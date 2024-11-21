-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table beekeeper.ban: ~60 rows (approximately)
DELETE FROM `ban`;
INSERT INTO `ban` (`ID_Ban`, `ID_CuaHang`, `TinhTrang`) VALUES
	(1, 1, 1),
	(2, 1, 0),
	(3, 1, 0),
	(4, 1, 0),
	(5, 1, 0),
	(6, 1, 0),
	(7, 1, 0),
	(8, 1, 0),
	(9, 1, 0),
	(10, 1, 0),
	(11, 1, 0),
	(12, 1, 0),
	(13, 2, 0),
	(14, 2, 0),
	(15, 2, 0),
	(16, 2, 0),
	(17, 2, 0),
	(18, 2, 0),
	(19, 2, 0),
	(20, 2, 0),
	(21, 2, 0),
	(22, 2, 0),
	(23, 2, 0),
	(24, 2, 0),
	(25, 3, 0),
	(26, 3, 0),
	(27, 3, 0),
	(28, 3, 0),
	(29, 3, 0),
	(30, 3, 0),
	(31, 3, 0),
	(32, 3, 0),
	(33, 3, 0),
	(34, 3, 0),
	(35, 3, 0),
	(36, 3, 0),
	(37, 4, 0),
	(38, 4, 0),
	(39, 4, 0),
	(40, 4, 0),
	(41, 4, 0),
	(42, 4, 0),
	(43, 4, 0),
	(44, 4, 0),
	(45, 4, 0),
	(46, 4, 0),
	(47, 4, 0),
	(48, 4, 0),
	(49, 5, 0),
	(50, 5, 0),
	(51, 5, 0),
	(52, 5, 0),
	(53, 5, 0),
	(54, 5, 0),
	(55, 5, 0),
	(56, 5, 0),
	(57, 5, 0),
	(58, 5, 0),
	(59, 5, 0),
	(60, 5, 0);

-- Dumping data for table beekeeper.chamcong: ~4 rows (approximately)
DELETE FROM `chamcong`;
INSERT INTO `chamcong` (`ID_NhanVien`, `ID_Lich`, `NgayChamCong`, `Checkin`, `CheckOut`, `SoGioLam`, `TrangThai`) VALUES
	(1, 1, '2024-11-15', '13:34:42', '13:40:35', 0, '0'),
	(3, 1, '2024-11-15', '12:35:01', '16:27:51', 1.42, ''),
	(5, 1, '2024-11-15', '13:16:15', '13:16:24', 3, '0'),
	(1, 2, '2024-11-17', '13:38:18', '13:40:35', 3, '1');

-- Dumping data for table beekeeper.chitietdattiec: ~0 rows (approximately)
DELETE FROM `chitietdattiec`;

-- Dumping data for table beekeeper.chitietdonhang: ~9 rows (approximately)
DELETE FROM `chitietdonhang`;
INSERT INTO `chitietdonhang` (`ID_DonHang`, `ID_MonAn`, `SoLuong`, `Ghichu`) VALUES
	(2, 8, 3, ''),
	(2, 19, 1, ''),
	(2, 2, 2, 'không cay'),
	(3, 15, 1, 'thêm sốt'),
	(4, 18, 2, ''),
	(4, 11, 2, 'nhiều cơm'),
	(5, 4, 5, ''),
	(5, 20, 2, ''),
	(5, 12, 1, '2 gói tương cà');

