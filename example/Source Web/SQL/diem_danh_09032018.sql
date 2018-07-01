-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 09, 2018 lúc 05:09 PM
-- Phiên bản máy phục vụ: 10.1.30-MariaDB
-- Phiên bản PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `diem_danh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_mon`
--

CREATE TABLE `bo_mon` (
  `ID_BO_MON` decimal(2,0) NOT NULL,
  `ID_KHOA` decimal(2,0) NOT NULL,
  `TEN_BO_MON` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_mon`
--

INSERT INTO `bo_mon` (`ID_BO_MON`, `ID_KHOA`, `TEN_BO_MON`) VALUES
('1', '2', 'Bô môn Công nghệ thông tin'),
('2', '2', 'Mạng máy tính và truyền thông'),
('3', '2', 'Khoa học máy tính');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuong_trinh_dao_tao`
--

CREATE TABLE `chuong_trinh_dao_tao` (
  `MA_MH` varchar(5) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ID_NGANH` decimal(3,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_sach_diem_danh`
--

CREATE TABLE `danh_sach_diem_danh` (
  `ID_LH` decimal(10,0) NOT NULL,
  `TAIKHOAN_USER` varchar(8) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `CHECK_DIEMDANH` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giao_vien`
--

CREATE TABLE `giao_vien` (
  `TAIKHOAN_USER` varchar(8) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ID_BO_MON` decimal(2,0) DEFAULT NULL,
  `ID_QUYEN` decimal(1,0) DEFAULT NULL,
  `PASSWORD_USER` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `HOTEN_USER` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MATHE_USER` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `HINH_USER` varchar(400) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `NGAY_SINH` date DEFAULT NULL,
  `GIOI_TINH` varchar(5) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `DIA_CHI` varchar(400) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `EMAIL` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `SO_DT` varchar(15) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `giao_vien`
--

INSERT INTO `giao_vien` (`TAIKHOAN_USER`, `ID_BO_MON`, `ID_QUYEN`, `PASSWORD_USER`, `HOTEN_USER`, `MATHE_USER`, `HINH_USER`, `NGAY_SINH`, `GIOI_TINH`, `DIA_CHI`, `EMAIL`, `SO_DT`) VALUES
('CB0001', '1', '2', '25d55ad283aa400af464c76d713c07ad', 'Nguyễn Ngọc Mỹ', 'Chưa có', 'cb0001.png', '1986-09-09', 'Nam', 'An Giang', 'nnmy@ctu.edu.vn', '0976727098'),
('CB0002', '2', '2', '25d55ad283aa400af464c76d713c07ad', 'Phạm Thế Phi', 'Chưa có', 'cb0002.png', '1980-01-01', 'Nam', 'Cần Thơ', 'ptphi@ctu.edu.vn', 'Không biết'),
('CB0003', '2', '2', '25d55ad283aa400af464c76d713c07ad', 'Lâm Nhựt Khang', 'Chưa có', NULL, '1980-11-11', 'Nữ', 'Cần Thơ', 'lnkhang@ctu.edu.vn', 'Không biết'),
('CB0004', '2', '2', '25d55ad283aa400af464c76d713c07ad', 'Bùi Minh Quân', 'Chưa có', NULL, '1980-01-01', 'Nam', 'Cần Thơ', 'bmquann@ctu.edu.vn', 'Không biết'),
('CB0005', '1', '2', '25d55ad283aa400af464c76d713c07ad', 'Trần Công Án', 'Chưa có', NULL, '1980-01-01', 'Nam', 'Cần Thơ', 'tcan@ctu.edu.vn', 'Không biết'),
('CB0006', '2', '2', '25d55ad283aa400af464c76d713c07ad', 'Ngô Bá Hùng', 'Chưa có', NULL, '1980-01-01', 'Nam', 'Cần Thơ', 'nbhung@ctu.edu.vn', 'Không biết'),
('CB0007', '2', '2', '25d55ad283aa400af464c76d713c07ad', 'Nguyễn Hữu Vân Long', 'Chưa có', NULL, '1980-01-01', 'Nam', 'Cần Thơ', 'nhvlong@ctu.edu.vn', 'Không có'),
('CB0008', '3', '2', '25d55ad283aa400af464c76d713c07ad', 'Trần Việt Châu', 'Chưa có', NULL, '1980-01-01', 'Nam', 'Cần Thơ', 'tvchau@ctu.edu.vn', 'Không biết');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocky_namhoc`
--

CREATE TABLE `hocky_namhoc` (
  `ID_HKNH` decimal(5,0) NOT NULL,
  `HOCKY` varchar(3) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `NAMHOC` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `NGAY_BD_HK` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hocky_namhoc`
--

INSERT INTO `hocky_namhoc` (`ID_HKNH`, `HOCKY`, `NAMHOC`, `NGAY_BD_HK`) VALUES
('1', '1', '2016-2017', NULL),
('2', '2', '2016-2017', NULL),
('3', 'Hè', '2016-2017', NULL),
('4', '1', '2017-2018', NULL),
('5', '2', '2017-2018', '2018-01-01'),
('6', 'Hè', '2017-2018', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa`
--

CREATE TABLE `khoa` (
  `ID_KHOA` decimal(2,0) NOT NULL,
  `TEN_KHOA` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa`
--

INSERT INTO `khoa` (`ID_KHOA`, `TEN_KHOA`) VALUES
('1', 'Khoa Công nghệ'),
('2', 'Khoa Công nghệ Thông tin và Truyền thông'),
('3', 'Khoa Dự bị Dân tộc'),
('4', 'Khoa Khoa học Chính trị'),
('5', 'Khoa Khoa học Tự nhiên'),
('6', 'Khoa Khoa học Xã hội & Nhân văn'),
('7', 'Khoa Kinh tế'),
('8', 'Khoa Luật'),
('9', 'Khoa Môi trường & Tài nguyên Thiên nhiên'),
('10', 'Khoa Ngoại ngữ'),
('11', 'Khoa Nông nghiệp & Sinh học Ứng dụng'),
('12', 'Khoa Phát triển Nông thôn'),
('13', 'Khoa Sau đại học'),
('14', 'Khoa Sư phạm'),
('15', 'Khoa Thủy sản'),
('16', 'Bộ môn Giáo dục Thể chất'),
('17', 'Viện Nghiên cứu Biến đổi Khí Hậu'),
('18', 'Viện Nghiên cứu Phát triển ĐBSCL'),
('19', 'Viện NC & Phát triển Công nghệ Sinh học'),
('20', 'Trường THPT Thực hành Sư phạm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_hoc`
--

CREATE TABLE `lich_hoc` (
  `ID_LH` decimal(10,0) NOT NULL,
  `ID_TUAN` decimal(2,0) DEFAULT NULL,
  `ID_TIET` decimal(2,0) DEFAULT NULL,
  `ID_PHONG` decimal(4,0) DEFAULT NULL,
  `ID_NHOM_HP` decimal(11,0) NOT NULL,
  `SO_TIET` decimal(1,0) DEFAULT NULL,
  `NGAY_HOC` date DEFAULT NULL,
  `THU` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lich_hoc`
--

INSERT INTO `lich_hoc` (`ID_LH`, `ID_TUAN`, `ID_TIET`, `ID_PHONG`, `ID_NHOM_HP`, `SO_TIET`, `NGAY_HOC`, `THU`) VALUES
('1', '1', '1', '8', '1', '3', '2018-01-04', 5),
('2', '2', '1', '8', '1', '3', '2018-01-11', 5),
('3', '3', '1', '8', '1', '3', '2018-01-18', 5),
('4', '4', '1', '8', '1', '3', '2018-01-25', 5),
('5', '5', '1', '8', '1', '3', '2018-02-01', 5),
('6', '6', '1', '8', '1', '3', '2018-02-08', 5),
('7', '9', '1', '8', '1', '3', '2018-03-01', 5),
('8', '10', '1', '8', '1', '3', '2018-03-08', 5),
('9', '11', '1', '8', '1', '3', '2018-03-15', 5),
('10', '12', '1', '8', '1', '3', '2018-03-22', 5),
('11', '13', '1', '8', '1', '3', '2018-03-29', 5),
('12', '14', '1', '8', '1', '3', '2018-04-05', 5),
('13', '15', '1', '8', '1', '3', '2018-04-12', 5),
('14', '16', '1', '8', '1', '3', '2018-04-19', 5),
('15', '17', '1', '8', '1', '3', '2018-04-26', 5),
('16', '18', '1', '8', '1', '3', '2018-05-03', 5),
('17', '1', '1', '9', '2', '3', '2018-01-01', 2),
('18', '2', '1', '9', '2', '3', '2018-01-08', 2),
('19', '3', '1', '9', '2', '3', '2018-01-15', 2),
('20', '4', '1', '9', '2', '3', '2018-01-22', 2),
('21', '5', '1', '9', '2', '3', '2018-01-29', 2),
('22', '6', '1', '9', '2', '3', '2018-02-05', 2),
('23', '9', '1', '9', '2', '3', '2018-02-26', 2),
('24', '10', '1', '9', '2', '3', '2018-03-05', 2),
('25', '11', '1', '9', '2', '3', '2018-03-12', 2),
('26', '12', '1', '9', '2', '3', '2018-03-19', 2),
('27', '13', '1', '9', '2', '3', '2018-03-26', 2),
('28', '14', '1', '9', '2', '3', '2018-04-02', 2),
('29', '15', '1', '9', '2', '3', '2018-04-09', 2),
('30', '16', '1', '9', '2', '3', '2018-04-16', 2),
('31', '17', '1', '9', '2', '3', '2018-04-23', 2),
('32', '18', '1', '9', '2', '3', '2018-04-30', 2),
('34', '1', '6', '7', '3', '3', '2018-01-03', 4),
('36', '2', '6', '7', '3', '3', '2018-01-10', 4),
('38', '3', '6', '7', '3', '3', '2018-01-17', 4),
('40', '4', '6', '7', '3', '3', '2018-01-24', 4),
('42', '5', '6', '7', '3', '3', '2018-01-31', 4),
('44', '6', '6', '7', '3', '3', '2018-02-07', 4),
('46', '9', '6', '7', '3', '3', '2018-02-28', 4),
('48', '10', '6', '7', '3', '3', '2018-03-07', 4),
('50', '11', '6', '7', '3', '3', '2018-03-14', 4),
('52', '12', '6', '7', '3', '3', '2018-03-21', 4),
('54', '13', '6', '7', '3', '3', '2018-03-28', 4),
('56', '14', '6', '7', '3', '3', '2018-04-04', 4),
('58', '15', '6', '7', '3', '3', '2018-04-11', 4),
('60', '16', '6', '7', '3', '3', '2018-04-18', 4),
('62', '17', '6', '7', '3', '3', '2018-04-25', 4),
('64', '18', '6', '7', '3', '3', '2018-05-02', 4),
('66', '1', '2', '7', '4', '3', '2018-01-03', 4),
('68', '2', '2', '7', '4', '3', '2018-01-10', 4),
('70', '3', '2', '7', '4', '3', '2018-01-17', 4),
('72', '4', '2', '7', '4', '3', '2018-01-24', 4),
('74', '5', '2', '7', '4', '3', '2018-01-31', 4),
('76', '6', '2', '7', '4', '3', '2018-02-07', 4),
('78', '9', '2', '7', '4', '3', '2018-02-28', 4),
('80', '10', '2', '7', '4', '3', '2018-03-07', 4),
('82', '11', '2', '7', '4', '3', '2018-03-14', 4),
('84', '12', '2', '7', '4', '3', '2018-03-21', 4),
('86', '13', '2', '7', '4', '3', '2018-03-28', 4),
('88', '14', '2', '7', '4', '3', '2018-04-04', 4),
('90', '15', '2', '7', '4', '3', '2018-04-11', 4),
('92', '16', '2', '7', '4', '3', '2018-04-18', 4),
('94', '17', '2', '7', '4', '3', '2018-04-25', 4),
('96', '18', '2', '7', '4', '3', '2018-05-02', 4),
('97', '2', '6', '9', '5', '3', '2018-01-08', 2),
('98', '3', '6', '9', '5', '3', '2018-01-15', 2),
('99', '4', '6', '9', '5', '3', '2018-01-22', 2),
('100', '5', '6', '9', '5', '3', '2018-01-29', 2),
('101', '6', '6', '9', '5', '3', '2018-02-05', 2),
('102', '9', '6', '9', '5', '3', '2018-02-26', 2),
('103', '10', '6', '9', '5', '3', '2018-03-05', 2),
('104', '11', '6', '9', '5', '3', '2018-03-12', 2),
('105', '12', '6', '9', '5', '3', '2018-03-19', 2),
('106', '13', '6', '9', '5', '3', '2018-03-26', 2),
('107', '14', '6', '9', '5', '3', '2018-04-02', 2),
('108', '15', '6', '9', '5', '3', '2018-04-09', 2),
('109', '16', '6', '9', '5', '3', '2018-04-16', 2),
('110', '17', '6', '9', '5', '3', '2018-04-23', 2),
('111', '18', '6', '9', '5', '3', '2018-04-30', 2),
('112', '1', '3', '10', '6', '3', '2018-01-01', 2),
('113', '2', '3', '10', '6', '3', '2018-01-08', 2),
('114', '3', '3', '10', '6', '3', '2018-01-15', 2),
('115', '4', '3', '10', '6', '3', '2018-01-22', 2),
('116', '5', '3', '10', '6', '3', '2018-01-29', 2),
('117', '6', '3', '10', '6', '3', '2018-02-05', 2),
('118', '9', '3', '10', '6', '3', '2018-02-26', 2),
('119', '10', '3', '10', '6', '3', '2018-03-05', 2),
('120', '11', '3', '10', '6', '3', '2018-03-12', 2),
('121', '12', '3', '10', '6', '3', '2018-03-19', 2),
('122', '13', '3', '10', '6', '3', '2018-03-26', 2),
('123', '14', '3', '10', '6', '3', '2018-04-02', 2),
('124', '15', '3', '10', '6', '3', '2018-04-09', 2),
('125', '16', '3', '10', '6', '3', '2018-04-16', 2),
('126', '17', '3', '10', '6', '3', '2018-04-23', 2),
('127', '18', '3', '10', '6', '3', '2018-04-30', 2),
('128', '1', '2', '7', '7', '3', '2018-01-02', 3),
('129', '2', '2', '7', '7', '3', '2018-01-09', 3),
('130', '3', '2', '7', '7', '3', '2018-01-16', 3),
('131', '4', '2', '7', '7', '3', '2018-01-23', 3),
('132', '5', '2', '7', '7', '3', '2018-01-30', 3),
('133', '6', '2', '7', '7', '3', '2018-02-06', 3),
('134', '9', '2', '7', '7', '3', '2018-02-27', 3),
('135', '10', '2', '7', '7', '3', '2018-03-06', 3),
('136', '11', '2', '7', '7', '3', '2018-03-13', 3),
('137', '12', '2', '7', '7', '3', '2018-03-20', 3),
('138', '13', '2', '7', '7', '3', '2018-03-27', 3),
('139', '14', '2', '7', '7', '3', '2018-04-03', 3),
('140', '15', '2', '7', '7', '3', '2018-04-10', 3),
('141', '16', '2', '7', '7', '3', '2018-04-17', 3),
('142', '17', '2', '7', '7', '3', '2018-04-24', 3),
('143', '18', '2', '7', '7', '3', '2018-05-01', 3),
('144', '1', '1', '10', '8', '3', '2018-01-04', 5),
('145', '2', '1', '10', '8', '3', '2018-01-11', 5),
('146', '3', '1', '10', '8', '3', '2018-01-18', 5),
('147', '4', '1', '10', '8', '3', '2018-01-25', 5),
('148', '5', '1', '10', '8', '3', '2018-02-01', 5),
('149', '6', '1', '10', '8', '3', '2018-02-08', 5),
('150', '9', '1', '10', '8', '3', '2018-03-01', 5),
('151', '10', '1', '10', '8', '3', '2018-03-08', 5),
('152', '11', '1', '10', '8', '3', '2018-03-15', 5),
('153', '12', '1', '10', '8', '3', '2018-03-22', 5),
('154', '13', '1', '10', '8', '3', '2018-03-29', 5),
('155', '14', '1', '10', '8', '3', '2018-04-05', 5),
('156', '15', '1', '10', '8', '3', '2018-04-12', 5),
('157', '16', '1', '10', '8', '3', '2018-04-19', 5),
('158', '17', '1', '10', '8', '3', '2018-04-26', 5),
('159', '18', '1', '10', '8', '3', '2018-05-03', 5),
('160', '1', '1', '11', '9', '3', '2018-01-01', 2),
('161', '2', '1', '11', '9', '3', '2018-01-08', 2),
('162', '3', '1', '11', '9', '3', '2018-01-15', 2),
('163', '4', '1', '11', '9', '3', '2018-01-22', 2),
('164', '5', '1', '11', '9', '3', '2018-01-29', 2),
('165', '6', '1', '11', '9', '3', '2018-02-05', 2),
('166', '9', '1', '11', '9', '3', '2018-02-26', 2),
('167', '10', '1', '11', '9', '3', '2018-03-05', 2),
('168', '11', '1', '11', '9', '3', '2018-03-12', 2),
('169', '12', '1', '11', '9', '3', '2018-03-19', 2),
('170', '13', '1', '11', '9', '3', '2018-03-26', 2),
('171', '14', '1', '11', '9', '3', '2018-04-02', 2),
('172', '15', '1', '11', '9', '3', '2018-04-09', 2),
('173', '16', '1', '11', '9', '3', '2018-04-16', 2),
('174', '17', '1', '11', '9', '3', '2018-04-23', 2),
('175', '18', '1', '11', '9', '3', '2018-04-30', 2),
('176', '1', '2', '6', '10', '3', '2018-01-05', 6),
('177', '2', '2', '6', '10', '3', '2018-01-12', 6),
('178', '3', '2', '6', '10', '3', '2018-01-19', 6),
('179', '4', '2', '6', '10', '3', '2018-01-26', 6),
('180', '5', '2', '6', '10', '3', '2018-02-02', 6),
('181', '6', '2', '6', '10', '3', '2018-02-09', 6),
('182', '9', '2', '6', '10', '3', '2018-03-02', 6),
('183', '10', '2', '6', '10', '3', '2018-03-09', 6),
('184', '11', '2', '6', '10', '3', '2018-03-16', 6),
('185', '12', '2', '6', '10', '3', '2018-03-23', 6),
('186', '13', '2', '6', '10', '3', '2018-03-30', 6),
('187', '14', '2', '6', '10', '3', '2018-04-06', 6),
('188', '15', '2', '6', '10', '3', '2018-04-13', 6),
('189', '16', '2', '6', '10', '3', '2018-04-20', 6),
('190', '17', '2', '6', '10', '3', '2018-04-27', 6),
('191', '18', '2', '6', '10', '3', '2018-05-04', 6),
('192', '1', '6', '7', '11', '3', '2018-01-05', 6),
('193', '2', '6', '7', '11', '3', '2018-01-12', 6),
('194', '3', '6', '7', '11', '3', '2018-01-19', 6),
('195', '4', '6', '7', '11', '3', '2018-01-26', 6),
('196', '5', '6', '7', '11', '3', '2018-02-02', 6),
('197', '6', '6', '7', '11', '3', '2018-02-09', 6),
('198', '9', '6', '7', '11', '3', '2018-03-02', 6),
('199', '10', '6', '7', '11', '3', '2018-03-09', 6),
('200', '11', '6', '7', '11', '3', '2018-03-16', 6),
('201', '12', '6', '7', '11', '3', '2018-03-23', 6),
('202', '13', '6', '7', '11', '3', '2018-03-30', 6),
('203', '14', '6', '7', '11', '3', '2018-04-06', 6),
('204', '15', '6', '7', '11', '3', '2018-04-13', 6),
('205', '16', '6', '7', '11', '3', '2018-04-20', 6),
('206', '17', '6', '7', '11', '3', '2018-04-27', 6),
('207', '18', '6', '7', '11', '3', '2018-05-04', 6),
('208', '1', NULL, NULL, '12', NULL, NULL, NULL),
('209', '2', NULL, NULL, '12', NULL, NULL, NULL),
('210', '3', NULL, NULL, '12', NULL, NULL, NULL),
('211', '4', NULL, NULL, '12', NULL, NULL, NULL),
('212', '5', NULL, NULL, '12', NULL, NULL, NULL),
('213', '6', NULL, NULL, '12', NULL, NULL, NULL),
('214', '9', NULL, NULL, '12', NULL, NULL, NULL),
('215', '10', NULL, NULL, '12', NULL, NULL, NULL),
('216', '11', NULL, NULL, '12', NULL, NULL, NULL),
('217', '12', NULL, NULL, '12', NULL, NULL, NULL),
('218', '13', NULL, NULL, '12', NULL, NULL, NULL),
('219', '14', NULL, NULL, '12', NULL, NULL, NULL),
('220', '15', NULL, NULL, '12', NULL, NULL, NULL),
('221', '16', NULL, NULL, '12', NULL, NULL, NULL),
('222', '17', NULL, NULL, '12', NULL, NULL, NULL),
('223', '18', NULL, NULL, '12', NULL, NULL, NULL),
('224', '1', NULL, NULL, '13', NULL, NULL, NULL),
('225', '2', NULL, NULL, '13', NULL, NULL, NULL),
('226', '3', NULL, NULL, '13', NULL, NULL, NULL),
('227', '4', NULL, NULL, '13', NULL, NULL, NULL),
('228', '5', NULL, NULL, '13', NULL, NULL, NULL),
('229', '6', NULL, NULL, '13', NULL, NULL, NULL),
('230', '9', NULL, NULL, '13', NULL, NULL, NULL),
('231', '10', NULL, NULL, '13', NULL, NULL, NULL),
('232', '11', NULL, NULL, '13', NULL, NULL, NULL),
('233', '12', NULL, NULL, '13', NULL, NULL, NULL),
('234', '13', NULL, NULL, '13', NULL, NULL, NULL),
('235', '14', NULL, NULL, '13', NULL, NULL, NULL),
('236', '15', NULL, NULL, '13', NULL, NULL, NULL),
('237', '16', NULL, NULL, '13', NULL, NULL, NULL),
('238', '17', NULL, NULL, '13', NULL, NULL, NULL),
('239', '18', NULL, NULL, '13', NULL, NULL, NULL),
('240', '1', NULL, NULL, '14', NULL, NULL, NULL),
('241', '2', NULL, NULL, '14', NULL, NULL, NULL),
('242', '3', NULL, NULL, '14', NULL, NULL, NULL),
('243', '4', NULL, NULL, '14', NULL, NULL, NULL),
('244', '5', NULL, NULL, '14', NULL, NULL, NULL),
('245', '6', NULL, NULL, '14', NULL, NULL, NULL),
('246', '9', NULL, NULL, '14', NULL, NULL, NULL),
('247', '10', NULL, NULL, '14', NULL, NULL, NULL),
('248', '11', NULL, NULL, '14', NULL, NULL, NULL),
('249', '12', NULL, NULL, '14', NULL, NULL, NULL),
('250', '13', NULL, NULL, '14', NULL, NULL, NULL),
('251', '14', NULL, NULL, '14', NULL, NULL, NULL),
('252', '15', NULL, NULL, '14', NULL, NULL, NULL),
('253', '16', NULL, NULL, '14', NULL, NULL, NULL),
('254', '17', NULL, NULL, '14', NULL, NULL, NULL),
('255', '18', NULL, NULL, '14', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `MA_LOP` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TAIKHOAN_USER` varchar(8) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TEN_LOP` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `KHOA` decimal(3,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon_hoc`
--

CREATE TABLE `mon_hoc` (
  `MA_MH` varchar(5) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TEN_MH` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `SO_TC` decimal(2,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `mon_hoc`
--

INSERT INTO `mon_hoc` (`MA_MH`, `TEN_MH`, `SO_TC`) VALUES
('CT101', 'Lập trình căn bản A', '4'),
('CT103', 'Cấu trúc dữ liệu', '4'),
('CT109', 'Phân tích và thiết kế hệ thống TT', '3'),
('CT112', 'Mạng máy tính', '3'),
('CT171', 'Nhập môn công nghệ phần mềm', '3'),
('CT172', 'Toán rời rạc', '4'),
('CT173', 'Kiến trúc máy tính', '3'),
('CT174', 'Phân tích và thiết kế thuật toán', '3'),
('CT175', 'Lý thuyết đồ thị', '3'),
('CT176', 'Lập trình hướng đối tượng', '3'),
('CT178', 'Nguyên lý hệ điều hành', '3'),
('CT179', 'Quản trị hệ thống', '3'),
('CT180', 'Cơ sở dữ liệu', '3'),
('CT183', 'Anh văn chuyên môn CNTT 1', '3'),
('CT184', 'Anh văn chuyên môn CNTT 2', '3'),
('CT187', 'Nền tảng công nghệ thông tin', '3'),
('CT202', 'Nguyên lý máy học', '3'),
('CT206', 'Phát triển Ứng dụng trên Linux', '3'),
('CT212', 'Quản trị mạng', '3'),
('CT221', 'Lập trình mạng', '3'),
('CT222', 'An toàn hệ thống', '3'),
('CT233', 'Điện toán đám mây', '3'),
('CT237', 'Nguyên lý hệ quản trị cơ sở dữ liệu', '3'),
('CT269', 'Hệ quản trị cơ sở dữ liệu Oracle', '2'),
('CT271', 'Niên luận cơ sở - CNTT', '3'),
('CT311', 'Phương pháp NCKH', '2'),
('CT332', 'Trí tuệ nhân tạo', '3'),
('CT335', 'Thiết kế và cài đặt mạng', '3'),
('CT428', 'Lập trình Web', '3'),
('CT450', 'Thực tập thực tế - CNTT', '2'),
('CT466', 'Niên luận - CNTT', '3'),
('CT593', 'Luận văn tốt nghiệp - CNTT', '10'),
('KL001', 'Pháp luật đại cương', '2'),
('ML006', 'Tư tưởng Hồ Chí Minh', '2'),
('ML009', 'Những nguyên lý cơ bản của chủ nghĩa Mác-Lênin 1', '2'),
('ML010', 'Những nguyên lý cơ bản của chủ nghĩa Mác-Lênin 2', '3'),
('ML011', 'Đường lối cách mạng của ĐCSVN', '3'),
('QP003', 'Giáo dục quốc phòng - An ninh 1 (*)', '3'),
('QP004', 'Giáo dục quốc phòng - An ninh 2 (*)', '2'),
('QP005', 'Giáo dục quốc phòng - An ninh 3 (*)', '3'),
('TC003', 'Taekwondo 1 (*)', '1'),
('TC004', 'Taekwondo 2 (*)', '1'),
('TC019', 'Taekwondo 3 (*)', '1'),
('TN001', 'Vi - Tích phân A1', '3'),
('TN002', 'Vi - Tích phân A2', '4'),
('TN010', 'Xác suất thống kê', '3'),
('TN012', 'Đại số tuyến tính và hình học', '4'),
('TN033', 'Tin học căn bản', '1'),
('TN034', 'TT. Tin học căn bản', '2'),
('XH011', 'Cơ sở văn hoá Việt Nam', '2'),
('XH023', 'Anh văn căn bản 1 (*)', '4'),
('XH024', 'Anh văn căn bản 2 (*)', '3'),
('XH025', 'Anh văn căn bản 3 (*)', '3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganh`
--

CREATE TABLE `nganh` (
  `ID_NGANH` decimal(3,0) NOT NULL,
  `TEN_NGANH` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nganh`
--

INSERT INTO `nganh` (`ID_NGANH`, `TEN_NGANH`) VALUES
('1', 'Công nghệ thông tin'),
('2', 'Kỹ thuật phần mềm'),
('3', 'Khoa học máy tính'),
('4', 'Hệ thống thông tin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganh_thuoc_khoa`
--

CREATE TABLE `nganh_thuoc_khoa` (
  `ID_NGANH` decimal(3,0) NOT NULL,
  `ID_KHOA` decimal(2,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nganh_thuoc_khoa`
--

INSERT INTO `nganh_thuoc_khoa` (`ID_NGANH`, `ID_KHOA`) VALUES
('1', '2'),
('1', '12'),
('2', '2'),
('3', '2'),
('4', '2'),
('4', '12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom_hp`
--

CREATE TABLE `nhom_hp` (
  `ID_NHOM_HP` decimal(11,0) NOT NULL,
  `MA_MH` varchar(5) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ID_HKNH` decimal(5,0) NOT NULL,
  `TAIKHOAN_USER` varchar(8) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MA_NHOM_HP` varchar(5) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `SISO_NHOM_HP` decimal(4,0) DEFAULT NULL,
  `SISO_TOIDA_NHOM_HP` decimal(4,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom_hp`
--

INSERT INTO `nhom_hp` (`ID_NHOM_HP`, `MA_MH`, `ID_HKNH`, `TAIKHOAN_USER`, `MA_NHOM_HP`, `SISO_NHOM_HP`, `SISO_TOIDA_NHOM_HP`) VALUES
('1', 'Ct335', '5', 'CB0007', '01', '0', '80'),
('2', 'CT335', '5', 'CB0007', '02', '0', '40'),
('3', 'CT335', '5', 'CB0007', 'H01', '0', '60'),
('4', 'CT335', '5', 'CB0007', 'H02', '0', '60'),
('5', 'CT212', '5', 'CB0004', '01', '0', '60'),
('6', 'CT212', '5', 'CB0004', '02', '0', '60'),
('7', 'CT212', '5', 'CB0004', 'H01', '0', '65'),
('8', 'CT222', '5', 'CB0002', '01', '0', '52'),
('9', 'CT222', '5', 'CB0002', '02', '0', '52'),
('10', 'CT222', '5', 'CB0002', 'H01', '0', '60'),
('11', 'CT222', '5', 'CB0002', 'H02', '0', '60'),
('12', 'CT466', '5', 'CB0005', 'H01', '0', '40'),
('13', 'CT466', '5', 'CB0003', 'H02', '0', '40'),
('14', 'CT466', '5', 'CB0001', 'H03', '0', '40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `ID_PHONG` decimal(4,0) NOT NULL,
  `TEN_PHONG` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `DIA_DIEM_PHONG` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `SUC_CHUA_PHONG` decimal(5,0) DEFAULT NULL,
  `IP_RFID` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`ID_PHONG`, `TEN_PHONG`, `DIA_DIEM_PHONG`, `SUC_CHUA_PHONG`, `IP_RFID`) VALUES
('1', '101/HA', 'Khu Hòa An', '120', 'Chưa có'),
('2', '102/HA', 'Khu Hòa An', '120', 'Chưa có'),
('3', '103/HA', 'Khu Hòa An', '120', 'Chưa có'),
('4', '104/HA', 'Khu Hòa An', '120', 'Chưa có'),
('5', '105/HA', 'Khu Hòa An', '80', 'Chưa có'),
('6', '106/HA', 'Khu Hòa An', '60', 'Chưa có'),
('7', '107/HA', 'Khu Hòa An', '60', 'Chưa có'),
('8', '221/B1', 'Lầu 1, Nhà học B1', '100', 'Chưa có'),
('9', '401/D1', 'Lầu 3, nhà điều hành', '60', 'Chưa có'),
('10', '201/C1', 'Lầu 1, nhà học C1', '80', 'Chưa có'),
('11', '101/C1', 'Tầng trệt, nhà học C1', '100', 'Chưa có');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quan_ly`
--

CREATE TABLE `quan_ly` (
  `TAIKHOAN_USER` varchar(8) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ID_QUYEN` decimal(1,0) DEFAULT NULL,
  `PASSWORD_USER` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `HOTEN_USER` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MATHE_USER` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `HINH_USER` varchar(400) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `NGAY_SINH` date DEFAULT NULL,
  `GIOI_TINH` varchar(5) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `DIA_CHI` varchar(400) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `EMAIL` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `SO_DT` varchar(15) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `ID_QUYEN` decimal(1,0) NOT NULL,
  `TEN_QUYEN` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`ID_QUYEN`, `TEN_QUYEN`) VALUES
('1', 'Quản lý'),
('2', 'Giáo viên'),
('3', 'Sinh viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `TAIKHOAN_USER` varchar(8) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `MA_LOP` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ID_NGANH` decimal(3,0) DEFAULT NULL,
  `ID_KHOA` decimal(2,0) DEFAULT NULL,
  `ID_QUYEN` decimal(1,0) DEFAULT NULL,
  `PASSWORD_USER` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `HOTEN_USER` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MATHE_USER` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `HINH_USER` varchar(400) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `NGAY_SINH` date DEFAULT NULL,
  `GIOI_TINH` varchar(5) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `DIA_CHI` varchar(400) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `EMAIL` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `SO_DT` varchar(15) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `sinh_vien`
--

INSERT INTO `sinh_vien` (`TAIKHOAN_USER`, `MA_LOP`, `ID_NGANH`, `ID_KHOA`, `ID_QUYEN`, `PASSWORD_USER`, `HOTEN_USER`, `MATHE_USER`, `HINH_USER`, `NGAY_SINH`, `GIOI_TINH`, `DIA_CHI`, `EMAIL`, `SO_DT`) VALUES
('B1410557', NULL, NULL, NULL, '3', '25d55ad283aa400af464c76d713c07ad', 'Phạm Nguyễn Trường An', 'Chưa có', NULL, '1996-02-10', 'Nam', 'Cần Thơ', 'anb1410557@student.ctu.edu.vn', '0979837717'),
('B1410573', NULL, NULL, NULL, '3', '25d55ad283aa400af464c76d713c07ad', 'Hồ Ngọc Đăng Khoa', 'Chưa có', NULL, '1996-06-16', 'Nam', 'Trà Ôn, Vĩnh Long', 'khoab1410573@student.ctu.edu.vn', '016123456789'),
('B1412489', NULL, NULL, NULL, '3', '25d55ad283aa400af464c76d713c07ad', 'Mai Thị Yến Nhi', 'Chưa có', NULL, '1996-09-18', 'Nữ', 'Cần Thơ', 'nhib1412489@student.ctu.edu.vn', '090123456789'),
('B1412519', NULL, NULL, NULL, '3', '25d55ad283aa400af464c76d713c07ad', 'Lê Trí Thành', 'Chưa có', NULL, '1996-12-30', 'Nam', 'Ninh Kiều, Cần Thơ', 'thanhb1412519@student.ctu.edu.vn', '016123345678'),
('B1412524', NULL, NULL, NULL, '3', '25d55ad283aa400af464c76d713c07ad', 'Cao Thanh Thi', 'Chưa có', NULL, '1996-08-26', 'Nam', 'Khóm 3, Cái Nhum, Mang Thít, Vĩnh Long', 'thib1412524@student.ctu.edu.vn', '0908476219');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sv_thuoc_nhom_hp`
--

CREATE TABLE `sv_thuoc_nhom_hp` (
  `TAIKHOAN_USER` varchar(8) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ID_NHOM_HP` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tiet_hoc`
--

CREATE TABLE `tiet_hoc` (
  `ID_TIET` decimal(2,0) NOT NULL,
  `GIO_BD` time DEFAULT NULL,
  `GIO_KT` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tiet_hoc`
--

INSERT INTO `tiet_hoc` (`ID_TIET`, `GIO_BD`, `GIO_KT`) VALUES
('1', '07:00:00', '07:45:00'),
('2', '07:45:00', '08:30:00'),
('3', '08:30:00', '09:15:00'),
('4', '09:15:00', '10:00:00'),
('5', '10:15:00', '11:00:00'),
('6', '13:30:00', '14:15:00'),
('7', '14:15:00', '15:00:00'),
('8', '15:00:00', '15:45:00'),
('9', '15:45:00', '16:30:00'),
('10', '16:30:00', '17:15:00'),
('11', '18:00:00', '18:45:00'),
('12', '18:45:00', '19:30:00'),
('13', '19:30:00', '20:15:00'),
('14', '20:15:00', '21:00:00'),
('15', '21:00:00', '21:45:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tuan`
--

CREATE TABLE `tuan` (
  `ID_TUAN` decimal(2,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tuan`
--

INSERT INTO `tuan` (`ID_TUAN`) VALUES
('1'),
('2'),
('3'),
('4'),
('5'),
('6'),
('7'),
('8'),
('9'),
('10'),
('11'),
('12'),
('13'),
('14'),
('15'),
('16'),
('17'),
('18'),
('19'),
('20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `TAIKHOAN_USER` varchar(8) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ID_QUYEN` decimal(1,0) NOT NULL,
  `PASSWORD_USER` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `HOTEN_USER` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MATHE_USER` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `HINH_USER` varchar(400) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `NGAY_SINH` date DEFAULT NULL,
  `GIOI_TINH` varchar(5) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `DIA_CHI` varchar(400) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `EMAIL` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `SO_DT` varchar(15) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`TAIKHOAN_USER`, `ID_QUYEN`, `PASSWORD_USER`, `HOTEN_USER`, `MATHE_USER`, `HINH_USER`, `NGAY_SINH`, `GIOI_TINH`, `DIA_CHI`, `EMAIL`, `SO_DT`) VALUES
('admin', '1', '25d55ad283aa400af464c76d713c07ad', 'Nguyễn Văn A', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('B1410557', '3', '25d55ad283aa400af464c76d713c07ad', 'Phạm Nguyễn Trường An', 'Chưa có', NULL, '1996-02-10', 'Nam', 'Cần Thơ', 'anb1410557@student.ctu.edu.vn', '0979837717'),
('B1410573', '3', '25d55ad283aa400af464c76d713c07ad', 'Hồ Ngọc Đăng Khoa', 'Chưa có', 'b1410573.png', '1996-06-16', 'Nam', 'Trà Ôn, Vĩnh Long', 'khoab1410573@student.ctu.edu.vn', '016123456789'),
('B1412489', '3', '25d55ad283aa400af464c76d713c07ad', 'Mai Thị Yến Nhi', 'Chưa có', NULL, '1996-09-18', 'Nữ', 'Cần Thơ', 'nhib1412489@student.ctu.edu.vn', '090123456789'),
('B1412519', '3', '25d55ad283aa400af464c76d713c07ad', 'Lê Trí Thành', 'Chưa có', NULL, '1996-12-30', 'Nam', 'Ninh Kiều, Cần Thơ', 'thanhb1412519@student.ctu.edu.vn', '016123345678'),
('B1412524', '3', '25d55ad283aa400af464c76d713c07ad', 'Cao Thanh Thi', '111111111111111', NULL, '1996-08-26', 'Nam', 'Khóm 3, Cái Nhum, Mang Thít, Vĩnh Long', 'thib1412524@student.ctu.edu.vn', '0908476219'),
('CB0001', '2', '25d55ad283aa400af464c76d713c07ad', 'Nguyễn Ngọc Mỹ', 'Chưa có', 'cb0001.png', '1986-09-09', 'Nam', 'An Giang', 'nnmy@ctu.edu.vn', '0976727098'),
('CB0002', '2', '25d55ad283aa400af464c76d713c07ad', 'Phạm Thế Phi', 'Chưa có', 'cb0002.png', '1980-01-01', 'Nam', 'Cần Thơ', 'ptphi@ctu.edu.vn', 'Không biết'),
('CB0003', '2', '25d55ad283aa400af464c76d713c07ad', 'Lâm Nhựt Khang', 'Chưa có', NULL, '1980-11-11', 'Nữ', 'Cần Thơ', 'lnkhang@ctu.edu.vn', 'Không biết'),
('CB0004', '2', '25d55ad283aa400af464c76d713c07ad', 'Bùi Minh Quân', 'Chưa có', NULL, '1980-01-01', 'Nam', 'Cần Thơ', 'bmqu??n@ctu.edu.vn', 'Không biết'),
('CB0005', '2', '25d55ad283aa400af464c76d713c07ad', 'Trần Công Án', 'Chưa có', NULL, '1980-01-01', 'Nam', 'Cần Thơ', 'tc??n@ctu.edu.vn', 'Không biết'),
('CB0006', '2', '25d55ad283aa400af464c76d713c07ad', 'Ngô Bá Hùng', 'Chưa có', NULL, '1980-01-01', 'Nam', 'Cần Thơ', 'nbhung@ctu.edu.vn', 'Không biết'),
('CB0007', '2', '25d55ad283aa400af464c76d713c07ad', 'Nguyễn Hữu Vân Long', 'Chưa có', NULL, '1980-01-01', 'Nam', 'Cần Thơ', 'nhvlong@ctu.edu.vn', 'Không có'),
('CB0008', '2', '25d55ad283aa400af464c76d713c07ad', 'Trần Việt Châu', 'Chưa có', NULL, '1980-01-01', 'Nam', 'Cần Thơ', 'tvchau@ctu.edu.vn', 'Không biết');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bo_mon`
--
ALTER TABLE `bo_mon`
  ADD PRIMARY KEY (`ID_BO_MON`),
  ADD KEY `FK_BO_MON_CUA_KHOA` (`ID_KHOA`);

--
-- Chỉ mục cho bảng `chuong_trinh_dao_tao`
--
ALTER TABLE `chuong_trinh_dao_tao`
  ADD PRIMARY KEY (`MA_MH`,`ID_NGANH`),
  ADD KEY `FK_CTDT_CUA_NGANH` (`ID_NGANH`);

--
-- Chỉ mục cho bảng `danh_sach_diem_danh`
--
ALTER TABLE `danh_sach_diem_danh`
  ADD KEY `FK_DSDD_CUA_LICHHOC` (`ID_LH`),
  ADD KEY `FK_DSDD_CUA_SINHVIEN` (`TAIKHOAN_USER`);

--
-- Chỉ mục cho bảng `giao_vien`
--
ALTER TABLE `giao_vien`
  ADD PRIMARY KEY (`TAIKHOAN_USER`),
  ADD KEY `FK_GIAOVIEN_CUA_BOMON` (`ID_BO_MON`);

--
-- Chỉ mục cho bảng `hocky_namhoc`
--
ALTER TABLE `hocky_namhoc`
  ADD PRIMARY KEY (`ID_HKNH`);

--
-- Chỉ mục cho bảng `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`ID_KHOA`);

--
-- Chỉ mục cho bảng `lich_hoc`
--
ALTER TABLE `lich_hoc`
  ADD PRIMARY KEY (`ID_LH`),
  ADD KEY `FK_LICH_HOC_CUA_NHOM_HP` (`ID_NHOM_HP`),
  ADD KEY `FK_PHONG_CUA_LICH_HOC` (`ID_PHONG`),
  ADD KEY `FK_TIET_BD_CUA_LH` (`ID_TIET`),
  ADD KEY `FK_TUAN_CUA_LH` (`ID_TUAN`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`MA_LOP`),
  ADD KEY `FK_LOP_CUA_GIAOVIEN` (`TAIKHOAN_USER`);

--
-- Chỉ mục cho bảng `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`MA_MH`);

--
-- Chỉ mục cho bảng `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`ID_NGANH`);

--
-- Chỉ mục cho bảng `nganh_thuoc_khoa`
--
ALTER TABLE `nganh_thuoc_khoa`
  ADD PRIMARY KEY (`ID_NGANH`,`ID_KHOA`),
  ADD KEY `FK_NGANH_CUA_KHOA` (`ID_KHOA`);

--
-- Chỉ mục cho bảng `nhom_hp`
--
ALTER TABLE `nhom_hp`
  ADD PRIMARY KEY (`ID_NHOM_HP`),
  ADD KEY `FK_GV_DAY_NHOM_HP` (`TAIKHOAN_USER`),
  ADD KEY `FK_HKNH_CUA_NHOM_HP` (`ID_HKNH`),
  ADD KEY `FK_NHOM_HP_CUA_MONHOC` (`MA_MH`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`ID_PHONG`);

--
-- Chỉ mục cho bảng `quan_ly`
--
ALTER TABLE `quan_ly`
  ADD PRIMARY KEY (`TAIKHOAN_USER`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`ID_QUYEN`);

--
-- Chỉ mục cho bảng `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`TAIKHOAN_USER`),
  ADD KEY `FK_LOP_CUA_SINHVIEN` (`MA_LOP`),
  ADD KEY `FK_NGANH_CUA_SINHVIEN` (`ID_NGANH`,`ID_KHOA`);

--
-- Chỉ mục cho bảng `sv_thuoc_nhom_hp`
--
ALTER TABLE `sv_thuoc_nhom_hp`
  ADD PRIMARY KEY (`TAIKHOAN_USER`,`ID_NHOM_HP`),
  ADD KEY `FK_SV_THUOC_NHOM_HP2` (`ID_NHOM_HP`);

--
-- Chỉ mục cho bảng `tiet_hoc`
--
ALTER TABLE `tiet_hoc`
  ADD PRIMARY KEY (`ID_TIET`);

--
-- Chỉ mục cho bảng `tuan`
--
ALTER TABLE `tuan`
  ADD PRIMARY KEY (`ID_TUAN`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`TAIKHOAN_USER`),
  ADD KEY `FK_QUYEN_USER` (`ID_QUYEN`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bo_mon`
--
ALTER TABLE `bo_mon`
  ADD CONSTRAINT `FK_BO_MON_CUA_KHOA` FOREIGN KEY (`ID_KHOA`) REFERENCES `khoa` (`ID_KHOA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chuong_trinh_dao_tao`
--
ALTER TABLE `chuong_trinh_dao_tao`
  ADD CONSTRAINT `FK_CTDT_CUA_NGANH` FOREIGN KEY (`ID_NGANH`) REFERENCES `nganh` (`ID_NGANH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MON_HOC_THUOC_CTDT` FOREIGN KEY (`MA_MH`) REFERENCES `mon_hoc` (`MA_MH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `danh_sach_diem_danh`
--
ALTER TABLE `danh_sach_diem_danh`
  ADD CONSTRAINT `FK_DSDD_CUA_LICHHOC` FOREIGN KEY (`ID_LH`) REFERENCES `lich_hoc` (`ID_LH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DSDD_CUA_SINHVIEN` FOREIGN KEY (`TAIKHOAN_USER`) REFERENCES `sinh_vien` (`TAIKHOAN_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `giao_vien`
--
ALTER TABLE `giao_vien`
  ADD CONSTRAINT `FK_GIAOVIEN_CUA_BOMON` FOREIGN KEY (`ID_BO_MON`) REFERENCES `bo_mon` (`ID_BO_MON`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_INHERITANCE_2` FOREIGN KEY (`TAIKHOAN_USER`) REFERENCES `user` (`TAIKHOAN_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `lich_hoc`
--
ALTER TABLE `lich_hoc`
  ADD CONSTRAINT `FK_LICH_HOC_CUA_NHOM_HP` FOREIGN KEY (`ID_NHOM_HP`) REFERENCES `nhom_hp` (`ID_NHOM_HP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PHONG_CUA_LICH_HOC` FOREIGN KEY (`ID_PHONG`) REFERENCES `phong` (`ID_PHONG`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TIET_BD_CUA_LH` FOREIGN KEY (`ID_TIET`) REFERENCES `tiet_hoc` (`ID_TIET`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TUAN_CUA_LH` FOREIGN KEY (`ID_TUAN`) REFERENCES `tuan` (`ID_TUAN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `FK_LOP_CUA_GIAOVIEN` FOREIGN KEY (`TAIKHOAN_USER`) REFERENCES `giao_vien` (`TAIKHOAN_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nganh_thuoc_khoa`
--
ALTER TABLE `nganh_thuoc_khoa`
  ADD CONSTRAINT `FK_NGANH_CUA_KHOA` FOREIGN KEY (`ID_KHOA`) REFERENCES `khoa` (`ID_KHOA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NGANH_THUOC_KHOA` FOREIGN KEY (`ID_NGANH`) REFERENCES `nganh` (`ID_NGANH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhom_hp`
--
ALTER TABLE `nhom_hp`
  ADD CONSTRAINT `FK_GV_DAY_NHOM_HP` FOREIGN KEY (`TAIKHOAN_USER`) REFERENCES `giao_vien` (`TAIKHOAN_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HKNH_CUA_NHOM_HP` FOREIGN KEY (`ID_HKNH`) REFERENCES `hocky_namhoc` (`ID_HKNH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NHOM_HP_CUA_MONHOC` FOREIGN KEY (`MA_MH`) REFERENCES `mon_hoc` (`MA_MH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `quan_ly`
--
ALTER TABLE `quan_ly`
  ADD CONSTRAINT `FK_INHERITANCE_3` FOREIGN KEY (`TAIKHOAN_USER`) REFERENCES `user` (`TAIKHOAN_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD CONSTRAINT `FK_INHERITANCE_1` FOREIGN KEY (`TAIKHOAN_USER`) REFERENCES `user` (`TAIKHOAN_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LOP_CUA_SINHVIEN` FOREIGN KEY (`MA_LOP`) REFERENCES `lop` (`MA_LOP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NGANH_CUA_SINHVIEN` FOREIGN KEY (`ID_NGANH`,`ID_KHOA`) REFERENCES `nganh_thuoc_khoa` (`ID_NGANH`, `ID_KHOA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sv_thuoc_nhom_hp`
--
ALTER TABLE `sv_thuoc_nhom_hp`
  ADD CONSTRAINT `FK_SV_THUOC_NHOM_HP` FOREIGN KEY (`TAIKHOAN_USER`) REFERENCES `sinh_vien` (`TAIKHOAN_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SV_THUOC_NHOM_HP2` FOREIGN KEY (`ID_NHOM_HP`) REFERENCES `nhom_hp` (`ID_NHOM_HP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_QUYEN_USER` FOREIGN KEY (`ID_QUYEN`) REFERENCES `quyen` (`ID_QUYEN`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
