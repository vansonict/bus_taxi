-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.11 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table ptit-taxi.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hangtaxi_id` int(11) NOT NULL COMMENT 'id hãng tương ứng trong bảng tbl_hangtaxi',
  `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tong_truy_cap` int(11) NOT NULL DEFAULT '0',
  `dia_phuong_id` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Tài khoảng server web';

-- Dumping data for table ptit-taxi.account: 2 rows
DELETE FROM `account`;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`id`, `account`, `password`, `hangtaxi_id`, `end_date`, `tong_truy_cap`, `dia_phuong_id`) VALUES
	(1, 'tienphuong', '123456', 1, '2014-05-11 08:50:29', 0, 1),
	(8, 'dongly', '123456', 2, '2014-05-11 10:26:55', 0, 2);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.dia_phuong
DROP TABLE IF EXISTS `dia_phuong`;
CREATE TABLE IF NOT EXISTS `dia_phuong` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_dia_phuong` varchar(255) NOT NULL,
  `fix_lat` int(11) NOT NULL,
  `fix_lng` int(11) NOT NULL,
  `lat_1` int(11) NOT NULL,
  `lng_1` int(11) NOT NULL,
  `lat_2` int(11) NOT NULL,
  `lng_2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table ptit-taxi.dia_phuong: 2 rows
DELETE FROM `dia_phuong`;
/*!40000 ALTER TABLE `dia_phuong` DISABLE KEYS */;
INSERT INTO `dia_phuong` (`id`, `ten_dia_phuong`, `fix_lat`, `fix_lng`, `lat_1`, `lng_1`, `lat_2`, `lng_2`) VALUES
	(1, 'hanoi', 21000000, 106000000, 20960798, 105781174, 21052783, 105888290),
	(2, 'saigon', 10000000, 106000000, 10732802, 106591415, 10869047, 106711578);
/*!40000 ALTER TABLE `dia_phuong` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.hang_xe
DROP TABLE IF EXISTS `hang_xe`;
CREATE TABLE IF NOT EXISTS `hang_xe` (
  `IDHangXe` int(5) NOT NULL AUTO_INCREMENT,
  `TenHang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DiaPhuong` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SoDienThoai` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`IDHangXe`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='thông tin nhà xe';

-- Dumping data for table ptit-taxi.hang_xe: 4 rows
DELETE FROM `hang_xe`;
/*!40000 ALTER TABLE `hang_xe` DISABLE KEYS */;
INSERT INTO `hang_xe` (`IDHangXe`, `TenHang`, `DiaPhuong`, `SoDienThoai`) VALUES
	(2, 'Tiến Phương', 'Như Xuân - Thanh Hóa', '981234567'),
	(3, 'Đông Lý', 'Nông Cống - Thanh Hóa', '981234568'),
	(4, 'Hoàng Long', 'Hà Nội', '982345678'),
	(5, 'Anh Hào', 'Triệu Sơn - Thanh Hóa', '989123456');
/*!40000 ALTER TABLE `hang_xe` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.khach_hang
DROP TABLE IF EXISTS `khach_hang`;
CREATE TABLE IF NOT EXISTS `khach_hang` (
  `IDKhachHang` int(5) NOT NULL AUTO_INCREMENT,
  `SoDienThoai` text COLLATE utf8_unicode_ci NOT NULL,
  `IMSI` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDKhachHang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ptit-taxi.khach_hang: 0 rows
DELETE FROM `khach_hang`;
/*!40000 ALTER TABLE `khach_hang` DISABLE KEYS */;
/*!40000 ALTER TABLE `khach_hang` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.lich_su
DROP TABLE IF EXISTS `lich_su`;
CREATE TABLE IF NOT EXISTS `lich_su` (
  `IDLichSu` int(10) NOT NULL AUTO_INCREMENT,
  `ThoiGian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `BKS` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `IDTaiXe` int(5) NOT NULL,
  `IDKhachHang` int(5) NOT NULL,
  `StartLat` int(11) NOT NULL,
  `StarLon` int(11) NOT NULL,
  `EndLat` int(11) DEFAULT NULL,
  `EndLon` int(11) DEFAULT NULL,
  `IDTrangThai` int(3) NOT NULL DEFAULT '3',
  PRIMARY KEY (`IDLichSu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ptit-taxi.lich_su: 0 rows
DELETE FROM `lich_su`;
/*!40000 ALTER TABLE `lich_su` DISABLE KEYS */;
/*!40000 ALTER TABLE `lich_su` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.loai_xe
DROP TABLE IF EXISTS `loai_xe`;
CREATE TABLE IF NOT EXISTS `loai_xe` (
  `IDLoaiXe` int(5) NOT NULL AUTO_INCREMENT,
  `LoaiXe` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDLoaiXe`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Các loại xe khách';

-- Dumping data for table ptit-taxi.loai_xe: 4 rows
DELETE FROM `loai_xe`;
/*!40000 ALTER TABLE `loai_xe` DISABLE KEYS */;
INSERT INTO `loai_xe` (`IDLoaiXe`, `LoaiXe`) VALUES
	(1, '45 chỗ'),
	(2, '29 chỗ'),
	(3, '16 chỗ'),
	(4, 'Giường nằm');
