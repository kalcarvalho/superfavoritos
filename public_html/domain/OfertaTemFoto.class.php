<?php 

class OfertaTemFoto {

	private $codigo;
	private $oferta;
	private $foto;
	
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
	}
	
	public function getCodigo() {
		return $this->codigo;
	}
	
	public function setOferta($oferta) {
		$this->oferta = $oferta;
	}
	
	public function setFoto($foto) {
		$this->foto = $foto;
	}
	
	public function getFoto() {
		return $this->foto;
	}

}


?>