-- Dumping data for table beekeeper.chitietmonan: ~51 rows (approximately)
DELETE FROM `chitietmonan`;
INSERT INTO `chitietmonan` (`ID_MonAn`, `ID_NguyenLieu`, `SoLuongNguyenLieu`) VALUES
	(1, 22, 1),
	(1, 21, 1),
	(2, 22, 1),
	(2, 19, 1),
	(3, 22, 1),
	(3, 21, 1),
	(4, 10, 1),
	(4, 6, 1),
	(5, 10, 1),
	(5, 21, 1),
	(6, 10, 1),
	(6, 21, 1),
	(7, 10, 1),
	(7, 6, 1),
	(8, 7, 1),
	(9, 7, 1),
	(9, 6, 1),
	(10, 7, 1),
	(10, 21, 1),
	(11, 7, 1),
	(11, 3, 2),
	(12, 6, 1),
	(13, 6, 2),
	(14, 6, 3),
	(15, 3, 3),
	(16, 3, 5),
	(17, 9, 1),
	(18, 9, 1),
	(19, 2, 1),
	(19, 8, 1),
	(20, 16, 1),
	(20, 14, 1),
	(20, 18, 1),
	(19, 1, 1),
	(1, 15, 1),
	(2, 15, 1),
	(3, 15, 1),
	(4, 2, 1),
	(5, 2, 1),
	(6, 2, 1),
	(7, 2, 1),
	(10, 5, 1),
	(11, 5, 1),
	(1, 13, 1),
	(2, 13, 1),
	(3, 13, 1),
	(4, 12, 1),
	(5, 12, 1),
	(6, 12, 1),
	(7, 12, 1),
	(19, 11, 1);

-- Dumping data for table beekeeper.chitietnguyenlieu: ~0 rows (approximately)
DELETE FROM `chitietnguyenlieu`;

-- Dumping data for table beekeeper.cuahang: ~5 rows (approximately)
DELETE FROM `cuahang`;
INSERT INTO `cuahang` (`ID_CuaHang`, `TenCuaHang`, `DiaChi`) VALUES
	(1, 'Quang Trung', '275 Quang Trung phường 10 Quận Gò Vấp'),
	(2, 'Lê Quang Định ', '133 Lê Quang Định Phường 14 Quận Bình Thạnh'),
	(3, 'Điện Biên Phủ', '25 Điện Biên Phủ Phường 15 Quận Bình Thạnh'),
	(4, 'Cách Mạng Tháng 8', '201 Cách Mạng Tháng 8 Phường 4 Quận 3'),
	(5, 'Nam Kì Khởi Nghĩa', '103 Nam Kì Khởi Nghĩa Khu Phố 1 Quận 1');

-- Dumping data for table beekeeper.danhsachdexuatmonmoi: ~5 rows (approximately)
DELETE FROM `danhsachdexuatmonmoi`;
INSERT INTO `danhsachdexuatmonmoi` (`ID_MonMoi`, `ID_NhanVien`, `TenMon`, `NguyenLieu`, `MoTa`, `Gia`, `TrangThai`, `Ngay`) VALUES
	(1, 1, 'Burger Phô Mai Bò Nướng', 'Thịt bò, phô mai, bánh mì, xà lách, cà chua', 'Burger với thịt bò nướng kèm phô mai tan chảy', 65000, 1, '2024-11-07'),
	(2, 1, 'Mì Ý Sốt Kem Gà', 'Mì Ý, sốt kem, gà, nấm, phô mai', 'Mì Ý kèm sốt kem béo ngậy và thịt gà', 70000, 1, '2024-11-07'),
	(3, 2, 'Salad Trái Cây Tươi', 'Dưa hấu, xoài, nho, cam, sốt chanh dây', 'Salad trái cây tươi mát và giàu vitamin', 45000, 0, '2024-11-07'),
	(4, 5, 'Gà Rán Sốt Tỏi Mật Ong', 'Gà rán, tỏi, mật ong, tiêu, hành lá', 'Gà rán phủ sốt tỏi mật ong thơm ngon', 55000, 0, '2024-11-07'),
	(5, 4, 'Súp Miso Rong Biển', 'Rong biển, đậu hũ, hành lá, miso, nước dùng', 'Súp miso Nhật Bản thanh đạm và bổ dưỡng', 30000, 0, '2024-11-07');

-- Dumping data for table beekeeper.danhsachyeucaubosungnguyenlieu: ~0 rows (approximately)
DELETE FROM `danhsachyeucaubosungnguyenlieu`;

