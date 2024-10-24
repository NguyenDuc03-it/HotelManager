-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 24, 2024 lúc 11:35 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlkhachsan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `check_in_date` varchar(50) DEFAULT NULL,
  `check_out_date` varchar(50) DEFAULT NULL,
  `price_booking` char(30) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Chưa thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`booking_id`, `customer_id`, `room_id`, `check_in_date`, `check_out_date`, `price_booking`, `status`) VALUES
(1, 1, 9, '10-01-2024', '20-01-2024', '22,000,000', 'Đã thanh toán'),
(2, 11, 8, '10-01-2024', '20-01-2024', '16,500,000', 'Đã thanh toán'),
(14, 1, 1, '10-01-2024', '20-01-2024', '2,200,000', 'Đã thanh toán'),
(23, 11, 2, '24/9/2024', '24/9/2024', '200,000', 'Đã thanh toán'),
(24, 2, 6, '20-06-2024', '24-06-2024', '5,000,000', 'Đã thanh toán'),
(25, 11, 2, '24/9/2024', '24/9/2024', '200,000', 'Đã thanh toán'),
(26, 13, 12, '25/9/2024', '29/9/2024', '25,000,000', 'Chưa thanh toán'),
(30, 13, 11, '24/9/2024', '24/9/2024', '10,000,000', 'Chưa thanh toán'),
(31, 11, 2, '24/9/2024', '24/9/2024', '200,000', 'Đã thanh toán'),
(32, 11, 2, '24/9/2024', '29/9/2024', '1,200,000', 'Hủy đặt phòng'),
(33, 13, 10, '25/9/2024', '25/9/2024', '2,000,000', 'Hủy đặt phòng'),
(34, 12, 8, '25/9/2024', '25/9/2024', '1,500,000', 'Hủy đặt phòng'),
(35, NULL, 3219, '26/9/2024', '27/9/2024', '20,000,000', 'Hủy đặt phòng'),
(36, 12, 3219, '29/9/2024', '29/9/2024', '10,000,000', 'Chưa thanh toán'),
(37, 12, 1, '27/9/2024', '27/9/2024', '200,000', 'Hủy đặt phòng'),
(38, 3, 1, '27/9/2024', '29/9/2024', '600,000', 'Đã thanh toán'),
(39, 21, 1, '27/9/2024', '30/9/2024', '800,000', 'Đã thanh toán'),
(40, 22, 3221, '27/9/2024', '30/9/2024', '800,000', 'Đã thanh toán'),
(41, 23, 3221, '27/9/2024', '28/9/2024', '400,000', 'Đã thanh toán'),
(42, 23, 3221, '27/9/2024', '27/9/2024', '200,000', 'Đã thanh toán'),
(43, 24, 3221, '27/9/2024', '30/9/2024', '800,000', 'Đã thanh toán'),
(44, 24, 13, '27/9/2024', '30/9/2024', '10,000,000', 'Đã thanh toán'),
(45, 24, 10, '28/9/2024', '30/9/2024', '6,000,000', 'Đã thanh toán'),
(46, 24, 14, '28/9/2024', '1/10/2024', '28,000,000', 'Đã thanh toán'),
(47, 24, 10, '28/9/2024', '1/10/2024', '8,000,000', 'Đã thanh toán'),
(48, 20, 6, '28/9/2024', '29/9/2024', '2,000,000', 'Đã thanh toán'),
(49, 25, 6, '28/9/2024', '29/9/2024', '2,000,000', 'Đã thanh toán'),
(50, 25, 6, '28/9/2024', '29/9/2024', '2,000,000', 'Hủy đặt phòng'),
(51, 11, 6, '28/9/2024', '29/9/2024', '2,000,000', 'Đã thanh toán'),
(52, 26, 13, '29/9/2024', '29/9/2024', '2,500,000', 'Đã thanh toán'),
(53, 26, 13, '29/9/2024', '29/9/2024', '2,500,000', 'Đã thanh toán'),
(54, 26, 3222, '29/9/2024', '1/10/2024', '16,500,000', 'Chưa thanh toán'),
(56, 27, 3223, '29/9/2024', '30/9/2024', '22,000,000', 'Đã thanh toán'),
(57, NULL, 3224, '29/9/2024', '30/9/2024', '4,000,000', 'Hủy đặt phòng'),
(58, NULL, 3224, '29/9/2024', '30/9/2024', '4,000,000', 'Hủy đặt phòng'),
(59, 31, 3224, '29/9/2024', '30/9/2024', '4,000,000', 'Đã thanh toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `sex` varchar(5) NOT NULL,
  `cccd` varchar(15) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customer_id`, `fullname`, `sex`, `cccd`, `phone`) VALUES
(1, 'Nguyễn Khách Hàng Nam', 'Nam', '036203004478', '0123456'),
(2, 'Ngô Khách Hàng Nữ', 'Nữ', '032034239012', '04324'),
(3, 'Nguyễn Văn A', 'Nam', '038036259017', '03288911279'),
(11, 'John Smith', 'Nam', '032189211238', '03218991192'),
(12, 'nguyen trung duc', 'Nam', '123432', '123432'),
(13, 'People test', 'Nam', '123431', '0321889193'),
(15, 'flakjfa', 'Nam', '0363219389', '0321889193'),
(20, 'test', 'Nam', '12311332131', '1231113123'),
(21, 'nguyen trung duc', 'Nam', '0321889193', '123431'),
(22, 'Ngo Van Nam', 'Nữ', '027203007782', '0854128229'),
(23, 'Nam Van', 'Nam', '20214032', '1234567890'),
(24, 'duc nguyen', 'Nam', '0123456', '0123456'),
(25, 'test', 'Nam', '1231113123', '1231133213'),
(26, 'test 2', 'Nam', '123789', '123789'),
(27, 'test 3', 'Nam', '12378910', '123789'),
(28, 'Huy', 'Nữ', '087659241', '0987654312'),
(31, 'Nam Van', 'Nam', '1234567', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` char(25) NOT NULL,
  `password` char(25) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `name`) VALUES
