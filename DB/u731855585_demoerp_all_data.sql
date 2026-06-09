-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 04, 2026 at 10:07 AM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u731855585_demoerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `account` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `session_id`, `account`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 1, 'Registration Fee', 1, '2026-06-03 12:15:05', '2026-06-03 12:15:05'),
(4, 1, 'Tuition Fee', 1, '2026-06-03 12:15:13', '2026-06-03 12:15:13'),
(5, 1, 'Admission Fee', 1, '2026-06-03 12:15:20', '2026-06-03 12:15:20'),
(6, 1, 'Transport Fee', 1, '2026-06-03 12:15:32', '2026-06-03 12:15:32'),
(7, 2, 'Registration Fee', 1, '2026-06-04 06:25:05', '2026-06-04 06:25:05'),
(8, 2, 'Tuition Fee', 1, '2026-06-04 06:25:05', '2026-06-04 06:25:05'),
(9, 2, 'Admission Fee', 1, '2026-06-04 06:25:05', '2026-06-04 06:25:05'),
(10, 2, 'Transport Fee', 1, '2026-06-04 06:25:05', '2026-06-04 06:25:05');

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
-- Table structure for table `balance_sheets`
--

CREATE TABLE `balance_sheets` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `balance_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Income, 1=Expense',
  `student_id` int(11) DEFAULT NULL,
  `receipt_no` varchar(255) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `head_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `attatchment` varchar(200) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Active, 1=Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balance_sheets`
--

INSERT INTO `balance_sheets` (`id`, `session_id`, `balance_type`, `student_id`, `receipt_no`, `staff_id`, `head_id`, `amount`, `date`, `attatchment`, `description`, `status`) VALUES
(1, 1, 0, 1, '2025-2026/1', NULL, 1, 2000.00, '2026-06-03 19:35:31', NULL, NULL, 0),
(2, 1, 0, 2, '2025-2026/2', NULL, 1, 3000.00, '2026-06-03 19:39:59', NULL, NULL, 0),
(3, 2, 0, NULL, NULL, NULL, 0, 5000.00, '2026-06-04 06:25:05', NULL, 'Opening balance', 0),
(5, 2, 0, 2, '2026-2027/2', NULL, 2, 2500.00, '2026-06-04 14:03:30', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
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
  `session_id` int(11) DEFAULT NULL,
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
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `branch_url` varchar(255) DEFAULT NULL,
  `db_host` varchar(100) DEFAULT NULL,
  `db_name` varchar(100) DEFAULT NULL,
  `db_username` varchar(100) DEFAULT NULL,
  `db_password` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'login', 0, '2025-12-19 14:30:57'),
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
  `session_id` int(11) DEFAULT NULL,
  `certificate_name` varchar(100) NOT NULL,
  `certificate_text` text NOT NULL,
  `left_header` varchar(100) NOT NULL,
  `center_header` varchar(100) NOT NULL,
  `right_header` varchar(100) NOT NULL,
  `left_footer` varchar(100) NOT NULL,
  `right_footer` varchar(100) NOT NULL,
  `center_footer` varchar(100) NOT NULL,
  `is_left_footer` int(11) NOT NULL DEFAULT 0,
  `is_center_footer` int(11) NOT NULL DEFAULT 0,
  `is_right_footer` int(11) NOT NULL DEFAULT 0,
  `left_sign` varchar(200) DEFAULT NULL,
  `middle_sign` varchar(200) DEFAULT NULL,
  `right_sign` varchar(200) DEFAULT NULL,
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
  `enable_image_height` int(11) NOT NULL,
  `is_active_header_img` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_generates`
--

CREATE TABLE `certificate_generates` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class` varchar(60) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `session_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '1st', 1, 'no', '2026-06-03 12:08:15', NULL),
(2, '2nd', 1, 'no', '2026-06-03 17:07:18', NULL),
(3, '1st', 2, 'no', '2026-06-04 06:25:05', NULL),
(4, '2nd', 2, 'no', '2026-06-04 06:25:05', NULL);

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
(1, 1, 1, 'no', '2026-06-03 12:08:15', NULL),
(2, 2, 1, 'no', '2026-06-03 17:07:18', NULL),
(3, 3, 2, 'no', '2026-06-04 06:25:05', NULL),
(4, 4, 2, 'no', '2026-06-04 06:25:05', NULL);

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
  `session_id` int(11) DEFAULT NULL,
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
  `session_id` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `exam_type` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `exam_group` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coscholasticareas`
--

INSERT INTO `coscholasticareas` (`id`, `session_id`, `name`, `exam_type`, `description`, `exam_group`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Co- Scholastic Areas - Term-1', '', 'Co- Scholastic Areas - Term-1', 1, 0, '2026-06-03 14:20:50', '2026-06-03 14:20:50'),
(2, 1, 'Co- Scholastic Areas - Term-2', '', 'Co- Scholastic Areas - Term-2', 2, 0, '2026-06-03 14:41:59', '2026-06-03 14:41:59'),
(3, 2, 'Co- Scholastic Areas - Term-1', '', 'Co- Scholastic Areas - Term-1', NULL, 0, '2026-06-04 06:25:05', '2026-06-04 06:25:05'),
(4, 2, 'Co- Scholastic Areas - Term-2', '', 'Co- Scholastic Areas - Term-2', NULL, 0, '2026-06-04 06:25:05', '2026-06-04 06:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `deleted_receipts`
--

CREATE TABLE `deleted_receipts` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
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
  `month_total` varchar(200) DEFAULT NULL,
  `previous_balance` float(10,2) DEFAULT NULL,
  `remaining_previous_balance` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `department_name` varchar(200) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disable_reason`
--

CREATE TABLE `disable_reason` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `disable_reason`
--

INSERT INTO `disable_reason` (`id`, `session_id`, `reason`, `created_at`) VALUES
(1, 1, 'Transfer', '2026-06-03 14:00:32'),
(2, 2, 'Transfer', '2026-06-04 06:25:05');

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
  `session_id` int(11) DEFAULT NULL,
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

