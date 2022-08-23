<?php

ini_set('error_reporting', E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);

include_once '../domain/Parceiro.class.php';
include_once '../domain/OfertaTemFoto.class.php';


#carregar oferta

$pc = new Parceiro();
$ft = new OfertaTemFoto();

$pc = $od->retornaParceiroByOferta($of->getParceiro());
$fs = $od->listFotosByOferta($of->getCodigo());


$timeZone = "America/Sao_Paulo";
$dateTime =  date('Y-m-d G:i:s', strtotime($of->getTermino()));

$termino = new DateTime($dateTime, new DateTimeZone($timeZone));
#echo $termino->format("'Y','m','d','G','i','s'");

$status = 0; #0 - não iniciado / 1 - iniciado (não ativo) / 2 -  ativo / 3 - esgotado / 4 - encerrado 

if (date('Y-m-d') > $termino->format('Y-m-d')) {
	$status = 4;
	$dateTime =  date('Y-m-d G:i:s', date("now"));
	$termino = new DateTime($dateTime, new DateTimeZone($timeZone));
} elseif ($of->getMinimo() <= $of->getVendas()) {
	if ($of->getMaximo() <= $of->getVendas() && $of->getMaximo() != 0) {
		$status = 3;
		$dateTime =  date('Y-m-d G:i:s', date("now"));
		$termino = new DateTime($dateTime, new DateTimeZone($timeZone));
	} else {
		$status = 2;
	}
} elseif ($of->getMaximo() <= $of->getVendas() && $of->getMaximo() != 0) {
	$status = 3;
} else {
	$status = 1;
}

?>
<div class="content" <?php echo ($of->getCodigo() == 1 ? 'style="background: #fff;"' : ''); ?>>
	<h2><?php echo $of->getTitulo(); ?></h2>
	<?php if ($of->getCodigo() == 1) { ?>
		<img src="<?php echo $of->getFoto(); ?>" />
	<?php } else { ?>
		<ul id="slide">
			<?php
			if ($fs) {
				foreach ($fs as $ft) {
					echo '<li><img src="' . $ft->getFoto() . '" /></li>';
				}
			} else {
				echo '<li><img src="' . $of->getFoto() . '" /></li>';
			}
			?>
		</ul>

		<div id="comprar">
			<div class="box-comprar">
				<h1 style="background: #f90">R$ <?php echo number_format($of->getPreco(), 2, ',', ''); ?></h1>
				<h5>Valor</h5>
				<h5>Desconto</h5>
				<h5>Economia</h5>
				<h5>R$ <?php echo number_format($of->getCusto(), 2, ',', ''); ?></h5>
				<h5><?php echo number_format(($of->getCusto() - $of->getPreco()) / $of->getCusto() * 100, 0, ',', ''); ?>%</h5>
				<h5>R$ <?php echo number_format($of->getCusto() - $of->getPreco(), 2, ',', ''); ?></h5>
			</div>
			<div class="box-comprar" style="text-align: center;">
				<?php if ($status == 4) { ?>
					<input type="submit" name="submit" class="submit-encerrado" value="" />
				<?php } elseif ($status == 3) { ?>
					<input type="submit" name="submit" class="submit-esgotado" value="" />
				<?php } else { ?>
					<form method="post" action="carrinho">
						<input type="submit" name="submit" class="submit-comprar" value="" />
						<input type="hidden" name="oferta" value="<?php echo $of->getCodigo(); ?>" />
						<input type="hidden" name="descricao" value="<?php echo $of->getTitulo(); ?>" />
						<input type="hidden" name="quantidade" value="1" />
						<input type="hidden" name="preco" value="<?php echo $of->getPreco(); ?>" />
						<input type="hidden" name="of_city" value="<?php echo $ct->getCodigo(); ?>" />
					</form>
				<?php }  ?>
			</div>
			<div class="box-comprar" style="background: url(../images/peq_relogio.png) no-repeat; ">
				<h4>Tempo restante</h4>
				<div id="comprar-contador"></div>
			</div>

			<div class="box-comprar">
				<h4><?php echo $of->getVendas(); ?> comprador(es)</h4>
				<?php if ($status == 2) {  ?>
					<img style="text-align:center;" src="../images/oferta-ativada.jpg" />
				<?php } elseif ($status == 1) { ?>
					<p><strong>Falta(m) <?php echo $of->getMinimo() - $of->getVendas(); ?> para ativar esta oferta.</strong></p>
				<?php } ?>

			</div>
		</div>

		<div id="oferta">
			<h4 class="titulo-recomende">Recomende esta oferta</h4>
			<div class="recomende">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_preferred_1"></a>
					<a class="addthis_button_preferred_2"></a>
					<a class="addthis_button_preferred_3"></a>
					<a class="addthis_button_preferred_4"></a>
					<a class="addthis_button_compact"></a>
					<a class="addthis_counter addthis_bubble_style"></a>
				</div>
				<script type="text/javascript">
					var addthis_config = {
						"data_track_clickback": true
					};
				</script>
				<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4dc9af52497b93c5"></script>
				<!-- AddThis Button END -->
			</div>
			<div class="destaques_da_oferta">
				<ul>
					<h4>Destaques</h4>
					<?php echo $of->getDestaques(); ?>
				</ul>
			</div>
			<div class="regras_da_oferta">
				<ul>
					<h4>Regras</h4>
					<?php echo $of->getRegras(); ?>
				</ul>
			</div>
		</div>
	<?php } ?>
</div>
<?php if ($of->getCodigo() != 1) { ?>
	<div class="content">
		<div id="parceiro">
			<a href="<?php echo $pc->getGmaps(); ?>" target="_blank">
				<img src="<?php echo $pc->getMapa(); ?>" />
			</a>
			<h3><?php echo $pc->getFantasia(); ?></h3>
			<p><?php echo $pc->getSite(); ?></p>
			<p><?php echo $pc->getEndereco(); ?> <strong>(clique no mapa para ampliar)</strong></p>
		</div>
		<div class="texto_oferta">
			<?php echo $of->getTexto(); ?>
		</div>
	</div>
<?php } ?>
<script type="text/javascript">
	window.onload = function() {
		atualizaContador(<?php echo $termino->format("'Y','m','d','G','i','s'"); ?>, 'comprar-contador');
	}
</script>