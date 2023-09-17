-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2023 at 12:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password_new` varchar(100) NOT NULL DEFAULT 'Change',
  `reset_token` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `name`, `password_new`, `reset_token`, `role`) VALUES
(8, 'owais', 'owaisorakzai77@gmail.com', '$2y$10$bcYvJmi4x2JtTPZn9Zkh6Oq55f.oXl6t5DZyNv5B.JTa98zK.T2bK', 'Owais Orakzai', 'done', '', 'admin'),
(9, 'aslam', 'aslam@gmail.com', '$2y$10$pNxC4FpXnDR/YkBMNcfsFuBRfPW3s.WV1PU.cSP.QfxIXZulodcBG', 'aslam', 'done', '', 'owner'),
(11, 'aa', 'o@gmail.com', '$2y$10$bcYvJmi4x2JtTPZn9Zkh6Oq55f.oXl6t5DZyNv5B.JTa98zK.T2bK', 'Owais Orakzai', 'Change', '', 'admin'),
(12, 'dddd', 'asdas@gmail.com', '$2y$10$bcYvJmi4x2JtTPZn9Zkh6Oq55f.oXl6t5DZyNv5B.JTa98zK.T2bK', 'Owais Orakzai', 'Change', '', 'admin'),
(13, 'as', 'asda@gmail.com', '$2y$10$bcYvJmi4x2JtTPZn9Zkh6Oq55f.oXl6t5DZyNv5B.JTa98zK.T2bK', 'aslam', 'Change', '', 'admin'),
(14, 'asdcc', 'daaa@gmai.com', '$2y$10$bcYvJmi4x2JtTPZn9Zkh6Oq55f.oXl6t5DZyNv5B.JTa98zK.T2bK', 'dadas@gmail.com', 'Change', '', 'admin'),
(15, 'addddddd', 'dasdas@gmail.com', '$2y$10$8Bxwg2kaopS9rBczzLDKVOpz07024ucF42jObUovqwB8TNY/Lt6ie', 'Owais Orakzai', 'done', '', 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `submission` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cards` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `submission`, `status`, `cards`, `address`) VALUES
(635, '11011843', 'SHIPPED', 22, 'Hello'),
(636, '11609638', 'GRADING', 10, 'Abcderrf'),
(637, '11607174', 'ARRIVED', 56, 'Owais'),
(638, '10974508', 'SHIPPED', 90, 'Upwork'),
(639, '11561550', 'GRADING', 221, 'JK');

-- --------------------------------------------------------

--
-- Table structure for table `orders_psa`
--

CREATE TABLE `orders_psa` (
  `order_id` int(11) NOT NULL,
  `card_selection` varchar(255) NOT NULL,
  `card_quantity` int(11) NOT NULL,
  `pickup_dropoff` varchar(255) NOT NULL,
  `insurance` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `dv` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `cardYear` varchar(4) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `cardNumber` varchar(255) DEFAULT NULL,
  `playerName` varchar(255) DEFAULT NULL,
  `attributesSN` varchar(255) DEFAULT NULL,
  `declaredValue` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `qty`, `cardYear`, `brand`, `cardNumber`, `playerName`, `attributesSN`, `declaredValue`, `created_at`) VALUES
