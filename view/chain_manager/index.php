<?php
require_once "../../config.php";
session_start();
if(!isset($_SESSION["dn"]) || $_SESSION["dn"] != 1){
    echo"<script>alert('Bạn không có quyền truy cập')</script>";
    header("refresh:0;url='../../index.php'");
}   
$idTaiKhoan=isset($_SESSION["ID_TaiKhoan"]) ? intval($_SESSION["ID_TaiKhoan"]) : 0;
$conn = new mysqli(hostname: HOST, username: USERNAME, password: PASSWORD, database: DATABASE);
$idTaiKhoan=isset($_SESSION["ID_TaiKhoan"]) ? intval($_SESSION["ID_TaiKhoan"]) : 0; 
$query = "
    SELECT HoTen, Avatar 
    FROM nhanvien
    WHERE ID_TaiKhoan = '$idTaiKhoan'
";
$result = mysqli_query($conn, $query);
$nhanVien = mysqli_fetch_all($result, MYSQLI_ASSOC);
$query = "
    SELECT PhanQuyen 
    FROM taikhoan
    WHERE ID_TaiKhoan = '$idTaiKhoan'
";
$result = mysqli_query($conn, $query);
$taiKhoan = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý chuỗi</title>
  <link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
  <script src="../../asset/js/jquery-3.4.1.min.js"></script>
  <script src="../../asset/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    .sidebar {
      background-color: #f8f9fa;
      padding: 20px;
      min-height: calc(100vh - 56px);
      border-right: 1px solid #dee2e6;
    }
    .sidebar .nav-link {
      color: #333;
      font-weight: bold;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      padding: 10px 15px;
      transition: background-color 0.3s ease, color 0.3s ease;
      border-radius: 5px;
    }

    .sidebar .nav-link i {
      margin-right: 10px;
    }
    .sidebar .nav-link.active {
      background-color: #6c757d;
      color: white;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
    }

    .sidebar .nav-link:hover {
      background-color: #e9ecef;
      text-decoration: none;
    }
    .content {
      padding: 20px;
    }
    h3,
    h2 {
      color: #333;
    }

    /* Style for iframe */
    #contentFrame {
      width: 100%;
      height: calc(100vh - 56px - 40px);
      border: none;
    }

    .hidden {
      display: none;
    }

    .navbar {
      height: 70px; 
      display: flex;
      align-items: center; 
    }
    .logout-btn {
      background-color: #dc3545;
      color: white;
      padding: 8px 12px;
      border-radius: 4px;
      border: none;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #c82333;
    }
    .navbar h2 {
    font-family: 'Knewave', cursive; 
    font-size: 2rem; 
    color: #dc3545; 
    margin: 0; 
    text-transform: uppercase; 
    font-style: italic; 
    font-weight: bold;
    }
    .sidebar .dropdown-menu {
    background-color: #f8f9fa;
    padding: 10px 0; 
    border: 1px solid #dee2e6;
    border-radius: 5px;
    width: 100%; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
    position: relative; 
    }

    .sidebar .dropdown-item {
      color: #333;
      padding: 10px 15px; 
      border-radius: 3px;
      transition: background-color 0.3s ease, color 0.3s ease;
      width: 100%; 
      display: block; 
    }

    .sidebar .dropdown-item:hover {
      background-color: #e9ecef;
    }

    .sidebar .dropdown-toggle::after {
      margin-left: 10px;
    }

    .sidebar .dropdown-item.active, 
    .sidebar .dropdown-item:active {
      background-color: #6c757d;
      color: white;
    }

    .nav-item .dropdown-menu {
      display: none;
      position: relative;
      width: 100%; 
    }

    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
      width: 100%; 
    }
    .form-xslb{
      width: 60%;
      height: 70%;
    }
    .sidebar-title{
      width: 100%;
      display: flex;
      flex-direction: column;
    }
    .side-bar-avt{
      margin: 0 auto;
      width: 100px;
      height: 100px;
    }
    .side-bar-avt img{
    width: 100%;
    height: auto;
    border-radius: 50%;
    }
    .side-bar-role h3{
      text-align: center;
    }
    .side-bar-role h5{
      text-align: center;
    }
  </style>
  
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <span><h2>
      <?php
        echo $idTaiKhoan;
      ?>  
      BEEKEEPER</h2></span>
      <div class="ml-auto">
        <a href="logout.php" class="btn logout-btn" id="logoutBtn">Đăng xuất</a>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-3 sidebar">
      <div class="sidebar-title">
          <div class="side-bar-avt">
            <img src="C:\laragon\www\Freelance\Beekeeper\image\avatar\<?php echo $nhanVien[0]['Avatar'] ?>" alt="">
          </div>
          <div class="side-bar-role">
            <h3><?php echo $nhanVien[0]['HoTen'] ?></h3>
          </div>
          <div class="side-bar-role">
            <h5><?php echo $taiKhoan[0]['PhanQuyen']?></h5>
          </div>
        </div>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a href="?action=index" class="nav-link <?php echo (isset($_REQUEST['action']) && $_REQUEST['action'] === 'index') ? 'active' : ''; ?>" id="homeLink">Trang chủ</a>
          </li>
          <li class="nav-item">
            <a href="?action=duyet-de-xuat-mon-moi" class="nav-link <?php echo (isset($_REQUEST['action']) && $_REQUEST['action'] === 'duyet-de-xuat-mon-moi') ? 'active' : ''; ?>" id="newDishProposalLink">Duyệt đề xuất món mới</a>
          </li>
          <li class="nav-item">
            <a href="?action=duyet-yeu-cau-bo-sung-nguyen-lieu" class="nav-link <?php echo (isset($_REQUEST['action']) && $_REQUEST['action'] === 'duyet-yeu-cau-bo-sung-nguyen-lieu') ? 'active' : ''; ?>" id="ingredientRequestLink">Duyệt yêu cầu bổ sung nguyên liệu</a>
          </li>
          <li class="nav-item">
            <a href="?action=quan-ly-nhan-vien" class="nav-link <?php echo (isset($_REQUEST['action']) && $_REQUEST['action'] === 'quan-ly-nhan-vien') ? 'active' : ''; ?>" id="employeeManagementLink">Quản lý nhân viên</a>
          </li>
          <li class="nav-item">
            <a href="?action=quan-ly-nguyen-lieu" class="nav-link <?php echo (isset($_REQUEST['action']) && $_REQUEST['action'] === 'quan-ly-nguyen-lieu') ? 'active' : ''; ?>" id="ingredientManagementLink">Quản lý nguyên liệu</a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle <?php echo (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'quan-ly-mon-an') !== false) ? 'active' : ''; ?>" id="menuManagementLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Quản lý thực đơn
            </a>
            <ul class="dropdown-menu" aria-labelledby="menuManagementLink">
              <li><a href="?action=quan-ly-mon-an" class="dropdown-item">Quản lý món ăn</a></li>
              <li><a href="?action=quan-ly-loai-mon-an" class="dropdown-item">Quản lý loại món ăn</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="?action=thong-ke-doanh-thu" class="nav-link <?php echo (isset($_REQUEST['action']) && $_REQUEST['action'] === 'thong-ke-doanh-thu') ? 'active' : ''; ?>" id="revenueStatisticsLink">Thống kê doanh thu</a>
          </li>
          <li class="nav-item">
            <a href="?action=thong-ke-don-hang" class="nav-link <?php echo (isset($_REQUEST['action']) && $_REQUEST['action'] === 'thong-ke-don-hang') ? 'active' : ''; ?>" id="orderStatisticsLink">Thống kê đơn hàng</a>
          </li>
          <li class="nav-item">
            <a href="?action=xem-so-luong-ban" class="nav-link <?php echo (isset($_REQUEST['action']) && $_REQUEST['action'] === 'xem-so-luong-ban') ? 'active' : ''; ?>" id="tableCountLink">Xem số lượng bàn</a>
          </li>
        </ul>
      </div>
      <div class="col-12 col-md-9 content">
        <div class="content" id="content">
          <?php
          // Hiển thị nội dung dựa trên tham số action trong URL
          if (isset($_REQUEST["action"])) {
              $val = $_REQUEST["action"];
              switch ($val) {
                  case 'quan-ly-mon-an':
                      include_once("quan-ly-mon-an.php");
                      break;
                      case 'quan-ly-loai-mon-an':
                        include_once("quan-ly-loai-mon-an.php");
                        break;
                  case 'duyet-de-xuat-mon-moi':
                      include_once("duyet-de-xuat-mon-moi.php");
                      break;
                  case 'duyet-yeu-cau-bo-sung-nguyen-lieu':
                      include_once("duyet-yeu-cau-bo-sung-nguyen-lieu.php");
                      break;
                  case 'quan-ly-nhan-vien':
                      include_once("quan-ly-nhan-vien.php");
                      break;
                  case 'quan-ly-nguyen-lieu':
                      include_once("quan-ly-nguyen-lieu.php");
                      break;
                  case 'thong-ke-doanh-thu':
                      include_once("thong-ke-doanh-thu.php");
                      break;
                  case 'thong-ke-don-hang':
                      include_once("thong-ke-don-hang.php");
                      break;
                  case 'xem-so-luong-ban':
                      include_once("xem-so-luong-ban.php");
                      break;
                  case 'them-mon-an':
                      include_once("them-mon-an.php");
                      break;
                  case 'sua-mon-an':
                      include_once("sua-mon-an.php");
                      break;
                  case 'xoa-mon-an':
                      include_once("xoa-mon-an.php");
                      break;    
                  case 'index':
                  default:
                      echo "<h2>Chào mừng quay trở lại</h2>"; 
              }
          } else {
              echo "<h2>Chào mừng quay trở lại</h2>"; 
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
