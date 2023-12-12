<?php
require_once("DB_conn.php");
$id = $_GET['id'];
$sql = "UPDATE notice SET valid = 0 WHERE id = :id ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$conn = null;
header('Location: http://localhost/DiVing/new.php'); //轉跳list
exit();
