<?php 

class Parceiro {
	
	private $codigo;
	private $nomerazao;
	private $fantasia;
	private $endereco;
	private $cidade;
	private $cep;
	private $gmaps;
	private $mapa;
	private $site;
	
	
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
	}
	
	public function getCodigo() {
		return $this->codigo;
	}
	
	public function setNomeRazao($nomerazao) {
		$this->nomerazao = $nomerazao;
	}
	
	public function getNomeRazao() {
		return $this->nomerazao;
	}
	
	public function setFantasia($fantasia)  {
		$this->fantasia = $fantasia;
	}
	public function getFantasia() {
		return $this->fantasia;
	}
	
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}
	
	public function getEndereco() {
		return $this->endereco;
	}
	
	public function setBairro($bairro) {
		$this->bairro = $bairro;
	}
	
	public function getBairro() {
		return $this->bairro;
	}
	
	public function setCep($cep) {
		$this->cep = $cep;
	}
	
	public function getCep() {
		return $this->cep;
	}	
	
	public function setCidade($cidade) {
		$this->cidade = $cidade;
	}
	
	public function getCidade() {
		return $this->cidade;
	}
	
	public function setGmaps($gmaps) {
		$this->gmaps = $gmaps;
	}
	
	public function getGmaps() {
		return $this->gmaps;
	}
	
	public function setMapa($mapa) {
		$this->mapa = $mapa;
	}	
	
	public function getMapa() {
		return $this->mapa;
	}
	
	public function setSite($site) {
		$this->site = $site;
	}
	
	public function getSite() {
		return $this->site;
	}
	
}

?>