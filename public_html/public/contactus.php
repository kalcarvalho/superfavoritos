<?php

include_once '../persistence/CidadeDAO.class.php';
include_once '../domain/Cidade.class.php';

$cd  = new CidadeDAO();
$c = new Cidade();
$sucesso = false;

$c = $cd->findByPK($_REQUEST['city_id']);

$body = '<p><strong>Um novo e-mail foi enviado pelo fale conosco:</strong></p>'.
'<p>Nome: '.$_REQUEST['nome'].'</p>'.
'<p>Email: <a href="'.$_REQUEST['email'].'" >'.$_REQUEST['email'].'</a></p>'.
'<p>Tipo Contato: '.$_REQUEST['tipo_contato'].'. (1 - Cliente / 2 - Quero ser parceiro / 3 - Já sou parceiro)</p>'.
'<p>Cidade: '.$c->getDescricao().'</p>'.
'<p>Comentários: '.$_REQUEST['comentarios'].'</p>';


## CONFIG ##

# LIST EMAIL ADDRESS
$recipient = "contato@superfavoritos.com.br";

# SUBJECT (Subscribe/Remove)
$subject = "Fale Conosco SFav - ".$_REQUEST['assunto'];

# RESULT PAGE
$location = 'home/sucesso/'.base64_encode('Obrigado! Sua mensagem foi enviada com sucesso, em breve entraremos em contato.');

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

$email = "contato@superfavoritos.com.br";

$subject = "Fale conosco - superfavoritos.com.br";

$body = '<p><strong>Obrigado por entrar em contato!</strong></p>'.
'<p>Em breve, responderemos seu e-mail.</p>'.
'<p><label>&nbsp;</label></p>'.
'<p>Atenciosamente,</p>'.
'<p>SuperFavoritos - Uma compra coletiva diferente.</p>'.
'<p><a href="http://www.superfavoritos.com.br" >www.superfavoritos.com.br</a></p>';

include 'send-mail.php';

if(!$sucesso) {
	$msg = base64_encode("Houve um problema ao enviar seu e-mail, tente novamente mais tarde.") . "&erro=1";
	$location = 'home/erro/' . $msg;
	header( "Location: $location" );
	exit();
}

header( "Location: $location" );

?>