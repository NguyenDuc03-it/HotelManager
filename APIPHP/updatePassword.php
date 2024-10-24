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

    $input_password = $data['password'];
    $staff_id = $data['staff_id'];

    // Cập nhật thông tin phòng
    $sql = "UPDATE staff SET password = ? WHERE staff_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("si", $input_password, $staff_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = array(
            "success" => true,
            "message" => "Thay đổi mật khẩu thành công!"
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Thay đổi mật khẩu thất bại!"
        );
    }

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();
?>
