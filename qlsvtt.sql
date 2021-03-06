-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2022 at 07:17 PM
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
('', 'l??.ngh??a', 0, ''),
('DT05', 'maitruong.giang', 8, ''),
('', 'nguyen.hai', 0, ''),
('', 'nguyen.nhat', 0, ''),
('', 'nguyen.vy', 0, ''),
('', 'nguyenhong.tra', 0, ''),
('', 'nguyenminh.nhi', 0, ''),
('', 'nguyenthanh.hue', 0, ''),
('', 'phamhuu.nam', 0, ''),
('', 'phamhuu.phuoc', 0, ''),
('', 'phamkim.tuyen', 0, ''),
('', 'phamminh.anh', 0, ''),
('', 'phamthanh.nhan', 0, ''),
('', 'tran.khiem', 0, ''),
('', 'tranvan.an', 0, '');

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
  `members` tinyint(10) NOT NULL,
  `disabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic`, `user_id`, `topic_id`, `create_date`, `date_submit`, `members`, `disabled`) VALUES
(1, 'Phát hiện mã đọc Android dựa trên lời gọi API', 'tran.anh', 'DT01', '2022-01-01', '2022-02-28', 2, 0),
(2, 'Nhận dạng khuôn mặt dựa trên Deep Learning ', 'huu.nghia', 'DT02', '2022-01-01', '2022-02-02', 3, 0),
(4, 'Phát triển Website quản lý đồ án tốt nghiệp ', 'nguyen.tien', 'DT03', '2022-01-01', '2022-03-23', 2, 0),
(5, 'Xây dựng Website Quản lý thực tập khoa CNTT', 'pham.tuan', 'DT04', '2022-01-01', '2022-03-18', 3, 0),
(6, 'Xây dựng ứng dụng Web chat', 'yen.tram', 'DT05', '2022-01-01', '2022-04-26', 4, 0),
(7, 'Xây dựng hệ thống quản lý lớp học online', 'nguyen.phuc', 'DT06', '2022-01-01', '2022-05-04', 3, 0);

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
(96, 'maitruong.giang', 'DT01', 0);

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
(3, 'Phát', 'Đạt', 'admin@gmail.com', '2021-08-18 14:43:04', 'phat.dat', 'male', 'admin', '$2y$10$M7pc9tdHmCmHGgbhhl3zvOER1ozNSYetE6Gv23Yim0GhE2XFqvwgS', 'uploads/1647540818_images.jpg'),
(24, 'Trần', 'Anh', 'lecturer@gmail.com', '2022-02-23 04:36:05', 'tran.anh', 'male', 'lecturer', '$2y$10$i.HnYMw5yFbuSzVvNjYQvuGUUPIO2eipO5yzyu2Jz.RyCvNmC6yyi', ''),
(25, 'Hữu', 'Nghĩa', 'huunghia@gmail.com', '2022-02-23 04:37:24', 'huu.nghia', 'male', 'lecturer', '$2y$10$q7isPap4r5fqecVeFXt72.Q6oqb6w0f.mKi8v3ZStwboU5y6v29.G', ''),
(26, 'Nguyễn', 'Tiên', 'nguyentien@gmail.com', '2022-02-23 04:38:31', 'nguyen.tien', 'female', 'lecturer', '$2y$10$Jjo2reLNg1W4UUlh6pun9erBVzE6xvTfFdj5XKu8ObWBsF9IeJoWG', 'uploads/1647540938_download.jpg'),
(27, 'Phạm', 'Tuấn', 'phamtuan@gmail.com', '2022-02-23 04:40:05', 'pham.tuan', 'male', 'lecturer', '$2y$10$bfsm18Htfmom39aQVE6EIO8w2DTuJqxcIWYuZatMncI416VW6O2E.', 'uploads/1647540924_images (2).jpg'),
(28, 'Yến', 'Trâm', 'yentram@gmail.com', '2022-02-23 04:40:43', 'yen.tram', 'female', 'lecturer', '$2y$10$GyZmk1iMuBQciJXezdRoRuhWaqbxMvKKp33vhLwbY7d3oNT0hCEXm', ''),
(29, 'Nguyễn', 'Phúc', 'nguyenphuc@gmail.com', '2022-02-23 06:05:29', 'nguyen.phuc', 'male', 'lecturer', '$2y$10$clt.2/VdeE33zyxW3DrNxOQ9PJb3YEIm/rP8mSsQo8UP3TRn8XXy.', 'uploads/1647540905_images (1).jpg'),
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
(41, 'Nguyễn Minh', 'Nhi', 'minhnhi@gmail.com', '2022-02-23 13:25:12', 'nguyenminh.nhi', 'female', 'student', '$2y$10$BTQF6GJLXS8lCQ1K/5ZCo.00bHsqRkgUPy5p12QGGctRXZZm.3NCK', 'uploads/1647540889_images (3).jpg'),
(42, 'Phạm Minh', 'Anh', 'phamanh@gmail.com', '2022-02-23 13:37:14', 'phamminh.anh', 'female', 'student', '$2y$10$S/LHc9XSRY9uU24eCcGtseTEgeaRSWJn6Ug9HCW40feIDsRdbJHBi', 'uploads/1647540847_download.jpg'),
(43, 'Trần Văn', 'An', 'tranan@gmail.com', '2022-02-23 13:37:48', 'tranvan.an', 'male', 'student', '$2y$10$XRxTU6Hd68NsliHbd9gtTuJn0KVysqmOB.HXDQmUoUr9l4nolqWNO', 'uploads/1647540871_download (1).jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `topic_students`
--
ALTER TABLE `topic_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
