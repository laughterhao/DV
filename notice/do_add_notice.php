<?php
require(".." . DIRECTORY_SEPARATOR . "DB_conn.php");
$title_img = $_POST["title_img"];
$title = $_POST["title"];
$sort = $_POST["sort"];
$content = $_POST["content"];
$img = $_POST["img"];
$end_date = $_POST["end_date"];
$timestamp = date("Y-m-d");
$fileName = $_FILES["img"]["name"];



try {
  $sql = "INSERT INTO `notice` ( `Title`, `Sort`, `Content`, `Main_img`, `Exp_date`, `Create_at` ,valid) VALUES (:title, :sort, :content, :img, :end_date, :Create_at, '1')";
  $statement = $conn->prepare($sql); //資料先作暫存
  function NumToST($sort)
  {
    switch ($sort) {
      case 1:
        return "體驗";
        break;
      case 2:
        return "深潛";
        break;
      default:
        return "自由潛水";
        break;
    }
  }
  $word = NumToST($sort);

  if (!isset($_POST["sort"]) || empty($_POST["sort"])) {
    // $_POST["sort"] 沒有被設定或者其值為空
    echo "sort 的值沒有被設定或者為空";
    exit;
  } else {
    $sort = $_POST["sort"];
    // 現在你可以使用 $sort 的值了
  }

  if ($_FILES["file"]["error"] == 0) {
    move_uploaded_file($_FILES["img"]["tmp_name"], "../images/notice/" . $fileName);
    echo "上傳成功";
  } else {
    echo "上傳失敗";
  }
  $statement->execute([':title' => $title, ':sort' => $word, ':content' => $content, ':img' => $fileName, ':end_date' => $end_date, ':Create_at' => $timestamp]);
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;

header('Location: notice.php'); //轉跳list
exit();
