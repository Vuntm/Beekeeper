<?php
require_once "../../config.php";
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "beekeeper"; // Replace with your actual database name

$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Lấy ngày hiện tại
$ngayChamCong = date('Y-m-d');

// Lấy thông tin nhân viên và lịch làm việc cho ngày hôm nay
$query = "
    SELECT * 
    FROM chamcong cc
    LEFT JOIN nhanvien nv ON nv.ID_NhanVien = cc.ID_NhanVien
    LEFT JOIN lichlamviec ll ON ll.ID_Lich = cc.ID_Lich
    WHERE ThoiGian = '$ngayChamCong'
";
$result = mysqli_query($conn, $query);
$nhanVienList = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idNhanVien = $_POST['ID_NhanVien'];
    $action = $_POST['action'];
    $currentTime = date('H:i:s');
    if ($action == 'checkin') {
        // Insert thời gian check-in vào bảng chamcong
        $updateQuery = "UPDATE chamcong SET Checkin = '$currentTime' WHERE ID_NhanVien = $idNhanVien AND NgayChamCong = '$ngayChamCong'";
        mysqli_query($conn, $updateQuery);
    } elseif ($action == 'checkOut') {
        $checkOut = strtotime($_POST['CheckOut']); // Chuyển đổi CheckOut thành timestamp
        $checkIn = strtotime($_POST['Checkin']);   // Chuyển đổi CheckIn thành timestamp
        $giolam = 0;
        if ($_POST['ID_Lich'] == CASANG) {
            // Đặt mốc thời gian chuẩn của ca sáng
            $gioLamCaSang = strtotime(GIOLAMCASANG . ":00:00");
            $gioTanCaSang = strtotime(GIOTANCASANG . ":00:00");

            if ($checkIn < $gioLamCaSang) {
                $checkIn = $gioLamCaSang;
            }

            if ($checkOut > $gioTanCaSang) {
                $checkOut = $gioTanCaSang;
            }

            $giolam = ($checkOut - $checkIn) / 3600; // Chia cho 3600 để chuyển giây thành giờ
            $giolam =  number_format($giolam, 2); // Hiển thị 2 chữ số thập phân
        }
        $updateQuery = "UPDATE chamcong SET CheckOut = '$currentTime', SoGioLam = '$giolam' WHERE ID_NhanVien = $idNhanVien";
        mysqli_query($conn, $updateQuery);
    }
    $query = "
    SELECT * 
    FROM chamcong cc
    LEFT JOIN nhanvien nv ON nv.ID_NhanVien = cc.ID_NhanVien
    LEFT JOIN lichlamviec ll ON ll.ID_Lich = cc.ID_Lich
    WHERE ThoiGian = '$ngayChamCong'
";
    $result = mysqli_query($conn, $query);
    $nhanVienList = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


// Đóng kết nối
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chấm công</title>
</head>

<body>
    <h1>Chấm công ngày <?php echo $ngayChamCong; ?></h1>
    <table border="1">
        <thead>
            <tr>
                <th class="p-2">Tên Nhân Viên</th>
                <th class="p-2">Ca Làm Việc</th>
                <th class="p-2">Thời Gian</th>
                <th class="p-2">Check-in</th>
                <th class="p-2">Check-out</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($nhanVienList)): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Không có nhân viên nào làm việc ngày hôm nay</td>
                </tr>
            <?php else: ?>
                <?php foreach ($nhanVienList as $nv): ?>
                    <tr>
                        <td class="p-2"><?php echo $nv['HoTen']; ?></td>
                        <td class="p-2"><?php echo $nv['TenCa']; ?></td>
                        <td class="p-2"><?php echo $nv['ThoiGian']; ?></td>
                        <td class="p-2">
                            <?php
                            if (!empty($nv['Checkin'])) {
                                echo $nv['Checkin'];
                            } else {
                            ?>
                                <form method="POST" action="checkin">
                                    <input type="hidden" name="ID_NhanVien" value="<?php echo $nv['ID_NhanVien']; ?>">
                                    <input type="hidden" name="action" value="checkin">
                                    <button type="submit">Check-in</button>
                                </form>
                            <?php
                            }
                            ?>
                        </td>
                        <td class="p-2">
                            <?php
                            if (!empty($nv['CheckOut'])) {
                                echo $nv['CheckOut'];
                            } else {
                            ?>
                                <form method="POST" action="checkOut">
                                    <input hidden name="ID_Lich" value="<?php echo $nv['ID_Lich']; ?>"></input>
                                    <input hidden name="Checkin" value="<?php echo $nv['Checkin']; ?>"></input>
                                    <input hidden name="CheckOut" value="<?php echo $nv['CheckOut']; ?>"></input>
                                    <input type="hidden" name="ID_NhanVien" value="<?php echo $nv['ID_NhanVien']; ?>">
                                    <input type="hidden" name="action" value="checkOut">
                                    <button type="submit">Check-out</button>
                                </form>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

    </table>
</body>

</html>