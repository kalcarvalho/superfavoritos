<?php

include_once '../domain/Cidade.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class CidadeDAO extends DAO implements IDatabaseFinder {

    public function   __construct() {
    }
	
    public function findByPK($pk) {
		$cidade = new Cidade();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT cid_cidade.*
                                 FROM cid_cidade
                                 WHERE cid_codigo = ? ");
            
            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->execute();
			
            
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
				$cidade->setCodigo($row->cid_codigo);
				$cidade->setDescricao($row->cid_descricao);
				$cidade->setAbreviacao($row->cid_abreviacao);
				$cidade->setAtivo($row->cid_ativo);
				$cidade->setPrincipal($row->cid_principal);
				$cidade->setTags($row->cid_tags);
            }
			
			
			
            return $cidade;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
	
    }
	
	public function findByTag($tag) {
		$cidade = new Cidade();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT cid_cidade.*
                                 FROM cid_cidade
                                 WHERE cid_tags = ? ");
            
            $rs->bindParam(1,$tag,PDO::PARAM_STR);
            $rs->execute();
			
            
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
				$cidade->setCodigo($row->cid_codigo);
				$cidade->setDescricao($row->cid_descricao);
				$cidade->setAbreviacao($row->cid_abreviacao);
				$cidade->setAtivo($row->cid_ativo);
				$cidade->setPrincipal($row->cid_principal);
				$cidade->setTags($row->cid_tags);
            }
			
			
			
            return $cidade;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
	
    }
	
    
	public function listAll($sort=true) {
        try {

            $stmt = $this->openConnection();
			if($sort) {
				$rs = $stmt->prepare('SELECT cid_cidade.*
									  FROM cid_cidade
									  WHERE cid_ativo = 1
									  ORDER BY cid_ordem DESC, cid_descricao');
			} else {
				$rs = $stmt->prepare('SELECT cid_cidade.*
									  FROM cid_cidade
									  WHERE cid_ativo = 1
									  ORDER BY cid_descricao');
			}

            $rs->execute();
            
            if ($rs->rowCount() > 0) {

                $list = array();

                while($row = $rs->fetch(PDO::FETCH_OBJ)){

                    $cidade = new Cidade();
					$cidade->setCodigo($row->cid_codigo);
					$cidade->setDescricao($row->cid_descricao);
					$cidade->setAbreviacao($row->cid_abreviacao);
					$cidade->setAtivo($row->cid_ativo);
					$cidade->setPrincipal($row->cid_principal);
					$cidade->setTags($row->cid_tags);


                    array_push($list, $cidade);
                }

                return $list;
            }
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }
	
	public function insertUserNewsletter($email, $city) {
	
		try{

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('INSERT INTO new_newsletter(new_email, new_cidade) 
									VALUES(?,?)');

            $stmt->beginTransaction();

            $rs->bindParam(1,$email, PDO::PARAM_STR);
			$rs->bindParam(2,$city, PDO::PARAM_INT);

            $rs->execute();
			
            if($rs->rowCount() > 0){
			
                $stmt->commit();
                return true;
            }else{
                $stmt->rollBack();
                return false;
            }

        }catch(Exception $e){
            echo $e->getMessage();
            exit();
        }	
	
	}


}
