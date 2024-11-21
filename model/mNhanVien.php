<?php
include_once("ketnoi.php");
class modelNhanVien
{
    public function selectAllNhanVien()
    {
        $idTaiKhoan = isset($_SESSION["ID_TaiKhoan"]) ? intval($_SESSION["ID_TaiKhoan"]) : 0;

        $p = new clsketnoi();
        $con = $p->moKetNoi();
        $taiKhoan = mysqli_query($con, "SELECT PhanQuyen FROM taikhoan WHERE ID_TaiKhoan = '$idTaiKhoan' limit 1");

        if (!empty($taiKhoan)) {
            $taiKhoanData = mysqli_fetch_assoc($taiKhoan); 

            if ($taiKhoanData['PhanQuyen'] == 1) {
                $option = "";
            }
            if ($taiKhoanData['PhanQuyen'] == 2) {
                $cuaHangData = $this->getCuaHang();
                if ($cuaHangData === 0) { 
                    return [];
                } else {
                    $option = "WHERE ID_CuaHang = '$cuaHangData'";
                }
            }
        }
        $truyvan = "SELECT * FROM nhanvien nv LEFT JOIN taikhoan tk ON nv.ID_TaiKhoan = tk.ID_TaiKhoan $option ORDER BY nv.TrangThai ASC";

        $kq = mysqli_query($con, $truyvan);

        $p->dongKetNoi($con);
        return $kq;
    }
    public function insertNhanVien($idNv, $tenNv, $email, $sdt, $tenDangNhap, $matKhau, $chucVu, $idCuaHang, $trangThai, $avatar)
    {
        // Kiểm tra các tham số đầu vào
        if (empty($tenNv) || empty($email) || empty($sdt) || empty($tenDangNhap) || empty($matKhau)) {
            return [
                'success' => false,
                'message' => "Vui lòng nhập đầy đủ thông tin",
            ];
        }

        // Kết nối cơ sở dữ liệu
        $p = new clsketnoi();
        $con = $p->moKetNoi();
        // Nếu là sửa nhân viên
        if (!empty($idNv)) {
            $avatarOption = empty($avatar) ? "" : ", Avatar = '$avatar'";
            $truyVanSuaNhanVien = "UPDATE nhanvien SET HoTen = '$tenNv', SoDienThoai = '$sdt', Email = '$email', TrangThai = '$trangThai', ID_CuaHang = '$idCuaHang' $avatarOption WHERE ID_NhanVien = '$idNv'";
            $checkSuaNv = mysqli_query($con, $truyVanSuaNhanVien);
            $p->dongKetNoi($con);
            return [
                'success' => $checkSuaNv,
                'message' => $checkSuaNv ? "Sửa nhân viên thành công" : "Sửa nhân viên thất bại"
            ];
        }

        // Kiểm tra tài khoản tồn tại
        $truyvantaikhoan = "SELECT ID_TaiKhoan FROM taikhoan WHERE TenTaiKhoan = '$tenDangNhap'";
        $checkTk = mysqli_query($con, $truyvantaikhoan);
        if (mysqli_num_rows($checkTk) > 0) {
            $p->dongKetNoi($con);
            return [
                'success' => false,
                'message' => "Tài khoản đã tồn tại",
            ];
        }

        // Thêm tài khoản mới
        $mk = md5($matKhau);
        $themTkQuery = "INSERT INTO taikhoan (TenTaiKhoan, MatKhau, PhanQuyen) VALUES ('$tenDangNhap', '$mk', '$chucVu')";
        $themTk = mysqli_query($con, $themTkQuery);
        if (!$themTk) {
            $p->dongKetNoi($con);
            return [
                'success' => false,
                'message' => "Thêm mới tài khoản thất bại"
            ];
        }

        // Lấy ID_TaiKhoan vừa thêm
        $idTaiKhoan = $con->insert_id;

        // Thêm nhân viên vào bảng nhanvien
        $themNhanVienQuery = "INSERT INTO nhanvien (ID_TaiKhoan, ID_CuaHang, HoTen, SoDienThoai, Email, TrangThai)
                          VALUES ($idTaiKhoan, '$idCuaHang', '$tenNv', '$sdt', '$email', '$trangThai')";
        $themNv = mysqli_query($con, $themNhanVienQuery);

        $p->dongKetNoi($con);
        return [
            'success' => $themNv,
            'message' => $themNv ? "Thêm mới nhân viên thành công" : "Thêm mới nhân viên thất bại"
        ];
    }
    public function getCuaHang()
    {
        $idTaiKhoan = isset($_SESSION["ID_TaiKhoan"]) ? intval($_SESSION["ID_TaiKhoan"]) : 0;
        $p = new clsketnoi();
        $con = $p->moKetNoi();
        $cuaHang = mysqli_query($con, "SELECT ID_CuaHang FROM nhanvien WHERE ID_TaiKhoan = '$idTaiKhoan' LIMIT 1");
        $cuaHangData = mysqli_fetch_assoc($cuaHang);
        if ($cuaHangData === null) {
            $p->dongKetNoi($con);
            return 0;
        } else {
            $p->dongKetNoi($con);
            return $cuaHangData['ID_CuaHang'];
        }
    }
}
