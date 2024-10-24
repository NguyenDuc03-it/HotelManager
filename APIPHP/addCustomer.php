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
    $cccd = $data['cccd'];
    $phone = $data['phone'];


    // Kiểm tra xem khách hàng đã tồn tại chưa
    $sql = "SELECT customer_id FROM customers WHERE cccd = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $cccd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Khách hàng đã tồn tại
       
        $response = array(
            "success" => false,
            "message" => "Dữ liệu khách hàng đã tồn tại!"
        );
    } else {
        // Thêm mới khách hàng
        $sql = "INSERT INTO customers (fullname, sex, cccd, phone) VALUES (?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ssss", $fullname, $sex, $cccd, $phone);
        $stmt->execute();

        // Trả về thông tin thành công
        $response = array(
            "success" => true,
            "message" => "Thêm mới khách hàng thành công!"
        );
    }


    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();
?>
