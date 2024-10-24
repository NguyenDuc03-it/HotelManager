<?php
    $hostname = "localhost";
    $username = "sa";
    $password = "123456";
    $database = "qlkhachsan";
    $connect = mysqli_connect($hostname, $username, $password, $database);
    // Đảm bảo sử dụng mã hóa UTF-8
    header('Content-Type: application/json');
    mysqli_query($connect, "SET NAMES 'utf8mb4'");
    
?>