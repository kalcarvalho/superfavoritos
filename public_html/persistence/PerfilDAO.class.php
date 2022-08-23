<?php

include_once '../domain/Perfil.class.php';
include_once '../domain/Modulo.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class PerfilDAO extends DAO implements IDatabaseFinder {


    public function   __construct() {

    }

    public function findByPK($pk) {
        $perfil = new Perfil();

        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT per_perfil.*
                                 FROM per_perfil
                                 WHERE per_codigo = ?");

            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->execute();

            if($rs->rowCount() > 0){

                $row = $rs->fetch(PDO::FETCH_OBJ);
                $perfil->setCodigo($row->per_codigo);
                $perfil->setDescricao($row->per_descricao);

            }

            return $perfil;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }

    public function listAcessos($pk) {
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('SELECT nac_nivelacesso.*, mod_modulo.*
                                  FROM nac_nivelacesso
                                  INNER JOIN mod_modulo ON mod_codigo = nac_modulo
                                  WHERE nac_perfil = ?');
            $rs->bindParam(1,$pk,PDO::PARAM_INT);

            $rs->execute();

            if ($rs->rowCount() > 0) {

                $list = array();

                while($row = $rs->fetch(PDO::FETCH_OBJ)){

                    $modulo = new Modulo();
                    $modulo->setCodigo($row->mod_codigo);
                    $modulo->setDescricao($row->mod_descricao);
                    $modulo->setPagina($row->mod_pagina);
                    $modulo->setInclusao($row->nac_inclusao);
                    $modulo->setAlteracao($row->nac_alteracao);
                    $modulo->setExclusao($row->nac_exclusao);
                    $modulo->setConsulta($row->nac_consulta);

                    array_push($list, $modulo);
                }

                return $list;
            }
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }

    public function listAcessosByModulo($pk, $mod) {
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('SELECT nac_nivelacesso.*, mod_modulo.*
                                  FROM nac_nivelacesso
                                  INNER JOIN mod_modulo ON mod_codigo = nac_modulo
                                  WHERE nac_perfil = ? AND nac_modulo = ?');
            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->bindParam(2,$mod,PDO::PARAM_INT);

            $rs->execute();

            if ($rs->rowCount() > 0) {

                $row = $rs->fetch(PDO::FETCH_OBJ);

                $modulo = new Modulo();
                $modulo->setCodigo($row->mod_codigo);
                $modulo->setDescricao($row->mod_descricao);
                $modulo->setPagina($row->mod_pagina);
                $modulo->setInclusao($row->nac_inclusao);
                $modulo->setAlteracao($row->nac_alteracao);
                $modulo->setExclusao($row->nac_exclusao);
                $modulo->setConsulta($row->nac_consulta);

                return $modulo;
            }
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }

    public function listAll() {

    }
}

?>
