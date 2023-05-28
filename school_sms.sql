-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 28, 2023 lúc 06:13 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `school_sms`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class`
--

CREATE TABLE `class` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT '0',
  `status` tinyint(1) DEFAULT 0,
  `is_delete` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class`
--

INSERT INTO `class` (`id`, `name`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'HTCL2015', 0, 0, 1, '2023-04-17 20:07:49', '2023-04-26 10:05:26'),
(2, '10B', 0, 0, 1, '2023-04-17 20:18:11', '2023-04-17 21:05:56'),
(3, '10C', 0, 0, 1, '2023-04-17 20:42:07', '2023-04-17 21:06:03'),
(4, '11A', 0, 0, 1, '2023-04-17 20:46:23', '2023-05-14 07:12:02'),
(5, '10A', 0, 0, 1, '2023-04-17 21:05:05', '2023-04-20 08:45:02'),
(6, '12A1', 0, 0, 1, '2023-04-20 08:46:53', '2023-04-20 08:46:53'),
(7, '11a1', 0, 0, 1, '2023-04-22 12:14:30', '2023-04-22 12:14:30'),
(8, '11A1', 0, 0, 1, '2023-04-22 12:15:13', '2023-04-22 12:15:13'),
(9, '12A3', 0, 0, 1, '2023-04-22 12:16:12', '2023-04-22 12:16:12'),
(10, 'ATMT2022', 0, 0, 1, '2023-04-26 09:16:17', '2023-04-26 09:16:17'),
(11, '123123', 0, 1, 1, '2023-04-26 09:17:55', '2023-05-06 21:21:02'),
(12, '12124', 0, 1, 1, '2023-04-26 09:19:33', '2023-05-06 21:21:04'),
(13, '1124125125', 0, 1, 1, '2023-04-26 09:21:38', '2023-05-06 21:21:09'),
(14, 'Leo', 0, 1, 1, '2023-04-26 09:22:52', '2023-05-06 21:20:49'),
(15, 'gabu', 0, 1, 1, '2023-04-26 09:30:01', '2023-05-06 21:20:45'),
(16, '34234', 0, 1, 1, '2023-04-26 09:31:50', '2023-05-06 21:20:47'),
(17, '123123123123', 0, 1, 1, '2023-04-26 09:32:32', '2023-05-06 21:20:38'),
(18, '123123', 0, 1, 1, '2023-04-26 09:33:37', '2023-05-06 21:20:35'),
(19, '123', 0, 1, 1, '2023-04-26 09:38:27', '2023-05-06 21:20:41'),
(20, '12312', 0, 1, 1, '2023-04-26 09:39:05', '2023-05-06 21:20:43'),
(21, '123', 0, 1, 1, '2023-04-26 09:46:09', '2023-05-06 21:21:11'),
(24, 'CNPM', 0, 0, 1, '2023-04-27 21:05:04', '2023-04-27 21:05:04'),
(25, 'Willa Langosh', 1, 1, 26, '2023-05-09 03:41:46', '2023-05-09 03:41:46'),
(26, 'Dr. Cristal Osinski III', 0, 1, 26, '2023-05-09 03:41:46', '2023-05-09 03:41:46'),
(27, 'Dr. Rashad Jaskolski', 1, 1, 26, '2023-05-09 03:41:46', '2023-05-09 03:41:46'),
(28, 'Dr. Liza Ondricka Sr.', 0, 0, 29, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(29, 'Ms. Yazmin Goyette II', 0, 1, 29, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(30, 'Dr. Mariano Reilly', 1, 1, 29, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(31, 'Anne Kris', 1, 0, NULL, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(32, 'Emanuel Klein', 0, 0, NULL, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(33, 'Fabian McKenzie Jr.', 1, 1, NULL, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(34, '12312311111', 0, 1, 9, '2023-05-18 23:47:36', '2023-05-18 23:48:19'),
(35, 'Tonio', 0, 1, 9, '2023-05-21 20:41:15', '2023-05-21 20:41:23'),
(36, '566', 0, 0, 9, '2023-05-23 02:01:12', '2023-05-23 02:05:31'),
(37, '5', 0, 0, 9, '2023-05-23 02:22:54', '2023-05-23 02:22:54'),
(38, '55', 0, 0, 9, '2023-05-23 02:24:57', '2023-05-23 02:37:58'),
(39, '6', 0, 1, 9, '2023-05-23 02:33:59', '2023-05-23 02:34:10'),
(40, 'Linda Hermann', 0, 1, 51, '2023-05-23 03:14:00', '2023-05-23 03:14:00'),
(41, 'Mrs. Marisa Collier', 0, 1, 51, '2023-05-23 03:14:00', '2023-05-23 03:14:00'),
(42, 'Donnie Wehner', 0, 0, 51, '2023-05-23 03:14:00', '2023-05-23 03:14:00'),
(43, 'Vivienne Rempel', 1, 1, 54, '2023-05-23 03:15:00', '2023-05-23 03:15:00'),
(44, 'Prof. Cristina Torphy', 0, 1, 54, '2023-05-23 03:15:00', '2023-05-23 03:15:00'),
(45, 'Mrs. Bridget Aufderhar PhD', 1, 0, 54, '2023-05-23 03:15:00', '2023-05-23 03:15:00'),
(46, 'Roger Aufderhar I', 0, 0, 57, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(47, 'Vesta Ryan', 0, 0, 57, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(48, 'Ms. Heath Lesch Sr.', 0, 1, 57, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(49, 'King Abbott', 1, 0, NULL, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(50, 'Mayra Schimmel', 0, 1, NULL, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(51, 'Cindy Green I', 0, 0, 62, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(52, 'Unique Weber', 0, 0, 62, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(53, 'Demarco Weber', 0, 0, 62, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(54, 'Prof. Kamren Hermann IV', 0, 0, NULL, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(55, 'Akeem Pagac', 1, 0, NULL, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(56, 'Verner Simonis', 1, 0, NULL, '2023-05-23 03:57:09', '2023-05-23 03:57:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class_subject`
--

CREATE TABLE `class_subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  `status` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class_subject`
--

INSERT INTO `class_subject` (`id`, `class_id`, `subject_id`, `is_delete`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(121, 2, 7, 0, 0, 9, '2023-05-21 20:04:14', '2023-05-21 20:04:14'),
(122, 2, 13, 0, 0, 9, '2023-05-21 20:04:14', '2023-05-21 20:04:14'),
(123, 2, 4, 0, 0, 9, '2023-05-21 20:04:14', '2023-05-21 20:04:14'),
(124, 2, 1, 0, 0, 9, '2023-05-21 20:04:14', '2023-05-21 20:04:14'),
(125, 2, 18, 0, 0, 9, '2023-05-22 09:53:59', '2023-05-22 09:53:59'),
(126, 2, 9, 0, 0, 9, '2023-05-22 09:53:59', '2023-05-22 09:53:59'),
(131, 54, 43, 0, 0, 65, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(132, 55, 44, 0, 0, 66, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(133, 56, 45, 0, 0, 67, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(134, 5, 7, 0, 0, 9, '2023-05-24 19:50:20', '2023-05-24 19:50:20'),
(135, 5, 13, 0, 0, 9, '2023-05-24 19:50:20', '2023-05-24 19:50:20'),
(136, 5, 4, 0, 0, 9, '2023-05-24 19:50:20', '2023-05-24 19:50:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class_subject_timetable`
--

CREATE TABLE `class_subject_timetable` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `day_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class_subject_timetable`
--

INSERT INTO `class_subject_timetable` (`id`, `class_id`, `subject_id`, `day_id`, `start_time`, `end_time`, `room_number`, `created_at`, `updated_at`, `start_date`, `end_date`, `semester_id`) VALUES
(199, 5, 4, 1, '12:23', '13:23', '123', '2023-05-26 08:23:53', '2023-05-26 08:23:53', '2023-05-01', '2023-05-26', 1),
(201, 5, 4, 1, '13:24', '15:24', '8', '2023-05-26 08:58:52', '2023-05-26 08:58:52', '2023-05-09', '2023-05-16', 2),
(202, 5, 4, 2, '13:58', '15:58', '1', '2023-05-26 08:58:52', '2023-05-26 08:58:52', '2023-05-09', '2023-05-16', 2),
(204, 5, 7, 2, '14:21', '17:21', '1', '2023-05-27 22:21:31', '2023-05-27 22:21:31', '2023-05-17', '2023-05-31', 1),
(205, 5, 7, 4, '14:21', '18:21', '1', '2023-05-27 22:21:46', '2023-05-27 22:21:46', '2023-05-09', '2023-07-20', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `day_of_week`
--

CREATE TABLE `day_of_week` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fullcalendar_day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `day_of_week`
--

INSERT INTO `day_of_week` (`id`, `name`, `created_at`, `updated_at`, `fullcalendar_day`) VALUES
(1, 'Monday', NULL, NULL, 1),
(2, 'Tuesday', NULL, NULL, 2),
(3, 'Wednesday', NULL, NULL, 3),
(4, 'Thursday', NULL, NULL, 4),
(5, 'Friday', NULL, NULL, 5),
(6, 'Saturday', NULL, NULL, 6),
(7, 'Sunday', NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `exam`
--

INSERT INTO `exam` (`id`, `name`, `description`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(7, '15-minute test', '1', 0, 9, '2023-05-06 21:44:34', '2023-05-21 20:12:01'),
(9, '45-minute test', '2', 0, 9, '2023-05-06 21:45:03', '2023-05-21 20:12:31'),
(10, 'Final test', '3', 0, 9, '2023-05-06 21:45:31', '2023-05-21 20:12:42'),
(11, 'Kim Leuschke', 'Michele Schinner', 1, 28, '2023-05-09 03:41:47', '2023-05-09 03:41:47'),
(12, 'Ms. Jazmyn Koelpin', 'Prof. Tracy Krajcik', 1, 28, '2023-05-09 03:41:47', '2023-05-09 03:41:47'),
(13, 'Seth Emmerich', 'Bette Carter', 1, 28, '2023-05-09 03:41:47', '2023-05-09 03:41:47'),
(14, 'Destinee Nitzsche IV', 'Jerod Conn', 1, 31, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(15, 'Prof. Lyric Klein Jr.', 'Rosanna Hintz Jr.', 1, 31, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(16, 'Karina Altenwerth', 'Garry Schaden', 1, 31, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(17, 'Jadyn Okuneva', 'Dax Hudson DVM', 0, 59, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(18, 'Name Lesch', 'Marco Stiedemann', 1, 59, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(19, 'Darrell Jenkins', 'Katheryn Ankunding', 1, 59, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(20, 'Mrs. Lelah Wyman', 'Prof. Murphy Cronin IV', 0, 64, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(21, 'Florencio Wehner', 'Bell Parker', 0, 64, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(22, 'Bailey Borer', 'Vladimir Ebert', 1, 64, '2023-05-23 03:57:09', '2023-05-23 03:57:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `full_mark` varchar(255) DEFAULT NULL,
  `passing_mark` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `exam_schedule`
--

INSERT INTO `exam_schedule` (`id`, `exam_id`, `class_id`, `subject_id`, `exam_date`, `start_time`, `end_time`, `room_number`, `full_mark`, `passing_mark`, `created_by`, `created_at`, `updated_at`, `semester_id`) VALUES
(61, 7, 5, 4, '2023-05-02', '13:47', '18:43', '123', '123', '123', 9, '2023-05-26 00:00:17', '2023-05-26 00:00:17', 2),
(69, 9, 5, 4, '2023-05-15', '19:36', '23:36', '123', '12', '12', 9, '2023-05-26 00:41:53', '2023-05-26 00:41:53', 1),
(70, 7, 5, 4, '2023-05-16', '18:00', '21:00', '12', '12', '1', 9, '2023-05-26 01:04:03', '2023-05-26 01:04:03', 1),
(71, 7, 5, 13, '2023-05-22', '20:35', '23:35', '12', '12', '1', 9, '2023-05-26 01:04:03', '2023-05-26 01:04:03', 1),
(72, 7, 5, 7, '2023-05-15', '19:03', '18:03', '12', '124', '124', 9, '2023-05-26 01:04:03', '2023-05-26 01:04:03', 1),
(73, 10, 5, 4, '2023-05-01', '18:04', '20:04', '123', '123', '123', 9, '2023-05-26 01:04:38', '2023-05-26 01:04:38', 1),
(75, 9, 5, 4, '2023-05-01', '15:34', '17:34', '123', '123', '123', 9, '2023-05-27 22:31:31', '2023-05-27 22:31:31', 2),
(76, 9, 5, 7, '2023-05-18', '13:31', '17:31', '123', '123', '123', 9, '2023-05-27 22:31:31', '2023-05-27 22:31:31', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `exam_score`
--

CREATE TABLE `exam_score` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avage_score` varchar(255) DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `exam_score`
--

INSERT INTO `exam_score` (`id`, `exam_id`, `class_id`, `subject_id`, `student_id`, `score`, `created_by`, `created_at`, `updated_at`, `avage_score`, `semester_id`) VALUES
(2096, 7, 5, 4, 41, '6', 9, '2023-05-28 07:15:31', '2023-05-28 07:15:31', NULL, 1),
(2097, 9, 5, 4, 41, '6', 9, '2023-05-28 07:15:31', '2023-05-28 07:15:31', NULL, 1),
(2098, 10, 5, 4, 41, '7', 9, '2023-05-28 07:15:31', '2023-05-28 07:15:31', NULL, 1),
(2099, 7, 5, 4, 36, '7', 9, '2023-05-28 07:15:31', '2023-05-28 07:15:31', NULL, 1),
(2100, 9, 5, 4, 36, '7', 9, '2023-05-28 07:15:31', '2023-05-28 07:15:31', NULL, 1),
(2101, 10, 5, 4, 36, '7', 9, '2023-05-28 07:15:31', '2023-05-28 07:15:31', NULL, 1),
(2102, 7, 5, 4, 19, '10', 9, '2023-05-28 07:15:31', '2023-05-28 07:15:31', NULL, 1),
(2103, 9, 5, 4, 19, '5', 9, '2023-05-28 07:15:31', '2023-05-28 07:15:31', NULL, 1),
(2104, 10, 5, 4, 19, '10', 9, '2023-05-28 07:15:31', '2023-05-28 07:15:31', NULL, 1),
(2105, 7, 5, 13, 41, '6', 9, '2023-05-28 07:15:40', '2023-05-28 07:15:40', NULL, 1),
(2106, 9, 5, 13, 41, '6', 9, '2023-05-28 07:15:40', '2023-05-28 07:15:40', NULL, 1),
(2107, 10, 5, 13, 41, '6', 9, '2023-05-28 07:15:40', '2023-05-28 07:15:40', NULL, 1),
(2108, 7, 5, 13, 36, '10', 9, '2023-05-28 07:15:40', '2023-05-28 07:15:40', NULL, 1),
(2109, 9, 5, 13, 36, '7', 9, '2023-05-28 07:15:40', '2023-05-28 07:15:40', NULL, 1),
(2110, 10, 5, 13, 36, '8', 9, '2023-05-28 07:15:41', '2023-05-28 07:15:41', NULL, 1),
(2111, 7, 5, 13, 19, '6', 9, '2023-05-28 07:15:41', '2023-05-28 07:15:41', NULL, 1),
(2112, 9, 5, 13, 19, '7', 9, '2023-05-28 07:15:41', '2023-05-28 07:15:41', NULL, 1),
(2113, 10, 5, 13, 19, '8', 9, '2023-05-28 07:15:41', '2023-05-28 07:15:41', NULL, 1),
(2114, 7, 5, 7, 41, '9', 9, '2023-05-28 07:15:50', '2023-05-28 07:15:50', NULL, 1),
(2115, 9, 5, 7, 41, '9', 9, '2023-05-28 07:15:50', '2023-05-28 07:15:50', NULL, 1),
(2116, 10, 5, 7, 41, '9', 9, '2023-05-28 07:15:50', '2023-05-28 07:15:50', NULL, 1),
(2117, 7, 5, 7, 36, '10', 9, '2023-05-28 07:15:50', '2023-05-28 07:15:50', NULL, 1),
(2118, 9, 5, 7, 36, '7', 9, '2023-05-28 07:15:50', '2023-05-28 07:15:50', NULL, 1),
(2119, 10, 5, 7, 36, '8', 9, '2023-05-28 07:15:50', '2023-05-28 07:15:50', NULL, 1),
(2120, 7, 5, 7, 19, '10', 9, '2023-05-28 07:15:50', '2023-05-28 07:15:50', NULL, 1),
(2121, 9, 5, 7, 19, '10', 9, '2023-05-28 07:15:50', '2023-05-28 07:15:50', NULL, 1),
(2122, 10, 5, 7, 19, '10', 9, '2023-05-28 07:15:50', '2023-05-28 07:15:50', NULL, 1),
(2123, 7, 5, 7, 41, '10', 9, '2023-05-28 07:16:37', '2023-05-28 07:16:37', NULL, 2),
(2124, 9, 5, 7, 41, '10', 9, '2023-05-28 07:16:37', '2023-05-28 07:16:37', NULL, 2),
(2125, 10, 5, 7, 41, '10', 9, '2023-05-28 07:16:37', '2023-05-28 07:16:37', NULL, 2),
(2126, 7, 5, 7, 36, '10', 9, '2023-05-28 07:16:37', '2023-05-28 07:16:37', NULL, 2),
(2127, 9, 5, 7, 36, '10', 9, '2023-05-28 07:16:37', '2023-05-28 07:16:37', NULL, 2),
(2128, 10, 5, 7, 36, '10', 9, '2023-05-28 07:16:37', '2023-05-28 07:16:37', NULL, 2),
(2129, 7, 5, 7, 19, '1', 9, '2023-05-28 07:16:37', '2023-05-28 07:16:37', NULL, 2),
(2130, 9, 5, 7, 19, '5', 9, '2023-05-28 07:16:37', '2023-05-28 07:16:37', NULL, 2),
(2131, 10, 5, 7, 19, '6', 9, '2023-05-28 07:16:37', '2023-05-28 07:16:37', NULL, 2),
(2141, 7, 5, 13, 41, '8', 9, '2023-05-28 07:16:58', '2023-05-28 07:16:58', NULL, 2),
(2142, 9, 5, 13, 41, '9', 9, '2023-05-28 07:16:58', '2023-05-28 07:16:58', NULL, 2),
(2143, 10, 5, 13, 41, '10', 9, '2023-05-28 07:16:58', '2023-05-28 07:16:58', NULL, 2),
(2144, 7, 5, 13, 36, '10', 9, '2023-05-28 07:16:58', '2023-05-28 07:16:58', NULL, 2),
(2145, 9, 5, 13, 36, '5', 9, '2023-05-28 07:16:58', '2023-05-28 07:16:58', NULL, 2),
(2146, 10, 5, 13, 36, '8', 9, '2023-05-28 07:16:58', '2023-05-28 07:16:58', NULL, 2),
(2147, 7, 5, 13, 19, '10', 9, '2023-05-28 07:16:58', '2023-05-28 07:16:58', NULL, 2),
(2148, 9, 5, 13, 19, '5', 9, '2023-05-28 07:16:58', '2023-05-28 07:16:58', NULL, 2),
(2149, 10, 5, 13, 19, '10', 9, '2023-05-28 07:16:58', '2023-05-28 07:16:58', NULL, 2),
(2186, 7, 5, 4, 41, '6', 9, '2023-05-28 07:52:20', '2023-05-28 07:52:20', NULL, 2),
(2187, 9, 5, 4, 41, '7', 9, '2023-05-28 07:52:20', '2023-05-28 07:52:20', NULL, 2),
(2188, 10, 5, 4, 41, '10', 9, '2023-05-28 07:52:20', '2023-05-28 07:52:20', NULL, 2),
(2189, 7, 5, 4, 36, '10', 9, '2023-05-28 07:52:20', '2023-05-28 07:52:20', NULL, 2),
(2190, 9, 5, 4, 36, '10', 9, '2023-05-28 07:52:20', '2023-05-28 07:52:20', NULL, 2),
(2191, 10, 5, 4, 36, '5', 9, '2023-05-28 07:52:20', '2023-05-28 07:52:20', NULL, 2),
(2192, 7, 5, 4, 19, '7', 9, '2023-05-28 07:52:20', '2023-05-28 07:52:20', NULL, 2),
(2193, 9, 5, 4, 19, '8', 9, '2023-05-28 07:52:20', '2023-05-28 07:52:20', NULL, 2),
(2194, 10, 5, 4, 19, '10', 9, '2023-05-28 07:52:20', '2023-05-28 07:52:20', NULL, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_04_26_053811_create_class_table', 1),
(5, '2023_04_27_000000_create_users_table', 1),
(6, '2023_04_28_095904_create_subject_table', 1),
(7, '2023_04_29_102117_create_class_subject_table', 1),
(8, '2023_04_29_105107_create_teacher_class_table', 1),
(9, '2023_04_29_111314_create_day_of_week_table', 1),
(10, '2023_04_29_111540_create_class_subject_timetable_table', 1),
(11, '2023_04_3123_103329_create_exam_table', 1),
(12, '2023_05_02_114247_create_exam_schedule_table', 1),
(13, '2023_05_04_072608_add_calendar_to_day_table', 1),
(14, '2023_05_08_081106_add_subject_to_classteacher', 1),
(15, '2023_05_12_153654_create_exam_score_table', 1),
(16, '2023_05_14_095541_add_avagescore_exam_score_table', 1),
(17, '2023_05_17_031339_add_colunm_time_table', 1),
(18, '2023_05_18_042030_add_colunm_subject_to_users', 1),
(19, '2023_05_25_101639_add_score_to_user_table', 2),
(20, '2023_05_26_033240_create_visitors_table', 3),
(21, '2023_05_26_033744_create_semester_table', 4),
(22, '2023_05_26_041014_add_sesmeter_to_exam_schedule_table', 5),
(23, '2023_05_26_074715_add_semester_to_exam_score_table', 6),
(24, '2023_05_26_143716_add_semester_to_timetable_table', 7),
(25, '2023_05_27_070018_create_student_score_table', 8),
(26, '2023_05_27_074127_create_student_score_average_table', 9),
(27, '2023_05_27_152948_add_semester3_to_score', 10),
(28, '2023_05_27_185223_add_rank_to_score', 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `semester`
--

CREATE TABLE `semester` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `semester`
--

INSERT INTO `semester` (`id`, `name`) VALUES
(1, 'HK1'),
(2, 'HK2'),
(3, 'CN');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_score`
--

CREATE TABLE `student_score` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `avage_score` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_score`
--

INSERT INTO `student_score` (`id`, `class_id`, `subject_id`, `student_id`, `semester_id`, `score`, `avage_score`, `created_at`, `updated_at`) VALUES
(80, 5, 4, 19, 1, '8.3333333333333', NULL, NULL, NULL),
(81, 5, 13, 19, 1, '7.3333333333333', NULL, NULL, NULL),
(82, 5, 7, 19, 1, '10', NULL, NULL, NULL),
(83, 5, 7, 19, 2, '4.8333333333333', NULL, NULL, NULL),
(84, 5, 13, 19, 2, '8.3333333333333', NULL, NULL, NULL),
(85, 5, 4, 19, 2, '8.8333333333333', NULL, NULL, NULL),
(86, 5, 4, 36, 2, '7.5', NULL, NULL, NULL),
(87, 5, 13, 36, 2, '7.3333333333333', NULL, NULL, NULL),
(88, 5, 7, 36, 2, '10', NULL, NULL, NULL),
(89, 5, 7, 36, 1, '8', NULL, NULL, NULL),
(90, 5, 13, 36, 1, '8', NULL, NULL, NULL),
(91, 5, 4, 36, 1, '7', NULL, NULL, NULL),
(92, 5, 4, 41, 1, '6.5', NULL, NULL, NULL),
(93, 5, 13, 41, 1, '6', NULL, NULL, NULL),
(94, 5, 7, 41, 1, '9', NULL, NULL, NULL),
(95, 5, 7, 41, 2, '10', NULL, NULL, NULL),
(96, 5, 13, 41, 2, '9.3333333333333', NULL, NULL, NULL),
(97, 5, 4, 41, 2, '8.3333333333333', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_score_average`
--

CREATE TABLE `student_score_average` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `avage_score` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_score_average`
--

INSERT INTO `student_score_average` (`id`, `student_id`, `semester_id`, `avage_score`, `created_at`, `updated_at`, `rank`) VALUES
(139, 41, 3, '8.54', NULL, NULL, 'A'),
(140, 36, 3, '8.08', NULL, NULL, 'A'),
(141, 19, 3, '7.74', NULL, NULL, 'B'),
(142, 11, 3, NULL, NULL, NULL, NULL),
(143, 3, 3, NULL, NULL, NULL, NULL),
(144, 2, 3, NULL, NULL, NULL, NULL),
(145, 19, 1, '8.56', NULL, NULL, NULL),
(146, 19, 2, '7.33', NULL, NULL, NULL),
(147, 36, 2, '8.28', NULL, NULL, NULL),
(148, 36, 1, '7.67', NULL, NULL, NULL),
(149, 41, 1, '7.17', NULL, NULL, NULL),
(150, 41, 2, '9.22', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subject`
--

CREATE TABLE `subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  `status` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subject`
--

INSERT INTO `subject` (`id`, `name`, `type`, `is_delete`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Mathematics', 'Theory', 0, 0, 6, '2023-04-17 22:20:20', '2023-05-21 19:57:39'),
(2, 'Literature', 'Practical', 0, 0, 6, '2023-04-17 22:21:45', '2023-05-21 19:57:50'),
(4, 'English', 'Theory', 0, 0, 6, '2023-04-18 00:27:04', '2023-05-21 19:58:01'),
(6, 'Physics', 'Theory', 0, 0, 6, '2023-04-18 00:28:54', '2023-05-21 19:58:13'),
(7, 'Chemistry', 'Theory', 0, 0, 1, '2023-04-24 03:05:51', '2023-05-21 19:58:25'),
(8, 'Ngoc HUng ne', 'Theory', 1, 0, 1, '2023-04-24 07:04:47', '2023-04-24 07:04:53'),
(9, 'Biology', 'Theory', 0, 0, 1, '2023-04-26 03:17:37', '2023-05-21 19:58:35'),
(10, 'History', 'Theory', 0, 0, 1, '2023-04-26 09:57:42', '2023-05-21 19:58:44'),
(11, 'Geography', 'Theory', 0, 0, 1, '2023-04-26 09:58:00', '2023-05-21 19:58:53'),
(12, 'Technology', 'Theory', 0, 0, 1, '2023-04-26 09:58:55', '2023-05-21 19:59:04'),
(13, 'Computer Science', 'Theory', 0, 0, 1, '2023-04-26 09:59:46', '2023-05-21 19:59:21'),
(14, '123', 'Theory', 1, 0, 1, '2023-04-26 10:00:35', '2023-04-28 03:31:45'),
(15, 'SQL?Oracle', 'Practical', 0, 0, 1, '2023-04-26 10:01:23', '2023-05-06 21:40:18'),
(16, 'Gymnastics/Sports', 'Practical', 0, 0, 1, '2023-04-26 10:01:52', '2023-05-21 20:10:31'),
(17, 'Python', 'Practical', 0, 0, 1, '2023-04-26 10:04:45', '2023-05-06 21:40:46'),
(18, 'Bettie Cremin', 'Eileen Wolff V', 0, 0, 27, '2023-05-09 03:41:46', '2023-05-09 03:41:46'),
(19, 'Dino Miller', 'Miss Aglae Sporer', 1, 0, 27, '2023-05-09 03:41:46', '2023-05-09 03:41:46'),
(20, 'Dr. Katlynn Barton', 'Bobby Corkery', 1, 0, 27, '2023-05-09 03:41:46', '2023-05-09 03:41:46'),
(21, 'Angelica Streich', 'Miss Amy Ebert', 0, 1, 30, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(22, 'Jimmy Lemke', 'Kiera Block', 1, 1, 30, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(23, 'Houston Nicolas IV', 'Miss Brandi Botsford', 1, 0, 30, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(24, 'Grover Botsford', 'Concepcion Marvin IV', 1, 0, NULL, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(25, 'Hattie Bechtelar', 'Prof. Donny Tillman', 1, 0, NULL, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(26, 'Clyde Hilpert', 'Kyra Cruickshank', 0, 0, NULL, '2023-05-09 03:42:04', '2023-05-09 03:42:04'),
(27, 'Hùng đẹp trai', 'Theory', 1, 1, 9, '2023-05-19 00:03:19', '2023-05-19 00:03:27'),
(28, '5', 'Theory', 1, 0, 9, '2023-05-21 20:46:16', '2023-05-21 20:46:23'),
(29, 'Nguyễn Ngọc Hùng', 'Theory', 1, 0, 9, '2023-05-21 21:04:36', '2023-05-21 21:04:43'),
(30, 'Hùng đẹp trai', 'Theory', 1, 0, 9, '2023-05-21 21:06:31', '2023-05-21 21:06:46'),
(31, 'Hùng đẹp trai', 'Theory', 1, 0, 9, '2023-05-21 21:06:32', '2023-05-21 21:06:43'),
(32, 'Margarette Koss DDS', 'Shania Gottlieb DDS', 0, 1, 55, '2023-05-23 03:15:00', '2023-05-23 03:15:00'),
(33, 'Amya Padberg', 'Stacey Bogisich', 0, 1, 55, '2023-05-23 03:15:00', '2023-05-23 03:15:00'),
(34, 'Mrs. Aaliyah Wisozk', 'Reba Schultz', 0, 0, 55, '2023-05-23 03:15:00', '2023-05-23 03:15:00'),
(35, 'Ruth Collier', 'Amir McLaughlin I', 0, 1, 58, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(36, 'Brandon Smitham', 'Oliver Lindgren', 1, 0, 58, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(37, 'Albertha Kilback', 'Mabel Haley', 1, 0, 58, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(38, 'Emile Sanford', 'Okey Pacocha I', 1, 0, NULL, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(39, 'Arnaldo O\'Connell Jr.', 'Carleton Ritchie', 1, 1, NULL, '2023-05-23 03:57:00', '2023-05-23 03:57:00'),
(40, 'Marjolaine Hackett', 'Prof. Kurt Towne', 1, 1, 63, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(41, 'Juana Yundt', 'Shea Powlowski', 0, 1, 63, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(42, 'Andrew Macejkovic', 'Blair Graham DDS', 1, 1, 63, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(43, 'Rozella Anderson', 'Armando Fritsch', 0, 0, NULL, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(44, 'Prof. Jarrell Reichel', 'Mrs. Nelle Treutel DVM', 0, 1, NULL, '2023-05-23 03:57:09', '2023-05-23 03:57:09'),
(45, 'Mr. Deon Senger', 'Brock West', 1, 0, NULL, '2023-05-23 03:57:09', '2023-05-23 03:57:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher_class`
--

CREATE TABLE `teacher_class` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `is_delete` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teacher_class`
--

INSERT INTO `teacher_class` (`id`, `class_id`, `teacher_id`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`, `subject_id`) VALUES
(1, 5, 8, 0, 1, 9, '2023-05-19 00:07:44', '2023-05-21 22:31:05', 7),
(2, 5, 25, 0, 1, 9, '2023-05-19 00:26:46', '2023-05-22 00:33:18', 13),
(13, 2, 21, 0, 1, 9, '2023-05-21 20:04:36', '2023-05-22 00:33:20', 4),
(14, 2, 7, 0, 0, 9, '2023-05-21 22:09:35', '2023-05-21 22:09:35', 7),
(15, 5, 7, 0, 1, 9, '2023-05-21 23:31:19', '2023-05-22 00:33:23', 7),
(16, 2, 25, 0, 0, 9, '2023-05-21 23:40:54', '2023-05-21 23:40:54', 13),
(17, 5, 8, 0, 1, 9, '2023-05-22 00:33:42', '2023-05-25 01:57:47', 7),
(18, 5, 20, 0, 0, 9, '2023-05-23 02:58:59', '2023-05-23 02:58:59', 13),
(19, 5, 21, 0, 0, 9, '2023-05-24 19:54:49', '2023-05-24 19:54:49', 4),
(20, 5, 8, 0, 0, 9, '2023-05-25 01:58:01', '2023-05-25 02:53:32', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_type` tinyint(4) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  `admission_number` varchar(255) DEFAULT NULL,
  `roll_number` varchar(255) DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `user_avatar` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `teacher_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `is_delete`, `admission_number`, `roll_number`, `class_id`, `date_of_birth`, `joining_date`, `gender`, `qualification`, `experience`, `address`, `mobile_number`, `user_avatar`, `status`, `teacher_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `subject_id`, `score`) VALUES
(1, 'Admin', 'admin@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '763/60 Kha vạn cân', '091212345', '283260762_3212821132370597_7886786854533052827_n0.jpg', 0, NULL, NULL, '$2y$10$w9Wk0R2aVFph2ltNaPcE/OQ45vl9wkyOxS1rsK27Vscr9m3pWfFPe', 'H5b7eXC0eo91V2eQumx2CyANTV384CZapTVTeomPoviuwpWx1o4QmHOfs00E', NULL, '2023-04-26 19:30:40', NULL, NULL),
(2, 'Marcus', 'Marcus@gmail.com', 3, 0, '1', '1', 5, '2020-04-15', NULL, 'Male', NULL, NULL, '763/60 Kha vạn cân', '0917214318', '283260762_3212821132370597_7886786854533052827_n14.jpg', 0, NULL, NULL, '$2y$10$SrFEOY9fAt/Vt9dJpXIg1.RKIpiOBqKgXs/pPZgYSlvRaUL8LMM7u', NULL, '2023-04-26 02:38:30', '2023-05-27 08:25:37', NULL, NULL),
(3, 'Codyy', 'cody.nguyen.goldenowl@gmail.com', 3, 0, '2', '2', 5, '2006-04-20', NULL, 'Male', NULL, NULL, '763/60 Kha vạn cân', '0912123456', '310547953_3326544357664940_6449244382606623462_n59.jpg', 0, NULL, NULL, '$2y$10$eLWa998el0rIaFpDyki4NuzghklaEyFe79odtxcVpBpl/hoPqRzRS', NULL, '2023-04-26 02:39:39', '2023-05-27 08:25:37', NULL, NULL),
(4, 'Kelvin', 'Kelvin@gmail', 3, 0, '3', '3', 6, '2014-04-07', NULL, 'Male', NULL, NULL, '763/60 Kha vạn cân', '0912123456', '324077173_3509950659236548_5838072279842512956_n64.jpg', 0, NULL, NULL, '$2y$10$Yo1MH99BR7fWD0nRHIpi3O/CBKb5VPG5GDsTOlvsdv28rk5gw1C.q', NULL, '2023-04-26 02:44:51', '2023-04-26 04:48:42', NULL, NULL),
(6, 'Leo', 'Leo@gmail', 3, 0, '4', '123123', 6, '2020-04-20', NULL, 'Male', NULL, NULL, 'Vietnam', '0912123456', 'images (1)86.jfif', 0, NULL, NULL, '$2y$10$F8p9n0FbnRalPQXKD.axp.QlcOWmD3.1/k10.r5GtvrDHHiGI5LQy', NULL, '2023-04-26 02:48:13', '2023-05-07 00:07:52', NULL, NULL),
(7, 'Danny', 'Danny@gmail', 2, 0, NULL, NULL, NULL, '2020-05-20', '2020-05-20', 'Male', 'Thac si', '1 Year', 'Thu Duc HO chi Minh1111', '0912123456', '324077173_3509950659236548_5838072279842512956_n48.jpg', 0, '1', NULL, '$2y$10$hFN4G4YvR/BKunRKpFNP3OexmmWZuKNfbMQbEaIkO1YZRDibeuB52', NULL, '2023-04-26 02:53:45', '2023-05-25 00:44:11', 7, NULL),
(8, 'Tammie', 'Tammie@gmail', 2, 0, NULL, NULL, NULL, '2020-04-20', '2020-05-20', 'Male', 'Thac si', '4year', '763/60 Kha vạn cân', '0912123456', '283260762_3212821132370597_7886786854533052827_n46.jpg', 0, '2', NULL, '$2y$10$kwHtyeM02KwRok.REnclIuSm5tba4Wwqlk0rTMhcb8PvEc.M5Z//S', NULL, '2023-04-26 04:10:40', '2023-05-21 19:59:42', 7, NULL),
(9, 'Tonio', 'Tonio@gmail', 1, 0, '0912123456', '123123', 2, '2029-03-05', NULL, 'Select Gender', NULL, NULL, NULL, '0912123456', 'T0FJW964D-U010CR28E3D-4959bb755da8-512 (1)78.jfif', 0, NULL, NULL, '$2y$10$9tCeko/E6Xm3Ng957erYQuEYYRfeZFsgKVCtQ/i14EXOGrsB22xNy', NULL, '2023-04-26 04:50:38', '2023-05-14 07:11:21', NULL, NULL),
(10, 'Charlie', 'Charlie@gmail', 2, 0, NULL, NULL, NULL, '2020-04-20', '2016-05-20', 'Male', 'Thac si', '4year', '763/60 Kha vạn cân', '0912123456', '310547953_3326544357664940_6449244382606623462_n29.jpg', 0, '3', NULL, '$2y$10$YyUGjefVnUMbuHp/cP777e.SVvVz8nASbJbBb8PO6ABXAA.KVrCzC', 'f5D8FVwa9oMKHo7wzxU0ABTwi2cjE3ee3JskYNE2tuRedHVgLjPPE3Ip16gE', '2023-04-26 10:13:20', '2023-05-21 20:00:09', 13, NULL),
(11, 'logan', 'logan@gmail.com', 3, 0, '111', '4', 5, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '11311331133', 'images18.jfif', 0, NULL, NULL, '$2y$10$1D.tMpYYLH6qAMKPvRK1ouePQCC.awV1OppG1ZZyQX0BPjgBuAtaq', NULL, '2023-05-06 21:05:01', '2023-05-27 08:25:37', NULL, '7.33'),
(12, 'Jayden', 'Jayden@gmail.com', 3, 0, '1111', '123123', 3, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '1123123123', 'tải xuống75.jfif', 0, NULL, NULL, '$2y$10$rksPAaxABOp/MWAUA4MAeeeVx/r8aewuObFHjfabfEg9g7Hx.y86W', NULL, '2023-05-06 21:06:28', '2023-05-06 21:06:28', NULL, NULL),
(13, 'John', 'John@gmail', 3, 0, '10123', '1111', 6, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '0917214318', 'tải xuống (1)90.jfif', 0, NULL, NULL, '$2y$10$U0dU33xvdi6aW2ylav.zTuefXuTvPpp.9/y.OvJYIlngseKhvJdKC', NULL, '2023-05-06 21:08:24', '2023-05-06 21:08:24', NULL, NULL),
(14, 'Simon', 'simon@gmail.com', 3, 0, '12312', '1212', 24, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '0917214318', 'tải xuống (2)94.jfif', 0, NULL, NULL, '$2y$10$j7VVipiBfPxAsss89.IfmOgY9yepV2oQRS7YiXGRY.7lz7zq3vS9K', NULL, '2023-05-06 21:09:40', '2023-05-06 21:09:40', NULL, NULL),
(15, 'Derek', 'Derek@gmail.com', 3, 0, '123121', '123123', 24, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '091919191', 'images (1)5.jfif', 0, NULL, NULL, '$2y$10$F4UOnz40UrppoPGxJvqUmex6F48r0XaHi.TCGjnk7FCwWHsq5d616', NULL, '2023-05-06 21:10:48', '2023-05-06 21:10:48', NULL, NULL),
(16, 'Jenna', 'Jenna@gmail', 3, 0, '1231211', '123123', 24, '0000-00-00', NULL, 'Female', NULL, NULL, NULL, '0917214318', 'tải xuống88.jfif', 0, NULL, NULL, '$2y$10$aNzCaNYvPAvUuirb6tWEFelb1UmBrSdpiRTa1YEBjcjW7ygDa7mcC', NULL, '2023-05-06 21:13:06', '2023-05-06 21:13:06', NULL, NULL),
(17, 'Bryan', 'Bryan@gmail.com', 3, 0, '151', '01', 24, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '0969696969111', 'images14.png', 0, NULL, NULL, '$2y$10$i.LVzF8QGL4MUizRI.AsOufXRWwbKSDUyHuPA64RelVd/0IMeZSmK', NULL, '2023-05-06 21:15:29', '2023-05-06 21:15:29', NULL, NULL),
(18, 'Phoebe', 'Phoebe@gmail.com', 3, 0, '15111', '111112', 24, '2023-05-07', NULL, 'Female', NULL, NULL, 'Tonio@gmail', '0917214318', 'T0FJW964D-U04N5DMFE2W-065a95d3b87b-51221.png', 0, NULL, NULL, '$2y$10$6feKkoeySdFVVSsTDq.vc.5/clnsY8rmQ9uYmqn.fgycHOo45r0T6', NULL, '2023-05-06 21:17:25', '2023-05-11 01:56:52', NULL, NULL),
(19, 'Jade', 'Jade@gmail.com', 3, 0, '15111122', '123', 5, '2020-05-20', NULL, 'Female', NULL, NULL, '123123123', '0917214318', 'T0FJW964D-U04RUHB47T6-c9e07f92cc9e-51218.png', 0, NULL, NULL, '$2y$10$TErY0aGhAQ20pyU3bHAH8u3vGtWsiumoP7EuPZ37tpILgWlC4no3m', NULL, '2023-05-06 21:19:18', '2023-05-27 08:25:37', NULL, '8.33'),
(20, 'Justin', 'Justin@gmail.com', 2, 0, NULL, NULL, NULL, '2004-05-20', '2023-05-22', 'Male', 'CEO', '4year', 'An loi dong', '0917214318', 'tải xuống (3)95.jfif', 0, '6', NULL, '$2y$10$wzWaEeUoFTzrPzlCz7.EzeTc4miQLkmxMS8bjjrnGO.flFw8/8lXC', NULL, '2023-05-06 21:27:07', '2023-05-21 20:00:25', 13, NULL),
(21, 'Oscar', 'Teacher1@gmail', 2, 0, NULL, NULL, NULL, '2011-05-20', '2023-05-09', 'Male', 'Senior', '1 Year', '763/60 Kha vạn cân', '0969645845', 'T0FJW964D-U051NENR19U-e0cc3b731ceb-51245.png', 0, '5', NULL, '$2y$10$Mq68zofAEU8kiR2xwetM/.wYC2U9jhfSeeYXl.ZBd5mMb4MDEv18a', NULL, '2023-05-06 21:29:46', '2023-05-21 20:00:42', 4, NULL),
(22, 'Bill', 'Bill@gmail.com', 2, 0, NULL, NULL, NULL, '2007-05-20', '2023-05-22', 'Male', 'Intern', '1 Month', '45454545', '0917214318', 'T0FJW964D-U051EGLDUTH-a029ddd504ab-51283.jfif', 0, '4', NULL, '$2y$10$u6TRFx4Dju42juCUNTdwSuewXp50BX5a7BkVdS.Eo0qC9VL73UDiW', NULL, '2023-05-06 21:30:59', '2023-05-21 20:01:09', 4, NULL),
(23, 'Isaac', 'Isaac@gmail.com', 2, 0, NULL, NULL, NULL, '2003-05-20', '2023-05-15', 'Male', 'Fresher', '2 year', '763/60 Kha vạn cân', '091919191', 'T0FJW964D-U03NTLV8YAV-3f3cc4bd5bb8-51242.png', 0, '7', NULL, '$2y$10$LHTR7Y6KPASfk76c3JElke081be2RdST9rr.sRm4aYXxgl7FRUUIK', NULL, '2023-05-06 21:32:49', '2023-05-21 20:01:22', 11, NULL),
(24, 'Gwen', 'Gwen@gmail.com', 2, 0, NULL, NULL, NULL, '2004-05-20', '2023-05-29', 'Female', 'PC Fresher', '1 Year', '44e An loi DOng quan 2', '0917214318', 'T0FJW964D-U04744PRTSM-24f546a03c3a-51287.png', 0, '9', NULL, '$2y$10$0mUw2ohmaQ70cHFqFkcxiO9vwD5XANEY28xtO5EbdqPL57IKWzI2C', NULL, '2023-05-06 21:35:05', '2023-05-21 20:01:34', 10, NULL),
(25, 'Baron', 'Baron@gmail.com', 2, 0, NULL, NULL, NULL, '2001-05-20', '2023-05-30', 'Male', 'Thac si', '1 Year', '45454545', '0917214318', 'T0FJW964D-U010CR28E3D-4959bb755da8-512 (1)95.jfif', 0, '10', NULL, '$2y$10$H7USXhwS/3eWWuQrtZ9VUuH.PYioLbrcQeuOs6.cS2NPWy9m0k61K', NULL, '2023-05-06 21:37:01', '2023-05-19 00:26:16', 13, NULL),
(26, 'Mr. Nat Bergstrom', 'candace29@example.org', 1, 0, '76061', '2219', NULL, '1995-10-19', '1994-09-11', 'male', 'Data Processing Equipment Repairer', 'Perspiciatis dignissimos debitis quaerat consequatur aliquid.', '199 O\'Kon Ports Apt. 709\nPort Keithfurt, FL 83475', '+1-623-674-6489', NULL, 1, '577', '2023-05-09 03:41:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'v8diofAI8H', '2023-05-09 03:41:46', '2023-05-09 03:41:46', NULL, NULL),
(27, 'Mr. Davion Bahringer II', 'ogoyette@example.com', 1, 0, '845812745', '69', NULL, '2019-11-23', '2012-12-30', 'male', 'Psychiatric Aide', 'Dolore harum minus ab dolores quidem aliquam.', '5979 Lexus Tunnel Suite 622\nEast Samanthaland, TN 71290', '(760) 895-5585', NULL, 0, '259', '2023-05-09 03:41:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ECnR4uK8PN', '2023-05-09 03:41:46', '2023-05-09 03:41:46', NULL, NULL),
(28, 'Rodolfo Dare', 'fae.gulgowski@example.com', 1, 0, '9', '271', NULL, '2015-11-24', '1987-03-20', 'female', 'Economics Teacher', 'Illo illo natus atque.', '69581 Kayla Wells Suite 939\nBergstromton, OH 43873', '1-580-986-1118', NULL, 1, '112680', '2023-05-09 03:41:47', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Tg1J3bUsXi', '2023-05-09 03:41:47', '2023-05-09 03:41:47', NULL, NULL),
(29, 'Mr. Lorenzo Gleason PhD', 'tate.lebsack@example.net', 2, 1, '731999', '376072', NULL, '1974-02-26', '1977-08-20', 'male', 'Food Preparation', 'Voluptatem est laboriosam consequatur quod eos.', '906 Kris Land\nLake Bettye, IA 87385-8201', '+16782060489', NULL, 0, '30574221', '2023-05-09 03:42:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ReDLZeDD2r', '2023-05-09 03:42:04', '2023-05-18 23:20:12', NULL, NULL),
(30, 'Kareem Ondricka', 'arielle64@example.net', 2, 1, '97', '14916076', NULL, '2002-07-02', '1990-07-14', 'male', 'Gaming Cage Worker', 'Voluptatibus iste doloribus sed aliquid nesciunt soluta officiis.', '6476 Ledner Stravenue\nZoieburgh, AZ 54213', '+1-917-494-6270', NULL, 0, '9470940', '2023-05-09 03:42:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9W3ZjjMtyj', '2023-05-09 03:42:04', '2023-05-09 03:42:04', NULL, NULL),
(31, 'Prof. Kareem Klocko MD', 'lboehm@example.org', 1, 0, '99', '1', NULL, '2009-10-28', '2008-03-20', 'female', 'Glass Blower', 'Minima deserunt delectus sunt qui aut.', '409 Benjamin Trail Apt. 555\nKamrynburgh, MA 13059', '682.292.1161', NULL, 1, '97955', '2023-05-09 03:42:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0AgcmWtQfE', '2023-05-09 03:42:04', '2023-05-09 03:42:04', NULL, NULL),
(32, 'Marcelo Torp', 'grayce41@example.org', 3, 1, '98509750', '199', NULL, '1986-04-15', '2005-11-04', 'male', 'Stock Clerk', 'Vel eaque optio exercitationem voluptas et hic.', '2010 Berenice Glen\nLubowitzfort, UT 88657', '+15155388225', NULL, 0, '93873', '2023-05-09 03:42:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SvyuuoCyhE', '2023-05-09 03:42:04', '2023-05-09 03:42:04', NULL, NULL),
(33, 'Darby Kub', 'uortiz@example.org', 1, 1, '41761', '6728338', NULL, '2007-05-01', '2003-07-19', 'male', 'Compacting Machine Operator', 'Consequatur unde corrupti saepe sunt.', '109 Nikki Flats\nMontybury, OR 36331-0626', '234.362.3785', NULL, 0, '911431365', '2023-05-09 03:42:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'B5lL4okVwT', '2023-05-09 03:42:04', '2023-05-09 03:42:04', NULL, NULL),
(34, 'Ross Mante', 'alvina.borer@example.org', 3, 0, '5', '41141213', NULL, '2008-01-08', '2022-07-24', 'female', 'Psychologist', 'Qui nulla a harum necessitatibus.', '7537 Rice Cove Suite 277\nEast Nathaniel, SC 47926', '+1-949-740-7569', NULL, 1, '89783964', '2023-05-09 03:42:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1YieKxLSf2', '2023-05-09 03:42:04', '2023-05-09 03:42:04', NULL, NULL),
(35, 'Hùng đẹp trai', '19521573@gm.uit.edu.vn', 3, 0, '123', '123123', 2, '2023-05-07', NULL, 'Female', NULL, NULL, '45454545', '0917214318', 'T0FJW964D-U010CR28E3D-4959bb755da8-51288.jfif', 0, NULL, NULL, '$2y$10$LZ/Y1zWiBa9gUTuLjlJGVunGuwXZnohjcAcTUtzd/yzl1Ji1AICXW', NULL, '2023-05-10 01:27:27', '2023-05-11 01:57:16', NULL, NULL),
(36, 'Hùng đẹp trai1', '19521573@gmail.com', 3, 0, '12312311', '1231231111', 5, '2023-05-08', NULL, 'Female', NULL, NULL, '45454545', '0917214318', 'tải xuống11.jfif', 0, NULL, NULL, '$2y$10$JUcZjpuyoaHcS0NGWEbts.RoioqHbr4lLHkHp/aYGmW6EXdytXfQC', NULL, '2023-05-11 02:00:05', '2023-05-27 08:25:37', NULL, NULL),
(37, 'Hùng đẹp trai', '123@gmail', 2, 1, NULL, NULL, NULL, '2023-05-08', '2023-05-08', 'Female', '123', '123', '45454545', '0917214318', 'T0FJW964D-U010CR28E3D-4959bb755da8-512 (1)82.jfif', 0, '112', NULL, '$2y$10$4827QAMWX9OihyJfCtNln.xXazNkY1w42t.WhFfW22JXQABo3BqBe', NULL, '2023-05-11 02:28:53', '2023-05-18 23:21:29', NULL, NULL),
(38, 'Max', 'Max@gmail.com', 2, 0, NULL, NULL, NULL, '2014-05-20', '2008-05-20', 'Male', '1124', '4', 'Golden owl quan 2 ,thanh pho ho chi minh', '0917214318', 'T0FJW964D-U051NENR19U-e0cc3b731ceb-51290.png', 0, '15', NULL, '$2y$10$iTXa/y27SPvtMaMIPgZPCe7XtvkukKa07RyM3SPGL81c9fuLtRXbC', NULL, '2023-05-14 06:54:06', '2023-05-19 00:07:23', 7, NULL),
(39, 'Alex', 'Alex@gmail.com', 2, 0, NULL, NULL, NULL, '2002-05-20', '2008-05-20', 'Male', 'thac si', '4', '45454545', '0917214318', 'T0FJW964D-U010CR28E3D-4959bb755da8-51218.jfif', 0, '16', NULL, '$2y$10$PafK9W2AyMK9M5qwZLlqXuQNqjRjDKQfLSOWxmrsbUeX86znOakZm', NULL, '2023-05-14 06:55:45', '2023-05-21 20:01:47', 1, NULL),
(40, 'Simon', 'simon@gmail', 3, 0, 'Danny', 'A12', 2, '2016-05-20', NULL, 'Female', NULL, NULL, 'KHa van can thu duc', '0917214318', 'T0FJW964D-U010CR28E3D-4959bb755da8-51228.jfif', 0, NULL, NULL, '$2y$10$WlZypA2Tzf3PznjmbkPAX.XcL1x6khuQKHHCyz9Lq2mHQZLPVmdie', NULL, '2023-05-14 07:00:19', '2023-05-14 07:03:13', NULL, NULL),
(41, 'Hùng', '11111@gmail', 3, 0, '125125', '12355125', 5, '2020-05-20', NULL, 'Male', NULL, NULL, '123123', '12312321312', NULL, 0, NULL, NULL, '$2y$10$tGForjLMBMPyLmj3ZHWV0ujvWNZusNJm48O/5c/pj0Jc9s3XqFJRK', NULL, '2023-05-18 21:27:14', '2023-05-27 08:25:37', NULL, NULL),
(42, '123123', '123123@gmail', 3, 1, '125125125', '123123', 5, '2016-05-20', NULL, 'Male', NULL, NULL, '123123213', '123123123123', 'T0FJW964D-U010CR28E3D-4959bb755da8-5127.jfif', 0, NULL, NULL, '$2y$10$Tu.PZTNNupjIE645.T2njeMQoPIxsQ1ssGhNb5bOq0LBrt8H.ngp.', NULL, '2023-05-18 21:41:19', '2023-05-18 22:17:05', NULL, NULL),
(43, 'Neil', '12312312@gmail', 3, 0, '123123', '123123', 2, '2016-05-20', NULL, 'Female', NULL, NULL, '123123123123', '123123123', 'T0FJW964D-U04N5DMFE2W-065a95d3b87b-51271.png', 0, NULL, NULL, '$2y$10$w.ONh2B2aumGfXpLf1kSEOlysHVqn1sE5InCNPl9upJl4VaSYgGEW', NULL, '2023-05-18 21:55:17', '2023-05-21 20:03:19', NULL, NULL),
(44, 'Tonio', 'Tonio@gmail.commmm', 3, 0, '45454545123123', '123123123', 2, '2016-05-20', NULL, 'Male', NULL, NULL, '763/60 Kha vạn cân', '09121234561', 'images37.jfif', 0, NULL, NULL, '$2y$10$gvs1WtlHSQb.gdJvWwWGhOGNve05hY/3cWlabCUW6mxmg33zb/zpG', NULL, '2023-05-18 22:05:03', '2023-05-21 20:03:37', NULL, NULL),
(45, '123123', '12312512521@gmail', 3, 1, '123123123', '123123', 4, '2023-05-10', NULL, 'Male', NULL, NULL, '123123123123123', '123123123', NULL, 0, NULL, NULL, '$2y$10$TFHOYVsOowHZSSTlLYTlt.kiUcyXcHmKPKNYASU9O6R3QZza0Ma3G', NULL, '2023-05-18 22:07:44', '2023-05-18 23:20:56', NULL, NULL),
(46, '123123123', 'macu@gmail', 2, 1, NULL, NULL, NULL, '2023-05-16', '2023-05-15', 'Others', '123123', '123123', '763/60 Kha vạn cân', '0912123456', 'tải xuống (2)64.jfif', 0, '123123', NULL, '$2y$10$s/fxLvBgrEMDzcTWqU6UdORlfBlfC6KRoge7.gKo/o0PiYDgjeaZq', NULL, '2023-05-18 23:18:26', '2023-05-18 23:18:41', 10, NULL),
(47, NULL, 'Jade111@gmail.com', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '', NULL, '2023-05-19 02:55:34', '2023-05-19 02:55:34', NULL, NULL),
(48, NULL, 'Jad11e@gmail.com', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '', NULL, '2023-05-19 02:55:59', '2023-05-19 02:55:59', NULL, NULL),
(49, '123', 'Jad11e@gmail.com123', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '$2y$10$M9n1JOg0ZTnlfRcUi5vz2.H3pbRITL.wcb2w6wxrauMYcBxa4TKIS', NULL, '2023-05-19 02:59:25', '2023-05-19 03:03:51', NULL, NULL),
(51, 'Tracey Swaniawski', 'yoshiko58@example.net', 1, 0, '969739', '4251', NULL, '1989-04-19', '2016-09-23', 'male', 'Furnace Operator', 'Similique ex eveniet nihil minus sit.', '1222 Ashley Valleys\nEast Felicia, IA 83160', '+1-201-831-3387', NULL, 0, '126011', '2023-05-23 03:14:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'PypfKE2BFe', '2023-05-23 03:14:00', '2023-05-23 03:14:00', NULL, NULL),
(54, 'Melissa Hoeger', 'gkrajcik@example.com', 1, 1, '184693829', '822383823', NULL, '1986-03-30', '1970-05-27', 'male', 'Council', 'Enim aliquam officiis voluptatem et accusamus enim.', '980 Orn Extensions Suite 741\nGrantside, NY 97723', '(629) 329-6858', NULL, 0, '879982', '2023-05-23 03:15:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zJB90OVHo0', '2023-05-23 03:15:00', '2023-05-23 03:15:00', NULL, NULL),
(55, 'Prof. Forest Wintheiser', 'anderson.mayert@example.org', 1, 1, '5841908', '892', NULL, '1971-07-08', '1976-03-18', 'male', 'Fraud Investigator', 'Consequuntur corporis delectus ex sunt laboriosam harum.', '91607 Nakia Lane Suite 937\nSouth Maribelchester, CA 02587', '539-949-6144', NULL, 1, '885404', '2023-05-23 03:15:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fkCbxyLxOZ', '2023-05-23 03:15:00', '2023-05-23 03:15:00', NULL, NULL),
(57, 'Naomie Langworth', 'kristy10@example.com', 1, 0, '797534967', '607328705', NULL, '1973-11-29', '2009-04-16', 'female', 'Economist', 'Est nobis eos dicta non quia officiis harum.', '6607 Regan Port\nItzelbury, WY 77966-4245', '+1 (207) 506-7645', NULL, 1, '0', '2023-05-23 03:56:59', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GJfcRAffYv', '2023-05-23 03:57:00', '2023-05-23 03:57:00', NULL, NULL),
(58, 'Russel Torp PhD', 'brekke.chadd@example.net', 3, 0, '493', '759937', NULL, '2004-08-09', '1988-11-03', 'male', 'Chemical Equipment Controller', 'Qui temporibus quibusdam exercitationem et.', '595 Watsica Roads\nLake Wilburnfurt, WA 70914-7189', '941.435.3078', NULL, 1, '594', '2023-05-23 03:57:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FPUQWDNheW', '2023-05-23 03:57:00', '2023-05-23 03:57:00', NULL, NULL),
(59, 'Duane Schulist', 'roslyn56@example.com', 3, 1, '797959056', '2', NULL, '2010-12-14', '2019-09-05', 'male', 'Photographer', 'Assumenda ea adipisci nisi quidem adipisci eligendi ullam.', '8225 Marcellus View\nWunschberg, TN 91993-9131', '678.774.3306', NULL, 0, '79513236', '2023-05-23 03:57:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QHrsdKB83x', '2023-05-23 03:57:00', '2023-05-23 03:57:00', NULL, NULL),
(60, 'Lora Botsford', 'wehner.sanford@example.net', 2, 0, '70072', '461813297', NULL, '1970-04-08', '2009-01-28', 'female', 'Soil Scientist', 'A illum dolores beatae eligendi dolores.', '29102 Ressie Isle\nO\'Keefechester, WY 73474', '1-678-481-8625', NULL, 1, '52342254', '2023-05-23 03:57:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3HfHRwHXzm', '2023-05-23 03:57:00', '2023-05-23 03:57:00', NULL, NULL),
(62, 'Ms. Naomie Hartmann II', 'prosacco.jasper@example.org', 3, 1, '62947703', '430', NULL, '2011-06-13', '1979-01-29', 'male', 'Human Resource Director', 'Nostrum quia laboriosam laudantium est quo quasi.', '192 Toy Well\nJacksonchester, VT 36937-1548', '678-513-3620', NULL, 1, '3761', '2023-05-23 03:57:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vpOgD7yZlN', '2023-05-23 03:57:09', '2023-05-23 03:57:09', NULL, NULL),
(63, 'Reanna Kassulke', 'lang.dameon@example.org', 1, 1, '211155', '29804', NULL, '1974-11-14', '1986-05-05', 'female', 'General Farmworker', 'Voluptatem et et laudantium id odit a.', '864 Guillermo Expressway Apt. 145\nMelyssabury, ND 25969', '+13152244212', NULL, 0, '8427722', '2023-05-23 03:57:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vj6NPLbYJs', '2023-05-23 03:57:09', '2023-05-23 03:57:09', NULL, NULL),
(64, 'Vicente Anderson', 'ofriesen@example.net', 3, 0, '13', '76399', NULL, '1976-12-11', '1985-05-16', 'male', 'Tool Sharpener', 'Eius id dicta et dolorem et sit.', '79609 Kreiger Port\nWest Hannahburgh, SC 16303-2088', '+17624069729', NULL, 1, '233876', '2023-05-23 03:57:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ZiiGIe6mws', '2023-05-23 03:57:09', '2023-05-23 03:57:09', NULL, NULL),
(65, 'Cassie Kuhlman', 'hirthe.martina@example.org', 1, 1, '42256092', '742475028', NULL, '1995-07-26', '2011-10-19', 'male', 'Electronic Masking System Operator', 'Quo corrupti error non.', '48270 Carmine Island\nHiramborough, WY 08157-6635', '+15398421330', NULL, 0, '6150', '2023-05-23 03:57:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zlQWqkb7H5', '2023-05-23 03:57:09', '2023-05-23 03:57:09', NULL, NULL),
(66, 'Waino Gusikowski', 'dicki.norberto@example.net', 1, 0, '4610143', '15767799', NULL, '1984-02-06', '2017-01-30', 'female', 'Atmospheric and Space Scientist', 'Inventore assumenda qui ipsum est est.', '31303 Schmitt Tunnel\nNorth Molly, CA 15112-2177', '+1.435.741.8683', NULL, 1, '84589', '2023-05-23 03:57:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cu2AvaSwHV', '2023-05-23 03:57:09', '2023-05-23 03:57:09', NULL, NULL),
(67, 'Ferne Boyle', 'fanny.vandervort@example.org', 1, 0, '146', '760958288', NULL, '1981-07-14', '1974-09-17', 'male', 'Pediatricians', 'Et ad beatae qui ut reiciendis quisquam eligendi.', '5010 Mariah Walk Apt. 901\nMayermouth, AK 55702', '+1-845-626-7858', NULL, 1, '9904', '2023-05-23 03:57:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hNAGOuCPs4', '2023-05-23 03:57:09', '2023-05-23 03:57:09', NULL, NULL),
(68, 'May', 'May@gmail.com', 2, 0, NULL, NULL, NULL, '2015-05-20', '2025-05-20', 'Female', 'Thac si', '4year', '45454545', '123123', 'T0FJW964D-U051NENR19U-e0cc3b731ceb-51225.png', 0, 'Teacherd9255', NULL, '$2y$10$Zgl8j/SrUF/N6S3FH0VcSuxaFQV1hz0YeJcRBWapBn/D1H98pmHgu', NULL, '2023-05-25 03:38:40', '2023-05-25 03:40:20', 7, NULL),
(69, 'Hùng đẹp trai123', 'student@gmail', 3, 0, 'Studentce423', '123', 2, '2023-05-09', NULL, 'Male', NULL, NULL, '45454545', '0917214318', 'T0FJW964D-U017K0KGVGE-3cfd9f23fed9-51277.png', 0, NULL, NULL, '$2y$10$yW7AZmUfSXDMvg.PUtrcp.06lt6zo/vHjYaAxnY4upDPE50ftFXRW', NULL, '2023-05-25 03:47:30', '2023-05-25 03:47:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `date_visitor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `date_visitor`) VALUES
(1, '127.0.0.1', '2023-05-26');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `class_subject`
--
ALTER TABLE `class_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_subject_class_id_foreign` (`class_id`),
  ADD KEY `class_subject_subject_id_foreign` (`subject_id`);

--
-- Chỉ mục cho bảng `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_subject_timetable_class_id_foreign` (`class_id`),
  ADD KEY `class_subject_timetable_subject_id_foreign` (`subject_id`),
  ADD KEY `class_subject_timetable_day_id_foreign` (`day_id`),
  ADD KEY `class_subject_timetable_semester_id_foreign` (`semester_id`);

--
-- Chỉ mục cho bảng `day_of_week`
--
ALTER TABLE `day_of_week`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_schedule_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_schedule_class_id_foreign` (`class_id`),
  ADD KEY `exam_schedule_subject_id_foreign` (`subject_id`),
  ADD KEY `exam_schedule_semester_id_foreign` (`semester_id`);

--
-- Chỉ mục cho bảng `exam_score`
--
ALTER TABLE `exam_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_score_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_score_class_id_foreign` (`class_id`),
  ADD KEY `exam_score_subject_id_foreign` (`subject_id`),
  ADD KEY `exam_score_student_id_foreign` (`student_id`),
  ADD KEY `exam_score_semester_id_foreign` (`semester_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `student_score`
--
ALTER TABLE `student_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_score_class_id_foreign` (`class_id`),
  ADD KEY `student_score_subject_id_foreign` (`subject_id`),
  ADD KEY `student_score_student_id_foreign` (`student_id`),
  ADD KEY `student_score_semester_id_foreign` (`semester_id`);

--
-- Chỉ mục cho bảng `student_score_average`
--
ALTER TABLE `student_score_average`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_score_average_student_id_foreign` (`student_id`),
  ADD KEY `student_score_average_semester_id_foreign` (`semester_id`);

--
-- Chỉ mục cho bảng `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `teacher_class`
--
ALTER TABLE `teacher_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_class_class_id_foreign` (`class_id`),
  ADD KEY `teacher_class_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_class_subject_id_foreign` (`subject_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_admission_number_unique` (`admission_number`),
  ADD UNIQUE KEY `users_teacher_id_unique` (`teacher_id`),
  ADD KEY `users_class_id_foreign` (`class_id`),
  ADD KEY `users_subject_id_foreign` (`subject_id`);

--
-- Chỉ mục cho bảng `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `class`
--
ALTER TABLE `class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `class_subject`
--
ALTER TABLE `class_subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT cho bảng `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT cho bảng `day_of_week`
--
ALTER TABLE `day_of_week`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `exam_score`
--
ALTER TABLE `exam_score`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2195;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `semester`
--
ALTER TABLE `semester`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `student_score`
--
ALTER TABLE `student_score`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT cho bảng `student_score_average`
--
ALTER TABLE `student_score_average`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT cho bảng `subject`
--
ALTER TABLE `subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `teacher_class`
--
ALTER TABLE `teacher_class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `class_subject`
--
ALTER TABLE `class_subject`
  ADD CONSTRAINT `class_subject_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `class_subject_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Các ràng buộc cho bảng `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  ADD CONSTRAINT `class_subject_timetable_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `class_subject_timetable_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `day_of_week` (`id`),
  ADD CONSTRAINT `class_subject_timetable_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`),
  ADD CONSTRAINT `class_subject_timetable_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Các ràng buộc cho bảng `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD CONSTRAINT `exam_schedule_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `exam_schedule_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `exam_schedule_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`),
  ADD CONSTRAINT `exam_schedule_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Các ràng buộc cho bảng `exam_score`
--
ALTER TABLE `exam_score`
  ADD CONSTRAINT `exam_score_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `exam_score_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `exam_score_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`),
  ADD CONSTRAINT `exam_score_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `exam_score_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Các ràng buộc cho bảng `student_score`
--
ALTER TABLE `student_score`
  ADD CONSTRAINT `student_score_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `student_score_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`),
  ADD CONSTRAINT `student_score_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_score_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Các ràng buộc cho bảng `student_score_average`
--
ALTER TABLE `student_score_average`
  ADD CONSTRAINT `student_score_average_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`),
  ADD CONSTRAINT `student_score_average_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `teacher_class`
--
ALTER TABLE `teacher_class`
  ADD CONSTRAINT `teacher_class_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `teacher_class_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `teacher_class_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `users_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
