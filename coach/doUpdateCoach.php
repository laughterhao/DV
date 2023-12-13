<?php
require_once("./coach_connect.php");
// 之後可以自己加上 最後更新時間
// 如果每次更新都記錄 就是log =幫助檢查所有使用者行為 是後端在作的

// 處理我的資料 確保說一定都是透過POST來的 再接收資料 再去弄到sql裡面再執行
if (!isset($_POST["name"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_POST["id"];

$name = $_POST["name"];
$gender = $_POST["gender"];
$birth = $_POST["birth"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$city = $_POST["city"];
$experience = $_POST["experience"];

$info = $_POST["info"];
$skill = $_POST["skill"];
$time = date('Y-m-d H:i:s');

// echo $sql; 測試 如果沒有值的話會被清空 要有預設的值在裡面才行

//首先，取得原始的教練證照資訊：
$sql = "SELECT license_id FROM coach_license WHERE coach_id = $id";
$result = $conn->query($sql);

$license = isset($_POST["license"]) ? $_POST["license"] : [];

if (isset($_POST["license"])) {
    $original_licenses = [];
    while ($row = $result->fetch_assoc()) {
        $original_licenses[] = $row['license_id']; //原本資料表的資料
    }
    // 從表單提交過來的證照資訊
    $submitted_licenses = $_POST["license"];
    // $submitted_licenses_array = explode(',', $submitted_licenses);

    // 移除重複值
    $submitted_licenses = array_unique($submitted_licenses);

    // 找出需要新增和移除的證照 (array_diff 比對)
    $licenses_to_add = array_diff($submitted_licenses, $original_licenses);
    $licenses_to_remove = array_diff($original_licenses, $submitted_licenses);
    // 將需要新增的證照插入到 coach_license 表格中

    foreach ($licenses_to_add as $license_id) {
        $sql = "INSERT INTO coach_license (coach_id, license_id) VALUES ('$id', '$license_id')";
        $conn->query($sql);
    }

    // 將需要移除的證照從 coach_license 表格中刪除
    foreach ($licenses_to_remove as $license_id) {
        $sql = "DELETE FROM coach_license WHERE coach_id = $id AND license_id = $license_id";
        if ($conn->query($sql) !== TRUE) {
            echo "刪除資料錯誤: " . $conn->error;
        }
    }
} else {
    // 處理沒有收到 license 欄位的情況
    $sql = "DELETE FROM coach_license WHERE coach_id = $id";
    if ($conn->query($sql) !== TRUE) {
        echo "刪除資料錯誤: " . $conn->error;
    }
}

$sql = "SELECT img FROM coach WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$oldImagePath = $row["img"];
$newImagePath = $oldImagePath;

if ($_FILES["newImgfile"]["error"] === UPLOAD_ERR_NO_FILE) {
    $newImagePath = $oldImagePath;
} else {
    $newImagePath = $_FILES["newImgfile"]["name"];
    // 檢查是否有檔案被上傳
    if (move_uploaded_file($_FILES["newImgfile"]["tmp_name"],  "./upload/" . $newImagePath)) {
        // 如果成功上傳新圖片，你可以在這裡更新資料庫中的圖片路徑
        $sql = "UPDATE coach SET img = '$newImagePath' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "圖片更新成功";
        } else {
            echo "圖片更新失敗: " . $conn->error;
        }
    } else {
        echo "上傳新圖片失敗";
        exit;
    }
}

$sql = "UPDATE coach SET name='$name', gender='$gender', birth='$birth', email='$email', phone='$phone', city='$city', experience='$experience', info='$info', skill='$skill', upload_at='$time' WHERE id=$id";

if ($conn->query($sql) === TRUE) {

    echo "更新成功";
} else {
    echo "更新資料錯誤 : " . $conn->error;
}

$conn->close();

header("location: coach.php?id=$id");
// header("location: coach-list.php");
