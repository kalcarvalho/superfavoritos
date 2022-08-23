<?php 

		if(!isset($_REQUEST['msg'])) {


?>
<div class="content">
	<div class="painel-cliente">
		<h3>Dados cadastrais</h3>
		<form id="form-cadastro" method="post" action="cadastrar-usuario">
			<p>
				<label>E-mail</label>
				<input type="text" id="email" name="email" value="<?php echo $_COOKIE['email']; ?>" class="pc-mail" />
			</p>
			<p>
				<label>Sua cidade</label>
				<select name="city_id">
					<?php 
						$_GET = array();
						$_GET['tipo'] = "2";
						$city = (isset($_COOKIE['cidade']) ? $_COOKIE['cidade'] : $_COOKIE['home_city']);
						include 'listar-cidades.php';
					?>
				</select> 
			</p>
			<p>
				<label>Nome</label>
				<input type="text" id="nome" name="nome" value="<?php echo $_COOKIE['nome']; ?>"  class="pc-nome" />
			</p>
			<p>
				<label>Sobrenome</label>
				<input type="text" id="sobrenome" name="sobrenome" value="<?php echo $_COOKIE['sobrenome']; ?>"  class="pc-sobrenome" />
			</p>
			
			<p>
				<label>Sexo</label>
				<?php if( $_COOKIE['sexo'] == "2") { ?>
					<input type="radio" name="sexo" value="1"  class="pc-senha" />Masculino
					<input type="radio" name="sexo" value="2"  class="pc-senha" checked />Feminino
				<?php } else { ?>
					<input type="radio" name="sexo" value="1"  class="pc-senha" checked />Masculino
					<input type="radio" name="sexo" value="2"  class="pc-senha"  />Feminino
				<?php }  ?>
			</p>
			<p>
				<label>Senha</label>
				<input type="password" id="senha" name="senha" value=""  class="pc-senha" />
			</p>
			<p>
				<label>Confirmar senha</label>
				<input type="password" id="confirmar_senha" name="confirmar_senha" value=""  class="pc-senha" />
			</p>
			<p>
				<label>CEP</label>
				<input type="text" name="cep" value="<?php echo $_COOKIE['cep']; ?>"  class="pc-senha" />
			</p>
			<p>
				<label>Endereço</label>
				<input type="text" name="endereco" value="<?php echo $_COOKIE['endereco']; ?>"  class="pc-endereco" />
			</p>
			<p>
				<label>Telefone</label>
				<input type="text" name="telefone" value="<?php echo $_COOKIE['telefone']; ?>"  class="pc-telefone" />
			</p>
			<p>
				<label>Celular</label>
				<input type="text" name="celular" value="<?php echo $_COOKIE['celular']; ?>"  class="pc-telefone" />
			</p>
			
			<p>
				<label>&nbsp;</label> 
				<input type="submit" name="submit" value="Cadastrar" class="pc-submit"/>
				<input type="hidden" name="retorno" value="login/sucesso/<?php echo base64_encode('Seu cadastro foi realizado com sucesso. Faça login para continuar...'); ?>" />
			</p>
		</form>
	</div>
</div>
<?php } else {?>
<div class="content">
	<div class="painel-cliente">
		<h3>Cadastro</h3>
		<?php if(!isset($_REQUEST['erro'])) { ?> 
			<p class="sucesso"><?php echo base64_decode($_REQUEST['msg']); ?></p>
		<?php } else { ?>
			<p class="erro"><?php echo base64_decode($_REQUEST['msg']); ?></p>
		<?php }  ?>
	</div>
</div>
<?php } ?>