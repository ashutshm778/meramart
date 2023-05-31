-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 08:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `state`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Andhra Pradesh', '1', '2023-01-31 23:33:41', '2023-01-31 23:33:41'),
(2, 1, 'Arunachal Pradesh', '1', '2023-01-31 23:39:25', '2023-01-31 23:39:25'),
(3, 1, 'Telangana', '1', '2023-01-31 23:39:38', '2023-01-31 23:39:38'),
(4, 1, 'Assam', '1', '2023-01-31 23:39:45', '2023-01-31 23:39:45'),
(5, 1, 'Bihar', '1', '2023-01-31 23:40:10', '2023-01-31 23:40:10'),
(6, 1, 'Uttar Pradesh', '1', '2023-01-31 23:40:12', '2023-01-31 23:40:12'),
(7, 1, 'Gujarat', '1', '2023-01-31 23:40:30', '2023-01-31 23:40:30'),
(8, 1, 'Goa', '1', '2023-01-31 23:40:45', '2023-01-31 23:40:45'),
(9, 1, 'Haryana', '1', '2023-01-31 23:40:46', '2023-01-31 23:40:46'),
(10, 1, 'Himachal Pradesh', '1', '2023-01-31 23:40:46', '2023-01-31 23:40:46'),
(11, 1, 'Jammu and Kashmir', '1', '2023-01-31 23:40:46', '2023-01-31 23:40:46'),
(12, 1, 'Madhya Pradesh', '1', '2023-01-31 23:40:47', '2023-01-31 23:40:47'),
(13, 1, 'Karnataka', '1', '2023-01-31 23:40:47', '2023-01-31 23:40:47'),
(14, 1, 'Kerala', '1', '2023-01-31 23:40:47', '2023-01-31 23:40:47'),
(15, 1, 'Maharashtra', '1', '2023-01-31 23:40:47', '2023-01-31 23:40:47'),
(16, 1, 'Chattisgarh', '1', '2023-01-31 23:41:05', '2023-01-31 23:41:05'),
(17, 1, 'Delhi', '1', '2023-01-31 23:41:24', '2023-01-31 23:41:24'),
(18, 1, 'Daman and Diu', '1', '2023-01-31 23:41:57', '2023-01-31 23:41:57'),
(19, 1, 'Dadra and Nagar Hav.', '1', '2023-01-31 23:42:31', '2023-01-31 23:42:31'),
(20, 1, 'Manipur', '1', '2023-01-31 23:42:52', '2023-01-31 23:42:52'),
(21, 1, 'Megalaya', '1', '2023-01-31 23:42:53', '2023-01-31 23:42:53'),
(22, 1, 'Mizoram', '1', '2023-01-31 23:42:53', '2023-01-31 23:42:53'),
(23, 1, 'Nagaland', '1', '2023-01-31 23:42:53', '2023-01-31 23:42:53'),
(24, 1, 'Odisha', '1', '2023-01-31 23:42:53', '2023-01-31 23:42:53'),
(25, 1, 'Punjab', '1', '2023-01-31 23:42:53', '2023-01-31 23:42:53'),
(26, 1, 'Rajasthan', '1', '2023-01-31 23:42:53', '2023-01-31 23:42:53'),
(27, 1, 'Sikkim', '1', '2023-01-31 23:42:53', '2023-01-31 23:42:53'),
(28, 1, 'Tamil Nadu', '1', '2023-01-31 23:42:54', '2023-01-31 23:42:54'),
(29, 1, 'Tripura', '1', '2023-01-31 23:42:54', '2023-01-31 23:42:54'),
(30, 1, 'Jharkhand', '1', '2023-01-31 23:43:35', '2023-01-31 23:43:35'),
(31, 1, 'Uttarakhand', '1', '2023-01-31 23:43:45', '2023-01-31 23:43:45'),
(32, 1, 'Lakshadweep', '1', '2023-01-31 23:46:21', '2023-01-31 23:46:21'),
(33, 1, 'Chandigarh', '1', '2023-01-31 23:51:29', '2023-01-31 23:51:29'),
(34, 1, 'Pondicherry', '1', '2023-01-31 23:54:41', '2023-01-31 23:54:41'),
(35, 1, 'Andaman and Nico.In.', '1', '2023-01-31 23:57:35', '2023-01-31 23:57:35'),
(36, 1, 'West Bengal', '1', '2023-01-31 23:59:19', '2023-01-31 23:59:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_country_id_foreign` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
