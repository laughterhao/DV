<?php
// require_once("./db_connect.php");
require("..". DIRECTORY_SEPARATOR ."mysql-db-conn.php");

if (!isset($_POST["name"])) {
    echo "請依循正常管道進入 ";
    exit;
}

$id = $_POST["id"];
$image = $_FILES["file"]["name"];
$name = $_POST["name"];
$info = $_POST["info"];
$content = $_POST["content"];
$sort = $_POST["sort"];
$location = $_POST["location"];
$price = $_POST["price"];
$maxPerson = $_POST["max_person"];

$sql = "UPDATE lesson
        SET name = '$name',
            info = '$info',
            content = '$content',
            sort = '$sort',
            location = '$location',
            price = '$price',
            max_person = '$maxPerson'
        WHERE id = $id";

if ($_FILES["file"]["error"] == 0) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "./images/" . $_FILES["file"]["name"])) {
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
    } else {
        echo "新增失敗" . $conn->error;
    }
}

if ($conn->query($sql) === TRUE) {
    // echo "新增成功";
    header("location: ./lessonList.php");
} else {
    echo "編輯失敗" . $conn->error;
}
$conn->close();
