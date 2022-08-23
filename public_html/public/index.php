<?php

ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING);
// ini_set('display_errors', 1);

$geturl = explode('/', $_SERVER['REQUEST_URI']);

session_start();

include_once '../persistence/CidadeDAO.class.php';
include_once '../persistence/OfertaDAO.class.php';
include_once '../domain/Cidade.class.php';
include_once '../domain/Oferta.class.php';

setlocale(LC_MONETARY, 'pt_BR');

$ini = parse_ini_file('../config/site.ini', true);


$locked = $ini['admin']['locked'];
$analytics = $ini['admin']['analytics'] == 1 ? true : false;
$destaque = $ini['admin']['oferta'];
$cidade = $ini['admin']['cidade'];
$expira = $ini['admin']['expira'];
$base_dir = $ini['admin']['base_dir'];
$msgarea = false;
$msg = '';
$msginfo = '';
$erro = false;

$cd = new CidadeDAO();
$ct = new Cidade();
$of = null;
$od = new OfertaDAO();

$locked = (!isset($_REQUEST['locked'])) ? $locked : $_REQUEST['locked'];

if (isset($_COOKIE["locked"])) {
	$locked = $_COOKIE["locked"];
}

if (isset($_COOKIE["cidade"])) {
	$cidade = $_COOKIE["cidade"];
}

if (isset($_GET["cidade"])) {
	$cidade = $_GET["cidade"];
	setcookie("home_city", $cidade);
}

if (!isset($locked)) $locked = 1;



define("_SFav", true);

$conteudo = "" . $_GET['p'];

$p1 = $geturl[2];
$p2 = $geturl[3];
$p3 = $geturl[4];



// $p1 = $geturl[4];
// $p2 = $geturl[5];
// $p3 = $geturl[6];



if ($p1 == 'home' || strlen($p1) == 0) {
	$conteudo = 'home';
	if ($p2 == 'erro' || $p2 == 'sucesso') {
		$msg = base64_decode($p3);
		$msgarea = true;
	}
} elseif ($p1 == 'cidade') {
	$conteudo = 'home';
	$ct = $cd->findByTag($p2);
	$cidade = $ct->getCodigo();
	setcookie("home_city", $cidade);
} elseif ($p1 == 'oferta') {
	$conteudo = 'home';
	$oferta = $p2;
} elseif ($p1 == 'contato') {
	$conteudo = 'contato';
	$_GET['tipo'] = $p2;
} elseif ($p1 == 'login') {
	$conteudo = 'login';
	$cidade = (isset($_COOKIE['of_city']) ? $_COOKIE['of_city'] : $_COOKIE['home_city']);
	if ($p2 == 'erro' || $p2 == 'sucesso') {
		$msg = base64_decode($p3);
	}
} elseif ($p1 == 'dados' || $p1 == 'modify-password') {
	$conteudo = $p1;
	$msginfo = $p2;
	if ($p3 == 'erro') $erro = true;
} elseif ($p1 == 'promocao-bombons-santa-ignes') {
	$conteudo = $p1;
	$title = 'Curta a página do SuperFavoritos no Facebook e concorra a uma caixa de bombons da Bombons de Santa Ignes';
} elseif ($p1 == 'carrinho') {
	if (!isset($_SESSION['sf_user_profile'])) {
		include 'carrinho.php';
		exit();
	}
	$conteudo = 'carrinho';
	$cidade = $_COOKIE['of_city'];
} elseif ($p1 == 'registrar-pedido') {
	$conteudo = 'registrar-pedido';
	include_once 'gerar-pedido.php';
} elseif ($p1 == 'preview') {
	$conteudo = 'home';
	$locked = 0;
} elseif (
	$p1 == 'subscribe' || $p1 == 'contactus' ||
	$p1 == 'cadastrar-usuario' || $p1 == 'logout' ||
	$p1 == 'retorno' || $p1 == 'update-userprofile' || $p1 == 'action-modify-password'
) {
	include $p1 . '.php';
	exit();
} elseif (strpos($p1, '.php') || !file_exists($p1 . '.php')) {
	$conteudo = '404';
} else {
	$conteudo = $p1;
}

if ($locked == 0) {
	setcookie("locked", $locked, time() + 3600);
}

// var_dump($geturl);

if (!isset($conteudo)) $conteudo = 'home';

// if(strlen($_REQUEST['oferta']) == 0) {
// $_REQUEST['oferta'] = NULL;
// }

