<?php

class UserProfile {

    private $codigo;
    private $nome;
	private $sobrenome;
	private $cpf;
	private $endereco;
    protected $senha;
    private $email;
    private $registro;
	private $sexo;
	private $ativo;
	private $ativacao;
	private $cidade;
	private $cep;
	private $telefone;
	private $celular;

	public function __construct() {
		$this->ativo = 0;
	}

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }
	
	public function setSobrenome($sobrenome) {
		$this->sobrenome = $sobrenome;
	}
	
	public function getSobrenome() {
		return $this->sobrenome;
	}

    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
    public function getSenha() {
        return $this->senha;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setRegistro($registro) {
        $this->registro = $registro;
    }

    public function getRegistro() {
        return $this->registro;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function isAtivo() {
        return $this->ativo;
    }

	public function setSexo($sexo) {
		$this->sexo = $sexo;
	}
	
	public function getSexo() {
		return $this->sexo;
	}
	
	public function setAtivacao($ativacao) {
		$this->ativacao = $ativacao;
	}
	
	public function getAtivacao() {
		return $this->ativacao;
	}
	
	public function setCidade($cidade) {
		$this->cidade = $cidade;
	}
	
	public function getCidade() {
		return $this->cidade;
	}
	
	public function setCEP($cep) {
		$this->cep = $cep;
	}
	
	public function getCEP() {
		return $this->cep;
	}
	
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}
	
	public function getEndereco() {
		return $this->endereco;
	}
	
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	
	public function getTelefone() {
		return $this->telefone;
	}
	
	public function setCelular($celular) {
		$this->celular = $celular;
	}
	
	public function getCelular() {
		return $this->celular;
	}
	
}