<?php

class Pedido {
    
    private $codigo;
	private $oferta;
	private $cliente;
	private $parceiro;
	private $cidade;
	private $pagseguro;
    private $titulo;
    private $criacao;
	private $modificacao;
	private $credito;
	private $preco;
	private $custo;
	private $status;
	private $cupom;
	
	
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;

    }
	
	public function setCliente($cliente) {
		$this->cliente = $cliente;
	}
	
	public function getCliente() {
		return $this->cliente;
	}

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTitulo() {
        return $this->titulo;
    }

	
	public function setModificado($modificado) {
		$this->modificado = $modificado;
	}
	
	public function getModificado() {
		return $this->modificado;
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
	
	public function setParceiro($parceiro) {
		$this->parceiro = $parceiro;
	}
	
	public function getParceiro() {
		return $this->parceiro;
	}
	
	public function setPagSeguro($pagseguro) {
		$this->pagseguro = $pagseguro;
	}
	
	public function getPagSeguro() {
		return $this->pagseguro;
	}
	
	public function setQuantidade($quantidade) {
		$this->quantidade = $quantidade;
	}
	
	public function getQuantidade() {
		return $this->quantidade;
	}
	
	public function setValor($valor) {
		$this->valor = $valor;
	}
	
	public function getValor() {
		return $this->valor;
	}
	
	public function setStatus($status) {
		$this->status = $status;
	}
	
	public function getStatus() {
		return $this->status;
	}
	
	public function setOferta($oferta) {
		$this->oferta = $oferta;
	}
	
	public function getOferta() {
		return $this->oferta;
	}
	
	public function setCupom($cupom) {
		$this->cupom = $cupom;
	}
	
	public function getCupom() {
		return $this->cupom;
	}
	
}
?>