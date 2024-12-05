-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 08:18 AM
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
-- Database: `scheduling_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assembly_hall`
--

CREATE TABLE `assembly_hall` (
  `id` int(30) NOT NULL,
  `room_name` varchar(250) NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assembly_hall`
--

INSERT INTO `assembly_hall` (`id`, `room_name`, `location`, `description`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Room 101', 'Ground Floor, Right Corner', 'Conference Room that can occupy 30 attendees', 1, '2021-08-06 09:26:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `canceled_schedule`
--

CREATE TABLE `canceled_schedule` (
  `id` int(11) NOT NULL,
  `schedule_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`schedule_data`)),
  `canceled_at` datetime NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `canceled_schedule`
--

INSERT INTO `canceled_schedule` (`id`, `schedule_data`, `canceled_at`, `room_name`, `location`) VALUES
(1, '{\"id\":\"10\",\"assembly_hall_id\":\"1\",\"reserved_by\":\"a\",\"schedule_remarks\":\"qawswd\",\"datetime_start\":\"2024-12-04 08:20:00\",\"datetime_end\":\"2024-12-04 09:20:00\",\"status\":\"0\",\"date_created\":\"2024-12-03 21:20:51\",\"date_updated\":null}', '2024-12-05 13:40:27', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `assembly_hall_id` int(30) NOT NULL,
  `reserved_by` text NOT NULL,
  `schedule_remarks` text NOT NULL,
  `datetime_start` datetime NOT NULL,
  `datetime_end` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `assembly_hall_id`, `reserved_by`, `schedule_remarks`, `datetime_start`, `datetime_end`, `status`, `date_created`, `date_updated`) VALUES
(7, 1, 'jaja', 'asddasdasd', '2024-11-18 01:00:00', '2024-11-18 03:00:00', 0, '2024-11-17 22:56:27', NULL),
(8, 1, 'sdffsdf', 'asdasd', '2024-11-18 13:00:00', '2024-11-18 14:00:00', 0, '2024-11-17 22:58:09', NULL),
(9, 1, 'fgfgds', 'asdasd', '2024-11-18 15:00:00', '2024-11-18 16:00:00', 0, '2024-11-17 22:58:59', NULL),
(19, 1, 'jaja', 'Event by jannete', '2024-12-06 15:12:00', '2024-12-06 16:12:00', 0, '2024-12-05 15:13:03', NULL),
(20, 1, 'jaja', 'aefsasdfedfsdfas', '2024-12-05 15:13:00', '2024-12-05 16:13:00', 0, '2024-12-05 15:14:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Barangay Mabulitec Scheduling System'),
(6, 'short_name', 'Brgy MSS'),
(11, 'logo', 'uploads/1628211420_schedule.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1628211420_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1624240500_avatar.png', NULL, 1, '2021-01-20 14:02:37', '2021-06-21 09:55:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assembly_hall`
--
ALTER TABLE `assembly_hall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canceled_schedule`
--
ALTER TABLE `canceled_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
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
-- AUTO_INCREMENT for table `assembly_hall`
--
ALTER TABLE `assembly_hall`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `canceled_schedule`
--
ALTER TABLE `canceled_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
