-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2021 at 12:21 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems2`
--
CREATE DATABASE IF NOT EXISTS `ems2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ems2`;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`) VALUES
(1, 'Chhapra', 1),
(2, 'Gazipur', 1),
(3, 'Patna', 1),
(4, 'Delhi', 2),
(5, 'New Delhi', 2),
(6, 'Ambala', 3),
(7, 'Gurgaon', 3),
(8, 'Panipat', 3),
(9, 'Amritsar', 4),
(10, 'Kotkapura', 4),
(11, 'Patiala', 4),
(12, 'Allahabad', 5),
(13, 'Lucknow', 5),
(14, 'Noida', 5),
(15, 'Varanasi', 5);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `shortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `shortname`, `name`, `phonecode`) VALUES
(249, 'IN', 'India', 91);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `state_id` varchar(50) NOT NULL,
  `cities_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `state_id`, `cities_id`, `name`) VALUES
(18, '1', '3', 'Financee'),
(20, '2', '5', 'IT'),
(22, '1', '2', 'Mechanical'),
(23, '3', '6', 'Tester'),
(24, '3', '7', 'CS'),
(25, '3', '8', 'Management'),
(27, '4', '10', 'Designer'),
(28, '4', '11', 'Finance'),
(29, '5', '12', 'Management'),
(30, '5', '13', 'IT'),
(31, '5', '14', 'CS'),
(32, '5', '15', 'Tester'),
(33, '1', '1', 'Tester');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `salary` int(11) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `btech` varchar(255) NOT NULL,
  `bca` varchar(255) NOT NULL,
  `mtech` varchar(255) NOT NULL,
  `mca` varchar(255) NOT NULL,
  `hobbies` varchar(5000) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `cities_id` int(11) NOT NULL,
  `dept_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `dob`, `salary`, `gender`, `btech`, `bca`, `mtech`, `mca`, `hobbies`, `resume`, `state_id`, `cities_id`, `dept_id`) VALUES
(1, 'Adnan Ashraf', '1995-06-05', 10000, 'Male', '1', '1', '1', '1', '<p>&nbsp;Playing Cricket &amp; Football,</p>\r\n', 'uploads/bootstrap-4.0.0.zip', 5, 12, '29'),
(2, 'Adil ', '2003-12-10', 250000, 'Male', '0', '1', '0', '1', '<p>Study,</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'uploads/javed resume.docx', 4, 10, '27'),
(11, 'Sufiyan Ashraf', '2003-01-01', 1000000, 'Male', '0', '1', '0', '1', '<p>Travelling</p>\r\n', 'uploads/Adnan..pdf', 5, 12, '29');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'Bihar', 101),
(2, 'Delhi', 101),
(3, 'Haryana', 101),
(4, 'Punjab', 101),
(5, 'Uttar Pradesh', 101);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
