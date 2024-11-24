<?php
require("connect.php");

// Nhận dữ liệu từ request
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // Kiểm tra xem dữ liệu có hợp lệ không
    if (json_last_error() !== JSON_ERROR_NONE) {
        header('Content-Type: application/json');
        echo json_encode(array(
            "success" => false,
            "message" => "Dữ liệu không hợp lệ"
        ));
        exit;
    }

    // Lấy ID room từ query string
    $roomId = $_GET['room_id']; // Sử dụng $_GET để lấy tham số từ query string

    // Kiểm tra xem room có tồn tại không
    $sql = "SELECT room_id FROM rooms WHERE room_id = ? AND status <> 'Đã đặt'";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $roomId); // Sử dụng "i" nếu room_id là số nguyên
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // room tồn tại, tiến hành xóa
        $sql = "DELETE FROM rooms WHERE room_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $roomId);
        $stmt->execute();

        // Trả về thông tin thành công
        $response = array(
            "success" => true,
            "message" => "Xóa phòng thành công!"
        );
    } else {
        // Phòng không tồn tại
        $response = array(
            "success" => false,
            "message" => "Phòng không tồn tại hoặc đã được đặt!"
        );
    }

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();

?>
