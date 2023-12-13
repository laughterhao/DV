<!-- 命名=丟資料的用階梯式命名 利於找資料 -->
<?php
require_once("./coach_connect.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入";
    // die;
}
// 先測試有沒有跟表單連接到
var_dump($_POST);

$name = $_POST["name"]; //存起來
$gender = $_POST["gender"];
$birth = $_POST["birth"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$city = $_POST["city"];
$experience = $_POST["experience"];

$license = $_POST["license"];

$info = $_POST["info"];
$skill = $_POST["skill"];
$time = date('Y-m-d H:i:s'); //直接用php抓取現在時間
// ★加上檢查的一些功能 每個欄位會要檢查的不一樣

//如果user沒寫東西啦 給他顯示請輸入資料啦 就算你已經html加requied了也要  避免他輸入無效資料進去 前後端都要擋~~ 
if (empty($name) || empty($gender) || empty($birth) || empty($email) || empty($phone) || empty($city) || empty($experience) || empty($license) || empty($info) || empty($skill)) {
    echo "請輸入資料";
    die;
}

if ($_FILES["imgfile"]["error"] == 0) {
    $img_filename = $_FILES["imgfile"]["name"];
    $img_tmp_name = $_FILES["imgfile"]["tmp_name"];

    if (move_uploaded_file($img_tmp_name, "./upload/" . $img_filename)) {
        $sql = "INSERT INTO coach (name, gender, birth, email, phone, city, experience, info, skill, img, created_at, valid)
        VALUES ('$name', '$gender', '$birth','$email', '$phone', '$city', '$experience', '$info', '$skill', '$img_filename', '$time', 1)";
    } else {
        echo "上傳失敗";
    }
} else {
    echo "檔案上傳錯誤";
}

if ($conn->query($sql) === TRUE) {
    $id = $conn->insert_id;
    foreach ($license as $license_id) {
        $sql = "INSERT INTO coach_license (coach_id, license_id) VALUES ('$id', '$license_id')";
        $conn->query($sql);
    }

    echo "新增資料完成";
    $last_id = $conn->insert_id;
    echo "最新一筆為序號" . $last_id;
} else {
    echo "新增資料錯誤" . $conn->error;
}

$conn->close();

header("location: coach-list.php");
