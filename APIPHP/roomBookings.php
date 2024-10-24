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

    $fullname = $data['customers']['fullname'];
    $sex = $data['customers']['sex'];
    $cccd = $data['customers']['cccd'];
    $phone = $data['customers']['phone'];
    $room_number = $data['room']['room_number'];
    $check_in_date = $data['bookings']['check_in_date'];
    $check_out_date = $data['bookings']['check_out_date'];
    $price_booking = $data['bookings']['price_booking'];

    // Kiểm tra xem khách hàng đã tồn tại chưa
    $sql = "SELECT customer_id, fullname FROM customers WHERE cccd = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $cccd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Khách hàng đã tồn tại
        $customer_data = $result->fetch_assoc();
        $customer_id = $customer_data['customer_id'];
        $customer_name = $customer_data['fullname'];

        if ($customer_name !== $fullname) {
            $response = array(
                "success" => false,
                "message" => "Dữ liệu CCCD và tên khách hàng khác đã tồn tại trong hệ thống!"
            );
            // Đặt header và trả về
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    } else {
        // Thêm mới khách hàng
        $sql = "INSERT INTO customers (fullname, sex, cccd, phone) VALUES (?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ssss", $fullname, $sex, $cccd, $phone);
        $stmt->execute();
        $customer_id = $stmt->insert_id; // Lấy mã khách hàng mới
    }

    // Lấy room_id từ room_number
    $sql = "SELECT room_id FROM rooms WHERE room_number = ? AND status = 'Trống'";
    $stmt = $connect->prepare($sql);    
    $stmt->bind_param("s", $room_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room_data = $result->fetch_assoc();
        $room_id = $room_data['room_id'];

        // Thêm đặt phòng
        $sql = "INSERT INTO bookings (customer_id, room_id, check_in_date, check_out_date, price_booking, status) VALUES (?, ?, ?, ?, ?, 'Chưa thanh toán')";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("iisss", $customer_id, $room_id, $check_in_date, $check_out_date, $price_booking);
        $stmt->execute();

        // Cập nhật trạng thái phòng
        $sql = "UPDATE rooms SET status = 'Đã đặt' WHERE room_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $room_id);
        $stmt->execute();

        // Trả về thông tin thành công
        $response = array(
            "success" => true,
            "message" => "Đặt phòng thành công"
        );
    } else {
        // Phòng không còn trống
        $response = array(
            "success" => false,
            "message" => "Phòng không còn trống"
        );
    }

    // Đặt header để trả về dữ liệu JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Đóng kết nối
$connect->close();
?>