/*!40000 ALTER TABLE `loai_xe` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.lo_trinh
DROP TABLE IF EXISTS `lo_trinh`;
CREATE TABLE IF NOT EXISTS `lo_trinh` (
  `IDLoTrinh` int(3) NOT NULL AUTO_INCREMENT,
  `LoTrinhTomTat` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Hà Nội - Thanh Hóa',
  `LoTrinhChiTiet` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Hà Nội - Thanh Hóa',
  `Tram` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IDLoTrinh`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin các lộ trình (đường đi của xe)';

-- Dumping data for table ptit-taxi.lo_trinh: 2 rows
DELETE FROM `lo_trinh`;
/*!40000 ALTER TABLE `lo_trinh` DISABLE KEYS */;
INSERT INTO `lo_trinh` (`IDLoTrinh`, `LoTrinhTomTat`, `LoTrinhChiTiet`, `Tram`) VALUES
	(1, 'Hà Nội | Thanh Hóa', 'Hà Nội | Phủ Lý, Hà Nam | Ninh Bình | Thanh Hóa', NULL),
	(2, 'Thanh Hóa | Hà Nội', 'Như Xuân, Thanh Hóa | Như Thanh, Như Xuân, Thanh Hóa | Nông Cống, Thanh Hóa | TP Thanh Hóa | Ninh Bình | Phủ Lý, Hà Nam | Bến xe Giáp Bát, Hà Nội', NULL);
/*!40000 ALTER TABLE `lo_trinh` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tai_xe
DROP TABLE IF EXISTS `tai_xe`;
CREATE TABLE IF NOT EXISTS `tai_xe` (
  `IDTaiXe` int(5) NOT NULL AUTO_INCREMENT,
  `HoTen` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `SoDienThoai` int(15) NOT NULL,
  `DiaChi` text COLLATE utf8_unicode_ci NOT NULL,
  `IDTrangThai` int(3) DEFAULT '2',
  PRIMARY KEY (`IDTaiXe`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ptit-taxi.tai_xe: 1 rows
DELETE FROM `tai_xe`;
/*!40000 ALTER TABLE `tai_xe` DISABLE KEYS */;
INSERT INTO `tai_xe` (`IDTaiXe`, `HoTen`, `SoDienThoai`, `DiaChi`, `IDTrangThai`) VALUES
	(1, 'Lê Văn Sơn', 977012581, 'Bưu Chính Viễn Thông', 2);
/*!40000 ALTER TABLE `tai_xe` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tbl_config
DROP TABLE IF EXISTS `tbl_config`;
CREATE TABLE IF NOT EXISTS `tbl_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table ptit-taxi.tbl_config: 4 rows
DELETE FROM `tbl_config`;
/*!40000 ALTER TABLE `tbl_config` DISABLE KEYS */;
INSERT INTO `tbl_config` (`id`, `name`, `value`) VALUES
	(1, 'giaidoan', '1'),
	(2, 'sdt_tg', '0977012580'),
	(3, 'default_ptittaxi_id', '0'),
	(4, 'default_hangtaxi_id', '1');
/*!40000 ALTER TABLE `tbl_config` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tbl_daily
DROP TABLE IF EXISTS `tbl_daily`;
CREATE TABLE IF NOT EXISTS `tbl_daily` (
  `id` char(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `parent_id` char(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Bảng lưu thông tin đại lý các cấp';

-- Dumping data for table ptit-taxi.tbl_daily: 5 rows
DELETE FROM `tbl_daily`;
/*!40000 ALTER TABLE `tbl_daily` DISABLE KEYS */;
INSERT INTO `tbl_daily` (`id`, `password`, `parent_id`, `name`, `mobile`, `count`) VALUES
	('0', '123456789', '0', '11', 977012580, 7),
	('5625', '', '0', '', 0, 0),
	('9999', '', '0', '', 973361499, 0),
	('1111', '', '0', '', 0, 0),
	('33333', '', '0', '', 0, 0);
