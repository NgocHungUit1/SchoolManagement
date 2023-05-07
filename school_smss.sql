-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 07, 2023 lúc 12:54 PM
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
(4, '11A', 1, 0, 1, '2023-04-17 20:46:23', '2023-04-17 23:35:36'),
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
(22, '123123', 0, 1, 1, '2023-04-26 09:48:13', '2023-05-06 21:21:13'),
(23, 'Tonio', 1, 1, 1, '2023-04-26 09:54:13', '2023-05-06 21:21:07'),
(24, 'CNPM', 0, 0, 1, '2023-04-27 21:05:04', '2023-04-27 21:05:04');

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
(79, 5, 10, 0, 0, 9, '2023-05-06 23:51:59', '2023-05-06 23:51:59'),
(80, 5, 9, 0, 0, 9, '2023-05-06 23:51:59', '2023-05-06 23:51:59'),
(81, 5, 11, 0, 0, 9, '2023-05-06 23:51:59', '2023-05-06 23:51:59'),
(82, 5, 13, 0, 0, 9, '2023-05-06 23:51:59', '2023-05-06 23:51:59'),
(83, 5, 7, 0, 0, 9, '2023-05-06 23:51:59', '2023-05-06 23:51:59'),
(84, 5, 4, 0, 0, 9, '2023-05-06 23:51:59', '2023-05-06 23:51:59'),
(85, 5, 16, 0, 0, 9, '2023-05-06 23:51:59', '2023-05-06 23:51:59'),
(86, 5, 2, 0, 0, 9, '2023-05-06 23:51:59', '2023-05-06 23:51:59'),
(87, 5, 12, 0, 0, 9, '2023-05-06 23:51:59', '2023-05-06 23:51:59'),
(88, 6, 9, 0, 0, 9, '2023-05-06 23:52:12', '2023-05-06 23:52:12'),
(89, 6, 7, 0, 0, 9, '2023-05-06 23:52:12', '2023-05-06 23:52:12'),
(90, 6, 4, 0, 0, 9, '2023-05-06 23:52:12', '2023-05-06 23:52:12'),
(91, 6, 16, 0, 0, 9, '2023-05-06 23:52:12', '2023-05-06 23:52:12'),
(92, 6, 2, 0, 0, 9, '2023-05-06 23:52:12', '2023-05-06 23:52:12'),
(93, 6, 12, 0, 0, 9, '2023-05-06 23:52:12', '2023-05-06 23:52:12'),
(94, 24, 2, 0, 0, 9, '2023-05-06 23:52:21', '2023-05-06 23:52:21'),
(95, 24, 12, 0, 0, 9, '2023-05-06 23:52:21', '2023-05-06 23:52:21'),
(96, 24, 17, 0, 0, 9, '2023-05-06 23:52:21', '2023-05-06 23:52:21'),
(97, 24, 6, 0, 0, 9, '2023-05-06 23:52:21', '2023-05-06 23:52:21'),
(98, 24, 15, 0, 0, 9, '2023-05-06 23:52:21', '2023-05-06 23:52:21');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class_subject_timetable`
--

INSERT INTO `class_subject_timetable` (`id`, `class_id`, `subject_id`, `day_id`, `start_time`, `end_time`, `room_number`, `created_at`, `updated_at`) VALUES
(28, 5, 12, 1, '19:53', '23:53', 'C108', '2023-05-06 23:53:37', '2023-05-06 23:53:37'),
(29, 5, 2, 1, '15:53', '17:53', 'C308', '2023-05-06 23:53:50', '2023-05-06 23:53:50'),
(30, 5, 16, 4, '16:53', '19:54', 'A107', '2023-05-06 23:54:07', '2023-05-06 23:54:07'),
(31, 5, 4, 6, '17:54', '12:54', 'B302', '2023-05-06 23:54:26', '2023-05-06 23:54:26'),
(32, 6, 12, 3, '15:54', '18:54', 'C101', '2023-05-06 23:54:51', '2023-05-06 23:54:51'),
(33, 6, 16, 2, '16:54', '19:55', '123', '2023-05-06 23:55:05', '2023-05-06 23:55:05');

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
(7, 'Mid-term test', '30% score', 0, 9, '2023-05-06 21:44:34', '2023-05-06 21:44:34'),
(8, 'Final exam', '50%', 0, 9, '2023-05-06 21:44:50', '2023-05-06 21:44:50'),
(9, 'Practice test', '20%', 0, 9, '2023-05-06 21:45:03', '2023-05-06 21:45:03'),
(10, 'process check exam', '10%', 0, 9, '2023-05-06 21:45:31', '2023-05-06 21:45:31');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `exam_schedule`
--

INSERT INTO `exam_schedule` (`id`, `exam_id`, `class_id`, `subject_id`, `exam_date`, `start_time`, `end_time`, `room_number`, `full_mark`, `passing_mark`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 7, 6, 12, '2023-05-09', '15:55', '19:55', 'C101', '100', '50', 9, '2023-05-06 23:56:06', '2023-05-06 23:56:06'),
(2, 7, 6, 16, '2023-05-08', '15:55', '18:55', 'C202', '100', '50', 9, '2023-05-06 23:56:06', '2023-05-06 23:56:06'),
(3, 7, 5, 12, '2023-05-10', '15:56', '18:56', 'C303', '100', '50', 9, '2023-05-06 23:56:43', '2023-05-06 23:56:43'),
(4, 7, 5, 2, '2023-05-15', '15:56', '20:56', '123', '100', '50', 9, '2023-05-06 23:56:43', '2023-05-06 23:56:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `exam_score`
--

CREATE TABLE `exam_score` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, '2023_05_04_072608_add_calendar_to_day_table', 1);

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
(1, 'Big Data', 'Theory', 1, 1, 6, '2023-04-17 22:20:20', '2023-04-26 10:02:22'),
(2, 'OOP', 'Practical', 0, 0, 6, '2023-04-17 22:21:45', '2023-04-26 10:03:08'),
(4, 'IOT', 'Theory', 0, 0, 6, '2023-04-18 00:27:04', '2023-04-23 07:52:14'),
(6, 'Social network', 'Theory', 0, 0, 6, '2023-04-18 00:28:54', '2023-05-06 21:38:44'),
(7, 'Giai tich', 'Theory', 0, 0, 1, '2023-04-24 03:05:51', '2023-04-24 03:05:51'),
(8, 'Ngoc HUng ne', 'Theory', 1, 0, 1, '2023-04-24 07:04:47', '2023-04-24 07:04:53'),
(9, 'BlockChain', 'Theory', 0, 0, 1, '2023-04-26 03:17:37', '2023-04-26 03:17:37'),
(10, 'BIgdata', 'Theory', 0, 0, 1, '2023-04-26 09:57:42', '2023-05-06 21:39:09'),
(11, 'C#', 'Theory', 0, 0, 1, '2023-04-26 09:58:00', '2023-05-06 21:39:23'),
(12, 'PHP', 'Theory', 0, 0, 1, '2023-04-26 09:58:55', '2023-05-06 21:39:33'),
(13, 'Cloud computing', 'Theory', 0, 0, 1, '2023-04-26 09:59:46', '2023-05-06 21:39:56'),
(14, '123', 'Theory', 1, 0, 1, '2023-04-26 10:00:35', '2023-04-28 03:31:45'),
(15, 'SQL?Oracle', 'Practical', 0, 0, 1, '2023-04-26 10:01:23', '2023-05-06 21:40:18'),
(16, 'Java', 'Theory', 0, 0, 1, '2023-04-26 10:01:52', '2023-05-06 21:40:35'),
(17, 'Python', 'Practical', 0, 0, 1, '2023-04-26 10:04:45', '2023-05-06 21:40:46');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teacher_class`
--

