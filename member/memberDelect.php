<?php

require("..". DIRECTORY_SEPARATOR ."mysql-db-conn.php");

$id= $_GET["id"];


$sql = "UPDATE member SET valid='0' WHERE id=$id";

if($conn -> query($sql) === TRUE){
    header("location: member-list.php");

}else{
    echo "失敗";
    exit;
}



$conn -> close();
