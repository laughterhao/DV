<?php

require("..". DIRECTORY_SEPARATOR ."DB_conn.php");

$id = $_GET["id"];

$sql = "UPDATE `coupon` SET `valid`= 0 WHERE id=$id";

try {
  $statement = $conn->prepare($sql); //資料先作暫存
  $statement->execute();
  $data = [
    "status" => 1,
    "message" => "刪除優惠券成功"
  ];
  echo json_encode($data);
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;

header("location: ../coupon-pdo-version/coupon-list.php");
