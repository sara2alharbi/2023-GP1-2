-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 05:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elmam`
--

-- --------------------------------------------------------

--
-- Table structure for table `elmam_device`
--

CREATE TABLE `elmam_device` (
  `microID` varchar(50) NOT NULL,
  `roomNo` varchar(10) NOT NULL,
  `temperature` double(10,10) DEFAULT NULL,
  `humidity` double(10,10) DEFAULT NULL,
  `noise` double(10,10) DEFAULT NULL,
  `airQuality` double(10,10) DEFAULT NULL,
  `dataTime` time(6) NOT NULL,
  `dataDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `courseCo` varchar(10) NOT NULL,
  `roomNo` varchar(10) NOT NULL,
  `section` int(10) NOT NULL,
  `day` varchar(15) NOT NULL,
  `startTime` varchar(6) NOT NULL,
  `endTime` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `name` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`name`, `email`, `password`) VALUES
('admin', 'admin@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `floor` varchar(15) NOT NULL,
  `roomNo` varchar(10) NOT NULL,
  `microID` varchar(50) NOT NULL,
  `type` varchar(25) NOT NULL,
  `capacity` int(4) NOT NULL,
  `status` varchar(12) NOT NULL,
  `elmamSystem` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`floor`, `roomNo`, `microID`, `type`, `capacity`, `status`, `elmamSystem`) VALUES
('الأول', 'F1', '', 'عادية', 26, 'متاحه', 0),
('الأول', 'F12', '', 'معمل', 56, 'متاحه', 0),
('الأول', 'F14', '', 'معمل', 32, 'متاحه', 0),
('الأول', 'F15', '', 'عادية', 51, 'متاحه', 0),
('الأول', 'F16', '', 'عادية', 33, 'متاحه', 0),
('الأول', 'F17', '', 'تفاعلية', 33, 'متاحه', 0),
('الأول', 'F19', '', 'تفاعلية', 31, 'متاحه', 0),
('الأول', 'F2', '', 'بث', 20, 'متاحه', 0),
('الأول', 'F20', '', 'معمل', 24, 'متاحه', 0),
('الأول', 'F26', '', 'عادية', 33, 'متاحه', 0),
('الأول', 'F3', '', 'معمل', 23, 'متاحه', 0),
('الأول', 'F35', '', 'تفاعلية', 36, 'متاحه', 0),
('الأول', 'F37', '', 'تفاعلية', 36, 'متاحه', 0),
('الأول', 'F38', '', 'تفاعلية', 38, 'متاحه', 0),
('الأول', 'F5', '', 'عادية', 24, 'متاحه', 0),
('الأول', 'F51', '', 'بث', 29, 'متاحه', 0),
('الأول', 'F52', '', 'بث', 27, 'متاحه', 0),
('الأول', 'F55', '', 'بث', 17, 'متاحه', 0),
('الأول', 'F56', '', 'بث', 40, 'متاحه', 0),
('الأول', 'F6', '', 'بث', 21, 'متاحه', 0),
('الأول', 'F9', '', 'عادية', 38, 'متاحه', 0),
('الأرضي', 'G11', '', 'عادية', 45, 'متاحه', 0),
('الأرضي', 'G12', '', 'معمل', 56, 'متاحه', 0),
('الأرضي', 'G13', '', 'تفاعلية', 34, 'متاحه', 0),
('الأرضي', 'G15', '', 'معمل', 40, 'متاحه', 0),
('الأرضي', 'G16', '', 'عادية', 62, 'متاحه', 0),
('الأرضي', 'G20', '', 'بث', 36, 'متاحه', 0),
('الأرضي', 'G21', '', 'بث', 45, 'متاحه', 0),
('الأرضي', 'G3', '', 'عادية', 30, 'متاحه', 0),
('الأرضي', 'G30', '', 'بث', 40, 'متاحه', 0),
('الأرضي', 'G35', '', 'عادية', 28, 'متاحه', 0),
('الأرضي', 'G36', '', 'عادية', 58, 'متاحه', 0),
('الأرضي', 'G37', '', 'عادية', 29, 'متاحه', 0),
('الأرضي', 'G38', '', 'تفاعلية', 38, 'متاحه', 0),
('الأرضي', 'G4', '', 'عادية', 45, 'متاحه', 0),
('الأرضي', 'G40', '', 'عادية', 57, 'متاحه', 0),
('الأرضي', 'G47', '', 'عادية', 52, 'متاحه', 0),
('الأرضي', 'G48', '', 'عادية', 22, 'متاحه', 0),
('الأرضي', 'G49', '', 'تفاعلية', 27, 'متاحه', 0),
('الأرضي', 'G5', '', 'عادية', 25, 'متاحه', 0),
('الأرضي', 'G50', '', 'عادية', 34, 'متاحه', 0),
('الأرضي', 'G51', '', 'عادية', 25, 'متاحه', 0),
('الأرضي', 'G6', '', 'عادية', 28, 'متاحه', 0),
('الأرضي', 'G7', '', 'عادية', 45, 'متاحه', 0),
('الأرضي', 'G9', '', 'عادية', 30, 'متاحه', 0),
('الثاني', 'S14', '', 'معمل', 44, 'متاحه', 0),
('الثاني', 'S16', '', 'معمل', 36, 'متاحه', 0),
('الثاني', 'S20', '', 'معمل', 34, 'متاحه', 0),
('الثاني', 'S22', '', 'معمل', 25, 'متاحه', 0),
('الثاني', 'S23', '', 'معمل', 44, 'متاحه', 0),
('الثاني', 'S25', '', 'معمل', 40, 'متاحه', 0),
('الثاني', 'S30', '', 'معمل', 32, 'متاحه', 0),
('الثاني', 'S34', '', 'معمل', 33, 'متاحه', 0),
('الثاني', 'S39', '', 'معمل', 26, 'متاحه', 0),
('الثاني', 'S40', '', 'عادية', 32, 'متاحه', 0),
('الثاني', 'S41', '', 'معمل', 30, 'متاحه', 0),
('الثاني', 'S43', '', 'عادية', 24, 'متاحه', 0),
('الثاني', 'S44', '', 'عادية', 35, 'متاحه', 0),
('الثاني', 'S7', '', 'معمل', 23, 'متاحه', 0),
('الثاني', 'S8', '', 'عادية', 30, 'متاحه', 0),
('الثاني', 'ٍS5', '', 'معمل', 20, 'متاحه', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `elmam_device`
--
ALTER TABLE `elmam_device`
  ADD PRIMARY KEY (`microID`),
  ADD KEY `roomNo` (`roomNo`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`courseCo`),
  ADD KEY `roomNo` (`roomNo`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomNo`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `elmam_device`
--
ALTER TABLE `elmam_device`
  ADD CONSTRAINT `elmam_device_ibfk_1` FOREIGN KEY (`roomNo`) REFERENCES `room` (`roomNo`);

--
-- Constraints for table `lecture`
--
ALTER TABLE `lecture`
  ADD CONSTRAINT `lecture_ibfk_1` FOREIGN KEY (`roomNo`) REFERENCES `room` (`roomNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
