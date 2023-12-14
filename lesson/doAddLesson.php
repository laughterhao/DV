<?php
require_once("../mysql-db-conn.php");

// if(!isset($_POST["name"])){
//     echo "請依循正常管道進入 ";
//     exit;
// }

$image = "01.jpg";
$name = "level1課程";
$price = 16000;
$time = date("Y-m-d H:i:s");

$sql = "INSERT INTO lesson (image, name, price, valid, created_at)
VALUES ('$image', '$name', '$price', '1', '$time')";


if ($conn->query($sql) === TRUE) {
    echo "新增成功";
} else {
    echo "新增錯誤: " . $conn->error;
}

$conn -> close();
