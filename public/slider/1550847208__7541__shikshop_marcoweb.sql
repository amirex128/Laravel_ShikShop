-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 18, 2019 at 07:14 PM
-- Server version: 10.0.37-MariaDB
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shikshop_marcoweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `last_visits`
--

CREATE TABLE `last_visits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_06_114701_create_designs_table', 1),
(4, '2018_12_06_145847_create_sizes_table', 1),
(5, '2018_12_07_023658_create_brands_table', 1),
(6, '2018_12_07_163713_create_categories_table', 1),
(7, '2018_12_07_165210_create_colors_table', 1),
(8, '2018_12_07_165443_create_options_table', 1),
(9, '2018_12_07_165606_create_orders_table', 1),
(10, '2018_12_07_190242_create_products_table', 1),
(11, '2018_12_08_023054_create_articles_table', 1),
(12, '2018_12_08_190341_create_order_items_table', 1),
(13, '2018_12_30_150930_create_last_visits_table', 1),
(14, '2018_12_30_151308_create_favorites_table', 1),
(15, '2018_12_30_152525_create_tickets_table', 1),
(16, '2018_12_30_154811_create_question_and_answers_table', 1),
(17, '2018_12_31_115036_create_category_product_table', 1),
(18, '2018_12_31_120421_create_specifications_table', 1),
(19, '2018_12_31_120952_create_slides_table', 1),
(20, '2018_12_31_121347_create_slidables_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'slider', '[{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06f1\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06f1\",\"link\":\"http:\\/\\/hicostore\\/link1\",\"button\":\"\\u062e\\u0631\\u06cc\\u062f \\u06a9\\u0646\\u06cc\\u062f\",\"photo\":\"f9f28eaa.jpg\"},{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 2 \\u0627\\u0635\\u0644\\u0627\\u062d \\u0634\\u062f\\u0647\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"link\":\"http:\\/\\/hicostore\\/link2\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 2\",\"photo\":\"e8dd6566.jpg\"},{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"link\":\"http:\\/\\/hicostore\\/link3\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 3\",\"photo\":\"312a4973.jpg\"}]', NULL, NULL),
(2, 'posters', '[{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 1\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 1\",\"link\":\"http:\\/\\/hicostore\\/link1\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 1\",\"photo\":\"3c52cb59.jpeg\"},{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 2\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"link\":\"http:\\/\\/hicostore\\/link2\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"photo\":\"11d55624.jpg\"},{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 3\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"link\":\"http:\\/\\/hicostore\\/link3\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"photo\":\"27968418.jpg\"},{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 1\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 1\",\"link\":\"http:\\/\\/hicostore\\/link1\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 1\",\"photo\":\"3c52cb59.jpeg\"},{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 2\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"link\":\"http:\\/\\/hicostore\\/link2\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"photo\":\"11d55624.jpg\"},{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 3\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"link\":\"http:\\/\\/hicostore\\/link3\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"photo\":\"27968418.jpg\"}]', NULL, NULL),
(3, 'site_name', 'HiCO Store', NULL, NULL),
(4, 'site_description', 'این یک توضیح خیلی کوتاه و تصادفی درباره فروشگاه و کسب و کار کوچک هایکو استور میباشد که توسط مدیر قابل تعویض است', NULL, NULL),
(5, 'site_logo', 'b0fae1e6.png', NULL, NULL),
(6, 'watermark', 'b0fae1e6.png', NULL, NULL),
(7, 'shop_phone', '09123456789', NULL, NULL),
(8, 'shop_address', 'خراسان رضوی ، مشهد ، بین دستغیب 15 و 17 ، پلاک 231 ، واحد 1', NULL, NULL),
(9, 'social_link', '{\"instagram\":\"https:\\/\\/instagram.com\\/\",\"telegram\":\"https:\\/\\/telegram.com\\/\",\"facebook\":\"https:\\/\\/facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\"}', NULL, NULL),
(10, 'dollar_cost', '14500', NULL, NULL),
(11, 'shipping_cost', '{\"model1\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06cc\\u06a9\",\"cost\":\"5000\"},\"model2\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u062f\\u0648\",\"cost\":\"14000\"},\"model3\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0633\\u0647\",\"cost\":\"8000\"},\"model4\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0686\\u0647\\u0627\\u0631\",\"cost\":\"5000\"}}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer` int(11) NOT NULL DEFAULT '0',
  `shipping_cost` int(11) NOT NULL DEFAULT '0',
  `total` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `auth_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_code` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetimes` mediumtext COLLATE utf8mb4_unicode_ci,
  `payment` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `count` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `offer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `color_id` int(10) UNSIGNED DEFAULT NULL,
  `size_id` int(10) UNSIGNED DEFAULT NULL,
  `design_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` int(11) NOT NULL,
  `offer` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `special` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `views_count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_and_answers`
