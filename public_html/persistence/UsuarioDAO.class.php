<?php

include_once '../domain/Usuario.class.php';
include_once '../domain/UserProfile.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class UsuarioDAO extends DAO implements IDatabaseFinder {

    public function   __construct() {

    }

    public function findByPK($pk) {

    }

    public function findByLogin($login) {
        $usuario = new Usuario();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT usu_usuario.*
                                 FROM usu_usuario
                                 WHERE usu_login = ?");
            
            $rs->bindParam(1,$login,PDO::PARAM_STR);
            $rs->execute();
            
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
                $usuario->setCodigo($row->usu_codigo);
                $usuario->setLogin($row->usu_login);
                $usuario->setNome($row->usu_nome);
                $usuario->setBloqueado($row->usu_bloqueado);
                $usuario->setEmail($row->usu_email);
                $usuario->setMatricula($row->usu_matricula);
                $usuario->setSenha($row->usu_senha);
                $usuario->setPerfil($row->usu_perfil);

            }

            return $usuario;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }

    }
	
	public function findByLoginProfile($login) {
        $user = new UserProfile();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT usp_userprofile.*
                                 FROM usp_userprofile
                                 WHERE usp_email = ? AND usp_ativo = 1 ");
            
            $rs->bindParam(1,$login,PDO::PARAM_STR);
            $rs->execute();
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
                $user->setCodigo($row->usp_codigo);
                $user->setSobrenome($row->usp_sobrenome);
                $user->setNome($row->usp_nome);
                $user->setAtivo($row->usp_ativo);
                $user->setEmail($row->usp_email);
                $user->setSenha($row->usp_senha);
				$user->setSexo($row->usp_sexo);
				$user->setCidade($row->usp_cidade);
				$user->setEndereco($row->usp_endereco);
				$user->setTelefone($row->usp_telefone);
				$user->setCelular($row->usp_celular);
				$user->setCEP($row->usp_cep);
				

            }

            return $user;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }

    }
	
	public function findProfileByPK($pk) {
        $user = new UserProfile();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT usp_userprofile.*
                                 FROM usp_userprofile
                                 WHERE usp_codigo = ? ");
            
            $rs->bindParam(1,$pk,PDO::PARAM_STR);
            $rs->execute();
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
				
                $user->setCodigo($row->usp_codigo);
                $user->setNome($row->usp_nome);
				$user->setSobrenome($row->usp_sobrenome);
                $user->setCPF($row->usp_cpf);
				$user->setLocalizacao($row->usp_localizacao);
                $user->setAtivo($row->usp_ativo);
                $user->setEmail($row->usp_email);
				$user->setGata($row->usp_gata);
				$user->setVideo($row->usp_video);
				$user->setChute($row->usp_chute);
				$user->setNascimento($row->usp_nascimento);
				$user->setClube($row->usp_clube);
				$user->setSexo($row->usp_sexo);
				$user->setSenha($row->usp_senha);
				$user->setFoto1($row->usp_foto1);

            }

            return $user;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }

    }
	
	public function updateProfilePassword($pk, $pwd) {
		try{
		
            $stmt = $this->openConnection();
			
			$rs = $stmt->prepare("UPDATE usp_userprofile SET usp_senha = ? WHERE usp_codigo = ? ");
			
            $stmt->beginTransaction();
			
			$rs->bindParam(1,$pwd, PDO::PARAM_STR);
			$rs->bindParam(2,$pk, PDO::PARAM_INT);

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
	

    public function listAll() {
        
    }
	
	public function isUserRegistered($cpf, $email) {
		$usuario = new Usuario();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT usp_userprofile.*
                                 FROM usp_userprofile
                                 WHERE usp_cpf = ? OR usp_email = ? ");
            
            $rs->bindParam(1,$cpf,PDO::PARAM_STR);
			$rs->bindParam(2,$email,PDO::PARAM_STR);
            $rs->execute();
            
            if($rs->rowCount() > 0){
				return true;
            } else {
				return false;
			}

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }

    }
	
	public function insertUserProfile($user) {
		try{
		
            $stmt = $this->openConnection();
            $rs = $stmt->prepare('INSERT INTO usp_userprofile 
									(usp_nome, usp_sobrenome, usp_email, usp_senha, 
									usp_sexo, usp_ativacao, usp_ativo, usp_cidade ) 
									VALUES ( ? ,  ? ,  ? ,  ? ,  ? ,  ? ,  ? ,  ? )');
			
            $stmt->beginTransaction();
			
			$rs->bindParam(1,$user->getNome(), PDO::PARAM_STR);
			$rs->bindParam(2,$user->getSobrenome(), PDO::PARAM_STR);
			$rs->bindParam(3,$user->getEmail(), PDO::PARAM_STR);
			$rs->bindParam(4,$user->getSenha(), PDO::PARAM_STR);
			$rs->bindParam(5,$user->getSexo(), PDO::PARAM_INT);
			$rs->bindParam(6,$user->getAtivacao(), PDO::PARAM_STR);
			$rs->bindParam(7,$user->isAtivo(), PDO::PARAM_INT);
			$rs->bindParam(8,$user->getCidade(), PDO::PARAM_INT);
			
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
	
	public function updateUserProfile($user) {
		try{
		
            $stmt = $this->openConnection();
            $rs = $stmt->prepare('UPDATE usp_userprofile SET 
									usp_nome = ?, usp_sobrenome = ?, usp_cidade = ?, usp_sexo = ?, 
									usp_cep = ?, usp_endereco = ?, usp_telefone = ?, usp_celular = ?
									WHERE usp_codigo = ?');
			
            $stmt->beginTransaction();
			
			$rs->bindParam(1,$user->getNome(), PDO::PARAM_STR);
			$rs->bindParam(2,$user->getSobrenome(), PDO::PARAM_STR);
			$rs->bindParam(3,$user->getCidade(), PDO::PARAM_INT);
			$rs->bindParam(4,$user->getSexo(), PDO::PARAM_INT);
			$rs->bindParam(5,$user->getCEP(), PDO::PARAM_STR);
			$rs->bindParam(6,$user->getEndereco(), PDO::PARAM_STR);
			$rs->bindParam(7,$user->getTelefone(), PDO::PARAM_STR);
			$rs->bindParam(8,$user->getCelular(), PDO::PARAM_STR);
			$rs->bindParam(9,$user->getCodigo(), PDO::PARAM_INT);
			
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
	
	public function validaUserProfile($hash) {
		try{
		
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("UPDATE usp_userprofile SET usp_ativo = 1, usp_ativacao = NULL WHERE usp_ativacao = ? AND usp_ativo = 0 ");
			
            $stmt->beginTransaction();
			
			$rs->bindParam(1,$hash, PDO::PARAM_STR);

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

?>
