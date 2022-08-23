<?php

	include_once '../domain/Oferta.class.php';
	include_once '../domain/Pedido.class.php';
	include_once '../persistence/OfertaDAO.class.php';
	include_once '../persistence/PedidoDAO.class.php';
	
	$op = new Oferta();
	$pe = new Pedido();
	$pd = new PedidoDAO();
	
	$op = $od->findByPK($_COOKIE['oferta']);
	

	if(!isset($_COOKIE['pedido'])) {
		$id_pagseguro = str_pad($op->getCodigo(), 8,'0', STR_PAD_LEFT) . '.' . 
						str_pad($op->getParceiro(), 6, '0', STR_PAD_LEFT) . '.' .
						date("now") . '.' .
						time();
	} else {
		$id_pagseguro = $_COOKIE['pedido'];
	}
	
	if(!isset($_COOKIE['pedido'])) {

		$pe->setCliente($_SESSION['codigo']);
		$pe->setStatus('Aguardando pagamento');
		$pe->setParceiro($op->getParceiro());
		$pe->setPagSeguro($id_pagseguro);
		$pe->setTitulo($_REQUEST['descricao']);
		$pe->setQuantidade($_REQUEST['quantidade']);
		$pe->setValor($_REQUEST['preco']);
		$pe->setOferta($_REQUEST['oferta']);
		$res = $pd->insert($pe);
		// var_dump($pe);
		// die();
	}
	
	if($res) {
		setcookie("pedido",$id_pagseguro, time()+3600);
	} else {
		unset($_COOKIE['pedido']);
		setcookie("pedido",NULL, -1);
	}
