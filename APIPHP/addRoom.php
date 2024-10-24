<?php
require("connect.php");

// Nhận dữ liệu từ request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Kiểm tra xem dữ liệu có hợp lệ không
    if (json_last_error() !== JSON_ERROR_NONE) {
        header('Content-Type: application/json');
        echo json_encode(array(
            "success" => false,
            "message" => "Dữ liệu không hợp lệ"
        ));
        exit;
    }


    $room_number = $data['room_number'];
    $room_type = $data['room_type'];
    $price = $data['price'];
    $status = "Trống";


    // Kiểm tra xem phòng đã tồn tại chưa
    $sql = "SELECT room_number FROM rooms WHERE room_number = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $room_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Phòng đã tồn tại
       
        $response = array(
            "success" => false,
            "message" => "Dữ liệu phòng đã tồn tại!"
        );
    } else {
        // Thêm mới phòng
        $sql = "INSERT INTO rooms (room_number, room_type, price, status) VALUES (?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ssss", $room_number, $room_type, $price, $status);
        $stmt->execute();

        // Trả về thông tin thành công
        $response = array(
            "success" => true,
            "message" => "Thêm mới phòng thành công!"
        );
    }


    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();
?>
