<?php

class Modulo {
    private $codigo;
    private $descricao;
    private $pagina;
    private $consulta;
    private $inclusao;
    private $alteracao;
    private $exclusao;


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

    public function setPagina($pagina) {
        $this->pagina = $pagina;
    }

    public function getPagina() {
        return $this->pagina;
    }

    public function setConsulta($consulta) {
        $this->consulta = $consulta;
    }

    public function getConsulta() {
        return $this->consulta;
    }

    public function setInclusao($inclusao) {
        $this->inclusao = $inclusao;
    }

    public function getInclusao() {
        return $this->inclusao;
    }

    public function setAlteracao($alteracao) {
        $this->alteracao = $alteracao;
    }

    public function getAlteracao() {
        return $this->alteracao;
    }

    public function setExclusao($exclusao) {
        $this->exclusao = $exclusao;
    }

    public function getExclusao() {
        return $this->exclusao;
    }
}

?>
