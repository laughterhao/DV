<?php
// require_once("./db_connect.php");
require("..". DIRECTORY_SEPARATOR ."mysql-db-conn.php");

// 建立課程資料表
$sql = "CREATE TABLE location (
    id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(10) NOT NULL,
    ) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if($conn->query($sql)===TRUE){
    echo "success";
}else{
    echo "fail: " . $conn->error;
}

$conn -> close();