-- Dumping data for table beekeeper.donhang: ~4 rows (approximately)
DELETE FROM `donhang`;
INSERT INTO `donhang` (`ID_DonHang`, `ID_CuaHang`, `ID_KhachHang`, `NgayDat`, `DiaChiGiaoHang`, `TrangThai`, `PhuongThucThanhToan`) VALUES
	(2, 1, 22, '2024-10-08', '12 Nguyễn Văn Lượng ', 'Đã giao hàng', 1),
	(3, 2, 21, '2024-09-11', '638 Phạm Văn Đồng ', 'Đặt thành công và thu tiền mặt', 0),
	(4, 4, 23, '2024-11-03', '35 Ung Văn Khiêm ', 'Đặt thành công và chuyển khoản', 1),
	(5, 3, 24, '2024-11-01', '3 Phạm Ngọc Thạch', 'Đã thanh toán', 0);

-- Dumping data for table beekeeper.dontiec: ~0 rows (approximately)
DELETE FROM `dontiec`;

-- Dumping data for table beekeeper.khachhang: ~4 rows (approximately)
DELETE FROM `khachhang`;
INSERT INTO `khachhang` (`ID_KhachHang`, `ID_TaiKhoan`, `HoTen`, `SoDienThoai`, `Email`, `DiaChi`) VALUES
	(21, 16, 'Trần Minh Hiếu', '0912345678', 'hieutran@gmail.', '123 Đường A, Quận 1, TP. HCM'),
	(22, 15, 'Trần Tấn Tài ', '0912345678', 'trantantai.3013@gmail.', '789 Đường C, Quận 3, TP. HCM'),
	(23, 13, 'Bùi Thanh Bình ', '0945678901', 'thanhbinh@gmail.', '321 Đường D, Quận 4, TP. HCM'),
	(24, 14, 'Nguyễn Tuấn Dũng', '0956789012', 'tuandung@gmail.', '987 Đường F, Quận 6, TP. HCM');

-- Dumping data for table beekeeper.lichlamviec: ~0 rows (approximately)
DELETE FROM `lichlamviec`;
INSERT INTO `lichlamviec` (`ID_Lich`, `TenCa`, `ThoiGian`, `Tuan`, `Thu`) VALUES
	(1, 'Ca Sáng', '2024-11-16', 1, ''),
	(2, 'Ca Sáng', '2024-11-17', 2, 'CN');

-- Dumping data for table beekeeper.loaimonan: ~5 rows (approximately)
DELETE FROM `loaimonan`;
INSERT INTO `loaimonan` (`ID_LoaiMon`, `TenLoaiMon`, `HinhLoaiMon`, `TrangThai`) VALUES
	(1, 'Thức Ăn Nhẹ', 'thuc_an_nhe.png', 0),
	(2, 'Burger', 'burger.png', 0),
	(3, 'Mì Ý', 'mi_y.png', 0),
	(4, 'Cơm', 'com.png', 0),
	(5, 'Gà Rán', 'ga_ran.png', 0);

-- Dumping data for table beekeeper.luong: ~3 rows (approximately)
DELETE FROM `luong`;
INSERT INTO `luong` (`ID_Luong`, `ID_NhanVien`, `TongGioLam`, `LuongTheoGio`, `Thuong`, `TongLuong`) VALUES
	(1, 3, NULL, 23000, 0, 0),
	(2, 5, NULL, 24000, 0, 0),
	(3, 1, NULL, 30000, 0, 0);

-- Dumping data for table beekeeper.messages: ~0 rows (approximately)
DELETE FROM `messages`;

