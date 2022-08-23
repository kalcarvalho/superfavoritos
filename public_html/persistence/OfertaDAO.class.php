<?php

include_once '../domain/Oferta.class.php';
include_once '../domain/OfertaTemFoto.class.php';
include_once '../domain/Parceiro.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class OfertaDAO extends DAO implements IDatabaseFinder {

	private $counter;
	
    public function   __construct() {
		$lastId = 0;
    }
	
	public function getCounter() {
		return $this->counter;
	}

    public function findByPK($pk) {
		$oferta = new Oferta();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT ofe_oferta.*
                                 FROM ofe_oferta
                                 WHERE ofe_codigo = ?");
            
            $rs->bindParam(1,$pk,PDO::PARAM_STR);
            $rs->execute();
            
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
                $oferta->setCodigo($row->ofe_codigo);
                $oferta->setTitulo($row->ofe_titulo);
                $oferta->setDestaques($row->ofe_destaques);
                $oferta->setAlias($row->ofe_alias);
                $oferta->setRegras($row->ofe_regras);
                $oferta->setIntro($row->ofe_intro);
                $oferta->setTexto($row->ofe_texto);
                $oferta->setAutor($row->ofe_autor);
				$oferta->setCidade($row->ofe_cidade);
				$oferta->setFonte($row->ofe_fonte);
				$oferta->setPublicar($row->ofe_publicar);
				$oferta->setHome($row->ofe_home);
				$oferta->setAcessos($row->ofe_acessos);
				$oferta->setParceiro($row->ofe_parceiro);
				$oferta->setFoto($row->ofe_foto);
				$oferta->setPreco($row->ofe_preco);
				$oferta->setCusto($row->ofe_custo);
				$oferta->setTermino($row->ofe_termino);
				$oferta->setVendas($row->ofe_vendas);
				$oferta->setMinimo($row->ofe_minimo);
				$oferta->setMaximo($row->ofe_maximo);
            }

            return $oferta;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }
	
	public function findByAlias($alias) {
		$oferta = new Oferta();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT ofe_oferta.*
                                 FROM ofe_oferta
                                 WHERE ofe_alias = ?");
            
            $rs->bindParam(1,$alias,PDO::PARAM_STR);
            $rs->execute();
			
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
                $oferta->setCodigo($row->ofe_codigo);
                $oferta->setTitulo($row->ofe_titulo);
                $oferta->setDestaques($row->ofe_destaques);
                $oferta->setAlias($row->ofe_alias);
                $oferta->setRegras($row->ofe_regras);
                $oferta->setIntro($row->ofe_intro);
                $oferta->setTexto($row->ofe_texto);
                $oferta->setAutor($row->ofe_autor);
				$oferta->setCidade($row->ofe_cidade);
				$oferta->setFonte($row->ofe_fonte);
				$oferta->setPublicar($row->ofe_publicar);
				$oferta->setHome($row->ofe_home);
				$oferta->setAcessos($row->ofe_acessos);
				$oferta->setParceiro($row->ofe_parceiro);
				$oferta->setFoto($row->ofe_foto);
				$oferta->setPreco($row->ofe_preco);
				$oferta->setCusto($row->ofe_custo);
				$oferta->setTermino($row->ofe_termino);
				$oferta->setVendas($row->ofe_vendas);
				$oferta->setMinimo($row->ofe_minimo);
				$oferta->setMaximo($row->ofe_maximo);
				
				 return $oferta;
            }

           

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }
	
	public function findByDateCity($periodo, $city) {
		

        try {
            
            $stmt = $this->openConnection();

            $rs = $stmt->prepare("SELECT ofe_oferta.*
                                 FROM ofe_oferta
                                 LEFT OUTER JOIN cto_cidade_tem_oferta ON cto_oferta = ofe_codigo
                                 WHERE (ofe_criacao = ? OR ofe_termino >= ?) AND cto_cidade = ? ");

         //    $rs = $stmt->prepare("SELECT ofe_oferta.*
         //                         FROM ofe_oferta
								 // LEFT OUTER JOIN cto_cidade_tem_oferta ON cto_oferta = ofe_codigo
         //                         WHERE cto_cidade = ? AND ofe_publicar =1 ");

            
            $rs->bindParam(1,$periodo,PDO::PARAM_STR);
            $rs->bindParam(2,$periodo,PDO::PARAM_STR);
            $rs->bindParam(3,$city,PDO::PARAM_INT);
            $rs->execute();
			
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
				$oferta = new Oferta();
                $oferta->setCodigo($row->ofe_codigo);
                $oferta->setTitulo($row->ofe_titulo);
                $oferta->setDestaques($row->ofe_destaques);
                $oferta->setAlias($row->ofe_alias);
                $oferta->setRegras($row->ofe_regras);
                $oferta->setIntro($row->ofe_intro);
                $oferta->setTexto($row->ofe_texto);
                $oferta->setAutor($row->ofe_autor);
				$oferta->setCidade($row->ofe_clube);
				$oferta->setFonte($row->ofe_fonte);
				$oferta->setPublicar($row->ofe_publicar);
				$oferta->setHome($row->ofe_home);
				$oferta->setAcessos($row->ofe_acessos);
				$oferta->setParceiro($row->ofe_parceiro);
				$oferta->setFoto($row->ofe_foto);
				$oferta->setPreco($row->ofe_preco);
				$oferta->setCusto($row->ofe_custo);
				$oferta->setTermino($row->ofe_termino);
				$oferta->setVendas($row->ofe_vendas);
				$oferta->setMinimo($row->ofe_minimo);
				$oferta->setMaximo($row->ofe_maximo);
				
				
				return $oferta;
            }

            

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }
	
	public function retornaParceiroByOferta($pid) {
		$parceiro = new Parceiro();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT par_parceiro.*
                                 FROM par_parceiro
                                 WHERE par_codigo = ?");
            
            $rs->bindParam(1,$pid,PDO::PARAM_STR);
            $rs->execute();
            
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
                $parceiro->setCodigo($row->par_codigo);
                $parceiro->setNomeRazao($row->par_nomerazao);
                $parceiro->setFantasia($row->par_fantasia);
                $parceiro->setEndereco($row->par_endereco);
                $parceiro->setBairro($row->par_bairro);
                $parceiro->setCep($row->par_cep);
                $parceiro->setCidade($row->par_cidade);
                $parceiro->setGmaps($row->par_gmaps);
                $parceiro->setMapa($row->par_mapa);
                $parceiro->setSite($row->par_site);
				
				return $parceiro;
				
            }

            

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
	}
	
	
    public function listFotosByOferta($oferta) {
        try {

            $stmt = $this->openConnection();
			
			$rs = $stmt->prepare('SELECT otf_oferta_tem_foto.*
							  FROM otf_oferta_tem_foto
							  WHERE otf_oferta = ?');
							  
			$rs->bindParam(1,$oferta,PDO::PARAM_INT);

            $rs->execute();

            if ($rs->rowCount() > 0) {

                $list = array();

                while($row = $rs->fetch(PDO::FETCH_OBJ)){

                    $foto = new OfertaTemFoto();
					$foto->setCodigo($row->otf_codigo);
					$foto->setOferta($row->otf_oferta);
					$foto->setFoto($row->otf_foto);

                    array_push($list, $foto);
                }
                return $list;
            }
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }
	
	 public function listChamadaByClube($clube) {
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('SELECT ofe_oferta.*
                                  FROM ofe_oferta
                                  WHERE ofe_tipo = 1 
								  AND ofe_clube = ?
								  AND ofe_publicar = 1
								  AND ofe_destaque = 1
								  ORDER BY ofe_modificado DESC LIMIT 1');
            $rs->bindParam(1,$clube,PDO::PARAM_INT);

            $rs->execute();
            
            if ($rs->rowCount() > 0) {
			
				$oferta = new Oferta();

                while($row = $rs->fetch(PDO::FETCH_OBJ)){

                    $oferta->setCodigo($row->ofe_codigo);
                    $oferta->setTitulo($row->ofe_titulo);
					$oferta->setSubTitulo($row->ofe_subtitulo);
					$oferta->setTexto($row->ofe_texto);
                    $oferta->setCidade($row->clu_codigo);
                    $oferta->setTipo($row->ofe_tipo);
                    $oferta->setAutor($row->ofe_autor);
                    $oferta->setFonte($row->ofe_fonte);
					$oferta->setEditavel($row->ofe_editavel);
					$oferta->setFoto($row->ofe_foto);
					$oferta->setAlias($row->ofe_alias);
					$oferta->setDestaque($row->ofe_destaque);
					$oferta->setCredito($row->ofe_credito);

				}
                return $oferta;
            }
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }
	
	public function listConteudoHomeByTipo($tipo) {
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('SELECT ofe_oferta.*, clu_clube.*
                                  FROM ofe_oferta
                                  INNER JOIN clu_clube ON clu_codigo = ofe_clube
                                  WHERE ofe_tipo = ? AND ofe_home = 1
								  ORDER BY ofe_modificado DESC LIMIT 10');
            $rs->bindParam(1,$tipo,PDO::PARAM_INT);

            $rs->execute();
            
            if ($rs->rowCount() > 0) {

                $list = array();

                while($row = $rs->fetch(PDO::FETCH_OBJ)){

                    $oferta = new Oferta();
                    $oferta->setCodigo($row->ofe_codigo);
                    $oferta->setTitulo($row->ofe_titulo);
					$oferta->setSubTitulo($row->ofe_subtitulo);
					$oferta->setAlias($row->ofe_alias);
                    $oferta->setCidade($row->clu_codigo);
					$oferta->setTexto($row->ofe_texto);
                    $oferta->setTipo($row->ofe_tipo);
                    $oferta->setAutor($row->ofe_autor);
                    $oferta->setFonte($row->ofe_fonte);
					$oferta->setEditavel($row->ofe_editavel);

                    array_push($list, $oferta);
                }

                return $list;
            }
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }
	
	public function listConteudoHomeDestaqueByTipo($tipo) {
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('SELECT ofe_oferta.*, clu_clube.*
                                  FROM ofe_oferta
                                  INNER JOIN clu_clube ON clu_codigo = ofe_clube
                                  WHERE ofe_tipo = ? AND ofe_home = 1 OR ofe_destaque = 1
								  ORDER BY ofe_modificado DESC LIMIT 10');
            $rs->bindParam(1,$tipo,PDO::PARAM_INT);

            $rs->execute();
            
            if ($rs->rowCount() > 0) {

                $list = array();

                while($row = $rs->fetch(PDO::FETCH_OBJ)){

                    $oferta = new Oferta();
                    $oferta->setCodigo($row->ofe_codigo);
                    $oferta->setTitulo($row->ofe_titulo);
					$oferta->setSubTitulo($row->ofe_subtitulo);
					$oferta->setAlias($row->ofe_alias);
                    $oferta->setCidade($row->clu_codigo);
					$oferta->setTexto($row->ofe_texto);
                    $oferta->setTipo($row->ofe_tipo);
                    $oferta->setAutor($row->ofe_autor);
                    $oferta->setFonte($row->ofe_fonte);
					$oferta->setEditavel($row->ofe_editavel);
					$oferta->setThumb($row->ofe_thumb);

                    array_push($list, $oferta);
                }

                return $list;
            }
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }
	
	public function listConteudoChamadaColunista($col) {
		$oferta = null;
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('SELECT ofe_oferta.*
                                  FROM ofe_oferta
                                  WHERE ofe_tipo = 4 AND ofe_publicar = 1 AND ofe_colunista = ?
								  ORDER BY ofe_modificado DESC LIMIT 1');
								  
            $rs->bindParam(1,$col,PDO::PARAM_INT);

            $rs->execute();
            if ($rs->rowCount() > 0) {

					
					$row = $rs->fetch(PDO::FETCH_OBJ);
					$oferta = new Oferta();
                    $oferta->setCodigo($row->ofe_codigo);
                    $oferta->setTitulo($row->ofe_titulo);
					$oferta->setSubTitulo($row->ofe_subtitulo);
					$oferta->setAlias($row->ofe_alias);
					$oferta->setTexto($row->ofe_texto);
                    $oferta->setTipo($row->ofe_tipo);
                    $oferta->setAutor($row->ofe_autor);
                    $oferta->setFonte($row->ofe_fonte);
					
            }
			
			return $oferta;
			
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }
	
	public function listConteudoClubeByTipoTag($tipo, $tag, $clube) {
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('SELECT ofe_oferta.*, clu_clube.*
                                  FROM ofe_oferta
                                  INNER JOIN clu_clube ON clu_codigo = ofe_clube
                                  WHERE ofe_tipo = ? AND (clu_codigo = ? OR ofe_tags LIKE ?) AND ofe_publicar = 1 
								  ORDER BY ofe_modificado DESC LIMIT 10');
								  
            $rs->bindParam(1,$tipo,PDO::PARAM_INT);
			$rs->bindParam(2,$clube,PDO::PARAM_INT);
			$rs->bindParam(3,$tag,PDO::PARAM_STR);
            $rs->execute();
            if ($rs->rowCount() > 0) {

                $list = array();

                while($row = $rs->fetch(PDO::FETCH_OBJ)){

                    $oferta = new Oferta();
                    $oferta->setCodigo($row->ofe_codigo);
                    $oferta->setTitulo($row->ofe_titulo);
					$oferta->setSubTitulo($row->ofe_subtitulo);
					$oferta->setAlias($row->ofe_alias);
                    $oferta->setCidade($row->clu_codigo);
					$oferta->setTexto($row->ofe_texto);
                    $oferta->setTipo($row->ofe_tipo);
                    $oferta->setAutor($row->ofe_autor);
                    $oferta->setFonte($row->ofe_fonte);
					$oferta->setEditavel($row->ofe_editavel);

                    array_push($list, $oferta);
                }

                return $list;
            }
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }
	
	public function listConteudoByTipoFiltro($tipo, $filtro) {
		$filtro = '%'.$filtro.'%';
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('SELECT ofe_oferta.*, clu_clube.*
                                  FROM ofe_oferta
                                  INNER JOIN clu_clube ON clu_codigo = ofe_clube
                                  WHERE ofe_tipo = ? AND (clu_descricao LIKE ? OR ofe_titulo LIKE ? or ofe_tags LIKE ?)
								  ORDER BY ofe_modificado DESC');
            $rs->bindParam(1,$tipo,PDO::PARAM_INT);
			$rs->bindParam(2,$filtro,PDO::PARAM_STR);
			$rs->bindParam(3,$filtro,PDO::PARAM_STR);
			$rs->bindParam(4,$filtro,PDO::PARAM_STR);

            $rs->execute();
            
            if ($rs->rowCount() > 0) {

                $list = array();

                while($row = $rs->fetch(PDO::FETCH_OBJ)){

                    $oferta = new Oferta();
                    $oferta->setCodigo($row->ofe_codigo);
                    $oferta->setTitulo($row->ofe_titulo);
                    $oferta->setCidade($row->clu_codigo);
                    $oferta->setTipo($row->ofe_tipo);
                    $oferta->setAutor($row->ofe_autor);
                    $oferta->setFonte($row->ofe_fonte);
					$oferta->setEditavel($row->ofe_editavel);
					$oferta->setAcessos($row->ofe_acessos);

                    array_push($list, $oferta);
                }

                return $list;
            }
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }

    public function listAll() {
        
    }
	
	
	public function search($termo) {
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('SELECT ofe_oferta.*, MATCH(ofe_titulo, ofe_subtitulo, ofe_texto, ofe_tags) AGAINST(?) as score
                                  FROM ofe_oferta
                                  WHERE MATCH(ofe_titulo, ofe_subtitulo, ofe_texto, ofe_tags) AGAINST(?) AND ofe_publicar = 1 AND ofe_tipo = 1
								  ORDER BY score DESC');
								  
            $rs->bindParam(1,$termo,PDO::PARAM_STR);
			$rs->bindParam(2,$termo,PDO::PARAM_STR);

            $rs->execute();
            
            if ($rs->rowCount() > 0) {

                $list = array();

                while($row = $rs->fetch(PDO::FETCH_OBJ)){

                    $busca = new BuscaOferta();
                    $busca->setCodigo($row->ofe_codigo);
                    $busca->setTitulo($row->ofe_titulo);
                    $busca->setCidade($row->clu_codigo);
                    $busca->setTipo($row->ofe_tipo);
                    $busca->setAutor($row->ofe_autor);
                    $busca->setFonte($row->ofe_fonte);
					$busca->setEditavel($row->ofe_editavel);
					$busca->setTexto($row->ofe_texto);
					$busca->setAlias($row->ofe_alias);
	
                    array_push($list, $busca);
                }

                return $list;
            }
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }
	
	public function searchPerfil($termo) {
		$busca = new BuscaOferta();
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('SELECT ofe_oferta.*, MATCH(ofe_titulo, ofe_subtitulo, ofe_texto, ofe_tags) AGAINST(?) as score FROM ofe_oferta WHERE MATCH(ofe_titulo, ofe_subtitulo, ofe_texto, ofe_tags) AGAINST(?) AND ofe_publicar = 1 AND ofe_tipo = 0 ORDER BY score DESC LIMIT 1');
								  
            $rs->bindParam(1,$termo,PDO::PARAM_STR);
			$rs->bindParam(2,$termo,PDO::PARAM_STR);

            $rs->execute();
            
            if ($rs->rowCount() > 0) {

				$row = $rs->fetch(PDO::FETCH_OBJ);

				
				$busca->setCodigo($row->ofe_codigo);
				$busca->setTitulo($row->ofe_titulo);
				$busca->setCidade($row->clu_codigo);
				$busca->setTipo($row->ofe_tipo);
				$busca->setAutor($row->ofe_autor);
				$busca->setFonte($row->ofe_fonte);
				$busca->setEditavel($row->ofe_editavel);
				$busca->setTexto($row->ofe_texto);
				$busca->setAlias($row->ofe_alias);
				$busca->setFoto($row->ofe_foto);
				$busca->setRelevancia($row->score);
				
		
            }
			
			return $busca;
			
        } catch(Exception $e ) {
            echo $e->getMessage();
            exit();
        }
    }
	
    public function deleteByPK($pk) {
        try{

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('DELETE FROM ofe_oferta WHERE ofe_codigo = ?');

            $stmt->beginTransaction();

            $rs->bindParam(1,$pk, PDO::PARAM_INT);

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
	
	public function insert($oferta) {
        try{

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('INSERT INTO ofe_oferta
			(ofe_titulo, ofe_subtitulo, ofe_alias, ofe_tipo, 
			ofe_intro, ofe_texto, ofe_autor, ofe_clube, ofe_fonte, 
			ofe_publicar, ofe_criacao, ofe_modificado, ofe_home, ofe_editavel) 
			VALUES(?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP(),?, ?)');

            $stmt->beginTransaction();

            $rs->bindParam(1,$oferta->getTitulo(), PDO::PARAM_STR);
			$rs->bindParam(2,$oferta->getSubTitulo(), PDO::PARAM_STR);
			$rs->bindParam(3,$oferta->getAlias(), PDO::PARAM_STR);
			$rs->bindParam(4,$oferta->getTipo(), PDO::PARAM_INT);
			$rs->bindParam(5,$oferta->getIntro(), PDO::PARAM_STR);
			$rs->bindParam(6,$oferta->getTexto(), PDO::PARAM_STR);
			$rs->bindParam(7,$oferta->getAutor(), PDO::PARAM_STR);
			$rs->bindParam(8,$oferta->getClube(), PDO::PARAM_INT);
			$rs->bindParam(9,$oferta->getFonte(), PDO::PARAM_STR);
			$rs->bindParam(10,$oferta->getPublicar(), PDO::PARAM_INT);
			$rs->bindParam(11,$oferta->getHome(), PDO::PARAM_INT);
			$rs->bindParam(12,$oferta->getEditavel(), PDO::PARAM_INT);

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
	
	public function updateAcessos($pk) {
		try {
		
			$stmt = $this->openConnection();
			$rs = $stmt->prepare('UPDATE ofe_oferta SET ofe_acessos = ofe_acessos + 1 WHERE ofe_codigo = ?');
				
			$rs->bindParam(1,$pk, PDO::PARAM_INT);
				
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
	
	
	
	public function update($oferta) {
        try{
		
			if($oferta->getDestaque() == 1) {
			
				$stmt = $this->openConnection();
				$rs = $stmt->prepare('UPDATE ofe_oferta SET ofe_destaque = 0 WHERE ofe_clube = ?');
				
				$stmt->beginTransaction();
				
				$rs->bindParam(1,$oferta->getClube(), PDO::PARAM_INT);
				
				$rs->execute();
				if($rs->rowCount() > 0){
					$stmt->commit();
				} else {
					$stmt->rollBack();
				}
				
			}
		
            $stmt = $this->openConnection();
            $rs = $stmt->prepare('UPDATE ofe_oferta SET
			ofe_titulo = ?, ofe_subtitulo = ?, ofe_alias = ?, ofe_texto = ?, ofe_autor = ?, ofe_clube = ?, ofe_fonte = ?, 
			ofe_publicar = ?, ofe_modificado = CURRENT_TIMESTAMP(), ofe_home = ?, ofe_editavel = ?, ofe_foto = ?, ofe_destaque = ?, ofe_credito = ?, ofe_thumb = ?
			WHERE ofe_codigo = '.$oferta->getCodigo());
			
            $stmt->beginTransaction();

            $rs->bindParam(1,$oferta->getTitulo(), PDO::PARAM_STR);
			$rs->bindParam(2,$oferta->getSubTitulo(), PDO::PARAM_STR);
			$rs->bindParam(3,$oferta->getAlias(), PDO::PARAM_STR);
			$rs->bindParam(4,$oferta->getTexto(), PDO::PARAM_STR);
			$rs->bindParam(5,$oferta->getAutor(), PDO::PARAM_STR);
			$rs->bindParam(6,$oferta->getClube(), PDO::PARAM_INT);
			$rs->bindParam(7,$oferta->getFonte(), PDO::PARAM_STR);
			$rs->bindParam(8,$oferta->getPublicar(), PDO::PARAM_INT);
			$rs->bindParam(9,$oferta->getHome(), PDO::PARAM_INT);
			$rs->bindParam(10,$oferta->getEditavel(), PDO::PARAM_INT);
			$rs->bindParam(11,$oferta->getFoto(), PDO::PARAM_STR);
			$rs->bindParam(12,$oferta->getDestaque(), PDO::PARAM_STR);
			$rs->bindParam(13,$oferta->getCredito(), PDO::PARAM_STR);
			$rs->bindParam(14,$oferta->getThumb(), PDO::PARAM_STR);

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
	
	public function saveVideo($yt) {
	
	
		try{

            $stmt = $this->openConnection();
            $rs = $stmt->prepare('INSERT INTO vid_video
			(vid_uid, vid_link, vid_titulo, vid_thumb, vid_descricao, vid_userprofile, vid_liberado) 
			VALUES(?,?,?,?,?,?,?)');

            $stmt->beginTransaction();

            $rs->bindParam(1,$yt->getId(), PDO::PARAM_STR);
			$rs->bindParam(2,$yt->getLink(), PDO::PARAM_STR);
			$rs->bindParam(3,$yt->getTitulo(), PDO::PARAM_STR);
			$rs->bindParam(4,$yt->getThumb(), PDO::PARAM_INT);
			$rs->bindParam(5,$yt->getDescricao(), PDO::PARAM_STR);
			$rs->bindParam(6,$yt->getUserProfile(), PDO::PARAM_STR);
			$rs->bindParam(7,$yt->getLiberado(), PDO::PARAM_STR);

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