/*!40000 ALTER TABLE `tbl_daily` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tbl_gd1_khachhanglog
DROP TABLE IF EXISTS `tbl_gd1_khachhanglog`;
CREATE TABLE IF NOT EXISTS `tbl_gd1_khachhanglog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hangtaxi_id` int(10) NOT NULL,
  `loaitaxi_id` int(10) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `lat` int(11) NOT NULL,
  `lon` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `daily_id` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=460 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table ptit-taxi.tbl_gd1_khachhanglog: 0 rows
DELETE FROM `tbl_gd1_khachhanglog`;
/*!40000 ALTER TABLE `tbl_gd1_khachhanglog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_gd1_khachhanglog` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tbl_hangtaxi
DROP TABLE IF EXISTS `tbl_hangtaxi`;
CREATE TABLE IF NOT EXISTS `tbl_hangtaxi` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa',
  `name` varchar(80) NOT NULL COMMENT 'tên hãng',
  `description` varchar(200) NOT NULL COMMENT 'thông tin chi tiết',
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='quản lý các hãng taxi trên địa bàn';

-- Dumping data for table ptit-taxi.tbl_hangtaxi: 8 rows
DELETE FROM `tbl_hangtaxi`;
/*!40000 ALTER TABLE `tbl_hangtaxi` DISABLE KEYS */;
INSERT INTO `tbl_hangtaxi` (`id`, `name`, `description`, `status`) VALUES
	(1, 'mai linh', 'mai linh hn: 0987,  mai linh sai gon: 0988', 1),
	(6, 'Hà Nội', ' ĐT: 04.38.53.53.53 – Web: www.TaxiHanoi.com', 1),
	(7, 'Vạn Xuân', ' ĐT: 04.38.222.888', 1),
	(8, 'Thành Hưng', ' ĐT: 04.38.733.733 – 04.38.73.13.13 – Web: http://www.thanhhunggroup.com', 1),
	(9, 'Thanh Nga ', ' ĐT: 04.38.215.215', 1),
	(10, 'CP Taxi', 'ĐT: 04.38.26.26.26', 0),
	(0, 'pingtaxi', 'default taxi', 0),
	(16, 'Hoàn Kiếm Taxi', 'ĐT: 04.37.16.16.16', 0);
