-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 12, 2025 lúc 03:03 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `store_book`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `ma_ad` int(11) NOT NULL,
  `ten_ad` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `dia_chi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`ma_ad`, `ten_ad`, `username`, `password`, `email`, `sdt`, `dia_chi`) VALUES
(1, 'Admin Chapter One', 'admin', 'root', 'admin@chapterone.com', '0964789010', '180 Cao Lo, Quan 8, TP.HCM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `ma_cart` int(11) NOT NULL,
  `ma_kh` int(11) DEFAULT NULL,
  `ma_sp` int(11) DEFAULT NULL,
  `size` varchar(11) DEFAULT NULL,
  `loai_mau` varchar(255) DEFAULT NULL,
  `soluong` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`ma_cart`, `ma_kh`, `ma_sp`, `size`, `loai_mau`, `soluong`) VALUES
(2, 1, 7, 'Bìa Mềm', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `ma_danhmuc` int(11) NOT NULL,
  `ten_danhmuc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`ma_danhmuc`, `ten_danhmuc`) VALUES
(1, 'Văn Học - Tiểu Thuyết'),
(2, 'Kinh Tế - Quản Trị'),
(3, 'Tâm Lý - Kỹ Năng'),
(4, 'Truyện Tranh (Manga)'),
(5, 'Sách Thiếu Nhi'),
(6, 'Sách Ngoại Văn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dacdiem_sp`
--

CREATE TABLE `dacdiem_sp` (
  `ma_dacdiem` int(11) NOT NULL,
  `phien_ban` varchar(255) DEFAULT NULL,
  `soluong_tonkho` int(11) DEFAULT NULL,
  `ma_sp` int(11) DEFAULT NULL,
  `chat_lieu` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dacdiem_sp`
--

INSERT INTO `dacdiem_sp` (`ma_dacdiem`, `phien_ban`, `soluong_tonkho`, `ma_sp`, `chat_lieu`) VALUES
(1, 'Tiếng Việt', 100, 1, 'Bìa Mềm'),
(2, 'Tiếng Anh', 50, 1, 'Bìa Mềm'),
(3, 'Bản Đặc Biệt', 20, 1, 'Bìa Cứng'),
(4, 'Tái bản 2024', 200, 2, 'Bìa Mềm'),
(5, 'Tiếng Việt', 150, 3, 'Bìa Mềm'),
(6, 'Tiếng anh', 30, 3, 'Bìa Cứng'),
(7, 'Tiếng Việt', 500, 4, 'Tiêu Chuẩn'),
(8, 'Bản kỹ niệm', 100, 5, 'Bìa Mềm'),
(9, 'Bản Thường', 120, 6, 'Bìa Mềm'),
(10, 'Có Chữ Ký', 10, 6, 'Bìa Mềm'),
(11, 'Tiếng Việt', 80, 7, 'Bìa Mềm'),
(12, 'Tiếng Việt', 90, 8, 'Bìa Mềm'),
(13, 'Bản Kỷ Niệm', 40, 8, 'Bìa Cứng'),
(14, 'Tiếng Việt', 60, 9, 'Bìa Mềm'),
(15, 'Bản có chữ ký', 300, 10, 'Tiêu Chuẩn'),
(16, 'Tiếng Việt', 70, 11, 'Bìa Mềm'),
(17, 'Tiếng Anh', 25, 11, 'Bìa Mềm'),
(18, 'Tiếng Việt', 100, 12, 'Bìa Mềm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nxb`
--

CREATE TABLE `nxb` (
  `ma_nxb` int(11) NOT NULL,
  `ten_nxb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nxb`
--

INSERT INTO `nxb` (`ma_nxb`, `ten_nxb`) VALUES
(1, 'NXB Trẻ'),
(2, 'NXB Kim Đồng'),
(3, 'Nhã Nam'),
(4, 'First News'),
(5, 'SkyBooks'),
(6, 'Alphabooks'),
(7, 'NXB Văn Học'),
(8, 'NXB Tổng Hợp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `ma_dh` int(11) NOT NULL,
  `ma_kh` int(11) DEFAULT NULL,
  `tongtien` decimal(18,2) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tongsp` int(11) DEFAULT NULL,
  `trangthai` varchar(255) DEFAULT NULL,
  `phuongthuc_thanhtoan` varchar(255) DEFAULT NULL,
  `ngay_dat` date DEFAULT NULL,
  `ngay_giaohang` date DEFAULT NULL,
  `sdt` int(11) NOT NULL,
  `ten_kh` varchar(255) NOT NULL,
  `diachi_giaohang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_item`
--

CREATE TABLE `order_item` (
  `ma_sp` int(11) DEFAULT NULL,
  `ma_dh` int(11) DEFAULT NULL,
  `size` varchar(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `giasp` decimal(18,2) DEFAULT NULL,
  `loai_mau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ma_sp` int(11) NOT NULL,
  `tensp` varchar(255) DEFAULT NULL,
  `motasp` varchar(1000) DEFAULT NULL,
  `giasp` decimal(18,2) DEFAULT NULL,
  `ma_nxb` int(11) DEFAULT NULL,
  `link_hinhanh` varchar(255) DEFAULT NULL,
  `ma_danhmuc` int(11) DEFAULT NULL,
  `phan_loai` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ma_sp`, `tensp`, `motasp`, `giasp`, `ma_nxb`, `link_hinhanh`, `ma_danhmuc`, `phan_loai`) VALUES
(1, 'Nhà Giả Kim', 'Tiểu thuyết kinh điển về hành trình theo đuổi ước mơ của chàng chăn cừu Santiago.', 79000.00, 3, 'sach_1.png', 1, 'Mọi người'),
(2, 'Đắc Nhân Tâm', 'Nghệ thuật thu phục lòng người, cuốn sách kỹ năng sống bán chạy nhất mọi thời đại.', 86000.00, 4, 'sach_2.png', 3, 'Người lớn'),
(3, 'Harry Potter và Hòn Đá Phù Thủy', 'Tập 1 của series truyện phù thủy nổi tiếng, đưa bạn vào thế giới phép thuật kỳ diệu.', 150000.00, 1, 'sach_3.png', 1, 'Thiếu niên'),
(4, 'Doraemon Tập 1', 'Chú mèo máy thông minh đến từ tương lai. Truyện tranh gắn liền với tuổi thơ.', 25000.00, 2, 'sach_4.png', 4, 'Thiếu nhi'),
(5, 'Tuổi Trẻ Đáng Giá Bao Nhiêu', 'Cuốn sách truyền cảm hứng giúp bạn trẻ tìm ra hướng đi đúng đắn.', 90000.00, 3, 'sach_5.png', 3, 'Thanh niên'),
(6, 'Cha Giàu Cha Nghèo', 'Bài học về tư duy tài chính để đạt được sự tự do về tiền bạc.', 135000.00, 1, 'sach_2.png', 2, 'Người lớn'),
(7, 'Cây Cam Ngọt Của Tôi', 'Câu chuyện cảm động về chú bé Zeze tinh nghịch nhưng có tâm hồn nhạy cảm.', 108000.00, 3, 'sach_1.png', 1, 'Mọi người'),
(8, 'Mắt Biếc', 'Tác phẩm lãng mạn nhưng đượm buồn của nhà văn Nguyễn Nhật Ánh.', 110000.00, 1, 'sach_5.png', 1, 'Thanh niên'),
(9, 'Nghĩ Giàu Làm Giàu', 'Những nguyên tắc vàng dẫn lối đến thành công và thịnh vượng.', 120000.00, 6, 'sach_4.png', 2, 'Người lớn'),
(10, 'Thám Tử Lừng Danh Conan', 'Những vụ án hóc búa được phá giải bởi cậu bé thám tử lừng danh.', 25000.00, 2, 'sach_3.png', 4, 'Thiếu niên'),
(11, 'Hoàng Tử Bé', 'Câu chuyện thơ mộng và triết lý dành cho người lớn từng là trẻ con.', 55000.00, 2, 'sach_5.png', 5, 'Thiếu nhi'),
(12, 'Tắt Đèn', 'Tác phẩm hiện thực phê phán xuất sắc của văn học Việt Nam.', 60000.00, 7, 'sach_1.png', 1, 'Học sinh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ma_kh` int(11) NOT NULL,
  `ten_kh` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ma_kh`, `ten_kh`, `email`, `sdt`, `token`, `username`, `password`, `dia_chi`) VALUES
(1, 'Khách Hàng Mẫu', 'khachhang@gmail.com', '0123456789', '', 'ngocquan', 'root', 'TP Ho Chi Minh');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ma_ad`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ma_cart`),
  ADD KEY `ma_kh` (`ma_kh`),
  ADD KEY `ma_sp` (`ma_sp`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ma_danhmuc`);

--
-- Chỉ mục cho bảng `dacdiem_sp`
--
ALTER TABLE `dacdiem_sp`
  ADD PRIMARY KEY (`ma_dacdiem`),
  ADD KEY `ma_sp` (`ma_sp`);

--
-- Chỉ mục cho bảng `nxb`
--
ALTER TABLE `nxb`
  ADD PRIMARY KEY (`ma_nxb`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ma_dh`),
  ADD KEY `ma_kh` (`ma_kh`);

--
-- Chỉ mục cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD KEY `ma_sp` (`ma_sp`),
  ADD KEY `ma_dh` (`ma_dh`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ma_sp`),
  ADD KEY `ma_th` (`ma_nxb`),
  ADD KEY `ma_danhmuc` (`ma_danhmuc`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ma_kh`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `ma_ad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `ma_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `ma_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `dacdiem_sp`
--
ALTER TABLE `dacdiem_sp`
  MODIFY `ma_dacdiem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `nxb`
--
ALTER TABLE `nxb`
  MODIFY `ma_nxb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `ma_dh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `ma_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ma_kh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ma_kh`) REFERENCES `users` (`ma_kh`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ma_sp`) REFERENCES `product` (`ma_sp`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `dacdiem_sp`
--
ALTER TABLE `dacdiem_sp`
  ADD CONSTRAINT `dacdiem_sp_ibfk_1` FOREIGN KEY (`ma_sp`) REFERENCES `product` (`ma_sp`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ma_kh`) REFERENCES `users` (`ma_kh`);

--
-- Các ràng buộc cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`ma_sp`) REFERENCES `product` (`ma_sp`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`ma_dh`) REFERENCES `orders` (`ma_dh`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_nxb` FOREIGN KEY (`ma_nxb`) REFERENCES `nxb` (`ma_nxb`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`ma_danhmuc`) REFERENCES `category` (`ma_danhmuc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
