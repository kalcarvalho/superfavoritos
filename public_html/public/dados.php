<?php 

include_once '../domain/UserProfile.class.php';
include_once '../persistence/UsuarioDAO.class.php';

$up = new UserProfile();
$ud = new UsuarioDAO();

$up = $ud->findByLoginProfile($_SESSION['sf_user_profile']);

// echo '<pre>';
// var_dump($up);
// echo '</pre>';

?>
<div class="content">
	<div class="painel-cliente">
		<h3>Dados da sua conta</h3>
		<form id="form-cadastro" method="post" action="update-userprofile">
			<p>
				<label>E-mail</label>
				<input type="text" value="<?php echo $up->getEmail(); ?>" class="pc-mail" disabled />
			</p>
			<p>
				<label>Sua cidade</label>
				<select name="city_id">
					<?php 
						$_GET = array();
						$_GET['tipo'] = "2";
						$city = $up->getCidade();
						include 'listar-cidades.php';
					?>
				</select> 
			</p>
			<p>
				<label>Nome</label>
				<input type="text" name="nome" value="<?php echo $up->getNome(); ?>"  class="pc-nome" />
			</p>
			<p>
				<label>Sobrenome</label>
				<input type="text" name="sobrenome" value="<?php echo $up->getSobrenome(); ?>"  class="pc-sobrenome" />
			</p>
			<p>
				<label>Sexo</label>
				<input type="radio" name="sexo" value="1"  class="pc-senha" <?php echo $up->getSexo() == 1 ? "checked" : ""; ?> />Masculino
				<input type="radio" name="sexo" value="2"  class="pc-senha" <?php echo $up->getSexo() == 2 ? "checked" : ""; ?> />Feminino
			</p>
			<p>
				<label>CEP</label>
				<input type="text" name="cep" value="<?php echo $up->getCEP(); ?>"  class="pc-senha" />
			</p>
			<p>
				<label>Endereço</label>
				<input type="text" name="endereco" value="<?php echo $up->getEndereco(); ?>"  class="pc-endereco" />
			</p>
			<p>
				<label>Telefone</label>
				<input type="text" name="telefone" value="<?php echo $up->getTelefone(); ?>"  class="pc-telefone" />
			</p>
			<p>
				<label>Celular</label>
				<input type="text" name="celular" value="<?php echo $up->getCelular(); ?>"  class="pc-telefone" />
			</p>
			<p>
				<label>&nbsp;</label>
				<a class="link" href="modify-password" >Modificar Senha</a>
			</p>
			<p>
				<label>&nbsp;</label> 
				<input type="submit" name="submit" value="Salvar" class="pc-submit"/>
			</p>
			<input type="hidden" name="uid" value="<?php echo $up->getCodigo(); ?>" />
			<input type="hidden" name="email" value="<?php echo $up->getEmail(); ?>" />
		</form>
		<p>
			<label>&nbsp;</label> 
			<?php if($erro) { ?>
				<span class="error-message"><?php echo base64_decode($msginfo); ?></span>
			<?php } else { ?>
				<span class="success-message"><?php echo base64_decode($msginfo); ?></span>
			<?php } ?>
		</p>
	</div>
</div>