(5, 21, 2, '22', '', '', '', '', 11.00, '2023-09-08 23:36:36'),
(6, 21, 1, '2022', '', '', '', '', 33.00, '2023-09-08 23:37:03'),
(7, 22, 33, '2022', '', '', '', '', 112.00, '2023-09-09 00:02:21'),
(8, 26, 22, '2022', '', '', '', '', 1000.00, '2023-09-15 14:35:50'),
(9, 27, 10, '2022', '', '', '', '', 1000.00, '2023-09-15 14:57:10'),
(10, 27, 50, '2023', '', '', '', '', 1000.00, '2023-09-15 14:57:21'),
(11, 28, 11, '2022', '', '', '', '', 1111.00, '2023-09-17 14:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `referral_code` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `total_grading_price` decimal(10,2) DEFAULT NULL,
  `total_evaluation_price` decimal(10,2) DEFAULT NULL,
  `card_value` varchar(100) DEFAULT NULL,
  `service_provider` varchar(50) DEFAULT NULL,
  `card_quantity` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `insurance` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Awaiting Card List',
  `submission` varchar(100) NOT NULL,
  `notify` varchar(30) NOT NULL DEFAULT 'new',
  `payment_status` varchar(100) NOT NULL DEFAULT 'unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `street_address`, `address_line2`, `state`, `coupon_code`, `referral_code`, `total_price`, `total_grading_price`, `total_evaluation_price`, `card_value`, `service_provider`, `card_quantity`, `user_id`, `created_at`, `insurance`, `status`, `submission`, `notify`, `payment_status`) VALUES
(19, 'owaisorakzai77@gmail.com', 'Qarni', 'owaisorakzai77@gmail.com', '+923111232327', 'Bobs Hostel, Main Hamza Rd, F11, Islamabad', 'ss', 'asdasd', 'Islamabad', '', '', 484.00, 418.00, 66.00, 'PSA Bulk 1980-present- $19 per card - Max Declared Value: $499 - Est. Turnaround : 60 Business Days|', 'PSA', 22, 1, '2023-09-08 23:04:14', 0, 'Awaiting Card List', '11011843', 'old', ''),
(20, 'owaisorakzai77@gmail.com', 'Qarni', 'owaisorakzai77@gmail.com', '+923111232327', 'Bobs Hostel, Main Hamza Rd, F11, Islamabad', 'Hhhh', 'asdasd', 'Islamabad', '', '', 88.00, 76.00, 12.00, 'PSA Bulk 1980-present- $19 per card - Max Declared Value: $499 - Est. Turnaround : 60 Business Days|', 'PSA', 4, 1, '2023-09-08 23:13:24', 0, 'Awaiting Card List', '', 'old', ''),
(21, 'owaisorakzai77@gmail.com', 'Qarni', 'owaisorakzai77@gmail.com', '+923111232327', 'Bobs Hostel, Main Hamza Rd, F11, Islamabad', 'Hhhh', 'asdasd', 'Islamabad', '', '', 44.00, 38.00, 6.00, 'PSA Bulk 1980-present- $19 per card - Max Declared Value: $499 - Est. Turnaround : 60 Business Days|', 'PSA', 2, 1, '2023-09-08 23:14:27', 12, 'Awaiting Card List', '', 'old', ''),
(22, 'owaisorakzai77@gmail.com', 'Qarni', 'owaisorakzai77@gmail.com', '+923111232327', 'Bobs Hostel, Main Hamza Rd, F11, Islamabad', 'Hhhh', 'asdasd', 'Islamabad', '', '', 440.00, 380.00, 60.00, 'PSA Bulk 1980-present- $19 per card - Max Declared Value: $499 - Est. Turnaround : 60 Business Days|', 'PSA', 20, 1, '2023-09-09 00:01:14', 12, 'Awaiting Card List', '', 'old', ''),
(23, 'owaisorakzai77@gmail.com', 'Qarni', 'owaisorakzai77@gmail.com', '+923111232327', 'Bobs Hostel, Main Hamza Rd, F11, Islamabad', 'Hhhh', 'asdasd', 'Islamabad', '', '', 0.00, 0.00, 0.00, '0', '', 0, 1, '2023-09-09 01:24:11', 0, 'Awaiting Card List', '', 'old', ''),
(24, 'owaisorakzai77@gmail.com', 'Qarni', 'owaisorakzai77@gmail.com', '+923111232327', 'Bobs Hostel, Main Hamza Rd, F11, Islamabad', 'Hhhh', 'asdasd', 'Islamabad', '', '', 0.00, 0.00, 0.00, '0', '', 0, 1, '2023-09-09 01:25:40', 0, 'Awaiting Card List', '', 'old', ''),
(25, 'owaisorakzai77@gmail.com', 'Qarni', 'owaisorakzai77@gmail.com', '+923111232327', 'Bobs Hostel, Main Hamza Rd, F11, Islamabad', 'Hhhh', 'asdasd', 'Islamabad', '', '', 88.00, 76.00, 12.00, 'PSA Bulk 1980-present- $19 per card - Max Declared Value: $499 - Est. Turnaround : 60 Business Days|', 'PSA', 4, 1, '2023-09-09 01:26:35', 0, 'Awaiting Card List', '', 'old', ''),
(26, 'Owais', 'Qarni', 'owaisorakzai77@gmail.com', '+923111232327', 'Bobs Hostel, Main Hamza Rd, F11, Islamabad', 'ss', 'dd', 'Islamabad', '', '', 484.00, 418.00, 66.00, 'PSA Bulk 1980-present- $19 per card - Max Declared Value: $499 - Est. Turnaround : 60 Business Days|', 'PSA', 22, 3, '2023-09-15 14:35:39', 48, 'Awaiting Card List', '', 'old', 'paid'),
(27, 'asds', 'asd', 'owaisorakzai77@gmail.com', '+923111232327', 'Bobs Hostel, Main Hamza Rd, F11, Islamabad', 'asd', 'asdas', 'Islamabad', '', '', 484.00, 418.00, 66.00, 'PSA Bulk 1980-present- $19 per card - Max Declared Value: $499 - Est. Turnaround : 60 Business Days|', 'PSA', 22, 3, '2023-09-15 14:57:00', 6, 'Awaiting Card List', '', 'old', 'unpaid'),
(28, 'owais', 'Qarni', 'owaisorakzai77@gmail.com', '+923111232327', 'Bobs Hostel, Main Hamza Rd, F11, Islamabad', 'Hhhh', 'asdasd', 'Islamabad', '', '', 3663.00, 3630.00, 33.00, 'PSA Super Express- $330 per card - Max Declared Value $4,999 - Est. Turnaround: 3 Business Days|330', 'PSA', 11, 14, '2023-09-17 14:51:46', 11, 'Awaiting Card List', '', 'old', 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_token` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'unverified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `verification_token`, `status`) VALUES
(1, 'owais', 'owaisorakzai77@gmail.com', '$2y$10$f.1civBX0dzEoQDo9Z5rN.IqGoMnaufWSJW46j0beKq0IN3werEtW', '', 'unverified'),
(2, 'owais77', 'o@gmail.com', '$2y$10$CWMcLJaHzWB5qC8aWV8tMO4C3GT.pN8eye8JpopUiJ/fscN5/1BWi', '', 'unverified'),
(3, 'karan', 'k@gmail.com', '$2y$10$8pkQgRmKkXibbs13y2rM8eVdJF9rA2ZN5Pzg8tODJS0XdY3OhXxca', '', 'unverified'),
(9, 'admin77', 'owaisor@gmail.com', '$2y$10$mnAdoelRzS368ehvaK6/8u1dT3aUKzdIWZERRvDZ5llDcffHYr8vW', '', 'unverified'),
(11, 'ZZ', 'z@gmail.com', '$2y$10$eZZt.VTt9T4gEbh0Ir7r4.MCLkPrYrAh.waM1ptY8vlwMu2Iz3coC', '', 'unverified'),
(14, 'ff', 'owaisorakzai99@gmail.com', '$2y$10$Mm2484FtL/9oSbQizT.KnurukEgd2t1DVk/6YXURF5tEoZHKctQx6', 'dc8819409dc888ba8215d587ae1743474270e38812873143a5381b75a4821b23', 'verified'),
(15, 'karan1111111111111', 'adsd@gmail.com', '$2y$10$u5Q1KgkJNaaxPycXAvDQVOq/Js5qs1DSkV5yjgnRhuihZRQ/nk8Cy', 'a140420939bfdc9bafde4785801708284678261ec6e5debd8f53e3582b729f10', 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `home_text` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id`, `home_text`) VALUES
(1, 'You are more than welcome to submit different service levels in the same package to us (ex: PSA bulk & SGC regular).\r\n\r\nHowever each service level needs a different order placed on our site, as they would come back at different times.\r\n\r\nSo you would place your order for (ex: 20 cards bulk, complete shipping and place order) then place a new order for the other service(s) you need.\r\n\r\nYou would then print out your 2 packing slips, put each form with the cards going each service level in the 1 package.\r\n\r\nThis allows you to get status updates on each individual order. If submitting just 1 order type (ex: PSA bulk) simply put your packing slip with the cards and you are good to go!\r\n\r\nGood luck on your submission, and thank you for choosing kksportscards.\r\n\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_psa`
--
ALTER TABLE `orders_psa`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_ibfk_1` (`order_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `for` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=640;

--
-- AUTO_INCREMENT for table `orders_psa`
--
ALTER TABLE `orders_psa`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_psa`
--
ALTER TABLE `orders_psa`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `submissions` (`id`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `for` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
