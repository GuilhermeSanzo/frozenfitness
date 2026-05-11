-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.10-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema frozenfitness
--

CREATE DATABASE IF NOT EXISTS frozenfitness;
USE frozenfitness;

--
-- Definition of table `artigo`
--

DROP TABLE IF EXISTS `artigo`;
CREATE TABLE `artigo` (
  `artigo_id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `conteudo` text NOT NULL,
  `caminho_imagem` varchar(100) NOT NULL,
  `artigo_data` date NOT NULL,
  `autor` varchar(100) NOT NULL,
  PRIMARY KEY (`artigo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artigo`
--

/*!40000 ALTER TABLE `artigo` DISABLE KEYS */;
/*!40000 ALTER TABLE `artigo` ENABLE KEYS */;


--
-- Definition of table `bairro`
--

DROP TABLE IF EXISTS `bairro`;
CREATE TABLE `bairro` (
  `bairro_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cidade_id` int(11) NOT NULL,
  PRIMARY KEY (`bairro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bairro`
--

/*!40000 ALTER TABLE `bairro` DISABLE KEYS */;
/*!40000 ALTER TABLE `bairro` ENABLE KEYS */;


--
-- Definition of table `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `caminho_imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner`
--

/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;


--
-- Definition of table `caminhao`
--

DROP TABLE IF EXISTS `caminhao`;
CREATE TABLE `caminhao` (
  `caminhao_id` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(8) NOT NULL,
  `latitude` double(10,8) NOT NULL,
  `longitude` double(10,8) NOT NULL,
  `transportadora_id` int(11) NOT NULL,
  `motorista_id` int(11) NOT NULL,
  PRIMARY KEY (`caminhao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `caminhao`
--

/*!40000 ALTER TABLE `caminhao` DISABLE KEYS */;
/*!40000 ALTER TABLE `caminhao` ENABLE KEYS */;


--
-- Definition of table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `categria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`categria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria`
--

/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;


--
-- Definition of table `cidade`
--

DROP TABLE IF EXISTS `cidade`;
CREATE TABLE `cidade` (
  `cidade_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `estado_id` int(11) NOT NULL,
  PRIMARY KEY (`cidade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cidade`
--

/*!40000 ALTER TABLE `cidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `cidade` ENABLE KEYS */;


--
-- Definition of table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `peso` double(10,2) DEFAULT NULL,
  `altura` double(10,2) DEFAULT NULL,
  `necessidade_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cliente`
--

/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


--
-- Definition of table `dieta`
--

DROP TABLE IF EXISTS `dieta`;
CREATE TABLE `dieta` (
  `dieta_id` int(11) NOT NULL AUTO_INCREMENT,
  `noem` varchar(100) NOT NULL,
  `caminho_imagem` varchar(100) NOT NULL,
  `tipo_dieta_id` int(11) NOT NULL,
  `tipo_cadastro_id` int(11) NOT NULL,
  PRIMARY KEY (`dieta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dieta`
--

/*!40000 ALTER TABLE `dieta` DISABLE KEYS */;
/*!40000 ALTER TABLE `dieta` ENABLE KEYS */;


--
-- Definition of table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE `endereco` (
  `endereco_id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `tipo_endereco_id` int(11) NOT NULL,
  `bairro_id` int(11) NOT NULL,
  PRIMARY KEY (`endereco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `endereco`
--

/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;


--
-- Definition of table `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `uf` varchar(4) NOT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estado`
--

/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;


--
-- Definition of table `faleconosco`
--

DROP TABLE IF EXISTS `faleconosco`;
CREATE TABLE `faleconosco` (
  `fale_conosco_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `mensagem` text NOT NULL,
  `categoria` int(11) NOT NULL,
  PRIMARY KEY (`fale_conosco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faleconosco`
--

/*!40000 ALTER TABLE `faleconosco` DISABLE KEYS */;
/*!40000 ALTER TABLE `faleconosco` ENABLE KEYS */;


--
-- Definition of table `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE `fornecedor` (
  `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  PRIMARY KEY (`fornecedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fornecedor`
--

/*!40000 ALTER TABLE `fornecedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `fornecedor` ENABLE KEYS */;


--
-- Definition of table `horario_do_dia`
--

DROP TABLE IF EXISTS `horario_do_dia`;
CREATE TABLE `horario_do_dia` (
  `horario_do_dia_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`horario_do_dia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `horario_do_dia`
--

/*!40000 ALTER TABLE `horario_do_dia` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario_do_dia` ENABLE KEYS */;


--
-- Definition of table `ingrediente`
--

DROP TABLE IF EXISTS `ingrediente`;
CREATE TABLE `ingrediente` (
  `ingrediente_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `qtd_estoque` double(10,2) NOT NULL,
  `unidade_id` int(11) NOT NULL,
  `kcal_por_100g` int(11) NOT NULL,
  PRIMARY KEY (`ingrediente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingrediente`
--

/*!40000 ALTER TABLE `ingrediente` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingrediente` ENABLE KEYS */;


--
-- Definition of table `motorista`
--

DROP TABLE IF EXISTS `motorista`;
CREATE TABLE `motorista` (
  `motorista_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cnh` varchar(15) NOT NULL,
  `celular` varchar(20) NOT NULL,
  PRIMARY KEY (`motorista_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `motorista`
--

/*!40000 ALTER TABLE `motorista` DISABLE KEYS */;
/*!40000 ALTER TABLE `motorista` ENABLE KEYS */;


--
-- Definition of table `necessidade`
--

DROP TABLE IF EXISTS `necessidade`;
CREATE TABLE `necessidade` (
  `necessidade_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`necessidade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `necessidade`
--

/*!40000 ALTER TABLE `necessidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `necessidade` ENABLE KEYS */;


--
-- Definition of table `parceiro`
--

DROP TABLE IF EXISTS `parceiro`;
CREATE TABLE `parceiro` (
  `parceiro_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `caminho_imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`parceiro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parceiro`
--

/*!40000 ALTER TABLE `parceiro` DISABLE KEYS */;
/*!40000 ALTER TABLE `parceiro` ENABLE KEYS */;


--
-- Definition of table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `pedido_id` int(11) NOT NULL AUTO_INCREMENT,
  `desconto` double(3,2) NOT NULL,
  `total_pedido` double(10,2) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `caminhao_id` int(11) NOT NULL,
  PRIMARY KEY (`pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pedido`
--

/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;


--
-- Definition of table `prato`
--

DROP TABLE IF EXISTS `prato`;
CREATE TABLE `prato` (
  `prato_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `validade` varchar(100) NOT NULL,
  `valor_unitario` double(10,2) NOT NULL,
  `caminho_imagem` varchar(45) NOT NULL,
  `tipo_cadastro_id` int(11) NOT NULL,
  `tempo_preparo` int(11) NOT NULL,
  PRIMARY KEY (`prato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prato`
--

/*!40000 ALTER TABLE `prato` DISABLE KEYS */;
/*!40000 ALTER TABLE `prato` ENABLE KEYS */;


--
-- Definition of table `rel_cliente_endereco`
--

DROP TABLE IF EXISTS `rel_cliente_endereco`;
CREATE TABLE `rel_cliente_endereco` (
  `rel_cliente_endereco_id` int(11) NOT NULL AUTO_INCREMENT,
  `endereco_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  PRIMARY KEY (`rel_cliente_endereco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rel_cliente_endereco`
--

/*!40000 ALTER TABLE `rel_cliente_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `rel_cliente_endereco` ENABLE KEYS */;


--
-- Definition of table `rel_dieta_pedido`
--

DROP TABLE IF EXISTS `rel_dieta_pedido`;
CREATE TABLE `rel_dieta_pedido` (
  `dieta_pedido_id` int(11) NOT NULL AUTO_INCREMENT,
  `dieta_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  PRIMARY KEY (`dieta_pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rel_dieta_pedido`
--

/*!40000 ALTER TABLE `rel_dieta_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `rel_dieta_pedido` ENABLE KEYS */;


--
-- Definition of table `rel_dieta_prato`
--

DROP TABLE IF EXISTS `rel_dieta_prato`;
CREATE TABLE `rel_dieta_prato` (
  `rel_dieta_prato_id` int(11) NOT NULL AUTO_INCREMENT,
  `dia` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `horario_do_dia_id` int(11) NOT NULL,
  `prato_id` int(11) NOT NULL,
  `dieta_id` int(11) NOT NULL,
  PRIMARY KEY (`rel_dieta_prato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rel_dieta_prato`
--

/*!40000 ALTER TABLE `rel_dieta_prato` DISABLE KEYS */;
/*!40000 ALTER TABLE `rel_dieta_prato` ENABLE KEYS */;


--
-- Definition of table `rel_ingrediente_fornecedor`
--

DROP TABLE IF EXISTS `rel_ingrediente_fornecedor`;
CREATE TABLE `rel_ingrediente_fornecedor` (
  `rel_ingrediente_fornecedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor_id` int(11) NOT NULL,
  `ingrediente_id` int(11) NOT NULL,
  PRIMARY KEY (`rel_ingrediente_fornecedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rel_ingrediente_fornecedor`
--

/*!40000 ALTER TABLE `rel_ingrediente_fornecedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `rel_ingrediente_fornecedor` ENABLE KEYS */;


--
-- Definition of table `rel_prato_ingrediente`
--

DROP TABLE IF EXISTS `rel_prato_ingrediente`;
CREATE TABLE `rel_prato_ingrediente` (
  `rel_prato_ingrediente_id` int(11) NOT NULL AUTO_INCREMENT,
  `qtd` int(11) NOT NULL,
  `ingrediente_id` int(11) NOT NULL,
  `unidade_id` int(11) NOT NULL,
  `prato_id` int(11) NOT NULL,
  PRIMARY KEY (`rel_prato_ingrediente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rel_prato_ingrediente`
--

/*!40000 ALTER TABLE `rel_prato_ingrediente` DISABLE KEYS */;
/*!40000 ALTER TABLE `rel_prato_ingrediente` ENABLE KEYS */;


--
-- Definition of table `rel_status_pedido`
--

DROP TABLE IF EXISTS `rel_status_pedido`;
CREATE TABLE `rel_status_pedido` (
  `rel_status_pedido_id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_status_pedido_data` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  PRIMARY KEY (`rel_status_pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rel_status_pedido`
--

/*!40000 ALTER TABLE `rel_status_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `rel_status_pedido` ENABLE KEYS */;


--
-- Definition of table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

/*!40000 ALTER TABLE `status` DISABLE KEYS */;
/*!40000 ALTER TABLE `status` ENABLE KEYS */;


--
-- Definition of table `tipo_cadastro`
--

DROP TABLE IF EXISTS `tipo_cadastro`;
CREATE TABLE `tipo_cadastro` (
  `tipo_cadastro_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`tipo_cadastro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_cadastro`
--

/*!40000 ALTER TABLE `tipo_cadastro` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_cadastro` ENABLE KEYS */;


--
-- Definition of table `tipo_dieta`
--

DROP TABLE IF EXISTS `tipo_dieta`;
CREATE TABLE `tipo_dieta` (
  `tipo_dieta_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`tipo_dieta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_dieta`
--

/*!40000 ALTER TABLE `tipo_dieta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_dieta` ENABLE KEYS */;


--
-- Definition of table `tipo_endereco`
--

DROP TABLE IF EXISTS `tipo_endereco`;
CREATE TABLE `tipo_endereco` (
  `tipo_endereco_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`tipo_endereco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_endereco`
--

/*!40000 ALTER TABLE `tipo_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_endereco` ENABLE KEYS */;


--
-- Definition of table `transportadora`
--

DROP TABLE IF EXISTS `transportadora`;
CREATE TABLE `transportadora` (
  `transportadora_id` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  PRIMARY KEY (`transportadora_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transportadora`
--

/*!40000 ALTER TABLE `transportadora` DISABLE KEYS */;
/*!40000 ALTER TABLE `transportadora` ENABLE KEYS */;


--
-- Definition of table `unidade`
--

DROP TABLE IF EXISTS `unidade`;
CREATE TABLE `unidade` (
  `unidade_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`unidade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unidade`
--

/*!40000 ALTER TABLE `unidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidade` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
