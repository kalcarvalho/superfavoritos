<?php

header('Content-Type: text/html; charset=ISO-8859-1');

define('PAGSEGURO_TOKEN', '');

class PagSeguroNpi {

	private $timeout = 20; // Timeout em segundos

	public function notificationPost() {
		$postdata = 'Comando=validar&PAGSEGURO_TOKEN=' . PAGSEGURO_TOKEN;
		foreach ($_POST as $key => $value) {
			$valued    = $this->clearStr($value);
			$postdata .= "&$key=$valued";
		}
		return $this->verify($postdata);
	}

	private function clearStr($str) {
		if (!get_magic_quotes_gpc()) {
			$str = addslashes($str);
		}
		return $str;
	}

	private function verify($data) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://pagseguro.uol.com.br/pagseguro-ws/checkout/NPI.jhtml");
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$result = trim(curl_exec($curl));
		curl_close($curl);
		return $result;
	}
}

if (count($_POST) > 0) {

	// POST recebido, indica que é a requisição do NPI.
	$npi = new PagSeguroNpi();
	$result = $npi->notificationPost();

	$transacaoID = isset($_POST['TransacaoID']) ? $_POST['TransacaoID'] : '';

	$fp = fopen('../log/' . $transacaoID . '.log', 'a');

	fwrite($fp, date("Y-m-d G:i:s") . '\r\n');

	foreach ($_POST as $key => $value) {
		fwrite($fp, $key . '=' . $value . '\r\n');
	}

	if ($result == "VERIFICADO") {
		fwrite($fp, 'O post foi validado pelo PagSeguro.\r\n');
	} else if ($result == "FALSO") {
		fwrite($fp, 'O post não foi validado pelo PagSeguro.\r\n');
	} else {
		fwrite($fp, 'Erro na integração com o PagSeguro.\r\n');
	}
	fwrite($fp, ' ================================ \r\n');
	fclose($fp);
} else {

	fwrite($fp, date("Y-m-d G:i:s") . '\r\n');
	fwrite($fp, 'POST não recebido\r\n');
	fwrite($fp, ' ================================ \r\n');
	fclose($fp);

	// POST não recebido, indica que a requisição é o retorno do Checkout PagSeguro.
	// No término do checkout o usuário é redirecionado para este bloco.
?>
	<h3>Obrigado por efetuar a compra.</h3>

<?php } ?>