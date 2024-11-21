<?php
include_once("../../controller/cNhanVien.php");
include_once("../../controller/cCuaHang.php");
$p = new controlNhanVien();
$cuaHangController = new controlCuaHang();
$successMessage = "";

$cuaHangHienTai = $p->getCuaHang();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['isDelete'])) {
        $updateQuery = "UPDATE nhanvien SET TrangThai = '1' WHERE ID_NhanVien = {$_POST['id']}";
        mysqli_query($conn, $updateQuery);
    } else {
        // Giả sử bạn đã có kết nối database
        // Lấy thông tin từ form
        $ID_NhanVien = isset($_POST['employeeID']) ? $_POST['employeeID'] : "";
        $HoTen = $_POST['fullName'];
        $Email = $_POST['email'];
        $SoDienThoai = $_POST['phone'];
        $ID_TaiKhoan = $_POST['username'];
        $MatKhau = $_POST['password'];
        $PhanQuyen = $_POST['position'];
        $TrangThaiLamViec = $_POST['status'];
        $chiNhanh = $_POST['chiNhanh'];

        // Xử lý ảnh upload
        $Avatar = null; // Mặc định không có ảnh
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $targetDir = "../../image/avatar/"; // Thư mục lưu ảnh
            // Tạo thư mục nếu chưa tồn tại
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]); // Đặt tên ảnh duy nhất
            $targetFilePath = $targetDir . $fileName;
            $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Kiểm tra định dạng file
            $allowedFileTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($imageFileType, $allowedFileTypes)) {
                // Upload file
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $Avatar = $fileName; // Lấy tên ảnh để lưu vào database
                } else {
                    echo "<script>
                        swal({
                            title: 'Lỗi',
                            text: 'Không thể upload ảnh.',
                            icon: 'error',
                            button: 'OK',
                        });
                      </script>";
                    exit;
                }
            } else {
                echo "<script>
                    swal({
                        title: 'Lỗi',
                        text: 'Định dạng ảnh không hợp lệ. Chỉ chấp nhận JPG, JPEG, PNG, GIF.',
                        icon: 'error',
                        button: 'OK',
                    });
                  </script>";
                exit;
            }
        } elseif (isset($_FILES['image']['error']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
            // Xử lý các lỗi khác ngoài việc không upload file
            echo "<script>
                swal({
                    title: 'Lỗi',
                    text: 'Lỗi khi upload ảnh: " . $_FILES['image']['error'] . "',
                    icon: 'error',
                    button: 'OK',
                });
              </script>";
            exit;
        }

        // Lưu dữ liệu vào database
        $isAdded = $p->insertNhanVien(
            $ID_NhanVien,
            $HoTen,
            $Email,
            $SoDienThoai,
            $ID_TaiKhoan,
            $MatKhau,
            $PhanQuyen,
            $chiNhanh,
            $TrangThaiLamViec,
            $Avatar
        );

        // Hiển thị thông báo kết quả
        if ($isAdded) {
            $successMessage = $isAdded['message'];
            $successStatus = $isAdded['success'] ? 'success' : 'error'; // Xác định trạng thái
            echo "<script>
                swal({
                    title: 'Thông báo',
                    text: '$successMessage',
                    icon: '$successStatus',
                    button: 'OK',
                });
              </script>";
        }
    }

    // Lấy danh sách nhân viên và cửa hàng
    $nv = $p->getAllNhanVien();
    $ch = $cuaHangController->getAllCuaHang();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $nv = $p->getAllNhanVien();
    $ch = $cuaHangController->getAllCuaHang();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #CuaHang {
            width: 600px;
            height: 40px;
            margin-left: 0px;
            border: 1px solid black;
            text-align: center;
        }

        #them-btn,
        #xoa-btn {
            padding: 8px 40px;
            margin-top: 10px;
            margin-left: 20px;
            background-color: white;
            border: 1px solid black;
        }

        input[type="text"] {
            width: 700px;
        }

        th,
        tr,
        td {
            border: 1px solid black;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        #form {
            display: none;
            /* Ẩn form ban đầu */
            margin-top: 20px;
        }

        #nhan-vien-form h4 {
            text-align: center;
        }

        #ds-nhan-vien {
            width: 100%;
        }
    </style>
</head>

