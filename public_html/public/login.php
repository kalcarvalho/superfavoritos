<?php
$sucesso = $_REQUEST['sucesso'];
$uid = $_REQUEST['uid'];

?>
<?php if (!$msg == '') { ?>
	<div class="msglogin">
		<?php if ($p2 == 'erro') { ?>
			<p><span class="error-message"><?php echo $msg; ?></span></p>
		<?php } else { ?>
			<p><span class="success-message"><?php echo $msg; ?></span></p>
		<?php }  ?>
	</div>
<?php } ?>
<div class="content">
	<div class="painel-cliente">

		<h3>Faça seu login</h3>
		<form action="../controller/userLoginController.php" method="post" id="form-cadastro">
			<p>
				<label>E-mail:</label>
				<input type="text" size="30" name="login" value="<?php echo $_COOKIE['login'];	 ?>">
			</p>
			<p>
				<label>Senha:</label>
				<input type="password" size="30" name="senha" value="">
			</p>
			<p>
				<label>&nbsp;</label>
				<input name="submit" type="submit" value="Entrar" class="pc-submit">
				<?php if (isset($_COOKIE['oferta'])) { ?>
					<input type="hidden" name="page" value="carrinho" />
				<?php } else { ?>
					<input type="hidden" name="page" value="profile" />
				<?php } ?>
			</p>
		</form>
		<p>
			<label>&nbsp;</label>
		</p>
		<h3>Ainda não possui cadastro?</h3>
		<p class="cadastro">
			<a class="cadastro" href="cadastro">Cadastre-se</a>
			<a class="cadastro" href="esqueci">Esqueci senha</a>
		</p>

	</div>
</div>