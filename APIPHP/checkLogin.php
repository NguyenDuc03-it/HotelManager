<?php
require("connect.php");

// Nhận dữ liệu từ request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Đọc JSON từ request body
    $data = json_decode(file_get_contents('php://input'), true);
    $input_username = $data['username'];
    $input_password = $data['password'];

    // Truy vấn để xác thực người dùng
    $sql = "SELECT * FROM staff WHERE username = ? AND password = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ss", $input_username, $input_password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        // Đăng nhập thành công
        $response = array(
            "success" => true,
            "message" => "Đăng nhập thành công",
            "staff" => $user_data
        );
    } else {
        // Đăng nhập thất bại
        $response = array(
            "success" => false,
            "message" => "Sai tên đăng nhập hoặc mật khẩu"
        );
    }

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();
?>
