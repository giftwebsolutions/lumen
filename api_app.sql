-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 08 Maj 2021, 12:43
-- Wersja serwera: 10.3.27-MariaDB-0+deb10u1
-- Wersja PHP: 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `api_app`
--
CREATE DATABASE IF NOT EXISTS `api_app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `api_app`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(190) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `user`
--

TRUNCATE TABLE `user`;
--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `email`, `pass`, `active`) VALUES
(17, '609667f8434ca@woo.xx', 'd72ba322b362f42bae0d4f69f59f3996', 1),
(18, '609667f85f2ff@woo.xx', '3df45edfe920634b33d4ab0009da634c', 1),
(19, '609668330964d@woo.xx', '8a874e22987f99c1d3e35a8d25e54430', 1),
(20, '60966833175ce@woo.xx', 'a3cb4e70fcd14ec0c8d6dd234e948d14', 1),
(21, '60966912eb05d@woo.xx', '6f66e858bfd7e23a60904db390541d86', 1),
(22, '6096691306973@woo.xx', '2c75208a4bbc2ccece6948147ffbf568', 1),
(23, '6096691ce13f7@woo.xx', '7f8c178124f5ac5cbd20f41a80cabe6b', 1),
(24, '6096691cf2f26@woo.xx', 'e61fa098d829c8ed6882f0748bbc6b39', 1),
(25, '60966933b3300@woo.xx', '5805b14cb3a449b72c8687e0aad6bc63', 1),
(26, '60966933bdaf3@woo.xx', 'd8cfff8ea924c2c63c0551b07bd2fbfa', 1),
(27, '6096698b91e7d@woo.xx', '4964f5560f408c0775d8c47ee28fb4a2', 1),
(28, '6096698bb78c5@woo.xx', 'fc02e8baa366f1a3c498b11379dc9d01', 1),
(29, '60966b0f67aea@woo.xx', '92db99cd4b0fffacb8c2f2a82d4fd3ea', 1),
(30, '60966b0f7d412@woo.xx', 'e879ee2859df697e0c2f8335e7fa3c9e', 1),
(31, '60966b3ecc6dc@woo.xx', '5b2e7f8231421d402cf1050a5f265b2d', 1),
(32, '60966b3ed6f9e@woo.xx', '89486aec1b4b85cc0f03b83fa873fcdb', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
