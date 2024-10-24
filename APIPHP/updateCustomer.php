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

    $customerId = $data['customer_id'];
    $fullname = $data['fullname'];
    $sex = $data['sex'];
    $cccd = $data['cccd'];
    $phone = $data['phone'];

    // Lấy thông tin khách hàng
    $sql = "SELECT * FROM customers WHERE customer_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Khách hàng đã tồn tại
        $customer = $result->fetch_assoc();

        // Kiểm tra xem thông tin có thay đổi không
        if ($customer['fullname'] === $fullname && $customer['sex'] === $sex && $customer['phone'] === $phone && $customer['cccd'] === $cccd) {
            $response = array(
                "success" => false,
                "message" => "Dữ liệu đã tồn tại!"
            );
        } else {
            // Kiểm tra xem cccd này có trùng với cccd của khách hàng khác không
            $sql = "SELECT * FROM customers WHERE cccd = ? AND customer_id <> ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("si", $cccd, $customer['customer_id']);
            $stmt->execute();
            $checkResult = $stmt->get_result();

            if ($checkResult->num_rows > 0) {
                // Trùng cccd với khách hàng khác
                $response = array(
                    "success" => false,
                    "message" => "CCCD này đã tồn tại cho khách hàng khác!"
                );
            } else {
                // Cập nhật khách hàng
                $sql = "UPDATE customers SET fullname = ?, sex = ?, phone = ?, cccd = ? WHERE customer_id = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("ssssi", $fullname, $sex, $phone, $cccd, $customerId);
                $stmt->execute();

                // Trả về thông tin thành công
                $response = array(
                    "success" => true,
                    "message" => "Cập nhật khách hàng thành công!"
                );
            }
        }
    } else {
        // Khách hàng không tồn tại
        $response = array(
            "success" => false,
            "message" => "Khách hàng không tồn tại!"
        );
    }

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();
?>
