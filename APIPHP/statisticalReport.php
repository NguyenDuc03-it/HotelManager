<?php
require("connect.php");

// Nhận dữ liệu từ request
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $data = json_decode(file_get_contents("php://input"), true);

    // // Kiểm tra xem dữ liệu có hợp lệ không
    // if (json_last_error() !== JSON_ERROR_NONE) {
    //     header('Content-Type: application/json');
    //     echo json_encode(array(
    //         "success" => false,
    //         "message" => "Dữ liệu không hợp lệ"
    //     ));
    //     exit;
    // }

    $fromDate = $_GET['fromDate'] ?? '';
    $toDate = $_GET['toDate'] ?? '';

    // Chuẩn bị câu truy vấn
    $query = "
        SELECT r.room_type, SUM(REPLACE(p.amount, ',', '') + 0) AS total_amount, COUNT(b.booking_id) AS booking_count
        FROM payments p
        JOIN bookings b ON p.booking_id = b.booking_id
        JOIN rooms r ON b.room_id = r.room_id
    ";

    // Kiểm tra nếu fromDate và toDate có dữ liệu
    if (!empty($fromDate) && !empty($toDate)) {
        $query .= " WHERE STR_TO_DATE(p.payment_date, '%d/%m/%Y') BETWEEN STR_TO_DATE(?, '%d/%m/%Y') AND STR_TO_DATE(?, '%d/%m/%Y')";
    } else {
        $query .= " WHERE p.payment_date IS NOT NULL";
    }
    
    $query .= " GROUP BY r.room_type";
    $stmt = $connect->prepare($query);
    if (!empty($fromDate) && !empty($toDate)) {
        $stmt->bind_param("ss", $fromDate, $toDate);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $response = array();
    while ($row = $result->fetch_assoc()) {
        $response[] = array(
            "room_type" => $row['room_type'],
            "total_amount" => $row['total_amount'],
            "booking_count" => $row['booking_count'],
        );
    }

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode(array(
        "success" => true,
        "data" => $response
    ));
}

// Đóng kết nối
$connect->close();
?>
