<?php

	session_start();
	
	if (!isset($_SESSION['sf_user_profile'])) {
		header('Location: home/erro/'.base64_encode('Acesso não autenticado!'));
	}

?>