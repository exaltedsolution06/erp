-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2025 at 01:45 PM
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
-- Table structure for table `fee_discounts`
--

CREATE TABLE `fee_discounts` (
  `id` int(10) NOT NULL,
  `student_session_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `fee_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Fee Head, 1=Route Head',
  `fee_type_id` int(10) NOT NULL,
  `month_apr` double(10,2) NOT NULL DEFAULT 0.00,
  `month_may` double(10,2) NOT NULL DEFAULT 0.00,
  `month_jun` double(10,2) NOT NULL DEFAULT 0.00,
  `month_jul` double(10,2) NOT NULL DEFAULT 0.00,
  `month_aug` double(10,2) NOT NULL DEFAULT 0.00,
  `month_sep` double(10,2) NOT NULL DEFAULT 0.00,
  `month_oct` double(10,2) NOT NULL DEFAULT 0.00,
  `month_nov` double(10,2) NOT NULL DEFAULT 0.00,
  `month_dec` double(10,2) NOT NULL DEFAULT 0.00,
  `month_jan` double(10,2) NOT NULL DEFAULT 0.00,
  `month_feb` double(10,2) NOT NULL DEFAULT 0.00,
  `month_mar` double(10,2) NOT NULL DEFAULT 0.00,
  `total` double(10,2) NOT NULL DEFAULT 0.00,
  `remarks` text NOT NULL,
  `created_by` int(10) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fee_discounts`
--
ALTER TABLE `fee_discounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fee_discounts`
--
ALTER TABLE `fee_discounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
