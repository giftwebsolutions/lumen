-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 28 Lip 2021, 17:51
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
-- Struktura tabeli dla tabeli `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(190) NOT NULL,
  `role` enum('admin','worker','user') NOT NULL DEFAULT 'user',
  `pass` varchar(100) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `api_token` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `token` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Tabela Truncate przed wstawieniem `users`
--

TRUNCATE TABLE `users`;
--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `pass`, `active`, `api_token`, `created_at`, `updated_at`) VALUES
(17, 'Admin', 'admin@woo.xx', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'token666', '2021-07-28 15:24:34', '2021-07-28 15:24:34'),
(18, 'Worker', 'worker@woo.xx', 'worker', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'token123', '2021-07-28 15:24:34', '2021-07-28 15:37:49'),
(19, 'User', 'user@woo.xx', 'user', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'token321', '2021-07-28 15:24:34', '2021-07-28 15:24:34');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
