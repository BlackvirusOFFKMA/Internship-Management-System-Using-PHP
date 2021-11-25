-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 06:32 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlsvtt`
--

-- --------------------------------------------------------

--
-- Table structure for table `bangdiemtt`
--

CREATE TABLE `bangdiemtt` (
  `MaDT` char(10) NOT NULL,
  `MaSV` char(10) NOT NULL,
  `Diem` tinyint(4) NOT NULL,
  `GhiChu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detai`
--

CREATE TABLE `detai` (
  `MaDT` char(10) NOT NULL,
  `TenDt` varchar(50) NOT NULL,
  `MaGV` char(10) NOT NULL COMMENT 'Mã giáo viên',
  `LoaihinhTT` varchar(20) NOT NULL COMMENT 'Loại hình thực tập'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nhomtt`
--

CREATE TABLE `nhomtt` (
  `MaDT` char(10) NOT NULL,
  `MaGV` char(10) NOT NULL,
  `MaSV` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `rank` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `date`, `user_id`, `gender`, `rank`, `password`, `image`) VALUES
(1, 'Eathorne', 'Banda', 'eathorne@yahoo.com', '2021-08-10 19:08:58', 'eathorne.banda', 'male', 'super_admin', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', 'uploads/cardinal_1585485603.jpg'),
(3, 'John', 'Tembo', 'john@yahoo.com', '2021-08-18 14:43:04', 'john.tembo', 'male', 'admin', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', 'uploads/header100people.jpg'),
(4, 'Anna', 'Jones', 'anna@yahoo.com', '2021-08-18 15:02:29', 'anna.jonnes', 'female', 'reception', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', ''),
(5, 'Vibe', 'Peters', 'vibe@yahoo.com', '2021-08-18 15:03:07', 'vibe.peters', 'male', 'lecturer', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', ''),
(6, 'Bob', 'Marley', 'bob@yahoo.com', '2021-08-18 16:03:55', 'bob.marley', 'male', 'student', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', ''),
(7, 'Maria', 'Jonnes', 'maria@yahoo.com', '2021-08-18 16:06:27', 'maria.jonnes', 'female', 'student', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', ''),
(8, 'Jane', 'Mandawa', 'jane@yahoo.com', '2021-08-18 16:07:00', 'jane.mandawa', 'female', 'student', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', ''),
(9, 'Guy', 'Dude', 'guy@yahoo.com', '2021-08-21 18:26:48', 'guy.dude', 'male', 'student', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detai`
--
ALTER TABLE `detai`
  ADD PRIMARY KEY (`MaDT`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `lastname` (`lastname`),
  ADD KEY `date` (`date`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `gender` (`gender`),
  ADD KEY `rank` (`rank`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