INSERT INTO `exam_groups` (`id`, `session_id`, `name`, `exam_type`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Term1', 'basic_system', 'Term1', 0, '2026-06-03 14:17:22', NULL),
(2, 1, 'Term2', 'basic_system', '', 0, '2026-06-03 14:17:35', NULL),
(3, 2, 'Term1', 'basic_system', 'Term1', 0, '2026-06-04 06:25:05', NULL),
(4, 2, 'Term2', 'basic_system', '', 0, '2026-06-04 06:25:05', NULL);

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
(1, 'UT-1', 1, NULL, NULL, 'UT-1', NULL, 1, 1, '2026-06-03 14:17:50', NULL, 0, 1),
(2, 'UT-2', 1, NULL, NULL, 'UT-2', NULL, 1, 1, '2026-06-03 14:18:06', NULL, 0, 2),
(3, 'Uniform', 1, NULL, NULL, 'Uniform ', NULL, 1, 1, '2026-06-03 14:21:05', NULL, 1, 1),
(4, 'Attendance', 1, NULL, NULL, 'Attendance', NULL, 1, 1, '2026-06-03 14:21:16', NULL, 1, 1),
(5, 'Uniform', 1, NULL, NULL, 'Uniform', NULL, 1, 1, '2026-06-03 14:42:15', NULL, 1, 2),
(6, 'Attendance', 1, NULL, NULL, 'Attendance', NULL, 1, 1, '2026-06-03 14:42:27', NULL, 1, 2),
(7, 'UT-1', 2, NULL, NULL, 'UT-1', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 0, 1),
(8, 'Uniform', 2, NULL, NULL, 'Uniform', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 0, 3),
(9, 'Attendance', 2, NULL, NULL, 'Attendance', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 0, 4),
(10, 'UT-2', 2, NULL, NULL, 'UT-2', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 0, 2),
(11, 'Uniform', 2, NULL, NULL, 'Uniform', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 0, 5),
(12, 'Attendance', 2, NULL, NULL, 'Attendance', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 0, 6),
(13, 'UT-1', 2, NULL, NULL, 'UT-1', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 1, 1),
(14, 'Uniform', 2, NULL, NULL, 'Uniform', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 1, 3),
(15, 'Attendance', 2, NULL, NULL, 'Attendance', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 1, 4),
(16, 'UT-2', 2, NULL, NULL, 'UT-2', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 1, 2),
(17, 'Uniform', 2, NULL, NULL, 'Uniform', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 1, 5),
(18, 'Attendance', 2, NULL, NULL, 'Attendance', NULL, 1, 1, '2026-06-04 06:25:05', NULL, 1, 6);

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
(1, 1, 2, 4111, 0, 0, '2026-06-03 14:18:24', NULL),
(2, 1, 1, 4110, 0, 0, '2026-06-03 14:18:24', NULL),
(3, 3, 2, 4111, 0, 0, '2026-06-03 14:21:23', NULL),
(4, 3, 1, 4110, 0, 0, '2026-06-03 14:21:23', NULL),
(5, 4, 2, 4111, 0, 0, '2026-06-03 14:21:32', NULL),
(6, 4, 1, 4110, 0, 0, '2026-06-03 14:21:32', NULL),
(7, 2, 2, 4111, 0, 0, '2026-06-03 14:40:02', NULL),
(8, 2, 1, 4110, 0, 0, '2026-06-03 14:40:02', NULL),
(9, 5, 2, 4111, 0, 0, '2026-06-03 14:42:39', NULL),
(10, 5, 1, 4110, 0, 0, '2026-06-03 14:42:39', NULL),
(11, 6, 2, 4111, 0, 0, '2026-06-03 14:42:45', NULL),
(12, 6, 1, 4110, 0, 0, '2026-06-03 14:42:45', NULL);

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
(1, 1, 1, '2025-05-01', '09:00:00', '120', '1', 50.00, '17', 1.00, NULL, 0, '2026-06-03 14:19:35', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, '2025-05-02', '09:00:00', '120', '1', 50.00, '17', 1.00, NULL, 0, '2026-06-03 14:19:35', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 3, '2025-05-03', '09:00:00', '120', '1', 50.00, '17', 1.00, NULL, 0, '2026-06-03 14:19:35', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 1, '2026-03-03', '09:00:00', '120', '1', 50.00, '17', 1.00, NULL, 0, '2026-06-03 14:40:59', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 2, '2026-03-04', '09:00:00', '120', '1', 50.00, '17', 1.00, NULL, 0, '2026-06-03 14:40:59', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, 3, '2026-03-05', '09:00:00', '120', '1', 50.00, '17', 1.00, NULL, 0, '2026-06-03 14:40:59', NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, 1, 1, 'm_leave', 0.00, '', 0, '2026-06-03 14:20:00', NULL, NULL),
(2, 2, 1, 'present', 45.00, '', 0, '2026-06-03 14:20:00', NULL, NULL),
(3, 1, 2, 'present', 43.00, '', 0, '2026-06-03 14:20:13', NULL, NULL),
(4, 2, 2, 'present', 46.00, '', 0, '2026-06-03 14:20:13', NULL, NULL),
(5, 1, 3, 'present', 47.00, '', 0, '2026-06-03 14:20:26', NULL, NULL),
(6, 2, 3, 'present', 48.00, '', 0, '2026-06-03 14:20:26', NULL, NULL),
(7, 7, 4, 'present', 43.00, '', 0, '2026-06-03 16:59:15', NULL, NULL),
(8, 8, 4, 'present', 49.00, '', 0, '2026-06-03 14:41:20', NULL, NULL),
(9, 7, 5, 'present', 45.00, '', 0, '2026-06-03 14:41:30', NULL, NULL),
(10, 8, 5, 'present', 48.00, '', 0, '2026-06-03 14:41:30', NULL, NULL),
(11, 7, 6, 'present', 47.00, '', 0, '2026-06-03 14:41:40', NULL, NULL),
(12, 8, 6, 'present', 49.00, '', 0, '2026-06-03 14:41:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_group_exam_results_coscholastic`
--

CREATE TABLE `exam_group_exam_results_coscholastic` (
  `id` int(11) NOT NULL,
  `exam_group_class_batch_exam_student_id` int(11) NOT NULL,
  `exam_group_class_batch_exam_subject_id` int(11) DEFAULT NULL,
  `attendence` varchar(10) DEFAULT NULL,
  `get_marks` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `exam_group_student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `exam_group_exam_results_coscholastic`
--

INSERT INTO `exam_group_exam_results_coscholastic` (`id`, `exam_group_class_batch_exam_student_id`, `exam_group_class_batch_exam_subject_id`, `attendence`, `get_marks`, `note`, `is_active`, `created_at`, `updated_at`, `exam_group_student_id`) VALUES
(1, 3, 3, 'present', 'A', '', 0, '2026-06-03 14:21:56', NULL, NULL),
(2, 4, 3, 'present', 'A', '', 0, '2026-06-03 14:21:56', NULL, NULL),
(3, 5, 4, 'present', 'B', '', 0, '2026-06-03 14:22:08', NULL, NULL),
(4, 6, 4, 'present', 'B', '', 0, '2026-06-03 14:22:08', NULL, NULL),
(5, 9, 5, 'present', 'A1', '', 0, '2026-06-03 14:43:00', NULL, NULL),
(6, 10, 5, 'present', 'A1', '', 0, '2026-06-03 14:43:00', NULL, NULL),
(7, 11, 6, 'present', 'B1', '', 0, '2026-06-03 14:43:10', NULL, NULL),
(8, 12, 6, 'present', 'B1', '', 0, '2026-06-03 14:43:10', NULL, NULL);

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
  `session_id` int(11) DEFAULT NULL,
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
  `session_id` int(11) DEFAULT NULL,
  `exp_category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `fees_plan`
--

CREATE TABLE `fees_plan` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `fee_group_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `class_ids` text NOT NULL,
  `category_ids` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_plan`
--

INSERT INTO `fees_plan` (`id`, `session_id`, `fee_group_id`, `amount`, `class_ids`, `category_ids`, `created_at`) VALUES
(1, 1, 3, 1000.00, '[\"1\"]', '[\"1\"]', '2026-06-03 12:19:32'),
(2, 1, 2, 500.00, '[\"1\"]', '[\"1\"]', '2026-06-03 12:19:40'),
(3, 1, 1, 500.00, '[\"1\"]', '[\"1\"]', '2026-06-03 12:19:53'),
(4, 2, 6, 1000.00, '[\"3\"]', '[\"3\"]', '2026-06-04 06:25:05'),
(5, 2, 5, 500.00, '[\"3\",\"4\"]', '[\"3\",\"4\"]', '2026-06-04 06:25:05'),
(6, 2, 4, 500.00, '[\"3\",\"4\"]', '[\"3\",\"4\"]', '2026-06-04 06:25:05');

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
(103, 1, NULL, 'Previous Session Balance', 'Previous Session Balance', 'no', '2026-04-03 10:44:03', NULL, '');

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
  `session_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `is_system` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `fee_groups`
--

INSERT INTO `fee_groups` (`id`, `session_id`, `name`, `is_system`, `description`, `is_active`, `created_at`) VALUES
(1, 1, 'NS', 0, 'New Student For 2025-2026', 'no', '2026-06-03 12:13:44'),
(2, 1, 'OS', 0, 'Old Student', 'no', '2026-06-03 17:07:06'),
(3, 2, 'NS', 0, '', 'no', '2026-06-04 06:25:05'),
(4, 2, 'OS', 0, '', 'no', '2026-06-04 06:25:05'),
(5, 1, 'Balance Master', 1, NULL, 'no', '2026-06-04 06:25:05');

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
(1, 1, 5, 103, 1, NULL, 'none', '2026-07-04', 0.00, 0.00, 'no', '2026-06-04 06:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `fee_head`
--

CREATE TABLE `fee_head` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `fees_heading` varchar(255) NOT NULL,
  `frequency` enum('Annual','Quarterly','Monthly') NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `months` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`months`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_head`
--

INSERT INTO `fee_head` (`id`, `session_id`, `fees_heading`, `frequency`, `account_name`, `months`, `created_at`) VALUES
(1, 1, 'Tuition Fee', 'Monthly', 'Tuition Fee', '[\"Apr\",\"May\",\"Jun\",\"Jul\",\"Aug\",\"Sep\",\"Oct\",\"Nov\",\"Dec\",\"Jan\",\"Feb\",\"Mar\"]', '2026-06-03 12:18:23'),
(2, 1, 'Reg. Fee', 'Annual', 'Registration Fee', '[\"Apr\"]', '2026-06-03 12:18:52'),
(3, 1, 'Admission Fee', 'Annual', 'Admission Fee', '[\"Apr\"]', '2026-06-03 12:19:14'),
(4, 2, 'Tuition Fee', 'Monthly', 'Tuition Fee', '[\"Apr\",\"May\",\"Jun\",\"Jul\",\"Aug\",\"Sep\",\"Oct\",\"Nov\",\"Dec\",\"Jan\",\"Feb\",\"Mar\"]', '2026-06-04 06:25:05'),
(5, 2, 'Reg. Fee', 'Annual', 'Registration Fee', '[\"Apr\"]', '2026-06-04 06:25:05'),
(6, 2, 'Admission Fee', 'Annual', 'Admission Fee', '[\"Apr\"]', '2026-06-04 06:25:05');

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
(1, 5, 1, 'no', '2026-06-04 06:25:05');

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

--
-- Dumping data for table `front_cms_media_gallery`
--

INSERT INTO `front_cms_media_gallery` (`id`, `image`, `thumb_path`, `dir_path`, `img_name`, `thumb_name`, `created_at`, `file_type`, `file_size`, `vid_url`, `vid_title`) VALUES
(1, NULL, 'uploads/gallery/media/thumb/', 'uploads/gallery/media/', 'image (1).png', 'image (1).png', '2026-05-29 10:54:12', 'image/png', '232910', '', '');

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
  `content_heading` varchar(255) DEFAULT NULL,
  `menu_description` longtext NOT NULL,
  `image_position` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Left, 1=Right',
  `media_gallery_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `session_id` int(11) DEFAULT NULL,
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

INSERT INTO `front_cms_programs` (`id`, `session_id`, `type`, `slug`, `url`, `title`, `date`, `event_start`, `event_end`, `event_venue`, `description`, `is_active`, `created_at`, `meta_title`, `meta_description`, `meta_keyword`, `feature_image`, `publish_date`, `publish`, `sidebar`) VALUES
(1, 30, 'notice', 'ut-2-starts-from-15-nov-2025', 'read/ut-2-starts-from-15-nov-2025', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2026-01-21 10:53:35', '', '', '', '', '0000-00-00', '0', NULL),
(2, 30, 'events', 'childrens-day-program-by-teachers', 'read/childrens-day-program-by-teachers', 'Children\'s day program by teachers', NULL, '2025-11-07', '2025-11-07', 'GIS', '<p><a class=\"detail_popover\" data-original-title=\"\" data-toggle=\"popover\" href=\"https://demo.smart-school.in/admin/front/events#\" style=\"box-sizing: border-box; color: rgb(68, 68, 68); text-decoration-line: none; transition: color 250ms ease-in-out, background-color 250ms ease-in-out; position: relative; overflow: hidden; display: table; cursor: default; font-family: Roboto, sans-serif; font-size: 13.3333px;\" title=\"\">Children\'s day program by teachers</a></p>', 'no', '2026-01-21 10:53:35', '', '', '', '', '0000-00-00', '0', NULL),
(3, 30, 'notice', 'ut-2-starts-from-15-nov-2025-1', 'read/ut-2-starts-from-15-nov-2025-1', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2026-01-21 10:53:35', '', '', '', '', '0000-00-00', '0', NULL),
(4, 30, 'notice', 'ut-2-starts-from-15-nov-2025-2', 'read/ut-2-starts-from-15-nov-2025-2', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2026-01-21 10:53:35', '', '', '', '', '0000-00-00', '0', NULL),
(5, 30, 'notice', 'ut-2-starts-from-15-nov-2025-3', 'read/ut-2-starts-from-15-nov-2025-3', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2026-01-21 10:53:35', '', '', '', '', '0000-00-00', '0', NULL),
(6, 30, 'notice', 'ut-2-starts-from-15-nov-2025-4', 'read/ut-2-starts-from-15-nov-2025-4', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2026-01-21 10:53:35', '', '', '', '', '0000-00-00', '0', NULL),
(7, 30, 'notice', 'ut-2-starts-from-15-nov-2025-5', 'read/ut-2-starts-from-15-nov-2025-5', 'UT-2 Starts from 15-Nov-2025', '2025-11-07', NULL, NULL, NULL, '<p>UT-2 Starts from 15-Nov-2025</p>', 'no', '2026-01-21 10:53:35', '', '', '', '', '0000-00-00', '0', NULL);

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
  `header_phone` varchar(50) DEFAULT NULL,
  `header_email` varchar(100) DEFAULT NULL,
  `header_address` text DEFAULT NULL,
  `header_button_enable` int(1) NOT NULL DEFAULT 0 COMMENT '0=Not active, 1= Active',
  `header_button_text` varchar(255) DEFAULT NULL,
  `header_button_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `front_cms_settings`
--

INSERT INTO `front_cms_settings` (`id`, `theme`, `is_active_rtl`, `is_active_front_cms`, `is_active_sidebar`, `logo`, `contact_us_email`, `complain_form_email`, `sidebar_options`, `whatsapp_url`, `fb_url`, `twitter_url`, `youtube_url`, `google_plus`, `instagram_url`, `pinterest_url`, `linkedin_url`, `google_analytics`, `footer_text`, `fav_icon`, `header_phone`, `header_email`, `header_address`, `header_button_enable`, `header_button_text`, `header_button_url`, `created_at`) VALUES
(1, NULL, NULL, 1, NULL, './uploads/school_content/logo/front_logo-69d9e4f7b7f016.93055336.jpg', NULL, NULL, '[]', '', '', '', '', '', '', '', '', NULL, 'All Right Reserved @ St. Stephen International School', './uploads/school_content/logo/front_fav_icon-69d9e4f7b816d3.89539732.jpg', '9876543210', 'demomail@gmail.com', 'School Address', 1, 'Admission Online Apply ', NULL, '2026-04-11 06:06:47');

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
  `session_id` int(11) DEFAULT NULL,
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

INSERT INTO `grades` (`id`, `session_id`, `exam_type`, `name`, `point`, `mark_from`, `mark_upto`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'basic_system', 'A', 0.0, 100.00, 91.00, '', 'no', '2026-06-03 14:35:14', NULL),
(2, 1, 'basic_system', 'B', 0.0, 90.00, 81.00, '', 'no', '2026-06-03 14:35:31', NULL);

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
  `session_id` int(11) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `income_head`
--

CREATE TABLE `income_head` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
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

INSERT INTO `income_head` (`id`, `session_id`, `income_category`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Fees Collection', 'Fees Collection', 'yes', 'no', '2026-06-03 07:35:31', NULL),
(2, 2, 'Fees Collection', 'Fees Collection', 'yes', 'no', '2026-06-04 02:00:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `item_category` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'yes',
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_issue`
--

CREATE TABLE `item_issue` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
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
  `session_id` int(11) DEFAULT NULL,
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
  `session_id` int(11) DEFAULT NULL,
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
  `session_id` int(11) DEFAULT NULL,
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
  `session_id` int(11) DEFAULT NULL,
  `type` varchar(200) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `session_id` int(11) DEFAULT NULL,
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
(1, 'New Record inserted On sections id 1', 1, 1, 'Insert', '103.68.21.69', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:38:08', NULL),
(2, 'New Record inserted On subject groups id 1', 1, 1, 'Insert', '103.68.21.69', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:38:15', NULL),
(3, 'New Record inserted On  fee groups id 1', 1, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:43:44', NULL),
(4, 'New Record inserted On account id 1', 1, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:44:24', NULL),
(5, 'New Record inserted On account id 2', 2, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:44:37', NULL),
(6, 'Record deleted On account id 2', 2, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:44:44', NULL),
(7, 'Record deleted On account id 1', 1, 1, 'Delete', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:44:47', NULL),
(8, 'New Record inserted On account id 3', 3, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:45:05', NULL),
(9, 'New Record inserted On account id 4', 4, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:45:13', NULL),
(10, 'New Record inserted On account id 5', 5, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:45:20', NULL),
(11, 'New Record inserted On account id 6', 6, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:45:32', NULL),
(12, 'New Record inserted On school houses id 22', 22, 1, 'Insert', '103.68.21.88', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:51:28', NULL),
(13, 'New Record inserted On subjects id 1', 1, 1, 'Insert', '103.68.21.88', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:51:43', NULL),
(14, 'New Record inserted On subjects id 2', 2, 1, 'Insert', '103.68.21.88', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:51:54', NULL),
(15, 'New Record inserted On subjects id 3', 3, 1, 'Insert', '103.68.21.88', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:52:04', NULL),
(16, 'New Record inserted On subject groups id 1', 1, 1, 'Insert', '103.68.21.88', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 17:52:39', NULL),
(17, 'New Record inserted On students id 1', 1, 1, 'Insert', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:24:26', NULL),
(18, 'New Record inserted On  student session id 4110', 4110, 1, 'Insert', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:24:26', NULL),
(19, 'New Record inserted On users id 1', 1, 1, 'Insert', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:24:26', NULL),
(20, 'New Record inserted On users id 2', 2, 1, 'Insert', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:24:26', NULL),
(21, 'Record updated On students id 1', 1, 1, 'Update', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:24:26', NULL),
(22, 'Record updated On students id 1', 1, 1, 'Update', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:24:26', NULL),
(23, 'Record updated On students id 1', 1, 1, 'Update', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:24:42', NULL),
(24, 'Record updated On  student session id 4110', 4110, 1, 'Update', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:24:42', NULL),
(25, 'New Record inserted On students id 2', 2, 1, 'Insert', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:27:09', NULL),
(26, 'New Record inserted On users id 3', 3, 1, 'Insert', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:27:09', NULL),
(27, 'New Record inserted On users id 4', 4, 1, 'Insert', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:27:09', NULL),
(28, 'Record updated On students id 2', 2, 1, 'Update', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:27:09', NULL),
(29, 'New Record inserted On  student session id 4111', 4111, 1, 'Insert', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:27:09', NULL),
(30, 'Record updated On students id 2', 2, 1, 'Update', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:27:58', NULL),
(31, 'Record updated On  student session id 4111', 4111, 1, 'Update', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:27:58', NULL),
(32, 'Record updated On students id 2', 2, 1, 'Update', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:29:40', NULL),
(33, 'Record updated On  student session id 4111', 4111, 1, 'Update', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:29:40', NULL),
(34, 'New Record inserted On disable reason id 1', 1, 1, 'Insert', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:30:32', NULL),
(35, 'Record updated On  student session id 4111', 4111, 1, 'Update', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:30:46', NULL),
(36, 'Record updated On users id 3', 3, 1, 'Update', '103.68.21.85', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:30:59', NULL),
(37, 'New Record inserted On exam groups id 1', 1, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:47:22', NULL),
(38, 'New Record inserted On exam groups id 2', 2, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:47:35', NULL),
(39, 'New Record inserted On exam group exams name id 1', 1, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:47:50', NULL),
(40, 'New Record inserted On exam group exams name id 2', 2, 1, 'Insert', '103.68.21.66', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:48:06', NULL),
(41, 'New Record inserted On exam groups id 1', 1, 1, 'Insert', '103.68.21.92', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:50:50', NULL),
(42, 'New Record inserted On exam group exams name id 3', 3, 1, 'Insert', '103.68.21.92', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:51:05', NULL),
(43, 'New Record inserted On exam group exams name id 4', 4, 1, 'Insert', '103.68.21.92', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:51:16', NULL),
(44, 'New Record inserted On  marksheets id 2', 2, 1, 'Insert', '103.68.21.68', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 19:59:04', NULL),
(45, 'Record updated On  marksheets id 2', 2, 1, 'Update', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 20:01:27', NULL),
(46, 'Record updated On  marksheets id 2', 2, 1, 'Update', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 20:02:44', NULL),
(47, 'Record updated On  marksheets id 2', 2, 1, 'Update', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 20:03:42', NULL),
(48, 'New Record inserted On grades id 1', 1, 1, 'Update', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 20:05:14', NULL),
(49, 'New Record inserted On grades id 2', 2, 1, 'Update', '103.68.21.86', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 20:05:31', NULL),
(50, 'New Record inserted On exam groups id 2', 2, 1, 'Insert', '103.68.21.93', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 20:11:59', NULL),
(51, 'New Record inserted On exam group exams name id 5', 5, 1, 'Insert', '103.68.21.93', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 20:12:15', NULL),
(52, 'New Record inserted On exam group exams name id 6', 6, 1, 'Insert', '103.68.21.93', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 20:12:27', NULL),
(53, 'New Record inserted On  reportcard id 1', 1, 1, 'Insert', '103.68.21.81', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 20:15:27', NULL),
(54, 'New Record inserted On  fee groups id 2', 2, 1, 'Insert', '2402:8100:2e93:f535:38e9:c82a:85c4:66bc', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 22:37:06', NULL),
(55, 'New Record inserted On subject groups id 2', 2, 1, 'Insert', '2402:8100:2e93:f535:38e9:c82a:85c4:66bc', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 22:37:18', NULL),
(56, 'New Record inserted On sessions id 2', 2, 1, 'Insert', '2402:8100:2e93:f535:38e9:c82a:85c4:66bc', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 22:50:55', NULL),
(57, 'New Record inserted On move_students id 1', 1, 1, 'Insert', '2402:8100:2e93:f535:38e9:c82a:85c4:66bc', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 22:51:14', NULL),
(58, 'New Record inserted On move_students_category id 1', 1, 1, 'Insert', '2402:8100:2e93:f535:38e9:c82a:85c4:66bc', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-03 22:51:21', NULL),
(59, 'New Record inserted On sections id 2', 2, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(60, 'New Record inserted On subject groups id 3', 3, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(61, 'New Record inserted On subject groups id 4', 4, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(62, 'New Record inserted On school houses id 23', 23, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(63, 'New Record inserted On  fee groups id 3', 3, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(64, 'New Record inserted On  fee groups id 4', 4, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(65, 'New Record inserted On  student session id 4112', 4112, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(66, 'New Record inserted On  student session id 4113', 4113, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(67, 'New Record inserted On exam groups id 3', 3, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(68, 'New Record inserted On exam groups id 4', 4, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(69, 'New Record inserted On exam groups id 3', 3, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(70, 'New Record inserted On exam groups id 4', 4, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(71, 'New Record inserted On disable reason id 2', 2, NULL, 'Insert', '0.0.0.0', '', 'Unidentified User Agent', '2026-06-04 06:25:05', NULL),
(72, 'Record updated On students id 2', 2, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-04 14:03:01', NULL),
(73, 'Record updated On  student session id 4113', 4113, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-04 14:03:01', NULL),
(74, 'Record updated On  student session id 4113', 4113, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-04 15:14:58', NULL),
(75, 'Record updated On users id 3', 3, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-04 15:15:00', NULL),
(76, 'Record updated On students id 2', 2, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-04 15:15:15', NULL),
(77, 'Record updated On  student session id 4113', 4113, 1, 'Update', '103.68.21.77', 'Windows 10', 'Chrome 148.0.0.0', '2026-06-04 15:15:15', NULL);

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
-- Table structure for table `move_students`
--

CREATE TABLE `move_students` (
  `id` int(11) NOT NULL,
  `batch_id` varchar(100) NOT NULL,
  `current_session_id` int(11) NOT NULL,
  `current_class_id` int(11) NOT NULL,
  `next_session_id` int(11) NOT NULL,
  `next_class_id` int(11) NOT NULL COMMENT '0=Passout',
  `discontinue_next_session` tinyint(1) DEFAULT NULL,
  `carry_zero_balance` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=add to list, 1=Submit for cron, 2=move completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `move_students`
--

INSERT INTO `move_students` (`id`, `batch_id`, `current_session_id`, `current_class_id`, `next_session_id`, `next_class_id`, `discontinue_next_session`, `carry_zero_balance`, `status`) VALUES
(1, 'O4G7CT', 1, 1, 2, 2, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `move_students_category`
--

CREATE TABLE `move_students_category` (
  `id` int(11) NOT NULL,
  `batch_id` varchar(100) NOT NULL,
  `current_session_id` int(11) NOT NULL,
  `current_category_id` int(11) NOT NULL,
  `next_category_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=add to list, 1=Submit for cron,'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `move_students_category`
--

INSERT INTO `move_students_category` (`id`, `batch_id`, `current_session_id`, `current_category_id`, `next_category_id`, `status`) VALUES
(1, 'O4G7CT', 1, 1, 2, 2);

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
(1, 1, 'Package List', 'package_list', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(2, 1, 'Quick Session Change', 'quick_session_change', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(3, 1, 'School Registration', 'school_registration', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(4, 1, 'Subscription Details', 'subscription_details', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(5, 1, 'Invoice Details', 'invoice_details', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(6, 2, 'Add Section', 'add_section', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(7, 2, 'Add Class', 'add_class', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(8, 2, 'Fee Category', 'fee_category', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(9, 2, 'Create Account', 'create_account', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(10, 2, 'Fee Head', 'fee_head', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(11, 2, 'Fee Plan', 'fee_plan', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(12, 2, 'Create Route', 'create_route', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(13, 2, 'Route Plan', 'route_plan', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(14, 2, 'Set Discount', 'set_discount', 1, 0, 1, 1, '2026-04-05 09:37:33'),
(15, 2, 'Caste Category', 'caste_category', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(16, 2, 'Payment Mode', 'payment_mode', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(17, 2, 'Student House', 'student_house', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(18, 2, 'Add Vehicles', 'add_vehicles', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(19, 2, 'Assign Vehicle', 'assign_vehicle', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(20, 2, 'Add Subjects', 'add_subjects', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(21, 2, 'Subject Group', 'subject_group', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(22, 2, 'Class Timetable', 'class_timetable', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(23, 2, 'Teachers Timetable', 'teachers_timetable', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(24, 2, 'Assign Class Teacher', 'assign_class_teacher', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(25, 2, 'Promote Students', 'promote_students', 1, 1, 0, 0, '2026-04-05 09:37:33'),
(26, 2, 'Set Disable Reason', 'set_disable_reason', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(27, 2, 'Previous Session Balance', 'previous_session_balance', 1, 0, 1, 0, '2026-04-05 09:37:33'),
(28, 2, 'Change Session', 'change_session', 1, 1, 0, 0, '2026-04-05 09:37:33'),
(29, 3, 'Setup Front Office', 'setup_front_office', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(30, 3, 'Admission Enquiry', 'admission_enquiry', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(31, 3, 'Follow Up Admission Enq', 'follow_up_admission_enq', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(32, 3, 'Visitor Book', 'visitor_book', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(33, 3, 'Phone Call Log', 'phone_call_log', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(34, 3, 'Postal Dispatch', 'postal_dispatch', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(35, 3, 'Postal Receive', 'postal_receive', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(36, 3, 'Complain', 'complain', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(37, 3, 'All Reports', 'front_desk_all_reports', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(38, 4, 'New Admission', 'new_admission', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(39, 4, 'Import Admission', 'import_admission', 0, 1, 0, 0, '2026-04-05 09:37:33'),
(40, 4, 'Online Admission', 'online_admission', 1, 0, 1, 1, '2026-04-05 09:37:33'),
(41, 4, 'Student Full Details', 'student_full_details', 1, 0, 1, 0, '2026-04-05 09:37:33'),
(42, 4, 'Discountinue Students', 'discountinue_students', 1, 1, 1, 0, '2026-04-05 09:37:33'),
(43, 4, 'Bulk Delete', 'bulk_delete', 1, 0, 0, 1, '2026-04-05 09:37:33'),
(44, 4, 'Bulk Upload', 'bulk_upload', 1, 1, 0, 0, '2026-04-05 09:37:33'),
(45, 4, 'Student Timeline', 'student_timeline', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(46, 4, 'All Reports', 'admission_all_reports', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(47, 5, 'Collect Fee', 'collect_fee', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(48, 5, 'Collect Fee List', 'collect_fee_list', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(49, 5, 'Assign Discount', 'assign_discount', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(50, 5, 'Receipt Book', 'receipt_book', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(51, 5, 'Fee Register', 'fee_register', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(52, 5, 'Fee Card', 'fee_card', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(53, 5, 'Defaulter List', 'defaulter_list', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(54, 5, 'Reminder Letter', 'reminder_letter', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(55, 5, 'Delete Fee List', 'delete_fee_list', 1, 0, 1, 1, '2026-04-05 09:37:33'),
(56, 5, 'Search Fee Slip', 'search_fee_slip', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(57, 5, 'Student Ledger', 'student_ledger', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(58, 5, 'All Reports', 'fee_all_reports', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(59, 6, 'Department', 'department', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(60, 6, 'Designation', 'designation', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(61, 6, 'Add Staff', 'staff', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(62, 6, 'Staff Attendance', 'staff_attendance', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(63, 6, 'Payroll', 'staff_payroll', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(64, 6, 'Approve Leave Request', 'approve_leave_request', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(65, 6, 'Apply Leave', 'apply_leave', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(66, 6, 'Leave Type', 'leave_types', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(67, 6, 'Teachers Rateing', 'teachers_rating', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(68, 6, 'Staff Timeline', 'staff_timeline', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(69, 6, 'Disabled Staff', 'disabled_staff', 1, 0, 1, 0, '2026-04-05 09:37:33'),
(70, 6, 'All Report', 'staff_management_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(71, 7, 'Student Attendance', 'student_attendance', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(72, 7, 'Attendance By Date', 'attendance_by_date', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(73, 7, 'Approve Leave', 'approve_leave', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(74, 7, 'Add Leave', 'add_leave', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(75, 7, 'All Reports', 'attendance_section_reports', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(76, 8, 'Online Exam', 'online_exam', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(77, 8, 'Add Question Paper', 'question_paper', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(78, 8, 'Assign / View Students', 'online_assign_view_student', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(79, 8, 'Import Questions', 'import_question', 1, 1, 0, 0, '2026-04-05 09:37:33'),
(80, 8, 'All Reports', 'online_exam_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(81, 9, 'Create Terms', 'create_terms', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(82, 9, 'Add Exam', 'add_exam', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(83, 9, 'Link Exam', 'link_exam', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(84, 9, 'Publish', 'publish', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(85, 9, 'Publish Result', 'publish_result', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(86, 9, 'Assign / View Students', 'exam_assign_view_student', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(87, 9, 'Assign Subjects', 'exam_subject', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(88, 9, 'Enter Marks', 'exam_marks', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(89, 9, 'Import Marks', 'marks_import', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(90, 9, 'Co-Scholastic Areas', 'co_scholastic_areas', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(91, 9, 'Assign Skills', 'assign_skills', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(92, 9, 'Publish', 'co_publish', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(93, 9, 'Publish Result', 'co_publish_result', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(94, 9, 'Assign / View Students', 'co_assign_view_students', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(95, 9, 'Add Grade', 'add_grade', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(96, 9, 'Import Grade', 'import_grade', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(97, 9, 'Exam Result', 'exam_result', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(98, 9, 'Design Admit Card', 'design_admit_card', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(99, 9, 'Print Admit Card', 'print_admit_card', 1, 1, 0, 0, '2026-04-05 09:37:33'),
(100, 9, 'Design Marksheet', 'design_marksheet', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(101, 9, 'Print Marksheet', 'print_marksheet', 1, 1, 0, 0, '2026-04-05 09:37:33'),
(102, 9, 'Design Report Card', 'design_report_card', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(103, 9, 'Print Report Card', 'print_report_card', 1, 1, 0, 0, '2026-04-05 09:37:33'),
(104, 9, 'Marks Grade', 'marks_grade', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(105, 9, 'All Reports', 'exam_section_reports', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(106, 10, 'Manage Lesson Plan', 'manage_lesson_plan', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(107, 10, 'Manage Syllabus Status', 'manage_syllabus_status', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(108, 10, 'Lesson', 'lesson', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(109, 10, 'Topic', 'topic', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(110, 10, 'All Report', 'lesson_plan_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(111, 11, 'Add Homework', 'add_homework', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(112, 11, 'Homework Evaluation', 'homework_evaluation', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(113, 11, 'All Report', 'homework_section_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(114, 12, 'Upload Section', 'upload_section', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(115, 12, 'Assignment', 'assignment', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(116, 12, 'Study Material', 'study_material', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(117, 12, 'Syllabus', 'syllabus', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(118, 12, 'Other Download', 'other_download', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(119, 12, 'All Report', 'download_section_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(120, 13, 'Notice Board', 'notice_board', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(121, 13, 'Update Events', 'update_events', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(122, 13, 'Update News', 'update_news', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(123, 13, 'Send Email', 'send_email', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(124, 13, 'Send SMS', 'send_sms', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(125, 13, 'Send Whatsapp', 'send_whatsapp', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(126, 13, 'Email / SMS Log', 'email_sms_log', 0, 1, 0, 0, '2026-04-05 09:37:33'),
(127, 13, 'All Report', 'message_section_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(128, 14, 'Student Certificate', 'student_certificate', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(129, 14, 'Generate Certificate', 'generate_certificate', 1, 1, 0, 0, '2026-04-05 09:37:33'),
(130, 14, 'Student ID Card', 'student_id_card', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(131, 14, 'Generate ID Card', 'generate_id_card', 1, 1, 0, 0, '2026-04-05 09:37:33'),
(132, 14, 'Staff ID Card', 'staff_id_card', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(133, 14, 'Generate Staff ID Card', 'generate_staff_id_card', 1, 1, 0, 0, '2026-04-05 09:37:33'),
(134, 14, 'Design TC', 'design_tc', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(135, 14, 'Print TC', 'print_tc', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(136, 14, 'All Reports', 'certificate_section_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(137, 15, 'Book List', 'book_list', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(138, 15, 'Issue Return', 'issue_return', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(139, 15, 'Add Student', 'add_student', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(140, 15, 'Add Staff Member', 'add_staff_member', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(141, 15, 'Import Book', 'import_book', 1, 1, 1, 0, '2026-04-05 09:37:33'),
(142, 15, 'All Report', 'library_management_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(143, 16, 'Income Heads', 'income_heads', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(144, 16, 'Add Income', 'add_income', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(145, 16, 'Income Report', 'search_income', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(146, 17, 'Expense Head', 'expense_head', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(147, 17, 'Add Expense', 'add_expense', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(148, 17, 'Expense Report', 'search_expense', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(149, 18, 'Item Category', 'item_category', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(150, 18, 'Add Item', 'item', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(151, 18, 'Add Item Stock', 'item_stock', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(152, 18, 'Issue Item', 'issue_item', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(153, 18, 'Item Store', 'store', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(154, 18, 'Item Supplier', 'supplier', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(155, 18, 'All Report', 'stock_management_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(156, 19, 'Front Web Settings', 'front_cms_setting', 1, 0, 1, 0, '2026-04-05 09:37:33'),
(157, 19, 'Add Webs Links', 'add_webs_links', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(158, 19, 'Media Manager', 'media_manager', 1, 1, 0, 1, '2026-04-05 09:37:33'),
(159, 19, 'Banner Image', 'banner_image', 1, 1, 0, 1, '2026-04-05 09:37:33'),
(160, 20, 'Create Ticket', 'create_ticket', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(161, 20, 'Track Ticket', 'track_ticket', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(162, 20, 'Closed Ticket', 'closed_ticket', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(163, 20, 'All Report', 'ticket_section_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(164, 21, 'General Setting', 'general_setting', 1, 1, 1, 0, '2026-04-05 09:37:33'),
(165, 21, 'Session Setting', 'session_setting', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(166, 21, 'Notification Setting', 'notification_setting', 1, 0, 1, 0, '2026-04-05 09:37:33'),
(167, 21, 'SMS Setting', 'sms_setting', 1, 0, 1, 0, '2026-04-05 09:37:33'),
(168, 21, 'Email Setting', 'email_setting', 1, 0, 1, 0, '2026-04-05 09:37:33'),
(169, 21, 'Payment Method', 'payment_methods', 1, 1, 1, 0, '2026-04-05 09:37:33'),
(170, 21, 'Print Header Footer', 'print_header_footer', 1, 1, 1, 0, '2026-04-05 09:37:33'),
(171, 21, 'Roles Permission', 'roles_permissions', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(172, 21, 'User', 'user_status', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(173, 21, 'Modules', 'modules', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(174, 21, 'Custom Fields', 'custom_fields', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(175, 21, 'System Fields', 'system_fields', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(176, 21, 'File Types', 'file_types', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(177, 21, 'Set Captcha', 'set_captcha', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(178, 21, 'Data Backup', 'data_backup', 1, 1, 0, 1, '2026-04-05 09:37:33'),
(179, 22, 'Add Branch', 'add_branch', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(180, 22, 'Overview', 'overview', 1, 1, 1, 1, '2026-04-05 09:37:33'),
(181, 22, 'Switch Branch', 'switch_branch', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(182, 22, 'All Report', 'multi_branch_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(183, 23, 'User Log', 'user_log', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(184, 23, 'Audit Trail Report', 'audit_trail_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(185, 23, 'Income Expense Report', 'income_expense_report', 1, 0, 0, 0, '2026-04-05 09:37:33'),
(186, 24, 'Monthly Fees Collection Widget', 'monthly_fees_collection_widget', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(187, 24, 'Monthly Expense Widget', 'monthly_expense_widget', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(188, 24, 'Student Count Widget', 'student_count_widget', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(189, 24, 'Staff Role Count Widget', 'staff_role_count_widget', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(190, 24, 'Fees Awaiting Payment Widgets', 'fees_awaiting_payment_widgets', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(191, 24, 'Converted Leads Widgets', 'converted_leads_widgets', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(192, 24, 'Fees Overview Widgets', 'fees_overview_widgets', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(193, 24, 'Enquiry Overview Widgets', 'enquiry_overview_widgets', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(194, 24, 'Library Overview Widgets', 'library_overview_widgets', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(195, 24, 'Student Today Attendance Widgets', 'student_today_attendance_widgets', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(196, 24, 'Income Donut Graph', 'income_donut_graph', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(197, 24, 'Expense Donut Graph', 'expense_donut_graph', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(198, 24, 'Staff Present Today Widgets', 'staff_present_today_widgets', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(199, 24, 'Student Present Today Widgets', 'student_present_today_widgets', 0, 0, 0, 0, '2026-04-05 09:37:33'),
(200, 25, '', '', 0, 0, 0, 0, '2026-04-05 09:37:33');

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
(1, 'Software Subscription', 'software_subscription', 1, 0, '2026-05-07 14:16:29'),
(2, 'Set Master', 'set_master', 1, 0, '2026-04-05 09:37:33'),
(3, 'Front Desk', 'front_desk', 1, 0, '2026-04-05 09:37:33'),
(4, 'Admission Section', 'admission_section', 1, 0, '2026-04-05 09:37:33'),
(5, 'Fee Collection', 'fee_collection', 1, 0, '2026-04-05 09:37:33'),
(6, 'Staff Management', 'staff_management', 1, 0, '2026-04-05 09:37:33'),
(7, 'Attendance Section', 'attendance_section', 1, 0, '2026-04-05 09:37:33'),
(8, 'Online Exam Section', 'online_exam_section', 1, 0, '2026-04-05 09:37:33'),
(9, 'Exam Section', 'exam_section', 1, 0, '2026-04-05 09:37:33'),
(10, 'Lesson Plan', 'lesson_plan', 1, 0, '2026-04-05 09:37:33'),
(11, 'Homework Section', 'homework_section', 1, 0, '2026-04-05 09:37:33'),
(12, 'Download Section', 'download_section', 1, 0, '2026-04-05 09:37:33'),
(13, 'Message Section', 'message_section', 1, 0, '2026-04-05 09:37:33'),
(14, 'Certificate Section', 'certificate_section', 1, 0, '2026-04-05 09:37:33'),
(15, 'Library Management', 'library_management', 1, 0, '2026-04-05 09:37:33'),
(16, 'Income Section', 'income_section', 1, 0, '2026-04-05 09:37:33'),
(17, 'Expense Section', 'expense_section', 1, 0, '2026-04-05 09:37:33'),
(18, 'Stock Management', 'stock_management', 1, 0, '2026-04-05 09:37:33'),
(19, 'Front Web', 'front_web', 1, 0, '2026-04-05 09:37:33'),
(20, 'Ticket Section', 'ticket_section', 1, 0, '2026-04-05 09:37:33'),
(21, 'System Setting', 'system_setting', 1, 0, '2026-04-05 09:37:33'),
(22, 'Multi Branch', 'multi_branch', 1, 0, '2026-04-05 09:37:33'),
(23, 'Overall Reports', 'overall_reports', 1, 0, '2026-04-05 09:37:33'),
(24, 'Dashboard Management', 'dashboard_management', 1, 1, '2026-04-05 09:37:33'),
(25, 'Chat', 'chat', 1, 1, '2026-04-05 09:37:33');

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
(1, 'Fees', 'fees', 0, 1, 1, 2, '2026-01-27 09:49:43'),
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
(16, 'Teachers Rating', 'teachers_rating', 0, 1, 1, 0, '2026-05-07 09:32:36'),
(17, 'Chat', 'chat', 0, 1, 1, 25, '2025-11-16 06:28:42'),
(18, 'Multi Class', 'multi_class', 1, 1, 1, 26, '2025-11-16 06:28:46'),
(19, 'Lesson Plan', 'lesson_plan', 0, 1, 1, 29, '2025-11-16 06:28:52'),
(20, 'Syllabus Status', 'syllabus_status', 0, 1, 1, 29, '2025-11-16 06:28:52'),
(23, 'Apply Leave', 'apply_leave', 0, 1, 1, 0, '2026-05-07 09:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `print_headerfooter`
--

CREATE TABLE `print_headerfooter` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `print_type` varchar(255) NOT NULL,
  `header_image` varchar(255) NOT NULL,
  `footer_content` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `session_id` int(11) DEFAULT NULL,
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
  `month_total` varchar(200) DEFAULT NULL,
  `previous_balance` float(10,2) DEFAULT NULL,
  `remaining_previous_balance` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `session_id`, `receipt_no`, `student_id`, `months`, `fee_head`, `fee_head_type`, `fee_head_name`, `balance_amount`, `total`, `rec_discount`, `rec_amount`, `fees_received`, `late_fees`, `ledger_amt`, `total_fees`, `discount_amt`, `net_fees`, `receipt_amt`, `balance_amt`, `mode`, `remarks`, `created_at`, `date_time`, `back_id`, `sr_no`, `create_by`, `total_month`, `month_total`, `previous_balance`, `remaining_previous_balance`) VALUES
(1, 1, '2025-2026/1', 1, '', '', '', 'Ledger Amount', '2000', '2000', '0', '10000', '2000', '', '10000.00', '10000', '0', '10000', '2000', '8000.00', 'Online', '', '2026-06-03 14:05:31', '2025-04-03', '4110', 1, 'login@easyskool.in', NULL, NULL, 0.00, 0.00),
(2, 1, '2025-2026/2', 2, 'Apr', '1', 'fees', 'Admission Fee', '0', '1000', '0', '1000', '2000', '', '10000', '12000', '0', '12000', '3000', '9000.00', 'Cash', '', '2026-06-03 14:09:59', '2025-04-05', '4111', 2, 'login@easyskool.in', 1, '1000.00', 0.00, 0.00),
(3, 1, '2025-2026/2', 2, 'Apr', '2', 'fees', 'Reg. Fee', '0', '500', '0', '500', '2000', '', '10000', '12000', '0', '12000', '3000', '9000.00', 'Cash', '', '2026-06-03 14:09:59', '2025-04-05', '4111', 2, 'login@easyskool.in', 1, '500.00', 0.00, 0.00),
(4, 1, '2025-2026/2', 2, 'Apr', '3', 'fees', 'Tuition Fee', '0', '500', '0', '500', '2000', '', '10000', '12000', '0', '12000', '3000', '9000.00', 'Cash', '', '2026-06-03 14:09:59', '2025-04-05', '4111', 2, 'login@easyskool.in', 1, '500.00', 0.00, 0.00),
(6, 2, '2026-2027/2', 2, '', '', '', 'Ledger Amount', '2000', '2000', '0', '5000', '2000', '', '5000.00', '5000', '0', '5000', '2000', '3000.00', 'Online', '', '2026-06-04 08:33:30', '2026-06-04', '4113', 2, 'login@easyskool.in', NULL, NULL, 500.00, 14000.00);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_sr_no`
--

CREATE TABLE `receipt_sr_no` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `sr_no` bigint(20) DEFAULT NULL,
  `deleted_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Active(Not delete), 1=Permanent Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipt_sr_no`
--

INSERT INTO `receipt_sr_no` (`id`, `session_id`, `sr_no`, `deleted_status`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 2, 1, 1),
(4, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `received_previous_balance`
--

CREATE TABLE `received_previous_balance` (
  `id` int(11) NOT NULL,
  `previous_student_session_id` int(11) DEFAULT NULL COMMENT 'student_session table id (previous id)',
  `receipt_no` varchar(255) DEFAULT NULL,
  `amount` float(10,2) DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Deleted, 1=Active',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `received_previous_balance`
--

INSERT INTO `received_previous_balance` (`id`, `previous_student_session_id`, `receipt_no`, `amount`, `status`, `created_at`) VALUES
(1, 0, '2025-2026/1', 0.00, 1, '2026-06-03 19:35:31'),
(2, 0, '2025-2026/2', 0.00, 1, '2026-06-03 19:39:59'),
(4, 4111, '2026-2027/2', 500.00, 1, '2026-06-04 14:03:30');

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
  `session_id` int(11) DEFAULT NULL,
  `fees_heading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frequency` enum('Annual','Quarterly','Monthly') NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `months` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`months`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route_head`
--

INSERT INTO `route_head` (`id`, `session_id`, `fees_heading`, `frequency`, `account_name`, `months`, `created_at`) VALUES
(1, 1, 'Shamli', 'Monthly', 'Transport Fee', '[\"Apr\",\"May\",\"Jul\",\"Aug\",\"Sep\",\"Oct\",\"Nov\",\"Dec\",\"Jan\",\"Feb\",\"Mar\"]', '2026-06-03 12:20:20'),
(2, 2, 'Shamli', 'Monthly', 'Transport Fee', '[\"Apr\",\"May\",\"Jul\",\"Aug\",\"Sep\",\"Oct\",\"Nov\",\"Dec\",\"Jan\",\"Feb\",\"Mar\"]', '2026-06-04 06:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `route_plan`
--

CREATE TABLE `route_plan` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `fee_group_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `class_ids` text NOT NULL,
  `category_ids` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route_plan`
--

INSERT INTO `route_plan` (`id`, `session_id`, `fee_group_id`, `amount`, `class_ids`, `category_ids`, `created_at`) VALUES
(1, 1, 1, 500.00, '[\"1\"]', '[\"1\"]', '2026-06-03 12:20:31'),
(2, 2, 2, 500.00, '[\"3\",\"4\"]', '[\"3\",\"4\"]', '2026-06-04 06:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `school_houses`
--

CREATE TABLE `school_houses` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `house_name` varchar(200) NOT NULL,
  `description` varchar(400) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `school_houses`
--

INSERT INTO `school_houses` (`id`, `session_id`, `house_name`, `description`, `is_active`) VALUES
(22, 1, 'Raman House', 'Raman House', 'yes'),
(23, 2, 'Raman House', '', 'yes');

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
  `alternate_no` varchar(50) DEFAULT NULL,
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
  `gender` int(11) NOT NULL DEFAULT 1,
  `dob` int(11) NOT NULL DEFAULT 1,
  `pen_no` int(11) NOT NULL DEFAULT 1,
  `aadhar_no` int(11) NOT NULL DEFAULT 1,
  `other_no` int(11) NOT NULL DEFAULT 1,
  `student_photo` int(11) NOT NULL DEFAULT 1,
  `student_height` int(11) NOT NULL DEFAULT 1,
  `student_weight` int(11) NOT NULL DEFAULT 1,
  `measurement_date` int(11) NOT NULL DEFAULT 1,
  `father_name` int(11) NOT NULL DEFAULT 1,
  `father_phone` int(11) NOT NULL DEFAULT 1,
  `father_occupation` int(11) NOT NULL DEFAULT 1,
  `father_pic` int(11) NOT NULL DEFAULT 1,
  `father_pan` int(11) NOT NULL DEFAULT 1,
  `father_aadhar_no` int(11) NOT NULL DEFAULT 1,
  `father_other_no` int(11) NOT NULL DEFAULT 1,
  `father_id_no` int(11) NOT NULL DEFAULT 1,
  `mother_name` int(11) NOT NULL DEFAULT 1,
  `mother_phone` int(11) NOT NULL DEFAULT 1,
  `mother_occupation` int(11) NOT NULL DEFAULT 1,
  `mother_pic` int(11) NOT NULL DEFAULT 1,
  `mother_pan` int(11) NOT NULL DEFAULT 1,
  `mother_aadhar_no` int(11) NOT NULL DEFAULT 1,
  `mother_other_no` int(11) NOT NULL DEFAULT 1,
  `mother_id_no` int(11) NOT NULL DEFAULT 1,
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
  `legder_amount` int(11) NOT NULL DEFAULT 1,
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
  `main_domain_url` tinytext NOT NULL,
  `app_primary_color_code` varchar(20) DEFAULT NULL,
  `app_secondary_color_code` varchar(20) DEFAULT NULL,
  `app_logo` varchar(250) DEFAULT NULL,
  `student_profile_edit` int(11) NOT NULL DEFAULT 0,
  `start_week` varchar(10) NOT NULL,
  `my_question` int(11) NOT NULL,
  `rcpt_admission_no` int(11) NOT NULL DEFAULT 1,
  `rcpt_student_name` int(11) NOT NULL DEFAULT 1,
  `rcpt_photo` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_father` int(11) NOT NULL DEFAULT 1,
  `rcpt_class_section` int(11) NOT NULL DEFAULT 1,
  `rcpt_fee_months` int(11) NOT NULL DEFAULT 1,
  `rcpt_mother` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_dob` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_mobile_no` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_address` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_total_amt` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_late_fee` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_discount_amt` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_net_amt` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_received_amt` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_balance_amt` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_amt_in_words` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_pay_mode` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_remark` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_created_by` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_note` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_common_header` tinyint(1) NOT NULL DEFAULT 1,
  `rcpt_header_height` int(10) NOT NULL,
  `rcpt_footer_height` int(10) NOT NULL,
  `domain_api_key` varchar(255) DEFAULT NULL,
  `book_no` varchar(50) DEFAULT NULL,
  `serial_no_prefix` varchar(50) DEFAULT NULL,
  `serial_no_suffix` int(11) DEFAULT NULL,
  `fee_receipt_print_mode` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Landscape, 2=Potrait',
  `fee_receipt_page_size` char(36) NOT NULL DEFAULT 'A4',
  `aff_no` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sch_settings`
--

INSERT INTO `sch_settings` (`id`, `name`, `biometric`, `biometric_device`, `email`, `phone`, `alternate_no`, `address`, `lang_id`, `languages`, `dise_code`, `date_format`, `time_format`, `currency`, `currency_symbol`, `is_rtl`, `is_duplicate_fees_invoice`, `timezone`, `session_id`, `cron_secret_key`, `currency_place`, `class_teacher`, `start_month`, `attendence_type`, `image`, `admin_logo`, `admin_small_logo`, `theme`, `fee_due_days`, `is_active`, `online_admission`, `is_blood_group`, `is_student_house`, `roll_no`, `category`, `religion`, `cast`, `mobile_no`, `student_email`, `admission_date`, `lastname`, `middlename`, `gender`, `dob`, `pen_no`, `aadhar_no`, `other_no`, `student_photo`, `student_height`, `student_weight`, `measurement_date`, `father_name`, `father_phone`, `father_occupation`, `father_pic`, `father_pan`, `father_aadhar_no`, `father_other_no`, `father_id_no`, `mother_name`, `mother_phone`, `mother_occupation`, `mother_pic`, `mother_pan`, `mother_aadhar_no`, `mother_other_no`, `mother_id_no`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_email`, `guardian_pic`, `guardian_occupation`, `guardian_address`, `current_address`, `permanent_address`, `route_list`, `legder_amount`, `hostel_id`, `bank_account_no`, `ifsc_code`, `bank_name`, `national_identification_no`, `local_identification_no`, `rte`, `previous_school_details`, `student_note`, `upload_documents`, `staff_designation`, `staff_department`, `staff_last_name`, `staff_father_name`, `staff_mother_name`, `staff_date_of_joining`, `staff_phone`, `staff_emergency_contact`, `staff_marital_status`, `staff_photo`, `staff_current_address`, `staff_permanent_address`, `staff_qualification`, `staff_work_experience`, `staff_note`, `staff_epf_no`, `staff_basic_salary`, `staff_contract_type`, `staff_work_shift`, `staff_work_location`, `staff_leaves`, `staff_account_details`, `staff_social_media`, `staff_upload_documents`, `mobile_api_url`, `main_domain_url`, `app_primary_color_code`, `app_secondary_color_code`, `app_logo`, `student_profile_edit`, `start_week`, `my_question`, `rcpt_admission_no`, `rcpt_student_name`, `rcpt_photo`, `rcpt_father`, `rcpt_class_section`, `rcpt_fee_months`, `rcpt_mother`, `rcpt_dob`, `rcpt_mobile_no`, `rcpt_address`, `rcpt_total_amt`, `rcpt_late_fee`, `rcpt_discount_amt`, `rcpt_net_amt`, `rcpt_received_amt`, `rcpt_balance_amt`, `rcpt_amt_in_words`, `rcpt_pay_mode`, `rcpt_remark`, `rcpt_created_by`, `rcpt_note`, `rcpt_common_header`, `rcpt_header_height`, `rcpt_footer_height`, `domain_api_key`, `book_no`, `serial_no_prefix`, `serial_no_suffix`, `fee_receipt_print_mode`, `fee_receipt_page_size`, `aff_no`, `created_at`, `updated_at`) VALUES
(1, 'DEMO MLPS', 0, '', 'mlps@gmail.com', '9897982328', NULL, 'Near Old HP Gas Agency, Banat, Shamli', 4, '[\"4\"]', 'SML-00132', 'd-m-Y', '12-hour', 'INR', 'Rs', 'disabled', 0, 'Asia/Kolkata', 1, '2o7PfLpUBrSkIvlQfeK75IDED', 'after_number', 'no', '4', 0, '1.jpg', '1.png', '1.png', 'default.jpg', 30, 'no', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '', 'https://www.easyskool.in/', '#424242', '#eeeeee', '1.png', 0, 'Monday', 0, 1, 1, 0, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 'a4140d4bc0281395e561492b6b864d19a62a5324c8c1cc3891ecdb3227da8489', '1', '1', 1, 2, 'A4', '213132', '2026-06-03 10:44:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sch_settings_session`
--

CREATE TABLE `sch_settings_session` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `receipt_sr_no` bigint(20) NOT NULL DEFAULT 0,
  `staffid_auto_insert` int(11) NOT NULL DEFAULT 0,
  `staffid_prefix` varchar(100) DEFAULT NULL,
  `staffid_start_from` varchar(50) DEFAULT NULL,
  `staffid_no_digit` int(11) DEFAULT NULL,
  `staffid_update_status` int(11) NOT NULL DEFAULT 0,
  `adm_auto_insert` int(11) NOT NULL DEFAULT 0,
  `adm_prefix` varchar(100) DEFAULT NULL,
  `adm_start_from` varchar(50) DEFAULT NULL,
  `adm_no_digit` int(11) DEFAULT NULL,
  `adm_update_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sch_settings_session`
--

INSERT INTO `sch_settings_session` (`id`, `session_id`, `receipt_sr_no`, `staffid_auto_insert`, `staffid_prefix`, `staffid_start_from`, `staffid_no_digit`, `staffid_update_status`, `adm_auto_insert`, `adm_prefix`, `adm_start_from`, `adm_no_digit`, `adm_update_status`) VALUES
(1, 30, 0, 0, '', '', 0, 1, 0, 'KGPS', '925', 3, 1),
(2, 35, 0, 0, '', '', 0, 1, 0, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section` varchar(60) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section`, `session_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'A', 1, 'no', '2026-06-03 12:08:08', NULL),
(2, 'A', 2, 'no', '2026-06-04 06:25:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `send_notification`
--

CREATE TABLE `send_notification` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
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
(1, '2025-2026', 'no', '2026-06-03 11:08:34', NULL),
(2, '2026-2027', 'no', '2026-06-03 17:20:55', NULL);

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
  `session_id` int(11) DEFAULT NULL,
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

INSERT INTO `staff` (`id`, `session_id`, `employee_id`, `lang_id`, `department`, `designation`, `qualification`, `work_exp`, `name`, `surname`, `father_name`, `mother_name`, `contact_no`, `emergency_contact_no`, `email`, `dob`, `marital_status`, `date_of_joining`, `date_of_leaving`, `local_address`, `permanent_address`, `note`, `image`, `password`, `gender`, `account_title`, `bank_account_no`, `bank_name`, `ifsc_code`, `bank_branch`, `payscale`, `basic_salary`, `epf_no`, `contract_type`, `shift`, `location`, `facebook`, `twitter`, `linkedin`, `instagram`, `resume`, `joining_letter`, `resignation_letter`, `other_document_name`, `other_document_file`, `user_id`, `is_active`, `verification_code`, `disable_at`) VALUES
(1, NULL, 'E01', 0, 13, 23, '', '', 'Mr. Your Name', '', '', '', '', '', 'login@easyskool.in', '1990-10-20', 'Married', '2000-01-01', '0000-00-00', '', '', '', '1.jpg', '$2y$10$cYIA/eGODyyRzuStBkXAM.JX4CD0OtNaQDZA4oWpfMHMkXuyp2XO6', 'Male', '', '', '', '', '', '', '', '', 'permanent', '', '', '', '', '', '', '', '', '', 'Other Document', '', 0, 1, 'bGhDY1pmcTQ2UWNsS2lEZkJjT0N5YndqR0NLOXk4UHBoSXNXaFVud0QzTT0=', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance`
--

CREATE TABLE `staff_attendance` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `staff_attendance_type_id` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `staff_designation`
--

CREATE TABLE `staff_designation` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `designation` varchar(200) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_id_card`
--

CREATE TABLE `staff_id_card` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
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
(1, 7, 1, 0, '2022-06-23 13:33:55', NULL);

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
  `blood_group` varchar(200) NOT NULL,
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

INSERT INTO `students` (`id`, `parent_id`, `admission_no`, `roll_no`, `admission_date`, `firstname`, `middlename`, `lastname`, `rte`, `image`, `mobileno`, `email`, `state`, `city`, `pincode`, `religion`, `cast`, `dob`, `gender`, `current_address`, `permanent_address`, `blood_group`, `hostel_room_id`, `adhar_no`, `samagra_id`, `bank_account_no`, `bank_name`, `ifsc_code`, `guardian_is`, `father_name`, `father_phone`, `father_occupation`, `mother_name`, `mother_phone`, `mother_occupation`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_occupation`, `guardian_address`, `guardian_email`, `father_pic`, `mother_pic`, `guardian_pic`, `is_active`, `previous_school`, `height`, `weight`, `measurement_date`, `dis_reason`, `note`, `dis_note`, `app_key`, `parent_app_key`, `disable_at`, `created_at`, `updated_at`, `cast_category`, `pan_no`, `aadhan_no`, `other_no`, `father_pan_no`, `father_aadhar_no`, `father_other_no`, `father_id_no`, `mother_pan_no`, `mother_aadhar_no`, `mother_other_no`, `mother_id_no`) VALUES
(1, 2, '01', '01', '2026-06-03', 'Rahul Kumar Sharma', '', '', 'No', 'uploads/student_images/1.jpg', '9897982348', '01@gmail.com', NULL, NULL, NULL, 'Hindu', 'Brahiman', '2020-01-20', 'Male', '', '', 'O+', 0, '', '', '', '', '', 'father', 'Rajpal Sharma', '', '', 'Seema', '', '', 'Rajpal', 'Father', '', '', '', '', '', '', '', 'yes', '', '5', '23', '2026-06-03', 0, NULL, '', NULL, NULL, '0000-00-00', '2026-06-03 13:54:42', NULL, 'GENERAL', 'PEN01', 'AADHAR01', 'OTHER01', '', '', '', '', '', '', '', ''),
(2, 4, '02', '1', '2026-06-03', 'Pintu Panwar', '', '', NULL, '', '', '', NULL, NULL, NULL, '', '', '2020-10-20', 'Male', '', '', '', 0, '', '', '', '', '', '', 'Ramkumar', '', '', 'Kela Devi', '', '', '', '', '', '', '', '', '', '', '', 'yes', '', '', '', '2026-06-03', 0, NULL, '', NULL, NULL, '0000-00-00', '2026-06-03 13:59:40', NULL, '', '', '', '', '', '', '', '', '', '', '', '');

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
  `previous_session_balance` float(10,2) NOT NULL DEFAULT 0.00,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `student_fees_master`
--

INSERT INTO `student_fees_master` (`id`, `is_system`, `student_session_id`, `fee_session_group_id`, `amount`, `previous_session_balance`, `is_active`, `created_at`) VALUES
(1, 1, 4110, 1, 21000.00, 21000.00, 'no', '2026-06-04 06:25:05'),
(2, 1, 4111, 1, 14500.00, 14500.00, 'no', '2026-06-04 08:48:03');

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
  `school_house_id` int(11) NOT NULL,
  `fee_category_id` int(11) DEFAULT NULL,
  `transport_fees` float(10,2) NOT NULL DEFAULT 0.00,
  `fees_discount` float(10,2) NOT NULL DEFAULT 0.00,
  `previous_session_balance` float(10,2) NOT NULL DEFAULT 0.00,
  `previous_student_session_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `disable_at` date DEFAULT NULL,
  `dis_reason` int(11) DEFAULT NULL,
  `dis_note` text DEFAULT NULL,
  `is_alumni` int(11) NOT NULL,
  `default_login` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `student_session`
--

INSERT INTO `student_session` (`id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `school_house_id`, `fee_category_id`, `transport_fees`, `fees_discount`, `previous_session_balance`, `previous_student_session_id`, `is_active`, `disable_at`, `dis_reason`, `dis_note`, `is_alumni`, `default_login`, `created_at`, `updated_at`) VALUES
(4110, 1, 1, 1, 1, 1, 22, 1, 0.00, 8000.00, 0.00, NULL, 'yes', NULL, NULL, NULL, 0, 0, '2026-06-03 14:05:31', NULL),
(4111, 1, 2, 1, 1, 0, 0, 1, 0.00, 9000.00, 0.00, NULL, 'yes', '2026-06-03', 1, '', 0, 0, '2026-06-03 14:09:59', NULL),
(4112, 2, 1, 4, 2, 2, 23, 4, 0.00, 0.00, 21000.00, 4110, 'yes', NULL, NULL, NULL, 0, 0, '2026-06-04 08:31:39', NULL),
(4113, 2, 2, 4, 2, 2, 0, 4, 0.00, 3000.00, 14000.00, 4111, 'yes', '2026-06-04', 2, 'gg', 0, 0, '2026-06-04 09:45:15', NULL);

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
  `session_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `type_one` varchar(100) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `session_id`, `name`, `code`, `type`, `type_one`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hindi', 'Hindi-001', 'theory', 'main', 'no', '2026-06-03 12:21:43', NULL),
(2, 1, 'English', 'English-001', 'theory', 'main', 'no', '2026-06-03 12:21:54', NULL),
(3, 1, 'Maths', 'Maths-001', 'theory', 'main', 'no', '2026-06-03 12:22:04', NULL);

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
(1, 'Class-1st', 'For Class 1st', 1, '2026-06-03 12:22:39');

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
(143, 1, 1, 1, NULL, 0, '2026-06-03 12:22:39', NULL);

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
(1, 1, 1, 1, '2026-06-03 12:22:39'),
(2, 1, 1, 2, '2026-06-03 12:22:39'),
(3, 1, 1, 3, '2026-06-03 12:22:39');

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
-- Table structure for table `tc_certificate_generates`
--

CREATE TABLE `tc_certificate_generates` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `session_id` int(11) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `template_designtc`
--

CREATE TABLE `template_designtc` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `certificate_name` varchar(255) NOT NULL,
  `fields_json` longtext DEFAULT NULL,
  `is_common_header` int(11) NOT NULL DEFAULT 0,
  `header_height` int(11) NOT NULL,
  `footer_height` int(11) NOT NULL,
  `left_sign` varchar(200) DEFAULT NULL,
  `middle_sign` varchar(200) DEFAULT NULL,
  `right_sign` varchar(200) DEFAULT NULL,
  `left_sign_title` varchar(255) DEFAULT NULL,
  `middle_sign_title` varchar(255) DEFAULT NULL,
  `right_sign_title` varchar(255) DEFAULT NULL,
  `is_class_teacher` int(11) NOT NULL DEFAULT 0,
  `is_examination_ic` int(11) NOT NULL DEFAULT 0,
  `is_principal` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `background_image` varchar(255) DEFAULT NULL,
  `is_show_date` tinyint(1) NOT NULL DEFAULT 0,
  `show_date` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_marksheets`
--

CREATE TABLE `template_marksheets` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `template` varchar(200) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `left_sign` varchar(200) DEFAULT NULL,
  `middle_sign` varchar(200) DEFAULT NULL,
  `right_sign` varchar(200) DEFAULT NULL,
  `left_sign_title` varchar(255) DEFAULT NULL,
  `middle_sign_title` varchar(255) DEFAULT NULL,
  `right_sign_title` varchar(255) DEFAULT NULL,
  `is_class_teacher` int(11) NOT NULL DEFAULT 0,
  `is_examination_ic` int(11) NOT NULL DEFAULT 0,
  `is_principal` int(11) NOT NULL DEFAULT 0,
  `background_image` varchar(200) DEFAULT NULL,
  `is_name` int(11) DEFAULT 1,
  `is_father_name` int(11) DEFAULT 1,
  `is_mother_name` int(11) DEFAULT 1,
  `is_dob` int(11) DEFAULT 1,
  `is_admission_no` int(11) DEFAULT 1,
  `is_roll_no` int(11) DEFAULT 1,
  `is_class` int(11) NOT NULL DEFAULT 0,
  `is_section` int(11) NOT NULL DEFAULT 0,
  `is_photo` int(11) NOT NULL DEFAULT 0,
  `is_contactno` int(11) NOT NULL DEFAULT 0,
  `exam_group_grade` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`exam_group_grade`)),
  `exam_group_marks_obtained` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`exam_group_marks_obtained`)),
  `exam_group_max_marks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`exam_group_max_marks`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `is_header` int(11) NOT NULL,
  `header_img` text NOT NULL,
  `marks_grade_table` int(11) NOT NULL DEFAULT 0,
  `max_marks_shift_left` int(11) NOT NULL DEFAULT 0,
  `overall_marks_title` varchar(255) DEFAULT NULL,
  `subject_color` char(36) DEFAULT NULL,
  `scholastic_area_color` char(36) DEFAULT NULL,
  `main_subject_color` char(36) DEFAULT NULL,
  `school_reopen` int(11) NOT NULL DEFAULT 0,
  `header_height` int(11) DEFAULT NULL,
  `footer_height` int(11) DEFAULT NULL,
  `is_show_date` int(11) NOT NULL DEFAULT 0,
  `school_reopen_date` char(36) DEFAULT NULL,
  `school_reopen_time` char(36) DEFAULT NULL,
  `place` int(11) NOT NULL DEFAULT 0,
  `show_date` char(36) DEFAULT NULL,
  `show_place` char(36) DEFAULT NULL,
  `is_show_attendance` int(1) NOT NULL DEFAULT 0,
  `is_class_position` int(1) NOT NULL DEFAULT 0,
  `is_promoted_to` int(11) NOT NULL DEFAULT 0,
  `grade_table_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `template_marksheets`
--

INSERT INTO `template_marksheets` (`id`, `session_id`, `template`, `title`, `left_sign`, `middle_sign`, `right_sign`, `left_sign_title`, `middle_sign_title`, `right_sign_title`, `is_class_teacher`, `is_examination_ic`, `is_principal`, `background_image`, `is_name`, `is_father_name`, `is_mother_name`, `is_dob`, `is_admission_no`, `is_roll_no`, `is_class`, `is_section`, `is_photo`, `is_contactno`, `exam_group_grade`, `exam_group_marks_obtained`, `exam_group_max_marks`, `created_at`, `updated_at`, `is_header`, `header_img`, `marks_grade_table`, `max_marks_shift_left`, `overall_marks_title`, `subject_color`, `scholastic_area_color`, `main_subject_color`, `school_reopen`, `header_height`, `footer_height`, `is_show_date`, `school_reopen_date`, `school_reopen_time`, `place`, `show_date`, `show_place`, `is_show_attendance`, `is_class_position`, `is_promoted_to`, `grade_table_title`) VALUES
(2, 1, 'UT-1 Marksheet', 'UT-1 Marksheet', '', '', '', 'Class Teacher Signature', 'Co-Ordinator Signature', 'Principal Signature', 1, 1, 1, '', 1, 1, 1, 0, 1, 0, 1, 1, 0, 0, '{\"0\":\"1\",\"overall\":\"1\"}', '{\"overall\":\"1\"}', '{\"0\":\"1\",\"overall\":\"1\"}', '2026-06-03 14:33:42', NULL, 0, '', 1, 1, 'Overall Marks', '', '', '', 0, 100, 20, 0, '', '', 0, '', '', 0, 1, 0, 'Grading Table');

-- --------------------------------------------------------

--
-- Table structure for table `template_marksheets_old_bkp`
--

CREATE TABLE `template_marksheets_old_bkp` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
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
-- Table structure for table `template_reminder_letter`
--

CREATE TABLE `template_reminder_letter` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `template_name` text NOT NULL,
  `heading_title` varchar(255) DEFAULT NULL,
  `uid_no` tinyint(1) NOT NULL DEFAULT 0,
  `student_name` tinyint(1) NOT NULL DEFAULT 0,
  `father_name` tinyint(1) NOT NULL DEFAULT 0,
  `class_section` tinyint(1) NOT NULL DEFAULT 0,
  `route` tinyint(1) NOT NULL DEFAULT 0,
  `phone` tinyint(1) NOT NULL DEFAULT 0,
  `date` tinyint(1) NOT NULL DEFAULT 0,
  `header_image` varchar(225) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_signature` tinyint(1) NOT NULL DEFAULT 0,
  `signature` varchar(255) DEFAULT NULL,
  `signature_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_reportcard`
--

CREATE TABLE `template_reportcard` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `template` varchar(200) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `left_sign` varchar(200) DEFAULT NULL,
  `middle_sign` varchar(200) DEFAULT NULL,
  `right_sign` varchar(200) DEFAULT NULL,
  `left_sign_title` varchar(255) DEFAULT NULL,
  `middle_sign_title` varchar(255) DEFAULT NULL,
  `right_sign_title` varchar(255) DEFAULT NULL,
  `is_class_teacher` int(11) NOT NULL DEFAULT 0,
  `is_examination_ic` int(11) NOT NULL DEFAULT 0,
  `is_principal` int(11) NOT NULL DEFAULT 0,
  `background_image` varchar(200) DEFAULT NULL,
  `is_name` int(11) DEFAULT 1,
  `is_father_name` int(11) DEFAULT 1,
  `is_mother_name` int(11) DEFAULT 1,
  `is_dob` int(11) DEFAULT 1,
  `is_admission_no` int(11) DEFAULT 1,
  `is_roll_no` int(11) DEFAULT 1,
  `is_class` int(11) NOT NULL DEFAULT 0,
  `is_section` int(11) NOT NULL DEFAULT 0,
  `is_photo` int(11) NOT NULL DEFAULT 0,
  `is_contactno` int(11) NOT NULL DEFAULT 0,
  `exam_group_grade` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`exam_group_grade`)),
  `exam_group_marks_obtained` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`exam_group_marks_obtained`)),
  `exam_group_max_marks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`exam_group_max_marks`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `is_header` int(11) NOT NULL,
  `header_img` text NOT NULL,
  `marks_grade_table` int(11) NOT NULL DEFAULT 0,
  `max_marks_shift_left` int(11) NOT NULL DEFAULT 0,
  `overall_marks_title` varchar(255) DEFAULT NULL,
  `subject_color` char(36) DEFAULT NULL,
  `scholastic_area_color` char(36) DEFAULT NULL,
  `main_subject_color` char(36) DEFAULT NULL,
  `school_reopen` int(11) NOT NULL DEFAULT 0,
  `header_height` int(11) DEFAULT NULL,
  `footer_height` int(11) DEFAULT NULL,
  `is_show_date` int(11) NOT NULL DEFAULT 0,
  `school_reopen_date` char(36) DEFAULT NULL,
  `school_reopen_time` char(36) DEFAULT NULL,
  `place` int(11) NOT NULL DEFAULT 0,
  `show_date` char(36) DEFAULT NULL,
  `show_place` char(36) DEFAULT NULL,
  `is_show_attendance` int(1) NOT NULL DEFAULT 0,
  `is_class_position` int(1) NOT NULL DEFAULT 0,
  `is_promoted_to` int(11) NOT NULL DEFAULT 0,
  `grade_table_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `template_reportcard`
--

INSERT INTO `template_reportcard` (`id`, `session_id`, `template`, `title`, `left_sign`, `middle_sign`, `right_sign`, `left_sign_title`, `middle_sign_title`, `right_sign_title`, `is_class_teacher`, `is_examination_ic`, `is_principal`, `background_image`, `is_name`, `is_father_name`, `is_mother_name`, `is_dob`, `is_admission_no`, `is_roll_no`, `is_class`, `is_section`, `is_photo`, `is_contactno`, `exam_group_grade`, `exam_group_marks_obtained`, `exam_group_max_marks`, `created_at`, `updated_at`, `is_header`, `header_img`, `marks_grade_table`, `max_marks_shift_left`, `overall_marks_title`, `subject_color`, `scholastic_area_color`, `main_subject_color`, `school_reopen`, `header_height`, `footer_height`, `is_show_date`, `school_reopen_date`, `school_reopen_time`, `place`, `show_date`, `show_place`, `is_show_attendance`, `is_class_position`, `is_promoted_to`, `grade_table_title`) VALUES
(1, 1, 'Report Card', 'Report Card', '', '', '', 'Left Sign', 'Middle Sign', 'Right Sign', 1, 1, 1, '', 1, 1, 1, 0, 1, 0, 1, 1, 0, 0, '{\"1\":\"1\",\"2\":\"1\",\"overall\":\"1\"}', '{\"1\":\"1\",\"2\":\"1\",\"overall\":\"1\"}', '{\"1\":\"1\",\"2\":\"1\",\"overall\":\"1\"}', '2026-06-03 14:45:27', NULL, 0, '', 1, 1, 'Overall ', '', '', '', 0, 200, 10, 0, '', '', 0, '', '', 0, 1, 0, 'Grading Scale');

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
(1, 'login@easyskool.in', 'Super Admin', NULL, '103.211.133.255', 'Chrome 148.0.0.0, Windows 10', '2026-06-03 16:38:40'),
(2, 'login@easyskool.in', 'Super Admin', NULL, '103.211.133.255', 'Chrome 148.0.0.0, Windows 10', '2026-06-03 16:38:54'),
(3, 'login@easyskool.in', 'Super Admin', NULL, '103.68.21.75', 'Chrome 148.0.0.0, Windows 10', '2026-06-03 16:47:58'),
(4, 'login@easyskool.in', 'Super Admin', NULL, '103.68.21.85', 'Chrome 148.0.0.0, Windows 10', '2026-06-03 19:22:04'),
(5, 'login@easyskool.in', 'Super Admin', NULL, '2402:8100:2e93:f535:38e9:c82a:85c4:66bc', 'Chrome 148.0.0.0, Windows 10', '2026-06-03 22:24:48'),
(6, 'login@easyskool.in', 'Super Admin', NULL, '103.68.21.79', 'Chrome 148.0.0.0, Windows 10', '2026-06-04 08:21:21'),
(7, 'login@easyskool.in', 'Super Admin', NULL, '103.135.228.165', 'Chrome 148.0.0.0, Windows 10', '2026-06-04 10:30:05'),
(8, 'login@easyskool.in', 'Super Admin', NULL, '103.68.21.91', 'Chrome 148.0.0.0, Windows 10', '2026-06-04 11:56:30'),
(9, 'login@easyskool.in', 'Super Admin', NULL, '103.68.21.81', 'Chrome 148.0.0.0, Windows 10', '2026-06-04 13:50:45'),
(10, 'login@easyskool.in', 'Super Admin', NULL, '103.135.228.165', 'Chrome 148.0.0.0, Windows 10', '2026-06-04 15:22:02');

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
(1, 1, 'std1', '5oz3yh', '', 'student', '', 0, 'yes', '2026-06-03 13:54:26', NULL),
(2, 0, 'parent1', 'hs9vua', '1', 'parent', '', 0, 'yes', '2026-06-03 13:54:26', NULL),
(3, 2, 'std2', '6j31fi', '', 'student', '', 0, 'yes', '2026-06-03 13:57:09', NULL),
(4, 2, 'parent2', '30o363', '2', 'parent', '', 0, 'yes', '2026-06-03 13:57:09', NULL);

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
  `session_id` int(11) DEFAULT NULL,
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
  `session_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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

--
-- Dumping data for table `visitors_book`
--

INSERT INTO `visitors_book` (`id`, `source`, `purpose`, `name`, `email`, `contact`, `id_proof`, `no_of_pepple`, `date`, `in_time`, `out_time`, `note`, `image`) VALUES
(1, NULL, 'Testing', 'Rahul', NULL, '9897982348', '', 0, '2025-12-17', '04:15 PM', '04:15 PM', '', '');

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
-- Dumping data for table `visitors_purpose`
--

INSERT INTO `visitors_purpose` (`id`, `visitors_purpose`, `description`) VALUES
(1, 'Testing', 'Testing');

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
-- Indexes for table `balance_sheets`
--
ALTER TABLE `balance_sheets`
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
-- Indexes for table `branches`
--
ALTER TABLE `branches`
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
-- Indexes for table `certificate_generates`
--
ALTER TABLE `certificate_generates`
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
-- Indexes for table `deleted_receipts`
--
ALTER TABLE `deleted_receipts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `exam_group_exam_results_coscholastic`
--
ALTER TABLE `exam_group_exam_results_coscholastic`
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
-- Indexes for table `move_students`
--
ALTER TABLE `move_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `move_students_category`
--
ALTER TABLE `move_students_category`
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
-- Indexes for table `receipt_sr_no`
--
ALTER TABLE `receipt_sr_no`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `received_previous_balance`
--
ALTER TABLE `received_previous_balance`
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
-- Indexes for table `sch_settings_session`
--
ALTER TABLE `sch_settings_session`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tc_certificate_generates`
--
ALTER TABLE `tc_certificate_generates`
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
-- Indexes for table `template_designtc`
--
ALTER TABLE `template_designtc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_marksheets`
--
ALTER TABLE `template_marksheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_marksheets_old_bkp`
--
ALTER TABLE `template_marksheets_old_bkp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_reminder_letter`
--
ALTER TABLE `template_reminder_letter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_reportcard`
--
ALTER TABLE `template_reportcard`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `balance_sheets`
--
ALTER TABLE `balance_sheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate_generates`
--
ALTER TABLE `certificate_generates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class_sections`
--
ALTER TABLE `class_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class_teacher`
--
ALTER TABLE `class_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deleted_receipts`
--
ALTER TABLE `deleted_receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disable_reason`
--
ALTER TABLE `disable_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_group_class_batch_exams`
--
ALTER TABLE `exam_group_class_batch_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `exam_group_class_batch_exam_students`
--
ALTER TABLE `exam_group_class_batch_exam_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exam_group_class_batch_exam_subjects`
--
ALTER TABLE `exam_group_class_batch_exam_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam_group_exam_connections`
--
ALTER TABLE `exam_group_exam_connections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_group_exam_results`
--
ALTER TABLE `exam_group_exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exam_group_exam_results_coscholastic`
--
ALTER TABLE `exam_group_exam_results_coscholastic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_head`
--
ALTER TABLE `expense_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_plan`
--
ALTER TABLE `fees_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fees_reminder`
--
ALTER TABLE `fees_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feetype`
--
ALTER TABLE `feetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `fee_discounts`
--
ALTER TABLE `fee_discounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_groups`
--
ALTER TABLE `fee_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fee_groups_feetype`
--
ALTER TABLE `fee_groups_feetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fee_head`
--
ALTER TABLE `fee_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fee_receipt_no`
--
ALTER TABLE `fee_receipt_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_session_groups`
--
ALTER TABLE `fee_session_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `front_cms_menus`
--
ALTER TABLE `front_cms_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `front_cms_menu_items`
--
ALTER TABLE `front_cms_menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_head`
--
ALTER TABLE `income_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `move_students`
--
ALTER TABLE `move_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `move_students_category`
--
ALTER TABLE `move_students_category`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `permission_group`
--
ALTER TABLE `permission_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permission_student`
--
ALTER TABLE `permission_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `print_headerfooter`
--
ALTER TABLE `print_headerfooter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `receipt_sr_no`
--
ALTER TABLE `receipt_sr_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `received_previous_balance`
--
ALTER TABLE `received_previous_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route_head`
--
ALTER TABLE `route_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `route_plan`
--
ALTER TABLE `route_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_houses`
--
ALTER TABLE `school_houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sch_settings`
--
ALTER TABLE `sch_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sch_settings_session`
--
ALTER TABLE `sch_settings_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `send_notification`
--
ALTER TABLE `send_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_attendance_type`
--
ALTER TABLE `staff_attendance_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_designation`
--
ALTER TABLE `staff_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_id_card`
--
ALTER TABLE `staff_id_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_leave_details`
--
ALTER TABLE `staff_leave_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff_timeline`
--
ALTER TABLE `staff_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_applyleave`
--
ALTER TABLE `student_applyleave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_attendences`
--
ALTER TABLE `student_attendences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_doc`
--
ALTER TABLE `student_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees_master`
--
ALTER TABLE `student_fees_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_session`
--
ALTER TABLE `student_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4114;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_groups`
--
ALTER TABLE `subject_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subject_group_class_sections`
--
ALTER TABLE `subject_group_class_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `subject_group_subjects`
--
ALTER TABLE `subject_group_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `tc_certificate_generates`
--
ALTER TABLE `tc_certificate_generates`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_designtc`
--
ALTER TABLE `template_designtc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_marksheets`
--
ALTER TABLE `template_marksheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_marksheets_old_bkp`
--
ALTER TABLE `template_marksheets_old_bkp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_reminder_letter`
--
ALTER TABLE `template_reminder_letter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_reportcard`
--
ALTER TABLE `template_reportcard`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_authentication`
--
ALTER TABLE `users_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_routes`
--
ALTER TABLE `vehicle_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors_book`
--
ALTER TABLE `visitors_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitors_purpose`
--
ALTER TABLE `visitors_purpose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
