<?php

require("..". DIRECTORY_SEPARATOR ."DB_conn.php");

// if(!isset($_POST["name"])){
//     echo "請循正常管道進入";
//     die;
// }

$name = $_POST["name"];
$code = $_POST["code"];
$max_count = $_POST["max_count"];
$discount_method = $_POST["discount_method"];
$discount = $_POST["discount"];
$start = $_POST["start"];
$end = $_POST["end"];

$stmt = $conn->prepare('SELECT * FROM `coupon` WHERE code =:code ');

$stmt->execute([':code' => $code]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rowCount = $stmt->rowCount();

if (empty($name) || empty($code) || empty($max_count) || empty($discount) || empty($start) || empty($end)) {
    $data = [
        "status" => 0,
        "message" => "請輸入必填欄位"
    ];
    echo json_encode($data);
    exit;
}

if ($rowCount > 0) {
    $data = [
        "status" => 0,
        "message" => "此優惠碼已存在"
    ];
    echo json_encode($data);
    exit;
}

if (strtotime($start) > strtotime($end)) {
    $data = [
        "status" => 0,
        "message" => "使用期間格式錯誤"
    ];
    echo json_encode($data);
    exit;
}

try {
    if ($discount_method == "discount_cash") {
        $sql = "INSERT INTO `coupon` (`name`, `code`, `max_count`, `discount_cash`, `start`, `end`, `valid`) VALUES (:name, :code, :max_count, :discount, :start, :end, 1)";
    } else {
        $sql = "INSERT INTO `coupon` (`name`, `code`, `max_count`, `discount_pa`, `start`, `end`, `valid`) VALUES (:name, :code, :max_count, :discount, :start, :end, 1)";
    }
    $statement = $conn->prepare($sql); //資料先作暫存
    $statement->execute([':name' => $name, ':code' => $code, ':max_count' => $max_count, ':discount' => $discount, ':start' => $start, ':end' => $end]);
    $data = [
        "status" => 1,
        "message" => "新增優惠券完成"
    ];
    echo json_encode($data);
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
