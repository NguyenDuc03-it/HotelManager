<?php
require("connect.php");

$query = "SELECT * FROM `bookings` WHERE 1";
$data = mysqli_query($connect, $query);

$response = array(); // Mảng để lưu trữ tất cả thông tin đặt phòng

if ($data && $data->num_rows > 0) {
    while ($booking_data = $data->fetch_assoc()) {
        $room_id = $booking_data['room_id'];
        $customer_id = $booking_data['customer_id'];

        // Truy vấn thông tin phòng
        $sql1 = "SELECT * FROM rooms WHERE room_id = ?";
        $stmt = $connect->prepare($sql1);
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $room_data = $result->num_rows > 0 ? $result->fetch_assoc() : null;

        // Truy vấn thông tin khách hàng
        $sql2 = "SELECT * FROM customers WHERE customer_id = ?";
        $stmt1 = $connect->prepare($sql2);
        $stmt1->bind_param("i", $customer_id);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $customer_data = $result1->num_rows > 0 ? $result1->fetch_assoc() : $customer_data = array(
            "customer_id" => 0,
            "fullname" => "NULL",
            "sex" => "",
            "cccd" => "",
            "phone" => ""
        );;

        // Thêm thông tin vào phản hồi
        $response[] = array(
            "success" => true,
            "booking" => $booking_data,
            "customer" => $customer_data,
            "room" => $room_data
        );
    }
} else {
    $response[] = array("success" => false, "message" => "Không có dữ liệu đặt phòng.");
}

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