/*!40000 ALTER TABLE `tbl_hangtaxi` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tbl_history
DROP TABLE IF EXISTS `tbl_history`;
CREATE TABLE IF NOT EXISTS `tbl_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hangtaxi_id` int(10) NOT NULL,
  `loaitaxi_id` int(10) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `lat` int(11) NOT NULL,
  `lon` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `daily_id` int(3) NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=460 DEFAULT CHARSET=latin1;

-- Dumping data for table ptit-taxi.tbl_history: 173 rows
DELETE FROM `tbl_history`;
/*!40000 ALTER TABLE `tbl_history` DISABLE KEYS */;
INSERT INTO `tbl_history` (`id`, `time_stamp`, `hangtaxi_id`, `loaitaxi_id`, `phonenumber`, `lat`, `lon`, `status`, `daily_id`, `password`) VALUES
	(171, '2013-01-15 11:19:27', 1, 2, '0984380003', 20989590, 105869328, 1, 11, ''),
	(170, '2013-01-15 11:19:41', 0, 1, '', 0, 0, 0, 11, ''),
	(172, '2013-01-15 11:19:57', 1, 2, '0984380003', 20989590, 105869328, 1, 112, ''),
	(173, '2013-01-15 11:20:10', 1, 1, '0984380003', 20989590, 105869328, 1, 111, ''),
	(174, '2013-01-15 11:20:30', 8, 7, '0984380003', 20989590, 105869328, 0, 112, ''),
	(122, '2013-01-15 11:20:45', 1, 6, '0984380003', 20989111, 105868257, 1, 10, ''),
	(32, '2013-01-15 11:21:03', 0, 7, '0984380003', 20989111, 105868257, 1, 1123, ''),
	(188, '2013-01-15 11:21:24', 0, 1, '0984380003', 20979105, 105864314, 1, 112, ''),
	(187, '2013-01-15 11:21:55', 0, 6, '0984380003', 20983793, 105857105, 1, 1124, ''),
	(185, '2013-01-15 11:22:12', 0, 2, '0984380003', 20983793, 105857105, 1, 1123, ''),
	(184, '2013-01-15 11:22:28', 9, 7, '0984380003', 20983793, 105857105, 1, 112, ''),
	(183, '2012-12-18 13:50:34', 0, 6, '0984380003', 20983793, 105857105, 1, 0, ''),
	(182, '2012-12-18 13:50:34', 0, 1, '0984380003', 20983793, 105857105, 1, 0, ''),
	(181, '2012-12-18 13:48:32', 9, 2, '0984380003', 20983793, 105857105, 1, 0, ''),
	(180, '2012-12-18 13:47:46', 0, 2, '0984380003', 20983793, 105857105, 1, 0, ''),
	(179, '2012-12-18 13:47:31', 1, 1, '0984380003', 20983793, 105857105, 1, 0, ''),
	(178, '2012-12-18 13:48:32', 9, 1, '0984380003', 20983793, 105857105, 1, 0, ''),
	(189, '2012-12-18 14:19:44', 1, 2, '0984380003', 20983793, 105857105, 1, 0, ''),
	(190, '2012-12-18 14:23:54', 0, 6, '', 20983793, 105857105, 1, 0, ''),
	(191, '2012-12-18 14:26:04', 1, 1, '0988888888888', 20983793, 105857105, 1, 0, ''),
	(175, '2012-12-18 17:35:42', 7, 0, '', 0, 0, 0, 0, ''),
	(176, '2012-12-18 17:35:49', 7, 0, '', 0, 41021, 0, 0, ''),
	(177, '2012-12-18 17:35:57', 8, 0, '', 0, 41021, 0, 0, ''),
	(186, '2012-12-18 19:50:35', 7, 1, '0984380003', 20983793, 105857105, 0, 0, ''),
	(192, '2012-12-18 20:37:59', 6, 1, '0984380003', 20983793, 105857105, 0, 0, ''),
	(195, '2012-12-18 22:12:27', 6, 1, '625588', 0, 41021, 0, 0, ''),
	(194, '2012-12-18 22:12:22', 7, 1, '625588', 0, 41021, 0, 0, ''),
	(193, '2012-12-18 22:12:08', 7, 2, '625588', 0, 0, 0, 0, ''),
	(235, '2012-12-19 16:19:15', 0, 1, '369963', 20994357, 105859907, 1, 2525, ''),
	(234, '2012-12-19 16:18:50', 1, 1, '123456789', 20994357, 105859907, 1, 2525, ''),
	(252, '2012-12-20 06:58:32', 1, 1, '9999999999', 106906589, 41021, 0, 33333, ''),
	(254, '2012-12-20 07:11:37', 7, 1, '7777777777777', 106893828, 41021, 0, 33333, ''),
	(253, '2012-12-20 07:11:05', 7, 7, '9999999999', 106892910, 41021, 0, 33333, ''),
	(256, '2012-12-20 08:46:02', 9, 6, '01697469000', 20989591, 105869365, 0, 0, ''),
	(255, '2012-12-20 08:43:08', 1, 2, '01697469000', 20989591, 105869365, 0, 0, ''),
	(257, '2012-12-20 17:08:21', 1, 1, '01697469000', 106900157, 41021, 0, 0, ''),
	(258, '2012-12-21 02:52:41', 1, 2, '0984380003', 21, 106, 0, 0, ''),
	(259, '2012-12-21 02:53:36', 1, 1, '0984380003', 21, 106, 0, 0, ''),
	(260, '2012-12-21 02:54:09', 1, 1, '0984380003', 21, 106, 0, 0, ''),
	(261, '2012-12-21 02:55:07', 0, 1, '0984380003', 21, 106, 0, 0, ''),
	(262, '2012-12-21 11:25:04', 1, 2, '0984380003', 21024984, 105856376, 1, 0, ''),
	(263, '2012-12-21 17:27:33', 1, 1, '0984380003', 21, 106, 0, 0, ''),
	(264, '2012-12-23 10:01:51', 1, 2, '0977012580', 20991839, 105859327, 1, 0, ''),
	(265, '2012-12-23 10:09:56', 1, 1, '0977012581', 20991839, 105859327, 1, 0, ''),
	(266, '2012-12-25 00:36:55', 1, 7, '0977012584', 20991839, 105859328, 0, 0, ''),
	(268, '2012-12-25 01:18:11', 9, 2, '', 20992298, 105859860, 0, 0, ''),
	(267, '2012-12-25 01:02:12', 9, 2, '', 20992069, 105859594, 0, 0, ''),
	(269, '2012-12-25 02:37:48', 9, 2, '', 20988334, 105859519, 0, 0, ''),
	(270, '2012-12-25 05:45:30', 1, 2, '', 20991839, 105859328, 0, 0, ''),
	(271, '2012-12-25 05:53:30', 6, 2, '0', 20990316, 105859690, 0, 0, ''),
	(272, '2012-12-25 06:02:16', 7, 2, '0', 20992145, 105859683, 0, 0, ''),
	(273, '2012-12-25 06:04:54', 6, 2, '0', 20992298, 105859860, 0, 0, ''),
	(274, '2012-12-25 18:53:04', 6, 2, '0', 20988334, 105859519, 0, 0, ''),
	(275, '2012-12-25 19:05:48', 1, 2, '0', 20991840, 105859326, 0, 0, ''),
	(276, '2012-12-25 19:37:52', 1, 2, '0', 20991840, 105859326, 0, 0, ''),
	(277, '2012-12-25 19:46:08', 1, 2, '0', 20992101, 105859537, 0, 0, ''),
	(278, '2012-12-25 19:47:54', 6, 2, '0', 20992101, 105859537, 0, 0, ''),
	(279, '2012-12-25 19:48:16', 8, 2, '0', 20992101, 105859537, 0, 0, ''),
	(280, '2012-12-25 19:48:27', 9, 1, '0', 20992101, 105859537, 0, 0, ''),
	(281, '2012-12-25 19:48:33', 1, 6, '0', 20992101, 105859537, 0, 0, ''),
	(297, '2012-12-25 20:30:25', 6, 2, '', 0, 0, 0, 0, ''),
	(296, '2012-12-25 20:29:59', 0, 2, '', 0, 0, 0, 0, ''),
	(295, '2012-12-25 20:29:06', 6, 1, '', 0, 0, 0, 0, ''),
	(294, '2012-12-25 20:28:26', 6, 2, '', 0, 0, 0, 0, ''),
	(293, '2012-12-25 20:27:54', 0, 2, '', 0, 0, 0, 0, ''),
	(292, '2012-12-25 20:27:33', 8, 2, '', 0, 0, 0, 0, ''),
	(291, '2012-12-25 20:27:20', 1, 2, '', 0, 0, 0, 0, ''),
	(290, '2012-12-25 20:27:13', 1, 1, '', 0, 0, 0, 0, ''),
	(289, '2012-12-25 20:27:02', 0, 2, '', 0, 0, 0, 0, ''),
	(288, '2012-12-25 20:26:57', 0, 2, '', 0, 0, 0, 0, ''),
	(287, '2012-12-25 20:23:55', 6, 2, '', 0, 0, 0, 0, ''),
	(286, '2012-12-25 20:23:48', 6, 2, '', 0, 0, 0, 0, ''),
	(285, '2012-12-25 20:22:50', 1, 2, '', 0, 0, 0, 0, ''),
	(282, '2012-12-25 20:18:27', 1, 2, '0', 0, 0, 0, 0, ''),
	(283, '2012-12-25 20:18:46', 6, 2, '', 0, 0, 0, 0, ''),
	(284, '2012-12-25 20:19:21', 1, 2, '', 0, 0, 0, 0, ''),
	(298, '2012-12-25 20:30:30', 6, 2, '', 0, 0, 0, 0, ''),
	(299, '2012-12-25 20:35:14', 0, 2, '', 0, 0, 0, 0, ''),
	(300, '2012-12-25 20:39:19', 1, 2, '0', 0, 0, 0, 0, ''),
	(302, '2012-12-26 16:09:22', 8, 7, '', 20982365, 105786679, 0, 0, ''),
	(301, '2012-12-26 16:08:59', 7, 2, '0', 20982365, 105786679, 0, 0, ''),
	(303, '2012-12-27 16:49:46', 1, 1, '0984380003', 20989687, 105869152, 0, 0, ''),
	(312, '2012-12-27 23:40:00', 1, 7, '0984380003', 20995296, 105875203, 1, 0, ''),
	(311, '2012-12-27 23:39:30', 1, 2, '0984380003', 20984318, 105873058, 1, 0, ''),
	(310, '2012-12-27 23:39:10', 1, 1, '0984380003', 20989687, 105869152, 1, 0, ''),
	(304, '2012-12-27 23:31:53', 1, 1, '0984380003', 20989843, 105869057, 1, 0, ''),
	(309, '2012-12-28 05:37:15', 1, 2, '0984380003', 21, 106, 0, 0, ''),
	(307, '2012-12-28 05:36:27', 1, 1, '0984380003', 21, 106, 0, 0, ''),
	(308, '2012-12-28 05:36:43', 1, 2, '0984380003', 21, 106, 0, 0, ''),
	(306, '2012-12-28 05:35:35', 1, 6, '0984380003', 21, 106, 0, 0, ''),
	(305, '2012-12-28 05:35:09', 0, 6, '0984380003', 21, 106, 0, 0, ''),
	(313, '2012-12-28 07:35:57', 7, 2, '2222222', 0, 0, 0, 0, ''),
	(314, '2012-12-30 01:33:52', 7, 2, '0984380003', 21120551, 106394512, 0, 0, ''),
	(317, '2012-12-30 11:52:45', 1, 2, '0984380003', 21117226, 106399494, 1, 0, ''),
	(316, '2012-12-30 11:49:34', 1, 1, '0984380003', 21120549, 106394516, 1, 0, ''),
	(315, '2012-12-30 11:48:51', 0, 2, '0984380003', 21120549, 106394516, 1, 0, ''),
	(319, '2012-12-30 23:18:18', 1, 6, '0984380003', 111845039, 43002, 0, 0, ''),
	(318, '2012-12-30 23:18:14', 1, 1, '0984380003', 0, 0, 0, 0, ''),
	(321, '2013-01-04 03:00:54', 6, 2, '0984380003', 106891392, 41021, 0, 0, ''),
	(320, '2013-01-04 03:00:17', 8, 1, '0984380003', 0, 0, 0, 0, ''),
	(323, '2013-01-04 14:49:59', 1, 7, '0984380003', 20994351, 105846068, 1, 0, ''),
	(322, '2013-01-04 14:49:24', 1, 2, '0984380003', 20997396, 105842592, 1, 0, ''),
	(324, '2013-01-05 15:08:50', 1, 1, '0984380003', 20989593, 105869363, 1, 0, ''),
	(328, '2013-01-05 23:29:05', 1, 2, '', 20989800, 105869051, 1, 0, ''),
	(327, '2013-01-05 23:28:25', 1, 1, '', 20989800, 105869051, 1, 0, ''),
	(326, '2013-01-05 23:28:00', 0, 2, '', 20989800, 105869051, 1, 0, ''),
	(325, '2013-01-05 23:27:01', 1, 1, '0984380003', 20989593, 105869363, 1, 0, ''),
	(329, '2013-01-07 01:47:10', 9, 7, '0', 106892910, 41021, 0, 0, ''),
	(330, '2013-01-08 16:27:27', 1, 1, '', 20994627, 105862098, 0, 0, ''),
	(331, '2013-01-10 02:47:43', 1, 1, '', 20991234, 105866630, 0, 0, ''),
	(335, '2013-01-10 18:26:40', 0, 1, '', 20994373, 105859510, 0, 555, ''),
	(334, '2013-01-10 18:26:06', 1, 2, '', 20994373, 105859510, 0, 555, ''),
	(333, '2013-01-10 18:25:26', 6, 2, '', 20994373, 105859510, 0, 555, ''),
	(332, '2013-01-10 18:22:45', 6, 2, '', 20994373, 105859510, 0, 555, ''),
	(344, '2013-01-12 00:24:09', 1, 2, '', 20989593, 105869363, 1, 0, ''),
	(339, '2013-01-12 06:19:32', 0, 6, '', 106891392, 41021, 0, 0, ''),
	(340, '2013-01-12 06:19:41', 1, 1, '', 106891392, 41021, 0, 0, ''),
	(341, '2013-01-12 06:20:45', 1, 2, '', 106891389, 41021, 0, 0, ''),
	(342, '2013-01-12 06:20:54', 0, 1, '', 106891389, 41021, 0, 0, ''),
	(343, '2013-01-12 06:20:58', 1, 2, '', 106891389, 41021, 0, 0, ''),
	(338, '2013-01-12 06:19:22', 1, 2, '', 106891392, 41021, 0, 0, ''),
	(337, '2013-01-12 06:19:07', 1, 2, '', 106891392, 41021, 0, 0, ''),
	(336, '2013-01-12 06:16:45', 1, 2, '', 106891392, 41021, 0, 0, ''),
	(409, '2013-01-13 08:52:27', 1, 1, '0977012580', 106892910, 41021, 0, 0, ''),
	(408, '2013-01-13 08:52:25', 6, 2, '0977012580', 106892910, 41021, 0, 0, ''),
	(407, '2013-01-13 08:52:09', 6, 7, '0977012580', 106892910, 41021, 0, 0, ''),
	(406, '2013-01-13 08:52:08', 0, 1, '0977012580', 106892910, 41021, 0, 0, ''),
	(405, '2013-01-13 08:51:54', 0, 2, '0977012580', 106892910, 41021, 0, 0, ''),
	(404, '2013-01-13 08:48:58', 0, 2, '0977012580', 106892910, 41021, 0, 0, ''),
	(403, '2013-01-13 08:46:26', 1, 1, '', 106892910, 41021, 0, 0, ''),
	(402, '2013-01-13 08:46:26', 1, 6, '', 106892910, 41021, 0, 0, ''),
	(401, '2013-01-13 08:46:04', 1, 2, '', 106892910, 41021, 0, 0, ''),
	(400, '2013-01-13 08:45:50', 1, 2, '', 106892910, 41021, 0, 0, ''),
	(399, '2013-01-13 08:42:51', 1, 2, '', 106892910, 41021, 0, 0, ''),
	(398, '2013-01-13 08:42:39', 0, 2, '', 106892910, 41021, 0, 0, ''),
	(397, '2013-01-13 08:30:27', 1, 1, '', 106892910, 41021, 0, 0, ''),
	(410, '2013-01-13 10:10:05', 0, 2, '0977012580', 20994579, 105860271, 0, 0, ''),
	(413, '2013-01-13 14:25:16', 6, 1, '0977012580', 20995316, 105861123, 0, 0, ''),
	(412, '2013-01-13 14:25:01', 6, 2, '0977012580', 20995316, 105861123, 0, 0, ''),
	(411, '2013-01-13 14:24:44', 6, 2, '0977012580', 20995316, 105861123, 0, 0, ''),
	(415, '2013-01-13 16:45:44', 0, 1, '0977012580', 21004882, 105933219, 0, 0, ''),
	(414, '2013-01-13 16:45:32', 0, 2, '0977012580', 21004882, 105933219, 0, 0, ''),
	(418, '2013-01-13 17:33:52', 0, 1, '', 106768359, 41011, 0, 0, ''),
	(417, '2013-01-13 17:32:55', 7, 1, '', 106768359, 41011, 0, 0, ''),
	(416, '2013-01-13 17:32:46', 7, 1, '', 106768359, 41011, 0, 0, ''),
	(422, '2013-01-15 01:41:24', 1, 2, '0977012580', 20991859, 105859292, 0, 0, ''),
	(419, '2013-01-15 01:40:58', 0, 2, '0977012580', 20991859, 105859292, 0, 0, ''),
	(420, '2013-01-15 01:41:05', 1, 6, '0977012580', 20991859, 105859292, 0, 0, ''),
	(421, '2013-01-15 01:41:11', 1, 1, '0977012580', 20991859, 105859292, 0, 0, ''),
	(458, '2013-01-15 14:58:17', 0, 2, '0977012580', 20990158, 105869816, 1, 0, ''),
	(457, '2013-01-15 14:38:28', 0, 7, '0977012580', 20990471, 105867783, 1, 0, ''),
	(456, '2013-01-15 14:38:28', 0, 7, '0977012580', 20990471, 105867783, 1, 0, ''),
	(455, '2013-01-15 14:38:02', 0, 1, '0977012580', 20990471, 105867783, 1, 0, ''),
	(454, '2013-01-15 14:37:27', 0, 1, '0977012580', 20990471, 105867783, 1, 0, ''),
	(453, '2013-01-15 14:35:52', 0, 1, '0977012580', 20990471, 105867783, 1, 0, ''),
	(452, '2013-01-15 14:32:07', 0, 6, '52521325', 20991826, 105858390, 1, 0, ''),
	(451, '2013-01-15 14:31:42', 0, 2, '52521325', 20991826, 105858390, 1, 0, ''),
	(450, '2013-01-15 14:30:42', 0, 2, '52521325', 20991826, 105858390, 1, 0, ''),
	(447, '2013-01-15 14:25:32', 0, 2, '0977012580', 20990158, 105869816, 1, 0, ''),
	(446, '2013-01-15 14:23:37', 0, 2, '845213652', 20991826, 105858390, 1, 0, ''),
	(440, '2013-01-15 14:11:37', 0, 2, '0977012580', 20990158, 105869816, 1, 0, ''),
	(441, '2013-01-15 14:11:37', 0, 1, '0977012580', 20990158, 105869816, 1, 0, ''),
	(442, '2013-01-15 14:11:37', 0, 2, '0977012580', 20990158, 105869816, 1, 0, ''),
	(443, '2013-01-15 14:11:37', 0, 6, '0977012580', 20990158, 105869816, 1, 0, ''),
	(444, '2013-01-15 14:13:02', 0, 1, '', 20990702, 105863877, 1, 0, ''),
	(445, '2013-01-15 14:23:17', 0, 2, '0984380003', 20991826, 105858390, 1, 0, ''),
	(439, '2013-01-15 14:11:37', 0, 2, '0977012580', 20990158, 105869816, 1, 0, ''),
	(437, '2013-01-15 14:11:37', 0, 1, '845213652', 20999275, 105859025, 1, 0, ''),
	(436, '2013-01-15 14:11:37', 0, 2, '845213652', 20999235, 105854562, 1, 0, ''),
	(449, '2013-01-15 20:30:17', 0, 7, '0977012580', 10791, 11221, 0, 0, ''),
	(448, '2013-01-15 20:30:15', 0, 2, '0977012580', 10791, 11221, 0, 0, ''),
	(438, '2013-01-15 20:07:11', 8, 7, '0977012580', 20990158, 105869816, 0, 0, ''),
	(459, '2013-01-22 14:39:00', 0, 1, '0977012580', 20982318, 105786684, 1, 0, '');
