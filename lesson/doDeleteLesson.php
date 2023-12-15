<?php
// require_once("./db_connect.php");
require("..". DIRECTORY_SEPARATOR ."mysql-db-conn.php");

if (isset($_GET["id"])) {
    // 如果是一個陣列，取得所有ID
    $ids = is_array($_GET["id"]) ? $_GET["id"] : array($_GET["id"]);
    // var_dump($ids);

    foreach ($ids as $id) {
        $sql = "UPDATE lesson SET valid=2 WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "刪除成功";
        } else {
            echo "刪除失敗: " . $conn->error;
        }
    }
}
$conn->close();
header("location: lessonList.php");