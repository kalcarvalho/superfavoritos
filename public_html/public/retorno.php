<?php

	include_once '../domain/PagSeguro.class.php';
	include_once '../domain/Funcao.class.php';
	include_once '../persistence/PedidoDAO.class.php';

	header('Content-Type: text/html; charset=ISO-8859-1');

	define('TOKEN', '');

	$pg = new PagSeguro();
	$pd = new PedidoDAO();
	$f = new Funcao();

// class PagSeguroNpi {
	
	// private $timeout = 20; // Timeout em segundos
	
	// public function notificationPost() {
		// $postdata = 'Comando=validar&Token='.TOKEN;
		// foreach ($_POST as $key => $value) {
			// $valued    = $this->clearStr($value);
			// $postdata .= "&$key=$valued";
		// }
		// return $this->verify($postdata);
	// }
	
	// private function clearStr($str) {
		// if (!get_magic_quotes_gpc()) {
			// $str = addslashes($str);
		// }
		// return $str;
	// }
	
	// private function verify($data) {
		// $curl = curl_init();
		// curl_setopt($curl, CURLOPT_URL, "https://pagseguro.uol.com.br/pagseguro-ws/checkout/NPI.jhtml");
		// curl_setopt($curl, CURLOPT_POST, true);
		// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($curl, CURLOPT_HEADER, false);
		// curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
		// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		// $result = trim(curl_exec($curl));
		// curl_close($curl);
		// return $result;
	// }

// }

if (count($_POST) > 0) {
	
	// POST recebido, indica que é a requisição do NPI.
	// $npi = new PagSeguroNpi();
	// $result = $npi->notificationPost();
	
	$result = "VERIFICADO";
	
	$transacaoID = isset($_POST['TransacaoID']) ? $_POST['TransacaoID'] : '';
	
	$fp = fopen('../log/'.$transacaoID.'.html','a');
	
	
	fwrite($fp, date("Y-m-d G:i:s").'<br />');
	foreach($_POST as $key => $value) {
		fwrite($fp, $key . '=' . $value . '<br />');
		$pg->$key = $value;
	}
	
	if ($result == "VERIFICADO") {
		fwrite($fp,'O post foi validado pelo PagSeguro.<br />');
		
		
		$pg->DataTransacao = $f->ConverterData($pg->DataTransacao);
		
		$pd->insertPagSeguro($pg);
		
		if($pg->StatusTransacao == 'Cancelado') {
			$pd->updateStatusPedido($pg, true);
		} else {
			$pd->updateStatusPedido($pg);
		}
		
		
	} else if ($result == "FALSO") {
		fwrite($fp,'O post não foi validado pelo PagSeguro.<br />');
	} else {
		fwrite($fp,'Erro na integração com o PagSeguro.<br />');
	}
	fwrite($fp,' ================================ <br />');
	fclose($fp);
	
	
	// header( "Location: pagseguro" );
	
} else {

	unset($_COOKIE['pedido']);
	setcookie('pedido',NULL,-1);
	
	$fp = fopen('../log/post.log','a');
	fwrite($fp, date("Y-m-d G:i:s").'<br />');
	fwrite($fp, 'POST não recebido<br />');
	fwrite($fp,' ================================ <br />');
	fclose($fp);
	
	// POST não recebido, indica que a requisição é o retorno do Checkout PagSeguro.
	// No término do checkout o usuário é redirecionado para este bloco.
	
	header( "Location: concluido" );
	
} 
?>