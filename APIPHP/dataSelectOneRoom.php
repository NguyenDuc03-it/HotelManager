<?php
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $room_number = $_GET['room_number'];

    // Lấy room_id từ room_number
    $sql = "SELECT room_id FROM rooms WHERE room_number = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $room_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room_data = $result->fetch_assoc();
        $room_id = $room_data['room_id'];

        // Lấy booking_id từ room_id
        $sql = "SELECT * FROM bookings WHERE room_id = ? AND status = 'Chưa thanh toán'";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $booking_data = $result->fetch_assoc();
            $customer_id = $booking_data['customer_id'];

            // Lấy thông tin khách hàng
            $sql = "SELECT * FROM customers WHERE customer_id = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("i", $customer_id);
            $stmt->execute();
            $customer_result = $stmt->get_result();

            if ($customer_result->num_rows > 0) {
                $customer_data = $customer_result->fetch_assoc();

                // Lấy thông tin phòng
                $sql = "SELECT * FROM rooms WHERE room_id = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("i", $room_id);
                $stmt->execute();
                $room_result = $stmt->get_result();

                if ($room_result->num_rows > 0) {
                    $room_info = $room_result->fetch_assoc();
                    $response = array(
                        "success" => true,
                        "booking" => $booking_data,
                        "customer" => $customer_data,
                        "room" => $room_info
                    );
                } else {
                    $response = array("success" => false, "message" => "Không tìm thấy thông tin phòng.");
                }
            } else {
                // Không tìm thấy thông tin khách hàng
                $customer_data = array(
                    "customer_id" => 0,
                    "fullname" => "",
                    "sex" => "",
                    "cccd" => "",
                    "phone" => ""
                );

                // Lấy thông tin phòng
                $sql = "SELECT * FROM rooms WHERE room_id = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("i", $room_id);
                $stmt->execute();
                $room_result = $stmt->get_result();

                if ($room_result->num_rows > 0) {
                    $room_info = $room_result->fetch_assoc();
                    $response = array(
                        "success" => true,
                        "booking" => $booking_data,
                        "customer" => $customer_data,
                        "room" => $room_info
                    );
                } else {
                    $response = array("success" => false, "message" => "Không tìm thấy thông tin phòng.");
                }
            }
        } else {
            $response = array("success" => false, "message" => "Không tìm thấy thông tin đặt phòng.");
        }
    } else {
        $response = array("success" => false, "message" => "Không tìm thấy phòng.");
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

$connect->close();
?>
