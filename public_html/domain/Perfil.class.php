<?php

class Perfil {

    private $codigo;
    private $descricao;
    private $acessos;

   function __construct() {

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
    
    public function setAcessos($acessos) {
        $this->acessos = $acessos;
    }

    public function getAcessos() {
        return $this->acessos;
    }

    
}

?>
