-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2026 at 10:12 AM
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
-- Table structure for table `permission_group`
--

CREATE TABLE `permission_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) NOT NULL,
  `is_active` int(11) DEFAULT 0,
  `system` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `permission_group`
--

INSERT INTO `permission_group` (`id`, `name`, `short_code`, `is_active`, `system`, `created_at`) VALUES
(1, 'Student Information', 'student_information', 1, 1, '2019-03-15 09:30:22'),
(2, 'Fees Collection', 'fees_collection', 1, 0, '2026-01-28 08:23:07'),
(3, 'Income', 'income', 1, 0, '2025-11-16 06:28:09'),
(4, 'Expense', 'expense', 1, 0, '2025-11-16 06:28:13'),
(5, 'Student Attendance', 'student_attendance', 1, 0, '2025-11-16 06:28:15'),
(6, 'Examination', 'examination', 1, 0, '2025-11-16 06:28:17'),
(7, 'Academics', 'academics', 1, 1, '2018-07-02 07:25:43'),
(8, 'Download Center', 'download_center', 1, 0, '2025-11-16 06:28:19'),
(9, 'Library', 'library', 1, 0, '2025-11-16 06:28:24'),
(10, 'Inventory', 'inventory', 1, 0, '2025-11-16 06:28:26'),
(11, 'Transport', 'transport', 1, 0, '2025-11-16 06:28:28'),
(12, 'Hostel', 'hostel', 1, 0, '2025-11-16 06:28:30'),
(13, 'Communicate', 'communicate', 1, 0, '2025-11-16 06:28:31'),
(14, 'Reports', 'reports', 1, 1, '2018-06-27 03:40:22'),
(15, 'System Settings', 'system_settings', 1, 1, '2018-06-27 03:40:28'),
(16, 'Front CMS', 'front_cms', 1, 0, '2025-11-16 06:28:32'),
(17, 'Front Office', 'front_office', 1, 0, '2025-11-16 06:28:35'),
(18, 'Human Resource', 'human_resource', 1, 1, '2018-06-27 03:41:02'),
(19, 'Homework', 'homework', 1, 0, '2025-11-16 06:28:36'),
(20, 'Certificate', 'certificate', 1, 0, '2025-11-16 06:28:37'),
(21, 'Calendar To Do List', 'calendar_to_do_list', 1, 0, '2025-11-16 06:28:39'),
(22, 'Dashboard and Widgets', 'dashboard_and_widgets', 1, 1, '2018-06-27 03:41:17'),
(23, 'Online Examination', 'online_examination', 1, 0, '2025-11-16 06:28:41'),
(25, 'Chat', 'chat', 1, 0, '2025-11-16 06:28:42'),
(26, 'Multi Class', 'multi_class', 1, 0, '2025-11-16 06:28:46'),
(27, 'Online Admission', 'online_admission', 1, 0, '2025-11-16 06:28:48'),
(28, 'Alumni', 'alumni', 1, 0, '2025-11-16 06:28:50'),
(29, 'Lesson Plan', 'lesson_plan', 1, 0, '2025-11-16 06:28:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission_group`
--
ALTER TABLE `permission_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission_group`
--
ALTER TABLE `permission_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
