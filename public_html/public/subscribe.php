<?php 

include_once '../persistence/CidadeDAO.class.php';
include_once '../domain/Cidade.class.php';

$cd  = new CidadeDAO();
$c = new Cidade();

$cd->insertUserNewsletter($_REQUEST['email'], $_REQUEST['city_id']);

$c = $cd->findByPK($_REQUEST['city_id']);

//setcookie("home_city", $_REQUEST['city_id']);

## CONFIG ##

# LIST EMAIL ADDRESS
$recipient = "contato@superfavoritos.com.br";

# SUBJECT (Subscribe/Remove)
$subject = "Receba ofertas do SuperFavoritos na cidade de ". $c->getDescricao();

# RESULT PAGE
$location = 'home/sucesso/'.base64_encode('E-mail cadastrado com sucesso na nossa newsletter.');

## FORM VALUES ##

# SENDER
$email = $_REQUEST['email']; 

# MAIL BODY
$body = '<html><body>' . 
'<h4>Um novo e-mail foi cadastrado no sistema de newsletter...</h4>' .
'<p>Email: <a href="mailto:'.$_REQUEST['email'].'">'.$_REQUEST['email'].' </p>'.
'<p>Cidade: '.$c->getDescricao().' ('.$c->getCodigo().')</p>'.
'</body></html>';
# add more fields here if required

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

$subject = "Receba ofertas da sua cidade - superfavoritos.com.br";

$body = '<p><strong>Obrigado por se cadastrar em nossa Newsletter!</strong></p>'.
'<p>Em breve, você receberá ofertas da sua região e promoções relacionadas ao site.</p>'.
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
