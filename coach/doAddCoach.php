<!-- 命名=丟資料的用階梯式命名 利於找資料 -->
<?php
require_once("../mysql-db-conn.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入";
    // die;
}
// 先測試有沒有跟表單連接到

$name = $_POST["name"]; //存起來
$gender = $_POST["gender"];
$birth = $_POST["birth"];
$email = $_POST["email"];
$phones = $_POST["phones"];
$city = $_POST["city"];
$experience = $_POST["experience"];
$license = $_POST["license"];
$info = $_POST["info"];
$skill = $_POST["skill"];
$time = date('Y-m-d H:i:s'); //直接用php抓取現在時間
$phones = array_filter($phones);
// ★加上檢查的一些功能 每個欄位會要檢查的不一樣
// $experience = array_filter($experience);
// $license = array_filter($license);

if (isset($_POST['phones'])) {
    $phones = $_POST['phones'];

    // 如果你想要逐一處理這些電話號碼，你可以使用迴圈
    foreach ($phones as $phone) {
        // 在這裡對每個電話號碼執行需要的操作
        var_dump($phone . ",");
        // 將這些值插入到資料庫中的程式碼
        // 請確保將這些值插入到資料庫的適當位置
    }
}
//如果user沒寫東西啦 給他顯示請輸入資料啦 就算你已經html加requied了也要  避免他輸入無效資料進去 前後端都要擋~~
if (empty($name) || empty($email) || empty($phones)) {
    echo "請輸入資料";
    die;
}
var_dump($phones);

// if ($_FILES["imgfile"]["error"] == 0) {
//     $img_filename = $_FILES["imgfile"]["name"];
//     $img_tmp_name = $_FILES["imgfile"]["tmp_name"];

//     if (move_uploaded_file($img_tmp_name, "../upload/" . $img_filename)) {
//         $sql = "INSERT INTO coach (name, gender, birth, email, phone, city, experience, license, info, skill, img, created_at, valid)
//         VALUES ('$name', '$gender', '$birth','$email', '$phone', '$city', '$experience', '$license', '$info', '$skill', '$img_filename', '$time', 1)";

//         if ($conn->query($sql) === TRUE) {
//             echo "新增資料完成";
//             $last_id = $conn->insert_id;
//             echo "最新一筆為序號" . $last_id;
//         } else {
//             echo "新增資料錯誤" . $conn->error;
//         }
//     } else {
//         echo "上傳失敗";
//     }
// } else {
//     echo "檔案上傳錯誤";
// }





//新增至sql資料庫 ↓
// $sql = "INSERT INTO coach (name, gender, birth, email, phone, city, experience, license, info, skill, created_at, valid)
// VALUES ('$name', '$gender', '$birth','$email', '$phone', '$city', '$experience', '$license', '$info', '$skill', '$time', 1)";
// VALUS 改成我們從POST接收到的變數↑
// echo $sql; 解釋:為了看時區有沒有抓到
// exit;  解釋:為了看時區有沒有抓到


// if ($conn->query($sql) === TRUE) {
//     echo "新增資料完成";
//     $last_id = $conn->insert_id;
//     echo "最新一筆為序號" . $last_id; // 看剛才新增的那一筆序號是多少 就是去抓流水號的意思~
// } else {
//     echo "新增資料錯誤" . $conn->error;
//     $conn->error;
// }




$conn->close();
//header("location: add-user.php"); 回到原本的頁面~ 回到哪頁可以選的喔~ 會跳過上面剛剛那些 user就看不到了~

// 最好的方法是可以讓管理者再看到新增資料成功 看到所有使用者
// header("location: coach-list.php");
