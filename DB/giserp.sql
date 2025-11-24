-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2025 at 06:19 AM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u731855585_giserp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account`, `is_active`, `created_at`, `updated_at`) VALUES
(15, 'Registration Fee', 1, '2025-11-07 10:07:56', '2025-11-07 10:07:56'),
(16, 'Annual Fee', 1, '2025-11-07 10:08:06', '2025-11-07 10:08:06'),
(17, 'Monthly Fee', 1, '2025-11-07 10:08:14', '2025-11-07 10:08:14'),
(18, 'Composite Fee', 1, '2025-11-07 10:08:26', '2025-11-07 10:08:26'),
(19, 'Transport Fees', 1, '2025-11-07 12:18:48', '2025-11-07 12:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `alumni_events`
--

CREATE TABLE `alumni_events` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `event_for` varchar(100) NOT NULL,
  `session_id` int(11) NOT NULL,
  `class_id` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `note` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `event_notification_message` text NOT NULL,
  `show_onwebsite` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alumni_students`
--

CREATE TABLE `alumni_students` (
  `id` int(11) NOT NULL,
  `current_email` varchar(255) NOT NULL,
  `current_phone` varchar(255) NOT NULL,
  `occupation` text NOT NULL,
  `address` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendence_type`
--

CREATE TABLE `attendence_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `key_value` varchar(50) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `attendence_type`
--

INSERT INTO `attendence_type` (`id`, `type`, `key_value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Present', '<b class=\"text text-success\">P</b>', 'yes', '2016-06-23 18:11:37', '0000-00-00'),
(2, 'Late With Excuse', '<b class=\"text text-warning\">E</b>', 'no', '2018-05-29 08:19:48', '0000-00-00'),
(3, 'Late', '<b class=\"text text-warning\">L</b>', 'yes', '2016-06-23 18:12:28', '0000-00-00'),
(4, 'Absent', '<b class=\"text text-danger\">A</b>', 'yes', '2016-10-11 11:35:40', '0000-00-00'),
(5, 'Holiday', 'H', 'yes', '2016-10-11 11:35:01', '0000-00-00'),
(6, 'Half Day', '<b class=\"text text-warning\">F</b>', 'yes', '2016-06-23 18:12:28', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `isbn_no` varchar(100) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `rack_no` varchar(100) NOT NULL,
  `publish` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `perunitcost` float(10,2) DEFAULT NULL,
  `postdate` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `available` varchar(10) DEFAULT 'yes',
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` int(10) UNSIGNED NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `duereturn_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `is_returned` int(11) DEFAULT 0,
  `member_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'userlogin', 0, '2021-01-19 08:10:29'),
(2, 'login', 0, '2021-01-19 08:10:31'),
(3, 'admission', 0, '2021-01-19 04:48:11'),
(4, 'complain', 0, '2021-01-19 04:48:13'),
(5, 'contact_us', 0, '2021-01-19 04:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `is_active`, `created_at`, `updated_at`) VALUES
(22, 'ST', 'no', '2025-04-26 03:40:24', NULL),
(23, 'OBC', 'no', '2025-04-26 08:52:30', NULL),
(25, 'Other', 'no', '2025-04-27 13:39:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `certificate_name` varchar(100) NOT NULL,
  `certificate_text` text NOT NULL,
  `left_header` varchar(100) NOT NULL,
  `center_header` varchar(100) NOT NULL,
  `right_header` varchar(100) NOT NULL,
  `left_footer` varchar(100) NOT NULL,
  `right_footer` varchar(100) NOT NULL,
  `center_footer` varchar(100) NOT NULL,
  `background_image` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `created_for` tinyint(1) NOT NULL COMMENT '1 = staff, 2 = students',
  `status` tinyint(1) NOT NULL,
  `header_height` int(11) NOT NULL,
  `content_height` int(11) NOT NULL,
  `footer_height` int(11) NOT NULL,
  `content_width` int(11) NOT NULL,
  `enable_student_image` tinyint(1) NOT NULL COMMENT '0=no,1=yes',
  `enable_image_height` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `certificate_name`, `certificate_text`, `left_header`, `center_header`, `right_header`, `left_footer`, `right_footer`, `center_footer`, `background_image`, `created_at`, `updated_at`, `created_for`, `status`, `header_height`, `content_height`, `footer_height`, `content_width`, `enable_student_image`, `enable_image_height`) VALUES
(2, 'DOB Certificate', 'This is to Certified that [name] study in Class [class] with Admission No [admission_no] with DOB [dob]. \r\n\r\nThank for Future.', 'Ref. No : ', 'BIRTH CERTIFICATE', 'Date: ', 'Accountant Sign', 'Principal Sign', '', '', '2025-11-22 15:37:29', NULL, 2, 1, 200, 400, 400, 1000, 1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `chat_connections`
--

CREATE TABLE `chat_connections` (
  `id` int(11) NOT NULL,
  `chat_user_one` int(11) NOT NULL,
  `chat_user_two` int(11) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `chat_user_id` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  `is_first` int(11) DEFAULT 0,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `chat_connection_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_users`
--

CREATE TABLE `chat_users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `create_staff_id` int(11) DEFAULT NULL,
  `create_student_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `chat_users`
--

INSERT INTO `chat_users` (`id`, `user_type`, `staff_id`, `student_id`, `create_staff_id`, `create_student_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'staff', 1, NULL, NULL, NULL, 0, '2022-09-17 03:27:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class` varchar(60) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `is_active`, `created_at`, `updated_at`) VALUES
(68, 'Play', 'no', '2025-11-07 10:03:36', NULL),
(69, 'Nur.', 'no', '2025-11-07 10:03:49', NULL),
(70, 'L.K.G.', 'no', '2025-11-07 10:03:57', NULL),
(71, 'U.K.G.', 'no', '2025-11-07 10:04:39', NULL),
(72, '1st', 'no', '2025-11-07 10:04:45', NULL),
(73, '2nd', 'no', '2025-11-07 10:04:50', NULL),
(74, '3rd', 'no', '2025-11-07 10:04:54', NULL),
(75, '4th', 'no', '2025-11-07 10:04:59', NULL),
(76, '5th', 'no', '2025-11-07 10:05:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_sections`
--

CREATE TABLE `class_sections` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `class_sections`
--

INSERT INTO `class_sections` (`id`, `class_id`, `section_id`, `is_active`, `created_at`, `updated_at`) VALUES
(106, 68, 1, 'no', '2025-11-07 10:03:36', NULL),
(107, 68, 24, 'no', '2025-11-07 10:03:36', NULL),
(108, 69, 1, 'no', '2025-11-07 10:03:49', NULL),
(109, 70, 1, 'no', '2025-11-07 10:03:57', NULL),
(110, 71, 1, 'no', '2025-11-07 10:04:39', NULL),
(111, 72, 1, 'no', '2025-11-07 10:04:45', NULL),
(112, 73, 1, 'no', '2025-11-07 10:04:50', NULL),
(113, 74, 1, 'no', '2025-11-07 10:04:54', NULL),
(114, 75, 1, 'no', '2025-11-07 10:04:59', NULL),
(115, 76, 1, 'no', '2025-11-07 10:05:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_teacher`
--

CREATE TABLE `class_teacher` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `class_teacher`
--

INSERT INTO `class_teacher` (`id`, `class_id`, `staff_id`, `section_id`, `session_id`) VALUES
(1, 7, 3, 1, 18),
(2, 9, 4, 1, 18),
(3, 11, 5, 1, 18),
(4, 8, 6, 1, 18),
(5, 10, 7, 1, 18),
(6, 13, 8, 2, 18),
(7, 29, 9, 3, 18),
(8, 29, 9, 4, 18),
(9, 1, 11, 1, 18),
(10, 4, 13, 1, 18),
(11, 6, 28, 1, 18),
(13, 24, 27, 3, 18),
(14, 24, 27, 4, 18),
(15, 2, 26, 1, 18),
(16, 3, 22, 1, 18),
(17, 15, 37, 2, 18),
(18, 32, 46, 1, 30),
(19, 68, 47, 1, 30),
(20, 68, 47, 24, 30),
(21, 69, 49, 1, 30),
(22, 70, 51, 1, 30),
(23, 71, 48, 1, 30),
(24, 72, 48, 1, 30),
(25, 73, 50, 1, 30),
(26, 74, 50, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL,
  `complaint_type` varchar(255) NOT NULL,
  `source` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `action_taken` varchar(200) NOT NULL,
  `assigned` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_type`
--

CREATE TABLE `complaint_type` (
  `id` int(11) NOT NULL,
  `complaint_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `is_public` varchar(10) DEFAULT 'No',
  `class_id` int(11) DEFAULT NULL,
  `cls_sec_id` int(11) NOT NULL,
  `file` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_for`
--

CREATE TABLE `content_for` (
  `id` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coscholasticareas`
--

CREATE TABLE `coscholasticareas` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `exam_type` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coscholasticareas`
--

INSERT INTO `coscholasticareas` (`id`, `name`, `exam_type`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(19, 'Scholastic A', 'basic_system', 'Scholastic A', 0, '2025-11-21 16:26:31', '2025-11-21 16:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `belong_to` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `bs_column` int(11) DEFAULT NULL,
  `validation` int(11) DEFAULT 0,
  `field_values` text DEFAULT NULL,
  `show_table` varchar(100) DEFAULT NULL,
  `visible_on_table` int(11) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `name`, `belong_to`, `type`, `bs_column`, `validation`, `field_values`, `show_table`, `visible_on_table`, `weight`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'CASTE CATEGORY', 'students', 'select', 3, 1, 'OBC , SC/ST , GENERAL , MINORITY', NULL, 1, NULL, 0, '2022-11-02 03:19:59', NULL),
(2, 'PAN Card', 'students', 'input', 12, 0, '', NULL, 0, NULL, 0, '2025-04-26 05:43:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `custom_field_values`
--

CREATE TABLE `custom_field_values` (
  `id` int(11) NOT NULL,
  `belong_table_id` int(11) DEFAULT NULL,
  `custom_field_id` int(11) DEFAULT NULL,
  `field_value` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `custom_field_values`
--

INSERT INTO `custom_field_values` (`id`, `belong_table_id`, `custom_field_id`, `field_value`, `created_at`, `updated_at`) VALUES
(1, 181, 1, 'GENERAL', '2022-11-09 04:24:33', NULL),
(2, 183, 1, 'OBC', '2022-11-10 04:33:13', NULL),
(3, 182, 1, 'OLD STUDENT', '2022-09-23 02:36:03', NULL),
(4, 185, 1, 'OBC', '2022-11-10 07:14:31', NULL),
(5, 184, 1, 'OLD STUDENT', '2022-09-23 02:36:19', NULL),
(6, 186, 1, 'OLD STUDENT', '2022-09-23 02:36:24', NULL),
(7, 188, 1, 'OBC', '2022-11-10 04:38:49', NULL),
(8, 187, 1, 'OLD STUDENT', '2022-09-23 02:36:37', NULL),
(9, 189, 1, 'OLD STUDENT', '2022-09-23 02:36:40', NULL),
(11, 191, 1, 'OLD STUDENT', '2022-09-23 02:40:01', NULL),
(12, 192, 1, 'OBC', '2022-11-10 03:46:39', NULL),
(13, 200, 1, 'OLD STUDENT', '2022-09-23 02:40:18', NULL),
(14, 193, 1, 'OBC', '2022-11-19 05:51:54', NULL),
(15, 194, 1, 'OBC', '2022-11-21 04:07:08', NULL),
(16, 199, 1, 'OBC', '2022-11-21 07:00:43', NULL),
(17, 149, 1, 'OBC', '2022-11-05 04:17:52', NULL),
(18, 146, 1, 'OBC', '2022-11-05 04:19:05', NULL),
(19, 144, 1, 'OBC', '2022-11-05 04:19:27', NULL),
(20, 151, 1, 'OBC', '2022-11-05 04:17:15', NULL),
(21, 152, 1, 'OBC', '2022-11-05 04:18:29', NULL),
(22, 147, 1, 'OBC', '2022-11-05 04:18:47', NULL),
(23, 150, 1, 'OBC', '2022-11-05 04:14:56', NULL),
(24, 142, 1, 'OBC', '2022-11-05 04:17:00', NULL),
(25, 145, 1, 'OBC', '2022-11-05 04:17:35', NULL),
(26, 141, 1, 'OBC', '2022-11-05 04:16:44', NULL),
(27, 108, 1, 'OBC', '2022-11-05 04:38:34', NULL),
(28, 86, 1, 'OBC', '2022-11-05 04:38:55', NULL),
(29, 107, 1, 'OBC', '2022-11-05 04:39:15', NULL),
(30, 109, 1, 'OBC', '2022-11-05 04:40:06', NULL),
(31, 87, 1, 'OBC', '2022-11-05 04:40:29', NULL),
(32, 110, 1, 'OBC', '2022-11-05 04:39:43', NULL),
(33, 157, 1, 'OBC', '2022-11-05 04:50:31', NULL),
(34, 153, 1, 'OBC', '2022-11-05 04:47:41', NULL),
(35, 197, 1, 'OBC', '2022-11-05 04:51:26', NULL),
(36, 154, 1, 'OBC', '2022-11-05 04:49:23', NULL),
(37, 161, 1, 'OBC', '2022-11-05 04:46:07', NULL),
(38, 160, 1, 'OBC', '2022-11-05 04:47:14', NULL),
(39, 162, 1, 'OBC', '2022-11-05 04:45:51', NULL),
(40, 159, 1, 'OBC', '2022-11-05 04:51:01', NULL),
(41, 155, 1, 'OBC', '2022-11-05 04:46:57', NULL),
(42, 196, 1, 'OBC', '2022-11-05 04:48:01', NULL),
(43, 158, 1, 'OBC', '2022-11-05 04:50:14', NULL),
(44, 156, 1, 'OBC', '2022-11-05 04:50:44', NULL),
(45, 77, 1, 'OBC', '2022-11-05 04:59:45', NULL),
(46, 79, 1, 'OBC', '2022-11-05 05:01:19', NULL),
(47, 195, 1, 'OBC', '2022-11-05 05:01:03', NULL),
(48, 82, 1, 'OBC', '2022-11-05 05:02:05', NULL),
(49, 171, 1, 'OBC', '2022-11-02 03:22:11', NULL),
(50, 140, 1, 'OBC', '2022-11-05 05:00:00', NULL),
(51, 83, 1, 'OBC', '2022-11-05 05:02:15', NULL),
(52, 84, 1, 'OBC', '2022-11-05 05:03:52', NULL),
(53, 170, 1, 'OBC', '2022-11-05 05:02:27', NULL),
(54, 163, 1, 'OBC', '2022-11-05 05:01:30', NULL),
(55, 80, 1, 'OBC', '2022-11-05 05:01:46', NULL),
(56, 76, 1, 'OBC', '2022-11-05 04:59:26', NULL),
(57, 78, 1, 'OBC', '2022-11-05 05:00:46', NULL),
(58, 81, 1, 'OBC', '2022-11-05 05:04:05', NULL),
(59, 117, 1, 'OBC', '2022-11-05 05:04:31', NULL),
(60, 125, 1, 'OBC', '2022-11-05 06:11:01', NULL),
(61, 123, 1, 'OBC', '2022-11-05 06:07:52', NULL),
(62, 118, 1, 'OBC', '2022-11-05 06:09:45', NULL),
(63, 126, 1, 'OBC', '2022-11-05 06:06:30', NULL),
(64, 176, 1, 'OBC', '2022-11-05 06:06:16', NULL),
(65, 179, 1, 'OBC', '2022-11-05 06:06:03', NULL),
(66, 121, 1, 'OBC', '2022-11-05 06:08:47', NULL),
(67, 119, 1, 'OBC', '2022-11-05 06:07:21', NULL),
(68, 114, 1, 'OBC', '2022-11-05 06:08:10', NULL),
(69, 122, 1, 'OBC', '2022-11-05 06:08:27', NULL),
(70, 177, 1, 'OBC', '2022-11-05 06:09:27', NULL),
(71, 120, 1, 'GENERAL', '2022-11-05 06:10:42', NULL),
(72, 124, 1, 'OBC', '2022-11-05 06:06:57', NULL),
(73, 178, 1, 'OBC', '2022-11-05 06:03:58', NULL),
(74, 112, 1, 'GENERAL', '2022-11-05 06:05:29', NULL),
(75, 127, 1, 'OBC', '2022-11-05 06:05:04', NULL),
(76, 113, 1, 'OBC', '2022-11-05 06:09:11', NULL),
(77, 111, 1, 'OBC', '2022-11-05 06:11:19', NULL),
(78, 42, 1, 'OBC', '2022-11-05 06:20:49', NULL),
(79, 44, 1, 'OBC', '2022-11-05 06:21:52', NULL),
(80, 48, 1, 'GENERAL', '2022-11-05 06:19:40', NULL),
(81, 37, 1, 'OBC', '2022-11-05 06:19:03', NULL),
(82, 40, 1, 'OBC', '2022-11-05 06:20:10', NULL),
(83, 39, 1, 'OBC', '2022-11-05 06:19:19', NULL),
(84, 51, 1, 'OBC', '2022-11-05 06:24:23', NULL),
(85, 45, 1, 'OBC', '2022-11-05 06:21:36', NULL),
(86, 38, 1, 'OBC', '2022-11-05 06:25:51', NULL),
(87, 52, 1, 'OBC', '2022-11-05 06:25:11', NULL),
(88, 43, 1, 'GENERAL', '2022-11-05 06:22:12', NULL),
(89, 46, 1, 'OBC', '2022-11-05 06:23:14', NULL),
(90, 143, 1, 'OBC', '2022-11-05 06:22:36', NULL),
(91, 36, 1, 'GENERAL', '2022-11-05 06:22:54', NULL),
(92, 47, 1, 'OBC', '2022-11-05 06:24:03', NULL),
(93, 50, 1, 'OBC', '2022-11-05 06:24:43', NULL),
(94, 41, 1, 'OBC', '2022-11-05 06:20:33', NULL),
(95, 139, 1, 'SC/ST', '2022-11-05 06:26:18', NULL),
(96, 198, 1, 'OBC', '2022-11-05 03:49:40', NULL),
(97, 49, 1, 'SC/ST', '2022-11-05 06:25:28', NULL),
(98, 102, 1, 'OBC', '2022-11-05 06:42:11', NULL),
(99, 98, 1, 'OBC', '2022-11-05 06:40:15', NULL),
(100, 99, 1, 'OBC', '2022-11-05 06:40:32', NULL),
(101, 90, 1, 'OBC', '2022-11-05 06:36:34', NULL),
(102, 103, 1, 'OBC', '2022-11-05 06:43:05', NULL),
(103, 101, 1, 'OBC', '2022-11-05 06:42:48', NULL),
(104, 104, 1, 'OBC', '2022-11-05 06:43:24', NULL),
(105, 93, 1, 'OBC', '2022-11-05 06:37:21', NULL),
(106, 92, 1, 'OBC', '2022-11-05 06:37:01', NULL),
(107, 91, 1, 'OBC', '2022-11-05 06:36:06', NULL),
(108, 95, 1, 'OBC', '2022-11-05 06:37:52', NULL),
(109, 88, 1, 'MINORITY', '2022-11-05 06:35:41', NULL),
(110, 94, 1, 'SC/ST', '2022-12-01 04:04:15', NULL),
(111, 97, 1, 'OBC', '2022-11-05 06:38:43', NULL),
(112, 100, 1, 'GENERAL', '2022-11-05 06:41:38', NULL),
(113, 96, 1, 'OBC', '2022-11-05 06:39:48', NULL),
(114, 105, 1, 'OBC', '2022-11-05 06:40:47', NULL),
(115, 89, 1, 'OBC', '2022-11-05 06:43:53', NULL),
(116, 66, 1, 'OBC', '2022-11-05 07:44:28', NULL),
(117, 58, 1, 'OBC', '2022-11-05 07:33:18', NULL),
(118, 74, 1, 'OBC', '2022-11-05 07:45:27', NULL),
(119, 61, 1, 'OBC', '2022-11-05 07:43:34', NULL),
(120, 60, 1, 'OBC', '2022-11-05 07:42:58', NULL),
(121, 68, 1, 'OBC', '2022-11-05 07:48:04', NULL),
(122, 106, 1, 'OBC', '2022-11-05 07:43:18', NULL),
(123, 64, 1, 'OBC', '2022-11-05 07:43:53', NULL),
(124, 85, 1, 'OBC', '2022-11-05 07:44:45', NULL),
(125, 59, 1, 'OBC', '2022-11-05 07:42:43', NULL),
(126, 75, 1, 'OBC', '2022-11-05 07:45:05', NULL),
(127, 72, 1, 'OBC', '2022-11-05 07:45:45', NULL),
(128, 73, 1, 'OBC', '2022-11-05 07:46:25', NULL),
(129, 63, 1, 'OBC', '2022-11-05 07:46:01', NULL),
(130, 65, 1, 'OBC', '2022-11-05 07:47:10', NULL),
(131, 70, 1, 'OBC', '2022-11-05 07:47:37', NULL),
(132, 69, 1, 'OBC', '2022-11-05 07:48:38', NULL),
(133, 56, 1, 'OBC', '2022-11-05 07:48:53', NULL),
(134, 57, 1, 'OBC', '2022-11-05 07:49:23', NULL),
(135, 62, 1, 'OBC', '2022-11-05 07:44:10', NULL),
(136, 71, 1, 'OBC', '2022-11-05 07:49:44', NULL),
(137, 67, 1, 'OBC', '2022-11-05 07:51:40', NULL),
(138, 55, 1, 'OBC', '2022-11-05 07:51:27', NULL),
(139, 53, 1, 'OBC', '2022-11-05 07:50:49', NULL),
(140, 54, 1, 'OBC', '2022-11-05 07:50:26', NULL),
(141, 116, 1, 'OBC', '2022-11-05 07:50:03', NULL),
(142, 137, 1, 'OBC', '2022-11-07 03:49:00', NULL),
(143, 132, 1, 'GENERAL', '2022-11-07 03:49:15', NULL),
(144, 131, 1, 'OBC', '2022-11-07 03:50:44', NULL),
(145, 130, 1, 'OBC', '2022-11-07 03:50:57', NULL),
(146, 128, 1, 'OBC', '2022-11-07 03:51:14', NULL),
(147, 129, 1, 'OBC', '2022-11-07 03:51:30', NULL),
(148, 136, 1, 'OBC', '2022-11-07 03:51:44', NULL),
(149, 134, 1, 'GENERAL', '2022-11-07 03:52:01', NULL),
(150, 135, 1, 'OBC', '2022-11-07 03:52:16', NULL),
(151, 133, 1, 'OBC', '2022-11-07 03:52:34', NULL),
(152, 28, 1, 'OBC', '2022-11-07 04:11:46', NULL),
(153, 22, 1, 'OBC', '2022-11-07 04:10:48', NULL),
(154, 26, 1, 'OBC', '2022-11-07 04:11:25', NULL),
(155, 24, 1, 'OBC', '2022-11-07 04:12:21', NULL),
(156, 27, 1, 'OBC', '2022-11-07 04:12:38', NULL),
(157, 20, 1, 'OBC', '2022-11-07 04:10:15', NULL),
(158, 23, 1, 'OBC', '2022-11-07 04:12:01', NULL),
(159, 25, 1, 'OBC', '2022-11-07 04:12:52', NULL),
(160, 19, 1, 'OBC', '2022-11-07 04:10:33', NULL),
(161, 21, 1, 'OBC', '2022-11-07 04:11:08', NULL),
(162, 174, 1, 'OBC', '2022-11-08 07:09:12', NULL),
(163, 175, 1, 'OBC', '2022-11-07 04:15:57', NULL),
(164, 173, 1, 'OBC', '2022-11-07 04:15:42', NULL),
(165, 168, 1, 'OBC', '2022-11-07 04:44:56', NULL),
(166, 169, 1, 'GENERAL', '2022-11-07 04:46:03', NULL),
(167, 148, 1, 'OBC', '2022-11-07 04:45:43', NULL),
(168, 166, 1, 'OBC', '2022-11-07 04:45:26', NULL),
(169, 167, 1, 'OBC', '2022-11-07 04:46:41', NULL),
(170, 164, 1, 'GENERAL', '2022-11-07 04:46:24', NULL),
(171, 172, 1, 'OBC', '2022-11-07 04:44:41', NULL),
(172, 165, 1, 'OBC', '2022-11-07 04:45:12', NULL),
(173, 201, 1, 'OBC', '2022-11-05 05:04:18', NULL),
(174, 202, 1, 'OBC', '2022-11-05 05:00:32', NULL),
(175, 203, 1, 'OBC', '2022-11-05 05:02:39', NULL),
(176, 204, 1, 'OLD STUDENT', '2022-09-23 04:34:38', NULL),
(177, 205, 1, 'OBC', '2022-11-10 07:32:48', NULL),
(178, 206, 1, 'OLD STUDENT', '2022-09-23 04:49:57', NULL),
(179, 207, 1, 'OBC', '2022-11-10 07:28:37', NULL),
(180, 208, 1, 'OBC', '2022-11-09 04:59:58', NULL),
(181, 209, 1, 'OLD STUDENT', '2022-09-23 05:18:21', NULL),
(182, 210, 1, 'OLD STUDENT', '2022-09-23 05:26:47', NULL),
(183, 211, 1, 'OBC', '2022-11-25 07:19:03', NULL),
(184, 212, 1, 'OBC', '2022-11-25 07:22:01', NULL),
(185, 213, 1, 'OBC', '2022-11-26 04:53:35', NULL),
(186, 214, 1, 'OBC', '2022-11-29 03:58:51', NULL),
(187, 215, 1, 'OLD STUDENT', '2022-09-23 06:31:18', NULL),
(188, 216, 1, 'OBC', '2022-11-05 04:16:00', NULL),
(189, 217, 1, 'OBC', '2022-11-05 04:16:20', NULL),
(190, 218, 1, 'OBC', '2022-11-05 04:15:39', NULL),
(191, 219, 1, 'OBC', '2022-11-05 04:18:10', NULL),
(192, 220, 1, 'OBC', '2022-11-05 04:40:52', NULL),
(193, 221, 1, 'OBC', '2022-11-05 04:41:09', NULL),
(194, 222, 1, 'OBC', '2022-11-05 04:51:41', NULL),
(195, 223, 1, 'OBC', '2022-11-05 04:46:46', NULL),
(196, 224, 1, 'OBC', '2022-11-05 04:46:27', NULL),
(197, 225, 1, 'OBC', '2022-11-05 06:04:23', NULL),
(198, 226, 1, 'OBC', '2022-11-05 06:04:49', NULL),
(199, 227, 1, 'OBC', '2022-11-05 06:07:37', NULL),
(200, 228, 1, 'OBC', '2022-11-05 06:05:44', NULL),
(201, 229, 1, 'OBC', '2022-11-05 06:41:08', NULL),
(202, 230, 1, 'OBC', '2022-11-05 06:10:07', NULL),
(203, 231, 1, 'OLD STUDENT', '2022-10-28 05:12:45', NULL),
(204, 232, 1, 'OBC', '2022-11-09 04:07:44', NULL),
(205, 233, 1, 'OBC', '2023-02-22 05:55:27', NULL),
(206, 234, 1, 'OLD STUDENT', '2022-10-28 05:38:00', NULL),
(207, 235, 1, 'OBC', '2022-11-21 04:01:50', NULL),
(208, 236, 1, 'OBC', '2022-12-02 05:01:55', NULL),
(209, 237, 1, 'OBC', '2023-03-13 05:00:38', NULL),
(210, 238, 1, 'OBC', '2022-11-05 04:14:18', NULL),
(211, 239, 1, 'OBC', '2022-11-05 07:42:00', NULL),
(212, 240, 1, 'GENERAL', '2022-11-07 04:33:20', NULL),
(213, 241, 1, 'OBC', '2022-11-14 03:37:39', NULL),
(214, 242, 1, 'OBC', '2022-11-14 03:48:43', NULL),
(215, 243, 1, 'OBC', '2022-11-14 03:56:34', NULL),
(216, 244, 1, 'OBC', '2022-11-14 04:24:30', NULL),
(217, 245, 1, 'OBC', '2022-11-14 04:31:52', NULL),
(218, 246, 1, 'OBC', '2022-11-14 04:38:57', NULL),
(219, 247, 1, 'OBC', '2022-11-14 05:46:46', NULL),
(220, 248, 1, 'OBC', '2022-11-16 07:56:31', NULL),
(221, 249, 1, 'OBC', '2022-11-16 08:04:38', NULL),
(222, 250, 1, 'OBC', '2022-11-16 08:14:26', NULL),
(223, 251, 1, 'OBC', '2022-11-16 08:21:07', NULL),
(224, 252, 1, 'OBC', '2022-11-16 08:31:12', NULL),
(225, 253, 1, 'OBC', '2022-11-20 14:16:19', NULL),
(226, 254, 1, 'OBC', '2022-11-20 14:19:02', NULL),
(227, 255, 1, 'OBC', '2022-11-20 14:21:59', NULL),
(228, 256, 1, 'OBC', '2022-11-20 14:25:03', NULL),
(229, 257, 1, 'OBC', '2022-11-20 14:27:55', NULL),
(230, 258, 1, 'OBC', '2022-11-20 14:35:32', NULL),
(232, 260, 1, 'OBC', '2022-11-20 14:41:46', NULL),
(233, 261, 1, 'OBC', '2022-11-20 14:44:07', NULL),
(234, 262, 1, 'OBC', '2022-11-20 14:46:07', NULL),
(235, 263, 1, 'OBC', '2022-11-20 14:49:00', NULL),
(236, 264, 1, 'OBC', '2022-11-20 14:52:05', NULL),
(237, 265, 1, 'OBC', '2022-11-20 14:55:36', NULL),
(238, 266, 1, 'OBC', '2022-11-20 14:59:02', NULL),
(239, 267, 1, 'OBC', '2022-11-20 15:11:00', NULL),
(240, 268, 1, 'OBC', '2022-11-22 06:41:32', NULL),
(241, 269, 1, 'GENERAL', '2022-11-22 06:48:11', NULL),
(242, 270, 1, 'SC/ST', '2022-11-22 06:55:56', NULL),
(243, 271, 1, 'OBC', '2022-11-22 07:07:08', NULL),
(244, 272, 1, 'GENERAL', '2022-11-22 07:16:44', NULL),
(245, 273, 1, 'OBC', '2022-11-22 07:25:20', NULL),
(246, 274, 1, 'OBC', '2022-11-22 08:03:56', NULL),
(247, 275, 1, 'SC/ST', '2022-11-22 08:15:34', NULL),
(248, 276, 1, 'OBC', '2022-11-22 08:21:39', NULL),
(249, 277, 1, 'OBC', '2022-11-23 06:06:02', NULL),
(250, 278, 1, 'OBC', '2022-11-23 06:48:55', NULL),
(251, 279, 1, 'OBC', '2022-11-23 07:12:09', NULL),
(252, 280, 1, 'OBC', '2022-11-23 07:41:58', NULL),
(253, 281, 1, 'OBC', '2022-11-23 08:03:01', NULL),
(254, 282, 1, 'OBC', '2022-11-23 08:10:24', NULL),
(255, 283, 1, 'OBC', '2022-11-24 06:49:41', NULL),
(256, 284, 1, 'OBC', '2022-11-24 06:58:32', NULL),
(257, 285, 1, 'OBC', '2022-11-24 07:08:01', NULL),
(258, 286, 1, 'OBC', '2022-11-24 07:14:15', NULL),
(259, 287, 1, 'SC/ST', '2022-12-01 04:03:50', NULL),
(260, 288, 1, 'OBC', '2022-11-30 04:40:39', NULL),
(261, 289, 1, 'OBC', '2022-11-30 04:46:45', NULL),
(262, 290, 1, 'OBC', '2022-11-30 05:05:13', NULL),
(263, 291, 1, 'OBC', '2022-12-01 03:46:06', NULL),
(264, 292, 1, 'GENERAL', '2022-12-01 03:56:08', NULL),
(265, 293, 1, 'OBC', '2022-12-01 04:11:46', NULL),
(266, 294, 1, 'OBC', '2022-12-01 04:17:53', NULL),
(267, 295, 1, 'OBC', '2022-12-07 05:27:29', NULL),
(268, 296, 1, 'OBC', '2022-12-07 06:17:02', NULL),
(269, 297, 1, 'OBC', '2022-12-14 06:00:18', NULL),
(271, 299, 1, 'OBC', '2023-01-05 05:03:48', NULL),
(272, 300, 1, 'OBC', '2023-01-05 05:24:46', NULL),
(273, 301, 1, 'GENERAL', '2023-01-06 04:40:27', NULL),
(274, 302, 1, 'OBC', '2023-01-06 04:46:53', NULL),
(275, 303, 1, 'OBC', '2023-01-06 04:49:51', NULL),
(276, 304, 1, 'OBC', '2023-01-06 04:52:52', NULL),
(277, 305, 1, 'OBC', '2023-01-06 04:58:13', NULL),
(278, 306, 1, 'GENERAL', '2023-01-06 05:05:13', NULL),
(279, 307, 1, 'GENERAL', '2023-01-06 05:09:41', NULL),
(280, 308, 1, 'OBC', '2023-01-06 05:12:56', NULL),
(281, 309, 1, 'OBC', '2023-01-06 05:15:59', NULL),
(282, 310, 1, 'OBC', '2023-01-06 05:19:09', NULL),
(283, 311, 1, 'OBC', '2023-01-06 05:22:32', NULL),
(284, 312, 1, 'OBC', '2023-01-06 05:24:59', NULL),
(285, 313, 1, 'OBC', '2023-01-06 05:32:05', NULL),
(286, 314, 1, 'OBC', '2023-01-06 05:35:18', NULL),
(287, 315, 1, 'OBC', '2023-01-06 05:44:24', NULL),
(288, 316, 1, 'OBC', '2023-01-06 05:47:24', NULL),
(289, 317, 1, 'OBC', '2023-01-06 05:50:46', NULL),
(290, 318, 1, 'OBC', '2023-01-06 05:53:22', NULL),
(291, 319, 1, 'GENERAL', '2023-01-06 05:56:27', NULL),
(292, 320, 1, 'OBC', '2023-01-06 05:59:40', NULL),
(293, 321, 1, 'OBC', '2023-01-06 06:02:33', NULL),
(294, 322, 1, 'OBC', '2023-01-06 06:14:00', NULL),
(295, 323, 1, 'OBC', '2023-01-06 06:17:00', NULL),
(296, 324, 1, 'OBC', '2023-01-06 06:19:10', NULL),
(297, 325, 1, 'OBC', '2023-01-06 06:21:59', NULL),
(298, 326, 1, 'OBC', '2023-01-06 06:24:59', NULL),
(299, 327, 1, 'OBC', '2023-01-06 06:27:33', NULL),
(300, 328, 1, 'OBC', '2023-01-06 06:29:57', NULL),
(301, 329, 1, 'OBC', '2023-01-06 06:32:13', NULL),
(302, 330, 1, 'OBC', '2023-01-06 06:35:45', NULL),
(303, 331, 1, 'OBC', '2023-01-06 06:38:55', NULL),
(304, 332, 1, 'OBC', '2023-01-06 06:42:42', NULL),
(305, 333, 1, 'OBC', '2023-01-06 06:45:19', NULL),
(306, 334, 1, 'OBC', '2023-01-06 06:48:51', NULL),
(307, 335, 1, 'OBC', '2023-01-06 06:59:37', NULL),
(308, 336, 1, 'OBC', '2023-01-06 07:02:35', NULL),
(309, 337, 1, 'OBC', '2023-01-06 07:09:51', NULL),
(310, 338, 1, 'OBC', '2023-01-16 08:44:37', NULL),
(311, 339, 1, 'OBC', '2023-01-26 05:13:08', NULL),
(312, 340, 1, 'OBC', '2023-01-26 05:17:01', NULL),
(313, 341, 1, 'OBC', '2023-01-26 05:23:25', NULL),
(314, 342, 1, 'OBC', '2023-01-26 05:26:11', NULL),
(315, 343, 1, 'OBC', '2023-01-26 05:28:34', NULL),
(316, 344, 1, 'OBC', '2023-01-26 05:31:22', NULL),
(317, 345, 1, 'OBC', '2023-01-26 05:34:35', NULL),
(318, 346, 1, 'OBC', '2023-01-26 05:37:55', NULL),
(319, 347, 1, 'OBC', '2023-01-26 05:40:51', NULL),
(320, 348, 1, 'OBC', '2023-01-26 05:43:17', NULL),
(321, 349, 1, 'OBC', '2023-01-26 05:45:53', NULL),
(322, 350, 1, 'OBC', '2023-01-26 05:48:56', NULL),
(323, 351, 1, 'OBC', '2023-01-26 05:52:06', NULL),
(324, 352, 1, 'OBC', '2023-01-26 05:55:07', NULL),
(325, 353, 1, 'OBC', '2023-01-26 05:57:35', NULL),
(326, 354, 1, 'OBC', '2023-01-26 06:02:02', NULL),
(327, 355, 1, 'GENERAL', '2023-01-26 06:11:34', NULL),
(328, 356, 1, 'GENERAL', '2023-01-26 06:09:45', NULL),
(329, 357, 1, 'MINORITY', '2023-01-26 06:14:57', NULL),
(330, 358, 1, 'OBC', '2023-01-26 06:17:59', NULL),
(331, 359, 1, 'OBC', '2023-01-26 06:22:04', NULL),
(332, 360, 1, 'MINORITY', '2023-01-26 06:24:23', NULL),
(333, 361, 1, 'OBC', '2023-01-26 06:28:14', NULL),
(334, 362, 1, 'OBC', '2023-01-26 06:31:29', NULL),
(335, 363, 1, 'OBC', '2023-01-26 06:34:20', NULL),
(336, 364, 1, 'OBC', '2023-01-26 06:36:31', NULL),
(337, 365, 1, 'OBC', '2023-01-26 06:41:18', NULL),
(338, 366, 1, 'GENERAL', '2023-01-26 06:47:05', NULL),
(339, 367, 1, 'OBC', '2023-01-26 06:50:07', NULL),
(340, 368, 1, 'OBC', '2023-01-26 06:53:47', NULL),
(341, 369, 1, 'GENERAL', '2023-01-26 06:56:16', NULL),
(342, 370, 1, 'GENERAL', '2023-01-26 07:25:23', NULL),
(343, 371, 1, 'OBC', '2023-01-26 07:29:00', NULL),
(344, 372, 1, 'OBC', '2023-01-27 07:30:28', NULL),
(345, 373, 1, 'OBC', '2023-01-27 07:33:26', NULL),
(346, 374, 1, 'OBC', '2023-01-27 07:36:56', NULL),
(347, 375, 1, 'GENERAL', '2023-01-27 07:39:48', NULL),
(348, 376, 1, 'OBC', '2023-01-27 07:42:10', NULL),
(349, 377, 1, 'OBC', '2023-01-27 07:44:56', NULL),
(350, 378, 1, 'OBC', '2023-01-27 07:47:03', NULL),
(351, 379, 1, 'OBC', '2023-01-27 07:49:24', NULL),
(352, 380, 1, 'GENERAL', '2023-01-27 08:29:06', NULL),
(353, 381, 1, 'GENERAL', '2023-01-27 08:33:09', NULL),
(354, 382, 1, 'OBC', '2023-02-01 06:50:14', NULL),
(355, 383, 1, 'OBC', '2023-02-01 06:52:57', NULL),
(356, 384, 1, 'OBC', '2023-02-01 06:57:45', NULL),
(357, 385, 1, 'OBC', '2023-02-01 06:59:45', NULL),
(358, 386, 1, 'OBC', '2023-02-01 07:05:35', NULL),
(359, 387, 1, 'OBC', '2023-02-01 07:12:23', NULL),
(360, 388, 1, 'OBC', '2023-02-01 07:15:01', NULL),
(361, 389, 1, 'OBC', '2023-02-01 07:38:53', NULL),
(362, 390, 1, 'OBC', '2023-02-01 07:41:12', NULL),
(363, 391, 1, 'OBC', '2023-02-01 07:48:10', NULL),
(364, 392, 1, 'OBC', '2023-02-01 07:51:21', NULL),
(365, 393, 1, 'GENERAL', '2023-02-04 06:27:28', NULL),
(366, 394, 1, 'OBC', '2023-02-01 08:18:17', NULL),
(367, 395, 1, 'GENERAL', '2023-02-04 06:53:25', NULL),
(368, 396, 1, 'OBC', '2023-02-01 08:23:12', NULL),
(369, 397, 1, 'OBC', '2023-02-01 08:25:17', NULL),
(370, 398, 1, 'GENERAL', '2023-02-04 06:58:10', NULL),
(371, 399, 1, 'OBC', '2023-02-01 08:29:27', NULL),
(372, 400, 1, 'OBC', '2023-02-01 08:32:17', NULL),
(373, 401, 1, 'OBC', '2023-02-01 08:34:13', NULL),
(374, 402, 1, 'OBC', '2023-02-01 08:36:18', NULL),
(375, 403, 1, 'GENERAL', '2023-02-04 07:03:15', NULL),
(376, 404, 1, 'GENERAL', '2023-02-04 07:05:07', NULL),
(377, 405, 1, 'OBC', '2023-02-02 06:06:03', NULL),
(378, 406, 1, 'OBC', '2023-02-02 06:08:12', NULL),
(379, 407, 1, 'GENERAL', '2023-02-04 07:08:46', NULL),
(380, 408, 1, 'OBC', '2023-02-02 06:15:02', NULL),
(381, 409, 1, 'OBC', '2023-02-02 06:17:09', NULL),
(382, 410, 1, 'GENERAL', '2023-02-02 06:21:43', NULL),
(383, 411, 1, 'GENERAL', '2023-02-02 06:21:13', NULL),
(384, 412, 1, 'OBC', '2023-02-02 06:32:22', NULL),
(385, 413, 1, 'OBC', '2023-02-02 06:34:28', NULL),
(386, 414, 1, 'OBC', '2023-02-03 04:58:19', NULL),
(387, 415, 1, 'OBC', '2023-02-03 05:07:48', NULL),
(388, 416, 1, 'OBC', '2023-02-03 05:15:25', NULL),
(389, 417, 1, 'GENERAL', '2023-02-03 05:24:22', NULL),
(390, 418, 1, 'OBC', '2023-02-03 05:28:04', NULL),
(391, 419, 1, 'OBC', '2023-02-03 05:31:12', NULL),
(392, 420, 1, 'OBC', '2023-02-03 05:36:24', NULL),
(393, 421, 1, 'OBC', '2023-02-03 05:39:56', NULL),
(394, 422, 1, 'GENERAL', '2023-02-03 05:43:24', NULL),
(395, 423, 1, 'OBC', '2023-02-03 05:48:57', NULL),
(396, 424, 1, 'OBC', '2023-02-03 05:52:04', NULL),
(397, 425, 1, 'OBC', '2023-02-03 05:54:41', NULL),
(398, 426, 1, 'OBC', '2023-02-03 05:57:29', NULL),
(399, 427, 1, 'OBC', '2023-02-03 06:00:05', NULL),
(400, 428, 1, 'OBC', '2023-02-03 06:02:52', NULL),
(401, 429, 1, 'OBC', '2023-02-03 06:05:52', NULL),
(402, 430, 1, 'OBC', '2023-02-03 06:08:43', NULL),
(403, 431, 1, 'OBC', '2023-02-03 06:12:03', NULL),
(404, 432, 1, 'OBC', '2023-02-03 06:15:22', NULL),
(405, 433, 1, 'OBC', '2023-02-03 06:18:22', NULL),
(406, 434, 1, 'OBC', '2023-02-03 06:21:02', NULL),
(407, 435, 1, 'OBC', '2023-02-03 06:23:35', NULL),
(408, 436, 1, 'OBC', '2023-02-03 06:30:06', NULL),
(409, 437, 1, 'OBC', '2023-02-03 06:32:37', NULL),
(410, 438, 1, 'OBC', '2023-02-03 06:35:08', NULL),
(411, 439, 1, 'OBC', '2023-02-03 06:38:01', NULL),
(412, 440, 1, 'OBC', '2023-02-03 06:42:42', NULL),
(413, 441, 1, 'OBC', '2023-02-24 07:10:12', NULL),
(414, 442, 1, 'OBC', '2023-03-06 04:43:17', NULL),
(415, 443, 1, 'OBC', '2023-03-25 15:40:58', NULL),
(416, 444, 1, 'OBC', '2023-03-27 04:07:56', NULL),
(417, 445, 1, 'OBC', '2023-04-01 06:17:53', NULL),
(418, 446, 1, 'OBC', '2023-04-03 04:39:49', NULL),
(419, 447, 1, 'OBC', '2023-04-23 09:25:40', NULL),
(420, 448, 1, 'GENERAL', '2023-04-25 06:07:32', NULL),
(421, 449, 1, 'GENERAL', '2023-04-25 06:24:34', NULL),
(422, 450, 1, 'GENERAL', '2023-04-25 07:03:49', NULL),
(423, 451, 1, 'GENERAL', '2023-04-25 07:12:08', NULL),
(424, 452, 1, 'OBC', '2023-04-25 07:16:08', NULL),
(425, 453, 1, 'GENERAL', '2023-04-25 07:18:40', NULL),
(426, 454, 1, 'GENERAL', '2023-04-25 07:22:20', NULL),
(427, 455, 1, 'OBC', '2023-04-25 07:24:45', NULL),
(428, 456, 1, 'OBC', '2023-04-25 07:28:51', NULL),
(429, 457, 1, 'SC/ST', '2023-04-25 07:31:31', NULL),
(430, 458, 1, 'OBC', '2023-04-25 08:36:55', NULL),
(431, 459, 1, 'OBC', '2023-04-25 08:38:52', NULL),
(432, 460, 1, 'SC/ST', '2023-04-25 08:43:35', NULL),
(433, 461, 1, 'OBC', '2023-04-25 08:46:00', NULL),
(434, 462, 1, 'OBC', '2023-04-25 08:49:25', NULL),
(435, 463, 1, 'GENERAL', '2023-04-25 08:51:43', NULL),
(436, 464, 1, 'OBC', '2023-04-25 09:01:34', NULL),
(437, 465, 1, 'OBC', '2023-04-25 09:04:49', NULL),
(438, 466, 1, 'OBC', '2023-04-25 11:55:20', NULL),
(439, 467, 1, 'OBC', '2023-04-25 12:19:22', NULL),
(440, 468, 1, 'OBC', '2023-04-25 12:32:42', NULL),
(441, 469, 1, 'OBC', '2023-05-31 04:59:43', NULL),
(442, 470, 1, 'OBC', '2023-07-25 07:02:05', NULL),
(443, 471, 1, 'MINORITY', '2025-04-18 15:26:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deleted_receipts`
--

CREATE TABLE `deleted_receipts` (
  `id` int(11) NOT NULL DEFAULT 0,
  `receipt_no` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `months` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `fee_head` varchar(100) DEFAULT NULL,
  `fee_head_type` varchar(100) DEFAULT NULL,
  `fee_head_name` varchar(100) DEFAULT NULL,
  `balance_amount` varchar(100) DEFAULT NULL,
  `total` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`total`)),
  `rec_discount` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`rec_discount`)),
  `rec_amount` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`rec_amount`)),
  `fees_received` varchar(100) DEFAULT NULL,
  `late_fees` varchar(100) DEFAULT NULL,
  `ledger_amt` varchar(100) DEFAULT NULL,
  `total_fees` varchar(100) DEFAULT NULL,
  `discount_amt` varchar(100) DEFAULT NULL,
  `net_fees` varchar(100) DEFAULT NULL,
  `receipt_amt` varchar(100) DEFAULT NULL,
  `balance_amt` varchar(100) DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `date_time` varchar(100) DEFAULT NULL,
  `back_id` varchar(100) DEFAULT NULL,
  `sr_no` varchar(100) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `total_month` int(11) DEFAULT NULL,
  `month_total` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deleted_receipts`
--

INSERT INTO `deleted_receipts` (`id`, `receipt_no`, `student_id`, `months`, `fee_head`, `fee_head_type`, `fee_head_name`, `balance_amount`, `total`, `rec_discount`, `rec_amount`, `fees_received`, `late_fees`, `ledger_amt`, `total_fees`, `discount_amt`, `net_fees`, `receipt_amt`, `balance_amt`, `mode`, `remarks`, `created_at`, `date_time`, `back_id`, `sr_no`, `create_by`, `total_month`, `month_total`) VALUES
(6, '2025-2026/3', 471, '', '', '', 'Ledger Amount', '1000', '1000', '0', '6950', '1000', '', '6950.00', '6950', '0', '6950', '1000', '5950.00', 'Online', '', '2025-07-08 16:10:19', '2025-07-08', '503', '3', 'demo@easyskool.in', NULL, NULL),
(11, '2025-2026/5', 471, '', '', '', 'Ledger Amount', '3000', '3000', '0', '3180', '3000', '', '3180.00', '3180', '0', '3180', '3000', '180.00', 'Online', '', '2025-07-08 16:45:49', '2025-07-08', '503', '5', 'demo@easyskool.in', NULL, NULL),
(900, '2025-2026/310', 628, 'Jun', '66', 'fees', 'Monthly Fee', '0', '1600', '0', '1600', '1600', '', '800.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-19 03:44:14', '2025-11-19', '661', '310', 'demo@easyskool.in', 1, '1600.00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `is_active`) VALUES
(11, 'Teaching', 'yes'),
(12, 'Non-Teaching', 'yes'),
(13, 'Admin', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `disable_reason`
--

CREATE TABLE `disable_reason` (
  `id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `disable_reason`
--

INSERT INTO `disable_reason` (`id`, `reason`, `created_at`) VALUES
(2, 'Wrong Fees', '2025-11-12 09:37:10'),
(3, 'Wrong Entry', '2025-11-12 09:36:42'),
(5, 'Transfer Case', '2025-11-12 09:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `dispatch_receive`
--

CREATE TABLE `dispatch_receive` (
  `id` int(11) NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `to_title` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `from_title` varchar(200) NOT NULL,
  `date` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_type` varchar(100) DEFAULT NULL,
  `smtp_server` varchar(100) DEFAULT NULL,
  `smtp_port` varchar(100) DEFAULT NULL,
  `smtp_username` varchar(100) DEFAULT NULL,
  `smtp_password` varchar(100) DEFAULT NULL,
  `ssl_tls` varchar(100) DEFAULT NULL,
  `smtp_auth` varchar(10) NOT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`id`, `email_type`, `smtp_server`, `smtp_port`, `smtp_username`, `smtp_password`, `ssl_tls`, `smtp_auth`, `is_active`, `created_at`) VALUES
(1, 'sendmail', NULL, NULL, NULL, NULL, NULL, '', '', '2020-02-28 13:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `reference` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `follow_up_date` date NOT NULL,
  `note` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `assigned` varchar(100) NOT NULL,
  `class` int(11) NOT NULL,
  `no_of_child` varchar(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id`, `name`, `contact`, `address`, `reference`, `date`, `description`, `follow_up_date`, `note`, `source`, `email`, `assigned`, `class`, `no_of_child`, `status`) VALUES
(1, 'Shiva', '9897982348', 'Shamli', '', '2024-04-17', 'Test', '2024-04-17', 'Test', 'By Website', 'shiva@gmail.com', '', 32, '1', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_type`
--

CREATE TABLE `enquiry_type` (
  `id` int(11) NOT NULL,
  `enquiry_type` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_title` varchar(200) NOT NULL,
  `event_description` varchar(300) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `event_color` varchar(200) NOT NULL,
  `event_for` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `sesion_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_groups`
--

CREATE TABLE `exam_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `exam_type` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `exam_groups`
--

INSERT INTO `exam_groups` (`id`, `name`, `exam_type`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(34, 'Term 1', 'basic_system', 'Term 1', 0, '2025-11-22 15:50:05', NULL),
(35, 'Term 2', 'basic_system', 'Term 2', 0, '2025-11-20 02:28:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_class_batch_exams`
--

CREATE TABLE `exam_group_class_batch_exams` (
  `id` int(11) NOT NULL,
  `exam` varchar(250) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `exam_group_d` int(11) DEFAULT NULL,
  `is_publish` int(11) DEFAULT 0,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `coscholasticareas` int(11) DEFAULT 0,
  `exam_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `exam_group_class_batch_exams`
--

INSERT INTO `exam_group_class_batch_exams` (`id`, `exam`, `session_id`, `date_from`, `date_to`, `description`, `exam_group_d`, `is_publish`, `is_active`, `created_at`, `updated_at`, `coscholasticareas`, `exam_group_id`) VALUES
(168, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2023-03-21 16:48:41', NULL, NULL, 0),
(171, 'PT-1', 18, NULL, NULL, 'PERIODIC TEST - 1', NULL, 1, 1, '2023-03-22 06:58:29', NULL, 0, 25),
(172, 'SE-1', 18, NULL, NULL, 'SUB - ENRICHMENT 1', NULL, 1, 1, '2023-03-22 07:05:37', NULL, 0, 25),
(173, 'NB-1', 18, NULL, NULL, 'NOTE BOOK 1', NULL, 1, 1, '2023-03-22 07:06:14', NULL, 0, 25),
(174, 'HALF YEARLY', 18, NULL, NULL, 'HALF YEARLY', NULL, 1, 1, '2023-03-22 07:06:32', NULL, 0, 25),
(175, 'PT-2', 18, NULL, NULL, 'PERIODIC TEST - 2', NULL, 1, 1, '2023-03-22 07:06:46', NULL, 0, 25),
(176, 'SE-2', 18, NULL, NULL, 'SUB - ENRICHMENT 2', NULL, 1, 1, '2023-03-22 07:07:09', NULL, 0, 25),
(177, 'NB-2', 18, NULL, NULL, 'NOTE BOOK 2', NULL, 1, 1, '2023-03-22 07:07:26', NULL, 0, 25),
(178, 'ANNUAL', 18, NULL, NULL, 'ANNUAL', NULL, 1, 1, '2023-03-22 07:07:41', NULL, 0, 25),
(179, 'PT-1', 18, NULL, NULL, 'PERIODIC TEST - 1', NULL, 1, 1, '2023-03-22 07:36:08', NULL, 0, 26),
(180, 'SE-1', 18, NULL, NULL, 'SUB - ENRICHMENT 1', NULL, 1, 1, '2023-03-22 07:37:00', NULL, 0, 26),
(181, 'NB-1', 18, NULL, NULL, 'NOTE BOOK 1', NULL, 1, 1, '2023-03-22 07:37:16', NULL, 0, 26),
(182, 'HALF YEARLY', 18, NULL, NULL, 'HALF YEARLY', NULL, 1, 1, '2023-03-22 07:37:34', NULL, 0, 26),
(183, 'PT-2', 18, NULL, NULL, 'PERIODIC TEST - 2', NULL, 1, 1, '2023-03-22 07:37:53', NULL, 0, 26),
(184, 'SE-2', 18, NULL, NULL, 'SUB - ENRICHMENT 2', NULL, 1, 1, '2023-03-22 07:38:14', NULL, 0, 26),
(185, 'NB-2', 18, NULL, NULL, 'NOTE BOOK 2', NULL, 1, 1, '2023-03-22 07:38:34', NULL, 0, 26),
(186, 'ANNUAL', 18, NULL, NULL, 'ANNUAL', NULL, 1, 1, '2023-03-22 07:38:56', NULL, 0, 26),
(187, 'PT-1', 18, NULL, NULL, 'PERIODIC TEST - 1', NULL, 1, 1, '2023-03-22 07:58:32', NULL, 0, 27),
(188, 'SE-1', 18, NULL, NULL, 'SUB - ENRICHMENT 1', NULL, 1, 1, '2023-03-22 07:58:56', NULL, 0, 27),
(189, 'NB-1', 18, NULL, NULL, 'NOTE BOOK 1', NULL, 1, 1, '2023-03-22 07:59:17', NULL, 0, 27),
(190, 'HALF YEARLY', 18, NULL, NULL, 'HALF YEARLY', NULL, 1, 1, '2023-03-22 07:59:35', NULL, 0, 27),
(191, 'PT-2', 18, NULL, NULL, 'PERIODIC TEST - 2', NULL, 1, 1, '2023-03-22 07:59:56', NULL, 0, 27),
(192, 'SE-2', 18, NULL, NULL, 'SUB - ENRICHMENT 2', NULL, 1, 1, '2023-03-22 08:00:19', NULL, 0, 27),
(193, 'NB-2', 18, NULL, NULL, 'NOTE BOOK 2', NULL, 1, 1, '2023-03-22 08:00:36', NULL, 0, 27),
(194, 'ANNUAL', 18, NULL, NULL, 'ANNUAL', NULL, 1, 1, '2023-03-22 08:00:54', NULL, 0, 27),
(195, 'PT-1', 18, NULL, NULL, 'PERIODIC TEST - 1', NULL, 1, 1, '2023-03-23 03:44:22', NULL, 0, 28),
(196, 'HALF YEARLY (T)', 18, NULL, NULL, 'HALF YEARLY(THEORY)', NULL, 1, 1, '2023-03-23 03:45:11', NULL, 0, 28),
(197, 'HALF YEARLY (P)', 18, NULL, NULL, 'HALF YEARLY(PRACTICAL)', NULL, 1, 1, '2023-03-23 03:45:32', NULL, 0, 28),
(198, 'PT-2', 18, NULL, NULL, 'PERIODIC TEST - 2', NULL, 1, 1, '2023-03-23 03:45:54', NULL, 0, 28),
(199, 'ANNUAL (T)', 18, NULL, NULL, 'ANNUAL(THEORY)', NULL, 1, 1, '2023-03-23 03:46:29', NULL, 0, 28),
(200, 'ANNUAL (P)', 18, NULL, NULL, 'ANNUAL(PRACTICAL)', NULL, 1, 1, '2023-03-23 03:46:49', NULL, 0, 28),
(206, 'Art Education', 18, NULL, NULL, 'Art Education', NULL, 1, 1, '2023-03-24 04:40:23', NULL, 1, 3),
(207, 'Work Education', 18, NULL, NULL, 'Work Education', NULL, 1, 1, '2023-03-24 04:40:42', NULL, 1, 3),
(208, 'Scientific Skills', 18, NULL, NULL, 'Scientific Skills', NULL, 1, 1, '2023-03-24 04:41:10', NULL, 1, 3),
(209, 'Social Skills', 18, NULL, NULL, 'Social Skills', NULL, 1, 1, '2023-03-24 04:41:30', NULL, 1, 3),
(211, 'Yoga', 18, NULL, NULL, 'Yoga', NULL, 1, 1, '2023-03-24 04:42:24', NULL, 1, 3),
(212, 'Sports', 18, NULL, NULL, 'Sports', NULL, 1, 1, '2023-03-24 04:42:34', NULL, 1, 3),
(213, 'Regularity & Punctuality', 18, NULL, NULL, 'Regularity & Punctuality', NULL, 1, 1, '2023-03-24 04:43:26', NULL, 1, 4),
(214, 'Behavior & Values', 18, NULL, NULL, 'Behavior & Values', NULL, 1, 1, '2023-03-24 04:43:56', NULL, 1, 4),
(215, 'Attitude towards Teacher', 18, NULL, NULL, 'Attitude towards Teacher', NULL, 1, 1, '2023-03-24 04:44:19', NULL, 1, 4),
(216, 'Attitude towards Society', 18, NULL, NULL, 'Attitude towards Society', NULL, 1, 1, '2023-03-24 04:44:36', NULL, 1, 4),
(217, 'Attitude towards Nation', 18, NULL, NULL, 'Attitude towards Nation', NULL, 1, 1, '2023-03-24 04:44:52', NULL, 1, 4),
(218, 'PT - 1', 18, NULL, NULL, '', NULL, 1, 1, '2023-03-25 13:53:30', NULL, 0, 29),
(219, 'HALF YEARLY (THEORY)', 18, NULL, NULL, '', NULL, 1, 1, '2023-03-25 13:53:43', NULL, 0, 29),
(220, 'HALF YEARLY (PRACTICAL)', 18, NULL, NULL, '', NULL, 1, 1, '2023-03-25 13:53:56', NULL, 0, 29),
(221, 'UT1', 18, NULL, NULL, 'TSTING', NULL, 1, 1, '2023-03-25 15:41:46', NULL, 0, 30),
(222, 'UT2', 18, NULL, NULL, '', NULL, 1, 1, '2023-03-25 15:42:11', NULL, 0, 30),
(224, 'HALF YEARLY (P)', 18, NULL, NULL, 'HALF YEARLY (PRACTICAL)', NULL, 1, 1, '2023-03-26 12:57:49', NULL, 0, 23),
(225, 'PT - 2', 18, NULL, NULL, 'PERIODIC TEST - 2', NULL, 1, 1, '2023-03-26 12:58:19', NULL, 0, 23),
(226, 'ANNUAL (T)', 18, NULL, NULL, 'ANNUAL (THEORY)', NULL, 1, 1, '2023-03-26 12:58:45', NULL, 0, 23),
(227, 'ANNUAL (P)', 18, NULL, NULL, 'ANNUAL (PRACTICAL)', NULL, 1, 1, '2023-03-26 12:59:07', NULL, 0, 23),
(228, 'PT-1', 19, NULL, NULL, '', NULL, 1, 1, '2023-04-08 09:53:04', NULL, 0, 32),
(229, 'NB-1', 19, NULL, NULL, '', NULL, 1, 1, '2023-04-08 09:53:21', NULL, 0, 32),
(230, 'SE-1', 19, NULL, NULL, '', NULL, 1, 1, '2023-04-08 09:53:34', NULL, 0, 32),
(231, 'HALF-YEARLY', 19, NULL, NULL, '', NULL, 1, 1, '2023-04-08 09:53:50', NULL, 0, 32),
(232, 'PT-2', 19, NULL, NULL, '', NULL, 1, 1, '2023-04-08 09:54:28', NULL, 0, 33),
(233, 'NB-2', 19, NULL, NULL, '', NULL, 1, 1, '2023-04-08 09:54:40', NULL, 0, 33),
(234, 'SE-2', 19, NULL, NULL, '', NULL, 1, 1, '2023-04-08 09:54:49', NULL, 0, 33),
(235, 'ANNUAL', 19, NULL, NULL, '', NULL, 1, 1, '2023-04-08 09:55:01', NULL, 0, 33),
(236, 'UT-1', 30, NULL, NULL, 'Unit Test 1', NULL, 1, 1, '2025-11-20 02:29:10', NULL, 0, 34),
(238, 'Half-Yearly', 30, NULL, NULL, 'Half-Yearly', NULL, 1, 1, '2025-11-20 02:33:44', NULL, 0, 34),
(241, 'UT1', 30, NULL, NULL, 'UT1', NULL, 1, 1, '2025-11-20 15:44:52', NULL, 1, 10),
(242, 'Half Yearly', 30, NULL, NULL, 'Half Yearly', NULL, 1, 1, '2025-11-20 15:48:57', NULL, 1, 10),
(244, 'UT-2', 30, NULL, NULL, 'Unit Test2', NULL, 1, 1, '2025-11-20 15:54:09', NULL, 0, 35),
(245, 'Annually', 30, NULL, NULL, 'Annually', NULL, 1, 1, '2025-11-20 15:54:37', NULL, 0, 35),
(251, 'Uniform & Cleanness', 30, NULL, NULL, 'Uniform & Cleanness ', NULL, 1, 1, '2025-11-20 17:06:22', NULL, 1, 15),
(252, 'PT & Games', 30, NULL, NULL, 'PT & Games', NULL, 1, 1, '2025-11-20 17:06:48', NULL, 1, 15),
(253, 'Rhymes & Poems', 30, NULL, NULL, 'Rhymes & Poems ', NULL, 1, 1, '2025-11-20 17:07:37', NULL, 1, 15),
(254, 'Total Attendance', 30, NULL, NULL, 'Total Attendance ', NULL, 1, 1, '2025-11-20 17:08:08', NULL, 1, 15),
(255, 'Uniform & Cleanness', 30, NULL, NULL, 'Uniform & Cleanness', NULL, 1, 1, '2025-11-20 17:16:09', NULL, 1, 18),
(256, 'PT & Games', 30, NULL, NULL, 'PT & Games', NULL, 1, 1, '2025-11-20 17:17:06', NULL, 1, 18),
(257, 'Rhymes & Poems', 30, NULL, NULL, 'Rhymes & Poems', NULL, 1, 1, '2025-11-20 17:17:27', NULL, 1, 18),
(258, 'Total Attendance', 30, NULL, NULL, 'Total Attendance', NULL, 1, 1, '2025-11-20 17:17:47', NULL, 1, 18),
(264, 'Theory T1', 30, NULL, NULL, 'Theory T1', NULL, 1, 1, '2025-11-22 15:51:07', NULL, 0, 34),
(265, 'Practical T1', 30, NULL, NULL, 'Practical T1', NULL, 1, 1, '2025-11-22 15:51:29', NULL, 0, 34),
(266, 'Theory T2', 30, NULL, NULL, 'Theory T2', NULL, 1, 1, '2025-11-22 16:46:39', NULL, 0, 35),
(267, 'Practical T2', 30, NULL, NULL, 'Practical T2', NULL, 1, 1, '2025-11-22 16:46:54', NULL, 0, 35),
(268, 'Work Education T1', 30, NULL, NULL, 'Work Education T1', NULL, 1, 1, '2025-11-22 16:57:19', NULL, 1, 19),
(269, 'Art Education T1', 30, NULL, NULL, 'Art Education T1', NULL, 1, 1, '2025-11-22 16:57:34', NULL, 1, 19),
(270, 'Phy. & Health Edu. T1', 30, NULL, NULL, 'Phy. & Health Edu. T1', NULL, 1, 1, '2025-11-22 16:57:55', NULL, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_class_batch_exam_students`
--

CREATE TABLE `exam_group_class_batch_exam_students` (
  `id` int(11) NOT NULL,
  `exam_group_class_batch_exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_session_id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `exam_group_class_batch_exam_students`
--

INSERT INTO `exam_group_class_batch_exam_students` (`id`, `exam_group_class_batch_exam_id`, `student_id`, `student_session_id`, `roll_no`, `is_active`, `created_at`, `updated_at`) VALUES
(7491, 236, 588, 621, 0, 0, '2025-11-20 02:30:03', NULL),
(7492, 236, 587, 620, 0, 0, '2025-11-20 02:30:03', NULL),
(7493, 236, 586, 619, 0, 0, '2025-11-20 02:30:03', NULL),
(7494, 236, 584, 617, 0, 0, '2025-11-20 02:30:03', NULL),
(7495, 236, 583, 616, 0, 0, '2025-11-20 02:30:03', NULL),
(7496, 236, 582, 615, 0, 0, '2025-11-20 02:30:03', NULL),
(7497, 236, 581, 614, 0, 0, '2025-11-20 02:30:03', NULL),
(7498, 236, 580, 613, 0, 0, '2025-11-20 02:30:03', NULL),
(7499, 236, 579, 612, 0, 0, '2025-11-20 02:30:03', NULL),
(7500, 236, 574, 607, 0, 0, '2025-11-20 02:30:03', NULL),
(7501, 241, 588, 621, 0, 0, '2025-11-20 15:45:16', NULL),
(7502, 241, 587, 620, 0, 0, '2025-11-20 15:45:16', NULL),
(7503, 241, 586, 619, 0, 0, '2025-11-20 15:45:16', NULL),
(7504, 241, 584, 617, 0, 0, '2025-11-20 15:45:16', NULL),
(7505, 241, 583, 616, 0, 0, '2025-11-20 15:45:16', NULL),
(7506, 241, 582, 615, 0, 0, '2025-11-20 15:45:16', NULL),
(7507, 241, 581, 614, 0, 0, '2025-11-20 15:45:16', NULL),
(7508, 241, 580, 613, 0, 0, '2025-11-20 15:45:16', NULL),
(7509, 241, 579, 612, 0, 0, '2025-11-20 15:45:16', NULL),
(7510, 241, 574, 607, 0, 0, '2025-11-20 15:45:16', NULL),
(7511, 238, 588, 621, 0, 0, '2025-11-20 15:56:41', NULL),
(7512, 238, 587, 620, 0, 0, '2025-11-20 15:56:41', NULL),
(7513, 238, 586, 619, 0, 0, '2025-11-20 15:56:41', NULL),
(7514, 238, 584, 617, 0, 0, '2025-11-20 15:56:41', NULL),
(7515, 238, 583, 616, 0, 0, '2025-11-20 15:56:41', NULL),
(7516, 238, 582, 615, 0, 0, '2025-11-20 15:56:41', NULL),
(7517, 238, 581, 614, 0, 0, '2025-11-20 15:56:41', NULL),
(7518, 238, 580, 613, 0, 0, '2025-11-20 15:56:41', NULL),
(7519, 238, 579, 612, 0, 0, '2025-11-20 15:56:41', NULL),
(7520, 238, 574, 607, 0, 0, '2025-11-20 15:56:41', NULL),
(7521, 244, 588, 621, 0, 0, '2025-11-20 16:20:54', NULL),
(7522, 244, 587, 620, 0, 0, '2025-11-20 16:20:54', NULL),
(7523, 244, 586, 619, 0, 0, '2025-11-20 16:20:54', NULL),
(7524, 244, 584, 617, 0, 0, '2025-11-20 16:20:54', NULL),
(7525, 244, 583, 616, 0, 0, '2025-11-20 16:20:54', NULL),
(7526, 244, 582, 615, 0, 0, '2025-11-20 16:20:54', NULL),
(7527, 244, 581, 614, 0, 0, '2025-11-20 16:20:54', NULL),
(7528, 244, 580, 613, 0, 0, '2025-11-20 16:20:54', NULL),
(7529, 244, 579, 612, 0, 0, '2025-11-20 16:20:54', NULL),
(7530, 244, 574, 607, 0, 0, '2025-11-20 16:20:54', NULL),
(7531, 245, 588, 621, 0, 0, '2025-11-20 16:24:17', NULL),
(7532, 245, 587, 620, 0, 0, '2025-11-20 16:24:17', NULL),
(7533, 245, 586, 619, 0, 0, '2025-11-20 16:24:17', NULL),
(7534, 245, 584, 617, 0, 0, '2025-11-20 16:24:17', NULL),
(7535, 245, 583, 616, 0, 0, '2025-11-20 16:24:17', NULL),
(7536, 245, 582, 615, 0, 0, '2025-11-20 16:24:17', NULL),
(7537, 245, 581, 614, 0, 0, '2025-11-20 16:24:17', NULL),
(7538, 245, 580, 613, 0, 0, '2025-11-20 16:24:17', NULL),
(7539, 245, 579, 612, 0, 0, '2025-11-20 16:24:17', NULL),
(7540, 245, 574, 607, 0, 0, '2025-11-20 16:24:17', NULL),
(7591, 251, 588, 621, 0, 0, '2025-11-20 17:11:41', NULL),
(7592, 251, 587, 620, 0, 0, '2025-11-20 17:11:41', NULL),
(7593, 251, 586, 619, 0, 0, '2025-11-20 17:11:41', NULL),
(7594, 251, 584, 617, 0, 0, '2025-11-20 17:11:41', NULL),
(7595, 251, 583, 616, 0, 0, '2025-11-20 17:11:41', NULL),
(7596, 251, 582, 615, 0, 0, '2025-11-20 17:11:41', NULL),
(7597, 251, 581, 614, 0, 0, '2025-11-20 17:11:41', NULL),
(7598, 251, 580, 613, 0, 0, '2025-11-20 17:11:41', NULL),
(7599, 251, 579, 612, 0, 0, '2025-11-20 17:11:41', NULL),
(7600, 251, 574, 607, 0, 0, '2025-11-20 17:11:41', NULL),
(7601, 252, 588, 621, 0, 0, '2025-11-20 17:12:00', NULL),
(7602, 252, 587, 620, 0, 0, '2025-11-20 17:12:00', NULL),
(7603, 252, 586, 619, 0, 0, '2025-11-20 17:12:00', NULL),
(7604, 252, 584, 617, 0, 0, '2025-11-20 17:12:00', NULL),
(7605, 252, 583, 616, 0, 0, '2025-11-20 17:12:00', NULL),
(7606, 252, 582, 615, 0, 0, '2025-11-20 17:12:00', NULL),
(7607, 252, 581, 614, 0, 0, '2025-11-20 17:12:00', NULL),
(7608, 252, 580, 613, 0, 0, '2025-11-20 17:12:00', NULL),
(7609, 252, 579, 612, 0, 0, '2025-11-20 17:12:00', NULL),
(7610, 252, 574, 607, 0, 0, '2025-11-20 17:12:00', NULL),
(7611, 253, 588, 621, 0, 0, '2025-11-20 17:12:17', NULL),
(7612, 253, 587, 620, 0, 0, '2025-11-20 17:12:17', NULL),
(7613, 253, 586, 619, 0, 0, '2025-11-20 17:12:17', NULL),
(7614, 253, 584, 617, 0, 0, '2025-11-20 17:12:17', NULL),
(7615, 253, 583, 616, 0, 0, '2025-11-20 17:12:17', NULL),
(7616, 253, 582, 615, 0, 0, '2025-11-20 17:12:17', NULL),
(7617, 253, 581, 614, 0, 0, '2025-11-20 17:12:17', NULL),
(7618, 253, 580, 613, 0, 0, '2025-11-20 17:12:17', NULL),
(7619, 253, 579, 612, 0, 0, '2025-11-20 17:12:17', NULL),
(7620, 253, 574, 607, 0, 0, '2025-11-20 17:12:17', NULL),
(7621, 254, 588, 621, 0, 0, '2025-11-20 17:12:46', NULL),
(7622, 254, 587, 620, 0, 0, '2025-11-20 17:12:46', NULL),
(7623, 254, 586, 619, 0, 0, '2025-11-20 17:12:46', NULL),
(7624, 254, 584, 617, 0, 0, '2025-11-20 17:12:46', NULL),
(7625, 254, 583, 616, 0, 0, '2025-11-20 17:12:46', NULL),
(7626, 254, 582, 615, 0, 0, '2025-11-20 17:12:46', NULL),
(7627, 254, 581, 614, 0, 0, '2025-11-20 17:12:46', NULL),
(7628, 254, 580, 613, 0, 0, '2025-11-20 17:12:46', NULL),
(7629, 254, 579, 612, 0, 0, '2025-11-20 17:12:46', NULL),
(7630, 254, 574, 607, 0, 0, '2025-11-20 17:12:46', NULL),
(7631, 255, 588, 621, 0, 0, '2025-11-20 17:18:04', NULL),
(7632, 255, 587, 620, 0, 0, '2025-11-20 17:18:04', NULL),
(7633, 255, 586, 619, 0, 0, '2025-11-20 17:18:04', NULL),
(7634, 255, 584, 617, 0, 0, '2025-11-20 17:18:04', NULL),
(7635, 255, 583, 616, 0, 0, '2025-11-20 17:18:04', NULL),
(7636, 255, 582, 615, 0, 0, '2025-11-20 17:18:04', NULL),
(7637, 255, 581, 614, 0, 0, '2025-11-20 17:18:04', NULL),
(7638, 255, 580, 613, 0, 0, '2025-11-20 17:18:04', NULL),
(7639, 255, 579, 612, 0, 0, '2025-11-20 17:18:04', NULL),
(7640, 255, 574, 607, 0, 0, '2025-11-20 17:18:04', NULL),
(7641, 256, 588, 621, 0, 0, '2025-11-20 17:18:21', NULL),
(7642, 256, 587, 620, 0, 0, '2025-11-20 17:18:21', NULL),
(7643, 256, 586, 619, 0, 0, '2025-11-20 17:18:21', NULL),
(7644, 256, 584, 617, 0, 0, '2025-11-20 17:18:21', NULL),
(7645, 256, 583, 616, 0, 0, '2025-11-20 17:18:21', NULL),
(7646, 256, 582, 615, 0, 0, '2025-11-20 17:18:21', NULL),
(7647, 256, 581, 614, 0, 0, '2025-11-20 17:18:21', NULL),
(7648, 256, 580, 613, 0, 0, '2025-11-20 17:18:21', NULL),
(7649, 256, 579, 612, 0, 0, '2025-11-20 17:18:21', NULL),
(7650, 256, 574, 607, 0, 0, '2025-11-20 17:18:21', NULL),
(7651, 257, 588, 621, 0, 0, '2025-11-20 17:18:39', NULL),
(7652, 257, 587, 620, 0, 0, '2025-11-20 17:18:39', NULL),
(7653, 257, 586, 619, 0, 0, '2025-11-20 17:18:39', NULL),
(7654, 257, 584, 617, 0, 0, '2025-11-20 17:18:39', NULL),
(7655, 257, 583, 616, 0, 0, '2025-11-20 17:18:39', NULL),
(7656, 257, 582, 615, 0, 0, '2025-11-20 17:18:39', NULL),
(7657, 257, 581, 614, 0, 0, '2025-11-20 17:18:39', NULL),
(7658, 257, 580, 613, 0, 0, '2025-11-20 17:18:39', NULL),
(7659, 257, 579, 612, 0, 0, '2025-11-20 17:18:39', NULL),
(7660, 257, 574, 607, 0, 0, '2025-11-20 17:18:39', NULL),
(7661, 258, 588, 621, 0, 0, '2025-11-20 17:18:54', NULL),
(7662, 258, 587, 620, 0, 0, '2025-11-20 17:18:54', NULL),
(7663, 258, 586, 619, 0, 0, '2025-11-20 17:18:54', NULL),
(7664, 258, 584, 617, 0, 0, '2025-11-20 17:18:54', NULL),
(7665, 258, 583, 616, 0, 0, '2025-11-20 17:18:54', NULL),
(7666, 258, 582, 615, 0, 0, '2025-11-20 17:18:54', NULL),
(7667, 258, 581, 614, 0, 0, '2025-11-20 17:18:54', NULL),
(7668, 258, 580, 613, 0, 0, '2025-11-20 17:18:54', NULL),
(7669, 258, 579, 612, 0, 0, '2025-11-20 17:18:54', NULL),
(7670, 258, 574, 607, 0, 0, '2025-11-20 17:18:54', NULL),
(7691, 264, 623, 656, 0, 0, '2025-11-22 15:51:47', NULL),
(7692, 264, 624, 657, 0, 0, '2025-11-22 15:51:47', NULL),
(7693, 264, 625, 658, 0, 0, '2025-11-22 15:51:47', NULL),
(7694, 265, 623, 656, 0, 0, '2025-11-22 16:36:41', NULL),
(7695, 265, 624, 657, 0, 0, '2025-11-22 16:36:41', NULL),
(7696, 265, 625, 658, 0, 0, '2025-11-22 16:36:41', NULL),
(7697, 268, 588, 621, 0, 0, '2025-11-22 16:58:07', NULL),
(7698, 268, 587, 620, 0, 0, '2025-11-22 16:58:07', NULL),
(7699, 268, 586, 619, 0, 0, '2025-11-22 16:58:07', NULL),
(7700, 268, 584, 617, 0, 0, '2025-11-22 16:58:07', NULL),
(7701, 268, 583, 616, 0, 0, '2025-11-22 16:58:07', NULL),
(7702, 268, 582, 615, 0, 0, '2025-11-22 16:58:07', NULL),
(7703, 268, 581, 614, 0, 0, '2025-11-22 16:58:07', NULL),
(7704, 268, 580, 613, 0, 0, '2025-11-22 16:58:07', NULL),
(7705, 268, 579, 612, 0, 0, '2025-11-22 16:58:07', NULL),
(7706, 268, 574, 607, 0, 0, '2025-11-22 16:58:07', NULL),
(7707, 236, 605, 638, 0, 0, '2025-11-23 12:42:17', NULL),
(7708, 236, 599, 632, 0, 0, '2025-11-23 12:42:17', NULL),
(7709, 236, 602, 635, 0, 0, '2025-11-23 12:42:17', NULL),
(7710, 236, 601, 634, 0, 0, '2025-11-23 12:42:17', NULL),
(7711, 236, 592, 625, 0, 0, '2025-11-23 12:42:17', NULL),
(7712, 236, 600, 633, 0, 0, '2025-11-23 12:42:17', NULL),
(7713, 236, 603, 636, 0, 0, '2025-11-23 12:42:17', NULL),
(7714, 236, 598, 631, 0, 0, '2025-11-23 12:42:17', NULL),
(7715, 236, 597, 630, 0, 0, '2025-11-23 12:42:17', NULL),
(7716, 236, 596, 629, 0, 0, '2025-11-23 12:42:17', NULL),
(7717, 236, 595, 628, 0, 0, '2025-11-23 12:42:17', NULL),
(7718, 236, 594, 627, 0, 0, '2025-11-23 12:42:17', NULL),
(7719, 236, 593, 626, 0, 0, '2025-11-23 12:42:17', NULL),
(7720, 236, 609, 642, 0, 0, '2025-11-23 12:42:17', NULL),
(7721, 236, 604, 637, 0, 0, '2025-11-23 12:42:17', NULL),
(7722, 236, 607, 640, 0, 0, '2025-11-23 12:42:17', NULL),
(7723, 236, 608, 641, 0, 0, '2025-11-23 12:42:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_class_batch_exam_subjects`
--

CREATE TABLE `exam_group_class_batch_exam_subjects` (
  `id` int(11) NOT NULL,
  `exam_group_class_batch_exams_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `date_from` date NOT NULL,
  `time_from` time NOT NULL,
  `duration` varchar(50) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `max_marks` float(10,2) DEFAULT NULL,
  `min_marks` varchar(50) DEFAULT NULL,
  `credit_hours` float(10,2) DEFAULT 0.00,
  `date_to` datetime DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `class_id` varchar(50) DEFAULT NULL,
  `section_id` varchar(50) DEFAULT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `subject` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `exam_group_class_batch_exam_subjects`
--

INSERT INTO `exam_group_class_batch_exam_subjects` (`id`, `exam_group_class_batch_exams_id`, `subject_id`, `date_from`, `time_from`, `duration`, `room_no`, `max_marks`, `min_marks`, `credit_hours`, `date_to`, `is_active`, `created_at`, `updated_at`, `grade`, `class_id`, `section_id`, `student_id`, `subject`) VALUES
(1552, 236, 86, '2025-12-02', '09:00:00', '90', '1', 20.00, '10', 2.00, NULL, 0, '2025-11-20 02:36:10', NULL, NULL, NULL, NULL, NULL, NULL),
(1553, 236, 92, '2025-12-03', '09:00:00', '90', '1', 20.00, '10', 2.00, NULL, 0, '2025-11-20 02:36:40', NULL, NULL, NULL, NULL, NULL, NULL),
(1554, 236, 93, '2025-12-04', '09:00:00', '90', '1', 20.00, '10', 2.00, NULL, 0, '2025-11-20 02:38:11', NULL, NULL, NULL, NULL, NULL, NULL),
(1555, 236, 94, '2025-12-05', '09:00:00', '90', '1', 20.00, '10', 2.00, NULL, 0, '2025-11-20 02:38:40', NULL, NULL, NULL, NULL, NULL, NULL),
(1556, 236, 95, '2025-12-06', '09:00:00', '90', '1', 20.00, '10', 2.00, NULL, 0, '2025-11-20 02:39:52', NULL, NULL, NULL, NULL, NULL, NULL),
(1557, 236, 96, '2025-12-07', '09:00:00', '90', '1', 20.00, '10', 2.00, NULL, 0, '2025-11-20 02:39:52', NULL, NULL, NULL, NULL, NULL, NULL),
(1560, 238, 86, '2025-12-02', '09:00:00', '90', '1', 80.00, '30', 0.00, NULL, 0, '2025-11-20 15:59:28', NULL, NULL, NULL, NULL, NULL, NULL),
(1561, 238, 92, '2025-12-03', '09:00:00', '90', '1', 80.00, '30', 0.00, NULL, 0, '2025-11-20 15:59:28', NULL, NULL, NULL, NULL, NULL, NULL),
(1562, 238, 93, '2025-12-04', '09:00:00', '90', '1', 80.00, '30', 0.00, NULL, 0, '2025-11-20 15:59:28', NULL, NULL, NULL, NULL, NULL, NULL),
(1563, 238, 94, '2025-12-05', '09:00:00', '90', '1', 80.00, '30', 0.00, NULL, 0, '2025-11-20 15:59:28', NULL, NULL, NULL, NULL, NULL, NULL),
(1564, 238, 95, '2025-12-06', '09:00:00', '90', '1', 80.00, '30', 0.00, NULL, 0, '2025-11-20 15:59:28', NULL, NULL, NULL, NULL, NULL, NULL),
(1565, 238, 96, '2025-12-07', '09:00:00', '90', '1', 80.00, '30', 0.00, NULL, 0, '2025-11-20 15:59:28', NULL, NULL, NULL, NULL, NULL, NULL),
(1566, 244, 86, '2025-12-02', '09:00:00', '90', '1', 20.00, '10', 0.00, NULL, 0, '2025-11-20 16:23:44', NULL, NULL, NULL, NULL, NULL, NULL),
(1567, 244, 92, '2025-12-03', '09:00:00', '90', '1', 20.00, '10', 0.00, NULL, 0, '2025-11-20 16:23:44', NULL, NULL, NULL, NULL, NULL, NULL),
(1568, 244, 93, '2025-12-04', '09:00:00', '90', '1', 20.00, '10', 0.00, NULL, 0, '2025-11-20 16:23:44', NULL, NULL, NULL, NULL, NULL, NULL),
(1569, 244, 94, '2025-12-05', '09:00:00', '90', '1', 20.00, '10', 0.00, NULL, 0, '2025-11-20 16:23:44', NULL, NULL, NULL, NULL, NULL, NULL),
(1570, 244, 95, '2025-12-06', '09:00:00', '90', '1', 20.00, '10', 0.00, NULL, 0, '2025-11-20 16:23:44', NULL, NULL, NULL, NULL, NULL, NULL),
(1571, 244, 96, '2025-12-07', '09:00:00', '90', '1', 20.00, '10', 0.00, NULL, 0, '2025-11-20 16:23:44', NULL, NULL, NULL, NULL, NULL, NULL),
(1572, 245, 86, '2025-12-02', '09:00:00', '90', '', 80.00, '30', 0.00, NULL, 0, '2025-11-20 16:30:01', NULL, NULL, NULL, NULL, NULL, NULL),
(1573, 245, 92, '2025-12-03', '09:00:00', '90', '', 80.00, '30', 0.00, NULL, 0, '2025-11-20 16:30:01', NULL, NULL, NULL, NULL, NULL, NULL),
(1574, 245, 93, '2025-12-04', '09:00:00', '90', '', 80.00, '30', 0.00, NULL, 0, '2025-11-20 16:30:01', NULL, NULL, NULL, NULL, NULL, NULL),
(1575, 245, 94, '2025-12-05', '09:00:00', '90', '', 80.00, '30', 0.00, NULL, 0, '2025-11-20 16:30:01', NULL, NULL, NULL, NULL, NULL, NULL),
(1576, 245, 95, '2025-12-06', '09:00:00', '90', '', 80.00, '30', 0.00, NULL, 0, '2025-11-20 16:30:01', NULL, NULL, NULL, NULL, NULL, NULL),
(1577, 245, 96, '2025-12-07', '09:00:00', '90', '', 80.00, '30', 0.00, NULL, 0, '2025-11-20 16:30:01', NULL, NULL, NULL, NULL, NULL, NULL),
(1590, 264, 102, '2025-11-24', '09:00:00', '90', '2', 80.00, '30', 0.00, NULL, 0, '2025-11-22 16:35:45', NULL, NULL, NULL, NULL, NULL, NULL),
(1591, 265, 102, '2025-11-24', '09:00:00', '90', '2', 20.00, '10', 0.00, NULL, 0, '2025-11-22 16:37:02', NULL, NULL, NULL, NULL, NULL, NULL),
(1592, 264, 104, '2025-11-24', '09:00:00', '90', '2', 80.00, '30', 0.00, NULL, 0, '2025-11-22 16:49:27', NULL, NULL, NULL, NULL, NULL, NULL),
(1593, 264, 103, '2025-11-24', '09:00:00', '90', '2', 80.00, '30', 0.00, NULL, 0, '2025-11-22 16:49:27', NULL, NULL, NULL, NULL, NULL, NULL),
(1594, 264, 105, '2025-11-24', '09:00:00', '90', '2', 80.00, '30', 0.00, NULL, 0, '2025-11-22 16:49:27', NULL, NULL, NULL, NULL, NULL, NULL),
(1595, 264, 106, '2025-11-24', '09:00:00', '90', '2', 80.00, '30', 0.00, NULL, 0, '2025-11-22 16:49:27', NULL, NULL, NULL, NULL, NULL, NULL),
(1596, 265, 104, '2025-11-24', '09:00:00', '90', '2', 20.00, '10', 0.00, NULL, 0, '2025-11-22 16:50:43', NULL, NULL, NULL, NULL, NULL, NULL),
(1597, 265, 103, '2025-11-24', '09:00:00', '90', '2', 20.00, '10', 0.00, NULL, 0, '2025-11-22 16:50:43', NULL, NULL, NULL, NULL, NULL, NULL),
(1598, 265, 105, '2025-11-24', '09:00:00', '90', '2', 20.00, '10', 0.00, NULL, 0, '2025-11-22 16:50:43', NULL, NULL, NULL, NULL, NULL, NULL),
(1599, 265, 106, '2025-11-24', '09:00:00', '90', '2', 20.00, '10', 0.00, NULL, 0, '2025-11-22 16:50:43', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_exam_connections`
--

CREATE TABLE `exam_group_exam_connections` (
  `id` int(11) NOT NULL,
  `exam_group_id` int(11) DEFAULT NULL,
  `exam_group_class_batch_exams_id` int(11) DEFAULT NULL,
  `exam_weightage` float(10,2) DEFAULT 0.00,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `exam_group_exam_connections`
--

INSERT INTO `exam_group_exam_connections` (`id`, `exam_group_id`, `exam_group_class_batch_exams_id`, `exam_weightage`, `is_active`, `created_at`, `updated_at`) VALUES
(15, 35, 244, 100.00, 0, '2025-11-20 16:34:44', NULL),
(16, 35, 245, 100.00, 0, '2025-11-20 16:34:44', NULL),
(19, 34, 264, 100.00, 0, '2025-11-22 16:37:55', NULL),
(20, 34, 265, 100.00, 0, '2025-11-22 16:37:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_exam_results`
--

CREATE TABLE `exam_group_exam_results` (
  `id` int(11) NOT NULL,
  `exam_group_class_batch_exam_student_id` int(11) NOT NULL,
  `exam_group_class_batch_exam_subject_id` int(11) DEFAULT NULL,
  `attendence` varchar(10) DEFAULT NULL,
  `get_marks` float(10,2) DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `exam_group_student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `exam_group_exam_results`
--

INSERT INTO `exam_group_exam_results` (`id`, `exam_group_class_batch_exam_student_id`, `exam_group_class_batch_exam_subject_id`, `attendence`, `get_marks`, `note`, `is_active`, `created_at`, `updated_at`, `exam_group_student_id`) VALUES
(16376, 7500, 1552, 'present', 20.00, 'Good', 0, '2025-11-22 10:45:37', NULL, NULL),
(16377, 7499, 1552, 'present', 20.00, 'Good', 0, '2025-11-20 02:44:33', NULL, NULL),
(16378, 7498, 1552, 'present', 20.00, 'Good', 0, '2025-11-20 02:44:33', NULL, NULL),
(16379, 7497, 1552, 'present', 20.00, 'Good', 0, '2025-11-20 02:44:33', NULL, NULL),
(16380, 7496, 1552, 'present', 20.00, 'Good', 0, '2025-11-20 02:44:33', NULL, NULL),
(16381, 7495, 1552, 'present', 20.00, 'Good', 0, '2025-11-20 02:44:33', NULL, NULL),
(16382, 7494, 1552, 'present', 20.00, 'Good', 0, '2025-11-20 02:44:33', NULL, NULL),
(16383, 7493, 1552, 'present', 20.00, 'Good', 0, '2025-11-20 02:44:33', NULL, NULL),
(16384, 7492, 1552, 'present', 20.00, 'Good', 0, '2025-11-20 02:44:33', NULL, NULL),
(16385, 7491, 1552, 'present', 20.00, 'Good', 0, '2025-11-20 02:44:33', NULL, NULL),
(16386, 7500, 1553, 'present', 18.00, '', 0, '2025-11-20 02:45:12', NULL, NULL),
(16387, 7499, 1553, 'present', 20.00, '', 0, '2025-11-20 02:45:12', NULL, NULL),
(16388, 7498, 1553, 'present', 20.00, '', 0, '2025-11-20 02:45:12', NULL, NULL),
(16389, 7497, 1553, 'present', 20.00, '', 0, '2025-11-20 02:45:12', NULL, NULL),
(16390, 7496, 1553, 'present', 20.00, '', 0, '2025-11-20 02:45:12', NULL, NULL),
(16391, 7495, 1553, 'present', 20.00, '', 0, '2025-11-20 02:45:12', NULL, NULL),
(16392, 7494, 1553, 'present', 20.00, '', 0, '2025-11-20 02:45:12', NULL, NULL),
(16393, 7493, 1553, 'present', 20.00, '', 0, '2025-11-20 02:45:12', NULL, NULL),
(16394, 7492, 1553, 'present', 20.00, '', 0, '2025-11-20 02:45:12', NULL, NULL),
(16395, 7491, 1553, 'present', 20.00, '', 0, '2025-11-20 02:45:12', NULL, NULL),
(16396, 7500, 1554, 'present', 19.00, '', 0, '2025-11-20 02:45:34', NULL, NULL),
(16397, 7499, 1554, 'present', 20.00, '', 0, '2025-11-20 02:45:34', NULL, NULL),
(16398, 7498, 1554, 'present', 20.00, '', 0, '2025-11-20 02:45:34', NULL, NULL),
(16399, 7497, 1554, 'present', 20.00, '', 0, '2025-11-20 02:45:34', NULL, NULL),
(16400, 7496, 1554, 'present', 20.00, '', 0, '2025-11-20 02:45:34', NULL, NULL),
(16401, 7495, 1554, 'present', 20.00, '', 0, '2025-11-20 02:45:34', NULL, NULL),
(16402, 7494, 1554, 'present', 20.00, '', 0, '2025-11-20 02:45:34', NULL, NULL),
(16403, 7493, 1554, 'present', 20.00, '', 0, '2025-11-20 02:45:34', NULL, NULL),
(16404, 7492, 1554, 'present', 20.00, '', 0, '2025-11-20 02:45:34', NULL, NULL),
(16405, 7491, 1554, 'present', 20.00, '', 0, '2025-11-20 02:45:34', NULL, NULL),
(16406, 7500, 1555, 'present', 18.00, '', 0, '2025-11-20 02:46:12', NULL, NULL),
(16407, 7499, 1555, 'present', 20.00, '', 0, '2025-11-20 02:46:12', NULL, NULL),
(16408, 7498, 1555, 'present', 20.00, '', 0, '2025-11-20 02:46:12', NULL, NULL),
(16409, 7497, 1555, 'present', 20.00, '', 0, '2025-11-20 02:46:12', NULL, NULL),
(16410, 7496, 1555, 'present', 20.00, '', 0, '2025-11-20 02:46:12', NULL, NULL),
(16411, 7495, 1555, 'present', 20.00, '', 0, '2025-11-20 02:46:12', NULL, NULL),
(16412, 7494, 1555, 'present', 20.00, '', 0, '2025-11-20 02:46:12', NULL, NULL),
(16413, 7493, 1555, 'present', 20.00, '', 0, '2025-11-20 02:46:12', NULL, NULL),
(16414, 7492, 1555, 'present', 20.00, '', 0, '2025-11-20 02:46:12', NULL, NULL),
(16415, 7491, 1555, 'present', 20.00, '', 0, '2025-11-20 02:46:12', NULL, NULL),
(16416, 7500, 1556, 'present', 18.00, '', 0, '2025-11-20 02:46:41', NULL, NULL),
(16417, 7499, 1556, 'present', 20.00, '', 0, '2025-11-20 02:46:41', NULL, NULL),
(16418, 7498, 1556, 'present', 20.00, '', 0, '2025-11-20 02:46:41', NULL, NULL),
(16419, 7497, 1556, 'present', 20.00, '', 0, '2025-11-20 02:46:41', NULL, NULL),
(16420, 7496, 1556, 'present', 20.00, '', 0, '2025-11-20 02:46:41', NULL, NULL),
(16421, 7495, 1556, 'present', 20.00, '', 0, '2025-11-20 02:46:41', NULL, NULL),
(16422, 7494, 1556, 'present', 20.00, '', 0, '2025-11-20 02:46:41', NULL, NULL),
(16423, 7493, 1556, 'present', 20.00, '', 0, '2025-11-20 02:46:41', NULL, NULL),
(16424, 7492, 1556, 'present', 20.00, '', 0, '2025-11-20 02:46:41', NULL, NULL),
(16425, 7491, 1556, 'present', 20.00, '', 0, '2025-11-20 02:46:41', NULL, NULL),
(16426, 7500, 1557, 'present', 18.00, '', 0, '2025-11-20 02:47:07', NULL, NULL),
(16427, 7499, 1557, 'present', 20.00, '', 0, '2025-11-20 02:47:07', NULL, NULL),
(16428, 7498, 1557, 'present', 20.00, '', 0, '2025-11-20 02:47:07', NULL, NULL),
(16429, 7497, 1557, 'present', 20.00, '', 0, '2025-11-20 02:47:07', NULL, NULL),
(16430, 7496, 1557, 'present', 20.00, '', 0, '2025-11-20 02:47:07', NULL, NULL),
(16431, 7495, 1557, 'present', 20.00, '', 0, '2025-11-20 02:47:07', NULL, NULL),
(16432, 7494, 1557, 'present', 20.00, '', 0, '2025-11-20 02:47:07', NULL, NULL),
(16433, 7493, 1557, 'present', 20.00, '', 0, '2025-11-20 02:47:07', NULL, NULL),
(16434, 7492, 1557, 'present', 20.00, '', 0, '2025-11-20 02:47:07', NULL, NULL),
(16435, 7491, 1557, 'present', 20.00, '', 0, '2025-11-20 02:47:07', NULL, NULL),
(16436, 7520, 1560, 'present', 78.00, '', 0, '2025-11-20 16:11:26', NULL, NULL),
(16437, 7519, 1560, 'present', 80.00, '', 0, '2025-11-20 16:11:26', NULL, NULL),
(16438, 7518, 1560, 'present', 80.00, '', 0, '2025-11-20 16:11:26', NULL, NULL),
(16439, 7517, 1560, 'present', 80.00, '', 0, '2025-11-20 16:11:26', NULL, NULL),
(16440, 7516, 1560, 'present', 80.00, '', 0, '2025-11-20 16:11:26', NULL, NULL),
(16441, 7515, 1560, 'present', 80.00, '', 0, '2025-11-20 16:11:26', NULL, NULL),
(16442, 7514, 1560, 'present', 80.00, '', 0, '2025-11-20 16:11:26', NULL, NULL),
(16443, 7513, 1560, 'present', 80.00, '', 0, '2025-11-20 16:11:26', NULL, NULL),
(16444, 7512, 1560, 'present', 80.00, '', 0, '2025-11-20 16:11:26', NULL, NULL),
(16445, 7511, 1560, 'present', 80.00, '', 0, '2025-11-20 16:11:26', NULL, NULL),
(16446, 7520, 1561, 'present', 76.00, '', 0, '2025-11-20 16:12:14', NULL, NULL),
(16447, 7519, 1561, 'present', 80.00, '', 0, '2025-11-20 16:12:14', NULL, NULL),
(16448, 7518, 1561, 'present', 80.00, '', 0, '2025-11-20 16:12:14', NULL, NULL),
(16449, 7517, 1561, 'present', 80.00, '', 0, '2025-11-20 16:12:14', NULL, NULL),
(16450, 7516, 1561, 'present', 80.00, '', 0, '2025-11-20 16:12:14', NULL, NULL),
(16451, 7515, 1561, 'present', 80.00, '', 0, '2025-11-20 16:12:14', NULL, NULL),
(16452, 7514, 1561, 'present', 80.00, '', 0, '2025-11-20 16:12:14', NULL, NULL),
(16453, 7513, 1561, 'present', 80.00, '', 0, '2025-11-20 16:12:14', NULL, NULL),
(16454, 7512, 1561, 'present', 80.00, '', 0, '2025-11-20 16:12:14', NULL, NULL),
(16455, 7511, 1561, 'present', 80.00, '', 0, '2025-11-20 16:12:14', NULL, NULL),
(16456, 7520, 1562, 'present', 75.00, '', 0, '2025-11-20 16:12:58', NULL, NULL),
(16457, 7519, 1562, 'present', 80.00, '', 0, '2025-11-20 16:12:58', NULL, NULL),
(16458, 7518, 1562, 'present', 80.00, '', 0, '2025-11-20 16:12:58', NULL, NULL),
(16459, 7517, 1562, 'present', 80.00, '', 0, '2025-11-20 16:12:58', NULL, NULL),
(16460, 7516, 1562, 'present', 80.00, '', 0, '2025-11-20 16:12:58', NULL, NULL),
(16461, 7515, 1562, 'present', 80.00, '', 0, '2025-11-20 16:12:58', NULL, NULL),
(16462, 7514, 1562, 'present', 80.00, '', 0, '2025-11-20 16:12:58', NULL, NULL),
(16463, 7513, 1562, 'present', 80.00, '', 0, '2025-11-20 16:12:58', NULL, NULL),
(16464, 7512, 1562, 'present', 80.00, '', 0, '2025-11-20 16:12:58', NULL, NULL),
(16465, 7511, 1562, 'present', 80.00, '', 0, '2025-11-20 16:12:58', NULL, NULL),
(16466, 7520, 1563, 'present', 76.00, '', 0, '2025-11-20 16:13:33', NULL, NULL),
(16467, 7519, 1563, 'present', 80.00, '', 0, '2025-11-20 16:13:33', NULL, NULL),
(16468, 7518, 1563, 'present', 80.00, '', 0, '2025-11-20 16:13:33', NULL, NULL),
(16469, 7517, 1563, 'present', 80.00, '', 0, '2025-11-20 16:13:33', NULL, NULL),
(16470, 7516, 1563, 'present', 80.00, '', 0, '2025-11-20 16:13:33', NULL, NULL),
(16471, 7515, 1563, 'present', 80.00, '', 0, '2025-11-20 16:13:33', NULL, NULL),
(16472, 7514, 1563, 'present', 80.00, '', 0, '2025-11-20 16:13:33', NULL, NULL),
(16473, 7513, 1563, 'present', 80.00, '', 0, '2025-11-20 16:13:33', NULL, NULL),
(16474, 7512, 1563, 'present', 80.00, '', 0, '2025-11-20 16:13:33', NULL, NULL),
(16475, 7511, 1563, 'present', 80.00, '', 0, '2025-11-20 16:13:33', NULL, NULL),
(16476, 7520, 1564, 'present', 71.00, '', 0, '2025-11-20 16:15:12', NULL, NULL),
(16477, 7519, 1564, 'present', 80.00, '', 0, '2025-11-20 16:14:15', NULL, NULL),
(16478, 7518, 1564, 'present', 80.00, '', 0, '2025-11-20 16:14:15', NULL, NULL),
(16479, 7517, 1564, 'present', 80.00, '', 0, '2025-11-20 16:14:15', NULL, NULL),
(16480, 7516, 1564, 'present', 80.00, '', 0, '2025-11-20 16:14:15', NULL, NULL),
(16481, 7515, 1564, 'present', 80.00, '', 0, '2025-11-20 16:14:15', NULL, NULL),
(16482, 7514, 1564, 'present', 80.00, '', 0, '2025-11-20 16:14:15', NULL, NULL),
(16483, 7513, 1564, 'present', 80.00, '', 0, '2025-11-20 16:14:15', NULL, NULL),
(16484, 7512, 1564, 'present', 80.00, '', 0, '2025-11-20 16:14:15', NULL, NULL),
(16485, 7511, 1564, 'present', 80.00, '', 0, '2025-11-20 16:14:15', NULL, NULL),
(16486, 7520, 1565, 'present', 70.00, '', 0, '2025-11-20 16:14:50', NULL, NULL),
(16487, 7519, 1565, 'present', 80.00, '', 0, '2025-11-20 16:14:50', NULL, NULL),
(16488, 7518, 1565, 'present', 80.00, '', 0, '2025-11-20 16:14:50', NULL, NULL),
(16489, 7517, 1565, 'present', 80.00, '', 0, '2025-11-20 16:14:50', NULL, NULL),
(16490, 7516, 1565, 'present', 80.00, '', 0, '2025-11-20 16:14:50', NULL, NULL),
(16491, 7515, 1565, 'present', 80.00, '', 0, '2025-11-20 16:14:50', NULL, NULL),
(16492, 7514, 1565, 'present', 80.00, '', 0, '2025-11-20 16:14:50', NULL, NULL),
(16493, 7513, 1565, 'present', 80.00, '', 0, '2025-11-20 16:14:50', NULL, NULL),
(16494, 7512, 1565, 'present', 80.00, '', 0, '2025-11-20 16:14:50', NULL, NULL),
(16495, 7511, 1565, 'present', 80.00, '', 0, '2025-11-20 16:14:50', NULL, NULL),
(16496, 7530, 1566, 'present', 18.00, '', 0, '2025-11-20 16:30:51', NULL, NULL),
(16497, 7529, 1566, 'present', 20.00, '', 0, '2025-11-20 16:30:51', NULL, NULL),
(16498, 7528, 1566, 'present', 20.00, '', 0, '2025-11-20 16:30:51', NULL, NULL),
(16499, 7527, 1566, 'present', 20.00, '', 0, '2025-11-20 16:30:51', NULL, NULL),
(16500, 7526, 1566, 'present', 20.00, '', 0, '2025-11-20 16:30:51', NULL, NULL),
(16501, 7525, 1566, 'present', 20.00, '', 0, '2025-11-20 16:30:51', NULL, NULL),
(16502, 7524, 1566, 'present', 20.00, '', 0, '2025-11-20 16:30:51', NULL, NULL),
(16503, 7523, 1566, 'present', 20.00, '', 0, '2025-11-20 16:30:51', NULL, NULL),
(16504, 7522, 1566, 'present', 20.00, '', 0, '2025-11-20 16:30:51', NULL, NULL),
(16505, 7521, 1566, 'present', 20.00, '', 0, '2025-11-20 16:30:51', NULL, NULL),
(16506, 7530, 1567, 'present', 19.00, '', 0, '2025-11-20 16:31:28', NULL, NULL),
(16507, 7529, 1567, 'present', 20.00, '', 0, '2025-11-20 16:31:28', NULL, NULL),
(16508, 7528, 1567, 'present', 20.00, '', 0, '2025-11-20 16:31:28', NULL, NULL),
(16509, 7527, 1567, 'present', 20.00, '', 0, '2025-11-20 16:31:28', NULL, NULL),
(16510, 7526, 1567, 'present', 20.00, '', 0, '2025-11-20 16:31:28', NULL, NULL),
(16511, 7525, 1567, 'present', 20.00, '', 0, '2025-11-20 16:31:28', NULL, NULL),
(16512, 7524, 1567, 'present', 20.00, '', 0, '2025-11-20 16:31:28', NULL, NULL),
(16513, 7523, 1567, 'present', 20.00, '', 0, '2025-11-20 16:31:28', NULL, NULL),
(16514, 7522, 1567, 'present', 20.00, '', 0, '2025-11-20 16:31:28', NULL, NULL),
(16515, 7521, 1567, 'present', 20.00, '', 0, '2025-11-20 16:31:28', NULL, NULL),
(16516, 7530, 1568, 'present', 16.00, '', 0, '2025-11-20 16:31:57', NULL, NULL),
(16517, 7529, 1568, 'present', 20.00, '', 0, '2025-11-20 16:31:57', NULL, NULL),
(16518, 7528, 1568, 'present', 20.00, '', 0, '2025-11-20 16:31:57', NULL, NULL),
(16519, 7527, 1568, 'present', 20.00, '', 0, '2025-11-20 16:31:57', NULL, NULL),
(16520, 7526, 1568, 'present', 20.00, '', 0, '2025-11-20 16:31:57', NULL, NULL),
(16521, 7525, 1568, 'present', 20.00, '', 0, '2025-11-20 16:31:57', NULL, NULL),
(16522, 7524, 1568, 'present', 20.00, '', 0, '2025-11-20 16:31:57', NULL, NULL),
(16523, 7523, 1568, 'present', 20.00, '', 0, '2025-11-20 16:31:57', NULL, NULL),
(16524, 7522, 1568, 'present', 20.00, '', 0, '2025-11-20 16:31:57', NULL, NULL),
(16525, 7521, 1568, 'present', 20.00, '', 0, '2025-11-20 16:31:57', NULL, NULL),
(16526, 7530, 1569, 'present', 14.00, '', 0, '2025-11-20 16:32:48', NULL, NULL),
(16527, 7529, 1569, 'present', 20.00, '', 0, '2025-11-20 16:32:48', NULL, NULL),
(16528, 7528, 1569, 'present', 20.00, '', 0, '2025-11-20 16:32:48', NULL, NULL),
(16529, 7527, 1569, 'present', 20.00, '', 0, '2025-11-20 16:32:48', NULL, NULL),
(16530, 7526, 1569, 'present', 20.00, '', 0, '2025-11-20 16:32:48', NULL, NULL),
(16531, 7525, 1569, 'present', 20.00, '', 0, '2025-11-20 16:32:48', NULL, NULL),
(16532, 7524, 1569, 'present', 20.00, '', 0, '2025-11-20 16:32:48', NULL, NULL),
(16533, 7523, 1569, 'present', 20.00, '', 0, '2025-11-20 16:32:48', NULL, NULL),
(16534, 7522, 1569, 'present', 20.00, '', 0, '2025-11-20 16:32:48', NULL, NULL),
(16535, 7521, 1569, 'present', 20.00, '', 0, '2025-11-20 16:32:48', NULL, NULL),
(16536, 7530, 1571, 'present', 19.00, '', 0, '2025-11-20 16:33:21', NULL, NULL),
(16537, 7529, 1571, 'present', 20.00, '', 0, '2025-11-20 16:33:21', NULL, NULL),
(16538, 7528, 1571, 'present', 20.00, '', 0, '2025-11-20 16:33:21', NULL, NULL),
(16539, 7527, 1571, 'present', 20.00, '', 0, '2025-11-20 16:33:21', NULL, NULL),
(16540, 7526, 1571, 'present', 20.00, '', 0, '2025-11-20 16:33:21', NULL, NULL),
(16541, 7525, 1571, 'present', 20.00, '', 0, '2025-11-20 16:33:21', NULL, NULL),
(16542, 7524, 1571, 'present', 20.00, '', 0, '2025-11-20 16:33:21', NULL, NULL),
(16543, 7523, 1571, 'present', 20.00, '', 0, '2025-11-20 16:33:21', NULL, NULL),
(16544, 7522, 1571, 'present', 20.00, '', 0, '2025-11-20 16:33:21', NULL, NULL),
(16545, 7521, 1571, 'present', 20.00, '', 0, '2025-11-20 16:33:21', NULL, NULL),
(16546, 7530, 1570, 'present', 18.00, '', 0, '2025-11-20 16:34:02', NULL, NULL),
(16547, 7529, 1570, 'present', 20.00, '', 0, '2025-11-20 16:34:02', NULL, NULL),
(16548, 7528, 1570, 'present', 20.00, '', 0, '2025-11-20 16:34:02', NULL, NULL),
(16549, 7527, 1570, 'present', 20.00, '', 0, '2025-11-20 16:34:02', NULL, NULL),
(16550, 7526, 1570, 'present', 20.00, '', 0, '2025-11-20 16:34:02', NULL, NULL),
(16551, 7525, 1570, 'present', 20.00, '', 0, '2025-11-20 16:34:02', NULL, NULL),
(16552, 7524, 1570, 'present', 20.00, '', 0, '2025-11-20 16:34:02', NULL, NULL),
(16553, 7523, 1570, 'present', 20.00, '', 0, '2025-11-20 16:34:02', NULL, NULL),
(16554, 7522, 1570, 'present', 20.00, '', 0, '2025-11-20 16:34:02', NULL, NULL),
(16555, 7521, 1570, 'present', 20.00, '', 0, '2025-11-20 16:34:02', NULL, NULL),
(16556, 7540, 1572, 'present', 76.00, '', 0, '2025-11-20 16:36:00', NULL, NULL),
(16557, 7539, 1572, 'present', 80.00, '', 0, '2025-11-20 16:36:00', NULL, NULL),
(16558, 7538, 1572, 'present', 80.00, '', 0, '2025-11-20 16:36:00', NULL, NULL),
(16559, 7537, 1572, 'present', 80.00, '', 0, '2025-11-20 16:36:00', NULL, NULL),
(16560, 7536, 1572, 'present', 80.00, '', 0, '2025-11-20 16:36:00', NULL, NULL),
(16561, 7535, 1572, 'present', 80.00, '', 0, '2025-11-20 16:36:00', NULL, NULL),
(16562, 7534, 1572, 'present', 80.00, '', 0, '2025-11-20 16:36:00', NULL, NULL),
(16563, 7533, 1572, 'present', 80.00, '', 0, '2025-11-20 16:36:00', NULL, NULL),
(16564, 7532, 1572, 'present', 80.00, '', 0, '2025-11-20 16:36:00', NULL, NULL),
(16565, 7531, 1572, 'present', 80.00, '', 0, '2025-11-20 16:36:00', NULL, NULL),
(16566, 7540, 1573, 'present', 75.00, '', 0, '2025-11-20 16:36:34', NULL, NULL),
(16567, 7539, 1573, 'present', 80.00, '', 0, '2025-11-20 16:36:34', NULL, NULL),
(16568, 7538, 1573, 'present', 80.00, '', 0, '2025-11-20 16:36:34', NULL, NULL),
(16569, 7537, 1573, 'present', 80.00, '', 0, '2025-11-20 16:36:34', NULL, NULL),
(16570, 7536, 1573, 'present', 80.00, '', 0, '2025-11-20 16:36:34', NULL, NULL),
(16571, 7535, 1573, 'present', 80.00, '', 0, '2025-11-20 16:36:34', NULL, NULL),
(16572, 7534, 1573, 'present', 80.00, '', 0, '2025-11-20 16:36:34', NULL, NULL),
(16573, 7533, 1573, 'present', 80.00, '', 0, '2025-11-20 16:36:34', NULL, NULL),
(16574, 7532, 1573, 'present', 80.00, '', 0, '2025-11-20 16:36:34', NULL, NULL),
(16575, 7531, 1573, 'present', 80.00, '', 0, '2025-11-20 16:36:34', NULL, NULL),
(16576, 7540, 1574, 'present', 74.00, '', 0, '2025-11-20 16:37:05', NULL, NULL),
(16577, 7539, 1574, 'present', 80.00, '', 0, '2025-11-20 16:37:05', NULL, NULL),
(16578, 7538, 1574, 'present', 80.00, '', 0, '2025-11-20 16:37:05', NULL, NULL),
(16579, 7537, 1574, 'present', 80.00, '', 0, '2025-11-20 16:37:05', NULL, NULL),
(16580, 7536, 1574, 'present', 80.00, '', 0, '2025-11-20 16:37:05', NULL, NULL),
(16581, 7535, 1574, 'present', 80.00, '', 0, '2025-11-20 16:37:05', NULL, NULL),
(16582, 7534, 1574, 'present', 80.00, '', 0, '2025-11-20 16:37:05', NULL, NULL),
(16583, 7533, 1574, 'present', 80.00, '', 0, '2025-11-20 16:37:05', NULL, NULL),
(16584, 7532, 1574, 'present', 80.00, '', 0, '2025-11-20 16:37:05', NULL, NULL),
(16585, 7531, 1574, 'present', 80.00, '', 0, '2025-11-20 16:37:05', NULL, NULL),
(16586, 7540, 1575, 'present', 78.00, '', 0, '2025-11-20 16:37:36', NULL, NULL),
(16587, 7539, 1575, 'present', 80.00, '', 0, '2025-11-20 16:37:36', NULL, NULL),
(16588, 7538, 1575, 'present', 80.00, '', 0, '2025-11-20 16:37:36', NULL, NULL),
(16589, 7537, 1575, 'present', 80.00, '', 0, '2025-11-20 16:37:36', NULL, NULL),
(16590, 7536, 1575, 'present', 80.00, '', 0, '2025-11-20 16:37:36', NULL, NULL),
(16591, 7535, 1575, 'present', 80.00, '', 0, '2025-11-20 16:37:36', NULL, NULL),
(16592, 7534, 1575, 'present', 80.00, '', 0, '2025-11-20 16:37:36', NULL, NULL),
(16593, 7533, 1575, 'present', 80.00, '', 0, '2025-11-20 16:37:36', NULL, NULL),
(16594, 7532, 1575, 'present', 80.00, '', 0, '2025-11-20 16:37:36', NULL, NULL),
(16595, 7531, 1575, 'present', 80.00, '', 0, '2025-11-20 16:37:36', NULL, NULL),
(16596, 7540, 1577, 'present', 79.00, '', 0, '2025-11-20 16:38:06', NULL, NULL),
(16597, 7539, 1577, 'present', 80.00, '', 0, '2025-11-20 16:38:06', NULL, NULL),
(16598, 7538, 1577, 'present', 80.00, '', 0, '2025-11-20 16:38:06', NULL, NULL),
(16599, 7537, 1577, 'present', 80.00, '', 0, '2025-11-20 16:38:06', NULL, NULL),
(16600, 7536, 1577, 'present', 80.00, '', 0, '2025-11-20 16:38:06', NULL, NULL),
(16601, 7535, 1577, 'present', 80.00, '', 0, '2025-11-20 16:38:06', NULL, NULL),
(16602, 7534, 1577, 'present', 80.00, '', 0, '2025-11-20 16:38:06', NULL, NULL),
(16603, 7533, 1577, 'present', 80.00, '', 0, '2025-11-20 16:38:06', NULL, NULL),
(16604, 7532, 1577, 'present', 80.00, '', 0, '2025-11-20 16:38:06', NULL, NULL),
(16605, 7531, 1577, 'present', 80.00, '', 0, '2025-11-20 16:38:06', NULL, NULL),
(16606, 7540, 1576, 'present', 72.00, '', 0, '2025-11-20 16:38:35', NULL, NULL),
(16607, 7539, 1576, 'present', 80.00, '', 0, '2025-11-20 16:38:35', NULL, NULL),
(16608, 7538, 1576, 'present', 80.00, '', 0, '2025-11-20 16:38:35', NULL, NULL),
(16609, 7537, 1576, 'present', 80.00, '', 0, '2025-11-20 16:38:35', NULL, NULL),
(16610, 7536, 1576, 'present', 80.00, '', 0, '2025-11-20 16:38:35', NULL, NULL),
(16611, 7535, 1576, 'present', 80.00, '', 0, '2025-11-20 16:38:35', NULL, NULL),
(16612, 7534, 1576, 'present', 80.00, '', 0, '2025-11-20 16:38:35', NULL, NULL),
(16613, 7533, 1576, 'present', 80.00, '', 0, '2025-11-20 16:38:35', NULL, NULL),
(16614, 7532, 1576, 'present', 80.00, '', 0, '2025-11-20 16:38:35', NULL, NULL),
(16615, 7531, 1576, 'present', 80.00, '', 0, '2025-11-20 16:38:35', NULL, NULL),
(16616, 7691, 1590, 'present', 79.00, '', 0, '2025-11-22 16:40:39', NULL, NULL),
(16617, 7692, 1590, 'present', 78.00, '', 0, '2025-11-22 16:40:39', NULL, NULL),
(16618, 7693, 1590, 'present', 78.00, '', 0, '2025-11-22 16:40:39', NULL, NULL),
(16619, 7691, 1592, 'present', 67.00, '', 0, '2025-11-22 16:51:51', NULL, NULL),
(16620, 7692, 1592, 'present', 68.00, '', 0, '2025-11-22 16:51:51', NULL, NULL),
(16621, 7693, 1592, 'present', 69.00, '', 0, '2025-11-22 16:51:51', NULL, NULL),
(16622, 7691, 1593, 'present', 78.00, '', 0, '2025-11-22 16:52:06', NULL, NULL),
(16623, 7692, 1593, 'present', 79.00, '', 0, '2025-11-22 16:52:06', NULL, NULL),
(16624, 7693, 1593, 'present', 78.00, '', 0, '2025-11-22 16:52:06', NULL, NULL),
(16625, 7691, 1594, 'present', 56.00, '', 0, '2025-11-22 16:52:40', NULL, NULL),
(16626, 7692, 1594, 'present', 57.00, '', 0, '2025-11-22 16:52:40', NULL, NULL),
(16627, 7693, 1594, 'present', 58.00, '', 0, '2025-11-22 16:52:40', NULL, NULL),
(16628, 7691, 1595, 'present', 78.00, '', 0, '2025-11-22 16:52:51', NULL, NULL),
(16629, 7692, 1595, 'present', 78.00, '', 0, '2025-11-22 16:52:51', NULL, NULL),
(16630, 7693, 1595, 'present', 78.00, '', 0, '2025-11-22 16:52:51', NULL, NULL),
(16631, 7694, 1591, 'present', 9.00, '', 0, '2025-11-22 16:53:22', NULL, NULL),
(16632, 7695, 1591, 'present', 8.00, '', 0, '2025-11-22 16:53:22', NULL, NULL),
(16633, 7696, 1591, 'present', 9.00, '', 0, '2025-11-22 16:53:22', NULL, NULL),
(16634, 7694, 1596, 'present', 9.00, '', 0, '2025-11-22 16:53:34', NULL, NULL),
(16635, 7695, 1596, 'present', 9.00, '', 0, '2025-11-22 16:53:34', NULL, NULL),
(16636, 7696, 1596, 'present', 9.00, '', 0, '2025-11-22 16:53:34', NULL, NULL),
(16637, 7694, 1597, 'present', 8.00, '', 0, '2025-11-22 16:53:43', NULL, NULL),
(16638, 7695, 1597, 'present', 8.00, '', 0, '2025-11-22 16:53:43', NULL, NULL),
(16639, 7696, 1597, 'present', 8.00, '', 0, '2025-11-22 16:53:43', NULL, NULL),
(16640, 7694, 1598, 'present', 7.00, '', 0, '2025-11-22 16:53:54', NULL, NULL),
(16641, 7695, 1598, 'present', 7.00, '', 0, '2025-11-22 16:53:54', NULL, NULL),
(16642, 7696, 1598, 'present', 8.00, '', 0, '2025-11-22 16:53:54', NULL, NULL),
(16643, 7694, 1599, 'present', 9.00, '', 0, '2025-11-22 16:54:03', NULL, NULL),
(16644, 7695, 1599, 'present', 9.00, '', 0, '2025-11-22 16:54:03', NULL, NULL),
(16645, 7696, 1599, 'present', 8.00, '', 0, '2025-11-22 16:54:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_students`
--

CREATE TABLE `exam_group_students` (
  `id` int(11) NOT NULL,
  `exam_group_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `attendence` varchar(10) NOT NULL,
  `exam_schedule_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `get_marks` float(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedules`
--

CREATE TABLE `exam_schedules` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `teacher_subject_id` int(11) DEFAULT NULL,
  `date_of_exam` date DEFAULT NULL,
  `start_to` varchar(50) DEFAULT NULL,
  `end_from` varchar(50) DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `full_marks` int(11) DEFAULT NULL,
  `passing_marks` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `exp_head_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `documents` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_head`
--

CREATE TABLE `expense_head` (
  `id` int(11) NOT NULL,
  `exp_category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `expense_head`
--

INSERT INTO `expense_head` (`id`, `exp_category`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Diesel', '', 'yes', 'no', '2023-04-04 05:17:37', NULL),
(3, 'petrol', '', 'yes', 'no', '2023-07-25 07:25:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feecategory`
--

CREATE TABLE `feecategory` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feemasters`
--

CREATE TABLE `feemasters` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `feetype_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_discounts`
--

CREATE TABLE `fees_discounts` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `fees_discounts`
--

INSERT INTO `fees_discounts` (`id`, `session_id`, `name`, `code`, `amount`, `description`, `is_active`, `created_at`) VALUES
(7, 30, 'Admission Fee', '2', 200.00, 'ww', 'no', '2025-11-18 13:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `fees_plan`
--

CREATE TABLE `fees_plan` (
  `id` int(11) NOT NULL,
  `fee_group_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `class_ids` text NOT NULL,
  `category_ids` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_plan`
--

INSERT INTO `fees_plan` (`id`, `fee_group_id`, `amount`, `class_ids`, `category_ids`, `created_at`) VALUES
(49, 18, 500.00, '[\"68\",\"69\",\"70\",\"71\",\"72\",\"73\",\"74\",\"75\",\"76\"]', '[\"128\"]', '2025-11-07 10:12:48'),
(50, 20, 1000.00, '[\"68\",\"69\"]', '[\"128\",\"129\"]', '2025-11-07 10:13:34'),
(51, 20, 1500.00, '[\"70\",\"71\"]', '[\"128\",\"129\"]', '2025-11-07 10:14:23'),
(52, 20, 2000.00, '[\"72\",\"73\"]', '[\"128\",\"129\"]', '2025-11-07 10:14:40'),
(53, 20, 2500.00, '[\"74\",\"75\",\"76\"]', '[\"128\",\"129\"]', '2025-11-07 10:14:59'),
(54, 21, 1000.00, '[\"68\",\"69\"]', '[\"128\",\"129\"]', '2025-11-07 10:15:14'),
(55, 21, 1500.00, '[\"70\",\"71\"]', '[\"128\",\"129\"]', '2025-11-07 10:15:28'),
(56, 21, 2000.00, '[\"72\"]', '[\"128\",\"129\"]', '2025-11-07 10:15:41'),
(57, 21, 2200.00, '[\"73\"]', '[\"128\",\"129\"]', '2025-11-07 10:15:53'),
(58, 21, 2300.00, '[\"74\"]', '[\"128\",\"129\"]', '2025-11-07 10:16:04'),
(59, 21, 2400.00, '[\"75\"]', '[\"128\",\"129\"]', '2025-11-07 10:16:16'),
(60, 21, 2500.00, '[\"76\"]', '[\"128\",\"129\"]', '2025-11-07 10:16:28'),
(61, 22, 1100.00, '[\"68\"]', '[\"128\",\"129\"]', '2025-11-07 10:16:41'),
(62, 22, 1200.00, '[\"69\"]', '[\"128\",\"129\"]', '2025-11-07 10:16:48'),
(63, 22, 1300.00, '[\"70\"]', '[\"128\",\"129\"]', '2025-11-07 10:16:57'),
(64, 22, 1400.00, '[\"71\"]', '[\"128\",\"129\"]', '2025-11-07 10:17:14'),
(65, 22, 1500.00, '[\"72\"]', '[\"128\",\"129\"]', '2025-11-07 10:18:14'),
(66, 22, 1600.00, '[\"73\"]', '[\"128\",\"129\"]', '2025-11-07 10:18:42'),
(67, 22, 1700.00, '[\"74\"]', '[\"128\",\"129\"]', '2025-11-07 10:18:56'),
(68, 22, 1800.00, '[\"75\"]', '[\"128\",\"129\"]', '2025-11-07 10:19:03'),
(69, 22, 1900.00, '[\"76\"]', '[\"128\",\"129\"]', '2025-11-07 10:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `fees_reminder`
--

CREATE TABLE `fees_reminder` (
  `id` int(11) NOT NULL,
  `reminder_type` varchar(10) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `fees_reminder`
--

INSERT INTO `fees_reminder` (`id`, `reminder_type`, `day`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'before', 2, 1, '2022-09-25 11:59:50', NULL),
(2, 'before', 5, 1, '2022-09-25 11:59:50', NULL),
(3, 'after', 2, 1, '2022-09-25 11:59:50', NULL),
(4, 'after', 5, 1, '2022-09-25 11:59:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feetype`
--

CREATE TABLE `feetype` (
  `id` int(11) NOT NULL,
  `is_system` int(11) NOT NULL DEFAULT 0,
  `feecategory_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `feetype`
--

INSERT INTO `feetype` (`id`, `is_system`, `feecategory_id`, `type`, `code`, `is_active`, `created_at`, `updated_at`, `description`) VALUES
(40, 1, NULL, 'Previous Session Balance', 'Previous Session Balance', 'no', '2022-09-24 11:32:25', NULL, ''),
(41, 0, NULL, 'Admission-Fee-April', 'Admission-Fee-April', 'no', '2024-04-12 04:35:02', NULL, 'Admission-Fee-April'),
(67, 0, NULL, 'Annual-Fee-April', 'Annual-Fee-April', 'no', '2024-04-12 04:34:50', NULL, 'Annual-Fee-April'),
(68, 0, NULL, 'Tution-Fee-April', 'Tution-Fee-April', 'no', '2024-04-12 04:35:22', NULL, 'Tution-Fee-April'),
(80, 0, NULL, 'Bus-Fee-April', 'Bus-Fee-April', 'no', '2024-04-12 04:53:05', NULL, 'Bus-Fee-April'),
(81, 0, NULL, 'Tution-Fee-May', 'Tution-Fee-May', 'no', '2024-04-12 04:53:16', NULL, 'Tution-Fee-May'),
(82, 0, NULL, 'Bus-Fee-May', 'Bus-Fee-May', 'no', '2024-04-12 04:53:27', NULL, 'Bus-Fee-May'),
(83, 0, NULL, 'Tution-Fee-Jun', 'Tution-Fee-Jun', 'no', '2024-04-12 04:54:09', NULL, 'Tution-Fee-Jun'),
(85, 0, NULL, 'Tution-Fee-July', 'Tution-Fee-July', 'no', '2024-04-12 04:54:50', NULL, 'Tution-Fee-July'),
(86, 0, NULL, 'Bus-Fee-July', 'Bus-Fee-July', 'no', '2024-04-12 04:55:04', NULL, 'Bus-Fee-July'),
(87, 0, NULL, 'Tution-Fee-Aug', 'Tution-Fee-Aug', 'no', '2024-04-12 04:55:27', NULL, 'Tution-Fee-Aug'),
(88, 0, NULL, 'Bus-Fee-Aug', 'Bus-Fee-Aug', 'no', '2024-04-12 04:55:37', NULL, 'Bus-Fee-Aug'),
(89, 0, NULL, 'Tution-Fee-Sep', 'Tution-Fee-Sep', 'no', '2024-04-12 04:55:55', NULL, 'Tution-Fee-Sep'),
(90, 0, NULL, 'Bus-Fee-Sep', 'Bus-Fee-Sep', 'no', '2024-04-12 04:56:05', NULL, 'Bus-Fee-Sep'),
(91, 0, NULL, 'Tution-Fee-Oct', 'Tution-Fee-Oct', 'no', '2024-04-12 05:01:54', NULL, 'Tution-Fee-Oct'),
(92, 0, NULL, 'Bus-Fee-Oct', 'Bus-Fee-Oct', 'no', '2024-04-12 05:02:07', NULL, 'Bus-Fee-Oct'),
(93, 0, NULL, 'Tution-Fee-Nov', 'Tution-Fee-Nov', 'no', '2024-04-12 05:02:22', NULL, 'Tution-Fee-Nov'),
(94, 0, NULL, 'Bus-Fee-Nov', 'Bus-Fee-Nov', 'no', '2024-04-12 05:02:35', NULL, 'Bus-Fee-Nov'),
(95, 0, NULL, 'Tution-Fee-Dec', 'Tution-Fee-Dec', 'no', '2024-04-12 05:02:49', NULL, 'Tution-Fee-Dec'),
(96, 0, NULL, 'Bus-Fee-Dec', 'Bus-Fee-Dec', 'no', '2024-04-12 05:03:02', NULL, 'Bus-Fee-Dec'),
(97, 0, NULL, 'Tution-FeeJan', 'Tution-FeeJan', 'no', '2024-04-12 05:03:24', NULL, 'Tution-FeeJan'),
(98, 0, NULL, 'Bus-Fee-Jan', 'Bus-Fee-Jan', 'no', '2024-04-12 05:03:38', NULL, 'Bus-Fee-Jan'),
(99, 0, NULL, 'Tution-Fee-Feb', 'Tution-Fee-Feb', 'no', '2024-04-12 05:03:53', NULL, 'Tution-Fee-Feb'),
(100, 0, NULL, 'Bus-Fee-Feb', 'Bus-Fee-Feb', 'no', '2024-04-12 05:04:03', NULL, 'Bus-Fee-Feb'),
(101, 0, NULL, 'Tution-Fee-March', 'Tution-Fee-March', 'no', '2024-04-12 05:04:14', NULL, 'Tution-Fee-March'),
(102, 0, NULL, 'Bus-Fee-March', 'Bus-Fee-March', 'no', '2024-04-12 05:04:24', NULL, 'Bus-Fee-March');

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

-- --------------------------------------------------------

--
-- Table structure for table `fee_groups`
--

CREATE TABLE `fee_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `is_system` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `fee_groups`
--

INSERT INTO `fee_groups` (`id`, `name`, `is_system`, `description`, `is_active`, `created_at`) VALUES
(109, 'Balance Master', 1, NULL, 'no', '2022-09-24 11:32:25'),
(128, 'NS-25-26', 0, 'New Student 2025-26', 'no', '2025-05-18 14:14:26'),
(129, 'OS-25-26', 0, 'Old Student 2025-26', 'no', '2025-05-18 14:14:46'),
(164, 'MW-25-26', 0, 'Management Ward-25-26', 'no', '2025-11-08 03:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `fee_groups_feetype`
--

CREATE TABLE `fee_groups_feetype` (
  `id` int(11) NOT NULL,
  `fee_session_group_id` int(11) DEFAULT NULL,
  `fee_groups_id` int(11) DEFAULT NULL,
  `feetype_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `fine_type` varchar(50) NOT NULL DEFAULT 'none',
  `due_date` date DEFAULT NULL,
  `fine_percentage` float(10,2) NOT NULL DEFAULT 0.00,
  `fine_amount` float(10,2) NOT NULL DEFAULT 0.00,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `fee_groups_feetype`
--

INSERT INTO `fee_groups_feetype` (`id`, `fee_session_group_id`, `fee_groups_id`, `feetype_id`, `session_id`, `amount`, `fine_type`, `due_date`, `fine_percentage`, `fine_amount`, `is_active`, `created_at`) VALUES
(181, 134, 128, 41, 30, 1000.00, 'none', '2024-04-01', 0.00, 0.00, 'no', '2024-04-12 04:39:03'),
(182, 134, 128, 67, 30, 1500.00, 'none', '2024-04-01', 0.00, 0.00, 'no', '2024-04-12 04:39:18'),
(183, 134, 128, 68, 30, 500.00, 'none', '2024-04-01', 0.00, 0.00, 'no', '2024-04-12 04:39:29'),
(185, 135, 129, 67, 30, 1500.00, 'none', '2024-04-01', 0.00, 0.00, 'no', '2024-04-12 04:40:39'),
(186, 135, 129, 68, 30, 500.00, 'none', '2024-04-01', 0.00, 0.00, 'no', '2024-04-12 04:40:50'),
(200, 134, 128, 81, 30, 500.00, 'none', '2024-05-01', 0.00, 0.00, 'no', '2024-04-12 05:10:04'),
(201, 134, 128, 83, 30, 500.00, 'none', '2024-06-01', 0.00, 0.00, 'no', '2024-04-12 05:10:20');

-- --------------------------------------------------------

--
-- Table structure for table `fee_head`
--

CREATE TABLE `fee_head` (
  `id` int(11) NOT NULL,
  `fees_heading` varchar(255) NOT NULL,
  `frequency` enum('Annual','Quarterly','Monthly') NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `months` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`months`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_head`
--

INSERT INTO `fee_head` (`id`, `fees_heading`, `frequency`, `account_name`, `months`, `created_at`) VALUES
(18, 'Registration Fee', 'Annual', 'Registration Fee', '[\"Apr\"]', '2025-11-07 10:09:39'),
(20, 'Annual Fee', 'Annual', 'Annual Fee', '[\"Apr\"]', '2025-11-07 10:10:27'),
(21, 'Composite Fee', 'Annual', 'Composite Fee', '[\"Apr\"]', '2025-11-07 10:10:48'),
(22, 'Monthly Fee', 'Monthly', 'Monthly Fee', '[\"Apr\",\"May\",\"Jun\",\"Jul\",\"Aug\",\"Sep\",\"Oct\",\"Nov\",\"Dec\",\"Jan\",\"Feb\",\"Mar\"]', '2025-11-07 10:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `fee_receipt_no`
--

CREATE TABLE `fee_receipt_no` (
  `id` int(11) NOT NULL,
  `payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_session_groups`
--

CREATE TABLE `fee_session_groups` (
  `id` int(11) NOT NULL,
  `fee_groups_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `fee_session_groups`
--

INSERT INTO `fee_session_groups` (`id`, `fee_groups_id`, `session_id`, `is_active`, `created_at`) VALUES
(134, 128, 30, 'no', '2024-04-12 04:39:03'),
(135, 129, 30, 'no', '2024-04-12 04:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `filetypes`
--

CREATE TABLE `filetypes` (
  `id` int(11) NOT NULL,
  `file_extension` text DEFAULT NULL,
  `file_mime` text DEFAULT NULL,
  `file_size` int(11) NOT NULL,
  `image_extension` text DEFAULT NULL,
  `image_mime` text DEFAULT NULL,
  `image_size` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `filetypes`
--

INSERT INTO `filetypes` (`id`, `file_extension`, `file_mime`, `file_size`, `image_extension`, `image_mime`, `image_size`, `created_at`) VALUES
(1, 'pdf, zip, jpg, jpeg, png, txt, 7z, gif, csv, docx, mp3, mp4, accdb, odt, ods, ppt, pptx, xlsx, wmv, jfif, apk, ppt, bmp, jpe, mdb, rar, xls, svg', 'application/pdf, image/zip, image/jpg, image/png, image/jpeg, text/plain, application/x-zip-compressed, application/zip, image/gif, text/csv, application/vnd.openxmlformats-officedocument.wordprocessingml.document, audio/mpeg, application/msaccess, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.spreadsheet, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, video/x-ms-wmv, video/mp4, image/jpeg, application/vnd.android.package-archive, application/x-msdownload, application/vnd.ms-powerpoint, image/bmp, image/jpeg, application/msaccess, application/vnd.ms-excel, image/svg+xml', 100048576, 'jfif, png, jpe, jpeg, jpg, bmp, gif, svg', 'image/jpeg, image/png, image/jpeg, image/jpeg, image/bmp, image/gif, image/x-ms-bmp, image/svg+xml', 10048576, '2021-01-30 13:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `follow_up`
--

CREATE TABLE `follow_up` (
  `id` int(11) NOT NULL,
  `enquiry_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `next_date` date NOT NULL,
  `response` text NOT NULL,
  `note` text NOT NULL,
  `followup_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_media_gallery`
--

CREATE TABLE `front_cms_media_gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `thumb_path` varchar(300) DEFAULT NULL,
  `dir_path` varchar(300) DEFAULT NULL,
  `img_name` varchar(300) DEFAULT NULL,
  `thumb_name` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file_type` varchar(100) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `vid_url` text NOT NULL,
  `vid_title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_menus`
--

CREATE TABLE `front_cms_menus` (
  `id` int(11) NOT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `open_new_tab` int(11) NOT NULL DEFAULT 0,
  `ext_url` text NOT NULL,
  `ext_url_link` text NOT NULL,
  `publish` int(11) NOT NULL DEFAULT 0,
  `content_type` varchar(10) NOT NULL DEFAULT 'manual',
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `front_cms_menus`
--

INSERT INTO `front_cms_menus` (`id`, `menu`, `slug`, `description`, `open_new_tab`, `ext_url`, `ext_url_link`, `publish`, `content_type`, `is_active`, `created_at`) VALUES
(1, 'Main Menu', 'main-menu', 'Main menu', 0, '', '', 0, 'default', 'no', '2018-04-20 14:54:49'),
(2, 'Bottom Menu', 'bottom-menu', 'Bottom Menu', 0, '', '', 0, 'default', 'no', '2018-04-20 14:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_menu_items`
--

CREATE TABLE `front_cms_menu_items` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ext_url` text DEFAULT NULL,
  `open_new_tab` int(11) DEFAULT 0,
  `ext_url_link` text DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `publish` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `front_cms_menu_items`
--

INSERT INTO `front_cms_menu_items` (`id`, `menu_id`, `menu`, `page_id`, `parent_id`, `ext_url`, `open_new_tab`, `ext_url_link`, `slug`, `weight`, `publish`, `description`, `is_active`, `created_at`) VALUES
(1, 1, 'Home', 1, 0, NULL, NULL, NULL, 'home', 1, 0, NULL, 'no', '2019-12-02 22:11:50'),
(2, 1, 'Contact Us', 76, 0, NULL, NULL, NULL, 'contact-us', 4, 0, NULL, 'no', '2019-12-02 22:11:52'),
(3, 1, 'Complain', 2, 0, NULL, NULL, NULL, 'complain', 3, 0, NULL, 'no', '2019-12-02 22:11:52'),
(4, 1, 'Admission', 0, 0, '1', NULL, 'http://yourschoolurl.com/online_admission', 'admssion', 2, 0, NULL, 'no', '2019-12-21 15:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_pages`
--

CREATE TABLE `front_cms_pages` (
  `id` int(11) NOT NULL,
  `page_type` varchar(10) NOT NULL DEFAULT 'manual',
  `is_homepage` int(11) DEFAULT 0,
  `title` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `feature_image` varchar(200) NOT NULL,
  `description` longtext DEFAULT NULL,
  `publish_date` date NOT NULL,
  `publish` int(11) DEFAULT 0,
  `sidebar` int(11) DEFAULT 0,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `front_cms_pages`
--

INSERT INTO `front_cms_pages` (`id`, `page_type`, `is_homepage`, `title`, `url`, `type`, `slug`, `meta_title`, `meta_description`, `meta_keyword`, `feature_image`, `description`, `publish_date`, `publish`, `sidebar`, `is_active`, `created_at`) VALUES
(1, 'default', 1, 'Home', 'page/home', 'page', 'home', '', '', '', '', '<p>home page</p>', '0000-00-00', 1, NULL, 'no', '2019-12-02 15:23:47'),
(2, 'default', 0, 'Complain', 'page/complain', 'page', 'complain', 'Complain form', '                                                                                                                                                                                    complain form                                                                                                                                                                                                                                ', 'complain form', '', '<p>[form-builder:complain]</p>', '0000-00-00', 1, NULL, 'no', '2019-11-13 10:16:36'),
(54, 'default', 0, '404 page', 'page/404-page', 'page', '404-page', '', '                                ', '', '', '<html>\r\n<head>\r\n <title></title>\r\n</head>\r\n<body>\r\n<p>404 page found</p>\r\n</body>\r\n</html>', '0000-00-00', 0, NULL, 'no', '2018-05-18 14:46:04'),
(76, 'default', 0, 'Contact us', 'page/contact-us', 'page', 'contact-us', '', '', '', '', '<section class=\"contact\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<h2 class=\"col-md-12 col-sm-12\">Send In Your Query</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div class=\"col-md-12 col-sm-12\">[form-builder:contact_us]<!--./row--></div>\r\n<!--./col-md-12--></div>\r\n<!--./row--></div>\r\n<!--./container--></section>\r\n\r\n<div class=\"col-md-4 col-sm-4\">\r\n<div class=\"contact-item\"><img src=\"http://192.168.1.81/repos/smartschool/uploads/gallery/media/pin.svg\" />\r\n<h3>Our Location</h3>\r\n\r\n<p>350 Fifth Avenue, 34th floor New York NY 10118-3299 USA</p>\r\n</div>\r\n<!--./contact-item--></div>\r\n<!--./col-md-4-->\r\n\r\n<div class=\"col-md-4 col-sm-4\">\r\n<div class=\"contact-item\"><img src=\"http://192.168.1.81/repos/smartschool/uploads/gallery/media/phone.svg\" />\r\n<h3>CALL US</h3>\r\n\r\n<p>E-mail : info@abcschool.com</p>\r\n\r\n<p>Mobile : +91-9009987654</p>\r\n</div>\r\n<!--./contact-item--></div>\r\n<!--./col-md-4-->\r\n\r\n<div class=\"col-md-4 col-sm-4\">\r\n<div class=\"contact-item\"><img src=\"http://192.168.1.81/repos/smartschool/uploads/gallery/media/clock.svg\" />\r\n<h3>Working Hours</h3>\r\n\r\n<p>Mon-Fri : 9 am to 5 pm</p>\r\n\r\n<p>Sat : 9 am to 3 pm</p>\r\n</div>\r\n<!--./contact-item--></div>\r\n<!--./col-md-4-->\r\n\r\n<div class=\"col-md-12 col-sm-12\">\r\n<div class=\"mapWrapper fullwidth\"><iframe frameborder=\"0\" height=\"500\" marginheight=\"0\" marginwidth=\"0\" scrolling=\"no\" src=\"http://maps.google.com/maps?f=q&source=s_q&hl=EN&q=time+square&aq=&sll=40.716558,-73.931122&sspn=0.40438,1.056747&ie=UTF8&rq=1&ev=p&split=1&radius=33.22&hq=time+square&hnear=&ll=37.061753,-95.677185&spn=0.438347,0.769043&z=9&output=embed\" width=\"100%\"></iframe></div>\r\n</div>', '0000-00-00', 0, NULL, 'no', '2019-05-04 15:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_page_contents`
--

CREATE TABLE `front_cms_page_contents` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `content_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_programs`
--

CREATE TABLE `front_cms_programs` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `event_start` date DEFAULT NULL,
  `event_end` date DEFAULT NULL,
  `event_venue` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `meta_title` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `feature_image` text NOT NULL,
  `publish_date` date NOT NULL,
  `publish` varchar(10) DEFAULT '0',
  `sidebar` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `front_cms_programs`
--

INSERT INTO `front_cms_programs` (`id`, `type`, `slug`, `url`, `title`, `date`, `event_start`, `event_end`, `event_venue`, `description`, `is_active`, `created_at`, `meta_title`, `meta_description`, `meta_keyword`, `feature_image`, `publish_date`, `publish`, `sidebar`) VALUES
(1, 'notice', 'ut-2-starts-from-15-nov-2025', 'read/ut-2-starts-from-15-nov-2025', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2025-11-07 15:45:36', '', '', '', '', '0000-00-00', '0', NULL),
(2, 'events', 'childrens-day-program-by-teachers', 'read/childrens-day-program-by-teachers', 'Children\'s day program by teachers', NULL, '2025-11-07', '2025-11-07', 'GIS', '<p><a class=\"detail_popover\" data-original-title=\"\" data-toggle=\"popover\" href=\"https://demo.smart-school.in/admin/front/events#\" style=\"box-sizing: border-box; color: rgb(68, 68, 68); text-decoration-line: none; transition: color 250ms ease-in-out, background-color 250ms ease-in-out; position: relative; overflow: hidden; display: table; cursor: default; font-family: Roboto, sans-serif; font-size: 13.3333px;\" title=\"\">Children\'s day program by teachers</a></p>', 'no', '2025-11-07 15:51:21', '', '', '', '', '0000-00-00', '0', NULL),
(3, 'notice', 'ut-2-starts-from-15-nov-2025-1', 'read/ut-2-starts-from-15-nov-2025-1', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2025-11-07 15:53:41', '', '', '', '', '0000-00-00', '0', NULL),
(4, 'notice', 'ut-2-starts-from-15-nov-2025-2', 'read/ut-2-starts-from-15-nov-2025-2', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2025-11-07 15:53:47', '', '', '', '', '0000-00-00', '0', NULL),
(5, 'notice', 'ut-2-starts-from-15-nov-2025-3', 'read/ut-2-starts-from-15-nov-2025-3', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2025-11-07 15:53:53', '', '', '', '', '0000-00-00', '0', NULL),
(6, 'notice', 'ut-2-starts-from-15-nov-2025-4', 'read/ut-2-starts-from-15-nov-2025-4', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2025-11-07 15:54:01', '', '', '', '', '0000-00-00', '0', NULL),
(7, 'notice', 'ut-2-starts-from-15-nov-2025-5', 'read/ut-2-starts-from-15-nov-2025-5', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2025-11-07 15:54:08', '', '', '', '', '0000-00-00', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_program_photos`
--

CREATE TABLE `front_cms_program_photos` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `media_gallery_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_settings`
--

CREATE TABLE `front_cms_settings` (
  `id` int(11) NOT NULL,
  `theme` varchar(50) DEFAULT NULL,
  `is_active_rtl` int(11) DEFAULT 0,
  `is_active_front_cms` int(11) DEFAULT 0,
  `is_active_sidebar` int(11) DEFAULT 0,
  `logo` varchar(200) DEFAULT NULL,
  `contact_us_email` varchar(100) DEFAULT NULL,
  `complain_form_email` varchar(100) DEFAULT NULL,
  `sidebar_options` text NOT NULL,
  `whatsapp_url` varchar(255) NOT NULL,
  `fb_url` varchar(200) NOT NULL,
  `twitter_url` varchar(200) NOT NULL,
  `youtube_url` varchar(200) NOT NULL,
  `google_plus` varchar(200) NOT NULL,
  `instagram_url` varchar(200) NOT NULL,
  `pinterest_url` varchar(200) NOT NULL,
  `linkedin_url` varchar(200) NOT NULL,
  `google_analytics` text DEFAULT NULL,
  `footer_text` varchar(500) DEFAULT NULL,
  `fav_icon` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `front_cms_settings`
--

INSERT INTO `front_cms_settings` (`id`, `theme`, `is_active_rtl`, `is_active_front_cms`, `is_active_sidebar`, `logo`, `contact_us_email`, `complain_form_email`, `sidebar_options`, `whatsapp_url`, `fb_url`, `twitter_url`, `youtube_url`, `google_plus`, `instagram_url`, `pinterest_url`, `linkedin_url`, `google_analytics`, `footer_text`, `fav_icon`, `created_at`) VALUES
(1, 'material_pink', NULL, NULL, NULL, NULL, '', '', '[\"news\",\"complain\"]', '', '', '', '', '', '', '', '', '', '', '', '2020-02-28 13:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `general_calls`
--

CREATE TABLE `general_calls` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `follow_up_date` date NOT NULL,
  `call_dureation` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `call_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `exam_type` varchar(250) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `point` float(10,1) DEFAULT NULL,
  `mark_from` float(10,2) DEFAULT NULL,
  `mark_upto` float(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `exam_type`, `name`, `point`, `mark_from`, `mark_upto`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'basic_system', 'E (FAIL)', 0.0, 32.99, 0.00, '', 'no', '2023-03-24 12:55:20', NULL),
(3, 'basic_system', 'D', 0.0, 40.99, 33.00, '', 'no', '2023-03-24 12:55:29', NULL),
(4, 'basic_system', 'C2', 0.0, 50.99, 41.00, '', 'no', '2023-03-24 12:55:42', NULL),
(5, 'basic_system', 'C1', 0.0, 60.99, 51.00, '', 'no', '2023-03-24 12:55:48', NULL),
(6, 'basic_system', 'B2', 0.0, 70.99, 61.00, '', 'no', '2023-03-24 12:55:58', NULL),
(7, 'basic_system', 'B1', 0.0, 80.99, 71.00, '', 'no', '2023-03-24 12:56:05', NULL),
(8, 'basic_system', 'A2', 0.0, 90.99, 81.00, '', 'no', '2023-03-24 12:56:13', NULL),
(9, 'basic_system', 'A1', 0.0, 100.00, 91.00, '', 'no', '2023-03-24 11:40:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `homework_date` date NOT NULL,
  `submit_date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `subject_group_subject_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `create_date` date NOT NULL,
  `evaluation_date` date NOT NULL,
  `document` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `evaluated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homework_evaluation`
--

CREATE TABLE `homework_evaluation` (
  `id` int(11) NOT NULL,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `id` int(11) NOT NULL,
  `hostel_name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `intake` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hostel_rooms`
--

CREATE TABLE `hostel_rooms` (
  `id` int(11) NOT NULL,
  `hostel_id` int(11) DEFAULT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `room_no` varchar(200) DEFAULT NULL,
  `no_of_bed` int(11) DEFAULT NULL,
  `cost_per_bed` float(10,2) DEFAULT 0.00,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `id_card`
--

CREATE TABLE `id_card` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `school_address` varchar(500) NOT NULL,
  `background` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `sign_image` varchar(100) NOT NULL,
  `header_color` varchar(100) NOT NULL,
  `enable_admission_no` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_student_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_class` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_fathers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_mothers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_address` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_phone` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_dob` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_blood_group` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `status` tinyint(1) NOT NULL COMMENT '0=disable,1=enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `id_card`
--

INSERT INTO `id_card` (`id`, `title`, `school_name`, `school_address`, `background`, `logo`, `sign_image`, `header_color`, `enable_admission_no`, `enable_student_name`, `enable_class`, `enable_fathers_name`, `enable_mothers_name`, `enable_address`, `enable_phone`, `enable_dob`, `enable_blood_group`, `status`) VALUES
(3, 'STUDNET ID Card', 'GURUKUL INTERNATIONAL', 'Shiv Vihar Colony, Railpar Shamli', '', 'logo3.png', '', '', 1, 1, 1, 1, 1, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `inc_head_id` varchar(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `documents` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `inc_head_id`, `name`, `invoice_no`, `date`, `amount`, `note`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `documents`) VALUES
(1, '2', 'Tour Fee', '1', '2025-11-09', 500, 'Tour Fee', 'yes', 'no', '2025-11-09 05:20:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `income_head`
--

CREATE TABLE `income_head` (
  `id` int(11) NOT NULL,
  `income_category` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'yes',
  `is_deleted` varchar(255) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `income_head`
--

INSERT INTO `income_head` (`id`, `income_category`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2, 'Tour Fee', 'Tour Fee', 'yes', 'no', '2025-11-09 05:19:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `item_photo` varchar(225) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `item_store_id` int(11) DEFAULT NULL,
  `item_supplier_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_category_id`, `name`, `unit`, `item_photo`, `description`, `created_at`, `updated_at`, `item_store_id`, `item_supplier_id`, `quantity`, `date`) VALUES
(1, 1, 'Tour Fee', '1', NULL, 'Tour Fee', '2025-11-09 05:23:51', NULL, NULL, NULL, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(11) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'yes',
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `item_category`, `is_active`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Tour Fee', 'yes', 'Tour Fee', '2025-11-09 05:23:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_issue`
--

CREATE TABLE `item_issue` (
  `id` int(11) NOT NULL,
  `issue_type` varchar(15) DEFAULT NULL,
  `issue_to` varchar(100) DEFAULT NULL,
  `issue_by` varchar(100) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `note` text NOT NULL,
  `is_returned` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` varchar(10) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_stock`
--

CREATE TABLE `item_stock` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `symbol` varchar(10) NOT NULL DEFAULT '+',
  `store_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `purchase_price` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `attachment` varchar(250) DEFAULT NULL,
  `description` text NOT NULL,
  `is_active` varchar(10) DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_store`
--

CREATE TABLE `item_store` (
  `id` int(11) NOT NULL,
  `item_store` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_supplier`
--

CREATE TABLE `item_supplier` (
  `id` int(11) NOT NULL,
  `item_supplier` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_phone` varchar(255) NOT NULL,
  `contact_person_email` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `short_code` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `is_deleted` varchar(10) NOT NULL DEFAULT 'yes',
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `short_code`, `country_code`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Azerbaijan', 'az', 'az', 'no', 'no', '2019-11-20 11:23:12', '0000-00-00'),
(2, 'Albanian', 'sq', 'al', 'no', 'no', '2019-11-20 11:42:42', '0000-00-00'),
(3, 'Amharic', 'am', 'am', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(4, 'English', 'en', 'us', 'no', 'no', '2019-11-20 11:38:50', '0000-00-00'),
(5, 'Arabic', 'ar', 'sa', 'no', 'no', '2019-11-20 11:47:28', '0000-00-00'),
(7, 'Afrikaans', 'af', 'af', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(8, 'Basque', 'eu', 'es', 'no', 'no', '2019-11-20 11:54:10', '0000-00-00'),
(11, 'Bengali', 'bn', 'in', 'no', 'no', '2019-11-20 11:41:53', '0000-00-00'),
(13, 'Bosnian', 'bs', 'bs', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(14, 'Welsh', 'cy', 'cy', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(15, 'Hungarian', 'hu', 'hu', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(16, 'Vietnamese', 'vi', 'vi', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(17, 'Haitian', 'ht', 'ht', 'no', 'no', '2021-01-23 07:09:32', '0000-00-00'),
(18, 'Galician', 'gl', 'gl', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(19, 'Dutch', 'nl', 'nl', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(21, 'Greek', 'el', 'gr', 'no', 'no', '2019-11-20 12:12:08', '0000-00-00'),
(22, 'Georgian', 'ka', 'ge', 'no', 'no', '2019-11-20 12:11:40', '0000-00-00'),
(23, 'Gujarati', 'gu', 'in', 'no', 'no', '2019-11-20 11:39:16', '0000-00-00'),
(24, 'Danish', 'da', 'dk', 'no', 'no', '2019-11-20 12:03:25', '0000-00-00'),
(25, 'Hebrew', 'he', 'il', 'no', 'no', '2019-11-20 12:13:50', '0000-00-00'),
(26, 'Yiddish', 'yi', 'il', 'no', 'no', '2019-11-20 12:25:33', '0000-00-00'),
(27, 'Indonesian', 'id', 'id', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(28, 'Irish', 'ga', 'ga', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(29, 'Italian', 'it', 'it', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(30, 'Icelandic', 'is', 'is', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(31, 'Spanish', 'es', 'es', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(33, 'Kannada', 'kn', 'kn', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(34, 'Catalan', 'ca', 'ca', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(36, 'Chinese', 'zh', 'cn', 'no', 'no', '2019-11-20 12:01:48', '0000-00-00'),
(37, 'Korean', 'ko', 'kr', 'no', 'no', '2019-11-20 12:19:09', '0000-00-00'),
(38, 'Xhosa', 'xh', 'ls', 'no', 'no', '2019-11-20 12:24:39', '0000-00-00'),
(39, 'Latin', 'la', 'it', 'no', 'no', '2021-01-23 07:09:32', '0000-00-00'),
(40, 'Latvian', 'lv', 'lv', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(41, 'Lithuanian', 'lt', 'lt', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(43, 'Malagasy', 'mg', 'mg', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(44, 'Malay', 'ms', 'ms', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(45, 'Malayalam', 'ml', 'ml', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(46, 'Maltese', 'mt', 'mt', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(47, 'Macedonian', 'mk', 'mk', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(48, 'Maori', 'mi', 'nz', 'no', 'no', '2019-11-20 12:20:27', '0000-00-00'),
(49, 'Marathi', 'mr', 'in', 'no', 'no', '2019-11-20 11:39:51', '0000-00-00'),
(51, 'Mongolian', 'mn', 'mn', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(52, 'German', 'de', 'de', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(53, 'Nepali', 'ne', 'ne', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(54, 'Norwegian', 'no', 'no', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(55, 'Punjabi', 'pa', 'in', 'no', 'no', '2019-11-20 11:40:16', '0000-00-00'),
(57, 'Persian', 'fa', 'ir', 'no', 'no', '2019-11-20 12:21:17', '0000-00-00'),
(59, 'Portuguese', 'pt', 'pt', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(60, 'Romanian', 'ro', 'ro', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(61, 'Russian', 'ru', 'ru', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(62, 'Cebuano', 'ceb', 'ph', 'no', 'no', '2019-11-20 11:59:12', '0000-00-00'),
(64, 'Sinhala', 'si', 'lk ', 'no', 'no', '2021-01-23 07:09:32', '0000-00-00'),
(65, 'Slovakian', 'sk', 'sk', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(66, 'Slovenian', 'sl', 'sl', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(67, 'Swahili', 'sw', 'ke', 'no', 'no', '2019-11-20 12:21:57', '0000-00-00'),
(68, 'Sundanese', 'su', 'sd', 'no', 'no', '2019-12-03 11:06:57', '0000-00-00'),
(70, 'Thai', 'th', 'th', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(71, 'Tagalog', 'tl', 'tl', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(72, 'Tamil', 'ta', 'in', 'no', 'no', '2019-11-20 11:40:53', '0000-00-00'),
(74, 'Telugu', 'te', 'in', 'no', 'no', '2019-11-20 11:41:15', '0000-00-00'),
(75, 'Turkish', 'tr', 'tr', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(77, 'Uzbek', 'uz', 'uz', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(79, 'Urdu', 'ur', 'pk', 'no', 'no', '2019-11-20 12:23:57', '0000-00-00'),
(80, 'Finnish', 'fi', 'fi', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(81, 'French', 'fr', 'fr', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(82, 'Hindi', 'hi', 'in', 'no', 'no', '2019-11-20 11:36:34', '0000-00-00'),
(84, 'Czech', 'cs', 'cz', 'no', 'no', '2019-11-20 12:02:36', '0000-00-00'),
(85, 'Swedish', 'sv', 'sv', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(86, 'Scottish', 'gd', 'gd', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(87, 'Estonian', 'et', 'et', 'no', 'no', '2019-11-20 11:24:23', '0000-00-00'),
(88, 'Esperanto', 'eo', 'br', 'no', 'no', '2019-11-21 04:49:18', '0000-00-00'),
(89, 'Javanese', 'jv', 'id', 'no', 'no', '2019-11-20 12:18:29', '0000-00-00'),
(90, 'Japanese', 'ja', 'jp', 'no', 'no', '2019-11-20 12:14:39', '0000-00-00'),
(91, 'Polish', 'pl', 'pl', 'no', 'no', '2020-06-15 03:25:27', '0000-00-00'),
(92, 'Kurdish', 'ku', 'iq', 'no', 'no', '2020-12-21 00:15:31', '0000-00-00'),
(93, 'Lao', 'lo', 'la', 'no', 'no', '2020-12-21 00:15:36', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `type`, `is_active`) VALUES
(3, 'Casual leave', 'yes'),
(4, 'Sick leave', 'yes'),
(5, 'Maternity leave', 'yes'),
(6, 'Paternity leave', 'yes'),
(7, 'Emergency leave', 'yes'),
(8, 'Leave without pay ', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `subject_group_subject_id` int(11) NOT NULL,
  `subject_group_class_sections_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `libarary_members`
--

CREATE TABLE `libarary_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `library_card_no` varchar(50) DEFAULT NULL,
  `member_type` varchar(50) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `record_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `agent` varchar(50) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `message`, `record_id`, `user_id`, `action`, `ip_address`, `platform`, `agent`, `time`, `created_at`) VALUES
(1, 'New Record inserted On students id 526', 526, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(2, 'New Record inserted On  student session id 559', 559, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(3, 'New Record inserted On users id 1010', 1010, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(4, 'New Record inserted On users id 1011', 1011, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(5, 'Record updated On students id 526', 526, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(6, 'New Record inserted On students id 527', 527, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(7, 'New Record inserted On  student session id 560', 560, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(8, 'New Record inserted On users id 1012', 1012, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(9, 'New Record inserted On users id 1013', 1013, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(10, 'Record updated On students id 527', 527, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(11, 'New Record inserted On students id 528', 528, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(12, 'New Record inserted On  student session id 561', 561, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(13, 'New Record inserted On users id 1014', 1014, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(14, 'New Record inserted On users id 1015', 1015, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(15, 'Record updated On students id 528', 528, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(16, 'New Record inserted On students id 529', 529, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(17, 'New Record inserted On  student session id 562', 562, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(18, 'New Record inserted On users id 1016', 1016, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(19, 'New Record inserted On users id 1017', 1017, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(20, 'Record updated On students id 529', 529, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(21, 'New Record inserted On students id 530', 530, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(22, 'New Record inserted On  student session id 563', 563, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(23, 'New Record inserted On users id 1018', 1018, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(24, 'New Record inserted On users id 1019', 1019, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(25, 'Record updated On students id 530', 530, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(26, 'New Record inserted On students id 531', 531, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(27, 'New Record inserted On  student session id 564', 564, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(28, 'New Record inserted On users id 1020', 1020, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(29, 'New Record inserted On users id 1021', 1021, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(30, 'Record updated On students id 531', 531, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(31, 'New Record inserted On students id 532', 532, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(32, 'New Record inserted On  student session id 565', 565, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(33, 'New Record inserted On users id 1022', 1022, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(34, 'New Record inserted On users id 1023', 1023, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(35, 'Record updated On students id 532', 532, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(36, 'New Record inserted On students id 533', 533, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(37, 'New Record inserted On  student session id 566', 566, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(38, 'New Record inserted On users id 1024', 1024, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(39, 'New Record inserted On users id 1025', 1025, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(40, 'Record updated On students id 533', 533, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(41, 'New Record inserted On students id 534', 534, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(42, 'New Record inserted On  student session id 567', 567, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(43, 'New Record inserted On users id 1026', 1026, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(44, 'New Record inserted On users id 1027', 1027, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(45, 'Record updated On students id 534', 534, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(46, 'New Record inserted On students id 535', 535, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(47, 'New Record inserted On  student session id 568', 568, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(48, 'New Record inserted On users id 1028', 1028, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(49, 'New Record inserted On users id 1029', 1029, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(50, 'Record updated On students id 535', 535, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(51, 'New Record inserted On students id 536', 536, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(52, 'New Record inserted On  student session id 569', 569, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(53, 'New Record inserted On users id 1030', 1030, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(54, 'New Record inserted On users id 1031', 1031, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(55, 'Record updated On students id 536', 536, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(56, 'New Record inserted On students id 537', 537, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(57, 'New Record inserted On  student session id 570', 570, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(58, 'New Record inserted On users id 1032', 1032, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(59, 'New Record inserted On users id 1033', 1033, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(60, 'Record updated On students id 537', 537, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(61, 'New Record inserted On students id 538', 538, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(62, 'New Record inserted On  student session id 571', 571, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(63, 'New Record inserted On users id 1034', 1034, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(64, 'New Record inserted On users id 1035', 1035, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(65, 'Record updated On students id 538', 538, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(66, 'New Record inserted On students id 539', 539, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(67, 'New Record inserted On  student session id 572', 572, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(68, 'New Record inserted On users id 1036', 1036, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(69, 'New Record inserted On users id 1037', 1037, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(70, 'Record updated On students id 539', 539, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(71, 'New Record inserted On students id 540', 540, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(72, 'New Record inserted On  student session id 573', 573, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(73, 'New Record inserted On users id 1038', 1038, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(74, 'New Record inserted On users id 1039', 1039, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(75, 'Record updated On students id 540', 540, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(76, 'New Record inserted On students id 541', 541, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(77, 'New Record inserted On  student session id 574', 574, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(78, 'New Record inserted On users id 1040', 1040, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(79, 'New Record inserted On users id 1041', 1041, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(80, 'Record updated On students id 541', 541, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(81, 'New Record inserted On students id 542', 542, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(82, 'New Record inserted On  student session id 575', 575, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(83, 'New Record inserted On users id 1042', 1042, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(84, 'New Record inserted On users id 1043', 1043, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(85, 'Record updated On students id 542', 542, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(86, 'New Record inserted On students id 543', 543, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(87, 'New Record inserted On  student session id 576', 576, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(88, 'New Record inserted On users id 1044', 1044, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(89, 'New Record inserted On users id 1045', 1045, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(90, 'Record updated On students id 543', 543, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(91, 'New Record inserted On students id 544', 544, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(92, 'New Record inserted On  student session id 577', 577, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(93, 'New Record inserted On users id 1046', 1046, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(94, 'New Record inserted On users id 1047', 1047, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(95, 'Record updated On students id 544', 544, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(96, 'New Record inserted On students id 545', 545, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(97, 'New Record inserted On  student session id 578', 578, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(98, 'New Record inserted On users id 1048', 1048, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(99, 'New Record inserted On users id 1049', 1049, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(100, 'Record updated On students id 545', 545, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(101, 'New Record inserted On students id 546', 546, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(102, 'New Record inserted On  student session id 579', 579, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(103, 'New Record inserted On users id 1050', 1050, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(104, 'New Record inserted On users id 1051', 1051, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(105, 'Record updated On students id 546', 546, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:16:01', NULL),
(106, 'New Record inserted On students id 547', 547, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(107, 'New Record inserted On  student session id 580', 580, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(108, 'New Record inserted On users id 1052', 1052, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(109, 'New Record inserted On users id 1053', 1053, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(110, 'Record updated On students id 547', 547, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(111, 'New Record inserted On students id 548', 548, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(112, 'New Record inserted On  student session id 581', 581, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(113, 'New Record inserted On users id 1054', 1054, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(114, 'New Record inserted On users id 1055', 1055, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(115, 'Record updated On students id 548', 548, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(116, 'New Record inserted On students id 549', 549, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(117, 'New Record inserted On  student session id 582', 582, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(118, 'New Record inserted On users id 1056', 1056, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(119, 'New Record inserted On users id 1057', 1057, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(120, 'Record updated On students id 549', 549, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(121, 'New Record inserted On students id 550', 550, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(122, 'New Record inserted On  student session id 583', 583, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(123, 'New Record inserted On users id 1058', 1058, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(124, 'New Record inserted On users id 1059', 1059, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(125, 'Record updated On students id 550', 550, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(126, 'New Record inserted On students id 551', 551, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(127, 'New Record inserted On  student session id 584', 584, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(128, 'New Record inserted On users id 1060', 1060, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(129, 'New Record inserted On users id 1061', 1061, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(130, 'Record updated On students id 551', 551, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(131, 'New Record inserted On students id 552', 552, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(132, 'New Record inserted On  student session id 585', 585, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(133, 'New Record inserted On users id 1062', 1062, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(134, 'New Record inserted On users id 1063', 1063, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(135, 'Record updated On students id 552', 552, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(136, 'New Record inserted On students id 553', 553, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(137, 'New Record inserted On  student session id 586', 586, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(138, 'New Record inserted On users id 1064', 1064, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(139, 'New Record inserted On users id 1065', 1065, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(140, 'Record updated On students id 553', 553, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(141, 'New Record inserted On students id 554', 554, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(142, 'New Record inserted On  student session id 587', 587, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(143, 'New Record inserted On users id 1066', 1066, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(144, 'New Record inserted On users id 1067', 1067, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(145, 'Record updated On students id 554', 554, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(146, 'New Record inserted On students id 555', 555, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(147, 'New Record inserted On  student session id 588', 588, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(148, 'New Record inserted On users id 1068', 1068, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(149, 'New Record inserted On users id 1069', 1069, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(150, 'Record updated On students id 555', 555, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(151, 'New Record inserted On students id 556', 556, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(152, 'New Record inserted On  student session id 589', 589, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(153, 'New Record inserted On users id 1070', 1070, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(154, 'New Record inserted On users id 1071', 1071, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(155, 'Record updated On students id 556', 556, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(156, 'New Record inserted On students id 557', 557, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(157, 'New Record inserted On  student session id 590', 590, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(158, 'New Record inserted On users id 1072', 1072, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(159, 'New Record inserted On users id 1073', 1073, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(160, 'Record updated On students id 557', 557, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(161, 'New Record inserted On students id 558', 558, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(162, 'New Record inserted On  student session id 591', 591, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(163, 'New Record inserted On users id 1074', 1074, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(164, 'New Record inserted On users id 1075', 1075, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(165, 'Record updated On students id 558', 558, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(166, 'New Record inserted On students id 559', 559, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(167, 'New Record inserted On  student session id 592', 592, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(168, 'New Record inserted On users id 1076', 1076, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(169, 'New Record inserted On users id 1077', 1077, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(170, 'Record updated On students id 559', 559, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(171, 'New Record inserted On students id 560', 560, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(172, 'New Record inserted On  student session id 593', 593, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(173, 'New Record inserted On users id 1078', 1078, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(174, 'New Record inserted On users id 1079', 1079, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(175, 'Record updated On students id 560', 560, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(176, 'New Record inserted On students id 561', 561, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(177, 'New Record inserted On  student session id 594', 594, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(178, 'New Record inserted On users id 1080', 1080, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(179, 'New Record inserted On users id 1081', 1081, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(180, 'Record updated On students id 561', 561, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(181, 'New Record inserted On students id 562', 562, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(182, 'New Record inserted On  student session id 595', 595, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(183, 'New Record inserted On users id 1082', 1082, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(184, 'New Record inserted On users id 1083', 1083, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(185, 'Record updated On students id 562', 562, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(186, 'New Record inserted On students id 563', 563, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(187, 'New Record inserted On  student session id 596', 596, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(188, 'New Record inserted On users id 1084', 1084, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(189, 'New Record inserted On users id 1085', 1085, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(190, 'Record updated On students id 563', 563, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(191, 'New Record inserted On students id 564', 564, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(192, 'New Record inserted On  student session id 597', 597, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(193, 'New Record inserted On users id 1086', 1086, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(194, 'New Record inserted On users id 1087', 1087, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(195, 'Record updated On students id 564', 564, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(196, 'New Record inserted On students id 565', 565, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(197, 'New Record inserted On  student session id 598', 598, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(198, 'New Record inserted On users id 1088', 1088, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(199, 'New Record inserted On users id 1089', 1089, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(200, 'Record updated On students id 565', 565, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(201, 'New Record inserted On students id 566', 566, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(202, 'New Record inserted On  student session id 599', 599, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(203, 'New Record inserted On users id 1090', 1090, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(204, 'New Record inserted On users id 1091', 1091, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(205, 'Record updated On students id 566', 566, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(206, 'New Record inserted On students id 567', 567, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(207, 'New Record inserted On  student session id 600', 600, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(208, 'New Record inserted On users id 1092', 1092, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(209, 'New Record inserted On users id 1093', 1093, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(210, 'Record updated On students id 567', 567, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:19:25', NULL),
(211, 'New Record inserted On students id 568', 568, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:24:00', NULL),
(212, 'New Record inserted On  student session id 601', 601, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:24:00', NULL),
(213, 'New Record inserted On users id 1094', 1094, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:24:00', NULL),
(214, 'New Record inserted On users id 1095', 1095, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:24:00', NULL),
(215, 'Record updated On students id 568', 568, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:24:00', NULL),
(216, 'New Record inserted On  staff designation id 24', 24, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:31:25', NULL),
(217, 'Record updated On staff id 45', 45, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:38:31', NULL),
(218, 'Record updated On staff id 45', 45, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:38:31', NULL),
(219, 'Record updated On staff id 45', 45, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:42:39', NULL),
(220, 'Record updated On staff id 45', 45, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:42:39', NULL),
(221, 'Record updated On staff id 45', 45, 45, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:43:40', NULL),
(222, 'Record updated On staff id 45', 45, 45, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 09:43:40', NULL),
(223, 'New Record inserted On students id 569', 569, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 09:58:06', NULL),
(224, 'New Record inserted On  student session id 602', 602, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 09:58:06', NULL),
(225, 'New Record inserted On users id 1096', 1096, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 09:58:06', NULL),
(226, 'New Record inserted On users id 1097', 1097, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 09:58:06', NULL),
(227, 'Record updated On students id 569', 569, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 09:58:06', NULL),
(228, 'Record deleted On subjects id 83', 83, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:01:40', NULL),
(229, 'Record deleted On subjects id 84', 84, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:01:42', NULL),
(230, 'Record deleted On subjects id 85', 85, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:01:44', NULL),
(231, 'New Record inserted On students id 570', 570, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:02:13', NULL),
(232, 'New Record inserted On  student session id 603', 603, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:02:13', NULL),
(233, 'New Record inserted On users id 1098', 1098, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:02:13', NULL),
(234, 'New Record inserted On users id 1099', 1099, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:02:13', NULL),
(235, 'Record updated On students id 570', 570, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:02:13', NULL),
(236, 'New Record inserted On subjects id 86', 86, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:02:40', NULL),
(237, 'New Record inserted On subjects id 87', 87, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:02:51', NULL),
(238, 'New Record inserted On subjects id 88', 88, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:03:23', NULL),
(239, 'Record updated On subjects id 86', 86, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:03:50', NULL),
(240, 'Record updated On subjects id 87', 87, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:04:01', NULL),
(241, 'Record updated On subjects id 88', 88, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:04:08', NULL),
(242, 'New Record inserted On subjects id 89', 89, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:04:31', NULL),
(243, 'New Record inserted On subjects id 90', 90, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:04:57', NULL),
(244, 'New Record inserted On subjects id 91', 91, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:05:15', NULL),
(245, 'Record deleted On subjects id 87', 87, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:05:51', NULL),
(246, 'Record deleted On subjects id 88', 88, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:05:52', NULL),
(247, 'Record deleted On subjects id 89', 89, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:05:53', NULL),
(248, 'Record deleted On subjects id 90', 90, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:05:54', NULL),
(249, 'Record deleted On subjects id 91', 91, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:05:55', NULL),
(250, 'New Record inserted On subjects id 92', 92, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:06:14', NULL),
(251, 'New Record inserted On subjects id 93', 93, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:06:38', NULL),
(252, 'New Record inserted On subjects id 94', 94, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:06:55', NULL),
(253, 'New Record inserted On subjects id 95', 95, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:07:11', NULL),
(254, 'Record updated On subjects id 95', 95, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:07:56', NULL),
(255, 'New Record inserted On subjects id 96', 96, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:08:07', NULL),
(256, 'New Record inserted On subjects id 97', 97, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:08:35', NULL),
(257, 'New Record inserted On subjects id 98', 98, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:09:08', NULL),
(258, 'New Record inserted On students id 571', 571, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:09:11', NULL),
(259, 'New Record inserted On  student session id 604', 604, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:09:11', NULL),
(260, 'New Record inserted On users id 1100', 1100, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:09:11', NULL),
(261, 'New Record inserted On users id 1101', 1101, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:09:11', NULL),
(262, 'Record updated On students id 571', 571, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:09:11', NULL),
(263, 'New Record inserted On subjects id 99', 99, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:13:05', NULL),
(264, 'New Record inserted On subjects id 100', 100, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:13:44', NULL),
(265, 'Record updated On subjects id 97', 97, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:13:50', NULL),
(266, 'New Record inserted On subjects id 101', 101, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:14:17', NULL),
(267, 'New Record inserted On subjects id 102', 102, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:14:50', NULL),
(268, 'New Record inserted On subjects id 103', 103, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:15:02', NULL),
(269, 'New Record inserted On subjects id 104', 104, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:15:17', NULL),
(270, 'New Record inserted On students id 572', 572, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:15:29', NULL),
(271, 'New Record inserted On  student session id 605', 605, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:15:29', NULL),
(272, 'New Record inserted On users id 1102', 1102, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:15:29', NULL),
(273, 'New Record inserted On users id 1103', 1103, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:15:29', NULL),
(274, 'Record updated On students id 572', 572, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:15:29', NULL),
(275, 'New Record inserted On subjects id 105', 105, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:15:33', NULL),
(276, 'New Record inserted On subjects id 106', 106, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:15:39', NULL),
(277, 'New Record inserted On subjects id 107', 107, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:16:05', NULL),
(278, 'New Record inserted On subjects id 108', 108, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:16:20', NULL),
(279, 'New Record inserted On students id 573', 573, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:17:32', NULL),
(280, 'New Record inserted On  student session id 606', 606, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:17:32', NULL),
(281, 'New Record inserted On users id 1104', 1104, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:17:32', NULL),
(282, 'New Record inserted On users id 1105', 1105, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:17:32', NULL),
(283, 'Record updated On students id 573', 573, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:17:32', NULL),
(284, 'Record updated On students id 570', 570, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:18:14', NULL),
(285, 'Record updated On  student session id 603', 603, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:18:14', NULL),
(286, 'Record updated On students id 572', 572, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:18:42', NULL),
(287, 'Record updated On  student session id 605', 605, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:18:42', NULL),
(288, 'New Record inserted On students id 574', 574, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:20:45', NULL),
(289, 'New Record inserted On  student session id 607', 607, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:20:45', NULL),
(290, 'New Record inserted On users id 1106', 1106, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:20:45', NULL),
(291, 'New Record inserted On users id 1107', 1107, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:20:45', NULL),
(292, 'Record updated On students id 574', 574, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:20:45', NULL),
(293, 'New Record inserted On students id 575', 575, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:22:32', NULL),
(294, 'New Record inserted On  student session id 608', 608, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:22:32', NULL),
(295, 'New Record inserted On users id 1108', 1108, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:22:32', NULL),
(296, 'New Record inserted On users id 1109', 1109, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:22:32', NULL),
(297, 'Record updated On students id 575', 575, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:22:32', NULL),
(298, 'Record updated On students id 575', 575, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:22:56', NULL),
(299, 'Record updated On  student session id 608', 608, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:22:56', NULL),
(300, 'Record updated On students id 572', 572, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:23:31', NULL),
(301, 'Record updated On  student session id 605', 605, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:23:31', NULL),
(302, 'New Record inserted On students id 576', 576, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:26:58', NULL),
(303, 'New Record inserted On  student session id 609', 609, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:26:58', NULL),
(304, 'New Record inserted On users id 1110', 1110, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:26:58', NULL),
(305, 'New Record inserted On users id 1111', 1111, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:26:58', NULL),
(306, 'Record updated On students id 576', 576, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:26:58', NULL),
(307, 'New Record inserted On students id 577', 577, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:28:44', NULL),
(308, 'New Record inserted On  student session id 610', 610, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:28:44', NULL),
(309, 'New Record inserted On users id 1112', 1112, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:28:44', NULL),
(310, 'New Record inserted On users id 1113', 1113, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:28:44', NULL),
(311, 'Record updated On students id 577', 577, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:28:44', NULL),
(312, 'Record updated On staff id 46', 46, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:31:37', NULL),
(313, 'Record updated On staff id 46', 46, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:31:37', NULL),
(314, 'New Record inserted On students id 578', 578, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:32:59', NULL),
(315, 'New Record inserted On  student session id 611', 611, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:32:59', NULL),
(316, 'New Record inserted On users id 1114', 1114, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:32:59', NULL),
(317, 'New Record inserted On users id 1115', 1115, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:32:59', NULL),
(318, 'Record updated On students id 578', 578, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:32:59', NULL),
(319, 'Record updated On staff id 47', 47, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:33:45', NULL),
(320, 'Record updated On staff id 48', 48, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:35:40', NULL),
(321, 'Record updated On staff id 49', 49, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:37:27', NULL),
(322, 'New Record inserted On students id 579', 579, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:38:58', NULL),
(323, 'New Record inserted On  student session id 612', 612, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:38:58', NULL),
(324, 'New Record inserted On users id 1116', 1116, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:38:58', NULL),
(325, 'New Record inserted On users id 1117', 1117, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:38:58', NULL),
(326, 'Record updated On students id 579', 579, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:38:58', NULL),
(327, 'Record updated On staff id 50', 50, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:39:18', NULL),
(328, 'Record updated On staff id 51', 51, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:41:08', NULL),
(329, 'New Record inserted On students id 580', 580, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:41:09', NULL),
(330, 'New Record inserted On  student session id 613', 613, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:41:09', NULL),
(331, 'New Record inserted On users id 1118', 1118, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:41:09', NULL),
(332, 'New Record inserted On users id 1119', 1119, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:41:09', NULL),
(333, 'Record updated On students id 580', 580, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:41:09', NULL),
(334, 'Record updated On staff id 52', 52, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:42:53', NULL),
(335, 'New Record inserted On students id 581', 581, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:43:18', NULL),
(336, 'New Record inserted On  student session id 614', 614, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:43:18', NULL),
(337, 'New Record inserted On users id 1120', 1120, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:43:18', NULL),
(338, 'New Record inserted On users id 1121', 1121, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:43:18', NULL),
(339, 'Record updated On students id 581', 581, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:43:18', NULL),
(340, 'Record deleted On subject groups id 21', 21, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:43:51', NULL),
(341, 'New Record inserted On subject groups id 22', 22, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:44:43', NULL),
(342, 'New Record inserted On subject groups id 23', 23, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:45:16', NULL),
(343, 'New Record inserted On students id 582', 582, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:46:45', NULL),
(344, 'New Record inserted On  student session id 615', 615, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:46:45', NULL),
(345, 'New Record inserted On users id 1122', 1122, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:46:45', NULL),
(346, 'New Record inserted On users id 1123', 1123, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:46:45', NULL),
(347, 'Record updated On students id 582', 582, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:46:45', NULL),
(348, 'New Record inserted On students id 583', 583, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:48:09', NULL);
INSERT INTO `logs` (`id`, `message`, `record_id`, `user_id`, `action`, `ip_address`, `platform`, `agent`, `time`, `created_at`) VALUES
(349, 'New Record inserted On  student session id 616', 616, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:48:09', NULL),
(350, 'New Record inserted On users id 1124', 1124, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:48:09', NULL),
(351, 'New Record inserted On users id 1125', 1125, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:48:09', NULL),
(352, 'Record updated On students id 583', 583, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:48:09', NULL),
(353, 'New Record inserted On subject groups id 24', 24, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:49:06', NULL),
(354, 'New Record inserted On subject groups id 25', 25, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:49:52', NULL),
(355, 'New Record inserted On students id 584', 584, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:49:55', NULL),
(356, 'New Record inserted On  student session id 617', 617, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:49:55', NULL),
(357, 'New Record inserted On users id 1126', 1126, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:49:55', NULL),
(358, 'New Record inserted On users id 1127', 1127, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:49:55', NULL),
(359, 'Record updated On students id 584', 584, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:49:55', NULL),
(360, 'New Record inserted On subject groups id 26', 26, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:50:32', NULL),
(361, 'New Record inserted On subject groups id 27', 27, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:51:27', NULL),
(362, 'New Record inserted On students id 585', 585, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:51:41', NULL),
(363, 'New Record inserted On  student session id 618', 618, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:51:41', NULL),
(364, 'New Record inserted On users id 1128', 1128, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:51:41', NULL),
(365, 'New Record inserted On users id 1129', 1129, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:51:41', NULL),
(366, 'Record updated On students id 585', 585, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:51:41', NULL),
(367, 'New Record inserted On subject groups id 28', 28, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:51:56', NULL),
(368, 'New Record inserted On class teacher id 19', 19, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:52:31', NULL),
(369, 'New Record inserted On class teacher id 20', 20, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:52:37', NULL),
(370, 'New Record inserted On class teacher id 21', 21, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:52:47', NULL),
(371, 'New Record inserted On class teacher id 22', 22, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:53:01', NULL),
(372, 'New Record inserted On class teacher id 23', 23, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:53:12', NULL),
(373, 'New Record inserted On students id 586', 586, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:53:14', NULL),
(374, 'New Record inserted On  student session id 619', 619, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:53:14', NULL),
(375, 'New Record inserted On users id 1130', 1130, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:53:14', NULL),
(376, 'New Record inserted On users id 1131', 1131, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:53:14', NULL),
(377, 'Record updated On students id 586', 586, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:53:14', NULL),
(378, 'New Record inserted On class teacher id 24', 24, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:53:18', NULL),
(379, 'New Record inserted On class teacher id 25', 25, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:53:37', NULL),
(380, 'New Record inserted On class teacher id 26', 26, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 10:53:45', NULL),
(381, 'New Record inserted On students id 587', 587, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:55:15', NULL),
(382, 'New Record inserted On  student session id 620', 620, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:55:15', NULL),
(383, 'New Record inserted On users id 1132', 1132, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:55:15', NULL),
(384, 'New Record inserted On users id 1133', 1133, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:55:15', NULL),
(385, 'Record updated On students id 587', 587, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:55:15', NULL),
(386, 'New Record inserted On students id 588', 588, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:59:06', NULL),
(387, 'New Record inserted On  student session id 621', 621, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:59:06', NULL),
(388, 'New Record inserted On users id 1134', 1134, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:59:06', NULL),
(389, 'New Record inserted On users id 1135', 1135, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:59:06', NULL),
(390, 'Record updated On students id 588', 588, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 10:59:06', NULL),
(391, 'New Record inserted On students id 589', 589, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:01:32', NULL),
(392, 'New Record inserted On  student session id 622', 622, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:01:32', NULL),
(393, 'New Record inserted On users id 1136', 1136, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:01:32', NULL),
(394, 'New Record inserted On users id 1137', 1137, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:01:32', NULL),
(395, 'Record updated On students id 589', 589, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:01:32', NULL),
(396, 'New Record inserted On students id 590', 590, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:03:19', NULL),
(397, 'New Record inserted On  student session id 623', 623, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:03:19', NULL),
(398, 'New Record inserted On users id 1138', 1138, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:03:19', NULL),
(399, 'New Record inserted On users id 1139', 1139, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:03:19', NULL),
(400, 'Record updated On students id 590', 590, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:03:19', NULL),
(401, 'New Record inserted On students id 591', 591, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:05:38', NULL),
(402, 'New Record inserted On  student session id 624', 624, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:05:38', NULL),
(403, 'New Record inserted On users id 1140', 1140, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:05:38', NULL),
(404, 'New Record inserted On users id 1141', 1141, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:05:38', NULL),
(405, 'Record updated On students id 591', 591, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:05:38', NULL),
(406, 'New Record inserted On students id 592', 592, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:09:08', NULL),
(407, 'New Record inserted On  student session id 625', 625, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:09:08', NULL),
(408, 'New Record inserted On users id 1142', 1142, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:09:08', NULL),
(409, 'New Record inserted On users id 1143', 1143, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:09:08', NULL),
(410, 'Record updated On students id 592', 592, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:09:08', NULL),
(411, 'New Record inserted On students id 593', 593, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:12:04', NULL),
(412, 'New Record inserted On  student session id 626', 626, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:12:04', NULL),
(413, 'New Record inserted On users id 1144', 1144, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:12:04', NULL),
(414, 'New Record inserted On users id 1145', 1145, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:12:04', NULL),
(415, 'Record updated On students id 593', 593, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:12:04', NULL),
(416, 'New Record inserted On students id 594', 594, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:14:49', NULL),
(417, 'New Record inserted On  student session id 627', 627, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:14:49', NULL),
(418, 'New Record inserted On users id 1146', 1146, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:14:49', NULL),
(419, 'New Record inserted On users id 1147', 1147, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:14:49', NULL),
(420, 'Record updated On students id 594', 594, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:14:49', NULL),
(421, 'New Record inserted On students id 595', 595, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:16:23', NULL),
(422, 'New Record inserted On  student session id 628', 628, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:16:23', NULL),
(423, 'New Record inserted On users id 1148', 1148, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:16:23', NULL),
(424, 'New Record inserted On users id 1149', 1149, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:16:23', NULL),
(425, 'Record updated On students id 595', 595, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:16:23', NULL),
(426, 'New Record inserted On students id 596', 596, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:18:20', NULL),
(427, 'New Record inserted On  student session id 629', 629, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:18:20', NULL),
(428, 'New Record inserted On users id 1150', 1150, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:18:20', NULL),
(429, 'New Record inserted On users id 1151', 1151, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:18:20', NULL),
(430, 'Record updated On students id 596', 596, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:18:20', NULL),
(431, 'New Record inserted On students id 597', 597, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:23:45', NULL),
(432, 'New Record inserted On  student session id 630', 630, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:23:45', NULL),
(433, 'New Record inserted On users id 1152', 1152, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:23:45', NULL),
(434, 'New Record inserted On users id 1153', 1153, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:23:45', NULL),
(435, 'Record updated On students id 597', 597, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:23:45', NULL),
(436, 'New Record inserted On students id 598', 598, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:25:29', NULL),
(437, 'New Record inserted On  student session id 631', 631, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:25:29', NULL),
(438, 'New Record inserted On users id 1154', 1154, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:25:29', NULL),
(439, 'New Record inserted On users id 1155', 1155, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:25:29', NULL),
(440, 'Record updated On students id 598', 598, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:25:29', NULL),
(441, 'New Record inserted On students id 599', 599, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:27:53', NULL),
(442, 'New Record inserted On  student session id 632', 632, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:27:53', NULL),
(443, 'New Record inserted On users id 1156', 1156, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:27:53', NULL),
(444, 'New Record inserted On users id 1157', 1157, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:27:53', NULL),
(445, 'Record updated On students id 599', 599, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:27:53', NULL),
(446, 'New Record inserted On students id 600', 600, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:35:19', NULL),
(447, 'New Record inserted On  student session id 633', 633, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:35:19', NULL),
(448, 'New Record inserted On users id 1158', 1158, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:35:19', NULL),
(449, 'New Record inserted On users id 1159', 1159, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:35:19', NULL),
(450, 'Record updated On students id 600', 600, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:35:19', NULL),
(451, 'New Record inserted On students id 601', 601, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:36:50', NULL),
(452, 'New Record inserted On  student session id 634', 634, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:36:50', NULL),
(453, 'New Record inserted On users id 1160', 1160, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:36:50', NULL),
(454, 'New Record inserted On users id 1161', 1161, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:36:50', NULL),
(455, 'Record updated On students id 601', 601, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:36:50', NULL),
(456, 'New Record inserted On students id 602', 602, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:38:36', NULL),
(457, 'New Record inserted On  student session id 635', 635, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:38:36', NULL),
(458, 'New Record inserted On users id 1162', 1162, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:38:36', NULL),
(459, 'New Record inserted On users id 1163', 1163, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:38:36', NULL),
(460, 'Record updated On students id 602', 602, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:38:36', NULL),
(461, 'New Record inserted On students id 603', 603, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:40:25', NULL),
(462, 'New Record inserted On  student session id 636', 636, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:40:25', NULL),
(463, 'New Record inserted On users id 1164', 1164, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:40:25', NULL),
(464, 'New Record inserted On users id 1165', 1165, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:40:25', NULL),
(465, 'Record updated On students id 603', 603, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:40:25', NULL),
(466, 'New Record inserted On students id 604', 604, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:46:13', NULL),
(467, 'New Record inserted On  student session id 637', 637, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:46:13', NULL),
(468, 'New Record inserted On users id 1166', 1166, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:46:13', NULL),
(469, 'New Record inserted On users id 1167', 1167, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:46:13', NULL),
(470, 'Record updated On students id 604', 604, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:46:13', NULL),
(471, 'New Record inserted On students id 605', 605, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:48:47', NULL),
(472, 'New Record inserted On  student session id 638', 638, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:48:47', NULL),
(473, 'New Record inserted On users id 1168', 1168, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:48:47', NULL),
(474, 'New Record inserted On users id 1169', 1169, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:48:47', NULL),
(475, 'Record updated On students id 605', 605, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:48:47', NULL),
(476, 'New Record inserted On students id 606', 606, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:55:11', NULL),
(477, 'New Record inserted On  student session id 639', 639, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:55:11', NULL),
(478, 'New Record inserted On users id 1170', 1170, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:55:11', NULL),
(479, 'New Record inserted On users id 1171', 1171, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:55:11', NULL),
(480, 'Record updated On students id 606', 606, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:55:11', NULL),
(481, 'New Record inserted On students id 607', 607, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:57:02', NULL),
(482, 'New Record inserted On  student session id 640', 640, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:57:02', NULL),
(483, 'New Record inserted On users id 1172', 1172, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:57:02', NULL),
(484, 'New Record inserted On users id 1173', 1173, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:57:02', NULL),
(485, 'Record updated On students id 607', 607, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 11:57:02', NULL),
(486, 'New Record inserted On students id 608', 608, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:01:14', NULL),
(487, 'New Record inserted On  student session id 641', 641, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:01:14', NULL),
(488, 'New Record inserted On users id 1174', 1174, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:01:14', NULL),
(489, 'New Record inserted On users id 1175', 1175, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:01:14', NULL),
(490, 'Record updated On students id 608', 608, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:01:14', NULL),
(491, 'New Record inserted On students id 609', 609, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:03:48', NULL),
(492, 'New Record inserted On  student session id 642', 642, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:03:48', NULL),
(493, 'New Record inserted On users id 1176', 1176, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:03:48', NULL),
(494, 'New Record inserted On users id 1177', 1177, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:03:48', NULL),
(495, 'Record updated On students id 609', 609, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:03:48', NULL),
(496, 'Record updated On staff id 45', 45, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 12:05:39', NULL),
(497, 'Record updated On staff id 45', 45, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 12:05:39', NULL),
(498, 'New Record inserted On students id 610', 610, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:08:20', NULL),
(499, 'New Record inserted On  student session id 643', 643, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:08:20', NULL),
(500, 'New Record inserted On users id 1178', 1178, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:08:20', NULL),
(501, 'New Record inserted On users id 1179', 1179, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:08:20', NULL),
(502, 'Record updated On students id 610', 610, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:08:20', NULL),
(503, 'New Record inserted On students id 611', 611, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:09:57', NULL),
(504, 'New Record inserted On  student session id 644', 644, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:09:57', NULL),
(505, 'New Record inserted On users id 1180', 1180, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:09:57', NULL),
(506, 'New Record inserted On users id 1181', 1181, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:09:57', NULL),
(507, 'Record updated On students id 611', 611, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:09:57', NULL),
(508, 'New Record inserted On students id 612', 612, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:12:29', NULL),
(509, 'New Record inserted On  student session id 645', 645, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:12:29', NULL),
(510, 'New Record inserted On users id 1182', 1182, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:12:29', NULL),
(511, 'New Record inserted On users id 1183', 1183, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:12:29', NULL),
(512, 'Record updated On students id 612', 612, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:12:29', NULL),
(513, 'New Record inserted On roles id 20', 20, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 12:13:16', NULL),
(514, 'New Record inserted On students id 613', 613, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:13:57', NULL),
(515, 'New Record inserted On  student session id 646', 646, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:13:57', NULL),
(516, 'New Record inserted On users id 1184', 1184, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:13:57', NULL),
(517, 'New Record inserted On users id 1185', 1185, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:13:57', NULL),
(518, 'Record updated On students id 613', 613, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:13:57', NULL),
(519, 'New Record inserted On students id 614', 614, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:15:55', NULL),
(520, 'New Record inserted On  student session id 647', 647, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:15:55', NULL),
(521, 'New Record inserted On users id 1186', 1186, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:15:55', NULL),
(522, 'New Record inserted On users id 1187', 1187, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:15:55', NULL),
(523, 'Record updated On students id 614', 614, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:15:55', NULL),
(524, 'New Record inserted On students id 615', 615, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:20:22', NULL),
(525, 'New Record inserted On  student session id 648', 648, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:20:22', NULL),
(526, 'New Record inserted On users id 1188', 1188, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:20:22', NULL),
(527, 'New Record inserted On users id 1189', 1189, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:20:22', NULL),
(528, 'Record updated On students id 615', 615, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:20:22', NULL),
(529, 'New Record inserted On students id 616', 616, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:22:07', NULL),
(530, 'New Record inserted On  student session id 649', 649, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:22:07', NULL),
(531, 'New Record inserted On users id 1190', 1190, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:22:07', NULL),
(532, 'New Record inserted On users id 1191', 1191, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:22:07', NULL),
(533, 'Record updated On students id 616', 616, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:22:07', NULL),
(534, 'New Record inserted On students id 617', 617, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:23:49', NULL),
(535, 'New Record inserted On  student session id 650', 650, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:23:49', NULL),
(536, 'New Record inserted On users id 1192', 1192, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:23:49', NULL),
(537, 'New Record inserted On users id 1193', 1193, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:23:49', NULL),
(538, 'Record updated On students id 617', 617, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:23:49', NULL),
(539, 'New Record inserted On students id 618', 618, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:25:55', NULL),
(540, 'New Record inserted On  student session id 651', 651, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:25:55', NULL),
(541, 'New Record inserted On users id 1194', 1194, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:25:55', NULL),
(542, 'New Record inserted On users id 1195', 1195, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:25:55', NULL),
(543, 'Record updated On students id 618', 618, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:25:55', NULL),
(544, 'New Record inserted On students id 619', 619, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:28:00', NULL),
(545, 'New Record inserted On  student session id 652', 652, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:28:00', NULL),
(546, 'New Record inserted On users id 1196', 1196, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:28:00', NULL),
(547, 'New Record inserted On users id 1197', 1197, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:28:00', NULL),
(548, 'Record updated On students id 619', 619, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:28:00', NULL),
(549, 'New Record inserted On students id 620', 620, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:37:41', NULL),
(550, 'New Record inserted On  student session id 653', 653, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:37:41', NULL),
(551, 'New Record inserted On users id 1198', 1198, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:37:41', NULL),
(552, 'New Record inserted On users id 1199', 1199, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:37:41', NULL),
(553, 'Record updated On students id 620', 620, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:37:41', NULL),
(554, 'New Record inserted On students id 621', 621, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:45:21', NULL),
(555, 'New Record inserted On  student session id 654', 654, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:45:21', NULL),
(556, 'New Record inserted On users id 1200', 1200, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:45:21', NULL),
(557, 'New Record inserted On users id 1201', 1201, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:45:21', NULL),
(558, 'Record updated On students id 621', 621, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:45:21', NULL),
(559, 'New Record inserted On students id 622', 622, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:49:08', NULL),
(560, 'New Record inserted On  student session id 655', 655, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:49:08', NULL),
(561, 'New Record inserted On users id 1202', 1202, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:49:08', NULL),
(562, 'New Record inserted On users id 1203', 1203, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:49:08', NULL),
(563, 'Record updated On students id 622', 622, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:49:08', NULL),
(564, 'New Record inserted On students id 623', 623, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:54:24', NULL),
(565, 'New Record inserted On  student session id 656', 656, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:54:24', NULL),
(566, 'New Record inserted On users id 1204', 1204, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:54:24', NULL),
(567, 'New Record inserted On users id 1205', 1205, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:54:24', NULL),
(568, 'Record updated On students id 623', 623, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:54:24', NULL),
(569, 'New Record inserted On students id 624', 624, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:56:45', NULL),
(570, 'New Record inserted On  student session id 657', 657, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:56:45', NULL),
(571, 'New Record inserted On users id 1206', 1206, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:56:45', NULL),
(572, 'New Record inserted On users id 1207', 1207, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:56:45', NULL),
(573, 'Record updated On students id 624', 624, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:56:45', NULL),
(574, 'New Record inserted On students id 625', 625, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:59:05', NULL),
(575, 'New Record inserted On  student session id 658', 658, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:59:05', NULL),
(576, 'New Record inserted On users id 1208', 1208, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:59:05', NULL),
(577, 'New Record inserted On users id 1209', 1209, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:59:05', NULL),
(578, 'Record updated On students id 625', 625, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 12:59:05', NULL),
(579, 'New Record inserted On students id 626', 626, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:00:43', NULL),
(580, 'New Record inserted On  student session id 659', 659, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:00:43', NULL),
(581, 'New Record inserted On users id 1210', 1210, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:00:43', NULL),
(582, 'New Record inserted On users id 1211', 1211, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:00:43', NULL),
(583, 'Record updated On students id 626', 626, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:00:43', NULL),
(584, 'New Record inserted On students id 627', 627, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:02:52', NULL),
(585, 'New Record inserted On  student session id 660', 660, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:02:52', NULL),
(586, 'New Record inserted On users id 1212', 1212, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:02:52', NULL),
(587, 'New Record inserted On users id 1213', 1213, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:02:52', NULL),
(588, 'Record updated On students id 627', 627, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:02:52', NULL),
(589, 'New Record inserted On students id 628', 628, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:04:51', NULL),
(590, 'New Record inserted On  student session id 661', 661, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:04:51', NULL),
(591, 'New Record inserted On users id 1214', 1214, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:04:51', NULL),
(592, 'New Record inserted On users id 1215', 1215, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:04:51', NULL),
(593, 'Record updated On students id 628', 628, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:04:51', NULL),
(594, 'New Record inserted On students id 629', 629, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:09:41', NULL),
(595, 'New Record inserted On  student session id 662', 662, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:09:41', NULL),
(596, 'New Record inserted On users id 1216', 1216, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:09:41', NULL),
(597, 'New Record inserted On users id 1217', 1217, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:09:41', NULL),
(598, 'Record updated On students id 629', 629, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:09:41', NULL),
(599, 'Record updated On students id 603', 603, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:29:27', NULL),
(600, 'Record updated On  student session id 636', 636, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:29:27', NULL),
(601, 'Record updated On students id 599', 599, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:31:05', NULL),
(602, 'Record updated On  student session id 632', 632, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:31:05', NULL),
(603, 'Record updated On students id 597', 597, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:58:44', NULL),
(604, 'Record updated On  student session id 630', 630, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 13:58:44', NULL),
(605, 'Record updated On students id 600', 600, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 14:00:07', NULL),
(606, 'Record updated On  student session id 633', 633, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 14:00:07', NULL),
(607, 'Record updated On students id 615', 615, 1, 'Update', '223.184.177.148', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 14:18:37', NULL),
(608, 'Record updated On  student session id 648', 648, 1, 'Update', '223.184.177.148', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 14:18:37', NULL),
(609, 'Record updated On students id 620', 620, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 14:50:09', NULL),
(610, 'Record updated On  student session id 653', 653, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 14:50:09', NULL),
(611, 'Record updated On students id 624', 624, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 14:53:57', NULL),
(612, 'Record updated On  student session id 657', 657, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 14:53:57', NULL),
(613, 'Record updated On students id 618', 618, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 14:55:30', NULL),
(614, 'Record updated On  student session id 651', 651, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 14:55:30', NULL),
(615, 'Record updated On students id 604', 604, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 15:09:10', NULL),
(616, 'Record updated On  student session id 637', 637, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 15:09:10', NULL),
(617, 'Record updated On students id 585', 585, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 15:17:47', NULL),
(618, 'Record updated On  student session id 618', 618, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 141.0.0.0', '2025-11-08 15:17:47', NULL),
(619, 'Record updated On students id 585', 585, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 16:54:05', NULL),
(620, 'Record updated On  student session id 618', 618, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 16:54:05', NULL),
(621, 'Record updated On students id 594', 594, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 16:55:45', NULL),
(622, 'Record updated On  student session id 627', 627, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 16:55:45', NULL),
(623, 'Record updated On students id 627', 627, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 16:57:51', NULL),
(624, 'Record updated On  student session id 660', 660, 1, 'Update', '103.68.21.66', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-08 16:57:51', NULL),
(625, 'Record updated On  income head   id 2', 2, 1, 'Update', '103.68.21.90', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 10:49:39', NULL),
(626, 'New Record inserted On  Income   id 1', 1, 1, 'Insert', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 10:50:21', NULL),
(627, 'New Record inserted On item category id 1', 1, 1, 'Insert', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 10:53:27', NULL),
(628, 'New Record inserted On item id 1', 1, 1, 'Insert', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 10:53:51', NULL),
(629, 'New Record inserted On  fees discounts id 6', 6, 1, 'Insert', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 11:17:27', NULL),
(630, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:57:55', NULL),
(631, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:57:55', NULL),
(632, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:57:55', NULL),
(633, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:58:37', NULL),
(634, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:58:37', NULL),
(635, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:58:37', NULL),
(636, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:58:53', NULL),
(637, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:58:53', NULL),
(638, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:58:53', NULL),
(639, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:59:09', NULL),
(640, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:59:09', NULL),
(641, 'Record updated On staff id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 14:59:09', NULL),
(642, 'Record updated On  permission student id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:06', NULL),
(643, 'Record updated On permission group id 3', 3, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:08', NULL),
(644, 'Record updated On permission group id 3', 3, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:09', NULL),
(645, 'Record updated On permission group id 4', 4, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:09', NULL),
(646, 'Record updated On permission group id 5', 5, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:11', NULL),
(647, 'Record updated On permission group id 6', 6, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:13', NULL),
(648, 'Record updated On permission group id 3', 3, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:14', NULL),
(649, 'Record updated On permission group id 2', 2, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:15', NULL),
(650, 'Record updated On permission group id 8', 8, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:18', NULL),
(651, 'Record updated On permission group id 9', 9, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:19', NULL),
(652, 'Record updated On permission group id 10', 10, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:20', NULL),
(653, 'Record updated On permission group id 11', 11, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:21', NULL),
(654, 'Record updated On permission group id 12', 12, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:22', NULL),
(655, 'Record updated On permission group id 13', 13, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:23', NULL),
(656, 'Record updated On permission group id 16', 16, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:26', NULL),
(657, 'Record updated On permission group id 17', 17, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:28', NULL),
(658, 'Record updated On permission group id 19', 19, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:29', NULL),
(659, 'Record updated On permission group id 20', 20, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:31', NULL),
(660, 'Record updated On permission group id 21', 21, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:35', NULL),
(661, 'Record updated On permission group id 23', 23, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:37', NULL),
(662, 'Record updated On permission group id 25', 25, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:39', NULL),
(663, 'Record updated On permission group id 26', 26, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:41', NULL),
(664, 'Record updated On permission group id 27', 27, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:42', NULL),
(665, 'Record updated On permission group id 28', 28, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:44', NULL),
(666, 'Record updated On permission group id 29', 29, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:46', NULL),
(667, 'Record updated On permission group id 2', 2, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:40:51', NULL),
(668, 'Record updated On  permission student id 1', 1, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:44:43', NULL),
(669, 'Record updated On  permission student id 16', 16, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:44:51', NULL),
(670, 'Record updated On  permission student id 23', 23, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 15:44:57', NULL),
(671, 'Record updated On students id 624', 624, 1, 'Update', '223.233.70.128', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 20:32:07', NULL),
(672, 'Record updated On  student session id 657', 657, 1, 'Update', '223.233.70.128', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 20:32:07', NULL),
(673, 'Record updated On students id 572', 572, 1, 'Update', '223.233.70.128', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 20:34:15', NULL),
(674, 'Record updated On  student session id 605', 605, 1, 'Update', '223.233.70.128', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 20:34:15', NULL),
(675, 'Record updated On students id 576', 576, 1, 'Update', '223.233.70.128', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 20:42:16', NULL),
(676, 'Record updated On  student session id 609', 609, 1, 'Update', '223.233.70.128', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 20:42:16', NULL),
(677, 'Record updated On students id 589', 589, 1, 'Update', '223.233.70.128', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 21:12:53', NULL),
(678, 'Record updated On  student session id 622', 622, 1, 'Update', '223.233.70.128', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-09 21:12:53', NULL),
(679, 'Record updated On students id 588', 588, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-10 08:41:20', NULL),
(680, 'Record updated On  student session id 621', 621, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-10 08:41:20', NULL),
(681, 'Record updated On students id 588', 588, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-10 08:41:20', NULL),
(682, 'Record updated On students id 584', 584, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-10 12:30:24', NULL),
(683, 'Record updated On  student session id 617', 617, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-10 12:30:24', NULL),
(684, 'Record updated On students id 584', 584, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-10 12:31:31', NULL),
(685, 'Record updated On  student session id 617', 617, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-10 12:31:31', NULL),
(686, 'Record updated On students id 626', 626, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-10 16:10:47', NULL),
(687, 'Record updated On  student session id 659', 659, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-10 16:10:47', NULL),
(688, 'Record updated On students id 587', 587, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 10:10:01', NULL),
(689, 'Record updated On  student session id 620', 620, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 10:10:01', NULL),
(690, 'Record updated On students id 588', 588, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 10:22:24', NULL),
(691, 'Record updated On  student session id 621', 621, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 10:22:24', NULL),
(692, 'Record updated On students id 588', 588, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 10:22:24', NULL),
(693, 'Record updated On students id 587', 587, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 10:31:24', NULL),
(694, 'Record updated On  student session id 620', 620, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 10:31:24', NULL),
(695, 'Record updated On students id 587', 587, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 10:31:24', NULL);
INSERT INTO `logs` (`id`, `message`, `record_id`, `user_id`, `action`, `ip_address`, `platform`, `agent`, `time`, `created_at`) VALUES
(696, 'Record updated On students id 586', 586, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 11:37:51', NULL),
(697, 'Record updated On  student session id 619', 619, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 11:37:51', NULL),
(698, 'Record updated On students id 586', 586, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 11:37:51', NULL),
(699, 'Record updated On students id 584', 584, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:36:32', NULL),
(700, 'Record updated On  student session id 617', 617, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:36:32', NULL),
(701, 'Record updated On students id 584', 584, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:36:32', NULL),
(702, 'Record updated On students id 583', 583, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:38:27', NULL),
(703, 'Record updated On  student session id 616', 616, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:38:27', NULL),
(704, 'Record updated On students id 583', 583, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:38:27', NULL),
(705, 'Record updated On students id 582', 582, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:40:04', NULL),
(706, 'Record updated On  student session id 615', 615, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:40:04', NULL),
(707, 'Record updated On students id 582', 582, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:40:04', NULL),
(708, 'Record updated On students id 582', 582, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:43:38', NULL),
(709, 'Record updated On  student session id 615', 615, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:43:38', NULL),
(710, 'Record updated On students id 582', 582, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:43:38', NULL),
(711, 'Record updated On students id 581', 581, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:45:11', NULL),
(712, 'Record updated On  student session id 614', 614, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:45:11', NULL),
(713, 'Record updated On students id 581', 581, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:45:11', NULL),
(714, 'Record updated On students id 629', 629, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:46:53', NULL),
(715, 'Record updated On  student session id 662', 662, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:46:53', NULL),
(716, 'Record updated On students id 629', 629, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:46:53', NULL),
(717, 'Record updated On students id 608', 608, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:49:06', NULL),
(718, 'Record updated On  student session id 641', 641, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:49:06', NULL),
(719, 'Record updated On students id 608', 608, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:49:06', NULL),
(720, 'Record updated On students id 580', 580, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:50:16', NULL),
(721, 'Record updated On  student session id 613', 613, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:50:16', NULL),
(722, 'Record updated On students id 580', 580, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:50:16', NULL),
(723, 'Record updated On students id 579', 579, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:52:16', NULL),
(724, 'Record updated On  student session id 612', 612, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:52:16', NULL),
(725, 'Record updated On students id 579', 579, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:52:16', NULL),
(726, 'Record updated On students id 570', 570, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:53:39', NULL),
(727, 'Record updated On  student session id 603', 603, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:53:39', NULL),
(728, 'Record updated On students id 570', 570, 1, 'Update', '103.68.21.83', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-11 12:53:39', NULL),
(729, 'Record updated On students id 571', 571, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:05:08', NULL),
(730, 'Record updated On  student session id 604', 604, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:05:08', NULL),
(731, 'Record updated On students id 572', 572, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:05:32', NULL),
(732, 'Record updated On  student session id 605', 605, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:05:32', NULL),
(733, 'Record updated On students id 570', 570, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:05:45', NULL),
(734, 'Record updated On  student session id 603', 603, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:05:45', NULL),
(735, 'Record updated On students id 578', 578, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:05:58', NULL),
(736, 'Record updated On  student session id 611', 611, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:05:58', NULL),
(737, 'Record updated On students id 575', 575, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:06:11', NULL),
(738, 'Record updated On  student session id 608', 608, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:06:11', NULL),
(739, 'Record updated On students id 573', 573, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:06:28', NULL),
(740, 'Record updated On  student session id 606', 606, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:06:28', NULL),
(741, 'Record updated On students id 569', 569, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:06:41', NULL),
(742, 'Record updated On  student session id 602', 602, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:06:41', NULL),
(743, 'Record updated On students id 589', 589, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:06:59', NULL),
(744, 'Record updated On  student session id 622', 622, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:06:59', NULL),
(745, 'Record updated On students id 577', 577, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:07:11', NULL),
(746, 'Record updated On  student session id 610', 610, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:07:11', NULL),
(747, 'Record updated On students id 590', 590, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:07:22', NULL),
(748, 'Record updated On  student session id 623', 623, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:07:22', NULL),
(749, 'Record updated On students id 591', 591, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:07:39', NULL),
(750, 'Record updated On  student session id 624', 624, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:07:39', NULL),
(751, 'Record updated On students id 576', 576, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:08:52', NULL),
(752, 'Record updated On  student session id 609', 609, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:08:52', NULL),
(753, 'Record updated On students id 585', 585, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:10:42', NULL),
(754, 'Record updated On students id 606', 606, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:16:29', NULL),
(755, 'Record deleted On  disable reason id 4', 4, 1, 'Delete', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:54:26', NULL),
(756, 'New Record inserted On disable reason id 5', 5, 1, 'Insert', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 14:54:52', NULL),
(757, 'Record updated On  disable reason id 3', 3, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 15:06:42', NULL),
(758, 'New Record inserted On disable reason id 6', 6, 1, 'Insert', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 15:06:48', NULL),
(759, 'Record deleted On  disable reason id 6', 6, 1, 'Delete', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 15:06:58', NULL),
(760, 'Record updated On  disable reason id 2', 2, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 15:07:10', NULL),
(761, 'Record updated On users id 1128', 1128, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 15:07:44', NULL),
(762, 'Record updated On students id 585', 585, 1, 'Update', '103.68.21.67', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-12 15:08:11', NULL),
(763, 'Record deleted On roles id 20', 20, 1, 'Delete', '106.78.72.18', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-14 13:50:18', NULL),
(764, 'Record updated On permission group id 3', 3, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:09', NULL),
(765, 'Record updated On permission group id 4', 4, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:13', NULL),
(766, 'Record updated On permission group id 5', 5, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:15', NULL),
(767, 'Record updated On permission group id 6', 6, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:17', NULL),
(768, 'Record updated On permission group id 8', 8, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:19', NULL),
(769, 'Record updated On permission group id 9', 9, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:24', NULL),
(770, 'Record updated On permission group id 10', 10, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:26', NULL),
(771, 'Record updated On permission group id 11', 11, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:28', NULL),
(772, 'Record updated On permission group id 12', 12, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:30', NULL),
(773, 'Record updated On permission group id 13', 13, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:31', NULL),
(774, 'Record updated On permission group id 16', 16, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:32', NULL),
(775, 'Record updated On permission group id 17', 17, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:35', NULL),
(776, 'Record updated On permission group id 19', 19, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:36', NULL),
(777, 'Record updated On permission group id 20', 20, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:37', NULL),
(778, 'Record updated On permission group id 21', 21, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:39', NULL),
(779, 'Record updated On permission group id 23', 23, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:41', NULL),
(780, 'Record updated On permission group id 25', 25, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:42', NULL),
(781, 'Record updated On permission group id 26', 26, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:46', NULL),
(782, 'Record updated On permission group id 27', 27, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:48', NULL),
(783, 'Record updated On permission group id 28', 28, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:50', NULL),
(784, 'Record updated On permission group id 29', 29, 1, 'Update', '103.68.21.73', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-16 11:58:52', NULL),
(785, 'Record deleted On  fees discounts id 6', 6, 1, 'Delete', '106.77.137.61', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-18 18:40:13', NULL),
(786, 'New Record inserted On  fees discounts id 7', 7, 1, 'Insert', '106.77.137.61', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-18 18:40:47', NULL),
(787, 'Record updated On students id 571', 571, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-19 09:33:29', NULL),
(788, 'Record updated On  student session id 604', 604, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-19 09:33:29', NULL),
(789, 'Record updated On students id 571', 571, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-19 09:33:29', NULL),
(790, 'Record updated On students id 572', 572, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-19 09:35:05', NULL),
(791, 'Record updated On  student session id 605', 605, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-19 09:35:05', NULL),
(792, 'Record updated On students id 572', 572, 1, 'Update', '103.68.21.65', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-19 09:35:05', NULL),
(793, 'Record deleted On exam groups id 33', 33, 1, 'Delete', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 07:58:14', NULL),
(794, 'Record deleted On exam groups id 32', 32, 1, 'Delete', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 07:58:16', NULL),
(795, 'New Record inserted On exam groups id 34', 34, 1, 'Insert', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 07:58:35', NULL),
(796, 'New Record inserted On exam groups id 35', 35, 1, 'Insert', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 07:58:43', NULL),
(797, 'New Record inserted On exam group exams name id 236', 236, 1, 'Insert', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 07:59:10', NULL),
(798, 'New Record inserted On exam group exams name id 237', 237, 1, 'Insert', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 07:59:52', NULL),
(799, 'Record deleted On exam groups exams name id 237', 237, 1, 'Delete', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 08:03:25', NULL),
(800, 'New Record inserted On exam group exams name id 238', 238, 1, 'Insert', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 08:03:44', NULL),
(801, 'New Record inserted On exam group exams name id 239', 239, 1, 'Insert', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 08:04:00', NULL),
(802, 'New Record inserted On exam group exams name id 240', 240, 1, 'Insert', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 08:04:21', NULL),
(803, 'Record updated On  exam group exams name id 236', 236, 1, 'Update', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 08:17:17', NULL),
(804, 'New Record inserted On exam groups id 9', 9, 1, 'Insert', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 08:17:50', NULL),
(805, 'Record deleted On admit cards id 2', 2, 1, 'Delete', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 08:23:36', NULL),
(806, 'New Record inserted On admit cards id 3', 3, 1, 'Insert', '103.68.21.72', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 08:25:04', NULL),
(807, 'Record updated On  admit cards id 3', 3, 1, 'Update', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 21:09:34', NULL),
(808, 'Record deleted On exam groups id 9', 9, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 21:12:54', NULL),
(809, 'New Record inserted On exam groups id 10', 10, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 21:13:38', NULL),
(810, 'New Record inserted On exam group exams name id 241', 241, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 21:14:52', NULL),
(811, 'New Record inserted On exam group exams name id 242', 242, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 21:18:57', NULL),
(812, 'New Record inserted On exam group exams name id 243', 243, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 21:20:43', NULL),
(813, 'Record deleted On exam groups exams name id 240', 240, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 21:22:02', NULL),
(814, 'Record deleted On exam groups exams name id 239', 239, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 21:22:07', NULL),
(815, 'New Record inserted On exam group exams name id 244', 244, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 21:24:09', NULL),
(816, 'New Record inserted On exam group exams name id 245', 245, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 21:24:37', NULL),
(817, 'Record deleted On exam groups exams name id 243', 243, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:12:53', NULL),
(818, 'New Record inserted On exam groups id 11', 11, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:13:45', NULL),
(819, 'Record deleted On exam groups id 11', 11, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:17:01', NULL),
(820, 'Record deleted On exam groups id 10', 10, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:17:11', NULL),
(821, 'New Record inserted On exam groups id 12', 12, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:17:37', NULL),
(822, 'New Record inserted On exam groups id 13', 13, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:17:53', NULL),
(823, 'New Record inserted On exam groups id 14', 14, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:18:28', NULL),
(824, 'New Record inserted On exam group exams name id 246', 246, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:19:02', NULL),
(825, 'New Record inserted On exam group exams name id 247', 247, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:19:32', NULL),
(826, 'New Record inserted On exam group exams name id 248', 248, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:19:48', NULL),
(827, 'Record deleted On exam groups exams name id 248', 248, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:25:09', NULL),
(828, 'Record deleted On exam groups exams name id 247', 247, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:25:14', NULL),
(829, 'Record deleted On exam groups exams name id 246', 246, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:25:17', NULL),
(830, 'Record deleted On exam groups id 12', 12, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:25:30', NULL),
(831, 'Record deleted On exam groups id 13', 13, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:25:47', NULL),
(832, 'Record deleted On exam groups id 14', 14, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:26:06', NULL),
(833, 'New Record inserted On exam groups id 15', 15, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:26:29', NULL),
(834, 'New Record inserted On exam group exams name id 249', 249, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:27:30', NULL),
(835, 'New Record inserted On exam groups id 16', 16, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:30:23', NULL),
(836, 'New Record inserted On exam groups id 17', 17, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:30:36', NULL),
(837, 'Record deleted On exam groups id 17', 17, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:32:07', NULL),
(838, 'Record deleted On exam groups id 16', 16, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:32:18', NULL),
(839, 'Record deleted On exam groups exams name id 249', 249, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:32:43', NULL),
(840, 'New Record inserted On exam group exams name id 250', 250, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:32:59', NULL),
(841, 'Record deleted On exam groups exams name id 250', 250, 1, 'Delete', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:35:17', NULL),
(842, 'New Record inserted On exam group exams name id 251', 251, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:36:22', NULL),
(843, 'New Record inserted On exam group exams name id 252', 252, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:36:48', NULL),
(844, 'New Record inserted On exam group exams name id 253', 253, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:37:37', NULL),
(845, 'New Record inserted On exam group exams name id 254', 254, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:38:08', NULL),
(846, 'New Record inserted On exam groups id 18', 18, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:39:44', NULL),
(847, 'New Record inserted On exam group exams name id 255', 255, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:46:09', NULL),
(848, 'New Record inserted On exam group exams name id 256', 256, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:47:06', NULL),
(849, 'New Record inserted On exam group exams name id 257', 257, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:47:27', NULL),
(850, 'New Record inserted On exam group exams name id 258', 258, 1, 'Insert', '106.78.67.59', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-20 22:47:47', NULL),
(851, 'Record updated On students id 591', 591, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 12:49:05', NULL),
(852, 'Record updated On  student session id 624', 624, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 12:49:05', NULL),
(853, 'Record updated On students id 591', 591, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 12:49:05', NULL),
(854, 'Record updated On students id 591', 591, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 12:49:05', NULL),
(855, 'Record updated On students id 591', 591, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 12:49:05', NULL),
(856, 'Record updated On students id 590', 590, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 12:57:27', NULL),
(857, 'Record updated On  student session id 623', 623, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 12:57:27', NULL),
(858, 'Record updated On students id 590', 590, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 12:57:27', NULL),
(859, 'Record updated On students id 590', 590, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 12:57:27', NULL),
(860, 'Record updated On students id 590', 590, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 12:57:27', NULL),
(861, 'Record updated On students id 589', 589, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 13:05:09', NULL),
(862, 'Record updated On  student session id 622', 622, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 13:05:09', NULL),
(863, 'Record updated On students id 589', 589, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 13:05:09', NULL),
(864, 'Record updated On students id 589', 589, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 13:05:09', NULL),
(865, 'Record updated On students id 589', 589, 1, 'Update', '103.68.21.75', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 13:05:09', NULL),
(866, 'Record updated On grades id 2', 2, 1, 'Update', '112.110.58.14', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 21:50:09', NULL),
(867, 'Record deleted On exam groups id 15', 15, 1, 'Delete', '112.110.58.14', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 21:56:07', NULL),
(868, 'Record deleted On exam groups id 18', 18, 1, 'Delete', '112.110.58.14', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 21:56:11', NULL),
(869, 'New Record inserted On exam groups id 19', 19, 1, 'Insert', '112.110.58.14', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 21:56:31', NULL),
(870, 'New Record inserted On exam groups id 20', 20, 1, 'Insert', '112.110.58.14', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 21:56:42', NULL),
(871, 'New Record inserted On exam group exams name id 259', 259, 1, 'Insert', '112.110.58.14', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 21:57:09', NULL),
(872, 'New Record inserted On exam group exams name id 260', 260, 1, 'Insert', '112.110.58.14', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 21:59:36', NULL),
(873, 'Record deleted On exam groups exams name id 259', 259, 1, 'Delete', '112.110.58.14', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 22:03:07', NULL),
(874, 'New Record inserted On exam group exams name id 261', 261, 1, 'Insert', '112.110.58.14', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-21 22:03:34', NULL),
(875, 'Record updated On subjects id 86', 86, 1, 'Update', '103.68.21.93', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 11:40:30', NULL),
(876, 'Record updated On  exam groups id 34', 34, 1, 'Update', '103.68.21.93', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 16:10:25', NULL),
(877, 'New Record inserted On exam group exams name id 262', 262, 1, 'Insert', '103.68.21.93', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 16:11:44', NULL),
(878, 'Record deleted On exam groups exams name id 262', 262, 1, 'Delete', '103.68.21.93', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 16:12:01', NULL),
(879, 'Record updated On  exam groups id 34', 34, 1, 'Update', '103.68.21.93', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 16:19:05', NULL),
(880, 'New Record inserted On exam group exams name id 263', 263, 1, 'Insert', '103.68.21.93', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 16:20:49', NULL),
(881, 'Record updated On  admit cards id 3', 3, 1, 'Update', '103.68.21.93', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 16:35:57', NULL),
(882, 'Record updated On  exam group exams name id 236', 236, 1, 'Update', '106.78.66.133', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 19:43:11', NULL),
(883, 'Record updated On  exam group exams name id 236', 236, 1, 'Update', '106.78.66.133', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 19:43:17', NULL),
(884, 'Record deleted On admit cards id 3', 3, 1, 'Delete', '106.78.66.61', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 20:21:34', NULL),
(885, 'New Record inserted On admit cards id 4', 4, 1, 'Insert', '106.78.66.101', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 20:24:07', NULL),
(886, 'Record deleted On id card id 1', 1, 1, 'Delete', '106.78.66.61', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 20:43:27', NULL),
(887, 'New Record inserted On certificates id 2', 2, 1, 'Insert', '106.78.66.61', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:01:31', NULL),
(888, 'Record updated On  certificates id 2', 2, 1, 'Update', '106.78.66.61', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:02:01', NULL),
(889, 'Record updated On  certificates id 2', 2, 1, 'Update', '106.78.66.61', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:03:19', NULL),
(890, 'Record updated On  certificates id 2', 2, 1, 'Update', '106.78.66.61', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:05:57', NULL),
(891, 'Record updated On  certificates id 2', 2, 1, 'Update', '106.78.66.61', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:07:29', NULL),
(892, 'New Record inserted On id card id 3', 3, 1, 'Insert', '106.78.66.255', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:11:10', NULL),
(893, 'Record updated On  id card id 3', 3, 1, 'Update', '106.78.66.255', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:11:10', NULL),
(894, 'New Record inserted On exam groups id 36', 36, 1, 'Insert', '106.78.66.255', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:16:13', NULL),
(895, 'Record deleted On exam groups id 36', 36, 1, 'Delete', '106.78.66.255', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:17:31', NULL),
(896, 'Record updated On  exam groups id 34', 34, 1, 'Update', '106.78.66.255', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:18:55', NULL),
(897, 'Record updated On  exam groups id 34', 34, 1, 'Update', '106.78.66.255', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:20:05', NULL),
(898, 'New Record inserted On exam group exams name id 264', 264, 1, 'Insert', '106.78.66.255', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:21:07', NULL),
(899, 'New Record inserted On exam group exams name id 265', 265, 1, 'Insert', '106.78.66.255', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 21:21:29', NULL),
(900, 'New Record inserted On exam group exams name id 266', 266, 1, 'Insert', '106.78.66.255', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 22:16:39', NULL),
(901, 'New Record inserted On exam group exams name id 267', 267, 1, 'Insert', '106.78.66.255', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 22:16:54', NULL),
(902, 'Record deleted On exam groups exams name id 263', 263, 1, 'Delete', '106.78.66.98', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 22:26:16', NULL),
(903, 'Record deleted On exam groups exams name id 261', 261, 1, 'Delete', '106.78.66.98', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 22:26:19', NULL),
(904, 'Record deleted On exam groups exams name id 260', 260, 1, 'Delete', '106.78.66.98', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 22:26:53', NULL),
(905, 'Record deleted On exam groups id 20', 20, 1, 'Delete', '106.78.66.98', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 22:27:01', NULL),
(906, 'New Record inserted On exam group exams name id 268', 268, 1, 'Insert', '106.78.66.98', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 22:27:19', NULL),
(907, 'New Record inserted On exam group exams name id 269', 269, 1, 'Insert', '106.78.66.98', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 22:27:34', NULL),
(908, 'New Record inserted On exam group exams name id 270', 270, 1, 'Insert', '106.78.66.98', 'Windows 10', 'Chrome 142.0.0.0', '2025-11-22 22:27:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `send_mail` varchar(10) DEFAULT '0',
  `send_sms` varchar(10) DEFAULT '0',
  `is_group` varchar(10) DEFAULT '0',
  `is_individual` varchar(10) DEFAULT '0',
  `is_class` int(11) NOT NULL DEFAULT 0,
  `group_list` text DEFAULT NULL,
  `user_list` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `title`, `message`, `send_mail`, `send_sms`, `is_group`, `is_individual`, `is_class`, `group_list`, `user_list`, `created_at`, `updated_at`) VALUES
(1, 'test', 'hello', '0', '1', '0', '1', 0, NULL, '[{\"category\":\"student\",\"user_id\":\"298\",\"email\":\"\",\"guardianEmail\":\"\",\"mobileno\":\"9897982348\",\"app_key\":\"\"}]', '2023-01-03 09:27:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multi_class_students`
--

CREATE TABLE `multi_class_students` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_roles`
--

CREATE TABLE `notification_roles` (
  `id` int(11) NOT NULL,
  `send_notification_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `notification_roles`
--

INSERT INTO `notification_roles` (`id`, `send_notification_id`, `role_id`, `is_active`, `created_at`) VALUES
(1, 1, 1, 0, '2025-11-07 15:41:53'),
(2, 1, 7, 0, '2025-11-07 15:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `notification_setting`
--

CREATE TABLE `notification_setting` (
  `id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `is_mail` varchar(10) DEFAULT '0',
  `is_sms` varchar(10) DEFAULT '0',
  `is_notification` int(11) NOT NULL DEFAULT 0,
  `display_notification` int(11) NOT NULL DEFAULT 0,
  `display_sms` int(11) NOT NULL DEFAULT 1,
  `template` longtext NOT NULL,
  `variables` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `notification_setting`
--

INSERT INTO `notification_setting` (`id`, `type`, `is_mail`, `is_sms`, `is_notification`, `display_notification`, `display_sms`, `template`, `variables`, `created_at`) VALUES
(1, 'student_admission', '1', '1', 0, 0, 1, 'Dear {{student_name}} your admission is confirm in Class: {{class}} Section:  {{section}} for Session: {{current_session_name}} for more \r\ndetail\r\n contact\r\n System\r\n Admin\r\n {{class}} {{section}} {{admission_no}} {{roll_no}} {{admission_date}} {{mobileno}} {{email}} {{dob}} {{guardian_name}} {{guardian_relation}} {{guardian_phone}} {{father_name}} {{father_phone}} {{blood_group}} {{mother_name}} {{gender}} {{guardian_email}}', '{{student_name}} {{class}}  {{section}}  {{admission_no}}  {{roll_no}}  {{admission_date}}   {{mobileno}}  {{email}}  {{dob}}  {{guardian_name}}  {{guardian_relation}}  {{guardian_phone}}  {{father_name}}  {{father_phone}}  {{blood_group}}  {{mother_name}}  {{gender}} {{guardian_email}} {{current_session_name}} ', '2021-01-22 11:34:16'),
(2, 'exam_result', '1', '1', 1, 1, 1, 'Dear {{student_name}} - {{exam_roll_no}}, your {{exam}} result has been published.', '{{student_name}} {{exam_roll_no}} {{exam}}', '2021-01-22 11:34:56'),
(3, 'fee_submission', '1', '1', 1, 1, 1, 'Dear parents, we have received Fees Amount {{fee_amount}} for  {{student_name}}  by Godwin  Public School\r\n{{class}} {{section}} {{fine_type}} {{fine_percentage}} {{fine_amount}} {{fee_group_name}} {{type}} {{code}} {{email}} {{contact_no}} {{invoice_id}} {{sub_invoice_id}} {{due_date}} {{amount}} {{fee_amount}}', '{{student_name}} {{class}} {{section}} {{fine_type}} {{fine_percentage}} {{fine_amount}} {{fee_group_name}} {{type}} {{code}} {{email}} {{contact_no}} {{invoice_id}} {{sub_invoice_id}} {{due_date}} {{amount}} {{fee_amount}}', '2023-01-19 07:34:02'),
(4, 'absent_attendence', '1', '1', 1, 1, 1, 'Absent Notice :{{student_name}}  was absent on date {{date}} in period {{subject_name}} {{subject_code}} {{subject_type}} from Godwin Public School', '{{student_name}} {{mobileno}} {{email}} {{father_name}} {{father_phone}} {{father_occupation}} {{mother_name}} {{mother_phone}} {{guardian_name}} {{guardian_phone}} {{guardian_occupation}} {{guardian_email}} {{date}} {{current_session_name}}             {{time_from}} {{time_to}} {{subject_name}} {{subject_code}} {{subject_type}}  ', '2023-01-19 07:35:25'),
(5, 'login_credential', '1', '1', 0, 0, 1, 'Hello {{display_name}} your login details for Url: {{url}} Username: {{username}}  Password: {{password}}', '{{url}} {{display_name}} {{username}} {{password}}', '2021-01-19 12:15:36'),
(6, 'homework', '1', '1', 1, 1, 1, 'New Homework has been created for \r\n{{student_name}} at\r\n\r\n\r\n\r\n{{homework_date}} for the class {{class}} {{section}} {{subject}}. kindly submit your\r\n\r\n\r\n homework before {{submit_date}} .Thank you', '{{homework_date}} {{submit_date}} {{class}} {{section}} {{subject}} {{student_name}}', '2021-01-19 12:43:22'),
(7, 'fees_reminder', '1', '1', 1, 1, 1, 'Dear parents, please pay fee amount Rs.{{due_amount}} of {{fee_type}} before {{due_date}} for {{student_name}}  from Godwin Public school (ignore if you already paid)', '{{fee_type}}{{fee_code}}{{due_date}}{{student_name}}{{school_name}}{{fee_amount}}{{due_amount}}{{deposit_amount}} ', '2023-01-19 07:37:28'),
(8, 'forgot_password', '1', '0', 0, 0, 0, 'Dear  {{name}} , \r\n    Recently a request was submitted to reset password for your account. If you didn\'t make the request, just ignore this email. Otherwise you can reset your password using this link <a href=\'{{resetPassLink}}\'>Click here to reset your password</a>,\r\nif you\'re having trouble clicking the password reset button, copy and paste the URL below into your web browser. your username {{username}}\r\n{{resetPassLink}}\r\n Regards,\r\n {{school_name}}', '{{school_name}}{{name}}{{username}}{{resetPassLink}} ', '2021-01-22 11:44:50'),
(9, 'online_examination_publish_exam', '1', '1', 1, 1, 1, 'A new exam {{exam_title}} has been created for  duration: {{time_duration}} min, which will be available from:  {{exam_from}} to  {{exam_to}}.', '{{exam_title}} {{exam_from}} {{exam_to}} {{time_duration}} {{attempt}} {{passing_percentage}}', '2021-01-18 12:46:16'),
(10, 'online_examination_publish_result', '1', '1', 1, 1, 1, 'Exam {{exam_title}} result has been declared which was conducted between  {{exam_from}} to   {{exam_to}}, for more details, please check your student portal.', '{{exam_title}} {{exam_from}} {{exam_to}} {{time_duration}} {{attempt}} {{passing_percentage}}', '2021-01-18 12:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `onlineexam`
--

CREATE TABLE `onlineexam` (
  `id` int(11) NOT NULL,
  `exam` text DEFAULT NULL,
  `attempt` int(11) NOT NULL,
  `exam_from` datetime DEFAULT NULL,
  `exam_to` datetime DEFAULT NULL,
  `is_quiz` int(11) NOT NULL DEFAULT 0,
  `auto_publish_date` datetime DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `duration` time NOT NULL,
  `passing_percentage` float NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `publish_result` int(11) NOT NULL DEFAULT 0,
  `is_active` varchar(1) DEFAULT '0',
  `is_marks_display` int(11) NOT NULL DEFAULT 0,
  `is_neg_marking` int(11) NOT NULL DEFAULT 0,
  `is_random_question` int(11) NOT NULL DEFAULT 0,
  `is_rank_generated` int(11) NOT NULL DEFAULT 0,
  `publish_exam_notification` int(11) NOT NULL,
  `publish_result_notification` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onlineexam_attempts`
--

CREATE TABLE `onlineexam_attempts` (
  `id` int(11) NOT NULL,
  `onlineexam_student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onlineexam_questions`
--

CREATE TABLE `onlineexam_questions` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `onlineexam_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `marks` float(10,2) NOT NULL DEFAULT 0.00,
  `neg_marks` float(10,2) DEFAULT 0.00,
  `is_active` varchar(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onlineexam_students`
--

CREATE TABLE `onlineexam_students` (
  `id` int(11) NOT NULL,
  `onlineexam_id` int(11) DEFAULT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `is_attempted` int(11) NOT NULL DEFAULT 0,
  `rank` int(11) DEFAULT 0,
  `quiz_attempted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onlineexam_student_results`
--

CREATE TABLE `onlineexam_student_results` (
  `id` int(11) NOT NULL,
  `onlineexam_student_id` int(11) NOT NULL,
  `onlineexam_question_id` int(11) NOT NULL,
  `select_option` longtext DEFAULT NULL,
  `marks` float(10,2) NOT NULL DEFAULT 0.00,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_admissions`
--

CREATE TABLE `online_admissions` (
  `id` int(11) NOT NULL,
  `admission_no` varchar(100) DEFAULT NULL,
  `roll_no` varchar(100) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `rte` varchar(20) NOT NULL DEFAULT 'No',
  `image` varchar(100) DEFAULT NULL,
  `mobileno` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `cast` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `school_house_id` int(11) DEFAULT NULL,
  `blood_group` varchar(200) NOT NULL,
  `vehroute_id` int(11) NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `adhar_no` varchar(100) DEFAULT NULL,
  `samagra_id` varchar(100) DEFAULT NULL,
  `bank_account_no` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `guardian_is` varchar(100) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_phone` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_phone` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_relation` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(100) DEFAULT NULL,
  `guardian_occupation` varchar(150) NOT NULL,
  `guardian_address` text DEFAULT NULL,
  `guardian_email` varchar(100) NOT NULL,
  `father_pic` varchar(200) NOT NULL,
  `mother_pic` varchar(200) NOT NULL,
  `guardian_pic` varchar(200) NOT NULL,
  `is_enroll` int(11) DEFAULT 0,
  `previous_school` text DEFAULT NULL,
  `height` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `note` varchar(200) NOT NULL,
  `measurement_date` date DEFAULT NULL,
  `app_key` text DEFAULT NULL,
  `document` text DEFAULT NULL,
  `disable_at` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `payment_type` varchar(200) NOT NULL,
  `api_username` varchar(200) DEFAULT NULL,
  `api_secret_key` varchar(200) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `api_publishable_key` varchar(200) NOT NULL,
  `api_password` varchar(200) DEFAULT NULL,
  `api_signature` varchar(200) DEFAULT NULL,
  `api_email` varchar(200) DEFAULT NULL,
  `paypal_demo` varchar(100) NOT NULL,
  `account_no` varchar(200) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `gateway_mode` int(11) NOT NULL COMMENT '0 Testing, 1 live',
  `paytm_website` varchar(255) NOT NULL,
  `paytm_industrytype` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payslip_allowance`
--

CREATE TABLE `payslip_allowance` (
  `id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `allowance_type` varchar(200) NOT NULL,
  `amount` float NOT NULL,
  `staff_id` int(11) NOT NULL,
  `cal_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_category`
--

CREATE TABLE `permission_category` (
  `id` int(11) NOT NULL,
  `perm_group_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) DEFAULT NULL,
  `enable_view` int(11) DEFAULT 0,
  `enable_add` int(11) DEFAULT 0,
  `enable_edit` int(11) DEFAULT 0,
  `enable_delete` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `permission_category`
--

INSERT INTO `permission_category` (`id`, `perm_group_id`, `name`, `short_code`, `enable_view`, `enable_add`, `enable_edit`, `enable_delete`, `created_at`) VALUES
(1, 1, 'Student', 'student', 1, 1, 1, 1, '2019-10-24 05:42:03'),
(2, 1, 'Import Student', 'import_student', 1, 0, 0, 0, '2018-06-22 10:17:19'),
(3, 1, 'Student Categories', 'student_categories', 1, 1, 1, 1, '2018-06-22 10:17:36'),
(4, 1, 'Student Houses', 'student_houses', 1, 1, 1, 1, '2018-06-22 10:17:53'),
(5, 2, 'Collect Fees', 'collect_fees', 1, 1, 0, 1, '2018-06-22 10:21:03'),
(6, 2, 'Fees Carry Forward', 'fees_carry_forward', 1, 0, 0, 0, '2018-06-27 00:18:15'),
(7, 2, 'Fees Master', 'fees_master', 1, 1, 1, 1, '2018-06-27 00:18:57'),
(8, 2, 'Fees Group', 'fees_group', 1, 1, 1, 1, '2018-06-22 10:21:46'),
(9, 3, 'Income', 'income', 1, 1, 1, 1, '2018-06-22 10:23:21'),
(10, 3, 'Income Head', 'income_head', 1, 1, 1, 1, '2018-06-22 10:22:44'),
(11, 3, 'Search Income', 'search_income', 1, 0, 0, 0, '2018-06-22 10:23:00'),
(12, 4, 'Expense', 'expense', 1, 1, 1, 1, '2018-06-22 10:24:06'),
(13, 4, 'Expense Head', 'expense_head', 1, 1, 1, 1, '2018-06-22 10:23:47'),
(14, 4, 'Search Expense', 'search_expense', 1, 0, 0, 0, '2018-06-22 10:24:13'),
(15, 5, 'Student / Period Attendance', 'student_attendance', 1, 1, 1, 0, '2019-11-29 01:19:05'),
(20, 6, 'Marks Grade', 'marks_grade', 1, 1, 1, 1, '2018-06-22 10:25:25'),
(21, 7, 'Class Timetable', 'class_timetable', 1, 0, 1, 0, '2019-11-24 03:05:17'),
(23, 7, 'Subject', 'subject', 1, 1, 1, 1, '2018-06-22 10:32:17'),
(24, 7, 'Class', 'class', 1, 1, 1, 1, '2018-06-22 10:32:35'),
(25, 7, 'Section', 'section', 1, 1, 1, 1, '2018-06-22 10:31:10'),
(26, 7, 'Promote Student', 'promote_student', 1, 0, 0, 0, '2018-06-22 10:32:47'),
(27, 8, 'Upload Content', 'upload_content', 1, 1, 0, 1, '2018-06-22 10:33:19'),
(28, 9, 'Books List', 'books', 1, 1, 1, 1, '2019-11-24 00:37:12'),
(29, 9, 'Issue Return', 'issue_return', 1, 0, 0, 0, '2019-11-24 00:37:18'),
(30, 9, 'Add Staff Member', 'add_staff_member', 1, 0, 0, 0, '2018-07-02 11:37:00'),
(31, 10, 'Issue Item', 'issue_item', 1, 1, 1, 1, '2019-11-29 06:39:27'),
(32, 10, 'Add Item Stock', 'item_stock', 1, 1, 1, 1, '2019-11-24 00:39:17'),
(33, 10, 'Add Item', 'item', 1, 1, 1, 1, '2019-11-24 00:39:39'),
(34, 10, 'Item Store', 'store', 1, 1, 1, 1, '2019-11-24 00:40:41'),
(35, 10, 'Item Supplier', 'supplier', 1, 1, 1, 1, '2019-11-24 00:40:49'),
(37, 11, 'Routes', 'routes', 1, 1, 1, 1, '2018-06-22 10:39:17'),
(38, 11, 'Vehicle', 'vehicle', 1, 1, 1, 1, '2018-06-22 10:39:36'),
(39, 11, 'Assign Vehicle', 'assign_vehicle', 1, 1, 1, 1, '2018-06-27 04:39:20'),
(40, 12, 'Hostel', 'hostel', 1, 1, 1, 1, '2018-06-22 10:40:49'),
(41, 12, 'Room Type', 'room_type', 1, 1, 1, 1, '2018-06-22 10:40:27'),
(42, 12, 'Hostel Rooms', 'hostel_rooms', 1, 1, 1, 1, '2018-06-25 06:23:03'),
(43, 13, 'Notice Board', 'notice_board', 1, 1, 1, 1, '2018-06-22 10:41:17'),
(44, 13, 'Email', 'email', 1, 0, 0, 0, '2019-11-26 05:20:37'),
(46, 13, 'Email / SMS Log', 'email_sms_log', 1, 0, 0, 0, '2018-06-22 10:41:23'),
(53, 15, 'Languages', 'languages', 0, 1, 0, 1, '2021-01-23 07:09:32'),
(54, 15, 'General Setting', 'general_setting', 1, 0, 1, 0, '2018-07-05 09:08:35'),
(55, 15, 'Session Setting', 'session_setting', 1, 1, 1, 1, '2018-06-22 10:44:15'),
(56, 15, 'Notification Setting', 'notification_setting', 1, 0, 1, 0, '2018-07-05 09:08:41'),
(57, 15, 'SMS Setting', 'sms_setting', 1, 0, 1, 0, '2018-07-05 09:08:47'),
(58, 15, 'Email Setting', 'email_setting', 1, 0, 1, 0, '2018-07-05 09:08:51'),
(59, 15, 'Front CMS Setting', 'front_cms_setting', 1, 0, 1, 0, '2018-07-05 09:08:55'),
(60, 15, 'Payment Methods', 'payment_methods', 1, 0, 1, 0, '2018-07-05 09:08:59'),
(61, 16, 'Menus', 'menus', 1, 1, 0, 1, '2018-07-09 03:50:06'),
(62, 16, 'Media Manager', 'media_manager', 1, 1, 0, 1, '2018-07-09 03:50:26'),
(63, 16, 'Banner Images', 'banner_images', 1, 1, 0, 1, '2018-06-22 10:46:02'),
(64, 16, 'Pages', 'pages', 1, 1, 1, 1, '2018-06-22 10:46:21'),
(65, 16, 'Gallery', 'gallery', 1, 1, 1, 1, '2018-06-22 10:47:02'),
(66, 16, 'Event', 'event', 1, 1, 1, 1, '2018-06-22 10:47:20'),
(67, 16, 'News', 'notice', 1, 1, 1, 1, '2018-07-03 08:39:34'),
(68, 2, 'Fees Group Assign', 'fees_group_assign', 1, 0, 0, 0, '2018-06-22 10:20:42'),
(69, 2, 'Fees Type', 'fees_type', 1, 1, 1, 1, '2018-06-22 10:19:34'),
(70, 2, 'Fees Discount', 'fees_discount', 1, 1, 1, 1, '2018-06-22 10:20:10'),
(71, 2, 'Fees Discount Assign', 'fees_discount_assign', 1, 0, 0, 0, '2018-06-22 10:20:17'),
(73, 2, 'Search Fees Payment', 'search_fees_payment', 1, 0, 0, 0, '2018-06-22 10:20:27'),
(74, 2, 'Search Due Fees', 'search_due_fees', 1, 0, 0, 0, '2018-06-22 10:20:35'),
(77, 7, 'Assign Class Teacher', 'assign_class_teacher', 1, 1, 1, 1, '2018-06-22 10:30:52'),
(78, 17, 'Admission Enquiry', 'admission_enquiry', 1, 1, 1, 1, '2018-06-22 10:51:24'),
(79, 17, 'Follow Up Admission Enquiry', 'follow_up_admission_enquiry', 1, 1, 0, 1, '2018-06-22 10:51:39'),
(80, 17, 'Visitor Book', 'visitor_book', 1, 1, 1, 1, '2018-06-22 10:48:58'),
(81, 17, 'Phone Call Log', 'phone_call_log', 1, 1, 1, 1, '2018-06-22 10:50:57'),
(82, 17, 'Postal Dispatch', 'postal_dispatch', 1, 1, 1, 1, '2018-06-22 10:50:21'),
(83, 17, 'Postal Receive', 'postal_receive', 1, 1, 1, 1, '2018-06-22 10:50:04'),
(84, 17, 'Complain', 'complaint', 1, 1, 1, 1, '2018-07-03 08:40:55'),
(85, 17, 'Setup Font Office', 'setup_font_office', 1, 1, 1, 1, '2018-06-22 10:49:24'),
(86, 18, 'Staff', 'staff', 1, 1, 1, 1, '2018-06-22 10:53:31'),
(87, 18, 'Disable Staff', 'disable_staff', 1, 0, 0, 0, '2018-06-22 10:53:12'),
(88, 18, 'Staff Attendance', 'staff_attendance', 1, 1, 1, 0, '2018-06-22 10:53:10'),
(90, 18, 'Staff Payroll', 'staff_payroll', 1, 1, 0, 1, '2018-06-22 10:52:51'),
(93, 19, 'Homework', 'homework', 1, 1, 1, 1, '2018-06-22 10:53:50'),
(94, 19, 'Homework Evaluation', 'homework_evaluation', 1, 1, 0, 0, '2018-06-27 03:07:21'),
(96, 20, 'Student Certificate', 'student_certificate', 1, 1, 1, 1, '2018-07-06 10:41:07'),
(97, 20, 'Generate Certificate', 'generate_certificate', 1, 0, 0, 0, '2018-07-06 10:37:16'),
(98, 20, 'Student ID Card', 'student_id_card', 1, 1, 1, 1, '2018-07-06 10:41:28'),
(99, 20, 'Generate ID Card', 'generate_id_card', 1, 0, 0, 0, '2018-07-06 10:41:49'),
(102, 21, 'Calendar To Do List', 'calendar_to_do_list', 1, 1, 1, 1, '2018-06-22 10:54:41'),
(104, 10, 'Item Category', 'item_category', 1, 1, 1, 1, '2018-06-22 10:34:33'),
(106, 22, 'Quick Session Change', 'quick_session_change', 1, 0, 0, 0, '2018-06-22 10:54:45'),
(107, 1, 'Disable Student', 'disable_student', 1, 0, 0, 0, '2018-06-25 06:21:34'),
(108, 18, ' Approve Leave Request', 'approve_leave_request', 1, 0, 1, 1, '2020-10-05 08:56:27'),
(109, 18, 'Apply Leave', 'apply_leave', 1, 1, 0, 0, '2019-11-28 23:47:46'),
(110, 18, 'Leave Types ', 'leave_types', 1, 1, 1, 1, '2018-07-02 10:17:56'),
(111, 18, 'Department', 'department', 1, 1, 1, 1, '2018-06-26 03:57:07'),
(112, 18, 'Designation', 'designation', 1, 1, 1, 1, '2018-06-26 03:57:07'),
(113, 22, 'Fees Collection And Expense Monthly Chart', 'fees_collection_and_expense_monthly_chart', 1, 0, 0, 0, '2018-07-03 07:08:15'),
(114, 22, 'Fees Collection And Expense Yearly Chart', 'fees_collection_and_expense_yearly_chart', 1, 0, 0, 0, '2018-07-03 07:08:15'),
(115, 22, 'Monthly Fees Collection Widget', 'Monthly fees_collection_widget', 1, 0, 0, 0, '2018-07-03 07:13:35'),
(116, 22, 'Monthly Expense Widget', 'monthly_expense_widget', 1, 0, 0, 0, '2018-07-03 07:13:35'),
(117, 22, 'Student Count Widget', 'student_count_widget', 1, 0, 0, 0, '2018-07-03 07:13:35'),
(118, 22, 'Staff Role Count Widget', 'staff_role_count_widget', 1, 0, 0, 0, '2018-07-03 07:13:35'),
(122, 5, 'Attendance By Date', 'attendance_by_date', 1, 0, 0, 0, '2018-07-03 08:42:29'),
(123, 9, 'Add Student', 'add_student', 1, 0, 0, 0, '2018-07-03 08:42:29'),
(126, 15, 'User Status', 'user_status', 1, 0, 0, 0, '2018-07-03 08:42:29'),
(127, 18, 'Can See Other Users Profile', 'can_see_other_users_profile', 1, 0, 0, 0, '2018-07-03 08:42:29'),
(128, 1, 'Student Timeline', 'student_timeline', 0, 1, 0, 1, '2018-07-05 08:08:52'),
(129, 18, 'Staff Timeline', 'staff_timeline', 0, 1, 0, 1, '2018-07-05 08:08:52'),
(130, 15, 'Backup', 'backup', 1, 1, 0, 1, '2018-07-09 04:17:17'),
(131, 15, 'Restore', 'restore', 1, 0, 0, 0, '2018-07-09 04:17:17'),
(134, 1, 'Disable Reason', 'disable_reason', 1, 1, 1, 1, '2019-11-27 06:39:21'),
(135, 2, 'Fees Reminder', 'fees_reminder', 1, 0, 1, 0, '2019-10-25 00:39:49'),
(136, 5, 'Approve Leave', 'approve_leave', 1, 0, 0, 0, '2019-10-25 00:46:44'),
(137, 6, 'Exam Group', 'exam_group', 1, 1, 1, 1, '2019-10-25 01:02:34'),
(141, 6, 'Design Admit Card', 'design_admit_card', 1, 1, 1, 1, '2019-10-25 01:06:59'),
(142, 6, 'Print Admit Card', 'print_admit_card', 1, 0, 0, 0, '2019-11-23 23:57:51'),
(143, 6, 'Design Marksheet', 'design_marksheet', 1, 1, 1, 1, '2019-10-25 01:10:25'),
(144, 6, 'Print Marksheet', 'print_marksheet', 1, 0, 0, 0, '2019-10-25 01:11:02'),
(145, 7, 'Teachers Timetable', 'teachers_time_table', 1, 0, 0, 0, '2019-11-30 02:52:21'),
(146, 14, 'Student Report', 'student_report', 1, 0, 0, 0, '2019-10-25 01:27:00'),
(147, 14, 'Guardian Report', 'guardian_report', 1, 0, 0, 0, '2019-10-25 01:30:27'),
(148, 14, 'Student History', 'student_history', 1, 0, 0, 0, '2019-10-25 01:39:07'),
(149, 14, 'Student Login Credential Report', 'student_login_credential_report', 1, 0, 0, 0, '2019-10-25 01:39:07'),
(150, 14, 'Class Subject Report', 'class_subject_report', 1, 0, 0, 0, '2019-10-25 01:39:07'),
(151, 14, 'Admission Report', 'admission_report', 1, 0, 0, 0, '2019-10-25 01:39:07'),
(152, 14, 'Sibling Report', 'sibling_report', 1, 0, 0, 0, '2019-10-25 01:39:07'),
(153, 14, 'Homework Evaluation Report', 'homehork_evaluation_report', 1, 0, 0, 0, '2019-11-24 01:04:24'),
(154, 14, 'Student Profile', 'student_profile', 1, 0, 0, 0, '2019-10-25 01:39:07'),
(155, 14, 'Fees Statement', 'fees_statement', 1, 0, 0, 0, '2019-10-25 01:55:52'),
(156, 14, 'Balance Fees Report', 'balance_fees_report', 1, 0, 0, 0, '2019-10-25 01:55:52'),
(157, 14, 'Fees Collection Report', 'fees_collection_report', 1, 0, 0, 0, '2019-10-25 01:55:52'),
(158, 14, 'Online Fees Collection Report', 'online_fees_collection_report', 1, 0, 0, 0, '2019-10-25 01:55:52'),
(159, 14, 'Income Report', 'income_report', 1, 0, 0, 0, '2019-10-25 01:55:52'),
(160, 14, 'Expense Report', 'expense_report', 1, 0, 0, 0, '2019-10-25 01:55:52'),
(161, 14, 'PayRoll Report', 'payroll_report', 1, 0, 0, 0, '2019-10-31 00:23:22'),
(162, 14, 'Income Group Report', 'income_group_report', 1, 0, 0, 0, '2019-10-25 01:55:52'),
(163, 14, 'Expense Group Report', 'expense_group_report', 1, 0, 0, 0, '2019-10-25 01:55:52'),
(164, 14, 'Attendance Report', 'attendance_report', 1, 0, 0, 0, '2019-10-25 02:08:06'),
(165, 14, 'Staff Attendance Report', 'staff_attendance_report', 1, 0, 0, 0, '2019-10-25 02:08:06'),
(174, 14, 'Transport Report', 'transport_report', 1, 0, 0, 0, '2019-10-25 02:13:56'),
(175, 14, 'Hostel Report', 'hostel_report', 1, 0, 0, 0, '2019-11-27 06:51:53'),
(176, 14, 'Audit Trail Report', 'audit_trail_report', 1, 0, 0, 0, '2019-10-25 02:16:39'),
(177, 14, 'User Log', 'user_log', 1, 0, 0, 0, '2019-10-25 02:19:27'),
(178, 14, 'Book Issue Report', 'book_issue_report', 1, 0, 0, 0, '2019-10-25 02:29:04'),
(179, 14, 'Book Due Report', 'book_due_report', 1, 0, 0, 0, '2019-10-25 02:29:04'),
(180, 14, 'Book Inventory Report', 'book_inventory_report', 1, 0, 0, 0, '2019-10-25 02:29:04'),
(181, 14, 'Stock Report', 'stock_report', 1, 0, 0, 0, '2019-10-25 02:31:28'),
(182, 14, 'Add Item Report', 'add_item_report', 1, 0, 0, 0, '2019-10-25 02:31:28'),
(183, 14, 'Issue Item Report', 'issue_item_report', 1, 0, 0, 0, '2019-11-29 03:48:06'),
(185, 23, 'Online Examination', 'online_examination', 1, 1, 1, 1, '2019-11-23 23:54:50'),
(186, 23, 'Question Bank', 'question_bank', 1, 1, 1, 1, '2019-11-23 23:55:18'),
(187, 6, 'Exam Result', 'exam_result', 1, 0, 0, 0, '2019-11-23 23:58:50'),
(188, 7, 'Subject Group', 'subject_group', 1, 1, 1, 1, '2019-11-24 00:34:32'),
(189, 18, 'Teachers Rating', 'teachers_rating', 1, 0, 1, 1, '2019-11-24 03:12:54'),
(190, 22, 'Fees Awaiting Payment Widegts', 'fees_awaiting_payment_widegts', 1, 0, 0, 0, '2019-11-24 00:52:51'),
(191, 22, 'Conveted Leads Widegts', 'conveted_leads_widegts', 1, 0, 0, 0, '2019-11-24 00:58:24'),
(192, 22, 'Fees Overview Widegts', 'fees_overview_widegts', 1, 0, 0, 0, '2019-11-24 00:57:41'),
(193, 22, 'Enquiry Overview Widegts', 'enquiry_overview_widegts', 1, 0, 0, 0, '2019-12-02 05:06:09'),
(194, 22, 'Library Overview Widegts', 'book_overview_widegts', 1, 0, 0, 0, '2019-12-01 01:13:04'),
(195, 22, 'Student Today Attendance Widegts', 'today_attendance_widegts', 1, 0, 0, 0, '2019-12-03 04:57:45'),
(196, 6, 'Marks Import', 'marks_import', 1, 0, 0, 0, '2019-11-24 01:02:11'),
(197, 14, 'Student Attendance Type Report', 'student_attendance_type_report', 1, 0, 0, 0, '2019-11-24 01:06:32'),
(198, 14, 'Exam Marks Report', 'exam_marks_report', 1, 0, 0, 0, '2019-11-24 01:11:15'),
(200, 14, 'Online Exam Wise Report', 'online_exam_wise_report', 1, 0, 0, 0, '2019-11-24 01:18:14'),
(201, 14, 'Online Exams Report', 'online_exams_report', 1, 0, 0, 0, '2019-11-29 02:48:05'),
(202, 14, 'Online Exams Attempt Report', 'online_exams_attempt_report', 1, 0, 0, 0, '2019-11-29 02:46:24'),
(203, 14, 'Online Exams Rank Report', 'online_exams_rank_report', 1, 0, 0, 0, '2019-11-24 01:22:25'),
(204, 14, 'Staff Report', 'staff_report', 1, 0, 0, 0, '2019-11-24 01:25:27'),
(205, 6, 'Exam', 'exam', 1, 1, 1, 1, '2019-11-24 04:55:48'),
(207, 6, 'Exam Publish', 'exam_publish', 1, 0, 0, 0, '2019-11-24 05:15:04'),
(208, 6, 'Link Exam', 'link_exam', 1, 0, 1, 0, '2019-11-24 05:15:04'),
(210, 6, 'Assign / View student', 'exam_assign_view_student', 1, 0, 1, 0, '2019-11-24 05:15:04'),
(211, 6, 'Exam Subject', 'exam_subject', 1, 0, 1, 0, '2019-11-24 05:15:04'),
(212, 6, 'Exam Marks', 'exam_marks', 1, 0, 1, 0, '2019-11-24 05:15:04'),
(213, 15, 'Language Switcher', 'language_switcher', 1, 0, 0, 0, '2019-11-24 05:17:11'),
(214, 23, 'Add Questions in Exam ', 'add_questions_in_exam', 1, 0, 1, 0, '2019-11-28 01:38:57'),
(215, 15, 'Custom Fields', 'custom_fields', 1, 0, 0, 0, '2019-11-29 04:08:35'),
(216, 15, 'System Fields', 'system_fields', 1, 0, 0, 0, '2019-11-25 00:15:01'),
(217, 13, 'SMS', 'sms', 1, 0, 0, 0, '2018-06-22 10:40:54'),
(219, 14, 'Student / Period Attendance Report', 'student_period_attendance_report', 1, 0, 0, 0, '2019-11-29 02:19:31'),
(220, 14, 'Biometric Attendance Log', 'biometric_attendance_log', 1, 0, 0, 0, '2019-11-27 05:59:16'),
(221, 14, 'Book Issue Return Report', 'book_issue_return_report', 1, 0, 0, 0, '2019-11-27 06:30:23'),
(222, 23, 'Assign / View Student', 'online_assign_view_student', 1, 0, 1, 0, '2019-11-28 04:20:22'),
(223, 14, 'Rank Report', 'rank_report', 1, 0, 0, 0, '2019-11-29 02:30:21'),
(224, 25, 'Chat', 'chat', 1, 0, 0, 0, '2019-11-29 04:10:28'),
(226, 22, 'Income Donut Graph', 'income_donut_graph', 1, 0, 0, 0, '2019-11-29 05:00:33'),
(227, 22, 'Expense Donut Graph', 'expense_donut_graph', 1, 0, 0, 0, '2019-11-29 05:01:10'),
(228, 9, 'Import Book', 'import_book', 1, 0, 0, 0, '2019-11-29 06:21:01'),
(229, 22, 'Staff Present Today Widegts', 'staff_present_today_widegts', 1, 0, 0, 0, '2019-11-29 06:48:00'),
(230, 22, 'Student Present Today Widegts', 'student_present_today_widegts', 1, 0, 0, 0, '2019-11-29 06:47:42'),
(231, 26, 'Multi Class Student', 'multi_class_student', 1, 1, 1, 1, '2020-10-05 08:56:27'),
(232, 27, 'Online Admission', 'online_admission', 1, 0, 1, 1, '2019-12-02 06:11:10'),
(233, 15, 'Print Header Footer', 'print_header_footer', 1, 0, 0, 0, '2020-02-12 02:02:02'),
(234, 28, 'Manage Alumni', 'manage_alumni', 1, 1, 1, 1, '2020-06-02 03:15:46'),
(235, 28, 'Events', 'events', 1, 1, 1, 1, '2020-05-28 21:48:52'),
(236, 29, 'Manage Lesson Plan', 'manage_lesson_plan', 1, 1, 1, 0, '2020-05-28 22:17:37'),
(237, 29, 'Manage Syllabus Status', 'manage_syllabus_status', 1, 0, 1, 0, '2020-05-28 22:20:11'),
(238, 29, 'Lesson', 'lesson', 1, 1, 1, 1, '2020-05-28 22:20:11'),
(239, 29, 'Topic', 'topic', 1, 1, 1, 1, '2020-05-28 22:20:11'),
(240, 14, 'Syllabus Status Report', 'syllabus_status_report', 1, 0, 0, 0, '2020-05-28 23:17:54'),
(241, 14, 'Teacher Syllabus Status Report', 'teacher_syllabus_status_report', 1, 0, 0, 0, '2020-05-28 23:17:54'),
(242, 14, 'Alumni Report', 'alumni_report', 1, 0, 0, 0, '2020-06-07 23:59:54'),
(243, 15, 'Student Profile Update', 'student_profile_update', 1, 0, 0, 0, '2020-08-21 05:36:33'),
(244, 14, 'Student Gender Ratio Report', 'student_gender_ratio_report', 1, 0, 0, 0, '2020-08-22 12:37:51'),
(245, 14, 'Student Teacher Ratio Report', 'student_teacher_ratio_report', 1, 0, 0, 0, '2020-08-22 12:42:27'),
(246, 14, 'Daily Attendance Report', 'daily_attendance_report', 1, 0, 0, 0, '2020-08-22 12:43:16'),
(247, 23, 'Import Question', 'import_question', 1, 0, 0, 0, '2019-11-23 18:25:18');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `permission_group`
--

INSERT INTO `permission_group` (`id`, `name`, `short_code`, `is_active`, `system`, `created_at`) VALUES
(1, 'Student Information', 'student_information', 1, 1, '2019-03-15 09:30:22'),
(2, 'Fees Collection', 'fees_collection', 1, 0, '2025-11-09 10:10:51'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `permission_student`
--

INSERT INTO `permission_student` (`id`, `name`, `short_code`, `system`, `student`, `parent`, `group_id`, `created_at`) VALUES
(1, 'Fees', 'fees', 0, 0, 1, 2, '2025-11-09 10:14:43'),
(2, 'Class Timetable', 'class_timetable', 1, 1, 1, 7, '2020-05-30 19:57:50'),
(3, 'Homework', 'homework', 0, 1, 1, 19, '2025-11-16 06:28:36'),
(4, 'Download Center', 'download_center', 0, 1, 1, 8, '2025-11-16 06:28:19'),
(5, 'Attendance', 'attendance', 0, 1, 1, 5, '2025-11-16 06:28:15'),
(7, 'Examinations', 'examinations', 0, 1, 1, 6, '2025-11-16 06:28:17'),
(8, 'Notice Board', 'notice_board', 0, 1, 1, 13, '2025-11-16 06:28:31'),
(11, 'Library', 'library', 0, 1, 1, 9, '2025-11-16 06:28:24'),
(12, 'Transport Routes', 'transport_routes', 0, 1, 1, 11, '2025-11-16 06:28:28'),
(13, 'Hostel Rooms', 'hostel_rooms', 0, 1, 1, 12, '2025-11-16 06:28:30'),
(14, 'Calendar To Do List', 'calendar_to_do_list', 0, 1, 1, 21, '2025-11-16 06:28:39'),
(15, 'Online Examination', 'online_examination', 0, 1, 1, 23, '2025-11-16 06:28:41'),
(16, 'Teachers Rating', 'teachers_rating', 0, 0, 1, 0, '2025-11-09 10:14:51'),
(17, 'Chat', 'chat', 0, 1, 1, 25, '2025-11-16 06:28:42'),
(18, 'Multi Class', 'multi_class', 1, 1, 1, 26, '2025-11-16 06:28:46'),
(19, 'Lesson Plan', 'lesson_plan', 0, 1, 1, 29, '2025-11-16 06:28:52'),
(20, 'Syllabus Status', 'syllabus_status', 0, 1, 1, 29, '2025-11-16 06:28:52'),
(23, 'Apply Leave', 'apply_leave', 0, 0, 1, 0, '2025-11-09 10:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `print_headerfooter`
--

CREATE TABLE `print_headerfooter` (
  `id` int(11) NOT NULL,
  `print_type` varchar(255) NOT NULL,
  `header_image` varchar(255) NOT NULL,
  `footer_content` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `print_headerfooter`
--

INSERT INTO `print_headerfooter` (`id`, `print_type`, `header_image`, `footer_content`, `created_by`, `entry_date`) VALUES
(1, 'staff_payslip', 'header_image.jpg', 'This payslip is computer generated hence no signature is required.', 1, '2020-02-28 15:41:08'),
(2, 'student_receipt', 'header_image.jpg', 'This receipt is computer generated hence no signature is required.', 1, '2020-02-28 15:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `question_type` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `opt_a` text DEFAULT NULL,
  `opt_b` text DEFAULT NULL,
  `opt_c` text DEFAULT NULL,
  `opt_d` text DEFAULT NULL,
  `opt_e` text DEFAULT NULL,
  `correct` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE `question_answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `read_notification`
--

CREATE TABLE `read_notification` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `notification_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `months` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `fee_head` varchar(100) DEFAULT NULL,
  `fee_head_type` varchar(100) DEFAULT NULL,
  `fee_head_name` varchar(255) DEFAULT NULL,
  `balance_amount` varchar(100) DEFAULT NULL,
  `total` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`total`)),
  `rec_discount` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`rec_discount`)),
  `rec_amount` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`rec_amount`)),
  `fees_received` varchar(100) DEFAULT NULL,
  `late_fees` varchar(100) DEFAULT NULL,
  `ledger_amt` varchar(100) DEFAULT NULL,
  `total_fees` varchar(100) DEFAULT NULL,
  `discount_amt` varchar(100) DEFAULT NULL,
  `net_fees` varchar(100) DEFAULT NULL,
  `receipt_amt` varchar(100) DEFAULT NULL,
  `balance_amt` varchar(100) DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `date_time` varchar(100) DEFAULT NULL,
  `back_id` varchar(100) DEFAULT NULL,
  `sr_no` bigint(20) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `total_month` int(11) DEFAULT NULL,
  `month_total` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `receipt_no`, `student_id`, `months`, `fee_head`, `fee_head_type`, `fee_head_name`, `balance_amount`, `total`, `rec_discount`, `rec_amount`, `fees_received`, `late_fees`, `ledger_amt`, `total_fees`, `discount_amt`, `net_fees`, `receipt_amt`, `balance_amt`, `mode`, `remarks`, `created_at`, `date_time`, `back_id`, `sr_no`, `create_by`, `total_month`, `month_total`) VALUES
(42, '2025-2026/1', 583, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '3600', '', '0.00', '3600', '0', '3600', '3000', '600.00', 'Cash', '', '2025-11-08 07:43:52', '2025-03-21', '616', 1, 'demo@easyskool.in', 1, '500.00'),
(43, '2025-2026/1', 583, 'Apr', '50', 'fees', 'Annual Fee', '600', '1000', '0', '400', '3600', '', '0.00', '3600', '0', '3600', '3000', '600.00', 'Cash', '', '2025-11-08 07:43:52', '2025-03-21', '616', 1, 'demo@easyskool.in', 1, '1000.00'),
(44, '2025-2026/1', 583, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3600', '', '0.00', '3600', '0', '3600', '3000', '600.00', 'Cash', '', '2025-11-08 07:43:52', '2025-03-21', '616', 1, 'demo@easyskool.in', 1, '1000.00'),
(45, '2025-2026/1', 583, 'Apr', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '3600', '', '0.00', '3600', '0', '3600', '3000', '600.00', 'Cash', '', '2025-11-08 07:43:52', '2025-03-21', '616', 1, 'demo@easyskool.in', 1, '1100.00'),
(46, '2025-2026/2', 582, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '3600', '', '0.00', '3600', '0', '3600', '3600', '0', 'Cash', '', '2025-11-08 07:45:09', '2025-03-24', '615', 2, 'demo@easyskool.in', 1, '500.00'),
(47, '2025-2026/2', 582, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3600', '', '0.00', '3600', '0', '3600', '3600', '0', 'Cash', '', '2025-11-08 07:45:09', '2025-03-24', '615', 2, 'demo@easyskool.in', 1, '1000.00'),
(48, '2025-2026/2', 582, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3600', '', '0.00', '3600', '0', '3600', '3600', '0', 'Cash', '', '2025-11-08 07:45:09', '2025-03-24', '615', 2, 'demo@easyskool.in', 1, '1000.00'),
(49, '2025-2026/2', 582, 'Apr', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '3600', '', '0.00', '3600', '0', '3600', '3600', '0', 'Cash', '', '2025-11-08 07:45:09', '2025-03-24', '615', 2, 'demo@easyskool.in', 1, '1100.00'),
(50, '2025-2026/3', 581, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '3600', '', '0.00', '3600', '500', '3100', '3100', '0.00', 'Cash', '', '2025-11-08 07:46:34', '2025-03-26', '614', 3, 'demo@easyskool.in', 1, '500.00'),
(51, '2025-2026/3', 581, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3600', '', '0.00', '3600', '500', '3100', '3100', '0.00', 'Cash', '', '2025-11-08 07:46:34', '2025-03-26', '614', 3, 'demo@easyskool.in', 1, '1000.00'),
(52, '2025-2026/3', 581, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3600', '', '0.00', '3600', '500', '3100', '3100', '0.00', 'Cash', '', '2025-11-08 07:46:34', '2025-03-26', '614', 3, 'demo@easyskool.in', 1, '1000.00'),
(53, '2025-2026/3', 581, 'Apr', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '3600', '', '0.00', '3600', '500', '3100', '3100', '0.00', 'Cash', '', '2025-11-08 07:46:34', '2025-03-26', '614', 3, 'demo@easyskool.in', 1, '1100.00'),
(54, '2025-2026/4', 601, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 07:49:42', '2025-04-02', '634', 4, 'demo@easyskool.in', 1, '1000.00'),
(55, '2025-2026/4', 601, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 07:49:42', '2025-04-02', '634', 4, 'demo@easyskool.in', 1, '1000.00'),
(56, '2025-2026/4', 601, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 07:49:42', '2025-04-02', '634', 4, 'demo@easyskool.in', 1, '1200.00'),
(57, '2025-2026/5', 629, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '7000', '', '0.00', '7000', '1300', '5700', '5700', '0.00', 'Cash', '', '2025-11-08 07:51:47', '2025-04-02', '662', 5, 'demo@easyskool.in', 1, '500.00'),
(58, '2025-2026/5', 629, 'Apr', '53', 'fees', 'Annual Fee', '0', '2500', '0', '2500', '7000', '', '0.00', '7000', '1300', '5700', '5700', '0.00', 'Cash', '', '2025-11-08 07:51:47', '2025-04-02', '662', 5, 'demo@easyskool.in', 1, '2500.00'),
(59, '2025-2026/5', 629, 'Apr', '58', 'fees', 'Composite Fee', '0', '2300', '800', '1500', '7000', '', '0.00', '7000', '1300', '5700', '5700', '0.00', 'Cash', '', '2025-11-08 07:51:47', '2025-04-02', '662', 5, 'demo@easyskool.in', 1, '2300.00'),
(60, '2025-2026/5', 629, 'Apr', '67', 'fees', 'Monthly Fee', '0', '1700', '500', '1200', '7000', '', '0.00', '7000', '1300', '5700', '5700', '0.00', 'Cash', '', '2025-11-08 07:51:47', '2025-04-02', '662', 5, 'demo@easyskool.in', 1, '1700.00'),
(61, '2025-2026/6', 626, 'Apr', '52', 'fees', 'Annual Fee', '2000', '2000', '0', '0', '5800', '', '0.00', '5800', '0', '5800', '1600', '4200.00', 'Cash', '', '2025-11-08 07:52:58', '2025-04-02', '659', 6, 'demo@easyskool.in', 1, '2000.00'),
(62, '2025-2026/6', 626, 'Apr', '57', 'fees', 'Composite Fee', '2200', '2200', '0', '0', '5800', '', '0.00', '5800', '0', '5800', '1600', '4200.00', 'Cash', '', '2025-11-08 07:52:58', '2025-04-02', '659', 6, 'demo@easyskool.in', 1, '2200.00'),
(63, '2025-2026/6', 626, 'Apr', '66', 'fees', 'Monthly Fee', '0', '1600', '0', '1600', '5800', '', '0.00', '5800', '0', '5800', '1600', '4200.00', 'Cash', '', '2025-11-08 07:52:58', '2025-04-02', '659', 6, 'demo@easyskool.in', 1, '1600.00'),
(64, '2025-2026/7', 613, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Online', '', '2025-11-08 07:53:31', '2025-04-03', '646', 7, 'demo@easyskool.in', 1, '1500.00'),
(65, '2025-2026/7', 613, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Online', '', '2025-11-08 07:53:31', '2025-04-03', '646', 7, 'demo@easyskool.in', 1, '1500.00'),
(66, '2025-2026/7', 613, 'Apr', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Online', '', '2025-11-08 07:53:31', '2025-04-03', '646', 7, 'demo@easyskool.in', 1, '1300.00'),
(67, '2025-2026/8', 595, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 07:54:58', '2025-04-03', '628', 8, 'demo@easyskool.in', 1, '1000.00'),
(68, '2025-2026/8', 595, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 07:54:58', '2025-04-03', '628', 8, 'demo@easyskool.in', 1, '1000.00'),
(69, '2025-2026/8', 595, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 07:54:58', '2025-04-03', '628', 8, 'demo@easyskool.in', 1, '1200.00'),
(70, '2025-2026/9', 614, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Cash', '', '2025-11-08 07:56:30', '2025-04-04', '647', 9, 'demo@easyskool.in', 1, '1500.00'),
(71, '2025-2026/9', 614, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Cash', '', '2025-11-08 07:56:30', '2025-04-04', '647', 9, 'demo@easyskool.in', 1, '1500.00'),
(72, '2025-2026/9', 614, 'Apr', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Cash', '', '2025-11-08 07:56:30', '2025-04-04', '647', 9, 'demo@easyskool.in', 1, '1300.00'),
(73, '2025-2026/10', 609, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 07:57:28', '2025-04-04', '642', 10, 'demo@easyskool.in', 1, '1000.00'),
(74, '2025-2026/10', 609, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 07:57:28', '2025-04-04', '642', 10, 'demo@easyskool.in', 1, '1000.00'),
(75, '2025-2026/10', 609, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 07:57:28', '2025-04-04', '642', 10, 'demo@easyskool.in', 1, '1200.00'),
(76, '2025-2026/11', 603, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 08:00:16', '2025-04-07', '636', 11, 'demo@easyskool.in', 1, '1000.00'),
(77, '2025-2026/11', 603, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 08:00:16', '2025-04-07', '636', 11, 'demo@easyskool.in', 1, '1000.00'),
(78, '2025-2026/11', 603, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 08:00:17', '2025-04-07', '636', 11, 'demo@easyskool.in', 1, '1200.00'),
(79, '2025-2026/12', 599, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:01:47', '2025-04-07', '632', 12, 'demo@easyskool.in', 1, '1000.00'),
(80, '2025-2026/12', 599, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:01:47', '2025-04-07', '632', 12, 'demo@easyskool.in', 1, '1000.00'),
(81, '2025-2026/12', 599, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:01:47', '2025-04-07', '632', 12, 'demo@easyskool.in', 1, '1200.00'),
(82, '2025-2026/13', 608, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '3700', '', '0.00', '3700', '100', '3600', '3600', '0.00', 'Online', '', '2025-11-08 08:06:07', '2025-04-07', '641', 13, 'demo@easyskool.in', 1, '500.00'),
(83, '2025-2026/13', 608, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3700', '', '0.00', '3700', '100', '3600', '3600', '0.00', 'Online', '', '2025-11-08 08:06:07', '2025-04-07', '641', 13, 'demo@easyskool.in', 1, '1000.00'),
(84, '2025-2026/13', 608, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3700', '', '0.00', '3700', '100', '3600', '3600', '0.00', 'Online', '', '2025-11-08 08:06:07', '2025-04-07', '641', 13, 'demo@easyskool.in', 1, '1000.00'),
(85, '2025-2026/13', 608, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '100', '1100', '3700', '', '0.00', '3700', '100', '3600', '3600', '0.00', 'Online', '', '2025-11-08 08:06:07', '2025-04-07', '641', 13, 'demo@easyskool.in', 1, '1200.00'),
(86, '2025-2026/14', 580, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '3600', '', '0.00', '3600', '600', '3000', '3000', '0.00', 'Online', '', '2025-11-08 08:07:41', '2025-04-07', '613', 14, 'demo@easyskool.in', 1, '500.00'),
(87, '2025-2026/14', 580, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3600', '', '0.00', '3600', '600', '3000', '3000', '0.00', 'Online', '', '2025-11-08 08:07:41', '2025-04-07', '613', 14, 'demo@easyskool.in', 1, '1000.00'),
(88, '2025-2026/14', 580, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '600', '400', '3600', '', '0.00', '3600', '600', '3000', '3000', '0.00', 'Online', '', '2025-11-08 08:07:41', '2025-04-07', '613', 14, 'demo@easyskool.in', 1, '1000.00'),
(89, '2025-2026/14', 580, 'Apr', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '3600', '', '0.00', '3600', '600', '3000', '3000', '0.00', 'Online', '', '2025-11-08 08:07:41', '2025-04-07', '613', 14, 'demo@easyskool.in', 1, '1100.00'),
(90, '2025-2026/15', 605, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:09:15', '2025-04-07', '638', 15, 'demo@easyskool.in', 1, '1000.00'),
(91, '2025-2026/15', 605, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:09:15', '2025-04-07', '638', 15, 'demo@easyskool.in', 1, '1000.00'),
(92, '2025-2026/15', 605, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:09:15', '2025-04-07', '638', 15, 'demo@easyskool.in', 1, '1200.00'),
(93, '2025-2026/16', 596, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:10:19', '2025-04-09', '629', 16, 'demo@easyskool.in', 1, '1000.00'),
(94, '2025-2026/16', 596, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:10:19', '2025-04-09', '629', 16, 'demo@easyskool.in', 1, '1000.00'),
(95, '2025-2026/16', 596, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:10:19', '2025-04-09', '629', 16, 'demo@easyskool.in', 1, '1200.00'),
(96, '2025-2026/17', 592, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 08:11:03', '2025-04-10', '625', 17, 'demo@easyskool.in', 1, '1000.00'),
(97, '2025-2026/17', 592, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 08:11:03', '2025-04-10', '625', 17, 'demo@easyskool.in', 1, '1000.00'),
(98, '2025-2026/17', 592, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 08:11:03', '2025-04-10', '625', 17, 'demo@easyskool.in', 1, '1200.00'),
(99, '2025-2026/18', 606, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '3700', '500', '0.00', '4200', '0', '4200', '4200', '0', 'Online', '', '2025-11-08 08:17:33', '2025-04-10', '639', 18, 'demo@easyskool.in', 1, '500.00'),
(100, '2025-2026/18', 606, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3700', '', '0.00', '3700', '0', '3700', '3700', '0', 'Online', '', '2025-11-08 08:17:33', '2025-04-10', '639', 18, 'demo@easyskool.in', 1, '1000.00'),
(101, '2025-2026/18', 606, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3700', '', '0.00', '3700', '0', '3700', '3700', '0', 'Online', '', '2025-11-08 08:17:33', '2025-04-10', '639', 18, 'demo@easyskool.in', 1, '1000.00'),
(102, '2025-2026/18', 606, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3700', '', '0.00', '3700', '0', '3700', '3700', '0', 'Online', '', '2025-11-08 08:17:33', '2025-04-10', '639', 18, 'demo@easyskool.in', 1, '1200.00'),
(103, '2025-2026/19', 617, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Cash', '', '2025-11-08 08:18:28', '2025-04-11', '650', 19, 'demo@easyskool.in', 1, '1500.00'),
(104, '2025-2026/19', 617, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Cash', '', '2025-11-08 08:18:28', '2025-04-11', '650', 19, 'demo@easyskool.in', 1, '1500.00'),
(105, '2025-2026/19', 617, 'Apr', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Cash', '', '2025-11-08 08:18:28', '2025-04-11', '650', 19, 'demo@easyskool.in', 1, '1300.00'),
(106, '2025-2026/20', 612, 'Apr', '51', 'fees', 'Annual Fee', '700', '1500', '800', '0', '4300', '', '0.00', '4300', '800', '3500', '1300', '2200.00', 'Online', '', '2025-11-08 08:27:06', '2025-04-11', '645', 20, 'demo@easyskool.in', 1, '1500.00'),
(107, '2025-2026/20', 612, 'Apr', '55', 'fees', 'Composite Fee', '1500', '1500', '0', '0', '4300', '', '0.00', '4300', '800', '3500', '1300', '2200.00', 'Online', '', '2025-11-08 08:27:06', '2025-04-11', '645', 20, 'demo@easyskool.in', 1, '1500.00'),
(108, '2025-2026/20', 612, 'Apr', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '4300', '', '0.00', '4300', '800', '3500', '1300', '2200.00', 'Online', '', '2025-11-08 08:27:06', '2025-04-11', '645', 20, 'demo@easyskool.in', 1, '1300.00'),
(109, '2025-2026/21', 597, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '200', '800', '3200', '', '0.00', '3200', '200', '3000', '3000', '0.00', 'Cash', '', '2025-11-08 08:29:27', '2025-04-11', '630', 21, 'demo@easyskool.in', 1, '1000.00'),
(110, '2025-2026/21', 597, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '200', '3000', '3000', '0.00', 'Cash', '', '2025-11-08 08:29:27', '2025-04-11', '630', 21, 'demo@easyskool.in', 1, '1000.00'),
(111, '2025-2026/21', 597, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '200', '3000', '3000', '0.00', 'Cash', '', '2025-11-08 08:29:27', '2025-04-11', '630', 21, 'demo@easyskool.in', 1, '1200.00'),
(112, '2025-2026/22', 600, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '200', '800', '3200', '', '0.00', '3200', '200', '3000', '3000', '0.00', 'Online', '', '2025-11-08 08:31:11', '2025-04-11', '633', 22, 'demo@easyskool.in', 1, '1000.00'),
(113, '2025-2026/22', 600, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '200', '3000', '3000', '0.00', 'Online', '', '2025-11-08 08:31:11', '2025-04-11', '633', 22, 'demo@easyskool.in', 1, '1000.00'),
(114, '2025-2026/22', 600, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '200', '3000', '3000', '0.00', 'Online', '', '2025-11-08 08:31:11', '2025-04-11', '633', 22, 'demo@easyskool.in', 1, '1200.00'),
(115, '2025-2026/23', 586, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Cash', '', '2025-11-08 08:41:54', '2025-04-11', '619', 23, 'demo@easyskool.in', 1, '500.00'),
(116, '2025-2026/23', 586, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Cash', '', '2025-11-08 08:41:54', '2025-04-11', '619', 23, 'demo@easyskool.in', 1, '1000.00'),
(117, '2025-2026/23', 586, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '1000', '0', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Cash', '', '2025-11-08 08:41:54', '2025-04-11', '619', 23, 'demo@easyskool.in', 1, '1000.00'),
(118, '2025-2026/23', 586, 'Apr', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Cash', '', '2025-11-08 08:41:54', '2025-04-11', '619', 23, 'demo@easyskool.in', 1, '1100.00'),
(123, '2025-2026/25', 622, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '100', '1400', '4400', '', '0.00', '4400', '100', '4300', '4300', '0.00', 'Online', '', '2025-11-08 08:47:40', '2025-04-11', '655', 25, 'demo@easyskool.in', 1, '1500.00'),
(124, '2025-2026/25', 622, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '4400', '', '0.00', '4400', '100', '4300', '4300', '0.00', 'Online', '', '2025-11-08 08:47:40', '2025-04-11', '655', 25, 'demo@easyskool.in', 1, '1500.00'),
(125, '2025-2026/25', 622, 'Apr', '64', 'fees', 'Monthly Fee', '0', '1400', '0', '1400', '4400', '', '0.00', '4400', '100', '4300', '4300', '0.00', 'Online', '', '2025-11-08 08:47:40', '2025-04-11', '655', 25, 'demo@easyskool.in', 1, '1400.00'),
(129, '2025-2026/27', 602, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:53:32', '2025-04-12', '635', 27, 'demo@easyskool.in', 1, '1000.00'),
(130, '2025-2026/27', 602, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:53:32', '2025-04-12', '635', 27, 'demo@easyskool.in', 1, '1000.00'),
(131, '2025-2026/27', 602, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-08 08:53:32', '2025-04-12', '635', 27, 'demo@easyskool.in', 1, '1200.00'),
(132, '2025-2026/28', 598, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 08:56:51', '2025-04-12', '631', 28, 'demo@easyskool.in', 1, '1000.00'),
(133, '2025-2026/28', 598, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 08:56:51', '2025-04-12', '631', 28, 'demo@easyskool.in', 1, '1000.00'),
(134, '2025-2026/28', 598, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 08:56:51', '2025-04-12', '631', 28, 'demo@easyskool.in', 1, '1200.00'),
(135, '2025-2026/29', 587, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '3600', '', '0.00', '3600', '300', '3300', '3300', '0.00', 'Online', '', '2025-11-08 09:19:10', '2025-04-15', '620', 29, 'demo@easyskool.in', 1, '500.00'),
(136, '2025-2026/29', 587, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '300', '700', '3600', '', '0.00', '3600', '300', '3300', '3300', '0.00', 'Online', '', '2025-11-08 09:19:10', '2025-04-15', '620', 29, 'demo@easyskool.in', 1, '1000.00'),
(137, '2025-2026/29', 587, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3600', '', '0.00', '3600', '300', '3300', '3300', '0.00', 'Online', '', '2025-11-08 09:19:10', '2025-04-15', '620', 29, 'demo@easyskool.in', 1, '1000.00'),
(138, '2025-2026/29', 587, 'Apr', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '3600', '', '0.00', '3600', '300', '3300', '3300', '0.00', 'Online', '', '2025-11-08 09:19:10', '2025-04-15', '620', 29, 'demo@easyskool.in', 1, '1100.00'),
(139, '2025-2026/30', 620, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '3000', '1300.00', 'Online', '', '2025-11-08 09:22:32', '2025-04-15', '653', 30, 'demo@easyskool.in', 1, '1500.00'),
(140, '2025-2026/30', 620, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '3000', '1300.00', 'Online', '', '2025-11-08 09:22:32', '2025-04-15', '653', 30, 'demo@easyskool.in', 1, '1500.00'),
(141, '2025-2026/30', 620, 'Apr', '63', 'fees', 'Monthly Fee', '1300', '1300', '0', '0', '4300', '', '0.00', '4300', '0', '4300', '3000', '1300.00', 'Online', '', '2025-11-08 09:22:32', '2025-04-15', '653', 30, 'demo@easyskool.in', 1, '1300.00'),
(142, '2025-2026/31', 624, 'Apr', '52', 'fees', 'Annual Fee', '0', '2000', '2000', '0', '5500', '', '0.00', '5500', '4300', '1200', '1200', '0.00', 'Cash', '', '2025-11-08 09:24:45', '2025-04-16', '657', 31, 'demo@easyskool.in', 1, '2000.00'),
(143, '2025-2026/31', 624, 'Apr', '56', 'fees', 'Composite Fee', '0', '2000', '2000', '0', '5500', '', '0.00', '5500', '4300', '1200', '1200', '0.00', 'Cash', '', '2025-11-08 09:24:45', '2025-04-16', '657', 31, 'demo@easyskool.in', 1, '2000.00'),
(144, '2025-2026/31', 624, 'Apr', '65', 'fees', 'Monthly Fee', '0', '1500', '300', '1200', '5500', '', '0.00', '5500', '4300', '1200', '1200', '0.00', 'Cash', '', '2025-11-08 09:24:45', '2025-04-16', '657', 31, 'demo@easyskool.in', 1, '1500.00'),
(145, '2025-2026/32', 618, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '1500', '0', '4300', '', '0.00', '4300', '3500', '800', '800', '0.00', 'Cash', '', '2025-11-08 09:26:28', '2025-04-16', '651', 32, 'demo@easyskool.in', 1, '1500.00'),
(146, '2025-2026/32', 618, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '1500', '0', '4300', '', '0.00', '4300', '3500', '800', '800', '0.00', 'Cash', '', '2025-11-08 09:26:28', '2025-04-16', '651', 32, 'demo@easyskool.in', 1, '1500.00'),
(147, '2025-2026/32', 618, 'Apr', '63', 'fees', 'Monthly Fee', '0', '1300', '500', '800', '4300', '', '0.00', '4300', '3500', '800', '800', '0.00', 'Cash', '', '2025-11-08 09:26:28', '2025-04-16', '651', 32, 'demo@easyskool.in', 1, '1300.00'),
(148, '2025-2026/33', 612, '', '', '', 'Ledger Amount', '2200', '2200', '0', '2200', '2200', '', '2200.00', '2200', '0', '2200', '2200', '0.00', 'Online', '', '2025-11-08 09:33:06', '2025-04-17', '645', 33, 'demo@easyskool.in', NULL, NULL),
(149, '2025-2026/34', 607, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '3700', '', '0.00', '3700', '2500', '1200', '1200', '0.00', 'Online', '', '2025-11-08 09:36:00', '2025-04-17', '640', 34, 'demo@easyskool.in', 1, '500.00'),
(150, '2025-2026/34', 607, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '3700', '', '0.00', '3700', '2500', '1200', '1200', '0.00', 'Online', '', '2025-11-08 09:36:00', '2025-04-17', '640', 34, 'demo@easyskool.in', 1, '1000.00'),
(151, '2025-2026/34', 607, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '1000', '0', '3700', '', '0.00', '3700', '2500', '1200', '1200', '0.00', 'Online', '', '2025-11-08 09:36:00', '2025-04-17', '640', 34, 'demo@easyskool.in', 1, '1000.00'),
(152, '2025-2026/34', 607, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3700', '', '0.00', '3700', '2500', '1200', '1200', '0.00', 'Online', '', '2025-11-08 09:36:00', '2025-04-17', '640', 34, 'demo@easyskool.in', 1, '1200.00'),
(153, '2025-2026/35', 584, 'Apr', '49', 'fees', 'Registration Fee', '500', '500', '0', '0', '3600', '', '0.00', '3600', '0', '3600', '1100', '2500.00', 'Online', '', '2025-11-08 09:38:28', '2025-04-18', '617', 35, 'demo@easyskool.in', 1, '500.00'),
(154, '2025-2026/35', 584, 'Apr', '50', 'fees', 'Annual Fee', '1000', '1000', '0', '0', '3600', '', '0.00', '3600', '0', '3600', '1100', '2500.00', 'Online', '', '2025-11-08 09:38:28', '2025-04-18', '617', 35, 'demo@easyskool.in', 1, '1000.00'),
(155, '2025-2026/35', 584, 'Apr', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '3600', '', '0.00', '3600', '0', '3600', '1100', '2500.00', 'Online', '', '2025-11-08 09:38:28', '2025-04-18', '617', 35, 'demo@easyskool.in', 1, '1000.00'),
(156, '2025-2026/35', 584, 'Apr', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '3600', '', '0.00', '3600', '0', '3600', '1100', '2500.00', 'Online', '', '2025-11-08 09:38:28', '2025-04-18', '617', 35, 'demo@easyskool.in', 1, '1100.00'),
(157, '2025-2026/36', 604, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 09:39:44', '2025-04-18', '637', 36, 'demo@easyskool.in', 1, '1000.00'),
(158, '2025-2026/36', 604, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 09:39:44', '2025-04-18', '637', 36, 'demo@easyskool.in', 1, '1000.00'),
(159, '2025-2026/36', 604, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-08 09:39:44', '2025-04-18', '637', 36, 'demo@easyskool.in', 1, '1200.00'),
(160, '2025-2026/37', 588, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Online', '', '2025-11-08 09:45:13', '2025-04-21', '621', 37, 'demo@easyskool.in', 1, '500.00'),
(161, '2025-2026/37', 588, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Online', '', '2025-11-08 09:45:13', '2025-04-21', '621', 37, 'demo@easyskool.in', 1, '1000.00'),
(162, '2025-2026/37', 588, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '1000', '0', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Online', '', '2025-11-08 09:45:13', '2025-04-21', '621', 37, 'demo@easyskool.in', 1, '1000.00'),
(163, '2025-2026/37', 588, 'Apr', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Online', '', '2025-11-08 09:45:13', '2025-04-21', '621', 37, 'demo@easyskool.in', 1, '1100.00'),
(165, '2025-2026/39', 594, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '200', '800', '3200', '', '0.00', '3200', '200', '3000', '3000', '0.00', 'Online', '', '2025-11-08 11:26:47', '2025-04-22', '627', 39, 'demo@easyskool.in', 1, '1000.00'),
(166, '2025-2026/39', 594, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3200', '', '0.00', '3200', '200', '3000', '3000', '0.00', 'Online', '', '2025-11-08 11:26:47', '2025-04-22', '627', 39, 'demo@easyskool.in', 1, '1000.00'),
(167, '2025-2026/39', 594, 'Apr', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '3200', '', '0.00', '3200', '200', '3000', '3000', '0.00', 'Online', '', '2025-11-08 11:26:47', '2025-04-22', '627', 39, 'demo@easyskool.in', 1, '1200.00'),
(168, '2025-2026/40', 610, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Online', '', '2025-11-08 11:27:20', '2025-04-24', '643', 40, 'demo@easyskool.in', 1, '1500.00'),
(169, '2025-2026/40', 610, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Online', '', '2025-11-08 11:27:20', '2025-04-24', '643', 40, 'demo@easyskool.in', 1, '1500.00'),
(170, '2025-2026/40', 610, 'Apr', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Online', '', '2025-11-08 11:27:20', '2025-04-24', '643', 40, 'demo@easyskool.in', 1, '1300.00'),
(171, '2025-2026/41', 627, 'Apr', '52', 'fees', 'Annual Fee', '0', '2000', '0', '2000', '5800', '', '0.00', '5800', '0', '5800', '5800', '0', 'Online', '', '2025-11-08 11:28:15', '2025-04-24', '660', 41, 'demo@easyskool.in', 1, '2000.00'),
(172, '2025-2026/41', 627, 'Apr', '57', 'fees', 'Composite Fee', '0', '2200', '0', '2200', '5800', '', '0.00', '5800', '0', '5800', '5800', '0', 'Online', '', '2025-11-08 11:28:15', '2025-04-24', '660', 41, 'demo@easyskool.in', 1, '2200.00'),
(173, '2025-2026/41', 627, 'Apr', '66', 'fees', 'Monthly Fee', '0', '1600', '0', '1600', '5800', '', '0.00', '5800', '0', '5800', '5800', '0', 'Online', '', '2025-11-08 11:28:15', '2025-04-24', '660', 41, 'demo@easyskool.in', 1, '1600.00'),
(174, '2025-2026/42', 625, 'Apr', '52', 'fees', 'Annual Fee', '0', '2000', '0', '2000', '7000', '', '0.00', '7000', '1500', '5500', '5500', '0.00', 'Online', '', '2025-11-08 11:29:24', '2025-04-24', '658', 42, 'demo@easyskool.in', 2, '2000.00'),
(175, '2025-2026/42', 625, 'May', '52', 'fees', 'Annual Fee', '0', '2000', '0', '2000', '7000', '', '0.00', '7000', '1500', '5500', '5500', '0.00', 'Online', '', '2025-11-08 11:29:24', '2025-04-24', '658', 42, 'demo@easyskool.in', 2, '0'),
(176, '2025-2026/42', 625, 'Apr', '56', 'fees', 'Composite Fee', '0', '2000', '0', '2000', '7000', '', '0.00', '7000', '1500', '5500', '5500', '0.00', 'Online', '', '2025-11-08 11:29:24', '2025-04-24', '658', 42, 'demo@easyskool.in', 2, '2000.00'),
(177, '2025-2026/42', 625, 'May', '56', 'fees', 'Composite Fee', '0', '2000', '0', '2000', '7000', '', '0.00', '7000', '1500', '5500', '5500', '0.00', 'Online', '', '2025-11-08 11:29:24', '2025-04-24', '658', 42, 'demo@easyskool.in', 2, '0'),
(178, '2025-2026/42', 625, 'Apr', '65', 'fees', 'Monthly Fee', '0', '3000', '1500', '1500', '7000', '', '0.00', '7000', '1500', '5500', '5500', '0.00', 'Online', '', '2025-11-08 11:29:24', '2025-04-24', '658', 42, 'demo@easyskool.in', 2, '1500.00'),
(179, '2025-2026/42', 625, 'May', '65', 'fees', 'Monthly Fee', '0', '3000', '1500', '1500', '7000', '', '0.00', '7000', '1500', '5500', '5500', '0.00', 'Online', '', '2025-11-08 11:29:24', '2025-04-24', '658', 42, 'demo@easyskool.in', 2, '1500.00'),
(180, '2025-2026/43', 582, 'May', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '1100', '0.00', '2200', '0', '2200', '2200', '0.00', 'Online', 'Including April Fee', '2025-11-08 11:36:37', '2025-04-25', '615', 43, 'demo@easyskool.in', 1, '1100.00'),
(181, '2025-2026/44', 579, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '3600', '', '0.00', '3600', '1000', '2600', '2600', '0.00', 'Cash', 'Late Pay', '2025-11-08 11:37:31', '2025-04-25', '612', 44, 'demo@easyskool.in', 1, '500.00'),
(182, '2025-2026/44', 579, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '3600', '', '0.00', '3600', '1000', '2600', '2600', '0.00', 'Cash', 'Late Pay', '2025-11-08 11:37:31', '2025-04-25', '612', 44, 'demo@easyskool.in', 1, '1000.00'),
(183, '2025-2026/44', 579, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '3600', '', '0.00', '3600', '1000', '2600', '2600', '0.00', 'Cash', 'Late Pay', '2025-11-08 11:37:31', '2025-04-25', '612', 44, 'demo@easyskool.in', 1, '1000.00'),
(184, '2025-2026/44', 579, 'Apr', '61', 'fees', 'Monthly Fee', '0', '1100', '1000', '100', '3600', '', '0.00', '3600', '1000', '2600', '2600', '0.00', 'Cash', 'Late Pay', '2025-11-08 11:37:31', '2025-04-25', '612', 44, 'demo@easyskool.in', 1, '1100.00'),
(185, '2025-2026/45', 611, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '300', '1200', '4300', '', '0.00', '4300', '300', '4000', '4000', '0.00', 'Cash', '', '2025-11-08 11:38:31', '2025-04-30', '644', 45, 'demo@easyskool.in', 1, '1500.00'),
(186, '2025-2026/45', 611, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '300', '4000', '4000', '0.00', 'Cash', '', '2025-11-08 11:38:31', '2025-04-30', '644', 45, 'demo@easyskool.in', 1, '1500.00'),
(187, '2025-2026/45', 611, 'Apr', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '4300', '', '0.00', '4300', '300', '4000', '4000', '0.00', 'Cash', '', '2025-11-08 11:38:31', '2025-04-30', '644', 45, 'demo@easyskool.in', 1, '1300.00'),
(188, '2025-2026/46', 614, 'May', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Cash', '', '2025-11-09 08:00:37', '2025-05-01', '647', 46, 'demo@easyskool.in', 1, '1300.00'),
(189, '2025-2026/47', 593, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '600', '400', '5600', '', '0.00', '5600', '600', '5000', '5000', '0.00', 'Online', '', '2025-11-09 08:01:28', '2025-05-01', '626', 47, 'demo@easyskool.in', 3, '1000.00'),
(190, '2025-2026/47', 593, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '600', '400', '5600', '', '0.00', '5600', '600', '5000', '5000', '0.00', 'Online', '', '2025-11-09 08:01:28', '2025-05-01', '626', 47, 'demo@easyskool.in', 3, '0'),
(191, '2025-2026/47', 593, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '600', '400', '5600', '', '0.00', '5600', '600', '5000', '5000', '0.00', 'Online', '', '2025-11-09 08:01:28', '2025-05-01', '626', 47, 'demo@easyskool.in', 3, '0'),
(192, '2025-2026/47', 593, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '5600', '', '0.00', '5600', '600', '5000', '5000', '0.00', 'Online', '', '2025-11-09 08:01:28', '2025-05-01', '626', 47, 'demo@easyskool.in', 3, '1000.00'),
(193, '2025-2026/47', 593, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '5600', '', '0.00', '5600', '600', '5000', '5000', '0.00', 'Online', '', '2025-11-09 08:01:28', '2025-05-01', '626', 47, 'demo@easyskool.in', 3, '0'),
(194, '2025-2026/47', 593, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '5600', '', '0.00', '5600', '600', '5000', '5000', '0.00', 'Online', '', '2025-11-09 08:01:28', '2025-05-01', '626', 47, 'demo@easyskool.in', 3, '0'),
(195, '2025-2026/47', 593, 'Apr', '62', 'fees', 'Monthly Fee', '0', '3600', '0', '3600', '5600', '', '0.00', '5600', '600', '5000', '5000', '0.00', 'Online', '', '2025-11-09 08:01:28', '2025-05-01', '626', 47, 'demo@easyskool.in', 3, '1200.00'),
(196, '2025-2026/47', 593, 'May', '62', 'fees', 'Monthly Fee', '0', '3600', '0', '3600', '5600', '', '0.00', '5600', '600', '5000', '5000', '0.00', 'Online', '', '2025-11-09 08:01:28', '2025-05-01', '626', 47, 'demo@easyskool.in', 3, '1200.00'),
(197, '2025-2026/47', 593, 'Jun', '62', 'fees', 'Monthly Fee', '0', '3600', '0', '3600', '5600', '', '0.00', '5600', '600', '5000', '5000', '0.00', 'Online', '', '2025-11-09 08:01:28', '2025-05-01', '626', 47, 'demo@easyskool.in', 3, '1200.00'),
(198, '2025-2026/48', 626, '', '', '', 'Ledger Amount', '3600', '3600', '0', '4200', '3600', '', '4200.00', '4200', '0', '4200', '3600', '600.00', 'Cash', '', '2025-11-09 08:03:08', '2025-05-01', '659', 48, 'demo@easyskool.in', NULL, NULL),
(199, '2025-2026/49', 598, 'May', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 08:03:40', '2025-05-01', '631', 49, 'demo@easyskool.in', 1, '1200.00'),
(200, '2025-2026/50', 595, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:04:24', '2025-05-01', '628', 50, 'demo@easyskool.in', 2, '1200.00'),
(201, '2025-2026/50', 595, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:04:24', '2025-05-01', '628', 50, 'demo@easyskool.in', 2, '1200.00'),
(202, '2025-2026/51', 606, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:05:03', '2025-05-01', '639', 51, 'demo@easyskool.in', 2, '1200.00'),
(203, '2025-2026/51', 606, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:05:03', '2025-05-01', '639', 51, 'demo@easyskool.in', 2, '1200.00'),
(204, '2025-2026/52', 613, 'May', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Cash', '', '2025-11-09 08:05:42', '2025-05-01', '646', 52, 'demo@easyskool.in', 2, '1300.00'),
(205, '2025-2026/52', 613, 'Jun', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Cash', '', '2025-11-09 08:05:42', '2025-05-01', '646', 52, 'demo@easyskool.in', 2, '1300.00'),
(206, '2025-2026/53', 601, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Cash', '', '2025-11-09 08:06:12', '2025-05-01', '634', 53, 'demo@easyskool.in', 2, '1200.00'),
(207, '2025-2026/53', 601, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Cash', '', '2025-11-09 08:06:12', '2025-05-01', '634', 53, 'demo@easyskool.in', 2, '1200.00'),
(208, '2025-2026/54', 598, 'Jun', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 08:08:05', '2025-05-02', '631', 54, 'demo@easyskool.in', 1, '1200.00'),
(211, '2025-2026/56', 603, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:09:47', '2025-05-03', '636', 56, 'demo@easyskool.in', 2, '1200.00'),
(212, '2025-2026/56', 603, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:09:47', '2025-05-03', '636', 56, 'demo@easyskool.in', 2, '1200.00'),
(213, '2025-2026/57', 608, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '200', '2200', '2400', '', '0.00', '2400', '200', '2200', '2200', '0.00', 'Online', '', '2025-11-09 08:10:41', '2025-05-03', '641', 57, 'demo@easyskool.in', 2, '1200.00'),
(214, '2025-2026/57', 608, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '200', '2200', '2400', '', '0.00', '2400', '200', '2200', '2200', '0.00', 'Online', '', '2025-11-09 08:10:41', '2025-05-03', '641', 57, 'demo@easyskool.in', 2, '1200.00'),
(215, '2025-2026/58', 607, 'May', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 08:11:19', '2025-05-04', '640', 58, 'demo@easyskool.in', 1, '1200.00'),
(216, '2025-2026/59', 622, 'May', '64', 'fees', 'Monthly Fee', '0', '2800', '0', '2800', '2800', '', '0.00', '2800', '0', '2800', '2800', '0', 'Online', '', '2025-11-09 08:13:09', '2025-05-05', '655', 59, 'demo@easyskool.in', 2, '1400.00'),
(217, '2025-2026/59', 622, 'Jun', '64', 'fees', 'Monthly Fee', '0', '2800', '0', '2800', '2800', '', '0.00', '2800', '0', '2800', '2800', '0', 'Online', '', '2025-11-09 08:13:09', '2025-05-05', '655', 59, 'demo@easyskool.in', 2, '1400.00'),
(218, '2025-2026/60', 579, 'May', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-09 08:13:41', '2025-05-05', '612', 60, 'demo@easyskool.in', 2, '1100.00'),
(219, '2025-2026/60', 579, 'Jun', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-09 08:13:41', '2025-05-05', '612', 60, 'demo@easyskool.in', 2, '1100.00'),
(220, '2025-2026/61', 588, 'May', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-09 08:14:24', '2025-05-05', '621', 61, 'demo@easyskool.in', 2, '1100.00'),
(221, '2025-2026/61', 588, 'Jun', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-09 08:14:24', '2025-05-05', '621', 61, 'demo@easyskool.in', 2, '1100.00'),
(222, '2025-2026/62', 609, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:18:44', '2025-05-05', '642', 62, 'demo@easyskool.in', 2, '1200.00'),
(223, '2025-2026/62', 609, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:18:44', '2025-05-05', '642', 62, 'demo@easyskool.in', 2, '1200.00'),
(224, '2025-2026/63', 592, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:20:05', '2025-05-05', '625', 63, 'demo@easyskool.in', 2, '1200.00'),
(225, '2025-2026/63', 592, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:20:05', '2025-05-05', '625', 63, 'demo@easyskool.in', 2, '1200.00'),
(226, '2025-2026/64', 585, 'May', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-09 08:20:38', '2025-05-06', '618', 64, 'demo@easyskool.in', 2, '1100.00'),
(227, '2025-2026/64', 585, 'Jun', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-09 08:20:38', '2025-05-06', '618', 64, 'demo@easyskool.in', 2, '1100.00'),
(228, '2025-2026/65', 587, 'May', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-09 08:21:17', '2025-05-06', '620', 65, 'demo@easyskool.in', 2, '1100.00'),
(229, '2025-2026/65', 587, 'Jun', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-09 08:21:17', '2025-05-06', '620', 65, 'demo@easyskool.in', 2, '1100.00'),
(230, '2025-2026/66', 624, 'May', '65', 'fees', 'Monthly Fee', '0', '1500', '300', '1200', '1500', '', '0.00', '1500', '300', '1200', '1200', '0.00', 'Cash', '', '2025-11-09 08:22:26', '2025-05-07', '657', 66, 'demo@easyskool.in', 1, '1500.00'),
(231, '2025-2026/67', 618, 'May', '63', 'fees', 'Monthly Fee', '0', '1300', '500', '800', '1300', '', '0.00', '1300', '500', '800', '800', '0.00', 'Cash', '', '2025-11-09 08:23:14', '2025-05-07', '651', 67, 'demo@easyskool.in', 1, '1300.00'),
(232, '2025-2026/68', 612, 'May', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 08:23:47', '2025-05-07', '645', 68, 'demo@easyskool.in', 1, '1300.00'),
(233, '2025-2026/69', 629, 'May', '67', 'fees', 'Monthly Fee', '0', '3400', '1000', '2400', '3400', '', '0.00', '3400', '1000', '2400', '2400', '0.00', 'Cash', '', '2025-11-09 08:25:02', '2025-05-09', '662', 69, 'demo@easyskool.in', 2, '1700.00'),
(234, '2025-2026/69', 629, 'Jun', '67', 'fees', 'Monthly Fee', '0', '3400', '1000', '2400', '3400', '', '0.00', '3400', '1000', '2400', '2400', '0.00', 'Cash', '', '2025-11-09 08:25:02', '2025-05-09', '662', 69, 'demo@easyskool.in', 2, '1700.00'),
(235, '2025-2026/70', 586, 'May', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 08:25:36', '2025-05-09', '619', 70, 'demo@easyskool.in', 1, '1100.00'),
(236, '2025-2026/71', 615, 'May', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 08:27:22', '2025-05-09', '648', 71, 'demo@easyskool.in', 1, '1300.00'),
(237, '2025-2026/72', 600, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:27:51', '2025-05-10', '633', 72, 'demo@easyskool.in', 2, '1200.00'),
(238, '2025-2026/72', 600, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:27:51', '2025-05-10', '633', 72, 'demo@easyskool.in', 2, '1200.00'),
(239, '2025-2026/73', 620, 'May', '63', 'fees', 'Monthly Fee', '100', '1300', '0', '1200', '1300', '', '1300.00', '2600', '0', '2600', '2500', '100.00', 'Online', '', '2025-11-09 08:28:43', '2025-05-10', '653', 73, 'demo@easyskool.in', 1, '1300.00'),
(240, '2025-2026/74', 581, 'May', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-09 08:29:29', '2025-05-13', '614', 74, 'demo@easyskool.in', 1, '1100.00'),
(241, '2025-2026/75', 604, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:30:15', '2025-05-13', '637', 75, 'demo@easyskool.in', 2, '1200.00'),
(242, '2025-2026/75', 604, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:30:15', '2025-05-13', '637', 75, 'demo@easyskool.in', 2, '1200.00'),
(243, '2025-2026/76', 583, 'May', '61', 'fees', 'Monthly Fee', '-200', '2200', '0', '2400', '2200', '', '600.00', '2800', '0', '2800', '3000', '-200.00', 'Cash', '', '2025-11-09 08:36:07', '2025-05-14', '616', 76, 'demo@easyskool.in', 2, '1100.00'),
(244, '2025-2026/76', 583, 'Jun', '61', 'fees', 'Monthly Fee', '-200', '2200', '0', '2400', '2200', '', '600.00', '2800', '0', '2800', '3000', '-200.00', 'Cash', '', '2025-11-09 08:36:07', '2025-05-14', '616', 76, 'demo@easyskool.in', 2, '1100.00'),
(245, '2025-2026/77', 612, 'Jun', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 08:36:48', '2025-05-15', '645', 77, 'demo@easyskool.in', 1, '1300.00'),
(246, '2025-2026/78', 602, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:37:33', '2025-05-15', '635', 78, 'demo@easyskool.in', 2, '1200.00'),
(247, '2025-2026/78', 602, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:37:33', '2025-05-15', '635', 78, 'demo@easyskool.in', 2, '1200.00'),
(248, '2025-2026/79', 614, 'Jun', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Cash', '', '2025-11-09 08:38:13', '2025-05-19', '647', 79, 'demo@easyskool.in', 1, '1300.00'),
(249, '2025-2026/80', 580, 'May', '61', 'fees', 'Monthly Fee', '100', '2200', '0', '2100', '2200', '', '0.00', '2200', '0', '2200', '2100', '100.00', 'Online', '', '2025-11-09 08:39:23', '2025-05-19', '613', 80, 'demo@easyskool.in', 2, '1100.00'),
(250, '2025-2026/80', 580, 'Jun', '61', 'fees', 'Monthly Fee', '100', '2200', '0', '2100', '2200', '', '0.00', '2200', '0', '2200', '2100', '100.00', 'Online', '', '2025-11-09 08:39:23', '2025-05-19', '613', 80, 'demo@easyskool.in', 2, '1100.00'),
(251, '2025-2026/81', 605, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:40:09', '2025-05-19', '638', 81, 'demo@easyskool.in', 2, '1200.00'),
(252, '2025-2026/81', 605, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 08:40:09', '2025-05-19', '638', 81, 'demo@easyskool.in', 2, '1200.00'),
(253, '2025-2026/82', 594, 'May', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 09:05:59', '2025-05-19', '627', 82, 'demo@easyskool.in', 1, '1200.00'),
(254, '2025-2026/83', 596, 'May', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 09:06:24', '2025-05-19', '629', 83, 'demo@easyskool.in', 1, '1200.00'),
(255, '2025-2026/84', 596, 'Jun', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 09:07:26', '2025-05-19', '629', 84, 'demo@easyskool.in', 1, '1200.00'),
(256, '2025-2026/85', 607, 'Jun', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 09:07:59', '2025-05-20', '640', 85, 'demo@easyskool.in', 1, '1200.00');
INSERT INTO `receipts` (`id`, `receipt_no`, `student_id`, `months`, `fee_head`, `fee_head_type`, `fee_head_name`, `balance_amount`, `total`, `rec_discount`, `rec_amount`, `fees_received`, `late_fees`, `ledger_amt`, `total_fees`, `discount_amt`, `net_fees`, `receipt_amt`, `balance_amt`, `mode`, `remarks`, `created_at`, `date_time`, `back_id`, `sr_no`, `create_by`, `total_month`, `month_total`) VALUES
(257, '2025-2026/86', 597, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '200', '2200', '2400', '', '0.00', '2400', '200', '2200', '2200', '0.00', 'Cash', '', '2025-11-09 09:08:42', '2025-05-20', '630', 86, 'demo@easyskool.in', 2, '1200.00'),
(258, '2025-2026/86', 597, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '200', '2200', '2400', '', '0.00', '2400', '200', '2200', '2200', '0.00', 'Cash', '', '2025-11-09 09:08:42', '2025-05-20', '630', 86, 'demo@easyskool.in', 2, '1200.00'),
(259, '2025-2026/87', 584, '', '', '', 'Ledger Amount', '2200', '2200', '0', '2500', '2200', '', '2500.00', '2500', '0', '2500', '2200', '300.00', 'Online', '', '2025-11-09 09:10:12', '2025-05-21', '617', 87, 'demo@easyskool.in', NULL, NULL),
(260, '2025-2026/88', 627, 'May', '66', 'fees', 'Monthly Fee', '0', '1600', '0', '1600', '1600', '', '0.00', '1600', '0', '1600', '1600', '0', 'Cash', '', '2025-11-09 09:10:47', '2025-05-22', '660', 88, 'demo@easyskool.in', 1, '1600.00'),
(261, '2025-2026/89', 627, 'Jun', '66', 'fees', 'Monthly Fee', '0', '1600', '0', '1600', '1600', '', '0.00', '1600', '0', '1600', '1600', '0', 'Cash', '', '2025-11-09 09:11:18', '2025-05-23', '660', 89, 'demo@easyskool.in', 1, '1600.00'),
(262, '2025-2026/90', 582, 'Jun', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-09 09:11:55', '2025-05-23', '615', 90, 'demo@easyskool.in', 1, '1100.00'),
(263, '2025-2026/91', 599, 'May', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Cash', '', '2025-11-09 09:12:33', '2025-05-24', '632', 91, 'demo@easyskool.in', 2, '1200.00'),
(264, '2025-2026/91', 599, 'Jun', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Cash', '', '2025-11-09 09:12:33', '2025-05-24', '632', 91, 'demo@easyskool.in', 2, '1200.00'),
(265, '2025-2026/92', 611, 'May', '63', 'fees', 'Monthly Fee', '1100', '2600', '0', '1500', '2600', '', '0.00', '2600', '0', '2600', '1500', '1100.00', 'Cash', '', '2025-11-09 09:13:18', '2025-05-29', '644', 92, 'demo@easyskool.in', 2, '1300.00'),
(266, '2025-2026/92', 611, 'Jun', '63', 'fees', 'Monthly Fee', '1100', '2600', '0', '1500', '2600', '', '0.00', '2600', '0', '2600', '1500', '1100.00', 'Cash', '', '2025-11-09 09:13:18', '2025-05-29', '644', 92, 'demo@easyskool.in', 2, '1300.00'),
(267, '2025-2026/93', 615, 'Jun', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 09:13:57', '2025-06-03', '648', 93, 'demo@easyskool.in', 1, '1300.00'),
(268, '2025-2026/94', 610, 'May', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Online', '', '2025-11-09 09:15:14', '2025-06-04', '643', 94, 'demo@easyskool.in', 2, '1300.00'),
(269, '2025-2026/94', 610, 'Jun', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Online', '', '2025-11-09 09:15:14', '2025-06-04', '643', 94, 'demo@easyskool.in', 2, '1300.00'),
(270, '2025-2026/95', 614, 'Jul', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Cash', '', '2025-11-09 09:15:47', '2025-07-01', '647', 95, 'demo@easyskool.in', 1, '1300.00'),
(271, '2025-2026/96', 601, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 09:16:12', '2025-07-01', '634', 96, 'demo@easyskool.in', 1, '1200.00'),
(272, '2025-2026/97', 570, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '500.00'),
(273, '2025-2026/97', 570, 'May', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '0'),
(274, '2025-2026/97', 570, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '0'),
(275, '2025-2026/97', 570, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '0'),
(276, '2025-2026/97', 570, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '100', '900', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '1000.00'),
(277, '2025-2026/97', 570, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '100', '900', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '0'),
(278, '2025-2026/97', 570, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '100', '900', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '0'),
(279, '2025-2026/97', 570, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '100', '900', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '0'),
(280, '2025-2026/97', 570, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '1000.00'),
(281, '2025-2026/97', 570, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '0'),
(282, '2025-2026/97', 570, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '0'),
(283, '2025-2026/97', 570, 'Jul', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '0'),
(284, '2025-2026/97', 570, 'Apr', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '1100.00'),
(285, '2025-2026/97', 570, 'May', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '1100.00'),
(286, '2025-2026/97', 570, 'Jun', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '1100.00'),
(287, '2025-2026/97', 570, 'Jul', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '3900', '3000', '3000', '0.00', 'Online', '', '2025-11-09 09:27:04', '2025-07-01', '603', 97, 'demo@easyskool.in', 4, '1100.00'),
(288, '2025-2026/98', 617, 'Jul', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 09:27:32', '2025-07-02', '650', 98, 'demo@easyskool.in', 1, '1300.00'),
(289, '2025-2026/99', 595, 'Jul', '62', 'fees', 'Monthly Fee', '0', '10800', '1200', '9600', '10800', '', '0.00', '10800', '1200', '9600', '9600', '0.00', 'Online', 'Full Paid', '2025-11-09 09:31:09', '2025-07-03', '628', 99, 'demo@easyskool.in', 9, '1200.00'),
(290, '2025-2026/99', 595, 'Aug', '62', 'fees', 'Monthly Fee', '0', '10800', '1200', '9600', '10800', '', '0.00', '10800', '1200', '9600', '9600', '0.00', 'Online', 'Full Paid', '2025-11-09 09:31:10', '2025-07-03', '628', 99, 'demo@easyskool.in', 9, '1200.00'),
(291, '2025-2026/99', 595, 'Sep', '62', 'fees', 'Monthly Fee', '0', '10800', '1200', '9600', '10800', '', '0.00', '10800', '1200', '9600', '9600', '0.00', 'Online', 'Full Paid', '2025-11-09 09:31:10', '2025-07-03', '628', 99, 'demo@easyskool.in', 9, '1200.00'),
(292, '2025-2026/99', 595, 'Oct', '62', 'fees', 'Monthly Fee', '0', '10800', '1200', '9600', '10800', '', '0.00', '10800', '1200', '9600', '9600', '0.00', 'Online', 'Full Paid', '2025-11-09 09:31:10', '2025-07-03', '628', 99, 'demo@easyskool.in', 9, '1200.00'),
(293, '2025-2026/99', 595, 'Nov', '62', 'fees', 'Monthly Fee', '0', '10800', '1200', '9600', '10800', '', '0.00', '10800', '1200', '9600', '9600', '0.00', 'Online', 'Full Paid', '2025-11-09 09:31:10', '2025-07-03', '628', 99, 'demo@easyskool.in', 9, '1200.00'),
(294, '2025-2026/99', 595, 'Dec', '62', 'fees', 'Monthly Fee', '0', '10800', '1200', '9600', '10800', '', '0.00', '10800', '1200', '9600', '9600', '0.00', 'Online', 'Full Paid', '2025-11-09 09:31:10', '2025-07-03', '628', 99, 'demo@easyskool.in', 9, '1200.00'),
(295, '2025-2026/99', 595, 'Jan', '62', 'fees', 'Monthly Fee', '0', '10800', '1200', '9600', '10800', '', '0.00', '10800', '1200', '9600', '9600', '0.00', 'Online', 'Full Paid', '2025-11-09 09:31:10', '2025-07-03', '628', 99, 'demo@easyskool.in', 9, '1200.00'),
(296, '2025-2026/99', 595, 'Feb', '62', 'fees', 'Monthly Fee', '0', '10800', '1200', '9600', '10800', '', '0.00', '10800', '1200', '9600', '9600', '0.00', 'Online', 'Full Paid', '2025-11-09 09:31:10', '2025-07-03', '628', 99, 'demo@easyskool.in', 9, '1200.00'),
(297, '2025-2026/99', 595, 'Mar', '62', 'fees', 'Monthly Fee', '0', '10800', '1200', '9600', '10800', '', '0.00', '10800', '1200', '9600', '9600', '0.00', 'Online', 'Full Paid', '2025-11-09 09:31:10', '2025-07-03', '628', 99, 'demo@easyskool.in', 9, '1200.00'),
(298, '2025-2026/100', 629, 'Jul', '67', 'fees', 'Monthly Fee', '0', '1700', '500', '1200', '1700', '', '0.00', '1700', '500', '1200', '1200', '0.00', 'Cash', '', '2025-11-09 09:32:04', '2025-07-03', '662', 100, 'demo@easyskool.in', 1, '1700.00'),
(299, '2025-2026/101', 613, 'Jul', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 09:32:31', '2025-07-03', '646', 101, 'demo@easyskool.in', 1, '1300.00'),
(300, '2025-2026/102', 609, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 09:32:55', '2025-07-04', '642', 102, 'demo@easyskool.in', 1, '1200.00'),
(301, '2025-2026/103', 592, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 09:33:38', '2025-07-04', '625', 103, 'demo@easyskool.in', 1, '1200.00'),
(302, '2025-2026/104', 622, 'Jul', '64', 'fees', 'Monthly Fee', '0', '1400', '0', '1400', '1400', '', '0.00', '1400', '0', '1400', '1400', '0', 'Online', '', '2025-11-09 09:34:14', '2025-07-05', '655', 104, 'demo@easyskool.in', 1, '1400.00'),
(303, '2025-2026/105', 579, 'Jul', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-09 09:34:42', '2025-07-05', '612', 105, 'demo@easyskool.in', 1, '1100.00'),
(304, '2025-2026/106', 612, 'Jul', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 09:35:12', '2025-07-05', '645', 106, 'demo@easyskool.in', 1, '1300.00'),
(305, '2025-2026/107', 626, 'May', '66', 'fees', 'Monthly Fee', '200', '1600', '0', '1400', '1600', '', '600.00', '2200', '0', '2200', '2000', '200.00', 'Online', '', '2025-11-09 09:36:04', '2025-07-05', '659', 107, 'demo@easyskool.in', 1, '1600.00'),
(306, '2025-2026/108', 625, 'Jun', '65', 'fees', 'Monthly Fee', '0', '3000', '0', '3000', '3000', '', '0.00', '3000', '0', '3000', '3000', '0', 'Online', '', '2025-11-09 09:36:40', '2025-07-05', '658', 108, 'demo@easyskool.in', 2, '1500.00'),
(307, '2025-2026/108', 625, 'Jul', '65', 'fees', 'Monthly Fee', '0', '3000', '0', '3000', '3000', '', '0.00', '3000', '0', '3000', '3000', '0', 'Online', '', '2025-11-09 09:36:40', '2025-07-05', '658', 108, 'demo@easyskool.in', 2, '1500.00'),
(308, '2025-2026/109', 608, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 09:37:15', '2025-07-05', '641', 109, 'demo@easyskool.in', 1, '1200.00'),
(309, '2025-2026/110', 606, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 09:37:51', '2025-07-05', '639', 110, 'demo@easyskool.in', 1, '1200.00'),
(310, '2025-2026/111', 600, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 09:39:23', '2025-07-07', '633', 111, 'demo@easyskool.in', 1, '1200.00'),
(311, '2025-2026/112', 603, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 09:40:06', '2025-07-07', '636', 112, 'demo@easyskool.in', 1, '1200.00'),
(312, '2025-2026/113', 584, 'May', '61', 'fees', 'Monthly Fee', '300', '1100', '0', '800', '1100', '', '300.00', '1400', '0', '1400', '1100', '300.00', 'Online', '', '2025-11-09 09:41:16', '2025-07-07', '617', 113, 'demo@easyskool.in', 1, '1100.00'),
(313, '2025-2026/114', 571, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '500.00'),
(314, '2025-2026/114', 571, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '0'),
(315, '2025-2026/114', 571, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '0'),
(316, '2025-2026/114', 571, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '0'),
(317, '2025-2026/114', 571, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '1000.00'),
(318, '2025-2026/114', 571, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '0'),
(319, '2025-2026/114', 571, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '0'),
(320, '2025-2026/114', 571, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '0'),
(321, '2025-2026/114', 571, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '1000.00'),
(322, '2025-2026/114', 571, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '0'),
(323, '2025-2026/114', 571, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '0'),
(324, '2025-2026/114', 571, 'Jul', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '0'),
(325, '2025-2026/114', 571, 'Apr', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '1100.00'),
(326, '2025-2026/114', 571, 'May', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '1100.00'),
(327, '2025-2026/114', 571, 'Jun', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '1100.00'),
(328, '2025-2026/114', 571, 'Jul', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '3300', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 09:42:00', '2025-07-07', '604', 114, 'demo@easyskool.in', 4, '1100.00'),
(329, '2025-2026/115', 607, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 09:42:58', '2025-07-07', '640', 115, 'demo@easyskool.in', 1, '1200.00'),
(331, '2025-2026/117', 615, 'Jul', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 09:44:29', '2025-07-09', '648', 117, 'demo@easyskool.in', 1, '1300.00'),
(332, '2025-2026/118', 585, 'Jul', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 09:45:11', '2025-07-10', '618', 118, 'demo@easyskool.in', 1, '1100.00'),
(333, '2025-2026/119', 610, 'Jul', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Online', '', '2025-11-09 09:45:40', '2025-07-10', '643', 119, 'demo@easyskool.in', 2, '1300.00'),
(334, '2025-2026/119', 610, 'Aug', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Online', '', '2025-11-09 09:45:40', '2025-07-10', '643', 119, 'demo@easyskool.in', 2, '1300.00'),
(335, '2025-2026/120', 588, 'Jul', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 09:46:33', '2025-07-10', '621', 120, 'demo@easyskool.in', 1, '1100.00'),
(337, '2025-2026/122', 599, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 14:37:09', '2025-07-11', '632', 122, 'demo@easyskool.in', 1, '1200.00'),
(338, '2025-2026/123', 596, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 14:37:50', '2025-07-11', '629', 123, 'demo@easyskool.in', 1, '1200.00'),
(339, '2025-2026/124', 593, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '200', '1000', '1200', '', '0.00', '1200', '200', '1000', '1000', '0.00', 'Online', '', '2025-11-09 14:38:35', '2025-07-11', '626', 124, 'demo@easyskool.in', 1, '1200.00'),
(340, '2025-2026/125', 620, 'Jun', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '100.00', '2700', '0', '2700', '2700', '0', 'Online', '', '2025-11-09 14:39:08', '2025-07-11', '653', 125, 'demo@easyskool.in', 2, '1300.00'),
(341, '2025-2026/125', 620, 'Jul', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '100.00', '2700', '0', '2700', '2700', '0', 'Online', '', '2025-11-09 14:39:08', '2025-07-11', '653', 125, 'demo@easyskool.in', 2, '1300.00'),
(342, '2025-2026/126', 602, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 14:39:37', '2025-07-12', '635', 126, 'demo@easyskool.in', 1, '1200.00'),
(343, '2025-2026/127', 598, 'Jul', '62', 'fees', 'Monthly Fee', '-466', '1200', '0', '1666', '1200', '', '0.00', '1200', '0', '1200', '1666', '-466.00', 'Online', '', '2025-11-09 14:47:25', '2025-07-12', '631', 127, 'demo@easyskool.in', 1, '1200.00'),
(344, '2025-2026/128', 581, 'Jun', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-09 14:47:57', '2025-07-12', '614', 128, 'demo@easyskool.in', 2, '1100.00'),
(345, '2025-2026/128', 581, 'Jul', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-09 14:47:57', '2025-07-12', '614', 128, 'demo@easyskool.in', 2, '1100.00'),
(348, '2025-2026/130', 618, 'Jun', '63', 'fees', 'Monthly Fee', '0', '2600', '1100', '1500', '2600', '', '0.00', '2600', '1100', '1500', '1500', '0.00', 'Online', '', '2025-11-09 14:54:09', '2025-07-14', '651', 130, 'demo@easyskool.in', 2, '1300.00'),
(349, '2025-2026/130', 618, 'Jul', '63', 'fees', 'Monthly Fee', '0', '2600', '1100', '1500', '2600', '', '0.00', '2600', '1100', '1500', '1500', '0.00', 'Online', '', '2025-11-09 14:54:09', '2025-07-14', '651', 130, 'demo@easyskool.in', 2, '1300.00'),
(350, '2025-2026/131', 582, 'Jul', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-09 14:55:00', '2025-07-14', '615', 131, 'demo@easyskool.in', 2, '1100.00'),
(351, '2025-2026/131', 582, 'Aug', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-09 14:55:00', '2025-07-14', '615', 131, 'demo@easyskool.in', 2, '1100.00'),
(352, '2025-2026/132', 587, 'Jul', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 14:55:29', '2025-07-16', '620', 132, 'demo@easyskool.in', 1, '1100.00'),
(353, '2025-2026/133', 624, 'Aug', '65', 'fees', 'Monthly Fee', '200', '1500', '300', '1000', '1500', '', '0.00', '1500', '300', '1200', '1000', '200.00', 'Online', '', '2025-11-09 14:57:44', '2025-07-18', '657', 133, 'demo@easyskool.in', 1, '1500.00'),
(354, '2025-2026/134', 624, '', '', '', 'Ledger Amount', '1000', '1000', '0', '1000', '1000', '', '1000.00', '1000', '0', '1000', '1000', '0.00', 'Online', '', '2025-11-09 15:02:40', '2025-07-18', '657', 134, 'demo@easyskool.in', NULL, NULL),
(355, '2025-2026/135', 586, 'Jun', '61', 'fees', 'Monthly Fee', '0', '3300', '0', '3300', '3300', '', '0.00', '3300', '0', '3300', '3300', '0', 'Cash', '', '2025-11-09 15:03:11', '2025-07-24', '619', 135, 'demo@easyskool.in', 3, '1100.00'),
(356, '2025-2026/135', 586, 'Jul', '61', 'fees', 'Monthly Fee', '0', '3300', '0', '3300', '3300', '', '0.00', '3300', '0', '3300', '3300', '0', 'Cash', '', '2025-11-09 15:03:11', '2025-07-24', '619', 135, 'demo@easyskool.in', 3, '1100.00'),
(357, '2025-2026/135', 586, 'Aug', '61', 'fees', 'Monthly Fee', '0', '3300', '0', '3300', '3300', '', '0.00', '3300', '0', '3300', '3300', '0', 'Cash', '', '2025-11-09 15:03:11', '2025-07-24', '619', 135, 'demo@easyskool.in', 3, '1100.00'),
(358, '2025-2026/136', 572, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '500.00'),
(359, '2025-2026/136', 572, 'May', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '0'),
(360, '2025-2026/136', 572, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '0'),
(361, '2025-2026/136', 572, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '0'),
(362, '2025-2026/136', 572, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '1000.00'),
(363, '2025-2026/136', 572, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '0'),
(364, '2025-2026/136', 572, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '0'),
(365, '2025-2026/136', 572, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '0'),
(366, '2025-2026/136', 572, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '100', '900', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '1000.00'),
(367, '2025-2026/136', 572, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '100', '900', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '0'),
(368, '2025-2026/136', 572, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '100', '900', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '0'),
(369, '2025-2026/136', 572, 'Jul', '54', 'fees', 'Composite Fee', '0', '1000', '100', '900', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '0'),
(370, '2025-2026/136', 572, 'Apr', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '1100.00'),
(371, '2025-2026/136', 572, 'May', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '1100.00'),
(372, '2025-2026/136', 572, 'Jun', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '1100.00'),
(373, '2025-2026/136', 572, 'Jul', '61', 'fees', 'Monthly Fee', '0', '4400', '3300', '1100', '6900', '', '0.00', '6900', '4900', '2000', '2000', '0.00', 'Cash', '', '2025-11-09 15:06:08', '2025-07-28', '605', 136, 'demo@easyskool.in', 4, '1100.00'),
(374, '2025-2026/137', 601, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 15:06:40', '2025-08-01', '634', 137, 'demo@easyskool.in', 1, '1200.00'),
(375, '2025-2026/138', 578, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '500.00'),
(376, '2025-2026/138', 578, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(377, '2025-2026/138', 578, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(378, '2025-2026/138', 578, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(379, '2025-2026/138', 578, 'Aug', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(380, '2025-2026/138', 578, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '1000.00'),
(381, '2025-2026/138', 578, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(382, '2025-2026/138', 578, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(383, '2025-2026/138', 578, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(384, '2025-2026/138', 578, 'Aug', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(385, '2025-2026/138', 578, 'Apr', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '1000.00'),
(386, '2025-2026/138', 578, 'May', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(387, '2025-2026/138', 578, 'Jun', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(388, '2025-2026/138', 578, 'Jul', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(389, '2025-2026/138', 578, 'Aug', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '0'),
(390, '2025-2026/138', 578, 'Apr', '61', 'fees', 'Monthly Fee', '1100', '5500', '4400', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '1100.00'),
(391, '2025-2026/138', 578, 'May', '61', 'fees', 'Monthly Fee', '1100', '5500', '4400', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '1100.00'),
(392, '2025-2026/138', 578, 'Jun', '61', 'fees', 'Monthly Fee', '1100', '5500', '4400', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '1100.00'),
(393, '2025-2026/138', 578, 'Jul', '61', 'fees', 'Monthly Fee', '1100', '5500', '4400', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '1100.00'),
(394, '2025-2026/138', 578, 'Aug', '61', 'fees', 'Monthly Fee', '1100', '5500', '4400', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:10:39', '2025-08-01', '611', 138, 'demo@easyskool.in', 5, '1100.00'),
(395, '2025-2026/139', 575, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '500.00'),
(396, '2025-2026/139', 575, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(397, '2025-2026/139', 575, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(398, '2025-2026/139', 575, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(399, '2025-2026/139', 575, 'Aug', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(400, '2025-2026/139', 575, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '1000.00'),
(401, '2025-2026/139', 575, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(402, '2025-2026/139', 575, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(403, '2025-2026/139', 575, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(404, '2025-2026/139', 575, 'Aug', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(405, '2025-2026/139', 575, 'Apr', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '1000.00'),
(406, '2025-2026/139', 575, 'May', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(407, '2025-2026/139', 575, 'Jun', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(408, '2025-2026/139', 575, 'Jul', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(409, '2025-2026/139', 575, 'Aug', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '0'),
(410, '2025-2026/139', 575, 'Apr', '61', 'fees', 'Monthly Fee', '1100', '5500', '4400', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '1100.00'),
(411, '2025-2026/139', 575, 'May', '61', 'fees', 'Monthly Fee', '1100', '5500', '4400', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '1100.00'),
(412, '2025-2026/139', 575, 'Jun', '61', 'fees', 'Monthly Fee', '1100', '5500', '4400', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '1100.00'),
(413, '2025-2026/139', 575, 'Jul', '61', 'fees', 'Monthly Fee', '1100', '5500', '4400', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '1100.00'),
(414, '2025-2026/139', 575, 'Aug', '61', 'fees', 'Monthly Fee', '1100', '5500', '4400', '0', '8000', '', '0.00', '8000', '4400', '3600', '1500', '2100.00', 'Cash', '', '2025-11-09 15:11:30', '2025-08-01', '608', 139, 'demo@easyskool.in', 5, '1100.00'),
(415, '2025-2026/140', 576, 'Apr', '49', 'fees', 'Registration Fee', '500', '500', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '500.00'),
(416, '2025-2026/140', 576, 'May', '49', 'fees', 'Registration Fee', '500', '500', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(417, '2025-2026/140', 576, 'Jun', '49', 'fees', 'Registration Fee', '500', '500', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(418, '2025-2026/140', 576, 'Jul', '49', 'fees', 'Registration Fee', '500', '500', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(419, '2025-2026/140', 576, 'Aug', '49', 'fees', 'Registration Fee', '500', '500', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(420, '2025-2026/140', 576, 'Apr', '50', 'fees', 'Annual Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '1000.00'),
(421, '2025-2026/140', 576, 'May', '50', 'fees', 'Annual Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(422, '2025-2026/140', 576, 'Jun', '50', 'fees', 'Annual Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(423, '2025-2026/140', 576, 'Jul', '50', 'fees', 'Annual Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(424, '2025-2026/140', 576, 'Aug', '50', 'fees', 'Annual Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(425, '2025-2026/140', 576, 'Apr', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '1000.00'),
(426, '2025-2026/140', 576, 'May', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(427, '2025-2026/140', 576, 'Jun', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(428, '2025-2026/140', 576, 'Jul', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(429, '2025-2026/140', 576, 'Aug', '54', 'fees', 'Composite Fee', '1000', '1000', '0', '0', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '0'),
(430, '2025-2026/140', 576, 'Apr', '61', 'fees', 'Monthly Fee', '100', '5500', '4400', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '1100.00'),
(431, '2025-2026/140', 576, 'May', '61', 'fees', 'Monthly Fee', '100', '5500', '4400', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '1100.00'),
(432, '2025-2026/140', 576, 'Jun', '61', 'fees', 'Monthly Fee', '100', '5500', '4400', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '1100.00'),
(433, '2025-2026/140', 576, 'Jul', '61', 'fees', 'Monthly Fee', '100', '5500', '4400', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '1100.00'),
(434, '2025-2026/140', 576, 'Aug', '61', 'fees', 'Monthly Fee', '100', '5500', '4400', '1000', '8000', '', '0.00', '8000', '4400', '3600', '1000', '2600.00', 'Cash', '', '2025-11-09 15:13:37', '2025-08-01', '609', 140, 'demo@easyskool.in', 5, '1100.00'),
(435, '2025-2026/141', 627, 'Jul', '66', 'fees', 'Monthly Fee', '0', '1600', '0', '1600', '1600', '', '0.00', '1600', '0', '1600', '1600', '0', 'Cash', '', '2025-11-09 15:14:07', '2025-08-02', '660', 141, 'demo@easyskool.in', 1, '1600.00'),
(436, '2025-2026/142', 608, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 15:14:32', '2025-08-02', '641', 142, 'demo@easyskool.in', 1, '1200.00'),
(437, '2025-2026/143', 613, 'Aug', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 15:15:07', '2025-08-02', '646', 143, 'demo@easyskool.in', 1, '1300.00'),
(438, '2025-2026/144', 614, 'Aug', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Cash', '', '2025-11-09 15:15:24', '2025-08-02', '647', 144, 'demo@easyskool.in', 1, '1300.00'),
(439, '2025-2026/145', 597, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '100', '1100', '1200', '', '0.00', '1200', '100', '1100', '1100', '0.00', 'Cash', '', '2025-11-09 15:15:50', '2025-08-04', '630', 145, 'demo@easyskool.in', 1, '1200.00'),
(440, '2025-2026/146', 603, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 15:16:17', '2025-08-04', '636', 146, 'demo@easyskool.in', 1, '1200.00'),
(441, '2025-2026/147', 607, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 15:17:00', '2025-08-04', '640', 147, 'demo@easyskool.in', 1, '1200.00'),
(444, '2025-2026/149', 612, 'Aug', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 15:20:26', '2025-08-05', '645', 149, 'demo@easyskool.in', 1, '1300.00'),
(445, '2025-2026/150', 629, 'Aug', '67', 'fees', 'Monthly Fee', '0', '1700', '500', '1200', '1700', '', '0.00', '1700', '500', '1200', '1200', '0.00', 'Cash', '', '2025-11-09 15:20:48', '2025-08-05', '662', 150, 'demo@easyskool.in', 1, '1700.00'),
(446, '2025-2026/151', 625, 'Aug', '65', 'fees', 'Monthly Fee', '0', '1500', '0', '1500', '1500', '', '0.00', '1500', '0', '1500', '1500', '0', 'Online', '', '2025-11-09 15:21:12', '2025-08-05', '658', 151, 'demo@easyskool.in', 1, '1500.00'),
(447, '2025-2026/152', 622, 'Aug', '64', 'fees', 'Monthly Fee', '0', '1400', '0', '1400', '1400', '', '0.00', '1400', '0', '1400', '1400', '0', 'Online', '', '2025-11-09 15:21:44', '2025-08-05', '655', 152, 'demo@easyskool.in', 1, '1400.00'),
(448, '2025-2026/153', 609, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 15:22:19', '2025-08-05', '642', 153, 'demo@easyskool.in', 1, '1200.00'),
(451, '2025-2026/155', 605, 'Jul', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 15:23:58', '2025-08-05', '638', 155, 'demo@easyskool.in', 2, '1200.00'),
(452, '2025-2026/155', 605, 'Aug', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 15:23:58', '2025-08-05', '638', 155, 'demo@easyskool.in', 2, '1200.00'),
(453, '2025-2026/156', 617, 'Aug', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 15:24:27', '2025-08-05', '650', 156, 'demo@easyskool.in', 1, '1300.00'),
(454, '2025-2026/157', 604, 'Jul', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 15:25:00', '2025-08-06', '637', 157, 'demo@easyskool.in', 2, '1200.00'),
(455, '2025-2026/157', 604, 'Aug', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 15:25:00', '2025-08-06', '637', 157, 'demo@easyskool.in', 2, '1200.00'),
(456, '2025-2026/158', 585, 'Aug', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 15:25:16', '2025-08-07', '618', 158, 'demo@easyskool.in', 1, '1100.00'),
(457, '2025-2026/159', 592, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 15:25:43', '2025-08-07', '625', 159, 'demo@easyskool.in', 1, '1200.00'),
(458, '2025-2026/160', 606, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 15:26:14', '2025-08-07', '639', 160, 'demo@easyskool.in', 1, '1200.00'),
(459, '2025-2026/161', 594, 'Jun', '62', 'fees', 'Monthly Fee', '0', '3600', '0', '3600', '3600', '', '0.00', '3600', '0', '3600', '3600', '0', 'Online', '', '2025-11-09 15:27:11', '2025-08-07', '627', 161, 'demo@easyskool.in', 3, '1200.00'),
(460, '2025-2026/161', 594, 'Jul', '62', 'fees', 'Monthly Fee', '0', '3600', '0', '3600', '3600', '', '0.00', '3600', '0', '3600', '3600', '0', 'Online', '', '2025-11-09 15:27:11', '2025-08-07', '627', 161, 'demo@easyskool.in', 3, '1200.00'),
(461, '2025-2026/161', 594, 'Aug', '62', 'fees', 'Monthly Fee', '0', '3600', '0', '3600', '3600', '', '0.00', '3600', '0', '3600', '3600', '0', 'Online', '', '2025-11-09 15:27:11', '2025-08-07', '627', 161, 'demo@easyskool.in', 3, '1200.00'),
(462, '2025-2026/162', 570, 'Aug', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 15:27:27', '2025-08-08', '603', 162, 'demo@easyskool.in', 1, '1100.00'),
(463, '2025-2026/163', 584, 'Jun', '61', 'fees', 'Monthly Fee', '300', '1100', '0', '800', '1100', '', '300.00', '1400', '0', '1400', '1100', '300.00', 'Online', '', '2025-11-09 15:30:22', '2025-08-08', '617', 163, 'demo@easyskool.in', 1, '1100.00'),
(464, '2025-2026/164', 579, 'Aug', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 15:30:39', '2025-08-11', '612', 164, 'demo@easyskool.in', 1, '1100.00'),
(465, '2025-2026/165', 616, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '500.00');
INSERT INTO `receipts` (`id`, `receipt_no`, `student_id`, `months`, `fee_head`, `fee_head_type`, `fee_head_name`, `balance_amount`, `total`, `rec_discount`, `rec_amount`, `fees_received`, `late_fees`, `ledger_amt`, `total_fees`, `discount_amt`, `net_fees`, `receipt_amt`, `balance_amt`, `mode`, `remarks`, `created_at`, `date_time`, `back_id`, `sr_no`, `create_by`, `total_month`, `month_total`) VALUES
(466, '2025-2026/165', 616, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(467, '2025-2026/165', 616, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(468, '2025-2026/165', 616, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(469, '2025-2026/165', 616, 'Aug', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(470, '2025-2026/165', 616, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '1500.00'),
(471, '2025-2026/165', 616, 'May', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(472, '2025-2026/165', 616, 'Jun', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(473, '2025-2026/165', 616, 'Jul', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(474, '2025-2026/165', 616, 'Aug', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(475, '2025-2026/165', 616, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '1500.00'),
(476, '2025-2026/165', 616, 'May', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(477, '2025-2026/165', 616, 'Jun', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(478, '2025-2026/165', 616, 'Jul', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(479, '2025-2026/165', 616, 'Aug', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '0'),
(480, '2025-2026/165', 616, 'Apr', '63', 'fees', 'Monthly Fee', '0', '6500', '5200', '1300', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '1300.00'),
(481, '2025-2026/165', 616, 'May', '63', 'fees', 'Monthly Fee', '0', '6500', '5200', '1300', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '1300.00'),
(482, '2025-2026/165', 616, 'Jun', '63', 'fees', 'Monthly Fee', '0', '6500', '5200', '1300', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '1300.00'),
(483, '2025-2026/165', 616, 'Jul', '63', 'fees', 'Monthly Fee', '0', '6500', '5200', '1300', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '1300.00'),
(484, '2025-2026/165', 616, 'Aug', '63', 'fees', 'Monthly Fee', '0', '6500', '5200', '1300', '10000', '', '0.00', '10000', '5200', '4800', '4800', '0.00', 'Online', 'Late Admission', '2025-11-09 15:31:21', '2025-08-11', '649', 165, 'demo@easyskool.in', 5, '1300.00'),
(485, '2025-2026/166', 600, 'Aug', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 15:31:50', '2025-08-11', '633', 166, 'demo@easyskool.in', 2, '1200.00'),
(486, '2025-2026/166', 600, 'Sep', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-09 15:31:50', '2025-08-11', '633', 166, 'demo@easyskool.in', 2, '1200.00'),
(487, '2025-2026/167', 611, 'Jul', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '1100.00', '3700', '0', '3700', '3700', '0', 'Online', '', '2025-11-09 15:32:27', '2025-08-11', '644', 167, 'demo@easyskool.in', 2, '1300.00'),
(488, '2025-2026/167', 611, 'Aug', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '1100.00', '3700', '0', '3700', '3700', '0', 'Online', '', '2025-11-09 15:32:27', '2025-08-11', '644', 167, 'demo@easyskool.in', 2, '1300.00'),
(489, '2025-2026/168', 596, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 15:33:06', '2025-08-11', '629', 168, 'demo@easyskool.in', 1, '1200.00'),
(490, '2025-2026/169', 615, 'Aug', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 15:33:25', '2025-08-12', '648', 169, 'demo@easyskool.in', 1, '1300.00'),
(491, '2025-2026/170', 593, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '200', '1000', '1200', '', '0.00', '1200', '200', '1000', '1000', '0.00', 'Online', '', '2025-11-09 15:33:45', '2025-08-19', '626', 170, 'demo@easyskool.in', 1, '1200.00'),
(492, '2025-2026/171', 587, 'Aug', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 15:34:11', '2025-08-19', '620', 171, 'demo@easyskool.in', 1, '1100.00'),
(493, '2025-2026/172', 620, 'Aug', '63', 'fees', 'Monthly Fee', '-100', '1300', '0', '1400', '1300', '', '0.00', '1300', '0', '1300', '1400', '-100.00', 'Online', '', '2025-11-09 15:34:34', '2025-08-20', '653', 172, 'demo@easyskool.in', 1, '1300.00'),
(494, '2025-2026/173', 588, 'Aug', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 15:34:56', '2025-08-20', '621', 173, 'demo@easyskool.in', 1, '1100.00'),
(495, '2025-2026/174', 598, 'Aug', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '66', '-466.00', '2000', '0', '2000', '2000', '0.00', 'Online', '', '2025-11-09 15:35:42', '2025-08-21', '631', 174, 'demo@easyskool.in', 2, '1200.00'),
(496, '2025-2026/174', 598, 'Sep', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '66', '-466.00', '2000', '0', '2000', '2000', '0.00', 'Online', '', '2025-11-09 15:35:42', '2025-08-21', '631', 174, 'demo@easyskool.in', 2, '1200.00'),
(497, '2025-2026/175', 602, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 15:35:58', '2025-08-22', '635', 175, 'demo@easyskool.in', 1, '1200.00'),
(498, '2025-2026/176', 599, 'Aug', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 15:36:22', '2025-08-23', '632', 176, 'demo@easyskool.in', 1, '1200.00'),
(499, '2025-2026/177', 597, 'Sep', '62', 'fees', 'Monthly Fee', '100', '1200', '100', '1000', '1200', '', '0.00', '1200', '100', '1100', '1000', '100.00', 'Online', '', '2025-11-09 15:36:57', '2025-08-29', '630', 177, 'demo@easyskool.in', 1, '1200.00'),
(500, '2025-2026/178', 573, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '500.00'),
(501, '2025-2026/178', 573, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(502, '2025-2026/178', 573, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(503, '2025-2026/178', 573, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(504, '2025-2026/178', 573, 'Aug', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(505, '2025-2026/178', 573, 'Sep', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(506, '2025-2026/178', 573, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '1000.00'),
(507, '2025-2026/178', 573, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(508, '2025-2026/178', 573, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(509, '2025-2026/178', 573, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(510, '2025-2026/178', 573, 'Aug', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(511, '2025-2026/178', 573, 'Sep', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(512, '2025-2026/178', 573, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '1000.00'),
(513, '2025-2026/178', 573, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(514, '2025-2026/178', 573, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(515, '2025-2026/178', 573, 'Jul', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(516, '2025-2026/178', 573, 'Aug', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(517, '2025-2026/178', 573, 'Sep', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '0'),
(518, '2025-2026/178', 573, 'Apr', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '1100.00'),
(519, '2025-2026/178', 573, 'May', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '1100.00'),
(520, '2025-2026/178', 573, 'Jun', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '1100.00'),
(521, '2025-2026/178', 573, 'Jul', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '1100.00'),
(522, '2025-2026/178', 573, 'Aug', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '1100.00'),
(523, '2025-2026/178', 573, 'Sep', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:37:48', '2025-08-29', '606', 178, 'demo@easyskool.in', 6, '1100.00'),
(524, '2025-2026/179', 569, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '500.00'),
(525, '2025-2026/179', 569, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(526, '2025-2026/179', 569, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(527, '2025-2026/179', 569, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(528, '2025-2026/179', 569, 'Aug', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(529, '2025-2026/179', 569, 'Sep', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(530, '2025-2026/179', 569, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '1000.00'),
(531, '2025-2026/179', 569, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(532, '2025-2026/179', 569, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(533, '2025-2026/179', 569, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(534, '2025-2026/179', 569, 'Aug', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(535, '2025-2026/179', 569, 'Sep', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(536, '2025-2026/179', 569, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '1000.00'),
(537, '2025-2026/179', 569, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(538, '2025-2026/179', 569, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(539, '2025-2026/179', 569, 'Jul', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(540, '2025-2026/179', 569, 'Aug', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(541, '2025-2026/179', 569, 'Sep', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '0'),
(542, '2025-2026/179', 569, 'Apr', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '1100.00'),
(543, '2025-2026/179', 569, 'May', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '1100.00'),
(544, '2025-2026/179', 569, 'Jun', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '1100.00'),
(545, '2025-2026/179', 569, 'Jul', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '1100.00'),
(546, '2025-2026/179', 569, 'Aug', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '1100.00'),
(547, '2025-2026/179', 569, 'Sep', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', 'Late Admission', '2025-11-09 15:38:39', '2025-08-29', '602', 179, 'demo@easyskool.in', 6, '1100.00'),
(548, '2025-2026/180', 616, 'Sep', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Cash', '', '2025-11-09 15:39:00', '2025-08-30', '649', 180, 'demo@easyskool.in', 1, '1300.00'),
(549, '2025-2026/181', 593, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '200', '1000', '1200', '', '0.00', '1200', '200', '1000', '1000', '0.00', 'Online', '', '2025-11-09 15:39:20', '2025-08-30', '626', 181, 'demo@easyskool.in', 1, '1200.00'),
(550, '2025-2026/182', 574, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '500.00'),
(551, '2025-2026/182', 574, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(552, '2025-2026/182', 574, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(553, '2025-2026/182', 574, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(554, '2025-2026/182', 574, 'Aug', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(555, '2025-2026/182', 574, 'Sep', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(556, '2025-2026/182', 574, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '1000.00'),
(557, '2025-2026/182', 574, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(558, '2025-2026/182', 574, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(559, '2025-2026/182', 574, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(560, '2025-2026/182', 574, 'Aug', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(561, '2025-2026/182', 574, 'Sep', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(562, '2025-2026/182', 574, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '1000.00'),
(563, '2025-2026/182', 574, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(564, '2025-2026/182', 574, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(565, '2025-2026/182', 574, 'Jul', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(566, '2025-2026/182', 574, 'Aug', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(567, '2025-2026/182', 574, 'Sep', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '0'),
(568, '2025-2026/182', 574, 'Apr', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '1100.00'),
(569, '2025-2026/182', 574, 'May', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '1100.00'),
(570, '2025-2026/182', 574, 'Jun', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '1100.00'),
(571, '2025-2026/182', 574, 'Jul', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '1100.00'),
(572, '2025-2026/182', 574, 'Aug', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '1100.00'),
(573, '2025-2026/182', 574, 'Sep', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:08', '2025-08-30', '607', 182, 'demo@easyskool.in', 6, '1100.00'),
(574, '2025-2026/183', 577, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '500.00'),
(575, '2025-2026/183', 577, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(576, '2025-2026/183', 577, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(577, '2025-2026/183', 577, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(578, '2025-2026/183', 577, 'Aug', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(579, '2025-2026/183', 577, 'Sep', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(580, '2025-2026/183', 577, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '1000.00'),
(581, '2025-2026/183', 577, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(582, '2025-2026/183', 577, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(583, '2025-2026/183', 577, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(584, '2025-2026/183', 577, 'Aug', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(585, '2025-2026/183', 577, 'Sep', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(586, '2025-2026/183', 577, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '1000.00'),
(587, '2025-2026/183', 577, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(588, '2025-2026/183', 577, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(589, '2025-2026/183', 577, 'Jul', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(590, '2025-2026/183', 577, 'Aug', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(591, '2025-2026/183', 577, 'Sep', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '0'),
(592, '2025-2026/183', 577, 'Apr', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '1100.00'),
(593, '2025-2026/183', 577, 'May', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '1100.00'),
(594, '2025-2026/183', 577, 'Jun', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '1100.00'),
(595, '2025-2026/183', 577, 'Jul', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '1100.00'),
(596, '2025-2026/183', 577, 'Aug', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '1100.00'),
(597, '2025-2026/183', 577, 'Sep', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '5500', '3600', '3600', '0.00', 'Online', '', '2025-11-09 15:40:38', '2025-09-01', '610', 183, 'demo@easyskool.in', 6, '1100.00'),
(598, '2025-2026/184', 608, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-09 15:40:59', '2025-09-02', '641', 184, 'demo@easyskool.in', 1, '1200.00'),
(599, '2025-2026/185', 626, 'Sep', '66', 'fees', 'Monthly Fee', '200', '1600', '0', '1400', '1600', '', '1600.00', '3200', '0', '3200', '3000', '200.00', 'Cash', '', '2025-11-09 15:42:05', '2025-09-03', '659', 185, 'demo@easyskool.in', 1, '1600.00'),
(600, '2025-2026/186', 589, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '500.00'),
(601, '2025-2026/186', 589, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(602, '2025-2026/186', 589, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(603, '2025-2026/186', 589, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(604, '2025-2026/186', 589, 'Aug', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(605, '2025-2026/186', 589, 'Sep', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(606, '2025-2026/186', 589, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '1000.00'),
(607, '2025-2026/186', 589, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(608, '2025-2026/186', 589, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(609, '2025-2026/186', 589, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(610, '2025-2026/186', 589, 'Aug', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(611, '2025-2026/186', 589, 'Sep', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(612, '2025-2026/186', 589, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '1000.00'),
(613, '2025-2026/186', 589, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(614, '2025-2026/186', 589, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(615, '2025-2026/186', 589, 'Jul', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(616, '2025-2026/186', 589, 'Aug', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(617, '2025-2026/186', 589, 'Sep', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '0'),
(618, '2025-2026/186', 589, 'Apr', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '1100.00'),
(619, '2025-2026/186', 589, 'May', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '1100.00'),
(620, '2025-2026/186', 589, 'Jun', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '1100.00'),
(621, '2025-2026/186', 589, 'Jul', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '1100.00'),
(622, '2025-2026/186', 589, 'Aug', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '1100.00'),
(623, '2025-2026/186', 589, 'Sep', '61', 'fees', 'Monthly Fee', '0', '6600', '5500', '1100', '9100', '', '0.00', '9100', '6500', '2600', '2600', '0.00', 'Online', '', '2025-11-09 15:43:26', '2025-09-03', '622', 186, 'demo@easyskool.in', 6, '1100.00'),
(624, '2025-2026/187', 607, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 15:43:51', '2025-09-06', '640', 187, 'demo@easyskool.in', 1, '1200.00'),
(625, '2025-2026/188', 613, 'Sep', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 15:44:09', '2025-09-06', '646', 188, 'demo@easyskool.in', 1, '1300.00'),
(626, '2025-2026/189', 617, 'Sep', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 15:44:31', '2025-09-08', '650', 189, 'demo@easyskool.in', 1, '1300.00'),
(627, '2025-2026/190', 579, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 15:44:49', '2025-09-08', '612', 190, 'demo@easyskool.in', 1, '1100.00'),
(628, '2025-2026/191', 601, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 15:45:03', '2025-09-08', '634', 191, 'demo@easyskool.in', 1, '1200.00'),
(629, '2025-2026/192', 576, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '100', '1000', '1100', '-2600', '2600.00', '1100', '100', '1000', '1000', '0.00', 'Online', '', '2025-11-09 15:46:31', '2025-09-08', '609', 192, 'demo@easyskool.in', 1, '1100.00'),
(630, '2025-2026/193', 585, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 15:46:54', '2025-09-08', '618', 193, 'demo@easyskool.in', 1, '1100.00'),
(631, '2025-2026/194', 629, 'Sep', '67', 'fees', 'Monthly Fee', '0', '1700', '500', '1200', '1700', '', '0.00', '1700', '500', '1200', '1200', '0.00', 'Cash', '', '2025-11-09 15:47:17', '2025-09-08', '662', 194, 'demo@easyskool.in', 1, '1700.00'),
(632, '2025-2026/195', 614, 'Sep', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-09 15:47:35', '2025-09-08', '647', 195, 'demo@easyskool.in', 1, '1300.00'),
(633, '2025-2026/196', 588, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 15:47:52', '2025-09-08', '621', 196, 'demo@easyskool.in', 1, '1100.00'),
(634, '2025-2026/197', 609, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 15:48:07', '2025-09-08', '642', 197, 'demo@easyskool.in', 1, '1200.00'),
(635, '2025-2026/198', 625, 'Sep', '65', 'fees', 'Monthly Fee', '0', '1500', '0', '1500', '1500', '', '0.00', '1500', '0', '1500', '1500', '0', 'Online', '', '2025-11-09 15:48:36', '2025-09-08', '658', 198, 'demo@easyskool.in', 1, '1500.00'),
(636, '2025-2026/199', 582, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-09 15:48:59', '2025-09-09', '615', 199, 'demo@easyskool.in', 1, '1100.00'),
(637, '2025-2026/200', 592, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-09 15:49:41', '2025-09-09', '625', 200, 'demo@easyskool.in', 1, '1200.00'),
(640, '2025-2026/203', 622, 'Sep', '64', 'fees', 'Monthly Fee', '0', '1400', '0', '1400', '1400', '', '0.00', '1400', '0', '1400', '1400', '0', 'Online', '', '2025-11-10 06:54:30', '2025-09-09', '655', 203, 'demo@easyskool.in', 1, '1400.00'),
(641, '2025-2026/204', 584, 'Jul', '61', 'fees', 'Monthly Fee', '0', '3300', '500', '2800', '3300', '', '300.00', '3600', '500', '3100', '3100', '0.00', 'Online', '', '2025-11-10 09:57:20', '2025-09-09', '617', 204, 'demo@easyskool.in', 3, '1100.00'),
(642, '2025-2026/204', 584, 'Aug', '61', 'fees', 'Monthly Fee', '0', '3300', '500', '2800', '3300', '', '300.00', '3600', '500', '3100', '3100', '0.00', 'Online', '', '2025-11-10 09:57:20', '2025-09-09', '617', 204, 'demo@easyskool.in', 3, '1100.00'),
(643, '2025-2026/204', 584, 'Sep', '61', 'fees', 'Monthly Fee', '0', '3300', '500', '2800', '3300', '', '300.00', '3600', '500', '3100', '3100', '0.00', 'Online', '', '2025-11-10 09:57:20', '2025-09-09', '617', 204, 'demo@easyskool.in', 3, '1100.00'),
(644, '2025-2026/205', 587, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 10:01:11', '2025-09-09', '620', 205, 'demo@easyskool.in', 1, '1100.00'),
(645, '2025-2026/206', 612, 'Sep', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-10 10:01:34', '2025-09-09', '645', 206, 'demo@easyskool.in', 1, '1300.00'),
(646, '2025-2026/207', 594, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:01:54', '2025-09-10', '627', 207, 'demo@easyskool.in', 1, '1200.00'),
(647, '2025-2026/208', 571, 'Aug', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 10:02:12', '2025-09-10', '604', 208, 'demo@easyskool.in', 2, '1100.00'),
(648, '2025-2026/208', 571, 'Sep', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 10:02:12', '2025-09-10', '604', 208, 'demo@easyskool.in', 2, '1100.00'),
(649, '2025-2026/209', 583, 'Jul', '61', 'fees', 'Monthly Fee', '0', '3300', '0', '3300', '3300', '', '-200.00', '3100', '0', '3100', '3100', '0', 'Cash', '', '2025-11-10 10:02:36', '2025-09-10', '616', 209, 'demo@easyskool.in', 3, '1100.00'),
(650, '2025-2026/209', 583, 'Aug', '61', 'fees', 'Monthly Fee', '0', '3300', '0', '3300', '3300', '', '-200.00', '3100', '0', '3100', '3100', '0', 'Cash', '', '2025-11-10 10:02:36', '2025-09-10', '616', 209, 'demo@easyskool.in', 3, '1100.00'),
(651, '2025-2026/209', 583, 'Sep', '61', 'fees', 'Monthly Fee', '0', '3300', '0', '3300', '3300', '', '-200.00', '3100', '0', '3100', '3100', '0', 'Cash', '', '2025-11-10 10:02:36', '2025-09-10', '616', 209, 'demo@easyskool.in', 3, '1100.00'),
(652, '2025-2026/210', 581, 'Aug', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-10 10:02:53', '2025-09-11', '614', 210, 'demo@easyskool.in', 2, '1100.00'),
(653, '2025-2026/210', 581, 'Sep', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-10 10:02:53', '2025-09-11', '614', 210, 'demo@easyskool.in', 2, '1100.00'),
(654, '2025-2026/211', 602, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:03:11', '2025-09-11', '635', 211, 'demo@easyskool.in', 1, '1200.00'),
(655, '2025-2026/212', 604, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:03:34', '2025-09-11', '637', 212, 'demo@easyskool.in', 1, '1200.00'),
(656, '2025-2026/213', 596, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:04:29', '2025-09-12', '629', 213, 'demo@easyskool.in', 1, '1200.00'),
(657, '2025-2026/214', 586, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-10 10:04:48', '2025-09-12', '619', 214, 'demo@easyskool.in', 1, '1100.00'),
(660, '2025-2026/217', 618, 'Aug', '63', 'fees', 'Monthly Fee', '0', '1300', '500', '800', '1300', '', '0.00', '1300', '500', '800', '800', '0.00', 'Online', '', '2025-11-10 10:06:07', '2025-09-12', '651', 217, 'demo@easyskool.in', 1, '1300.00'),
(661, '2025-2026/218', 599, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:06:30', '2025-09-12', '632', 218, 'demo@easyskool.in', 1, '1200.00'),
(662, '2025-2026/219', 575, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '2100.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-10 10:07:19', '2025-09-12', '608', 219, 'demo@easyskool.in', 1, '1100.00'),
(663, '2025-2026/220', 578, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '2100.00', '3200', '0', '3200', '3200', '0', 'Online', '', '2025-11-10 10:07:48', '2025-09-12', '611', 220, 'demo@easyskool.in', 1, '1100.00'),
(664, '2025-2026/221', 619, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '1500', '0', '5600', '', '0.00', '5600', '3000', '2600', '2600', '0.00', 'Online', '', '2025-11-10 10:19:45', '2025-09-13', '652', 221, 'demo@easyskool.in', 2, '1500.00'),
(665, '2025-2026/221', 619, 'May', '51', 'fees', 'Annual Fee', '0', '1500', '1500', '0', '5600', '', '0.00', '5600', '3000', '2600', '2600', '0.00', 'Online', '', '2025-11-10 10:19:45', '2025-09-13', '652', 221, 'demo@easyskool.in', 2, '0'),
(666, '2025-2026/221', 619, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '1500', '0', '5600', '', '0.00', '5600', '3000', '2600', '2600', '0.00', 'Online', '', '2025-11-10 10:19:45', '2025-09-13', '652', 221, 'demo@easyskool.in', 2, '1500.00'),
(667, '2025-2026/221', 619, 'May', '55', 'fees', 'Composite Fee', '0', '1500', '1500', '0', '5600', '', '0.00', '5600', '3000', '2600', '2600', '0.00', 'Online', '', '2025-11-10 10:19:45', '2025-09-13', '652', 221, 'demo@easyskool.in', 2, '0');
INSERT INTO `receipts` (`id`, `receipt_no`, `student_id`, `months`, `fee_head`, `fee_head_type`, `fee_head_name`, `balance_amount`, `total`, `rec_discount`, `rec_amount`, `fees_received`, `late_fees`, `ledger_amt`, `total_fees`, `discount_amt`, `net_fees`, `receipt_amt`, `balance_amt`, `mode`, `remarks`, `created_at`, `date_time`, `back_id`, `sr_no`, `create_by`, `total_month`, `month_total`) VALUES
(668, '2025-2026/221', 619, 'Apr', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '5600', '', '0.00', '5600', '3000', '2600', '2600', '0.00', 'Online', '', '2025-11-10 10:19:45', '2025-09-13', '652', 221, 'demo@easyskool.in', 2, '1300.00'),
(669, '2025-2026/221', 619, 'May', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '5600', '', '0.00', '5600', '3000', '2600', '2600', '0.00', 'Online', '', '2025-11-10 10:19:45', '2025-09-13', '652', 221, 'demo@easyskool.in', 2, '1300.00'),
(670, '2025-2026/222', 628, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '7900', '', '0.00', '7900', '4700', '3200', '2400', '800.00', 'Online', '', '2025-11-10 10:21:05', '2025-09-13', '661', 222, 'demo@easyskool.in', 2, '500.00'),
(671, '2025-2026/222', 628, 'May', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '7900', '', '0.00', '7900', '4700', '3200', '2400', '800.00', 'Online', '', '2025-11-10 10:21:05', '2025-09-13', '661', 222, 'demo@easyskool.in', 2, '0'),
(672, '2025-2026/222', 628, 'Apr', '52', 'fees', 'Annual Fee', '0', '2000', '2000', '0', '7900', '', '0.00', '7900', '4700', '3200', '2400', '800.00', 'Online', '', '2025-11-10 10:21:05', '2025-09-13', '661', 222, 'demo@easyskool.in', 2, '2000.00'),
(673, '2025-2026/222', 628, 'May', '52', 'fees', 'Annual Fee', '0', '2000', '2000', '0', '7900', '', '0.00', '7900', '4700', '3200', '2400', '800.00', 'Online', '', '2025-11-10 10:21:05', '2025-09-13', '661', 222, 'demo@easyskool.in', 2, '0'),
(674, '2025-2026/222', 628, 'Apr', '57', 'fees', 'Composite Fee', '0', '2200', '2200', '0', '7900', '', '0.00', '7900', '4700', '3200', '2400', '800.00', 'Online', '', '2025-11-10 10:21:05', '2025-09-13', '661', 222, 'demo@easyskool.in', 2, '2200.00'),
(675, '2025-2026/222', 628, 'May', '57', 'fees', 'Composite Fee', '0', '2200', '2200', '0', '7900', '', '0.00', '7900', '4700', '3200', '2400', '800.00', 'Online', '', '2025-11-10 10:21:05', '2025-09-13', '661', 222, 'demo@easyskool.in', 2, '0'),
(676, '2025-2026/222', 628, 'Apr', '66', 'fees', 'Monthly Fee', '800', '3200', '0', '2400', '7900', '', '0.00', '7900', '4700', '3200', '2400', '800.00', 'Online', '', '2025-11-10 10:21:05', '2025-09-13', '661', 222, 'demo@easyskool.in', 2, '1600.00'),
(677, '2025-2026/222', 628, 'May', '66', 'fees', 'Monthly Fee', '800', '3200', '0', '2400', '7900', '', '0.00', '7900', '4700', '3200', '2400', '800.00', 'Online', '', '2025-11-10 10:21:05', '2025-09-13', '661', 222, 'demo@easyskool.in', 2, '1600.00'),
(678, '2025-2026/223', 605, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:21:35', '2025-09-17', '638', 223, 'demo@easyskool.in', 1, '1200.00'),
(679, '2025-2026/224', 580, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '100', '100.00', '1300', '0', '1300', '1300', '0.00', 'Online', '', '2025-11-10 10:27:02', '2025-09-17', '613', 224, 'demo@easyskool.in', 1, '1100.00'),
(680, '2025-2026/225', 627, 'Aug', '66', 'fees', 'Monthly Fee', '0', '3200', '0', '3200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-10 10:28:46', '2025-09-18', '660', 225, 'demo@easyskool.in', 2, '1600.00'),
(681, '2025-2026/225', 627, 'Sep', '66', 'fees', 'Monthly Fee', '0', '3200', '0', '3200', '3200', '', '0.00', '3200', '0', '3200', '3200', '0', 'Cash', '', '2025-11-10 10:28:46', '2025-09-18', '660', 225, 'demo@easyskool.in', 2, '1600.00'),
(682, '2025-2026/226', 611, 'Sep', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-10 10:29:19', '2025-09-27', '644', 226, 'demo@easyskool.in', 1, '1300.00'),
(683, '2025-2026/227', 616, 'Oct', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-10 10:29:39', '2025-09-27', '649', 227, 'demo@easyskool.in', 1, '1300.00'),
(684, '2025-2026/228', 570, 'Oct', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 10:30:01', '2025-10-01', '603', 228, 'demo@easyskool.in', 1, '1100.00'),
(686, '2025-2026/230', 601, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-10 10:30:40', '2025-10-01', '634', 230, 'demo@easyskool.in', 1, '1200.00'),
(687, '2025-2026/231', 603, 'Sep', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-10 10:31:11', '2025-10-03', '636', 231, 'demo@easyskool.in', 2, '1200.00'),
(688, '2025-2026/231', 603, 'Oct', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-10 10:31:11', '2025-10-03', '636', 231, 'demo@easyskool.in', 2, '1200.00'),
(689, '2025-2026/232', 586, 'Oct', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-10 10:31:35', '2025-10-03', '619', 232, 'demo@easyskool.in', 1, '1100.00'),
(690, '2025-2026/233', 607, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-10 10:31:59', '2025-10-03', '640', 233, 'demo@easyskool.in', 1, '1200.00'),
(691, '2025-2026/234', 613, 'Oct', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-10 10:33:07', '2025-10-03', '646', 234, 'demo@easyskool.in', 1, '1300.00'),
(692, '2025-2026/235', 625, 'Oct', '65', 'fees', 'Monthly Fee', '0', '1500', '0', '1500', '1500', '', '0.00', '1500', '0', '1500', '1500', '0', 'Online', '', '2025-11-10 10:38:20', '2025-10-04', '658', 235, 'demo@easyskool.in', 1, '1500.00'),
(693, '2025-2026/236', 577, 'Oct', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 10:38:49', '2025-10-04', '610', 236, 'demo@easyskool.in', 1, '1100.00'),
(694, '2025-2026/237', 604, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-10 10:39:24', '2025-10-04', '637', 237, 'demo@easyskool.in', 1, '1200.00'),
(695, '2025-2026/238', 626, 'Oct', '66', 'fees', 'Monthly Fee', '0', '1600', '0', '1600', '1600', '', '0.00', '1600', '0', '1600', '1600', '0', 'Cash', '', '2025-11-10 10:41:31', '2025-10-04', '659', 238, 'demo@easyskool.in', 1, '1600.00'),
(696, '2025-2026/239', 598, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:42:01', '2025-10-04', '631', 239, 'demo@easyskool.in', 1, '1200.00'),
(697, '2025-2026/240', 612, 'Oct', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-10 10:42:41', '2025-10-06', '645', 240, 'demo@easyskool.in', 1, '1300.00'),
(698, '2025-2026/241', 592, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:43:09', '2025-10-06', '625', 241, 'demo@easyskool.in', 1, '1200.00'),
(699, '2025-2026/242', 584, 'Oct', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 10:43:32', '2025-10-06', '617', 242, 'demo@easyskool.in', 1, '1100.00'),
(700, '2025-2026/243', 587, 'Oct', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 10:44:17', '2025-10-06', '620', 243, 'demo@easyskool.in', 1, '1100.00'),
(701, '2025-2026/244', 609, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:45:05', '2025-10-06', '642', 244, 'demo@easyskool.in', 1, '1200.00'),
(702, '2025-2026/245', 588, 'Oct', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-10 10:45:40', '2025-10-08', '621', 245, 'demo@easyskool.in', 1, '1100.00'),
(703, '2025-2026/246', 574, 'Oct', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 10:46:09', '2025-10-08', '607', 246, 'demo@easyskool.in', 1, '1100.00'),
(704, '2025-2026/247', 600, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-10 10:46:45', '2025-10-08', '633', 247, 'demo@easyskool.in', 1, '1200.00'),
(705, '2025-2026/248', 629, 'Oct', '67', 'fees', 'Monthly Fee', '0', '1700', '500', '1200', '1700', '', '0.00', '1700', '500', '1200', '1200', '0.00', 'Cash', '', '2025-11-10 10:47:57', '2025-10-08', '662', 248, 'demo@easyskool.in', 1, '1700.00'),
(706, '2025-2026/249', 608, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:48:26', '2025-10-09', '641', 249, 'demo@easyskool.in', 1, '1200.00'),
(707, '2025-2026/250', 593, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '200', '1000', '1200', '', '0.00', '1200', '200', '1000', '1000', '0.00', 'Online', '', '2025-11-10 10:49:08', '2025-10-09', '626', 250, 'demo@easyskool.in', 1, '1200.00'),
(709, '2025-2026/252', 618, 'Sep', '63', 'fees', 'Monthly Fee', '0', '1300', '500', '800', '1300', '', '0.00', '1300', '500', '800', '800', '0.00', 'Online', '', '2025-11-10 10:51:21', '2025-10-09', '651', 252, 'demo@easyskool.in', 1, '1300.00'),
(710, '2025-2026/253', 599, 'Oct', '62', 'fees', 'Monthly Fee', '100', '1200', '0', '1100', '1200', '', '0.00', '1200', '0', '1200', '1100', '100.00', 'Online', '', '2025-11-10 10:52:30', '2025-10-09', '632', 253, 'demo@easyskool.in', 1, '1200.00'),
(711, '2025-2026/254', 579, 'Oct', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-10 10:53:02', '2025-10-09', '612', 254, 'demo@easyskool.in', 1, '1100.00'),
(712, '2025-2026/255', 617, 'Oct', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-10 10:53:38', '2025-10-09', '650', 255, 'demo@easyskool.in', 1, '1300.00'),
(713, '2025-2026/256', 569, 'Oct', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 10:54:07', '2025-10-10', '602', 256, 'demo@easyskool.in', 1, '1100.00'),
(714, '2025-2026/257', 622, 'Oct', '64', 'fees', 'Monthly Fee', '0', '1400', '0', '1400', '1400', '', '0.00', '1400', '0', '1400', '1400', '0', 'Online', '', '2025-11-10 10:54:34', '2025-10-10', '655', 257, 'demo@easyskool.in', 1, '1400.00'),
(715, '2025-2026/258', 596, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:55:12', '2025-10-13', '629', 258, 'demo@easyskool.in', 1, '1200.00'),
(716, '2025-2026/259', 594, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 10:55:36', '2025-10-13', '627', 259, 'demo@easyskool.in', 1, '1200.00'),
(717, '2025-2026/260', 590, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '500.00'),
(718, '2025-2026/260', 590, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(719, '2025-2026/260', 590, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(720, '2025-2026/260', 590, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(721, '2025-2026/260', 590, 'Aug', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(722, '2025-2026/260', 590, 'Sep', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(723, '2025-2026/260', 590, 'Oct', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(724, '2025-2026/260', 590, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '1000.00'),
(725, '2025-2026/260', 590, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(726, '2025-2026/260', 590, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(727, '2025-2026/260', 590, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(728, '2025-2026/260', 590, 'Aug', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(729, '2025-2026/260', 590, 'Sep', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(730, '2025-2026/260', 590, 'Oct', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(731, '2025-2026/260', 590, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '1000.00'),
(732, '2025-2026/260', 590, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(733, '2025-2026/260', 590, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(734, '2025-2026/260', 590, 'Jul', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(735, '2025-2026/260', 590, 'Aug', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(736, '2025-2026/260', 590, 'Sep', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(737, '2025-2026/260', 590, 'Oct', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '0'),
(738, '2025-2026/260', 590, 'Apr', '61', 'fees', 'Monthly Fee', '0', '7700', '6600', '1100', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '1100.00'),
(739, '2025-2026/260', 590, 'May', '61', 'fees', 'Monthly Fee', '0', '7700', '6600', '1100', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '1100.00'),
(740, '2025-2026/260', 590, 'Jun', '61', 'fees', 'Monthly Fee', '0', '7700', '6600', '1100', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '1100.00'),
(741, '2025-2026/260', 590, 'Jul', '61', 'fees', 'Monthly Fee', '0', '7700', '6600', '1100', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '1100.00'),
(742, '2025-2026/260', 590, 'Aug', '61', 'fees', 'Monthly Fee', '0', '7700', '6600', '1100', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '1100.00'),
(743, '2025-2026/260', 590, 'Sep', '61', 'fees', 'Monthly Fee', '0', '7700', '6600', '1100', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '1100.00'),
(744, '2025-2026/260', 590, 'Oct', '61', 'fees', 'Monthly Fee', '0', '7700', '6600', '1100', '10200', '', '0.00', '10200', '6600', '3600', '3600', '0.00', 'Online', '', '2025-11-10 11:00:29', '2025-10-14', '623', 260, 'demo@easyskool.in', 7, '1100.00'),
(748, '2025-2026/262', 610, 'Sep', '63', 'fees', 'Monthly Fee', '0', '3900', '0', '3900', '3900', '', '0.00', '3900', '0', '3900', '3900', '0', 'Online', '', '2025-11-10 11:05:33', '2025-10-16', '643', 262, 'demo@easyskool.in', 3, '1300.00'),
(749, '2025-2026/262', 610, 'Oct', '63', 'fees', 'Monthly Fee', '0', '3900', '0', '3900', '3900', '', '0.00', '3900', '0', '3900', '3900', '0', 'Online', '', '2025-11-10 11:05:33', '2025-10-16', '643', 262, 'demo@easyskool.in', 3, '1300.00'),
(750, '2025-2026/262', 610, 'Nov', '63', 'fees', 'Monthly Fee', '0', '3900', '0', '3900', '3900', '', '0.00', '3900', '0', '3900', '3900', '0', 'Online', '', '2025-11-10 11:05:33', '2025-10-16', '643', 262, 'demo@easyskool.in', 3, '1300.00'),
(751, '2025-2026/263', 582, 'Oct', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 11:06:32', '2025-10-17', '615', 263, 'demo@easyskool.in', 2, '1100.00'),
(752, '2025-2026/263', 582, 'Nov', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 11:06:32', '2025-10-17', '615', 263, 'demo@easyskool.in', 2, '1100.00'),
(753, '2025-2026/264', 597, 'Oct', '62', 'fees', 'Monthly Fee', '0', '1200', '100', '1100', '1200', '', '0.00', '1200', '100', '1100', '1100', '0.00', 'Cash', '', '2025-11-10 11:07:20', '2025-10-17', '630', 264, 'demo@easyskool.in', 1, '1200.00'),
(754, '2025-2026/265', 598, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 11:08:17', '2025-10-18', '631', 265, 'demo@easyskool.in', 1, '1200.00'),
(755, '2025-2026/266', 581, 'Oct', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-10 11:09:00', '2025-10-27', '614', 266, 'demo@easyskool.in', 2, '1100.00'),
(756, '2025-2026/266', 581, 'Nov', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-10 11:09:00', '2025-10-27', '614', 266, 'demo@easyskool.in', 2, '1100.00'),
(757, '2025-2026/267', 573, 'Oct', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 11:09:57', '2025-10-30', '606', 267, 'demo@easyskool.in', 2, '1100.00'),
(758, '2025-2026/267', 573, 'Nov', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 11:09:57', '2025-10-30', '606', 267, 'demo@easyskool.in', 2, '1100.00'),
(759, '2025-2026/268', 602, 'Oct', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-10 11:11:13', '2025-10-30', '635', 268, 'demo@easyskool.in', 2, '1200.00'),
(760, '2025-2026/268', 602, 'Nov', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Online', '', '2025-11-10 11:11:13', '2025-10-30', '635', 268, 'demo@easyskool.in', 2, '1200.00'),
(761, '2025-2026/269', 626, 'Nov', '66', 'fees', 'Monthly Fee', '0', '1600', '0', '1600', '1600', '', '0.00', '1600', '0', '1600', '1600', '0', 'Cash', '', '2025-11-10 11:14:16', '2025-10-30', '659', 269, 'demo@easyskool.in', 1, '1600.00'),
(762, '2025-2026/270', 616, 'Nov', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Cash', '', '2025-11-10 11:16:08', '2025-10-31', '649', 270, 'demo@easyskool.in', 1, '1300.00'),
(763, '2025-2026/271', 570, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 11:17:56', '2025-11-01', '603', 271, 'demo@easyskool.in', 1, '1100.00'),
(764, '2025-2026/272', 613, 'Nov', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-10 11:19:37', '2025-11-01', '646', 272, 'demo@easyskool.in', 1, '1300.00'),
(765, '2025-2026/273', 617, 'Nov', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-10 11:21:16', '2025-11-03', '650', 273, 'demo@easyskool.in', 1, '1300.00'),
(766, '2025-2026/274', 579, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-10 11:24:00', '2025-11-03', '612', 274, 'demo@easyskool.in', 1, '1100.00'),
(768, '2025-2026/276', 580, 'Oct', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-10 11:26:47', '2025-11-03', '613', 276, 'demo@easyskool.in', 2, '1100.00'),
(769, '2025-2026/276', 580, 'Nov', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-10 11:26:47', '2025-11-03', '613', 276, 'demo@easyskool.in', 2, '1100.00'),
(770, '2025-2026/277', 605, 'Oct', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Cash', '', '2025-11-10 11:27:25', '2025-11-03', '638', 277, 'demo@easyskool.in', 2, '1200.00'),
(771, '2025-2026/277', 605, 'Nov', '62', 'fees', 'Monthly Fee', '0', '2400', '0', '2400', '2400', '', '0.00', '2400', '0', '2400', '2400', '0', 'Cash', '', '2025-11-10 11:27:25', '2025-11-03', '638', 277, 'demo@easyskool.in', 2, '1200.00'),
(772, '2025-2026/278', 625, 'Nov', '65', 'fees', 'Monthly Fee', '0', '1500', '0', '1500', '1500', '', '0.00', '1500', '0', '1500', '1500', '0', 'Online', '', '2025-11-10 11:27:57', '2025-11-03', '658', 278, 'demo@easyskool.in', 1, '1500.00'),
(773, '2025-2026/279', 622, 'Nov', '64', 'fees', 'Monthly Fee', '0', '1400', '0', '1400', '1400', '', '0.00', '1400', '0', '1400', '1400', '0', 'Online', '', '2025-11-10 11:28:33', '2025-11-03', '655', 279, 'demo@easyskool.in', 1, '1400.00'),
(774, '2025-2026/280', 609, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-10 11:29:21', '2025-11-03', '642', 280, 'demo@easyskool.in', 1, '1200.00'),
(775, '2025-2026/281', 587, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-10 11:30:22', '2025-11-04', '620', 281, 'demo@easyskool.in', 1, '1100.00'),
(776, '2025-2026/282', 607, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 11:30:55', '2025-11-04', '640', 282, 'demo@easyskool.in', 1, '1200.00'),
(777, '2025-2026/283', 614, 'Nov', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Cash', '', '2025-11-10 11:31:25', '2025-11-04', '647', 283, 'demo@easyskool.in', 1, '1300.00'),
(778, '2025-2026/284', 586, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-10 11:31:52', '2025-11-04', '619', 284, 'demo@easyskool.in', 1, '1100.00'),
(779, '2025-2026/285', 629, 'Nov', '67', 'fees', 'Monthly Fee', '0', '1700', '500', '1200', '1700', '', '0.00', '1700', '500', '1200', '1200', '0.00', 'Cash', '', '2025-11-10 11:32:39', '2025-11-04', '662', 285, 'demo@easyskool.in', 1, '1700.00'),
(780, '2025-2026/286', 611, 'Oct', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Online', '', '2025-11-10 11:33:41', '2025-11-04', '644', 286, 'demo@easyskool.in', 2, '1300.00'),
(781, '2025-2026/286', 611, 'Nov', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Online', '', '2025-11-10 11:33:41', '2025-11-04', '644', 286, 'demo@easyskool.in', 2, '1300.00'),
(782, '2025-2026/287', 592, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 11:34:26', '2025-11-04', '625', 287, 'demo@easyskool.in', 1, '1200.00'),
(815, '2025-2026/289', 584, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 11:36:43', '2025-11-04', '617', 289, 'demo@easyskool.in', 1, '1100.00'),
(816, '2025-2026/290', 588, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 11:37:41', '2025-11-06', '621', 290, 'demo@easyskool.in', 1, '1100.00'),
(817, '2025-2026/291', 627, 'Oct', '66', 'fees', 'Monthly Fee', '0', '1600', '0', '1600', '1600', '', '0.00', '1600', '0', '1600', '1600', '0', 'Cash', '', '2025-11-10 11:38:30', '2025-11-06', '660', 291, 'demo@easyskool.in', 1, '1600.00'),
(818, '2025-2026/292', 612, 'Nov', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-10 11:39:07', '2025-11-06', '645', 292, 'demo@easyskool.in', 1, '1300.00'),
(819, '2025-2026/293', 593, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '200', '1000', '1200', '', '0.00', '1200', '200', '1000', '1000', '0.00', 'Online', '', '2025-11-10 11:39:58', '2025-11-06', '626', 293, 'demo@easyskool.in', 1, '1200.00'),
(820, '2025-2026/294', 578, 'Oct', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 11:40:29', '2025-11-06', '611', 294, 'demo@easyskool.in', 2, '1100.00'),
(821, '2025-2026/294', 578, 'Nov', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 11:40:29', '2025-11-06', '611', 294, 'demo@easyskool.in', 2, '1100.00'),
(822, '2025-2026/295', 575, 'Oct', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 11:40:48', '2025-11-06', '608', 295, 'demo@easyskool.in', 2, '1100.00'),
(823, '2025-2026/295', 575, 'Nov', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 11:40:48', '2025-11-06', '608', 295, 'demo@easyskool.in', 2, '1100.00'),
(824, '2025-2026/296', 596, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 11:41:13', '2025-11-06', '629', 296, 'demo@easyskool.in', 1, '1200.00'),
(825, '2025-2026/297', 590, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 11:41:38', '2025-11-06', '623', 297, 'demo@easyskool.in', 1, '1100.00'),
(826, '2025-2026/298', 571, 'Oct', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 11:42:04', '2025-11-06', '604', 298, 'demo@easyskool.in', 2, '1100.00'),
(827, '2025-2026/298', 571, 'Nov', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Online', '', '2025-11-10 11:42:04', '2025-11-06', '604', 298, 'demo@easyskool.in', 2, '1100.00'),
(828, '2025-2026/299', 569, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 11:42:28', '2025-11-07', '602', 299, 'demo@easyskool.in', 1, '1100.00'),
(829, '2025-2026/300', 574, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 11:42:47', '2025-11-07', '607', 300, 'demo@easyskool.in', 1, '1100.00'),
(830, '2025-2026/301', 608, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-10 11:43:07', '2025-11-07', '641', 301, 'demo@easyskool.in', 1, '1200.00'),
(831, '2025-2026/302', 577, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-10 11:43:30', '2025-11-07', '610', 302, 'demo@easyskool.in', 1, '1100.00'),
(832, '2025-2026/303', 583, 'Oct', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-10 11:43:54', '2025-11-07', '616', 303, 'demo@easyskool.in', 2, '1100.00'),
(833, '2025-2026/303', 583, 'Nov', '61', 'fees', 'Monthly Fee', '0', '2200', '0', '2200', '2200', '', '0.00', '2200', '0', '2200', '2200', '0', 'Cash', '', '2025-11-10 11:43:54', '2025-11-07', '616', 303, 'demo@easyskool.in', 2, '1100.00'),
(834, '2025-2026/304', 600, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-10 11:44:17', '2025-11-10', '633', 304, 'demo@easyskool.in', 1, '1200.00'),
(835, '2025-2026/305', 594, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-10 11:44:48', '2025-11-10', '627', 305, 'demo@easyskool.in', 1, '1200.00'),
(836, '2025-2026/306', 572, 'Nov', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Cash', '', '2025-11-11 08:02:16', '2025-11-11', '605', 306, 'demo@easyskool.in', 1, '1100.00'),
(837, '2025-2026/307', 604, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-13 04:06:31', '2025-11-12', '637', 307, 'demo@easyskool.in', 1, '1200.00'),
(838, '2025-2026/26', 615, 'Apr', '51', 'fees', 'Annual Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Online', '', '2025-11-13 08:25:05', '2025-04-11', '648', NULL, 'demo@easyskool.in', 1, '1500.00'),
(839, '2025-2026/26', 615, 'Apr', '55', 'fees', 'Composite Fee', '0', '1500', '0', '1500', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Online', '', '2025-11-13 08:25:05', '2025-04-11', '648', NULL, 'demo@easyskool.in', 1, '1500.00'),
(840, '2025-2026/26', 615, 'Apr', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '4300', '', '0.00', '4300', '0', '4300', '4300', '0', 'Online', '', '2025-11-13 08:25:05', '2025-04-11', '648', NULL, 'demo@easyskool.in', 1, '1300.00'),
(841, '2025-2026/38', 585, '', '', '', 'Ledger Amount', '1100.00', '1100.00', '0', '1100', '1100.00', '', '0.00', '1100', '0', '1100', '1100.00', '0', 'Online', 'April Month Fee', '2025-11-13 08:26:37', '2025-04-21', '618', 1, 'demo@easyskool.in', NULL, NULL),
(842, '2025-2026/55', 617, 'May', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Online', '', '2025-11-13 08:27:33', '2025-05-03', '650', 2, 'demo@easyskool.in', 2, '1300.00'),
(843, '2025-2026/55', 617, 'Jun', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Online', '', '2025-11-13 08:27:33', '2025-05-03', '650', 2, 'demo@easyskool.in', 2, '1300.00'),
(844, '2025-2026/116', 626, 'Jun', '66', 'fees', 'Monthly Fee', '-200', '1600', '0', '1800', '1600', '', '200.00', '1800', '0', '1800', '2000', '-200', 'Online', '', '2025-11-13 08:27:53', '2025-07-08', '659', 3, 'demo@easyskool.in', 1, '1600.00'),
(845, '2025-2026/129', 624, 'Jun', '65', 'fees', 'Monthly Fee', '0', '3000', '1500', '1500', '3000', '', '0.00', '3000', '1500', '1500', '1500', '0', 'Online', '', '2025-11-13 08:28:20', '2025-07-14', '657', 4, 'demo@easyskool.in', 2, '1500.00'),
(846, '2025-2026/129', 624, 'Jul', '65', 'fees', 'Monthly Fee', '0', '3000', '1500', '1500', '3000', '', '0.00', '3000', '1500', '1500', '1500', '0', 'Online', '', '2025-11-13 08:28:20', '2025-07-14', '657', 4, 'demo@easyskool.in', 2, '1500.00'),
(847, '2025-2026/201', 606, 'Sep', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-13 08:28:39', '2025-09-09', '639', 5, 'demo@easyskool.in', 1, '1200.00'),
(848, '2025-2026/215', 597, '', '', '', 'Ledger Amount', '100.00', '100.00', '0', '100', '100.00', '', '0.00', '100', '0', '100', '100.00', '0', 'Cash', '', '2025-11-13 08:29:03', '2025-09-12', '630', 6, 'demo@easyskool.in', NULL, NULL),
(849, '2025-2026/216', 624, 'Sep', '65', 'fees', 'Monthly Fee', '0', '1500', '300', '1200', '1500', '', '0.00', '1500', '300', '1200', '1200', '0', 'Cash', '', '2025-11-13 08:29:24', '2025-09-12', '657', 7, 'demo@easyskool.in', 1, '1500.00'),
(850, '2025-2026/229', 614, 'Oct', '63', 'fees', 'Monthly Fee', '0', '1300', '0', '1300', '1300', '', '0.00', '1300', '0', '1300', '1300', '0', 'Cash', '', '2025-11-13 08:29:49', '2025-10-01', '647', 8, 'demo@easyskool.in', 1, '1300.00'),
(851, '2025-2026/251', 624, 'Oct', '65', 'fees', 'Monthly Fee', '0', '1500', '300', '1200', '1500', '', '0.00', '1500', '300', '1200', '1200', '0', 'Online', '', '2025-11-13 08:30:07', '2025-10-09', '657', 9, 'demo@easyskool.in', 1, '1500.00'),
(852, '2025-2026/261', 572, 'Aug', '61', 'fees', 'Monthly Fee', '0', '3300', '1100', '2200', '3300', '', '0.00', '3300', '1100', '2200', '2200', '0', 'Online', '', '2025-11-13 08:30:26', '2025-10-15', '605', 10, 'demo@easyskool.in', 3, '1100.00'),
(853, '2025-2026/261', 572, 'Sep', '61', 'fees', 'Monthly Fee', '0', '3300', '1100', '2200', '3300', '', '0.00', '3300', '1100', '2200', '2200', '0', 'Online', '', '2025-11-13 08:30:26', '2025-10-15', '605', 10, 'demo@easyskool.in', 3, '1100.00'),
(854, '2025-2026/261', 572, 'Oct', '61', 'fees', 'Monthly Fee', '0', '3300', '1100', '2200', '3300', '', '0.00', '3300', '1100', '2200', '2200', '0', 'Online', '', '2025-11-13 08:30:26', '2025-10-15', '605', 10, 'demo@easyskool.in', 3, '1100.00'),
(855, '2025-2026/275', 601, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Cash', '', '2025-11-13 08:30:47', '2025-11-03', '634', 11, 'demo@easyskool.in', 1, '1200.00'),
(856, '2025-2026/288', 591, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '500.00'),
(857, '2025-2026/288', 591, 'May', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(858, '2025-2026/288', 591, 'Jun', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(859, '2025-2026/288', 591, 'Jul', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(860, '2025-2026/288', 591, 'Aug', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(861, '2025-2026/288', 591, 'Sep', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(862, '2025-2026/288', 591, 'Oct', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(863, '2025-2026/288', 591, 'Nov', '49', 'fees', 'Registration Fee', '0', '500', '0', '500', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(864, '2025-2026/288', 591, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '1000.00'),
(865, '2025-2026/288', 591, 'May', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(866, '2025-2026/288', 591, 'Jun', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(867, '2025-2026/288', 591, 'Jul', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(868, '2025-2026/288', 591, 'Aug', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(869, '2025-2026/288', 591, 'Sep', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(870, '2025-2026/288', 591, 'Oct', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(871, '2025-2026/288', 591, 'Nov', '50', 'fees', 'Annual Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(872, '2025-2026/288', 591, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '1000.00'),
(873, '2025-2026/288', 591, 'May', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(874, '2025-2026/288', 591, 'Jun', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(875, '2025-2026/288', 591, 'Jul', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(876, '2025-2026/288', 591, 'Aug', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(877, '2025-2026/288', 591, 'Sep', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(878, '2025-2026/288', 591, 'Oct', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(879, '2025-2026/288', 591, 'Nov', '54', 'fees', 'Composite Fee', '0', '1000', '0', '1000', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '0'),
(880, '2025-2026/288', 591, 'Apr', '61', 'fees', 'Monthly Fee', '0', '8800', '7700', '1100', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '1100.00'),
(881, '2025-2026/288', 591, 'May', '61', 'fees', 'Monthly Fee', '0', '8800', '7700', '1100', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '1100.00'),
(882, '2025-2026/288', 591, 'Jun', '61', 'fees', 'Monthly Fee', '0', '8800', '7700', '1100', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '1100.00'),
(883, '2025-2026/288', 591, 'Jul', '61', 'fees', 'Monthly Fee', '0', '8800', '7700', '1100', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '1100.00'),
(884, '2025-2026/288', 591, 'Aug', '61', 'fees', 'Monthly Fee', '0', '8800', '7700', '1100', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '1100.00'),
(885, '2025-2026/288', 591, 'Sep', '61', 'fees', 'Monthly Fee', '0', '8800', '7700', '1100', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '1100.00'),
(886, '2025-2026/288', 591, 'Oct', '61', 'fees', 'Monthly Fee', '0', '8800', '7700', '1100', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '1100.00'),
(887, '2025-2026/288', 591, 'Nov', '61', 'fees', 'Monthly Fee', '0', '8800', '7700', '1100', '11300', '', '0.00', '11300', '7700', '3600', '3600', '0', 'Online', '', '2025-11-13 08:31:11', '2025-11-04', '624', 12, 'demo@easyskool.in', 8, '1100.00'),
(888, '2025-2026/24', 585, 'Apr', '49', 'fees', 'Registration Fee', '0', '500', '500', '0', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Online', '', '2025-11-13 08:32:28', '2025-04-11', '618', 13, 'demo@easyskool.in', 1, '500.00'),
(889, '2025-2026/24', 585, 'Apr', '50', 'fees', 'Annual Fee', '0', '1000', '1000', '0', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Online', '', '2025-11-13 08:32:28', '2025-04-11', '618', 13, 'demo@easyskool.in', 1, '1000.00'),
(890, '2025-2026/24', 585, 'Apr', '54', 'fees', 'Composite Fee', '0', '1000', '1000', '0', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Online', '', '2025-11-13 08:32:28', '2025-04-11', '618', 13, 'demo@easyskool.in', 1, '1000.00'),
(891, '2025-2026/24', 585, 'Apr', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '3600', '', '0.00', '3600', '2500', '1100', '1100', '0.00', 'Online', '', '2025-11-13 08:32:28', '2025-04-11', '618', 13, 'demo@easyskool.in', 1, '1100.00'),
(892, '2025-2026/121', 597, 'Jul', '62', 'fees', 'Monthly Fee', '0', '1200', '100', '1100', '1200', '', '0.00', '1200', '100', '1100', '1100', '0.00', 'Cash', '', '2025-11-13 08:33:47', '2025-07-11', '630', 14, 'demo@easyskool.in', 1, '1200.00'),
(893, '2025-2026/148', 626, 'Jul', '66', 'fees', 'Monthly Fee', '1600', '3200', '0', '1600', '3200', '200', '-200.00', '3200', '0', '3200', '1600', '1600.00', 'Cash', '', '2025-11-13 08:52:21', '2025-08-04', '659', 15, 'demo@easyskool.in', 2, '1600.00'),
(894, '2025-2026/148', 626, 'Aug', '66', 'fees', 'Monthly Fee', '1600', '3200', '0', '1600', '3200', '200', '-200.00', '3200', '0', '3200', '1600', '1600.00', 'Cash', '', '2025-11-13 08:52:21', '2025-08-04', '659', 15, 'demo@easyskool.in', 2, '1600.00'),
(895, '2025-2026/154', 580, 'Jul', '61', 'fees', 'Monthly Fee', '200', '2200', '0', '2000', '2200', '', '100.00', '2300', '0', '2300', '2100', '200.00', 'Online', '', '2025-11-13 08:56:19', '2025-08-05', '613', 16, 'demo@easyskool.in', 2, '1100.00'),
(896, '2025-2026/154', 580, 'Aug', '61', 'fees', 'Monthly Fee', '200', '2200', '0', '2000', '2200', '', '100.00', '2300', '0', '2300', '2100', '200.00', 'Online', '', '2025-11-13 08:56:19', '2025-08-05', '613', 16, 'demo@easyskool.in', 2, '1100.00'),
(897, '2025-2026/202', 570, 'Sep', '61', 'fees', 'Monthly Fee', '0', '1100', '0', '1100', '1100', '', '0.00', '1100', '0', '1100', '1100', '0', 'Online', '', '2025-11-13 08:58:29', '2025-09-09', '603', 17, 'demo@easyskool.in', 1, '1100.00'),
(898, '2025-2026/308', 598, 'Dec', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '0.00', '1200', '0', '1200', '1200', '0', 'Online', '', '2025-11-19 03:42:14', '2025-11-15', '631', 308, 'demo@easyskool.in', 1, '1200.00'),
(899, '2025-2026/309', 599, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '0', '1200', '1200', '', '100.00', '1300', '0', '1300', '1300', '0', 'Online', '', '2025-11-19 03:43:39', '2025-11-19', '632', 309, 'demo@easyskool.in', 1, '1200.00'),
(901, '2025-2026/310', 628, 'Jun', '66', 'fees', 'Monthly Fee', '0', '1600', '0', '1600', '1600', '', '800.00', '2400', '0', '2400', '2400', '0', 'Cash', '', '2025-11-19 03:51:04', '2025-11-19', '661', 310, 'demo@easyskool.in', 1, '1600.00'),
(902, '2025-2026/311', 619, 'Jun', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Cash', '', '2025-11-19 03:51:43', '2025-11-19', '652', 311, 'demo@easyskool.in', 2, '1300.00'),
(903, '2025-2026/311', 619, 'Jul', '63', 'fees', 'Monthly Fee', '0', '2600', '0', '2600', '2600', '', '0.00', '2600', '0', '2600', '2600', '0', 'Cash', '', '2025-11-19 03:51:43', '2025-11-19', '652', 311, 'demo@easyskool.in', 2, '1300.00'),
(905, '2025-2026/312', 618, 'Oct', '63', 'fees', 'Monthly Fee', '0', '2600', '1000', '1600', '2600', '0', '0.00', '2600', '1000', '1600', '1600', '0.00', 'Online', '', '2025-11-20 04:04:17', '2025-11-20', '651', 312, 'demo@easyskool.in', 2, '1300.00'),
(906, '2025-2026/312', 618, 'Nov', '63', 'fees', 'Monthly Fee', '0', '2600', '1000', '1600', '2600', '0', '0.00', '2600', '1000', '1600', '1600', '0.00', 'Online', '', '2025-11-20 04:04:17', '2025-11-20', '651', 312, 'demo@easyskool.in', 2, '1300.00'),
(907, '2025-2026/313', 624, 'Nov', '65', 'fees', 'Monthly Fee', '-200', '1500', '300', '1400', '1500', '', '0.00', '1500', '300', '1200', '1400', '-200.00', 'Online', '', '2025-11-20 04:05:48', '2025-11-20', '657', 313, 'demo@easyskool.in', 1, '1500.00'),
(908, '2025-2026/314', 597, 'Nov', '62', 'fees', 'Monthly Fee', '0', '1200', '100', '1100', '1200', '', '0.00', '1200', '100', '1100', '1100', '0.00', 'Cash', '', '2025-11-20 07:58:31', '2025-11-20', '630', 314, 'demo@easyskool.in', 1, '1200.00');

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `id` int(11) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `is_system` int(11) NOT NULL DEFAULT 0,
  `is_superadmin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `is_active`, `is_system`, `is_superadmin`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 0, 1, 0, '2018-06-30 15:39:11', '0000-00-00'),
(2, 'Teacher', NULL, 0, 1, 0, '2018-06-30 15:39:14', '0000-00-00'),
(3, 'Accountant', NULL, 0, 1, 0, '2018-06-30 15:39:17', '0000-00-00'),
(4, 'Librarian', NULL, 0, 1, 0, '2018-06-30 15:39:21', '0000-00-00'),
(6, 'Receptionist', NULL, 0, 1, 0, '2018-07-02 05:39:03', '0000-00-00'),
(7, 'Super Admin', NULL, 0, 1, 1, '2018-07-11 14:11:29', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `perm_cat_id` int(11) DEFAULT NULL,
  `can_view` int(11) DEFAULT NULL,
  `can_add` int(11) DEFAULT NULL,
  `can_edit` int(11) DEFAULT NULL,
  `can_delete` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_id`, `perm_cat_id`, `can_view`, `can_add`, `can_edit`, `can_delete`, `created_at`) VALUES
(10, 1, 17, 1, 1, 1, 1, '2018-07-06 09:48:56'),
(28, 1, 19, 1, 1, 1, 0, '2018-07-02 11:31:10'),
(30, 1, 76, 1, 1, 1, 0, '2018-07-02 11:31:10'),
(32, 1, 22, 1, 1, 1, 1, '2018-07-02 11:32:05'),
(58, 1, 52, 1, 1, 0, 1, '2018-07-09 03:19:43'),
(87, 1, 92, 1, 1, 1, 1, '2018-06-26 03:33:43'),
(190, 1, 105, 1, 0, 0, 0, '2018-07-02 11:13:25'),
(199, 1, 75, 1, 0, 0, 0, '2018-07-02 11:19:46'),
(203, 1, 16, 1, 0, 0, 0, '2018-07-02 11:24:21'),
(215, 1, 50, 1, 0, 0, 0, '2018-07-02 12:04:53'),
(216, 1, 51, 1, 0, 0, 0, '2018-07-02 12:04:53'),
(222, 1, 1, 1, 1, 1, 1, '2019-11-27 22:55:06'),
(227, 1, 91, 1, 0, 0, 0, '2018-07-03 01:49:27'),
(230, 10, 53, 0, 1, 0, 0, '2018-07-03 03:52:55'),
(231, 10, 54, 0, 0, 1, 0, '2018-07-03 03:52:55'),
(232, 10, 55, 1, 1, 1, 1, '2018-07-03 03:58:42'),
(233, 10, 56, 0, 0, 1, 0, '2018-07-03 03:52:55'),
(235, 10, 58, 0, 0, 1, 0, '2018-07-03 03:52:55'),
(236, 10, 59, 0, 0, 1, 0, '2018-07-03 03:52:55'),
(239, 10, 1, 1, 1, 1, 1, '2018-07-03 04:16:43'),
(241, 10, 3, 1, 0, 0, 0, '2018-07-03 04:23:56'),
(242, 10, 2, 1, 0, 0, 0, '2018-07-03 04:24:39'),
(243, 10, 4, 1, 0, 1, 1, '2018-07-03 04:31:24'),
(245, 10, 107, 1, 0, 0, 0, '2018-07-03 04:36:41'),
(246, 10, 5, 1, 1, 0, 1, '2018-07-03 04:38:18'),
(247, 10, 7, 1, 1, 1, 1, '2018-07-03 04:42:07'),
(248, 10, 68, 1, 0, 0, 0, '2018-07-03 04:42:53'),
(249, 10, 69, 1, 1, 1, 1, '2018-07-03 04:49:46'),
(250, 10, 70, 1, 0, 0, 1, '2018-07-03 04:52:40'),
(251, 10, 72, 1, 0, 0, 0, '2018-07-03 04:56:46'),
(252, 10, 73, 1, 0, 0, 0, '2018-07-03 04:56:46'),
(253, 10, 74, 1, 0, 0, 0, '2018-07-03 04:58:34'),
(254, 10, 75, 1, 0, 0, 0, '2018-07-03 04:58:34'),
(255, 10, 9, 1, 1, 1, 1, '2018-07-03 05:02:22'),
(256, 10, 10, 1, 1, 1, 1, '2018-07-03 05:03:09'),
(257, 10, 11, 1, 0, 0, 0, '2018-07-03 05:03:09'),
(258, 10, 12, 1, 1, 1, 1, '2018-07-03 05:08:40'),
(259, 10, 13, 1, 1, 1, 1, '2018-07-03 05:08:40'),
(260, 10, 14, 1, 0, 0, 0, '2018-07-03 05:08:53'),
(261, 10, 15, 1, 1, 1, 0, '2018-07-03 05:11:28'),
(262, 10, 16, 1, 0, 0, 0, '2018-07-03 05:12:12'),
(263, 10, 17, 1, 1, 1, 1, '2018-07-03 05:14:30'),
(264, 10, 19, 1, 1, 1, 0, '2018-07-03 05:15:45'),
(265, 10, 20, 1, 1, 1, 1, '2018-07-03 05:18:51'),
(266, 10, 76, 1, 0, 0, 0, '2018-07-03 05:21:21'),
(267, 10, 21, 1, 1, 1, 0, '2018-07-03 05:22:45'),
(268, 10, 22, 1, 1, 1, 1, '2018-07-03 05:25:00'),
(269, 10, 23, 1, 1, 1, 1, '2018-07-03 05:27:16'),
(270, 10, 24, 1, 1, 1, 1, '2018-07-03 05:27:49'),
(271, 10, 25, 1, 1, 1, 1, '2018-07-03 05:27:49'),
(272, 10, 26, 1, 0, 0, 0, '2018-07-03 05:28:25'),
(273, 10, 77, 1, 1, 1, 1, '2018-07-03 05:29:57'),
(274, 10, 27, 1, 1, 0, 1, '2018-07-03 05:30:36'),
(275, 10, 28, 1, 1, 1, 1, '2018-07-03 05:33:09'),
(276, 10, 29, 1, 0, 0, 0, '2018-07-03 05:34:03'),
(277, 10, 30, 1, 0, 0, 0, '2018-07-03 05:34:03'),
(278, 10, 31, 1, 0, 0, 0, '2018-07-03 05:34:03'),
(279, 10, 32, 1, 1, 1, 1, '2018-07-03 05:35:42'),
(280, 10, 33, 1, 1, 1, 1, '2018-07-03 05:36:32'),
(281, 10, 34, 1, 1, 1, 1, '2018-07-03 05:38:03'),
(282, 10, 35, 1, 1, 1, 1, '2018-07-03 05:38:41'),
(283, 10, 104, 1, 1, 1, 1, '2018-07-03 05:40:43'),
(284, 10, 37, 1, 1, 1, 1, '2018-07-03 05:42:42'),
(285, 10, 38, 1, 1, 1, 1, '2018-07-03 05:43:56'),
(286, 10, 39, 1, 1, 1, 1, '2018-07-03 05:45:39'),
(287, 10, 40, 1, 1, 1, 1, '2018-07-03 05:47:22'),
(288, 10, 41, 1, 1, 1, 1, '2018-07-03 05:48:54'),
(289, 10, 42, 1, 1, 1, 1, '2018-07-03 05:49:31'),
(290, 10, 43, 1, 1, 1, 1, '2018-07-03 05:51:15'),
(291, 10, 44, 1, 0, 0, 0, '2018-07-03 05:52:06'),
(292, 10, 46, 1, 0, 0, 0, '2018-07-03 05:52:06'),
(293, 10, 50, 1, 0, 0, 0, '2018-07-03 05:52:59'),
(294, 10, 51, 1, 0, 0, 0, '2018-07-03 05:52:59'),
(295, 10, 60, 0, 0, 1, 0, '2018-07-03 05:55:05'),
(296, 10, 61, 1, 1, 1, 1, '2018-07-03 05:56:52'),
(297, 10, 62, 1, 1, 1, 1, '2018-07-03 05:58:53'),
(298, 10, 63, 1, 1, 0, 0, '2018-07-03 05:59:37'),
(299, 10, 64, 1, 1, 1, 1, '2018-07-03 06:00:27'),
(300, 10, 65, 1, 1, 1, 1, '2018-07-03 06:02:51'),
(301, 10, 66, 1, 1, 1, 1, '2018-07-03 06:02:51'),
(302, 10, 67, 1, 0, 0, 0, '2018-07-03 06:02:51'),
(303, 10, 78, 1, 1, 1, 1, '2018-07-04 04:10:04'),
(310, 1, 119, 1, 0, 0, 0, '2018-07-03 10:15:00'),
(311, 1, 120, 1, 0, 0, 0, '2018-07-03 10:15:00'),
(317, 1, 124, 1, 0, 0, 0, '2018-07-03 10:29:14'),
(320, 1, 47, 1, 0, 0, 0, '2018-07-03 11:01:12'),
(321, 1, 121, 1, 0, 0, 0, '2018-07-03 11:01:12'),
(372, 10, 79, 1, 1, 0, 0, '2018-07-04 04:10:04'),
(373, 10, 80, 1, 1, 1, 1, '2018-07-04 04:23:09'),
(374, 10, 81, 1, 1, 1, 1, '2018-07-04 04:23:50'),
(375, 10, 82, 1, 1, 1, 1, '2018-07-04 04:26:54'),
(376, 10, 83, 1, 1, 1, 1, '2018-07-04 04:27:55'),
(377, 10, 84, 1, 1, 1, 1, '2018-07-04 04:30:26'),
(378, 10, 85, 1, 1, 1, 1, '2018-07-04 04:32:54'),
(379, 10, 86, 1, 1, 1, 1, '2018-07-04 04:46:18'),
(380, 10, 87, 1, 0, 0, 0, '2018-07-04 04:49:49'),
(381, 10, 88, 1, 1, 1, 0, '2018-07-04 04:51:20'),
(382, 10, 89, 1, 0, 0, 0, '2018-07-04 04:51:51'),
(383, 10, 90, 1, 1, 0, 1, '2018-07-04 04:55:01'),
(384, 10, 91, 1, 0, 0, 0, '2018-07-04 04:55:01'),
(385, 10, 108, 1, 1, 1, 1, '2018-07-04 04:57:46'),
(386, 10, 109, 1, 1, 1, 1, '2018-07-04 04:58:26'),
(387, 10, 110, 1, 1, 1, 1, '2018-07-04 05:02:43'),
(388, 10, 111, 1, 1, 1, 1, '2018-07-04 05:03:21'),
(389, 10, 112, 1, 1, 1, 1, '2018-07-04 05:05:06'),
(390, 10, 127, 1, 0, 0, 0, '2018-07-04 05:05:06'),
(391, 10, 93, 1, 1, 1, 1, '2018-07-04 05:07:14'),
(392, 10, 94, 1, 1, 0, 0, '2018-07-04 05:08:02'),
(394, 10, 95, 1, 0, 0, 0, '2018-07-04 05:08:44'),
(395, 10, 102, 1, 1, 1, 1, '2018-07-04 05:11:02'),
(396, 10, 106, 1, 0, 0, 0, '2018-07-04 05:11:39'),
(397, 10, 113, 1, 0, 0, 0, '2018-07-04 05:12:37'),
(398, 10, 114, 1, 0, 0, 0, '2018-07-04 05:12:37'),
(399, 10, 115, 1, 0, 0, 0, '2018-07-04 05:18:45'),
(400, 10, 116, 1, 0, 0, 0, '2018-07-04 05:18:45'),
(401, 10, 117, 1, 0, 0, 0, '2018-07-04 05:19:43'),
(402, 10, 118, 1, 0, 0, 0, '2018-07-04 05:19:43'),
(434, 1, 125, 1, 0, 0, 0, '2018-07-06 09:59:26'),
(445, 1, 48, 1, 0, 0, 0, '2018-07-06 11:49:35'),
(446, 1, 49, 1, 0, 0, 0, '2018-07-06 11:49:35'),
(462, 1, 95, 1, 0, 0, 0, '2018-07-09 01:18:41'),
(479, 2, 47, 1, 0, 0, 0, '2018-07-10 06:47:12'),
(480, 2, 105, 1, 0, 0, 0, '2018-07-10 06:47:12'),
(482, 2, 119, 1, 0, 0, 0, '2018-07-10 06:47:12'),
(483, 2, 120, 1, 0, 0, 0, '2018-07-10 06:47:12'),
(486, 2, 16, 1, 0, 0, 0, '2018-07-10 06:47:12'),
(493, 2, 22, 1, 0, 0, 0, '2018-07-12 00:20:27'),
(504, 2, 95, 1, 0, 0, 0, '2018-07-10 06:47:12'),
(513, 3, 72, 1, 0, 0, 0, '2018-07-10 07:07:30'),
(517, 3, 75, 1, 0, 0, 0, '2018-07-10 07:10:38'),
(527, 3, 89, 1, 0, 0, 0, '2018-07-10 07:18:44'),
(529, 3, 91, 1, 0, 0, 0, '2018-07-10 07:18:44'),
(549, 3, 124, 1, 0, 0, 0, '2018-07-10 07:22:17'),
(557, 6, 82, 1, 1, 1, 1, '2019-12-01 01:48:28'),
(558, 6, 83, 1, 1, 1, 1, '2019-12-01 01:49:08'),
(559, 6, 84, 1, 1, 1, 1, '2019-12-01 01:49:59'),
(575, 6, 44, 1, 0, 0, 0, '2018-07-10 07:35:33'),
(576, 6, 46, 1, 0, 0, 0, '2018-07-10 07:35:33'),
(578, 6, 102, 1, 1, 1, 1, '2019-12-01 01:52:27'),
(594, 3, 125, 1, 0, 0, 0, '2018-07-10 07:58:12'),
(595, 3, 48, 1, 0, 0, 0, '2018-07-10 07:58:12'),
(596, 3, 49, 1, 0, 0, 0, '2018-07-10 07:58:12'),
(617, 2, 17, 1, 1, 1, 1, '2018-07-11 06:55:14'),
(618, 2, 19, 1, 1, 1, 0, '2018-07-11 06:55:14'),
(620, 2, 76, 1, 1, 1, 0, '2018-07-11 06:55:14'),
(622, 2, 121, 1, 0, 0, 0, '2018-07-11 06:56:27'),
(628, 6, 22, 1, 0, 0, 0, '2018-07-12 00:23:47'),
(634, 4, 102, 1, 1, 1, 1, '2019-12-01 01:03:00'),
(662, 1, 138, 1, 0, 0, 0, '2019-11-01 02:28:24'),
(663, 1, 139, 1, 1, 1, 1, '2019-11-01 02:28:24'),
(664, 1, 140, 1, 1, 1, 1, '2019-11-01 02:28:24'),
(690, 1, 166, 1, 0, 0, 0, '2019-11-01 02:28:24'),
(691, 1, 167, 1, 0, 0, 0, '2019-11-01 02:28:24'),
(692, 1, 168, 1, 0, 0, 0, '2019-11-01 02:28:24'),
(693, 1, 170, 1, 0, 0, 0, '2019-11-01 02:28:24'),
(694, 1, 172, 1, 0, 0, 0, '2019-11-01 02:28:24'),
(695, 1, 173, 1, 0, 0, 0, '2019-11-01 02:28:24'),
(733, 1, 199, 1, 0, 0, 0, '2019-11-26 05:24:30'),
(739, 1, 218, 1, 0, 0, 0, '2019-11-27 06:36:31'),
(743, 1, 218, 1, 0, 0, 0, '2019-11-27 06:36:32'),
(747, 1, 2, 1, 0, 0, 0, '2019-11-27 22:56:08'),
(748, 1, 3, 1, 1, 1, 1, '2022-08-29 03:42:01'),
(749, 1, 4, 1, 1, 1, 1, '2022-08-29 03:42:01'),
(752, 1, 132, 1, 0, 1, 1, '2019-11-27 23:02:23'),
(754, 1, 134, 1, 1, 1, 1, '2019-11-27 23:18:21'),
(764, 1, 72, 1, 0, 0, 0, '2019-11-27 23:40:11'),
(806, 2, 133, 1, 0, 1, 0, '2019-11-29 00:34:35'),
(813, 1, 133, 1, 0, 1, 0, '2019-11-29 00:39:57'),
(979, 1, 225, 1, 0, 0, 0, '2019-11-29 04:45:30'),
(982, 2, 225, 1, 0, 0, 0, '2019-11-29 04:47:19'),
(1103, 2, 205, 1, 0, 0, 0, '2022-09-15 03:10:29'),
(1105, 2, 23, 1, 0, 0, 0, '2019-11-30 01:56:04'),
(1107, 2, 25, 1, 0, 0, 0, '2019-11-30 01:56:04'),
(1108, 2, 77, 1, 0, 0, 0, '2019-11-30 01:56:04'),
(1119, 2, 117, 1, 0, 0, 0, '2019-11-30 01:56:04'),
(1123, 3, 8, 1, 1, 1, 1, '2019-11-30 06:46:18'),
(1125, 3, 69, 1, 1, 1, 1, '2019-11-30 07:00:49'),
(1126, 3, 70, 1, 1, 1, 1, '2019-11-30 07:04:46'),
(1130, 3, 9, 1, 1, 1, 1, '2019-11-30 07:14:54'),
(1131, 3, 10, 1, 1, 1, 1, '2019-11-30 07:16:02'),
(1134, 3, 35, 1, 1, 1, 1, '2019-11-30 07:25:04'),
(1135, 3, 104, 1, 1, 1, 1, '2019-11-30 07:25:53'),
(1140, 3, 41, 1, 1, 1, 1, '2019-11-30 07:37:13'),
(1141, 3, 42, 1, 1, 1, 1, '2019-11-30 07:37:46'),
(1142, 3, 43, 1, 1, 1, 1, '2019-11-30 07:42:06'),
(1151, 3, 87, 1, 0, 0, 0, '2019-11-30 02:23:13'),
(1152, 3, 88, 1, 1, 1, 0, '2019-11-30 02:23:13'),
(1153, 3, 90, 1, 1, 0, 1, '2019-11-30 02:23:13'),
(1154, 3, 108, 1, 0, 1, 1, '2025-11-08 06:34:01'),
(1155, 3, 109, 1, 1, 0, 0, '2019-11-30 02:23:13'),
(1156, 3, 110, 1, 1, 1, 1, '2019-11-30 02:23:13'),
(1157, 3, 111, 1, 1, 1, 1, '2019-11-30 02:23:13'),
(1158, 3, 112, 1, 1, 1, 1, '2019-11-30 02:23:13'),
(1159, 3, 127, 1, 0, 0, 0, '2019-11-30 02:23:13'),
(1160, 3, 129, 0, 1, 0, 1, '2019-11-30 02:23:13'),
(1161, 3, 102, 1, 1, 1, 1, '2019-11-30 02:23:13'),
(1162, 3, 106, 1, 0, 0, 0, '2019-11-30 02:23:13'),
(1163, 3, 113, 1, 0, 0, 0, '2019-11-30 02:23:13'),
(1164, 3, 114, 1, 0, 0, 0, '2019-11-30 02:23:13'),
(1165, 3, 115, 1, 0, 0, 0, '2019-11-30 02:23:13'),
(1166, 3, 116, 1, 0, 0, 0, '2019-11-30 02:23:13'),
(1167, 3, 117, 1, 0, 0, 0, '2019-11-30 02:23:13'),
(1168, 3, 118, 1, 0, 0, 0, '2019-11-30 02:23:13'),
(1179, 2, 212, 1, 0, 1, 0, '2022-09-20 16:11:11'),
(1185, 2, 150, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1188, 2, 153, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1190, 2, 197, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1191, 2, 198, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1192, 2, 199, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1193, 2, 200, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1194, 2, 201, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1195, 2, 202, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1196, 2, 203, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1197, 2, 219, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1198, 2, 223, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1199, 2, 213, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1201, 2, 230, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1204, 2, 214, 1, 0, 1, 0, '2019-11-30 02:36:17'),
(1206, 2, 224, 1, 0, 0, 0, '2019-11-30 02:36:17'),
(1211, 2, 145, 1, 0, 0, 0, '2019-11-30 02:57:28'),
(1220, 3, 135, 1, 0, 1, 0, '2019-11-30 07:08:56'),
(1231, 3, 190, 1, 0, 0, 0, '2019-11-30 03:44:02'),
(1232, 3, 192, 1, 0, 0, 0, '2019-11-30 03:44:02'),
(1233, 3, 226, 1, 0, 0, 0, '2019-11-30 03:44:02'),
(1234, 3, 227, 1, 0, 0, 0, '2019-11-30 03:44:02'),
(1235, 3, 224, 1, 0, 0, 0, '2019-11-30 03:44:02'),
(1236, 2, 15, 1, 1, 1, 0, '2019-11-30 03:54:25'),
(1239, 2, 122, 1, 0, 0, 0, '2019-11-30 03:57:48'),
(1240, 2, 136, 1, 0, 0, 0, '2019-11-30 03:57:48'),
(1242, 6, 217, 1, 0, 0, 0, '2019-11-30 04:00:13'),
(1243, 6, 224, 1, 0, 0, 0, '2019-11-30 04:00:13'),
(1245, 2, 20, 1, 0, 0, 0, '2022-09-15 03:10:29'),
(1246, 2, 137, 1, 0, 0, 0, '2022-09-15 03:10:29'),
(1250, 2, 187, 1, 0, 0, 0, '2019-11-30 04:11:19'),
(1257, 2, 21, 1, 0, 0, 0, '2019-11-30 04:32:59'),
(1259, 2, 188, 1, 0, 0, 0, '2019-11-30 04:34:35'),
(1260, 2, 27, 1, 0, 0, 0, '2019-11-30 04:36:13'),
(1262, 2, 43, 1, 1, 1, 1, '2019-11-30 04:39:42'),
(1263, 2, 44, 1, 0, 0, 0, '2019-11-30 04:41:43'),
(1264, 2, 46, 1, 0, 0, 0, '2019-11-30 04:41:43'),
(1265, 2, 217, 1, 0, 0, 0, '2019-11-30 04:41:43'),
(1269, 2, 164, 1, 0, 0, 0, '2019-11-30 04:51:04'),
(1271, 2, 109, 1, 1, 0, 0, '2019-11-30 05:03:37'),
(1272, 2, 93, 1, 1, 1, 1, '2019-11-30 05:07:25'),
(1273, 2, 94, 1, 1, 0, 0, '2019-11-30 05:07:42'),
(1275, 2, 102, 1, 1, 1, 1, '2019-11-30 05:11:22'),
(1277, 2, 196, 1, 0, 0, 0, '2019-11-30 05:15:01'),
(1278, 2, 195, 1, 0, 0, 0, '2019-11-30 05:19:08'),
(1279, 2, 185, 1, 1, 1, 1, '2019-11-30 05:21:44'),
(1280, 2, 186, 1, 1, 1, 1, '2019-11-30 05:22:43'),
(1281, 2, 222, 1, 0, 1, 0, '2019-11-30 05:24:30'),
(1283, 3, 5, 1, 1, 0, 1, '2019-11-30 06:43:04'),
(1284, 3, 6, 1, 0, 0, 0, '2019-11-30 06:43:29'),
(1285, 3, 7, 1, 1, 1, 1, '2019-11-30 06:44:39'),
(1286, 3, 68, 1, 0, 0, 0, '2019-11-30 06:46:58'),
(1287, 3, 71, 1, 0, 0, 0, '2019-11-30 07:05:41'),
(1288, 3, 73, 1, 0, 0, 0, '2019-11-30 07:05:59'),
(1289, 3, 74, 1, 0, 0, 0, '2019-11-30 07:06:08'),
(1290, 3, 11, 1, 0, 0, 0, '2019-11-30 07:16:37'),
(1291, 3, 12, 1, 1, 1, 1, '2019-11-30 07:19:29'),
(1292, 3, 13, 1, 1, 1, 1, '2019-11-30 07:22:27'),
(1294, 3, 14, 1, 0, 0, 0, '2019-11-30 07:22:55'),
(1295, 3, 31, 1, 1, 1, 1, '2019-12-02 06:30:37'),
(1297, 3, 37, 1, 1, 1, 1, '2019-11-30 07:28:09'),
(1298, 3, 38, 1, 1, 1, 1, '2019-11-30 07:29:02'),
(1299, 3, 39, 1, 1, 1, 1, '2019-11-30 07:30:07'),
(1300, 3, 40, 1, 1, 1, 1, '2019-11-30 07:32:43'),
(1301, 3, 44, 1, 0, 0, 0, '2019-11-30 07:44:09'),
(1302, 3, 46, 1, 0, 0, 0, '2019-11-30 07:44:09'),
(1303, 3, 217, 1, 0, 0, 0, '2019-11-30 07:44:09'),
(1304, 3, 155, 1, 0, 0, 0, '2019-11-30 07:44:32'),
(1305, 3, 156, 1, 0, 0, 0, '2019-11-30 07:45:18'),
(1306, 3, 157, 1, 0, 0, 0, '2019-11-30 07:45:42'),
(1307, 3, 158, 1, 0, 0, 0, '2019-11-30 07:46:07'),
(1308, 3, 159, 1, 0, 0, 0, '2019-11-30 07:46:21'),
(1309, 3, 160, 1, 0, 0, 0, '2019-11-30 07:46:33'),
(1313, 3, 161, 1, 0, 0, 0, '2019-11-30 07:48:26'),
(1314, 3, 162, 1, 0, 0, 0, '2019-11-30 07:48:48'),
(1315, 3, 163, 1, 0, 0, 0, '2019-11-30 07:48:48'),
(1316, 3, 164, 1, 0, 0, 0, '2019-11-30 07:49:47'),
(1317, 3, 165, 1, 0, 0, 0, '2019-11-30 07:49:47'),
(1318, 3, 174, 1, 0, 0, 0, '2019-11-30 07:49:47'),
(1319, 3, 175, 1, 0, 0, 0, '2019-11-30 07:49:59'),
(1320, 3, 181, 1, 0, 0, 0, '2019-11-30 07:50:08'),
(1321, 3, 86, 1, 1, 1, 1, '2019-11-30 07:54:08'),
(1322, 4, 28, 1, 1, 1, 1, '2019-12-01 00:52:39'),
(1324, 4, 29, 1, 0, 0, 0, '2019-12-01 00:53:46'),
(1325, 4, 30, 1, 0, 0, 0, '2019-12-01 00:53:59'),
(1326, 4, 123, 1, 0, 0, 0, '2019-12-01 00:54:26'),
(1327, 4, 228, 1, 0, 0, 0, '2019-12-01 00:54:39'),
(1328, 4, 43, 1, 1, 1, 1, '2019-12-01 00:58:05'),
(1332, 4, 44, 1, 0, 0, 0, '2019-12-01 00:59:16'),
(1333, 4, 46, 1, 0, 0, 0, '2019-12-01 00:59:16'),
(1334, 4, 217, 1, 0, 0, 0, '2019-12-01 00:59:16'),
(1335, 4, 178, 1, 0, 0, 0, '2019-12-01 00:59:59'),
(1336, 4, 179, 1, 0, 0, 0, '2019-12-01 01:00:11'),
(1337, 4, 180, 1, 0, 0, 0, '2019-12-01 01:00:29'),
(1338, 4, 221, 1, 0, 0, 0, '2019-12-01 01:00:46'),
(1339, 4, 86, 1, 0, 0, 0, '2019-12-01 01:01:02'),
(1341, 4, 106, 1, 0, 0, 0, '2019-12-01 01:05:21'),
(1342, 1, 107, 1, 0, 0, 0, '2019-12-01 01:06:44'),
(1343, 4, 117, 1, 0, 0, 0, '2019-12-01 01:10:20'),
(1344, 4, 194, 1, 0, 0, 0, '2019-12-01 01:11:35'),
(1348, 4, 230, 1, 0, 0, 0, '2019-12-01 01:19:15'),
(1350, 6, 1, 1, 1, 1, 1, '2022-11-16 04:05:40'),
(1351, 6, 21, 1, 0, 0, 0, '2019-12-01 01:36:29'),
(1352, 6, 23, 1, 0, 0, 0, '2019-12-01 01:36:45'),
(1353, 6, 24, 1, 0, 0, 0, '2019-12-01 01:37:05'),
(1354, 6, 25, 1, 0, 0, 0, '2019-12-01 01:37:34'),
(1355, 6, 77, 1, 0, 0, 0, '2019-12-01 01:38:08'),
(1356, 6, 188, 1, 0, 0, 0, '2019-12-01 01:38:45'),
(1357, 6, 43, 1, 1, 1, 1, '2019-12-01 01:40:44'),
(1358, 6, 78, 1, 1, 1, 1, '2019-12-01 01:43:04'),
(1360, 6, 79, 1, 1, 0, 1, '2019-12-01 01:44:39'),
(1361, 6, 80, 1, 1, 1, 1, '2019-12-01 01:45:08'),
(1362, 6, 81, 1, 1, 1, 1, '2019-12-01 01:47:50'),
(1363, 6, 85, 1, 1, 1, 1, '2019-12-01 01:50:43'),
(1364, 6, 86, 1, 1, 1, 0, '2022-11-16 04:05:19'),
(1365, 6, 106, 1, 0, 0, 0, '2019-12-01 01:52:55'),
(1366, 6, 117, 1, 0, 0, 0, '2019-12-01 01:53:08'),
(1414, 2, 174, 1, 0, 0, 0, '2019-12-02 05:54:37'),
(1418, 2, 232, 1, 0, 1, 1, '2019-12-02 06:11:27'),
(1419, 2, 231, 1, 0, 0, 0, '2019-12-02 06:12:28'),
(1422, 3, 32, 1, 1, 1, 1, '2019-12-02 06:30:37'),
(1423, 3, 33, 1, 1, 1, 1, '2019-12-02 06:30:37'),
(1424, 3, 34, 1, 1, 1, 1, '2019-12-02 06:30:37'),
(1425, 3, 182, 1, 0, 0, 0, '2019-12-02 06:30:37'),
(1426, 3, 183, 1, 0, 0, 0, '2019-12-02 06:30:37'),
(1427, 3, 189, 1, 0, 1, 1, '2019-12-02 06:30:37'),
(1428, 3, 229, 1, 0, 0, 0, '2019-12-02 06:30:37'),
(1429, 3, 230, 1, 0, 0, 0, '2019-12-02 06:30:37'),
(1430, 4, 213, 1, 0, 0, 0, '2019-12-02 06:32:14'),
(1432, 4, 224, 1, 0, 0, 0, '2019-12-02 06:32:14'),
(1433, 4, 195, 1, 0, 0, 0, '2019-12-03 04:57:53'),
(1434, 4, 229, 1, 0, 0, 0, '2019-12-03 04:58:19'),
(1436, 6, 213, 1, 0, 0, 0, '2019-12-03 05:10:11'),
(1437, 6, 191, 1, 0, 0, 0, '2019-12-03 05:10:11'),
(1438, 6, 193, 1, 0, 0, 0, '2019-12-03 05:10:11'),
(1439, 6, 230, 1, 0, 0, 0, '2019-12-03 05:10:11'),
(1440, 2, 106, 1, 0, 0, 0, '2020-01-25 04:21:36'),
(1445, 3, 233, 1, 0, 0, 0, '2020-02-12 03:51:17'),
(1452, 2, 236, 1, 1, 1, 0, '2020-05-29 23:40:33'),
(1453, 2, 237, 1, 0, 1, 0, '2020-05-29 23:40:33'),
(1454, 2, 238, 1, 1, 1, 1, '2020-05-29 23:40:33'),
(1455, 2, 239, 1, 1, 1, 1, '2020-05-29 23:40:33'),
(1456, 2, 240, 1, 0, 0, 0, '2020-05-28 20:51:18'),
(1457, 2, 241, 1, 0, 0, 0, '2020-05-28 20:51:18'),
(1461, 2, 242, 1, 0, 0, 0, '2020-06-11 22:45:24'),
(1462, 3, 242, 1, 0, 0, 0, '2020-06-14 22:46:54'),
(1463, 6, 242, 1, 0, 0, 0, '2020-06-14 22:48:14'),
(1472, 2, 247, 1, 0, 0, 0, '2021-01-21 12:46:40'),
(1473, 8, 1, 1, 1, 1, 1, '2022-08-09 04:13:19'),
(1474, 8, 2, 1, 0, 0, 0, '2022-08-09 04:13:19'),
(1475, 8, 3, 1, 1, 1, 1, '2022-08-09 04:13:19'),
(1476, 8, 4, 1, 1, 1, 1, '2022-08-09 04:13:19'),
(1477, 8, 107, 1, 0, 0, 0, '2022-08-09 04:13:19'),
(1478, 8, 128, 0, 1, 0, 1, '2022-08-09 04:13:19'),
(1479, 8, 134, 1, 1, 1, 1, '2022-08-09 04:13:19'),
(1480, 9, 1, 1, 1, 1, 1, '2022-08-09 04:29:12'),
(1481, 9, 2, 1, 0, 0, 0, '2022-08-09 04:29:12'),
(1482, 9, 3, 1, 1, 1, 1, '2022-08-09 04:29:12'),
(1483, 9, 4, 1, 1, 1, 1, '2022-08-09 04:29:12'),
(1484, 9, 107, 1, 0, 0, 0, '2022-08-09 04:29:12'),
(1485, 9, 128, 0, 1, 0, 1, '2022-08-09 04:29:12'),
(1486, 9, 134, 1, 1, 1, 1, '2022-08-09 04:29:12'),
(1488, 1, 128, 0, 1, 0, 1, '2022-08-26 14:06:31'),
(1873, 1, 15, 1, 1, 1, 0, '2022-09-07 03:53:40'),
(1874, 1, 122, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1875, 1, 136, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1876, 1, 20, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1877, 1, 137, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1878, 1, 141, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1879, 1, 142, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1880, 1, 143, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1881, 1, 144, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1882, 1, 187, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1883, 1, 196, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1884, 1, 205, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1885, 1, 207, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1886, 1, 208, 1, 0, 1, 0, '2022-09-07 03:53:40'),
(1887, 1, 210, 1, 0, 1, 0, '2022-09-07 03:53:40'),
(1888, 1, 211, 1, 0, 1, 0, '2022-09-07 03:53:40'),
(1889, 1, 212, 1, 0, 1, 0, '2022-09-07 03:53:40'),
(1890, 1, 21, 1, 0, 1, 0, '2022-09-07 03:53:40'),
(1891, 1, 23, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1892, 1, 24, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1893, 1, 25, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1894, 1, 26, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1895, 1, 77, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1896, 1, 145, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1897, 1, 188, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1898, 1, 27, 1, 1, 0, 1, '2022-09-07 03:53:40'),
(1899, 1, 37, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1900, 1, 38, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1901, 1, 39, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1902, 1, 43, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1903, 1, 44, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1904, 1, 46, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1905, 1, 217, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1906, 1, 146, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1907, 1, 147, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1908, 1, 148, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1909, 1, 149, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1910, 1, 150, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1911, 1, 151, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1912, 1, 152, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1913, 1, 153, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1914, 1, 154, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1915, 1, 155, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1916, 1, 156, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1917, 1, 157, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1918, 1, 158, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1919, 1, 159, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1920, 1, 160, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1921, 1, 161, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1922, 1, 162, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1923, 1, 163, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1924, 1, 164, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1925, 1, 165, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1926, 1, 174, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1927, 1, 175, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1928, 1, 176, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1929, 1, 177, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1930, 1, 178, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1931, 1, 179, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1932, 1, 180, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1933, 1, 181, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1934, 1, 182, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1935, 1, 183, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1936, 1, 197, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1937, 1, 198, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1938, 1, 200, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1939, 1, 201, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1940, 1, 202, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1941, 1, 203, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1942, 1, 204, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1943, 1, 219, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1944, 1, 220, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1945, 1, 221, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1946, 1, 223, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1947, 1, 240, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1948, 1, 241, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1949, 1, 242, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1950, 1, 244, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1951, 1, 245, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1952, 1, 246, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1953, 1, 78, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1954, 1, 79, 1, 1, 0, 1, '2022-09-07 03:53:40'),
(1955, 1, 80, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1956, 1, 81, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1957, 1, 82, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1958, 1, 83, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1959, 1, 84, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1960, 1, 85, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1961, 1, 86, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1962, 1, 87, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1963, 1, 88, 1, 1, 1, 0, '2022-09-07 03:53:40'),
(1964, 1, 90, 1, 1, 0, 1, '2022-09-07 03:53:40'),
(1965, 1, 108, 1, 0, 1, 1, '2022-09-07 03:53:40'),
(1966, 1, 109, 1, 1, 0, 0, '2022-09-07 03:53:40'),
(1967, 1, 110, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1968, 1, 111, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1969, 1, 112, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1970, 1, 127, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1971, 1, 129, 0, 1, 0, 1, '2022-09-07 03:53:40'),
(1972, 1, 189, 1, 0, 1, 1, '2022-09-07 03:53:40'),
(1973, 1, 93, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1974, 1, 94, 1, 1, 0, 0, '2022-09-07 03:53:40'),
(1975, 1, 96, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1976, 1, 97, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1977, 1, 98, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1978, 1, 99, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1979, 1, 102, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1980, 1, 185, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1981, 1, 186, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1982, 1, 214, 1, 0, 1, 0, '2022-09-07 03:53:40'),
(1983, 1, 222, 1, 0, 1, 0, '2022-09-07 03:53:40'),
(1984, 1, 247, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1985, 1, 224, 1, 0, 0, 0, '2022-09-07 03:53:40'),
(1986, 1, 231, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1987, 1, 232, 1, 0, 1, 1, '2022-09-07 03:53:40'),
(1988, 1, 234, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1989, 1, 235, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1990, 1, 236, 1, 1, 1, 0, '2022-09-07 03:53:40'),
(1991, 1, 237, 1, 0, 1, 0, '2022-09-07 03:53:40'),
(1992, 1, 238, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1993, 1, 239, 1, 1, 1, 1, '2022-09-07 03:53:40'),
(1995, 2, 165, 1, 0, 0, 0, '2022-09-13 01:05:00'),
(1997, 2, 244, 1, 0, 0, 0, '2022-09-13 01:05:00'),
(1998, 2, 245, 1, 0, 0, 0, '2022-09-13 01:05:00'),
(1999, 2, 246, 1, 0, 0, 0, '2022-09-13 01:05:00'),
(2004, 2, 110, 1, 0, 0, 0, '2022-09-15 02:15:54'),
(2010, 2, 156, 1, 0, 0, 0, '2022-09-15 02:53:26'),
(2013, 2, 178, 1, 0, 0, 0, '2022-09-15 02:53:26'),
(2014, 2, 179, 1, 0, 0, 0, '2022-09-15 02:53:26'),
(2015, 2, 180, 1, 0, 0, 0, '2022-09-15 02:53:26'),
(2016, 2, 221, 1, 0, 0, 0, '2022-09-15 02:53:26'),
(2021, 2, 108, 1, 0, 0, 0, '2022-09-15 03:22:08'),
(2024, 2, 207, 1, 0, 0, 0, '2022-09-20 08:27:34'),
(2026, 2, 24, 1, 0, 0, 0, '2022-09-20 16:01:37'),
(2027, 2, 208, 1, 0, 0, 0, '2022-09-20 16:15:45'),
(2031, 1, 5, 1, 1, 0, 1, '2022-10-28 05:52:37'),
(2032, 1, 6, 1, 0, 0, 0, '2022-10-28 05:52:37'),
(2033, 1, 7, 1, 1, 1, 1, '2022-10-28 05:52:37'),
(2034, 1, 8, 1, 1, 1, 1, '2022-10-28 05:52:37'),
(2035, 1, 68, 1, 0, 0, 0, '2022-10-28 05:52:37'),
(2036, 1, 69, 1, 1, 1, 1, '2022-10-28 05:52:37'),
(2037, 1, 70, 1, 1, 1, 1, '2022-10-28 05:52:37'),
(2038, 1, 71, 1, 0, 0, 0, '2022-10-28 05:52:37'),
(2039, 1, 73, 1, 0, 0, 0, '2022-10-28 05:52:37'),
(2040, 1, 74, 1, 0, 0, 0, '2022-10-28 05:52:37'),
(2041, 1, 135, 1, 0, 1, 0, '2022-10-28 05:52:37'),
(2042, 6, 2, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2043, 6, 3, 1, 1, 1, 1, '2022-11-16 04:05:40'),
(2044, 6, 4, 1, 1, 1, 1, '2022-11-16 04:05:40'),
(2045, 6, 107, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2046, 6, 128, 0, 1, 0, 1, '2022-11-16 04:05:40'),
(2047, 6, 134, 1, 1, 1, 1, '2022-11-16 04:05:40'),
(2048, 6, 5, 1, 1, 0, 1, '2022-11-16 04:05:19'),
(2049, 6, 6, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2050, 6, 7, 1, 1, 1, 1, '2022-11-16 04:05:19'),
(2051, 6, 8, 1, 1, 1, 1, '2022-11-16 04:05:19'),
(2052, 6, 68, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2053, 6, 69, 1, 1, 1, 1, '2022-11-16 04:05:19'),
(2054, 6, 70, 1, 1, 1, 1, '2022-11-16 04:05:19'),
(2055, 6, 71, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2056, 6, 73, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2057, 6, 74, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2058, 6, 135, 1, 0, 1, 0, '2022-11-16 04:05:19'),
(2059, 6, 15, 1, 1, 1, 0, '2022-11-16 04:05:19'),
(2060, 6, 122, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2061, 6, 136, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2062, 6, 37, 1, 1, 1, 0, '2022-11-16 04:05:19'),
(2063, 6, 38, 1, 1, 1, 0, '2022-11-16 04:05:19'),
(2064, 6, 39, 1, 1, 1, 0, '2022-11-16 04:05:19'),
(2065, 6, 146, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2066, 6, 147, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2067, 6, 148, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2068, 6, 149, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2069, 6, 150, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2070, 6, 151, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2071, 6, 152, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2072, 6, 153, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2073, 6, 154, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2074, 6, 155, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2075, 6, 156, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2076, 6, 157, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2077, 6, 158, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2078, 6, 159, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2079, 6, 160, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2080, 6, 161, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2081, 6, 162, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2082, 6, 163, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2083, 6, 164, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2084, 6, 165, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2085, 6, 174, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2086, 6, 175, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2087, 6, 176, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2088, 6, 177, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2089, 6, 178, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2090, 6, 179, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2091, 6, 180, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2092, 6, 181, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2093, 6, 182, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2094, 6, 183, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2095, 6, 197, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2096, 6, 198, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2097, 6, 200, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2098, 6, 201, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2099, 6, 202, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2100, 6, 203, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2101, 6, 204, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2102, 6, 219, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2103, 6, 220, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2104, 6, 221, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2105, 6, 223, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2106, 6, 240, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2107, 6, 241, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2108, 6, 244, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2109, 6, 245, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2110, 6, 246, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2111, 6, 87, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2112, 6, 88, 1, 1, 1, 0, '2022-11-16 04:05:19'),
(2113, 6, 90, 1, 1, 0, 0, '2022-11-16 04:05:19'),
(2114, 6, 108, 1, 0, 1, 0, '2022-11-16 04:05:19'),
(2115, 6, 109, 1, 1, 0, 0, '2022-11-16 04:05:19'),
(2116, 6, 110, 1, 1, 1, 0, '2022-11-16 04:05:19'),
(2117, 6, 111, 1, 1, 1, 0, '2022-11-16 04:05:19'),
(2118, 6, 112, 1, 1, 1, 0, '2022-11-16 04:05:19'),
(2119, 6, 127, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2120, 6, 129, 0, 1, 0, 0, '2022-11-16 04:05:19'),
(2121, 6, 189, 1, 0, 1, 0, '2022-11-16 04:05:19'),
(2122, 6, 113, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2123, 6, 114, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2124, 6, 115, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2125, 6, 116, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2126, 6, 118, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2127, 6, 190, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2128, 6, 192, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2129, 6, 194, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2130, 6, 195, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2131, 6, 226, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2132, 6, 227, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2133, 6, 229, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2134, 6, 185, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2135, 6, 186, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2136, 6, 214, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2137, 6, 222, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2138, 6, 247, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2139, 6, 232, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2140, 6, 234, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2141, 6, 235, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2142, 6, 236, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2143, 6, 237, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2144, 6, 238, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2145, 6, 239, 1, 0, 0, 0, '2022-11-16 04:05:19'),
(2146, 2, 88, 1, 0, 0, 0, '2022-11-23 03:52:38'),
(2147, 2, 111, 1, 0, 0, 0, '2022-11-23 03:53:24'),
(2148, 2, 112, 1, 0, 0, 0, '2022-11-23 03:53:24'),
(2149, 15, 1, 0, 1, 0, 0, '2022-12-30 07:55:13'),
(2151, 15, 3, 1, 1, 0, 0, '2022-12-30 07:55:13'),
(2152, 15, 4, 1, 1, 0, 0, '2022-12-30 07:55:13'),
(2153, 15, 107, 1, 0, 0, 0, '2022-12-30 07:37:07'),
(2154, 15, 128, 0, 1, 0, 0, '2022-12-30 07:55:13'),
(2155, 15, 134, 1, 1, 0, 0, '2022-12-30 07:55:13'),
(2156, 15, 146, 1, 0, 0, 0, '2022-12-30 07:37:07'),
(2157, 15, 147, 1, 0, 0, 0, '2022-12-30 07:37:07'),
(2158, 15, 148, 1, 0, 0, 0, '2022-12-30 07:37:07'),
(2159, 15, 149, 1, 0, 0, 0, '2022-12-30 07:37:07'),
(2160, 15, 150, 1, 0, 0, 0, '2022-12-30 07:37:07'),
(2161, 15, 151, 1, 0, 0, 0, '2022-12-30 07:37:07'),
(2162, 15, 152, 1, 0, 0, 0, '2022-12-30 07:37:07'),
(2163, 15, 154, 1, 0, 0, 0, '2022-12-30 07:37:07'),
(2164, 15, 197, 1, 0, 0, 0, '2022-12-30 07:37:07'),
(2165, 16, 1, 0, 1, 1, 0, '2023-01-05 07:35:52'),
(2166, 16, 2, 1, 0, 0, 0, '2023-01-05 07:35:52'),
(2167, 16, 3, 1, 1, 1, 0, '2023-01-05 07:35:52'),
(2168, 16, 4, 1, 1, 1, 0, '2023-01-05 07:35:52'),
(2169, 16, 107, 1, 0, 0, 0, '2023-01-05 07:35:52'),
(2170, 16, 128, 0, 1, 0, 0, '2023-01-05 07:35:52'),
(2171, 16, 134, 1, 0, 0, 0, '2023-01-05 07:35:52'),
(2172, 6, 9, 1, 1, 1, 1, '2023-04-04 03:08:50'),
(2173, 6, 10, 1, 1, 1, 1, '2023-04-04 03:08:50'),
(2174, 6, 11, 1, 0, 0, 0, '2023-04-04 03:08:50'),
(2175, 6, 12, 1, 1, 1, 1, '2023-04-04 03:08:50'),
(2176, 6, 13, 1, 1, 1, 1, '2023-04-04 03:08:50'),
(2177, 6, 14, 1, 0, 0, 0, '2023-04-04 03:08:50'),
(2178, 3, 1, 1, 1, 1, 1, '2025-11-08 04:11:42'),
(2179, 3, 3, 1, 1, 1, 1, '2025-11-08 04:11:42'),
(2180, 3, 4, 1, 1, 1, 1, '2025-11-08 04:11:42'),
(2181, 3, 107, 1, 0, 0, 0, '2025-11-08 04:11:42'),
(2182, 3, 128, 0, 1, 0, 1, '2025-11-08 04:11:42'),
(2183, 3, 134, 1, 1, 1, 1, '2025-11-08 04:11:42'),
(2184, 3, 2, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2185, 3, 15, 1, 1, 1, 0, '2025-11-08 06:34:01'),
(2186, 3, 122, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2187, 3, 136, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2188, 3, 20, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2189, 3, 137, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2190, 3, 141, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2191, 3, 142, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2192, 3, 143, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2193, 3, 144, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2194, 3, 187, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2195, 3, 196, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2196, 3, 205, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2197, 3, 207, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2198, 3, 208, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2199, 3, 210, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2200, 3, 211, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2201, 3, 212, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2202, 3, 21, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2203, 3, 23, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2204, 3, 24, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2205, 3, 25, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2206, 3, 26, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2207, 3, 77, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2208, 3, 145, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2209, 3, 188, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2210, 3, 27, 1, 1, 0, 1, '2025-11-08 06:34:01'),
(2211, 3, 28, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2212, 3, 29, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2213, 3, 30, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2214, 3, 123, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2215, 3, 228, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2216, 3, 146, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2217, 3, 147, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2218, 3, 148, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2219, 3, 149, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2220, 3, 150, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2221, 3, 151, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2222, 3, 152, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2223, 3, 153, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2224, 3, 154, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2225, 3, 176, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2226, 3, 177, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2227, 3, 178, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2228, 3, 179, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2229, 3, 180, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2230, 3, 197, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2231, 3, 198, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2232, 3, 200, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2233, 3, 201, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2234, 3, 202, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2235, 3, 203, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2236, 3, 204, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2237, 3, 219, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2238, 3, 220, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2239, 3, 221, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2240, 3, 223, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2241, 3, 240, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2242, 3, 241, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2243, 3, 244, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2244, 3, 245, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2245, 3, 246, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2246, 3, 53, 0, 1, 0, 1, '2025-11-08 06:34:01'),
(2247, 3, 54, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2248, 3, 55, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2249, 3, 56, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2250, 3, 57, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2251, 3, 58, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2252, 3, 59, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2253, 3, 60, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2254, 3, 126, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2255, 3, 130, 1, 1, 0, 1, '2025-11-08 06:34:01'),
(2256, 3, 131, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2257, 3, 213, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2258, 3, 215, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2259, 3, 216, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2260, 3, 243, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2261, 3, 61, 1, 1, 0, 1, '2025-11-08 06:34:01'),
(2262, 3, 62, 1, 1, 0, 1, '2025-11-08 06:34:01'),
(2263, 3, 63, 1, 1, 0, 1, '2025-11-08 06:34:01'),
(2264, 3, 64, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2265, 3, 65, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2266, 3, 66, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2267, 3, 67, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2268, 3, 78, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2269, 3, 79, 1, 1, 0, 1, '2025-11-08 06:34:01'),
(2270, 3, 80, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2271, 3, 81, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2272, 3, 82, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2273, 3, 83, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2274, 3, 84, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2275, 3, 85, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2276, 3, 93, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2277, 3, 94, 1, 1, 0, 0, '2025-11-08 06:34:01'),
(2278, 3, 96, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2279, 3, 97, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2280, 3, 98, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2281, 3, 99, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2282, 3, 191, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2283, 3, 193, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2284, 3, 194, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2285, 3, 195, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2286, 3, 185, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2287, 3, 186, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2288, 3, 214, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2289, 3, 222, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2290, 3, 247, 1, 0, 0, 0, '2025-11-08 06:34:01'),
(2291, 3, 231, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2292, 3, 232, 1, 0, 1, 1, '2025-11-08 06:34:01'),
(2293, 3, 234, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2294, 3, 235, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2295, 3, 236, 1, 1, 1, 0, '2025-11-08 06:34:01'),
(2296, 3, 237, 1, 0, 1, 0, '2025-11-08 06:34:01'),
(2297, 3, 238, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2298, 3, 239, 1, 1, 1, 1, '2025-11-08 06:34:01'),
(2299, 20, 1, 1, 1, 1, 1, '2025-11-08 06:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `room_type` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `route_head`
--

CREATE TABLE `route_head` (
  `id` int(11) NOT NULL,
  `fees_heading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frequency` enum('Annual','Quarterly','Monthly') NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `months` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`months`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `route_plan`
--

CREATE TABLE `route_plan` (
  `id` int(11) NOT NULL,
  `fee_group_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `class_ids` text NOT NULL,
  `category_ids` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_houses`
--

CREATE TABLE `school_houses` (
  `id` int(11) NOT NULL,
  `house_name` varchar(200) NOT NULL,
  `description` varchar(400) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sch_settings`
--

CREATE TABLE `sch_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `biometric` int(11) DEFAULT 0,
  `biometric_device` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `languages` varchar(500) NOT NULL,
  `dise_code` varchar(50) DEFAULT NULL,
  `date_format` varchar(50) NOT NULL,
  `time_format` varchar(255) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `currency_symbol` varchar(50) NOT NULL,
  `is_rtl` varchar(10) DEFAULT 'disabled',
  `is_duplicate_fees_invoice` int(11) DEFAULT 0,
  `timezone` varchar(30) DEFAULT 'UTC',
  `session_id` int(11) DEFAULT NULL,
  `cron_secret_key` varchar(100) NOT NULL,
  `currency_place` varchar(50) NOT NULL DEFAULT 'before_number',
  `class_teacher` varchar(100) NOT NULL,
  `start_month` varchar(40) NOT NULL,
  `attendence_type` int(11) NOT NULL DEFAULT 0,
  `image` varchar(100) DEFAULT NULL,
  `admin_logo` varchar(255) NOT NULL,
  `admin_small_logo` varchar(255) NOT NULL,
  `theme` varchar(200) NOT NULL DEFAULT 'default.jpg',
  `fee_due_days` int(11) DEFAULT 0,
  `adm_auto_insert` int(11) NOT NULL DEFAULT 1,
  `adm_prefix` varchar(50) NOT NULL DEFAULT 'ssadm19/20',
  `adm_start_from` varchar(11) NOT NULL,
  `adm_no_digit` int(11) NOT NULL DEFAULT 6,
  `adm_update_status` int(11) NOT NULL DEFAULT 0,
  `staffid_auto_insert` int(11) NOT NULL DEFAULT 1,
  `staffid_prefix` varchar(100) NOT NULL DEFAULT 'staffss/19/20',
  `staffid_start_from` varchar(50) NOT NULL,
  `staffid_no_digit` int(11) NOT NULL DEFAULT 6,
  `staffid_update_status` int(11) NOT NULL DEFAULT 0,
  `is_active` varchar(255) DEFAULT 'no',
  `online_admission` int(11) DEFAULT 0,
  `is_blood_group` int(11) NOT NULL DEFAULT 1,
  `is_student_house` int(11) NOT NULL DEFAULT 1,
  `roll_no` int(11) NOT NULL DEFAULT 1,
  `category` int(11) NOT NULL,
  `religion` int(11) NOT NULL DEFAULT 1,
  `cast` int(11) NOT NULL DEFAULT 1,
  `mobile_no` int(11) NOT NULL DEFAULT 1,
  `student_email` int(11) NOT NULL DEFAULT 1,
  `admission_date` int(11) NOT NULL DEFAULT 1,
  `lastname` int(11) NOT NULL,
  `middlename` int(11) NOT NULL DEFAULT 1,
  `student_photo` int(11) NOT NULL DEFAULT 1,
  `student_height` int(11) NOT NULL DEFAULT 1,
  `student_weight` int(11) NOT NULL DEFAULT 1,
  `measurement_date` int(11) NOT NULL DEFAULT 1,
  `father_name` int(11) NOT NULL DEFAULT 1,
  `father_phone` int(11) NOT NULL DEFAULT 1,
  `father_occupation` int(11) NOT NULL DEFAULT 1,
  `father_pic` int(11) NOT NULL DEFAULT 1,
  `mother_name` int(11) NOT NULL DEFAULT 1,
  `mother_phone` int(11) NOT NULL DEFAULT 1,
  `mother_occupation` int(11) NOT NULL DEFAULT 1,
  `mother_pic` int(11) NOT NULL DEFAULT 1,
  `guardian_name` int(11) NOT NULL,
  `guardian_relation` int(11) NOT NULL DEFAULT 1,
  `guardian_phone` int(11) NOT NULL,
  `guardian_email` int(11) NOT NULL DEFAULT 1,
  `guardian_pic` int(11) NOT NULL DEFAULT 1,
  `guardian_occupation` int(11) NOT NULL,
  `guardian_address` int(11) NOT NULL DEFAULT 1,
  `current_address` int(11) NOT NULL DEFAULT 1,
  `permanent_address` int(11) NOT NULL DEFAULT 1,
  `route_list` int(11) NOT NULL DEFAULT 1,
  `hostel_id` int(11) NOT NULL DEFAULT 1,
  `bank_account_no` int(11) NOT NULL DEFAULT 1,
  `ifsc_code` int(11) NOT NULL,
  `bank_name` int(11) NOT NULL,
  `national_identification_no` int(11) NOT NULL DEFAULT 1,
  `local_identification_no` int(11) NOT NULL DEFAULT 1,
  `rte` int(11) NOT NULL DEFAULT 1,
  `previous_school_details` int(11) NOT NULL DEFAULT 1,
  `student_note` int(11) NOT NULL DEFAULT 1,
  `upload_documents` int(11) NOT NULL DEFAULT 1,
  `staff_designation` int(11) NOT NULL DEFAULT 1,
  `staff_department` int(11) NOT NULL DEFAULT 1,
  `staff_last_name` int(11) NOT NULL DEFAULT 1,
  `staff_father_name` int(11) NOT NULL DEFAULT 1,
  `staff_mother_name` int(11) NOT NULL DEFAULT 1,
  `staff_date_of_joining` int(11) NOT NULL DEFAULT 1,
  `staff_phone` int(11) NOT NULL DEFAULT 1,
  `staff_emergency_contact` int(11) NOT NULL DEFAULT 1,
  `staff_marital_status` int(11) NOT NULL DEFAULT 1,
  `staff_photo` int(11) NOT NULL DEFAULT 1,
  `staff_current_address` int(11) NOT NULL DEFAULT 1,
  `staff_permanent_address` int(11) NOT NULL DEFAULT 1,
  `staff_qualification` int(11) NOT NULL DEFAULT 1,
  `staff_work_experience` int(11) NOT NULL DEFAULT 1,
  `staff_note` int(11) NOT NULL DEFAULT 1,
  `staff_epf_no` int(11) NOT NULL DEFAULT 1,
  `staff_basic_salary` int(11) NOT NULL DEFAULT 1,
  `staff_contract_type` int(11) NOT NULL DEFAULT 1,
  `staff_work_shift` int(11) NOT NULL DEFAULT 1,
  `staff_work_location` int(11) NOT NULL DEFAULT 1,
  `staff_leaves` int(11) NOT NULL DEFAULT 1,
  `staff_account_details` int(11) NOT NULL DEFAULT 1,
  `staff_social_media` int(11) NOT NULL DEFAULT 1,
  `staff_upload_documents` int(11) NOT NULL DEFAULT 1,
  `mobile_api_url` tinytext NOT NULL,
  `app_primary_color_code` varchar(20) DEFAULT NULL,
  `app_secondary_color_code` varchar(20) DEFAULT NULL,
  `app_logo` varchar(250) DEFAULT NULL,
  `student_profile_edit` int(11) NOT NULL DEFAULT 0,
  `start_week` varchar(10) NOT NULL,
  `my_question` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sch_settings`
--

INSERT INTO `sch_settings` (`id`, `name`, `biometric`, `biometric_device`, `email`, `phone`, `address`, `lang_id`, `languages`, `dise_code`, `date_format`, `time_format`, `currency`, `currency_symbol`, `is_rtl`, `is_duplicate_fees_invoice`, `timezone`, `session_id`, `cron_secret_key`, `currency_place`, `class_teacher`, `start_month`, `attendence_type`, `image`, `admin_logo`, `admin_small_logo`, `theme`, `fee_due_days`, `adm_auto_insert`, `adm_prefix`, `adm_start_from`, `adm_no_digit`, `adm_update_status`, `staffid_auto_insert`, `staffid_prefix`, `staffid_start_from`, `staffid_no_digit`, `staffid_update_status`, `is_active`, `online_admission`, `is_blood_group`, `is_student_house`, `roll_no`, `category`, `religion`, `cast`, `mobile_no`, `student_email`, `admission_date`, `lastname`, `middlename`, `student_photo`, `student_height`, `student_weight`, `measurement_date`, `father_name`, `father_phone`, `father_occupation`, `father_pic`, `mother_name`, `mother_phone`, `mother_occupation`, `mother_pic`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_email`, `guardian_pic`, `guardian_occupation`, `guardian_address`, `current_address`, `permanent_address`, `route_list`, `hostel_id`, `bank_account_no`, `ifsc_code`, `bank_name`, `national_identification_no`, `local_identification_no`, `rte`, `previous_school_details`, `student_note`, `upload_documents`, `staff_designation`, `staff_department`, `staff_last_name`, `staff_father_name`, `staff_mother_name`, `staff_date_of_joining`, `staff_phone`, `staff_emergency_contact`, `staff_marital_status`, `staff_photo`, `staff_current_address`, `staff_permanent_address`, `staff_qualification`, `staff_work_experience`, `staff_note`, `staff_epf_no`, `staff_basic_salary`, `staff_contract_type`, `staff_work_shift`, `staff_work_location`, `staff_leaves`, `staff_account_details`, `staff_social_media`, `staff_upload_documents`, `mobile_api_url`, `app_primary_color_code`, `app_secondary_color_code`, `app_logo`, `student_profile_edit`, `start_week`, `my_question`, `created_at`, `updated_at`) VALUES
(1, 'GURUKUL INTERNATIONAL SCHOOL', 0, '', 'support@easyskool.in', '9897982348, 9639251519', '461/A, Shiv Vihar Colony, Railpar Near Old SP Office, Shamli UP', 4, '[\"4\"]', '123456', 'd-m-Y', '12-hour', 'INR', 'Rs', 'disabled', 0, 'Asia/Kolkata', 30, 'ASX9NZxjvmL0SYtSgkV9MAe7l', 'after_number', 'no', '4', 0, '1.png', '1.png', '1.png', 'default.jpg', 30, 0, 'KGPS', '925', 3, 1, 0, '', '', 0, 1, 'no', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '', '#424242', '#eeeeee', '1.png', 0, 'Monday', 0, '2025-11-07 15:33:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section` varchar(60) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'A', 'no', '2022-07-14 03:05:54', NULL),
(24, 'B', 'no', '2025-11-07 10:03:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `send_notification`
--

CREATE TABLE `send_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `message` text DEFAULT NULL,
  `visible_student` varchar(10) NOT NULL DEFAULT 'no',
  `visible_staff` varchar(10) NOT NULL DEFAULT 'no',
  `visible_parent` varchar(10) NOT NULL DEFAULT 'no',
  `created_by` varchar(60) DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `send_notification`
--

INSERT INTO `send_notification` (`id`, `title`, `publish_date`, `date`, `message`, `visible_student`, `visible_staff`, `visible_parent`, `created_by`, `created_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'UT-2 Exams Starts From 15 Nov-2025', '2025-11-07', '2025-11-07', '<p>UT-2 Exams Starts From 15 Nov-2025,  Collect your Admit Card From You Application</p>', 'No', 'Yes', 'No', 'Super Admin', 1, 'no', '2025-11-07 15:41:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `session` varchar(60) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session`, `is_active`, `created_at`, `updated_at`) VALUES
(30, '2025-2026', 'no', '2025-03-09 07:15:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_config`
--

CREATE TABLE `sms_config` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `api_id` varchar(100) NOT NULL,
  `authkey` varchar(100) NOT NULL,
  `senderid` varchar(100) NOT NULL,
  `contact` text DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'disabled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sms_config`
--

INSERT INTO `sms_config` (`id`, `type`, `name`, `api_id`, `authkey`, `senderid`, `contact`, `username`, `url`, `password`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'custom', 'http://164.52.195.161/API/SendMsg.aspx?uname=20172274&pass=godwill11091109&send=GODKIR&priority=1&&d', '', '', '', NULL, NULL, NULL, NULL, 'enabled', '2023-01-03 09:20:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `id` int(11) NOT NULL,
  `source` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `source`, `description`) VALUES
(1, 'By Website', '');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `department` int(11) DEFAULT 0,
  `designation` int(11) DEFAULT 0,
  `qualification` varchar(200) NOT NULL,
  `work_exp` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `father_name` varchar(200) NOT NULL,
  `mother_name` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `emergency_contact_no` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `marital_status` varchar(100) NOT NULL,
  `date_of_joining` date NOT NULL,
  `date_of_leaving` date NOT NULL,
  `local_address` varchar(300) NOT NULL,
  `permanent_address` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `account_title` varchar(200) NOT NULL,
  `bank_account_no` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `ifsc_code` varchar(200) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `payscale` varchar(200) NOT NULL,
  `basic_salary` varchar(200) NOT NULL,
  `epf_no` varchar(200) NOT NULL,
  `contract_type` varchar(100) NOT NULL,
  `shift` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `linkedin` varchar(200) NOT NULL,
  `instagram` varchar(200) NOT NULL,
  `resume` varchar(200) NOT NULL,
  `joining_letter` varchar(200) NOT NULL,
  `resignation_letter` varchar(200) NOT NULL,
  `other_document_name` varchar(200) NOT NULL,
  `other_document_file` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `verification_code` varchar(100) NOT NULL,
  `disable_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `employee_id`, `lang_id`, `department`, `designation`, `qualification`, `work_exp`, `name`, `surname`, `father_name`, `mother_name`, `contact_no`, `emergency_contact_no`, `email`, `dob`, `marital_status`, `date_of_joining`, `date_of_leaving`, `local_address`, `permanent_address`, `note`, `image`, `password`, `gender`, `account_title`, `bank_account_no`, `bank_name`, `ifsc_code`, `bank_branch`, `payscale`, `basic_salary`, `epf_no`, `contract_type`, `shift`, `location`, `facebook`, `twitter`, `linkedin`, `instagram`, `resume`, `joining_letter`, `resignation_letter`, `other_document_name`, `other_document_file`, `user_id`, `is_active`, `verification_code`, `disable_at`) VALUES
(1, 'WITS', 0, 0, 0, 'BCA', '12 YEARS', 'Mr. D.K.', 'Vasistha', 'SHRI SUKHBIR SINGH', 'Shakuntala Sharma', '9897982348', '9758984203', 'demo@easyskool.in', '1990-10-20', 'Married', '2000-01-01', '0000-00-00', 'WITS Building, Shiv Vihar Colony, shamli', 'WITS Building, Shiv Vihar Colony, shamli', '', '1.png', '$2y$10$Q4s2dJpNMeTV63BCdNAj4e8J9LaHG.vm8achjwl11P5BnGmz.DZe6', 'Male', 'CURRENT A/C', '04311132001317', 'PUNJAB NATIONAL BANK', 'PUNB0043110', 'SHAMLI', '', '', '', 'permanent', '', '', '', '', '', '', '', '', '', 'Other Document', '', 0, 1, 'bGhDY1pmcTQ2UWNsS2lEZkJjT0N5YndqR0NLOXk4UHBoSXNXaFVud0QzTT0=', NULL),
(45, 'WITS01', 0, 12, 24, 'Graduate', '', 'Mohit', '', 'Sharma', 'Kanta', '8864921425', '', 'mohit@gis.in', '1993-12-15', 'Single', '2023-04-19', '0000-00-00', 'Vill : Kudana Shamli', 'Vill : Kudana Shamli', '', '', '$2y$10$JDocWdo3zZ09BsQOTNDWQecr8oMYlJ4A/FmV3QZWDD.110Q/ebsMG', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Other Document', '', 0, 1, '', NULL),
(46, 'T01', 0, 11, 22, 'Post Graduate', '3 Years', 'Shikha', '', 'Rajesh Kumat', 'Lokesh Devi', '9457901105', '9897982348', 'shikha@gis.in', '1994-07-05', 'Married', '2025-04-01', '0000-00-00', 'Subash Nagar, Railpar Shamli', 'Subash Nagar, Railpar Shamli', '', '', '$2y$10$rhWO8XYXhDkQCZ1iyzNRlOAfyU4FYAx5TlRSWCsmKCb/s9bxjNIsm', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Other Document', '', 0, 1, '', NULL),
(47, 'T02', 0, 11, 22, 'Graduate', '+4', 'Pooja Dhiman', '', '', '', '9027039436', '', 'pooja@gis.in', '1980-01-01', 'Married', '2025-03-20', '0000-00-00', 'Kudana Road, Shamli', 'Kudana Road, Shamli', '', '', '$2y$10$bymUp/3av4hfhMzJ1QMaw.Gq0ELR6Ir.LL8tXEN20EDJ.CuhEU/B2', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1, '', NULL),
(48, 'T03', 0, 11, 22, '10+2', '0', 'Shagun', 'Panwar', '', '', '7983884527', '9758640680', 'shagun@gis.in', '2007-12-06', 'Single', '2025-09-22', '0000-00-00', 'Subash Nagar, Railpar Sharma', 'Subash Nagar, Railpar Sharma', '', '', '$2y$10$xckQcYlbSTGiKo9Yr/b56.6ZaR0kAytbEqqMfYyBTPx4ze7yDjRbO', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1, '', NULL),
(49, 'T04', 0, 11, 22, 'Graduate', '0', 'Neha', 'Panwar', '', '', '7457888640', '8273445652', 'neha@gis.in', '1994-04-01', 'Married', '2025-09-06', '0000-00-00', 'Shiv Vihar Colony, Near SP Office, Shamli', 'Shiv Vihar Colony, Near SP Office, Shamli', '', '', '$2y$10$ek9QNcYqyACC6od7XAME5Oh9YW2kdh9F29mqyHEKCOuPApExwyCD2', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1, '', NULL),
(50, 'T05', 0, 11, 22, 'Graduate', '', 'Sakshi Gautam', '', '', '', '9759915449', '9412842564', 'sakshi@gis.in', '2006-08-13', 'Single', '2025-10-03', '0000-00-00', 'Shiv Vihar Colony, Near Dr. Tej Singh, Shamli', 'Shiv Vihar Colony, Near Dr. Tej Singh, Shamli', '', '', '$2y$10$y8r4ObzSwtdM79bMwAn4RObjUuK/bHLDYGzRscll9/gRx1mRLm89S', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1, '', NULL),
(51, 'T06', 0, 11, 22, 'Graduate', '', 'Sakshi', 'Malik', 'Deshpal Singh', '', '8533839393', '9927153900', 'sakshimalik@gis.in', '2001-06-10', 'Single', '2024-03-02', '0000-00-00', 'Subash Nagar, RailPar, Shamli', 'Subash Nagar, RailPar, Shamli', '', '', '$2y$10$aUbZJJZqelDuqFfU6.oXAO9ukg.vPRU449ckBNWmS.Iwm2Y7HPy7y', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1, '', NULL),
(52, 'T07', 0, 11, 22, 'Diploma Holder', '+1', 'Rakhi', 'Dhiman', '', '', '6396542388', '9643175343', 'rakhi@gis.in', '1997-07-23', 'Married', '2024-07-22', '0000-00-00', 'Kudana Road, Shamli', 'Kudana Road, Shamli', '', '', '$2y$10$.DemNK3bwYRJXmxhm2yph.b8wdH1it.a/1sQlE41rXAgyNENJD5Wm', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance`
--

CREATE TABLE `staff_attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `staff_attendance_type_id` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `staff_attendance`
--

INSERT INTO `staff_attendance` (`id`, `date`, `staff_id`, `staff_attendance_type_id`, `remark`, `is_active`, `created_at`, `updated_at`) VALUES
(378, '2022-11-20', 1, 5, '', 0, '0000-00-00 00:00:00', NULL),
(1069, '2022-11-25', 1, 1, '', 0, '0000-00-00 00:00:00', NULL),
(1828, '2022-12-20', 1, 1, '', 0, '0000-00-00 00:00:00', NULL),
(1829, '2022-12-19', 1, 1, '', 0, '0000-00-00 00:00:00', NULL),
(1830, '2022-12-18', 1, 5, '', 0, '0000-00-00 00:00:00', NULL),
(1831, '2022-12-17', 1, 1, '', 0, '0000-00-00 00:00:00', NULL),
(1832, '2022-12-16', 1, 1, '', 0, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance_type`
--

CREATE TABLE `staff_attendance_type` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `key_value` varchar(200) NOT NULL,
  `is_active` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `staff_attendance_type`
--

INSERT INTO `staff_attendance_type` (`id`, `type`, `key_value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Present', '<b class=\"text text-success\">P</b>', 'yes', '0000-00-00 00:00:00', '0000-00-00'),
(2, 'Late', '<b class=\"text text-warning\">L</b>', 'yes', '0000-00-00 00:00:00', '0000-00-00'),
(3, 'Absent', '<b class=\"text text-danger\">A</b>', 'yes', '0000-00-00 00:00:00', '0000-00-00'),
(4, 'Half Day', '<b class=\"text text-warning\">F</b>', 'yes', '2018-05-07 01:56:16', '0000-00-00'),
(5, 'Holiday', 'H', 'yes', '0000-00-00 00:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `staff_designation`
--

CREATE TABLE `staff_designation` (
  `id` int(11) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `staff_designation`
--

INSERT INTO `staff_designation` (`id`, `designation`, `is_active`) VALUES
(22, 'Teacher', 'yes'),
(23, 'Admin', 'yes'),
(24, 'Accountant', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `staff_id_card`
--

CREATE TABLE `staff_id_card` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_address` varchar(255) NOT NULL,
  `background` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `sign_image` varchar(100) NOT NULL,
  `header_color` varchar(100) NOT NULL,
  `enable_staff_role` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_id` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_department` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_designation` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_fathers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_mothers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_date_of_joining` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_permanent_address` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_dob` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_phone` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `status` tinyint(1) NOT NULL COMMENT '0=disable,1=enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `staff_id_card`
--

INSERT INTO `staff_id_card` (`id`, `title`, `school_name`, `school_address`, `background`, `logo`, `sign_image`, `header_color`, `enable_staff_role`, `enable_staff_id`, `enable_staff_department`, `enable_designation`, `enable_name`, `enable_fathers_name`, `enable_mothers_name`, `enable_date_of_joining`, `enable_permanent_address`, `enable_staff_dob`, `enable_staff_phone`, `status`) VALUES
(1, 'Staff Identity Card', 'GODWIN PUBLIC SCHOOL', 'Affiliated to C.B.S.E BOARD ,VPO - Kirthal , Baraut (Baghpat), Email ID -www.godwinpublicschool795@gmail.com , \r\nContact - 9058905233', 'background11.png', 'logo11.png', 'sign11.png', '#181f9b', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff_leave_details`
--

CREATE TABLE `staff_leave_details` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `alloted_leave` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `staff_leave_details`
--

INSERT INTO `staff_leave_details` (`id`, `staff_id`, `leave_type_id`, `alloted_leave`) VALUES
(193, 1, 3, ''),
(194, 1, 4, ''),
(195, 1, 5, ''),
(196, 1, 6, ''),
(197, 1, 7, ''),
(198, 1, 8, ''),
(199, 45, 3, ''),
(200, 45, 4, ''),
(201, 45, 5, ''),
(202, 45, 6, ''),
(203, 45, 7, ''),
(204, 45, 8, ''),
(205, 46, 3, ''),
(206, 46, 4, ''),
(207, 46, 5, ''),
(208, 46, 6, ''),
(209, 46, 7, ''),
(210, 46, 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `staff_leave_request`
--

CREATE TABLE `staff_leave_request` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_days` int(11) NOT NULL,
  `employee_remark` varchar(200) NOT NULL,
  `admin_remark` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `applied_by` varchar(200) NOT NULL,
  `document_file` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_payroll`
--

CREATE TABLE `staff_payroll` (
  `id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `pay_scale` varchar(200) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_payslip`
--

CREATE TABLE `staff_payslip` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `basic` float NOT NULL,
  `total_allowance` float NOT NULL,
  `total_deduction` float NOT NULL,
  `leave_deduction` int(11) NOT NULL,
  `tax` varchar(200) NOT NULL,
  `net_salary` float NOT NULL,
  `status` varchar(100) NOT NULL,
  `month` varchar(200) NOT NULL,
  `year` varchar(200) NOT NULL,
  `payment_mode` varchar(200) NOT NULL,
  `payment_date` date NOT NULL,
  `remark` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_rating`
--

CREATE TABLE `staff_rating` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rate` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 decline, 1 Approve',
  `entrydt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_roles`
--

CREATE TABLE `staff_roles` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `staff_roles`
--

INSERT INTO `staff_roles` (`id`, `role_id`, `staff_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 7, 1, 0, '2022-06-23 13:33:55', NULL),
(44, 1, 45, 0, '2025-11-08 04:12:39', NULL),
(45, 2, 46, 0, '2025-08-13 04:33:50', NULL),
(46, 2, 47, 0, '2025-11-08 05:03:45', NULL),
(47, 2, 48, 0, '2025-11-08 05:05:40', NULL),
(48, 2, 49, 0, '2025-11-08 05:07:27', NULL),
(49, 2, 50, 0, '2025-11-08 05:09:18', NULL),
(50, 2, 51, 0, '2025-11-08 05:11:08', NULL),
(51, 2, 52, 0, '2025-11-08 05:12:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_timeline`
--

CREATE TABLE `staff_timeline` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `timeline_date` date NOT NULL,
  `description` varchar(300) NOT NULL,
  `document` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `admission_no` varchar(100) DEFAULT NULL,
  `roll_no` varchar(100) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `rte` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `mobileno` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `cast` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `category_id` varchar(100) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `school_house_id` int(11) NOT NULL,
  `blood_group` varchar(200) NOT NULL,
  `vehroute_id` int(11) NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `adhar_no` varchar(100) DEFAULT NULL,
  `samagra_id` varchar(100) DEFAULT NULL,
  `bank_account_no` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `guardian_is` varchar(100) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_phone` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_phone` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_relation` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(100) DEFAULT NULL,
  `guardian_occupation` varchar(150) NOT NULL,
  `guardian_address` text DEFAULT NULL,
  `guardian_email` varchar(100) DEFAULT NULL,
  `father_pic` varchar(200) NOT NULL,
  `mother_pic` varchar(200) NOT NULL,
  `guardian_pic` varchar(200) NOT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `previous_school` text DEFAULT NULL,
  `height` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `measurement_date` date NOT NULL,
  `dis_reason` int(11) NOT NULL,
  `note` varchar(200) DEFAULT NULL,
  `dis_note` text NOT NULL,
  `app_key` text DEFAULT NULL,
  `parent_app_key` text DEFAULT NULL,
  `disable_at` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `cast_category` varchar(200) DEFAULT '',
  `pan_no` varchar(100) DEFAULT NULL,
  `aadhan_no` varchar(100) DEFAULT NULL,
  `other_no` varchar(100) DEFAULT NULL,
  `father_pan_no` varchar(100) DEFAULT NULL,
  `father_aadhar_no` varchar(100) DEFAULT NULL,
  `father_other_no` varchar(100) DEFAULT NULL,
  `father_id_no` varchar(100) DEFAULT NULL,
  `mother_pan_no` varchar(100) DEFAULT NULL,
  `mother_aadhar_no` varchar(100) DEFAULT NULL,
  `mother_other_no` varchar(100) DEFAULT NULL,
  `mother_id_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `parent_id`, `admission_no`, `roll_no`, `admission_date`, `firstname`, `middlename`, `lastname`, `rte`, `image`, `mobileno`, `email`, `state`, `city`, `pincode`, `religion`, `cast`, `dob`, `gender`, `current_address`, `permanent_address`, `category_id`, `route_id`, `school_house_id`, `blood_group`, `vehroute_id`, `hostel_room_id`, `adhar_no`, `samagra_id`, `bank_account_no`, `bank_name`, `ifsc_code`, `guardian_is`, `father_name`, `father_phone`, `father_occupation`, `mother_name`, `mother_phone`, `mother_occupation`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_occupation`, `guardian_address`, `guardian_email`, `father_pic`, `mother_pic`, `guardian_pic`, `is_active`, `previous_school`, `height`, `weight`, `measurement_date`, `dis_reason`, `note`, `dis_note`, `app_key`, `parent_app_key`, `disable_at`, `created_at`, `updated_at`, `cast_category`, `pan_no`, `aadhan_no`, `other_no`, `father_pan_no`, `father_aadhar_no`, `father_other_no`, `father_id_no`, `mother_pan_no`, `mother_aadhar_no`, `mother_other_no`, `mother_id_no`) VALUES
(569, 1097, 'KGPS93', '1', '2025-11-08', 'Shivangi', '', 'Singh', 'No', 'uploads/student_images/default_female.jpg', '7318235008', '', NULL, NULL, NULL, '', '', '2022-07-15', 'Female', '', '', '128', 0, 0, 'O+', 0, 0, '', '', '', '', '', 'father', 'Satendra Kumar', '7318235008', '', 'Anita Devi', '', '', 'Satendra Kumar', 'Father', '7318235008', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 04:28:06', NULL, 'SC/ST', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(570, 1099, 'KGPS85', '2', '2025-07-01', 'Yatharth', '', '', 'No', 'uploads/student_images/570.jpeg', '8923546215', '', NULL, NULL, NULL, '', '', '2022-10-20', 'Male', 'Dev Nagar Underpass Shamli', 'Dev Nagar Underpass Shamli', '128', 0, 0, 'A+', 0, 0, '', '', '', '', '', 'father', 'Sachin Kumar', '8923546215', '', 'Riya Rani', '', '', 'Sachin Kumar', 'Father', '8923546215', '', 'Dev Nagar Underpass Shamli', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 07:23:39', NULL, 'SC/ST', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(571, 1101, 'KGPS86', '3', '2025-11-08', 'Pravya', '', '', 'No', 'uploads/student_images/571.jpeg', '8791395800', '', NULL, NULL, NULL, 'Hindu', '', '2023-01-01', 'Female', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Ankit Tomar', '8791395800', '', 'Princee', '', '', 'Ankit Tomar', 'Father', '8791395800', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-19 04:03:29', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(572, 1103, 'KGPS87', '4', '2025-11-08', 'Shivansh', '', 'Sharma', 'No', 'uploads/student_images/572.jpeg', '9259364608', '', NULL, NULL, NULL, '', '', '2023-01-02', 'Male', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sachin', '9259364608', '', 'Anu', '', '', 'Sachin', 'Father', '9259364608', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-19 04:05:05', NULL, 'GENERAL', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(573, 1105, 'KGPS92', '5', '2025-11-08', 'Love', '', 'Malik', 'No', 'uploads/student_images/default_male.jpg', '7568242044', '', NULL, NULL, NULL, '', '', '2023-06-30', 'Male', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Tarun Kumar', '7568242044', '', 'Pinki', '', '', 'Tarun Kumar', 'Father', '7568242044', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 04:47:32', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(574, 1107, 'KGPS94', '6', '2025-11-08', 'Dipti', '', '', 'No', 'uploads/student_images/default_female.jpg', '8433115415', '', NULL, NULL, NULL, '', '', '2021-08-05', 'Female', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Amit Kumar', '8433115415', '', 'Km. Deepa', '', '', 'Amit Kumar', 'Father', '8433115415', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 04:50:45', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(575, 1109, 'KGPS89', '7', '2025-11-08', 'Pihu', '', '', 'No', 'uploads/student_images/default_female.jpg', '7248454501', '', NULL, NULL, NULL, '', '', '2023-08-15', 'Female', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sachin', '7248454501', '', 'Tina Kumari', '', '', 'Sachin', 'Father', '7248454501', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 04:52:56', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(576, 1111, 'KGPS90', '8', '2025-11-08', 'Bhagyashree', '', '', 'No', 'uploads/student_images/default_female.jpg', '9817355512', '', NULL, NULL, NULL, '', '', '2022-01-01', 'Female', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Arvind Kumar', '9817355512', '', 'Sangeeta Devi', '', '', 'Arvind Kumar', 'Father', '9817355512', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 04:56:58', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(577, 1113, 'KGPS95', '9', '2025-11-08', 'Yashika', '', '', 'No', 'uploads/student_images/default_female.jpg', '9528731181', '', NULL, NULL, NULL, '', '', '2022-08-10', 'Female', '', '', '128', 0, 0, 'O+', 0, 0, '', '', '', '', '', 'father', 'Raju Kumar', '9528731181', '', 'Priya', '', '', 'Raju Kumar', 'Father', '9528731181', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 04:58:44', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(578, 1115, 'KGPS88', '10', '2025-11-08', 'Aayu', '', 'Kumar', 'No', 'uploads/student_images/default_male.jpg', '7248454501', '', NULL, NULL, NULL, '', '', '2023-08-15', 'Male', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sachin Tomar', '7248454501', '', 'Tina Kumari', '', '', 'Sachin Tomar', 'Father', '7248454501', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 05:02:59', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(579, 1117, 'KGPS84', '11', '2025-04-25', 'Vihan', '', 'Singh', 'No', 'uploads/student_images/579.jpeg', '8618925079', '', NULL, NULL, NULL, '', '', '2023-01-19', 'Male', 'Bhudhana Road Railpar Shamli', 'Bhudhana Road Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Akhil Kumar', '8618925079', '', 'Renu Puniya', '', '', 'Akhil Kumar', 'Father', '8618925079', '', 'Bhudhana Road Railpar Shamli', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 07:22:16', NULL, 'OBC', NULL, NULL, '', '', '266323876472', '', '', '', '631162661861', '', ''),
(580, 1119, 'KGPS82', '12', '2025-04-07', 'Yuvraj', '', '', 'No', 'uploads/student_images/580.jpeg', '9368126915', '', NULL, NULL, NULL, '', '', '2023-01-01', 'Male', 'Shiv Vihar Railpar Shamli', 'Shiv Vihar Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sumit Malik', '9368126915', '', 'Pooja Malik', '', '', 'Sumit Malik', 'Father', '9368126915', '', 'Shiv Vihar Railpar Shamli', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 07:20:16', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(581, 1121, 'KGPS78', '13', '2025-03-26', 'Arpita', '', 'Arora', 'No', 'uploads/student_images/581.jpeg', '8218956359', '', NULL, NULL, NULL, '', '', '2022-05-17', 'Female', 'Railpar Shamli', 'Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Abhishek', '8218956359', '', 'Priti Devi', '', '', 'Abhishek', 'Father', '8218956359', '', 'Railpar Shamli', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 07:15:11', NULL, 'OBC', NULL, NULL, '', '', '311870049535', '', '', '', '870767099286', '', ''),
(582, 1123, 'KGPS77', '14', '2025-03-24', 'Akshita', '', 'Chaudhary', 'No', 'uploads/student_images/582.jpeg', '8279929100', '', NULL, NULL, NULL, '', '', '2022-09-18', 'Female', 'Railpar Shamli', 'Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Mohit Saroha', '8279929100', '', 'Minakshi Taliyan', '', '', 'Mohit Saroha', 'Father', '8279929100', '', 'Railpar Shamli', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 07:10:04', NULL, 'OBC', NULL, NULL, '', '', '338481166712', '', '', '', '856352976690', '', ''),
(583, 1125, 'KGPS76', '15', '2025-03-21', 'Abhiraj', '', 'Nirwal', 'No', 'uploads/student_images/583.jpeg', '8077606178', '', NULL, NULL, NULL, '', '', '2022-03-31', 'Male', 'Railpar Shamli', 'Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Rahul', '8077606178', '', 'Rita', '', '', 'Rahul', 'Father', '8077606178', '', 'Railpar Shamli', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 07:08:27', NULL, 'OBC', NULL, NULL, '', '', '350282522259', '', '', '', '675116751886', '', ''),
(584, 1127, 'KGPS75', '16', '2025-02-25', 'Angad', '', 'Baliyan', 'No', 'uploads/student_images/584.jpeg', '9568228225', '', NULL, NULL, NULL, '', '', '2022-04-11', 'Male', 'Subhash Nagar Railpar Shamli', 'Subhash Nagar Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Nitin Baliyan', '9568228225', '', 'Teenu Baliyan', '', '', 'Nitin Baliyan', 'Father', '9568228225', '', 'Subhash Nagar Railpar Shamli', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 07:06:32', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '345013928815', '', ''),
(585, 1129, 'KGPS74', '17', '2025-11-08', 'Navya', '', '', 'No', 'uploads/student_images/default_female.jpg', '8368255772', '', NULL, NULL, NULL, '', '', '2022-01-22', 'Female', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Abhinav Yadav', '8368255772', '', 'Shalu Yadav', '', '', 'Abhinav Yadav', 'Father', '8368255772', '', '', '', '', '', '', 'no', '', '', '', '2025-11-08', 5, '', 'Transfer Case', NULL, NULL, '2025-09-30', '2025-11-12 09:38:11', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(586, 1131, 'KGPS72', '18', '2025-02-13', 'Aditi', '', '', 'No', 'uploads/student_images/586.jpeg', '8445867063', '', NULL, NULL, NULL, '', '', '2021-07-28', 'Female', 'Kudana Road Railpar Shamli', 'Kudana Road Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Vinay Kumar', '8445867063', '', 'Khushbu', '', '', 'Vinay Kumar', 'Father', '8445867063', '', 'Kudana Road Railpar Shamli', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 06:07:51', NULL, 'GENERAL', NULL, NULL, '', '', '557963531631', '', '', '', '866037904661', '', ''),
(587, 1133, 'KGPS71', '19', '2025-02-10', 'Vedanshi', '', '', 'No', 'uploads/student_images/587.jpeg', '8864826855', '', NULL, NULL, NULL, '', '', '2021-10-03', 'Female', 'Bhagirathi Colony Rajwahe ki Patri Railpar Shamli', 'Bhagirathi Colony Rajwahe ki Patri Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Vikendra Kumar', '8864826855', '', 'Diksha', '', '', 'Vikendra Kumar', 'Father', '8864826855', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 05:01:24', NULL, 'OBC', NULL, NULL, '', '', '379150571467', '', '', '', '548001504422', '', ''),
(588, 1135, 'KGPS70', '20', '2025-02-03', 'Vrinda', '', 'Sharma', 'No', 'uploads/student_images/588.jpeg', '8800434468', '', NULL, NULL, NULL, 'Hindu', '', '2021-07-23', 'Female', 'Shiv Vihar Railpar shamli', 'Shiv Vihar Railpar shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Kapil Sharma', '8800434468', '', 'Suman Sharma', '', '', 'Kapil Sharma', 'Father', '8800434468', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 04:52:24', NULL, 'GENERAL', NULL, NULL, '', '', '723709837582', '', '', '', '302716451747', '', ''),
(589, 1137, 'KGPS96', '21', '2025-09-01', 'Saanvi', '', 'Panwar', 'No', 'uploads/student_images/589.jpeg', '7457888640', '', NULL, NULL, NULL, '', '', '2022-07-15', 'Female', 'Shiv Vihar  Railpar Shamli', 'Shiv Vihar  Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sanjeev Panwar', '7457888640', '', 'Neha', '', '', 'Sanjeev Panwar', 'Father', '7457888640', '', 'Shiv Vihar  Railpar Shamli', '', 'uploads/student_images/589father.jpeg', 'uploads/student_images/589mother.jpeg', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-21 07:35:09', NULL, 'OBC', NULL, NULL, '', '', '981788524131', '', '', '', '', '', ''),
(590, 1139, 'KGPS97', '22', '2025-10-14', 'Ishan', '', '', 'No', 'uploads/student_images/590.jpeg', '9012736631', '', NULL, NULL, NULL, '', '', '2022-04-26', 'Male', 'Meerut -Karnal Road shamli Near Underpass', 'Meerut -Karnal Road shamli Near Underpass', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Anuj Malik', '9012736631', '', 'Ayushi Baliyan', '', '', 'Anuj Malik', 'Father', '9012736631', '', 'Meerut -Karnal Road shamli Near Underpass', '', 'uploads/student_images/590father.jpeg', 'uploads/student_images/590mother.jpeg', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-21 07:27:27', NULL, 'OBC', NULL, NULL, '', '', '935495874475', '', '', '', '326274741575', '', ''),
(591, 1141, 'KGPS98', '23', '2025-11-03', 'Misti', '', '', 'No', 'uploads/student_images/591.jpeg', '8299588239', '', NULL, NULL, NULL, '', '', '2023-01-24', 'Female', 'Railpar Shamli', 'Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Rohit', '8299588239', '', 'Reeta', '7983459048', '', 'Rohit', 'Father', '8299588239', '', 'Railpar Shamli', '', 'uploads/student_images/591father.jpeg', 'uploads/student_images/591mother.jpeg', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-21 07:19:05', NULL, 'OBC', NULL, NULL, '', '', '292604945325', '', '', '', '760613971976', '', ''),
(592, 1143, 'KGPS54', '1', '2025-11-08', 'Nitya', '', 'Malik', 'No', 'uploads/student_images/default_female.jpg', '9149052165', '', NULL, NULL, NULL, '', '', '2021-02-06', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Nitin Kumar', '9149052165', '', 'Neha Chaudhary', '', '', 'Nitin Kumar', 'Father', '9149052165', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 05:39:08', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(593, 1145, 'KGPS64', '2', '2025-11-08', 'Param', '', '', 'No', 'uploads/student_images/default_male.jpg', '9999061572', '', NULL, NULL, NULL, '', '', '2023-01-01', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Rajneesh Kumar', '9999061572', '', 'Pooja', '', '', 'Rajneesh Kumar', 'Father', '9999061572', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 05:42:04', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(594, 1147, 'KGPS63', '3', '2025-11-08', 'Vadanshi', '', 'Ruhela', 'No', 'uploads/student_images/default_female.jpg', '9897752857', '', NULL, NULL, NULL, '', '', '2023-01-01', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sunil Kumar', '9897752857', '', 'Ritu', '', '', 'Sunil Kumar', 'Father', '9897752857', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 05:44:49', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(595, 1149, 'KGPS62', '4', '2025-11-08', 'Shivansh', '', 'Rana', 'No', 'uploads/student_images/default_male.jpg', '9897570067', '', NULL, NULL, NULL, '', '', '2021-10-14', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Monu Rana', '9897570067', '', 'Veenu Kumari', '', '', 'Monu Rana', 'Father', '9897570067', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 05:46:23', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(596, 1151, 'KGPS60', '5', '2025-11-08', 'Bhuvi', '', 'Sonaliya', 'No', 'uploads/student_images/default_female.jpg', '7819862874', '', NULL, NULL, NULL, '', '', '2022-01-03', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Arjun Kumar', '7819862874', '', 'Pooja Rani', '', '', 'Arjun Kumar', 'Father', '7819862874', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 05:48:20', NULL, 'SC/ST', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(597, 1153, 'KGPS59', '6', '2025-11-08', 'Aadi', '', '', 'No', 'uploads/student_images/default_male.jpg', '8279362014', '', NULL, NULL, NULL, '', '', '2021-08-04', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sumit', '8279362014', '', 'Sonam', '', '', 'Sumit', 'Father', '8279362014', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 05:53:45', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(598, 1155, 'KGPS57', '7', '2025-11-08', 'Aavya', '', 'Chaudhary', 'No', 'uploads/student_images/default_female.jpg', '9568156605', '', NULL, NULL, NULL, '', '', '2021-11-12', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Mohit Chaudhary', '9568156605', '', 'Anu Chaudhary', '', '', 'Mohit Chaudhary', 'Father', '9568156605', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 05:55:29', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(599, 1157, 'KGPS49', '8', '2025-11-08', 'Devansh', '', '', 'No', 'uploads/student_images/default_male.jpg', '8923787908', '', NULL, NULL, NULL, '', '', '2020-01-01', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Nitin Kumar', '8923787908', '', 'Shalu', '', '', 'Nitin Kumar', 'Father', '8923787908', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 05:57:53', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(600, 1159, 'KGPS55', '9', '2025-11-08', 'Priya', '', 'Malik', 'No', 'uploads/student_images/default_female.jpg', '9555655255', '', NULL, NULL, NULL, '', '', '2021-09-01', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Vishal Malik', '9555655255', '', 'Lalita Singh', '', '', 'Vishal Malik', 'Father', '9555655255', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:05:19', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(601, 1161, 'KGPS52', '10', '2025-11-08', 'Reedhan', '', 'Malik', 'No', 'uploads/student_images/default_male.jpg', '6396742945', '', NULL, NULL, NULL, '', '', '2021-01-07', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Mulayam Singh', '6396742945', '', 'Alka', '', '', 'Mulayam Singh', 'Father', '6396742945', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:06:50', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(602, 1163, 'KGPS51', '11', '2025-11-08', 'Yashavi', '', 'Garg', 'No', 'uploads/student_images/default_female.jpg', '9457841979', '', NULL, NULL, NULL, '', '', '2022-11-01', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Amit Garg', '9457841979', '', 'Soni Garg', '', '', 'Amit Garg', 'Father', '9457841979', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:08:36', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(603, 1165, 'KGPS56', '12', '2025-11-08', 'Anshi', '', 'Sharma', 'No', 'uploads/student_images/default_female.jpg', '8439980848', '', NULL, NULL, NULL, '', '', '2020-12-25', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Ajay Sharma', '8439980848', '', 'Shivani Sharma', '', '', 'Ajay Sharma', 'Father', '8439980848', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:10:25', NULL, 'GENERAL', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(604, 1167, 'KGPS69', '13', '2025-11-08', 'Ojasvi', '', 'Tomar', 'No', 'uploads/student_images/default_female.jpg', '7248397357', '', NULL, NULL, NULL, '', '', '2021-05-18', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Amit Tomar', '7248397357', '', 'Shivani', '', '', 'Amit Tomar', 'Father', '7248397357', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:16:13', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(605, 1169, 'KGPS 67', '14', '2025-11-08', 'Shreya', '', 'Malik', 'No', 'uploads/student_images/default_female.jpg', '9368126915', '', NULL, NULL, NULL, '', '', '2021-01-01', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sumit Malik', '9368126915', '', 'Pooja Malik', '', '', 'Sumit Malik', 'Father', '9368126915', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:18:47', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(606, 1171, 'KGPS79', '15', '2025-11-08', 'Atharv', '', 'Yadav', 'No', 'uploads/student_images/default_male.jpg', '8218291686', '', NULL, NULL, NULL, '', '', '2021-06-22', 'Male', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Jeetendra Yadav', '8218291686', '', 'Tapsya Yadav', '', '', 'Jeetendra Yadav', 'Father', '8218291686', '', '', '', '', '', '', 'no', '', '', '', '2025-11-08', 4, '', 'Transfer Case', NULL, NULL, '2025-09-30', '2025-11-12 08:46:29', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(607, 1173, 'KGPS73', '16', '2025-11-08', 'Samyak', '', 'Sherwal', 'No', 'uploads/student_images/default_male.jpg', '9773933985', '', NULL, NULL, NULL, '', '', '2021-10-08', 'Male', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Neeraj Kumar', '9773933985', '', 'Preeti Rani', '', '', 'Neeraj Kumar', 'Father', '9773933985', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:27:02', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(608, 1175, 'KGPS81', '17', '2025-04-07', 'Liza', '', 'Singh', 'No', 'uploads/student_images/608.jpeg', '8273661511', '', NULL, NULL, NULL, '', '', '2020-02-02', 'Female', 'Shiv Vihar Railpar Shamli', 'Shiv Vihar Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Parveen Kumar', '8273661511', '', 'Priya Rani', '', '', 'Parveen Kumar', 'Father', '8273661511', '', 'Shiv Vihar Railpar Shamli', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 07:19:06', NULL, 'OBC', NULL, NULL, '', '', '863515260434', '', '', '', '556803216329', '', ''),
(609, 1177, 'KGPS66', '18', '2025-11-08', 'Riddhi', '', '', 'No', 'uploads/student_images/default_female.jpg', '9720116081', '', NULL, NULL, NULL, '', '', '2022-04-27', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Neeraj Tomar', '9720116081', '', 'Kiran', '', '', 'Neeraj Tomar', 'Father', '9720116081', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:33:48', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(610, 1179, 'KGPS61', '1', '2025-11-08', 'Shreya', '', 'Nirwal', 'No', 'uploads/student_images/default_female.jpg', '9760333393', '', NULL, NULL, NULL, '', '', '2021-01-21', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Lovinder Singh', '9760333393', '', 'Rupa Nirwal', '', '', 'Lovinder Singh', 'Father', '9760333393', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:38:20', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(611, 1181, 'KGPS50', '2', '2025-11-08', 'Pranshi', '', '', 'No', 'uploads/student_images/default_female.jpg', '7017287571', '', NULL, NULL, NULL, '', '', '2020-01-07', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Amit Panwar', '7017287571', '', 'Monika Devi', '', '', 'Amit Panwar', 'Father', '7017287571', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:39:57', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(612, 1183, 'KGPS45', '3', '2025-11-08', 'Rudra', '', 'Malik', 'No', 'uploads/student_images/default_male.jpg', '9873242308', '', NULL, NULL, NULL, '', '', '2020-07-30', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sandeep Kumar Malik', '9873242308', '', 'Mona Rani', '', '', 'Sandeep Kumar Malik', 'Father', '9873242308', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:42:29', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(613, 1185, 'KGPS43', '4', '2025-11-08', 'Rudra', '', 'Khokhar', 'No', 'uploads/student_images/default_male.jpg', '9760920935', '', NULL, NULL, NULL, '', '', '2021-03-03', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Shani Kumar', '9760920935', '', 'Ekta', '', '', 'Shani Kumar', 'Father', '9760920935', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:43:57', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(614, 1187, 'KGPS39', '5', '2025-11-08', 'Aarav', '', 'Choudhary', 'No', 'uploads/student_images/default_male.jpg', '7500145962', '', NULL, NULL, NULL, '', '', '2020-01-01', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sonu Kumar', '7500145962', '', 'Rashmi Malik', '', '', 'Sonu Kumar', 'Father', '7500145962', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:45:55', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(615, 1189, 'KGPS31', '6', '2025-11-08', 'Aayushi', '', '', 'No', 'uploads/student_images/default_female.jpg', '9140459946', '', NULL, NULL, NULL, '', '', '2020-01-01', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Sunil Kumar', '9140459946', '', 'Aakanksha', '', '', 'Sunil Kumar', 'Father', '9140459946', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:50:22', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(616, 1191, 'KGPS91', '7', '2025-11-08', 'Avika', '', '', 'No', 'uploads/student_images/default_female.jpg', '8191806130', '', NULL, NULL, NULL, '', '', '2020-01-02', 'Female', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Anuj Kumar', '8191806130', '', 'Minni', '', '', 'Anuj Kumar', 'Father', '8191806130', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:52:07', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(617, 1193, 'KGPS27', '8', '2025-11-08', 'Anushka', '', 'Chaudhary', 'No', 'uploads/student_images/default_female.jpg', '9758210983', '', NULL, NULL, NULL, '', '', '2020-01-20', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Akshay Malik', '9758210983', '', 'Deepa', '', '', 'Akshay Malik', 'Father', '9758210983', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:53:49', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(618, 1195, 'KGPS38', '9', '2025-11-08', 'Srishti', '', 'Singh', 'No', 'uploads/student_images/default_female.jpg', '9026040463', '', NULL, NULL, NULL, '', '', '2020-07-25', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Manjit Singh', '9026040463', '', 'Komal Singh', '', '', 'Manjit Singh', 'Father', '9026040463', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:55:55', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(619, 1197, 'KGPS42', '10', '2025-11-08', 'Aayushi', '', '', 'No', 'uploads/student_images/default_female.jpg', '7417185227', '', NULL, NULL, NULL, '', '', '2020-04-02', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Vikas Kumar', '7417185227', '', 'Komal', '', '', 'Vikas Kumar', 'Father', '7417185227', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 06:58:00', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(620, 1199, 'KGPS34', '11', '2025-11-08', 'Aayush', '', 'Singh', 'No', 'uploads/student_images/default_male.jpg', '9528789002', '', NULL, NULL, NULL, '', '', '2021-02-15', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Virendra Singh', '9528789002', '', 'Sunaina', '', '', 'Virendra Singh', 'Father', '9528789002', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 07:07:41', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(621, 1201, 'KGPS36', '1', '2025-11-08', 'Shiva', '', 'Sharma', 'No', 'uploads/student_images/default_male.jpg', '9897982348', '', NULL, NULL, NULL, '', '', '2019-12-11', 'Male', '', '', '164', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Durgesh Kumar Sharma', '9897982348', '', 'Shika Sharma', '', '', 'Durgesh Kumar Sharma', 'Father', '9897982348', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 07:15:21', NULL, 'GENERAL', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(622, 1203, 'KGPS48', '2', '2025-11-08', 'Ivanshi', '', 'Tomar', 'No', 'uploads/student_images/default_female.jpg', '8707584780', '', NULL, NULL, NULL, '', '', '2020-02-24', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Dheeraj Tomar', '8707584780', '', 'Seema', '', '', 'Dheeraj Tomar', 'Father', '8707584780', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 07:19:08', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(623, 1205, 'GIS1', '1', '2025-11-08', 'Nitya', '', 'Sharma', 'No', 'uploads/student_images/default_female.jpg', '9897982348', '', NULL, NULL, NULL, '', '', '2018-09-15', 'Female', '', '', '164', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Durgesh Kumar Sharma', '9897982348', '', 'Shikha Sharma', '', '', 'Durgesh Kumar Sharma', 'Father', '9897982348', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 07:24:24', NULL, 'GENERAL', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(624, 1207, 'GIS2', '2', '2025-11-08', 'Bhoomi', '', 'Singh', 'No', 'uploads/student_images/default_female.jpg', '9634937999', '', NULL, NULL, NULL, '', '', '2018-12-11', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Manjit Singh', '9634937999', '', 'Komal Singh', '', '', 'Manjit Singh', 'Father', '9634937999', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 07:26:45', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(625, 1209, 'GIS3', '3', '2025-11-08', 'Pranav', '', 'Tomar', 'No', 'uploads/student_images/default_male.jpg', '7455940543', '', NULL, NULL, NULL, '', '', '2019-01-01', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Amit Tomar', '7455940543', '', 'Pooja Kumari', '', '', 'Amit Tomar', 'Father', '7455940543', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 07:29:05', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(626, 1211, 'GIS4', '1', '2025-11-08', 'Arnima', '', 'Tomar', 'No', 'uploads/student_images/default_female.jpg', '7078446887', '', NULL, NULL, NULL, '', '', '2018-06-08', 'Female', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Amit Tomar', '7078446887', '', 'Reeta Tomar', '', '', 'Amit Tomar', 'Father', '7078446887', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 07:30:43', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(627, 1213, 'GIS5', '2', '2025-11-08', 'Shivansh', '', 'Raghuvanshi', 'No', 'uploads/student_images/default_male.jpg', '9758640680', '', NULL, NULL, NULL, '', '', '2018-01-01', 'Male', '', '', '129', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Anshul Raghuvanshi', '9758640680', '', 'Soniya', '', '', 'Anshul Raghuvanshi', 'Father', '9758640680', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 07:32:52', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(628, 1215, 'GIS6', '3', '2025-11-08', 'Pari', '', '', 'No', 'uploads/student_images/default_female.jpg', '7417185227', '', NULL, NULL, NULL, '', '', '2018-01-01', 'Female', '', '', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Vikas', '7417185227', '', 'Komal', '', '', 'Vikas', 'Father', '7417185227', '', '', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-08 07:34:51', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(629, 1217, 'GIS7', '1', '2025-04-02', 'Vaidik', '', 'Malik', 'No', 'uploads/student_images/629.jpeg', '9871662056', '', NULL, NULL, NULL, '', '', '2017-12-25', 'Male', 'Shiv Vihar Railpar Shamli', 'Shiv Vihar Railpar Shamli', '128', 0, 0, '', 0, 0, '', '', '', '', '', 'father', 'Nishant Malik', '9871662056', '', 'Archna Malik', '', '', 'Nishant Malik', 'Father', '9871662056', '', 'Shiv Vihar Railpar Shamli', '', '', '', '', 'yes', '', '', '', '2025-11-08', 0, '', '', NULL, NULL, '0000-00-00', '2025-11-11 07:16:53', NULL, 'OBC', NULL, NULL, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_applyleave`
--

CREATE TABLE `student_applyleave` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `apply_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `docs` text NOT NULL,
  `reason` text NOT NULL,
  `approve_by` int(11) NOT NULL,
  `request_type` int(11) NOT NULL COMMENT '0 student,1 staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `student_applyleave`
--

INSERT INTO `student_applyleave` (`id`, `student_session_id`, `from_date`, `to_date`, `apply_date`, `status`, `created_at`, `docs`, `reason`, `approve_by`, `request_type`) VALUES
(1, 503, '2025-03-10', '2025-03-12', '2025-03-09', 1, '2025-03-09 07:31:58', '', 'Marriage Party', 1, 0),
(2, 537, '2025-11-08', '2025-11-08', '2025-11-07', 0, '2025-11-07 15:59:25', '2.jpg', 'Fever', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_attendences`
--

CREATE TABLE `student_attendences` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `biometric_attendence` int(11) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `attendence_type_id` int(11) DEFAULT NULL,
  `remark` varchar(200) NOT NULL,
  `biometric_device_data` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `student_attendences`
--

INSERT INTO `student_attendences` (`id`, `student_session_id`, `biometric_attendence`, `date`, `attendence_type_id`, `remark`, `biometric_device_data`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 503, 0, '2025-03-09', 4, '', NULL, 'no', '2025-03-09 07:16:31', NULL),
(2, 535, 0, '2025-06-21', 4, '', NULL, 'no', '2025-06-21 07:37:20', NULL),
(3, 529, 0, '2025-06-21', 4, '', NULL, 'no', '2025-06-21 07:37:20', NULL),
(4, 528, 0, '2025-06-21', 1, '', NULL, 'no', '2025-06-21 07:37:20', NULL),
(5, 527, 0, '2025-06-21', 1, '', NULL, 'no', '2025-06-21 07:37:20', NULL),
(6, 522, 0, '2025-06-21', 1, '', NULL, 'no', '2025-06-21 07:37:20', NULL),
(7, 503, 0, '2025-06-21', 1, '', NULL, 'no', '2025-06-21 07:37:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_doc`
--

CREATE TABLE `student_doc` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `doc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `student_doc`
--

INSERT INTO `student_doc` (`id`, `student_id`, `title`, `doc`) VALUES
(1, 478, 'TC', 'For-Re-Seller.jpg'),
(2, 478, 'Birth Certificate', 'For-Re-Seller.jpg'),
(3, 588, 'Birth Certificate', '461646877_1517075038937550_2100875899161833068_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student_edit_fields`
--

CREATE TABLE `student_edit_fields` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `feemaster_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `amount_discount` float(10,2) NOT NULL,
  `amount_fine` float(10,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees_deposite`
--

CREATE TABLE `student_fees_deposite` (
  `id` int(11) NOT NULL,
  `student_fees_master_id` int(11) DEFAULT NULL,
  `fee_groups_feetype_id` int(11) DEFAULT NULL,
  `amount_detail` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees_discounts`
--

CREATE TABLE `student_fees_discounts` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `fees_discount_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'assigned',
  `payment_id` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `student_fees_discounts`
--

INSERT INTO `student_fees_discounts` (`id`, `student_session_id`, `fees_discount_id`, `status`, `payment_id`, `description`, `is_active`, `created_at`) VALUES
(1, 602, 6, 'assigned', NULL, NULL, 'no', '2025-11-09 05:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `student_fees_master`
--

CREATE TABLE `student_fees_master` (
  `id` int(11) NOT NULL,
  `is_system` int(11) NOT NULL DEFAULT 0,
  `student_session_id` int(11) DEFAULT NULL,
  `fee_session_group_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT 0.00,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `student_fees_master`
--

INSERT INTO `student_fees_master` (`id`, `is_system`, `student_session_id`, `fee_session_group_id`, `amount`, `is_active`, `created_at`) VALUES
(1, 0, 470, 110, 0.00, 'no', '2023-04-23 09:30:03'),
(2, 1, 470, 112, 3500.00, 'no', '2023-04-25 09:22:15'),
(3, 0, 471, 113, 0.00, 'no', '2023-04-24 09:50:27'),
(4, 0, 472, 117, 0.00, 'no', '2023-04-25 06:10:06'),
(5, 0, 473, 115, 0.00, 'no', '2023-04-25 06:15:00'),
(6, 0, 474, 117, 0.00, 'no', '2023-04-25 06:24:58'),
(7, 1, 474, 112, 0.00, 'no', '2023-04-25 06:28:22'),
(8, 1, 472, 112, 9800.00, 'no', '2023-04-25 06:30:46'),
(9, 0, 473, 121, 0.00, 'no', '2023-04-25 06:35:42'),
(10, 0, 475, 121, 0.00, 'no', '2023-04-25 06:35:42'),
(11, 0, 471, 122, 0.00, 'no', '2023-04-25 09:18:07'),
(12, 0, 495, 118, 0.00, 'no', '2023-04-25 11:55:41'),
(13, 0, 496, 115, 0.00, 'no', '2023-04-25 12:03:02'),
(14, 1, 497, 127, 38000.00, 'no', '2023-04-25 12:28:57'),
(15, 1, 498, 128, 35000.00, 'no', '2023-04-25 12:29:30'),
(16, 1, 499, 127, 9000.00, 'no', '2023-04-25 12:40:45'),
(17, 0, 499, 129, 0.00, 'no', '2023-04-25 12:35:15'),
(18, 0, 501, 129, 0.00, 'no', '2023-06-02 05:20:03'),
(19, 0, 503, 132, 0.00, 'no', '2024-04-12 03:59:25'),
(20, 0, 503, 134, 0.00, 'no', '2024-04-12 05:11:12'),
(22, 0, 503, 137, 0.00, 'no', '2024-04-12 05:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `student_session`
--

CREATE TABLE `student_session` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `vehroute_id` int(11) DEFAULT NULL,
  `transport_fees` float(10,2) NOT NULL DEFAULT 0.00,
  `fees_discount` float(10,2) NOT NULL DEFAULT 0.00,
  `is_active` varchar(255) DEFAULT 'no',
  `is_alumni` int(11) NOT NULL,
  `default_login` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `student_session`
--

INSERT INTO `student_session` (`id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `hostel_room_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `is_alumni`, `default_login`, `created_at`, `updated_at`) VALUES
(602, 30, 569, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:36:41', NULL),
(603, 30, 570, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:35:45', NULL),
(604, 30, 571, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:35:08', NULL),
(605, 30, 572, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:35:32', NULL),
(606, 30, 573, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:36:28', NULL),
(607, 30, 574, 68, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 04:50:45', NULL),
(608, 30, 575, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:36:11', NULL),
(609, 30, 576, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:38:52', NULL),
(610, 30, 577, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:37:11', NULL),
(611, 30, 578, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:35:58', NULL),
(612, 30, 579, 68, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 05:08:58', NULL),
(613, 30, 580, 68, 1, 0, 0, NULL, 0.00, 200.00, 'no', 0, 0, '2025-11-13 08:56:19', NULL),
(614, 30, 581, 68, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 05:13:18', NULL),
(615, 30, 582, 68, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 05:16:45', NULL),
(616, 30, 583, 68, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-10 10:02:36', NULL),
(617, 30, 584, 68, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-10 09:57:20', NULL),
(618, 30, 585, 68, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 11:24:29', NULL),
(619, 30, 586, 68, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 05:23:14', NULL),
(620, 30, 587, 68, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 05:25:15', NULL),
(621, 30, 588, 68, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 05:29:06', NULL),
(622, 30, 589, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:36:59', NULL),
(623, 30, 590, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:37:22', NULL),
(624, 30, 591, 68, 24, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-12 08:37:39', NULL),
(625, 30, 592, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 05:39:08', NULL),
(626, 30, 593, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 05:42:04', NULL),
(627, 30, 594, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 11:25:45', NULL),
(628, 30, 595, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 05:46:23', NULL),
(629, 30, 596, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 05:48:20', NULL),
(630, 30, 597, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-10 10:05:11', NULL),
(631, 30, 598, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-09 15:35:42', NULL),
(632, 30, 599, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-19 03:43:39', NULL),
(633, 30, 600, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 08:30:07', NULL),
(634, 30, 601, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:06:50', NULL),
(635, 30, 602, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:08:36', NULL),
(636, 30, 603, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 07:59:27', NULL),
(637, 30, 604, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 09:39:10', NULL),
(638, 30, 605, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:18:47', NULL),
(639, 30, 606, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:25:11', NULL),
(640, 30, 607, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:27:02', NULL),
(641, 30, 608, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:31:14', NULL),
(642, 30, 609, 69, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:33:48', NULL),
(643, 30, 610, 70, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:38:20', NULL),
(644, 30, 611, 70, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-09 15:32:27', NULL),
(645, 30, 612, 70, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 09:33:06', NULL),
(646, 30, 613, 70, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:43:57', NULL),
(647, 30, 614, 70, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:45:55', NULL),
(648, 30, 615, 70, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 08:48:37', NULL),
(649, 30, 616, 70, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:52:07', NULL),
(650, 30, 617, 70, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:53:49', NULL),
(651, 30, 618, 70, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 09:25:30', NULL),
(652, 30, 619, 70, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 06:58:00', NULL),
(653, 30, 620, 70, 1, 0, 0, NULL, 0.00, -100.00, 'no', 0, 0, '2025-11-09 15:34:34', NULL),
(654, 30, 621, 71, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 07:15:21', NULL),
(655, 30, 622, 71, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 07:19:08', NULL),
(656, 30, 623, 72, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 07:24:24', NULL),
(657, 30, 624, 72, 1, 0, 0, NULL, 0.00, -200.00, 'no', 0, 0, '2025-11-20 04:05:48', NULL),
(658, 30, 625, 72, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 07:29:05', NULL),
(659, 30, 626, 73, 1, 0, 0, NULL, 0.00, 1600.00, 'no', 0, 0, '2025-11-13 08:52:21', NULL),
(660, 30, 627, 73, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 11:27:51', NULL),
(661, 30, 628, 73, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-19 03:51:04', NULL),
(662, 30, 629, 74, 1, 0, 0, NULL, 0.00, 0.00, 'no', 0, 0, '2025-11-08 07:39:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_sibling`
--

CREATE TABLE `student_sibling` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `sibling_student_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_attendances`
--

CREATE TABLE `student_subject_attendances` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `subject_timetable_id` int(11) DEFAULT NULL,
  `attendence_type_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_timeline`
--

CREATE TABLE `student_timeline` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `timeline_date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(86, 'HINDI-(O)', 'HINDI-ORAL', 'theory', 'no', '2025-11-08 04:33:50', NULL),
(92, 'HINDI-(W)', 'HINDI-WRITTEN', 'theory', 'no', '2025-11-08 04:36:14', NULL),
(93, 'ENGLISH-(O)', 'ENGLISH-ORAL', 'theory', 'no', '2025-11-08 04:36:38', NULL),
(94, 'ENGLISH-(W)', 'ENGLISH-WRITTEN', 'theory', 'no', '2025-11-08 04:36:55', NULL),
(95, 'MATHS-(O)', 'MATHS-ORAL', 'theory', 'no', '2025-11-08 04:37:56', NULL),
(96, 'MATHS-(W)', 'MATHS-WRITTEN', 'theory', 'no', '2025-11-08 04:38:07', NULL),
(97, 'G.K.-(O)', 'G.K.-ORAL', 'theory', 'no', '2025-11-08 04:43:50', NULL),
(98, 'DRAWING', 'DRAWING', 'theory', 'no', '2025-11-08 04:39:08', NULL),
(99, 'G.K.', 'G.K.', 'theory', 'no', '2025-11-08 04:43:05', NULL),
(100, 'E.V.S.(O)', 'E.V.S.-ORAL', 'theory', 'no', '2025-11-08 04:43:44', NULL),
(101, 'E.V.S.(W)', 'E.V.S.WRITTEN', 'theory', 'no', '2025-11-08 04:44:17', NULL),
(102, 'HINDI-I', 'HINDI-I', 'theory', 'no', '2025-11-08 04:44:50', NULL),
(103, 'ENGLISH-I', 'ENGLISH-I', 'theory', 'no', '2025-11-08 04:45:02', NULL),
(104, 'HINDI-II', 'HINDI-II', 'theory', 'no', '2025-11-08 04:45:17', NULL),
(105, 'ENGLISH-II', 'ENGLISH-II', 'theory', 'no', '2025-11-08 04:45:33', NULL),
(106, 'MATHS', 'MATHS', 'theory', 'no', '2025-11-08 04:45:39', NULL),
(107, 'E.V.S.', 'E.V.S.', 'theory', 'no', '2025-11-08 04:46:05', NULL),
(108, 'COMPUTER', 'COMPUTER', 'theory', 'no', '2025-11-08 04:46:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_groups`
--

CREATE TABLE `subject_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `subject_groups`
--

INSERT INTO `subject_groups` (`id`, `name`, `description`, `session_id`, `created_at`) VALUES
(22, 'Play', 'For Class Play', 30, '2025-11-08 05:14:43'),
(23, 'Nur', 'For Class Nur.', 30, '2025-11-08 05:15:16'),
(24, 'L.K.G.', 'For Class L.K.G', 30, '2025-11-08 05:19:06'),
(25, 'U.K.G', 'For Class U.K.G', 30, '2025-11-08 05:19:52'),
(26, '1st Class', 'For Class 1st', 30, '2025-11-08 05:20:32'),
(27, '2nd Class', 'For Class 2nd', 30, '2025-11-08 05:21:27'),
(28, '3rd', 'For Class 3rd', 30, '2025-11-08 05:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `subject_group_class_sections`
--

CREATE TABLE `subject_group_class_sections` (
  `id` int(11) NOT NULL,
  `subject_group_id` int(11) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `subject_group_class_sections`
--

INSERT INTO `subject_group_class_sections` (`id`, `subject_group_id`, `class_section_id`, `session_id`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(29, 22, 106, 30, NULL, 0, '2025-11-08 05:14:43', NULL),
(30, 22, 107, 30, NULL, 0, '2025-11-08 05:14:43', NULL),
(31, 23, 108, 30, NULL, 0, '2025-11-08 05:15:16', NULL),
(32, 24, 109, 30, NULL, 0, '2025-11-08 05:19:06', NULL),
(33, 25, 110, 30, NULL, 0, '2025-11-08 05:19:52', NULL),
(34, 26, 111, 30, NULL, 0, '2025-11-08 05:20:32', NULL),
(35, 27, 112, 30, NULL, 0, '2025-11-08 05:21:27', NULL),
(36, 28, 113, 30, NULL, 0, '2025-11-08 05:21:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_group_subjects`
--

CREATE TABLE `subject_group_subjects` (
  `id` int(11) NOT NULL,
  `subject_group_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `subject_group_subjects`
--

INSERT INTO `subject_group_subjects` (`id`, `subject_group_id`, `session_id`, `subject_id`, `created_at`) VALUES
(161, 22, 30, 86, '2025-11-08 05:14:43'),
(162, 22, 30, 92, '2025-11-08 05:14:43'),
(163, 22, 30, 93, '2025-11-08 05:14:43'),
(164, 22, 30, 94, '2025-11-08 05:14:43'),
(165, 22, 30, 95, '2025-11-08 05:14:43'),
(166, 22, 30, 96, '2025-11-08 05:14:43'),
(167, 22, 30, 97, '2025-11-08 05:14:43'),
(168, 22, 30, 98, '2025-11-08 05:14:43'),
(169, 23, 30, 86, '2025-11-08 05:15:16'),
(170, 23, 30, 92, '2025-11-08 05:15:16'),
(171, 23, 30, 93, '2025-11-08 05:15:16'),
(172, 23, 30, 94, '2025-11-08 05:15:16'),
(173, 23, 30, 95, '2025-11-08 05:15:16'),
(174, 23, 30, 96, '2025-11-08 05:15:16'),
(175, 23, 30, 97, '2025-11-08 05:15:16'),
(176, 23, 30, 98, '2025-11-08 05:15:16'),
(177, 24, 30, 86, '2025-11-08 05:19:06'),
(178, 24, 30, 92, '2025-11-08 05:19:06'),
(179, 24, 30, 93, '2025-11-08 05:19:06'),
(180, 24, 30, 94, '2025-11-08 05:19:06'),
(181, 24, 30, 95, '2025-11-08 05:19:06'),
(182, 24, 30, 96, '2025-11-08 05:19:06'),
(183, 24, 30, 97, '2025-11-08 05:19:06'),
(184, 24, 30, 99, '2025-11-08 05:19:06'),
(185, 25, 30, 86, '2025-11-08 05:19:52'),
(186, 25, 30, 92, '2025-11-08 05:19:52'),
(187, 25, 30, 93, '2025-11-08 05:19:52'),
(188, 25, 30, 94, '2025-11-08 05:19:52'),
(189, 25, 30, 95, '2025-11-08 05:19:52'),
(190, 25, 30, 96, '2025-11-08 05:19:52'),
(191, 25, 30, 97, '2025-11-08 05:19:52'),
(192, 25, 30, 98, '2025-11-08 05:19:52'),
(193, 25, 30, 99, '2025-11-08 05:19:52'),
(194, 25, 30, 100, '2025-11-08 05:19:52'),
(195, 25, 30, 101, '2025-11-08 05:19:52'),
(196, 26, 30, 98, '2025-11-08 05:20:32'),
(197, 26, 30, 99, '2025-11-08 05:20:32'),
(198, 26, 30, 102, '2025-11-08 05:20:32'),
(199, 26, 30, 103, '2025-11-08 05:20:32'),
(200, 26, 30, 104, '2025-11-08 05:20:32'),
(201, 26, 30, 105, '2025-11-08 05:20:32'),
(202, 26, 30, 106, '2025-11-08 05:20:32'),
(203, 26, 30, 107, '2025-11-08 05:20:32'),
(204, 26, 30, 108, '2025-11-08 05:20:32'),
(205, 27, 30, 98, '2025-11-08 05:21:27'),
(206, 27, 30, 99, '2025-11-08 05:21:27'),
(207, 27, 30, 102, '2025-11-08 05:21:27'),
(208, 27, 30, 103, '2025-11-08 05:21:27'),
(209, 27, 30, 104, '2025-11-08 05:21:27'),
(210, 27, 30, 105, '2025-11-08 05:21:27'),
(211, 27, 30, 106, '2025-11-08 05:21:27'),
(212, 27, 30, 107, '2025-11-08 05:21:27'),
(213, 27, 30, 108, '2025-11-08 05:21:27'),
(214, 28, 30, 98, '2025-11-08 05:21:56'),
(215, 28, 30, 99, '2025-11-08 05:21:56'),
(216, 28, 30, 102, '2025-11-08 05:21:56'),
(217, 28, 30, 103, '2025-11-08 05:21:56'),
(218, 28, 30, 104, '2025-11-08 05:21:56'),
(219, 28, 30, 105, '2025-11-08 05:21:56'),
(220, 28, 30, 106, '2025-11-08 05:21:56'),
(221, 28, 30, 107, '2025-11-08 05:21:56'),
(222, 28, 30, 108, '2025-11-08 05:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `subject_syllabus`
--

CREATE TABLE `subject_syllabus` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_for` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_from` varchar(255) NOT NULL,
  `time_to` varchar(255) NOT NULL,
  `presentation` text NOT NULL,
  `attachment` text NOT NULL,
  `lacture_youtube_url` varchar(255) NOT NULL,
  `lacture_video` varchar(255) NOT NULL,
  `sub_topic` text NOT NULL,
  `teaching_method` text NOT NULL,
  `general_objectives` text NOT NULL,
  `previous_knowledge` text NOT NULL,
  `comprehensive_questions` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject_timetable`
--

CREATE TABLE `subject_timetable` (
  `id` int(11) NOT NULL,
  `day` varchar(20) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `subject_group_id` int(11) DEFAULT NULL,
  `subject_group_subject_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `time_from` varchar(20) DEFAULT NULL,
  `time_to` varchar(20) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `room_no` varchar(20) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submit_assignment`
--

CREATE TABLE `submit_assignment` (
  `id` int(11) NOT NULL,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `docs` varchar(225) NOT NULL,
  `file_name` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_admitcards`
--

CREATE TABLE `template_admitcards` (
  `id` int(11) NOT NULL,
  `template` varchar(250) DEFAULT NULL,
  `heading` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `left_logo` varchar(200) DEFAULT NULL,
  `right_logo` varchar(200) DEFAULT NULL,
  `exam_name` varchar(200) DEFAULT NULL,
  `school_name` varchar(200) DEFAULT NULL,
  `exam_center` varchar(200) DEFAULT NULL,
  `sign` varchar(200) DEFAULT NULL,
  `background_img` varchar(200) DEFAULT NULL,
  `is_name` int(11) NOT NULL DEFAULT 1,
  `is_father_name` int(11) NOT NULL DEFAULT 1,
  `is_mother_name` int(11) NOT NULL DEFAULT 1,
  `is_dob` int(11) NOT NULL DEFAULT 1,
  `is_admission_no` int(11) NOT NULL DEFAULT 1,
  `is_roll_no` int(11) NOT NULL DEFAULT 1,
  `is_address` int(11) NOT NULL DEFAULT 1,
  `is_gender` int(11) NOT NULL DEFAULT 1,
  `is_photo` int(11) NOT NULL,
  `is_class` int(11) NOT NULL DEFAULT 0,
  `is_section` int(11) NOT NULL DEFAULT 0,
  `content_footer` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `template_admitcards`
--

INSERT INTO `template_admitcards` (`id`, `template`, `heading`, `title`, `left_logo`, `right_logo`, `exam_name`, `school_name`, `exam_center`, `sign`, `background_img`, `is_name`, `is_father_name`, `is_mother_name`, `is_dob`, `is_admission_no`, `is_roll_no`, `is_address`, `is_gender`, `is_photo`, `is_class`, `is_section`, `content_footer`, `created_at`, `updated_at`) VALUES
(4, 'Admit Card - Unit Test-1', 'Admit Card - Heading', 'Admit Card Title', 'ee091780443ac5e67e2e0036ff6ab25d.png', '6bf8054cbdcc6bced9e3355d0760235e.png', 'Unit Test : 1', 'Gurukul International School', 'Self Centre', '', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'This is a System Generated Admit Card. ', '2025-11-22 14:54:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_marksheets`
--

CREATE TABLE `template_marksheets` (
  `id` int(11) NOT NULL,
  `template` varchar(200) DEFAULT NULL,
  `heading` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `left_logo` varchar(200) DEFAULT NULL,
  `right_logo` varchar(200) DEFAULT NULL,
  `exam_name` varchar(200) DEFAULT NULL,
  `school_name` varchar(200) DEFAULT NULL,
  `exam_center` varchar(200) DEFAULT NULL,
  `left_sign` varchar(200) DEFAULT NULL,
  `middle_sign` varchar(200) DEFAULT NULL,
  `right_sign` varchar(200) DEFAULT NULL,
  `exam_session` int(11) DEFAULT 1,
  `is_name` int(11) DEFAULT 1,
  `is_father_name` int(11) DEFAULT 1,
  `is_mother_name` int(11) DEFAULT 1,
  `is_dob` int(11) DEFAULT 1,
  `is_admission_no` int(11) DEFAULT 1,
  `is_roll_no` int(11) DEFAULT 1,
  `is_photo` int(11) DEFAULT 1,
  `is_division` int(11) NOT NULL DEFAULT 1,
  `is_customfield` int(11) NOT NULL,
  `background_img` varchar(200) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `is_class` int(11) NOT NULL DEFAULT 0,
  `is_section` int(11) NOT NULL DEFAULT 0,
  `content` text DEFAULT NULL,
  `content_footer` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `is_header` int(11) NOT NULL,
  `is_footer` int(11) NOT NULL,
  `footer_img` text NOT NULL,
  `header_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `teacher_subject_id` int(11) DEFAULT NULL,
  `day_name` varchar(50) DEFAULT NULL,
  `start_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `complete_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport_route`
--

CREATE TABLE `transport_route` (
  `id` int(11) NOT NULL,
  `route_title` varchar(100) DEFAULT NULL,
  `no_of_vehicle` int(11) DEFAULT NULL,
  `fare` float(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `transport_route`
--

INSERT INTO `transport_route` (`id`, `route_title`, `no_of_vehicle`, `fare`, `note`, `is_active`, `created_at`, `updated_at`) VALUES
(10, 'SHAMLI-INNER', NULL, 500.00, NULL, 'no', '2023-04-23 09:10:09', NULL),
(11, 'SHMALI-OUTER', NULL, 600.00, NULL, 'no', '2023-04-23 09:10:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `ipaddress` varchar(100) DEFAULT NULL,
  `user_agent` varchar(500) DEFAULT NULL,
  `login_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `user`, `role`, `class_section_id`, `ipaddress`, `user_agent`, `login_datetime`) VALUES
(1, 'admin@easyskool.in', 'Super Admin', NULL, '103.68.21.69', 'Chrome 112.0.0.0, Windows 10', '2023-04-23 11:52:49'),
(2, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:30dd:b7e9:40de:7559:b412:3a76', 'Chrome 112.0.0.0, Mac OS X', '2023-04-23 12:42:54'),
(3, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:30dd:b7e9:e14f:ee5b:7800:3eef', 'Chrome 112.0.0.0, Mac OS X', '2023-04-23 15:08:04'),
(4, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:30dd:b7e9:e14f:ee5b:7800:3eef', 'Chrome 112.0.0.0, Mac OS X', '2023-04-23 15:34:48'),
(5, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:30dd:b7e9:e14f:ee5b:7800:3eef', 'Chrome 112.0.0.0, Mac OS X', '2023-04-23 15:36:23'),
(6, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:30dd:b7e9:e14f:ee5b:7800:3eef', 'Chrome 112.0.0.0, Mac OS X', '2023-04-23 15:37:19'),
(7, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.78', 'Chrome 112.0.0.0, Windows 10', '2023-04-24 09:43:13'),
(8, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.78', 'Chrome 112.0.0.0, Windows 10', '2023-04-24 14:21:22'),
(9, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 112.0.0.0, Windows 10', '2023-04-25 11:25:30'),
(10, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 109.0.0.0, Windows 10', '2023-04-25 11:40:22'),
(11, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 112.0.0.0, Windows 10', '2023-04-25 11:42:50'),
(12, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 112.0.0.0, Windows 10', '2023-04-25 11:43:33'),
(13, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 112.0.0.0, Windows 10', '2023-04-25 17:17:08'),
(14, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 112.0.0.0, Windows 10', '2023-04-25 17:45:22'),
(15, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:30dc:6801:65ff:dbb9:509d:6459', 'Chrome 112.0.0.0, Mac OS X', '2023-04-25 20:25:21'),
(16, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:5fd5:1eb4:212b:baea:e99c:723e', 'Chrome 112.0.0.0, Windows 10', '2023-04-25 22:29:14'),
(17, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.80', 'Chrome 113.0.0.0, Windows 10', '2023-05-15 10:08:08'),
(18, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.80', 'Chrome 113.0.0.0, Windows 10', '2023-05-15 10:25:58'),
(19, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.80', 'Chrome 113.0.0.0, Windows 10', '2023-05-15 10:27:46'),
(20, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.70', 'Chrome 113.0.0.0, Windows 10', '2023-05-31 10:10:10'),
(21, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.70', 'Chrome 113.0.0.0, Windows 10', '2023-05-31 10:28:23'),
(22, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 113.0.0.0, Windows 10', '2023-06-02 10:48:47'),
(23, 'demo@easyskool.in', 'Super Admin', NULL, '2001:bc8:1201:609:46a8:42ff:fe38:fa1c', 'Chrome 114.0.0.0, Windows 10', '2023-06-07 06:50:16'),
(24, 'demo@easyskool.in', 'Super Admin', NULL, '122.162.149.144', 'Chrome 114.0.0.0, Windows 10', '2023-06-15 10:12:23'),
(25, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 114.0.0.0, Windows 10', '2023-07-07 13:00:43'),
(26, 'demo@easyskool.in', 'Super Admin', NULL, '103.55.63.206', 'Chrome 114.0.0.0, Windows 10', '2023-07-07 13:23:23'),
(27, 'demo@easyskool.in', 'Super Admin', NULL, '103.55.63.206', 'Chrome 114.0.0.0, Windows 10', '2023-07-07 14:09:29'),
(28, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.71', 'Chrome 114.0.0.0, Windows 10', '2023-07-10 08:28:59'),
(29, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.77', 'Chrome 115.0.0.0, Windows 10', '2023-07-22 17:08:06'),
(30, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.94', 'Chrome 115.0.0.0, Windows 10', '2023-07-24 08:55:44'),
(31, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.94', 'Chrome 115.0.0.0, Windows 10', '2023-07-24 11:18:31'),
(32, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.74', 'Chrome 115.0.0.0, Windows 10', '2023-07-25 11:45:33'),
(33, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.74', 'Chrome 115.0.0.0, Windows 10', '2023-07-26 09:38:11'),
(34, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.83', 'Chrome 116.0.0.0, Mac OS X', '2023-12-20 08:59:16'),
(35, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 102.0.0.0, Windows 7', '2024-03-19 18:43:55'),
(36, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 102.0.0.0, Windows 7', '2024-03-19 18:49:51'),
(37, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:824f:41e6:2461:bac7:1b6d:79ce', 'Chrome 123.0.0.0, Android', '2024-04-07 11:00:50'),
(38, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 102.0.0.0, Windows 7', '2024-04-09 16:43:14'),
(39, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.70', 'Chrome 102.0.0.0, Windows 7', '2024-04-10 08:40:51'),
(40, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.70', 'Chrome 102.0.0.0, Windows 7', '2024-04-10 14:05:31'),
(41, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:5f71:a0b3:b517:f24d:ffcb:f7ef', 'Chrome 123.0.0.0, Android', '2024-04-11 08:43:48'),
(42, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.81', 'Chrome 102.0.0.0, Windows 7', '2024-04-11 08:44:56'),
(43, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.81', 'Chrome 102.0.0.0, Windows 7', '2024-04-11 13:55:24'),
(44, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.81', 'Chrome 102.0.0.0, Windows 7', '2024-04-11 18:08:47'),
(45, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.86', 'Chrome 102.0.0.0, Windows 7', '2024-04-12 09:05:17'),
(46, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.86', 'Chrome 102.0.0.0, Windows 7', '2024-04-12 09:49:53'),
(47, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.86', 'Chrome 102.0.0.0, Windows 7', '2024-04-12 09:52:33'),
(48, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.87', 'Chrome 102.0.0.0, Windows 7', '2024-04-17 17:33:54'),
(49, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:825d:7665:554e:8375:421a:29a1', 'Chrome 124.0.0.0, Windows 10', '2024-05-15 21:41:33'),
(50, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.68', 'Chrome 102.0.0.0, Windows 7', '2024-05-31 15:54:18'),
(51, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a641:f2bc:b0b8:5390:4495:d7c6', 'Chrome 133.0.0.0, Android', '2025-03-09 12:40:21'),
(52, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a641:f2bc:b0b8:5390:4495:d7c6', 'Chrome 133.0.0.0, Android', '2025-03-09 12:54:23'),
(53, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a641:f2bc:b0b8:5390:4495:d7c6', 'Chrome 133.0.0.0, Android', '2025-03-09 13:00:36'),
(54, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-11 17:19:41'),
(55, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-12 09:14:54'),
(56, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-12 14:29:21'),
(57, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-14 17:03:41'),
(58, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-16 17:38:08'),
(59, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-17 16:08:30'),
(60, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-18 03:52:17'),
(61, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-18 08:25:30'),
(62, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-18 13:01:05'),
(63, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-18 15:14:35'),
(64, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-22 16:17:18'),
(65, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-22 19:06:14'),
(66, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-23 19:44:51'),
(67, 'demo@easyskool.in', 'Super Admin', NULL, '::1', 'Chrome 135.0.0.0, Windows 10', '2025-04-24 03:14:39'),
(68, 'demo@easyskool.in', 'Super Admin', NULL, '180.151.225.162', 'Chrome 135.0.0.0, Windows 10', '2025-04-24 12:50:31'),
(69, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.92', 'Chrome 135.0.0.0, Windows 10', '2025-04-24 15:17:25'),
(70, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.92', 'Chrome 135.0.0.0, Windows 10', '2025-04-24 15:27:12'),
(71, 'demo@easyskool.in', 'Super Admin', NULL, '152.58.114.123', 'Chrome 135.0.0.0, Windows 10', '2025-04-24 19:07:11'),
(72, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.92', 'Chrome 135.0.0.0, Windows 10', '2025-04-24 20:10:29'),
(73, 'demo@easyskool.in', 'Super Admin', NULL, '27.59.79.116', 'Chrome 135.0.0.0, Windows 10', '2025-04-25 00:49:22'),
(74, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.74', 'Chrome 135.0.0.0, Windows 10', '2025-04-25 08:36:03'),
(75, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.74', 'Chrome 135.0.0.0, Windows 10', '2025-04-25 09:04:57'),
(76, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.74', 'Chrome 135.0.0.0, Windows 10', '2025-04-25 12:24:30'),
(77, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.74', 'Chrome 135.0.0.0, Windows 10', '2025-04-25 15:25:57'),
(78, 'demo@easyskool.in', 'Super Admin', NULL, '27.59.70.51', 'Chrome 135.0.0.0, Windows 10', '2025-04-25 19:48:46'),
(79, 'demo@easyskool.in', 'Super Admin', NULL, '27.59.70.51', 'Chrome 135.0.0.0, Windows 10', '2025-04-26 00:09:11'),
(80, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 135.0.0.0, Windows 10', '2025-04-26 07:38:04'),
(81, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 135.0.0.0, Windows 10', '2025-04-26 09:04:31'),
(82, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 135.0.0.0, Windows 10', '2025-04-26 11:06:56'),
(83, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 135.0.0.0, Windows 10', '2025-04-26 14:22:18'),
(84, 'demo@easyskool.in', 'Super Admin', NULL, '223.225.58.81', 'Chrome 135.0.0.0, Windows 10', '2025-04-26 16:11:09'),
(85, 'demo@easyskool.in', 'Super Admin', NULL, '106.77.137.61', 'Chrome 135.0.0.0, Android', '2025-04-26 21:52:02'),
(86, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:2666:ec12:63af:3dfe:e08e:7972', 'Chrome 135.0.0.0, Android', '2025-04-27 08:09:23'),
(87, 'demo@easyskool.in', 'Super Admin', NULL, '223.225.57.219', 'Chrome 135.0.0.0, Windows 10', '2025-04-27 11:09:40'),
(88, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:2666:5508:b0b1:ae88:d936:9d5c', 'Chrome 135.0.0.0, Windows 10', '2025-04-27 18:52:36'),
(89, 'demo@easyskool.in', 'Super Admin', NULL, '152.59.69.87', 'Chrome 135.0.0.0, Windows 10', '2025-04-27 19:50:06'),
(90, 'demo@easyskool.in', 'Super Admin', NULL, '106.67.177.185', 'Chrome 135.0.0.0, Windows 10', '2025-04-27 23:54:06'),
(91, 'demo@easyskool.in', 'Super Admin', NULL, '106.219.239.57', 'Chrome 135.0.0.0, Windows 10', '2025-04-28 01:35:23'),
(92, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.79', 'Chrome 135.0.0.0, Windows 10', '2025-04-28 07:52:48'),
(93, 'demo@easyskool.in', 'Super Admin', NULL, '180.151.225.162', 'Chrome 135.0.0.0, Windows 10', '2025-04-28 10:10:35'),
(94, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.79', 'Chrome 135.0.0.0, Windows 10', '2025-04-28 16:48:20'),
(95, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:2068:5f48:f58e:4ebb:bc6e:f397', 'Chrome 135.0.0.0, Windows 10', '2025-04-28 20:31:07'),
(96, 'demo@easyskool.in', 'Super Admin', NULL, '152.58.119.167', 'Chrome 135.0.0.0, Windows 10', '2025-04-29 00:33:46'),
(97, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.80', 'Chrome 135.0.0.0, Windows 10', '2025-04-29 08:20:01'),
(98, 'demo@easyskool.in', 'Super Admin', NULL, '2409:40d0:11e1:79bc:bf7:9c25:b163:33ce', 'Chrome 135.0.0.0, Linux', '2025-04-29 08:37:28'),
(99, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.80', 'Chrome 135.0.0.0, Windows 10', '2025-04-29 12:26:19'),
(100, 'demo@easyskool.in', 'Super Admin', NULL, '103.157.195.126', 'Chrome 134.0.0.0, Linux', '2025-04-29 12:26:21'),
(101, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.80', 'Chrome 135.0.0.0, Windows 10', '2025-04-29 14:26:27'),
(102, 'demo@easyskool.in', 'Super Admin', NULL, '180.151.225.162', 'Chrome 135.0.0.0, Windows 10', '2025-04-29 15:30:40'),
(103, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.80', 'Chrome 135.0.0.0, Windows 10', '2025-04-29 15:44:14'),
(104, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:2668:6ca3:8d92:37b:f9e3:d226', 'Chrome 135.0.0.0, Windows 10', '2025-04-29 19:05:15'),
(105, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:2668:6ca3:f5a4:d579:6afe:22b1', 'Chrome 135.0.0.0, Windows 10', '2025-04-29 21:14:12'),
(106, 'demo@easyskool.in', 'Super Admin', NULL, '223.237.34.225', 'Chrome 135.0.0.0, Windows 10', '2025-04-29 21:35:15'),
(107, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81f8:7f82:57db:a203:4db7:3fcf', 'Chrome 135.0.0.0, Linux', '2025-04-30 01:51:59'),
(108, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81f2:c662:92ed:b842:1eba:23a9', 'Chrome 135.0.0.0, Linux', '2025-04-30 07:26:36'),
(109, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.79', 'Chrome 135.0.0.0, Windows 10', '2025-04-30 08:24:57'),
(110, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:266e:9333:8194:da27:c9c9:646f', 'Chrome 135.0.0.0, Windows 10', '2025-05-01 08:19:45'),
(111, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.79', 'Chrome 118.0.0.0, Windows 10', '2025-05-01 15:32:33'),
(112, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:83a5:87eb:820e:855a:a419:e76c', 'Chrome 135.0.0.0, Linux', '2025-05-01 20:35:29'),
(113, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:206d:7ee0:6d38:c0ce:2ccf:7acd', 'Chrome 135.0.0.0, Windows 10', '2025-05-01 21:03:33'),
(114, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8386:bff2:fec0:d18e:c3ca:7d6f', 'Chrome 135.0.0.0, Linux', '2025-05-01 23:37:39'),
(115, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:2665:65a0:562:2996:41a3:9612', 'Chrome 135.0.0.0, Windows 10', '2025-05-02 01:16:35'),
(116, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8386:bff2:d58:a140:6580:e35b', 'Chrome 135.0.0.0, Linux', '2025-05-02 06:10:08'),
(117, 'demo@easyskool.in', 'Super Admin', NULL, '106.67.188.182', 'Chrome 135.0.0.0, Windows 10', '2025-05-02 09:18:54'),
(118, 'demo@easyskool.in', 'Super Admin', NULL, '2409:40d0:3a:9f4c:18d5:753f:be7:c8e2', 'Chrome 135.0.0.0, Linux', '2025-05-02 15:02:12'),
(119, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 135.0.0.0, Windows 10', '2025-05-02 15:55:59'),
(120, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8381:6601:7607:3e78:b35f:226f', 'Chrome 135.0.0.0, Linux', '2025-05-02 23:22:59'),
(121, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:2672:922a:1c8f:3008:b11f:121c', 'Chrome 135.0.0.0, Windows 10', '2025-05-03 07:46:53'),
(122, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:83a2:9e64:5fb7:7923:97c3:e588', 'Chrome 135.0.0.0, Linux', '2025-05-03 12:07:50'),
(123, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.95', 'Chrome 135.0.0.0, Windows 10', '2025-05-03 12:15:39'),
(124, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81fa:60f1:6b1d:d4c5:1c34:f2ef', 'Chrome 136.0.0.0, Linux', '2025-05-03 19:10:00'),
(125, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:257e:7d97:8d4:5037:10c4:9ecc', 'Chrome 135.0.0.0, Windows 10', '2025-05-03 19:25:06'),
(126, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.73', 'Chrome 135.0.0.0, Windows 10', '2025-05-05 08:34:59'),
(127, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.73', 'Chrome 135.0.0.0, Windows 10', '2025-05-05 12:04:16'),
(128, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8201:9130:c056:5924:26d1:d67d', 'Chrome 136.0.0.0, Linux', '2025-05-08 22:58:42'),
(129, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.93', 'Chrome 135.0.0.0, Windows 10', '2025-05-09 08:14:20'),
(130, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81e2:e7d:86da:6ec2:50a5:304a', 'Chrome 136.0.0.0, Linux', '2025-05-09 20:43:42'),
(131, 'demo@easyskool.in', 'Super Admin', NULL, '103.159.44.126', 'Chrome 136.0.0.0, Windows 10', '2025-05-09 20:43:56'),
(132, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.70', 'Chrome 135.0.0.0, Windows 10', '2025-05-10 09:16:23'),
(133, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.70', 'Chrome 135.0.0.0, Windows 10', '2025-05-10 11:44:17'),
(134, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.70', 'Chrome 135.0.0.0, Windows 10', '2025-05-10 14:27:06'),
(135, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a070:e00c:9641:5cb9:7847:6146', 'Chrome 136.0.0.0, Linux', '2025-05-10 19:20:01'),
(136, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:257e:5f2f:85a4:b94d:9cb3:e61d', 'Chrome 123.0.6312.118, Android', '2025-05-11 08:40:54'),
(137, 'demo@easyskool.in', 'Super Admin', NULL, '103.159.44.126', 'Chrome 136.0.0.0, Windows 10', '2025-05-11 13:15:05'),
(138, 'demo@easyskool.in', 'Super Admin', NULL, '106.78.67.209', 'Chrome 136.0.0.0, Windows 10', '2025-05-11 13:59:11'),
(139, 'demo@easyskool.in', 'Super Admin', NULL, '103.159.44.126', 'Chrome 136.0.0.0, Windows 10', '2025-05-11 15:57:14'),
(140, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a15f:9b40:1c34:5fbf:e449:2101', 'Chrome 136.0.0.0, Linux', '2025-05-11 17:45:16'),
(141, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:83ac:c744:6390:61fc:9289:a3eb', 'Chrome 136.0.0.0, Linux', '2025-05-11 21:37:49'),
(142, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.88', 'Chrome 136.0.0.0, Windows 10', '2025-05-12 08:06:56'),
(143, 'demo@easyskool.in', 'Super Admin', NULL, '106.219.120.55', 'Chrome 136.0.0.0, Windows 10', '2025-05-12 12:45:33'),
(144, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.88', 'Chrome 136.0.0.0, Windows 10', '2025-05-12 14:47:51'),
(145, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.88', 'Chrome 136.0.0.0, Windows 10', '2025-05-12 17:08:58'),
(146, 'deepak@easyskool.in', 'Admin', NULL, '103.68.21.88', 'Chrome 136.0.0.0, Windows 10', '2025-05-12 17:26:25'),
(147, 'deepak@easyskool.in', 'Admin', NULL, '103.68.21.88', 'Chrome 136.0.0.0, Windows 10', '2025-05-12 17:26:36'),
(148, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.88', 'Chrome 136.0.0.0, Windows 10', '2025-05-12 17:28:41'),
(149, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a011:6f36:f338:80ec:8613:bf89', 'Chrome 136.0.0.0, Linux', '2025-05-13 01:33:07'),
(150, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.77', 'Chrome 136.0.0.0, Windows 10', '2025-05-13 08:36:04'),
(151, 'demo@easyskool.in', 'Super Admin', NULL, '180.151.225.162', 'Chrome 136.0.0.0, Windows 10', '2025-05-13 11:50:14'),
(152, 'demo@easyskool.in', 'Super Admin', NULL, '103.159.44.126', 'Chrome 136.0.0.0, Windows 10', '2025-05-13 19:06:21'),
(153, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 136.0.0.0, Windows 10', '2025-05-14 09:32:58'),
(154, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 136.0.0.0, Windows 10', '2025-05-14 13:01:17'),
(155, 'demo@easyskool.in', 'Super Admin', NULL, '103.159.44.126', 'Chrome 136.0.0.0, Windows 10', '2025-05-14 19:30:14'),
(156, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.64', 'Chrome 136.0.0.0, Windows 10', '2025-05-15 07:57:02'),
(157, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8380:da41:3e46:7ae2:80cf:30f9', 'Chrome 136.0.0.0, Linux', '2025-05-16 01:38:01'),
(158, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:83ac:f5db:c52a:78d7:9f1a:d202', 'Chrome 136.0.0.0, Linux', '2025-05-16 08:15:04'),
(159, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:ee8:4b93:e062:c0ab:58b0:6382', 'Chrome 136.0.0.0, Windows 10', '2025-05-16 16:16:46'),
(160, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:ee8:4afe:490a:3f13:9587:193a', 'Chrome 136.0.0.0, Windows 10', '2025-05-17 07:03:02'),
(161, 'demo@easyskool.in', 'Super Admin', NULL, '106.219.228.16', 'Chrome 136.0.0.0, Windows 10', '2025-05-17 23:31:14'),
(162, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:87fe:c8b7:c96e:4625:bb80:52c7', 'Chrome 136.0.0.0, Linux', '2025-05-18 00:48:40'),
(163, 'demo@easyskool.in', 'Super Admin', NULL, '106.219.229.16', 'Chrome 136.0.0.0, Windows 10', '2025-05-18 01:38:46'),
(164, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.95', 'Chrome 136.0.0.0, Windows 10', '2025-05-18 10:15:30'),
(165, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a00a:da62:4e5d:7dcd:bf53:ebab', 'Chrome 136.0.0.0, Linux', '2025-05-18 12:58:59'),
(166, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:58cb:50c0:bc61:f2c0:3b72:189e', 'Chrome 136.0.0.0, Windows 10', '2025-05-18 15:56:32'),
(167, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a010:6430:c096:80de:dda3:7980', 'Chrome 136.0.0.0, Linux', '2025-05-18 17:57:46'),
(168, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:58cb:50c0:49d6:f014:6fdc:5b12', 'Chrome 136.0.0.0, Windows 10', '2025-05-18 18:55:21'),
(169, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.94', 'Chrome 136.0.0.0, Windows 10', '2025-05-19 07:55:20'),
(170, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a005:a04f:fc:3b68:e3a9:5382', 'Chrome 136.0.0.0, Linux', '2025-05-19 08:09:49'),
(171, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.94', 'Chrome 136.0.0.0, Windows 10', '2025-05-19 09:58:54'),
(172, 'deepak@easyskool.in', 'Admin', NULL, '103.68.21.94', 'Chrome 136.0.0.0, Windows 10', '2025-05-19 11:20:18'),
(173, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.94', 'Chrome 136.0.0.0, Windows 10', '2025-05-19 11:22:10'),
(174, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.94', 'Chrome 136.0.0.0, Windows 10', '2025-05-19 15:36:56'),
(175, 'demo@easyskool.in', 'Super Admin', NULL, '2409:40d0:c:a534:f7ef:c3d6:2edd:c94', 'Chrome 136.0.0.0, Linux', '2025-05-19 18:15:55'),
(176, 'demo@easyskool.in', 'Super Admin', NULL, '103.181.64.187', 'Chrome 136.0.0.0, Windows 10', '2025-05-19 18:56:41'),
(177, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:2666:a241:a920:fa5:b753:d181', 'Chrome 136.0.0.0, Windows 10', '2025-05-19 21:18:36'),
(178, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a005:e1af:9e62:2c88:893e:b9df', 'Chrome 136.0.0.0, Linux', '2025-05-19 21:56:05'),
(179, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.71', 'Chrome 136.0.0.0, Windows 10', '2025-05-20 08:12:35'),
(180, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.71', 'Chrome 136.0.0.0, Windows 10', '2025-05-20 13:56:35'),
(181, 'demo@easyskool.in', 'Super Admin', NULL, '106.219.228.221', 'Chrome 136.0.0.0, Windows 10', '2025-05-20 21:17:24'),
(182, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:5a4b:5cbe:6959:8c5d:5664:37a6', 'Chrome 136.0.0.0, Windows 10', '2025-05-20 21:29:47'),
(183, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a005:d52c:2047:35bc:d33d:4c32', 'Chrome 136.0.0.0, Linux', '2025-05-20 21:42:05'),
(184, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a005:d52c:2047:35bc:d33d:4c32', 'Chrome 136.0.0.0, Linux', '2025-05-20 23:40:04'),
(185, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.82', 'Chrome 136.0.0.0, Windows 10', '2025-05-21 08:29:13'),
(186, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.82', 'Chrome 136.0.0.0, Windows 10', '2025-05-21 14:11:59'),
(187, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.85', 'Chrome 136.0.0.0, Windows 10', '2025-05-22 08:08:59'),
(188, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:87f8:14b:a972:7991:b0f0:c82a', 'Chrome 136.0.0.0, Linux', '2025-05-22 08:34:55'),
(189, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.85', 'Chrome 136.0.0.0, Windows 10', '2025-05-22 12:36:37'),
(190, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:5a3b:5c5e:406a:7b78:76e8:8661', 'Chrome 136.0.0.0, Windows 10', '2025-05-22 20:28:31'),
(191, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a13b:f13e:d938:7910:22a7:6e50', 'Chrome 136.0.0.0, Linux', '2025-05-22 20:29:30'),
(192, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a13b:f13e:2520:ccbc:6e73:cb22', 'Chrome 136.0.0.0, Linux', '2025-05-23 01:01:15'),
(193, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:5c2b:5125:98d9:1d1b:8eaf:8b2e', 'Chrome 136.0.0.0, Windows 10', '2025-05-23 06:35:54'),
(194, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 136.0.0.0, Windows 10', '2025-05-23 10:36:01'),
(195, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.68', 'Chrome 136.0.0.0, Windows 10', '2025-05-24 08:23:32'),
(196, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:58a8:4bba:554e:4247:b21c:6776', 'Chrome 136.0.0.0, Windows 10', '2025-05-24 12:42:36'),
(197, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.68', 'Chrome 136.0.0.0, Windows 10', '2025-05-24 16:07:42'),
(198, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.68', 'Chrome 136.0.0.0, Windows 10', '2025-05-24 18:33:11'),
(199, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:5a38:4b10:4fb9:74ec:2b81:8a75', 'Chrome 136.0.0.0, Android', '2025-05-25 09:58:13'),
(200, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.68', 'Chrome 118.0.0.0, Windows 10', '2025-05-25 17:33:23'),
(201, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.85', 'Chrome 136.0.0.0, Windows 10', '2025-05-26 08:18:58'),
(202, 'demo@easyskool.in', 'Super Admin', NULL, '103.175.180.54', 'Chrome 137.0.0.0, Windows 10', '2025-05-28 21:24:08'),
(203, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a133:cbe4:5b3c:f762:d5e5:b976', 'Chrome 136.0.0.0, Linux', '2025-05-29 02:05:15'),
(204, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.69', 'Chrome 136.0.0.0, Windows 10', '2025-05-29 07:52:42'),
(205, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.69', 'Chrome 136.0.0.0, Windows 10', '2025-05-29 13:39:07'),
(206, 'demo@easyskool.in', 'Super Admin', NULL, '180.151.225.162', 'Firefox 139.0, Windows 10', '2025-05-29 14:37:21'),
(207, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:58b8:5f96:fdf1:27e:aa49:5169', 'Chrome 136.0.0.0, Windows 10', '2025-05-29 21:19:31'),
(208, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:58b8:59a7:b989:65e2:870f:f175', 'Chrome 136.0.0.0, Windows 10', '2025-05-30 07:34:46'),
(209, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 136.0.0.0, Windows 10', '2025-05-30 08:06:39'),
(210, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.69', 'Chrome 136.0.0.0, Windows 10', '2025-05-30 12:39:43'),
(211, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a13a:2a85:4e63:a236:f09e:2182', 'Chrome 136.0.0.0, Linux', '2025-05-31 01:06:21'),
(212, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.73', 'Chrome 136.0.0.0, Windows 10', '2025-05-31 08:02:17'),
(213, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:87fd:5457:6b88:de17:d800:d402', 'Chrome 136.0.0.0, Linux', '2025-05-31 08:46:23'),
(214, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.73', 'Chrome 136.0.0.0, Windows 10', '2025-05-31 09:51:18'),
(215, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8395:a6ce:54b2:6e60:e4c9:a3ce', 'Chrome 136.0.0.0, Linux', '2025-06-01 09:24:22'),
(216, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.77', 'Chrome 136.0.0.0, Windows 10', '2025-06-01 10:54:35'),
(217, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.80', 'Chrome 136.0.0.0, Windows 10', '2025-06-01 13:13:45'),
(218, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.80', 'Chrome 136.0.0.0, Windows 10', '2025-06-01 16:37:00'),
(219, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8385:ccad:e9e9:3a2e:51da:4f83', 'Chrome 136.0.0.0, Linux', '2025-06-01 16:49:52'),
(220, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.86', 'Chrome 137.0.0.0, Windows 10', '2025-06-01 18:56:17'),
(221, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.71', 'Chrome 137.0.0.0, Windows 10', '2025-06-02 08:02:11'),
(222, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.71', 'Chrome 136.0.0.0, Windows 10', '2025-06-02 14:46:56'),
(223, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:83a0:fce5:800c:4ca6:edf5:935e', 'Chrome 136.0.0.0, Linux', '2025-06-02 20:52:12'),
(224, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:5c38:4a44:597a:44f:8498:23b', 'Chrome 137.0.0.0, Windows 10', '2025-06-02 21:04:55'),
(225, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:83a0:fce5:17c:cb97:ad9e:66a2', 'Chrome 136.0.0.0, Linux', '2025-06-03 00:02:12'),
(226, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:5c38:4a1a:2421:b840:b41f:fa', 'Chrome 137.0.0.0, Windows 10', '2025-06-03 08:22:25'),
(227, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:5c38:4a1a:a9d5:abf6:137:92bf', 'Chrome 137.0.0.0, Windows 10', '2025-06-03 10:40:35'),
(228, 'demo@easyskool.in', 'Super Admin', NULL, '223.184.189.217', 'Chrome 136.0.0.0, Windows 10', '2025-06-03 11:27:58'),
(229, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a63f:7fdc:8ca:974d:3691:f9dc', 'Chrome 137.0.0.0, Windows 10', '2025-06-03 17:06:57'),
(230, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:83af:fe8e:4763:5c30:55aa:162e', 'Chrome 136.0.0.0, Linux', '2025-06-03 21:12:31'),
(231, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a635:9f59:8d29:353:5c62:11f1', 'Chrome 137.0.0.0, Windows 10', '2025-06-04 09:10:48'),
(232, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81f2:647e:a114:c1a:8ece:81bf', 'Chrome 136.0.0.0, Linux', '2025-06-04 21:23:43'),
(233, 'demo@easyskool.in', 'Super Admin', NULL, '106.219.196.104', 'Chrome 137.0.0.0, Windows 10', '2025-06-05 11:51:24'),
(234, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.78', 'Chrome 137.0.0.0, Windows 10', '2025-06-05 17:17:22'),
(235, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8202:3290:1b63:6644:246c:3637', 'Chrome 136.0.0.0, Linux', '2025-06-05 22:35:38'),
(236, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81e3:8b9e:6f32:de6b:88a9:82d8', 'Chrome 136.0.0.0, Linux', '2025-06-06 07:39:39'),
(237, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 137.0.0.0, Windows 10', '2025-06-06 08:15:15'),
(238, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 137.0.0.0, Windows 10', '2025-06-06 13:34:14'),
(239, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 137.0.0.0, Windows 10', '2025-06-06 14:36:35'),
(240, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:87f9:143a:e029:1ef3:7ec7:129a', 'Chrome 136.0.0.0, Linux', '2025-06-06 22:26:22'),
(241, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.84', 'Chrome 137.0.0.0, Windows 10', '2025-06-07 10:01:31'),
(242, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.84', 'Chrome 137.0.0.0, Windows 10', '2025-06-07 10:45:59'),
(243, 'demo@easyskool.in', 'Super Admin', NULL, '2409:40d0:18:15d4:a264:9ff5:f34f:c0a', 'Chrome 136.0.0.0, Linux', '2025-06-07 11:44:37'),
(244, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.84', 'Chrome 137.0.0.0, Windows 10', '2025-06-07 13:48:27'),
(245, 'demo@easyskool.in', 'Super Admin', NULL, '2409:40d0:1021:6346:3fdd:235d:e4d:8ffb', 'Chrome 136.0.0.0, Linux', '2025-06-07 13:53:47'),
(246, 'demo@easyskool.in', 'Super Admin', NULL, '2409:40d0:1021:6346:b26d:5ad2:5a14:6822', 'Chrome 136.0.0.0, Linux', '2025-06-07 17:17:44'),
(247, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.90', 'Chrome 118.0.0.0, Windows 10', '2025-06-10 05:59:27'),
(248, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.90', 'Chrome 137.0.0.0, Windows 10', '2025-06-10 09:55:43'),
(249, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 137.0.0.0, Windows 10', '2025-06-11 15:24:57'),
(250, 'demo@easyskool.in', 'Super Admin', NULL, '2409:40d0:2009:ca85:71c2:6888:7fb9:164', 'Chrome 136.0.0.0, Linux', '2025-06-11 19:21:54'),
(251, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.85', 'Chrome 137.0.0.0, Windows 10', '2025-06-15 08:04:37'),
(252, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.69', 'Chrome 137.0.0.0, Windows 10', '2025-06-16 09:05:46'),
(253, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.93', 'Chrome 137.0.0.0, Windows 10', '2025-06-17 07:43:34'),
(254, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.93', 'Chrome 137.0.0.0, Windows 10', '2025-06-17 07:48:45'),
(255, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a5bf:9b2f:4d54:899:8bef:3222', 'Chrome 137.0.0.0, Windows 10', '2025-06-17 10:34:29'),
(256, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a5bf:9b2f:4d54:899:8bef:3222', 'Chrome 137.0.0.0, Windows 10', '2025-06-17 10:42:28'),
(257, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.78', 'Chrome 137.0.0.0, Windows 10', '2025-06-21 09:07:38'),
(258, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.78', 'Chrome 137.0.0.0, Windows 10', '2025-06-21 13:06:43'),
(259, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.78', 'Chrome 137.0.0.0, Windows 10', '2025-06-21 13:09:17'),
(260, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8395:94b1:80fa:821:ae6e:d308', 'Chrome 137.0.0.0, Linux', '2025-06-22 19:25:37'),
(261, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.68', 'Chrome 137.0.0.0, Windows 10', '2025-06-23 09:40:14'),
(262, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:838d:f94d:a167:9e3d:4ac3:7088', 'Chrome 137.0.0.0, Linux', '2025-06-23 20:02:12'),
(263, 'demo@easyskool.in', 'Super Admin', NULL, '2409:40d2:1038:cd6b:8d57:fb11:50e7:3258', 'Chrome 138.0.0.0, Windows 10', '2025-06-26 20:12:37'),
(264, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:820c:1893:5bef:1c8a:9cee:b9b8', 'Chrome 137.0.0.0, Linux', '2025-06-26 21:48:32'),
(265, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.94', 'Chrome 137.0.0.0, Windows 10', '2025-06-27 09:22:43'),
(266, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.89', 'Chrome 137.0.0.0, Windows 10', '2025-06-28 07:53:59'),
(267, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:820f:6de1:1958:22eb:9c45:868b', 'Chrome 137.0.0.0, Linux', '2025-06-28 20:04:33'),
(268, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8208:eb75:eab:27ca:3bea:a594', 'Chrome 137.0.0.0, Linux', '2025-06-29 00:30:07'),
(269, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 137.0.0.0, Windows 10', '2025-06-30 08:32:45'),
(270, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 137.0.0.0, Windows 10', '2025-06-30 11:28:44'),
(271, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.70', 'Chrome 137.0.0.0, Windows 10', '2025-07-02 10:58:56'),
(272, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81f6:54f1:c05e:1782:acf:492f', 'Chrome 137.0.0.0, Linux', '2025-07-05 23:31:19'),
(273, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:839d:5376:fbef:d3ae:5cb6:2dec', 'Chrome 137.0.0.0, Linux', '2025-07-08 21:27:49'),
(274, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 138.0.0.0, Windows 10', '2025-07-09 08:11:30'),
(275, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:820a:1ff:fcd1:10d4:3dc1:a5f2', 'Chrome 137.0.0.0, Linux', '2025-07-12 16:21:02'),
(276, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a5c6:f08a:1544:2bfd:38aa:97f8', 'Chrome 138.0.0.0, Windows 10', '2025-07-14 19:46:51'),
(277, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.93', 'Chrome 138.0.0.0, Windows 10', '2025-07-16 10:05:31'),
(278, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:8201:c92e:ebfc:2e:7670:3205', 'Chrome 138.0.0.0, Linux', '2025-07-21 20:32:43'),
(279, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 138.0.0.0, Windows 10', '2025-07-29 14:16:17'),
(280, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81ee:d076:dfde:d1c6:3dc8:5734', 'Chrome 138.0.0.0, Linux', '2025-08-03 01:48:32'),
(281, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81f0:405b:dc98:7301:61d4:64f6', 'Safari 604.1, iOS', '2025-08-03 12:45:43'),
(282, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:84d1:6a9c:d93b:9035:f7fb:ca87', 'Chrome 138.0.0.0, Android', '2025-08-03 13:39:29'),
(283, 'demo@easyskool.in', 'Super Admin', NULL, '2402:8100:2660:9f64:c432:506e:5cca:e35e', 'Chrome 138.0.0.0, Windows 10', '2025-08-11 09:56:40'),
(284, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.71', 'Chrome 138.0.0.0, Windows 10', '2025-08-13 08:21:11'),
(285, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.71', 'Chrome 132.0.0.0, Windows 10', '2025-08-13 08:26:40'),
(286, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.71', 'Chrome 138.0.0.0, Windows 10', '2025-08-13 11:31:38'),
(287, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81fd:6cd0:6d1f:6e51:3748:7974', 'Chrome 139.0.0.0, Linux', '2025-09-11 01:31:12'),
(288, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:81f6:b243:f78d:a647:f5fc:b988', 'Chrome 139.0.0.0, Android', '2025-09-11 09:04:02'),
(289, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.78', 'Chrome 139.0.0.0, Windows 10', '2025-09-12 17:03:29'),
(290, 'demo@easyskool.in', 'Super Admin', NULL, '2401:4900:a01a:9c1c:f89c:64a8:32d5:f096', 'Chrome 139.0.0.0, Linux', '2025-09-13 23:49:39'),
(291, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 140.0.0.0, Windows 10', '2025-09-17 08:29:27'),
(292, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 11:05:43'),
(293, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 14:04:57'),
(294, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 15:28:54'),
(295, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 17:38:12'),
(296, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.72.110', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 20:00:43'),
(297, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.71.22', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 21:12:19'),
(298, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.71.22', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 21:15:53'),
(299, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.71.22', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 21:17:20'),
(300, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.71.22', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 21:18:54'),
(301, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.71.22', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 21:19:59'),
(302, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.71.22', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 21:21:51'),
(303, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.71.22', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 21:25:10'),
(304, 'parent504', 'parent', NULL, '223.233.71.22', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 21:26:32'),
(305, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.71.22', 'Chrome 141.0.0.0, Windows 10', '2025-11-07 21:30:06'),
(306, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 08:34:10'),
(307, 'mohit@easyskool.in', 'Accountant', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 09:40:19'),
(308, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 09:40:55'),
(309, 'mohit@easyskool.in', 'Accountant', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 09:42:02'),
(310, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 09:42:16'),
(311, 'mohit@easyskool.in', 'Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 09:42:55'),
(312, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 09:44:11'),
(313, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 141.0.0.0, Windows 10', '2025-11-08 09:53:29'),
(314, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 141.0.0.0, Windows 10', '2025-11-08 09:54:21'),
(315, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 10:01:22'),
(316, 'rakhi@gis.in', 'Teacher', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 11:55:07'),
(317, 'sakshimalik@gis.in', 'Teacher', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 11:56:38'),
(318, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 11:57:29'),
(319, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 11:58:25'),
(320, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 12:04:43'),
(321, 'mohit@gis.in', 'Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 12:06:00'),
(322, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.88', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 12:06:46'),
(323, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 12:16:29'),
(324, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.66', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 16:51:15'),
(325, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.76.103', 'Chrome 142.0.0.0, Windows 10', '2025-11-08 20:51:00'),
(326, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.77', 'Chrome 142.0.0.0, Windows 10', '2025-11-09 10:35:36'),
(327, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.90', 'Chrome 142.0.0.0, Windows 10', '2025-11-09 10:48:45'),
(328, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.77', 'Chrome 142.0.0.0, Windows 10', '2025-11-09 14:35:27'),
(329, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.77', 'Chrome 142.0.0.0, Windows 10', '2025-11-09 15:19:00'),
(330, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.77', 'Chrome 142.0.0.0, Windows 10', '2025-11-09 15:42:35'),
(331, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.77', 'Chrome 142.0.0.0, Windows 10', '2025-11-09 15:44:19'),
(332, 'demo@easyskool.in', 'Super Admin', NULL, '223.233.70.128', 'Chrome 142.0.0.0, Windows 10', '2025-11-09 20:05:39'),
(333, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 142.0.0.0, Windows 10', '2025-11-10 08:38:12'),
(334, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 142.0.0.0, Windows 10', '2025-11-10 12:18:33'),
(335, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 142.0.0.0, Windows 10', '2025-11-10 12:19:28'),
(336, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 142.0.0.0, Windows 10', '2025-11-10 14:33:03'),
(337, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 142.0.0.0, Windows 10', '2025-11-10 16:28:41'),
(338, 'demo@easyskool.in', 'Super Admin', NULL, '106.67.190.59', 'Chrome 142.0.0.0, Windows 10', '2025-11-10 18:43:21'),
(339, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.83', 'Chrome 142.0.0.0, Windows 10', '2025-11-11 10:08:02'),
(340, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.83', 'Chrome 142.0.0.0, Windows 10', '2025-11-11 12:34:14'),
(341, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.83', 'Chrome 142.0.0.0, Windows 10', '2025-11-11 15:04:54'),
(342, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.67', 'Chrome 142.0.0.0, Windows 10', '2025-11-12 14:02:12'),
(343, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.67', 'Chrome 142.0.0.0, Windows 10', '2025-11-12 14:53:47'),
(344, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.67', 'Chrome 142.0.0.0, Windows 10', '2025-11-12 15:41:59'),
(345, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.69', 'Chrome 142.0.0.0, Windows 10', '2025-11-13 09:25:39'),
(346, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.69', 'Chrome 142.0.0.0, Windows 10', '2025-11-13 09:35:23'),
(347, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.81', 'Chrome 142.0.0.0, Windows 10', '2025-11-13 12:49:33'),
(348, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.81', 'Chrome 142.0.0.0, Windows 10', '2025-11-13 14:31:39'),
(349, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 142.0.0.0, Windows 10', '2025-11-14 10:56:58'),
(350, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 142.0.0.0, Windows 10', '2025-11-14 11:27:16'),
(351, 'demo@easyskool.in', 'Super Admin', NULL, '106.78.72.76', 'Chrome 142.0.0.0, Windows 10', '2025-11-14 12:30:09'),
(352, 'demo@easyskool.in', 'Super Admin', NULL, '106.78.72.18', 'Chrome 142.0.0.0, Windows 10', '2025-11-14 13:48:33'),
(353, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.91', 'Chrome 142.0.0.0, Windows 10', '2025-11-15 15:31:51'),
(354, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.73', 'Chrome 142.0.0.0, Windows 10', '2025-11-16 11:57:37'),
(355, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.67', 'Chrome 142.0.0.0, Windows 10', '2025-11-17 13:58:07'),
(356, 'demo@easyskool.in', 'Super Admin', NULL, '106.77.137.170', 'Chrome 142.0.0.0, Windows 10', '2025-11-18 18:09:53'),
(357, 'demo@easyskool.in', 'Super Admin', NULL, '106.77.137.61', 'Chrome 142.0.0.0, Windows 10', '2025-11-18 18:35:01'),
(358, 'demo@easyskool.in', 'Super Admin', NULL, '106.78.73.121', 'Chrome 142.0.0.0, Windows 10', '2025-11-18 21:23:56'),
(359, 'demo@easyskool.in', 'Super Admin', NULL, '106.78.73.129', 'Chrome 142.0.0.0, Windows 10', '2025-11-18 21:26:10'),
(360, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 142.0.0.0, Windows 10', '2025-11-19 09:08:27'),
(361, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 142.0.0.0, Windows 10', '2025-11-19 09:31:17'),
(362, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.65', 'Chrome 142.0.0.0, Windows 10', '2025-11-19 10:25:35'),
(363, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 142.0.0.0, Windows 10', '2025-11-20 07:57:29'),
(364, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 142.0.0.0, Windows 10', '2025-11-20 08:28:09'),
(365, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.72', 'Chrome 142.0.0.0, Windows 10', '2025-11-20 13:27:47'),
(366, 'demo@easyskool.in', 'Super Admin', NULL, '106.78.67.59', 'Chrome 142.0.0.0, Windows 10', '2025-11-20 21:07:31'),
(367, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 142.0.0.0, Windows 10', '2025-11-21 12:36:33'),
(368, 'demo@easyskool.in', 'Super Admin', NULL, '112.110.58.14', 'Chrome 142.0.0.0, Windows 10', '2025-11-21 21:38:57'),
(369, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.93', 'Chrome 142.0.0.0, Windows 10', '2025-11-22 11:35:28'),
(370, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.93', 'Chrome 142.0.0.0, Windows 10', '2025-11-22 11:41:54'),
(371, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.93', 'Chrome 142.0.0.0, Windows 10', '2025-11-22 15:32:31'),
(372, 'demo@easyskool.in', 'Super Admin', NULL, '103.68.21.93', 'Chrome 142.0.0.0, Windows 10', '2025-11-22 16:07:00'),
(373, 'demo@easyskool.in', 'Super Admin', NULL, '106.78.66.255', 'Chrome 142.0.0.0, Windows 10', '2025-11-22 22:15:15'),
(374, 'demo@easyskool.in', 'Super Admin', NULL, '106.66.61.122', 'Chrome 142.0.0.0, Windows 10', '2025-11-23 17:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `childs` text NOT NULL,
  `role` varchar(30) NOT NULL,
  `verification_code` varchar(200) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `password`, `childs`, `role`, `verification_code`, `lang_id`, `is_active`, `created_at`, `updated_at`) VALUES
(36, 19, 'std19', 'e5n6ui', '', 'student', '', 0, 'yes', '2022-08-27 04:28:53', NULL),
(38, 20, 'std20', '941nvm', '', 'student', '', 0, 'yes', '2022-08-27 05:18:28', NULL),
(40, 21, 'std21', '4u8x18', '', 'student', '', 0, 'yes', '2022-08-27 06:47:08', NULL),
(42, 22, 'std22', 'x0uyls', '', 'student', '', 0, 'yes', '2022-08-29 03:14:35', NULL),
(44, 23, 'std23', '47vtl2', '', 'student', '', 0, 'yes', '2022-08-29 03:28:33', NULL),
(46, 24, 'std24', 'qcj83m', '', 'student', '', 0, 'yes', '2022-08-29 04:01:42', NULL),
(48, 25, 'std25', 'uhy38c', '', 'student', '', 0, 'yes', '2022-08-29 04:59:39', NULL),
(50, 26, 'std26', 'k5p9m0', '', 'student', '', 0, 'yes', '2022-08-29 05:11:46', NULL),
(52, 27, 'std27', 'wjt840', '', 'student', '', 0, 'yes', '2022-08-29 05:19:28', NULL),
(53, 28, 'std28', 'kph4pa', '', 'student', '', 0, 'yes', '2022-08-29 05:46:29', NULL),
(55, 29, 'std29', '8m4jpl', '', 'student', '', 0, 'yes', '2022-08-29 06:12:32', NULL),
(57, 30, 'std30', '9vdy9m', '', 'student', '', 0, 'yes', '2022-08-29 06:28:41', NULL),
(59, 31, 'std31', 'mqhn5k', '', 'student', '', 0, 'yes', '2022-08-30 02:41:19', NULL),
(61, 32, 'std32', '0p8wtl', '', 'student', '', 0, 'yes', '2022-08-30 03:33:45', NULL),
(63, 33, 'std33', 'byuy2y', '', 'student', '', 0, 'yes', '2022-08-30 04:05:30', NULL),
(65, 34, 'std34', 'kejwwv', '', 'student', '', 0, 'yes', '2022-08-30 04:24:22', NULL),
(67, 35, 'std35', 'a78qjm', '', 'student', '', 0, 'yes', '2022-08-30 05:04:50', NULL),
(69, 36, 'std36', 'ivftuz', '', 'student', '', 0, 'yes', '2022-08-30 06:33:24', NULL),
(71, 37, 'std37', 'cnxg4f', '', 'student', '', 0, 'yes', '2022-08-31 03:09:48', NULL),
(73, 38, 'std38', '98n41p', '', 'student', '', 0, 'yes', '2022-08-31 05:30:53', NULL),
(75, 39, 'std39', 'kb3qak', '', 'student', '', 0, 'yes', '2022-08-31 06:34:09', NULL),
(77, 40, 'std40', '5d6j5l', '', 'student', '', 0, 'yes', '2022-08-31 06:44:23', NULL),
(79, 41, 'std41', 'sx28p2', '', 'student', '', 0, 'yes', '2022-09-01 03:24:51', NULL),
(81, 42, 'std42', 'e5kzu0', '', 'student', '', 0, 'yes', '2022-09-01 03:51:23', NULL),
(83, 43, 'std43', 'q5srz3', '', 'student', '', 0, 'yes', '2022-09-01 04:14:13', NULL),
(85, 44, 'std44', '4rge01', '', 'student', '', 0, 'yes', '2022-09-01 04:41:08', NULL),
(87, 45, 'std45', '32vsvo', '', 'student', '', 0, 'yes', '2022-09-01 05:05:56', NULL),
(89, 46, 'std46', 'ysclps', '', 'student', '', 0, 'yes', '2022-09-01 05:40:25', NULL),
(91, 47, 'std47', '14inx8', '', 'student', '', 0, 'yes', '2022-09-01 06:06:15', NULL),
(93, 48, 'std48', 'p7dz2x', '', 'student', '', 0, 'yes', '2022-09-01 06:25:59', NULL),
(95, 49, 'std49', '0fsimx', '', 'student', '', 0, 'yes', '2022-09-02 02:16:22', NULL),
(97, 50, 'std50', '3tmfd1', '', 'student', '', 0, 'yes', '2022-09-02 03:07:37', NULL),
(99, 51, 'std51', 's5z4bz', '', 'student', '', 0, 'yes', '2022-09-02 03:29:56', NULL),
(101, 52, 'std52', 'phzei2', '', 'student', '', 0, 'yes', '2022-09-02 03:41:11', NULL),
(103, 53, 'std53', 'ac8xs3', '', 'student', '', 0, 'yes', '2022-09-02 03:56:32', NULL),
(105, 54, 'std54', 'z4r5p2', '', 'student', '', 0, 'yes', '2022-09-02 04:05:23', NULL),
(107, 55, 'std55', 'sq3h4o', '', 'student', '', 0, 'yes', '2022-09-02 04:16:08', NULL),
(109, 56, 'std56', 'ttp9t0', '', 'student', '', 0, 'yes', '2022-09-02 04:44:56', NULL),
(111, 57, 'std57', 'rgcgv5', '', 'student', '', 0, 'yes', '2022-09-02 05:09:23', NULL),
(112, 58, 'std58', 'isyd9s', '', 'student', '', 0, 'yes', '2022-09-02 06:04:53', NULL),
(113, 59, 'std59', '55lmkf', '', 'student', '', 0, 'yes', '2022-09-02 06:15:46', NULL),
(115, 60, 'std60', 'u2lfxf', '', 'student', '', 0, 'yes', '2022-09-02 06:28:06', NULL),
(117, 61, 'std61', 'bmy8lr', '', 'student', '', 0, 'yes', '2022-09-02 06:38:36', NULL),
(119, 62, 'std62', '023kxm', '', 'student', '', 0, 'yes', '2022-09-02 06:51:16', NULL),
(121, 63, 'std63', '75po8t', '', 'student', '', 0, 'yes', '2022-09-03 02:12:29', NULL),
(123, 64, 'std64', 'hugjpj', '', 'student', '', 0, 'yes', '2022-09-03 04:29:07', NULL),
(125, 65, 'std65', 'a6q5de', '', 'student', '', 0, 'yes', '2022-09-03 05:20:49', NULL),
(127, 66, 'std66', 'tanybk', '', 'student', '', 0, 'yes', '2022-09-03 05:36:53', NULL),
(129, 67, 'std67', '7unl58', '', 'student', '', 0, 'yes', '2022-09-03 05:50:54', NULL),
(131, 68, 'std68', 'p4scex', '', 'student', '', 0, 'yes', '2022-09-03 06:02:46', NULL),
(133, 69, 'std69', 'wgm2do', '', 'student', '', 0, 'yes', '2022-09-03 06:18:21', NULL),
(135, 70, 'std70', 'l40rua', '', 'student', '', 0, 'yes', '2022-09-03 06:27:20', NULL),
(137, 71, 'std71', 'q0dps2', '', 'student', '', 0, 'yes', '2022-09-03 06:38:22', NULL),
(139, 72, 'std72', '8f6cis', '', 'student', '', 0, 'yes', '2022-09-03 06:49:03', NULL),
(141, 73, 'std73', 'iq99z3', '', 'student', '', 0, 'yes', '2022-09-03 06:59:33', NULL),
(143, 74, 'std74', 'anzuh9', '', 'student', '', 0, 'yes', '2022-09-03 07:10:29', NULL),
(145, 75, 'std75', '7kr2n6', '', 'student', '', 0, 'yes', '2022-09-03 07:23:14', NULL),
(147, 76, 'std76', 'n4vdpa', '', 'student', '', 0, 'yes', '2022-09-05 04:24:48', NULL),
(149, 77, 'std77', '16i1am', '', 'student', '', 0, 'yes', '2022-09-05 04:32:17', NULL),
(151, 78, 'std78', 'expc7i', '', 'student', '', 0, 'yes', '2022-09-05 05:00:14', NULL),
(153, 79, 'std79', '6cm3bd', '', 'student', '', 0, 'yes', '2022-09-05 05:16:40', NULL),
(155, 80, 'std80', 'dxc798', '', 'student', '', 0, 'yes', '2022-09-05 05:33:12', NULL),
(157, 81, 'std81', '43i1nd', '', 'student', '', 0, 'yes', '2022-09-05 05:42:59', NULL),
(159, 82, 'std82', 'z0j59s', '', 'student', '', 0, 'yes', '2022-09-05 05:55:35', NULL),
(161, 83, 'std83', 'ztvaiq', '', 'student', '', 0, 'yes', '2022-09-05 06:05:32', NULL),
(163, 84, 'std84', 'g2sb3l', '', 'student', '', 0, 'yes', '2022-09-05 06:14:06', NULL),
(165, 85, 'std85', 'yv9ubd', '', 'student', '', 0, 'yes', '2022-09-05 06:26:46', NULL),
(167, 86, 'std86', 'son3fk', '', 'student', '', 0, 'yes', '2022-09-05 07:04:39', NULL),
(169, 87, 'std87', '2toz0v', '', 'student', '', 0, 'yes', '2022-09-05 07:14:12', NULL),
(171, 88, 'std88', 'jyp8fe', '', 'student', '', 0, 'yes', '2022-09-06 02:50:23', NULL),
(173, 89, 'std89', 'qwgg96', '', 'student', '', 0, 'yes', '2022-09-06 03:01:55', NULL),
(175, 90, 'std90', 'o1n1v2', '', 'student', '', 0, 'yes', '2022-09-06 03:15:58', NULL),
(177, 91, 'std91', 'o87gs7', '', 'student', '', 0, 'yes', '2022-09-06 03:25:28', NULL),
(179, 92, 'std92', '0aqfrl', '', 'student', '', 0, 'yes', '2022-09-06 03:34:40', NULL),
(181, 93, 'std93', 'wvm316', '', 'student', '', 0, 'yes', '2022-09-06 03:43:03', NULL),
(183, 94, 'std94', 'tyf4y9', '', 'student', '', 0, 'yes', '2022-09-06 03:50:31', NULL),
(185, 95, 'std95', 'zm7q2b', '', 'student', '', 0, 'yes', '2022-09-06 03:57:45', NULL),
(187, 96, 'std96', 'z1z0bm', '', 'student', '', 0, 'yes', '2022-09-06 04:08:26', NULL),
(189, 97, 'std97', 'hb5bg5', '', 'student', '', 0, 'yes', '2022-09-06 04:15:53', NULL),
(191, 98, 'std98', '4jnwxc', '', 'student', '', 0, 'yes', '2022-09-06 04:25:51', NULL),
(193, 99, 'std99', '46kwv3', '', 'student', '', 0, 'yes', '2022-09-06 04:33:52', NULL),
(195, 100, 'std100', 'ytd031', '', 'student', '', 0, 'yes', '2022-09-06 04:43:50', NULL),
(197, 101, 'std101', 'q7yjuo', '', 'student', '', 0, 'yes', '2022-09-06 05:04:37', NULL),
(199, 102, 'std102', 'ipci1o', '', 'student', '', 0, 'yes', '2022-09-06 05:26:02', NULL),
(201, 103, 'std103', 'f8aszt', '', 'student', '', 0, 'yes', '2022-09-06 05:39:37', NULL),
(203, 104, 'std104', 'q7neb7', '', 'student', '', 0, 'yes', '2022-09-06 05:55:42', NULL),
(205, 105, 'std105', 'dv54n5', '', 'student', '', 0, 'yes', '2022-09-06 06:03:54', NULL),
(207, 106, 'std106', 'dgl7l0', '', 'student', '', 0, 'yes', '2022-09-06 06:19:03', NULL),
(209, 107, 'std107', 'frlbyw', '', 'student', '', 0, 'yes', '2022-09-06 06:28:41', NULL),
(211, 108, 'std108', 'qpy5jn', '', 'student', '', 0, 'yes', '2022-09-06 06:43:25', NULL),
(213, 109, 'std109', 't1m7q7', '', 'student', '', 0, 'yes', '2022-09-06 06:56:41', NULL),
(215, 110, 'std110', 'gso6lg', '', 'student', '', 0, 'yes', '2022-09-06 07:08:02', NULL),
(217, 111, 'std111', 'h2imz2', '', 'student', '', 0, 'yes', '2022-09-07 05:33:35', NULL),
(219, 112, 'std112', 'ofakdg', '', 'student', '', 0, 'yes', '2022-09-07 05:42:59', NULL),
(221, 113, 'std113', 'upaz2k', '', 'student', '', 0, 'yes', '2022-09-07 05:51:12', NULL),
(223, 114, 'std114', '7durhg', '', 'student', '', 0, 'yes', '2022-09-07 05:57:48', NULL),
(225, 115, 'std115', 'o0d6w9', '', 'student', '', 0, 'yes', '2022-09-07 06:06:05', NULL),
(227, 116, 'std116', '9h1l3g', '', 'student', '', 0, 'yes', '2022-09-07 06:50:52', NULL),
(229, 117, 'std117', 'dnvmbn', '', 'student', '', 0, 'yes', '2022-09-07 07:00:52', NULL),
(231, 118, 'std118', 'kcm1dd', '', 'student', '', 0, 'yes', '2022-09-07 07:10:08', NULL),
(233, 119, 'std119', 't96q9g', '', 'student', '', 0, 'yes', '2022-09-07 07:17:38', NULL),
(235, 120, 'std120', 'kl9n9y', '', 'student', '', 0, 'yes', '2022-09-08 02:39:12', NULL),
(237, 121, 'std121', 'jwtfhx', '', 'student', '', 0, 'yes', '2022-09-08 02:49:42', NULL),
(239, 122, 'std122', 'rj3kfl', '', 'student', '', 0, 'yes', '2022-09-08 02:57:13', NULL),
(241, 123, 'std123', 'abr5l2', '', 'student', '', 0, 'yes', '2022-09-08 03:12:12', NULL),
(243, 124, 'std124', '1eakm8', '', 'student', '', 0, 'yes', '2022-09-08 03:19:20', NULL),
(245, 125, 'std125', 'nuhzii', '', 'student', '', 0, 'yes', '2022-09-08 03:30:14', NULL),
(247, 126, 'std126', 'gygvfb', '', 'student', '', 0, 'yes', '2022-09-08 03:37:36', NULL),
(249, 127, 'std127', 'epp579', '', 'student', '', 0, 'yes', '2022-09-08 03:44:46', NULL),
(251, 128, 'std128', 'e7xl4s', '', 'student', '', 0, 'yes', '2022-09-08 05:32:46', NULL),
(253, 129, 'std129', 'kj03h3', '', 'student', '', 0, 'yes', '2022-09-08 05:36:23', NULL),
(255, 130, 'std130', 'n86wej', '', 'student', '', 0, 'yes', '2022-09-08 05:40:27', NULL),
(257, 131, 'std131', 'x1mxlx', '', 'student', '', 0, 'yes', '2022-09-08 05:44:19', NULL),
(259, 132, 'std132', 'py2bve', '', 'student', '', 0, 'yes', '2022-09-08 05:49:47', NULL),
(261, 133, 'std133', 'mml2zd', '', 'student', '', 0, 'yes', '2022-09-08 05:56:25', NULL),
(263, 134, 'std134', 'gjqx3w', '', 'student', '', 0, 'yes', '2022-09-08 06:00:18', NULL),
(265, 135, 'std135', '78hjvu', '', 'student', '', 0, 'yes', '2022-09-08 06:04:13', NULL),
(267, 136, 'std136', '52drgh', '', 'student', '', 0, 'yes', '2022-09-08 06:07:49', NULL),
(269, 137, 'std137', 'xgank9', '', 'student', '', 0, 'yes', '2022-09-08 06:12:48', NULL),
(271, 138, 'std138', 'vjz14s', '', 'student', '', 0, 'yes', '2022-09-09 06:57:46', NULL),
(273, 139, 'std139', 'd8qy6t', '', 'student', '', 0, 'yes', '2022-09-09 07:13:23', NULL),
(275, 140, 'std140', 'wc7kjg', '', 'student', '', 0, 'yes', '2022-09-09 07:23:32', NULL),
(277, 141, 'std141', '2j8etl', '', 'student', '', 0, 'yes', '2022-09-09 07:31:35', NULL),
(279, 142, 'std142', 'aa03kq', '', 'student', '', 0, 'yes', '2022-09-09 07:39:10', NULL),
(281, 143, 'std143', '3eexn3', '', 'student', '', 0, 'yes', '2022-09-13 04:47:11', NULL),
(283, 144, 'std144', 'pzh9t8', '', 'student', '', 0, 'yes', '2022-09-13 04:57:06', NULL),
(285, 145, 'std145', 'j45w0e', '', 'student', '', 0, 'yes', '2022-09-13 05:08:17', NULL),
(287, 146, 'std146', 'klobs9', '', 'student', '', 0, 'yes', '2022-09-13 05:17:08', NULL),
(289, 147, 'std147', 'xbr39l', '', 'student', '', 0, 'yes', '2022-09-13 05:25:48', NULL),
(291, 148, 'std148', 't8819s', '', 'student', '', 0, 'yes', '2022-09-13 05:31:42', NULL),
(293, 149, 'std149', 'eajxde', '', 'student', '', 0, 'yes', '2022-09-13 13:31:55', NULL),
(295, 150, 'std150', 'ixik9f', '', 'student', '', 0, 'yes', '2022-09-13 13:39:21', NULL),
(297, 151, 'std151', 'b393cu', '', 'student', '', 0, 'yes', '2022-09-13 13:50:46', NULL),
(299, 152, 'std152', 'ekkq0e', '', 'student', '', 0, 'yes', '2022-09-13 13:59:05', NULL),
(301, 153, 'std153', '0mrd8t', '', 'student', '', 0, 'yes', '2022-09-13 14:11:04', NULL),
(303, 154, 'std154', 'xec1oz', '', 'student', '', 0, 'yes', '2022-09-13 14:28:20', NULL),
(304, 155, 'std155', '5y8748', '', 'student', '', 0, 'yes', '2022-09-13 14:44:08', NULL),
(306, 156, 'std156', '2ynqqa', '', 'student', '', 0, 'yes', '2022-09-13 14:46:54', NULL),
(308, 157, 'std157', 'gwjcea', '', 'student', '', 0, 'yes', '2022-09-13 14:49:45', NULL),
(310, 158, 'std158', 'gsf6y8', '', 'student', '', 0, 'yes', '2022-09-13 14:58:52', NULL),
(312, 159, 'std159', 'ygwlgm', '', 'student', '', 0, 'yes', '2022-09-13 15:05:37', NULL),
(314, 160, 'std160', 'i5l7mu', '', 'student', '', 0, 'yes', '2022-09-13 15:11:28', NULL),
(316, 161, 'std161', 'rg7wtm', '', 'student', '', 0, 'yes', '2022-09-13 15:13:24', NULL),
(317, 162, 'std162', 'oewyhg', '', 'student', '', 0, 'yes', '2022-09-13 15:15:09', NULL),
(318, 163, 'std163', 'sb69lc', '', 'student', '', 0, 'yes', '2022-09-14 02:51:09', NULL),
(320, 164, 'std164', '5xmt7b', '', 'student', '', 0, 'yes', '2022-09-14 03:06:24', NULL),
(322, 165, 'std165', 'w091m5', '', 'student', '', 0, 'yes', '2022-09-14 03:13:47', NULL),
(324, 166, 'std166', 'gv6lny', '', 'student', '', 0, 'yes', '2022-09-14 03:32:08', NULL),
(326, 167, 'std167', 'bk6xdy', '', 'student', '', 0, 'yes', '2022-09-14 03:42:54', NULL),
(327, 168, 'std168', 'pwab4a', '', 'student', '', 0, 'yes', '2022-09-14 03:49:43', NULL),
(328, 169, 'std169', 'sh2fuc', '', 'student', '', 0, 'yes', '2022-09-14 03:57:50', NULL),
(330, 170, 'std170', 'kljhy8', '', 'student', '', 0, 'yes', '2022-09-14 04:14:39', NULL),
(332, 171, 'std171', 'k2qqlv', '', 'student', '', 0, 'yes', '2022-09-14 04:28:38', NULL),
(334, 172, 'std172', 'abw2ab', '', 'student', '', 0, 'yes', '2022-09-14 04:45:52', NULL),
(336, 173, 'std173', 'cfme7v', '', 'student', '', 0, 'yes', '2022-09-14 06:40:11', NULL),
(338, 174, 'std174', 'x1zozr', '', 'student', '', 0, 'yes', '2022-09-14 07:01:20', NULL),
(340, 175, 'std175', 'z1n6l5', '', 'student', '', 0, 'yes', '2022-09-14 07:24:05', NULL),
(341, 176, 'std176', 'xweeor', '', 'student', '', 0, 'yes', '2022-09-15 04:04:52', NULL),
(343, 177, 'std177', 'nfsx1b', '', 'student', '', 0, 'yes', '2022-09-15 04:12:46', NULL),
(345, 178, 'std178', '37jrl6', '', 'student', '', 0, 'yes', '2022-09-15 04:18:12', NULL),
(346, 179, 'std179', 'gh3loh', '', 'student', '', 0, 'yes', '2022-09-15 04:25:44', NULL),
(350, 181, 'std181', 'ayvq70', '', 'student', '', 0, 'yes', '2022-09-15 04:52:51', NULL),
(352, 182, 'std182', '1uy1ze', '', 'student', '', 0, 'yes', '2022-09-15 05:07:06', NULL),
(354, 183, 'std183', 'w3bbgi', '', 'student', '', 0, 'yes', '2022-09-15 14:45:10', NULL),
(356, 184, 'std184', 'vhngir', '', 'student', '', 0, 'yes', '2022-09-15 15:07:19', NULL),
(358, 185, 'std185', 'i1ic25', '', 'student', '', 0, 'yes', '2022-09-15 15:09:07', NULL),
(360, 186, 'std186', 'axot80', '', 'student', '', 0, 'yes', '2022-09-15 15:15:41', NULL),
(362, 187, 'std187', '61y14b', '', 'student', '', 0, 'yes', '2022-09-15 16:01:00', NULL),
(363, 188, 'std188', 'kyakzf', '', 'student', '', 0, 'yes', '2022-09-15 16:04:50', NULL),
(365, 189, 'std189', 'l7lx2j', '', 'student', '', 0, 'yes', '2022-09-15 16:09:57', NULL),
(369, 191, 'std191', '1kylck', '', 'student', '', 0, 'yes', '2022-09-15 16:14:42', NULL),
(371, 192, 'std192', 'hal34u', '', 'student', '', 0, 'yes', '2022-09-15 16:16:22', NULL),
(373, 193, 'std193', 'nkqcis', '', 'student', '', 0, 'yes', '2022-09-15 16:18:50', NULL),
(374, 194, 'std194', 'rz80s1', '', 'student', '', 0, 'yes', '2022-09-15 16:23:47', NULL),
(376, 195, 'std195', 'w4k4a8', '', 'student', '', 0, 'yes', '2022-09-16 06:32:56', NULL),
(378, 196, 'std196', '1bn3is', '', 'student', '', 0, 'yes', '2022-09-22 02:59:50', NULL),
(380, 197, 'std197', 'pmmyb9', '', 'student', '', 0, 'yes', '2022-09-22 03:10:23', NULL),
(382, 198, 'std198', 'icmx3w', '', 'student', '', 0, 'yes', '2022-09-22 03:18:36', NULL),
(384, 199, 'std199', 'kv4y6m', '', 'student', '', 0, 'yes', '2022-09-22 03:33:42', NULL),
(386, 200, 'std200', 'qbzsb3', '', 'student', '', 0, 'yes', '2022-09-22 03:49:40', NULL),
(388, 201, 'std201', 'y90k7a', '', 'student', '', 0, 'yes', '2022-09-23 03:25:53', NULL),
(390, 202, 'std202', 'vsl8jh', '', 'student', '', 0, 'yes', '2022-09-23 03:40:37', NULL),
(392, 203, 'std203', 'dn70gf', '', 'student', '', 0, 'yes', '2022-09-23 04:06:07', NULL),
(394, 204, 'std204', '87jk26', '', 'student', '', 0, 'yes', '2022-09-23 04:34:38', NULL),
(395, 205, 'std205', 'oopb0l', '', 'student', '', 0, 'yes', '2022-09-23 04:42:35', NULL),
(397, 206, 'std206', 'l04g31', '', 'student', '', 0, 'yes', '2022-09-23 04:49:57', NULL),
(398, 207, 'std207', 'ttey1r', '', 'student', '', 0, 'yes', '2022-09-23 04:57:35', NULL),
(400, 208, 'std208', 'k4wnbd', '', 'student', '', 0, 'yes', '2022-09-23 05:02:57', NULL),
(401, 209, 'std209', 'opyc1w', '', 'student', '', 0, 'yes', '2022-09-23 05:18:21', NULL),
(402, 210, 'std210', 'sd5z9k', '', 'student', '', 0, 'yes', '2022-09-23 05:26:48', NULL),
(404, 211, 'std211', 'ngmfos', '', 'student', '', 0, 'yes', '2022-09-23 05:36:27', NULL),
(406, 212, 'std212', 'di9n77', '', 'student', '', 0, 'yes', '2022-09-23 05:52:13', NULL),
(407, 213, 'std213', 'kewdx0', '', 'student', '', 0, 'yes', '2022-09-23 06:10:25', NULL),
(409, 214, 'std214', 'z3p8uk', '', 'student', '', 0, 'yes', '2022-09-23 06:18:07', NULL),
(411, 215, 'std215', 'djx7yn', '', 'student', '', 0, 'yes', '2022-09-23 06:31:18', NULL),
(413, 216, 'std216', 'gia347', '', 'student', '', 0, 'yes', '2022-10-27 07:35:41', NULL),
(414, 217, 'std217', 'snguq9', '', 'student', '', 0, 'yes', '2022-10-27 07:45:47', NULL),
(416, 218, 'std218', 'jx1t4s', '', 'student', '', 0, 'yes', '2022-10-27 07:54:26', NULL),
(418, 219, 'std219', 't0y9qe', '', 'student', '', 0, 'yes', '2022-10-27 08:04:24', NULL),
(420, 220, 'std220', 'vrfux1', '', 'student', '', 0, 'yes', '2022-10-28 03:23:15', NULL),
(422, 221, 'std221', 'ffsv90', '', 'student', '', 0, 'yes', '2022-10-28 03:31:00', NULL),
(424, 222, 'std222', '77st6a', '', 'student', '', 0, 'yes', '2022-10-28 03:37:19', NULL),
(426, 223, 'std223', 'oxedvn', '', 'student', '', 0, 'yes', '2022-10-28 03:43:47', NULL),
(427, 224, 'std224', 'fwtwwi', '', 'student', '', 0, 'yes', '2022-10-28 03:46:09', NULL),
(429, 225, 'std225', 'oxx61r', '', 'student', '', 0, 'yes', '2022-10-28 04:02:37', NULL),
(431, 226, 'std226', 'm80qu4', '', 'student', '', 0, 'yes', '2022-10-28 04:13:21', NULL),
(432, 227, 'std227', 'p207fk', '', 'student', '', 0, 'yes', '2022-10-28 04:21:09', NULL),
(434, 228, 'std228', '2xsf0z', '', 'student', '', 0, 'yes', '2022-10-28 04:30:29', NULL),
(436, 229, 'std229', 'c0l30v', '', 'student', '', 0, 'yes', '2022-10-28 04:44:12', NULL),
(438, 230, 'std230', 'maqedb', '', 'student', '', 0, 'yes', '2022-10-28 05:04:14', NULL),
(440, 231, 'std231', 'qioq72', '', 'student', '', 0, 'yes', '2022-10-28 05:12:45', NULL),
(441, 232, 'std232', 'hvzfop', '', 'student', '', 0, 'yes', '2022-10-28 05:23:03', NULL),
(442, 233, 'std233', 'k0oo6x', '', 'student', '', 0, 'yes', '2022-10-28 05:31:09', NULL),
(443, 234, 'std234', 'c1idsg', '', 'student', '', 0, 'yes', '2022-10-28 05:38:00', NULL),
(445, 235, 'std235', 'lytgj2', '', 'student', '', 0, 'yes', '2022-10-28 05:49:09', NULL),
(448, 236, 'std236', 'csjwus', '', 'student', '', 0, 'yes', '2022-10-28 08:36:02', NULL),
(450, 237, 'std237', '96c9eb', '', 'student', '', 0, 'yes', '2022-10-28 08:43:30', NULL),
(452, 238, 'std238', 'bxvyiw', '', 'student', '', 0, 'yes', '2022-10-31 03:50:44', NULL),
(453, 239, 'std239', 'o4xunj', '', 'student', '', 0, 'yes', '2022-11-05 07:42:00', NULL),
(455, 240, 'std240', 'odvgrf', '', 'student', '', 0, 'yes', '2022-11-07 04:33:20', NULL),
(457, 241, 'std241', 'mmjiwi', '', 'student', '', 0, 'yes', '2022-11-14 03:37:40', NULL),
(458, 242, 'std242', 'o0jyuu', '', 'student', '', 0, 'yes', '2022-11-14 03:48:43', NULL),
(460, 243, 'std243', 'a888g8', '', 'student', '', 0, 'yes', '2022-11-14 03:56:34', NULL),
(462, 244, 'std244', 'z4euzs', '', 'student', '', 0, 'yes', '2022-11-14 04:24:30', NULL),
(464, 245, 'std245', 'kiz8mr', '', 'student', '', 0, 'yes', '2022-11-14 04:31:53', NULL),
(465, 246, 'std246', 'gssbhm', '', 'student', '', 0, 'yes', '2022-11-14 04:38:57', NULL),
(466, 247, 'std247', '1joyv9', '', 'student', '', 0, 'yes', '2022-11-14 05:46:46', NULL),
(468, 248, 'std248', 'wfpqdm', '', 'student', '', 0, 'yes', '2022-11-16 07:56:31', NULL),
(470, 249, 'std249', 'rq9sr7', '', 'student', '', 0, 'yes', '2022-11-16 08:04:38', NULL),
(472, 250, 'std250', 'fr004j', '', 'student', '', 0, 'yes', '2022-11-16 08:14:27', NULL),
(474, 251, 'std251', 'pvzwcw', '', 'student', '', 0, 'yes', '2022-11-16 08:21:07', NULL),
(475, 252, 'std252', '7j927x', '', 'student', '', 0, 'yes', '2022-11-16 08:31:12', NULL),
(477, 253, 'std253', '4863cy', '', 'student', '', 0, 'yes', '2022-11-20 14:16:19', NULL),
(479, 254, 'std254', 'prkt4q', '', 'student', '', 0, 'yes', '2022-11-20 14:19:02', NULL),
(480, 255, 'std255', 'yb3oc3', '', 'student', '', 0, 'yes', '2022-11-20 14:21:59', NULL),
(482, 256, 'std256', 'w7z0q5', '', 'student', '', 0, 'yes', '2022-11-20 14:25:03', NULL),
(484, 257, 'std257', '65nslw', '', 'student', '', 0, 'yes', '2022-11-20 14:27:55', NULL),
(486, 258, 'std258', 'in558j', '', 'student', '', 0, 'yes', '2022-11-20 14:35:32', NULL),
(490, 260, 'std260', '0yorn6', '', 'student', '', 0, 'yes', '2022-11-20 14:41:47', NULL),
(491, 261, 'std261', '50jkp2', '', 'student', '', 0, 'yes', '2022-11-20 14:44:07', NULL),
(493, 262, 'std262', '89tr6l', '', 'student', '', 0, 'yes', '2022-11-20 14:46:07', NULL),
(494, 263, 'std263', '8trc6y', '', 'student', '', 0, 'yes', '2022-11-20 14:49:00', NULL),
(496, 264, 'std264', 'ne4xzy', '', 'student', '', 0, 'yes', '2022-11-20 14:52:05', NULL),
(497, 265, 'std265', '8mxgoh', '', 'student', '', 0, 'yes', '2022-11-20 14:55:36', NULL),
(498, 266, 'std266', '0wsc1u', '', 'student', '', 0, 'yes', '2022-11-20 14:59:02', NULL),
(500, 267, 'std267', 'fns46t', '', 'student', '', 0, 'yes', '2022-11-20 15:11:00', NULL),
(502, 268, 'std268', 'jatr6h', '', 'student', '', 0, 'yes', '2022-11-22 06:41:32', NULL),
(504, 269, 'std269', '7c83il', '', 'student', '', 0, 'yes', '2022-11-22 06:48:12', NULL),
(506, 270, 'std270', 'mlup6m', '', 'student', '', 0, 'yes', '2022-11-22 06:55:56', NULL),
(508, 271, 'std271', '02mqqe', '', 'student', '', 0, 'yes', '2022-11-22 07:07:08', NULL),
(510, 272, 'std272', 'gzcv9e', '', 'student', '', 0, 'yes', '2022-11-22 07:16:44', NULL),
(512, 273, 'std273', '9cikbq', '', 'student', '', 0, 'yes', '2022-11-22 07:25:20', NULL),
(514, 274, 'std274', 'hxnzw8', '', 'student', '', 0, 'yes', '2022-11-22 08:03:56', NULL),
(516, 275, 'std275', 'wukgcy', '', 'student', '', 0, 'yes', '2022-11-22 08:15:34', NULL),
(518, 276, 'std276', '1vzgll', '', 'student', '', 0, 'yes', '2022-11-22 08:21:39', NULL),
(520, 277, 'std277', 'jjlymc', '', 'student', '', 0, 'yes', '2022-11-23 06:06:02', NULL),
(522, 278, 'std278', 'cnwybk', '', 'student', '', 0, 'yes', '2022-11-23 06:48:55', NULL),
(524, 279, 'std279', 'uyuvzd', '', 'student', '', 0, 'yes', '2022-11-23 07:12:10', NULL),
(525, 280, 'std280', '48mj83', '', 'student', '', 0, 'yes', '2022-11-23 07:41:58', NULL),
(526, 281, 'std281', 'cwrebv', '', 'student', '', 0, 'yes', '2022-11-23 08:03:01', NULL),
(527, 282, 'std282', 'ovuxin', '', 'student', '', 0, 'yes', '2022-11-23 08:10:24', NULL),
(528, 283, 'std283', 'nkspj9', '', 'student', '', 0, 'yes', '2022-11-24 06:49:41', NULL),
(530, 284, 'std284', '3zuevf', '', 'student', '', 0, 'yes', '2022-11-24 06:58:32', NULL),
(532, 285, 'std285', '2a9468', '', 'student', '', 0, 'yes', '2022-11-24 07:08:05', NULL),
(534, 286, 'std286', 'urk12p', '', 'student', '', 0, 'yes', '2022-11-24 07:14:15', NULL),
(536, 287, 'std287', 'f6t2xr', '', 'student', '', 0, 'yes', '2022-11-24 08:04:52', NULL),
(537, 288, 'std288', 'ixa8w8', '', 'student', '', 0, 'yes', '2022-11-30 04:40:39', NULL),
(538, 289, 'std289', 'qskhiq', '', 'student', '', 0, 'yes', '2022-11-30 04:46:45', NULL),
(540, 290, 'std290', 'o29otu', '', 'student', '', 0, 'yes', '2022-11-30 05:05:13', NULL),
(542, 291, 'std291', 'm4nx12', '', 'student', '', 0, 'yes', '2022-12-01 03:46:07', NULL),
(544, 292, 'std292', 'q6kznj', '', 'student', '', 0, 'yes', '2022-12-01 03:56:08', NULL),
(546, 293, 'std293', '9frniq', '', 'student', '', 0, 'yes', '2022-12-01 04:11:46', NULL),
(548, 294, 'std294', 'v48h32', '', 'student', '', 0, 'yes', '2022-12-01 04:17:53', NULL),
(550, 295, 'std295', 'iwrkw1', '', 'student', '', 0, 'yes', '2022-12-07 05:27:30', NULL),
(552, 296, 'std296', '6nxwh3', '', 'student', '', 0, 'yes', '2022-12-07 06:17:03', NULL),
(553, 297, 'std297', '4cjcbf', '', 'student', '', 0, 'yes', '2022-12-14 06:00:19', NULL),
(557, 299, 'std299', 'zfaqtb', '', 'student', '', 0, 'yes', '2023-01-05 05:03:48', NULL),
(559, 300, 'std300', '30f8q3', '', 'student', '', 0, 'yes', '2023-01-05 05:24:46', NULL),
(561, 301, 'std301', '3n5nlp', '', 'student', '', 0, 'yes', '2023-01-06 04:40:27', NULL),
(563, 302, 'std302', 'x9u8up', '', 'student', '', 0, 'yes', '2023-01-06 04:46:53', NULL),
(565, 303, 'std303', 'c0stgn', '', 'student', '', 0, 'yes', '2023-01-06 04:49:51', NULL),
(567, 304, 'std304', 'y64g56', '', 'student', '', 0, 'yes', '2023-01-06 04:52:52', NULL),
(569, 305, 'std305', '43z0da', '', 'student', '', 0, 'yes', '2023-01-06 04:58:13', NULL),
(571, 306, 'std306', 'dqncq0', '', 'student', '', 0, 'yes', '2023-01-06 05:05:14', NULL),
(573, 307, 'std307', 'xtx3gf', '', 'student', '', 0, 'yes', '2023-01-06 05:09:46', NULL),
(575, 308, 'std308', 'owgqhb', '', 'student', '', 0, 'yes', '2023-01-06 05:12:56', NULL),
(577, 309, 'std309', '0rnee8', '', 'student', '', 0, 'yes', '2023-01-06 05:15:59', NULL),
(579, 310, 'std310', '967rtd', '', 'student', '', 0, 'yes', '2023-01-06 05:19:09', NULL),
(581, 311, 'std311', 'f4kfyu', '', 'student', '', 0, 'yes', '2023-01-06 05:22:33', NULL),
(583, 312, 'std312', '6zizts', '', 'student', '', 0, 'yes', '2023-01-06 05:24:59', NULL),
(585, 313, 'std313', '7zgs5y', '', 'student', '', 0, 'yes', '2023-01-06 05:32:05', NULL),
(587, 314, 'std314', 'prfah1', '', 'student', '', 0, 'yes', '2023-01-06 05:35:19', NULL),
(589, 315, 'std315', 't1uvxb', '', 'student', '', 0, 'yes', '2023-01-06 05:44:24', NULL),
(591, 316, 'std316', 'qamplv', '', 'student', '', 0, 'yes', '2023-01-06 05:47:24', NULL),
(593, 317, 'std317', '2q726m', '', 'student', '', 0, 'yes', '2023-01-06 05:50:46', NULL),
(595, 318, 'std318', 'l3551y', '', 'student', '', 0, 'yes', '2023-01-06 05:53:22', NULL),
(597, 319, 'std319', 'ugqfrr', '', 'student', '', 0, 'yes', '2023-01-06 05:56:27', NULL),
(599, 320, 'std320', 'i2yjgj', '', 'student', '', 0, 'yes', '2023-01-06 05:59:42', NULL),
(601, 321, 'std321', 'qszy6h', '', 'student', '', 0, 'yes', '2023-01-06 06:02:33', NULL),
(603, 322, 'std322', 'fta5nt', '', 'student', '', 0, 'yes', '2023-01-06 06:14:00', NULL),
(605, 323, 'std323', 'igeji1', '', 'student', '', 0, 'yes', '2023-01-06 06:17:00', NULL),
(607, 324, 'std324', 'nntqva', '', 'student', '', 0, 'yes', '2023-01-06 06:19:10', NULL),
(609, 325, 'std325', 'gwjcm0', '', 'student', '', 0, 'yes', '2023-01-06 06:21:59', NULL),
(611, 326, 'std326', 'da4wyp', '', 'student', '', 0, 'yes', '2023-01-06 06:25:00', NULL),
(613, 327, 'std327', '3n0mgb', '', 'student', '', 0, 'yes', '2023-01-06 06:27:33', NULL),
(615, 328, 'std328', 'drpth2', '', 'student', '', 0, 'yes', '2023-01-06 06:29:57', NULL),
(617, 329, 'std329', 'vn7rjr', '', 'student', '', 0, 'yes', '2023-01-06 06:32:13', NULL),
(619, 330, 'std330', 'iocxzt', '', 'student', '', 0, 'yes', '2023-01-06 06:35:46', NULL),
(621, 331, 'std331', 'rlfsa2', '', 'student', '', 0, 'yes', '2023-01-06 06:38:56', NULL),
(623, 332, 'std332', '9wpvtv', '', 'student', '', 0, 'yes', '2023-01-06 06:42:42', NULL),
(625, 333, 'std333', 'o09g3g', '', 'student', '', 0, 'yes', '2023-01-06 06:45:19', NULL),
(627, 334, 'std334', 'hxzcdb', '', 'student', '', 0, 'yes', '2023-01-06 06:48:51', NULL),
(629, 335, 'std335', 'vl30hp', '', 'student', '', 0, 'yes', '2023-01-06 06:59:38', NULL),
(631, 336, 'std336', 'r8c80n', '', 'student', '', 0, 'yes', '2023-01-06 07:02:35', NULL),
(633, 337, 'std337', 'q8o292', '', 'student', '', 0, 'yes', '2023-01-06 07:09:51', NULL),
(635, 338, 'std338', 'i4xyeh', '', 'student', '', 0, 'yes', '2023-01-16 08:44:37', NULL),
(637, 339, 'std339', 'diakmu', '', 'student', '', 0, 'yes', '2023-01-26 05:13:08', NULL),
(639, 340, 'std340', 'odnyqr', '', 'student', '', 0, 'yes', '2023-01-26 05:17:02', NULL),
(641, 341, 'std341', 'hblm6z', '', 'student', '', 0, 'yes', '2023-01-26 05:23:25', NULL),
(643, 342, 'std342', '4gecot', '', 'student', '', 0, 'yes', '2023-01-26 05:26:11', NULL),
(645, 343, 'std343', '0h1xdl', '', 'student', '', 0, 'yes', '2023-01-26 05:28:34', NULL),
(647, 344, 'std344', 'x2mrg3', '', 'student', '', 0, 'yes', '2023-01-26 05:31:22', NULL),
(649, 345, 'std345', 'e5fztu', '', 'student', '', 0, 'yes', '2023-01-26 05:34:35', NULL),
(651, 346, 'std346', '4hr72f', '', 'student', '', 0, 'yes', '2023-01-26 05:37:55', NULL),
(653, 347, 'std347', '70pk0a', '', 'student', '', 0, 'yes', '2023-01-26 05:40:51', NULL),
(655, 348, 'std348', 'gcqpep', '', 'student', '', 0, 'yes', '2023-01-26 05:43:23', NULL),
(657, 349, 'std349', 'ircia5', '', 'student', '', 0, 'yes', '2023-01-26 05:45:53', NULL),
(659, 350, 'std350', 's4fxzf', '', 'student', '', 0, 'yes', '2023-01-26 05:48:56', NULL),
(661, 351, 'std351', 'xl0yly', '', 'student', '', 0, 'yes', '2023-01-26 05:52:06', NULL),
(663, 352, 'std352', 'jvh16e', '', 'student', '', 0, 'yes', '2023-01-26 05:55:07', NULL),
(665, 353, 'std353', '7q1o8p', '', 'student', '', 0, 'yes', '2023-01-26 05:57:35', NULL),
(667, 354, 'std354', '1wf9rt', '', 'student', '', 0, 'yes', '2023-01-26 06:02:02', NULL),
(669, 355, 'std355', '66r1xr', '', 'student', '', 0, 'yes', '2023-01-26 06:06:09', NULL),
(671, 356, 'std356', '71f4a8', '', 'student', '', 0, 'yes', '2023-01-26 06:09:45', NULL),
(673, 357, 'std357', 'bob3ke', '', 'student', '', 0, 'yes', '2023-01-26 06:14:58', NULL),
(675, 358, 'std358', 'on6341', '', 'student', '', 0, 'yes', '2023-01-26 06:17:59', NULL),
(677, 359, 'std359', 'kwqx8c', '', 'student', '', 0, 'yes', '2023-01-26 06:22:04', NULL),
(679, 360, 'std360', '5e9woe', '', 'student', '', 0, 'yes', '2023-01-26 06:24:23', NULL),
(681, 361, 'std361', 'svz9ax', '', 'student', '', 0, 'yes', '2023-01-26 06:28:14', NULL),
(683, 362, 'std362', 'qhpf1y', '', 'student', '', 0, 'yes', '2023-01-26 06:31:29', NULL),
(685, 363, 'std363', 'fmipop', '', 'student', '', 0, 'yes', '2023-01-26 06:34:20', NULL),
(687, 364, 'std364', 'h26uyg', '', 'student', '', 0, 'yes', '2023-01-26 06:36:31', NULL),
(689, 365, 'std365', 'fiwcyv', '', 'student', '', 0, 'yes', '2023-01-26 06:41:18', NULL),
(691, 366, 'std366', 'e8alu8', '', 'student', '', 0, 'yes', '2023-01-26 06:47:05', NULL),
(693, 367, 'std367', 'wvp7lk', '', 'student', '', 0, 'yes', '2023-01-26 06:50:07', NULL),
(695, 368, 'std368', '0irafc', '', 'student', '', 0, 'yes', '2023-01-26 06:53:47', NULL),
(697, 369, 'std369', 'duo1jf', '', 'student', '', 0, 'yes', '2023-01-26 06:56:16', NULL),
(699, 370, 'std370', 'lz3eas', '', 'student', '', 0, 'yes', '2023-01-26 07:25:23', NULL),
(701, 371, 'std371', 'kbe4r6', '', 'student', '', 0, 'yes', '2023-01-26 07:29:01', NULL),
(703, 372, 'std372', 'gbawsc', '', 'student', '', 0, 'yes', '2023-01-27 07:30:28', NULL),
(705, 373, 'std373', 'cl122p', '', 'student', '', 0, 'yes', '2023-01-27 07:33:26', NULL),
(707, 374, 'std374', 'tnaumv', '', 'student', '', 0, 'yes', '2023-01-27 07:36:56', NULL),
(709, 375, 'std375', 'byv612', '', 'student', '', 0, 'yes', '2023-01-27 07:39:48', NULL),
(711, 376, 'std376', '1z45jn', '', 'student', '', 0, 'yes', '2023-01-27 07:42:10', NULL),
(713, 377, 'std377', 'z9vdjq', '', 'student', '', 0, 'yes', '2023-01-27 07:44:56', NULL),
(715, 378, 'std378', 'ehi8dm', '', 'student', '', 0, 'yes', '2023-01-27 07:47:04', NULL),
(717, 379, 'std379', '7fvtzz', '', 'student', '', 0, 'yes', '2023-01-27 07:49:24', NULL),
(719, 380, 'std380', 'dsdeih', '', 'student', '', 0, 'yes', '2023-01-27 08:29:08', NULL),
(721, 381, 'std381', '3wh2yl', '', 'student', '', 0, 'yes', '2023-01-27 08:33:09', NULL),
(723, 382, 'std382', 'biy3xg', '', 'student', '', 0, 'yes', '2023-02-01 06:50:14', NULL),
(725, 383, 'std383', 'fzqi9a', '', 'student', '', 0, 'yes', '2023-02-01 06:52:57', NULL),
(727, 384, 'std384', 'go5cu4', '', 'student', '', 0, 'yes', '2023-02-01 06:57:45', NULL),
(729, 385, 'std385', 'gnrjs9', '', 'student', '', 0, 'yes', '2023-02-01 06:59:45', NULL),
(731, 386, 'std386', '5gziug', '', 'student', '', 0, 'yes', '2023-02-01 07:05:35', NULL),
(733, 387, 'std387', '09hgwu', '', 'student', '', 0, 'yes', '2023-02-01 07:12:26', NULL),
(735, 388, 'std388', '3kin0s', '', 'student', '', 0, 'yes', '2023-02-01 07:15:01', NULL),
(737, 389, 'std389', '1nlh6u', '', 'student', '', 0, 'yes', '2023-02-01 07:38:53', NULL),
(739, 390, 'std390', '0suqzh', '', 'student', '', 0, 'yes', '2023-02-01 07:41:12', NULL),
(741, 391, 'std391', 'dx0ivp', '', 'student', '', 0, 'yes', '2023-02-01 07:48:10', NULL),
(743, 392, 'std392', 'cdp29n', '', 'student', '', 0, 'yes', '2023-02-01 07:51:21', NULL),
(745, 393, 'std393', 'jyhqrn', '', 'student', '', 0, 'yes', '2023-02-01 08:09:59', NULL),
(747, 394, 'std394', '4d58i9', '', 'student', '', 0, 'yes', '2023-02-01 08:18:17', NULL),
(749, 395, 'std395', '10avd3', '', 'student', '', 0, 'yes', '2023-02-01 08:20:53', NULL),
(751, 396, 'std396', 'y8olie', '', 'student', '', 0, 'yes', '2023-02-01 08:23:13', NULL),
(753, 397, 'std397', 'vtsy18', '', 'student', '', 0, 'yes', '2023-02-01 08:25:17', NULL),
(755, 398, 'std398', 'gsbguw', '', 'student', '', 0, 'yes', '2023-02-01 08:27:42', NULL),
(757, 399, 'std399', '4xrbro', '', 'student', '', 0, 'yes', '2023-02-01 08:29:27', NULL),
(759, 400, 'std400', 'r3foz5', '', 'student', '', 0, 'yes', '2023-02-01 08:32:17', NULL),
(761, 401, 'std401', 'cjip06', '', 'student', '', 0, 'yes', '2023-02-01 08:34:13', NULL),
(763, 402, 'std402', 'ewl6gh', '', 'student', '', 0, 'yes', '2023-02-01 08:36:18', NULL),
(765, 403, 'std403', 'bbayio', '', 'student', '', 0, 'yes', '2023-02-01 08:38:01', NULL),
(767, 404, 'std404', 'xqdwcg', '', 'student', '', 0, 'yes', '2023-02-01 08:40:15', NULL),
(769, 405, 'std405', 'o2mzd9', '', 'student', '', 0, 'yes', '2023-02-02 06:06:03', NULL),
(771, 406, 'std406', 'lgf5xs', '', 'student', '', 0, 'yes', '2023-02-02 06:08:12', NULL),
(773, 407, 'std407', '1iuxzu', '', 'student', '', 0, 'yes', '2023-02-02 06:10:22', NULL),
(775, 408, 'std408', 'vfi4oq', '', 'student', '', 0, 'yes', '2023-02-02 06:15:02', NULL),
(777, 409, 'std409', 'vvjics', '', 'student', '', 0, 'yes', '2023-02-02 06:17:09', NULL),
(779, 410, 'std410', 'kgc0y9', '', 'student', '', 0, 'yes', '2023-02-02 06:18:58', NULL),
(781, 411, 'std411', 'qbtp8b', '', 'student', '', 0, 'yes', '2023-02-02 06:21:13', NULL),
(783, 412, 'std412', '90ah5v', '', 'student', '', 0, 'yes', '2023-02-02 06:32:22', NULL),
(785, 413, 'std413', 'bl8fkh', '', 'student', '', 0, 'yes', '2023-02-02 06:34:28', NULL),
(787, 414, 'std414', 'g67zqg', '', 'student', '', 0, 'yes', '2023-02-03 04:58:19', NULL),
(789, 415, 'std415', 'ecpfs8', '', 'student', '', 0, 'yes', '2023-02-03 05:07:48', NULL),
(791, 416, 'std416', 'njykju', '', 'student', '', 0, 'yes', '2023-02-03 05:15:25', NULL),
(793, 417, 'std417', '96l0z8', '', 'student', '', 0, 'yes', '2023-02-03 05:24:22', NULL),
(795, 418, 'std418', 'sy0tqf', '', 'student', '', 0, 'yes', '2023-02-03 05:28:04', NULL),
(797, 419, 'std419', 'jhssme', '', 'student', '', 0, 'yes', '2023-02-03 05:31:13', NULL),
(799, 420, 'std420', 'hefgeo', '', 'student', '', 0, 'yes', '2023-02-03 05:36:24', NULL),
(801, 421, 'std421', 'yxxhj7', '', 'student', '', 0, 'yes', '2023-02-03 05:39:56', NULL),
(803, 422, 'std422', '1leors', '', 'student', '', 0, 'yes', '2023-02-03 05:43:24', NULL),
(805, 423, 'std423', '4ix5d6', '', 'student', '', 0, 'yes', '2023-02-03 05:48:57', NULL),
(807, 424, 'std424', 'skek2t', '', 'student', '', 0, 'yes', '2023-02-03 05:52:04', NULL),
(809, 425, 'std425', 'cch0nq', '', 'student', '', 0, 'yes', '2023-02-03 05:54:41', NULL),
(811, 426, 'std426', 'tl0kif', '', 'student', '', 0, 'yes', '2023-02-03 05:57:29', NULL),
(813, 427, 'std427', '7ne3ld', '', 'student', '', 0, 'yes', '2023-02-03 06:00:05', NULL),
(815, 428, 'std428', '5g87st', '', 'student', '', 0, 'yes', '2023-02-03 06:02:52', NULL),
(817, 429, 'std429', 'cjm7q6', '', 'student', '', 0, 'yes', '2023-02-03 06:05:52', NULL),
(819, 430, 'std430', 'xog2tl', '', 'student', '', 0, 'yes', '2023-02-03 06:08:44', NULL),
(821, 431, 'std431', 'v4t7og', '', 'student', '', 0, 'yes', '2023-02-03 06:12:04', NULL),
(823, 432, 'std432', '9cl669', '', 'student', '', 0, 'yes', '2023-02-03 06:15:22', NULL),
(825, 433, 'std433', 'm7st2a', '', 'student', '', 0, 'yes', '2023-02-03 06:18:22', NULL),
(827, 434, 'std434', 'cq1d88', '', 'student', '', 0, 'yes', '2023-02-03 06:21:02', NULL),
(829, 435, 'std435', '8u47ox', '', 'student', '', 0, 'yes', '2023-02-03 06:23:35', NULL),
(831, 436, 'std436', '64gfrw', '', 'student', '', 0, 'yes', '2023-02-03 06:30:06', NULL),
(833, 437, 'std437', 'uyn08t', '', 'student', '', 0, 'yes', '2023-02-03 06:32:38', NULL),
(835, 438, 'std438', '6gea7k', '', 'student', '', 0, 'yes', '2023-02-03 06:35:08', NULL),
(837, 439, 'std439', '5sfccz', '', 'student', '', 0, 'yes', '2023-02-03 06:38:01', NULL),
(839, 440, 'std440', '8fq4on', '', 'student', '', 0, 'yes', '2023-02-03 06:42:42', NULL),
(841, 441, 'std441', 'kbzyt6', '', 'student', '', 0, 'yes', '2023-02-24 07:10:12', NULL),
(843, 442, 'std442', 'nsnx3m', '', 'student', '', 0, 'yes', '2023-03-06 04:43:17', NULL),
(846, 443, 'std443', 'fhmxko', '', 'student', '', 0, 'yes', '2023-03-25 15:40:58', NULL),
(848, 444, 'std444', 'rjf1vk', '', 'student', '', 0, 'yes', '2023-03-27 04:07:56', NULL),
(849, 445, 'std445', 'ceyrs6', '', 'student', '', 0, 'yes', '2023-04-01 06:17:53', NULL),
(850, 446, 'std446', '5yli0f', '', 'student', '', 0, 'yes', '2023-04-03 04:39:49', NULL),
(852, 447, 'std447', 'p8bjvl', '', 'student', '', 0, 'yes', '2023-04-23 09:25:40', NULL),
(853, 0, 'parent447', '61rmfy', '447', 'parent', '', 0, 'yes', '2023-04-23 09:25:40', NULL),
(854, 448, 'std448', '5bp8y6', '', 'student', '', 0, 'yes', '2023-04-25 06:07:32', NULL),
(855, 0, 'parent448', 'x6a0e7', '448', 'parent', '', 0, 'yes', '2023-04-25 06:07:32', NULL),
(856, 449, 'std449', 'ymuj8g', '', 'student', '', 0, 'yes', '2023-04-25 06:24:34', NULL),
(857, 0, 'parent449', 'sslkgn', '449', 'parent', '', 0, 'yes', '2023-04-25 06:24:34', NULL),
(858, 450, 'std450', 'cxkm5k', '', 'student', '', 0, 'yes', '2023-04-25 07:03:49', NULL),
(859, 0, 'parent450', '3wmbik', '450', 'parent', '', 0, 'yes', '2023-04-25 07:03:49', NULL),
(860, 451, 'std451', 'cngrmg', '', 'student', '', 0, 'yes', '2023-04-25 07:12:08', NULL),
(861, 0, 'parent451', '53tdpa', '451', 'parent', '', 0, 'yes', '2023-04-25 07:12:08', NULL),
(862, 452, 'std452', '4ak649', '', 'student', '', 0, 'yes', '2023-04-25 07:16:08', NULL),
(863, 0, 'parent452', 'xohebz', '452', 'parent', '', 0, 'yes', '2023-04-25 07:16:08', NULL),
(864, 453, 'std453', 'mznbhw', '', 'student', '', 0, 'yes', '2023-04-25 07:18:40', NULL),
(865, 0, 'parent453', 'qm3b4a', '453', 'parent', '', 0, 'yes', '2023-04-25 07:18:40', NULL),
(866, 454, 'std454', '23cu51', '', 'student', '', 0, 'yes', '2023-04-25 07:22:20', NULL),
(867, 0, 'parent454', '6bxg76', '454', 'parent', '', 0, 'yes', '2023-04-25 07:22:20', NULL),
(868, 455, 'std455', 'm8sl16', '', 'student', '', 0, 'yes', '2023-04-25 07:24:45', NULL),
(869, 0, 'parent455', 'gxiq0j', '455', 'parent', '', 0, 'yes', '2023-04-25 07:24:45', NULL),
(870, 456, 'std456', 'shue77', '', 'student', '', 0, 'yes', '2023-04-25 07:28:51', NULL),
(871, 0, 'parent456', 'mqq4ja', '456', 'parent', '', 0, 'yes', '2023-04-25 07:28:51', NULL),
(872, 457, 'std457', 'mb6xlo', '', 'student', '', 0, 'yes', '2023-04-25 07:31:31', NULL),
(873, 0, 'parent457', 'blz1qr', '457', 'parent', '', 0, 'yes', '2023-04-25 07:31:31', NULL),
(874, 458, 'std458', 'rz8iw7', '', 'student', '', 0, 'yes', '2023-04-25 08:36:55', NULL),
(875, 0, 'parent458', 'l747kc', '458', 'parent', '', 0, 'yes', '2023-04-25 08:36:55', NULL),
(876, 459, 'std459', 'rf69ul', '', 'student', '', 0, 'yes', '2023-04-25 08:38:52', NULL),
(877, 0, 'parent459', 'y98bzf', '459', 'parent', '', 0, 'yes', '2023-04-25 08:38:52', NULL),
(878, 460, 'std460', 'ygfw3k', '', 'student', '', 0, 'yes', '2023-04-25 08:43:35', NULL),
(879, 0, 'parent460', 'wegedi', '460', 'parent', '', 0, 'yes', '2023-04-25 08:43:35', NULL),
(880, 461, 'std461', '9bh0hi', '', 'student', '', 0, 'yes', '2023-04-25 08:46:00', NULL),
(881, 0, 'parent461', 'msgw33', '461', 'parent', '', 0, 'yes', '2023-04-25 08:46:00', NULL),
(882, 462, 'std462', 'v9jrus', '', 'student', '', 0, 'yes', '2023-04-25 08:49:25', NULL),
(883, 0, 'parent462', 'menykh', '462', 'parent', '', 0, 'yes', '2023-04-25 08:49:25', NULL),
(884, 463, 'std463', 'v41eyq', '', 'student', '', 0, 'yes', '2023-04-25 08:51:43', NULL),
(885, 0, 'parent463', 'ed0fmj', '463', 'parent', '', 0, 'yes', '2023-04-25 08:51:43', NULL),
(886, 464, 'std464', '902ckd', '', 'student', '', 0, 'yes', '2023-04-25 09:01:34', NULL),
(887, 0, 'parent464', 'z7tfs9', '464', 'parent', '', 0, 'yes', '2023-04-25 09:01:34', NULL),
(888, 465, 'std465', 'pf8x88', '', 'student', '', 0, 'yes', '2023-04-25 09:04:49', NULL),
(889, 0, 'parent465', 'kr20qm', '465', 'parent', '', 0, 'yes', '2023-04-25 09:04:49', NULL),
(890, 466, 'std466', 'oo56bd', '', 'student', '', 0, 'yes', '2023-04-25 11:55:20', NULL),
(891, 0, 'parent466', 'yrxoqf', '466', 'parent', '', 0, 'yes', '2023-04-25 11:55:20', NULL),
(892, 467, 'std467', '1egitd', '', 'student', '', 0, 'yes', '2023-04-25 12:19:22', NULL),
(893, 0, 'parent467', 'slnqzg', '467', 'parent', '', 0, 'yes', '2023-04-25 12:19:22', NULL),
(894, 468, 'std468', '5moosr', '', 'student', '', 0, 'yes', '2023-04-25 12:32:42', NULL),
(895, 0, 'parent468', '7nx71f', '468', 'parent', '', 0, 'yes', '2023-04-25 12:32:42', NULL),
(896, 469, 'std469', 'd8nbzl', '', 'student', '', 0, 'yes', '2023-05-31 04:59:43', NULL),
(897, 0, 'parent469', '2su3wj', '469', 'parent', '', 0, 'yes', '2023-05-31 04:59:43', NULL),
(898, 470, 'std470', 'l0vfiv', '', 'student', '', 0, 'yes', '2023-07-25 07:02:05', NULL),
(899, 0, 'parent470', 'f422pq', '470', 'parent', '', 0, 'yes', '2023-07-25 07:02:05', NULL),
(900, 471, 'std471', 'sfcq9v', '', 'student', '', 0, 'yes', '2024-04-10 03:24:28', NULL),
(901, 0, 'parent471', '1hmwi4', '471', 'parent', '', 0, 'yes', '2024-04-10 03:24:28', NULL),
(906, 474, 'std474', 'zu42pz', '', 'student', '', 0, 'yes', '2025-04-25 19:22:32', NULL),
(907, 0, 'parent474', 'q6s66r', '474', 'parent', '', 0, 'yes', '2025-04-25 19:22:32', NULL),
(908, 475, 'std475', '3w2s8z', '', 'student', '', 0, 'yes', '2025-04-26 02:16:20', NULL),
(909, 0, 'parent475', '93agqe', '475', 'parent', '', 0, 'yes', '2025-04-26 02:16:20', NULL),
(914, 478, 'std478', 'kepssw', '', 'student', '', 0, 'yes', '2025-04-27 14:54:58', NULL),
(915, 0, 'parent478', '95y1hh', '478', 'parent', '', 0, 'yes', '2025-04-27 14:54:58', NULL),
(916, 479, 'std479', 'a0cm6p', '', 'student', '', 0, 'yes', '2025-04-28 02:42:10', NULL),
(917, 0, 'parent479', 'jrni1b', '479', 'parent', '', 0, 'yes', '2025-04-28 02:42:10', NULL),
(918, 480, 'std480', '193r6a', '', 'student', '', 0, 'yes', '2025-04-28 05:22:05', NULL),
(919, 0, 'parent480', 'fujtxi', '480', 'parent', '', 0, 'yes', '2025-04-28 05:22:05', NULL),
(920, 481, 'std481', 'yhddz5', '', 'student', '', 0, 'yes', '2025-04-29 02:55:45', NULL),
(921, 0, 'parent481', 'imwnim', '481', 'parent', '', 0, 'yes', '2025-04-29 02:55:45', NULL),
(922, 482, 'std482', '8r2b1i', '', 'student', '', 0, 'yes', '2025-04-29 03:42:03', NULL),
(923, 0, 'parent482', 't8g008', '482', 'parent', '', 0, 'yes', '2025-04-29 03:42:03', NULL),
(924, 483, 'std483', 'fuwd4u', '', 'student', '', 0, 'yes', '2025-04-29 10:22:05', NULL),
(925, 0, 'parent483', 'wtsnqg', '483', 'parent', '', 0, 'yes', '2025-04-29 10:22:05', NULL),
(926, 484, 'std484', 'cpqqrg', '', 'student', '', 0, 'yes', '2025-05-02 04:19:51', NULL),
(927, 0, 'parent484', 'pmkh7m', '484', 'parent', '', 0, 'yes', '2025-05-02 04:19:51', NULL),
(928, 485, 'std485', 'eq7rxb', '', 'student', '', 0, 'yes', '2025-05-03 09:15:28', NULL),
(929, 0, 'parent485', '2e95n5', '485', 'parent', '', 0, 'yes', '2025-05-03 09:15:28', NULL),
(930, 486, 'std486', 'ifpp4g', '', 'student', '', 0, 'yes', '2025-05-03 14:01:08', NULL),
(931, 0, 'parent486', 'nnzpk8', '486', 'parent', '', 0, 'yes', '2025-05-03 14:01:08', NULL),
(932, 487, 'std487', 'wtilti', '', 'student', '', 0, 'yes', '2025-05-03 14:04:31', NULL),
(933, 0, 'parent487', '2h3zxz', '487', 'parent', '', 0, 'yes', '2025-05-03 14:04:31', NULL),
(934, 488, 'std488', '8oqs2m', '', 'student', '', 0, 'yes', '2025-05-03 16:54:00', NULL),
(935, 0, 'parent488', 'f32edj', '488', 'parent', '', 0, 'yes', '2025-05-03 16:54:00', NULL),
(936, 489, 'std489', 'jvdnvl', '', 'student', '', 0, 'yes', '2025-05-03 17:12:54', NULL),
(937, 0, 'parent489', 'mnxu5s', '489', 'parent', '', 0, 'yes', '2025-05-03 17:12:54', NULL),
(938, 490, 'std490', '8abqcd', '', 'student', '', 0, 'yes', '2025-05-19 05:11:06', NULL),
(939, 0, 'parent490', '2premc', '490', 'parent', '', 0, 'yes', '2025-05-19 05:11:06', NULL),
(940, 491, 'std491', 's2znrc', '', 'student', '', 0, 'yes', '2025-05-19 16:30:06', NULL),
(941, 0, 'parent491', 'nz5zkj', '491', 'parent', '', 0, 'yes', '2025-05-19 16:30:06', NULL),
(942, 492, 'std492', 'r6uz6l', '', 'student', '', 0, 'yes', '2025-05-19 17:29:40', NULL),
(943, 0, 'parent492', 'fu1aw0', '492', 'parent', '', 0, 'yes', '2025-05-19 17:29:40', NULL),
(944, 493, 'std493', 'qaw210', '', 'student', '', 0, 'yes', '2025-06-01 07:57:02', NULL),
(945, 0, 'parent493', 'mzther', '493', 'parent', '', 0, 'yes', '2025-06-01 07:57:02', NULL),
(946, 494, 'std494', '7zeuxj', '', 'student', '', 0, 'yes', '2025-06-03 09:11:14', NULL),
(947, 0, 'parent494', 'zd6xwf', '494', 'parent', '', 0, 'yes', '2025-06-03 09:11:14', NULL),
(948, 495, 'std495', '2yjsw8', '', 'student', '', 0, 'yes', '2025-06-04 04:41:11', NULL),
(949, 0, 'parent495', 'tqy9lx', '495', 'parent', '', 0, 'yes', '2025-06-04 04:41:11', NULL),
(950, 496, 'std496', 'tlqmm1', '', 'student', '', 0, 'yes', '2025-06-04 04:42:41', NULL),
(951, 0, 'parent496', 'wja3h7', '496', 'parent', '', 0, 'yes', '2025-06-04 04:42:41', NULL),
(952, 497, 'std497', '60h4xi', '', 'student', '', 0, 'yes', '2025-06-04 04:43:56', NULL),
(953, 0, 'parent497', 'h6d13c', '497', 'parent', '', 0, 'yes', '2025-06-04 04:43:56', NULL),
(954, 498, 'std498', '71oxl6', '', 'student', '', 0, 'yes', '2025-06-04 04:44:59', NULL),
(955, 0, 'parent498', '4xzed0', '498', 'parent', '', 0, 'yes', '2025-06-04 04:44:59', NULL),
(956, 499, 'std499', 'fckw8d', '', 'student', '', 0, 'yes', '2025-06-04 04:46:10', NULL),
(957, 0, 'parent499', 'xo9aow', '499', 'parent', '', 0, 'yes', '2025-06-04 04:46:10', NULL),
(958, 500, 'std500', '6f28rk', '', 'student', '', 0, 'yes', '2025-06-04 04:47:55', NULL),
(959, 0, 'parent500', '3tk0qj', '500', 'parent', '', 0, 'yes', '2025-06-04 04:47:55', NULL),
(960, 501, 'std501', 'ebxugf', '', 'student', '', 0, 'yes', '2025-06-04 04:49:43', NULL),
(961, 0, 'parent501', '95jggh', '501', 'parent', '', 0, 'yes', '2025-06-04 04:49:43', NULL),
(962, 502, 'std502', 'w19fqr', '', 'student', '', 0, 'yes', '2025-06-21 06:58:30', NULL),
(963, 502, 'parent502', 'i2zttr', '502', 'parent', '', 0, 'yes', '2025-06-21 06:58:30', NULL),
(964, 503, 'std503', '7k3gdm', '', 'student', '', 0, 'yes', '2025-11-07 05:52:27', NULL),
(965, 0, 'parent503', 'bzt3w8', '503', 'parent', '', 0, 'yes', '2025-11-07 05:52:27', NULL),
(968, 505, 'std505', 'ohlqjd', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(969, 505, 'parent505', 'pgtmlz', '505', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(970, 506, 'std506', 'luiwvh', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(971, 506, 'parent506', 'trmugy', '506', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(972, 507, 'std507', 'w9qfoy', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(973, 507, 'parent507', 'c2vv09', '507', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(974, 508, 'std508', '6p84fw', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(975, 508, 'parent508', 'dyj3h5', '508', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(976, 509, 'std509', '7l6acy', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(977, 509, 'parent509', 'uv2n2n', '509', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(978, 510, 'std510', 'c0v4u3', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(979, 510, 'parent510', 'lbcp43', '510', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(980, 511, 'std511', 'i9kimw', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(981, 511, 'parent511', 'hslamh', '511', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(982, 512, 'std512', 'm6nuf3', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(983, 512, 'parent512', 'rdtq8u', '512', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(984, 513, 'std513', 'fb3og7', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(985, 513, 'parent513', 'sa69fk', '513', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(986, 514, 'std514', 't9siou', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(987, 514, 'parent514', 'thyvb1', '514', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(988, 515, 'std515', '07ohj9', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(989, 515, 'parent515', 'fmhyuf', '515', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(990, 516, 'std516', 'llalpw', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(991, 516, 'parent516', '3htzfm', '516', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(992, 517, 'std517', 'fte0ei', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(993, 517, 'parent517', 't8wrub', '517', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(994, 518, 'std518', 'clcbu4', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(995, 518, 'parent518', '0lc6hm', '518', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(996, 519, 'std519', '1gn8c0', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(997, 519, 'parent519', '0h1fmy', '519', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(998, 520, 'std520', 'jfbg13', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(999, 520, 'parent520', 'pdxri4', '520', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(1000, 521, 'std521', 'kdb48s', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(1001, 521, 'parent521', 'wdg42o', '521', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(1002, 522, 'std522', 'm2zrfy', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL);
INSERT INTO `users` (`id`, `user_id`, `username`, `password`, `childs`, `role`, `verification_code`, `lang_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1003, 522, 'parent522', '77o9g1', '522', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(1004, 523, 'std523', '7e4e5u', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(1005, 523, 'parent523', 'ui9ok8', '523', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(1006, 524, 'std524', 'u9co5j', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(1007, 524, 'parent524', '7iqxix', '524', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(1008, 525, 'std525', 'zxm10p', '', 'student', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(1009, 525, 'parent525', 'se233w', '525', 'parent', '', 0, 'yes', '2025-11-08 03:36:14', NULL),
(1010, 526, 'std526', 'adjyi4', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1011, 526, 'parent526', 'xsu3ju', '526', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1012, 527, 'std527', 'ctrdjb', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1013, 527, 'parent527', 'myj9hb', '527', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1014, 528, 'std528', 'n1rhwl', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1015, 528, 'parent528', 'mpx9tw', '528', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1016, 529, 'std529', 'xlnhw2', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1017, 529, 'parent529', '6gvbjo', '529', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1018, 530, 'std530', 'h366ii', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1019, 530, 'parent530', 'fqndod', '530', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1020, 531, 'std531', 'u9judx', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1021, 531, 'parent531', 'ssfz0p', '531', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1022, 532, 'std532', 'jc5bhp', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1023, 532, 'parent532', 'esytal', '532', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1024, 533, 'std533', '477l9t', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1025, 533, 'parent533', 'f4dngx', '533', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1026, 534, 'std534', '4c18q4', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1027, 534, 'parent534', 'c2bzes', '534', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1028, 535, 'std535', 'b4eyco', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1029, 535, 'parent535', '7sgtau', '535', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1030, 536, 'std536', '9rmvqr', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1031, 536, 'parent536', 'o3l3es', '536', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1032, 537, 'std537', 'ee1etb', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1033, 537, 'parent537', '3f6vcz', '537', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1034, 538, 'std538', 'jr97ul', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1035, 538, 'parent538', 'pwsvi3', '538', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1036, 539, 'std539', 'lnbiha', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1037, 539, 'parent539', 'qok1bh', '539', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1038, 540, 'std540', 'z3gg2l', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1039, 540, 'parent540', 'q3axtp', '540', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1040, 541, 'std541', 'o8xq9v', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1041, 541, 'parent541', 'u39m7r', '541', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1042, 542, 'std542', 'o6ecc0', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1043, 542, 'parent542', 'vs6c10', '542', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1044, 543, 'std543', 'xyitre', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1045, 543, 'parent543', '10ojcb', '543', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1046, 544, 'std544', 'vyjjmh', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1047, 544, 'parent544', 'fox2wm', '544', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1048, 545, 'std545', '8bi5sw', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1049, 545, 'parent545', 'jkby3s', '545', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1050, 546, 'std546', '28ehux', '', 'student', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1051, 546, 'parent546', 'v7t485', '546', 'parent', '', 0, 'yes', '2025-11-08 03:46:01', NULL),
(1052, 547, 'std547', 'jf6mdr', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1053, 547, 'parent547', 'fmru04', '547', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1054, 548, 'std548', '8e4n26', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1055, 548, 'parent548', 'vxulwv', '548', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1056, 549, 'std549', 'gdrtiv', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1057, 549, 'parent549', '0dfsca', '549', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1058, 550, 'std550', 'e3dfss', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1059, 550, 'parent550', 'dv94zg', '550', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1060, 551, 'std551', 'tbc916', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1061, 551, 'parent551', 'fsbozj', '551', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1062, 552, 'std552', 'go8b4h', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1063, 552, 'parent552', 'bgtm7j', '552', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1064, 553, 'std553', 'mjg0c7', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1065, 553, 'parent553', 'zocb8d', '553', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1066, 554, 'std554', 'nf148o', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1067, 554, 'parent554', 'cbqssv', '554', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1068, 555, 'std555', 'umb9mj', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1069, 555, 'parent555', '7nc9jm', '555', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1070, 556, 'std556', 'x46fk9', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1071, 556, 'parent556', '799lca', '556', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1072, 557, 'std557', 'azq3u2', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1073, 557, 'parent557', 'ud9n7d', '557', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1074, 558, 'std558', '3vdhd8', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1075, 558, 'parent558', 'emtye2', '558', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1076, 559, 'std559', 'vvpvy7', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1077, 559, 'parent559', 'ylotah', '559', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1078, 560, 'std560', 'uzvt89', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1079, 560, 'parent560', 'p1ltxr', '560', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1080, 561, 'std561', 't5sgyo', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1081, 561, 'parent561', '0kbkql', '561', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1082, 562, 'std562', 'ccmwu4', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1083, 562, 'parent562', 'xlg2z0', '562', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1084, 563, 'std563', 'clcnxs', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1085, 563, 'parent563', 'c50y5f', '563', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1086, 564, 'std564', 'nmt0a8', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1087, 564, 'parent564', 'top6cv', '564', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1088, 565, 'std565', '6lcvd6', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1089, 565, 'parent565', '70hvo4', '565', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1090, 566, 'std566', 'bp74wv', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1091, 566, 'parent566', 'goz94y', '566', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1092, 567, 'std567', 'y4xmks', '', 'student', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1093, 567, 'parent567', 'd5zzd1', '567', 'parent', '', 0, 'yes', '2025-11-08 03:49:25', NULL),
(1094, 568, 'std568', 'kc2i9c', '', 'student', '', 0, 'yes', '2025-11-08 03:54:00', NULL),
(1095, 0, 'parent568', '5u5kqs', '568', 'parent', '', 0, 'yes', '2025-11-08 03:54:00', NULL),
(1096, 569, 'std569', 'shhacv', '', 'student', '', 0, 'yes', '2025-11-08 04:28:06', NULL),
(1097, 0, 'parent569', 'nqyquo', '569', 'parent', '', 0, 'yes', '2025-11-08 04:28:06', NULL),
(1098, 570, 'std570', 'ubf68o', '', 'student', '', 0, 'yes', '2025-11-08 04:32:13', NULL),
(1099, 0, 'parent570', 'mno7m0', '570', 'parent', '', 0, 'yes', '2025-11-08 04:32:13', NULL),
(1100, 571, 'std571', '5cmgr7', '', 'student', '', 0, 'yes', '2025-11-08 04:39:11', NULL),
(1101, 0, 'parent571', 'lyvyx2', '571', 'parent', '', 0, 'yes', '2025-11-08 04:39:11', NULL),
(1102, 572, 'std572', 'v3lxzp', '', 'student', '', 0, 'yes', '2025-11-08 04:45:29', NULL),
(1103, 0, 'parent572', 'u25mzk', '572', 'parent', '', 0, 'yes', '2025-11-08 04:45:29', NULL),
(1104, 573, 'std573', 'p1dfbw', '', 'student', '', 0, 'yes', '2025-11-08 04:47:32', NULL),
(1105, 0, 'parent573', 'vvevch', '573', 'parent', '', 0, 'yes', '2025-11-08 04:47:32', NULL),
(1106, 574, 'std574', 'sewczs', '', 'student', '', 0, 'yes', '2025-11-08 04:50:45', NULL),
(1107, 0, 'parent574', '7qwrzt', '574', 'parent', '', 0, 'yes', '2025-11-08 04:50:45', NULL),
(1108, 575, 'std575', '7csndx', '', 'student', '', 0, 'yes', '2025-11-08 04:52:32', NULL),
(1109, 0, 'parent575', 'vfeto9', '575', 'parent', '', 0, 'yes', '2025-11-08 04:52:32', NULL),
(1110, 576, 'std576', 'th2vl4', '', 'student', '', 0, 'yes', '2025-11-08 04:56:58', NULL),
(1111, 0, 'parent576', 'gnrsrw', '576', 'parent', '', 0, 'yes', '2025-11-08 04:56:58', NULL),
(1112, 577, 'std577', 'mrzrhf', '', 'student', '', 0, 'yes', '2025-11-08 04:58:44', NULL),
(1113, 0, 'parent577', '2p7937', '577', 'parent', '', 0, 'yes', '2025-11-08 04:58:44', NULL),
(1114, 578, 'std578', 'r769h1', '', 'student', '', 0, 'yes', '2025-11-08 05:02:59', NULL),
(1115, 0, 'parent578', '5p1lpv', '578', 'parent', '', 0, 'yes', '2025-11-08 05:02:59', NULL),
(1116, 579, 'std579', '9cfez7', '', 'student', '', 0, 'yes', '2025-11-08 05:08:58', NULL),
(1117, 0, 'parent579', 'zy2q7u', '579', 'parent', '', 0, 'yes', '2025-11-08 05:08:58', NULL),
(1118, 580, 'std580', '8khjla', '', 'student', '', 0, 'yes', '2025-11-08 05:11:09', NULL),
(1119, 0, 'parent580', 'n07tf4', '580', 'parent', '', 0, 'yes', '2025-11-08 05:11:09', NULL),
(1120, 581, 'std581', '2z70o4', '', 'student', '', 0, 'yes', '2025-11-08 05:13:18', NULL),
(1121, 0, 'parent581', 'mct912', '581', 'parent', '', 0, 'yes', '2025-11-08 05:13:18', NULL),
(1122, 582, 'std582', 'qfga08', '', 'student', '', 0, 'yes', '2025-11-08 05:16:45', NULL),
(1123, 0, 'parent582', 'apz11d', '582', 'parent', '', 0, 'yes', '2025-11-08 05:16:45', NULL),
(1124, 583, 'std583', '7isri2', '', 'student', '', 0, 'yes', '2025-11-08 05:18:09', NULL),
(1125, 0, 'parent583', '88ntzo', '583', 'parent', '', 0, 'yes', '2025-11-08 05:18:09', NULL),
(1126, 584, 'std584', 'fd3cxb', '', 'student', '', 0, 'yes', '2025-11-08 05:19:55', NULL),
(1127, 0, 'parent584', 'moac05', '584', 'parent', '', 0, 'yes', '2025-11-08 05:19:55', NULL),
(1128, 585, 'std585', 'bq29wb', '', 'student', '', 0, 'yes', '2025-11-08 05:21:41', NULL),
(1129, 0, 'parent585', '6xe3ug', '585', 'parent', '', 0, 'yes', '2025-11-08 05:21:41', NULL),
(1130, 586, 'std586', 'pdul0p', '', 'student', '', 0, 'yes', '2025-11-08 05:23:14', NULL),
(1131, 0, 'parent586', 'joijkg', '586', 'parent', '', 0, 'yes', '2025-11-08 05:23:14', NULL),
(1132, 587, 'std587', 'pprosx', '', 'student', '', 0, 'yes', '2025-11-08 05:25:15', NULL),
(1133, 0, 'parent587', 'j22bah', '587', 'parent', '', 0, 'yes', '2025-11-08 05:25:15', NULL),
(1134, 588, 'std588', 'ub05bz', '', 'student', '', 0, 'yes', '2025-11-08 05:29:06', NULL),
(1135, 0, 'parent588', '3cccew', '588', 'parent', '', 0, 'yes', '2025-11-08 05:29:06', NULL),
(1136, 589, 'std589', 's5xf4j', '', 'student', '', 0, 'yes', '2025-11-08 05:31:32', NULL),
(1137, 0, 'parent589', 'ckfvng', '589', 'parent', '', 0, 'yes', '2025-11-08 05:31:32', NULL),
(1138, 590, 'std590', 'a3wta3', '', 'student', '', 0, 'yes', '2025-11-08 05:33:19', NULL),
(1139, 0, 'parent590', 'pe23ex', '590', 'parent', '', 0, 'yes', '2025-11-08 05:33:19', NULL),
(1140, 591, 'std591', 'w8mbdv', '', 'student', '', 0, 'yes', '2025-11-08 05:35:38', NULL),
(1141, 0, 'parent591', 'zwfd99', '591', 'parent', '', 0, 'yes', '2025-11-08 05:35:38', NULL),
(1142, 592, 'std592', '3xxs05', '', 'student', '', 0, 'yes', '2025-11-08 05:39:08', NULL),
(1143, 0, 'parent592', 'afddlw', '592', 'parent', '', 0, 'yes', '2025-11-08 05:39:08', NULL),
(1144, 593, 'std593', 'v8rgj0', '', 'student', '', 0, 'yes', '2025-11-08 05:42:04', NULL),
(1145, 0, 'parent593', '1xq81s', '593', 'parent', '', 0, 'yes', '2025-11-08 05:42:04', NULL),
(1146, 594, 'std594', 'hciyw2', '', 'student', '', 0, 'yes', '2025-11-08 05:44:49', NULL),
(1147, 0, 'parent594', 'n8rnnt', '594', 'parent', '', 0, 'yes', '2025-11-08 05:44:49', NULL),
(1148, 595, 'std595', '17mu4a', '', 'student', '', 0, 'yes', '2025-11-08 05:46:23', NULL),
(1149, 0, 'parent595', 'xzvdw1', '595', 'parent', '', 0, 'yes', '2025-11-08 05:46:23', NULL),
(1150, 596, 'std596', 'p2uheo', '', 'student', '', 0, 'yes', '2025-11-08 05:48:20', NULL),
(1151, 0, 'parent596', 'orjeyf', '596', 'parent', '', 0, 'yes', '2025-11-08 05:48:20', NULL),
(1152, 597, 'std597', 'vrfzgb', '', 'student', '', 0, 'yes', '2025-11-08 05:53:45', NULL),
(1153, 0, 'parent597', 'jtgn7d', '597', 'parent', '', 0, 'yes', '2025-11-08 05:53:45', NULL),
(1154, 598, 'std598', '3oniux', '', 'student', '', 0, 'yes', '2025-11-08 05:55:29', NULL),
(1155, 0, 'parent598', 'vtwswd', '598', 'parent', '', 0, 'yes', '2025-11-08 05:55:29', NULL),
(1156, 599, 'std599', 'qp2o50', '', 'student', '', 0, 'yes', '2025-11-08 05:57:53', NULL),
(1157, 0, 'parent599', 'da8wdc', '599', 'parent', '', 0, 'yes', '2025-11-08 05:57:53', NULL),
(1158, 600, 'std600', 'ci3hwd', '', 'student', '', 0, 'yes', '2025-11-08 06:05:19', NULL),
(1159, 0, 'parent600', 'u3d81y', '600', 'parent', '', 0, 'yes', '2025-11-08 06:05:19', NULL),
(1160, 601, 'std601', '9ketnu', '', 'student', '', 0, 'yes', '2025-11-08 06:06:50', NULL),
(1161, 0, 'parent601', 'gbz5st', '601', 'parent', '', 0, 'yes', '2025-11-08 06:06:50', NULL),
(1162, 602, 'std602', '0smzsq', '', 'student', '', 0, 'yes', '2025-11-08 06:08:36', NULL),
(1163, 0, 'parent602', '7b6vd0', '602', 'parent', '', 0, 'yes', '2025-11-08 06:08:36', NULL),
(1164, 603, 'std603', '8hvqm9', '', 'student', '', 0, 'yes', '2025-11-08 06:10:25', NULL),
(1165, 0, 'parent603', 'c3k13x', '603', 'parent', '', 0, 'yes', '2025-11-08 06:10:25', NULL),
(1166, 604, 'std604', 'io2xlo', '', 'student', '', 0, 'yes', '2025-11-08 06:16:13', NULL),
(1167, 0, 'parent604', 'q2vraf', '604', 'parent', '', 0, 'yes', '2025-11-08 06:16:13', NULL),
(1168, 605, 'std605', 'cy62qw', '', 'student', '', 0, 'yes', '2025-11-08 06:18:47', NULL),
(1169, 0, 'parent605', '87ktbv', '605', 'parent', '', 0, 'yes', '2025-11-08 06:18:47', NULL),
(1170, 606, 'std606', '21414n', '', 'student', '', 0, 'yes', '2025-11-08 06:25:11', NULL),
(1171, 0, 'parent606', 'dxzq0v', '606', 'parent', '', 0, 'yes', '2025-11-08 06:25:11', NULL),
(1172, 607, 'std607', '2g0tue', '', 'student', '', 0, 'yes', '2025-11-08 06:27:02', NULL),
(1173, 0, 'parent607', '63rrl4', '607', 'parent', '', 0, 'yes', '2025-11-08 06:27:02', NULL),
(1174, 608, 'std608', '15j4r6', '', 'student', '', 0, 'yes', '2025-11-08 06:31:14', NULL),
(1175, 0, 'parent608', 'g4o8vx', '608', 'parent', '', 0, 'yes', '2025-11-08 06:31:14', NULL),
(1176, 609, 'std609', '3qf52p', '', 'student', '', 0, 'yes', '2025-11-08 06:33:48', NULL),
(1177, 0, 'parent609', 'ktd5am', '609', 'parent', '', 0, 'yes', '2025-11-08 06:33:48', NULL),
(1178, 610, 'std610', 'mebc5y', '', 'student', '', 0, 'yes', '2025-11-08 06:38:20', NULL),
(1179, 0, 'parent610', 'g3qcdy', '610', 'parent', '', 0, 'yes', '2025-11-08 06:38:20', NULL),
(1180, 611, 'std611', 'pdlpnu', '', 'student', '', 0, 'yes', '2025-11-08 06:39:57', NULL),
(1181, 0, 'parent611', '0utvqq', '611', 'parent', '', 0, 'yes', '2025-11-08 06:39:57', NULL),
(1182, 612, 'std612', '9p22wi', '', 'student', '', 0, 'yes', '2025-11-08 06:42:29', NULL),
(1183, 0, 'parent612', 'tlc53g', '612', 'parent', '', 0, 'yes', '2025-11-08 06:42:29', NULL),
(1184, 613, 'std613', '3n9zuz', '', 'student', '', 0, 'yes', '2025-11-08 06:43:57', NULL),
(1185, 0, 'parent613', 'ebcf3x', '613', 'parent', '', 0, 'yes', '2025-11-08 06:43:57', NULL),
(1186, 614, 'std614', '6tnqi4', '', 'student', '', 0, 'yes', '2025-11-08 06:45:55', NULL),
(1187, 0, 'parent614', 'jdc46p', '614', 'parent', '', 0, 'yes', '2025-11-08 06:45:55', NULL),
(1188, 615, 'std615', 'cu7f8b', '', 'student', '', 0, 'yes', '2025-11-08 06:50:22', NULL),
(1189, 0, 'parent615', 'ozzawi', '615', 'parent', '', 0, 'yes', '2025-11-08 06:50:22', NULL),
(1190, 616, 'std616', 'tegyb6', '', 'student', '', 0, 'yes', '2025-11-08 06:52:07', NULL),
(1191, 0, 'parent616', 'ack3mh', '616', 'parent', '', 0, 'yes', '2025-11-08 06:52:07', NULL),
(1192, 617, 'std617', 'm7flqi', '', 'student', '', 0, 'yes', '2025-11-08 06:53:49', NULL),
(1193, 0, 'parent617', 'mobhic', '617', 'parent', '', 0, 'yes', '2025-11-08 06:53:49', NULL),
(1194, 618, 'std618', '6vchux', '', 'student', '', 0, 'yes', '2025-11-08 06:55:55', NULL),
(1195, 0, 'parent618', 'jg6f2k', '618', 'parent', '', 0, 'yes', '2025-11-08 06:55:55', NULL),
(1196, 619, 'std619', 'wk3gf9', '', 'student', '', 0, 'yes', '2025-11-08 06:58:00', NULL),
(1197, 0, 'parent619', 'csky5p', '619', 'parent', '', 0, 'yes', '2025-11-08 06:58:00', NULL),
(1198, 620, 'std620', '0894hm', '', 'student', '', 0, 'yes', '2025-11-08 07:07:41', NULL),
(1199, 0, 'parent620', 'bb3g9l', '620', 'parent', '', 0, 'yes', '2025-11-08 07:07:41', NULL),
(1200, 621, 'std621', 'qnqlns', '', 'student', '', 0, 'yes', '2025-11-08 07:15:21', NULL),
(1201, 0, 'parent621', 'lbwkp8', '621', 'parent', '', 0, 'yes', '2025-11-08 07:15:21', NULL),
(1202, 622, 'std622', 'w2qiqt', '', 'student', '', 0, 'yes', '2025-11-08 07:19:08', NULL),
(1203, 0, 'parent622', 'b6qyai', '622', 'parent', '', 0, 'yes', '2025-11-08 07:19:08', NULL),
(1204, 623, 'std623', 'xw227o', '', 'student', '', 0, 'yes', '2025-11-08 07:24:24', NULL),
(1205, 0, 'parent623', 'wxomcg', '623', 'parent', '', 0, 'yes', '2025-11-08 07:24:24', NULL),
(1206, 624, 'std624', 'degtmz', '', 'student', '', 0, 'yes', '2025-11-08 07:26:45', NULL),
(1207, 0, 'parent624', 'dxgvt1', '624', 'parent', '', 0, 'yes', '2025-11-08 07:26:45', NULL),
(1208, 625, 'std625', '8mxjri', '', 'student', '', 0, 'yes', '2025-11-08 07:29:05', NULL),
(1209, 0, 'parent625', '55ywl7', '625', 'parent', '', 0, 'yes', '2025-11-08 07:29:05', NULL),
(1210, 626, 'std626', 'bk9xhp', '', 'student', '', 0, 'yes', '2025-11-08 07:30:43', NULL),
(1211, 0, 'parent626', '3x6zvu', '626', 'parent', '', 0, 'yes', '2025-11-08 07:30:43', NULL),
(1212, 627, 'std627', 'bzwo1h', '', 'student', '', 0, 'yes', '2025-11-08 07:32:52', NULL),
(1213, 0, 'parent627', 'dunnw0', '627', 'parent', '', 0, 'yes', '2025-11-08 07:32:52', NULL),
(1214, 628, 'std628', 'uhzhtt', '', 'student', '', 0, 'yes', '2025-11-08 07:34:51', NULL),
(1215, 0, 'parent628', 'nkyfkw', '628', 'parent', '', 0, 'yes', '2025-11-08 07:34:51', NULL),
(1216, 629, 'std629', 'kdrn6b', '', 'student', '', 0, 'yes', '2025-11-08 07:39:41', NULL),
(1217, 0, 'parent629', '00cil4', '629', 'parent', '', 0, 'yes', '2025-11-08 07:39:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_authentication`
--

CREATE TABLE `users_authentication` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_no` varchar(20) DEFAULT NULL,
  `vehicle_model` varchar(100) NOT NULL DEFAULT 'None',
  `manufacture_year` varchar(4) DEFAULT NULL,
  `driver_name` varchar(50) DEFAULT NULL,
  `driver_licence` varchar(50) NOT NULL DEFAULT 'None',
  `driver_contact` varchar(20) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_routes`
--

CREATE TABLE `vehicle_routes` (
  `id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `vehicle_routes`
--

INSERT INTO `vehicle_routes` (`id`, `route_id`, `vehicle_id`, `created_at`) VALUES
(1, 1, 1, '2022-09-20 05:37:53'),
(2, 2, 1, '2022-09-20 05:38:03'),
(3, 6, 1, '2022-09-20 05:38:10'),
(4, 8, 1, '2022-09-20 05:40:38'),
(5, 3, 2, '2022-09-20 05:40:47'),
(6, 4, 2, '2022-09-20 05:40:55'),
(7, 5, 2, '2022-09-20 05:41:00'),
(8, 7, 2, '2022-09-20 05:41:05'),
(9, 9, 2, '2022-11-07 04:59:38'),
(12, 10, 4, '2025-06-21 06:13:54'),
(14, 15, 5, '2025-11-07 10:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `visitors_book`
--

CREATE TABLE `visitors_book` (
  `id` int(11) NOT NULL,
  `source` varchar(100) DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(12) NOT NULL,
  `id_proof` varchar(50) NOT NULL,
  `no_of_pepple` int(11) NOT NULL,
  `date` date NOT NULL,
  `in_time` varchar(20) NOT NULL,
  `out_time` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors_purpose`
--

CREATE TABLE `visitors_purpose` (
  `id` int(11) NOT NULL,
  `visitors_purpose` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alumni_events`
--
ALTER TABLE `alumni_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alumni_students`
--
ALTER TABLE `alumni_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `attendence_type`
--
ALTER TABLE `attendence_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_connections`
--
ALTER TABLE `chat_connections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_user_one` (`chat_user_one`),
  ADD KEY `chat_user_two` (`chat_user_two`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_user_id` (`chat_user_id`),
  ADD KEY `chat_connection_id` (`chat_connection_id`);

--
-- Indexes for table `chat_users`
--
ALTER TABLE `chat_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `create_staff_id` (`create_staff_id`),
  ADD KEY `create_student_id` (`create_student_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_sections`
--
ALTER TABLE `class_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint_type`
--
ALTER TABLE `complaint_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_for`
--
ALTER TABLE `content_for`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `coscholasticareas`
--
ALTER TABLE `coscholasticareas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_field_id` (`custom_field_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disable_reason`
--
ALTER TABLE `disable_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatch_receive`
--
ALTER TABLE `dispatch_receive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_type`
--
ALTER TABLE `enquiry_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_groups`
--
ALTER TABLE `exam_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_group_class_batch_exams`
--
ALTER TABLE `exam_group_class_batch_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_id` (`exam_group_d`);

--
-- Indexes for table `exam_group_class_batch_exam_students`
--
ALTER TABLE `exam_group_class_batch_exam_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_class_batch_exam_id` (`exam_group_class_batch_exam_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `student_session_id` (`student_session_id`);

--
-- Indexes for table `exam_group_class_batch_exam_subjects`
--
ALTER TABLE `exam_group_class_batch_exam_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_class_batch_exams_id` (`exam_group_class_batch_exams_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `exam_group_exam_connections`
--
ALTER TABLE `exam_group_exam_connections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_id` (`exam_group_id`),
  ADD KEY `exam_group_class_batch_exams_id` (`exam_group_class_batch_exams_id`);

--
-- Indexes for table `exam_group_exam_results`
--
ALTER TABLE `exam_group_exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_class_batch_exam_subject_id` (`exam_group_class_batch_exam_subject_id`),
  ADD KEY `exam_group_student_id` (`exam_group_student_id`),
  ADD KEY `exam_group_class_batch_exam_student_id` (`exam_group_class_batch_exam_student_id`);

--
-- Indexes for table `exam_group_students`
--
ALTER TABLE `exam_group_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_group_id` (`exam_group_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_schedule_id` (`exam_schedule_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_subject_id` (`teacher_subject_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_head`
--
ALTER TABLE `expense_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feecategory`
--
ALTER TABLE `feecategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feemasters`
--
ALTER TABLE `feemasters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_discounts`
--
ALTER TABLE `fees_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `fees_plan`
--
ALTER TABLE `fees_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_reminder`
--
ALTER TABLE `fees_reminder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feetype`
--
ALTER TABLE `feetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_discounts`
--
ALTER TABLE `fee_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_groups`
--
ALTER TABLE `fee_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_groups_feetype`
--
ALTER TABLE `fee_groups_feetype`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_session_group_id` (`fee_session_group_id`),
  ADD KEY `fee_groups_id` (`fee_groups_id`),
  ADD KEY `feetype_id` (`feetype_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `fee_head`
--
ALTER TABLE `fee_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_receipt_no`
--
ALTER TABLE `fee_receipt_no`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_session_groups`
--
ALTER TABLE `fee_session_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_groups_id` (`fee_groups_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `filetypes`
--
ALTER TABLE `filetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_up`
--
ALTER TABLE `follow_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_media_gallery`
--
ALTER TABLE `front_cms_media_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_menus`
--
ALTER TABLE `front_cms_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_menu_items`
--
ALTER TABLE `front_cms_menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_pages`
--
ALTER TABLE `front_cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_page_contents`
--
ALTER TABLE `front_cms_page_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `front_cms_programs`
--
ALTER TABLE `front_cms_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_program_photos`
--
ALTER TABLE `front_cms_program_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `front_cms_settings`
--
ALTER TABLE `front_cms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_calls`
--
ALTER TABLE `general_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_group_subject_id` (`subject_group_subject_id`);

--
-- Indexes for table `homework_evaluation`
--
ALTER TABLE `homework_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostel_rooms`
--
ALTER TABLE `hostel_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_card`
--
ALTER TABLE `id_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_head`
--
ALTER TABLE `income_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_issue`
--
ALTER TABLE `item_issue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `item_category_id` (`item_category_id`);

--
-- Indexes for table `item_stock`
--
ALTER TABLE `item_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `item_store`
--
ALTER TABLE `item_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_supplier`
--
ALTER TABLE `item_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `subject_group_subject_id` (`subject_group_subject_id`),
  ADD KEY `subject_group_class_sections_id` (`subject_group_class_sections_id`);

--
-- Indexes for table `libarary_members`
--
ALTER TABLE `libarary_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_class_students`
--
ALTER TABLE `multi_class_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `student_session_id` (`student_session_id`);

--
-- Indexes for table `notification_roles`
--
ALTER TABLE `notification_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `send_notification_id` (`send_notification_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `notification_setting`
--
ALTER TABLE `notification_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onlineexam`
--
ALTER TABLE `onlineexam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `onlineexam_attempts`
--
ALTER TABLE `onlineexam_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onlineexam_student_id` (`onlineexam_student_id`);

--
-- Indexes for table `onlineexam_questions`
--
ALTER TABLE `onlineexam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onlineexam_id` (`onlineexam_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `onlineexam_students`
--
ALTER TABLE `onlineexam_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onlineexam_id` (`onlineexam_id`),
  ADD KEY `student_session_id` (`student_session_id`);

--
-- Indexes for table `onlineexam_student_results`
--
ALTER TABLE `onlineexam_student_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onlineexam_student_id` (`onlineexam_student_id`),
  ADD KEY `onlineexam_question_id` (`onlineexam_question_id`);

--
-- Indexes for table `online_admissions`
--
ALTER TABLE `online_admissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_section_id` (`class_section_id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip_allowance`
--
ALTER TABLE `payslip_allowance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_category`
--
ALTER TABLE `permission_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_group`
--
ALTER TABLE `permission_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_student`
--
ALTER TABLE `permission_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `print_headerfooter`
--
ALTER TABLE `print_headerfooter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `read_notification`
--
ALTER TABLE `read_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_head`
--
ALTER TABLE `route_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_plan`
--
ALTER TABLE `route_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_houses`
--
ALTER TABLE `school_houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sch_settings`
--
ALTER TABLE `sch_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_notification`
--
ALTER TABLE `send_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_config`
--
ALTER TABLE `sms_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_attendance_staff` (`staff_id`),
  ADD KEY `FK_staff_attendance_staff_attendance_type` (`staff_attendance_type_id`);

--
-- Indexes for table `staff_attendance_type`
--
ALTER TABLE `staff_attendance_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_designation`
--
ALTER TABLE `staff_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_id_card`
--
ALTER TABLE `staff_id_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_leave_details`
--
ALTER TABLE `staff_leave_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_leave_details_staff` (`staff_id`),
  ADD KEY `FK_staff_leave_details_leave_types` (`leave_type_id`);

--
-- Indexes for table `staff_leave_request`
--
ALTER TABLE `staff_leave_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_leave_request_staff` (`staff_id`),
  ADD KEY `FK_staff_leave_request_leave_types` (`leave_type_id`);

--
-- Indexes for table `staff_payroll`
--
ALTER TABLE `staff_payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_payslip`
--
ALTER TABLE `staff_payslip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_payslip_staff` (`staff_id`);

--
-- Indexes for table `staff_rating`
--
ALTER TABLE `staff_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_rating_staff` (`staff_id`);

--
-- Indexes for table `staff_roles`
--
ALTER TABLE `staff_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff_timeline`
--
ALTER TABLE `staff_timeline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_timeline_staff` (`staff_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_applyleave`
--
ALTER TABLE `student_applyleave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendences`
--
ALTER TABLE `student_attendences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_session_id` (`student_session_id`),
  ADD KEY `attendence_type_id` (`attendence_type_id`);

--
-- Indexes for table `student_doc`
--
ALTER TABLE `student_doc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_edit_fields`
--
ALTER TABLE `student_edit_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fees_deposite`
--
ALTER TABLE `student_fees_deposite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_fees_master_id` (`student_fees_master_id`),
  ADD KEY `fee_groups_feetype_id` (`fee_groups_feetype_id`);

--
-- Indexes for table `student_fees_discounts`
--
ALTER TABLE `student_fees_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_session_id` (`student_session_id`),
  ADD KEY `fees_discount_id` (`fees_discount_id`);

--
-- Indexes for table `student_fees_master`
--
ALTER TABLE `student_fees_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_session_id` (`student_session_id`),
  ADD KEY `fee_session_group_id` (`fee_session_group_id`);

--
-- Indexes for table `student_session`
--
ALTER TABLE `student_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `student_sibling`
--
ALTER TABLE `student_sibling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_subject_attendances`
--
ALTER TABLE `student_subject_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendence_type_id` (`attendence_type_id`),
  ADD KEY `student_session_id` (`student_session_id`),
  ADD KEY `subject_timetable_id` (`subject_timetable_id`);

--
-- Indexes for table `student_timeline`
--
ALTER TABLE `student_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_groups`
--
ALTER TABLE `subject_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `subject_group_class_sections`
--
ALTER TABLE `subject_group_class_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_section_id` (`class_section_id`),
  ADD KEY `subject_group_id` (`subject_group_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `subject_group_subjects`
--
ALTER TABLE `subject_group_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_group_id` (`subject_group_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subject_syllabus`
--
ALTER TABLE `subject_syllabus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_for` (`created_for`);

--
-- Indexes for table `subject_timetable`
--
ALTER TABLE `subject_timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `subject_group_id` (`subject_group_id`),
  ADD KEY `subject_group_subject_id` (`subject_group_subject_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `submit_assignment`
--
ALTER TABLE `submit_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_section_id` (`class_section_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `template_admitcards`
--
ALTER TABLE `template_admitcards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_marksheets`
--
ALTER TABLE `template_marksheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `transport_route`
--
ALTER TABLE `transport_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_authentication`
--
ALTER TABLE `users_authentication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_routes`
--
ALTER TABLE `vehicle_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors_book`
--
ALTER TABLE `visitors_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors_purpose`
--
ALTER TABLE `visitors_purpose`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `alumni_events`
--
ALTER TABLE `alumni_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alumni_students`
--
ALTER TABLE `alumni_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendence_type`
--
ALTER TABLE `attendence_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chat_connections`
--
ALTER TABLE `chat_connections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chat_users`
--
ALTER TABLE `chat_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `class_sections`
--
ALTER TABLE `class_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `class_teacher`
--
ALTER TABLE `class_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint_type`
--
ALTER TABLE `complaint_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_for`
--
ALTER TABLE `content_for`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coscholasticareas`
--
ALTER TABLE `coscholasticareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `disable_reason`
--
ALTER TABLE `disable_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dispatch_receive`
--
ALTER TABLE `dispatch_receive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enquiry_type`
--
ALTER TABLE `enquiry_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_groups`
--
ALTER TABLE `exam_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `exam_group_class_batch_exams`
--
ALTER TABLE `exam_group_class_batch_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `exam_group_class_batch_exam_students`
--
ALTER TABLE `exam_group_class_batch_exam_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7724;

--
-- AUTO_INCREMENT for table `exam_group_class_batch_exam_subjects`
--
ALTER TABLE `exam_group_class_batch_exam_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1602;

--
-- AUTO_INCREMENT for table `exam_group_exam_connections`
--
ALTER TABLE `exam_group_exam_connections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `exam_group_exam_results`
--
ALTER TABLE `exam_group_exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16646;

--
-- AUTO_INCREMENT for table `exam_group_students`
--
ALTER TABLE `exam_group_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_head`
--
ALTER TABLE `expense_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feecategory`
--
ALTER TABLE `feecategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feemasters`
--
ALTER TABLE `feemasters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_discounts`
--
ALTER TABLE `fees_discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fees_plan`
--
ALTER TABLE `fees_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `fees_reminder`
--
ALTER TABLE `fees_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feetype`
--
ALTER TABLE `feetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `fee_discounts`
--
ALTER TABLE `fee_discounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_groups`
--
ALTER TABLE `fee_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `fee_groups_feetype`
--
ALTER TABLE `fee_groups_feetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `fee_head`
--
ALTER TABLE `fee_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `fee_receipt_no`
--
ALTER TABLE `fee_receipt_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_session_groups`
--
ALTER TABLE `fee_session_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `filetypes`
--
ALTER TABLE `filetypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `follow_up`
--
ALTER TABLE `follow_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_media_gallery`
--
ALTER TABLE `front_cms_media_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_menus`
--
ALTER TABLE `front_cms_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `front_cms_menu_items`
--
ALTER TABLE `front_cms_menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `front_cms_pages`
--
ALTER TABLE `front_cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `front_cms_page_contents`
--
ALTER TABLE `front_cms_page_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_programs`
--
ALTER TABLE `front_cms_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `front_cms_program_photos`
--
ALTER TABLE `front_cms_program_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_settings`
--
ALTER TABLE `front_cms_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_calls`
--
ALTER TABLE `general_calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework_evaluation`
--
ALTER TABLE `homework_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostel`
--
ALTER TABLE `hostel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostel_rooms`
--
ALTER TABLE `hostel_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `id_card`
--
ALTER TABLE `id_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `income_head`
--
ALTER TABLE `income_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_issue`
--
ALTER TABLE `item_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_stock`
--
ALTER TABLE `item_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_store`
--
ALTER TABLE `item_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_supplier`
--
ALTER TABLE `item_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `libarary_members`
--
ALTER TABLE `libarary_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=909;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `multi_class_students`
--
ALTER TABLE `multi_class_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_roles`
--
ALTER TABLE `notification_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification_setting`
--
ALTER TABLE `notification_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `onlineexam`
--
ALTER TABLE `onlineexam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlineexam_attempts`
--
ALTER TABLE `onlineexam_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlineexam_questions`
--
ALTER TABLE `onlineexam_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlineexam_students`
--
ALTER TABLE `onlineexam_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlineexam_student_results`
--
ALTER TABLE `onlineexam_student_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_admissions`
--
ALTER TABLE `online_admissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payslip_allowance`
--
ALTER TABLE `payslip_allowance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission_category`
--
ALTER TABLE `permission_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `permission_group`
--
ALTER TABLE `permission_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `permission_student`
--
ALTER TABLE `permission_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `print_headerfooter`
--
ALTER TABLE `print_headerfooter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `read_notification`
--
ALTER TABLE `read_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=909;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2300;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route_head`
--
ALTER TABLE `route_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `route_plan`
--
ALTER TABLE `route_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `school_houses`
--
ALTER TABLE `school_houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `send_notification`
--
ALTER TABLE `send_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sms_config`
--
ALTER TABLE `sms_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2902;

--
-- AUTO_INCREMENT for table `staff_attendance_type`
--
ALTER TABLE `staff_attendance_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_designation`
--
ALTER TABLE `staff_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `staff_id_card`
--
ALTER TABLE `staff_id_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff_leave_details`
--
ALTER TABLE `staff_leave_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `staff_leave_request`
--
ALTER TABLE `staff_leave_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff_payroll`
--
ALTER TABLE `staff_payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_payslip`
--
ALTER TABLE `staff_payslip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_rating`
--
ALTER TABLE `staff_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_roles`
--
ALTER TABLE `staff_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `staff_timeline`
--
ALTER TABLE `staff_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=630;

--
-- AUTO_INCREMENT for table `student_applyleave`
--
ALTER TABLE `student_applyleave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_attendences`
--
ALTER TABLE `student_attendences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_doc`
--
ALTER TABLE `student_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_edit_fields`
--
ALTER TABLE `student_edit_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees_deposite`
--
ALTER TABLE `student_fees_deposite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `student_fees_discounts`
--
ALTER TABLE `student_fees_discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_fees_master`
--
ALTER TABLE `student_fees_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student_session`
--
ALTER TABLE `student_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=663;

--
-- AUTO_INCREMENT for table `student_sibling`
--
ALTER TABLE `student_sibling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_subject_attendances`
--
ALTER TABLE `student_subject_attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_timeline`
--
ALTER TABLE `student_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `subject_groups`
--
ALTER TABLE `subject_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `subject_group_class_sections`
--
ALTER TABLE `subject_group_class_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `subject_group_subjects`
--
ALTER TABLE `subject_group_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `subject_syllabus`
--
ALTER TABLE `subject_syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_timetable`
--
ALTER TABLE `subject_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `submit_assignment`
--
ALTER TABLE `submit_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_admitcards`
--
ALTER TABLE `template_admitcards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_marksheets`
--
ALTER TABLE `template_marksheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport_route`
--
ALTER TABLE `transport_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1218;

--
-- AUTO_INCREMENT for table `users_authentication`
--
ALTER TABLE `users_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle_routes`
--
ALTER TABLE `vehicle_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `visitors_book`
--
ALTER TABLE `visitors_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors_purpose`
--
ALTER TABLE `visitors_purpose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni_students`
--
ALTER TABLE `alumni_students`
  ADD CONSTRAINT `alumni_students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_connections`
--
ALTER TABLE `chat_connections`
  ADD CONSTRAINT `chat_connections_ibfk_1` FOREIGN KEY (`chat_user_one`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_connections_ibfk_2` FOREIGN KEY (`chat_user_two`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`chat_user_id`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_messages_ibfk_2` FOREIGN KEY (`chat_connection_id`) REFERENCES `chat_connections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_users`
--
ALTER TABLE `chat_users`
  ADD CONSTRAINT `chat_users_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_users_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_users_ibfk_3` FOREIGN KEY (`create_staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_users_ibfk_4` FOREIGN KEY (`create_student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `content_for`
--
ALTER TABLE `content_for`
  ADD CONSTRAINT `content_for_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `content_for_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD CONSTRAINT `custom_field_values_ibfk_1` FOREIGN KEY (`custom_field_id`) REFERENCES `custom_fields` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_class_batch_exams`
--
ALTER TABLE `exam_group_class_batch_exams`
  ADD CONSTRAINT `exam_group_class_batch_exams_ibfk_1` FOREIGN KEY (`exam_group_d`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_class_batch_exam_students`
--
ALTER TABLE `exam_group_class_batch_exam_students`
  ADD CONSTRAINT `exam_group_class_batch_exam_students_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exam_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_class_batch_exam_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_class_batch_exam_students_ibfk_3` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_class_batch_exam_subjects`
--
ALTER TABLE `exam_group_class_batch_exam_subjects`
  ADD CONSTRAINT `exam_group_class_batch_exam_subjects_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exams_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_class_batch_exam_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_exam_connections`
--
ALTER TABLE `exam_group_exam_connections`
  ADD CONSTRAINT `exam_group_exam_connections_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_exam_connections_ibfk_2` FOREIGN KEY (`exam_group_class_batch_exams_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_exam_results`
--
ALTER TABLE `exam_group_exam_results`
  ADD CONSTRAINT `exam_group_exam_results_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exam_subject_id`) REFERENCES `exam_group_class_batch_exam_subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_exam_results_ibfk_2` FOREIGN KEY (`exam_group_student_id`) REFERENCES `exam_group_students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_exam_results_ibfk_3` FOREIGN KEY (`exam_group_class_batch_exam_student_id`) REFERENCES `exam_group_class_batch_exam_students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_group_students`
--
ALTER TABLE `exam_group_students`
  ADD CONSTRAINT `exam_group_students_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_group_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fees_discounts`
--
ALTER TABLE `fees_discounts`
  ADD CONSTRAINT `fees_discounts_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fee_groups_feetype`
--
ALTER TABLE `fee_groups_feetype`
  ADD CONSTRAINT `fee_groups_feetype_ibfk_1` FOREIGN KEY (`fee_session_group_id`) REFERENCES `fee_session_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_groups_feetype_ibfk_2` FOREIGN KEY (`fee_groups_id`) REFERENCES `fee_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_groups_feetype_ibfk_3` FOREIGN KEY (`feetype_id`) REFERENCES `feetype` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_groups_feetype_ibfk_4` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fee_session_groups`
--
ALTER TABLE `fee_session_groups`
  ADD CONSTRAINT `fee_session_groups_ibfk_1` FOREIGN KEY (`fee_groups_id`) REFERENCES `fee_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fee_session_groups_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `front_cms_page_contents`
--
ALTER TABLE `front_cms_page_contents`
  ADD CONSTRAINT `front_cms_page_contents_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `front_cms_pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `front_cms_program_photos`
--
ALTER TABLE `front_cms_program_photos`
  ADD CONSTRAINT `front_cms_program_photos_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `front_cms_programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `homework_ibfk_1` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_issue`
--
ALTER TABLE `item_issue`
  ADD CONSTRAINT `item_issue_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_issue_ibfk_2` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_stock`
--
ALTER TABLE `item_stock`
  ADD CONSTRAINT `item_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `item_supplier` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_stock_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `item_store` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_ibfk_3` FOREIGN KEY (`subject_group_class_sections_id`) REFERENCES `subject_group_class_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `multi_class_students`
--
ALTER TABLE `multi_class_students`
  ADD CONSTRAINT `multi_class_students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `multi_class_students_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_roles`
--
ALTER TABLE `notification_roles`
  ADD CONSTRAINT `notification_roles_ibfk_1` FOREIGN KEY (`send_notification_id`) REFERENCES `send_notification` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `onlineexam`
--
ALTER TABLE `onlineexam`
  ADD CONSTRAINT `onlineexam_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `onlineexam_attempts`
--
ALTER TABLE `onlineexam_attempts`
  ADD CONSTRAINT `onlineexam_attempts_ibfk_1` FOREIGN KEY (`onlineexam_student_id`) REFERENCES `onlineexam_students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `onlineexam_questions`
--
ALTER TABLE `onlineexam_questions`
  ADD CONSTRAINT `onlineexam_questions_ibfk_1` FOREIGN KEY (`onlineexam_id`) REFERENCES `onlineexam` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `onlineexam_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `onlineexam_questions_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `onlineexam_students`
--
ALTER TABLE `onlineexam_students`
  ADD CONSTRAINT `onlineexam_students_ibfk_1` FOREIGN KEY (`onlineexam_id`) REFERENCES `onlineexam` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `onlineexam_students_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `onlineexam_student_results`
--
ALTER TABLE `onlineexam_student_results`
  ADD CONSTRAINT `onlineexam_student_results_ibfk_1` FOREIGN KEY (`onlineexam_student_id`) REFERENCES `onlineexam_students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `onlineexam_student_results_ibfk_2` FOREIGN KEY (`onlineexam_question_id`) REFERENCES `onlineexam_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `online_admissions`
--
ALTER TABLE `online_admissions`
  ADD CONSTRAINT `online_admissions_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD CONSTRAINT `FK_staff_attendance_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_staff_attendance_staff_attendance_type` FOREIGN KEY (`staff_attendance_type_id`) REFERENCES `staff_attendance_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_leave_details`
--
ALTER TABLE `staff_leave_details`
  ADD CONSTRAINT `FK_staff_leave_details_leave_types` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_staff_leave_details_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_leave_request`
--
ALTER TABLE `staff_leave_request`
  ADD CONSTRAINT `FK_staff_leave_request_leave_types` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`),
  ADD CONSTRAINT `FK_staff_leave_request_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_payslip`
--
ALTER TABLE `staff_payslip`
  ADD CONSTRAINT `FK_staff_payslip_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_rating`
--
ALTER TABLE `staff_rating`
  ADD CONSTRAINT `FK_staff_rating_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_roles`
--
ALTER TABLE `staff_roles`
  ADD CONSTRAINT `FK_staff_roles_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_staff_roles_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_timeline`
--
ALTER TABLE `staff_timeline`
  ADD CONSTRAINT `FK_staff_timeline_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_session`
--
ALTER TABLE `student_session`
  ADD CONSTRAINT `student_session_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_session_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_session_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_session_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_subject_attendances`
--
ALTER TABLE `student_subject_attendances`
  ADD CONSTRAINT `student_subject_attendances_ibfk_1` FOREIGN KEY (`attendence_type_id`) REFERENCES `attendence_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_subject_attendances_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_subject_attendances_ibfk_3` FOREIGN KEY (`subject_timetable_id`) REFERENCES `subject_timetable` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_groups`
--
ALTER TABLE `subject_groups`
  ADD CONSTRAINT `subject_groups_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_group_class_sections`
--
ALTER TABLE `subject_group_class_sections`
  ADD CONSTRAINT `subject_group_class_sections_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_group_class_sections_ibfk_2` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_group_class_sections_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_group_subjects`
--
ALTER TABLE `subject_group_subjects`
  ADD CONSTRAINT `subject_group_subjects_ibfk_1` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_group_subjects_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_group_subjects_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_syllabus`
--
ALTER TABLE `subject_syllabus`
  ADD CONSTRAINT `subject_syllabus_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_syllabus_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_syllabus_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_syllabus_ibfk_4` FOREIGN KEY (`created_for`) REFERENCES `staff` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_timetable`
--
ALTER TABLE `subject_timetable`
  ADD CONSTRAINT `subject_timetable_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_3` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_4` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_5` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_6` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
