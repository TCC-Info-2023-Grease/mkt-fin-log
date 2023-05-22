-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Maio-2023 às 20:27
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `caixa_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `categoria` varchar(20) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `data_movimentacao` datetime DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `tipo_movimentacao` varchar(20) DEFAULT NULL,
  `forma_pagamento` varchar(20) DEFAULT NULL,
  `saldo_anterior` decimal(10,2) DEFAULT NULL,
  `saldo_atual` decimal(10,2) DEFAULT NULL,
  `status_caixa` varchar(15) DEFAULT NULL,
  `obs` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `caixa`
--

INSERT INTO `caixa` (`caixa_id`, `usuario_id`, `categoria`, `descricao`, `data_movimentacao`, `valor`, `tipo_movimentacao`, `forma_pagamento`, `saldo_anterior`, `saldo_atual`, `status_caixa`, `obs`) VALUES
(1, 1, 'Money', 'gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', '2023-05-17 00:00:00', '1111.56', 'Fisico', 'PIX', '0.00', '1111.56', 'ok', NULL),
(2, 1, 'Money', 'gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', '2023-05-17 00:00:00', '1111.56', 'Fisico', 'PIX', '0.00', '1111.56', 'ok', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoriasmaterial`
--

CREATE TABLE `categoriasmaterial` (
  `categoria_id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cenarios`
--

CREATE TABLE `cenarios` (
  `cenario_id` int(11) NOT NULL,
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
  `foto_cenario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entradasmaterial`
--

CREATE TABLE `entradasmaterial` (
  `entrada_id` int(11) NOT NULL,
  `material_id` int(11) DEFAULT NULL,
  `caixa_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `qtde_compra` int(4) NOT NULL,
  `valor_gasto` int(4) NOT NULL,
  `obs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `figurinos`
--

CREATE TABLE `figurinos` (
  `figurino_id` int(11) NOT NULL,
  `personagem_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `tamanho` varchar(3) NOT NULL,
  `tipo_figurino` varchar(30) NOT NULL,
  `data_cadastro` date NOT NULL,
  `status_figurino` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `fornecedor_id` int(11) NOT NULL,
  `ender` text NOT NULL,
  `nome` char(100) NOT NULL,
  `email` varchar(15) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(16) DEFAULT NULL,
  `descricao` varchar(100) NOT NULL,
  `status_fornecedor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE `materiais` (
  `material_id` int(11) NOT NULL,
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
  `status_material` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidosmateriais`
--

CREATE TABLE `pedidosmateriais` (
  `pedido_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `dada_pedido` date NOT NULL,
  `data_entrega` date NOT NULL,
  `qtde_material` int(11) NOT NULL,
  `status_pedido` varchar(16) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagens`
--

CREATE TABLE `personagens` (
  `personagem_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ator` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL,
  `idade` int(3) NOT NULL,
  `descricao` text NOT NULL,
  `historia` text NOT NULL,
  `habilidades` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `saidasmaterial`
--

CREATE TABLE `saidasmaterial` (
  `saida_id` int(11) NOT NULL,
  `material_id` int(11) DEFAULT NULL,
  `caixa_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `qtde_compra` int(4) NOT NULL,
  `valor_gasto` int(4) NOT NULL,
  `obs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `tipo_usuario` char(3) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(13) DEFAULT NULL,
  `senha` varchar(200) NOT NULL,
  `idade` int(3) NOT NULL,
  `genero` char(1) DEFAULT NULL,
  `celular` varchar(25) DEFAULT NULL,
  `foto_perfil` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `tipo_usuario`, `nome`, `email`, `cpf`, `senha`, `idade`, `genero`, `celular`, `foto_perfil`) VALUES
(1, 'adm', 'ggg', 'master.potato@gmail.com', '31276826893', '46b815f99832cfd9b6160e0749e6ccac', 100000, 'M', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`caixa_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `categoriasmaterial`
--
ALTER TABLE `categoriasmaterial`
  ADD PRIMARY KEY (`categoria_id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `cenarios`
--
ALTER TABLE `cenarios`
  ADD PRIMARY KEY (`cenario_id`),
  ADD KEY `personagem_id` (`personagem_id`);

--
-- Índices para tabela `entradasmaterial`
--
ALTER TABLE `entradasmaterial`
  ADD PRIMARY KEY (`entrada_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `caixa_id` (`caixa_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `figurinos`
--
ALTER TABLE `figurinos`
  ADD PRIMARY KEY (`figurino_id`),
  ADD KEY `personagem_id` (`personagem_id`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`fornecedor_id`);

--
-- Índices para tabela `materiais`
--
ALTER TABLE `materiais`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices para tabela `pedidosmateriais`
--
ALTER TABLE `pedidosmateriais`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `personagens`
--
ALTER TABLE `personagens`
  ADD PRIMARY KEY (`personagem_id`);

--
-- Índices para tabela `saidasmaterial`
--
ALTER TABLE `saidasmaterial`
  ADD PRIMARY KEY (`saida_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `caixa_id` (`caixa_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `caixa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `categoriasmaterial`
--
ALTER TABLE `categoriasmaterial`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cenarios`
--
ALTER TABLE `cenarios`
  MODIFY `cenario_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `entradasmaterial`
--
ALTER TABLE `entradasmaterial`
  MODIFY `entrada_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `figurinos`
--
ALTER TABLE `figurinos`
  MODIFY `figurino_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `materiais`
--
ALTER TABLE `materiais`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidosmateriais`
--
ALTER TABLE `pedidosmateriais`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personagens`
--
ALTER TABLE `personagens`
  MODIFY `personagem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `saidasmaterial`
--
ALTER TABLE `saidasmaterial`
  MODIFY `saida_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
