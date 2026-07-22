-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 03:52 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ideal_group`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_us` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `about_us`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '<p><strong>Ideal Groups</strong> was initially a dream to establish a firm, focused on <strong>Graphic Design</strong> and began at a small place in a small town. It was also launched for the same pursuit. We started small. Yet, along the way, we endeavored to expand our functionalities to many more areas. Our various firms, dedicated for the certain works, are products of those endeavors. Today we provide services in many more fields than Graphic Design, among which<strong> Branding, Coaching</strong> and <strong>Digital Studio stand tall.</strong> We are focused to pursue many more dreams which are perceived by our excellent team and with their sustenance and our hard work, we shall certainly attain them.&nbsp;</p>', 1, '2023-09-06 00:36:42', '2023-09-06 00:36:42'),
(2, '<p><strong>Ideal Groups</strong>&nbsp;was initially a dream to establish a firm, focused on&nbsp;<strong>Graphic Design</strong>&nbsp;and began at a small place in a small town. It was also launched for the same pursuit. We started small. Yet, along the way, we endeavored to expand our functionalities to many more areas. Our various firms, dedicated for the certain works, are products of those endeavors. Today we provide services in many more fields than Graphic Design, among which<strong>&nbsp;Branding, Coaching</strong>&nbsp;and&nbsp;<strong>Digital Studio stand tall.</strong>&nbsp;We are focused to pursue many more dreams which are perceived by our excellent team and with their sustenance and our hard work, we shall certainly attain them.&nbsp;</p>', 3, '2023-09-12 01:23:25', '2023-09-12 01:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time_status` tinyint(1) NOT NULL DEFAULT 0,
  `sunday_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sunday_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monday_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monday_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuesday_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuesday_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wednesday_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wednesday_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thursday_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thursday_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saturday_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saturday_From` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mondayStatus` tinyint(1) NOT NULL DEFAULT 0,
  `Tuesdaystatus` tinyint(1) NOT NULL DEFAULT 0,
  `Wednesdaystatus` tinyint(1) NOT NULL DEFAULT 0,
  `wednesday_status` tinyint(1) NOT NULL DEFAULT 0,
  `Thursdaystatus` tinyint(1) NOT NULL DEFAULT 0,
  `fridaystatus` tinyint(1) NOT NULL DEFAULT 0,
  `Saturdaystatus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `branch_name`, `address`, `phone`, `email`, `map`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`, `time_status`, `sunday_to`, `sunday_from`, `monday_to`, `monday_from`, `tuesday_to`, `tuesday_from`, `wednesday_to`, `wednesday_from`, `thursday_to`, `thursday_from`, `friday_to`, `friday_from`, `saturday_to`, `saturday_From`, `mondayStatus`, `Tuesdaystatus`, `Wednesdaystatus`, `wednesday_status`, `Thursdaystatus`, `fridaystatus`, `Saturdaystatus`) VALUES
(9, 'Lorem', '115, Blue Diamond Complex, B/h, Fatehgunj Petrol Pump, Vadodara, Gujarat - 390002, India', '+91 8460753102', 'idealinfosoft21@gmail.com', 'Vadodara, Gujarat', 1, NULL, NULL, '2023-09-06 01:39:36', '2023-09-06 01:39:36', 0, NULL, NULL, '09:00 AM', '05:30 PM', '09:00 AM', '05:30 PM', '09:00 AM', '05:30 PM', '09:00 AM', '05:30 PM', '09:00 AM', '05:30 PM', NULL, NULL, 1, 1, 1, 0, 1, 1, 0),
(10, 'Lorem', '115, Blue Diamond Complex, B/h, Fatehgunj Petrol Pump, Vadodara, Gujarat - 390002, India', '+91 8460753102', 'idealinfosoft21@gmail.com', 'Baroda,Gujarat', 3, NULL, NULL, '2023-09-12 01:44:41', '2023-09-12 01:44:41', 0, NULL, NULL, '09:00 AM', '05:30 PM', '09:00 AM', '05:30 PM', '09:00 AM', '05:30 PM', '09:00 AM', '05:30 PM', '09:00 AM', '05:30 PM', NULL, NULL, 1, 1, 1, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

CREATE TABLE `dashboards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dashboards`
--

INSERT INTO `dashboards` (`id`, `username`, `designation`, `phone_no`, `email`, `website`, `address`, `color`, `logo`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'AAA', 'BBBB', '1234567890', 'ew@ggg', 'fgh', 'jvhvvghjhj', '#dbc2c2', 'logo/1693653245.png', 1, '2023-09-01 01:20:28', '2023-09-02 05:49:31'),
(7, 'AAAsdasd', 'BBBBsadasd', '1234567890', 'ew@ggg', 'fgh', 'abad', '#dbc2c2', 'Screenshot (7).png', 2, '2023-09-01 01:20:28', '2023-09-01 04:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_form`
--

CREATE TABLE `inquiry_form` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inquiry_form`
--

INSERT INTO `inquiry_form` (`id`, `name`, `phone`, `email`, `topic`, `Description`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'JFqO6LUejh', '1666221256', '13fcr@bwmc.com', 'J81XtHOBDd', 'vitepBieNR', NULL, NULL, NULL, '2023-09-06 06:21:36', '2023-09-06 06:21:36'),
(4, 'jWIK0G1C0j', '0157223181', 'xthtx@86gp.com', 'A7Y4L4G7sa', 'C3wnIEyPRQ', NULL, NULL, NULL, '2023-09-06 06:26:52', '2023-09-06 06:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_31_105646_create_dashboards_table', 2),
(6, '2023_09_01_112826_create_about_us_table', 3),
(7, '2023_09_01_184144_create_services_table', 4),
(8, '2023_09_02_132354_create_videos_table', 5),
(9, '2023_09_03_072654_create_payments_table', 6),
(10, '2023_09_04_085641_create_testimonials_table', 7),
(11, '2023_09_04_103211_create_contacts_table', 8),
(12, '2023_09_04_142228_add_time_status_to_contacts_table', 9),
(13, '2023_09_05_075315_add_time_day_to_contacts_table', 10),
(14, '2023_09_05_100423_add_status_day_to_contacts_table', 11),
(15, '2023_09_06_091202_create_inquiry_form_table', 12),
(16, '2023_09_12_073710_add_roles_to_users_table', 13),
(18, '2023_09_12_091438_add_created_to_users_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `title`, `image`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(14, 'Paytem', 'images/1693983838.jpg', 0, 1, NULL, NULL, '2023-09-06 01:33:58', '2023-09-06 01:33:58'),
(15, 'Gpay', 'images/1693983851.jpg', 0, 1, NULL, NULL, '2023-09-06 01:34:11', '2023-09-06 01:34:11'),
(16, 'PhonePay', 'images/1693983868.jpg', 0, 1, NULL, NULL, '2023-09-06 01:34:28', '2023-09-06 01:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_no` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `whatsapp_no`, `description`, `created_by`, `logo`, `created_at`, `updated_at`) VALUES
(24, 'Lorem', '7889754642', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 1, 'logo/1694499579.jpg', '2023-09-12 00:49:40', '2023-09-12 00:49:40'),
(25, 'Lorem', '7897878', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 1, 'logo/1694499596.jpg', '2023-09-12 00:49:56', '2023-09-12 00:49:56'),
(26, 'Lorem', '7889754642', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 1, 'logo/1694499616.jpg', '2023-09-12 00:50:16', '2023-09-12 00:50:16'),
(27, 'Lorem', '7889754642', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 3, 'logo/1694501582.jpg', '2023-09-12 01:23:02', '2023-09-12 01:23:02'),
(28, 'sd', '7899987987', 'sdsds', 1, 'logo/1694514724.jpg', '2023-09-12 05:02:04', '2023-09-12 05:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auther` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `description`, `image`, `auther`, `designation`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'testimonials/1693821512.jpeg', 'Anny', 'Writer', 1, NULL, NULL, '2023-09-04 04:28:32', '2023-09-04 04:28:32'),
(3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'testimonials/1693828206.jpeg', 'Denny', 'jr.Writers', 1, NULL, NULL, '2023-09-04 06:20:06', '2023-09-04 06:20:06'),
(4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'testimonials/1694501678.png', 'UserOne', 'Writer', 3, NULL, NULL, '2023-09-12 01:24:38', '2023-09-12 01:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'User', 'user@gmail.com', NULL, '$2y$10$b3WbIRjGlS.q.ynLWKhpK.lr.EhRGBCs8LaazPfr9Jspv3wJRe0Su', NULL, '2023-08-31 04:37:29', '2023-08-31 04:37:29', 0, NULL, NULL, NULL),
(2, 'decent', 'decent@gmail.com', NULL, 'decent123', NULL, '2023-09-04 10:43:19', '2023-09-04 10:43:19', 0, NULL, NULL, NULL),
(3, 'User1', 'userone@gmail.com', NULL, '$2y$10$mCnLZmX8PCd1cz0OJQxIyOOR7g6eY2tL02WbEVijs8dixIdfvrrGu', NULL, '2023-09-12 01:22:28', '2023-09-12 01:22:28', 0, NULL, NULL, NULL),
(5, 'super admin', 'superadmin@gmail.com', NULL, '$2y$10$y/u8oO4arJLEpDaK5LOivuhwciq49RcLG8ocv2TVav/zaxOIhc6ZK', NULL, '2023-09-12 02:54:20', '2023-09-12 02:54:20', 1, NULL, NULL, NULL),
(6, 'UserTwo', 'usertwo@gmail.com', NULL, '$2y$10$FXJ0HjrMxlvSb6en1zayiey/HlbZ0It0DYLDFDioclfomJch7qM9a', NULL, '2023-09-12 02:55:52', '2023-09-12 02:55:52', 0, NULL, NULL, NULL),
(7, 'UserThree', 'userthree@gmail.com', NULL, 'userthree123', NULL, '2023-09-12 04:04:31', '2023-09-12 04:04:31', 0, 5, NULL, NULL),
(8, 'UserFour', 'userfour@gmail.com', NULL, '$2y$10$4.HKi74eCI.X3E6rGhpNY.H2RqLgz7yzTauW8r14FYpQ21WoK/C2i', NULL, '2023-09-12 07:58:00', '2023-09-12 07:58:00', 0, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `youtube_link`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Youtube', 'https://www.youtube.com/', 1, '2023-09-04 07:15:45', '2023-09-06 01:20:45'),
(2, 'Youtube', 'https://www.youtube.com/', 1, '2023-09-04 07:25:08', '2023-09-06 01:20:39'),
(3, 'Rajupancholiofficial', 'https://youtu.be/fQU4Z74MjvA?si=1E_kW-pBKyCzeBhD', 1, '2023-09-06 01:57:30', '2023-09-11 05:06:28'),
(4, 'Test', 'google.com', 3, '2023-09-12 01:25:33', '2023-09-12 01:25:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboards`
--
ALTER TABLE `dashboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inquiry_form`
--
ALTER TABLE `inquiry_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dashboards`
--
ALTER TABLE `dashboards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inquiry_form`
--
ALTER TABLE `inquiry_form`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
