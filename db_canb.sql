-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/10/2023 às 20:28
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_canb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cards`
--

CREATE TABLE `tb_cards` (
  `id_card` int(255) NOT NULL,
  `nm_card` varchar(255) NOT NULL,
  `ds_card` text NOT NULL,
  `id_kanban` int(255) NOT NULL,
  `ds_status` enum('fazer','fazendo','feito') NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_frame` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cards`
--

INSERT INTO `tb_cards` (`id_card`, `nm_card`, `ds_card`, `id_kanban`, `ds_status`, `id_user`, `id_frame`) VALUES
(1, '1', 'Pesquisa de Fund. Sistemas de Infomação', 1, 'fazer', 1, 1),
(2, '2', 'Curso de Js', 1, 'fazendo', 1, 1),
(3, '3', 'Prova de Desevolvimento Web', 1, 'feito', 1, 1),
(4, '4', 'Trabalho prático de programação orientada a objetos', 1, 'fazendo', 1, 1),
(5, '5', 'Finalizar o código', 2, 'feito', 1, 2),
(6, '6', 'Revisar e corrigir erros', 2, 'fazendo', 1, 2),
(7, '7', 'Postar no GitHub', 2, 'fazer', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_frames`
--

CREATE TABLE `tb_frames` (
  `id_frame` int(255) NOT NULL,
  `nm_frame` varchar(255) NOT NULL,
  `id_user` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_frames`
--

INSERT INTO `tb_frames` (`id_frame`, `nm_frame`, `id_user`) VALUES
(1, 'Faculdade', 1),
(2, 'Projeto CanB', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(255) NOT NULL,
  `ds_email` varchar(255) NOT NULL,
  `ds_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `ds_email`, `ds_password`) VALUES
(1, 'larissawerneck8@gmail.com', '25d55ad283aa400af464c76d713c07ad');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_cards`
--
ALTER TABLE `tb_cards`
  ADD PRIMARY KEY (`id_card`);

--
-- Índices de tabela `tb_frames`
--
ALTER TABLE `tb_frames`
  ADD PRIMARY KEY (`id_frame`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_cards`
--
ALTER TABLE `tb_cards`
  MODIFY `id_card` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_frames`
--
ALTER TABLE `tb_frames`
  MODIFY `id_frame` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