/*!40000 ALTER TABLE `tbl_history` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tbl_khachhang
DROP TABLE IF EXISTS `tbl_khachhang`;
CREATE TABLE IF NOT EXISTS `tbl_khachhang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phoneNumber` text NOT NULL,
  `IMSI` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table ptit-taxi.tbl_khachhang: 2 rows
DELETE FROM `tbl_khachhang`;
/*!40000 ALTER TABLE `tbl_khachhang` DISABLE KEYS */;
INSERT INTO `tbl_khachhang` (`id`, `phoneNumber`, `IMSI`) VALUES
	(22, '55555555', '9258081304'),
	(23, '44444444444', '01689982897');
/*!40000 ALTER TABLE `tbl_khachhang` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tbl_khachhanglog
DROP TABLE IF EXISTS `tbl_khachhanglog`;
CREATE TABLE IF NOT EXISTS `tbl_khachhanglog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hangtaxi_id` int(10) NOT NULL,
  `loaitaxi_id` int(10) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `lat` int(11) NOT NULL,
  `lon` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `daily_id` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- Dumping data for table ptit-taxi.tbl_khachhanglog: 0 rows
DELETE FROM `tbl_khachhanglog`;
/*!40000 ALTER TABLE `tbl_khachhanglog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_khachhanglog` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tbl_loaitaxi
DROP TABLE IF EXISTS `tbl_loaitaxi`;
CREATE TABLE IF NOT EXISTS `tbl_loaitaxi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'loại taxi',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='các loại taxi , đây là bảng tĩnh';

-- Dumping data for table ptit-taxi.tbl_loaitaxi: 4 rows
DELETE FROM `tbl_loaitaxi`;
/*!40000 ALTER TABLE `tbl_loaitaxi` DISABLE KEYS */;
INSERT INTO `tbl_loaitaxi` (`id`, `description`) VALUES
	(1, '4 chỗ'),
	(2, '7 chỗ'),
	(6, 'taxi tải 500kg'),
	(7, 'taxi tải 1000kg');
