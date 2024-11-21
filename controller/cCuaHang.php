<?php
require_once __DIR__ . '/../model/mQuanLyCuaHang.php';
require_once ('upload.php');

class controlCuaHang {
    private $p ;
    public function __construct() {
        $this->p = new modelCuaHang();
    }

    public function getAllCuaHang() {
        $kq = $this->p->selectAllCuaHang();
        if (mysqli_num_rows($kq)) {
            return $kq;
        } else {
            return false;
        }
    }
}