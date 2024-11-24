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

    // Cập nhật thông tin phòng
    $sql = "UPDATE rooms SET room_type = ?, price = ? WHERE room_number = ? AND status <> 'Đã đặt'";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sss", $room_type, $price, $room_number);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = array(
            "success" => true,
            "message" => "Cập nhật phòng thành công!"
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Phòng đã được đặt hoặc không được tìm thấy!"
        );
    }

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();
?>