/*!40000 ALTER TABLE `tbl_loaitaxi` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tbl_nguoi_dung
DROP TABLE IF EXISTS `tbl_nguoi_dung`;
CREATE TABLE IF NOT EXISTS `tbl_nguoi_dung` (
  `STT` int(10) NOT NULL AUTO_INCREMENT,
  `TenDangNhap` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ID` tinyint(4) NOT NULL DEFAULT '2' COMMENT '0: Admin ; 1: Mod ; 2: member',
  PRIMARY KEY (`STT`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Quản trị';

-- Dumping data for table ptit-taxi.tbl_nguoi_dung: ~1 rows (approximately)
DELETE FROM `tbl_nguoi_dung`;
/*!40000 ALTER TABLE `tbl_nguoi_dung` DISABLE KEYS */;
INSERT INTO `tbl_nguoi_dung` (`STT`, `TenDangNhap`, `MatKhau`, `ID`) VALUES
	(3, 'admin', 'f8450a97cc7e38e6d109425c87b41634', 0);
/*!40000 ALTER TABLE `tbl_nguoi_dung` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.tbl_xetaxi
DROP TABLE IF EXISTS `tbl_xetaxi`;
CREATE TABLE IF NOT EXISTS `tbl_xetaxi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bks` varchar(10) NOT NULL COMMENT 'biển kiểm soát',
  `passwd` varchar(255) NOT NULL COMMENT 'password',
  `loai` int(1) NOT NULL COMMENT 'loại xe taxi: 0, 1, 2, 3',
  `hangtaxi` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bks` (`bks`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1 COMMENT='quản lý các xe taxi';

-- Dumping data for table ptit-taxi.tbl_xetaxi: 17 rows
DELETE FROM `tbl_xetaxi`;
/*!40000 ALTER TABLE `tbl_xetaxi` DISABLE KEYS */;
INSERT INTO `tbl_xetaxi` (`id`, `bks`, `passwd`, `loai`, `hangtaxi`) VALUES
	(30, '88j8888', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 1),
	(49, '99j9999', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 6),
	(48, '99q8888', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 1),
	(41, '12z3456', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 6),
	(44, '99k9999', '2950258a8f29faf4bcf5b879fde30692', 2, 0),
	(45, '44b4444', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 6),
	(46, '29m19326', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 6),
	(47, '99g9999', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 6),
	(40, '12j1234', 'd8578edf8458ce06fbc5bb76a58c5ca4', 2, 6),
	(39, '11i1111', 'd8578edf8458ce06fbc5bb76a58c5ca4', 2, 7),
	(34, '22v3333', 'd8578edf8458ce06fbc5bb76a58c5ca4', 2, 7),
	(37, '29b99999', 'e10adc3949ba59abbe56e057f20f883e', 2, 6),
	(32, '77f7777', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 1),
	(50, '12l12345', 'd8578edf8458ce06fbc5bb76a58c5ca4', 6, 7),
	(51, '11l1111', 'd8578edf8458ce06fbc5bb76a58c5ca4', 2, 6),
	(52, '12h23456', 'd8578edf8458ce06fbc5bb76a58c5ca4', 2, 6),
	(53, '12j12345', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, 6);
