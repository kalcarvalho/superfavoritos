<?php ob_start();

	session_start();
	
	if (array_key_exists('HTTP_USER_AGENT', $_SESSION)) {
		if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
		  /* Acesso inválido. O header User-Agent mudou
		   durante a mesma sessão. */
		  exit;
		}
	} else {
		/* Primeiro acesso do usuário, vamos gravar na sessão um
		hash md5 do header User-Agent */
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
	}
	
    include_once '../persistence/UsuarioDAO.class.php';
    include_once '../domain/UserProfile.class.php';

    $ud = new UsuarioDAO();
    $u = new UserProfile();
    $msg = "";
	
    $login = $_POST['login'];
    $senha = $_POST['senha']; //base64_encode($_POST['senha']);
	setcookie("login", $login, time()+120);
	

    $u = $ud->findByLoginProfile($login);

    if(!isset($u)) {
        $msg = base64_encode("Login não encontrado.");
        // header('Location: ../public/index.php?p=login&msg='.$msg);
        header('Location: ../public/login/erro/'.$msg);
    } else  {
        if (strcmp(md5($senha), $u->getSenha()) == 0)  {
			
			session_regenerate_id();
			
            $_SESSION['sf_user_profile'] = $login;
            $_SESSION['nome'] = $u->getNome();
            $_SESSION['codigo'] = $u->getCodigo();

			if($_POST['page'] == 'profile') {
				// header('Location: ../public/index.php?p=profile');
				header('Location: ../public/profile');
			} elseif($_POST['page'] == 'carrinho' ) {
				// header('Location: ../public/index.php?p=carrinho');
				header('Location: ../public/carrinho');
			}

        } else {
            $msg = base64_encode("Senha ou login incorretos");
            // header('Location: ../public/index.php?p=login&msg='.$msg);
			header('Location: ../public/login/erro/'.$msg);
        }
    }

    exit();
	
?>