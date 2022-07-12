-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th7 12, 2022 lúc 01:40 PM
-- Phiên bản máy phục vụ: 8.0.29-0ubuntu0.20.04.3
-- Phiên bản PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webdidong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` timestamp NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `name`, `email`, `password`, `role_id`, `image`, `address`, `birthday`, `created_at`) VALUES
(9, 'Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 'logo-online-shop-cutjpg.jpeg', 'HUNGHA-THAIBINH', '1998-06-12 17:00:00', '2022-07-08 08:56:16'),
(10, 'Manager', 'manager@gmail.com', '1d0258c2440a8d19e716292b231e3190', 2, 'downloadjpeg.jpeg', 'Hà Nội', '2022-07-07 17:00:00', '2022-07-08 10:51:27'),
(11, 'Customer', 'customer@gmail.com', 'b427c90b069896a917d44ad8c9407cc5', 87, 'mau-banner-quang-cao-san-pham-15jpg.jpeg', 'HUNGHA-THAIBINH', '1998-06-12 17:00:00', '2022-07-08 10:54:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time_start` timestamp NOT NULL,
  `time_end` timestamp NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_banner`
--

INSERT INTO `tbl_banner` (`id`, `title`, `image`, `time_start`, `time_end`, `created_at`) VALUES
(30, 'banner test1', 'banner-test1.jpeg', '2022-07-07 17:00:00', '2022-07-14 17:00:00', '2022-07-08 04:20:42'),
(31, 'banner test2', 'banner-test2.jpeg', '2022-07-15 17:00:00', '2022-07-28 17:00:00', '2022-07-08 04:21:15'),
(32, 'banner test3', 'banner-test3.jpeg', '2022-06-30 17:00:00', '2022-07-07 17:00:00', '2022-07-08 04:21:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `created_at`) VALUES
(24, 'Iphone', '2022-07-08 05:27:59'),
(25, 'Samsung', '2022-07-08 05:28:08'),
(26, 'Redmi', '2022-07-08 05:28:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_config`
--

CREATE TABLE `tbl_config` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `github` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_config`
--

INSERT INTO `tbl_config` (`id`, `email`, `github`, `facebook`, `phone`, `created_at`) VALUES
(1, 'phuocbt698@gmail.com', 'https://github.com/phuocbt698', 'https://www.facebook.com/', '0975041697', '2022-07-08 11:32:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` timestamp NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `email`, `password`, `image`, `phone`, `address`, `birthday`, `created_at`) VALUES
(14, 'Bùi Thế Phước', 'phuocbt698@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'logo-online-shop-cutjpg.jpeg', '0975041697', 'Hưng Hà - Thái Bình', '2022-07-09 17:00:00', '2022-07-10 15:47:50'),
(15, 'Bùi Thế Phước', 'phuocbt69@gmail.com', 'e2a94a09ed81af99dd7c5793c1341eb2', 'phppng.png', '0975041690', 'Hưng Hà - Thái Bình', '2022-07-10 17:00:00', '2022-07-11 15:36:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int NOT NULL,
  `admin_id` int DEFAULT NULL,
  `customer_id` int NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `admin_id`, `customer_id`, `name`, `email`, `phone`, `status`, `address`, `total_price`, `created_at`) VALUES
(32, 10, 1657527503, 'Bùi Thế Phước', 'phuocbt698@gmail.com', '0975041697', 2, 'Hưng Hà - Thái Bình', 700000, '2022-07-11 08:21:24'),
(33, 10, 1657527503, 'Bùi Thế Phước', 'phuocbt698@gmail.com', '0975041697', 2, 'Hưng Hà - Thái Bình', 5750000, '2022-07-11 08:21:47'),
(34, 9, 1657527503, 'Bùi Thế Phước', 'phuocbt98@gmail.com', '0975041690', 2, 'Hưng Hà - Thái Bình', 1250000, '2022-07-11 15:35:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(10, 29, 8, 2, 500000),
(11, 29, 7, 5, 200000),
(12, 30, 8, 1, 500000),
(13, 31, 8, 1, 500000),
(14, 31, 7, 1, 200000),
(15, 32, 8, 1, 500000),
(16, 32, 7, 1, 200000),
(17, 33, 9, 1, 750000),
(18, 33, 10, 1, 5000000),
(19, 34, 9, 1, 750000),
(20, 34, 8, 1, 500000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `category_id`, `name`, `image`, `description`, `quantity`, `price`, `created_at`) VALUES
(7, 24, 'Iphone 13', 'iphone-13.jpeg', '<ol>\r\n	<li>Iphone 13</li>\r\n</ol>\r\n', 150, 200000, '2022-07-08 06:59:14'),
(8, 25, 'Samsung', 'screenshot-from-2022-07-06-23-57-50png.png', '<ol>\r\n	<li>Samsung</li>\r\n</ol>\r\n', 0, 500000, '2022-07-08 06:59:41'),
(9, 26, 'Redmi', 'redmi.jpeg', '<ol>\r\n	<li>Redmi</li>\r\n</ol>\r\n', 1412, 750000, '2022-07-08 07:00:05'),
(10, 25, 'Samsung 1', 'logo-online-shop-cutjpg.jpeg', '<h1>TSE Written Content</h1>\r\n\r\n<p><em><strong>This purchase</strong></em>&nbsp;will enable your email account for full access to our&nbsp;<a href=\"https://thundersaidenergy.com/downloads/category/written-research/\">written content</a>, for one calendar year. This includes all&nbsp; the PDF research posted to our site, but not our data-files or models.</p>\r\n\r\n<p><em><strong>Additional terms</strong></em>: All of our written insights can be shared fully within your organization. We will also be happy to enable additional email addresses within your organization for access to our written content.</p>\r\n\r\n<p><em><strong>For any questions</strong></em>, please message:&nbsp;contact@thundersaidenergy.com</p>\r\n\r\n<form id=\"edd_purchase_605\" method=\"post\">\r\n<p><input name=\"edd_purchase_download\" type=\"submit\" value=\"$5,350.00 – Purchase\" /></p>\r\n</form>\r\n\r\n<h2>Post navigation</h2>\r\n', 100, 5000000, '2022-07-09 10:54:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_reset_pass`
--

CREATE TABLE `tbl_reset_pass` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `name`, `created_at`) VALUES
(1, 'Admin', '2022-06-30 03:37:48'),
(2, 'Manager', '2022-06-30 03:37:48'),
(87, 'Customer', '2022-07-08 07:55:45');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email` (`email`);

--
-- Chỉ mục cho bảng `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_config`
--
ALTER TABLE `tbl_config`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_email` (`email`),
  ADD UNIQUE KEY `customer_phone` (`phone`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_reset_pass`
--
ALTER TABLE `tbl_reset_pass`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`name`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `tbl_config`
--
ALTER TABLE `tbl_config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_reset_pass`
--
ALTER TABLE `tbl_reset_pass`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