-- Dumping data for table beekeeper.monan: ~20 rows (approximately)
DELETE FROM `monan`;
INSERT INTO `monan` (`ID_MonAn`, `ID_LoaiMon`, `TenMonAn`, `MoTa`, `TongNguyenLieu`, `Gia`, `GiamGia`, `HinhAnh`, `TinhTrang`) VALUES
	(1, 2, 'Burger Gà Quay Flava', '', NULL, 54000, 0, 'burger_ga_quay_flava.jpg', 0),
	(2, 2, 'Burger Tôm', '', NULL, 45000, 0, 'burger_tom.jpg', 0),
	(3, 2, 'Burger Zinger', '', NULL, 54000, 0, 'burger_zinger.jpg', 0),
	(4, 3, 'Mì Ý Gà Rán', '', NULL, 64000, 0, 'mi_y_ga_ran.jpg', 0),
	(5, 3, 'Mì Ý Gà Viên', '', NULL, 40000, 0, 'mi_y_ga_vien.jpg', 0),
	(6, 3, 'Mì Ý Gà Zinger', '', NULL, 58000, 0, 'mi_y_ga_zinger.jpg', 0),
	(7, 3, 'Mì Ý Phi Lê Gà Quay', '', NULL, 61000, 0, 'mi_y_phi_le_ga_quay.jpg', 0),
	(8, 4, 'Cơm', '', NULL, 12000, 0, 'com.jpg', 0),
	(9, 4, 'Cơm Gà Rán', '', NULL, 48000, 0, 'com_ga_ran.jpg', 0),
	(10, 4, 'Cơm Phi Lê Gà Quay', '', NULL, 61000, 0, 'com_phi_le_ga_quay.jpg', 0),
	(11, 4, 'Cơm Gà Teriyaki', '', NULL, 45000, 0, 'com_ga_teriyaki.jpg', 0),
	(12, 5, '1 Miếng Gà Rán', '', NULL, 35000, 0, '1_mieng_ga_ran.jpg', 0),
	(13, 5, '2 Miếng Gà Rán', '', NULL, 70000, 0, '2_mieng_ga_ran.jpg', 0),
	(14, 5, '3 Miếng Gà Rán', '', NULL, 100000, 0, '3_mieng_ga_ran.jpg', 0),
	(15, 5, '3 Cánh Gà Hot Wings', '', NULL, 54000, 0, '3_canh_ga_hot_wings.jpg', 0),
	(16, 5, '5 Cánh Gà Hot Wings', '', NULL, 86000, 0, '5_canh_ga_hot_wings.jpg', 0),
	(17, 1, 'Khoai Tây Chiên', '', NULL, 28000, 0, 'khoai_tay_chien.jpg', 0),
	(18, 1, 'Khoai Tây Nghiền', '', NULL, 22000, 0, 'khoai_tay_nghien.jpg', 0),
	(19, 1, 'Bắp Cải Trộn', '', NULL, 22000, 0, 'bap_cai_tron.jpg', 0),
	(20, 1, 'Súp Rong Biển', '', NULL, 19000, 0, 'sup_rong_bien.jpg', 0);

-- Dumping data for table beekeeper.nguyenlieu: ~22 rows (approximately)
DELETE FROM `nguyenlieu`;
INSERT INTO `nguyenlieu` (`ID_NguyenLieu`, `TenNguyenLieu`, `GiaMua`, `HinhAnh`, `DonViTinh`, `TrangThai`) VALUES
	(1, 'Bắp cải', 30000, 'bap_cai.jpg', '100 gam', 0),
	(2, 'Cà chua', 60000, 'ca_chua.jpg', '100 gam', 0),
	(3, 'Cánh gà', 105000, 'canh_ga.jpg', 'cánh', 0),
	(4, 'Đậu hũ non', 13000, 'dau_hu_non.jpg', 'hộp', 0),
	(5, 'Dưa leo', 30000, 'dua_leo.jpg', '100 gam', 0),
	(6, 'Đùi gà', 103000, 'dui_ga.jpg', 'Đùi', 0),
	(7, 'Gạo', 28000, 'gao.jpg', '100 gam', 0),
	(8, 'Hành tây', 25000, 'hanh_tay.jpg', '100 gam', 0),
	(9, 'Khoai tây', 30000, 'khoai_tay.jpg', '100 gam', 0),
	(10, 'Mỳ ý', 36000, 'my_y.jpg', 'gói', 0),
	(11, 'Ớt chuông', 60000, 'ot_chuong.jpg', '100 gam', 0),
	(12, 'Phô mai sợi', 48000, 'pho_mai_soi.jpg', 'gói', 0),
	(13, 'Phô mai lát', 60000, 'pho_mai_lat.jpg', 'gói', 0),
	(14, 'Rau mùi thơm', 55000, 'rau_mui_thom.jpg', '100 gam', 0),
	(15, 'Rau xà lách', 40000, 'rau_xa_lach.jpg', '100 gam', 0),
	(16, 'Rong biển', 110000, 'rong_bien.jpg', 'gói', 0),
	(17, 'Thịt bò', 200000, 'thit_bo.jpg', '100 gam', 0),
	(18, 'Thịt heo', 120000, 'thit_heo.jpg', '100 gam', 0),
	(19, 'Tôm', 185000, 'tom.jpg', '100 gam', 0),
	(20, 'Trứng gà', 25000, 'trung_ga.jpg', 'trứng', 0),
	(21, 'Ức gà', 80000, 'uc_ga.jpg', 'ức', 0),
	(22, 'Vỏ bánh mì', 50000, 'vo_banh_mi.jpg', 'gói', 0);

