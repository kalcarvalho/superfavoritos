<?php if (!isset($_SESSION['sf_user_profile'])) { ?>
	<a href="home">Oferta do dia</a>
	<a href="ofertas/<?php echo $ct->getTags(); ?>">Ofertas recentes</a>
	<a href="como-funciona">Como funciona?</a>
	<a href="receba">Receba e-mail diário</a>
	<a href="contato">Contato</a>
	<a href="cadastro">Cadastre-se</a>
	<a href="login">Login</a>
<?php } else { ?>
	<a href="home/ind/<?php echo md5($_SESSION['codigo']); ?>">Oferta do dia</a>
	<a href="ofertas/<?php echo $ct->getTags(); ?>">Ofertas recentes</a>
	<a href="como-funciona">Como funciona?</a>
	<a href="profile">Minha Conta</a>
	<a href="receba">Receba e-mail diário</a>
	<a href="contato">Contato</a>
	<a href="logout">Sair</a>
<?php } ?>