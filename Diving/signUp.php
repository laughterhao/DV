<?php

session_start();

require_once("../Diving/db-connect.php");


if (!isset($_POST["email"])) {
    die("請從正常管道進入");
}

$email = $_POST["email"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];

echo "$email,$password,$repassword";

//檢查是否沒有填入值
if (empty($email) ) {
    //    die("請填入資料") ;
    $message =  "請輸入email";
    $_SESSION["error"]["message"] = $message;
    header("location:sign-up.php");
    exit;
}
if(empty($password) || empty($repassword)){
    $message =  "請輸入密碼";
    $_SESSION["error"]["message"] = $message;
    header("location:sign-up.php");
    exit;
}

//檢查email是否被使用過
$sql = "SELECT * FROM member WHERE email = '$email' AND valid=1";
$result = $conn->query($sql);
$rowCount = $result->num_rows;
if ($rowCount > 0) {
    // die("此帳號已存在");
    $message =  "此帳號已存在";
    $_SESSION["error"]["message"] = $message;
    header("location:sign-up.php");
    exit;
}

//檢查password=repassword
if ($password != $repassword) {

    // die("前後密碼不一致");
    $message =  "前後密碼不一致";
    $_SESSION["error"]["message"] = $message;
    header("location:sign-up.php");
    exit;
}

// 上面都通過後新增會員加入資料庫 -->
$time = date('Y-m-d H:i:s');
$sql = "INSERT INTO member (email, password, created_at,valid) VALUES ('$email','$password','$time','1') ";


if ($conn->query($sql) === TRUE) {
    echo "新增資料完成";
    $last_id = $conn->insert_id;
    echo "最新一筆的序號：" . $last_id;
} else {
    echo "新增資料錯誤" . $conn->error;
}

header("location:member-list.php");
