<?php

setcookie("email", $_POST['email'], time()+120);
setcookie("cidade", $_POST['city_id'], time()+120);
setcookie("nome", $_POST['nome'], time()+120);
setcookie("sobrenome", $_POST['sobrenome'], time()+120);
setcookie("sexo", $_POST['sexo'], time()+120);
setcookie("cep", $_POST['cep'], time()+120);
setcookie("endereco", $_POST['endereco'], time()+120);
setcookie("telefone", $_POST['telefone'], time()+120);
setcookie("celular", $_POST['celular'], time()+120);

($_POST['submit']) or die('Acesso restrito.');

$email = $_REQUEST['email']; 

include_once '../persistence/CidadeDAO.class.php';
include_once '../domain/Cidade.class.php';
include_once '../domain/UserProfile.class.php';
include_once '../persistence/UsuarioDAO.class.php';

$cd  = new CidadeDAO();
$c = new Cidade();
$up = new UserProfile();
$ud = new UsuarioDAO();
$sucesso = false;
$ativacao = md5(strtotime('now'));

$up->setEmail($_REQUEST['email']);
$up->setCidade($_REQUEST['city_id']);
$up->setNome($_REQUEST['nome']);
$up->setSobreNome($_REQUEST['sobrenome']);
$up->setSexo($_REQUEST['sexo']);
$up->setCEP($_REQUEST['cep']);
$up->setEndereco($_REQUEST['endereco']);
$up->setTelefone($_REQUEST['telefone']);
$up->setCelular($_REQUEST['celular']);
$up->setSenha(md5($_REQUEST['senha']));
$up->setAtivacao($ativacao);
$up->setAtivo(1);

$sucesso = $ud->insertUserProfile($up);

// echo '<pre>';
// var_dump($up);
// echo '</pre>';

$c = $cd->findByPK($_REQUEST['city_id']);

$body = '<p><strong>Um novo cadastro foi realizado no site SuperFavoritos:</strong></p>'.
'<p>Nome: '.$_REQUEST['nome'].'.</p>'.
'<p>Email: '.$_REQUEST['email'].'.</p>'.
'<p>Cidade: '.$c->getDescricao().'.</p>'.
'<p>Comentários: '.$_REQUEST['comentarios'].'.</p>'.
'<p><label>&nbsp;</label></p>'.
'<p>Atenciosamente,</p>'.
'<p><strong>SuperFavoritos</strong> - Uma compra coletiva diferente.</p>'.
'<p><a href="http://www.superfavoritos.com.br" >www.superfavoritos.com.br</a></p>';


## CONFIG ##

# LIST EMAIL ADDRESS
$recipient = "cadastro@superfavoritos.com.br";

# SUBJECT (Subscribe/Remove)
$subject = "Novo cadastro no site SuperFavoritos";

# RESULT PAGE
$location = $_POST['retorno'];

## FORM VALUES ##

# SENDER
$email = $_REQUEST['email']; 

## SEND MESSGAE ##

include 'send-mail.php';

## SHOW RESULT PAGE ##

if(!$sucesso) {
	$msg = base64_encode("Houve um problema ao enviar seu e-mail, tente novamente mais tarde.") . "&erro=1";
	$location = 'home/erro/' . $msg;
	header( "Location: $location" );
	exit();
}
$recipient = $email;

$email = "cadastro@superfavoritos.com.br";

$subject = "Obrigado por se cadastrar no SuperFavoritos";

$body = '<p>Olá, '.$_REQUEST['name'].'.</p>'.
'<p>Obrigado por se cadastrar no site SuperFavoritos.</p>'.
'<p><label>&nbsp;</label></p>'.
'<p>Atenciosamente,</p>'.
'<p><strong>SuperFavoritos</strong> - Uma compra coletiva diferente.</p>'.
'<p><a href="http://www.superfavoritos.com.br" >www.superfavoritos.com.br</a></p>'.
'<p>DÚVIDAS? Acesse o <a href="http://www.superfavoritos.com.br/public/contato">Canal de Atendimento</a></p>'.
'<p><label>&nbsp;</label></p>'.
'<p>Este é um e-mail automático disparado pelo sistema. Favor não respondê-lo, pois esta conta não é monitorada.</p>';


include 'send-mail.php';

if(!$sucesso) {
	$msg = base64_encode("Houve um problema ao enviar seu e-mail, tente novamente mais tarde.") . "&erro=1";
	$location = 'home/erro/' . $msg;
	header( "Location: $location" );
	exit();
}

header( "Location: $location" );

?>