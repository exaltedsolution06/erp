-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2026 at 03:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u121972512_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `caste_categories`
--

CREATE TABLE `caste_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '0=Inactive, 1=Active, 2=Deleted',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `caste_categories`
--

INSERT INTO `caste_categories` (`id`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GENERAL', 1, '2026-06-22 14:08:49', NULL),
(2, 'OBC', 1, '2026-06-22 14:08:58', NULL),
(3, 'SC/ST', 1, '2026-06-22 14:09:04', NULL),
(4, 'MINORITY', 1, '2026-06-22 14:09:08', NULL),
(5, 'OTHER', 1, '2026-06-22 14:09:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caste_categories`
--
ALTER TABLE `caste_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caste_categories`
--
ALTER TABLE `caste_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
