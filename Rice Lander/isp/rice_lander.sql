-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 09:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `products_c`
--

CREATE TABLE `products_c` (
  `id` int(100) NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `Paddy_Type` varchar(100) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_c`
--

INSERT INTO `products_c` (`id`, `product_id`, `Paddy_Type`, `Quantity`, `Price`) VALUES
(7, 'bdy3y44', 'aaaaaaaaaaaa', 88, 89),
(9, 'wwww', 'qqq', 111, 222),
(10, 'hf8f', '4r4r4r', 77, 88),
(11, 'yhrgyr', 'frggg', 7, 75);

-- --------------------------------------------------------

--
-- Table structure for table `products_manager_details`
--

CREATE TABLE `products_manager_details` (
  `id` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_manager_details`
--

INSERT INTO `products_manager_details` (`id`, `email`, `password`) VALUES
(1, 'chamathka.b@rl.com', 'Chamathka123#');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products_c`
--
ALTER TABLE `products_c`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products_manager_details`
--
ALTER TABLE `products_manager_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
