<!--  軟刪除 要用update -->

<?php
require_once("./coach_connect.php");

if (!isset($_GET["id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_GET["id"];

// 改成valid=0 修改valid這個欄位的值 阿資料還是存在 只是看不到
$sql = "UPDATE users SET valid='0' WHERE id=$id";

// echo $sql;
// exit;
// 確認有沒有成功連到這一頁

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除失敗 : " . $conn->error;
}

$conn->close();

header("location: coach-list.php");
