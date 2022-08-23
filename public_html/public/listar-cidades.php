<?php
	
	include_once '../domain/Cidade.class.php';
	include_once '../persistence/CidadeDAO.class.php';
	
	

	$c = new Cidade();
	$cd = new CidadeDAO();
	if($_GET['tipo'] == 1) {
		$rs = $cd->listAll(true);
	} else {
		$rs = $cd->listAll(false);
	}
	
	$i=0;
	if ($rs) {
		foreach($rs as $c) {
			
			if ($_GET['tipo'] == 1) {
				$html .= '<h4><a href="cidade/'.$c->getTags().'">'.$c->getDescricao().'</a></h4>';
			} else {
				if($c->getCodigo() == $city) {
					$html .= '<option value="'.$c->getCodigo().'" selected>'.$c->getDescricao().'</option>';
				} else {
					$html .= '<option value="'.$c->getCodigo().'">'.$c->getDescricao().'</option>';
				}
				
			}
		}
	}
	
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: text/html; charset="utf-8"', true );
	echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
	echo $html;
