<?php
require_once("./coach_connect.php");
// 之後可以自己加上 最後更新時間
// 如果每次更新都記錄 就是log =幫助檢查所有使用者行為 是後端在作的


// 處理我的資料 確保說一定都是透過POST來的 再接收資料 再去弄到sql裡面再執行
if (!isset($_POST["name"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_POST["id"];
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
// echo $name; 測試

$sql = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id=$id";

echo $sql; // 測試 如果沒有值的話會被清空 要有預設的值在裡面才行

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤 : " . $conn->error;
}

$conn->close();

header("location: user-edit.php?id=$id");
