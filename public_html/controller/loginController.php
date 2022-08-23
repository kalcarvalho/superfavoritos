<?php	
	ob_start();
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
    include_once '../domain/Usuario.class.php';

    

    $ud = new UsuarioDAO();
    $u = new Usuario();
    $msg = "";

    

    $login = $_POST['login'];
    $senha = $_POST['senha']; //base64_encode($_POST['senha']);

    $u = $ud->findByLogin($login);

    if(!isset($u)) {
        $msg = base64_encode("Login não encontrado.");
        header('Location: ../administrator/index.php?msg='.$msg);
    } else  {
        if (strcmp(md5($senha), $u->getSenha()) == 0)  {
			
			session_regenerate_id();
            $_SESSION['trajetoria'] = $login;
            $_SESSION['nome'] = $u->getNome();
            $_SESSION['codigo'] = $u->getCodigo();
            $_SESSION['perfil'] = $u->getPerfil();

            header('Location: ../administrator/index.php?p=home');

        } else {
            $msg = base64_encode("Senha ou login incorretos");
            header('Location: ../administrator/index.php?msg='.$msg);
        }
    }

    exit();

    
?>
