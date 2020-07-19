-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2020 at 04:26 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_cost`
--

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `cost` float(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`id`, `user_id`, `name`, `cost`, `created_at`) VALUES
(60, 4, 'egg', 1000.00, '2020-06-28 17:44:46'),
(61, 5, 'chicken', 1000.00, '2020-06-28 17:46:21'),
(62, 5, 'vegetable', 400.00, '2020-06-28 17:55:49'),
(63, 4, 'vegetable', 400.00, '2020-06-28 18:01:57'),
(64, 4, 'fried chicken', 2000.00, '2020-06-28 18:02:07'),
(65, 4, 'grill fish', 2000.00, '2020-06-28 18:02:16'),
(66, 4, 'orange', 2000.00, '2020-06-28 18:02:32'),
(67, 9, 'egg', 2000.00, '2020-06-28 18:04:11'),
(68, 4, 'egg', 500.00, '2020-06-29 23:28:13'),
(69, 4, 'Breakfast', 1500.00, '2020-06-29 23:45:04'),
(70, 4, 'Morning cake', 1000.00, '2020-06-30 00:05:15'),
(71, 4, 'orange', 200.00, '2020-06-30 00:18:18'),
(74, 10, 'food', 3000.00, '2020-06-30 01:33:44'),
(75, 4, 'chicken', 200.00, '2020-06-30 01:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `photo`, `bio`, `created_at`) VALUES
(2, 'Myat Ko Ko', 'myatkoko.programmer@gmail.com', '$2y$10$.gPCNBWzB8lhXkiifvK6U.lZSPpAiZrswUlaRi2NbkiBPQVVS79na', NULL, NULL, '2020-06-27 09:35:22'),
(3, 'Myat Ko Ko', 'myatkoko.programmer@gmail.com', '$2y$10$ntcxzthKRimKDUWQ2GTiP.v2MiP.paf3eETsDiTOFVhAU8cSnLHkm', NULL, NULL, '2020-06-27 09:35:52'),
(4, 'Myat Ko', 'hey.myatkoko@gmail.com', '$2y$10$NGcYSUSDQ4B/5ZhtlAvliemkRyceY3oBAvhldLvqSqjNyk8eVk4..', '1593481610-275778-51IHi0iEVHL._SX342_-1.jpg', 'I am a programmer , I have no life', '2020-06-27 12:35:40'),
(5, 'Pulisic', 'pulisic@gmail.com', '$2y$10$.sZaQyPloFJt8XxraZKzVuaNs4dreoO5kHO8R5xwLsJhH7SJgZ9Zy', '1593360196-645962-woman-wearing-sunhat-1382731.jpg', 'Chelsea player', '2020-06-27 12:53:19'),
(6, 'Myat ', 'hello.myatkoko@gmail.com', '$2y$10$xLwWYnCbKBfZjkNOXhfHDeC8NwWXVnJDFZIKqpZIHYOLI.ttStbS2', NULL, NULL, '2020-06-27 12:53:59'),
(7, 'Myat Ko Ko', 'willian@gmail.com', '$2y$10$m.43INa6VNRZFTizuxj/TeJpr1n7AN369kPyDUpJ1wRON/SkCThSG', '1593358714-596122-IMG_20200622_184314.jpg', '', '2020-06-28 00:29:05'),
(8, 'MKK', 'lwinphyo@gmail.com', '$2y$10$3kpIVn0iMHvkLTzSDSuv6.qEIr8ZA3ZjCc8ioWIiRSEUplGeTdiVS', NULL, NULL, '2020-06-28 08:25:47'),
(9, 'Myat Mon Soe Myint', 'myatmon@gmail.com', '$2y$10$OSbEv1T8pNTQzzPG0LbgKOa3aW6AhhmEzbm07DXN/sY0VITf7V3lO', '1593367790-971316-FB_IMG_1530116618219.jpg', 'I love travelling\r\n', '2020-06-28 18:03:27'),
(10, 'Hazard', 'hazard@gmail.com', '$2y$10$PJlnXEnIMpYL98qT.N7zdu/bHGnjwX8cgZFIXgPFUEferZuNMiEZy', '1593480801-299817-1xDD9DE-nasa-logo-wallpaper.jpg', '', '2020-06-30 01:31:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
