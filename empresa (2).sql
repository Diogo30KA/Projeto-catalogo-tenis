-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 16/05/2023 às 22h23min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `empresa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`codigo`, `nome`) VALUES
(1, 'Casual'),
(2, 'Esportivo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `generos`
--

CREATE TABLE IF NOT EXISTS `generos` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `generos`
--

INSERT INTO `generos` (`codigo`, `nome`) VALUES
(1, 'Masculino'),
(2, 'Feminino'),
(3, 'Unissex');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

CREATE TABLE IF NOT EXISTS `marcas` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`codigo`, `nome`) VALUES
(1, 'Vans'),
(2, 'Nike'),
(3, 'Adidas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tenis`
--

CREATE TABLE IF NOT EXISTS `tenis` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codcategoria` int(5) NOT NULL,
  `codgenero` int(5) NOT NULL,
  `codmarca` int(5) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `fotochamada` varchar(100) NOT NULL,
  `foto1` varchar(100) NOT NULL,
  `foto2` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codcategoria` (`codcategoria`),
  KEY `codgenero` (`codgenero`),
  KEY `codmarca` (`codmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tenis`
--

INSERT INTO `tenis` (`codigo`, `nome`, `codcategoria`, `codgenero`, `codmarca`, `cor`, `descricao`, `fotochamada`, `foto1`, `foto2`) VALUES
(1, 'TENIS SKATE WAYVEE WHITE GREEN', 1, 3, 1, 'Branco', 'Tênis confortável e estiloso', 'fotos/imgTenis1.png', 'fotos/imgTenis1.1.png', 'fotos/imgTenis1.2.png'),
(2, 'TÃŠNIS ULTRARANGE RAPIDWELD BLACK WHITE', 1, 3, 1, 'Preto', 'Tênis confortável, estiloso e versátil', 'fotos/imgTenis2.png', 'fotos/imgTenis2.1.png', 'fotos/imgTenis2.2.png'),
(3, 'TENIS NIKE SB CHRON 2', 1, 3, 2, 'Preto', 'Tênis estiloso, confortável, versátil, flexí­vel e ventilado', 'fotos/imgTenis3.png', 'fotos/imgTenis3.1.png', 'fotos/imgTenis3.2.png'),
(4, 'TÃŠNIS SLIP-ON BLACK PEWTER CHECKERBOARD', 1, 3, 1, 'Quadriculado - Preto/Cinza', 'Tênis estiloso, confortável e de fácil uso (slip-on)', 'fotos/imgTenis4.png', 'fotos/imgTenis4.1.png', 'fotos/imgTenis4.2.png'),
(5, 'TÃŠNIS NIKE MC TRAINER 2', 2, 2, 2, 'Rosa', 'Tênis confortável, resistente e indicado para corridas', 'fotos/imgTenis5.png', 'fotos/imgTenis5.1.png', 'fotos/imgTenis5.2.png'),
(6, 'TÃŠNIS NIKE PRECISION VI', 2, 1, 2, 'Preto/Branco', 'Tênis confortável, indicado para dia a dia e prática de esportes', 'fotos/imgTenis6.png', 'fotos/imgTenis6.1.png', 'fotos/imgTenis6.2.png'),
(7, 'TÃŠNIS ADIDAS ADI2000', 1, 3, 3, 'Branco', 'Tênis confortável, estiloso, versátil', 'fotos/imgTenis7.png', 'fotos/imgTenis7.1.png', 'fotos/imgTenis7.2.png'),
(8, 'TÃŠNIS GAMECOURT 2.0', 2, 1, 3, 'Preto', 'Tênis confortável, prático e indicado para prática de esportes', 'fotos/imgTenis8.png', 'fotos/imgTenis8.1.png', 'fotos/imgTenis8.2.png'),
(9, 'TÃŠNIS ADIDAS RESPONSE SUPER 3.0', 2, 2, 3, 'Preto/Rosa', 'Tênis confortável, versátil e indicado para prática esportiva', 'fotos/imgTenis9.png', 'fotos/imgTenis9.2.png', 'fotos/imgTenis9.1.png');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `tenis`
--
ALTER TABLE `tenis`
  ADD CONSTRAINT `tenis_ibfk_1` FOREIGN KEY (`codcategoria`) REFERENCES `categorias` (`codigo`),
  ADD CONSTRAINT `tenis_ibfk_2` FOREIGN KEY (`codgenero`) REFERENCES `generos` (`codigo`),
  ADD CONSTRAINT `tenis_ibfk_3` FOREIGN KEY (`codmarca`) REFERENCES `marcas` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
