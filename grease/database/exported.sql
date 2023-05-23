-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Maio-2023 às 08:07
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_tcc`
--
CREATE DATABASE IF NOT EXISTS `db_tcc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_tcc`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--
-- Criação: 10-Maio-2023 às 02:02
--

CREATE TABLE IF NOT EXISTS `caixa` (
  `caixa_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `categoria` varchar(20) DEFAULT NULL,
  `descricao` varchar(100) NOT NULL,
  `data_movimentacao` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `tipo_movimentacao` int(11) NOT NULL,
  `forma_pagamento` varchar(20) NOT NULL,
  `saldo_anterior` decimal(10,2) NOT NULL,
  `saldo_atual` decimal(10,2) NOT NULL,
  `status_caixa` varchar(15) NOT NULL,
  `obs` text NOT NULL,
  PRIMARY KEY (`caixa_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `caixa`:
--   `usuario_id`
--       `usuarios` -> `usuario_id`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoriasmaterial`
--
-- Criação: 10-Maio-2023 às 02:02
-- Última actualização: 10-Maio-2023 às 03:45
--

CREATE TABLE IF NOT EXISTS `categoriasmaterial` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`categoria_id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `categoriasmaterial`:
--

--
-- Extraindo dados da tabela `categoriasmaterial`
--

INSERT INTO `categoriasmaterial` (`categoria_id`, `nome`) VALUES
(3, 'Figurino'),
(1, 'Pintura '),
(4, 'Tintas'),
(2, 'Utensilios');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cenarios`
--
-- Criação: 10-Maio-2023 às 02:02
--

CREATE TABLE IF NOT EXISTS `cenarios` (
  `cenario_id` int(11) NOT NULL AUTO_INCREMENT,
  `personagem_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `localizacao` varchar(100) NOT NULL,
  `data_criacao` date NOT NULL,
  `epoca` varchar(50) NOT NULL,
  `estilo` varchar(50) NOT NULL,
  `iluminacao` varchar(50) NOT NULL,
  `requisitos_tecnicos` varchar(200) DEFAULT NULL,
  `interacao_elenco` varchar(200) DEFAULT NULL,
  `orcamento` decimal(10,2) NOT NULL,
  `status_cenario` varchar(15) DEFAULT NULL,
  `foto_cenario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cenario_id`),
  KEY `personagem_id` (`personagem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `cenarios`:
--   `personagem_id`
--       `personagens` -> `personagem_id`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `entradasmaterial`
--
-- Criação: 10-Maio-2023 às 02:02
--

CREATE TABLE IF NOT EXISTS `entradasmaterial` (
  `entrada_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) DEFAULT NULL,
  `caixa_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `qtde_compra` int(4) NOT NULL,
  `valor_gasto` int(4) NOT NULL,
  `obs` text NOT NULL,
  PRIMARY KEY (`entrada_id`),
  KEY `material_id` (`material_id`),
  KEY `caixa_id` (`caixa_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `entradasmaterial`:
--   `material_id`
--       `materiais` -> `material_id`
--   `caixa_id`
--       `caixa` -> `caixa_id`
--   `usuario_id`
--       `usuarios` -> `usuario_id`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `figurinos`
--
-- Criação: 10-Maio-2023 às 02:02
--

CREATE TABLE IF NOT EXISTS `figurinos` (
  `figurino_id` int(11) NOT NULL AUTO_INCREMENT,
  `personagem_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `tamanho` varchar(3) NOT NULL,
  `tipo_figurino` varchar(30) NOT NULL,
  `data_cadastro` date NOT NULL,
  `status_figurino` varchar(15) NOT NULL,
  PRIMARY KEY (`figurino_id`),
  KEY `personagem_id` (`personagem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `figurinos`:
--   `personagem_id`
--       `personagens` -> `personagem_id`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--
-- Criação: 10-Maio-2023 às 02:02
--

CREATE TABLE IF NOT EXISTS `fornecedores` (
  `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `ender` text NOT NULL,
  `nome` char(100) NOT NULL,
  `email` varchar(15) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(16) DEFAULT NULL,
  `descricao` varchar(100) NOT NULL,
  `status_fornecedor` varchar(45) NOT NULL,
  PRIMARY KEY (`fornecedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `fornecedores`:
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--
-- Criação: 10-Maio-2023 às 02:02
-- Última actualização: 10-Maio-2023 às 05:54
--

CREATE TABLE IF NOT EXISTS `materiais` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `qtde_estimada` int(4) NOT NULL,
  `valor_estimado` decimal(5,2) NOT NULL,
  `valor_gasto` decimal(5,2) NOT NULL,
  `unidade_medida` decimal(2,2) NOT NULL,
  `estoque_minimo` int(4) NOT NULL,
  `estoque_atual` int(4) NOT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `datahora_cadastro` datetime NOT NULL,
  `data_validade` date NOT NULL,
  `foto_material` varchar(50) NOT NULL,
  `status_material` varchar(15) NOT NULL,
  PRIMARY KEY (`material_id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `materiais`:
--   `categoria_id`
--       `categoriasmaterial` -> `categoria_id`
--

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`material_id`, `categoria_id`, `nome`, `descricao`, `qtde_estimada`, `valor_estimado`, `valor_gasto`, `unidade_medida`, `estoque_minimo`, `estoque_atual`, `valor_unitario`, `datahora_cadastro`, `data_validade`, `foto_material`, `status_material`) VALUES
(1, 1, 'Sed non voluptates v', 'A aut et nobis dolor', 60, '0.00', '0.00', '0.00', 96, 30, '0.00', '2023-05-10 07:52:52', '1991-05-27', '', 'Aut nobis verit'),
(2, 2, 'Maxime iure dolore i', 'Accusamus quibusdam ', 83, '0.00', '0.00', '0.00', 93, 79, '0.00', '2023-05-10 07:54:23', '2020-01-14', '', 'Id exercitation');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidosmateriais`
--
-- Criação: 10-Maio-2023 às 02:02
--

CREATE TABLE IF NOT EXISTS `pedidosmateriais` (
  `pedido_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `dada_pedido` date NOT NULL,
  `data_entrega` date NOT NULL,
  `qtde_material` int(11) NOT NULL,
  `status_pedido` varchar(16) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`pedido_id`),
  KEY `material_id` (`material_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `pedidosmateriais`:
--   `material_id`
--       `materiais` -> `material_id`
--   `usuario_id`
--       `usuarios` -> `usuario_id`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagens`
--
-- Criação: 10-Maio-2023 às 02:02
--

CREATE TABLE IF NOT EXISTS `personagens` (
  `personagem_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `ator` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL,
  `idade` int(3) NOT NULL,
  `descricao` text NOT NULL,
  `historia` text NOT NULL,
  `habilidades` text NOT NULL,
  PRIMARY KEY (`personagem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `personagens`:
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `saidasmaterial`
--
-- Criação: 10-Maio-2023 às 02:02
--

CREATE TABLE IF NOT EXISTS `saidasmaterial` (
  `saida_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) DEFAULT NULL,
  `caixa_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `qtde_compra` int(4) NOT NULL,
  `valor_gasto` int(4) NOT NULL,
  `obs` text NOT NULL,
  PRIMARY KEY (`saida_id`),
  KEY `material_id` (`material_id`),
  KEY `caixa_id` (`caixa_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `saidasmaterial`:
--   `material_id`
--       `materiais` -> `material_id`
--   `caixa_id`
--       `caixa` -> `caixa_id`
--   `usuario_id`
--       `usuarios` -> `usuario_id`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--
-- Criação: 10-Maio-2023 às 02:02
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` char(3) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(13) DEFAULT NULL,
  `senha` varchar(200) NOT NULL,
  `idade` int(3) NOT NULL,
  `genero` char(1) DEFAULT NULL,
  `celular` varchar(25) DEFAULT NULL,
  `foto_perfil` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `usuarios`:
--

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `caixa`
--
ALTER TABLE `caixa`
  ADD CONSTRAINT `caixa_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Limitadores para a tabela `cenarios`
--
ALTER TABLE `cenarios`
  ADD CONSTRAINT `cenarios_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `personagens` (`personagem_id`);

--
-- Limitadores para a tabela `entradasmaterial`
--
ALTER TABLE `entradasmaterial`
  ADD CONSTRAINT `entradasmaterial_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `materiais` (`material_id`),
  ADD CONSTRAINT `entradasmaterial_ibfk_2` FOREIGN KEY (`caixa_id`) REFERENCES `caixa` (`caixa_id`),
  ADD CONSTRAINT `entradasmaterial_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Limitadores para a tabela `figurinos`
--
ALTER TABLE `figurinos`
  ADD CONSTRAINT `figurinos_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `personagens` (`personagem_id`);

--
-- Limitadores para a tabela `materiais`
--
ALTER TABLE `materiais`
  ADD CONSTRAINT `materiais_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoriasmaterial` (`categoria_id`);

--
-- Limitadores para a tabela `pedidosmateriais`
--
ALTER TABLE `pedidosmateriais`
  ADD CONSTRAINT `pedidosmateriais_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `materiais` (`material_id`),
  ADD CONSTRAINT `pedidosmateriais_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Limitadores para a tabela `saidasmaterial`
--
ALTER TABLE `saidasmaterial`
  ADD CONSTRAINT `saidasmaterial_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `materiais` (`material_id`),
  ADD CONSTRAINT `saidasmaterial_ibfk_2` FOREIGN KEY (`caixa_id`) REFERENCES `caixa` (`caixa_id`),
  ADD CONSTRAINT `saidasmaterial_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
