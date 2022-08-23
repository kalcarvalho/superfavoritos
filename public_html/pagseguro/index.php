<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>PagSeguro UOL by JS Tecnologia</title>
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
              </div>
              <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">
                <tr>
                  <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="10">
                      <tr>
                        <td bgcolor="#f4f4f4">
                          <div align="center"><strong>Para realizar o seu pagamento atualize os campos ocultos.<br />
                            </strong></div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#f4f4f4">
                          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td height="25">
                                <div align="justify">
                                  <form id="form1" name="form1" method="post" action="https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx">
                                    <div align="center"><span class="titulo1">
                                        <input type="hidden" name="email_cobranca" value="pagamento@superfavoritos.com.br" />
                                        <input type="hidden" name="cliente_nome" value="Kal Carvalho" />
                                      </span><span class="titulo1">
                                        <input type="hidden" name="cliente_end" value="Rua Cap. Dalvo R. Sampaio" />
                                        <input type="hidden" name="cliente_num" value="5" />
                                      </span><span class="titulo1">
                                        <input type="hidden" name="cliente_compl" value="Apto 501" />
                                      </span><span class="titulo1">
                                        <input type="hidden" name="cliente_cidade" value="Cidade" />
                                      </span><span class="titulo1">
                                        <input type="hidden" name="cliente_bairro" value="Bairro" />
                                      </span><span class="titulo1">
                                        <input type="hidden" name="cliente_cep" value="24130100" />
                                      </span><span class="titulo1">
                                        <input type="hidden" name="cliente_uf" value="RJ" />
                                      </span><span class="titulo1">
                                        <input type="hidden" name="cliente_ddd" value="21" />
                                        <input type="hidden" name="cliente_tel" value="99117600" />
                                      </span><span class="titulo1">
                                        <input type="hidden" name="cliente_email" value="kalcarvalho.br@gmail.com" />
                                      </span>
                                      <input name="item_id_1" type="hidden" id="item_id_1" value="777" />
                                      <input name="item_descr_1" type="hidden" id="item_descr_1" value="Descricao do Produto" />
                                      <input name="item_quant_1" type="hidden" id="item_quant_1" value="1" />
                                      <input name="item_valor_1" type="hidden" id="item_valor_1" value="10.00" />
                                      <input name="item_frete_1" type="hidden" id="item_frete_1" value="0" />
                                      <input name="item_peso_1" type="hidden" id="item_peso_1" value="0" />
                                      <input name="ref_transacao" type="hidden" id="ref_transacao" value="233" />
                                      <span class="titulo1">
                                        <input type="hidden" name="tipo_frete" value="EN" />
                                        <input type="hidden" name="cliente_pais" value="BRA" />
                                        <input type="hidden" name="tipo" value="CP" />
                                        <input type="hidden" name="moeda" value="BRL" />
                                      </span>
                                    </div>
                                    <div align="center">
                                      <input name="button" type="submit" class="estiloCampoTexto" id="button" value="Realizar o Pagamento" />
                                    </div>
                                  </form>
                                </div>
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
      </td>
    </tr>
  </table>
</body>

</html>