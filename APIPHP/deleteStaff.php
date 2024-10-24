<?php
require("connect.php");

// Nhận dữ liệu từ request
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Lấy ID staff từ query string
    $staffId = $_GET['staff_id']; // Sử dụng $_GET để lấy tham số từ query string

    // Kiểm tra xem staff có tồn tại không
    $sql = "SELECT staff_id FROM staff WHERE staff_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $staffId); // Sử dụng "i" nếu staff_id là số nguyên
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // staff tồn tại, tiến hành xóa
        $sql = "DELETE FROM staff WHERE staff_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $staffId);
        $stmt->execute();

        // Trả về thông tin thành công
        $response = array(
            "success" => true,
            "message" => "Xóa nhân viên thành công!"
        );
    } else {
        // Khách hàng không tồn tại
        $response = array(
            "success" => false,
            "message" => "Nhân viên không tồn tại!"
        );
    }

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();

?>
