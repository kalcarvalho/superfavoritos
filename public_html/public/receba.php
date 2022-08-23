<div class="content">
	<div class="cadastro-email">
		<h2>Cadastro de e-mail</h2>
		<h4>Cadastre-se hoje mesmo e receba as melhores ofertas da sua cidade com até 90% de desconto!</h4>
		<p>Um novo desconto a cada dia, nos melhores lugares para comer, para beber, viu? Você não vai querer perder essa.</p>
		<form id="form-cadastro" action="subscribe" method="post"> 
			<div class="box-cadastro-mail"> 
					<label>Informe seu e-mail: </label> 
					<input id="enter-address-mail" name="email" class="f-input f-mail" type="text" value="" size="20" require="true" datatype="email" /> 
					<span class="tip">(Não se preocupe, seu e-mail está bem guardado!)</span> 
			</div> 
			<div class="box-cadastro-city"> 
				<label>&nbsp;</label> 
				<select name="city_id" class="f-city">
					<?php 
						$_GET = array();
						$_GET['tipo'] = "2";
						$city = $_COOKIE['home_city'];
						include 'listar-cidades.php';
					?>
				</select> 
				<input type="submit" class="formbutton" value="Inscreva-se" /> 
			</div> 
		</form> 
	</div>
</div>