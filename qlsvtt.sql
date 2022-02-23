-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2022 at 06:20 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

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
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `topic_id` varchar(60) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `score` tinyint(4) NOT NULL,
  `notes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`topic_id`, `user_id`, `score`, `notes`) VALUES
('T001', 'guy.dude', 8, ''),
('T003', 'jane.mandawa', 7, '');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `topic` varchar(30) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `topic_id` varchar(60) NOT NULL,
  `create_date` date NOT NULL,
  `date_submit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic`, `user_id`, `topic_id`, `create_date`, `date_submit`) VALUES
(1, 'Lập trình web', 'dude.guy', 'T01', '2022-01-01', '2022-02-28'),
(2, 'Lập trình ứng dụng', 'marley.bob', 'T02', '2022-01-01', '2022-02-28'),
(4, 'Khoa học máy tính', 'eathorne.banda', 'T03', '2022-02-23', '2022-03-23'),
(5, 'Công nghệ phần mềm', 'eathorne.banda', 'T04', '2022-02-23', '2022-03-18'),
(6, 'Kỹ thuật máy tính', 'eathorne.banda', 'T05', '2022-02-23', '2022-04-26'),
(7, 'Kỹ thuật mạng', 'eathorne.banda', 'T06', '2022-02-23', '2022-05-04'),
(8, 'Robot', 'eathorne.banda', 'T07', '2022-02-23', '2023-01-07'),
(9, 'Trí tuệ nhân tạo', 'eathorne.banda', 'T08', '2022-02-23', '2023-02-17');

-- --------------------------------------------------------

--
-- Table structure for table `topic_lecturers`
--

CREATE TABLE `topic_lecturers` (
  `id` int(11) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `topic_id` varchar(60) NOT NULL,
  `disabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic_lecturers`
--

INSERT INTO `topic_lecturers` (`id`, `user_id`, `topic_id`, `disabled`) VALUES
(6, 'tran.anh', 'T01', 1),
(7, 'huu.nghia', 'T01', 1),
(8, 'nguyen.tien', 'T01', 1),
(9, 'pham.tuan', 'T01', 1),
(10, 'yen.tram', 'T01', 1),
(11, 'nguyen.phuc', 'T01', 1),
(12, 'tran.anh', 'T02', 1),
(13, 'huu.nghia', 'T02', 1),
(14, 'nguyen.tien', 'T02', 1),
(15, 'pham.tuan', 'T02', 1),
(16, 'yen.tram', 'T02', 1),
(17, 'nguyen.phuc', 'T02', 1),
(18, 'tran.anh', 'T031', 1),
(19, 'huu.nghia', 'T03', 1),
(20, 'nguyen.tien', 'T03', 0),
(21, 'pham.tuan', 'T03', 1),
(22, 'yen.tram', 'T03', 1),
(23, 'nguyen.phuc', 'T03', 1),
(24, 'tran.anh', 'T04', 1),
(25, 'huu.nghia', 'T04', 1),
(26, 'nguyen.tien', 'T04', 1),
(27, 'pham.tuan', 'T04', 0),
(28, 'yen.tram', 'T04', 1),
(29, 'nguyen.phuc', 'T04', 1),
(30, 'tran.anh', 'T05', 1),
(31, 'huu.nghia', 'T05', 1),
(32, 'nguyen.tien', 'T05', 1),
(33, 'pham.tuan', 'T05', 1),
(34, 'yen.tram', 'T05', 0),
(35, 'nguyen.phuc', 'T05', 1),
(36, 'tran.anh', 'T06', 0),
(37, 'huu.nghia', 'T06', 1),
(38, 'nguyen.tien', 'T06', 1),
(39, 'pham.tuan', 'T06', 1),
(40, 'yen.tram', 'T06', 1),
(41, 'nguyen.phuc', 'T06', 1),
(42, 'tran.anh', 'T07', 1),
(43, 'huu.nghia', 'T07', 0),
(44, 'nguyen.tien', 'T07', 1),
(45, 'pham.tuan', 'T07', 1),
(46, 'yen.tram', 'T07', 1),
(47, 'nguyen.phuc', 'T07', 1),
(48, 'tran.anh', 'T08', 1),
(49, 'huu.nghia', 'T08', 1),
(50, 'nguyen.tien', 'T08', 1),
(51, 'pham.tuan', 'T08', 1),
(52, 'yen.tram', 'T08', 1),
(53, 'nguyen.phuc', 'T08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `topic_students`
--

CREATE TABLE `topic_students` (
  `id` int(11) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `topic_id` varchar(60) NOT NULL,
  `disabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic_students`
--

INSERT INTO `topic_students` (`id`, `user_id`, `topic_id`, `disabled`) VALUES
(1, 'pham.huu', 'T03', 0),
(6, 'nguyen.vy', 'T03', 0),
(7, 'tran.khiem', 'T03', 0),
(8, 'nguyenthanh.hue', 'T04', 1),
(9, 'nguyenminh.nhi', 'T04', 0),
(10, 'nguyen.nhat', 'T04', 1),
(11, 'nguyen.hai', 'T05', 1),
(12, 'truong.giang', 'T05', 1),
(13, 'phamkim.tuyen', 'T05', 0),
(14, 'pham.huu', 'T05', 1),
(15, 'nguyen.vy', 'T05', 1),
(16, 'tran.khiem', 'T05', 1),
(17, 'nguyen.nhat', 'T05', 1),
(18, 'nguyenminh.nhi', 'T05', 1),
(19, 'nguyenthanh.hue', 'T05', 0),
(20, 'huu.phuoc', 'T05', 1),
(21, 'phamthanh.nhan', 'T05', 0),
(22, 'nguyenhong.tra', 'T05', 1),
(23, 'nguyen.hai', 'T04', 1),
(24, 'truong.giang', 'T04', 0),
(25, 'phamkim.tuyen', 'T04', 1),
(26, 'pham.huu', 'T04', 1),
(27, 'nguyen.vy', 'T04', 1),
(28, 'tran.khiem', 'T04', 1),
(29, 'huu.phuoc', 'T04', 1),
(30, 'phamthanh.nhan', 'T04', 1),
(31, 'nguyenhong.tra', 'T04', 0),
(32, 'nguyen.hai', 'T03', 1),
(33, 'truong.giang', 'T03', 1),
(34, 'phamkim.tuyen', 'T03', 1),
(35, 'nguyen.nhat', 'T03', 1),
(36, 'nguyenminh.nhi', 'T03', 1),
(37, 'nguyenthanh.hue', 'T03', 1),
(38, 'huu.phuoc', 'T03', 1),
(39, 'phamthanh.nhan', 'T03', 1),
(40, 'nguyenhong.tra', 'T03', 1),
(41, 'truong.giang', 'T06', 1),
(42, 'nguyen.hai', 'T06', 1),
(43, 'pham.huu', 'T06', 1),
(44, 'nguyen.nhat', 'T06', 1),
(45, 'tran.khiem', 'T06', 1),
(46, 'huu.phuoc', 'T06', 1),
(47, 'phamthanh.nhan', 'T06', 1),
(48, 'nguyenthanh.hue', 'T06', 1),
(49, 'nguyen.vy', 'T06', 1),
(50, 'phamkim.tuyen', 'T06', 1),
(51, 'nguyenhong.tra', 'T06', 1),
(52, 'nguyenminh.nhi', 'T06', 1),
(53, 'truong.giang', 'T07', 1),
(54, 'nguyen.hai', 'T07', 1),
(55, 'pham.huu', 'T07', 1),
(56, 'nguyen.nhat', 'T07', 1),
(57, 'tran.khiem', 'T07', 1),
(58, 'huu.phuoc', 'T07', 1),
(59, 'phamthanh.nhan', 'T07', 1),
(60, 'nguyenthanh.hue', 'T07', 1),
(61, 'nguyen.vy', 'T07', 1),
(62, 'phamkim.tuyen', 'T07', 1),
(63, 'nguyenhong.tra', 'T07', 1),
(64, 'nguyenminh.nhi', 'T07', 1),
(65, 'truong.giang', 'T08', 1),
(66, 'nguyen.hai', 'T08', 0),
(67, 'pham.huu', 'T08', 1),
(68, 'nguyen.nhat', 'T08', 0),
(69, 'tran.khiem', 'T08', 1),
(70, 'huu.phuoc', 'T08', 0),
(71, 'phamthanh.nhan', 'T08', 1),
(72, 'nguyenthanh.hue', 'T08', 1),
(73, 'nguyen.vy', 'T08', 1),
(74, 'phamkim.tuyen', 'T08', 1),
(75, 'nguyenhong.tra', 'T08', 1),
(76, 'nguyenminh.nhi', 'T08', 1);

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
(1, 'Eathorne', 'Banda', 'eathorne@yahoo.com', '2021-08-10 19:08:58', 'eathorne.banda', 'female', 'admin', '$2y$10$XPYp4iXx2tHqkiphe1D.fepUw.TW1PYjYDkMGMY0p4MDLcvCaEZoS', ''),
(3, 'John', 'Tembo', 'john@yahoo.com', '2021-08-18 14:43:04', 'john.tembo', 'male', 'admin', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', ''),
(8, 'Guy', 'Dude', 'guy@yahoo.com', '2021-08-21 18:26:48', 'guy.dude', 'male', 'student', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', 'uploads/1641706176_images.jpg'),
(9, 'Đặng', 'Trường Giang', 'dtgiang@gmail.com', '2021-12-08 10:10:33', 'truong.giang', 'male', 'student', '$2y$10$XPYp4iXx2tHqkiphe1D.fepUw.TW1PYjYDkMGMY0p4MDLcvCaEZoS', ''),
(10, 'Nguyễn', 'Hải', 'nguyenhai@gmail.com', '2021-11-15 10:10:33', 'nguyen.hai', 'male', 'student', '$2y$10$XPYp4iXx2tHqkiphe1D.fepUw.TW1PYjYDkMGMY0p4MDLcvCaEZoS', ''),
(11, 'Phạm', 'Hữu', 'phamhuu@gmail.com', '2021-11-10 10:14:49', 'pham.huu', 'male', 'student', '$2y$10$XPYp4iXx2tHqkiphe1D.fepUw.TW1PYjYDkMGMY0p4MDLcvCaEZoS', ''),
(12, 'Nguyễn', 'Nhật', 'nguyennhat@gmail.com', '2021-12-01 10:14:49', 'nguyen.nhat', 'male', 'student', '$2y$10$XPYp4iXx2tHqkiphe1D.fepUw.TW1PYjYDkMGMY0p4MDLcvCaEZoS', ''),
(13, 'Trần', 'Khiêm', 'trankhiem@gmail.com', '2021-09-07 10:22:30', 'tran.khiem', 'male', 'student', '$2y$10$XPYp4iXx2tHqkiphe1D.fepUw.TW1PYjYDkMGMY0p4MDLcvCaEZoS', ''),
(14, 'Phạm', 'Hữu Phước', 'huuphuoc@gmail.com', '2021-11-09 10:22:30', 'huu.phuoc', 'male', 'student', '$2y$10$XPYp4iXx2tHqkiphe1D.fepUw.TW1PYjYDkMGMY0p4MDLcvCaEZoS', ''),
(18, 'Phạm Thanh', 'Nhàn', 'thanhnhan@gmail.com', '2022-02-23 04:27:32', 'phamthanh.nhan', 'female', 'student', '$2y$10$o4vC2hyov5Ij9Ea9Co7MaOXlnPBItsTHTVdckKKGn2zkgQM8Jcx4m', ''),
(19, 'Nguyễn Thanh', 'Huê', 'thanhhue@gmail.com', '2022-02-23 04:29:03', 'nguyenthanh.hue', 'female', 'student', '$2y$10$WrSDtY.TPktZxyUVRaDK5OU9v2jwSWGJ5NVmzR8t1tx34hY6yjdAK', ''),
(20, 'Nguyễn', 'Vy', 'nguyenvy@gmail.com', '2022-02-23 04:31:33', 'nguyen.vy', 'female', 'student', '$2y$10$5QbCWWK04mKqhbE2YrxfzOT0TiAenU8VlbVSx.TBMXIMPBFQPgthS', ''),
(21, 'Phạm Kim', 'Tuyến', 'kimtuyen@gmail.com', '2022-02-23 04:33:03', 'phamkim.tuyen', 'female', 'student', '$2y$10$iBwJITFqet8nNaXa4REzDuUnIirlb1Q2YqGEbx6sGm0Q4h9g3Urpm', ''),
(22, 'Nguyễn Hồng', 'Trà', 'hongtra@gmail.com', '2022-02-23 04:33:58', 'nguyenhong.tra', 'female', 'student', '$2y$10$ZJ73JOq/tf.NIj1.goLCsegHiEiqfv0aaiwRmBaD9hJqKHAmmoaHG', ''),
(23, 'Nguyễn Minh', 'Nhi', 'minhnhi@gmail.com', '2022-02-23 04:34:47', 'nguyenminh.nhi', 'female', 'student', '$2y$10$Kr5hEuLe0UA4mmKmyt/eG.pjOs6sBRVC80cu.SkutloAtBWG2.nbG', ''),
(24, 'Trần', 'Anh', 'trananh@gmail.com', '2022-02-23 04:36:05', 'tran.anh', 'male', 'lecturer', '$2y$10$i.HnYMw5yFbuSzVvNjYQvuGUUPIO2eipO5yzyu2Jz.RyCvNmC6yyi', ''),
(25, 'Hữu', 'Nghĩa', 'huunghia@gmail.com', '2022-02-23 04:37:24', 'huu.nghia', 'male', 'lecturer', '$2y$10$q7isPap4r5fqecVeFXt72.Q6oqb6w0f.mKi8v3ZStwboU5y6v29.G', ''),
(26, 'Nguyễn', 'Tiên', 'nguyentien@gmail.com', '2022-02-23 04:38:31', 'nguyen.tien', 'female', 'lecturer', '$2y$10$Jjo2reLNg1W4UUlh6pun9erBVzE6xvTfFdj5XKu8ObWBsF9IeJoWG', ''),
(27, 'Phạm', 'Tuấn', 'phamtuan@gmail.com', '2022-02-23 04:40:05', 'pham.tuan', 'male', 'lecturer', '$2y$10$bfsm18Htfmom39aQVE6EIO8w2DTuJqxcIWYuZatMncI416VW6O2E.', ''),
(28, 'Yến', 'Trâm', 'yentram@gmail.com', '2022-02-23 04:40:43', 'yen.tram', 'female', 'lecturer', '$2y$10$GyZmk1iMuBQciJXezdRoRuhWaqbxMvKKp33vhLwbY7d3oNT0hCEXm', ''),
(29, 'Nguyễn', 'Phúc', 'nguyenphuc@gmail.com', '2022-02-23 06:05:29', 'nguyen.phuc', 'male', 'lecturer', '$2y$10$clt.2/VdeE33zyxW3DrNxOQ9PJb3YEIm/rP8mSsQo8UP3TRn8XXy.', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic` (`topic`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topic_lecturers`
--
ALTER TABLE `topic_lecturers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topic_students`
--
ALTER TABLE `topic_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `topic_id` (`topic_id`);

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
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `topic_lecturers`
--
ALTER TABLE `topic_lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `topic_students`
--
ALTER TABLE `topic_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
