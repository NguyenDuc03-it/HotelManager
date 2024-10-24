<?php
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $room_number = $_GET['room_number'];

    $sts = "Chưa thanh toán";
    $status = "Hủy đặt phòng";
    $stats = "Trống";

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
        $sql = "SELECT booking_id FROM bookings WHERE room_id = ? AND status = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("is", $room_id, $sts);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $booking_data = $result->fetch_assoc();
            $booking_id = $booking_data['booking_id'];

            // Lấy thông tin khách hàng
            $sql = "UPDATE bookings SET status = ? WHERE booking_id = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("si", $status, $booking_id);
            $stmt->execute();

            $query = "UPDATE rooms SET status = ? WHERE room_id = ?";
            $stmt = $connect->prepare($query);
            $stmt->bind_param("si", $stats, $room_id);
            $stmt->execute();

            // Trả về thông tin thành công
            $response = array(
                "success" => true,
                "message" => "Hủy đặt phòng thành công"
            );

            
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
