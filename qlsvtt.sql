-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2022 at 06:13 AM
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
('DT05', 'maitruong.giang', 6, ''),
('DT02', 'nguyen.hai', 0, ''),
('DT06', 'nguyen.nhat', 8, ''),
('', 'nguyen.v??na', 0, ''),
('DT03', 'nguyen.vy', 0, ''),
('DT02', 'nguyenhong.tra', 9, ''),
('DT02', 'nguyenminh.nhi', 0, ''),
('DT04', 'nguyenthanh.hue', 7, ''),
('', 'nguyenv??n.anh', 0, ''),
('DT06', 'phamhuu.nam', 0, ''),
('DT05', 'phamhuu.phuoc', 0, ''),
('DT03', 'phamkim.tuyen', 0, ''),
('DT01', 'phamminh.anh', 0, ''),
('DT04', 'phamthanh.nhan', 0, ''),
('DT05', 'tran.khiem', 0, ''),
('', 'trananh.khoa', 0, ''),
('DT02', 'tranvan.an', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `topic_id` varchar(60) NOT NULL,
  `create_date` date NOT NULL,
  `date_submit` date NOT NULL,
  `members` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic`, `user_id`, `topic_id`, `create_date`, `date_submit`, `members`) VALUES
(1, 'Phát hiện mã đọc Android dựa trên lời gọi API', 'trong.hoang', 'DT01', '2022-01-01', '2022-02-28', 2),
(2, 'Nhận dạng khuôn mặt dựa trên Deep Learning ', 'trong.hoang', 'DT02', '2022-01-01', '2022-02-02', 2),
(4, 'Phát triển Website quản lý đồ án tốt nghiệp ', 'trong.hoang', 'DT03', '2022-01-01', '2022-03-23', 2),
(5, 'Xây dựng Website Quản lý thực tập khoa CNTT', 'trong.hoang', 'DT04', '2022-01-01', '2022-03-18', 0),
(6, 'Xây dựng ứng dụng Web chat', 'trong.hoang', 'DT05', '2022-01-01', '2022-04-26', 4),
(7, 'Xây dựng hệ thống quản lý lớp học online', 'trong.hoang', 'DT06', '2022-01-01', '2022-05-04', 1),
(8, 'Tìm hiểu và thử nghiệm nền tảng Blockchain', 'trong.hoang', 'DT07', '2022-01-01', '2023-01-07', 0),
(9, 'Nghiên cứu, việt hóa và triển khai thử nghiệm phần mềm', 'trong.hoang', 'DT08', '2022-01-01', '2023-02-17', 0);

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
(54, 'tran.anh', 'DT01', 0),
(55, 'huu.nghia', 'DT02', 0),
(56, 'nguyen.tien', 'DT03', 0),
(57, 'pham.tuan', 'DT04', 0),
(58, 'yen.tram', 'DT05', 0),
(59, 'nguyen.phuc', 'DT06', 0);

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
(77, 'tranvan.an', 'DT01', 0),
(78, 'phamminh.anh', 'DT01', 0),
(79, 'nguyenminh.nhi', 'DT02', 0),
(80, 'nguyenhong.tra', 'DT02', 0),
(81, 'phamkim.tuyen', 'DT03', 0),
(82, 'nguyen.vy', 'DT03', 0),
(83, 'nguyenthanh.hue', 'DT04', 0),
(84, 'phamthanh.nhan', 'DT04', 0),
(85, 'phamhuu.phuoc', 'DT05', 0),
(86, 'tran.khiem', 'DT05', 0),
(87, 'nguyen.nhat', 'DT06', 0),
(88, 'phamhuu.nam', 'DT06', 0),
(89, 'nguyen.hai', 'DT02', 0),
(90, 'maitruong.giang', 'DT05', 0),
(91, 'tranvan.an', 'DT02', 1);

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
(1, 'Trọng', 'Hoàng', 'tronghoang@gmail.com', '2021-08-10 19:08:58', 'trong.hoang', 'male', 'admin', '$2y$10$XPYp4iXx2tHqkiphe1D.fepUw.TW1PYjYDkMGMY0p4MDLcvCaEZoS', ''),
(3, 'Phát', 'Đạt', 'admin@gmail.com', '2021-08-18 14:43:04', 'phat.dat', 'male', 'admin', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', ''),
(24, 'Trần', 'Anh', 'lecturer@gmail.com', '2022-02-23 04:36:05', 'tran.anh', 'male', 'lecturer', '$2y$10$i.HnYMw5yFbuSzVvNjYQvuGUUPIO2eipO5yzyu2Jz.RyCvNmC6yyi', ''),
(25, 'Hữu', 'Nghĩa', 'huunghia@gmail.com', '2022-02-23 04:37:24', 'huu.nghia', 'male', 'lecturer', '$2y$10$q7isPap4r5fqecVeFXt72.Q6oqb6w0f.mKi8v3ZStwboU5y6v29.G', ''),
(26, 'Nguyễn', 'Tiên', 'nguyentien@gmail.com', '2022-02-23 04:38:31', 'nguyen.tien', 'female', 'lecturer', '$2y$10$Jjo2reLNg1W4UUlh6pun9erBVzE6xvTfFdj5XKu8ObWBsF9IeJoWG', ''),
(27, 'Phạm', 'Tuấn', 'phamtuan@gmail.com', '2022-02-23 04:40:05', 'pham.tuan', 'male', 'lecturer', '$2y$10$bfsm18Htfmom39aQVE6EIO8w2DTuJqxcIWYuZatMncI416VW6O2E.', ''),
(28, 'Yến', 'Trâm', 'yentram@gmail.com', '2022-02-23 04:40:43', 'yen.tram', 'female', 'lecturer', '$2y$10$GyZmk1iMuBQciJXezdRoRuhWaqbxMvKKp33vhLwbY7d3oNT0hCEXm', ''),
(29, 'Nguyễn', 'Phúc', 'nguyenphuc@gmail.com', '2022-02-23 06:05:29', 'nguyen.phuc', 'male', 'lecturer', '$2y$10$clt.2/VdeE33zyxW3DrNxOQ9PJb3YEIm/rP8mSsQo8UP3TRn8XXy.', ''),
(30, 'Mai Trường', 'Giang', 'student@gmail.com', '2022-02-23 13:20:35', 'maitruong.giang', 'male', 'student', '$2y$10$76jJG3ChfHEL2nagejNSOubnri.ilNWl1i3m6O6b2e0SdGZI7xZe.', ''),
(31, 'Nguyễn', 'Hải', 'nguyenhai@gmail.com', '2022-02-23 13:20:57', 'nguyen.hai', 'male', 'student', '$2y$10$GHQ1jDlMDr4XtWs8RNUwDu/NMcFGbZOIs4HYosxpp7UOGz06Oi2T.', ''),
(32, 'Phạm Hữu', 'Nam', 'phamhnam@gmail.com', '2022-02-23 13:21:24', 'phamhuu.nam', 'male', 'student', '$2y$10$96ByOZXHBcDG3zomBMb8a.qBtgts4FFWRVTA8Gnn8StlxyeXJEbMy', ''),
(33, 'Nguyễn', 'Nhật', 'nguyennhat@gmail.com', '2022-02-23 13:21:51', 'nguyen.nhat', 'male', 'student', '$2y$10$80CgcUdHo6AvfqwlU0pw2OS9aqowEga/PIzaZexFzQLOzQbk1Peou', ''),
(34, 'Trần', 'Khiêm', 'trankhiem@gmail.com', '2022-02-23 13:22:17', 'tran.khiem', 'male', 'student', '$2y$10$QjN3n5DE07Dz/tnCwOxOReU4NF9VHUqxHSuWWlXXbafZhIsL1N.J2', ''),
(35, 'Phạm Hữu', 'Phước', 'huuphuoc@gmail.com', '2022-02-23 13:22:37', 'phamhuu.phuoc', 'male', 'student', '$2y$10$i4aGAkeRt6UgyDqHGSwr6OjatvOt6pLeiMr7P7AZ2/T/qXodnp48i', ''),
(36, 'Phạm Thanh', 'Nhàn', 'thanhnhan@gmail.com', '2022-02-23 13:23:01', 'phamthanh.nhan', 'female', 'student', '$2y$10$9PpELSLAiFVztMPEsYu1r.5Iyh8r290C8t1WeZv9xoj0sE2HKHGya', ''),
(37, 'Nguyễn Thanh', 'Huê', 'thanhhue@gmail.com', '2022-02-23 13:23:28', 'nguyenthanh.hue', 'female', 'student', '$2y$10$JisMev0LJpE7wSvdx4bFMuAsds2.aUicn2./GEUZHLY6IL5Q86MZG', ''),
(38, 'Nguyễn', 'Vy', 'nguyenvy@gmail.com', '2022-02-23 13:23:44', 'nguyen.vy', 'female', 'student', '$2y$10$/7JpdE6AURTSdmVwlWH0cuueW3Ig7F06ggaWNoUlUP9x49RDQf83O', ''),
(39, 'Phạm Kim', 'Tuyến', 'phamtuyen@gmail.com', '2022-02-23 13:24:17', 'phamkim.tuyen', 'female', 'student', '$2y$10$B5cK23bvJtTliYBpkSo2ie4KpFuK3EsfqR/FT4bIwUrvgOSbcV3he', ''),
(40, 'Nguyễn Hồng', 'Trà', 'hongtra@gmail.com', '2022-02-23 13:24:55', 'nguyenhong.tra', 'male', 'student', '$2y$10$I5rdhuj8oN2PmfYNSfDUXOjP5l4YXz.kMGrGlKyHCFVkAjceTVgm6', ''),
(41, 'Nguyễn Minh', 'Nhi', 'minhnhi@gmail.com', '2022-02-23 13:25:12', 'nguyenminh.nhi', 'female', 'student', '$2y$10$BTQF6GJLXS8lCQ1K/5ZCo.00bHsqRkgUPy5p12QGGctRXZZm.3NCK', ''),
(42, 'Phạm Minh', 'Anh', 'phamanh@gmail.com', '2022-02-23 13:37:14', 'phamminh.anh', 'female', 'student', '$2y$10$S/LHc9XSRY9uU24eCcGtseTEgeaRSWJn6Ug9HCW40feIDsRdbJHBi', ''),
(43, 'Trần Văn', 'An', 'tranan@gmail.com', '2022-02-23 13:37:48', 'tranvan.an', 'male', 'student', '$2y$10$XRxTU6Hd68NsliHbd9gtTuJn0KVysqmOB.HXDQmUoUr9l4nolqWNO', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `topic_lecturers`
--
ALTER TABLE `topic_lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `topic_students`
--
ALTER TABLE `topic_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
