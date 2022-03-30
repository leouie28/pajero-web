-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 03:27 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pajero`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bk_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `bk_type` varchar(50) NOT NULL,
  `bk_from` varchar(191) NOT NULL,
  `bk_route` varchar(191) NOT NULL,
  `bk_pax` int(11) NOT NULL,
  `bk_note` text DEFAULT NULL,
  `bk_stat` varchar(50) NOT NULL,
  `bk_create` date NOT NULL,
  `bk_update` datetime NOT NULL,
  `driver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bk_id`, `passenger_id`, `bk_type`, `bk_from`, `bk_route`, `bk_pax`, `bk_note`, `bk_stat`, `bk_create`, `bk_update`, `driver_id`) VALUES
(2, 1, 'standard', 'Balud Covered court', 'Metro', 1, 'Atubang sa covered court', 'searching', '2022-03-27', '2022-03-27 16:15:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `of_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `bk_id` int(11) NOT NULL,
  `of_stat` varchar(50) NOT NULL,
  `of_message` varchar(100) NOT NULL,
  `of_time` varchar(100) NOT NULL,
  `of_create` date NOT NULL,
  `of_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`of_id`, `driver_id`, `bk_id`, `of_stat`, `of_message`, `of_time`, `of_create`, `of_update`) VALUES
(1, 2, 2, 'pending', 'Hi! Im available to be your service', '5', '2022-03-28', '2022-03-28 17:18:03'),
(2, 2, 2, 'pending', 'Hi! Im available to be your service', '5', '2022-03-29', '2022-03-28 20:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_fname` varchar(100) NOT NULL,
  `user_lname` varchar(100) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_user` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_stat` varchar(50) NOT NULL DEFAULT 'active',
  `user_create` date NOT NULL,
  `user_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `user_fname`, `user_lname`, `user_address`, `user_email`, `user_user`, `user_pass`, `user_stat`, `user_create`, `user_update`) VALUES
(1, 'passenger', 'Mark', 'Tabique', 'Testing Address', 'mark@gmail.com', 'mark', '123', 'active', '2022-03-27', '2022-03-27 10:42:04'),
(2, 'driver', 'Berna', 'Tabique', 'Testing Address', 'berna@gmail.com', 'berna', '123', 'active', '2022-03-27', '2022-03-27 16:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vh_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vh_plate` varchar(50) NOT NULL,
  `vh_color` varchar(50) NOT NULL,
  `vh_expire` date NOT NULL,
  `vh_image` varchar(100) NOT NULL DEFAULT 'none',
  `vh_create` date NOT NULL,
  `vh_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vh_id`, `user_id`, `vh_plate`, `vh_color`, `vh_expire`, `vh_image`, `vh_create`, `vh_update`) VALUES
(1, 2, 'T67HK', 'Yellow', '2023-04-13', 'none', '2022-03-27', '2022-03-27 16:22:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bk_id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`of_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vh_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `of_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
