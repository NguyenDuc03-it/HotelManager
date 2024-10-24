<?php
require("connect.php");
$query = "SELECT * FROM `customers` WHERE 1";
$data = mysqli_query($connect, $query);

// Định nghĩa lớp Customer
class Customer {
    public $customer_id;
    public $fullname;
    public $sex;
    public $cccd;
    public $phone;

    
    function __construct($customer_id, $fullname, $sex, $cccd, $phone) {
        $this->customer_id = $customer_id;
        $this->fullname = $fullname;
        $this->sex = $sex;
        $this->cccd = $cccd;
        $this->phone = $phone;
    }
}

$arrCustomers = array();
while ($row = mysqli_fetch_assoc($data)) {
    array_push($arrCustomers, new Customer(
        $row['customer_id'],
        $row['fullname'],
        $row['sex'],
        $row['cccd'],
        $row['phone']
    ));
}
header('Content-Type: application/json');
echo json_encode($arrCustomers, JSON_UNESCAPED_UNICODE);
$connect->close();
?>
