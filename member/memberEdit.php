<?php

<<<<<<< HEAD
require("../mysql-db-conn.php");
=======
require("..". DIRECTORY_SEPARATOR ."mysql-db-conn.php");
>>>>>>> origin/main

//先確認一定是透過post來的
if (!isset($_POST["name"])) {
    echo "請群正常管道進入";
    exit;
}

//取值
$id = $_POST["id"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$birth = $_POST["birth"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$city = $_POST["city"];
$address = $_POST["address"];
// var_dump($id);
// exit;


$sql = "UPDATE member
SET name='$name',gender='$gender', birth='$birth', email='$email', phone='$phone', city='$city',address='$address'
WHERE id=$id";

// var_dump($sql);

if ($conn->query($sql) === TRUE) {
    header("location:member-info.php?id=$id");
    exit;
} else {
    echo "更新錯誤";
    $conn->error;
}

$conn->close();
