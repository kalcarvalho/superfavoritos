<?php 

	include_once '../domain/Pedido.class.php';
	include_once '../domain/Oferta.class.php';
	include_once '../persistence/PedidoDAO.class.php';
	include_once '../persistence/OfertaDAO.class.php';
	
	$pe = new Pedido();
	$pd = new PedidoDAO();
	$of = new Oferta();
	$od = new OfertaDAO();

	$rs = $pd->listByCliente($_SESSION['codigo'], true);
	$i = 0;
?>
<div class="content">
		<h3>Meus Cupons</h3>
		<?php if( $rs ) { ?>
		<table style="width: 100%; margin-top: 10px; margin-bottom: 10px;" cellspacing="0" >
			<tr style="font-weight: bold; background: #f90; color: #fff;" >
				<th style="padding: 5px 0 5px 5px ;width: 50%">Oferta</th>
				<th>Quant.</th>
				<th>Total</th>
				<th>Cupom</th>
				<th style="padding-right: 5px;">Operação</th>
			</tr>
			<?php foreach($rs as $pe) { ?>
			<?php $of = $od->findByPK($pe->getOferta()); $i++; ?>
				<tr style="height: 5px;"></tr>
				<tr style="background: <?php echo ($i % 2 == 0 ? '#fff' : '#ffa'); ?>">
					<td><?php echo $of->getTitulo(); ?></td>
					<td style="text-align: right"><?php echo $pe->getQuantidade(); ?></td>
					<td style="text-align: right">R$ <?php echo number_format($pe->getQuantidade() * $pe->getValor(), 2, ',',''); ?></td>
					<td style="text-align: center"><?php echo $pe->getCupom(); ?></td>
					<td><a href="imprime-cupom">imprimir</a></td>
				</tr>
			<?php } ?>	
		</table>
		<?php } else { ?>
			<p>Você não possui nenhum cupom cadastrado. Caso tenha realizado alguma compra, acesse <strong>Minha Conta >> Minhas Compras </strong> ou aguarde até que o cupom seja liberado</p>
		<?php } ?>
</div>