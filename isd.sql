-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 16, 2024 at 11:50 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isd`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(23, 'Adidas', '2024-05-10 07:59:28', '2024-05-10 11:28:26'),
(24, 'Nike', '2024-05-10 07:59:39', '2024-05-10 11:28:15'),
(25, 'H&M', '2024-05-10 07:59:50', '2024-05-10 11:27:52'),
(26, 'Zara', '2024-05-10 09:24:57', '2024-05-10 11:28:01'),
(27, 'Osseili', '2024-05-15 01:44:05', '2024-05-15 01:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(71, 'Men\'s Clothing', 'Men\'s Clothing_1715440492.jpg', '2024-05-10 07:56:41', '2024-05-11 12:14:52'),
(72, 'Women\'s Clothing', 'Women\'s Clothing_1715440418.jpg', '2024-05-10 07:57:16', '2024-05-11 12:13:38'),
(74, 'Kid\'s Clothing', 'Kid\'s Clothing_1715440348.jpg', '2024-05-10 09:24:04', '2024-05-11 12:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `colors_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=267 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `product_id`, `color`, `created_at`, `updated_at`) VALUES
(1, 64, 'red', '2024-05-07 08:40:02', '2024-05-07 08:40:02'),
(2, 64, 'yellow', '2024-05-07 08:40:02', '2024-05-07 08:40:02'),
(62, 65, 'purple', '2024-05-10 05:15:05', '2024-05-10 05:15:05'),
(66, 66, 'gray', '2024-05-10 05:17:44', '2024-05-10 05:17:44'),
(65, 66, 'purple', '2024-05-10 05:17:44', '2024-05-10 05:17:44'),
(64, 66, 'red', '2024-05-10 05:17:44', '2024-05-10 05:17:44'),
(56, 67, 'orange', '2024-05-09 12:42:27', '2024-05-09 12:42:27'),
(55, 67, 'black', '2024-05-09 12:42:27', '2024-05-09 12:42:27'),
(12, 68, 'black', '2024-05-07 09:05:38', '2024-05-07 09:05:38'),
(13, 68, 'yellow', '2024-05-07 09:05:38', '2024-05-07 09:05:38'),
(14, 68, 'olive', '2024-05-07 09:05:38', '2024-05-07 09:05:38'),
(48, 69, 'gold', '2024-05-08 10:20:31', '2024-05-08 10:20:31'),
(47, 69, 'gray', '2024-05-08 10:20:31', '2024-05-08 10:20:31'),
(54, 70, 'yellow', '2024-05-08 10:23:10', '2024-05-08 10:23:10'),
(53, 70, 'green', '2024-05-08 10:23:10', '2024-05-08 10:23:10'),
(19, 71, 'red', '2024-05-07 09:09:08', '2024-05-07 09:09:08'),
(20, 71, 'yellow', '2024-05-07 09:09:08', '2024-05-07 09:09:08'),
(21, 72, 'purple', '2024-05-07 09:09:53', '2024-05-07 09:09:53'),
(22, 72, 'navy', '2024-05-07 09:09:53', '2024-05-07 09:09:53'),
(68, 73, 'white', '2024-05-10 05:19:04', '2024-05-10 05:19:04'),
(67, 73, 'black', '2024-05-10 05:19:04', '2024-05-10 05:19:04'),
(25, 74, 'yellow', '2024-05-07 09:11:43', '2024-05-07 09:11:43'),
(26, 74, 'brown', '2024-05-07 09:11:43', '2024-05-07 09:11:43'),
(27, 75, 'red', '2024-05-07 09:12:50', '2024-05-07 09:12:50'),
(28, 75, 'purple', '2024-05-07 09:12:50', '2024-05-07 09:12:50'),
(52, 76, 'green', '2024-05-08 10:22:52', '2024-05-08 10:22:52'),
(51, 76, 'red', '2024-05-08 10:22:52', '2024-05-08 10:22:52'),
(50, 76, 'blue', '2024-05-08 10:22:52', '2024-05-08 10:22:52'),
(49, 76, 'pink', '2024-05-08 10:22:52', '2024-05-08 10:22:52'),
(38, 77, 'black', '2024-05-08 02:50:34', '2024-05-08 02:50:34'),
(39, 77, 'yellow', '2024-05-08 02:50:34', '2024-05-08 02:50:34'),
(40, 78, 'blue', '2024-05-08 02:52:21', '2024-05-08 02:52:21'),
(41, 78, 'green', '2024-05-08 02:52:21', '2024-05-08 02:52:21'),
(42, 79, 'pink', '2024-05-08 03:08:33', '2024-05-08 03:08:33'),
(43, 79, 'green', '2024-05-08 03:08:33', '2024-05-08 03:08:33'),
(63, 65, 'magenta', '2024-05-10 05:15:05', '2024-05-10 05:15:05'),
(74, 80, 'orange', '2024-05-10 05:38:27', '2024-05-10 05:38:27'),
(73, 80, 'blue', '2024-05-10 05:38:27', '2024-05-10 05:38:27'),
(72, 81, 'pink', '2024-05-10 05:38:11', '2024-05-10 05:38:11'),
(75, 82, 'pink', '2024-05-10 07:51:33', '2024-05-10 07:51:33'),
(261, 83, 'brown', '2024-05-11 03:34:15', '2024-05-11 03:34:15'),
(260, 83, 'red', '2024-05-11 03:34:15', '2024-05-11 03:34:15'),
(218, 84, 'red', '2024-05-10 12:26:35', '2024-05-10 12:26:35'),
(217, 84, 'blue', '2024-05-10 12:26:35', '2024-05-10 12:26:35'),
(205, 85, 'white', '2024-05-10 12:21:55', '2024-05-10 12:21:55'),
(204, 85, 'black', '2024-05-10 12:21:55', '2024-05-10 12:21:55'),
(95, 86, 'brown', '2024-05-10 08:24:47', '2024-05-10 08:24:47'),
(94, 86, 'red', '2024-05-10 08:24:47', '2024-05-10 08:24:47'),
(182, 87, 'green', '2024-05-10 12:10:31', '2024-05-10 12:10:31'),
(181, 87, 'black', '2024-05-10 12:10:31', '2024-05-10 12:10:31'),
(180, 87, 'blue', '2024-05-10 12:10:31', '2024-05-10 12:10:31'),
(235, 88, 'yellow', '2024-05-10 12:34:16', '2024-05-10 12:34:16'),
(234, 88, 'blue', '2024-05-10 12:34:16', '2024-05-10 12:34:16'),
(101, 89, 'red', '2024-05-10 08:33:42', '2024-05-10 08:33:42'),
(102, 89, 'purple', '2024-05-10 08:33:42', '2024-05-10 08:33:42'),
(103, 89, 'navy', '2024-05-10 08:33:42', '2024-05-10 08:33:42'),
(186, 90, 'orange', '2024-05-10 12:11:14', '2024-05-10 12:11:14'),
(185, 90, 'black', '2024-05-10 12:11:14', '2024-05-10 12:11:14'),
(169, 91, 'brown', '2024-05-10 12:04:47', '2024-05-10 12:04:47'),
(168, 91, 'black', '2024-05-10 12:04:47', '2024-05-10 12:04:47'),
(188, 92, 'cyan', '2024-05-10 12:11:30', '2024-05-10 12:11:30'),
(187, 92, 'red', '2024-05-10 12:11:30', '2024-05-10 12:11:30'),
(264, 93, 'orange', '2024-05-14 14:44:09', '2024-05-14 14:44:09'),
(263, 93, 'black', '2024-05-14 14:44:09', '2024-05-14 14:44:09'),
(112, 94, 'pink', '2024-05-10 08:38:24', '2024-05-10 08:38:24'),
(113, 94, 'orange', '2024-05-10 08:38:24', '2024-05-10 08:38:24'),
(114, 94, 'brown', '2024-05-10 08:38:24', '2024-05-10 08:38:24'),
(115, 94, 'white', '2024-05-10 08:38:24', '2024-05-10 08:38:24'),
(116, 95, 'orange', '2024-05-10 08:39:16', '2024-05-10 08:39:16'),
(219, 96, 'black', '2024-05-10 12:27:09', '2024-05-10 12:27:09'),
(118, 97, 'yellow', '2024-05-10 08:41:04', '2024-05-10 08:41:04'),
(119, 97, 'purple', '2024-05-10 08:41:04', '2024-05-10 08:41:04'),
(207, 98, 'orange', '2024-05-10 12:22:51', '2024-05-10 12:22:51'),
(206, 98, 'black', '2024-05-10 12:22:51', '2024-05-10 12:22:51'),
(216, 99, 'orange', '2024-05-10 12:24:50', '2024-05-10 12:24:50'),
(215, 99, 'black', '2024-05-10 12:24:50', '2024-05-10 12:24:50'),
(211, 100, 'green', '2024-05-10 12:23:21', '2024-05-10 12:23:21'),
(210, 100, 'pink', '2024-05-10 12:23:21', '2024-05-10 12:23:21'),
(212, 101, 'pink', '2024-05-10 12:23:35', '2024-05-10 12:23:35'),
(209, 102, 'purple', '2024-05-10 12:23:06', '2024-05-10 12:23:06'),
(208, 102, 'green', '2024-05-10 12:23:06', '2024-05-10 12:23:06'),
(250, 103, 'orange', '2024-05-10 12:45:00', '2024-05-10 12:45:00'),
(249, 103, 'black', '2024-05-10 12:45:00', '2024-05-10 12:45:00'),
(255, 104, 'purple', '2024-05-10 12:49:45', '2024-05-10 12:49:45'),
(254, 104, 'black', '2024-05-10 12:49:45', '2024-05-10 12:49:45'),
(233, 105, 'magenta', '2024-05-10 12:32:50', '2024-05-10 12:32:50'),
(231, 106, 'yellow', '2024-05-10 12:31:09', '2024-05-10 12:31:09'),
(230, 106, 'black', '2024-05-10 12:31:09', '2024-05-10 12:31:09'),
(227, 107, 'gray', '2024-05-10 12:30:18', '2024-05-10 12:30:18'),
(225, 108, 'yellow', '2024-05-10 12:29:13', '2024-05-10 12:29:13'),
(224, 108, 'red', '2024-05-10 12:29:13', '2024-05-10 12:29:13'),
(223, 109, 'yellow', '2024-05-10 12:28:44', '2024-05-10 12:28:44'),
(222, 109, 'black', '2024-05-10 12:28:44', '2024-05-10 12:28:44'),
(203, 110, 'black', '2024-05-10 12:20:20', '2024-05-10 12:20:20'),
(163, 111, 'brown', '2024-05-10 12:03:05', '2024-05-10 12:03:05'),
(162, 111, 'green', '2024-05-10 12:03:05', '2024-05-10 12:03:05'),
(251, 112, 'brown', '2024-05-10 12:45:31', '2024-05-10 12:45:31'),
(248, 113, 'white', '2024-05-10 12:44:09', '2024-05-10 12:44:09'),
(247, 113, 'orange', '2024-05-10 12:44:09', '2024-05-10 12:44:09'),
(246, 113, 'blue', '2024-05-10 12:44:09', '2024-05-10 12:44:09'),
(150, 114, 'green', '2024-05-10 09:33:17', '2024-05-10 09:33:17'),
(245, 115, 'orange', '2024-05-10 12:43:31', '2024-05-10 12:43:31'),
(244, 115, 'black', '2024-05-10 12:43:31', '2024-05-10 12:43:31'),
(243, 116, 'orange', '2024-05-10 12:43:08', '2024-05-10 12:43:08'),
(242, 116, 'black', '2024-05-10 12:43:08', '2024-05-10 12:43:08'),
(155, 117, 'black', '2024-05-10 09:37:06', '2024-05-10 09:37:06'),
(156, 117, 'yellow', '2024-05-10 09:37:06', '2024-05-10 09:37:06'),
(262, 118, 'orange', '2024-05-12 05:27:36', '2024-05-12 05:27:36'),
(265, 119, 'pink', '2024-05-16 08:36:51', '2024-05-16 08:36:51'),
(266, 119, 'green', '2024-05-16 08:36:51', '2024-05-16 08:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
CREATE TABLE IF NOT EXISTS `configurations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE IF NOT EXISTS `coupon` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `discountAmount` int NOT NULL,
  `usageCount` int NOT NULL,
  `userUsageCount` int NOT NULL,
  `minimumPurchaseAmount` int NOT NULL,
  `isActive` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coupon_ibfk_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `created_at`, `updated_at`, `code`, `user_id`, `discountAmount`, `usageCount`, `userUsageCount`, `minimumPurchaseAmount`, `isActive`, `from_date`, `to_date`) VALUES
(9, '2024-05-11 03:36:41', '2024-05-14 12:26:08', 'asdfasdfwe', 30, 32, 10, 5, 32, 'no', '2024-05-05', '2024-05-21'),
(10, '2024-05-14 13:05:36', '2024-05-14 14:46:20', 'ali', 32, 21, 234, 3, 234, 'yes', '2024-04-07', '2024-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `generals`
--

DROP TABLE IF EXISTS `generals`;
CREATE TABLE IF NOT EXISTS `generals` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `landing_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generals`
--

INSERT INTO `generals` (`id`, `landing_image`, `email`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'landing_1715708222.jpg', 'khShop@gmail.com', '+961 76 709 256', '123 Street , South Lebanon, Tyre', NULL, '2024-05-14 14:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2024_05_10_065556_create_addresses_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_23_065008_create_categories_table', 1),
(6, '2024_01_24_083708_create_sub_categories_table', 2),
(7, '2024_01_24_084329_create_brands_table', 3),
(8, '2024_01_24_084401_create_products_table', 4),
(9, '2024_01_24_084847_create_product_variations_table', 5),
(10, '2024_01_24_085039_create_product_images_table', 6),
(11, '2024_01_24_090237_create_users_table', 7),
(12, '2024_01_24_101854_create_orders_table', 8),
(13, '2024_01_24_102023_create_order_items_table', 9),
(15, '2024_01_24_102544_create_coupon_table', 11),
(16, '2024_01_24_103018_create_configurations_table', 12),
(17, '2024_01_25_074031_add_index_to_sub_categories', 13),
(18, '2024_01_25_074127_add_index_to_categories', 13),
(19, '2024_01_26_083002_add_price_to_products', 14),
(20, '2024_01_26_120808_drop_product_variations_table', 15),
(21, '2024_01_26_120936_add_to_colors_sizes_to_products', 16),
(22, '2014_10_12_100000_create_password_resets_table', 17),
(23, '2024_02_09_111122_create_generals_table', 17),
(25, '2024_02_14_074742_add_gender_to_products', 19),
(26, '2024_02_14_075112_remove_gender_from_products', 20),
(27, '2024_02_14_075228_add_gender1_to_products', 21),
(28, '2024_02_20_125525_add_show_to_categories', 22),
(29, '2024_02_20_125750_drop_show_to_categories', 23),
(30, '2024_02_20_125842_add_show1_to_categories', 24),
(31, '2024_02_20_134434_add_qty_and_remaind_qty_to_products', 25),
(32, '2024_02_21_135029_create_admins_table', 26),
(33, '2024_02_21_152316_add_name_to_users', 27),
(34, '2024_02_24_101002_wishlists', 28),
(35, '2024_01_24_102449_create_stocks_table', 29),
(36, '2024_02_28_110537_create_stocks_table', 30),
(37, '2024_02_28_111110_drop_stocks_from_stock', 30),
(38, '2024_03_07_145956_add_gender_to_users', 31),
(39, '2024_04_03_205619_drop_user_id_from_coupon', 32),
(40, '2024_04_17_120939_create_shippingaddress_table', 32),
(41, '2024_04_18_051003_add_status_to_orders_table', 33),
(42, '2024_04_18_051203_add_status_to_orders_table', 34),
(43, '2024_04_24_100420_create_sizes_table', 35),
(44, '2024_04_24_100534_create_colors_table', 36),
(45, '2024_05_08_153137_create_addresses_table', 37),
(46, '2024_05_10_053037_add_status_to_orders_table', 38),
(47, '2024_05_10_054331_add_coupon_discount_to_orders_table', 39),
(48, '2024_02_12_130341_create_tests_table', 40),
(49, '2024_05_10_065556_create_addresses_table', 41);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `address_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('Pending','Shipped','Delivered') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `couponDiscount` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_address_id_foreign` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address_id`, `date`, `status`, `couponDiscount`, `created_at`, `updated_at`) VALUES
(108, 30, 6, '2024-05-15', 'Delivered', 2, '2024-05-15 13:34:25', '2024-05-16 06:40:56'),
(109, 30, 14, '2024-05-15', 'Shipped', 0, '2024-05-15 13:34:49', '2024-05-16 06:33:36'),
(110, 32, 11, '2024-05-15', 'Pending', 0, '2024-05-15 13:35:24', '2024-05-16 07:52:08'),
(111, 32, 11, '2024-05-15', 'Delivered', 0, '2024-05-15 13:38:14', '2024-05-16 08:44:34'),
(112, 32, 11, '2024-05-15', 'Pending', 0, '2024-05-15 13:53:01', '2024-05-16 07:33:41'),
(113, 32, 11, '2024-05-15', 'Shipped', 0, '2024-05-15 13:53:54', '2024-05-15 13:53:54'),
(114, 32, 11, '2024-05-15', 'Delivered', 0, '2024-05-15 13:58:55', '2024-05-16 07:17:23'),
(115, 32, 15, '2024-05-15', 'Pending', 10, '2024-05-15 14:01:49', '2024-05-16 08:34:30'),
(116, 30, 14, '2024-05-16', 'Pending', 0, '2024-05-16 05:03:12', '2024-05-16 05:03:12'),
(117, 30, 14, '2024-05-16', 'Delivered', 0, '2024-05-16 07:11:55', '2024-05-16 07:54:24'),
(118, 30, 14, '2024-05-16', 'Pending', 0, '2024-05-16 08:38:59', '2024-05-16 08:38:59'),
(119, 30, 14, '2024-05-16', 'Pending', 0, '2024-05-16 08:39:19', '2024-05-16 08:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` bigint NOT NULL,
  `size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `size`, `color`, `created_at`, `updated_at`, `country`, `state`, `city`) VALUES
(98, 108, 117, 3, 'xxl', 'black', '2024-05-15 13:34:25', '2024-05-15 13:34:25', 'Lebanon', 'Zahle', 'Austin'),
(99, 109, 114, 3, 'l', 'green', '2024-05-15 13:34:49', '2024-05-15 13:34:49', 'Lebanon', 'Zgharta_Ehden', 'Dallas'),
(100, 110, 85, 2, 's', 'white', '2024-05-15 13:35:24', '2024-05-15 13:35:24', 'Lebanon', 'Tyre', 'Austin'),
(101, 111, 96, 1, 'l', 'black', '2024-05-15 13:38:14', '2024-05-15 13:38:14', 'Lebanon', 'Tyre', 'Austin'),
(102, 112, 114, 2, 'l', 'green', '2024-05-15 13:53:01', '2024-05-15 13:53:01', 'Lebanon', 'Tyre', 'Austin'),
(103, 112, 87, 4, 'm', 'black', '2024-05-15 13:53:01', '2024-05-15 13:53:01', 'Lebanon', 'Tyre', 'Austin'),
(104, 113, 118, 1, 'xxl', 'orange', '2024-05-15 13:53:54', '2024-05-15 13:53:54', 'Lebanon', 'Tyre', 'Austin'),
(105, 114, 106, 1, '4xl', 'black', '2024-05-15 13:58:55', '2024-05-15 13:58:55', 'Lebanon', 'Tyre', 'Austin'),
(106, 115, 101, 2, 'xl', 'pink', '2024-05-15 14:01:49', '2024-05-15 14:01:49', 'Lebanon', 'Tyre', 'Austin'),
(107, 115, 92, 1, 'xxl', 'cyan', '2024-05-15 14:01:49', '2024-05-15 14:01:49', 'Lebanon', 'Tyre', 'Austin'),
(108, 116, 93, 100, 's', 'black', '2024-05-16 05:03:12', '2024-05-16 05:03:12', 'Lebanon', 'Zgharta_Ehden', 'Dallas'),
(109, 117, 117, 2, 'xxl', 'black', '2024-05-16 07:11:55', '2024-05-16 07:11:55', 'Lebanon', 'Zgharta_Ehden', 'Dallas'),
(110, 117, 106, 2, '4xl', 'black', '2024-05-16 07:11:55', '2024-05-16 07:11:55', 'Lebanon', 'Zgharta_Ehden', 'Dallas'),
(111, 118, 104, 54, 'xxl', 'black', '2024-05-16 08:38:59', '2024-05-16 08:38:59', 'Lebanon', 'Zgharta_Ehden', 'Dallas'),
(112, 119, 104, 1, 'xxl', 'black', '2024-05-16 08:39:19', '2024-05-16 08:39:19', 'Lebanon', 'Zgharta_Ehden', 'Dallas');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_id` bigint UNSIGNED NOT NULL,
  `subCategory_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `remained_quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_subcategory_id_foreign` (`subCategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `subCategory_id`, `name`, `gender`, `description`, `is_featured`, `price`, `quantity`, `remained_quantity`, `created_at`, `updated_at`) VALUES
