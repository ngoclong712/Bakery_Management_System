-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 23, 2024 lúc 04:07 PM
-- Phiên bản máy phục vụ: 8.0.34
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bakery`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `level`) VALUES
(1, 'Admin', 'admin@gmail.com', '123', 0),
(2, 'Super Admin', 'sadmin@gmail.com', '234', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` char(20) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `token`, `phone`, `address`) VALUES
(1, 'Ngọc Long', 'ngoclong@gmail.com', '123', 'user_66180754b9b042.32835089', '0123123123', 'Hà Nội'),
(2, 'Minh Long', 'minhlong@gmail.com', '234', NULL, '0345678910', 'Đà Nẵng'),
(3, 'Dương', 'duong@gmail.com', '123', NULL, '123', 'Hà Đông'),
(5, 'VNL', 'vanngoclong2003@gmail.com', 'abcd1234', NULL, '0123456123', 'Quảng Nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `forgot_password`
--

CREATE TABLE `forgot_password` (
  `customer_id` int NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `phone` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `address`, `phone`, `photo`) VALUES
(1, 'Thúy Đỗ', 'Hà Nội', '0123456789', '1712484571.png'),
(2, 'Đức Đô', 'Thành Phố Hồ Chí Minh', '0123456789', '1712462894.png'),
(5, 'Bami Bread', 'Hoàn Kiếm Hà Nội', '01111111111', '1712763755.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `name_receiver` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_receiver` char(20) COLLATE utf8mb4_general_ci NOT NULL,
  `address_receiver` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `name_receiver`, `phone_receiver`, `address_receiver`, `status`, `created_at`, `total_price`) VALUES
(4, 1, 'Ngọc Long', '0123123123', 'Hà Nội', 1, '2024-04-14 05:26:30', 114),
(5, 3, 'Minh Long', '0345678910', 'Đà Nẵng', 0, '2024-04-23 15:09:56', 43);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`) VALUES
(4, 5, 3),
(4, 6, 1),
(4, 7, 1),
(4, 8, 1),
(5, 5, 1),
(5, 6, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `type_id` int NOT NULL,
  `manufacturer_id` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `photo`, `price`, `type_id`, `manufacturer_id`, `description`) VALUES
(1, 'Xá xíu phô mai', '1713068864.jpg', 20, 1, 1, 'Bánh bao siêu ngon'),
(2, 'Thịt 2 trứng', '1712768021.jpg', 19, 1, 1, 'aaaab'),
(4, 'Thịt trứng muối', '1713068908.jpg', 25, 1, 1, 'Mô tả tạm thời'),
(5, 'Cốm dừa', '1713068937.jpg', 13, 1, 1, 'Mt'),
(6, 'Nguyên cám xá xíu phô mai', '1713068970.jpg', 30, 1, 1, 'mt'),
(7, 'Chay gạo lứt', '1713069110.jpg', 15, 1, 1, 'mt'),
(8, 'Gà nấm gạo lứt phô mai', '1713069175.jpg', 30, 1, 1, 'mt'),
(9, 'Chay nguyên cám', '1713069197.jpg', 15, 1, 1, 'mt'),
(10, 'Gà nấm gạo lứt', '1713069227.jpg', 25, 1, 1, 'mt'),
(11, 'Bông lan trứng muối', '1713069577.jpg', 100, 3, 2, 'mt'),
(12, 'Kem socola', '1713069599.jpeg', 120, 3, 2, 'mt'),
(13, 'Kem sữa tươi', '1713069625.jpg', 120, 3, 2, 'mt'),
(14, 'Ngọt', '1713069667.jpg', 20, 4, 2, 'mt'),
(15, 'Thú nổi', '1713069689.jpg', 130, 3, 2, 'mt'),
(16, 'Gà nướng', '1713069995.jpg', 35, 2, 5, 'mt'),
(17, 'Bánh hội an', '1713070011.jpg', 40, 2, 5, 'mt'),
(18, 'Bánh lợn nướng', '1713070032.jpg', 35, 2, 5, 'mt'),
(19, 'Bánh pate trứng', '1713070054.jpg', 30, 2, 5, 'mt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type`
--

CREATE TABLE `type` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'bánh bao'),
(2, 'bánh mì'),
(3, 'bánh kem'),
(4, 'bánh ngọt');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Chỉ mục cho bảng `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Chỉ mục cho bảng `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `type`
--
ALTER TABLE `type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
