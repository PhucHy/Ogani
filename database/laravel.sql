-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th1 21, 2022 lúc 01:30 AM
-- Phiên bản máy phục vụ: 10.4.10-MariaDB
-- Phiên bản PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` varchar(255) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `created_at`, `updated_at`) VALUES
('fruit', 'Trái cây', '2021-05-29 08:19:38', '2021-05-29 08:19:38'),
('vegetables', 'Rau củ', '2021-05-29 08:19:38', '2021-05-29 08:19:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(10) NOT NULL,
  `products_id` int(2) NOT NULL,
  `comment` text NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`comment_id`),
  KEY `products_id` (`products_id`),
  KEY `id` (`id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`comment_id`, `id`, `products_id`, `comment`, `status_id`, `created_at`, `updated_at`) VALUES
(15, 42, 108, 'rất ngon', 3, '2021-12-29 11:23:02', '2021-12-29 11:23:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2021_05_15_100124_create_users_table', 1),
(4, '2021_05_29_144558_create_products_table', 2),
(5, '2021_05_29_144834_create_categories_table', 2),
(6, '2021_05_29_161508_create_roles_table', 3),
(7, '2021_07_29_223558_create_order_table', 4),
(10, '2021_07_31_024203_create_orderdetail_table', 5),
(11, '2021_08_05_130535_create_rating_table', 6),
(12, '2021_08_05_150455_create_comment_table', 7),
(13, '2021_08_05_151520_create_status_table', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `receiver_address` varchar(255) NOT NULL,
  `receiver_phone` varchar(255) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `buyer_phone` varchar(255) NOT NULL,
  `payment_methods` varchar(8) NOT NULL DEFAULT 'COD',
  `sum` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`order_id`),
  KEY `email` (`email`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`order_id`, `email`, `receiver`, `receiver_address`, `receiver_phone`, `buyer`, `buyer_phone`, `payment_methods`, `sum`, `status_id`, `created_at`, `updated_at`) VALUES
