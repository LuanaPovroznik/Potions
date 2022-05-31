-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jun-2022 às 00:58
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `potions`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(5) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `login` varchar(60) NOT NULL,
  `password` varchar(120) NOT NULL,
  `cpf` varchar(25) NOT NULL,
  `avatar` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `login`, `password`, `cpf`, `avatar`) VALUES
(1, 'batata', 'luana', '202cb962ac59075b964b07152d234b70', '031.146.540-45', 'batata.'),
(2, 'batata', 'teste', '202cb962ac59075b964b07152d234b70', '031.146.540-45', 'batata.png'),
(3, 'batata', 'polenta', '202cb962ac59075b964b07152d234b70', '031.146.540-45', 'batata.png'),
(4, 'luana', 'luana.povroznik', '202cb962ac59075b964b07152d234b70', '031.146.540-45', 'luana.png'),
(5, 'chuinquinha', 'guilherminho', '202cb962ac59075b964b07152d234b70', '031.146.540-45', 'chuinquinha.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(5) NOT NULL,
  `isAdm` int(1) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `cpf` varchar(25) NOT NULL,
  `login` varchar(60) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `isAdm`, `nome`, `cpf`, `login`, `password`) VALUES
(1, 1, 'Luana', '80341811025', 'luana.povroznik', '202cb962ac59075b964b07152d234b70'),
(2, 1, 'luana', '803.418.110-25', 'luana', '202cb962ac59075b964b07152d234b70'),
(3, 1, 'luana', '803.418.110-25', 'luana', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `potion`
--

CREATE TABLE `potion` (
  `id` int(5) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `preco` varchar(20) NOT NULL,
  `tipo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `potion`
--

INSERT INTO `potion` (`id`, `nome`, `preco`, `tipo`) VALUES
(1, 'Sucy Speciality', '200.00', 1),
(2, 'Orc errante', '100.00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(5) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `efeito` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id`, `nome`, `efeito`) VALUES
(1, 'Health Potion', 'A consumable item that heals a large amount of HP.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(5) NOT NULL,
  `data` date NOT NULL,
  `total` varchar(20) NOT NULL,
  `produto` int(5) NOT NULL,
  `cliente` int(5) NOT NULL,
  `pagamento` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id`, `data`, `total`, `produto`, `cliente`, `pagamento`) VALUES
(6, '2031-05-22', '200.00', 1, 1, 'boleto'),
(7, '2031-05-22', '100.00', 2, 1, 'boleto'),
(8, '2031-05-22', '200.00', 1, 1, 'cartao'),
(9, '2031-05-22', '100.00', 2, 3, 'cartao'),
(10, '2031-05-22', '200.00', 1, 3, 'boleto'),
(11, '2031-05-22', '200.00', 1, 4, 'boleto'),
(12, '2031-05-22', '100.00', 2, 4, 'cartao'),
(13, '2031-05-22', '200.00', 1, 4, 'cartao'),
(14, '2031-05-22', '100.00', 2, 5, 'boleto');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `potion`
--
ALTER TABLE `potion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo` (`tipo`);

--
-- Índices para tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `produto` (`produto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `potion`
--
ALTER TABLE `potion`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `potion`
--
ALTER TABLE `potion`
  ADD CONSTRAINT `potion_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`);

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `venda_ibfk_3` FOREIGN KEY (`produto`) REFERENCES `potion` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
