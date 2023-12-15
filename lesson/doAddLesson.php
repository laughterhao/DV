<?php
// require_once("./db_connect.php");
require("..". DIRECTORY_SEPARATOR ."mysql-db-conn.php");

if(!isset($_POST["name"])){
    echo "請依循正常管道進入 ";
    exit;
}

$image = $_FILES["file"]["name"];
$name = $_POST["name"];
$info = $_POST["info"];
$content = $_POST["content"];
$sort = $_POST["sort"];
$location = $_POST["location"];
$price = $_POST["price"];
$maxPerson = $_POST["max-person"];
$time = date("Y-m-d H:i:s");

if ($_FILES["file"]["error"] == 0) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "./images/" . $_FILES["file"]["name"])) {
        $sql = "INSERT INTO lesson (image, name, info, content, sort, location,  price, max_person, valid, created_at)
        VALUES ('$image', '$name', '$info', '$content', '$sort', '$location', '$price', '$maxPerson', 1, '$time')";
        if ($conn->query($sql) === TRUE) {
            $modal = true;
            header("location: lessonList.php");
        }
    } else {
        echo "新增失敗" . $conn->error;
    }
}


$conn->close();
