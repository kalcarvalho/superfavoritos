<?php ob_start();

class Funcao {

    private $comando;
    private $pagina;
    private $ordenacao;
    private $qtde;

    public function getPagina() {
        return $this->pagina;
    }

    public function setPagina($pagina) {
        $this->pagina = $pagina;
    }

    public function getOrdenacao() {
        return $this->ordenacao;
    }

    public function setOrdenacao($ordenacao) {
        $this->ordenacao = $ordenacao;
    }

    public function getQtde() {
        return $this->qtde;
    }

    public function setQtde($qtde) {
        $this->qtde = $qtde;
    }

    public function getComando() {
        if(isset($_POST["cmd"])){
            $this->comando = $_POST["cmd"];
        }elseif(isset($_GET["cmd"])){
            $this->comando = base64_decode($_GET["cmd"]);
        }else{
            $this->comando = "ERROR";
        }
        return $this->comando;
    }

    public function setComando($comando) {
        $this->comando = $comando;
    }

    public function gerarNomeArquivo($diretorio,$extensao){
        $temp = date('YmdHis').rand(1000, 9999);
        $imagem_nome = $temp.".".$extensao;
        if(file_exists($diretorio.$imagem_nome)){
            $imagem_nome = $this->gerarNomeArquivo($diretorio, $extensao);
        }
        return $imagem_nome;
    }

    public function verExtensao($nome){
        $vetor = explode(".", $nome);
        $valor = array_reverse($vetor);
        return strtolower($valor[0]);
    }

    public function upload($img,$max_x,$max_y,$nome_arquivo){

        list($width,$height) = getimagesize($img);

        if($width > $height){
            $porcentagem = (100 * $max_x) / $width;
        }else{
            $porcentagem = (100 * $max_y) / $height;
        }
        $tamanho_x = $width * ($porcentagem / 100);
        $tamanho_y = $height * ($porcentagem / 100);

        if($tamanho_x > $tamanho_y){
            $dst_x = 0;
            $dst_y = ($max_y - $tamanho_y) / 2;
        }else{
            $dst_x = ($max_x - $tamanho_x) / 2;
            $dst_y = 0;
        }


        $image_p = imagecreatefromjpeg("../produtos/fundo.jpg");
        $image = imagecreatefromjpeg($img);

        imagecopyresampled($image_p,$image,$dst_x,$dst_y,0,0,
            $tamanho_x,$tamanho_y,$width,$height);

        return imagejpeg($image_p,$nome_arquivo,85);

    }
	
	public function marcarPesquisa($filtro, $texto) {
		return str_replace($filtro, '<span class="marca-texto">'.$filtro.'</span>', $texto);
	}
	
	public function makeAlias($titulo) {
		$titulo = strtolower($titulo);
		$titulo = str_replace(' ', '-', $titulo);
		
		$titulo = preg_replace("[áàâãª]","a",$titulo);	
		$titulo = preg_replace("[éèê]","e",$titulo);	
		$titulo = preg_replace("[óòôõº]","o",$titulo);	
		$titulo = preg_replace("[úùû]","u",$titulo);	
		$titulo = preg_replace("/[^a-zA-Z0-9-]/","",$titulo);	
		$titulo = str_replace("ç","c",$titulo);
		
		return $titulo;
	}
	
	public function validURL($url) {
		return filter_var($url, FILTER_VALIDATE_URL);
	}
	
	private function antiInjection($str) {
		# Remove palavras suspeitas de injection.
		# $str = preg_replace(sql_regcase("/(\n|\r|%0a|%0d|Content-Type:|bcc:|to:|cc:|Autoreply:|from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $str);
		$str = trim($str);        # Remove espaços vazios.
		$str = strip_tags($str);  # Remove tags HTML e PHP.
		$str = addslashes($str);  # Adiciona barras invertidas à uma string.
		return $str;
	} 
	
	public function validaParametro($vetor) {
	  if (is_array($vetor)) {
		foreach ($vetor as $chave => $valor) {
		  if (is_array($valor))   {
			$vetor[$chave] = validaParametro($valor); 
		  } else $vetor[$chave] = $this->antiInjection($valor);
		} } else $vetor[$chave] = validaParametro($valor);
	  return $vetor;
	}
	
