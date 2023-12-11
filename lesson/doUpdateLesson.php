<?php
require_once("./db_connect.php");

// if(!isset($_POST["name"])){
//     echo "請依循正常管道進入 ";
//     exit;
// }

$id = $_POST["id"];
$image = "01.jpg";
$name = $_POST["name"];
$info = $_POST["info"];
$content = $_POST["content"];
$sort = $_POST["sort"];
$location = $_POST["location"];
$price = $_POST["price"];
$maxPerson = $_POST["max_person"];

$sql = "UPDATE lesson
        SET image = '$image',
            name = '$name',
            info = '$info',
            content = '$content',
            sort = '$sort',
            location = '$location',
            price = '$price',
            max_person = '$maxPerson'
        WHERE id = $id";


if ($conn->query($sql) === TRUE) {
    header('location: ./lessonList.php');
} else {
    echo "新增錯誤: " . $conn->error;
}

$conn -> close();