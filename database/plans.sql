-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 01, 2024 at 09:01 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `url_shortner_sg`
--

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `config` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan`, `description`, `config`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Free Plan', ' The Free Plan is a basic subscription tier that offers limited access to our services. With the Free Plan, users can enjoy a set of features with the ability to submit and process a maximum of 10 requests within a specified time period. This plan is desi', '{\r\n  \"allowed_url_upload\": 10\r\n}', 'active', NULL, NULL),
(2, 'Economic Plan', ' The Economic Plan is a budget-friendly subscription tier tailored for users with a moderate level of demand for our services. This plan provides enhanced capabilities compared to the Free Plan, allowing users to submit and manage up to 1000 URLs within a', '{\r\n  \"allowed_url_upload\": 1000\r\n}', 'active', NULL, NULL),
(3, 'Elite Plan', ' The Elite Plan is our premium subscription tier, offering an unparalleled level of access and capabilities for users with extensive and demanding requirements. This top-tier plan provides users with the freedom to submit and manage an unlimited number of', '{\r\n  \"allowed_url_upload\": \"INFINITE\"\r\n}', 'active', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