--

CREATE TABLE `question_and_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slidables`
--

CREATE TABLE `slidables` (
  `id` int(10) UNSIGNED NOT NULL,
  `slide_id` int(10) UNSIGNED DEFAULT NULL,
  `slidable_id` int(10) UNSIGNED NOT NULL,
  `slidable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specifications`
--

CREATE TABLE `specifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mac_address` varchar(17) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `email_verified_at`, `password`, `mac_address`, `remember_token`, `type`, `created_at`, `updated_at`) VALUES
('3g6s316j', 'امیر', 'خدنگی', '09105009868', 'AmirKhadangi920@Gmail.com', NULL, '$2y$10$61EgTAD0UaHATG5dJ8S56OeL.bUwrfqC.8z.Rd/zTfwiPdhc9VJrq', NULL, 'yHDko8AhMX4Z7pl1RhG4WUNxzdRmFWqwYwSJ6JBUb9jSM2Ui9stgvQ1hVOgG', 1, '2019-02-17 15:11:18', '2019-02-17 15:11:18'),
('664529fc', 'سجاد', 'مقدم', '۰۹۱۵۰۱۴۸۲۲۴', 'test@gmail.com', NULL, '$2y$10$jMBgunqytnJe6qLY4VAX3.yNR67IYWcWz4UeG6ZgSSodODdOI/.Gq', NULL, NULL, 0, '2019-02-18 08:28:07', '2019-02-18 08:28:07'),
('735f45c1', 'امیر', 'جعفری', '09309808148', 'amirjafar@gmail.com', NULL, '$2y$10$/BD84L2DQnOr9XhY98vR6.s.Aq9We3HrT7vzYYDD.3jQG65GcOUqi', NULL, NULL, 0, '2019-02-18 14:09:51', '2019-02-18 14:09:51'),
('d8cc4aef', 'امیر', 'شیردل', '09153148520', 'amirshirdel@txt.txt', NULL, '$2y$10$9iag2ZZL0tOkcNR6nsNdwu87f9RMwys4NTzBI/1kslbsu5QZWgz5u', NULL, NULL, 0, '2019-02-18 13:53:47', '2019-02-18 13:53:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_foreign` (`parent`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_product_category_id_foreign` (`category_id`),
  ADD KEY `category_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_user_id_foreign` (`user_id`),
  ADD KEY `favorites_product_id_foreign` (`product_id`);

--
-- Indexes for table `last_visits`
--
ALTER TABLE `last_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `last_visits_user_id_foreign` (`user_id`),
  ADD KEY `last_visits_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_buyer_foreign` (`buyer`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_color_id_foreign` (`color_id`),
  ADD KEY `products_size_id_foreign` (`size_id`),
  ADD KEY `products_design_id_foreign` (`design_id`);

--
-- Indexes for table `question_and_answers`
--
ALTER TABLE `question_and_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sizes_group_foreign` (`group`);

--
-- Indexes for table `slidables`
--
ALTER TABLE `slidables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slidables_slide_id_foreign` (`slide_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specifications_product_id_foreign` (`product_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `last_visits`
--
ALTER TABLE `last_visits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_and_answers`
--
ALTER TABLE `question_and_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slidables`
--
ALTER TABLE `slidables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specifications`
--
ALTER TABLE `specifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `last_visits`
--
ALTER TABLE `last_visits`
  ADD CONSTRAINT `last_visits_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `last_visits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_buyer_foreign` FOREIGN KEY (`buyer`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_design_id_foreign` FOREIGN KEY (`design_id`) REFERENCES `designs` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `sizes_group_foreign` FOREIGN KEY (`group`) REFERENCES `sizes` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `slidables`
--
ALTER TABLE `slidables`
  ADD CONSTRAINT `slidables_slide_id_foreign` FOREIGN KEY (`slide_id`) REFERENCES `slides` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specifications`
--
ALTER TABLE `specifications`
  ADD CONSTRAINT `specifications_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
