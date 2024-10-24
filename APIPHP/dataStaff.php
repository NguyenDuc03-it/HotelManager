<?php
    require "connect.php";
    $query = "SELECT * FROM `staff` WHERE 1 AND position<>'ADMIN'";
    $data = mysqli_query($connect, $query);

    class Staff {
        public $staff_id;
        public $fullname;
        public $sex;
        public $position;
        public $email;
        public $phone;
        public $username;
        public $password;

        function __construct($staff_id, $fullname, $sex, $position, $email, $phone, $username, $password) {
            $this->staff_id = $staff_id;
            $this->fullname = $fullname;
            $this->sex = $sex;
            $this->position = $position;
            $this->email = $email;
            $this->phone = $phone;
            $this->username = $username;
            $this->password = $password;
        }
    }

    $arrStaff = array();
    while($row = mysqli_fetch_assoc($data)){
        array_push($arrStaff, new Staff($row['staff_id'],
                                        $row['fullname'],
                                        $row['sex'],
                                        $row['position'],
                                        $row['email'],
                                        $row['phone'],
                                        $row['username'],
                                        $row['password']));
    }
    header('Content-Type: application/json');
    echo json_encode($arrStaff, JSON_UNESCAPED_UNICODE);
    $connect->close();
?>
