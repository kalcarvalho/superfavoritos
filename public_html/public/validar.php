<?php
	
	include_once '../persistence/UsuarioDAO.class.php';

	$hash = $_GET['uid'];
	
	$ud = new UsuarioDAO();
	
	$sucesso = $ud->validaUserProfile($hash);
	
	header('Location: index.php?p=login&uid='.$hash.'&sucesso='.$sucesso);
	
?>