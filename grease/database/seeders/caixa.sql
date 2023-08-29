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
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `caixa_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `aluno_id` int(11) NOT NULL,
  `categoria` varchar(20) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `data_movimentacao` datetime DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `tipo_movimentacao` varchar(20) DEFAULT NULL,
  `forma_pagamento` varchar(20) DEFAULT NULL,
  `status_caixa` varchar(15) DEFAULT NULL,
  `obs` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `caixa`
--

INSERT INTO `caixa` (`caixa_id`, `usuario_id`, `aluno_id`, `categoria`, `descricao`, `data_movimentacao`, `valor`, `tipo_movimentacao`, `forma_pagamento`, `status_caixa`, `obs`) VALUES
(1, 1, 1, 'Pagamento aluno', '                    ', '2023-04-03 00:00:00', '20.00', 'Receita', 'Pix', NULL, '                   '),
(2, 1, 4, 'Pagamento aluno', 'Ajuda no Caixa de forma direta ou indireta', '2023-03-15 00:00:00', '40.00', 'Receita', 'Pix', NULL, '40$ de rifa no mes de março'),
(3, 1, 5, 'Pagamento aluno', 'Forma que ajudou', '2023-04-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, '                   10$ rifa'),
(4, 1, 6, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, '                 Tudo de rifa   '),
(5, 1, 7, 'Pagamento aluno', '                    ', '2023-03-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, '           10$ de caixa        '),
(6, 1, 8, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, ' rifa\r\n'),
(7, 1, 10, 'Pagamento aluno', '                    Tudo de rifa', '2023-03-15 00:00:00', '35.00', 'Receita', 'Pix', NULL, '                    Tudo de rifa'),
(8, 1, 11, 'Pagamento aluno', '                    Tudo de rifa', '2023-03-15 00:00:00', '25.00', 'Receita', 'Pix', NULL, '                    Tudo de rifa'),
(9, 1, 12, 'Pagamento aluno', '               Forma que ajudou     ', '2023-03-15 00:00:00', '30.00', 'Receita', 'Pix', NULL, '                    Tudo de rifa'),
(10, 1, 13, 'Pagamento aluno', '                    Tudo de rifa', '2023-03-15 00:00:00', '115.00', 'Receita', 'Pix', NULL, '                    Tudo de rifa'),
(11, 1, 14, 'Pagamento aluno', '                   Ajudou no caixa', '2023-04-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, 'Direto do bolso                    '),
(12, 1, 15, 'Pagamento aluno', '                Forma que ajudou    ', '2023-03-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, '                    10$ do bolso '),
(13, 1, 18, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '75.00', 'Receita', 'Pix', NULL, '          rifa '),
(14, 1, 19, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '15.00', 'Receita', 'Pix', NULL, '  rifa'),
(15, 1, 20, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, '10$ do bolso\r\n                    '),
(16, 1, 21, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, '                20$ do bolso    '),
(17, 1, 22, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '35.00', 'Receita', 'Pix', NULL, '                    tudo rifa'),
(18, 1, 23, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '5.00', 'Receita', 'Pix', NULL, 'bolso'),
(19, 1, 24, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '9.99', 'Receita', 'Pix', NULL, '            do bolso        '),
(20, 1, 25, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, '              10$ do bolso\r\n]'),
(21, 1, 26, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '30.00', 'Receita', 'Pix', NULL, 'tudo rifa                    '),
(22, 1, 27, 'Pagamento aluno', '                  Forma que ajudou  ', '2023-03-15 00:00:00', '5.00', 'Receita', 'Pix', NULL, '              tudo rifa      '),
(23, 1, 28, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '80.00', 'Receita', 'Pix', NULL, 'tudo rifa                    '),
(24, 1, 29, 'Pagamento aluno', '                   Forma que ajudou ', '2023-04-15 00:00:00', '25.00', 'Receita', 'Pix', NULL, 'tudo rifa                    '),
(25, 1, 30, 'Pagamento aluno', '          Forma que ajudou          ', '2023-04-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, 'tudo rifa                    '),
(26, 1, 31, 'Pagamento aluno', '                   Forma que ajudou', '2023-04-15 00:00:00', '30.00', 'Receita', 'Pix', NULL, 'tudo do bolso                    '),
(27, 1, 32, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '5.00', 'Receita', 'Pix', NULL, 'tudo rifa                    '),
(28, 1, 33, 'Pagamento aluno', '      Forma que ajudou              ', '2023-03-15 00:00:00', '75.00', 'Receita', 'Pix', NULL, '                tudo rifa    '),
(29, 1, 34, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, 'tudo rifa                    '),
(30, 1, 35, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, '            tudo do bolso        '),
(31, 1, 36, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, '          tudo do bolso          '),
(32, 1, 37, 'Pagamento aluno', '     Forma que ajudou               ', '2023-04-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, '              20$ do bolso e 30$ de rifa      '),
(33, 1, 38, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, 'tudo de rifa                    '),
(34, 1, 39, 'Pagamento aluno', '            Forma que ajudou        ', '2023-03-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, '                rifa'),
(35, 1, 40, 'Pagamento aluno', '                    Forma que ajudou', '2023-03-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, '                    tudo bolso'),
(36, 1, 4, 'Pagamento aluno', '                  Forma que ajudou  ', '2023-04-15 00:00:00', '30.00', 'Receita', 'Pix', NULL, '                  30$ no mes de abril\r\n  '),
(37, 1, 5, 'Pagamento aluno', '                    Forma que ajudou', '2023-05-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, '            20$ rifa        '),
(38, 1, 6, 'Pagamento aluno', '                    Forma que ajudou', '2023-05-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, '                    Forma que ajudou'),
(39, 1, 7, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, '                    rifa'),
(40, 1, 7, 'Pagamento aluno', '                Forma que ajudou    ', '2023-05-15 00:00:00', '5.00', 'Receita', 'Pix', NULL, '                    rifa'),
(41, 1, 8, 'Pagamento aluno', '                    Forma que ajudou', '2023-05-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(42, 1, 10, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(43, 1, 10, 'Pagamento aluno', '                 Forma que ajudou   ', '2023-05-15 00:00:00', '65.00', 'Receita', 'Pix', NULL, '                    Rifa'),
(44, 1, 11, 'Pagamento aluno', '                    Forma que ajudou', '2023-05-15 00:00:00', '15.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(45, 1, 12, 'Pagamento aluno', '              Forma que ajudou      ', '2023-05-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(46, 1, 13, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '25.00', 'Receita', 'Pix', NULL, '                rifa    '),
(47, 1, 13, 'Pagamento aluno', '                 Forma que ajudou   ', '2023-05-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(48, 1, 14, 'Pagamento aluno', '                    Forma que ajudou', '2023-05-15 00:00:00', '30.00', 'Receita', 'Pix', NULL, 'bolso                    '),
(49, 1, 15, 'Pagamento aluno', '                    Forma que ajudou', '2023-05-15 00:00:00', '20.00', 'Receita', 'Pix', NULL, '                    bolso'),
(50, 1, 18, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '45.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(51, 1, 18, 'Pagamento aluno', '                    Forma que ajudou', '2023-05-15 00:00:00', '5.00', 'Receita', 'Pix', NULL, ' rifa                    '),
(52, 1, 19, 'Pagamento aluno', '                    ', '2023-04-15 00:00:00', '40.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(53, 1, 22, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '25.00', 'Receita', 'Pix', NULL, ' rifa                    '),
(54, 1, 22, 'Pagamento aluno', 'Forma que ajudou                    ', '2023-05-15 00:00:00', '100.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(55, 1, 23, 'Pagamento aluno', 'Forma que ajudou                    ', '2023-04-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, 'bolso                    '),
(56, 1, 25, 'Pagamento aluno', '                   Forma que ajudou ', '2023-05-15 00:00:00', '30.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(57, 1, 27, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(58, 1, 27, 'Pagamento aluno', 'Forma que ajudou                    ', '2023-05-15 00:00:00', '5.00', 'Receita', 'Pix', NULL, '                rifa'),
(59, 1, 29, 'Pagamento aluno', 'Forma que ajudou                    ', '2023-05-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, '                    rifa'),
(60, 1, 30, 'Pagamento aluno', 'Forma que ajudou                    ', '2023-05-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(61, 1, 32, 'Pagamento aluno', 'Forma que ajudou                    ', '2023-04-15 00:00:00', '60.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(62, 1, 33, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '30.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(63, 1, 33, 'Pagamento aluno', 'Forma que ajudou                    ', '2023-03-15 00:00:00', '25.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(64, 1, 35, 'Pagamento aluno', 'Forma que ajudou                    ', '2023-05-15 00:00:00', '40.00', 'Receita', 'Pix', NULL, 'bolso                    '),
(65, 1, 37, 'Pagamento aluno', '                    Forma que ajudou', '2023-05-15 00:00:00', '30.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(66, 1, 38, 'Pagamento aluno', 'Forma que ajudou                    ', '2023-05-15 00:00:00', '30.00', 'Receita', 'Pix', NULL, 'rifa                    '),
(67, 1, 39, 'Pagamento aluno', '                    Forma que ajudou', '2023-04-15 00:00:00', '50.00', 'Receita', 'Pix', NULL, '40$ rifa 10$ bolso                    '),
(68, 1, 39, 'Pagamento aluno', 'Forma que ajudou                    ', '2023-05-15 00:00:00', '10.00', 'Receita', 'Pix', NULL, 'rifa                    ');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`caixa_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `aluno_id` (`aluno_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `caixa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `caixa`
--
ALTER TABLE `caixa`
  ADD CONSTRAINT `caixa_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `caixa_ibfk_2` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`aluno_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
