-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 06:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rice_lander`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `order_date`) VALUES
(1, 11, 700.00, '2024-10-13 12:41:17'),
(2, 11, 550.00, '2024-10-13 14:36:59'),
(3, 12, 440.00, '2024-10-13 15:02:31'),
(4, 12, 2200.00, '2024-10-13 15:05:26'),
(5, 12, 1150.00, '2024-10-13 16:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `products_c`
--

CREATE TABLE `products_c` (
  `id` int(100) NOT NULL,
  `Paddy_Type` varchar(100) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Price` int(100) NOT NULL,
  `product_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_c`
--

INSERT INTO `products_c` (`id`, `Paddy_Type`, `Quantity`, `Price`, `product_id`) VALUES
(1, 'White Raw', 40, 55, '1'),
(2, 'Red Raw Samba', 10, 60, '2'),
(3, 'White Raw Samba', 1, 65, '3'),
(4, 'Nadu', 1, 50, '4'),
(5, 'Basmati', 1, 120, '5'),
(6, 'Suwandel', 1, 75, '6'),
(10, 'Pachchaperumal', 200, 190, '8'),
(11, 'Madathawalu', 200, 180, '7');

-- --------------------------------------------------------

--
-- Table structure for table `products_manager_details`
--

CREATE TABLE `products_manager_details` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_manager_details`
--

INSERT INTO `products_manager_details` (`id`, `email`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `order_id`, `user_id`, `product_id`, `quantity`, `total_price`, `purchase_date`) VALUES
(1, 1, 11, 9, 2, 700.00, '2024-10-13 12:41:17'),
(2, 2, 11, 1, 10, 550.00, '2024-10-13 14:36:59'),
(3, 3, 12, 1, 8, 440.00, '2024-10-13 15:02:31'),
(4, 4, 12, 1, 40, 2200.00, '2024-10-13 15:05:26'),
(5, 5, 12, 1, 10, 550.00, '2024-10-13 16:09:56'),
(6, 5, 12, 2, 10, 600.00, '2024-10-13 16:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `address`, `username`, `password`, `image`) VALUES
(7, 'dasuni', 'dasuni@gmail.com', '0715970899', 'No,43,colombo.', 'dasuni12', '202cb962ac59075b964b07152d234b70', 'Screenshot (242).png'),
(8, 'aa', 'a@gmail.com', '0715970855', 'wq', 'werwe', '0cc175b9c0f1b6a831c399e269772661', 'Screenshot (383).png'),
(9, 'anjana', 'anjana@gmail.com', '0712945799', 'No,25,Malabe.', 'Anjana00', '81dc9bdb52d04dc20036dbd8313ed055', 'Screenshot (242).png'),
(11, 'Navod', 'nawarathnanavod98@gmail.com', '0702298135', '243/3 Sri Dharamawansha Road,', 'navod', '62915ebb0dec8106f9091dac81dba8ca', ''),
(12, 'mohan', 'mohan@gmail.com', '0778507614', 'colombo', 'mohan sudda', '202cb962ac59075b964b07152d234b70', 'intro.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products_c`
--
ALTER TABLE `products_c`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_manager_details`
--
ALTER TABLE `products_manager_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products_c`
--
ALTER TABLE `products_c`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products_manager_details`
--
ALTER TABLE `products_manager_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