(1, 'admin1', '123', 'Nguyễn Văn A');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `payment_date` varchar(50) DEFAULT NULL,
  `amount` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `staff_id`, `payment_date`, `amount`) VALUES
(14, 1, 3, '10/01/2024', '2,000,00'),
(20, 38, 1, '27/09/2024', '200,000'),
(21, 39, 1, '27/09/2024', '200,000'),
(22, 40, 1, '27/09/2024', '200,000'),
(23, 41, 1, '27/09/2024', '200,000'),
(24, 42, 1, '27/09/2024', '200,000'),
(25, 43, 1, '27/09/2024', '200,000'),
(26, 44, 1, '27/09/2024', '2,500,000'),
(27, 44, 1, '27/09/2024', '2,500,000'),
(28, 45, 1, '28/09/2024', '2,000,000'),
(29, 46, 1, '28/09/2024', '7,000,000'),
(31, 47, 1, '28/09/2024', '2,000,000'),
(32, 48, 1, '28/09/2024', '1,000,000'),
(33, 49, 1, '28/09/2024', '1,000,000'),
(34, 51, 1, '28/09/2024', '1,000,000'),
(35, 52, 1, '29/09/2024', '2,500,000'),
(36, 53, 1, '29/09/2024', '2,500,000'),
(37, 56, 1, '29/09/2024', '11,000,000'),
(38, 59, 1, '29/09/2024', '2,000,000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_number` varchar(10) DEFAULT NULL,
  `room_type` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `room_type`, `price`, `status`) VALUES
(1, '101', 'Standard', '200,000', 'Trống'),
(2, '102', 'Standard', '200,000', 'Trống'),
(4, '103', 'Standard', '200,000', 'Trống'),
(6, '201', 'Premium', '1,000,000', 'Trống'),
(8, '202', 'Premium', '1,500,000', 'Trống'),
(9, '203', 'Premium', '2,000,000', 'Trống'),
(10, '301', 'Premium', '2,000,000', 'Trống'),
(11, '302', 'Deluxe', '10,000,000', 'Đã đặt'),
(12, '303', 'Superior', '5,000,000', 'Đã đặt'),
(13, '304', 'Premium', '2,500,000', 'Trống'),
(14, '305', 'Suite', '7,000,000', 'Trống'),
(3219, '306', 'Suite', '10,000,000', 'Đã đặt'),
(3221, '401', 'Standard', '200,000', 'Trống'),
(3222, '402', 'Superior', '5,500,000', 'Đã đặt'),
(3223, '403', 'Deluxe', '11,000,000', 'Trống'),
(3224, '501', 'Premium', '2,000,000', 'Trống');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `sex` varchar(5) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `username` char(30) NOT NULL,
  `password` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `staff`
--

INSERT INTO `staff` (`staff_id`, `fullname`, `sex`, `position`, `email`, `phone`, `username`, `password`) VALUES
(1, 'Nguyễn Trung Đức', 'Nam', 'ADMIN', 'nguyentrungduc@gmail.com', '0123456', 'admin1', '1234'),
(2, 'Ngô Văn Nam', 'Nam', 'ADMIN', 'ngovannam@gmail.com', '0123456', 'admin2', '123'),
(3, 'Nguyễn Văn A', 'Nam', 'Nhân viên', 'nguyenvana@gmail.com', '032112123', 'nguyenvana', '123'),
(4, 'Nguyễn Văn B', 'Nam', 'Nhân viên', 'nguyenvanb@gmail.com', '0123456', 'nguyenvanb', '123'),
(5, 'Ngô Văn Nam', 'Nam', 'Nhân viên', 'nam@gmail.com', '03211111132', 'nam', '123'),
(7, 'people test', 'Nam', 'Nhân viên', 'nhanvien123@gmail.com', '032777635', 'nhanvien123', '123'),
(8, 'person test', 'Nam', 'Nhân viên', 'persontest123@gmail.com', '03283211', 'nhanvien12', '123'),
(10, 'Ngo Van Nam', 'Nam', 'Nhân viên', 'namkoika@gmail.com', '085418229', 'NamVan', '123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Chỉ mục cho bảng `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3226;

--
-- AUTO_INCREMENT cho bảng `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
