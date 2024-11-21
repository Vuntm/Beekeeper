<?php
require_once __DIR__ . '/../model/mNhanVien.php';
require_once ('upload.php');

class controlNhanVien {
    private $p ;
    public function __construct() {
        $this->p = new modelNhanVien();
    }

    public function getAllNhanVien() {
        $kq = $this->p->selectAllNhanVien();
        return $kq;
    }
    public function getCuaHang() {
        $kq = $this->p->getCuaHang();
        return $kq;
    }

    public function insertNhanVien($idNv, $tenNv, $email, $sdt, $tenDangNhap, $matKhau, $chucVu, $idCuaHang, $trangThai, $avatar) {
        $kq = $this->p->insertNhanVien($idNv, $tenNv, $email, $sdt, $tenDangNhap, $matKhau, $chucVu, $idCuaHang, $trangThai, $avatar);
        return $kq;
    }
    

}
?>
