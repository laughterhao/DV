<?php
require_once("../mysql-db-conn.php");

if(isset($_POST["sale"])){
    $id = $_POST["sale"];
    $sql = "UPDATE lesson SET valid='1' WHERE id = $id";

}elseif(isset($_POST["unsale"])){
    $id = $_POST["unsale"];
    $sql = "UPDATE lesson SET valid='0' WHERE id = $id";
}

$conn -> query($sql);
header("location: lessonList.php");
$conn -> close();
