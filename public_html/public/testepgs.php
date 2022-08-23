<?php 
	
	$post = array();
	$post['Comando'] = 'validar';
	$post['Token'] = '';
	
	$retorno=array();
    foreach ($post as $key=>$value){
      if('string'!==gettype($value)) $post[$key]='';
      $value=urlencode(stripslashes($value));
      $retorno[]="{$key}={$value}";
    }
    $retorno = implode('&', $retorno);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://pagseguro.uol.com.br/Security/NPI/Default.aspx');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $retorno);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$resp = curl_exec($ch);
	
	var_dump($resp);

?>