<?php
require_once __DIR__ . '/../config.php';

class clsketnoi{
    public function moKetNoi(){
        $con = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
        mysqli_set_charset($con,'utf8');
        return $con;
    }
    public function dongKetNoi($con){
        mysqli_close($con);
    }
}
?>