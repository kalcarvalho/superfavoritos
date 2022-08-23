<?php 
	if (!isset($p2)) {
		if(isset($_REQUEST['tipo'])) {
			$tipo = $_REQUEST['tipo'];
		} else {
			$tipo = 0;
		}
	} else {
		$tipo = ($p2 == 'quero-ser-parceiro') ? 2 : 0;
	}
	if(!isset($_REQUEST['msg'])) {

?>
<div class="content">
	<div class="painel-cliente">
		<form action="contactus" method="post" id="form-cadastro">
			<h3><?php echo $tipo == 2 ? "Quero ser Parceiro" : "Fale Conosco"; ?></h3>
			<p>
				<label>Nome</label>
				<input type="text" name="nome" id="nome" value=""  class="pc-nome" />
			</p>
			<p>
				<label>E-mail</label>
				<input type="text" name="email" id="email" value="" class="pc-mail" />
			</p>
			<p>
				<label>Cidade</label>
				<select name="city_id">
					<?php 
						$_GET = array();
						$_GET['tipo'] = "2";
						$city = $_COOKIE['home_city'];
						include 'listar-cidades.php';
					?>
				</select> 
			</p>
			<p>
				<label>Tipo</label>
				<select name="tipo_contato">
					<option value="0" <?php echo ($tipo==0) ? "selected" : "" ?> >(selecione um item)</option>
					<option value="1" <?php echo ($tipo==1) ? "selected" : "" ?> >Cliente</option>
					<option value="2" <?php echo ($tipo==2) ? "selected" : "" ?> >Quero ser parceiro</option>
					<option value="3" <?php echo ($tipo==3) ? "selected" : "" ?> >Já sou parceiro</option>
				</select>
			</p>
			<p>
				<label>Assunto</label>
				<input type="text" name="assunto" value="<?php echo $tipo == 2 ? "Como faço para anunciar no SuperFavoritos" : ""; ?>" id="assunto"  class="pc-endereco" />
			</p>
			<p>
				<label style="vertical-align: top; ">Comentários</label>
				<textarea name="comentarios" cols="60" rows="10"></textarea>
			</p>
			<p>
				<label>&nbsp;</label> 
				<input type="submit" value="Enviar" class="pc-submit"/>
			</p>
			<p class="erro"><?php echo base64_decode($_REQUEST['msg']); ?></p>
		</form>
	</div>
</div>
<?php } else {?>
<div class="content">
	<div class="painel-cliente">
		<h3>Fale Conosco</h3>
		<?php if(!isset($_REQUEST['erro'])) { ?> 
			<p class="sucesso"><?php echo base64_decode($_REQUEST['msg']); ?></p>
		<?php } else { ?>
			<p class="erro"><?php echo base64_decode($_REQUEST['msg']); ?></p>
		<?php }  ?>
	</div>
</div>
<?php } ?>