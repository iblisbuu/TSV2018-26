-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2018 at 11:59 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinhvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE IF NOT EXISTS `sinhvien` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `dob` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `name`, `class`, `dob`) VALUES
(1, 'Phạm Hoài An', 'DI1496A1', '1996-01-01 00:00:00'),
(2, 'Trần Tân Định', 'DI1496A1', '1996-01-01 00:00:00'),
(3, 'Trương Tú Oanh', 'DI1496A1', '1996-01-01 00:00:00'),
(4, 'Lê Minh Luân', 'DI1496A1', '1996-01-01 00:00:00'),
(5, 'Nguyễn Tấn Phát', 'DI1496A1', '1996-01-01 00:00:00'),
(6, 'Trịnh Văn Linh', 'DI1496A1', '1996-01-01 00:00:00'),
(7, 'Huỳnh Hoàng Thơ', 'DI1496A1', '1996-01-01 00:00:00'),
(8, 'Trần Đăng Tiến', 'DI1496A1', '1996-01-01 00:00:00'),
(9, 'Võ Thành Trung', 'DI1496A1', '1996-01-01 00:00:00'),
(10, 'Trương Vũ Trường', 'DI1496A1', '1996-01-01 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
