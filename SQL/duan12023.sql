-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 05:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duan12023`
--

-- --------------------------------------------------------

--
-- Table structure for table `binhluan`
--

CREATE TABLE `binhluan` (
  `id_bl` int(10) NOT NULL,
  `noidung` varchar(255) NOT NULL,
  `iduser` int(10) NOT NULL,
  `idpro` int(10) NOT NULL,
  `ngaybinhluan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id_d` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`id_d`, `name`) VALUES
(3, 'Áo'),
(4, 'Quần');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id_pro` int(11) NOT NULL,
  `name_sp` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `img` varchar(255) NOT NULL,
  `mota` text NOT NULL,
  `luotxem` int(11) NOT NULL DEFAULT 0,
  `iddm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id_pro`, `name_sp`, `price`, `img`, `mota`, `luotxem`, `iddm`) VALUES
(14, 'LENINN FARM TEE', 456.00, 'ao2.png', 'Công nghệ Enzyme wash cả cây vải tạo độ mềm, chống co giãn,biến dạng, giúp sợi vải xốp hơn, thân thiện và mềm mại trên da.', 0, 3),
(15, 'MUSHROOM BRAVE TEE', 450.00, 'ao1.jpg', 'Công nghệ Enzyme wash cả cây vải tạo độ mềm, chống co giãn,biến dạng, giúp sợi vải xốp hơn, thân thiện và mềm mại trên da.', 0, 3),
(16, 'METEORITE TEE', 450.00, 'ao3.jpg', 'Công nghệ Enzyme wash cả cây vải tạo độ mềm, chống co giãn,biến dạng, giúp sợi vải xốp hơn, thân thiện và mềm mại trên da.', 0, 3),
(17, 'LENINN BLACK SOCCER JERSEY', 550.00, 'ao4.png', 'Cấu thành vải theo tiêu chuẩn áo thể thao chuyên nghiệp với 30% sợi polyester tái chế.\r\n\r\n◾️ In lưới chuyển nhiệt khổ lớn, sắc nét, thẩm thấu sâu vào bề mặt vải.\r\n\r\n◾️Mix chất liệu lưới bên hông giúp sản phẩm thoáng khí, thoát hơi, thấm hút mồ hôi tốt.', 0, 3),
(20, 'BLACK SPEED FIRE TEE', 450.00, 'ao8.png', '◾️Định lượng cotton lên tới 280gsm tạo form dáng ổn định sau nhiều lần sử dụng.\r\n\r\n◾️In lụa ép nhiệt logo phía trước, hình in sắc nét bền màu.\r\n\r\n◾️Công nghệ Enzyme wash cả cây vải tạo độ mềm, chống co giãn hay biến dạng, làm sợi vải xốp hơn, thân thiện và mềm mại trên da.\r\n\r\n◾️Oversized fit.\r\n\r\n◾️Drop shoulder', 0, 3),
(21, 'GREEN SPEED FIRE TEE', 450.00, 'ao8.png', '◾️Định lượng cotton lên tới 280gsm tạo form dáng ổn định sau nhiều lần sử dụng.\r\n\r\n◾️In lụa ép nhiệt logo phía trước, hình in sắc nét bền màu.\r\n\r\n◾️Công nghệ Enzyme wash cả cây vải tạo độ mềm, chống co giãn hay biến dạng, làm sợi vải xốp hơn, thân thiện và mềm mại trên da.\r\n\r\n◾️Oversized fit.\r\n\r\n◾️Drop shoulder', 0, 3),
(22, 'GREEN SPEED FIRE TEE', 450.00, 'ao7.png', '◾️Định lượng cotton lên tới 280gsm tạo form dáng ổn định sau nhiều lần sử dụng.\r\n\r\n◾️In lụa ép nhiệt logo phía trước, hình in sắc nét bền màu.\r\n\r\n◾️Công nghệ Enzyme wash cả cây vải tạo độ mềm, chống co giãn hay biến dạng, làm sợi vải xốp hơn, thân thiện và mềm mại trên da.\r\n\r\n◾️Oversized fit.\r\n\r\n◾️Drop shoulder', 0, 3),
(23, 'RIPPED KNEE JEANS', 650.00, 'quan1.jpg', '◾️Quần chất liệu denim, wash bạc, cắt ghép chất liệu, làm rách trước sau có chủ đích, raw cut phần gấu...\r\n◾️Form baggy\r\n◾️Logo thêu phía sau túi trái\r\n◾️Có dây rút tăng chỉnh kích thước vòng eo linh hoạt.', 0, 4),
(24, 'EMBROIDERED DUCK LOGO DENIM JEANS', 560.00, 'quan2.jpg', '', 0, 4),
(25, '4-HOLE PUNCHER WHITE SHORT', 540.00, 'quan5.jpg', '· Drawstring at elasticized waistband\r\n· Four-pocket styling\r\n· Frayed edge at cuffs\r\n· Logo-engraved black-tone hardware\r\n· Logo embroidered at leg\r\n· Graphic printed at back', 0, 4),
(26, '4-HOLE PUNCHER BLACK TAILORED PANTS', 1250.00, 'quan4.jpg', 'Wool twill flared pants.\r\n\r\n· Belt loops\r\n· Adjustable mini cinch belts at waist\r\n· Zip-fly\r\n· Pleats at front', 0, 4),
(27, '4-HOLE PUNCHER NAVY SHORTS', 450.00, '', '· Drawstring at elasticized waistband\r\n· Four-pocket styling\r\n· Frayed edge at cuffs\r\n· Logo-engraved black-tone hardware\r\n· Logo embroidered at leg\r\n· Graphic printed at back', 0, 4),
(28, 'GREEN POLAR TRACK PANTS', 590.00, 'quan7.png', '◾️Vải gió tráng nhựa với hai túi hộp lớn kèm zip\r\n\r\n◾️Có dây rút tăng chỉnh gấu quần linh hoạt\r\n\r\n◾️Hai line phản quang chạy dọc bên hông\r\n\r\n◾️Logo In chuyển nhiệt', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `image_path` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_description` varchar(255) NOT NULL,
  `id_slide` int(10) NOT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`image_path`, `image_name`, `image_description`, `id_slide`, `is_active`) VALUES
('view/home/images/junvu.jpg', 'Vu', 'Vu', 7, 1),
('view/home/images/junvu.jpg', 'Vu', 'Vu', 8, 1),
('view/home/images/junvu.jpg', 'Vu', 'Vu', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id_ac` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id_ac`, `user`, `pass`, `email`, `address`, `tel`, `role`) VALUES
(1, 'admin', '123456', 'admin@fpt.edu.vn', 'hanoi', '123', 1),
(2, 'khanh', '123', 'tokhanh@fpt.edu.vn', 'hanoi', '123', 1),
(3, 'hihi@gmail.com', 'hihi@gmail.com', 'hihi@gmail.com', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`id_bl`),
  ADD KEY `binhluan_ibfk_1` (`idpro`),
  ADD KEY `binhluan_ibfk_2` (`iduser`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id_d`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_pro`),
  ADD KEY `sanpham_ibfk_1` (`iddm`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id_ac`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `id_bl` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id_slide` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id_ac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`idpro`) REFERENCES `sanpham` (`id_pro`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `taikhoan` (`id_ac`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`iddm`) REFERENCES `danhmuc` (`id_d`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
