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

    $staff_id = $data['staff_id'];
    $fullname = $data['fullname'];
    $sex = $data['sex'];
    $email = $data['email'];
    $phone = $data['phone'];
    $password = $data['password'];


    // Cập nhật thông tin nhân viên
    $sql = "UPDATE staff SET fullname = ?, sex = ?, email = ?, phone = ?, password = ? WHERE staff_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssssi", $fullname, $sex, $email, $phone, $password, $staff_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = array(
            "success" => true,
            "message" => "Cập nhật thông tin nhân viên thành công!"
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Cập nhật thất bại!"
        );
    }

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();
?>
