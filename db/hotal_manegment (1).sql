-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 09:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotal_manegment`
--

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `auditable_type` varchar(255) NOT NULL,
  `auditable_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` text DEFAULT NULL,
  `new_values` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(1023) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audits`
--

INSERT INTO `audits` (`id`, `user_type`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `tags`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'created', 'App\\Models\\Categories', 12, '[]', '{\"title\":\"test\",\"owner_id\":2,\"id\":12}', 'http://127.0.0.1:8000/administrator/categories/store', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', NULL, '2023-05-08 10:32:40', '2023-05-08 10:32:40'),
(2, 'App\\Models\\User', 2, 'updated', 'App\\Models\\Categories', 12, '{\"title\":\"test\"}', '{\"title\":\"testing\"}', 'http://127.0.0.1:8000/administrator/categories/update', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', NULL, '2023-05-08 10:33:15', '2023-05-08 10:33:15'),
(3, 'App\\Models\\User', 2, 'updated', 'App\\Models\\Categories', 12, '{\"status\":\"Active\"}', '{\"status\":\"Inactive\"}', 'http://127.0.0.1:8000/administrator/categories/change_status/12/Inactive', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', NULL, '2023-05-08 10:33:37', '2023-05-08 10:33:37'),
(4, 'App\\Models\\User', 2, 'updated', 'App\\Models\\Categories', 12, '{\"status\":\"Inactive\"}', '{\"status\":\"Active\"}', 'http://127.0.0.1:8000/administrator/categories/change_status/12/Active', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', NULL, '2023-05-08 10:33:52', '2023-05-08 10:33:52'),
(5, 'App\\Models\\User', 2, 'updated', 'App\\Models\\Customer', 3, '{\"status\":\"Active\"}', '{\"status\":\"Inactive\"}', 'http://127.0.0.1:8000/administrator/customer/change_status/3/Inactive', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', NULL, '2023-05-12 23:21:19', '2023-05-12 23:21:19'),
(6, 'App\\Models\\User', 2, 'updated', 'App\\Models\\Customer', 4, '{\"status\":\"Inactive\"}', '{\"status\":\"Active\"}', 'http://127.0.0.1:8000/administrator/customer/change_status/4/Active', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', NULL, '2023-05-12 23:37:21', '2023-05-12 23:37:21'),
(7, 'App\\Models\\User', 2, 'deleted', 'App\\Models\\Categories', 12, '{\"id\":12,\"title\":\"testing\",\"status\":\"Active\",\"owner_id\":2}', '[]', 'http://127.0.0.1:8000/administrator/categories/delete/12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', NULL, '2023-05-13 22:05:13', '2023-05-13 22:05:13'),
(8, 'App\\Models\\User', 2, 'created', 'App\\Models\\Categories', 13, '[]', '{\"title\":\"Weekend\",\"owner_id\":2,\"id\":13}', 'http://127.0.0.1:8000/administrator/categories/store', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', NULL, '2023-05-13 22:05:28', '2023-05-13 22:05:28'),
(9, 'App\\Models\\User', 2, 'created', 'App\\Models\\Categories', 14, '[]', '{\"title\":\"Monthly\",\"owner_id\":2,\"id\":14}', 'http://127.0.0.1:8000/administrator/categories/store', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', NULL, '2023-05-13 22:05:39', '2023-05-13 22:05:39'),
(10, 'App\\Models\\User', 2, 'created', 'App\\Models\\Categories', 15, '[]', '{\"title\":\"Yearly\",\"owner_id\":2,\"id\":15}', 'http://127.0.0.1:8000/administrator/categories/store', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', NULL, '2023-05-13 22:05:59', '2023-05-13 22:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `type` enum('package','coupon') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `status`, `created_at`, `updated_at`, `owner_id`) VALUES
(13, 'Weekend', 'Active', '2023-05-13 22:05:28', '2023-05-13 22:05:28', 2),
(14, 'Monthly', 'Active', '2023-05-13 22:05:39', '2023-05-13 22:05:39', 2),
(15, 'Yearly', 'Active', '2023-05-13 22:05:59', '2023-05-13 22:05:59', 2);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `custom_coupon_id` varchar(200) NOT NULL,
  `visit_type` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `category_id`, `title`, `description`, `custom_coupon_id`, `visit_type`, `status`, `created_at`, `updated_at`, `deleted_at`, `owner_id`) VALUES
(1, 13, 'WeeklyCoupon', 'Description', 'COUPON0001', 1, 'Active', '2023-05-13 22:09:37', '2023-05-13 22:09:37', NULL, 2),
(2, 14, 'Montly', 'Description', 'COUPON0002', 1, 'Active', '2023-05-13 22:10:01', '2023-05-13 22:10:01', NULL, 2),
(3, 15, 'Yearly', 'test', 'COUPON0003', 2, 'Active', '2023-05-13 22:10:14', '2023-05-13 22:10:14', NULL, 2),
(4, 15, 'Yearly 2', 'Yearly 2', 'COUPON0004', 1, 'Active', '2023-05-13 22:13:47', '2023-05-13 22:13:47', NULL, 2),
(5, 15, 'Yearly 3', 'Yearly 3', 'COUPON0005', 1, 'Active', '2023-05-13 22:14:00', '2023-05-13 22:14:00', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `mobile`) VALUES
(1, 'amit', 'aamdk@gmail.com', NULL, '$2y$10$9OLmMdZ.ysvobIbc1Ip2fuc0uL7xYWr9kGc2aOcjsb4HgNimv3qa6', 'Active', NULL, '2023-05-03 09:47:26', '2023-05-11 15:48:42', '9887989987'),
(2, 'amit', 'amk@gmail.com', NULL, '$2y$10$UGksnSO7j/Os/baTIijUIOBtT8me2h.fPDWI670w8OKCFgU9J3q9y', 'Active', NULL, '2023-05-11 15:10:59', '2023-05-11 15:10:59', '9887989986'),
(3, 'amit', 'amdk@gmail.com', NULL, '$2y$10$/C/tMnnMtNr6fA5fkBoCKezxoiBEUtAPNVwyjBfMODEk3RzEI2i46', 'Inactive', NULL, '2023-05-11 15:14:02', '2023-05-12 23:21:19', '9887989987'),
(4, 'Ram', 'ram@gmail.com', NULL, '$2y$10$/C/tMnnMtNr6fA5fkBoCKezxoiBEUtAPNVwyjBfMODEk3RzEI2i46', 'Active', NULL, '2023-05-11 15:14:02', '2023-05-12 23:37:21', '9887091831'),
(5, 'anuj', 'anuj@gmail.com', NULL, '$2y$10$J6FMgZfHi9oK3mjJjf/g4.DNecCDvu2FcFC1J8YEV4LLDi5I4pf.e', 'Active', NULL, '2023-05-16 14:46:46', '2023-05-16 14:46:46', '9887989982');

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
-- Table structure for table `hotelcoupons`
--

CREATE TABLE `hotelcoupons` (
  `id` bigint(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `custom_coupon_id` varchar(200) NOT NULL,
  `visit_type` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `hotel_id` int(11) NOT NULL,
  `used_limit` int(11) NOT NULL,
  `valid_date` date DEFAULT NULL,
  `amount` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotelcoupons`
--

INSERT INTO `hotelcoupons` (`id`, `title`, `description`, `custom_coupon_id`, `visit_type`, `status`, `created_at`, `updated_at`, `deleted_at`, `hotel_id`, `used_limit`, `valid_date`, `amount`) VALUES
(3, 'My c', '<b>test</b>', 'COUPON0001', 2, 'Active', '2023-04-29 09:49:52', '2023-04-29 10:02:44', '2023-04-29 10:02:44', 5, 0, NULL, 0.00),
(6, 'test', 'test', 'COUPON0002', 2, 'Active', '2023-04-29 10:05:14', '2023-04-29 22:08:12', NULL, 5, 0, NULL, 0.00),
(7, 'testdfsdfsdfsdfsdfs', 'dfsdfdsfsdfsdfsdfsdfsdf', 'COUPON0003', 1, 'Active', '2023-04-29 10:05:26', '2023-04-29 22:08:59', '2023-04-29 22:08:59', 5, 0, NULL, 0.00),
(8, 'test', 'test', 'COUPON0004', 12, 'Active', '2023-04-29 10:17:36', '2023-04-30 04:58:37', '2023-04-30 04:58:37', 4, 0, NULL, 0.00),
(9, 'My coupon', '&nbsp;Test', 'COUPON0005', 1, 'Active', '2023-04-29 22:13:58', '2023-04-29 22:16:14', NULL, 5, 255, '2023-05-29', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `type` enum('c','nc') DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `location`, `email`, `mobile`, `amount`, `password`, `type`, `status`, `created_at`, `updated_at`, `owner_id`) VALUES
(5, 'Rasado', 'Jaipur', 'rasado@gmail.com', '9887989987', 1500.00, '$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx/xCyofp6uDsD2dAsjUfVB1C', 'c', 'Active', '2023-04-29 05:59:40', '2023-05-16 00:25:45', 2),
(6, 'MRP', 'jaipur', 'mrp@gmail.com', '9887091831', NULL, '$2y$10$vilewPJWoR3OF9kJgjPPg.S74lzOxNn1DEZf0FhGWwUJpIhMaEw/m', 'nc', 'Active', '2023-05-14 00:06:59', '2023-05-14 00:06:59', 2);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_22_071602_create_permissions_table', 1),
(6, '2023_04_22_071615_create_roles_table', 1),
(7, '2023_04_22_071801_create_users_permissions_table', 1),
(8, '2023_04_22_071842_create_users_roles_table', 1),
(9, '2023_04_22_072052_create_roles_permissions_table', 1),
(10, '2023_04_29_032354_create_coupons_table', 2),
(11, '2023_05_02_150947_create_audits_table', 3),
(12, '2023_05_02_151429_create_audits_table', 4),
(13, '2023_05_03_094120_create_customers_table', 5),
(15, '2023_05_12_142534_create_cart_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `fixed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `status`, `updated_at`, `created_at`, `fixed`) VALUES
(1, 'Hotel Management', 'Active', NULL, NULL, 0),
(2, 'User Management', 'Active', NULL, NULL, 1),
(3, 'Coupon categories', 'Active', NULL, NULL, 0),
(4, 'Coupon Management ', 'Active', NULL, NULL, 0),
(5, 'Profile Management ', 'Active', NULL, NULL, 0),
(6, 'Customer Management ', 'Active', NULL, NULL, 0),
(7, 'Single Package ', 'Active', NULL, NULL, 0),
(8, 'Multiple Package ', 'Active', NULL, NULL, 0),
(9, 'Orders ', 'Active', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `coupon_id` bigint(20) NOT NULL,
  `hotel_id` bigint(20) NOT NULL,
  `coupon_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`coupon_data`)),
  `hotel_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`hotel_data`)),
  `valid_date` date NOT NULL,
  `coupon` varchar(200) NOT NULL,
  `visit_type` int(11) NOT NULL,
  `status` enum('Redeem','Pending') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `coupon_id`, `hotel_id`, `coupon_data`, `hotel_data`, `valid_date`, `coupon`, `visit_type`, `status`, `created_at`, `updated_at`) VALUES
(21, 10, 3, 5, '{\"id\":3,\"category_id\":15,\"title\":\"Yearly\",\"description\":\"test\",\"custom_coupon_id\":\"COUPON0003\",\"visit_type\":2,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:14.000000Z\",\"updated_at\":\"2023-05-13T22:10:14.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0003', 2, 'Pending', '2023-05-21 05:15:39', '2023-05-21 05:15:39'),
(22, 10, 4, 5, '{\"id\":4,\"category_id\":15,\"title\":\"Yearly 2\",\"description\":\"Yearly 2\",\"custom_coupon_id\":\"COUPON0004\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:13:47.000000Z\",\"updated_at\":\"2023-05-13T22:13:47.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0004', 1, 'Pending', '2023-05-21 05:15:39', '2023-05-21 05:15:39'),
(23, 10, 5, 5, '{\"id\":5,\"category_id\":15,\"title\":\"Yearly 3\",\"description\":\"Yearly 3\",\"custom_coupon_id\":\"COUPON0005\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:14:00.000000Z\",\"updated_at\":\"2023-05-13T22:14:00.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0005', 1, 'Pending', '2023-05-21 05:15:39', '2023-05-21 05:15:39'),
(24, 10, 1, 5, '{\"id\":1,\"category_id\":13,\"title\":\"WeeklyCoupon\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0001\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:09:37.000000Z\",\"updated_at\":\"2023-05-13T22:09:37.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0001', 1, 'Pending', '2023-05-21 05:15:39', '2023-05-21 05:15:39'),
(25, 11, 1, 5, '{\"id\":1,\"category_id\":13,\"title\":\"WeeklyCoupon\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0001\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:09:37.000000Z\",\"updated_at\":\"2023-05-13T22:09:37.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0001', 1, 'Pending', '2023-05-21 05:23:31', '2023-05-21 05:23:31'),
(26, 11, 2, 6, '{\"id\":2,\"category_id\":14,\"title\":\"Montly\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0002\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:01.000000Z\",\"updated_at\":\"2023-05-13T22:10:01.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":6,\"name\":\"MRP\",\"location\":\"jaipur\",\"email\":\"mrp@gmail.com\",\"mobile\":\"9887091831\",\"amount\":null,\"password\":\"$2y$10$vilewPJWoR3OF9kJgjPPg.S74lzOxNn1DEZf0FhGWwUJpIhMaEw\\/m\",\"type\":\"nc\",\"status\":\"Active\",\"created_at\":\"2023-05-14T00:06:59.000000Z\",\"updated_at\":\"2023-05-14T00:06:59.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0002', 1, 'Pending', '2023-05-21 05:23:31', '2023-05-21 05:23:31'),
(27, 11, 2, 5, '{\"id\":2,\"category_id\":14,\"title\":\"Montly\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0002\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:01.000000Z\",\"updated_at\":\"2023-05-13T22:10:01.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0002', 1, 'Pending', '2023-05-21 05:23:31', '2023-05-21 05:23:31'),
(28, 11, 4, 6, '{\"id\":4,\"category_id\":15,\"title\":\"Yearly 2\",\"description\":\"Yearly 2\",\"custom_coupon_id\":\"COUPON0004\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:13:47.000000Z\",\"updated_at\":\"2023-05-13T22:13:47.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":6,\"name\":\"MRP\",\"location\":\"jaipur\",\"email\":\"mrp@gmail.com\",\"mobile\":\"9887091831\",\"amount\":null,\"password\":\"$2y$10$vilewPJWoR3OF9kJgjPPg.S74lzOxNn1DEZf0FhGWwUJpIhMaEw\\/m\",\"type\":\"nc\",\"status\":\"Active\",\"created_at\":\"2023-05-14T00:06:59.000000Z\",\"updated_at\":\"2023-05-14T00:06:59.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0004', 1, 'Pending', '2023-05-21 05:23:31', '2023-05-21 05:23:31'),
(29, 11, 4, 5, '{\"id\":4,\"category_id\":15,\"title\":\"Yearly 2\",\"description\":\"Yearly 2\",\"custom_coupon_id\":\"COUPON0004\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:13:47.000000Z\",\"updated_at\":\"2023-05-13T22:13:47.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0004', 1, 'Pending', '2023-05-21 05:23:31', '2023-05-21 05:23:31'),
(30, 11, 3, 5, '{\"id\":3,\"category_id\":15,\"title\":\"Yearly\",\"description\":\"test\",\"custom_coupon_id\":\"COUPON0003\",\"visit_type\":2,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:14.000000Z\",\"updated_at\":\"2023-05-13T22:10:14.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0003', 2, 'Pending', '2023-05-21 05:23:31', '2023-05-21 05:23:31'),
(31, 12, 1, 5, '{\"id\":1,\"category_id\":13,\"title\":\"WeeklyCoupon\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0001\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:09:37.000000Z\",\"updated_at\":\"2023-05-13T22:09:37.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0001', 1, 'Pending', '2023-05-21 05:30:39', '2023-05-21 05:30:39'),
(32, 12, 2, 6, '{\"id\":2,\"category_id\":14,\"title\":\"Montly\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0002\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:01.000000Z\",\"updated_at\":\"2023-05-13T22:10:01.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":6,\"name\":\"MRP\",\"location\":\"jaipur\",\"email\":\"mrp@gmail.com\",\"mobile\":\"9887091831\",\"amount\":null,\"password\":\"$2y$10$vilewPJWoR3OF9kJgjPPg.S74lzOxNn1DEZf0FhGWwUJpIhMaEw\\/m\",\"type\":\"nc\",\"status\":\"Active\",\"created_at\":\"2023-05-14T00:06:59.000000Z\",\"updated_at\":\"2023-05-14T00:06:59.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0002', 1, 'Pending', '2023-05-21 05:30:39', '2023-05-21 05:30:39'),
(33, 12, 2, 5, '{\"id\":2,\"category_id\":14,\"title\":\"Montly\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0002\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:01.000000Z\",\"updated_at\":\"2023-05-13T22:10:01.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0002', 1, 'Pending', '2023-05-21 05:30:40', '2023-05-21 05:30:40'),
(34, 12, 4, 6, '{\"id\":4,\"category_id\":15,\"title\":\"Yearly 2\",\"description\":\"Yearly 2\",\"custom_coupon_id\":\"COUPON0004\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:13:47.000000Z\",\"updated_at\":\"2023-05-13T22:13:47.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":6,\"name\":\"MRP\",\"location\":\"jaipur\",\"email\":\"mrp@gmail.com\",\"mobile\":\"9887091831\",\"amount\":null,\"password\":\"$2y$10$vilewPJWoR3OF9kJgjPPg.S74lzOxNn1DEZf0FhGWwUJpIhMaEw\\/m\",\"type\":\"nc\",\"status\":\"Active\",\"created_at\":\"2023-05-14T00:06:59.000000Z\",\"updated_at\":\"2023-05-14T00:06:59.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0004', 1, 'Pending', '2023-05-21 05:30:40', '2023-05-21 05:30:40'),
(35, 12, 4, 5, '{\"id\":4,\"category_id\":15,\"title\":\"Yearly 2\",\"description\":\"Yearly 2\",\"custom_coupon_id\":\"COUPON0004\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:13:47.000000Z\",\"updated_at\":\"2023-05-13T22:13:47.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0004', 1, 'Pending', '2023-05-21 05:30:40', '2023-05-21 05:30:40'),
(36, 12, 3, 5, '{\"id\":3,\"category_id\":15,\"title\":\"Yearly\",\"description\":\"test\",\"custom_coupon_id\":\"COUPON0003\",\"visit_type\":2,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:14.000000Z\",\"updated_at\":\"2023-05-13T22:10:14.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0003', 2, 'Pending', '2023-05-21 05:30:40', '2023-05-21 05:30:40'),
(37, 13, 1, 5, '{\"id\":1,\"category_id\":13,\"title\":\"WeeklyCoupon\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0001\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:09:37.000000Z\",\"updated_at\":\"2023-05-13T22:09:37.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0001', 1, 'Pending', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(38, 13, 2, 6, '{\"id\":2,\"category_id\":14,\"title\":\"Montly\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0002\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:01.000000Z\",\"updated_at\":\"2023-05-13T22:10:01.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":6,\"name\":\"MRP\",\"location\":\"jaipur\",\"email\":\"mrp@gmail.com\",\"mobile\":\"9887091831\",\"amount\":null,\"password\":\"$2y$10$vilewPJWoR3OF9kJgjPPg.S74lzOxNn1DEZf0FhGWwUJpIhMaEw\\/m\",\"type\":\"nc\",\"status\":\"Active\",\"created_at\":\"2023-05-14T00:06:59.000000Z\",\"updated_at\":\"2023-05-14T00:06:59.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0002', 1, 'Pending', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(39, 13, 2, 5, '{\"id\":2,\"category_id\":14,\"title\":\"Montly\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0002\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:01.000000Z\",\"updated_at\":\"2023-05-13T22:10:01.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0002', 1, 'Pending', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(40, 13, 4, 6, '{\"id\":4,\"category_id\":15,\"title\":\"Yearly 2\",\"description\":\"Yearly 2\",\"custom_coupon_id\":\"COUPON0004\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:13:47.000000Z\",\"updated_at\":\"2023-05-13T22:13:47.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":6,\"name\":\"MRP\",\"location\":\"jaipur\",\"email\":\"mrp@gmail.com\",\"mobile\":\"9887091831\",\"amount\":null,\"password\":\"$2y$10$vilewPJWoR3OF9kJgjPPg.S74lzOxNn1DEZf0FhGWwUJpIhMaEw\\/m\",\"type\":\"nc\",\"status\":\"Active\",\"created_at\":\"2023-05-14T00:06:59.000000Z\",\"updated_at\":\"2023-05-14T00:06:59.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0004', 1, 'Pending', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(41, 13, 4, 5, '{\"id\":4,\"category_id\":15,\"title\":\"Yearly 2\",\"description\":\"Yearly 2\",\"custom_coupon_id\":\"COUPON0004\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:13:47.000000Z\",\"updated_at\":\"2023-05-13T22:13:47.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0004', 1, 'Pending', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(42, 13, 3, 5, '{\"id\":3,\"category_id\":15,\"title\":\"Yearly\",\"description\":\"test\",\"custom_coupon_id\":\"COUPON0003\",\"visit_type\":2,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:14.000000Z\",\"updated_at\":\"2023-05-13T22:10:14.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0003', 2, 'Pending', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(43, 13, 1, 5, '{\"id\":1,\"category_id\":13,\"title\":\"WeeklyCoupon\",\"description\":\"Description\",\"custom_coupon_id\":\"COUPON0001\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:09:37.000000Z\",\"updated_at\":\"2023-05-13T22:09:37.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0001', 1, 'Pending', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(44, 13, 3, 5, '{\"id\":3,\"category_id\":15,\"title\":\"Yearly\",\"description\":\"test\",\"custom_coupon_id\":\"COUPON0003\",\"visit_type\":2,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:10:14.000000Z\",\"updated_at\":\"2023-05-13T22:10:14.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0003', 2, 'Pending', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(45, 13, 4, 5, '{\"id\":4,\"category_id\":15,\"title\":\"Yearly 2\",\"description\":\"Yearly 2\",\"custom_coupon_id\":\"COUPON0004\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:13:47.000000Z\",\"updated_at\":\"2023-05-13T22:13:47.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0004', 1, 'Pending', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(46, 13, 5, 5, '{\"id\":5,\"category_id\":15,\"title\":\"Yearly 3\",\"description\":\"Yearly 3\",\"custom_coupon_id\":\"COUPON0005\",\"visit_type\":1,\"status\":\"Active\",\"created_at\":\"2023-05-13T22:14:00.000000Z\",\"updated_at\":\"2023-05-13T22:14:00.000000Z\",\"deleted_at\":null,\"owner_id\":2}', '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2028-05-21', 'COUPON0005', 1, 'Pending', '2023-05-21 05:32:06', '2023-05-21 05:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_package_details`
--

CREATE TABLE `order_package_details` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `package_id` bigint(20) NOT NULL,
  `package_log` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`package_log`)),
  `hotel_id` bigint(20) NOT NULL,
  `hotel_log` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`hotel_log`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_package_details`
--

INSERT INTO `order_package_details` (`id`, `order_id`, `package_id`, `package_log`, `hotel_id`, `hotel_log`, `created_at`, `updated_at`) VALUES
(12, 13, 20, '{\"id\":20,\"title\":\"Multiple\",\"limit\":23,\"term_conditions\":\"15\",\"amount\":15000,\"valid_date\":\"2023-05-23\",\"type\":\"multiple\",\"created_at\":\"2023-05-14T05:06:17.000000Z\",\"updated_at\":\"2023-05-21T05:30:40.000000Z\",\"description\":\"dfdsfsf\",\"owner_id\":2,\"status\":\"Active\",\"deleted_at\":null,\"package_item\":[{\"package_id\":20,\"category_id\":13,\"hotel_id\":5,\"coupon_id\":1},{\"package_id\":20,\"category_id\":14,\"hotel_id\":6,\"coupon_id\":2},{\"package_id\":20,\"category_id\":14,\"hotel_id\":5,\"coupon_id\":2},{\"package_id\":20,\"category_id\":15,\"hotel_id\":6,\"coupon_id\":4},{\"package_id\":20,\"category_id\":15,\"hotel_id\":5,\"coupon_id\":4},{\"package_id\":20,\"category_id\":15,\"hotel_id\":5,\"coupon_id\":3}]}', 5, '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(13, 13, 20, '{\"id\":20,\"title\":\"Multiple\",\"limit\":23,\"term_conditions\":\"15\",\"amount\":15000,\"valid_date\":\"2023-05-23\",\"type\":\"multiple\",\"created_at\":\"2023-05-14T05:06:17.000000Z\",\"updated_at\":\"2023-05-21T05:30:40.000000Z\",\"description\":\"dfdsfsf\",\"owner_id\":2,\"status\":\"Active\",\"deleted_at\":null,\"package_item\":[{\"package_id\":20,\"category_id\":13,\"hotel_id\":5,\"coupon_id\":1},{\"package_id\":20,\"category_id\":14,\"hotel_id\":6,\"coupon_id\":2},{\"package_id\":20,\"category_id\":14,\"hotel_id\":5,\"coupon_id\":2},{\"package_id\":20,\"category_id\":15,\"hotel_id\":6,\"coupon_id\":4},{\"package_id\":20,\"category_id\":15,\"hotel_id\":5,\"coupon_id\":4},{\"package_id\":20,\"category_id\":15,\"hotel_id\":5,\"coupon_id\":3}]}', 6, '{\"id\":6,\"name\":\"MRP\",\"location\":\"jaipur\",\"email\":\"mrp@gmail.com\",\"mobile\":\"9887091831\",\"amount\":null,\"password\":\"$2y$10$vilewPJWoR3OF9kJgjPPg.S74lzOxNn1DEZf0FhGWwUJpIhMaEw\\/m\",\"type\":\"nc\",\"status\":\"Active\",\"created_at\":\"2023-05-14T00:06:59.000000Z\",\"updated_at\":\"2023-05-14T00:06:59.000000Z\",\"owner_id\":2}', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(14, 13, 8, '{\"id\":8,\"title\":\"Weekly Package\",\"limit\":11,\"term_conditions\":\"test\",\"amount\":1000,\"valid_date\":\"2023-05-14\",\"type\":\"single\",\"created_at\":\"2023-05-13T22:12:34.000000Z\",\"updated_at\":\"2023-05-21T05:15:39.000000Z\",\"description\":\"test\",\"owner_id\":2,\"status\":\"Active\",\"deleted_at\":null,\"package_item\":[{\"package_id\":8,\"category_id\":13,\"hotel_id\":5,\"coupon_id\":1}]}', 5, '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(15, 13, 22, '{\"id\":22,\"title\":\"Sliver\",\"limit\":23,\"term_conditions\":\"test\",\"amount\":25,\"valid_date\":\"2023-05-16\",\"type\":\"single\",\"created_at\":\"2023-05-16T14:43:55.000000Z\",\"updated_at\":\"2023-05-21T05:15:39.000000Z\",\"description\":\"test\",\"owner_id\":2,\"status\":\"Active\",\"deleted_at\":null,\"package_item\":[{\"package_id\":22,\"category_id\":15,\"hotel_id\":5,\"coupon_id\":3},{\"package_id\":22,\"category_id\":15,\"hotel_id\":5,\"coupon_id\":4},{\"package_id\":22,\"category_id\":15,\"hotel_id\":5,\"coupon_id\":5}]}', 5, '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2023-05-21 05:32:06', '2023-05-21 05:32:06'),
(16, 13, 20, '{\"id\":20,\"title\":\"Multiple\",\"limit\":23,\"term_conditions\":\"15\",\"amount\":15000,\"valid_date\":\"2023-05-23\",\"type\":\"multiple\",\"created_at\":\"2023-05-14T05:06:17.000000Z\",\"updated_at\":\"2023-05-21T05:30:40.000000Z\",\"description\":\"dfdsfsf\",\"owner_id\":2,\"status\":\"Active\",\"deleted_at\":null,\"package_item\":[{\"package_id\":20,\"category_id\":13,\"hotel_id\":5,\"coupon_id\":1},{\"package_id\":20,\"category_id\":14,\"hotel_id\":6,\"coupon_id\":2},{\"package_id\":20,\"category_id\":14,\"hotel_id\":5,\"coupon_id\":2},{\"package_id\":20,\"category_id\":15,\"hotel_id\":6,\"coupon_id\":4},{\"package_id\":20,\"category_id\":15,\"hotel_id\":5,\"coupon_id\":4},{\"package_id\":20,\"category_id\":15,\"hotel_id\":5,\"coupon_id\":3}]}', 5, '{\"id\":5,\"name\":\"Rasado\",\"location\":\"Jaipur\",\"email\":\"rasado@gmail.com\",\"mobile\":\"9887989987\",\"amount\":1500,\"password\":\"$2y$10$AhyHryg3MSPtEfGVZh9TmuU.O.jtTx\\/xCyofp6uDsD2dAsjUfVB1C\",\"type\":\"c\",\"status\":\"Active\",\"created_at\":\"2023-04-29T05:59:40.000000Z\",\"updated_at\":\"2023-05-16T00:25:45.000000Z\",\"owner_id\":2}', '2023-05-21 05:32:06', '2023-05-21 05:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `limit` int(11) NOT NULL,
  `term_conditions` text NOT NULL,
  `amount` float(10,2) NOT NULL,
  `valid_date` date NOT NULL,
  `type` enum('single','multiple') NOT NULL DEFAULT 'single',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `limit`, `term_conditions`, `amount`, `valid_date`, `type`, `created_at`, `updated_at`, `description`, `owner_id`, `status`, `deleted_at`) VALUES
(1, 'test', 10, 'test', 100.00, '2023-05-13', '', '2023-05-13 05:52:52', '2023-05-13 08:11:33', 'ddtestg', 2, 'Active', '2023-05-13 08:11:33'),
(2, 'test', 10, 'test', 100.00, '2023-05-13', '', '2023-05-13 05:53:12', '2023-05-13 08:11:36', 'ddtestg', 2, 'Active', '2023-05-13 08:11:36'),
(3, 'test', 10, 'test', 100.00, '2023-05-13', '', '2023-05-13 05:54:15', '2023-05-13 22:10:23', 'ddtestg', 2, 'Active', '2023-05-13 22:10:23'),
(4, 'Another Package', 15, 'test', 100000.00, '2023-05-13', '', '2023-05-13 05:55:20', '2023-05-13 06:54:11', 'test', 2, 'Active', '2023-05-13 06:54:11'),
(5, 'test', 10, 'test', 10.00, '2023-05-13', '', '2023-05-13 08:07:41', '2023-05-13 22:10:26', 'dfsdfdsf', 2, 'Active', '2023-05-13 22:10:26'),
(6, 'testsdasdasd', 10, 'testddd', 11.00, '2023-05-13', '', '2023-05-13 08:08:51', '2023-05-13 22:10:29', 'dfsdfdsfdf', 2, 'Active', '2023-05-13 22:10:29'),
(7, 'testsdasdasd', 10, 'testddd', 11.00, '2023-05-13', '', '2023-05-13 10:09:20', '2023-05-13 22:10:32', 'dfsdfdsfdf', 2, 'Active', '2023-05-13 22:10:32'),
(8, 'Weekly Package', 10, 'test', 1000.00, '2023-05-14', 'single', '2023-05-13 22:12:34', '2023-05-21 05:32:06', 'test', 2, 'Active', NULL),
(9, 'Yearly 3', 1, 'test', 1000.00, '2023-05-14', '', '2023-05-13 22:14:30', '2023-05-13 22:14:30', 'test', 2, 'Active', NULL),
(10, 'test', 10, 'test', 1500.00, '2023-05-09', '', '2023-05-13 23:50:06', '2023-05-13 23:50:06', 'dfdsfsdf', 2, 'Active', NULL),
(11, 'test', 10, 'test', 1500.00, '2023-05-09', '', '2023-05-13 23:50:40', '2023-05-13 23:50:40', 'dfdsfsdf', 2, 'Active', NULL),
(12, 'test', 10, 'test', 1500.00, '2023-05-09', '', '2023-05-13 23:51:58', '2023-05-13 23:51:58', 'dfdsfsdf', 2, 'Active', NULL),
(13, 'test', 10, 'test', 1500.00, '2023-05-09', '', '2023-05-13 23:52:33', '2023-05-13 23:52:33', 'dfdsfsdf', 2, 'Active', NULL),
(14, 'test', 10, 'test', 1500.00, '2023-05-09', '', '2023-05-13 23:52:52', '2023-05-13 23:52:52', 'dfdsfsdf', 2, 'Active', NULL),
(15, 'test', 10, 'test', 1500.00, '2023-05-09', '', '2023-05-13 23:53:39', '2023-05-13 23:53:39', 'dfdsfsdf', 2, 'Active', NULL),
(16, 'test', 10, 'test', 100.00, '2023-05-18', 'multiple', '2023-05-13 23:57:09', '2023-05-14 01:40:09', 'dfdsf', 2, 'Active', '2023-05-14 01:40:09'),
(17, 'Multiple', 25, '15', 15000.00, '2023-05-23', 'multiple', '2023-05-14 00:08:35', '2023-05-14 00:08:35', 'dfdsfsf', 2, 'Active', NULL),
(18, 'test', 10, 'test', 1500.00, '2023-05-30', '', '2023-05-14 00:29:40', '2023-05-14 00:29:40', 'dfsdf', 2, 'Active', NULL),
(19, 'test', 10, 'rtdfdf', 1500.00, '2023-06-01', 'multiple', '2023-05-14 01:37:02', '2023-05-14 01:39:38', 'dfsas', 2, 'Active', NULL),
(20, 'Multiple', 22, '15', 15000.00, '2023-05-23', 'multiple', '2023-05-14 05:06:17', '2023-05-21 05:32:06', 'dfdsfsf', 2, 'Active', NULL),
(21, 'Multiple', 25, '15', 15000.00, '2023-05-23', 'multiple', '2023-05-14 05:09:10', '2023-05-14 05:31:02', 'dfdsfsf', 2, 'Active', NULL),
(22, 'Sliver', 22, 'test', 25.00, '2023-05-16', 'single', '2023-05-16 14:43:55', '2023-05-21 05:32:06', 'test', 2, 'Active', NULL),
(23, 'Gold', 25, 'test', 10.00, '2023-05-16', 'multiple', '2023-05-16 14:45:26', '2023-05-16 14:45:26', 'test', 2, 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_coupons`
--

CREATE TABLE `package_coupons` (
  `package_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_coupons`
--

INSERT INTO `package_coupons` (`package_id`, `category_id`, `hotel_id`, `coupon_id`) VALUES
(3, 0, 5, 1),
(3, 0, 5, 2),
(4, 0, 5, 1),
(4, 0, 5, 2),
(5, 0, 5, 2),
(6, 0, 5, 2),
(7, 0, 5, 1),
(7, 0, 5, 2),
(8, 13, 5, 1),
(9, 15, 5, 3),
(9, 15, 5, 4),
(9, 15, 5, 5),
(16, 13, 5, 1),
(16, 15, 5, 4),
(16, 14, 5, 2),
(17, 13, 5, 1),
(17, 14, 6, 2),
(17, 14, 5, 2),
(17, 15, 6, 4),
(18, 15, 5, 3),
(18, 15, 5, 4),
(18, 15, 5, 5),
(19, 13, 5, 1),
(19, 14, 5, 2),
(19, 15, 5, 3),
(19, 13, 6, 1),
(19, 14, 6, 2),
(19, 15, 6, 3),
(20, 13, 5, 1),
(20, 14, 6, 2),
(20, 14, 5, 2),
(20, 15, 6, 4),
(20, 15, 5, 4),
(20, 15, 5, 3),
(21, 13, 5, 1),
(21, 14, 6, 2),
(22, 15, 5, 3),
(22, 15, 5, 4),
(22, 15, 5, 5),
(23, 15, 5, 3),
(23, 13, 5, 1),
(23, 14, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Add Hotel', 'create-hotel', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(2, 1, 'Edit Hotel', 'edit-hotel', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(5, 1, 'Delete Hotel', 'delete-hotel', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(6, 1, 'Active/Inactive Hotel', 'ai-hotel', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(7, 1, 'View-hotel', 'view-hotel', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(8, 2, 'Add User', 'create-user', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(9, 2, 'Edit User', 'edit-user', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(10, 2, 'Delete User', 'delete-user', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(11, 2, 'Active/Inactive User', 'ai-user', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(12, 2, 'View User', 'view-user', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(14, 3, 'Add categories', 'add-categories', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(15, 3, 'Edit categories', 'edit-categories', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(16, 3, 'Delete categories', 'delete-categories', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(17, 3, 'Active/Inactive categories', 'ai-categories', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(18, 3, 'View categories', 'view-categories', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(19, 4, 'Add coupon', 'add-coupon', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(20, 4, 'Edit coupon', 'edit-coupon', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(21, 4, 'Delete coupon', 'delete-coupon', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(22, 4, 'Active/Inactive coupon', 'ai-coupon', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(23, 4, 'View coupon', 'view-coupons', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(24, 5, 'Edit Profile', 'edit-profile', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(25, 5, 'View Profile', 'view-profile', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(26, 6, 'Active/Inactive Customer', 'ai-customer', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(27, 6, 'View Customer', 'view-customer', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(28, 7, 'Add ', 'add-single-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(29, 7, 'Edit', 'edit-single-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(30, 7, 'Delete', 'delete-single-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(31, 7, 'Active/Inactive ', 'ai-single-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(32, 7, 'View', 'view-single-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(33, 7, 'Clone', 'clone-single-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(34, 8, 'Add ', 'add-multiple-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(35, 8, 'Edit', 'edit-multiple-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(36, 8, 'Delete', 'delete-multiple-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(37, 8, 'Active/Inactive ', 'ai-multiple-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(38, 8, 'View', 'view-multiple-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(39, 8, 'Clone', 'clone-multiple-package', '2023-04-22 02:22:37', '2023-04-22 02:22:37'),
(40, 9, 'View', 'view-orders', '2023-04-22 02:22:37', '2023-04-22 02:22:37');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `params` varchar(50) NOT NULL,
  `admin_can_see` int(11) NOT NULL,
  `sub_admin_can_see` int(11) NOT NULL,
  `maneger_can_see` int(11) NOT NULL,
  `agent_can_see` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`, `params`, `admin_can_see`, `sub_admin_can_see`, `maneger_can_see`, `agent_can_see`) VALUES
(1, 'Manager', 'manager', '2023-04-22 02:22:37', '2023-04-22 02:22:37', 'manager', 1, 1, 0, 0),
(5, 'Admin', 'subadmin', '2023-04-22 02:22:37', '2023-04-22 02:22:37', 'subadmin', 1, 0, 0, 0),
(6, 'Super  Admin', 'admin', '2023-04-22 02:22:37', '2023-04-22 02:22:37', 'administrator', 0, 0, 0, 0),
(7, 'Executive', 'agent', '2023-04-22 02:22:37', '2023-04-22 02:22:37', 'agent', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `type` enum('fixed','variable') NOT NULL DEFAULT 'variable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`, `type`) VALUES
(1, 1, 'variable'),
(1, 7, 'variable'),
(1, 8, 'variable'),
(1, 9, 'variable'),
(1, 10, 'variable'),
(1, 12, 'variable'),
(1, 14, 'variable'),
(1, 15, 'variable'),
(1, 16, 'variable'),
(1, 17, 'variable'),
(1, 18, 'variable'),
(1, 19, 'variable'),
(1, 20, 'variable'),
(1, 21, 'variable'),
(1, 22, 'variable'),
(1, 23, 'variable'),
(1, 24, 'variable'),
(1, 25, 'variable'),
(5, 7, 'variable'),
(5, 8, 'variable'),
(5, 9, 'variable'),
(5, 11, 'variable'),
(5, 12, 'variable'),
(5, 13, 'variable'),
(6, 1, 'variable'),
(6, 2, 'variable'),
(6, 5, 'variable'),
(6, 6, 'variable'),
(6, 7, 'variable'),
(6, 8, 'variable'),
(6, 9, 'variable'),
(6, 10, 'variable'),
(6, 11, 'variable'),
(6, 12, 'variable'),
(6, 15, 'variable'),
(6, 16, 'variable'),
(6, 17, 'variable'),
(6, 18, 'variable'),
(6, 19, 'variable'),
(6, 20, 'variable'),
(6, 21, 'variable'),
(6, 22, 'variable'),
(6, 23, 'variable'),
(6, 24, 'variable'),
(6, 25, 'variable'),
(6, 26, 'variable'),
(6, 27, 'variable'),
(6, 28, 'variable'),
(6, 29, 'variable'),
(6, 30, 'variable'),
(6, 31, 'variable'),
(6, 32, 'variable'),
(6, 33, 'variable'),
(6, 34, 'variable'),
(6, 35, 'variable'),
(6, 36, 'variable'),
(6, 37, 'variable'),
(6, 38, 'variable'),
(6, 39, 'variable'),
(6, 40, 'variable'),
(7, 24, 'variable'),
(7, 25, 'variable');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` bigint(20) NOT NULL,
  `order_id` varchar(200) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `trans_id` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_phone` varchar(200) NOT NULL,
  `type` enum('package','coupon') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `order_id`, `user_id`, `amount`, `trans_id`, `user_name`, `user_email`, `user_phone`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 'TPORD0001', 1, 16025.00, 'TNX121DFD', 'amit', 'aamdk@gmail.com', '9887989987', 'package', '2023-05-21 05:32:06', '2023-05-21 05:32:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `role` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `maneger_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `role`, `owner_id`, `maneger_id`) VALUES
(2, 'admin', 'admin@test.com', '9887989986', NULL, '$2y$10$aLQHGUtFfPy.aWsC0VnJsexa8YUgG0KQnptuHe2/jbClqdvO/9DJS', NULL, '2023-04-22 02:22:37', '2023-04-29 23:12:59', 'Active', 6, NULL, NULL),
(12, 'Nitya', 'manager@test.com', '9587456802', NULL, '$2y$10$VY8y857GKeaqhu9cSXVIX.Rh.iGodAkcX6V4xwf9S5PFBkTDSJyWe', NULL, '2023-04-25 21:01:46', '2023-04-25 21:01:46', 'Active', 1, NULL, NULL),
(13, 'Subadmin', 'subadmin@gmail.com', '9887989986', NULL, '$2y$10$pkoJn4U27EvR10tL/B4kqex6LuXhw3Eb7iOSFyeFiF6mE6RSVrtWO', NULL, '2023-04-25 21:23:55', '2023-04-25 21:23:55', 'Active', 5, NULL, NULL),
(14, 'Managertow', 'manager2@gmail.com', '9887989986', NULL, '$2y$10$bQPQVMZ2CvmynfFHrkDzQO8oiiGx7iwVjBo1Q9uodrGe.sykIMQf.', NULL, '2023-04-26 10:23:48', '2023-04-26 10:23:48', 'Active', 1, 13, NULL),
(15, 'Agent', 'agent@gmail.com', '9887989986', NULL, '$2y$10$Vn0BORNpBqlXtz/wYUqb1erbrl5B6LVf1YAp7HFkfbIDOjs1QqNqC', NULL, '2023-04-26 22:54:16', '2023-04-26 23:11:32', 'Active', 7, 13, 12),
(16, 'agent2', 'agentt@gmail.com', '9887091831', NULL, '$2y$10$myquPUdCjX2O3Kd82TT6tuJ2vH7gm2Ca06hmGOPPhLfhRmKlQwUp6', NULL, '2023-04-26 23:16:23', '2023-04-26 23:16:23', 'Active', 7, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`user_id`, `permission_id`) VALUES
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 6),
(9, 1),
(10, 5),
(11, 1),
(12, 1),
(13, 5),
(14, 1),
(15, 1),
(16, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  ADD KEY `audits_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `custom_coupon_id` (`custom_coupon_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hotelcoupons`
--
ALTER TABLE `hotelcoupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `custom_coupon_id` (`custom_coupon_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_package_details`
--
ALTER TABLE `order_package_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotelcoupons`
--
ALTER TABLE `hotelcoupons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_package_details`
--
ALTER TABLE `order_package_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