-- Dumping data for table beekeeper.nhanvien: ~6 rows (approximately)
DELETE FROM `nhanvien`;
INSERT INTO `nhanvien` (`ID_NhanVien`, `ID_TaiKhoan`, `ID_CuaHang`, `HoTen`, `SoDienThoai`, `Email`, `TrangThai`, `Avatar`) VALUES
	(1, 2, 1, 'Nguyễn Văn Hoàng', '0123456789', 'nguyenvanhoang@gmail.com', 0, '6739ec73ba13b_angry.jpg'),
	(2, 8, 2, 'Trần Thị Mai', '0123456790', 'tranthimai@gmail.com', 0, ''),
	(3, 9, 3, 'Lê Văn Phúc', '0123456789', 'levanphuc@gmail.com', 0, ''),
	(4, 10, 4, 'Phạm Thị Lan', '0123456792', 'phamthilan@gmail.com', 0, ''),
	(5, 12, 5, 'Vũ Văn Hùng', '0123456793', 'vuvanhung@gmail.com', 0, ''),
	(46, 69, 1, 'João Souza Silva', '0123333111', 'kairy@gmail.com', 0, '6739ea95b7f9f_164382.jpg');

-- Dumping data for table beekeeper.quanlychuoi: ~0 rows (approximately)
DELETE FROM `quanlychuoi`;
INSERT INTO `quanlychuoi` (`ID_TaiKhoan`, `ID_QuanLyChuoi`, `HoTen`, `SoDienThoai`, `Email`) VALUES
	(1, 2, 'Nguyễn Thanh Tùng', '0385902205', 'thanhtung@gmail.com');

-- Dumping data for table beekeeper.quanlycuahang: ~5 rows (approximately)
DELETE FROM `quanlycuahang`;
INSERT INTO `quanlycuahang` (`ID_TaiKhoan`, `ID_CuaHang`, `ID_QuanLyCuaHang`, `HoTen`, `SoDienThoai`, `Email`) VALUES
	(2, 1, 6, 'Phan Thắng Huy', '0901234567', 'thanghuy@gmail.com'),
	(3, 2, 7, 'Nguyễn Minh Cường', '0912345678', 'minhcuong@gmail.com'),
	(4, 3, 8, 'Trần Quang Hiếu', '0934567890', 'quanghieu@gmail.com'),
	(5, 4, 9, 'Nguyễn Việt ', '0923456789', 'hoangviet@gmail.com'),
	(6, 5, 10, 'Trần Minh Hiếu ', '0945678901', 'minhhieu@gmail.com');

