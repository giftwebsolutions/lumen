-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 27 Lip 2021, 19:02
-- Wersja serwera: 10.5.10-MariaDB-2
-- Wersja PHP: 7.4.15

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
  `name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(190) NOT NULL,
  `role` enum('admin','worker','user') NOT NULL DEFAULT 'user',
  `pass` varchar(100) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `token` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `user`
--

TRUNCATE TABLE `user`;
--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `role`, `pass`, `active`, `token`) VALUES
(17, 'Admin', '609667f8434ca@woo.xx', 'admin', 'd72ba322b362f42bae0d4f69f59f3996', 1, 'token666'),
(18, 'Worker', '609667f85f2ff@woo.xx', 'worker', '3df45edfe920634b33d4ab0009da634c', 1, 'token123'),
(19, 'User', '609668330964d@woo.xx', 'user', '8a874e22987f99c1d3e35a8d25e54430', 1, 'token321');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
