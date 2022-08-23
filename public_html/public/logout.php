<?php
	session_start();
	if (isset($_SESSION['sf_user_profile'])){

		session_unset(); // Eliminar todas as variáveis da sessão
		session_destroy(); // Destruir a sessão
		header('Location: home');
	  
	} else {
		header('Location: home/erro/'.base64_encode('Acesso não autenticado!'));
	}