if ($conteudo == 'home') {

	if (isset($oferta)) {
		$of = $od->findByAlias($oferta);
		if (!$of) {
			$oferta = null;
			$conteudo = '404';
		} else {
			$oferta = $of->getCodigo();
			$pa = $od->retornaParceiroByOferta($of->getParceiro());
			if ($pa) {
				$cidade = $pa->getCidade();
			} else {
				$cidade = $_COOKIE['home_city'];
			}
			$ct = $cd->findByPK($cidade);
		}
	} else {

		$of = $od->findByDateCity(date('Y-m-d'), $cidade);

		if (!$of) {

			$rd = $cd->findByPK($cidade);
			$princ = $rd->getPrincipal();

			$of = $od->findByDateCity(date('Y-m-d'), $princ);

			if (!$of) {
				$of = $od->findByPK($destaque);
				$rd = $cd->findByPK($cidade);
				//$cidade = $ini['admin']['cidade'];
			} else {
				$cidade = $rd->getPrincipal();
			}
			$msgarea = true;
			$msg = "A cidade selecionada (" . $rd->getDescricao() . ") não possui oferta cadastrada, exibindo cidade mais próxima.";

			if ($of->getCodigo() == 1) {
				$msgarea = false;
				$msg = '';
			}
		} else {
			$rd = null;
		}
		$ct = $cd->findByPK($cidade);
		// setcookie("cidade", $cidade);
	}
} else if ($conteudo == 'carrinho') {
	// if(!isset($_SESSION['sf_user_profile'])) {
	// $conteudo = 'login';
	// $msglogin = 'Para realizar a compra, você precisa estar logado.';
	// $cidade = $_COOKIE['cidade'];
	// $ct = $cd->findByPK($cidade);	
	// } else {
	// $cidade = $_COOKIE['of_city'];
	// }
	$ct = $cd->findByPK($cidade);
} else if ($conteudo == 'profile') {
	if (isset($_REQUEST['page'])) {
		$conteudo = $_REQUEST['page'];
	}
	$ct = $cd->findByPK($cidade);
} else if ($conteudo == 'login') {
	// $msgarea = true;
	// $msg = base64_decode($msg);
	$ct = null;
} else {
	$msgarea = false;
	$msg = "";
	$ct = $cd->findByPK($cidade);
}

if (!$ct) $ct = $cd->findByPK($cidade);

if (!$msgarea && isset($_SESSION['sf_user_profile'])) {
	$msgarea = true;
	$msg = 'Você está logado como: <strong style="padding: 3px 5px; color: #fff; background: #f90">' . $_SESSION['sf_user_profile'] . '</strong>';
}

if (!isset($_COOKIE['home_city'])) {
	$conteudo = "receba";
	setcookie("home_city", $cidade);
} elseif (isset($_REQUEST['city_id'])) {
	setcookie("home_city", $_REQUEST['city_id']);
}

if (isset($_POST['oferta'])) {

	setcookie('oferta', $_POST['oferta'], time() + 120);
	setcookie('descricao', $_POST['descricao'], time() + 120);
	setcookie('quantidade', 1, time() + 120);
	setcookie('preco', $_POST['preco'], time() + 120);
	setcookie('of_city', $_POST['of_city'], time() + 120);
} else {

	// unset($_COOKIE['oferta']);
	// setcookie('oferta', NULL, -1);

	// unset($_COOKIE['descricao']);
	// setcookie('descricao', NULL, -1);

	// unset($_COOKIE['quantidade']);
	// setcookie('quantidade', NULL, -1);

	// unset($_COOKIE['preco']);
	// setcookie('preco', NULL, -1);

	// unset($_COOKIE['of_city']);
	// setcookie('of_city', NULL, -1);

	// unset($_COOKIE['pedido']);
	// setcookie('pedido', NULL, -1);

}
if ($of) $title = $of->getTitulo();
// echo '<pre>';
// var_dump($conteudo);
// echo '</pre>';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<base href="<?php echo $base_dir; ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="pt-br">
	<meta name="author" content="Kal Carvalho" />
	<meta name="description" content="Os melhores cupons com até 90% de desconto. Encontre aqui as melhores lojas, hotéis, restaurantes, bares, spas, entre outros estabelecimentos. Divulgue e seu cupom pode sair de graça." />
	<meta name="keywords" content="hotéis, bares, restaurantes, spas, compra, coletiva, desconto, cupons" />
	<?php if ($title) { ?>
		<meta name="title" content="<?php echo $title; ?>" />
	<?php } else { ?>
		<meta name="title" content="Desconto de até 90% em bares, restaurantes, hotéis, spas e muito mais. Aproveite, seu cupom pode sair de graça!" />
	<?php } ?>
	<meta name="robots" content="index,follow">
	<title>Super Favoritos | Desconto de até 90% em bares, restaurantes, hotéis, spas e muito mais. Aproveite, seu cupom pode sair de graça!</title>
	<link href="../estilo/estilo.css" rel="stylesheet" type="text/css" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
	<script src="../js/jquery.innerfade.js" type="text/javascript"></script>
	<script type="text/javascript">
		function displayBlockNone(db) {
			if (document.getElementById(db).style.display == "block") {
				document.getElementById(db).style.display = "none";
			} else {
				document.getElementById(db).style.display = "block";
			}
		}

		function pad2(number) {

			return (number < 10 ? '0' : '') + number

		}


		function atualizaContador(YY, MM, DD, HH, MI, SS, saida) {

			//var SS = 00; //Segundos
			var hoje = new Date(); //Dia
			var futuro = new Date(YY, MM - 1, DD, HH, MI, SS); //Data limite do contador

			var ss = parseInt((futuro - hoje) / 1000); //Determina a quantidade total de segundos que faltam
			var mm = parseInt(ss / 60); //Determina a quantidade total de minutos que faltam
			var hh = parseInt(mm / 60); //Determina a quantidade total de horas que faltam
			var dd = parseInt(hh / 24); //Determina a quantidade total de dias que faltam

			ss = ss - (mm * 60); //Determina a quantidade de segundos
			mm = mm - (hh * 60); //Determina a quantidade de minutos
			//hh += (dd * 24);



			//O bloco abaixo descreve monta o que vai ser escrito na tela
			var faltam = '';
			faltam += (toString(hh).length) ? pad2(hh) + ':' : '';
			faltam += (toString(mm).length) ? pad2(mm) + ':' : '';
			faltam += pad2(ss);

			//faltam = pad2(hh) + ':' + pad2(mm) + ':' + pad2(ss);


			if (dd + hh + mm + ss > 0) {
				document.getElementById(saida).innerHTML = '<strong>' + faltam + '</strong>'; //INsere o conteudo da variável faltam na página.
				setTimeout(function() {
					atualizaContador(YY, MM, DD, HH, MI, SS, saida)
				}, 1000); //Reinicia a função a cada um segundo
			} else {
				document.getElementById(saida).innerHTML = '<strong>00:00:00</strong>';
				setTimeout(function() {
					atualizaContador(YY, MM, DD, HH, MI, SS, saida)
				}, 1000);
			}
		}
	</script>

	<script type="text/javascript">
		$(document).ready(
			function() {
				$('ul#slide').innerfade({
					speed: 1000,
					timeout: 3000,
					type: 'sequence',
					containerheight: '330px'
				});
			});
	</script>

	<!-- Validação de Formulários com JQuery -->

	<?php include_once 'scripts.php'; ?>

	<?php if ($analytics == true) { ?>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-23537199-1']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();
		</script>
	<?php } ?>