(71, 'dat230300@gmail.com', 'Nguyễn Minh Thiện', '97/2 Bình Thới', '0932763318', 'Đào Ngọc Tiến', '53165616', 'COD', '64,000', 3, '2021-12-29 11:33:33', '2022-01-15 14:14:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

DROP TABLE IF EXISTS `orderdetail`;
CREATE TABLE IF NOT EXISTS `orderdetail` (
  `orderdetail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL,
  `products_id` int(2) NOT NULL,
  `products_name` varchar(255) NOT NULL,
  `product_qty` int(6) NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`orderdetail_id`),
  KEY `order_id` (`order_id`),
  KEY `products_id` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`orderdetail_id`, `order_id`, `products_id`, `products_name`, `product_qty`, `product_price`, `created_at`, `updated_at`) VALUES
(46, 71, 109, 'Mận An Phước', 1, 35000.00, '2021-12-29 11:33:33', '2021-12-29 11:33:33'),
(47, 71, 108, 'Nhãn thái chùm', 1, 29000.00, '2021-12-29 11:33:33', '2021-12-29 11:33:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `products_id` int(2) NOT NULL AUTO_INCREMENT,
  `products_name` varchar(255) NOT NULL,
  `products_price` double(8,2) NOT NULL,
  `products_qty` int(6) NOT NULL,
  `products_description` text NOT NULL,
  `products_img` varchar(255) NOT NULL,
  `categories_id` varchar(255) NOT NULL,
  `status_id` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `expiry_day` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`products_id`),
  KEY `categories_id` (`categories_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`products_id`, `products_name`, `products_price`, `products_qty`, `products_description`, `products_img`, `categories_id`, `status_id`, `created_at`, `updated_at`, `expiry_day`) VALUES
(43, 'Cải thìa', 10300.00, 50, '300g', 'cai-thia-tui-300g.jpg', 'vegetables', 6, '2021-12-18 08:38:35', '2021-12-18 08:38:35', '2021-12-23 08:38:35'),
(44, 'Bắp cải thảo', 17500.00, 50, '500g (1-2 bắp)', 'bap-cai-thao-tui-500g.jpg', 'vegetables', 6, '2021-12-18 08:45:13', '2021-12-18 08:45:13', '2021-12-23 08:45:13'),
(45, 'Cải bẹ xanh baby', 18000.00, 50, '300g', 'cai-be-xanh-baby-tui-300g.jpg', 'vegetables', 6, '2021-12-18 08:47:57', '2021-12-18 08:47:57', '2021-12-23 08:47:57'),
(46, 'Cải ngọt baby', 18000.00, 50, '300g', 'cai-ngot-baby-tui-300g.jpg', 'vegetables', 6, '2021-12-18 08:55:34', '2021-12-18 08:55:34', '2021-12-23 08:55:34'),
(47, 'Cải ngồng baby', 18000.00, 50, '300g', 'cai-ngong-baby-tui-300g.jpg', 'vegetables', 6, '2021-12-18 09:04:42', '2021-12-18 09:04:42', '2021-12-23 09:04:42'),
(48, 'Bắp cải tím', 27500.00, 50, '500g', 'bap-cai-tim-tui-500g.jpg', 'vegetables', 6, '2021-12-18 09:19:22', '2021-12-18 09:19:22', '2021-12-23 09:19:21'),
(49, 'Bắp cải trắng', 17500.00, 50, '500g', 'bap-cai-trang-tui-500g.jpg', 'vegetables', 7, '2021-12-18 09:20:08', '2021-12-18 09:20:08', '2021-12-23 09:20:08'),
(50, 'Bắp cải trái tim', 18500.00, 50, '500g', 'bap-cai-trai-tim-tui-500g.jpg', 'vegetables', 7, '2021-12-18 09:21:29', '2021-12-18 09:21:29', '2021-12-23 09:21:29'),
(51, 'Bông cải xanh', 21000.00, 50, '300g', 'bong-cai-xanh-tui-300g.jpg', 'vegetables', 7, '2021-12-18 09:57:18', '2021-12-18 09:57:18', '2021-12-23 09:57:18'),
(54, 'Bông cải trắng làm sẵn', 41000.00, 50, '300g', 'bong-cai-trang-lam-san-khay-300g.jpg', 'vegetables', 7, '2021-12-18 10:14:30', '2021-12-18 10:14:30', '2021-12-23 10:14:30'),
(55, 'Củ cải trắng', 14000.00, 50, '500g (4-6 củ)', 'cu-cai-trang-tui-500g.jpg', 'vegetables', 7, '2021-12-18 10:19:11', '2021-12-18 10:19:11', '2021-12-23 10:19:11'),
(56, 'Rau tần ô', 15000.00, 50, '300g', 'rau-tan-o-tui-300g.jpg', 'vegetables', 7, '2021-12-18 10:20:52', '2021-12-18 10:20:52', '2021-12-23 10:20:52'),
(57, 'Cà rốt Đà Lạt', 17500.00, 50, '500g (4-6 củ)', 'ca-rot-da-lat-tui-500g.jpg', 'vegetables', 8, '2021-12-18 10:23:14', '2021-12-18 10:23:14', '2021-12-23 10:23:14'),
(58, 'Cà chua', 30000.00, 50, '500g (7-9 trái)', 'ca-chua-tui-500g.jpg', 'vegetables', 8, '2021-12-18 10:24:43', '2021-12-18 10:24:43', '2021-12-23 10:24:43'),
(59, 'Dưa leo baby', 25000.00, 50, '500g (10-12 trái)', 'dua-leo-baby-vi-500g.jpg', 'vegetables', 8, '2021-12-18 10:29:30', '2021-12-18 10:29:30', '2021-12-23 10:29:30'),
(60, 'Khoai lang Nhật', 35000.00, 50, '1kg (4-6 củ)', 'khoai-lang-nhat-1kg.jpg', 'vegetables', 8, '2021-12-18 10:30:45', '2021-12-18 10:30:45', '2021-12-23 10:30:45'),
(61, 'Ớt chuông xanh', 24000.00, 50, '300g (1-3 trái)', 'ot-chuong-xanh-tui-300g.jpg', 'vegetables', 8, '2021-12-18 10:31:48', '2021-12-18 10:31:48', '2021-12-23 10:31:48'),
(62, 'Ớt chuông đỏ', 24000.00, 50, '300g (1-2 quả)', 'ot-chuong-do-tui-300g.jpg', 'vegetables', 8, '2021-12-18 10:32:42', '2021-12-18 10:32:42', '2021-12-23 10:32:42'),
(63, 'Bí ngòi xanh', 20000.00, 50, '500g (1-3 trái)', 'bi-ngoi-xanh-goi-500g.jpg', 'vegetables', 1, '2021-12-18 10:34:55', '2021-12-18 10:34:55', '2021-12-23 10:34:54'),
(64, 'Khổ qua', 20000.00, 50, '500g (2-4 trái)', 'kho-qua-tui-500g.jpg', 'vegetables', 1, '2021-12-18 10:35:26', '2021-12-18 10:35:26', '2021-12-23 10:35:26'),
(65, 'Củ sắn', 20000.00, 50, '1kg (3-5 củ)', 'cu-san-tui-1kg.jpg', 'vegetables', 1, '2021-12-18 10:44:40', '2021-12-18 10:44:40', '2021-12-23 10:44:40'),
(66, 'Bắp mỹ', 18000.00, 50, '2 trái', 'bap-my-2-trai.jpg', 'vegetables', 1, '2021-12-18 10:45:41', '2021-12-18 10:45:41', '2021-12-23 10:45:41'),
(67, 'Mướp hương', 15000.00, 50, '500g (1-3 trái)', 'muop-huong-tui-500g.jpg', 'vegetables', 1, '2021-12-18 10:47:03', '2021-12-18 10:47:03', '2021-12-23 10:47:03'),
(68, 'Cà tím', 15000.00, 50, '500g (2-4 trái)', 'ca-tim-tui-500g.jpg', 'vegetables', 1, '2021-12-18 13:08:52', '2021-12-18 13:08:52', '2021-12-23 13:08:52'),
(69, 'Khoai tây', 15000.00, 50, '500g (5-7 củ)', 'khoai-tay-tui-500g.jpg', 'vegetables', 1, '2021-12-18 13:16:54', '2021-12-18 13:16:54', '2021-12-23 13:16:54'),
(70, 'Bầu sao', 15000.00, 50, '500g (1-2 trái)', 'bau-sao-tui-500g.jpg', 'vegetables', 1, '2021-12-18 13:18:27', '2021-12-18 13:18:27', '2021-12-23 13:18:27'),
(71, 'Củ dền', 13500.00, 50, '500g (2-4 củ)', 'cu-den-tui-500g.jpg', 'vegetables', 1, '2021-12-18 13:20:04', '2021-12-18 13:20:04', '2021-12-23 13:20:04'),
(72, 'Bí xanh', 12500.00, 50, '500g (1-2 trái)', 'bi-xanh-tui-500g.jpg', 'vegetables', 1, '2021-12-18 13:21:13', '2021-12-18 13:21:13', '2021-12-23 13:21:13'),
(73, 'Hành tây', 12000.00, 50, '300g (3-5 củ)', 'hanh-tay-tui-300g.jpg', 'vegetables', 1, '2021-12-18 13:22:34', '2021-12-18 13:22:34', '2021-12-23 13:22:34'),
(74, 'Su hào xanh', 10500.00, 50, '300g', 'su-hao-xanh-tui-300g.jpg', 'vegetables', 1, '2021-12-18 13:23:47', '2021-12-18 13:23:47', '2021-12-23 13:23:47'),
(75, 'Gừng túi', 4000.00, 50, '100g (2-4 củ)', 'gung-tui-100g.jpeg', 'vegetables', 1, '2021-12-18 13:36:18', '2021-12-18 13:36:18', '2021-12-23 13:36:18'),
(76, 'Bí đỏ hồ lô', 17500.00, 50, '700g', 'bi-do-ho-lo-tui-700g.jpg', 'vegetables', 1, '2021-12-18 13:36:52', '2021-12-18 13:36:52', '2021-12-23 13:36:52'),
(77, 'Bông cải trắng', 35000.00, 50, '500g', 'bong-cai-trang-tui-500g.jpg', 'vegetables', 1, '2021-12-18 13:37:55', '2021-12-18 13:37:55', '2021-12-23 13:37:55'),
(78, 'Táo Rockit', 149000.00, 50, 'ống 4 trái', 'tao-rockit-ong-4-trai.jpg', 'fruit', 1, '2021-12-18 14:14:17', '2021-12-22 11:26:03', '2021-12-23 14:14:17'),
(80, 'Táo nữ hoàng Queen', 79000.00, 50, 'Nhập khẩu New Zealand hộp 1kg (5-7 trái) (trái lớn, nhỏ tuỳ lô hàng)', 'tao-nu-hoang-queen-nhap-khau-new-zealand-hop-1kg-4-6-trai-trai-lon-nho-tuy-lo-hang.jpg', 'fruit', 1, '2021-12-18 14:17:50', '2021-12-22 12:30:48', '2021-12-23 14:17:50'),
(81, 'Lựu ngọt hạt lép', 167700.00, 50, 'Nhập khẩu Trung Quốc (1.3kg)', 'luu-ngot-hat-lep-nhap-khau-trung-quoc-tui-1kg.jpg', 'fruit', 1, '2021-12-18 14:21:40', '2021-12-22 10:24:53', '2021-12-23 14:21:40'),
(82, 'Kiwi vàng Zespri', 99500.00, 50, '500g (3-5 trái)', 'kiwi-vang-tui-500g.jpg', 'fruit', 1, '2021-12-18 14:24:42', '2021-12-22 11:26:09', '2021-12-23 14:24:42'),
(83, 'Kiwi xanh Zespri', 64500.00, 50, '500g (3-5 trái)', 'kiwi-xanh-zespri-hop-500g-3-5-trai.jpg', 'fruit', 1, '2021-12-18 14:25:19', '2021-12-22 11:26:14', '2021-12-23 14:25:19'),
(84, 'Việt quất hộp', 149000.00, 50, '125g', 'viet-quat-hop-125g.jpg', 'fruit', 1, '2021-12-18 14:30:38', '2021-12-18 14:30:38', '2021-12-23 14:30:38'),
(85, 'Nho xanh không hạt', 134500.00, 50, '500g', 'nho-xanh-khong-hat-tui-500g.jpeg', 'fruit', 1, '2021-12-18 14:33:06', '2021-12-18 14:33:06', '2021-12-23 14:33:06'),
(86, 'Nho đen nhập khẩu', 104500.00, 50, '500g', 'nho-den-nhap-khau-hop-500g.jpg', 'fruit', 1, '2021-12-18 14:34:25', '2021-12-18 14:34:25', '2021-12-23 14:34:25'),
(87, 'Xoài cát Hoà Lộc', 75100.00, 50, '1kg (1-3 trái)', 'xoai-cat-hoa-loc-tui-1kg.jpg', 'fruit', 1, '2021-12-18 14:36:29', '2021-12-18 14:36:29', '2021-12-23 14:36:29'),
(88, 'Cam vàng Navel', 75000.00, 50, 'Nhập khẩu Ai Cập 1kg (4-6 trái)', 'cam-vang-navel-nhap-khau-ai-cap-hop-1kg-4-6-trai.jpg', 'fruit', 8, '2021-12-18 14:38:10', '2021-12-21 15:51:06', '2021-12-23 14:38:10'),
(89, 'Cam vàng nhập khẩu', 89000.00, 50, '1kg', 'cam-vang-nhap-khau-1kg.jpg', 'fruit', 8, '2021-12-18 14:39:42', '2021-12-21 15:51:13', '2021-12-23 14:39:42'),
(90, 'Mãng cầu na', 71000.00, 50, '1kg (2-4 trái)', 'mang-cau-na-tui-500g.jpg', 'fruit', 8, '2021-12-18 14:40:45', '2021-12-21 15:51:53', '2021-12-23 14:40:45'),
(91, 'Bưởi da xanh', 70500.00, 50, '1.5kg', 'buoi-da-xanh-tui-15kg.jpg', 'fruit', 1, '2021-12-18 14:41:49', '2021-12-21 16:00:55', '2021-12-23 14:41:49'),
(92, 'Vú sữa bơ hồng', 55000.00, 50, '1kg', 'vu-sua-bo-hong-tui-1kg.jpg', 'fruit', 1, '2021-12-18 14:42:50', '2021-12-21 16:03:48', '2021-12-23 14:42:50'),
(93, 'Dưa hấu không hạt', 50000.00, 50, '2kg', 'dua-hau-khong-hat-tui-2kg.jpg', 'fruit', 1, '2021-12-18 14:43:39', '2021-12-18 14:43:39', '2021-12-23 14:43:39'),
(94, 'Quả hồng giòn', 49000.00, 50, 'Nhập khẩu Trung Quốc 1kg', 'hong-gion-nhap-khau-new-zealand-1kg.jpg', 'fruit', 1, '2021-12-18 14:45:05', '2021-12-18 14:45:05', '2021-12-23 14:45:05'),
(95, 'Dưa hấu đỏ', 46000.00, 50, '2kg (1-2 trái)', 'dua-hau-do-tui-2kg-1-2-trai.jpg', 'fruit', 1, '2021-12-18 14:51:24', '2021-12-18 14:51:24', '2021-12-23 14:51:24'),
(96, 'Chuối sứ', 22000.00, 50, '1kg (14-16 trái) (giao ngẫu nhiên chuối sống hoặc chín)', 'chuoi-su-tui-500g-giao-ngau-nhien-chuoi-song-hoac-chin.jpg', 'fruit', 1, '2021-12-18 14:52:36', '2021-12-18 14:52:36', '2021-12-23 14:52:36'),
(97, 'Chuối cau', 22000.00, 50, '1kg (15-17 trái) (giao ngẫu nhiên chuối sống hoặc chín)', 'chuoi-cau-tui-500g.jpg', 'fruit', 1, '2021-12-18 14:53:53', '2021-12-18 14:53:53', '2021-12-23 14:53:53'),
(98, 'Mận đá đường', 17500.00, 50, '500g (8-10 trái)', 'man-da-duong-tui-1kg.jpg', 'fruit', 1, '2021-12-18 14:55:20', '2021-12-18 14:55:20', '2021-12-23 14:55:20'),
(99, 'Ổi Đài Loan', 17000.00, 50, '1kg', 'oi-dai-loan-tui-1kg.jpg', 'fruit', 1, '2021-12-18 14:57:43', '2021-12-18 14:57:43', '2021-12-23 14:57:43'),
(100, 'Mía tươi cắt khúc', 15500.00, 50, '500g', 'mia-tuoi-cat-khuc-tui-500g.jpg', 'fruit', 1, '2021-12-18 14:58:51', '2021-12-18 14:58:51', '2021-12-23 14:58:51'),
(101, 'Quýt nhập khẩu', 17800.00, 50, '500g', 'quyt-nhap-khau-1kg-3-4-trai-kg.jpg', 'fruit', 1, '2021-12-18 14:59:42', '2021-12-18 14:59:42', '2021-12-23 14:59:42'),
(102, 'Táo Ninh Thuận', 25000.00, 50, '1kg (16-18 trái)', 'tao-ninh-thuan-dac-biet-tui-500g.jpg', 'fruit', 1, '2021-12-18 15:00:45', '2021-12-18 15:00:45', '2021-12-23 15:00:45'),
(103, 'Mít Thái', 25000.00, 50, '1kg', 'mit-thai-1kg.jpg', 'fruit', 1, '2021-12-18 15:03:09', '2021-12-18 15:03:09', '2021-12-23 15:03:09'),
(104, 'Thanh long trắng', 27000.00, 50, '1kg (1-3 trái)', 'thanh-long-tui-1kg.jpg', 'fruit', 1, '2021-12-18 15:03:46', '2021-12-18 15:03:46', '2021-12-23 15:03:46'),
(105, 'Thanh long ruột đỏ', 27000.00, 50, '1kg (2-4 trái)', 'thanh-long-ruot-do-tui-1kg.jpg', 'fruit', 1, '2021-12-18 15:04:32', '2021-12-18 15:04:32', '2021-12-23 15:04:32'),
(106, 'Chuối già', 27000.00, 50, 'Giống Nam Mỹ hộp 1kg (4-6 trái)', 'chuoi-gia-giong-nam-my-hop-1kg-4-6-trai.jpg', 'fruit', 1, '2021-12-18 15:05:22', '2021-12-18 15:05:22', '2021-12-23 15:05:22'),
(107, 'Ổi nữ hoàng', 25000.00, 50, '1kg (3-5 trái)', 'oi-nu-hoang-tui-500g.jpg', 'fruit', 1, '2021-12-18 15:05:56', '2021-12-18 15:05:56', '2021-12-23 15:05:56'),
(108, 'Nhãn thái chùm', 29000.00, 50, '1kg', 'nhan-thai-chum-tui-1kg.jpg', 'fruit', 1, '2021-12-18 15:06:34', '2021-12-18 15:06:34', '2021-12-23 15:06:34'),
(109, 'Mận An Phước', 35000.00, 50, '1kg (7-9 trái)', 'man-an-phuoc-tui-500g.jpg', 'fruit', 1, '2021-12-18 15:07:08', '2021-12-18 16:06:27', '2021-12-23 15:07:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `roles_id` int(2) NOT NULL,
  `roles_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`roles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`roles_id`, `roles_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2021-05-29 09:37:03', '2021-05-29 09:37:03'),
(2, 'Customer', '2021-05-29 09:37:03', '2021-05-29 09:37:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `status`
--

INSERT INTO `status` (`status_id`, `status_name`, `created_at`, `updated_at`) VALUES
(1, 'Còn hàng', NULL, NULL),
(2, 'Hết hàng', NULL, NULL),
(3, 'Đã duyệt', NULL, NULL),
(4, 'Chưa duyệt', NULL, NULL),
(5, 'Hết HSD', NULL, NULL),
(6, 'Sản phẩm bán chạy', NULL, NULL),
(7, 'Sản phẩm mới', NULL, NULL),
(8, 'Sản phẩm giảm giá', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `roles_id` int(2) DEFAULT 2,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `roles_id` (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `pass`, `roles_id`, `address`, `created_at`, `updated_at`) VALUES
(42, 'Vương Tuấn Đạt', 'dat230300@gmail.com', '0932761318', '$2y$10$xtCD2.fW7V3lluNp72aWLO.Zac2UTz9Qp5ZfLMe6MEkIupt18l2Vu', 1, '97/2 Bình Thới P11,Q11', '2021-11-15 14:05:10', '2022-01-17 13:29:23'),
(67, 'test', 'abc@gmail.com', '0932761318', '$2y$10$0H7xBfkjDo09QaaGeUfGEudhZjZ.XQQbGR/f7UeMR.CCDvh2OqaGO', 2, '19126', '2021-12-29 10:16:56', '2022-01-17 13:37:56'),
(68, 'aaa', '123@gmail.com', '0932761318', '$2y$10$wyJT/lXr3bgUPm1BF9hKNOVwzXX.XY2toHaJ82zUZtHS9E5oy5tW2', 1, '97/2 bình thới p11, q11', '2022-01-16 12:39:27', '2022-01-17 13:29:55'),
(69, 'Đào Ngọc Tiến', 'ngoctien@gmail.com', '0703569944', '$2y$10$jQYeEUidZOsK2TvTG4.U7.2zswx8oQMjFyvkkAOdSRXSa5M5SGhI2', 2, 'Cầu cây dừa', '2022-01-17 12:02:27', '2022-01-17 13:29:27');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`products_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`products_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`categories_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`roles_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