(83, 23, 34, 'Dress', 'female', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui ex tempora, mollitia ipsa temporibus autem dolorum repellat? Repudiandae, neque aut?', 1, 20, 29, 2, '2024-05-10 08:01:57', '2024-05-11 03:34:15'),
(84, 23, 39, 'T-shirt-kid-3', 'female', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui ex tempora, mollitia ipsa temporibus autem dolorum repellat? Repudiandae, neque aut?', 1, 10, 23, 18, '2024-05-10 08:03:35', '2024-05-11 08:33:00'),
(85, 24, 39, 'T-shirt-kid-2', 'male', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui ex tempora, mollitia ipsa temporibus autem dolorum repellat? Repudiandae, neque aut?', 1, 10, 17, 12, '2024-05-10 08:05:23', '2024-05-15 13:35:24'),
(86, 24, 33, 'T-shirt-2', 'male', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 1, 26, 39, 1, '2024-05-10 08:07:15', '2024-05-10 08:24:47'),
(87, 24, 38, 'T-Shirt-3', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 13, 26, 22, '2024-05-10 08:32:15', '2024-05-15 13:53:01'),
(88, 24, 38, 'T-shirt-4', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 30, 14, 2, '2024-05-10 08:33:01', '2024-05-11 08:33:00'),
(89, 24, 33, 'T-shirt-5', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 0, 43, 56, 52, '2024-05-10 08:33:42', '2024-05-14 14:47:23'),
(90, 24, 37, 'T-shirt-6', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 48, 10, 10, '2024-05-10 08:34:22', '2024-05-10 12:11:14'),
(91, 24, 38, 'T-shirt-7', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 16, 62, 62, '2024-05-10 08:35:05', '2024-05-10 12:04:47'),
(92, 24, 38, 'T-Shirt-9', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 26, 124, 115, '2024-05-10 08:36:19', '2024-05-15 14:01:49'),
(93, 24, 33, 'T-shirt-10', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 12, 152, 48, '2024-05-10 08:37:49', '2024-05-16 05:03:12'),
(94, 24, 33, 'T-Shirt-11', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 0, 52, 13, 13, '2024-05-10 08:38:24', '2024-05-14 05:20:33'),
(95, 24, 33, 'T-shirt-12', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 25, 145, 145, '2024-05-10 08:39:16', '2024-05-10 08:39:16'),
(96, 24, 38, 'T-shirt-14', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 41, 63, 62, '2024-05-10 08:40:15', '2024-05-15 13:38:14'),
(97, 24, 33, 'T-shirt-15', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 25, 66, 66, '2024-05-10 08:41:04', '2024-05-10 08:41:04'),
(98, 25, 39, 'T-shirt-kid-5', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 14, 25, 22, '2024-05-10 08:43:25', '2024-05-14 14:47:23'),
(99, 23, 34, 'jeans-women', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 71, 256, 250, '2024-05-10 08:44:00', '2024-05-15 01:40:51'),
(100, 23, 39, 'T-shirt-kid-5', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 23, 5, 5, '2024-05-10 08:45:18', '2024-05-14 05:23:44'),
(101, 23, 39, 'T-shirt-kid-7', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 63, 60, 57, '2024-05-10 08:45:55', '2024-05-15 14:01:49'),
(102, 23, 39, 'T-shirt-kid-4', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 25, 112, 104, '2024-05-10 08:46:41', '2024-05-11 08:33:00'),
(103, 23, 36, 'hoody', 'male', '15', 1, 55, 43, 39, '2024-05-10 08:52:46', '2024-05-14 13:01:12'),
(104, 25, 34, 'jeans-Zara', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 17, 55, 55, '2024-05-10 08:53:56', '2024-05-16 08:39:19'),
(105, 24, 34, 'NIKE t-shirt', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 34, 434, 423, '2024-05-10 08:54:30', '2024-05-11 11:54:28'),
(106, 23, 38, 't-shirt-42', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 432, 55, 39, '2024-05-10 08:55:04', '2024-05-16 07:11:55'),
(107, 23, 38, 't-shirt-74', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 76, 23, 23, '2024-05-10 08:56:24', '2024-05-11 11:19:49'),
(108, 23, 36, 'cap', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 63, 96, 0, '2024-05-10 08:56:55', '2024-05-10 12:29:13'),
(109, 23, 34, 'jacket-men', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 43, 53, 0, '2024-05-10 08:57:35', '2024-05-10 12:28:12'),
(110, 26, 34, 'jeans-183', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae repellendus deleniti, eum id tenetur aspernatur qui illum officia, sit temporibus hic error quaerat, nobis facilis eius itaque. Ipsum, esse adipisci.', 1, 43, 23, 0, '2024-05-10 08:58:25', '2024-05-10 12:20:03'),
(111, 26, 39, 'T-shirt-kid-1', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et beatae error voluptatum facere excepturi! Molestiae!', 1, 31, 32, 0, '2024-05-10 09:25:48', '2024-05-10 12:03:05'),
(112, 26, 36, 'Jeans-2', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ut, ipsum impedit doloribus dicta neque recusandae? Illo ratione molestiae deleniti?', 0, 21, 52, 0, '2024-05-10 09:27:55', '2024-05-10 12:45:31'),
(113, 24, 34, 'jeans-3', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ut, ipsum impedit doloribus dicta neque recusandae? Illo ratione molestiae deleniti?', 1, 42, 422, 0, '2024-05-10 09:31:20', '2024-05-10 12:44:09'),
(114, 26, 36, 'jeans-4', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ut, ipsum impedit doloribus dicta neque recusandae? Illo ratione molestiae deleniti?', 1, 13, 52, 30, '2024-05-10 09:33:17', '2024-05-15 13:53:01'),
(115, 26, 34, 'jeans-5', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ut, ipsum impedit doloribus dicta neque recusandae? Illo ratione molestiae deleniti?', 1, 23, 256, 0, '2024-05-10 09:33:50', '2024-05-10 12:43:31'),
(116, 26, 34, 'jeans-6', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ut, ipsum impedit doloribus dicta neque recusandae? Illo ratione molestiae deleniti?', 1, 85, 698, 0, '2024-05-10 09:34:25', '2024-05-10 12:43:08'),
(117, 26, 36, 'jeans-7', 'male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ut, ipsum impedit doloribus dicta neque recusandae? Illo ratione molestiae deleniti?', 1, 58, 52, 46, '2024-05-10 09:37:06', '2024-05-16 07:11:55'),
(118, 26, 34, 'jeans-8', 'female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ut, ipsum impedit doloribus dicta neque recusandae? Illo ratione molestiae deleniti?', 1, 4, 245, 243, '2024-05-10 09:40:18', '2024-05-15 13:53:54'),
(119, 25, 33, 't-shirt-180', 'male', 'this is description for t-shirt-10', 1, 20, 30, 30, '2024-05-16 08:36:51', '2024-05-16 08:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=773 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(567, 86, 'T-shirt-2_171533923587.jpg', '2024-05-10 08:07:15', '2024-05-10 08:07:15'),
(568, 86, 'T-shirt-2_171533923591.jpg', '2024-05-10 08:07:15', '2024-05-10 08:07:15'),
(569, 86, 'T-shirt-2_171533928253.jpg', NULL, NULL),
(570, 86, 'T-shirt-2_171533928266.jpg', NULL, NULL),
(571, 86, 'T-shirt-2_171533928240.jpg', NULL, NULL),
(572, 86, 'T-shirt-2_171533928211.jpg', NULL, NULL),
(573, 87, 'T-Shirt-3_171534073532.jpg', '2024-05-10 08:32:15', '2024-05-10 08:32:15'),
(574, 87, 'T-Shirt-3_171534073593.jpg', '2024-05-10 08:32:15', '2024-05-10 08:32:15'),
(575, 87, 'T-Shirt-3_17153407356.jpg', '2024-05-10 08:32:15', '2024-05-10 08:32:15'),
(576, 87, 'T-Shirt-3_171534073532.jpg', '2024-05-10 08:32:15', '2024-05-10 08:32:15'),
(577, 87, 'T-Shirt-3_171534073583.jpg', '2024-05-10 08:32:15', '2024-05-10 08:32:15'),
(579, 88, 'T-shirt-4_171534078127.jpg', '2024-05-10 08:33:01', '2024-05-10 08:33:01'),
(580, 88, 'T-shirt-4_17153407814.jpg', '2024-05-10 08:33:01', '2024-05-10 08:33:01'),
(581, 88, 'T-shirt-4_171534078148.jpg', '2024-05-10 08:33:01', '2024-05-10 08:33:01'),
(582, 88, 'T-shirt-4_171534078175.jpg', '2024-05-10 08:33:01', '2024-05-10 08:33:01'),
(583, 88, 'T-shirt-4_171534078194.jpg', '2024-05-10 08:33:01', '2024-05-10 08:33:01'),
(584, 88, 'T-shirt-4_171534078150.jpg', '2024-05-10 08:33:01', '2024-05-10 08:33:01'),
(585, 89, 'T-shirt-5_171534082275.jpg', '2024-05-10 08:33:42', '2024-05-10 08:33:42'),
(586, 89, 'T-shirt-5_17153408221.jpg', '2024-05-10 08:33:42', '2024-05-10 08:33:42'),
(587, 89, 'T-shirt-5_171534082298.jpg', '2024-05-10 08:33:42', '2024-05-10 08:33:42'),
(588, 89, 'T-shirt-5_171534082246.jpg', '2024-05-10 08:33:42', '2024-05-10 08:33:42'),
(589, 89, 'T-shirt-5_171534082296.jpg', '2024-05-10 08:33:42', '2024-05-10 08:33:42'),
(590, 90, 'T-shirt-6_171534086243.jpg', '2024-05-10 08:34:22', '2024-05-10 08:34:22'),
(591, 90, 'T-shirt-6_171534086229.jpg', '2024-05-10 08:34:22', '2024-05-10 08:34:22'),
(592, 90, 'T-shirt-6_171534086235.jpg', '2024-05-10 08:34:22', '2024-05-10 08:34:22'),
(593, 90, 'T-shirt-6_171534086237.jpg', '2024-05-10 08:34:22', '2024-05-10 08:34:22'),
(594, 91, 'T-shirt-7_171534090562.jpg', '2024-05-10 08:35:05', '2024-05-10 08:35:05'),
(595, 91, 'T-shirt-7_171534090590.jpg', '2024-05-10 08:35:05', '2024-05-10 08:35:05'),
(596, 91, 'T-shirt-7_171534090533.jpg', '2024-05-10 08:35:05', '2024-05-10 08:35:05'),
(597, 91, 'T-shirt-7_171534090526.jpg', '2024-05-10 08:35:05', '2024-05-10 08:35:05'),
(598, 91, 'T-shirt-7_171534090513.jpg', '2024-05-10 08:35:05', '2024-05-10 08:35:05'),
(599, 92, 'T-Shirt-9_17153409796.jpg', '2024-05-10 08:36:19', '2024-05-10 08:36:19'),
(600, 92, 'T-Shirt-9_171534097952.jpg', '2024-05-10 08:36:19', '2024-05-10 08:36:19'),
(601, 92, 'T-Shirt-9_171534097964.jpg', '2024-05-10 08:36:19', '2024-05-10 08:36:19'),
(602, 93, 'T-shirt-10_17153410699.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(603, 93, 'T-shirt-10_171534106954.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(604, 93, 'T-shirt-10_171534106974.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(605, 93, 'T-shirt-10_171534106929.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(606, 93, 'T-shirt-10_171534106956.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(607, 93, 'T-shirt-10_171534106922.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(608, 93, 'T-shirt-10_171534106994.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(609, 93, 'T-shirt-10_171534106936.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(610, 93, 'T-shirt-10_171534106966.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(611, 93, 'T-shirt-10_171534106933.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(612, 93, 'T-shirt-10_171534106950.jpg', '2024-05-10 08:37:49', '2024-05-10 08:37:49'),
(613, 94, 'T-Shirt-11_171534110460.jpg', '2024-05-10 08:38:24', '2024-05-10 08:38:24'),
(614, 94, 'T-Shirt-11_17153411048.jpg', '2024-05-10 08:38:24', '2024-05-10 08:38:24'),
(615, 94, 'T-Shirt-11_171534110482.jpg', '2024-05-10 08:38:24', '2024-05-10 08:38:24'),
(616, 95, 'T-shirt-12_171534115625.jpg', '2024-05-10 08:39:16', '2024-05-10 08:39:16'),
(617, 95, 'T-shirt-12_171534115660.jpg', '2024-05-10 08:39:16', '2024-05-10 08:39:16'),
(618, 95, 'T-shirt-12_171534115678.jpg', '2024-05-10 08:39:16', '2024-05-10 08:39:16'),
(619, 96, 'T-shirt-14_171534121567.jpg', '2024-05-10 08:40:15', '2024-05-10 08:40:15'),
(620, 96, 'T-shirt-14_171534121577.jpg', '2024-05-10 08:40:15', '2024-05-10 08:40:15'),
(621, 97, 'T-shirt-15_171534126460.jpg', '2024-05-10 08:41:04', '2024-05-10 08:41:04'),
(622, 97, 'T-shirt-15_171534126475.jpg', '2024-05-10 08:41:04', '2024-05-10 08:41:04'),
(661, 112, 'Jeans-2_171534407546.jpg', '2024-05-10 09:27:55', '2024-05-10 09:27:55'),
(662, 112, 'Jeans-2_171534407544.jpg', '2024-05-10 09:27:55', '2024-05-10 09:27:55'),
(663, 112, 'Jeans-2_171534407524.jpg', '2024-05-10 09:27:55', '2024-05-10 09:27:55'),
(664, 112, 'Jeans-2_171534407572.jpg', '2024-05-10 09:27:55', '2024-05-10 09:27:55'),
(665, 113, 'jeans-3_171534428055.jpg', '2024-05-10 09:31:20', '2024-05-10 09:31:20'),
(666, 113, 'jeans-3_171534428026.jpg', '2024-05-10 09:31:20', '2024-05-10 09:31:20'),
(667, 113, 'jeans-3_171534428046.jpg', '2024-05-10 09:31:20', '2024-05-10 09:31:20'),
(668, 113, 'jeans-3_171534428025.jpg', '2024-05-10 09:31:20', '2024-05-10 09:31:20'),
(669, 113, 'jeans-3_171534428013.jpg', '2024-05-10 09:31:20', '2024-05-10 09:31:20'),
(670, 114, 'jeans-4_171534439752.jpg', '2024-05-10 09:33:17', '2024-05-10 09:33:17'),
(671, 114, 'jeans-4_171534439760.jpg', '2024-05-10 09:33:17', '2024-05-10 09:33:17'),
(672, 114, 'jeans-4_171534439790.jpg', '2024-05-10 09:33:17', '2024-05-10 09:33:17'),
(673, 114, 'jeans-4_171534439745.jpg', '2024-05-10 09:33:17', '2024-05-10 09:33:17'),
(674, 115, 'jeans-5_171534443011.jpg', '2024-05-10 09:33:50', '2024-05-10 09:33:50'),
(675, 115, 'jeans-5_171534443051.jpg', '2024-05-10 09:33:50', '2024-05-10 09:33:50'),
(676, 115, 'jeans-5_171534443086.jpg', '2024-05-10 09:33:50', '2024-05-10 09:33:50'),
(677, 115, 'jeans-5_171534443065.jpg', '2024-05-10 09:33:50', '2024-05-10 09:33:50'),
(678, 116, 'jeans-6_171534446583.jpg', '2024-05-10 09:34:25', '2024-05-10 09:34:25'),
(679, 116, 'jeans-6_171534446571.jpg', '2024-05-10 09:34:25', '2024-05-10 09:34:25'),
(680, 116, 'jeans-6_171534446598.jpg', '2024-05-10 09:34:25', '2024-05-10 09:34:25'),
(681, 116, 'jeans-6_171534446599.jpg', '2024-05-10 09:34:25', '2024-05-10 09:34:25'),
(682, 116, 'jeans-6_171534446579.jpg', '2024-05-10 09:34:25', '2024-05-10 09:34:25'),
(683, 116, 'jeans-6_171534446574.jpg', '2024-05-10 09:34:25', '2024-05-10 09:34:25'),
(684, 116, 'jeans-6_171534446513.jpg', '2024-05-10 09:34:25', '2024-05-10 09:34:25'),
(685, 117, 'jeans-7_171534462688.jpg', '2024-05-10 09:37:06', '2024-05-10 09:37:06'),
(686, 117, 'jeans-7_171534462624.jpg', '2024-05-10 09:37:06', '2024-05-10 09:37:06'),
(687, 117, 'jeans-7_171534462643.jpg', '2024-05-10 09:37:06', '2024-05-10 09:37:06'),
(688, 118, 'jeans-8_171534481842.jpg', '2024-05-10 09:40:18', '2024-05-10 09:40:18'),
(689, 118, 'jeans-8_171534481882.jpg', '2024-05-10 09:40:18', '2024-05-10 09:40:18'),
(690, 118, 'jeans-8_171534481833.jpg', '2024-05-10 09:40:18', '2024-05-10 09:40:18'),
(691, 118, 'jeans-8_171534481855.jpg', '2024-05-10 09:40:18', '2024-05-10 09:40:18'),
(692, 111, 'T-shirt-1_171535329917.jpg', NULL, NULL),
(693, 111, 'T-shirt-1_171535329914.jpg', NULL, NULL),
(694, 111, 'T-shirt-1_171535329970.jpg', NULL, NULL),
(695, 111, 'T-shirt-1_171535329932.jpg', NULL, NULL),
(696, 85, 'Tishirt-1_171535341932.jpg', NULL, NULL),
(697, 85, 'Tishirt-1_171535341935.jpg', NULL, NULL),
(698, 85, 'Tishirt-1_171535341947.jpg', NULL, NULL),
(699, 85, 'Tishirt-1_171535341919.jpg', NULL, NULL),
(700, 84, 'T-shirt-kid-3_171535352168.jpg', NULL, NULL),
(701, 84, 'T-shirt-kid-3_171535352160.jpg', NULL, NULL),
(702, 84, 'T-shirt-kid-3_171535352198.jpg', NULL, NULL),
(703, 84, 'T-shirt-kid-3_171535352156.jpg', NULL, NULL),
(704, 102, 'shoes-8_171535355933.jpg', NULL, NULL),
(705, 102, 'shoes-8_171535355917.jpg', NULL, NULL),
(706, 102, 'shoes-8_171535355956.jpg', NULL, NULL),
(707, 83, 'Dress_17153536446.jpg', NULL, NULL),
(708, 83, 'Dress_171535364492.jpg', NULL, NULL),
(709, 83, 'Dress_171535364449.jpg', NULL, NULL),
(710, 101, 'T-shirt-kid-5_171535404476.jpg', NULL, NULL),
(711, 101, 'T-shirt-kid-5_171535404497.jpg', NULL, NULL),
(712, 101, 'T-shirt-kid-5_171535404485.jpg', NULL, NULL),
(713, 100, 'T-shirt-kid-5_171535409180.jpg', NULL, NULL),
(714, 100, 'T-shirt-kid-5_171535409168.jpg', NULL, NULL),
(715, 100, 'T-shirt-kid-5_171535409118.jpg', NULL, NULL),
(716, 100, 'T-shirt-kid-5_171535409193.jpg', NULL, NULL),
(717, 100, 'T-shirt-kid-5_171535409133.jpg', NULL, NULL),
(718, 100, 'T-shirt-kid-5_171535409158.jpg', NULL, NULL),
(719, 98, 'T-shirt-kid-5_171535412182.jpg', NULL, NULL),
(720, 98, 'T-shirt-kid-5_171535412141.jpg', NULL, NULL),
(721, 98, 'T-shirt-kid-5_171535412155.jpg', NULL, NULL),
(722, 98, 'T-shirt-kid-5_171535412153.jpg', NULL, NULL),
(723, 108, 'coat_171535419873.jpg', NULL, NULL),
(724, 110, 'jeans-1_171535433641.jpg', NULL, NULL),
(725, 110, 'jeans-1_171535433683.jpg', NULL, NULL),
(727, 99, 'jeans-women_171535465557.jpg', NULL, NULL),
(728, 99, 'jeans-women_171535465511.jpg', NULL, NULL),
(729, 99, 'jeans-women_171535469062.jpg', NULL, NULL),
(730, 99, 'jeans-women_171535469047.jpg', NULL, NULL),
(731, 109, 'jacket-men_171535489248.jpg', NULL, NULL),
(732, 109, 'jacket-men_171535489254.jpg', NULL, NULL),
(733, 109, 'jacket-men_171535489249.jpg', NULL, NULL),
(734, 107, 't-shirt-74_171535499868.jpg', NULL, NULL),
(735, 107, 't-shirt-74_171535499872.jpg', NULL, NULL),
(736, 107, 't-shirt-74_171535499838.jpg', NULL, NULL),
(737, 107, 't-shirt-74_171535499880.jpg', NULL, NULL),
(738, 107, 't-shirt-74_171535499827.jpg', NULL, NULL),
(739, 106, 't-shirt-42_171535504099.jpg', NULL, NULL),
(740, 106, 't-shirt-42_171535504061.jpg', NULL, NULL),
(741, 106, 't-shirt-42_171535504040.jpg', NULL, NULL),
(742, 106, 't-shirt-42_171535504054.jpg', NULL, NULL),
(743, 106, 't-shirt-42_171535504068.jpg', NULL, NULL),
(744, 106, 't-shirt-42_171535504086.jpg', NULL, NULL),
(745, 106, 't-shirt-42_171535504042.jpg', NULL, NULL),
(746, 106, 't-shirt-42_171535504081.jpg', NULL, NULL),
(747, 106, 't-shirt-42_17153550406.jpg', NULL, NULL),
(748, 106, 't-shirt-42_171535504020.jpg', NULL, NULL),
(749, 105, 'NIKE t-shirt_171535512936.jpg', NULL, NULL),
(750, 105, 'NIKE t-shirt_171535512967.jpg', NULL, NULL),
(751, 105, 'NIKE t-shirt_171535512954.jpg', NULL, NULL),
(752, 105, 'NIKE t-shirt_171535512945.jpg', NULL, NULL),
(753, 103, 't shirt_171535529735.jpg', NULL, NULL),
(754, 103, 't shirt_171535529781.jpg', NULL, NULL),
(755, 103, 't shirt_171535529723.jpg', NULL, NULL),
(756, 103, 't shirt_171535529783.jpg', NULL, NULL),
(757, 103, 't shirt_171535529782.jpg', NULL, NULL),
(758, 103, 't shirt_171535529782.jpg', NULL, NULL),
(759, 103, 't shirt_171535529781.jpg', NULL, NULL),
(760, 104, 'jeans-Zara_171535618553.jpg', NULL, NULL),
(761, 104, 'jeans-Zara_171535618532.jpg', NULL, NULL),
(762, 104, 'jeans-Zara_171535618599.jpg', NULL, NULL),
(763, 104, 'jeans-Zara_171535618545.jpg', NULL, NULL),
(764, 104, 'jeans-Zara_171535618593.jpg', NULL, NULL),
(765, 104, 'jeans-Zara_171535618518.jpg', NULL, NULL),
(766, 104, 'jeans-Zara_171535618576.jpg', NULL, NULL),
(767, 119, 't-shirt-180_171585941147.jpg', '2024-05-16 08:36:51', '2024-05-16 08:36:51'),
(768, 119, 't-shirt-180_17158594115.jpg', '2024-05-16 08:36:51', '2024-05-16 08:36:51'),
(769, 119, 't-shirt-180_171585941174.jpg', '2024-05-16 08:36:51', '2024-05-16 08:36:51'),
(770, 119, 't-shirt-180_171585941153.jpg', '2024-05-16 08:36:51', '2024-05-16 08:36:51'),
(771, 119, 't-shirt-180_171585941121.jpg', '2024-05-16 08:36:51', '2024-05-16 08:36:51'),
(772, 119, 't-shirt-180_171585941116.jpg', '2024-05-16 08:36:51', '2024-05-16 08:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `shippingaddress`
--

DROP TABLE IF EXISTS `shippingaddress`;
CREATE TABLE IF NOT EXISTS `shippingaddress` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `street_number` int NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shippingaddress_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippingaddress`
--

INSERT INTO `shippingaddress` (`id`, `user_id`, `street_number`, `city`, `country`, `state`, `created_at`, `updated_at`) VALUES
(1, 25, 234, 'Dallas', 'Lebanon', 'Baalbek', '2024-05-11 04:46:00', '2024-05-11 04:46:00'),
(2, 25, 342, 'ali', 'Lebanon', 'Tripoli', '2024-05-11 04:49:07', '2024-05-11 04:49:07'),
(3, 29, 7894, 'Dallas', 'Lebanon', 'Jounieh', '2024-05-11 07:55:56', '2024-05-11 07:55:56'),
(4, 30, 34, 'Los Angeles', 'Lebanon', 'Beirut', '2024-05-11 08:11:36', '2024-05-11 08:11:36'),
(5, 30, 34234, 'Dallas', 'Lebanon', 'Tyre', '2024-05-11 08:24:20', '2024-05-11 08:24:20'),
(6, 30, 4564654, 'Austin', 'Lebanon', 'Zahle', '2024-05-14 05:20:15', '2024-05-14 05:20:15'),
(7, 31, 33432, 'Austin', 'Lebanon', 'Tripoli', '2024-05-14 09:15:46', '2024-05-14 09:15:46'),
(8, 32, 324, 'Dallas', 'Lebanon', 'Zahle', '2024-05-14 09:40:30', '2024-05-14 09:40:30'),
(9, 32, 11, 'Dallas', 'Lebanon', 'Byblos', '2024-05-14 12:55:25', '2024-05-14 12:55:25'),
(10, 32, 111, 'Austin', 'Lebanon', 'Jounieh', '2024-05-14 14:47:18', '2024-05-14 14:47:18'),
(11, 32, 5, 'Austin', 'Lebanon', 'Tyre', '2024-05-14 14:53:22', '2024-05-14 14:53:22'),
(12, 33, -6, 'Dallas', 'Lebanon', 'Tyre', '2024-05-15 01:37:14', '2024-05-15 01:37:14'),
(13, 34, 3, 'Dallas', 'Lebanon', 'Tyre', '2024-05-15 01:39:41', '2024-05-15 01:39:41'),
(14, 30, 34, 'Dallas', 'Lebanon', 'Zgharta_Ehden', '2024-05-15 13:34:47', '2024-05-15 13:34:47'),
(15, 32, 334, 'Austin', 'Lebanon', 'Tyre', '2024-05-15 14:01:38', '2024-05-15 14:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sizes_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=267 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `product_id`, `size`, `created_at`, `updated_at`) VALUES
(1, 64, 'xl', '2024-05-07 08:40:02', '2024-05-07 08:40:02'),
(2, 64, '3xl', '2024-05-07 08:40:02', '2024-05-07 08:40:02'),
(62, 65, '5xl', '2024-05-10 05:15:05', '2024-05-10 05:15:05'),
(61, 65, 'xxl', '2024-05-10 05:15:05', '2024-05-10 05:15:05'),
(64, 66, '7xl', '2024-05-10 05:17:44', '2024-05-10 05:17:44'),
(63, 66, 'xxl', '2024-05-10 05:17:44', '2024-05-10 05:17:44'),
(55, 67, 'xs', '2024-05-09 12:42:27', '2024-05-09 12:42:27'),
(11, 68, 'm', '2024-05-07 09:05:38', '2024-05-07 09:05:38'),
(12, 68, 's', '2024-05-07 09:05:38', '2024-05-07 09:05:38'),
(13, 68, 'xl', '2024-05-07 09:05:38', '2024-05-07 09:05:38'),
(49, 69, '6xl', '2024-05-08 10:20:31', '2024-05-08 10:20:31'),
(48, 69, '5xl', '2024-05-08 10:20:31', '2024-05-08 10:20:31'),
(47, 69, 'xs', '2024-05-08 10:20:31', '2024-05-08 10:20:31'),
(54, 70, '3xl', '2024-05-08 10:23:10', '2024-05-08 10:23:10'),
(53, 70, 'xl', '2024-05-08 10:23:10', '2024-05-08 10:23:10'),
(19, 71, 'm', '2024-05-07 09:09:08', '2024-05-07 09:09:08'),
(20, 71, 'xs', '2024-05-07 09:09:08', '2024-05-07 09:09:08'),
(21, 71, 'xxl', '2024-05-07 09:09:08', '2024-05-07 09:09:08'),
(22, 72, 'xs', '2024-05-07 09:09:53', '2024-05-07 09:09:53'),
(23, 72, '7xl', '2024-05-07 09:09:53', '2024-05-07 09:09:53'),
(66, 73, '5xl', '2024-05-10 05:19:04', '2024-05-10 05:19:04'),
(65, 73, 'l', '2024-05-10 05:19:04', '2024-05-10 05:19:04'),
(26, 74, 'l', '2024-05-07 09:11:43', '2024-05-07 09:11:43'),
(27, 74, '7xl', '2024-05-07 09:11:43', '2024-05-07 09:11:43'),
(28, 75, 'm', '2024-05-07 09:12:50', '2024-05-07 09:12:50'),
(29, 75, 'xl', '2024-05-07 09:12:50', '2024-05-07 09:12:50'),
(30, 75, 'xxl', '2024-05-07 09:12:50', '2024-05-07 09:12:50'),
(52, 76, 'xl', '2024-05-08 10:22:52', '2024-05-08 10:22:52'),
(51, 76, 's', '2024-05-08 10:22:52', '2024-05-08 10:22:52'),
(50, 76, 'm', '2024-05-08 10:22:52', '2024-05-08 10:22:52'),
(56, 67, '4xl', '2024-05-09 12:42:27', '2024-05-09 12:42:27'),
(38, 77, 'm', '2024-05-08 02:50:34', '2024-05-08 02:50:34'),
(39, 77, 'xl', '2024-05-08 02:50:34', '2024-05-08 02:50:34'),
(40, 77, 'l', '2024-05-08 02:50:34', '2024-05-08 02:50:34'),
(41, 78, 's', '2024-05-08 02:52:21', '2024-05-08 02:52:21'),
(42, 78, 'xl', '2024-05-08 02:52:21', '2024-05-08 02:52:21'),
(43, 79, 'm', '2024-05-08 03:08:33', '2024-05-08 03:08:33'),
(44, 79, 'xl', '2024-05-08 03:08:33', '2024-05-08 03:08:33'),
(72, 80, 'l', '2024-05-10 05:38:27', '2024-05-10 05:38:27'),
(71, 80, 'm', '2024-05-10 05:38:27', '2024-05-10 05:38:27'),
(70, 81, 's', '2024-05-10 05:38:11', '2024-05-10 05:38:11'),
(73, 82, 'xl', '2024-05-10 07:51:33', '2024-05-10 07:51:33'),
(261, 83, 'l', '2024-05-11 03:34:15', '2024-05-11 03:34:15'),
(260, 83, 's', '2024-05-11 03:34:15', '2024-05-11 03:34:15'),
(216, 84, 'xs', '2024-05-10 12:26:35', '2024-05-10 12:26:35'),
(205, 85, 'xl', '2024-05-10 12:21:55', '2024-05-10 12:21:55'),
(204, 85, 's', '2024-05-10 12:21:55', '2024-05-10 12:21:55'),
(203, 85, 'm', '2024-05-10 12:21:55', '2024-05-10 12:21:55'),
(94, 86, 'xl', '2024-05-10 08:24:47', '2024-05-10 08:24:47'),
(93, 86, 'm', '2024-05-10 08:24:47', '2024-05-10 08:24:47'),
(180, 87, 'xl', '2024-05-10 12:10:31', '2024-05-10 12:10:31'),
(179, 87, 'm', '2024-05-10 12:10:31', '2024-05-10 12:10:31'),
(235, 88, 'xs', '2024-05-10 12:34:16', '2024-05-10 12:34:16'),
(99, 89, 'xs', '2024-05-10 08:33:42', '2024-05-10 08:33:42'),
(100, 89, '8xl', '2024-05-10 08:33:42', '2024-05-10 08:33:42'),
(186, 90, '3xl', '2024-05-10 12:11:14', '2024-05-10 12:11:14'),
(185, 90, 'l', '2024-05-10 12:11:14', '2024-05-10 12:11:14'),
(184, 90, 's', '2024-05-10 12:11:14', '2024-05-10 12:11:14'),
(183, 90, 'm', '2024-05-10 12:11:14', '2024-05-10 12:11:14'),
(168, 91, '3xl', '2024-05-10 12:04:47', '2024-05-10 12:04:47'),
(167, 91, 's', '2024-05-10 12:04:47', '2024-05-10 12:04:47'),
(188, 92, '4xl', '2024-05-10 12:11:30', '2024-05-10 12:11:30'),
(187, 92, 'xxl', '2024-05-10 12:11:30', '2024-05-10 12:11:30'),
(264, 93, 'l', '2024-05-14 14:44:09', '2024-05-14 14:44:09'),
(263, 93, 's', '2024-05-14 14:44:09', '2024-05-14 14:44:09'),
(111, 94, 's', '2024-05-10 08:38:24', '2024-05-10 08:38:24'),
(112, 94, '3xl', '2024-05-10 08:38:24', '2024-05-10 08:38:24'),
(113, 95, 's', '2024-05-10 08:39:16', '2024-05-10 08:39:16'),
(114, 95, '4xl', '2024-05-10 08:39:16', '2024-05-10 08:39:16'),
(218, 96, 'l', '2024-05-10 12:27:09', '2024-05-10 12:27:09'),
(116, 97, 'l', '2024-05-10 08:41:04', '2024-05-10 08:41:04'),
(117, 97, '4xl', '2024-05-10 08:41:04', '2024-05-10 08:41:04'),
(206, 98, 's', '2024-05-10 12:22:51', '2024-05-10 12:22:51'),
(214, 99, 'xl', '2024-05-10 12:24:50', '2024-05-10 12:24:50'),
(210, 100, 'm', '2024-05-10 12:23:21', '2024-05-10 12:23:21'),
(211, 101, 'xl', '2024-05-10 12:23:35', '2024-05-10 12:23:35'),
(208, 102, 'l', '2024-05-10 12:23:06', '2024-05-10 12:23:06'),
(249, 103, 'xxl', '2024-05-10 12:45:00', '2024-05-10 12:45:00'),
(248, 103, 'xl', '2024-05-10 12:45:00', '2024-05-10 12:45:00'),
(254, 104, 'xl', '2024-05-10 12:49:45', '2024-05-10 12:49:45'),
(234, 105, 'm', '2024-05-10 12:32:50', '2024-05-10 12:32:50'),
(231, 106, 'xs', '2024-05-10 12:31:09', '2024-05-10 12:31:09'),
(227, 107, 'xs', '2024-05-10 12:30:18', '2024-05-10 12:30:18'),
(223, 108, 'xl', '2024-05-10 12:29:13', '2024-05-10 12:29:13'),
(222, 109, 'l', '2024-05-10 12:28:44', '2024-05-10 12:28:44'),
(221, 109, 'xl', '2024-05-10 12:28:44', '2024-05-10 12:28:44'),
(202, 110, 'm', '2024-05-10 12:20:20', '2024-05-10 12:20:20'),
(159, 111, 'xl', '2024-05-10 12:03:05', '2024-05-10 12:03:05'),
(251, 112, 's', '2024-05-10 12:45:31', '2024-05-10 12:45:31'),
(250, 112, 'm', '2024-05-10 12:45:31', '2024-05-10 12:45:31'),
(247, 113, 's', '2024-05-10 12:44:09', '2024-05-10 12:44:09'),
(246, 113, 'm', '2024-05-10 12:44:09', '2024-05-10 12:44:09'),
(148, 114, 'l', '2024-05-10 09:33:17', '2024-05-10 09:33:17'),
(245, 115, 'xxl', '2024-05-10 12:43:31', '2024-05-10 12:43:31'),
(244, 115, 's', '2024-05-10 12:43:31', '2024-05-10 12:43:31'),
(243, 116, 'xs', '2024-05-10 12:43:08', '2024-05-10 12:43:08'),
(152, 117, 's', '2024-05-10 09:37:06', '2024-05-10 09:37:06'),
(153, 117, 'xxl', '2024-05-10 09:37:06', '2024-05-10 09:37:06'),
(262, 118, 'xxl', '2024-05-12 05:27:36', '2024-05-12 05:27:36'),
(160, 111, '3xl', '2024-05-10 12:03:05', '2024-05-10 12:03:05'),
(217, 84, 'xxl', '2024-05-10 12:26:35', '2024-05-10 12:26:35'),
(209, 102, '5xl', '2024-05-10 12:23:06', '2024-05-10 12:23:06'),
(236, 88, '4xl', '2024-05-10 12:34:16', '2024-05-10 12:34:16'),
(207, 98, '3xl', '2024-05-10 12:22:51', '2024-05-10 12:22:51'),
(224, 108, '5xl', '2024-05-10 12:29:13', '2024-05-10 12:29:13'),
(215, 99, '4xl', '2024-05-10 12:24:50', '2024-05-10 12:24:50'),
(228, 107, '4xl', '2024-05-10 12:30:18', '2024-05-10 12:30:18'),
(232, 106, '4xl', '2024-05-10 12:31:09', '2024-05-10 12:31:09'),
(255, 104, 'xxl', '2024-05-10 12:49:45', '2024-05-10 12:49:45'),
(265, 119, 's', '2024-05-16 08:36:51', '2024-05-16 08:36:51'),
(266, 119, 'xl', '2024-05-16 08:36:51', '2024-05-16 08:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_categories_category_id_index` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(33, 72, 'T-shirt-women', 'sub-T-shirt_1715338700.jpg', '2024-05-10 07:58:20', '2024-05-10 12:00:00'),
(34, 72, 'Jeans-women', 'sub-shoes_1715338719.jpg', '2024-05-10 07:58:39', '2024-05-10 12:00:08'),
(36, 71, 'Jackets & Coats-men', 'sub-Jeans_1715343883.jpg', '2024-05-10 09:24:43', '2024-05-10 12:47:29'),
(37, 72, 'Jackets & Coats-women', 'Jackets & Coats_1715353042.jpg', '2024-05-10 11:57:22', '2024-05-10 11:57:50'),
(38, 71, 'T-shirt-men', 'T-shirts_1715353181.jpg', '2024-05-10 11:59:41', '2024-05-10 11:59:49'),
(39, 74, 'T-shirt-kid', 'T-shirt-kid_1715353360.jpg', '2024-05-10 12:02:40', '2024-05-10 12:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `Gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `phone_number`, `image`, `birth_date`, `Gender`, `created_at`, `updated_at`) VALUES
(8, 'khaled alhilal', 'khaled1@gmail.com', '$2y$12$D.3TKJyBc9WBWuVLFSThqefPB2E.g8jL6tDjwE0x6mi7cOUY2UD42', 'user', '123456788', 'khaled_sdf_1715082954.webp', '2024-03-19', 'male', '2024-03-09 06:20:28', '2024-05-07 08:56:11'),
(25, 'khaled alhilal', 'khaleddd@gmail.com', '$2y$12$p8/I4oR0kLByCLE0RNgmauICKv1BoQ0XQciUgblu/66gX9AylDtui', 'admin', '87654321', 'profile.jpg', '2024-05-30', 'male', '2024-05-09 06:52:27', '2024-05-11 08:10:14'),
(29, 'khaled alhilal', 'khaled1@gmail.com', '$2y$12$CXb3Eey4FPEKQYv7mIL7aufNpWKh0Aa8lHaMWX2ZgLMo9ueLF2R3i', 'user', '12345678', 'profile.jpg', '2024-05-08', 'male', '2024-05-11 07:55:56', '2024-05-11 07:55:56'),
(30, 'ali hasan', 'khaled1111111@gmail.com', '$2y$12$GThNHKYJugawlExdBB.6rONTkkhYGsVRq4rohSAvfKcb/ct8CrY72', 'user', '88888888', 'profile.jpg', '2024-05-07', 'female', '2024-05-11 08:11:36', '2024-05-14 05:34:06'),
(31, 'ali ali', 'ali1@gmail.com', '$2y$12$JR.fJiSwMQphQjbn/WyBgeBPhkmoNSbgn14nqTbEOAWulZPzf37Fq', 'user', '12341234', 'profile.jpg', '2024-05-28', 'male', '2024-05-14 09:15:46', '2024-05-14 09:15:46'),
(32, 'ali mohsen', 'kha@gmail.com', '$2y$12$4KC8E26nrOxkfOQcJpn.HemCac01scsHQ2QaGXNUDKBVhrtECYUHW', 'user', '12312312', 'profile.jpg', '2024-05-21', 'male', '2024-05-14 09:40:30', '2024-05-14 13:05:00'),
(33, 'ali osseili', 'ali@gmail.com', '$2y$12$jXPvSxNE2vnebDywjgVk6uJgpw/uBCXukjQahFi3VclRL5gIortVO', 'user', '96165156', 'profile.jpg', '2001-11-11', 'male', '2024-05-15 01:37:14', '2024-05-15 01:37:14'),
(34, 'ahmad ismail', 'ahmad@gmail.com', '$2y$12$.8Da4IPPxAeIh4//bMRK5OtvH5DKT.r8Csnu.s/hPdiMUZpobWgO2', 'user', '03123456', 'profile.jpg', '2001-11-11', 'male', '2024-05-15 01:39:41', '2024-05-15 01:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(35, 117, 25, '2024-05-11 04:54:20', '2024-05-11 04:54:20'),
(38, 87, 30, '2024-05-16 08:43:37', '2024-05-16 08:43:37');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `shippingaddress` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subCategory_id`) REFERENCES `sub_categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shippingaddress`
--
ALTER TABLE `shippingaddress`
  ADD CONSTRAINT `shippingaddress_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