	function validaCPF($cpf) {	// Verifiva se o número digitado contém todos os digitos
		$cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
	
	// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') 	{
			return false;
		} else {   // Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}

				$d = ((10 * $d) % 11) % 10;

				if ($cpf{$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}
	
	function is_valid_date($value, $format = 'dd.mm.yyyy') { 
		if(strlen($value) >= 6 && strlen($format) == 10) { 
        
			// find separator. Remove all other characters from $format 
			$separator_only = str_replace(array('m','d','y'),'', $format); 
			$separator = $separator_only[0]; // separator is first character 
			
			if($separator && strlen($separator_only) == 2){ 
            // make regex 
				$regexp = str_replace('mm', '(0?[1-9]|1[0-2])', $format); 
				$regexp = str_replace('dd', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp); 
				$regexp = str_replace('yyyy', '(19|20)?[0-9][0-9]', $regexp); 
				$regexp = str_replace($separator, "\\" . $separator, $regexp); 
				if($regexp != $value && preg_match('/'.$regexp.'\z/', $value)){ 

					// check date 
					$arr=explode($separator,$value); 
					$day=$arr[0]; 
					$month=$arr[1]; 
					$year=$arr[2]; 
					
					if(@checkdate($month, $day, $year)) return true; 
				} 
			} 
		} 
		return false; 
	}

	function is_valid_email($email) {
	
		$conta = "^[a-zA-Z0-9\._-]+@";
		$domino = "[a-zA-Z0-9\._-]+.";
		$extensao = "([a-zA-Z]{2,4})$";

		$pattern = $conta.$domino.$extensao;

		if (ereg($pattern, $email)) {
			return true;
		} else {
			return false;
		}	
	}
	
	function formatarCPF_CNPJ($campo, $formatado = true){
		//retira formato
		$codigoLimpo = preg_replace("[' '-./ t]",'',$campo);
		// pega o tamanho da string menos os digitos verificadores
		$tamanho = (strlen($codigoLimpo) -2);
		//verifica se o tamanho do código informado é válido
		if ($tamanho != 9 && $tamanho != 12){
			return false;
		}

		if ($formatado){
			// seleciona a máscara para cpf ou cnpj
			$mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##'; 

			$indice = -1;
			for ($i=0; $i < strlen($mascara); $i++) {
				if ($mascara[$i]=='#') $mascara[$i] = $codigoLimpo[++$indice];
			}
			//retorna o campo formatado
			$retorno = $mascara;

		}else{
			//se não quer formatado, retorna o campo limpo
			$retorno = $codigoLimpo;
		}

		return $retorno;

	}
	
	function removerAcentos($palavra) {
		$palavra = preg_replace("[^a-zA-Z0-9_]", "", strtr($palavra, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC "));
		return $palavra;

	}
	
	function ConverterData($data) {
		$data = explode(' ', $data);
		$hora = $data[1]; $data = $data[0];
		$data = explode('/', $data);
		$data = $data[2].'-'.$data[1].'-'.$data[0].' ';		
		return $data.$hora;
	}

/*	
	function buscaJogador($termo) {
		$page = "http://www.zerozero.pt/search_player.php?search_string=$termo&op=all";

		$conecurl = @fopen($page,"r") or die ('<center>erro na conexão<br/><b>informe o administrador erro 15 </b></center>');

		$encontrado = true;

		while(!feof($conecurl)) {
			$cc = fgets($conecurl,4096);

			if(strpos($cc,'Nenhum jogador encontrado') > 0) {
				$encontrado = false;
				break;
			}

			$lin .= $cc;	
		}

		fclose($conecurl);


		if($encontrado) {
			return true;
		} else {
			return false;
		}
	}
	
	function buscaFoto($termo) {
		$page = "http://www.google.com.br/images?hl=pt-br&source=imghp&biw=1360&bih=653&q=$termo&gbv=2&aq=f&aqi=g10&aql=&oq=";
		
		$text = file_get_contents($page); 
		
		preg_match_all('#<img[^>]*>#i', $text, $match); 
		
		return $match[0][2]; 
	}
	*/
}

?>