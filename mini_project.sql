-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 05:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `board_config_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `board_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `name`, `board_config_id`, `title`, `desc`, `start_date`, `photo`, `status`, `board_slug`, `created_at`, `updated_at`) VALUES
(1, 'ConsumerX', 1, 'Demo', '123123', '2024-08-22', 'upload/board/1808102382421412.jpg', 1, 'consumerx', '2024-08-22 15:33:23', '2024-08-22 15:57:58');

-- --------------------------------------------------------

--
-- Table structure for table `board_configs`
--

CREATE TABLE `board_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `team` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `jira_id` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `jira_summary` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `working_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `ticket_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `link_to_result` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `test_plan` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `sprint` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `note` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `priority` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `tester_1` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `tester_2` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `tester_3` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `tester_4` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `tester_5` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jira_url` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `board_configs`
--

INSERT INTO `board_configs` (`id`, `board_id`, `team`, `type`, `jira_id`, `jira_summary`, `working_status`, `ticket_status`, `link_to_result`, `test_plan`, `sprint`, `note`, `priority`, `tester_1`, `tester_2`, `tester_3`, `tester_4`, `tester_5`, `created_at`, `updated_at`, `jira_url`) VALUES
(1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, '2024-08-22 15:57:58', '2024-08-29 15:57:36', 'https://jira.sonos.com/browse/');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `course_image` varchar(255) DEFAULT NULL,
  `course_title` text DEFAULT NULL,
  `course_name` text DEFAULT NULL,
  `course_name_slug` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `resources` varchar(255) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `selling_price` int(11) DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `prerequisites` text DEFAULT NULL,
  `bestseller` varchar(255) DEFAULT NULL,
  `featured` varchar(255) DEFAULT NULL,
  `highestrated` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_goals`
--

CREATE TABLE `course_goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `goal_name` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_lectures`
--

CREATE TABLE `course_lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `lecture_title` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_sections`
--

CREATE TABLE `course_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_20_202509_create_categories_table', 1),
(6, '2023_08_22_195042_create_sub_categories_table', 1),
(7, '2023_08_23_210009_create_courses_table', 1),
(8, '2023_08_23_210952_create_course_goals_table', 1),
(9, '2023_08_26_201730_create_course_sections_table', 1),
(10, '2023_08_26_201748_create_course_lectures_table', 1),
(11, '2024_07_23_144445_create_boards_table', 1),
(12, '2024_08_11_061808_create_teams_table', 1),
(13, '2024_08_11_074337_create_types_table', 1),
(14, '2024_08_11_081839_create_working_statuses_table', 1),
(15, '2024_08_11_084338_create_ticket_statuses_table', 1),
(16, '2024_08_11_093115_create_board_configs_table', 1),
(17, '2024_08_11_141227_create_tasks_table', 1),
(18, '2024_08_20_091358_create_priorities_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `priority_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `name`, `desc`, `board_id`, `priority_slug`, `created_at`, `updated_at`) VALUES
(1, 'Critical', 'demo', 1, NULL, NULL, NULL),
(2, 'Minor', 'demo', 1, NULL, NULL, NULL),
(3, 'Major', 'demo', 1, NULL, NULL, NULL),
(4, 'Hight', 'demo', 1, NULL, NULL, NULL),
(5, 'Medium', 'demo', 1, NULL, NULL, NULL),
(6, 'Low', 'demo', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `team` bigint(20) UNSIGNED DEFAULT NULL,
  `type` bigint(20) UNSIGNED DEFAULT NULL,
  `jira_id` varchar(255) DEFAULT NULL,
  `jira_summary` varchar(255) DEFAULT NULL,
  `working_status` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_status` bigint(20) UNSIGNED DEFAULT NULL,
  `link_to_result` varchar(255) DEFAULT NULL,
  `test_plan` varchar(255) DEFAULT NULL,
  `sprint` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `priority` bigint(20) UNSIGNED DEFAULT NULL,
  `tester_1` bigint(20) UNSIGNED DEFAULT NULL,
  `tester_2` bigint(20) UNSIGNED DEFAULT NULL,
  `tester_3` bigint(20) UNSIGNED DEFAULT NULL,
  `tester_4` bigint(20) UNSIGNED DEFAULT NULL,
  `tester_5` bigint(20) UNSIGNED DEFAULT NULL,
  `task_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `board_id`, `team`, `type`, `jira_id`, `jira_summary`, `working_status`, `ticket_status`, `link_to_result`, `test_plan`, `sprint`, `note`, `priority`, `tester_1`, `tester_2`, `tester_3`, `tester_4`, `tester_5`, `task_slug`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 1, 'PMA-1134512313', '12312312', 1, 2, '12312312', NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, 'pma-1134512313', '2024-08-22 15:58:55', '2024-08-29 15:11:15'),
(2, 1, 9, 1, 'PMA-11345', 'demo', 2, 2, '12312312', NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, 'pma-11345', NULL, '2024-08-29 15:31:41'),
(3, 1, 9, 1, 'PMA-11345', 'demo 2', 2, 2, '12312312', NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, 'pma-11345', NULL, '2024-08-29 15:34:18'),
(5, 1, 9, 1, 'PMA-11345', 'demo 2', 2, 2, '12312312', NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, 'pma-11345', NULL, '2024-08-29 15:54:21'),
(6, 1, 9, 1, 'PMA-11345', 'demo 2', 2, 2, '12312312', NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, 'pma-11345', NULL, '2024-08-29 15:54:23'),
(7, 1, 9, 1, 'PMA-11345', 'demo 2', 1, 2, '12312312', NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, 'pma-11345', NULL, '2024-08-29 15:54:43'),
(8, 1, 9, 1, 'PMA-11345', 'demo 2', 2, 2, '12312312', NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, 'pma-11345', NULL, '2024-08-29 15:54:31'),
(9, 1, 9, 1, 'PMA-11345', 'demo 2', 2, 2, '12312312', NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, 'pma-11345', NULL, '2024-08-29 15:54:34'),
(10, 1, 9, 1, 'PMA-11345', 'demo 2', 2, 2, '12312312', NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, 'pma-11345', NULL, '2024-08-29 15:54:37'),
(11, 1, 9, 1, 'PMA-11345', 'demo 2', 2, 2, '12312312', NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, 'pma-11345', NULL, '2024-08-29 15:55:00'),
(12, 1, 9, 1, 'PMA-11345', 'demo 2', 2, 2, '12312312', NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, 'pma-11345', NULL, '2024-08-29 15:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `team_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `desc`, `board_id`, `team_slug`, `created_at`, `updated_at`) VALUES
(9, 'Content Experience', 'demo', 1, NULL, NULL, '2024-08-22 15:46:56'),
(10, 'Initial Configuration', 'demo', 1, NULL, NULL, '2024-08-22 15:46:53'),
(11, 'App Core', 'demo', 1, NULL, NULL, NULL),
(12, 'Playback Control', 'demo', 1, NULL, NULL, NULL),
(13, 'Pinewood', 'demo', 1, NULL, NULL, NULL),
(14, 'Home Audio Embedded', 'demo', 1, NULL, NULL, NULL),
(15, 'Networking', 'demo', 1, NULL, NULL, NULL),
(16, 'Playback Control', 'demo', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_statuses`
--

CREATE TABLE `ticket_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_status_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_statuses`
--

INSERT INTO `ticket_statuses` (`id`, `name`, `desc`, `board_id`, `ticket_status_slug`, `created_at`, `updated_at`) VALUES
(1, 'In-Progress', 'demo', 1, NULL, NULL, NULL),
(2, 'Closed', 'demo', 1, NULL, NULL, NULL),
(3, 'Resolved', 'demo', 1, NULL, NULL, NULL),
(4, 'In-Verification', 'demo', 1, NULL, NULL, NULL),
(5, 'Ready To Verify', 'demo', 1, NULL, NULL, NULL),
(6, 'Block', 'demo', 1, NULL, NULL, NULL),
(7, 'Re-opened', 'demo', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `type_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `desc`, `board_id`, `type_slug`, `created_at`, `updated_at`) VALUES
(1, 'Bug Found', 'demo', 1, NULL, NULL, NULL),
(2, 'Testing Request', 'demo', 1, NULL, NULL, NULL),
(3, 'Ticket Verification', 'demo', 1, NULL, NULL, NULL),
(4, 'Bug Verification', 'demo', 1, NULL, NULL, NULL),
(5, 'Write TestPlan', 'demo', 1, NULL, NULL, NULL),
(6, 'Regression', 'demo', 1, NULL, NULL, NULL),
(7, 'Automation Ticket', 'demo', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `role` enum('admin','manager','user') NOT NULL DEFAULT 'user',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `title`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$2Zf7SMWWXD5IXqH1sba0pe5eLA6Unkph0hFgV3Dw9i5PQ/wl.DwUa', NULL, NULL, NULL, NULL, 'admin', '1', NULL, NULL, NULL),
(2, 'Manager', 'users', 'manager@gmail.com', NULL, '$2y$10$.Tz2jASgeTrKPy/zolb/7.JSgqIzQ90jZvUhJ8iD4e6XHuCmLylMi', NULL, NULL, NULL, NULL, 'manager', '1', NULL, NULL, NULL),
(3, 'User', 'user', 'user@gmail.com', NULL, '$2y$10$uI3wxoWlf8Ru5iq2RHOH6ubjWry3PppJfJX25PW0R6DMmSITkq8wK', NULL, NULL, NULL, NULL, 'user', '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `working_statuses`
--

CREATE TABLE `working_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `working_status_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_statuses`
--

INSERT INTO `working_statuses` (`id`, `name`, `desc`, `board_id`, `working_status_slug`, `created_at`, `updated_at`) VALUES
(1, 'In-Progress', 'demo', 1, NULL, NULL, NULL),
(2, 'Done', 'demo', 1, NULL, NULL, NULL),
(3, 'Todo', 'demo', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `board_configs`
--
ALTER TABLE `board_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_goals`
--
ALTER TABLE `course_goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_lectures`
--
ALTER TABLE `course_lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_sections`
--
ALTER TABLE `course_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `working_statuses`
--
ALTER TABLE `working_statuses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `board_configs`
--
ALTER TABLE `board_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_goals`
--
ALTER TABLE `course_goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_lectures`
--
ALTER TABLE `course_lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_sections`
--
ALTER TABLE `course_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `working_statuses`
--
ALTER TABLE `working_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
