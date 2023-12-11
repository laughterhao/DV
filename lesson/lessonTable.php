<?php
require_once("../mysql-db-conn.php");

// 建立課程資料表
$sql = "CREATE TABLE lesson (
    id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    sort INT(3) UNSIGNED,
    price INT(6) UNSIGNED,
    info TEXT,
    content TEXT,
    pre_person INT(4) UNSIGNED,
    max_person INT(4) UNSIGNED,
    coach_id INT(3) UNSIGNED,
    location INT(3) UNSIGNED,
    image VARCHAR(50),
    update_at DATETIME,
    created_at DATETIME,
    valid INT(3) UNSIGNED
    ) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if($conn->query($sql)===TRUE){
    echo "success";
}else{
    echo "fail: " . $conn->error;
}



// 建立圖片資料表

// 建立年齡分類表

// 建立課程種類表

$conn -> close();
