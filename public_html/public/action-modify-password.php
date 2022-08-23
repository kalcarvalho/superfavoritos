<?php

($_POST['submit']) or die('Acesso restrito.');


include_once '../persistence/CidadeDAO.class.php';
include_once '../domain/Cidade.class.php';
include_once '../domain/UserProfile.class.php';
include_once '../persistence/UsuarioDAO.class.php';

$cd  = new CidadeDAO();
$c = new Cidade();
$up = new UserProfile();
$ud = new UsuarioDAO();
$sucesso = false;
$user = $_POST['email'];

$up = $ud->findByLoginProfile($user);
// echo '<pre>';
// var_dump($up->getSenha());
// echo '</pre>';

// die();


if($up->getSenha() != md5($_POST['senha_atual'])) {
	$sucesso = false;
	$msg = base64_encode("A senha informada não corresponde à senha atual.")."/erro";

} else {
	$sucesso = $ud->updateProfilePassword($up->getCodigo(), md5($_POST['senha']));

	if($sucesso) {
		$msg = base64_encode("A sua senha foi alterada com sucesso!");
	} else {
		$msg = base64_encode("Houve algum problema ao alterar os dados ou nenhum dado foi alterado")."/erro";
	}
	
}

header('Location: modify-password/'.$msg);