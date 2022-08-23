<?php

include_once 'persistence.cfg.php';

class DAO {

    protected $dao = null;
    protected $con = null;
    protected $sql = null;
    protected $host = HOST_BD;
    protected $dbname = NAME_BD;
    protected $user = USER_BD;
    protected $password = PASSWORD_BD;

    protected function __construct() {
        
    }

    public function getInstance() {
        if ($this->dao == null) {
            $this->openConnection();
            $dao = $this;
        }
        return $dao;
    }

    

    public function openConnection() {

        try {

            // $this->con = new PDO(
                // 'mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf-8',
                // $this->user,
                // $this->password
            // );
			
			// $this->con = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->user,$this->password);
			$this->con = new PDO('mysql:host=host.docker.internal;dbname='.$this->dbname,$this->user,$this->password);
			$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$this->con->exec("SET NAMES utf8");
			
            if(!$this->con) throw new Exception("Não foi possível contectar-se à base de dados.");
            return $this->con;

        } catch(PDOException $e ) {

            
            echo $e->getLine() ." ". $e->getMessage(); //tratar  p/ arquivo de log
            exit();
            
        }

    }
    
    protected function closeConnection() {
        if($this->con != null) $this->con = null;
    }

    public function __destruct() {
        $this->closeConnection();
    }
}

?>
