-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: mysql02-farm61.uni5.net
-- Tempo de geração: 24/10/2017 às 08:50
-- Versão do servidor: 5.5.46-log
-- Versão do PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `superfavoritos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cat_categoria`
--

CREATE TABLE IF NOT EXISTS `cat_categoria` (
  `cat_codigo` int(10) unsigned NOT NULL,
  `cat_descricao` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `cat_categoria`
--

INSERT INTO `cat_categoria` (`cat_codigo`, `cat_descricao`) VALUES
(1, 'Bares e Baladas'),
(2, 'Cursos e Aulas'),
(3, 'Entretenimento'),
(4, 'Esporte'),
(5, 'Hotéis e Viagens'),
(6, 'Produtos'),
(7, 'Restaurantes'),
(8, 'Saúde e Beleza'),
(9, 'Serviços Locais'),
(10, 'Roupas e Acessórios');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cid_cidade`
--

CREATE TABLE IF NOT EXISTS `cid_cidade` (
  `cid_codigo` int(10) unsigned NOT NULL,
  `cid_descricao` varchar(255) NOT NULL DEFAULT '',
  `cid_abreviacao` varchar(255) NOT NULL DEFAULT '',
  `cid_ativo` int(10) unsigned NOT NULL DEFAULT '0',
  `cid_texto` varchar(255) NOT NULL DEFAULT '',
  `cid_tags` varchar(255) NOT NULL DEFAULT '',
  `cid_principal` int(11) NOT NULL DEFAULT '0',
  `cid_ordem` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `cid_cidade`
--

INSERT INTO `cid_cidade` (`cid_codigo`, `cid_descricao`, `cid_abreviacao`, `cid_ativo`, `cid_texto`, `cid_tags`, `cid_principal`, `cid_ordem`) VALUES
(28, 'Rio de Janeiro', 'RIO', 1, '', 'rio-de-janeiro', 55, 70),
(29, 'Niterói', 'NIT', 1, '', 'niteroi', 55, 60),
(30, 'Nova Friburgo', 'FRI', 1, '', 'nova-friburgo', 55, 90),
(31, 'Bom Jardim', 'BJA', 1, '', 'bom-jardim', 55, 2),
(32, 'Cordeiro', 'COR', 1, '', 'cordeiro', 55, 80),
(33, 'Cantagalo', 'CDM', 1, '', 'cantagalo', 55, 2),
(34, 'Macuco', 'MAC', 1, '', 'macuco', 55, 2),
(35, 'Itaboraí', 'ITA', 1, '', 'itaborai', 55, 2),
(36, 'Rio das Ostras', 'ROS', 1, '', 'rio-das-ostras', 55, 2),
(37, 'Macaé', 'MAC', 1, '', 'macae', 55, 2),
(38, 'Rio Bonito', 'RIB', 1, '', 'rio-bonito', 55, 2),
(39, 'São Paulo', 'SJM', 1, '', 'sao-paulo', 55, 1),
(40, 'Belo Horizonte', 'NIG', 1, '', 'belo-horizonte', 55, 1),
(41, 'São Gonçalo', 'SGO', 1, '', 'sao-goncalo', 55, 2),
(42, 'Teresópolis', 'TER', 1, '', 'teresopolis', 55, 2),
(43, 'Petrópolis', 'PET', 1, '', 'petropolis', 55, 2),
(44, 'Guarapari', 'GUA', 1, '', 'guarapari', 55, 1),
(45, 'Vila Velha', 'VIV', 1, '', 'vila-velha', 55, 1),
(48, 'Oferta Nacional', 'NAC', 1, '', 'oferta-nacional', 55, 100),
(49, 'Arraial do Cabo', 'ADC', 1, '', 'arraial-do-cabo', 55, 1),
(46, 'Búzios', 'BUZ', 1, '', 'buzios', 55, 1),
(51, 'Maricá', 'MAR', 1, '', 'marica', 55, 1),
(52, 'Saquarema', 'SAQ', 1, '', 'saquarema', 55, 1),
(53, 'Cabo Fribo', 'CBF', 1, '', 'cabo-frio', 55, 1),
(54, 'Cachoeiras de Macacu', 'CDM', 1, '', 'cachoeiras-de-macacu', 55, 1),
(55, 'Todas', 'TDS', 1, '', 'todas', 55, 1000),
(56, 'Salvador', 'SAL', 1, '', 'salvador', 55, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cto_cidade_tem_oferta`
--

CREATE TABLE IF NOT EXISTS `cto_cidade_tem_oferta` (
  `cto_codigo` int(11) NOT NULL,
  `cto_cidade` int(11) NOT NULL DEFAULT '0',
  `cto_oferta` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `cto_cidade_tem_oferta`
--


-- --------------------------------------------------------

--
-- Estrutura para tabela `mld_maladireta`
--

CREATE TABLE IF NOT EXISTS `mld_maladireta` (
  `mld_codigo` int(10) unsigned NOT NULL,
  `mld_email` varchar(255) NOT NULL DEFAULT '',
  `mld_cidade` int(10) unsigned NOT NULL DEFAULT '0',
  `mld_datacadastro` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mld_valid` int(10) unsigned NOT NULL DEFAULT '1',
  `mld_sent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=37525 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `mld_maladireta`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `mod_modulo`
--

CREATE TABLE IF NOT EXISTS `mod_modulo` (
  `mod_codigo` int(10) unsigned NOT NULL,
  `mod_descricao` varchar(255) NOT NULL DEFAULT '',
  `mod_pagina` varchar(255) NOT NULL DEFAULT '',
  `mod_ordem` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `mod_modulo`
--

INSERT INTO `mod_modulo` (`mod_codigo`, `mod_descricao`, `mod_pagina`, `mod_ordem`) VALUES
(1, 'Usuários', 'usuarios', 7),
(2, 'Ofertas', 'ofertas', 2),
(3, 'Pedidos', 'pedidos', 3),
(4, 'Cupons', 'cupons', 4),
(5, 'Cadastros', 'cadastros', 8),
(6, 'Parceiros', 'parceiros', 5),
(7, 'Marketing', 'marketing', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `nac_nivelacesso`
--

CREATE TABLE IF NOT EXISTS `nac_nivelacesso` (
  `nac_codigo` int(10) unsigned NOT NULL,
  `nac_modulo` int(10) unsigned NOT NULL DEFAULT '0',
  `nac_perfil` int(10) unsigned NOT NULL DEFAULT '0',
  `nac_inclusao` int(11) DEFAULT NULL,
  `nac_alteracao` int(11) DEFAULT NULL,
  `nac_exclusao` int(11) DEFAULT NULL,
  `nac_consulta` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `nac_nivelacesso`
--

INSERT INTO `nac_nivelacesso` (`nac_codigo`, `nac_modulo`, `nac_perfil`, `nac_inclusao`, `nac_alteracao`, `nac_exclusao`, `nac_consulta`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 1, 1, 1),
(8, 1, 2, 0, 0, 0, 1),
(11, 2, 2, 0, 0, 0, 1),
(12, 3, 1, 1, 1, 1, 1),
(13, 4, 1, 1, 1, 1, 1),
(14, 5, 1, 1, 1, 1, 1),
(15, 6, 1, 1, 1, 1, 1),
(16, 7, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `new_newsletter`
--

CREATE TABLE IF NOT EXISTS `new_newsletter` (
  `new_codigo` int(10) unsigned NOT NULL,
  `new_email` varchar(255) NOT NULL DEFAULT '',
  `new_cidade` int(10) unsigned NOT NULL DEFAULT '0',
  `new_datacadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `new_hash` varchar(255) DEFAULT NULL,
  `new_visits` int(11) NOT NULL DEFAULT '0',
  `new_nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=651 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `new_newsletter`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ofe_oferta`
--

CREATE TABLE IF NOT EXISTS `ofe_oferta` (
  `ofe_codigo` int(10) unsigned NOT NULL,
  `ofe_titulo` varchar(255) NOT NULL DEFAULT '',
  `ofe_alias` varchar(255) NOT NULL DEFAULT '',
  `ofe_destaques` longtext NOT NULL,
  `ofe_regras` longtext NOT NULL,
  `ofe_texto` longtext NOT NULL,
  `ofe_publicar` int(10) unsigned NOT NULL DEFAULT '0',
  `ofe_criacao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ofe_validade` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ofe_termino` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ofe_home` int(10) unsigned NOT NULL DEFAULT '0',
  `ofe_acessos` int(10) unsigned NOT NULL DEFAULT '0',
  `ofe_foto` varchar(255) NOT NULL DEFAULT '',
  `ofe_idioma` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0 = pt ; 1 = en',
  `ofe_tags` varchar(255) NOT NULL DEFAULT '',
  `ofe_destaque` int(11) NOT NULL DEFAULT '0',
  `ofe_minimo` int(11) NOT NULL DEFAULT '0',
  `ofe_maximo` int(11) NOT NULL DEFAULT '0',
  `ofe_parceiro` int(11) NOT NULL DEFAULT '0',
  `ofe_preco` double(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Preço de venda pelo site',
  `ofe_custo` double(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Valor Original do Produto',
  `ofe_desconto` int(10) unsigned NOT NULL DEFAULT '0',
  `ofe_vendas` int(11) NOT NULL DEFAULT '0',
  `ofe_categoria` int(10) unsigned NOT NULL,
  `ofe_limite` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1404 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `ofe_oferta`
--


-- --------------------------------------------------------

--
-- Estrutura para tabela `otf_oferta_tem_foto`
--

CREATE TABLE IF NOT EXISTS `otf_oferta_tem_foto` (
  `otf_codigo` int(10) unsigned NOT NULL,
  `otf_oferta` int(11) NOT NULL DEFAULT '0',
  `otf_foto` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `otf_oferta_tem_foto`
--



-- --------------------------------------------------------

--
-- Estrutura para tabela `pag_pagseguro`
--

CREATE TABLE IF NOT EXISTS `pag_pagseguro` (
  `pag_codigo` int(10) unsigned NOT NULL,
  `pag_vendedoremail` varchar(255) NOT NULL,
  `pag_transacaoid` varchar(255) NOT NULL,
  `pag_referencia` varchar(255) NOT NULL,
  `pag_extras` float(11,2) NOT NULL DEFAULT '0.00',
  `pag_tipofrete` varchar(255) NOT NULL,
  `pag_valorfrete` float(11,2) NOT NULL DEFAULT '0.00',
  `pag_anotacao` varchar(255) NOT NULL,
  `pag_datatransacao` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `pag_tipopagamento` varchar(255) DEFAULT NULL,
  `pag_statustransacao` varchar(255) DEFAULT NULL,
  `pag_clinome` varchar(255) DEFAULT NULL,
  `pag_cliendereco` varchar(255) DEFAULT NULL,
  `pag_clinumero` varchar(255) DEFAULT NULL,
  `pag_clicomplemento` varchar(255) DEFAULT NULL,
  `pag_clibairro` varchar(255) DEFAULT NULL,
  `pag_clicidade` varchar(255) DEFAULT NULL,
  `pag_cliestado` varchar(255) DEFAULT NULL,
  `pag_clicep` varchar(255) DEFAULT NULL,
  `pag_clitelefone` varchar(255) DEFAULT NULL,
  `pag_numitens` int(11) DEFAULT NULL,
  `pag_parcelas` int(11) DEFAULT NULL,
  `pag_prodid` varchar(255) DEFAULT NULL,
  `pag_proddescricao` varchar(255) DEFAULT NULL,
  `pag_prodvalor` float(11,2) DEFAULT NULL,
  `pag_prodquantidade` varchar(255) DEFAULT NULL,
  `pag_prodfrete` float(11,2) DEFAULT NULL,
  `pag_prodextras` float(11,2) DEFAULT NULL,
  `pag_cliemail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `pag_pagseguro`
--


-- --------------------------------------------------------

--
-- Estrutura para tabela `par_parceiro`
--

CREATE TABLE IF NOT EXISTS `par_parceiro` (
  `par_codigo` int(11) NOT NULL,
  `par_nomerazao` varchar(255) NOT NULL DEFAULT '',
  `par_fantasia` varchar(255) NOT NULL DEFAULT '',
  `par_endereco` varchar(255) NOT NULL DEFAULT '',
  `par_bairro` varchar(255) NOT NULL DEFAULT '',
  `par_cep` int(11) NOT NULL DEFAULT '0',
  `par_cidade` int(11) NOT NULL DEFAULT '0',
  `par_gmaps` longtext NOT NULL,
  `par_mapa` varchar(255) NOT NULL DEFAULT '',
  `par_site` varchar(255) DEFAULT NULL,
  `par_telefone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `par_parceiro`
--


-- --------------------------------------------------------

--
-- Estrutura para tabela `ped_pedido`
--

CREATE TABLE IF NOT EXISTS `ped_pedido` (
  `ped_codigo` int(10) unsigned NOT NULL,
  `ped_oferta` int(11) NOT NULL DEFAULT '0',
  `ped_cliente` int(11) NOT NULL DEFAULT '0',
  `ped_parceiro` int(11) NOT NULL DEFAULT '0',
  `ped_pagseguro` varchar(255) NOT NULL DEFAULT '',
  `ped_titulo` varchar(255) NOT NULL DEFAULT '',
  `ped_valor` float(11,2) NOT NULL DEFAULT '0.00',
  `ped_status` varchar(255) NOT NULL DEFAULT 'Aguardando Pagamento',
  `ped_quantidade` int(11) NOT NULL DEFAULT '0',
  `ped_datapedido` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ped_datapagamento` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ped_cupom` varchar(255) DEFAULT NULL,
  `ped_utilizador` longtext NOT NULL,
  `ped_sequencia` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `ped_pedido`
--



-- --------------------------------------------------------

--
-- Estrutura para tabela `per_perfil`
--

CREATE TABLE IF NOT EXISTS `per_perfil` (
  `per_codigo` int(10) unsigned NOT NULL,
  `per_descricao` varchar(255) NOT NULL DEFAULT '',
  `per_ativo` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `per_perfil`
--

INSERT INTO `per_perfil` (`per_codigo`, `per_descricao`, `per_ativo`) VALUES
(1, 'Administrador', 1),
(2, 'Usuário', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usp_userprofile`
--

CREATE TABLE IF NOT EXISTS `usp_userprofile` (
  `usp_codigo` int(10) unsigned NOT NULL,
  `usp_nome` varchar(255) NOT NULL DEFAULT '',
  `usp_sobrenome` varchar(255) NOT NULL DEFAULT '',
  `usp_email` varchar(255) NOT NULL DEFAULT '',
  `usp_senha` varchar(255) NOT NULL DEFAULT '',
  `usp_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usp_cidade` int(10) unsigned NOT NULL DEFAULT '0',
  `usp_sexo` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '1-Male / 2-Female',
  `usp_ativacao` varchar(255) DEFAULT NULL,
  `usp_ativo` int(10) unsigned NOT NULL DEFAULT '0',
  `usp_endereco` varchar(255) DEFAULT NULL,
  `usp_telefone` varchar(255) DEFAULT NULL,
  `usp_celular` varchar(255) DEFAULT NULL,
  `usp_cep` varchar(255) DEFAULT NULL,
  `usp_dataregistro` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usp_esqueci` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usp_userprofile`
--

INSERT INTO `usp_userprofile` (`usp_codigo`, `usp_nome`, `usp_sobrenome`, `usp_email`, `usp_senha`, `usp_registro`, `usp_cidade`, `usp_sexo`, `usp_ativacao`, `usp_ativo`, `usp_endereco`, `usp_telefone`, `usp_celular`, `usp_cep`, `usp_dataregistro`, `usp_esqueci`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', 'e9837d47b610ee29399831f917791a44', '2011-02-28 03:58:25', 29, 1, NULL, 1, 'XXXX', '21-22222222', '21-999999999', '00000-000', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usu_usuario`
--

CREATE TABLE IF NOT EXISTS `usu_usuario` (
  `usu_codigo` int(10) unsigned NOT NULL,
  `usu_nome` varchar(255) NOT NULL DEFAULT '',
  `usu_login` varchar(255) NOT NULL DEFAULT '',
  `usu_email` varchar(255) NOT NULL DEFAULT '',
  `usu_senha` varchar(255) NOT NULL DEFAULT '',
  `usu_perfil` int(10) unsigned NOT NULL DEFAULT '0',
  `usu_bloqueado` int(10) unsigned NOT NULL DEFAULT '0',
  `usu_enviar_email` int(10) unsigned NOT NULL DEFAULT '0',
  `usu_gid` int(10) unsigned NOT NULL DEFAULT '0',
  `usu_data_registro` int(10) unsigned NOT NULL DEFAULT '0',
  `usu_ultimo_acesso` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usu_ativacao` int(10) unsigned NOT NULL DEFAULT '0',
  `usu_parametros` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usu_usuario`
--

INSERT INTO `usu_usuario` (`usu_codigo`, `usu_nome`, `usu_login`, `usu_email`, `usu_senha`, `usu_perfil`, `usu_bloqueado`, `usu_enviar_email`, `usu_gid`, `usu_data_registro`, `usu_ultimo_acesso`, `usu_ativacao`, `usu_parametros`) VALUES
(1, 'Webmaster', 'webmaster', 'webmaster@email.com', 'e9837d47b610ee29399831f917791a44', 1, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ven_vendedor`
--

CREATE TABLE IF NOT EXISTS `ven_vendedor` (
  `ven_codigo` int(10) unsigned NOT NULL,
  `ven_nome` varchar(255) NOT NULL,
  `ven_admissao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ven_demissao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ven_vendas` float(11,2) NOT NULL DEFAULT '0.00',
  `ven_comissao` float(11,2) DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `ven_vendedor`
--

INSERT INTO `ven_vendedor` (`ven_codigo`, `ven_nome`, `ven_admissao`, `ven_demissao`, `ven_vendas`, `ven_comissao`) VALUES
(1, 'Seller', '2011-07-13 00:42:18', '0000-00-00 00:00:00', 28.96, 2.90);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cat_categoria`
--
ALTER TABLE `cat_categoria`
  ADD PRIMARY KEY (`cat_codigo`);

--
-- Índices de tabela `cid_cidade`
--
ALTER TABLE `cid_cidade`
  ADD PRIMARY KEY (`cid_codigo`), ADD FULLTEXT KEY `BUSCA_CLUBE` (`cid_descricao`,`cid_texto`,`cid_tags`);

--
-- Índices de tabela `cto_cidade_tem_oferta`
--
ALTER TABLE `cto_cidade_tem_oferta`
  ADD PRIMARY KEY (`cto_codigo`);

--
-- Índices de tabela `mld_maladireta`
--
ALTER TABLE `mld_maladireta`
  ADD PRIMARY KEY (`mld_codigo`);

--
-- Índices de tabela `mod_modulo`
--
ALTER TABLE `mod_modulo`
  ADD PRIMARY KEY (`mod_codigo`);

--
-- Índices de tabela `nac_nivelacesso`
--
ALTER TABLE `nac_nivelacesso`
  ADD PRIMARY KEY (`nac_codigo`);

--
-- Índices de tabela `new_newsletter`
--
ALTER TABLE `new_newsletter`
  ADD PRIMARY KEY (`new_codigo`);

--
-- Índices de tabela `ofe_oferta`
--
ALTER TABLE `ofe_oferta`
  ADD PRIMARY KEY (`ofe_codigo`), ADD FULLTEXT KEY `NewIndex1` (`ofe_titulo`,`ofe_texto`,`ofe_tags`), ADD FULLTEXT KEY `ofe_titulo` (`ofe_titulo`,`ofe_destaques`,`ofe_regras`,`ofe_texto`,`ofe_tags`);

--
-- Índices de tabela `otf_oferta_tem_foto`
--
ALTER TABLE `otf_oferta_tem_foto`
  ADD PRIMARY KEY (`otf_codigo`);

--
-- Índices de tabela `pag_pagseguro`
--
ALTER TABLE `pag_pagseguro`
  ADD PRIMARY KEY (`pag_codigo`);

--
-- Índices de tabela `par_parceiro`
--
ALTER TABLE `par_parceiro`
  ADD PRIMARY KEY (`par_codigo`);

--
-- Índices de tabela `ped_pedido`
--
ALTER TABLE `ped_pedido`
  ADD PRIMARY KEY (`ped_codigo`);

--
-- Índices de tabela `per_perfil`
--
ALTER TABLE `per_perfil`
  ADD PRIMARY KEY (`per_codigo`);

--
-- Índices de tabela `usp_userprofile`
--
ALTER TABLE `usp_userprofile`
  ADD PRIMARY KEY (`usp_codigo`);

--
-- Índices de tabela `usu_usuario`
--
ALTER TABLE `usu_usuario`
  ADD PRIMARY KEY (`usu_codigo`);

--
-- Índices de tabela `ven_vendedor`
--
ALTER TABLE `ven_vendedor`
  ADD PRIMARY KEY (`ven_codigo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cat_categoria`
--
ALTER TABLE `cat_categoria`
  MODIFY `cat_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `cid_cidade`
--
ALTER TABLE `cid_cidade`
  MODIFY `cid_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT de tabela `cto_cidade_tem_oferta`
--
ALTER TABLE `cto_cidade_tem_oferta`
  MODIFY `cto_codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `mld_maladireta`
--
ALTER TABLE `mld_maladireta`
  MODIFY `mld_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37525;
--
-- AUTO_INCREMENT de tabela `mod_modulo`
--
ALTER TABLE `mod_modulo`
  MODIFY `mod_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `nac_nivelacesso`
--
ALTER TABLE `nac_nivelacesso`
  MODIFY `nac_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de tabela `new_newsletter`
--
ALTER TABLE `new_newsletter`
  MODIFY `new_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=651;
--
-- AUTO_INCREMENT de tabela `ofe_oferta`
--
ALTER TABLE `ofe_oferta`
  MODIFY `ofe_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1404;
--
-- AUTO_INCREMENT de tabela `otf_oferta_tem_foto`
--
ALTER TABLE `otf_oferta_tem_foto`
  MODIFY `otf_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de tabela `pag_pagseguro`
--
ALTER TABLE `pag_pagseguro`
  MODIFY `pag_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT de tabela `par_parceiro`
--
ALTER TABLE `par_parceiro`
  MODIFY `par_codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `ped_pedido`
--
ALTER TABLE `ped_pedido`
  MODIFY `ped_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT de tabela `per_perfil`
--
ALTER TABLE `per_perfil`
  MODIFY `per_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `usp_userprofile`
--
ALTER TABLE `usp_userprofile`
  MODIFY `usp_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT de tabela `usu_usuario`
--
ALTER TABLE `usu_usuario`
  MODIFY `usu_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `ven_vendedor`
--
ALTER TABLE `ven_vendedor`
  MODIFY `ven_codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
