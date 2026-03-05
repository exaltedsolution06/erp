-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 08:42 AM
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
-- Table structure for table `permission_student`
--

CREATE TABLE `permission_student` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) NOT NULL,
  `system` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `permission_student`
--

INSERT INTO `permission_student` (`id`, `name`, `short_code`, `system`, `student`, `parent`, `group_id`, `created_at`) VALUES
(1, 'Fees', 'fees', 0, 1, 1, 2, '2026-01-30 11:23:52'),
(2, 'Class Timetable', 'class_timetable', 1, 1, 1, 7, '2020-05-30 19:57:50'),
(3, 'Homework', 'homework', 0, 1, 1, 19, '2025-11-16 06:28:36'),
(4, 'Download Center', 'download_center', 0, 1, 1, 8, '2025-11-16 06:28:19'),
(5, 'Attendance', 'attendance', 0, 1, 1, 5, '2025-11-16 06:28:15'),
(7, 'Examinations', 'examinations', 0, 1, 1, 6, '2025-11-16 06:28:17'),
(8, 'Notice Board', 'notice_board', 0, 1, 1, 13, '2025-11-16 06:28:31'),
(11, 'Library', 'library', 0, 1, 1, 9, '2025-11-16 06:28:24'),
(12, 'Transport Routes', 'transport_routes', 0, 1, 1, 11, '2026-02-06 06:02:29'),
(13, 'Hostel Rooms', 'hostel_rooms', 0, 1, 0, 12, '2026-02-18 05:34:41'),
(14, 'Calendar To Do List', 'calendar_to_do_list', 0, 1, 1, 21, '2025-11-16 06:28:39'),
(15, 'Online Examination', 'online_examination', 0, 1, 1, 23, '2025-11-16 06:28:41'),
(16, 'Teachers Rating', 'teachers_rating', 0, 1, 1, 0, '2026-02-18 05:34:49'),
(17, 'Chat', 'chat', 0, 1, 1, 25, '2025-11-16 06:28:42'),
(18, 'Multi Class', 'multi_class', 1, 1, 1, 26, '2025-11-16 06:28:46'),
(19, 'Lesson Plan', 'lesson_plan', 0, 1, 1, 29, '2025-11-16 06:28:52'),
(20, 'Syllabus Status', 'syllabus_status', 0, 1, 1, 29, '2025-11-16 06:28:52'),
(23, 'Apply Leave', 'apply_leave', 0, 1, 1, 0, '2026-02-18 05:34:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission_student`
--
ALTER TABLE `permission_student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission_student`
--
ALTER TABLE `permission_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
