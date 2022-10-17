-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.22-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para db_sistema_datatable
CREATE DATABASE IF NOT EXISTS `db_sistema_datatable` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_sistema_datatable`;

-- Copiando estrutura para tabela db_sistema_datatable.tb_aluno
CREATE TABLE IF NOT EXISTS `tb_aluno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `periodo` varchar(50) NOT NULL,
  `ativo` bit(1) NOT NULL DEFAULT b'1',
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela db_sistema_datatable.tb_aluno: ~2 rows (aproximadamente)
INSERT INTO `tb_aluno` (`id`, `nome`, `curso`, `periodo`, `ativo`, `data_cadastro`) VALUES
	(1, 'Thiago', 'Técnico em Informática', 'NOite', b'1', '2022-09-30 22:29:01'),
	(2, 'Thiago', 'Técnico em Informática', 'NOite', b'1', '2022-09-30 22:30:05');

-- Copiando estrutura para tabela db_sistema_datatable.tb_usuarios
CREATE TABLE IF NOT EXISTS `tb_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `cpf` char(11) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `ativo` bit(1) NOT NULL DEFAULT b'1',
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela db_sistema_datatable.tb_usuarios: ~0 rows (aproximadamente)
INSERT INTO `tb_usuarios` (`id`, `nome`, `email`, `telefone`, `cpf`, `senha`, `ativo`, `data_cadastro`) VALUES
	(7, 'Thiago', 'tmb85@hotmail.com', '19818199898', '18189189189', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', b'1', '2022-10-10 22:28:55');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
