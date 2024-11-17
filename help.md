CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    phoneNumber VARCHAR(15) NOT NULL,
    emailAddress VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    userCash DECIMAL(10, 2) DEFAULT 0.00
);










-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2024 at 12:34 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `site`
--

-- --------------------------------------------------------

--
-- Table structure for table `mobiles`
--

DROP TABLE IF EXISTS `mobiles`;
CREATE TABLE IF NOT EXISTS `mobiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product` varchar(32) NOT NULL,
  `model` varchar(32) NOT NULL,
  `color` varchar(32) NOT NULL,
  `ram` varchar(32) NOT NULL,
  `price` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mobiles`
--

INSERT INTO `mobiles` (`id`, `product`, `model`, `color`, `ram`, `price`) VALUES
(1, 'Xiaomi', 'Mi 11', 'Blue', '8GB', '700'),
(2, 'Xiaomi', 'Mi 11 Ultra', 'Blue', '12GB', '800'),
(3, 'Apple', 'iPhone 13', 'White', '6GB', '1200');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `mobiles_ids` json NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `mobiles_ids`, `totalPrice`, `status`, `created_at`) VALUES
(1, 1, '[101, 102, 103]', 5000000.00, 'pending', '2024-11-17 12:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userCash` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `emailAddress` (`emailAddress`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `phoneNumber`, `emailAddress`, `username`, `password`, `userCash`) VALUES
(1, 'John', 'Doe', '1234567890', 'john.doe@example.com', 'johndoe', '$2y$10$kjKlUpiT4ipVdcHEtEWmU.vxshOKzwIj6uZEnL8jV.IbVpGoAQbpS', 0.00),
(2, 'test', 'test', '23123123123', 'test@test.com', 'test', '$2y$10$k8JREwpikctiqEtta/39zeEnh1J70D/2Byo0fzVJdy4siDd6aFgl.', 0.00),
(3, 'test2', 'test', '2312312312', 'test2@test.com', 'rr2', '$2y$10$gn5qB4d4k5ea/VcXvE0/0OPgupQNSYV9iERC3gqPi1MqFrEUcKS1.', 0.00),
(4, 'test4', 'test', '2312312312', 'test42@test.com', 'rr4', '$2y$10$Ii22azI9u33uM80J9a.tfOGDAaQSloaDfrYalGUsoh12tRazt0UMu', 0.00),
(5, 'test433', 'test', '2312312312', 'test432@test.com', 'rr43', '$2y$10$ArRX/bw.L6f102JqDn7Gn.iuRITPnuLKTg8EynC2gHD796gRM.BvW', 0.00),
(6, 'test', 'test', '3123423543', 'user@testemail.com', 'testtest', '$2y$10$mXF2CGq1ovuwH4mxHEIqje5MePIdu9jdCsLKeYsCVDMdphG0f.KMW', 0.00),
(9, 'admin', 'admin', '21312312', 'admin@admin.com', 'admin', '$2y$10$CBK3DrbU7zEogyc1ePNQM.P.Tm/B24pku5n2ePb.Ua6x3WqjoIs.6', 0.00),
(10, 'admin', 'admin', '021312312', 'admin3456@admin.com', 'user', '$2y$10$jEJPscU4dLk1v2aEto9M7.5o76diDmXeasfDKBdtLsmrhnOdtQlJ2', 0.00);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
