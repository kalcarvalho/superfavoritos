<?php

class Cidade {

	private $codigo;
	private $descricao;
	private $abreviacao;
	private $ativo;
	private $texto;
	private $tags;
	private $principal;
	
	public function __construct() {
		$this->ativo = 0;
	}
	
	
	public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}	
	
	public function getDescricao() {
		return $this->descricao;
	}
	
	public function setAbreviacao($abreviacao) {
		$this->abreviacao = $abreviacao;
	}
	
	public function getAbreviacao() {
		return $this->abreviacao;
	}
	
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
	}
	
	public function getAtivo() {
		return $this->ativo;
	}
	
	public function setTexto($texto) {
		$this->texto = $texto;
	}
	
	public function getTexto() {
		return $this->texto;
	}
	
	public function setTags($tags) {
		$this->tags = $tags;
	}
	
	public function getTags() {
		return $this->tags;
	}
	
	public function setPrincipal($principal) {
		$this->principal = $principal;
	}
	
	public function getPrincipal() {
		return $this->principal;
	}
	
}
?>