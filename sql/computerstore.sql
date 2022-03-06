-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 05, 2022 lúc 05:41 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `computerstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` decimal(10,0) NOT NULL,
  `productImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `userId`, `productId`, `qty`, `productName`, `productPrice`, `productImage`) VALUES
(40, 1, 6, 1, 'Essex EUP-123EA1', '230000000', '4c301f519e.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(2, 'Bàn phím', 1),
(4, 'Tai nghe', 1),
(5, 'Chuột', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `receivedDate` date DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `userId`, `createdDate`, `receivedDate`, `status`) VALUES
(39, 31, '2021-12-07', '2021-12-07', 'Complete');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `productPrice` decimal(10,0) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `orderId`, `productId`, `qty`, `productPrice`, `productName`, `productImage`) VALUES
(36, 39, 7, 2, '3190000', 'GUITAR YAMAHA CX40', 'd3ac08c33e.jpg'),
(37, 39, 4, 1, '749000000', 'Boston GP-156', 'a30bcd79d7.jpg'),
(38, 39, 8, 3, '19000000', 'Taylor 114E', 'cb50eef0d8.jpg'),
(39, 39, 9, 4, '4200000', 'Takamine D2D', '758ded2800.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `originalPrice` decimal(10,0) NOT NULL,
  `promotionPrice` decimal(10,0) NOT NULL,
  `image` varchar(50) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `cateId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `soldCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `originalPrice`, `promotionPrice`, `image`, `createdBy`, `createdDate`, `cateId`, `qty`, `des`, `status`, `soldCount`) VALUES
(2, 'Bàn phím không dây Apple Magic Keyboard - MK2A3ZA/A', '2390000', '2390000', 'keyboard1.jpg', 1, '0000-00-00', 2, 96, 'Kết nối: Bluetooth, Lightning port, Wireless\r\nChiều cao: 0,41–1,09, rộng: 27,89, sâu: 11,49 cm\r\nTrọng lượng: 0.239 kg\r\nyêu cầu: Mac sử dụng macOS 11.3 trở lên\r\nPhụ kiện trong hộp: USB-C to Lightning Cable', 1, 4),
(3, 'Bàn phím cơ DareU EK87 Mutiled Blue Switch', '599000', '499000', 'keyboard2.png', 1, '0000-00-00', 2, 9, '- Kiểu: Bàn phím cơ \r\n- Kiểu kết nối: Có dây\r\n- Switch: Blue D switch\r\n- Đèn nền: Rainbow\r\n- Kích thước: Tenkeyless\r\n', 1, 1),
(4, 'Bàn phím cơ Corsair K60 Pro Viola switch', '1589000', '1589000', 'keyboard3.png', 1, '0000-00-00', 2, 19, 'Bàn phím cơ Corsair K60 Pro Viola switch,\r\nBàn phím cơ Gaming thế hệ mới,\r\nSử dụng switch Cherry Viola mới nhất,\r\nVỏ trên phím bằng nhôm anod đen.', 1, 1),
(5, 'Bàn phím cơ Corsair K70 RGB MK2 Red switch', '4000000', '3339000', 'keyboard4.jpg', 1, '0000-00-00', 2, 8, 'Bàn phím cơ Corsair K70 RGB MK2 Red switch,\r\nPhiên bản mới với nhiều cải tiến,\r\nBề mặt nhôm phay ( aluminum ),\r\nSử dụng switch Cherry MX RGB Red.', 1, 2),
(6, 'Bàn phím cơ Leopold FC750R PD Sweden Red switch', '3149000', '3149000', 'keyboard5.jpg', 1, '0000-00-00', 2, 7, 'Bàn phím cơ Leopold FC750R PD Sweden Red switch,\r\nBàn phím cơ sử dụng switch Cherry MX Red,\r\nKeycap làm bằng PBT siêu dày, độ bền cực cao, chống mài mòn cực tốt,\r\nKeycap Profile \"Cherry\" tiêu chuẩn.', 1, 3),
(7, 'Tai nghe Logitech G Pro Gen 2', '1600000', '1589000', 'tai1.jpg', 1, '2021-12-07', 4, 8, 'Tai nghe Logitech G Pro Gen 2,\r\nSử dụng màng loa Hybrid G-Pro mới nhất,\r\nTần số đáp ứng: 20 - 20.000Hz,\r\nVỏ nhựa Nilon pha sợi thủy tinh siêu bền.', 1, 2),
(8, 'Tai nghe chụp tai Gaming Logitech G431 7.1 Đen Xanh', '1900000', '1900000', 'tai2.jpeg', 1, '2021-12-07', 4, 7, '', 1, 3),
(9, 'Tai nghe DareU EH416 RGB (Đen)', '4200000', '4200000', 'tai3.png', 1, '2021-12-07', 4, 6, '- Kích thước Driver: 50 mm\r\n- Trở kháng: 32 ohms\r\n- Tần số: 20Hz-20KHz', 1, 4),
(10, 'TAI NGHE JBL TUNE 125TWS', '6350000', '6200000', 'tai4.jpg', 1, '2021-12-07', 4, 10, '', 1, 0),
(11, 'TAI NGHE IN EAR MARSHALL MODE', '2110000', '2110000', 'tai5.jpg', 1, '2021-12-07', 4, 10, 'Tai nghe Marshall Mode là một trong những mẫu tai nghe in-ear có dây nổi bật trong tầm giá đến từ thương hiệu Marshall, một trong những thương hiệu âm thanh hàng đầu đến từ Anh Quốc, với thiết kế bắt mắt cũng như công nghệ âm thanh đi kèm mà không phải bất cứ sản phẩm nào thuộc phân khúc tầm trung cũng có được.\r\n\r\nMarshall Mode là sự kết hợp hoàn hảo giữa thiết kế cổ điển, đẹp mắt và dải mid nịnh tai hẳn sẽ lấy lòng được rất nhiều người dùng – những ai từng trót yêu Marshall! ', 1, 0),
(12, 'TAI NGHE DENON AH-C100', '347000', '347000', 'tai6.jpg', 1, '2021-12-07', 4, 10, 'Tai nghe Denon AH-C100 thuộc dòng URBAN RAVER với 3 nút điều khiển từ xa và microphone, được thiết kế riêng cho tất cả các đời iPhone và iPod giúp đem đến cho bạn âm thanh nghe nhạc trung thực, âm bass chất lượng cao và tách bạch và dễ dàng trả lời điện thoại ngay cả nơi đông người ồn ào hay đang đi ngoài đường. Ngoài ra, Tai Nghe Denon AH - C100 còn hỗ trợ ứng dụng điều khiển nhạc trên iOS và Android. Tai Nghe Denon AH - C100 còn hỗ trợ thêm các đầu gắn vào tai với 3 kích cỡ (S, M, L) để bạn lựa chọn sử dụng phù hợp với kích cỡ tai.', 1, 0),
(13, 'Chuột gaming Logitech G102 Gen2 Lightsync (Đen)', '3100000', '3100000', 'chuot1.png', 1, '2021-12-07', 5, 20, 'Chuột gaming Logitech G102 Gen2 Lightsync có một thiết kế hiện đại, cao cấp. Sở hữu công nghệ LIGHTSYNC, cảm biến DPI cao và 6 nút tiện lợi giúp bạn dễ dàng sử dụng làm việc và chơi game hơn.\r\n\r\n', 1, 0),
(14, 'Chuột Logitech G502 Hero', '2900000', '2900000', 'chuot2.jpg', 1, '2021-12-07', 5, 15, 'Chuột Logitech G502 Hero tiếp nối thành công của mẫu chuột quốc dân G502, sử dụng cảm biến HERO 16K - cảm biến chính xác nhất, tốc độ xử lý khung hình nhanh nhất từ trước đến nay. Với gia tốc bằng 0 cùng với mức DPI chỉnh cực kỳ linh hoạt từ 100-16.000 giúp cảm biến HERO không có đối thủ trong các dòng chuột gaming hiện tại.', 1, 0),
(15, 'Chuột không dây Logitech G304 Lightspeed Wireless White', '2950000', '2950000', 'chuot3.png', 1, '2021-12-07', 5, 10, 'Chuột không dây Logitech G304 Lightspeed là sản phẩm gaming gear có giá thành rẻ, được thiết kế mang lại hiệu suất ổn định với các đột phá về công nghệ.', 1, 0),
(16, 'Chuột Gaming Razer DeathAdder Essential', '4430000', '4430000', 'chuot4.png', 1, '2021-12-07', 5, 10, 'Loại sản phẩm: Chuột gaming có dây,\r\nDPI: Lên đến 6400 DPI,\r\nTrọng lượng: 96g,\r\nĐộ bền Switch chuột: 10 triệu lượt nhấn,\r\nBảo hành 24 tháng ( giữ box sản phẩm ).', 1, 0),
(17, 'Chuột máy tính DARE-U EM908', '251000', '251000', 'chuot5.png', 1, '2021-12-07', 5, 20, '- Kiểu kết nối: Có dây\r\n- Cảm biến: ATG4090\r\n- Độ phân giải: 600-6400 DPI\r\n- Màu sắc: Đen', 1, 0),
(18, 'Chuột không dây Logitech MX Master 3', '1430000', '1430000', 'chuot6.jpg', 1, '2021-12-07', 5, 5, 'Chuột Logitech MX Master 3 Wireless Mid Grey,\r\nCảm biến Darkfield 4000DPI có thể sử dụng trên mặt kính,\r\nCó nút cuộn phụ cho phép cuộn ngang hoặc gán các chức năng khác nhau.\r\nKích thước: 124.9 mm (dài) x 84.3 mm (rộng) x 51 mm (cao),\r\nTrọng lượng: 141g.', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Normal');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `address` varchar(500) NOT NULL,
  `isConfirmed` tinyint(4) NOT NULL DEFAULT 0,
  `captcha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `dob`, `password`, `role_id`, `status`, `address`, `isConfirmed`, `captcha`) VALUES
(1, 'admin@gmail.com', 'Nguyễn Lập An Khương', '2021-11-01', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '', 1, ''),
(31, 'lapankhuongnguyen@gmail.com', 'khuong nguyen', '2021-12-06', 'c4ca4238a0b923820dcc509a6f75849b', 2, 1, 'CanTho', 1, '56661');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `product_id` (`productId`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`orderId`),
  ADD KEY `product_id` (`productId`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cate_id` (`cateId`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cateId`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
