-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 يوليو 2026 الساعة 13:20
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `created_at`) VALUES
(1, 'food', 'All the food', '2026-07-07 18:11:34'),
(2, 'Book', '', '2026-07-07 18:11:34'),
(3, 'drinks', 'All types of beverages and water.', '2026-07-07 18:14:08'),
(4, 'Sports', 'Sportswear and sports equipment', '2026-07-07 18:14:08'),
(5, 'Home', '', '2026-07-07 18:15:01'),
(6, 'Electronics', 'Electronic devices', '2026-07-09 18:16:42'),
(8, 'Electronics', 'Laptop', '2026-07-12 10:20:20');

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `order_date`, `created_at`) VALUES
(1, 1, 0.00, '', '2026-07-13 21:00:00', '2026-07-10 15:56:40'),
(2, 1, 1000.00, '', '2026-07-09 21:00:00', '2026-07-10 16:36:37'),
(3, 2, 8100000.00, 'cancelled', '2026-06-30 21:00:00', '2026-07-10 18:54:33'),
(4, 1, 0.00, 'completed', '2026-06-30 21:00:00', '2026-07-10 19:27:17'),
(125, 1, 160.00, 'pending', '2026-07-02 21:00:00', '2026-07-12 09:32:29'),
(126, 3, 400.00, 'pending', '2026-06-30 21:00:00', '2026-07-12 10:38:59');

-- --------------------------------------------------------

--
-- بنية الجدول `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 2, 9, 2, 500.00),
(2, 3, 15, 9000, 900.00),
(3, 126, 11, 2, 100.00),
(4, 126, 11, 2, 100.00),
(5, 125, 12, 8, 20.00);

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `description`, `price`, `quantity`, `image`, `created_at`) VALUES
(9, 5, 'Mirror', 'Salon mirror', 500.00, 100, '', '2026-07-09 16:56:49'),
(11, 2, 'Italian cooking', 'Italian cookbook', 100.00, 50, '', '2026-07-09 16:59:31'),
(12, 1, 'vegetables', 'vegetables', 20.00, 2, '', '2026-07-09 19:55:06'),
(15, 5, 'Living room sofa', 'Living room sofa', 900.00, 159, '1783629288_صالون.jpg', '2026-07-09 20:34:48'),
(16, 6, 'Laptop', 'Office laptop', 700.00, 20, '1783852267_Office laptop1.webp', '2026-07-12 10:31:07');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `image`, `created_at`, `status`) VALUES
(1, 'Marah', 'marah@marah.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '', '2026-07-09 15:48:57', 'active'),
(2, 'Ahmed', 'ahmed@ahmedcom', 'e10adc3949ba59abbe56e057f20f883e', 'user', '', '2026-07-10 17:51:38', 'active'),
(3, 'rawan', 'rawan@rawan', '202cb962ac59075b964b07152d234b70', 'user', '', '2026-07-12 09:48:11', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_users` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `fk_details_orders` (`order_id`),
  ADD KEY `fk_details_products` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_categories` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- قيود الجداول `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_details_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_details_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- قيود الجداول `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