</head>

<body id="bg">
	<?php if ($locked == 1) { ?>
		<div id="atualize" style="background: url(../images/transpie.png); width: 100%; height: 100%; position: fixed !important; position: absolute; z-index: 10; ">
			<div id="navegadores"></div>
		</div>
	<?php } ?>
	<div id="topo">
		<div id="logo">
			<a href="cidade/<?php echo $ct->getTags(); ?>">
				<img src="../images/logo-maior.png" />
			</a>
		</div>
		<div class="cidade">
			<h3><?php echo  $ct->getDescricao(); ?> </h3>
			<h4><a href="javascript:displayBlockNone('cidades');">Outras cidades</a></h4>
		</div>
	</div>
	<div id="cidades">
		<div id="cidades-content">
			<?php
			$_GET = array();
			$_GET['tipo'] = "1";
			$city = $cidade;
			include 'listar-cidades.php';
			?>
		</div>
	</div>
	<div id="menu">
		<div id="menu-content">
			<?php include_once 'menu.php' ?>
		</div>
	</div>
	<div id="container">
		<div id="page">
			<?php if ($msgarea) { ?>
				<div class="msglogin">
					<p style="text-align: left"><img src="../images/icone_info.png"><?php echo $msg; ?></p>
				</div>
			<?php } ?>
			<?php include_once $conteudo . '.php' ?>
			<?php include_once 'coluna.php' ?>
		</div>
	</div>
	<div id="rodape">
		<div class="rodape">
			<div class="box-rodape">
				<h3>SuperFavoritos</h3>
				<ul>
					<li><a href="sobre">Quem somos</a></li>
					<li><a href="como-funciona">Como funciona</a></li>
					<li><a href="promocoes">Promoções e Brindes</a></li>
					<li>Midia</li>
					<li><a href="contato">Contato</a></li>
				</ul>
			</div>
			<div class="box-rodape">
				<h3>Formas de Pagamento</h3>
				<a href="https://pagseguro.uol.com.br/?ind=498151" target="_blank">
					<img src="../images/pag-seguro.png" />
				</a>
			</div>
			<div class="box-rodape">
				<h3>Siga-nos</h3>
				<p><a href="http://www.facebook.com/pages/SuperFavoritos/208460049187293" target="_blank"><img src="../images/logoFb.png" style="float:left; margin-right: 5px; " />Facebook</a></p>
			</div>
		</div>
		<div class="rodape" style="border-top: 1px solid #666">
			<p>&copy; 2011 <a href="http://www.sysfactor.com.br" target="_blank">Sysfactor</a>. Todos os direitos reservados.</p>
		</div>
	</div>
</body>

</html>
*/
?>