-- Dumping data for table beekeeper.taikhoan: ~18 rows (approximately)
DELETE FROM `taikhoan`;
INSERT INTO `taikhoan` (`ID_TaiKhoan`, `TenTaiKhoan`, `MatKhau`, `PhanQuyen`) VALUES
	(1, 'quanlichuoi@gmail.com', '25f9e794323b453885f5181f1b624d0b', 1),
	(2, 'quanlicuahang1@gmail.com', '25f9e794323b453885f5181f1b624d0b', 2),
	(3, 'quanlicuahang2@gmail.com', '25f9e794323b453885f5181f1b624d0b', 2),
	(4, 'quanlicuahang3@gmail.com', '25f9e794323b453885f5181f1b624d0b', 2),
	(5, 'quanlicuahang4@gmail.com', '25f9e794323b453885f5181f1b624d0b', 2),
	(6, 'quanlicuahang5@gmail.com', '25f9e794323b453885f5181f1b624d0b', 2),
	(7, 'nhanvien1@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3),
	(8, 'nhanvien2@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3),
	(9, 'nhanvien3@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3),
	(10, 'nhanvien4@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3),
	(11, 'nhanvienbep1@gmail.com', '25f9e794323b453885f5181f1b624d0b', 4),
	(12, 'nhanvienbep2@gmail.com', '25f9e794323b453885f5181f1b624d0b', 4),
	(13, 'thanhbinh@gmail.com', '25f9e794323b453885f5181f1b624d0b', 5),
	(14, 'tuandung@gmail.com', '25f9e794323b453885f5181f1b624d0b', 5),
	(15, 'tantai@gmail.com', '25f9e794323b453885f5181f1b624d0b', 5),
	(16, 'hieuthuhai@gmail.com', '25f9e794323b453885f5181f1b624d0b', 5),
	(67, 'nhanvien5@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3),
	(68, 'nhanvien6@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3),
	(69, 'nhanviensale123', '25f9e794323b453885f5181f1b624d0b', 2);

-- Dumping data for table beekeeper.thucdon: ~100 rows (approximately)
DELETE FROM `thucdon`;
INSERT INTO `thucdon` (`ID_CuaHang`, `ID_MonAn`, `SoLuongTon`) VALUES
	(1, 1, 0),
	(1, 2, 0),
	(1, 3, 0),
	(1, 4, 0),
	(1, 5, 0),
	(1, 6, 0),
	(1, 7, 0),
	(1, 8, 0),
	(1, 9, 0),
	(1, 10, 0),
	(1, 11, 0),
	(1, 12, 0),
	(1, 13, 0),
	(1, 14, 0),
	(1, 15, 0),
	(1, 16, 0),
	(1, 17, 0),
	(1, 18, 0),
	(1, 19, 0),
	(1, 20, 0),
	(2, 1, 0),
	(2, 2, 0),
	(2, 3, 0),
	(2, 4, 0),
	(2, 5, 0),
	(2, 6, 0),
	(2, 7, 0),
	(2, 8, 0),
	(2, 9, 0),
	(2, 10, 0),
	(2, 11, 0),
	(2, 12, 0),
	(2, 13, 0),
	(2, 14, 0),
	(2, 15, 0),
	(2, 16, 0),
	(2, 17, 0),
	(2, 18, 0),
	(2, 19, 0),
	(2, 20, 0),
	(3, 1, 0),
	(3, 2, 0),
	(3, 3, 0),
	(3, 4, 0),
	(3, 5, 0),
	(3, 6, 0),
	(3, 7, 0),
	(3, 8, 0),
	(3, 9, 0),
	(3, 10, 0),
	(3, 11, 0),
	(3, 12, 0),
	(3, 13, 0),
	(3, 14, 0),
	(3, 15, 0),
	(3, 16, 0),
	(3, 17, 0),
	(3, 18, 0),
	(3, 19, 0),
	(3, 20, 0),
	(4, 1, 0),
	(4, 2, 0),
	(4, 3, 0),
	(4, 4, 0),
	(4, 5, 0),
	(4, 6, 0),
	(4, 7, 0),
	(4, 8, 0),
	(4, 9, 0),
	(4, 10, 0),
	(4, 11, 0),
	(4, 12, 0),
	(4, 13, 0),
	(4, 14, 0),
	(4, 15, 0),
	(4, 16, 0),
	(4, 17, 0),
	(4, 18, 0),
	(4, 19, 0),
	(4, 20, 0),
	(5, 1, 0),
	(5, 2, 0),
	(5, 3, 0),
	(5, 4, 0),
	(5, 5, 0),
	(5, 6, 0),
	(5, 7, 0),
	(5, 8, 0),
	(5, 9, 0),
	(5, 10, 0),
	(5, 11, 0),
	(5, 12, 0),
	(5, 13, 0),
	(5, 14, 0),
	(5, 15, 0),
	(5, 16, 0),
	(5, 17, 0),
	(5, 18, 0),
	(5, 19, 0),
	(5, 20, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