INSERT INTO `teacher_class` (`id`, `class_id`, `teacher_id`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 5, 21, 0, 0, 9, '2023-05-06 23:52:53', '2023-05-06 23:52:53'),
(2, 5, 20, 0, 0, 9, '2023-05-06 23:52:53', '2023-05-06 23:52:53'),
(3, 5, 10, 0, 0, 9, '2023-05-06 23:52:53', '2023-05-06 23:52:53'),
(4, 5, 8, 0, 0, 9, '2023-05-06 23:52:53', '2023-05-06 23:52:53'),
(5, 5, 7, 0, 0, 9, '2023-05-06 23:52:53', '2023-05-06 23:52:53'),
(11, 24, 25, 0, 0, 9, '2023-05-06 23:53:13', '2023-05-06 23:53:13'),
(12, 24, 24, 0, 0, 9, '2023-05-06 23:53:13', '2023-05-06 23:53:13'),
(13, 24, 23, 0, 0, 9, '2023-05-06 23:53:13', '2023-05-06 23:53:13'),
(14, 24, 22, 0, 0, 9, '2023-05-06 23:53:13', '2023-05-06 23:53:13'),
(15, 24, 10, 0, 0, 9, '2023-05-06 23:53:13', '2023-05-06 23:53:13'),
(16, 7, 8, 0, 0, 9, '2023-05-07 03:28:49', '2023-05-07 03:28:49'),
(17, 6, 8, 0, 0, 9, '2023-05-07 03:29:01', '2023-05-07 03:29:01');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `is_delete`, `admission_number`, `roll_number`, `class_id`, `date_of_birth`, `joining_date`, `gender`, `qualification`, `experience`, `address`, `mobile_number`, `user_avatar`, `status`, `teacher_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '763/60 Kha vạn cân', '091212345', '283260762_3212821132370597_7886786854533052827_n0.jpg', 0, NULL, NULL, '$2y$10$w9Wk0R2aVFph2ltNaPcE/OQ45vl9wkyOxS1rsK27Vscr9m3pWfFPe', 'H5b7eXC0eo91V2eQumx2CyANTV384CZapTVTeomPoviuwpWx1o4QmHOfs00E', NULL, '2023-04-26 19:30:40'),
(2, 'Marcus', 'Marcus@gmail.com', 3, 0, '1', '1', 5, '2020-04-15', NULL, 'Male', NULL, NULL, '763/60 Kha vạn cân', '0917214318', '283260762_3212821132370597_7886786854533052827_n14.jpg', 0, NULL, NULL, '$2y$10$SrFEOY9fAt/Vt9dJpXIg1.RKIpiOBqKgXs/pPZgYSlvRaUL8LMM7u', NULL, '2023-04-26 02:38:30', '2023-04-26 20:34:22'),
(3, 'Codyy', 'cody.nguyen.goldenowl@gmail.com', 3, 0, '2', '2', 5, '2006-04-20', NULL, 'Male', NULL, NULL, '763/60 Kha vạn cân', '0912123456', '310547953_3326544357664940_6449244382606623462_n59.jpg', 0, NULL, NULL, '$2y$10$eLWa998el0rIaFpDyki4NuzghklaEyFe79odtxcVpBpl/hoPqRzRS', NULL, '2023-04-26 02:39:39', '2023-04-26 05:18:44'),
(4, 'Kelvin', 'Kelvin@gmail', 3, 0, '3', '3', 6, '2014-04-07', NULL, 'Male', NULL, NULL, '763/60 Kha vạn cân', '0912123456', '324077173_3509950659236548_5838072279842512956_n64.jpg', 0, NULL, NULL, '$2y$10$Yo1MH99BR7fWD0nRHIpi3O/CBKb5VPG5GDsTOlvsdv28rk5gw1C.q', NULL, '2023-04-26 02:44:51', '2023-04-26 04:48:42'),
(6, 'Leo', 'Leo@gmail', 3, 0, '4', '123123', 6, '2020-04-20', NULL, 'Male', NULL, NULL, 'Vietnam', '0912123456', 'images (1)86.jfif', 0, NULL, NULL, '$2y$10$F8p9n0FbnRalPQXKD.axp.QlcOWmD3.1/k10.r5GtvrDHHiGI5LQy', NULL, '2023-04-26 02:48:13', '2023-05-07 00:07:52'),
(7, 'Danny', 'Danny@gmail', 2, 0, NULL, NULL, NULL, '2020-04-20', NULL, 'Male', 'Thac si', '4year', '763/60 Kha vạn cân', '0912123456', '324077173_3509950659236548_5838072279842512956_n48.jpg', 0, '1', NULL, '$2y$10$3BVlhmqfM9CCF6XpGhZ7mOGc27W8h2s1pgU8POKjPbMIzqwpAb4pG', NULL, '2023-04-26 02:53:45', '2023-04-27 21:07:41'),
(8, 'Tammie', 'Tammie@gmail', 2, 0, NULL, NULL, NULL, '2020-04-20', '0000-00-00', 'Male', 'Thac si', '4year', '763/60 Kha vạn cân', '0912123456', '283260762_3212821132370597_7886786854533052827_n46.jpg', 0, '2', NULL, '$2y$10$VgiHfcoUnmtDjlvWI/nL9OcEb9FmVtmVSCKblEORQ0SZgfS8ijk1u', NULL, '2023-04-26 04:10:40', '2023-05-06 21:00:48'),
(9, 'Tonio', 'Tonio@gmail', 1, 0, '0912123456', '123123', 2, '2029-03-05', NULL, 'Select Gender', NULL, NULL, NULL, '0912123456', 'T0FJW964D-U010CR28E3D-4959bb755da8-512 (1)78.jfif', 0, NULL, NULL, '$2y$10$MCmNXSBMdE7fW39zUpq9lugJPabkRxIsluu43S5gMjWaPfcQtiyJm', NULL, '2023-04-26 04:50:38', '2023-05-06 23:50:42'),
(10, 'Charlie', 'Charlie@gmail', 2, 0, NULL, NULL, NULL, '2023-04-03', '0000-00-00', 'Male', 'Thac si', '4year', '763/60 Kha vạn cân', '0912123456', '310547953_3326544357664940_6449244382606623462_n29.jpg', 0, '3', NULL, '$2y$10$C8rx8NgrUGdMyl3PC8BKreTVkGCMectRvnfOboqJSJ/N5ONdC4M1S', NULL, '2023-04-26 10:13:20', '2023-04-26 10:13:20'),
(11, 'logan', 'logan@gmail.com', 3, 0, '111', '4', 5, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '11311331133', 'images18.jfif', 0, NULL, NULL, '$2y$10$1D.tMpYYLH6qAMKPvRK1ouePQCC.awV1OppG1ZZyQX0BPjgBuAtaq', NULL, '2023-05-06 21:05:01', '2023-05-06 21:05:01'),
(12, 'Jayden', 'Jayden@gmail.com', 3, 0, '1111', '123123', 3, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '1123123123', 'tải xuống75.jfif', 0, NULL, NULL, '$2y$10$rksPAaxABOp/MWAUA4MAeeeVx/r8aewuObFHjfabfEg9g7Hx.y86W', NULL, '2023-05-06 21:06:28', '2023-05-06 21:06:28'),
(13, 'John', 'John@gmail', 3, 0, '10123', '1111', 6, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '0917214318', 'tải xuống (1)90.jfif', 0, NULL, NULL, '$2y$10$U0dU33xvdi6aW2ylav.zTuefXuTvPpp.9/y.OvJYIlngseKhvJdKC', NULL, '2023-05-06 21:08:24', '2023-05-06 21:08:24'),
(14, 'Simon', 'simon@gmail.com', 3, 0, '12312', '1212', 24, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '0917214318', 'tải xuống (2)94.jfif', 0, NULL, NULL, '$2y$10$j7VVipiBfPxAsss89.IfmOgY9yepV2oQRS7YiXGRY.7lz7zq3vS9K', NULL, '2023-05-06 21:09:40', '2023-05-06 21:09:40'),
(15, 'Derek', 'Derek@gmail.com', 3, 0, '123121', '123123', 24, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '091919191', 'images (1)5.jfif', 0, NULL, NULL, '$2y$10$F4UOnz40UrppoPGxJvqUmex6F48r0XaHi.TCGjnk7FCwWHsq5d616', NULL, '2023-05-06 21:10:48', '2023-05-06 21:10:48'),
(16, 'Jenna', 'Jenna@gmail', 3, 0, '1231211', '123123', 24, '0000-00-00', NULL, 'Female', NULL, NULL, NULL, '0917214318', 'tải xuống88.jfif', 0, NULL, NULL, '$2y$10$aNzCaNYvPAvUuirb6tWEFelb1UmBrSdpiRTa1YEBjcjW7ygDa7mcC', NULL, '2023-05-06 21:13:06', '2023-05-06 21:13:06'),
(17, 'Bryan', 'Bryan@gmail.com', 3, 0, '151', '01', 24, '0000-00-00', NULL, 'Male', NULL, NULL, NULL, '0969696969111', 'images14.png', 0, NULL, NULL, '$2y$10$i.LVzF8QGL4MUizRI.AsOufXRWwbKSDUyHuPA64RelVd/0IMeZSmK', NULL, '2023-05-06 21:15:29', '2023-05-06 21:15:29'),
(18, 'Phoebe', 'Phoebe@gmail.com', 3, 0, '15111', '111112', 24, '0000-00-00', NULL, 'Female', NULL, NULL, NULL, '0917214318', 'T0FJW964D-U04N5DMFE2W-065a95d3b87b-51221.png', 0, NULL, NULL, '$2y$10$9btH.KSgEeHCd6Ej/ZNyWemYweI9uLoXyhTk42LDPEQ4mubrXWaRe', NULL, '2023-05-06 21:17:25', '2023-05-06 21:17:25'),
(19, 'Jade', 'Jade@gmail.com', 3, 0, '15111122', '123', 5, '2023-05-07', NULL, 'Female', NULL, NULL, NULL, '0917214318', 'T0FJW964D-U04RUHB47T6-c9e07f92cc9e-51218.png', 0, NULL, NULL, '$2y$10$PyzvZ.SBRl2Z09RU.jIeZuqO/2WRRpTXZTVuokVPX5avd7SUZdSsS', NULL, '2023-05-06 21:19:18', '2023-05-06 23:58:50'),
(20, 'Justin', 'Justin@gmail.com', 2, 0, NULL, NULL, NULL, '2023-05-04', '0000-00-00', 'Male', 'CEO', '4year', 'An loi dong', '0917214318', 'tải xuống (3)95.jfif', 0, '6', NULL, '$2y$10$/jMxBdljrUYMPekCQHuLt.h8bN6IDaqwefq7aNODnsPK/.p3HcIV.', NULL, '2023-05-06 21:27:07', '2023-05-06 21:27:07'),
(21, 'Oscar', 'Teacher1@gmail', 2, 0, NULL, NULL, NULL, '2023-05-11', '0000-00-00', 'Male', 'Senior', '1 Year', '763/60 Kha vạn cân', '0969645845', 'T0FJW964D-U051NENR19U-e0cc3b731ceb-51245.png', 0, '5', NULL, '$2y$10$ja5qxV.IFcRTwIfsaWRrA.90K0fGf4RW5up32L81uWsxYq.3fSlLu', NULL, '2023-05-06 21:29:46', '2023-05-06 21:29:46'),
(22, 'Bill', 'Bill@gmail.com', 2, 0, NULL, NULL, NULL, '2023-05-07', '0000-00-00', 'Male', 'Intern', '1 Month', '45454545', '0917214318', 'T0FJW964D-U051EGLDUTH-a029ddd504ab-51283.jfif', 0, '4', NULL, '$2y$10$KQBLFC45ezdfZL.iIOGMY.xA3Dzw5yeT.sm/e1NcV2eIBUkpRaJB2', NULL, '2023-05-06 21:30:59', '2023-05-06 21:30:59'),
(23, 'Isaac', 'Isaac@gmail.com', 2, 0, NULL, NULL, NULL, '2023-05-03', '0000-00-00', 'Male', 'Fresher', '2 year', '763/60 Kha vạn cân', '091919191', 'T0FJW964D-U03NTLV8YAV-3f3cc4bd5bb8-51242.png', 0, '7', NULL, '$2y$10$qPYr0ZBk8lhnPKpsnpZk5.HYnpj6DFrdjuiIkfG22OhNaSaynsf7i', NULL, '2023-05-06 21:32:49', '2023-05-06 21:32:49'),
(24, 'Gwen', 'Gwen@gmail.com', 2, 0, NULL, NULL, NULL, '2023-05-04', '0000-00-00', 'Female', 'PC Fresher', '1 Year', '44e An loi DOng quan 2', '0917214318', 'T0FJW964D-U04744PRTSM-24f546a03c3a-51287.png', 0, '9', NULL, '$2y$10$shlqjkwJKKQQeSNMbqlD/eJsEsNpjsxZJYz3ZhMSkgtsaGEtBMsgC', NULL, '2023-05-06 21:35:05', '2023-05-06 21:35:05'),
(25, 'Baron', 'Baron@gmail.com', 2, 0, NULL, NULL, NULL, '2023-05-01', '0000-00-00', 'Male', 'Thac si', '1 Year', '45454545', '0917214318', 'T0FJW964D-U010CR28E3D-4959bb755da8-512 (1)95.jfif', 0, '10', NULL, '$2y$10$WvLs.LdiKmPdJOLDrmsmceQTyU8I.Z2luUvKko2HtNhuQ3nuAcvLi', NULL, '2023-05-06 21:37:01', '2023-05-06 21:37:01');

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
  ADD KEY `class_subject_timetable_day_id_foreign` (`day_id`);

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
  ADD KEY `exam_schedule_subject_id_foreign` (`subject_id`);

--
-- Chỉ mục cho bảng `exam_score`
--
ALTER TABLE `exam_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_score_class_id_foreign` (`class_id`),
  ADD KEY `exam_score_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_score_student_id_foreign` (`student_id`);

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
  ADD KEY `teacher_class_teacher_id_foreign` (`teacher_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_admission_number_unique` (`admission_number`),
  ADD UNIQUE KEY `users_teacher_id_unique` (`teacher_id`),
  ADD KEY `users_class_id_foreign` (`class_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `class`
--
ALTER TABLE `class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `class_subject`
--
ALTER TABLE `class_subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT cho bảng `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `day_of_week`
--
ALTER TABLE `day_of_week`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `exam_score`
--
ALTER TABLE `exam_score`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `subject`
--
ALTER TABLE `subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `teacher_class`
--
ALTER TABLE `teacher_class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  ADD CONSTRAINT `class_subject_timetable_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Các ràng buộc cho bảng `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD CONSTRAINT `exam_schedule_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `exam_schedule_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `exam_schedule_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Các ràng buộc cho bảng `teacher_class`
--
ALTER TABLE `teacher_class`
  ADD CONSTRAINT `teacher_class_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `teacher_class_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
