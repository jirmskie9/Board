-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 01:58 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `board`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `sender` int(5) NOT NULL,
  `receiver` int(5) NOT NULL,
  `msg` varchar(2555) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `sender`, `receiver`, `msg`, `Category`, `dt`) VALUES
(1, 1, 0, 'All chat ni johnrid recent', 'Message', '2025-04-07 01:38:00'),
(2, 1, 0, 'All chat ni johnrid recent', 'Message', '2025-04-07 01:38:00'),
(3, 1, 19, 'chat ni johnrid kay jirmy recent', 'Message', '2025-04-07 01:38:00'),
(4, 19, 0, 'all chat ni jirmy recentt', 'Message', '2025-04-07 01:39:00'),
(5, 19, 1, 'chat ni jirmy kay johnrid recentt', 'Message', '2025-04-07 01:39:00'),
(6, 1, 0, 'c', 'Message', '2025-04-07 01:39:00'),
(7, 1, 0, 'new chat ni johnrid all', 'Message', '2025-04-07 01:39:00'),
(8, 1, 19, 'chat ni johnrid kay jirmy new', 'Message', '2025-04-07 01:40:00'),
(9, 20, 0, 'all kifer ravena', 'Message', '2025-04-07 01:40:00'),
(10, 19, 0, 'all jirmy chat', 'Message', '2025-04-07 01:40:00'),
(11, 1, 0, 'goods na', 'Message', '2025-04-07 01:41:00'),
(12, 1, 0, 'yess', 'Message', '2025-04-07 01:41:00'),
(13, 1, 0, 'clear na', 'Message', '2025-04-07 01:42:00'),
(14, 1, 0, 'wala ga clear haw', 'Message', '2025-04-07 01:43:00'),
(15, 1, 0, 'utna okay na', 'Message', '2025-04-07 13:44:41'),
(16, 1, 20, 'test', 'Message', '2025-04-07 13:44:47'),
(17, 19, 0, 'test', 'Message', '2025-04-07 13:45:13'),
(18, 19, 0, 'test', 'Message', '2025-04-07 13:46:31'),
(19, 1, 0, 'unta okay na', 'Message', '2025-04-07 13:46:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