<body class="bg-gray-200">
    <div class="flex justify-between items-center">
        <h5><strong>Chi nhánh: </strong><?php
                                        foreach ($ch as $cuaHang) {
                                            if ($cuaHang['ID_CuaHang'] == $cuaHangHienTai) {
                                                echo $cuaHang['TenCuaHang'];
                                            }
                                        } ?></h5>
        <div class="flex justify-between items-center mb-4 mt-3">
            <button id="them-btn" onclick="clearOrderForm()">Thêm</button>
        </div>
    </div>
    <table id="ds-nhan-vien">
        <thead>
            <tr>
                <th class="p-2">Mã nhân viên</th>
                <th class="p-2">Họ và tên</th>
                <th class="p-2">Email</th>
                <th class="p-2">SDT</th>
                <th class="p-2">Tên đăng nhập</th>
                <th class="p-2">Mật khẩu</th>
                <th class="p-2">Chức vụ</th>
                <th class="p-2">Chi nhánh</th>
                <th class="p-2">Trạng thái</th>
                <th class="p-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nv as $nhanVien): ?>
                <form method="POST">
                    <tr id="employee-<?php echo $nhanVien['ID_NhanVien']; ?>">
                        <input name="isDelete" type="text" hidden value="1">
                        <input name="id" type="text" hidden value="<?php echo $nhanVien['ID_NhanVien']; ?>">
                        <td class="p-2"><?php echo $nhanVien['ID_NhanVien']; ?></td>
                        <td class="p-2"><?php echo $nhanVien['HoTen']; ?></td>
                        <td class="p-2"><?php echo $nhanVien['Email']; ?></td>
                        <td class="p-2"><?php echo $nhanVien['SoDienThoai']; ?></td>
                        <td class="p-2"><?php echo $nhanVien['TenTaiKhoan']; ?></td>
                        <td class="p-2"><?php echo ("***********"); ?></td>
                        <td class="p-2"><?php echo $nhanVien['PhanQuyen']; ?></td>
                        <td class="p-2" <?php
                                        foreach ($ch as $key => $value) {
                                            if ($value["ID_CuaHang"] == $nhanVien['ID_CuaHang']) {
                                                echo "id='{$value['ID_CuaHang']}'>";
                                                echo $value['TenCuaHang'];
                                            }
                                        }
                                        ?></td>
                        <td class="p-2"><?php echo $nhanVien['TrangThai'] == 0 ? "Hoạt động" : "Không hoạt động"; ?></td>
                        <td class="p-2">
                            <button class="btn btn-warning" onclick="editEmployee(this)">Sửa</button>
                            <button class="btn btn-danger" type="submit">Xóa</button>
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Sửa thông tin nhân viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="employeeID">Mã nhân viên</label>
                            <input type="text" id="employeeID" name="employeeID" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="fullName">Họ và tên</label>
                            <input type="text" id="fullName" name="fullName" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="position">Chức vụ</label>
                            <select id="position" name="position" class="form-control" required>
                                <option value="">--Chọn chức vụ--</option>
                                <option value="1">Quản lý</option>
                                <option value="2">Nhân viên</option>
                                <option value="3">Nhân viên bếp</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="0">Đang làm việc</option>
                                <option value="1">Ngưng làm việc</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="chiNhanh">Chi nhánh</label>
                            <?php
                            foreach ($ch as $cuaHang) {
                                if ($cuaHang['ID_CuaHang'] == $cuaHangHienTai) {
                                    echo "<input type='text' class='form-control' value='{$cuaHang['TenCuaHang']}' readonly>";
                                    echo "<input type='hidden' name='chiNhanh' id='chiNhanh' value='{$cuaHang['ID_CuaHang']}'>";
                                }
                            }
                            ?>
                        </div>
                        <label for="image">Chọn ảnh:</label>
                        <input type="file" name="image" id="image" accept="image/*" required>
                        <div class="form-group">
                            <input type="submit" value="Lưu thông tin" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hiển thị form nhập thông tin khi nhấn nút "Thêm"
        function showOrderForm() {
            var employeeIDDiv = document.getElementById("employeeID").closest('.form-group');
            if (employeeIDDiv) {
                employeeIDDiv.style.display = "none";
            }
            document.getElementById("form").style.display = "block";
        }

        function clearOrderForm() {
            document.getElementById("employeeID").value = "";
            document.getElementById("fullName").value = "";
            document.getElementById("email").value = "";
            document.getElementById("phone").value = "";
            document.getElementById("username").value = "";
            document.getElementById("password").value = "";
            document.getElementById("position").value = "";
            document.getElementById("status").value = "";
            document.getElementById("chiNhanh").value = "";
            $('#editEmployeeModal').modal('show');
        }

        // Hàm để điền dữ liệu vào modal sửa nhân viên
        function editEmployee(button) {
            event.preventDefault(); // Thêm dòng này để ngăn form submit

            // Lấy hàng cha của nút "Sửa"
            var row = button.closest('tr');

            // Lấy dữ liệu từ các ô trong hàng
            var idNhanVien = row.cells[0].innerText;
            var hoTen = row.cells[1].innerText;
            var email = row.cells[2].innerText;
            var soDienThoai = row.cells[3].innerText;
            var tenTaiKhoan = row.cells[4].innerText;
            var phanQuyen = row.cells[6].innerText;
            var trangThai = row.cells[8].innerText == "Hoạt động" ? "0" : "1";

            // Điền dữ liệu vào các trường trong modal
            document.getElementById("employeeID").value = idNhanVien;
            document.getElementById("fullName").value = hoTen;
            document.getElementById("email").value = email;
            document.getElementById("phone").value = soDienThoai;
            document.getElementById("username").value = tenTaiKhoan;
            document.getElementById("password").value = ""; // Để trống mật khẩu
            document.getElementById("position").value = phanQuyen;
            document.getElementById("status").value = trangThai;

            // Hiển thị modal
            $('#editEmployeeModal').modal('show');
        }

        function filterByBranch() {
            var selectedBranch = document.getElementById("CuaHang").value; // Lấy giá trị ID chi nhánh được chọn
            var rows = document.querySelectorAll("#ds-nhan-vien tbody tr"); // Lấy tất cả các hàng trong bảng

            rows.forEach(function(row) {
                var branchCell = row.cells[7].innerText; // Giả sử cột chi nhánh là cột thứ 8 (index 7)
                var branchID = "";

                // Lấy ID của chi nhánh từ ô chi nhánh
                <?php foreach ($ch as $cuaHangItem): ?>
                    if (branchCell.includes("<?php echo $cuaHangItem['TenCuaHang']; ?>")) {
                        branchID = "<?php echo $cuaHangItem['ID_CuaHang']; ?>"; // Lưu ID của chi nhánh
                    }
                <?php endforeach; ?>

                // Kiểm tra nếu chọn "Tất cả chi nhánh"
                if (selectedBranch === "0" || branchID === selectedBranch) {
                    row.style.display = ""; // Hiện hàng nếu chi nhánh trùng khớp hoặc chọn tất cả
                } else {
                    row.style.display = "none"; // Ẩn hàng nếu không trùng khớp
                }
            });
        }
    </script>
</body>

</html>