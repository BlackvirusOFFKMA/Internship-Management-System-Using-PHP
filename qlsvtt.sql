-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2021 at 08:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

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
  `TenDT` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `giangvienhdtt`
--

CREATE TABLE `giangvienhdtt` (
  `MaGV` char(10) NOT NULL,
  `TenGV` char(50) NOT NULL,
  `GioiTinh` char(3) NOT NULL,
  `NgaySinh` date NOT NULL,
  `SDT` char(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `DiaChi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `khoahoc`
--

CREATE TABLE `khoahoc` (
  `MaKH` char(10) NOT NULL,
  `NamBD` year(4) NOT NULL,
  `NamKT` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `MaLop` char(10) NOT NULL,
  `TenLop` varchar(30) NOT NULL,
  `MaKH` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nhomtt`
--

CREATE TABLE `nhomtt` (
  `MaNhom` char(10) NOT NULL,
  `MaGV` char(10) NOT NULL,
  `MaSV` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MaSV` char(10) NOT NULL,
  `TenSV` varchar(50) NOT NULL,
  `GioiTinh` char(3) NOT NULL,
  `NgaySinh` date NOT NULL,
  `SDT` char(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `DiaChi` varchar(50) NOT NULL,
  `MaLop` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `thongtindt`
--

CREATE TABLE `thongtindt` (
  `MaDT` char(10) NOT NULL,
  `MaSV` char(10) NOT NULL,
  `MaGV` char(10) NOT NULL,
  `LoaiHinhTT` varchar(15) NOT NULL,
  `ThoiGianDB` date NOT NULL,
  `ThoiGianKetThuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bangdiemtt`
--
ALTER TABLE `bangdiemtt`
  ADD PRIMARY KEY (`MaDT`),
  ADD KEY `fk_masv_bangdiemtt` (`MaSV`);

--
-- Indexes for table `detai`
--
ALTER TABLE `detai`
  ADD PRIMARY KEY (`MaDT`);

--
-- Indexes for table `giangvienhdtt`
--
ALTER TABLE `giangvienhdtt`
  ADD PRIMARY KEY (`MaGV`);

--
-- Indexes for table `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD PRIMARY KEY (`MaKH`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`MaLop`),
  ADD KEY `fk_makh` (`MaKH`);

--
-- Indexes for table `nhomtt`
--
ALTER TABLE `nhomtt`
  ADD PRIMARY KEY (`MaNhom`),
  ADD KEY `fk_magv_nhomtt` (`MaGV`),
  ADD KEY `fk_masv_nhomtt` (`MaSV`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MaSV`),
  ADD KEY `fk_malop` (`MaLop`);

--
-- Indexes for table `thongtindt`
--
ALTER TABLE `thongtindt`
  ADD PRIMARY KEY (`MaDT`),
  ADD KEY `fk_magv_thongtindt` (`MaGV`),
  ADD KEY `fk_masv_thontindt` (`MaSV`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bangdiemtt`
--
ALTER TABLE `bangdiemtt`
  ADD CONSTRAINT `fk_madt_bangdiemtt` FOREIGN KEY (`MaDT`) REFERENCES `detai` (`MaDT`),
  ADD CONSTRAINT `fk_masv_bangdiemtt` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `fk_makh` FOREIGN KEY (`MaKH`) REFERENCES `khoahoc` (`MaKH`);

--
-- Constraints for table `nhomtt`
--
ALTER TABLE `nhomtt`
  ADD CONSTRAINT `fk_magv_nhomtt` FOREIGN KEY (`MaGV`) REFERENCES `giangvienhdtt` (`MaGV`),
  ADD CONSTRAINT `fk_masv_nhomtt` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `fk_malop` FOREIGN KEY (`MaLop`) REFERENCES `lop` (`MaLop`);

--
-- Constraints for table `thongtindt`
--
ALTER TABLE `thongtindt`
  ADD CONSTRAINT `fk_madt_thongtindt` FOREIGN KEY (`MaDT`) REFERENCES `detai` (`MaDT`),
  ADD CONSTRAINT `fk_magv_thongtindt` FOREIGN KEY (`MaGV`) REFERENCES `giangvienhdtt` (`MaGV`),
  ADD CONSTRAINT `fk_masv_thontindt` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
