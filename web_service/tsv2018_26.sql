-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th7 03, 2018 lúc 11:03 AM
-- Phiên bản máy phục vụ: 8.0.11
-- Phiên bản PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tsv2018_26`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cards`
--

CREATE TABLE `cards` (
  `id_Card` varchar(12) NOT NULL,
  `id_member` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cards`
--

INSERT INTO `cards` (`id_Card`, `id_member`) VALUES
('0070155406', '000042'),
('0070151006', '002555'),
('0070158406', 'B1400702');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `id_member` varchar(8) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT '0',
  `isService` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`id_member`, `balance`, `isService`) VALUES
('000042', 50000, '0'),
('002555', 100000, '1'),
('B1400702', 50000, '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_pay_member` varchar(8) NOT NULL,
  `id_collect_member` varchar(8) NOT NULL,
  `amountofmoney` int(11) NOT NULL,
  `type_payment` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`date_time`, `id_pay_member`, `id_collect_member`, `amountofmoney`, `type_payment`) VALUES
('2018-07-03 03:47:45', 'B1400702', '002555', 20000, '2'),
('2018-07-03 03:48:36', 'B1400702', '002555', 20000, '2'),
('2018-07-03 03:48:37', 'B1400702', '002555', 20000, '2'),
('2018-07-03 08:52:16', '002555', 'B1400702', 20000, '2'),
('2018-07-03 08:54:52', '002555', 'B1400702', 20000, '1'),
('2018-07-03 09:00:49', '002555', 'B1400702', 20000, '1'),
('2018-07-03 09:01:53', '002555', 'B1400702', 100000, '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `name`, `class`, `dob`) VALUES
(1, 'Phạm Hoài An', 'DI1496A1', '1996-01-01 00:00:00'),
(2, 'Nguyễn Tấn Cường', 'DI1496A1', '1996-03-26 00:00:00'),
(4, 'Lê Minh Luân', 'DI1496A1', '1996-01-01 00:00:00'),
(5, 'Nguyễn Tấn Phát', 'DI1496A1', '1996-01-01 00:00:00'),
(6, 'Trịnh Văn Linh', 'DI1496A1', '1996-01-01 00:00:00'),
(7, 'Huỳnh Hoàng Thơ', 'DI1496A1', '1996-01-01 00:00:00'),
(8, 'Trần Đăng Tiến', 'DI1496A1', '1996-01-01 00:00:00'),
(9, 'Võ Thành Trung', 'DI1496A1', '1996-01-01 00:00:00'),
(10, 'Trương Vũ Trường', 'DI1496A1', '1996-01-01 00:00:00'),
(11, 'Vũ Trúc Quân', 'DI1496A1', '1995-03-26 00:00:00'),
(12, 'Vũ Trúc Quân', 'DI1496A1', '1995-03-26 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id_Card`),
  ADD KEY `id_member` (`id_member`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`date_time`,`id_pay_member`),
  ADD KEY `id_pay_member` (`id_pay_member`),
  ADD KEY `id_collect_member` (`id_collect_member`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`id_pay_member`) REFERENCES `members` (`id_member`) ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`id_collect_member`) REFERENCES `members` (`id_member`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