/*!40000 ALTER TABLE `tbl_xetaxi` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.trang_thai
DROP TABLE IF EXISTS `trang_thai`;
CREATE TABLE IF NOT EXISTS `trang_thai` (
  `IDTrangThai` int(3) NOT NULL AUTO_INCREMENT,
  `TrangThai` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDTrangThai`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ptit-taxi.trang_thai: 6 rows
DELETE FROM `trang_thai`;
/*!40000 ALTER TABLE `trang_thai` DISABLE KEYS */;
INSERT INTO `trang_thai` (`IDTrangThai`, `TrangThai`) VALUES
	(1, 'Đang chạy trên đường'),
	(2, 'Đang dừng nghỉ'),
	(3, 'đang chờ hồi đáp'),
	(4, 'đang được phục vụ'),
	(5, 'đã xong'),
	(6, 'không thành công');
/*!40000 ALTER TABLE `trang_thai` ENABLE KEYS */;


-- Dumping structure for table ptit-taxi.xe_khach
DROP TABLE IF EXISTS `xe_khach`;
CREATE TABLE IF NOT EXISTS `xe_khach` (
  `BKS` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IDLoaiXe` int(5) NOT NULL,
  `IDHangXe` int(5) NOT NULL,
  `IDLoTrinh` int(5) NOT NULL,
  `IDTaiXe` int(5) NOT NULL DEFAULT '1',
  `IDTrangThai` int(3) DEFAULT '2',
  `SoGheTrong` int(3) DEFAULT '0',
  `TimeArrive` float NOT NULL DEFAULT '60',
  PRIMARY KEY (`BKS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ptit-taxi.xe_khach: 4 rows
DELETE FROM `xe_khach`;
/*!40000 ALTER TABLE `xe_khach` DISABLE KEYS */;
INSERT INTO `xe_khach` (`BKS`, `MatKhau`, `IDLoaiXe`, `IDHangXe`, `IDLoTrinh`, `IDTaiXe`, `IDTrangThai`, `SoGheTrong`, `TimeArrive`) VALUES
	('36k302668', '123456', 1, 2, 1, 1, 1, 14, 60),
	('36K302669', '123456', 1, 2, 2, 1, 1, 15, 60),
	('46B2-02596', '123456', 1, 2, 1, 1, 1, 2, 60),
	('32Z2-54802', '123456', 1, 3, 2, 1, 1, 6, 60);
/*!40000 ALTER TABLE `xe_khach` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
