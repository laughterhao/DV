<?php
$host ="localhost";
$user = "Nic";
$passeword = "123456";
$dbname = "diving";
$charset = 'utf8mb4';

try{
  $opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset",$user,$passeword,$opt);


$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "連接成功";
}catch(PDOException $e){
  echo "連接失敗".$e->getMessage();
}
?>
