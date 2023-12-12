<?php
require_once("DB_conn.php");

try {
  $sql = "SELECT * FROM notice WHERE valid = '1'";
  $result = $conn->prepare($sql);
  $result->execute();
  $rows = $result->fetchall();

} catch (PDOException $e) {
  echo "Error:" . "<br>" . $e->getMessage();
}
$conn = null;
