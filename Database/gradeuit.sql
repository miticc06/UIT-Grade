-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th12 23, 2018 lúc 08:16 PM
-- Phiên bản máy phục vụ: 10.1.23-MariaDB-9+deb9u1
-- Phiên bản PHP: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gradeuit`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mssv` text NOT NULL,
  `pass` text NOT NULL,
  `keypw` varchar(200) DEFAULT NULL,
  `code` text NOT NULL,
  `email` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` text NOT NULL,
  `idmsg` varchar(100) NOT NULL,
  `cachediem` mediumtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci,
  `cachetkb` mediumtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci,
  `typenotice` varchar(10) NOT NULL DEFAULT 'emailmsg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
