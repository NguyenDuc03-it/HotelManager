<?php
require("connect.php");
$query = "SELECT * FROM `rooms` WHERE 1";
$data = mysqli_query($connect, $query);

// Định nghĩa lớp Room
class Room {
    public $room_id;
    public $room_number;
    public $room_type;
    public $price;
    public $status;

    function __construct($room_id, $room_number, $room_type, $price, $status) {
        $this->room_id = $room_id;
        $this->room_number = $room_number;
        $this->room_type = $room_type;
        $this->price = $price;
        $this->status = $status;
    }
}

$arrRooms = array();
while ($row = mysqli_fetch_assoc($data)) {
    array_push($arrRooms, new Room(
        $row['room_id'],
        $row['room_number'],
        $row['room_type'],
        $row['price'],
        $row['status']
    ));
}
header('Content-Type: application/json');
echo json_encode($arrRooms, JSON_UNESCAPED_UNICODE);
$connect->close();
?>
