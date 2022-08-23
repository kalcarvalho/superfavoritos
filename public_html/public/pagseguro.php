<div class="content">
	<div class="painel-cliente">
		<h3>Testador do retorno do Pagseguro</h3>
		<form id="form-cadastro" method="post" action="retorno">
			<input type="hidden" name="VendedorEmail" value="kalcarvalho@gmail.com" />
			<input type="hidden" name="Extras" value="0,00" />
			<input type="hidden" name="TipoFrete" value="FR" />
			<input type="hidden" name="ValorFrete" value="0,00" />
			<input type="hidden" name="Anotacao" value="" />
			<input type="hidden" name="TransacaoID" value="94A1F49D98A3430BADC010D18012B154" />
			<input type="hidden" name="DataTransacao" value="30/04/2011 19:56:00" />
			<input type="hidden" name="TipoPagamento" value="Boleto" />
			<input type="hidden" name="StatusTransacao" value="Completo" />
			<input type="hidden" name="CliNome" value="Kal Carvalho" />
			<input type="hidden" name="CliEndereco" value="RUA CAPITAO DALVO RABELLO SAMPAIO" />
			<input type="hidden" name="CliNumero" value="5" />
			<input type="hidden" name="CliComplemento" value="APTO 501" />
			<input type="hidden" name="CliBairro" value="Fonseca" />
			<input type="hidden" name="CliCidade" value="Niteroi" />
			<input type="hidden" name="CliEstado" value="RJ" />
			<input type="hidden" name="CliCEP" value="24130100" />
			<input type="hidden" name="CliTelefone" value="21 99117600" />
			<input type="hidden" name="NumItens" value="1" />
			<input type="hidden" name="Parcelas" value="1" />
			<input type="hidden" name="ProdID_1" value="1395" />
			<input type="hidden" name="ProdDescricao_1" value="60 de desconto em passeio pelo Centro Histórico do Rio de Janeiro, por um preço maravilhoso" />
			<input type="hidden" name="ProdValor_1" value="19,90" />
			<input type="hidden" name="ProdQuantidade_1" value="1" />
			<input type="hidden" name="ProdFrete_1" value="0,00" />
			<input type="hidden" name="ProdExtras_1" value="0,00" />
			<p>
				<label>Referência</label>
				<input type="text" name="Referencia" value="" />
			</p>
			<p>
				<label>E-mail</label>
				<input type="text" id="email" name="CliEmail" value="<?php echo $_COOKIE['email']; ?>" class="pc-mail" />
			</p>

			<p>
				<label>&nbsp;</label>
				<input type="submit" name="submit" value="Cadastrar" class="pc-submit" />
				<input type="hidden" name="retorno" value="pagseguro" />
			</p>
		</form>
	</div>
</div>