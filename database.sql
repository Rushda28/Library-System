-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2026 at 05:20 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--
CREATE DATABASE IF NOT EXISTS `library_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `library_db`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isbn` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `category`, `status`, `created_at`, `image_url`) VALUES
(4, 'new', 'test', 'ISBN-14', 'BUSINESS', 'available', '2026-02-13 13:41:57', 'https://images.unsplash.com/photo-1541963463532-d68292c34b19?q=80&w=1000&auto=format&fit=crop'),
(6, 'TEST', 'TEST', 'ISBN - 13', 'FINE ARTS', 'available', '2026-02-14 10:32:46', 'https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?q=80&w=1000&auto=format&fit=crop'),
(7, 'Test2', 'Scott', 'ISBN-14', 'Fine Arts', 'available', '2026-02-21 06:31:01', 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1000&auto=format&fit=crop'),
(12, 'tqrytq', 'saljs', '12', 'Fine Arts', 'available', '2026-02-22 12:14:08', 'https://images.unsplash.com/photo-1541963463532-d68292c34b19?q=80&w=1000&auto=format&fit=crop'),
(16, 'Test', 'tesr123', '123', 'Fine Arts', 'available', '2026-02-25 18:14:32', NULL),
(10, 'Adsa', '21321', '121', 'Architecture', 'available', '2026-02-22 12:07:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiries`
--

DROP TABLE IF EXISTS `contact_inquiries`;
CREATE TABLE IF NOT EXISTS `contact_inquiries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_inquiries`
--

INSERT INTO `contact_inquiries` (`id`, `full_name`, `email`, `message`, `submitted_at`) VALUES
(1, 'Sana', 'sana@gmail.com', 'Test', '2026-02-21 05:12:35'),
(2, 'Sana', 'sana@gmail.com', 'Test', '2026-02-21 05:12:58'),
(3, 'Anne', 'anab@gmail.com', 'Test', '2026-02-21 12:07:47'),
(4, 'Anne', 'anab@gmail.com', 'Test', '2026-02-22 17:47:59'),
(5, 'sakjlka', 'sajoajo@gmai.com', 'asa', '2026-02-25 10:33:12'),
(6, 'test', 'team@pandyas.lk', 'team', '2026-02-25 16:26:46'),
(7, 'test', 'team@pandyas.lk', 'test', '2026-02-25 16:56:32'),
(8, 'test', 'team@pandyas.lk', 'Team', '2026-02-25 17:16:51'),
(9, 'Tesr', 'Test@gmail.com', 'Tesr', '2026-02-25 18:09:46'),
(10, 'Test ', 'Test@gmail.com', 'test', '2026-02-25 18:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `major` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile_pic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `major`, `profile_pic`, `updated_at`) VALUES
(3, 4, 'Shalindri', 'uyanage', 'it', '', '2026-02-14 10:29:41'),
(4, 7, 'Sana', 'Ash', '', '', '2026-02-18 10:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `book_id` int DEFAULT NULL,
  `reserved_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `book_id`, `reserved_at`, `status`) VALUES
(1, 1, 4, '2026-02-13 13:46:39', 'pending'),
(2, 1, 3, '2026-02-13 13:47:17', 'pending'),
(3, 1, 1, '2026-02-13 13:47:37', 'pending'),
(8, 1, 5, '2026-02-13 14:09:25', 'pending'),
(9, 4, 4, '2026-02-14 10:31:48', 'pending'),
(10, 3, 6, '2026-02-14 10:33:16', 'pending'),
(11, 5, 4, '2026-02-16 04:24:04', 'pending'),
(12, 5, 6, '2026-02-16 04:48:14', 'pending'),
(13, 5, 6, '2026-02-16 05:22:08', 'pending'),
(14, 3, 6, '2026-02-16 08:33:04', 'pending'),
(15, 3, 4, '2026-02-16 08:51:37', 'returned'),
(16, 3, 3, '2026-02-16 09:14:18', 'returned'),
(17, 0, 4, '2026-02-16 11:02:59', 'pending'),
(18, 0, 6, '2026-02-16 11:16:23', 'pending'),
(19, 0, 6, '2026-02-16 11:17:37', 'pending'),
(20, 0, 4, '2026-02-16 11:19:29', 'pending'),
(21, 7, 4, '2026-02-18 10:16:34', 'returned'),
(22, 7, 6, '2026-02-18 10:28:51', 'returned'),
(23, 7, 3, '2026-02-18 10:30:22', 'issued'),
(24, 7, 3, '2026-02-18 10:34:56', 'returned'),
(25, 0, 6, '2026-02-18 10:48:41', 'pending'),
(26, 7, 4, '2026-02-18 11:02:57', 'returned'),
(27, 0, 4, '2026-02-18 11:32:09', 'pending'),
(28, 0, 3, '2026-02-18 11:33:56', 'pending'),
(29, 8, 6, '2026-02-21 04:43:14', 'pending'),
(30, 8, 3, '2026-02-21 04:44:08', 'pending'),
(31, 0, 6, '2026-02-21 06:55:28', 'pending'),
(32, 0, 6, '2026-02-21 06:55:35', 'pending'),
(33, 7, 6, '2026-02-21 06:56:24', 'returned'),
(34, 7, 8, '2026-02-21 07:03:31', 'returned'),
(35, 0, 4, '2026-02-21 12:07:11', 'pending'),
(36, 0, 6, '2026-02-21 12:39:36', 'pending'),
(37, 0, 3, '2026-02-22 06:06:31', 'pending'),
(38, 7, 8, '2026-02-22 06:08:19', 'issued'),
(39, 0, 6, '2026-02-22 17:12:44', 'pending'),
(40, 0, 12, '2026-02-24 03:28:17', 'pending'),
(41, 0, 7, '2026-02-25 10:33:23', 'pending'),
(42, 7, 12, '2026-02-25 16:28:39', 'returned'),
(43, 7, 7, '2026-02-25 16:58:22', 'pending'),
(44, 7, 12, '2026-02-25 17:18:36', 'returned'),
(45, 7, 12, '2026-02-25 18:12:54', 'pending'),
(46, 7, 12, '2026-02-25 18:54:09', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `student_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'student',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_id` (`student_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `student_id`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'amasha', '2003', 'amasha12@institute.edu', '$2y$10$Naea1giIJAM5jMEQZJ/npOMscCGkABKTAbhSC5ZaSDfIpbWXONg1W', 'student', '2026-02-13 12:50:29'),
(3, 'System Administrator', 'ADMIN001', 'amasha@institute.edu', '$2y$10$L4tKmj801bMGYPJkbXd4JuZ1g21E9Bpo0dCTHLkBo33mRuy6mLJKC', 'admin', '2026-02-14 09:12:36'),
(4, 'shalinri', '2003am', 'shali@gmail.com', '$2y$10$v.bfAqAcquKd/9Wce/graeYOYmjKyxeh/Ci/Z1x3SUnkIu6bHcKH6', 'student', '2026-02-14 09:57:39'),
(5, 'Rushda', '9802', 'rushdaramzin@gmail.com', '$2y$10$cDnes1LljsurcTMPIUlIy.P/AnkbT/CN0QpMPxkdgAhbDSOohY0qm', 'student', '2026-02-16 04:22:57'),
(6, 'Ana', 'ESSL-2026-02', 'ana@gmail.com', '$2y$10$b8VT4hT1e2VWWiAuUk1Q7Ou1/oUCtnGV2LRAJH6U3sFB2rOaacaLq', 'student', '2026-02-18 10:13:09'),
(7, 'Sana', 'sana', 'sana@gmail.com', '$2y$10$GrDeR1PEoZNdYsig.jvXa.zOwPVbTBI5uPxyQ4/Dn4pEAPiieqvXa', 'student', '2026-02-18 10:15:52'),
(8, 'Anne', 'Anne12', 'Anne@gmail.com', '$2y$10$RsO6qsVH2VwbQip.SViyGuA9lscSwubQskGdw.vjTJTePCqhEwthe', 'student', '2026-02-21 04:42:40');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
