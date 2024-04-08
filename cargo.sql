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
-- Database: `cargo`
--

-- --------------------------------------------------------

--
-- Table structure for table `export`
--

CREATE TABLE `export` (
  `FurnitureId` int(11) DEFAULT NULL,
  `ExportDate` date DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `furniture`
--

CREATE TABLE `furniture` (
  `FurnitureId` int(11) NOT NULL,
  `FurnitureName` varchar(255) DEFAULT NULL,
  `FurnitureOwnerName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furniture`
--

INSERT INTO `furniture` (`FurnitureId`, `FurnitureName`, `FurnitureOwnerName`) VALUES
(1, 'chairs', 'baptiste'),
(2, 'chairs', 'baptiste'),
(3, 'bed', 'marc'),
(4, 'bed', 'badou'),
(5, 'bed', 'badou'),
(6, 'bed', 'baptiste'),
(7, 'morriot', 'badou'),
(8, 'fds', 'sd'),
(9, 'morriot', 'badou'),
(10, 'cupboard', 'frasta'),
(11, 'cupboard', 'hdgs');

-- --------------------------------------------------------

--
-- Table structure for table `import`
--

CREATE TABLE `import` (
  `FurnitureId` int(11) DEFAULT NULL,
  `ImportDate` timestamp NULL DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `import`
--

INSERT INTO `import` (`FurnitureId`, `ImportDate`, `Quantity`) VALUES
(5, NULL, 50),
(6, NULL, 50),
(9, '2024-04-05 10:05:16', 60),
(10, '2024-04-06 07:28:58', 10),
(11, '2024-04-06 08:06:02', 800);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `ManagerId` int(11) NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`ManagerId`, `UserName`, `Password`) VALUES
(1, 'admin', 'admin'),
(2, 'badou', '202cb962ac59075b964b07152d234b70'),
(3, 'robert', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `export`
--
ALTER TABLE `export`
  ADD KEY `FurnitureId` (`FurnitureId`);

--
-- Indexes for table `furniture`
--
ALTER TABLE `furniture`
  ADD PRIMARY KEY (`FurnitureId`);

--
-- Indexes for table `import`
--
ALTER TABLE `import`
  ADD KEY `FurnitureId` (`FurnitureId`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`ManagerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `furniture`
--
ALTER TABLE `furniture`
  MODIFY `FurnitureId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `ManagerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `export`
--
ALTER TABLE `export`
  ADD CONSTRAINT `export_ibfk_1` FOREIGN KEY (`FurnitureId`) REFERENCES `furniture` (`FurnitureId`);

--
-- Constraints for table `import`
--
ALTER TABLE `import`
  ADD CONSTRAINT `import_ibfk_1` FOREIGN KEY (`FurnitureId`) REFERENCES `furniture` (`FurnitureId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
