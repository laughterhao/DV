<?php

$serverName = "localhost";
$userName = "admin";
$password = "12345";
$dbname = "exam";

$conn = new mysqli($serverName, $userName, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    // echo "連線成功";
}