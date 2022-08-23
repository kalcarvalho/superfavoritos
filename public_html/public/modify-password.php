]<?php

	include_once '../domain/UserProfile.class.php';
	include_once '../persistence/UsuarioDAO.class.php';

	$up = new UserProfile();
	$ud = new UsuarioDAO();

	$up = $ud->findByLoginProfile($_SESSION['sf_user_profile']);

	?>
<div class="content">
	<div class="painel-cliente">
		<h3>Dados da sua conta</h3>
		<form id="form-cadastro" method="post" action="action-modify-password">
			<p>
				<label>E-mail</label>
				<input type="text" value="kalcarvalho@gmail.com" class="pc-mail" disabled />
			</p>
			<p>
				<label>Senha atual</label>
				<input type="password" name="senha_atual" id="senha_atual" class="pc-senha" />
			</p>
			<p>
				<label>Nova senha</label>
				<input type="password" name="senha" id="senha" class="pc-senha" />
			</p>
			<p>
				<label>Confirmar senha</label>
				<input type="password" name="confirmar_senha" id="confirmar_senha" class="pc-senha" />
			</p>

			<p>
				<label>&nbsp;</label>
				<input type="submit" name="submit" value="Salvar" class="pc-submit" />
				<input type="hidden" name="uid" value="<?php echo $up->getCodigo(); ?>" />
				<input type="hidden" name="email" value="<?php echo $up->getEmail(); ?>" />
			</p>
		</form>
		<p>
			<label>&nbsp;</label>
			<?php if ($erro) { ?>
				<span class="error-message"><?php echo base64_decode($msginfo); ?></span>
			<?php } else { ?>
				<span class="success-message"><?php echo base64_decode($msginfo); ?></span>
			<?php } ?>
		</p>
	</div>
</div>