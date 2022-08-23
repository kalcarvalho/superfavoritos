<?php

	session_start();
	
	if (!isset($_SESSION['sf_user_profile'])) {
	
		if($_POST['oferta']) {
			setcookie('oferta', $_POST['oferta'], time()+120);
			setcookie('descricao', $_POST['descricao'], time()+120);
			setcookie('quantidade', 1, time()+120);
			setcookie('preco', $_POST['preco'], time()+120);
			setcookie('of_city', $_POST['of_city'], time()+120);
		}
		
		header('Location: login/erro/'.base64_encode('Para realizar a compra, é necessário estar cadastrado ou logado no site.'));
	}


	if($_REQUEST['oferta']) {
	
		$oferta = $_REQUEST['oferta'];
		$descricao = $_REQUEST['descricao'];
		$quantidade = $_REQUEST['quantidade'];
		$preco = $_REQUEST['preco'];
		
	} else {
	
		$oferta = $_COOKIE['oferta'];
		$descricao = $_COOKIE['descricao'];
		$quantidade = $_COOKIE['quantidade'];
		$preco = $_COOKIE['preco'];
	
	}
	
?>
<div class="content">
<h3>Confirmar Compra</h3>
<table style="width: 100%; margin-top: 10px; margin-bottom: 10px; border: 1px solid #333;" cellspacing="0" >
	<thead style="text-align: center;  ">
		<tr style="background: #ff6; ">
			<th style="padding: 5px 0 5px 5px ;width: 50%">Cupom</th>
			<th>Qtde.</th>
			<th>Preco</th>
			<th>Total</th>
		</tr>
	</thead>
		<tr>
			<td style="padding: 10px 0 10px 5px;"><?php echo $descricao; ?></td>
			<td style="text-align: center;">
				<form method="post" action="carrinho" id="#form-cadastro">
					<input type="hidden" name="oferta" value="<?php echo $oferta; ?>" />
					<input type="hidden" name="descricao" value="<?php echo $descricao; ?>" />
					<input style="text-align: center" name="quantidade" type="text" size="1" value="<?php echo $quantidade; ?>" /><br />
					<input type="submit" name="submit" title="Atualizar Quantidade"  border: none;" value="Alterar Quantidade"  style="text-decoration: underline; margin-top: 5px; border: none; background: #fff; font-size: 12px;" />
					<input type="hidden" name="preco" value="<?php echo $preco; ?>" />
				</form>
			</td>
			<td style="text-align: right">R$ <?php echo number_format($preco, 2, ',',''); ?></td>
			<td style="text-align: right; padding-right: 5px;">R$ <?php echo number_format($preco * $quantidade, 2, ',',''); ?></td>
		</tr>
	<tr style="background: #f90; color: #fff; font-weight: bold; ">
		<td style="padding: 5px 0 5px 5px;">Total</td>
		<td></td>
		<td></td>
		<td style="text-align: right; padding-right: 5px">R$ <?php echo number_format($preco * $quantidade, 2, ',',''); ?></td>
	</tr>
</table>

<form method="post" action="registrar-pedido">
<p><h4>Comentários</h4></p>
<p><textarea name="comentarios" cols="82" rows="5"></textarea>
</p>
	<input type="submit" name="submit" value="Confirmar Compra" style="padding: 10px;" />
	<input type="hidden" name="oferta" value="<?php echo $oferta ?>" />
	<input type="hidden" name="quantidade" value="<?php echo $quantidade ?>" />
	<input type="hidden" name="profile" value="<?php echo $_SESSION['codigo'] ?>" />
	<input type="hidden" name="descricao" value="<?php echo $descricao; ?>" />
	<input type="hidden" name="preco" value="<?php echo $preco; ?>" />
</form>
</div>