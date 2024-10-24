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

    $booking_id = $data['booking_id'];
    $staff_id = $data['staff_id'];
    $payment_date = $data['payment_date'];
    $amount = $data['amount'];

    // Bắt đầu giao dịch
    $connect->begin_transaction();

    try {
        // Kiểm tra id booking đã thanh toán chưa
        $sql = "SELECT * FROM bookings WHERE booking_id = ? AND status = 'Đã thanh toán'";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $response = array(
                "success" => false,
                "message" => "Phòng đã được thanh toán!"
            );
        }
        else{
            if($staff_id == ""){
                $response = array(
                    "success" => false,
                    "message" => "Không tìm thấy thông tin khách hàng!"
                );
            }
            else{ 
            // Thêm bản ghi vào bảng payments
            $sql = "INSERT INTO payments (booking_id, staff_id, payment_date, amount) VALUES (?, ?, ?, ?)";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("iiss", $booking_id, $staff_id, $payment_date, $amount);
            $stmt->execute();

            // Cập nhật trạng thái của booking thành "Đã thanh toán"
            $sql = "UPDATE bookings SET status = 'Đã thanh toán' WHERE booking_id = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("i", $booking_id);
            $stmt->execute();

            // Lấy room_id từ bookings
            $sql = "SELECT room_id FROM bookings WHERE booking_id = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("i", $booking_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $booking = $result->fetch_assoc();
                $room_id = $booking['room_id'];

                // Cập nhật trạng thái của phòng thành "Trống"
                $sql = "UPDATE rooms SET status = 'Trống' WHERE room_id = ?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("i", $room_id);
                $stmt->execute();
            }

            // Commit giao dịch
            $connect->commit();

            // Trả về thông tin thành công
            $response = array(
                "success" => true,
                "message" => "Thanh toán thành công!"
            );
        }
        }
    } catch (Exception $e) {
        // Rollback giao dịch nếu có lỗi
        $connect->rollback();
        $response = array(
            "success" => false,
            "message" => "Có lỗi xảy ra: " . $e->getMessage()
        );
    }

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();
?>
