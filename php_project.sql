-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 09:45 AM
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
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(4, 'admin', 'admin@email.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `boths`
--

CREATE TABLE `boths` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boths`
--

INSERT INTO `boths` (`id`, `product_name`, `product_image`) VALUES
(25, 'dodo', 'dodopdf'),
(26, 'mock timetable 2024', 'mock timetable 2024pdf');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(100) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_name`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(53, 'gbhs tiko', 'Verified', 1, '237', 'tiko', 'tiko', '2024-06-27 14:36:48'),
(54, 'gbhs tiko', 'Not Paid', 18, '682731181', 'tiko', 'chobes,tiko', '2024-06-28 00:00:50'),
(55, 'gbhs tiko', 'Verified', 18, '682731181', 'tiko', 'chobes,tiko', '2024-06-28 00:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `subject`, `quantity`, `user_id`, `order_date`) VALUES
(73, 53, '', '0570 Maths', 1, 1, '2024-06-27 14:36:48'),
(74, 53, '', '0530 English', 1, 1, '2024-06-27 14:36:48'),
(75, 53, '', '0550 Geography', 1, 1, '2024-06-27 14:36:48'),
(76, 53, '', '0525 Economics', 1, 1, '2024-06-27 14:36:48'),
(77, 53, '', '0505 Accounting', 1, 1, '2024-06-27 14:36:48'),
(78, 53, '', '0580 Physics', 0, 1, '2024-06-27 14:36:48'),
(79, 53, '', '0575 Additional Maths', 0, 1, '2024-06-27 14:36:48'),
(80, 53, '', '0565 Human Biology', 0, 1, '2024-06-27 14:36:48'),
(81, 54, '', '0780 Physics', 5, 18, '2024-06-28 00:00:50'),
(82, 54, '', '0770 Maths Mechanics', 3, 18, '2024-06-28 00:00:50'),
(83, 54, '', '0710 Biology', 5, 18, '2024-06-28 00:00:50'),
(84, 54, '', '0725 Economics', 5, 18, '2024-06-28 00:00:50'),
(85, 54, '', '0795 Computer Science', 10, 18, '2024-06-28 00:00:50'),
(86, 54, '', '0715 Chemistry', 10, 18, '2024-06-28 00:00:50'),
(87, 54, '', '0760 History', 10, 18, '2024-06-28 00:00:50'),
(88, 54, '', '0735 Literature', 10, 18, '2024-06-28 00:00:50'),
(89, 55, '', 'Business Management', 2, 18, '2024-06-28 00:09:39'),
(90, 55, '', 'Commerce and Finance', 2, 18, '2024-06-28 00:09:39'),
(91, 55, '', 'Entrepreneurship', 2, 18, '2024-06-28 00:09:39'),
(92, 55, '', 'Applied Mechanics', 2, 18, '2024-06-28 00:09:39'),
(93, 55, '', 'Professional English', 2, 18, '2024-06-28 00:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `payment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_price`, `product_special_offer`, `product_color`) VALUES
(2, '0780 physics', 'GCE', 'A/L general', 255.00, 0, 'colored'),
(4, '0770 Maths Mechanics', 'GCE', 'A/L general', 455.00, 0, 'colored'),
(5, '0710 Biology', 'GCE', 'A/L general', 355.00, 0, 'white'),
(7, 'Business management', 'tvee', 'TVEE/A', 455.00, 0, 'white'),
(8, '0725 Economics', 'GCE', 'A/L general', 355.00, 0, 'colored'),
(9, '0795 Computer Science', 'GCE', 'A/L general', 900.00, 0, 'white'),
(12, '0715 chemistry', 'GCE', 'A/L general', 900.00, 0, 'colored'),
(13, '0760 History', 'GCE', 'A/L general', 34.00, 0, 'colored'),
(14, '0735 Literature', 'GCE', 'A/l general', 50.00, 0, 'colored'),
(15, '0570 Maths', 'GCE', 'O/L general', 50.00, 0, 'colored'),
(16, '0530 English', 'GCE', 'O/L general', 50.00, 0, 'colored'),
(17, '0550 Geography', 'GCE', 'O/L general', 50.00, 0, 'colored'),
(18, '0525 Economics', 'GCE', 'O/L general', 50.00, 0, 'colored'),
(19, '0505 Accounting', 'GCE', 'O/L general', 50.00, 0, 'colored'),
(20, '0580 Physics', 'GCE', 'O/L general', 50.00, 0, 'colored'),
(21, '0555 Geology', 'GCE', 'O/L general', 50.00, 0, 'colored'),
(22, '0575 Additional Maths', 'GCE', 'O/L general', 50.00, 0, 'colored'),
(23, '0565 Human Biology', 'GCE', 'O/L general', 50.00, 0, 'colored'),
(24, 'commerce and finance', 'tvee', 'TVEE/A', 100.00, 0, 'colored'),
(26, 'Entrepreneurship', 'tvee', 'TVEE/A', 100.00, 0, 'colored'),
(27, 'Applied mechanics', 'tvee', 'TVEE/A', 200.00, 0, 'colored'),
(28, 'Professional English', 'TVEE', 'tvee/A', 355.00, 0, 'colored'),
(29, '811 pysics', 'TVEE', 'A/L', 355.00, 0, 'colored');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `data` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `name`, `type`, `size`, `data`) VALUES
(1, 'about-us.jpg', 'image/jpeg', 51690, ''),
(2, 'about-us.jpg', 'image/jpeg', 51690, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_region` varchar(250) NOT NULL,
  `user_division` varchar(250) NOT NULL,
  `user_subdivision` varchar(250) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_region`, `user_division`, `user_subdivision`, `user_email`, `user_password`) VALUES
(18, 'gbhs tiko', 'south west', 'fako', 'tiko', 'gb@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `boths`
--
ALTER TABLE `boths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `boths`
--
ALTER TABLE `boths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
