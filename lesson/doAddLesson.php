<?php
require_once("../mysql-db-conn.php");

// if(!isset($_POST["name"])){
//     echo "請依循正常管道進入 ";
//     exit;
// }

$image = "01.jpg";
$name = $_POST["name"];
$info = $_POST["info"];
$content = $_POST["content"];
$sort = $_POST["sort"];
$location = $_POST["location"];
$price = $_POST["price"];
$maxPerson = $_POST["max-person"];
$time = date("Y-m-d H:i:s");


$sql = "INSERT INTO lesson (image, name, info, content, sort, location,  price, max_person, valid, created_at)
VALUES ('$image', '$name', '$info', '$content', '$sort', '$location', '$price', '$maxPerson', '1', '$time')";


if ($conn->query($sql) === TRUE) {
    header('location: ./lessonList.php');
} else {
    echo "新增錯誤: " . $conn->error;
}

$conn -> close();
