<?php 

	include_once '../domain/Funcao.class.php';
	include_once '../domain/Oferta.class.php';
	include_once '../domain/Pedido.class.php';
	include_once '../persistence/OfertaDAO.class.php';
	include_once '../persistence/PedidoDAO.class.php';
	
	// Incluindo o arquivo da biblioteca
	include('pgs.php');
	
	// $f = new Funcao();
	// $op = new Oferta();
	// $pe = new Pedido();
	// $pd = new PedidoDAO();
	
	// $op = $od->findByPK($_REQUEST['oferta']);
	
	// Criando um novo carrinho
	$pgs = new pgs(array('email_cobranca'=>'pagamento@superfavoritos.com.br'));
	$descricao = trim($_REQUEST['descricao']);
	$preco = $_REQUEST['preco'];
	$qtde = $_REQUEST['quantidade'];
	
	
	// if(!isset($_COOKIE['pedido'])) {
		// $id_pagseguro = str_pad($op->getCodigo(), 8,'0', STR_PAD_LEFT) . '.' . 
						// str_pad($op->getParceiro(), 6, '0', STR_PAD_LEFT) . '.' .
						// date("now") . '.' .
						// time();
	// } else {
		// $id_pagseguro = $_COOKIE['pedido'];
	// }
	

	// Adicionando um produto
	$pgs->adicionar(array(
	  array(
		"descricao"=>substr($descricao, 0, 96).'...',
		"valor"=>$preco,
		"peso"=>0,
		"quantidade"=>$qtde,
		"id"=>$id_pagseguro
	  ),
	));

// Mostrando o botão de pagamento

	// if(!isset($_COOKIE['pedido'])) {

		// $pe->setCliente($_SESSION['codigo']);
		// $pe->setStatus('Aguardando pagamento');
		// $pe->setParceiro($op->getParceiro());
		// $pe->setPagSeguro($id_pagseguro);
		// $pe->setTitulo($descricao);
		// $pe->setQuantidade($qtde);
		// $pe->setValor($preco);
		// $pe->setOferta($_REQUEST['oferta']);
		// $msg = $pd->insert($pe);
		
	// }
	
	// if($msg) {
		// setcookie("pedido",$id_pagseguro, time()+3600);
	// }
	

?>
<div class="content">
<div class="painel-cliente">
<?php 
	echo '<h4>Parabéns, '.$_SESSION['nome'].'! </h4>';
	echo '<h4>você adquiriu '.$_REQUEST['quantidade'].' cupom(ns) de desconto referente a: </h4>';
	echo '<h2 style="font-style:italic; color: #666">'.$descricao.'</h2>';
	echo '<h4>Valor a pagar: R$ '.number_format($_REQUEST['preco'], 2, ',','').'</h4>';
	echo '<h4>Clique abaixo para realizar o pagamento (você será redirecionado para o PagSeguro)</h4>';
	echo '<h4>O seu cupom será liberado em até 24 horas após o término desta oferta.</h4>';
	$pgs->mostra();
?>
</div>
</div>