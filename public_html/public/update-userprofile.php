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
// var_dump($up);
// echo '</pre>';


$up->setEmail($_POST['email']);
$up->setCidade($_POST['city_id']);
$up->setNome($_POST['nome']);
$up->setSobreNome($_POST['sobrenome']);
$up->setSexo($_POST['sexo']);
$up->setCEP($_POST['cep']);
$up->setEndereco($_POST['endereco']);
$up->setTelefone($_POST['telefone']);
$up->setCelular($_POST['celular']);


$sucesso = $ud->updateUserProfile($up);

if($sucesso) {
	$msg = base64_encode("Os dados foram alterados com sucesso!");
} else {
	$msg = base64_encode("Houve algum problema ao alterar os dados ou nenhum dado foi alterado")."/erro";
}

header('Location: dados/'.$msg);