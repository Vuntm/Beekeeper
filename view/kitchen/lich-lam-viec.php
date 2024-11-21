<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch làm việc 7 ngày</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .calendar {
            width: 1000px;
            height: 700px;
            background-color: white;
            border: 1px solid #ddd;
            display: grid;
            grid-template-columns: 100px repeat(7, 1fr);
            grid-template-rows: repeat(13, 50px);
            position: relative;
        }

        .time-slot, .day {
            border-right: 1px solid #e0e0e0;
            border-left: 1px solid #e0e0e0;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
        }

        .time-slot {
            background-color: #f9f9f9;
            color: #333;
        }

        .day-header {
            background-color: #f4f4f4;
            border-bottom: 1px solid #e0e0e0;
            border-left: 1px solid #e0e0e0;
            text-align: center;
            padding: 5px;
            font-weight: bold;
            grid-row: 1;
        }

        .event {
            position: absolute;
            width: 70px;
            border-radius: 4px;
            padding: 5px;
            font-size: 12px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .event-green {
            background-color: #28a745;
        }

        .event-blue {
            background-color: #007bff;
        }

        .event .time {
            font-weight: bold;
        }

        .event .duration {
            font-size: 10px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="calendar">
    <!-- Cột thời gian -->
    <div class="time-slot" style="grid-row: 2;">08:00</div>
    <div class="time-slot" style="grid-row: 3;">09:00</div>
    <div class="time-slot" style="grid-row: 4;">10:00</div>
    <div class="time-slot" style="grid-row: 5;">11:00</div>
    <div class="time-slot" style="grid-row: 6;">12:00</div>
    <div class="time-slot" style="grid-row: 7;">13:00</div>
    <div class="time-slot" style="grid-row: 8;">14:00</div>
    <div class="time-slot" style="grid-row: 9;">15:00</div>
    <div class="time-slot" style="grid-row: 10;">16:00</div>
    <div class="time-slot" style="grid-row: 11;">17:00</div>
    <div class="time-slot" style="grid-row: 12;">18:00</div>
    <div class="time-slot" style="grid-row: 13;">19:00</div>
    <div class="time-slot" style="grid-row: 14;">20:00</div>

    <!-- Cột cho các ngày trong tuần -->
    <?php
    // Tính toán ngày đầu tuần (Thứ Hai) và các ngày còn lại
    $monday = strtotime('last Monday', strtotime('tomorrow'));
    $daysOfWeek = [];
    for ($i = 0; $i < 7; $i++) {
        $daysOfWeek[] = date('d/m', strtotime("+$i day", $monday));
    }
    ?>

    <div class="day-header" style="grid-column: 1;"></div>
    <div class="day-header" style="grid-column: 2;">Thứ hai<br><?php echo $daysOfWeek[0]; ?></div>
    <div class="day-header" style="grid-column: 3;">Thứ ba<br><?php echo $daysOfWeek[1]; ?></div>
    <div class="day-header" style="grid-column: 4;">Thứ tư<br><?php echo $daysOfWeek[2]; ?></div>
    <div class="day-header" style="grid-column: 5;">Thứ năm<br><?php echo $daysOfWeek[3]; ?></div>
    <div class="day-header" style="grid-column: 6;">Thứ sáu<br><?php echo $daysOfWeek[4]; ?></div>
    <div class="day-header" style="grid-column: 7;">Thứ bảy<br><?php echo $daysOfWeek[5]; ?></div>
    <div class="day-header" style="grid-column: 8;">Chủ nhật<br><?php echo $daysOfWeek[6]; ?></div>

    <!-- Các ô trống cho các ngày -->
    <?php for ($i = 2; $i <= 8; $i++): ?>
        <?php for ($j = 2; $j <= 14; $j++): ?>
            <div class="day" style="grid-column: <?= $i ?>; grid-row: <?= $j ?>;"></div>
        <?php endfor; ?>
    <?php endfor; ?>

    <!-- Kết nối cơ sở dữ liệu và hiển thị sự kiện -->
    <?php
    // Kết nối cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "test");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Tính toán ngày hiện tại từ thứ hai đến chủ nhật
    $mondayDate = date('Y-m-d', $monday);
    $sundayDate = date('Y-m-d', strtotime("+6 days", $monday));

    // Lấy dữ liệu từ bảng dangky_ca trong khoảng từ thứ hai đến chủ nhật
    $sql = "SELECT * FROM dangky_ca WHERE NgayLamViec BETWEEN '$mondayDate' AND '$sundayDate'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $day = $row['Thu'];
            $startTime = strtotime($row['NgayLamViec']);
            $shift = $row['TenCa'];

            // Xác định cột dựa trên ngày
            switch ($day) {
                case 'Thứ Hai': $column = 2; break;
                case 'Thứ Ba': $column = 3; break;
                case 'Thứ Tư': $column = 4; break;
                case 'Thứ Năm': $column = 5; break;
                case 'Thứ Sáu': $column = 6; break;
                case 'Thứ Bảy': $column = 7; break;
                case 'Chủ Nhật': $column = 8; break;
            }

            // Xác định hàng dựa trên giờ bắt đầu
            $hour = date('H', $startTime);
            $gridRow = $hour - 7;  // Giả sử giờ bắt đầu từ 08:00 -> hàng 2

            // Hiển thị sự kiện trong lịch
            echo "<div class='event event-green' style='grid-column: {$column}; grid-row: {$gridRow};'>
                    {$shift}<br><span class='time'>" . date('H:i', $startTime) . "</span><span class='duration'>4 giờ</span>
                  </div>";
        }
    } 
    // Đóng kết nối
    $conn->close();
    ?>
</div>

</body>
</html>