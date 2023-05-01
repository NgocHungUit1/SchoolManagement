-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 01, 2023 lúc 03:25 PM
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
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
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
(11, '123123', 0, 0, 1, '2023-04-26 09:17:55', '2023-04-26 09:17:55'),
(12, '12124', 0, 0, 1, '2023-04-26 09:19:33', '2023-04-26 09:19:33'),
(13, '1124125125', 0, 0, 1, '2023-04-26 09:21:38', '2023-04-26 09:21:38'),
(14, 'Leo', 0, 0, 1, '2023-04-26 09:22:52', '2023-04-26 09:22:52'),
(15, 'gabu', 0, 0, 1, '2023-04-26 09:30:01', '2023-04-26 09:30:01'),
(16, '34234', 0, 0, 1, '2023-04-26 09:31:50', '2023-04-26 09:31:50'),
(17, '123123123123', 0, 0, 1, '2023-04-26 09:32:32', '2023-04-26 09:32:32'),
(18, '123123', 0, 0, 1, '2023-04-26 09:33:37', '2023-04-26 09:33:37'),
(19, '123', 0, 0, 1, '2023-04-26 09:38:27', '2023-04-26 09:38:27'),
(20, '12312', 0, 0, 1, '2023-04-26 09:39:05', '2023-04-26 09:39:05'),
(21, '123', 0, 0, 1, '2023-04-26 09:46:09', '2023-04-26 09:46:09'),
(22, '123123', 0, 0, 1, '2023-04-26 09:48:13', '2023-04-26 09:48:13'),
(23, 'Tonio', 1, 0, 1, '2023-04-26 09:54:13', '2023-04-26 09:54:13'),
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
(50, 3, 1, 0, 0, 1, '2023-04-20 19:51:07', '2023-04-20 19:51:07'),
(51, 3, 6, 0, 0, 1, '2023-04-20 19:51:07', '2023-04-20 19:51:07'),
(52, 3, 4, 0, 0, 1, '2023-04-20 19:51:07', '2023-04-20 19:51:07'),
(53, 3, 2, 0, 0, 1, '2023-04-20 19:51:07', '2023-04-20 19:51:07'),
(57, 1, 6, 0, 0, 1, '2023-04-24 07:43:04', '2023-04-24 07:43:04'),
(58, 1, 7, 0, 0, 1, '2023-04-24 07:43:04', '2023-04-24 07:43:04'),
(59, 1, 4, 0, 0, 1, '2023-04-24 07:43:05', '2023-04-24 07:43:05'),
(60, 1, 2, 0, 0, 1, '2023-04-24 07:43:05', '2023-04-24 07:43:05'),
(64, 1, 9, 0, 0, 1, '2023-04-26 03:29:52', '2023-04-26 03:29:52'),
(65, 5, 6, 0, 0, 1, '2023-04-26 03:32:27', '2023-04-26 03:32:27'),
(66, 5, 9, 0, 0, 1, '2023-04-26 03:32:27', '2023-04-26 03:32:27'),
(67, 5, 4, 0, 0, 1, '2023-04-26 03:32:27', '2023-04-26 03:32:27'),
(68, 5, 2, 0, 0, 1, '2023-04-26 03:32:27', '2023-04-26 03:32:27'),
(69, 6, 9, 0, 0, 1, '2023-04-26 21:16:37', '2023-04-26 21:16:37'),
(70, 6, 7, 0, 0, 1, '2023-04-26 21:16:37', '2023-04-26 21:16:37'),
(71, 6, 4, 0, 0, 1, '2023-04-26 21:16:37', '2023-04-26 21:16:37'),
(72, 6, 2, 0, 0, 1, '2023-04-26 21:16:37', '2023-04-26 21:16:37'),
(73, 7, 9, 0, 0, 1, '2023-04-26 21:36:08', '2023-04-26 21:36:08'),
(74, 7, 7, 0, 0, 1, '2023-04-26 21:36:08', '2023-04-26 21:36:08'),
(75, 2, 9, 0, 0, 1, '2023-04-27 02:57:29', '2023-04-27 02:57:29'),
(76, 2, 7, 0, 0, 1, '2023-04-27 02:57:29', '2023-04-27 02:57:29'),
(77, 2, 4, 0, 0, 1, '2023-04-27 02:57:29', '2023-04-27 02:57:29'),
(78, 2, 2, 0, 0, 1, '2023-04-27 02:57:29', '2023-04-27 02:57:29');

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
(7, 3, 6, 1, '03:48', '02:48', '12', '2023-04-22 12:48:22', '2023-04-22 12:48:22'),
(8, 3, 4, 1, '04:48', '04:48', '12', '2023-04-22 12:48:39', '2023-04-22 12:48:39'),
(12, 5, 2, 1, '20:32', '19:32', '12', '2023-04-23 04:32:21', '2023-04-23 04:32:21'),
(13, 5, 4, 1, '19:32', '19:32', '12', '2023-04-23 04:32:33', '2023-04-23 04:32:33'),
(14, 3, 2, 1, '23:52', '21:53', '12', '2023-04-23 07:52:56', '2023-04-23 07:52:56'),
(17, 2, 2, 1, '18:15', '18:15', '12', '2023-04-26 10:22:39', '2023-04-26 10:22:39'),
(18, 2, 2, 2, '21:21', '18:23', '123', '2023-04-26 10:22:39', '2023-04-26 10:22:39'),
(19, 6, 2, 1, '07:16', '11:20', '12', '2023-04-26 21:17:22', '2023-04-26 21:17:22'),
(20, 6, 2, 2, '02:17', '11:19', '123', '2023-04-26 21:17:22', '2023-04-26 21:17:22'),
(21, 6, 2, 3, '01:17', '02:17', '2112', '2023-04-26 21:17:22', '2023-04-26 21:17:22'),
(22, 2, 7, 1, '18:58', '21:03', '123', '2023-04-27 02:58:33', '2023-04-27 02:58:33'),
(23, 2, 7, 2, '17:58', '16:01', '123', '2023-04-27 02:58:33', '2023-04-27 02:58:33'),
(24, 2, 4, 1, '19:19', '05:21', '12', '2023-04-27 03:53:16', '2023-04-27 03:53:16'),
(25, 2, 4, 2, '18:19', '17:21', '123', '2023-04-27 03:53:16', '2023-04-27 03:53:16'),
(26, 2, 4, 3, '19:53', '17:57', '123123', '2023-04-27 03:53:16', '2023-04-27 03:53:16'),
(27, 6, 4, 1, '18:18', '19:18', '12', '2023-04-28 03:18:34', '2023-04-28 03:18:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `day_of_week`
--

CREATE TABLE `day_of_week` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `day_of_week`
--

INSERT INTO `day_of_week` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Monday', NULL, NULL),
(2, 'Tuesday', NULL, NULL),
(3, 'Wednesday', NULL, NULL),
(4, 'Thursday', NULL, NULL),
(5, 'Friday', NULL, NULL),
(6, 'Saturday', NULL, NULL),
(7, 'Sunday', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  `status` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `exam`
--

INSERT INTO `exam` (`id`, `name`, `class_id`, `subject_id`, `start_time`, `end_time`, `is_delete`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'GIua ki', 6, 4, '09:51', '08:51', 1, 0, 1, '2020-04-19 17:00:00', '2023-04-28 03:00:41'),
(2, 'Cuoi ki', 6, 2, '15:29', '13:32', 1, 0, 1, '2023-04-26 23:29:57', '2023-04-28 03:01:15'),
(3, 'GIua ki', 2, 4, '15:39', '14:39', 0, 0, 1, '2023-04-26 23:39:15', '2023-04-26 23:39:15'),
(4, 'GIua ki', 6, 2, '17:00', '17:00', 0, 0, 1, '2023-04-27 01:00:41', '2023-04-27 01:00:41'),
(5, 'Exam', 5, 9, '17:54', '18:52', 0, 0, 1, '2023-04-27 03:52:47', '2023-04-27 03:52:47'),
(6, 'Nguyễn Ngọc Hùng', 3, 6, '17:15', '17:14', 1, 0, 1, '2023-04-28 03:12:25', '2023-04-28 03:12:32');

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
(6, '2023_04_28_095904_create_subject_table', 2),
(7, '2023_04_29_102117_create_class_subject_table', 3),
(9, '2023_04_29_103329_create_exam_table', 4),
(10, '2023_04_29_105107_create_teacher_class_table', 5),
(11, '2023_04_29_111314_create_day_of_week_table', 6),
(13, '2023_04_29_111540_create_class_subject_timetable_table', 7),
(16, '2023_04_30_045306_create_exam_score_table', 8);

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
(6, '123123213', 'Practical', 0, 0, 6, '2023-04-18 00:28:54', '2023-04-24 07:05:39'),
(7, 'Giai tich', 'Theory', 0, 0, 1, '2023-04-24 03:05:51', '2023-04-24 03:05:51'),
(8, 'Ngoc HUng ne', 'Theory', 1, 0, 1, '2023-04-24 07:04:47', '2023-04-24 07:04:53'),
(9, 'BlockChain', 'Theory', 0, 0, 1, '2023-04-26 03:17:37', '2023-04-26 03:17:37'),
(10, '123123', 'Theory', 0, 0, 1, '2023-04-26 09:57:42', '2023-04-26 09:57:42'),
(11, '3123', 'Theory', 0, 0, 1, '2023-04-26 09:58:00', '2023-04-26 09:58:00'),
(12, '123', 'Theory', 0, 0, 1, '2023-04-26 09:58:55', '2023-04-26 09:58:55'),
(13, '123123', 'Theory', 0, 0, 1, '2023-04-26 09:59:46', '2023-04-26 09:59:46'),
(14, '123', 'Theory', 1, 0, 1, '2023-04-26 10:00:35', '2023-04-28 03:31:45'),
(15, '123124', 'Theory', 0, 0, 1, '2023-04-26 10:01:23', '2023-04-26 10:01:23'),
(16, '123123', 'Theory', 0, 0, 1, '2023-04-26 10:01:52', '2023-04-26 10:01:52'),
(17, '123123', 'Theory', 0, 0, 1, '2023-04-26 10:04:45', '2023-04-26 10:04:45');

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
(2, 5, 7, 0, 0, 1, '2023-04-26 04:34:44', '2023-04-26 04:34:44'),
(3, 2, 10, 0, 0, 1, '2023-04-27 02:56:28', '2023-04-27 02:56:28'),
(4, 2, 8, 0, 0, 1, '2023-04-27 02:56:28', '2023-04-27 02:56:28'),
(5, 2, 7, 0, 0, 1, '2023-04-27 02:56:28', '2023-04-27 02:56:28');

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
(6, 'Leo', 'Leo@gmail', 3, 0, '4', '123123', 6, '2020-04-20', NULL, 'Male', NULL, NULL, 'Vietnam', '0912123456', '310547953_3326544357664940_6449244382606623462_n16.jpg', 0, NULL, NULL, '$2y$10$F8p9n0FbnRalPQXKD.axp.QlcOWmD3.1/k10.r5GtvrDHHiGI5LQy', NULL, '2023-04-26 02:48:13', '2023-04-26 21:02:54'),
(7, 'Danny', 'Danny@gmail', 2, 0, NULL, NULL, NULL, '2020-04-20', NULL, 'Male', 'Thac si', '4year', '763/60 Kha vạn cân', '0912123456', '324077173_3509950659236548_5838072279842512956_n48.jpg', 0, '1', NULL, '$2y$10$3BVlhmqfM9CCF6XpGhZ7mOGc27W8h2s1pgU8POKjPbMIzqwpAb4pG', NULL, '2023-04-26 02:53:45', '2023-04-27 21:07:41'),
(8, 'Tonio', 'Tonio@gmail', 2, 0, NULL, NULL, NULL, '2004-04-20', '0000-00-00', 'Male', 'Thac si', '4year', '763/60 Kha vạn cân', '0912123456', '283260762_3212821132370597_7886786854533052827_n46.jpg', 0, '2', NULL, '$2y$10$PlmepOInQWuiF3e5kLZFLus5HHdWP1KuTw8w/7iXhC0z4UbZVJKUG', NULL, '2023-04-26 04:10:40', '2023-04-26 05:28:47'),
(9, 'Tonio', 'Tonio0@gmail', 1, 0, '0912123456', '123123', 2, '2029-03-05', NULL, 'Select Gender', NULL, NULL, NULL, '0912123456', NULL, 0, NULL, NULL, '$2y$10$MCmNXSBMdE7fW39zUpq9lugJPabkRxIsluu43S5gMjWaPfcQtiyJm', NULL, '2023-04-26 04:50:38', '2023-04-26 20:33:58'),
(10, 'Charlie', 'Charlie@gmail', 2, 0, NULL, NULL, NULL, '2023-04-03', '0000-00-00', 'Male', 'Thac si', '4year', '763/60 Kha vạn cân', '0912123456', '310547953_3326544357664940_6449244382606623462_n29.jpg', 0, '3', NULL, '$2y$10$C8rx8NgrUGdMyl3PC8BKreTVkGCMectRvnfOboqJSJ/N5ONdC4M1S', NULL, '2023-04-26 10:13:20', '2023-04-26 10:13:20');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_class_id_foreign` (`class_id`),
  ADD KEY `exam_subject_id_foreign` (`subject_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `day_of_week`
--
ALTER TABLE `day_of_week`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Các ràng buộc cho bảng `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `exam_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Các ràng buộc cho bảng `exam_score`
--
ALTER TABLE `exam_score`
  ADD CONSTRAINT `exam_score_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `exam_score_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `exam_score_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

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
