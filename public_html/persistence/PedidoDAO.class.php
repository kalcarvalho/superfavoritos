<?php

include_once '../domain/Pedido.class.php';
include_once '../domain/Parceiro.class.php';
include_once '../domain/PagSeguro.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class PedidoDAO extends DAO implements IDatabaseFinder {

	private $codigo;
	private $pagseguro;
	
	public function   __construct() {
	
	}
	
	public function findByPK($pk) {
		$pedido = new Pedido();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT ped_pedido.*
                                 FROM ped_pedido
                                 WHERE ped_codigo = ?");
            
            $rs->bindParam(1,$pk,PDO::PARAM_STR);
            $rs->execute();
            var_dump($rs->rowCount());
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
                $pedido->setCodigo($row->ped_codigo);
                $pedido->setTitulo($row->ped_titulo);
                $pedido->setDestaques($row->ped_destaques);
                $pedido->setAlias($row->ped_alias);
                $pedido->setRegras($row->ped_regras);
                $pedido->setIntro($row->ped_intro);
                $pedido->setTexto($row->ped_texto);
                $pedido->setAutor($row->ped_autor);
				$pedido->setCidade($row->ped_cidade);
				$pedido->setFonte($row->ped_fonte);
				$pedido->setPublicar($row->ped_publicar);
				$pedido->setHome($row->ped_home);
				$pedido->setAcessos($row->ped_acessos);
				$pedido->setParceiro($row->ped_parceiro);
				$pedido->setFoto($row->ped_foto);
				$pedido->setPreco($row->ped_preco);
				$pedido->setCusto($row->ped_custo);
				$pedido->setTermino($row->ped_termino);
				$pedido->setVendas($row->ped_vendas);
				$pedido->setCupom($row->ped_cupom);
				
            }

            return $pedido;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
	}
	
	public function findByOferta($pk) {

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT ped_pedido.*
                                 FROM ped_pedido
                                 WHERE ped_oferta = ?");
            
            $rs->bindParam(1,$pk,PDO::PARAM_STR);
            $rs->execute();

            if($rs->rowCount() > 0){
               
				$row = $rs->fetch(PDO::FETCH_OBJ);
				$pedido = new Pedido();
				$pedido->setCodigo($row->ped_codigo);
				$pedido->setOferta($row->ped_oferta);
				$pedido->setQuantidade($row->ped_quantidade);
				$pedido->setValor($row->ped_valor);
				$pedido->setStatus($row->ped_status);
				$pedido->setCupom($row->ped_cupom);
				$pedido->setPagSeguro($row->ped_pagseguro);
				$pedido->setTitulo($row->ped_titulo);
				return $pedido;
				
            }
            

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
	}
	
	public function listAll() {
	
	}
	
	public function listByCliente($cid, $cupom=false) {
		

        try {
            
            $stmt = $this->openConnection();
			if($cupom) {
				$rs = $stmt->prepare("SELECT ped_pedido.*
									 FROM ped_pedido
									 WHERE ped_cliente = ? AND NOT ISNULL(ped_cupom)");
			} else {
				$rs = $stmt->prepare("SELECT ped_pedido.*
									 FROM ped_pedido
									 WHERE ped_cliente = ?");
			}
            
            $rs->bindParam(1,$cid,PDO::PARAM_STR);
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$list = array();
               
                while($row = $rs->fetch(PDO::FETCH_OBJ)){
					$pedido = new Pedido();
					$pedido->setCodigo($row->ped_codigo);
					$pedido->setOferta($row->ped_oferta);
					$pedido->setQuantidade($row->ped_quantidade);
					$pedido->setValor($row->ped_valor);
					$pedido->setStatus($row->ped_status);
					$pedido->setCupom($row->ped_cupom);
					
					array_push($list, $pedido);
					
				}
				
				 return $list;
            }

           

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
	}
	
	public function insert($pedido) {
        try{

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('INSERT INTO ped_pedido
			(ped_oferta, ped_cliente, ped_parceiro, ped_pagseguro, 
			ped_valor, ped_status, ped_quantidade, ped_datapedido, ped_titulo) 
			VALUES(?,?,?,?,?,?,?, CURRENT_TIMESTAMP, ?)');

            $stmt->beginTransaction();

            $rs->bindParam(1,$pedido->getOferta(), PDO::PARAM_INT);
            $rs->bindParam(2,$pedido->getCliente(), PDO::PARAM_INT);
            $rs->bindParam(3,$pedido->getParceiro(), PDO::PARAM_INT);
            $rs->bindParam(4,$pedido->getPagSeguro(), PDO::PARAM_STR);
            $rs->bindParam(5,$pedido->getValor(), PDO::PARAM_STR);
            $rs->bindParam(6,$pedido->getStatus(), PDO::PARAM_STR);
            $rs->bindParam(7,$pedido->getQuantidade(), PDO::PARAM_INT);
            $rs->bindParam(8,$pedido->getTitulo(), PDO::PARAM_STR);

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
	
	public function insertPagSeguro($pagseguro) {
		try{
            $stmt = $this->openConnection();
            $rs = $stmt->prepare('INSERT INTO pag_pagseguro  (  pag_vendedoremail, pag_extras, 
								  pag_tipofrete,  pag_valorfrete,  pag_anotacao,   pag_transacaoid,  
				pag_datatransacao, pag_tipopagamento,  pag_statustransacao,  pag_clinome, 
				pag_cliendereco,  pag_clinumero,  pag_clicomplemento,  pag_clibairro,  pag_clicidade,  
				pag_cliestado,  pag_clicep,  pag_clitelefone,  pag_numitens,  pag_parcelas,  pag_prodid,  
				pag_proddescricao,  pag_prodvalor,  pag_prodquantidade,  pag_prodfrete,  
				pag_prodextras, pag_referencia, pag_cliemail )  
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

            $stmt->beginTransaction();

            $rs->bindParam(1,$pagseguro->VendedorEmail, PDO::PARAM_STR);
			$rs->bindParam(2,$pagseguro->Extras, PDO::PARAM_STR);
			$rs->bindParam(3,$pagseguro->TipoFrete, PDO::PARAM_STR);
			$rs->bindParam(4,$pagseguro->ValorFrete, PDO::PARAM_STR);
			$rs->bindParam(5,$pagseguro->Anotacao, PDO::PARAM_STR);
			$rs->bindParam(6,$pagseguro->TransacaoID, PDO::PARAM_STR);
			$rs->bindParam(7,$pagseguro->DataTransacao, PDO::PARAM_STR);
			$rs->bindParam(8,$pagseguro->TipoPagamento, PDO::PARAM_STR);
			$rs->bindParam(9,$pagseguro->StatusTransacao, PDO::PARAM_STR);
			$rs->bindParam(10,$pagseguro->CliNome, PDO::PARAM_STR);
			$rs->bindParam(11,$pagseguro->CliEndereco, PDO::PARAM_STR);
			$rs->bindParam(12,$pagseguro->CliNumero, PDO::PARAM_STR);
			$rs->bindParam(13,$pagseguro->CliComplemento, PDO::PARAM_STR);
			$rs->bindParam(14,$pagseguro->CliBairro, PDO::PARAM_STR);
			$rs->bindParam(15,$pagseguro->CliCidade, PDO::PARAM_STR);
			$rs->bindParam(16,$pagseguro->CliEstado, PDO::PARAM_STR);
			$rs->bindParam(17,$pagseguro->CliCEP, PDO::PARAM_STR);
			$rs->bindParam(18,$pagseguro->CliTelefone, PDO::PARAM_STR);
			$rs->bindParam(19,$pagseguro->NumItens, PDO::PARAM_INT);
			$rs->bindParam(20,$pagseguro->Parcelas, PDO::PARAM_INT);
			$rs->bindParam(21,$pagseguro->ProdID_1, PDO::PARAM_STR);
			$rs->bindParam(22,$pagseguro->ProdDescricao_1, PDO::PARAM_STR);
			$rs->bindParam(23,$pagseguro->ProdValor_1, PDO::PARAM_STR);
			$rs->bindParam(24,$pagseguro->ProdQuantidade_1, PDO::PARAM_STR);
			$rs->bindParam(25,$pagseguro->ProdFrete_1, PDO::PARAM_STR);
			$rs->bindParam(26,$pagseguro->ProdExtras_1, PDO::PARAM_STR);
			$rs->bindParam(27,$pagseguro->Referencia, PDO::PARAM_STR);
			$rs->bindParam(28,$pagseguro->CliEmail, PDO::PARAM_STR);

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
	
	public function updateStatusPedido($pagseguro, $cancelar=false) {
		try {
		
		$stmt = $this->openConnection();
		
			if (!$cancelar) {
			
				$rs = $stmt->prepare('UPDATE ped_pedido SET ped_status = ?, ped_datapagamento = CURRENT_TIMESTAMP()
										WHERE ped_pagseguro = ?');

			} else {
				$rs = $stmt->prepare("UPDATE ped_pedido SET ped_status = ?, ped_datapagamento = CURRENT_TIMESTAMP(), ped_cupom = '' 
										WHERE ped_pagseguro = ?");
			}
			
			$rs->bindParam(1,$pagseguro->StatusTransacao, PDO::PARAM_STR);
			$rs->bindParam(2,$pagseguro->Referencia, PDO::PARAM_STR);
			
			$stmt->beginTransaction();
			
			$rs->execute();
            if($rs->rowCount() > 0){
                $stmt->commit();
                return true;
            }else{
                $stmt->rollBack();
                return false;
            }
		
		} catch(Exception $e) {
			echo $e->getMessage();
			exit();
		}
	}
}

?>