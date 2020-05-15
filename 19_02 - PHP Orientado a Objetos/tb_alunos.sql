-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 18-Fev-2020 às 21:33
-- Versão do servidor: 10.2.22-MariaDB
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aula02`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_alunos`
--

CREATE TABLE `tb_alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `curso` varchar(80) CHARACTER SET utf16 NOT NULL,
  `turma` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_alunos`
--

INSERT INTO `tb_alunos` (`id`, `nome`, `curso`, `turma`) VALUES
(1, 'MARIA EDUARDA DA SILVA', 'INFORMÁTICA - EMI', 'INFO18'),
(11, 'ANA PAULA GOMES SILVA', 'TÉCNICO EM MEIO AMBIENTE', 'MAMB20'),
(12, 'RENATO ALBERTO TELLES GOMES', 'INFORMÁTICA-EMI', 'INFO18'),
(13, 'DANIEL DA SILVA SOUZA JR', 'MECÂNICA - EMI', 'MEC15'),
(14, 'WELLINGTON DIAS ARAUJO E SILVA', 'MECÂNICA - EMI', 'MEC17'),
(15, 'MARCOS AURÉLIO', 'INFORMÁTICA - EMI', 'INFO14'),
(28, 'FABIO GILBERTO', 'TADS', 'TADS15'),
(29, 'NATÁLIA BIA DE OLIVEIRA', 'TÉCNICO EM MECÂCICA', 'MEC19'),
(30, 'PÉRICLES RODRIGO SILVEIRA', 'LICENCIATURA EM CIÊNCIAS SOCIAIS', 'CS18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alunos`
--
ALTER TABLE `tb_alunos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alunos`
--
ALTER TABLE `tb_alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
