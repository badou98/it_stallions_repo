-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 11:27 PM
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
-- Database: `ikimina`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_tbl`
--

CREATE TABLE `account_tbl` (
  `acc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` double NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`acc_id`, `user_id`, `balance`, `status`) VALUES
(1, 2, 20000, '1'),
(2, 3, 72000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `contribution_tbl`
--

CREATE TABLE `contribution_tbl` (
  `contribution_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `contributed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contribution_tbl`
--

INSERT INTO `contribution_tbl` (`contribution_id`, `user_id`, `amount`, `contributed_at`) VALUES
(1, 2, 3000.00, '2024-04-03 08:00:34'),
(2, 3, 3000.00, '2024-04-03 08:10:28'),
(3, 2, 3000.00, '2024-04-03 09:16:43'),
(4, 2, 1000.00, '2024-04-03 09:25:49'),
(5, 2, 1000.00, '2024-04-03 09:26:44'),
(6, 3, 1000.00, '2024-04-03 09:36:33'),
(7, 3, 1000.00, '2024-04-03 09:40:48'),
(10, 3, 1000.00, '2024-04-03 09:50:18'),
(11, 3, 10000.00, '2024-04-03 10:13:16'),
(12, 3, 1000.00, '2024-04-03 10:28:02'),
(13, 3, 1000.00, '2024-04-03 10:29:49'),
(14, 3, 1000.00, '2024-04-03 10:35:59'),
(15, 3, 1000.00, '2024-04-03 10:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `pin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`user_id`, `full_name`, `telephone`, `pin`) VALUES
(2, 'badou', '0781463527', 1111),
(3, 'robert', '0781473586', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_tbl`
--

CREATE TABLE `transaction_tbl` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_type` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_datetime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_tbl`
--

INSERT INTO `transaction_tbl` (`transaction_id`, `user_id`, `transaction_type`, `amount`, `transaction_datetime`) VALUES
(1, 3, 'Deposit', 1000.00, '2024-04-03'),
(2, 3, 'Deposit', 10000.00, '2024-04-03'),
(3, 3, 'Deposit', 1000.00, '2024-04-03'),
(4, 3, 'Deposit', 1000.00, '2024-04-03'),
(5, 3, 'Deposit', 1000.00, '2024-04-03'),
(6, 3, 'Deposit', 1000.00, '2024-04-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD PRIMARY KEY (`acc_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contribution_tbl`
--
ALTER TABLE `contribution_tbl`
  ADD PRIMARY KEY (`contribution_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_tbl`
--
ALTER TABLE `account_tbl`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contribution_tbl`
--
ALTER TABLE `contribution_tbl`
  MODIFY `contribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD CONSTRAINT `account_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`user_id`);

--
-- Constraints for table `contribution_tbl`
--
ALTER TABLE `contribution_tbl`
  ADD CONSTRAINT `contribution_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`user_id`);

--
-- Constraints for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  ADD CONSTRAINT `transaction_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account_tbl` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
