<?php
require("..". DIRECTORY_SEPARATOR ."mysql-db-conn.php");

if(!isset($_GET["product_id"])){
    echo "請循正常管道進入此頁";
    exit;
}

$id=$_GET["product_id"];

$sql="UPDATE product SET valid=1
WHERE product_id=$id";



if($conn->query($sql) === TRUE){
    echo "刪除成功";
}else{
    echo "刪除資料錯誤: ";
    $conn->error;
}

$conn->close();

header("location: product-list.php");
