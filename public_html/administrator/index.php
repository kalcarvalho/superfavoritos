<?php
	
	include_once '../domain/Funcao.class.php';
	
    session_start();
	
	$f = new Funcao();
	
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

    $login = $_SESSION['trajetoria'];
    
    if(!isset($login))  {
        $p = "../login.php";
    } else {
        $p = $_GET['p'];
        $p = (!isset($p)) ? "home.php" : $p.".php";
    }
	
	$_POST = $f->validaParametro($_POST);
	$_GET = $f->validaParametro($_GET);
    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0.1 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link rel="stylesheet" type="text/css" href="../estilo/interno.css" />
        <script type="text/javascript" src="../js/script.js"></script>
		<script type="text/javascript" src="../js/prototype.js"></script>
        <script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="../js/jquery.validate.js"></script>
		<script type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
			tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});
		</script>
        <title>SuperFavoritos - Administração</title>
    </head>
    <body>
    <?php if(!isset($login))  { ?>
        <?php include_once $p; ?>
    <?php } else { ?>
        <div id="container">
            <div id="topo-admin">Área Administrativa</div>
            <div id="menu-topo"><?php include_once 'menu.php'; ?></div>
            <div id="mensagem"><?php echo "Bem-vindo, ". $_SESSION['nome']; ?></div>
            <div id="conteudo"> <?php include_once $p; ?></div>
            <div id="rodape">Desenvolvido por: <a href="http://www.sysfactor.com.br" target="_blank">SysFactor</a> - Soluções Inteligentes em TI. Versão 1.0.0</div>
        </div>
   <?php } ?>
    </body>
</html>
