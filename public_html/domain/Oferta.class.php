<?php

class Oferta {
    
    private $codigo;
    private $titulo;
    private $alias;
	private $destaques;
    private $regras;
    private $intro;
    private $texto;
    private $autor;
    private $cidade;
    private $fonte;
    private $publicar;
    private $criacao;
    private $modificado;
	private $termino;
    private $home;
    private $acessos;
	private $editavel;
	private $foto;
	private $thumb;
	private $idioma;
	private $tags;
	private $destaque;
	private $credito;
	private $preco;
	private $custo;
	private $parceiro;
	private $vendas;
	private $minimo;
	private $maximo;
	
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setDestaques($destaques) {
        $this->destaques = $destaques;
    }

    public function getDestaques() {
        return $this->destaques;
    }

    public function setRegras($regras) {
        $this->regras = $regras;
    }

    public function getRegras() {
        return $this->regras;
    }
	
	public function setAlias($alias) {
		$this->alias = $alias;
	}
	
	public function getAlias() {
		return $this->alias;
	}
	
	public function setIntro($intro) {
		$this->intro = $intro;
	}
	
	public function getIntro() {
		return $this->intro;
	}
	
	public function setHome($home) {
		$this->home = $home;
	}
	
	public function getHome() {
		return $this->home;
	}
	
	public function setAcessos($acessos) {
		$this->acessos = $acessos;
	}
	
	public function getAcessos() {
		return $this->acessos;
	}

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setFonte($fonte) {
        $this->fonte = $fonte;
    }

    public function getFonte() {
        return $this->fonte;
    }

    public function setPublicar($publicar) {
        $this->publicar = $publicar;
    }

    public function getPublicar() {
        return $this->publicar;
    }
	
	public function setEditavel($editavel) {
		$this->editavel = $editavel;
	}
	
	public function getEditavel() {
		return $this->editavel;
	}

	public function setFoto($foto) {
		$this->foto = $foto;
	}
	
	public function getFoto() {
		return $this->foto;
	}
	
	public function setThumb($thumb) {
		$this->thumb = $thumb;
	}
	
	public function getThumb() {
		return $this->thumb;
	}
	
	public function setIdioma($idioma) {
		$this->idioma = $idioma;
	}
	
	public function getIdioma() {
		return $this->idioma;
	}
	
	public function setTags($tags) {
		$this->tags = $tags;
	}
	
	public function getTags() {
		return $this->tags;
	}
	
	public function setDestaque($destaque) {
		$this->destaque = $destaque;
	}
	
	public function getDestaque() {
		return $this->destaque;
	}
	
	public function setModificado($modificado) {
		$this->modificado = $modificado;
	}
	
	public function getModificado() {
		return $this->modificado;
	}
	
	public function setCredito($credito) {
		$this->credito = $credito;
	}
	
	public function getCredito() {
		return $this->credito;
	}
	
	public function setPreco($preco) {
		$this->preco = $preco;
	}
	
	public function getPreco() {
		return $this->preco;
	}
	
	public function setCusto($custo) {
		$this->custo = $custo;
	}
	
	public function getCusto() {
		return $this->custo;
	}
	
	public function setTermino($termino)  {
		$this->termino = $termino;
	}
	
	public function getTermino() {
		return $this->termino;
	}
	
	public function setParceiro($parceiro) {
		$this->parceiro = $parceiro;
	}
	
	public function getParceiro() {
		return $this->parceiro;
	}
	
	public function setVendas($vendas) {
		$this->vendas = $vendas;
	}
	
	public function getVendas() {
		return $this->vendas;
	}
	
	public function setMinimo($minimo) {
		$this->minimo = $minimo;
	}
	
	public function getMinimo() {
		return $this->minimo;
	}
	
	public function setMaximo($maximo) {
		$this->maximo = $maximo;
	}	
	
	public function getMaximo() {
		return $this->maximo;
	}
}

?>
