<?php
require("connect.php");

// Nhận dữ liệu từ request
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Lấy ID khách hàng từ query string
    $customerId = $_GET['customer_id']; // Sử dụng $_GET để lấy tham số từ query string

    // Kiểm tra xem khách hàng có tồn tại không
    $sql = "SELECT customer_id FROM customers WHERE customer_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $customerId); // Sử dụng "i" nếu customer_id là số nguyên
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Khách hàng tồn tại, tiến hành xóa
        $sql = "DELETE FROM customers WHERE customer_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $customerId);
        $stmt->execute();

        // Trả về thông tin thành công
        $response = array(
            "success" => true,
            "message" => "Xóa khách hàng thành công!"
        );
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
