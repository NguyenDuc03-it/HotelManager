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


    $fullname = $data['fullname'];
    $sex = $data['sex'];
    $email = $data['email'];
    $phone = $data['phone'];
    $username = $data['username'];
    $password = $data['password'];
    $position = $data['position'];


    // Kiểm tra xem nhân viên đã tồn tại chưa
    $sql = "SELECT staff_id FROM staff WHERE username = ? OR email = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Nhân viên đã tồn tại
       
        $response = array(
            "success" => false,
            "message" => "Dữ liệu tài khoản nhân viên đã tồn tại!"
        );
    } else {
        // Thêm mới nhân viên
        $sql = "INSERT INTO staff (fullname, sex, position, email, phone, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sssssss", $fullname, $sex, $position, $email, $phone, $username, $password);
        $stmt->execute();

        // Trả về thông tin thành công
        $response = array(
            "success" => true,
            "message" => "Thêm mới nhân viên thành công!"
        );
    }


    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();
?>
