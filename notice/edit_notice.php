<?php
require("..". DIRECTORY_SEPARATOR ."DB_conn.php");// 連接資料庫
//取得前台變數
$id = $_POST["id"];
$title = $_POST["title"];
$sort = $_POST["sort"];
$content = $_POST["content"];
$fileName=$_FILES["img"]["name"];
$end_date = $_POST["end_date"];
$timestamp = date("Y-m-d");
//取得前台變數
try {
//變更資料表 內容
$sql = "UPDATE notice SET  Title=?, Sort=?, Content=?, Main_img=?, Exp_date=? WHERE id=?";
//儲存資料庫內容
$stmt = $conn->prepare($sql);
//送出資料
$stmt->execute([ $title, $sort, $content, $fileName, $end_date, $id]);
} catch (Throwable $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;
header('Location: notice.php'); //轉跳list
exit();
