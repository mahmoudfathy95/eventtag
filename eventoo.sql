-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2020 at 10:08 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evento`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `img`) VALUES
(1, 'aly', 'aly@yahoo.com', '123456', '');

-- --------------------------------------------------------

--
-- Table structure for table `booths`
--

CREATE TABLE `booths` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` double NOT NULL,
  `open` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booths`
--

INSERT INTO `booths` (`id`, `event_id`, `name`, `price`, `open`, `created_at`, `updated_at`) VALUES
(3, 2, 'ggg', 50, 0, '2020-03-14 14:34:36', '2020-03-14 13:34:36'),
(4, 2, 'kjjkjl', 60, 1, '2020-03-13 20:49:18', '2020-03-13 20:49:18'),
(5, 3, 'ggg', 50, 1, '2020-03-13 20:58:47', '2020-03-13 20:58:47'),
(6, 3, 'kjjkjl', 60, 1, '2020-03-13 20:58:48', '2020-03-13 20:58:48'),
(7, 4, 'ggg', 50, 1, '2020-03-13 21:09:17', '2020-03-13 21:09:17'),
(8, 4, 'kjjkjl', 60, 1, '2020-03-13 21:09:17', '2020-03-13 21:09:17'),
(9, 5, 'ggg', 50, 1, '2020-03-13 21:15:04', '2020-03-13 21:15:04'),
(10, 5, 'kjjkjl', 60, 1, '2020-03-13 21:15:04', '2020-03-13 21:15:04'),
(11, 6, 'ggg', 50, 1, '2020-03-13 21:18:33', '2020-03-13 21:18:33'),
(12, 6, 'kjjkjl', 60, 1, '2020-03-13 21:18:33', '2020-03-13 21:18:33'),
(13, 7, 'ggg', 50, 1, '2020-03-13 21:20:42', '2020-03-13 21:20:42'),
(14, 7, 'kjjkjl', 60, 1, '2020-03-13 21:20:42', '2020-03-13 21:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `img` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`, `created_at`, `updated_at`) VALUES
(1, 'saS', 'SAsaS', '2020-03-07 18:01:07', '0000-00-00 00:00:00'),
(2, 'SAs', 'sAS', '2020-03-07 18:01:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'ahmed', 'ahmed@yahoo.com', '01025685545', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `eventName` varchar(250) NOT NULL,
  `hallName` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `day_from` date NOT NULL,
  `day_to` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `lat` varchar(250) NOT NULL,
  `cover` varchar(250) NOT NULL,
  `lang` varchar(250) NOT NULL,
  `permission` varchar(250) NOT NULL,
  `map` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventName`, `hallName`, `city`, `day_from`, `day_to`, `time_from`, `time_to`, `lat`, `cover`, `lang`, `permission`, `map`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'jkhljk', 'jnkhjkhk', 'jkhkj', '2020-01-01', '2020-02-02', '02:01:00', '05:02:00', '324354313', 'uploads/0.071112001584136082.jpg', '212132131332', 'uploads/0.072112001584136082.jpg', 'uploads/0.072112001584136082.jpg', 4, '2020-03-16 19:12:28', '2020-03-13 20:48:02'),
(2, 'jkhljk', 'jnkhjkhk', 'jkhkj', '2020-01-01', '2020-02-02', '02:01:00', '05:02:00', '324354313', 'uploads/0.805055001584136157.jpg', '212132131332', 'uploads/0.810055001584136157.jpg', 'uploads/0.811055001584136157.jpg', 0, '2020-03-13 20:49:17', '2020-03-13 20:49:17'),
(3, 'jkhljk', 'jnkhjkhk', 'jkhkj', '2020-01-01', '2020-02-02', '02:01:00', '05:02:00', '324354313', 'uploads/0.345987001584136727.jpg', '212132131332', 'uploads/0.345987001584136727.jpg', 'uploads/0.346987001584136727.jpg', 0, '2020-03-13 20:58:47', '2020-03-13 20:58:47'),
(4, 'jkhljk', 'jnkhjkhk', 'jkhkj', '2020-01-01', '2020-02-02', '02:01:00', '05:02:00', '324354313', 'uploads/0.298165001584137357.jpg', '212132131332', 'uploads/0.299166001584137357.jpg', 'uploads/0.300166001584137357.jpg', 0, '2020-03-13 21:09:17', '2020-03-13 21:09:17'),
(5, 'jkhljk', 'jnkhjkhk', 'jkhkj', '2020-01-01', '2020-02-02', '02:01:00', '05:02:00', '324354313', 'uploads/0.934785001584137703.jpg', '212132131332', 'uploads/0.935785001584137703.jpg', 'uploads/0.935785001584137703.jpg', 0, '2020-03-13 21:15:03', '2020-03-13 21:15:03'),
(6, 'jkhljk', 'jnkhjkhk', 'jkhkj', '2020-01-01', '2020-02-02', '02:01:00', '05:02:00', '324354313', 'uploads/0.491664001584137913.jpg', '212132131332', 'uploads/0.492664001584137913.jpg', 'uploads/0.492664001584137913.jpg', 0, '2020-03-13 21:18:33', '2020-03-13 21:18:33'),
(7, 'jkhljk', 'jnkhjkhk', 'jkhkj', '2020-01-01', '2020-02-02', '02:01:00', '05:02:00', '324354313', 'uploads/0.059472001584138042.jpg', '212132131332', 'uploads/0.060472001584138042.jpg', 'uploads/0.061472001584138042.jpg', 4, '2020-03-13 21:20:42', '2020-03-13 21:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-03-14 14:27:25', '2020-03-14 14:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `noti_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `name`, `noti_id`, `created_at`, `updated_at`) VALUES
(1, 'sdaasdsa', 5, '2020-03-07 17:18:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orderbootths`
--

CREATE TABLE `orderbootths` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `booths_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `event_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2020-03-16 19:33:12', '2020-03-14 13:09:01'),
(2, 3, 4, '2020-03-16 19:21:10', '2020-03-14 13:09:16'),
(3, 2, 4, '2020-03-16 19:21:17', '2020-03-14 13:09:35'),
(4, 3, 4, '2020-03-16 19:21:20', '2020-03-14 13:10:36'),
(5, 2, 6, '2020-03-16 19:21:23', '2020-03-14 13:11:22'),
(6, 1, 6, '2020-03-16 19:33:21', '2020-03-14 13:11:42'),
(7, 4, 6, '2020-03-16 19:21:33', '2020-03-14 13:31:02'),
(8, 7, 7, '2020-03-16 19:33:17', '2020-03-14 13:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `details` text NOT NULL,
  `img` varchar(250) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `img`, `cat_id`, `created_at`, `updated_at`) VALUES
(1, 'dasd', 'dasd', 'dasd', 1, '2020-03-07 18:04:17', '0000-00-00 00:00:00'),
(2, 'dsad', 'dsad', 'dsad', 1, '2020-03-07 18:04:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `booths_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `order_id`, `booths_id`, `created_at`, `updated_at`) VALUES
(11, 3, 4, '2020-03-16 19:07:35', '2020-03-14 13:09:35'),
(12, 3, 5, '2020-03-16 19:07:41', '2020-03-14 13:09:35'),
(13, 4, 5, '2020-03-16 19:07:50', '2020-03-14 13:10:37'),
(14, 4, 8, '2020-03-16 19:08:21', '2020-03-14 13:10:37'),
(15, 5, 7, '2020-03-16 19:08:13', '2020-03-14 13:11:22'),
(16, 5, 4, '2020-03-16 19:07:53', '2020-03-14 13:11:22'),
(17, 6, 5, '2020-03-16 19:07:56', '2020-03-14 13:11:42'),
(18, 6, 5, '2020-03-16 19:07:59', '2020-03-14 13:11:42'),
(19, 7, 5, '2020-03-16 19:08:01', '2020-03-14 13:30:50'),
(20, 7, 5, '2020-03-16 19:08:03', '2020-03-14 13:30:51'),
(21, 7, 4, '2020-03-16 19:08:05', '2020-03-14 13:31:02'),
(22, 7, 4, '2020-03-16 19:08:07', '2020-03-14 13:31:02'),
(23, 8, 3, '2020-03-14 13:34:36', '2020-03-14 13:34:36'),
(24, 8, 6, '2020-03-16 19:08:10', '2020-03-14 13:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `resets`
--

CREATE TABLE `resets` (
  `id` int(11) NOT NULL,
  `code` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resets`
--

INSERT INTO `resets` (`id`, `code`, `user_id`, `created_at`, `updated_at`) VALUES
(0, '0929', 4, '2020-03-22 11:57:14', '2020-03-22 11:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `rproducts`
--

CREATE TABLE `rproducts` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rproducts`
--

INSERT INTO `rproducts` (`id`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 3, 0, '2020-03-14 13:09:35', '2020-03-14 13:09:35'),
(2, 3, 0, '2020-03-14 13:09:36', '2020-03-14 13:09:36'),
(3, 6, 1, '2020-03-14 13:11:43', '2020-03-14 13:11:43'),
(4, 6, 2, '2020-03-14 13:11:43', '2020-03-14 13:11:43'),
(5, 7, 1, '2020-03-14 13:30:51', '2020-03-14 13:30:51'),
(6, 7, 2, '2020-03-14 13:30:51', '2020-03-14 13:30:51'),
(7, 7, 1, '2020-03-14 13:31:03', '2020-03-14 13:31:03'),
(8, 7, 2, '2020-03-14 13:31:03', '2020-03-14 13:31:03'),
(9, 8, 1, '2020-03-14 13:34:37', '2020-03-14 13:34:37'),
(10, 8, 2, '2020-03-14 13:34:37', '2020-03-14 13:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `brand` varchar(250) DEFAULT NULL,
  `company` varchar(250) DEFAULT NULL,
  `expedition` varchar(250) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `lat` varchar(250) DEFAULT NULL,
  `lang` varchar(250) DEFAULT NULL,
  `front` varchar(250) NOT NULL,
  `back` varchar(250) NOT NULL,
  `cr` varchar(250) NOT NULL,
  `token` varchar(300) DEFAULT NULL,
  `code` varchar(250) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `type`, `brand`, `company`, `expedition`, `logo`, `lat`, `lang`, `front`, `back`, `cr`, `token`, `code`, `active`, `created_at`, `updated_at`) VALUES
(4, 'aly meshal', 'aly@yahoo.com', '01254784589', '123456789', '1', 'kljklj', NULL, NULL, NULL, NULL, NULL, 'uploads/0.87199200 1583177364.jpg', 'uploads/0.87199200 1583177364.jpg', 'uploads/0.87199200 1583177364.jpg', 'w4TOGqdQKOSU/8QJX/Fl3Klgg10arY57oN1PKq2Q5DA=', '', 0, '2020-03-22 13:20:21', '2020-03-22 12:20:21'),
(5, 'alymeshal', 'all@ylahh.com', '015466484465', '123', 'ewqewq', 'ewqewqe', NULL, NULL, NULL, NULL, NULL, '', 'uploads/0.93215900 1583344812.jpg', 'uploads/0.93215900 1583344812.jpg', NULL, '', 0, '2020-03-04 17:00:13', '2020-03-04 17:00:13'),
(6, 'alyyyy', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', 0, '2020-03-04 17:25:13', '2020-03-04 17:25:13'),
(7, 'alymeshal', 'alsf@ylahh.com', '0154664845465', '123', 'ewqewq', 'ewqewqe', NULL, NULL, NULL, NULL, NULL, '', 'uploads/0.72664100 1583346538.jpg', 'uploads/0.72764100 1583346538.jpg', NULL, '', 0, '2020-03-04 17:28:58', '2020-03-04 17:28:58'),
(8, 'alymeshal', 'alsf@yloahh.com', '01546648454565', '123', 'ewqewq', 'ewqewqe', NULL, NULL, NULL, NULL, NULL, 'uploads/0.58907400 1583346568.jpg', 'uploads/0.58907400 1583346568.jpg', 'uploads/0.59007400 1583346568.jpg', NULL, '', 0, '2020-03-04 17:29:28', '2020-03-04 17:29:28'),
(9, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, 0, '2020-03-08 18:20:39', '2020-03-08 18:20:39'),
(10, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, 0, '2020-03-08 18:21:33', '2020-03-08 18:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `walks`
--

CREATE TABLE `walks` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `details` text NOT NULL,
  `img` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `walks`
--

INSERT INTO `walks` (`id`, `title`, `details`, `img`, `created_at`, `updated_at`) VALUES
(2, 'jkljklj;lk', 'koijkljklj', 'hyugjihiu', '2020-03-04 18:24:19', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booths`
--
ALTER TABLE `booths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderbootths`
--
ALTER TABLE `orderbootths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rproducts`
--
ALTER TABLE `rproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `walks`
--
ALTER TABLE `walks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `booths`
--
ALTER TABLE `booths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orderbootths`
--
ALTER TABLE `orderbootths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `rproducts`
--
ALTER TABLE `rproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `walks`
--
ALTER TABLE `walks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
