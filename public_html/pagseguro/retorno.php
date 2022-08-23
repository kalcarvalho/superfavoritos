<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Retorno PagSeguro UOL by JS Tecnologia</title>
  <LINK REL="SHORTCUT ICON" HREF="http://www.jstecnologia.com.br/ico_js.ico">

  <style type="text/css">
    <!--
    body,
    td,
    th {
      font-family: Verdana, Arial, Helvetica, sans-serif;
      font-size: 10px;
      color: #333333;
    }

    body {
      background-color: #FFFFFF;
      margin-left: 0px;
      margin-top: 0px;
      margin-right: 0px;
      margin-bottom: 0px;
      background-image: url();
    }
    -->
  </style>
</head>

<body>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="430">
        <table width="500" border="0" align="center" cellpadding="10" cellspacing="0">
          <tr>
            <td width="50%">
              <div align="center"><a href="http://www.jstecnologia.com.br" target="_blank"><img src="http://www.jstecnologia.com.br/logo.jpg" width="200" height="48" border="0" /></a></div>
            </td>
            <td width="50%">
              <div align="center"><a href="http://www.bibliananet.com.br" target="_blank"><img src="http://www.bibliananet.com.br/logo.jpg" width="160" height="72" border="0" /></a></div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div align="center">Clique no logo acima e acesse nossos sites.<br />
                <br />
                <strong><strong>
                    <?php


                    // RECEBE O POST ENVIADO PELA PagSeguro E ADICIONA OS VALORES PARA VALIDACAO DOS DADOS
                    $PagSeguro = 'Comando=validar';
                    $PagSeguro .= '&Token=APP_TOKEN' ; // Insira aqui o c&oacute;digo do Token gerado no PagSeguro
                    $Cabecalho = ""; // Coloque um t&iacute;tulo

                    foreach ($_POST as $key => $value) {
                      $value = urlencode(stripslashes($value));
                      $PagSeguro .= "&$key=$value";
                    }

                    if (function_exists('curl_exec')) {
                      //Prefira utilizar a funcao CURL do PHP
                      //Leia mais sobre CURL em: http://us3.php.net/curl
                      $curl = true;
                    } elseif ((PHP_VERSION >= 4.3) && ($fp = @fsockopen('ssl://pagseguro.uol.com.br', 443, $errno, $errstr, 30))) {
                      $fsocket = true;
                    } elseif ($fp = @fsockopen('pagseguro.uol.com.br', 80, $errno, $errstr, 30)) {
                      $fsocket = true;
                    }

                    // ENVIA DE VOLTA PARA A PagSeguro OS DADOS PARA VALIDA&Ccedil;&Atilde;O
                    if ($curl == true) {
                      $ch = curl_init();

                      curl_setopt($ch, CURLOPT_URL, 'https://pagseguro.uol.com.br/Security/NPI/Default.aspx');
                      curl_setopt($ch, CURLOPT_POST, true);
                      curl_setopt($ch, CURLOPT_POSTFIELDS, $PagSeguro);
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                      curl_setopt($ch, CURLOPT_HEADER, false);
                      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                      curl_setopt($ch, CURLOPT_URL, 'https://pagseguro.uol.com.br/Security/NPI/Default.aspx');
                      $resp = curl_exec($ch);

                      curl_close($ch);
                      $confirma = (strcmp($resp, "VERIFICADO") == 0);
                    } elseif ($fsocket == true) {
                      $Cabecalho  = "POST /Security/NPI/Default.aspx HTTP/1.0\r\n";
                      $Cabecalho .= "Content-Type: application/x-www-form-urlencoded\r\n";
                      $Cabecalho .= "Content-Length: " . strlen($PagSeguro) . "\r\n\r\n";

                      if ($fp || $errno > 0) {
                        fputs($fp, $Cabecalho . $PagSeguro);
                        $confirma = false;
                        $resp = '';
                        while (!feof($fp)) {
                          $res = @fgets($fp, 1024);
                          $resp .= $res;
                          // Verifica se o status da transa&ccedil;&atilde;o est&aacute; VERIFICADO
                          if (strcmp($res, "VERIFICADO") == 0) {
                            $confirma = true;
                            break;
                          }
                        }
                        fclose($fp);
                      } else {
                        echo "$errstr ($errno)<br />\n";
                        // ERRO HTTP
                      }
                    }

                    var_dump($confirma);
                    var_dump($Cabecalho);
                    var_dump($PagSeguro);




                    if ($confirma) {
                      // RECEBE OS DADOS ENVIADOS PELA PagSeguro E ARMAZENA EM VARIAVEIS
                      //Selecione aqui todos os parametros enviados pela PagSeguro
                      $VendedorEmail  = $_POST['VendedorEmail'];
                      $TransacaoID = $_POST['TransacaoID'];
                      $Referencia = $_POST['Referencia'];
                      $TipoFrete = $_POST['TipoFrete'];
                      $ValorFrete = $_POST['ValorFrete'];
                      $Anotacao = $_POST['Anotacao'];
                      $DataTransacao = $_POST['DataTransacao'];
                      $TipoPagamento = $_POST['TipoPagamento'];
                      $StatusTransacao = $_POST['StatusTransacao'];
                      $CliNome = $_POST['CliNome'];
                      $CliEmail = $_POST['CliEmail'];
                      $CliEndereco = $_POST['CliEndereco'];
                      $CliNumero = $_POST['CliNumero'];
                      $CliComplemento = $_POST['CliComplemento'];
                      $CliBairro = $_POST['CliBairro'];
                      $CliCidade = $_POST['CliCidade'];
                      $CliEstado = $_POST['CliEstado'];
                      $CliCEP = $_POST['CliCEP'];
                      $CliTelefone = $_POST['CliTelefone'];

                      $NumItens = $_POST['NumItens'];

                      $ProdID = $_POST['ProdID_1'];
                      $ProdDescricao = $_POST['ProdDescricao_1'];
                      $ProdValor = $_POST['ProdValor_1'];
                      $ProdQuantidade = $_POST['ProdQuantidade_1'];
                      $ProdFrete = $_POST['ProdFrete_1'];
                      $ProdExtras = $_POST['ProdExtras_1'];


                      // Verifique se a TransacaoID n&atilde;o foi previamente processada
                      // Verifique se o email recebido (VendedorEmail) &eacute; o seu email
                      // Verifique se o valor do pagamento est&aacute; correto
                      // Processe o pagamento salvando os dados em seu banco de dados
                      echo '<input type="hidden" name="vjs" value="PagSeguro by JS Tecnologia" />';

                      //	Pegando o IP do usu&aacute;rio
                      $ip = $_SERVER['REMOTE_ADDR']; // pegando o endere&ccedil;o remoto 
                      $forward = $_SERVER['HTTP_X_FORWARDED_FOR'];  // pegando o endere&ccedil;o que foi repassado (se houver) 
                      $ip = ((($ip == 'unknown' || $ip == '201.6.24.158') && (isset($foward) && $forward != 'unknown')) ? $forward : $ip);

                      $datahora = date("Y-m-d H:i:s");
                      $data = date("Y-m-d");
                      $hora = date("H:i:s");

                      echo "INSERT into PagSeguroTransacoes (TransacaoID, VendedorEmail, TipoFrete, ValorFrete, Anotacao, TipoPagamento, Referencia, StatusTransacao, CliNome, CliEmail, CliEndereco, CliNumero, CliComplemento, CliBairro, CliCidade, CliEstado, CliCEP, CliTelefone, NumItens, ProdID, ProdDescricao, ProdValor, ProdQuantidade, ProdFrete, ProdExtras, ip, datahora, data, hora) VALUES ('$TransacaoID','$VendedorEmail','$TipoFrete','$ValorFrete','$Anotacao','$TipoPagamento','$Referencia','$StatusTransacao','$CliNome','$CliEmail','$CliEndereco','$CliNumero','$CliComplemento','$CliBairro','$CliCidade','$CliEstado','$CliCEP','$CliTelefone','$NumItens','$ProdID','$ProdDescricao','$ProdValor','$ProdQuantidade','$ProdFrete','$ProdExtras','$ip','$datahora','$data','$hora')";
                    } else {
                      if (strcmp($res, "FALSO") == 0) {
                        echo "FALSO";
                      }
                    }
                    ?>
                  </strong></strong><br />
              </div>
              <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">
                <tr>
                  <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10">
                      <tr>
                        <td bgcolor="#f4f4f4">
                          <div align="center"><strong>Seu pagamento foi conclu&iacute;do com sucesso!</strong></div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>