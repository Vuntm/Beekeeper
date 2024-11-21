<?php
require_once "../../config.php";

// Kết nối đến database
$servername = "localhost";
$username = "root";
$password = "";
$database = "beekeeper"; // Replace with your actual database name

$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$idTaiKhoan = isset($_SESSION["ID_TaiKhoan"]) ? intval($_SESSION["ID_TaiKhoan"]) : 9;
$total = 0;
$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-01'); // Ngày đầu tháng nếu không có input
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-t'); // Ngày cuối tháng nếu không có input

$query = "
    SELECT 
        nv.ID_NhanVien, 
        nv.HoTen, 
        ch.TenCuaHang AS CuaHang, 
        DATE_FORMAT(cc.NgayChamCong, '%Y-%m') AS Thang,
        SUM(cc.SoGioLam) AS TongGioLam,
        lg.LuongTheoGio
    FROM 
        chamcong cc
    LEFT JOIN 
        nhanvien nv ON nv.ID_NhanVien = cc.ID_NhanVien
    LEFT JOIN 
        cuahang ch ON nv.ID_CuaHang = ch.ID_CuaHang
    LEFT JOIN 
        luong lg ON lg.ID_NhanVien = nv.ID_NhanVien
    WHERE 
        nv.ID_TaiKhoan = $idTaiKhoan
    GROUP BY 
        nv.ID_NhanVien, 
        Thang, 
        lg.LuongTheoGio,
        ch.TenCuaHang
    ORDER BY 
        Thang DESC
";
function formatCurrency($amount, $currencySymbol = 'VND')
{
    // Định dạng số với dấu phân cách hàng nghìn
    $formattedAmount = number_format($amount, 0, '.', ',');
    // Trả về chuỗi tiền tệ với ký hiệu
    return $formattedAmount . ' ' . $currencySymbol;
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem Lương Nhân Viên</title>
    <link rel="stylesheet" href="style.css"> <!-- CSS liên kết nếu cần -->
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }

        .container {
            text-align: center;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total-money {
            padding-top: 40px;
            text-align: start;
        }

        .total-money-text {
            color: red;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Thông Tin Lương Nhân Viên</h1>
    <div class="filter-section">
        <label for="month_picker">Chọn tháng:</label>
        <input type="month" id="month_picker" name="month_picker">
    </div>
    <table id="employeeTable">
        <thead>
            <tr>
                <th>Mã Nhân Viên</th>
                <th>Họ Tên</th>
                <th>Cửa Hàng</th>
                <th>Tháng</th>
                <th>Số giờ làm</th>
                <th>Lương Theo Giờ</th>
                <th>Tổng Lương</th>
            </tr>
        </thead>
        <tbody id="employeeData">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tongLuong = $row['TongGioLam'] * $row['LuongTheoGio'];
                    echo "<tr data-month='" . $row['Thang'] . "'>";
                    echo "<td>" . htmlspecialchars($row['ID_NhanVien']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['HoTen']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['CuaHang']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Thang']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['TongGioLam']) . "</td>";
                    echo "<td data-hourly-rate='" . $row['LuongTheoGio'] . "'>" . formatCurrency($row['LuongTheoGio']) . "</td>";
                    echo "<td class='salary-amount'>" . formatCurrency($tongLuong) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="total-money">
        <strong>Tổng lương: <span class="total-money-text">0 VND</span></strong>
    </div>
</div>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const monthPicker = document.getElementById('month_picker');
    const tableRows = document.querySelectorAll('#employeeData tr');
    const totalMoneyElement = document.querySelector('.total-money-text');

    // Hàm tính tổng lương từ các hàng đang hiển thị
    function calculateTotalSalary() {
        let total = 0;
        tableRows.forEach(row => {
            if (row.style.display !== 'none') {
                const salaryCell = row.querySelector('.salary-amount');
                if (salaryCell) {
                    // Chuyển đổi chuỗi tiền tệ thành số
                    const salary = parseInt(salaryCell.textContent.replace(/[^0-9]/g, ''));
                    total += salary;
                }
            }
        });
        totalMoneyElement.textContent = formatCurrency(total);
    }

    // Hàm định dạng tiền tệ
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount);
    }

    // Hàm lọc bảng theo tháng
    function filterTableByMonth() {
        const selectedMonth = monthPicker.value;
        
        tableRows.forEach(row => {
            const rowMonth = row.getAttribute('data-month');
            if (!selectedMonth || rowMonth === selectedMonth) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Tính lại tổng lương sau khi lọc
        calculateTotalSalary();
    }

    // Tính tổng lương ban đầu khi tải trang
    calculateTotalSalary();

    // Bắt sự kiện khi thay đổi tháng
    monthPicker.addEventListener('change', filterTableByMonth);
});
</script>

</html>
<?php
// Close the database connection
$conn->close();
?>