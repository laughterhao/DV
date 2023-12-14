<?php
// 如果沒有值的話讓她回到isset 因為原本沒有值的話他會跑到錯誤葉面 POST是把輸入內容寫到資料庫 / GET 就是讀出不一樣的資料
if (!isset($_GET["id"])) {
    header("location: coach-list.php"); //GET不一定要用表單 也可以用按鈕去抓唷(設在user-list)
}

$id = $_GET["id"]; //裝起來

require(".." . DIRECTORY_SEPARATOR . "mysql-db-conn.php");

$sql = " SELECT coach.*,  GROUP_CONCAT(license.name) AS license_names
FROM coach
LEFT JOIN coach_license ON coach.id = coach_license.coach_id
LEFT JOIN license ON coach_license.license_id = license.id
WHERE coach.id = $id";

// 目的1: 合併coach表的id & coach_license表 的id (要抓coach_license.coach_id 跟 coach_license.license_id)

// 目的2: 合併coach_license表 的id & license表的id (要顯示license.name)

$result = $conn->query($sql);
$userCount = $result->num_rows;
// 抓到他query之後結果的筆數 來判斷下面還要不要跑  (就是如果你在網址上面修改參數id=10 實際沒有10筆的話 會跳錯誤 所以要加上這個變數 再去下面做判斷函式)

$row = $result->fetch_assoc();
// var_dump($row);

?>

<!doctype html>
<html lang="en">

<head>
    <title>Coach</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    include("css-coach.php");
    ?>
</head>

<body>

    <div class="container-fluid">
        <main class="row">
            <nav class="main-nav col-lg-2 p-0">
                <h1 class="my-4 text-center">DiVING</h1>
                <ul class="main-ul list-unstyle p-0">
                    <li class="main-li"><a href="..\"><i class="bi bi-intersect"></i>總覽</a></li>
                    <li class="main-li"><a href="..\order\order-list.php"><i class="bi bi-file-text"></i>訂單管理</a></li>
                    <li class="main-li"><a href="..\product\product-list.php"><i class="bi bi-bag-fill"></i>商品及分類</a></li>
                    <li class="main-li"><a href="..\member\member-list.php"><i class="bi bi-person-circle"></i>顧客管理</a></li>
                    <li class="main-li"><a href="..\lesson\lessonList.php"><i class="bi bi-tv"></i>課程管理</a></li>
                    <li class="main-li"><a href="coach-list.php"><i class="bi bi-person-vcard"></i>教練管理</a></li>
                    <li class="main-li"><a href="..\coupon-pdo-version\coupon-list.php"><i class="bi bi-shop-window"></i>行銷</a></li>
                    <li class="main-li"><a href="..\notice\notice.php"><i class="bi bi-megaphone"></i>公告</a></li>
                </ul>
            </nav>

            <div class="col-10 px-0" style="margin-left: 16.66%;">
                <div class="main-top">
                    <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
                </div>

                <!-- 先做UI做好 (基本表格)~再去做別的是 -->
                <div class="container col-lg-10 bg-white rounded-3 my-5 border">
                    <h3 class="mt-4">教練資訊</h3>
                    <div class="py-2"><a class="btn" href="coach-list.php" title="回到教練列表"><i class="bi bi-arrow-left-circle-fill"></i></a>
                    </div>
                    <!-- 把它包起來 判斷XX的時候 就不跑下面那個表格 就是有人會搞事啦 所以都要做這種預防的 意外事件的處理-->
                    <?php if ($userCount == 0) : ?>
                        <h1>使用者不存在</h1>
                    <?php else : ?> <!-- 就列出table以下資訊  保留上面那個按鈕-->

                        <div class="container ">
                            <div class="row">
                                <div class="col-md-5 table-responsive">
                                    <img class="mb-4 img-thumbnail rounded-circle my-3 object-fit-cover" src="../images/coach/<?= $row["img"] ?>" alt="<?= $row["img"] ?>" style="height: 300px;">
                                    <table class="table table-bordered ">
                                        <tr>
                                            <th>教學年資</th>
                                            <td><?= $row["experience"] ?>年</td>
                                        </tr>
                                        <tr>
                                            <th>專長</th>
                                            <td><?= $row["skill"] ?> </td>
                                        </tr>
                                        <tr>
                                            <th>地區</th>
                                            <td><?= $row["city"] ?></td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="col-6">

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>姓名</th>
                                            <td><?= $row["name"] ?> </td>
                                        </tr>
                                        <tr>
                                            <th>性別</th>
                                            <?php $genderText = ($row["gender"] == 1) ? '男' : '女';
                                            ?>
                                            <td><?= $genderText; ?> </td>
                                        </tr>
                                        <tr>
                                            <th>生日</th>
                                            <td><?= $row["birth"] ?> </td>
                                        </tr>

                                        <tr>
                                            <th>email</th>
                                            <td><?= $row["email"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>電話號碼</th>
                                            <td><?= $row["phone"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>證照</th>
                                            <td><?= $row["license_names"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>教練介紹</th>
                                            <td><?= $row["info"] ?></td>
                                        </tr>

                                        <tr>
                                            <th>加入時間</th>
                                            <td><?= $row["created_at"] ?></td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- 在這邊加上修改資料的功能 -->
                        <div class="py-2">
                            <a class="btn" href="coach-edit.php?id=<?= $row["id"] ?>" title="修改資料"><i class="bi bi-pencil-fill "></i></a>
                            <!-- F12可以看 按鈕的id有沒有跟著變 跟user id 一樣 -->
                        </div>
                    <?php endif ?>
                </div>
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>