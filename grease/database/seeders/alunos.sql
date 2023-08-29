-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Ago-2023 às 19:36
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
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `aluno_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`aluno_id`, `nome`, `status`) VALUES
(1, 'Adriel Bueno', 1),
(4, 'Alana Aparecida', 1),
(5, 'Andressa Emilia', 1),
(6, 'Arthur Fumani', 1),
(7, 'Bernardo Oliveira', 1),
(8, 'Caio Lima', 1),
(9, 'Caio Victor', 1),
(10, 'Carla Fernanda', 1),
(11, 'Cristhian da Silva', 1),
(12, 'Eduardo da Silva', 1),
(13, 'Francielly Santos', 1),
(14, 'Geovani de Andrade', 1),
(15, 'Guilherme de Olveira', 1),
(16, 'Guilherme Dias', 1),
(17, 'Guilherme dos Santos', 1),
(18, 'Guilherme Pacheco', 1),
(19, 'Guilherme Palhares', 1),
(20, 'Gustavo Henrique', 1),
(21, 'Gustavo Martins', 1),
(22, 'Hendryl Rodrigues', 1),
(23, 'Henrique da Silva', 1),
(24, 'João Victor', 1),
(25, 'Jozué Wesley', 1),
(26, 'Julia Vitoria', 1),
(27, 'kethelin Vitória', 1),
(28, 'Livia Toledo', 1),
(29, 'Maria Vitoria', 1),
(30, 'Matheus Martins', 1),
(31, 'Matheus Cunha', 1),
(32, 'Milena de Freitas', 1),
(33, 'Nayla Assis', 1),
(34, 'Paulo Vitor', 1),
(35, 'Pedro Andrelino', 1),
(36, 'Pedro Gonçalves', 1),
(37, 'pedro henrique', 1),
(38, 'Raquel Lima', 1),
(39, 'Samuel Santana', 1),
(40, 'Vinicius Passos', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`aluno_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `aluno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
