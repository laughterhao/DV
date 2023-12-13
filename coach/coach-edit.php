<?php

if (!isset($_GET["id"])) {
    header("location: coach-list.php");
}

$id = $_GET["id"]; //裝起來

require("./coach_connect.php");

$sql = "SELECT c.*, GROUP_CONCAT(cl.license_id) AS license_ids
-- 使用 GROUP_CONCAT(cl.license_id) 聚合函數，將 coach_license 中對應每個教練的 license_id 聯結成一個字串
FROM coach c
LEFT JOIN coach_license cl ON c.id = cl.coach_id
WHERE c.id = $id
-- GROUP BY c.id";
// 如果是GROUP BY c.id，SQL 將根據 c.id 分組資料，並為每個唯一的 c.id 顯示一行資料。這意味著結果集中將會有每個唯一的 c.id，對應到每個教練的相關資料以及他們的執照ID列表。這會將結果集中的資料按照 c.id 分組，每個不同的 c.id 將會成為結果集中的一個獨立群組，並且在這個群組中會包含符合該 c.id 條件的所有記錄。

// 目的1: 合併coach表的id & coach_license表 的id (要抓coach_license.coach_id 跟 coach_license.license_id)

$result = $conn->query($sql);
$userCount = $result->num_rows;
$rows = $result->fetch_assoc();
// var_dump($rows);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Coach Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    include("css-coach.php");
    ?>
    <style>

    </style>

</head>

<body>
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="" aria-hidden="true"> <!-- 在這個裡面改id 要把modal可以不用JS 用id叫 -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">警告</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確認刪除?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">取消</button>
                    <a href="doDeleteCoach.php?id=<?= $rows["id"] ?>" class="btn btn-danger text-white">確認</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <main class="row">
            <nav class="main-nav col-2 p-0">
                <h1 class="my-4 text-center">DiVING</h1>
                <ul class="main-ul list-unstyle p-0">
                    <li class="main-li"><a href="index.php"><i class="bi bi-intersect"></i>總覽</a></li>
                    <li class="main-li"><a href="order-list.php"><i class="bi bi-file-text"></i>訂單管理</a></li>
                    <li class="main-li"><a href="product-list.php"><i class="bi bi-bag-fill"></i>商品及分類</a></li>
                    <li class="main-li"><a href="member-list.php"><i class="bi bi-person-circle"></i>顧客管理</a></li>
                    <li class="main-li"><a href="lessonList.php"><i class="bi bi-tv"></i>課程管理</a></li>
                    <li class="main-li"><a href="coach-list.php"><i class="bi bi-person-vcard"></i>教練管理</a></li>
                    <li class="main-li"><a href="coupon-list.php"><i class="bi bi-shop-window"></i>行銷</a></li>
                    <li class="main-li"><a href=""><i class="bi bi-megaphone"></i>公告</a></li>
                </ul>
            </nav>

            <div class="col-10 px-0" style="margin-left: 16.66%;">
                <div class="main-top">
                    <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
                </div>

                <div class="container rounded-3 p-5 border flex-nowrap">
                    <?php if ($userCount == 0) : ?>
                        <h1>使用者不存在</h1>
                    <?php else : ?>
                        <form class="row" action="doUpdateCoach.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $rows["id"] ?>">
                            <div class="d-flex justify-content-between mt-4">
                                <h4>編輯教練</h4>
                                <!-- 把原本的a 改成button 就不是超連結了 因為要呼叫上面那個modal 
                    沒寫type=button的話 預設會是submit喔-->
                                <button type="button" data-bs-toggle="modal" data-bs-target="#alertModal" class="btn btn-danger text-white">刪除教練</button>

                            </div>

                            <div class="col-4">
                                <img class="ratio ratio-1x1 mb-4 img-thumbnail rounded-circle my-3 object-fit-cover" id="output" src="./upload/<?= $rows["img"] ?>" style="height: 300px;" />
                                <input class="form-control" type="file" accept="image/*" onchange="loadFile(event)" id="newImgfile" name="newImgfile">

                                <div>
                                    <label for="" class="mt-3">專長</label>
                                    <input class="form-control" type="text" placeholder="專長" aria-label="skill" id="skill" name="skill" value="<?= $rows["skill"] ?>" required>
                                </div>

                                <div>
                                    <label for="" class="mt-3">地區</label>
                                    <input class="form-control " type="text" placeholder="地區" id="city" name="city" value="<?= $rows["city"] ?>" required>
                                </div>

                            </div>
                            <div class="col-7 ms-3">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <label for="">姓名</label>
                                        <input type="text" class="form-control" placeholder="請輸入姓名" id="name" name="name" value="<?= $rows["name"] ?>" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="mb-2">性別</label><br>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="male">男</label>
                                            <input class="form-check-input" type="radio" name="gender" id="gender" value="1" <?php if ($rows["gender"] != "2") echo "checked"; ?> />

                                        </div>
                                        <div class="form-check form-check-inline">
                                            <!-- 兩個input設定同一個name才能做單選；設定value才能帶到後端去 -->
                                            <label class="form-check-label" for="female">女</label>
                                            <input class="form-check-input" type="radio" name="gender" id="gender" value="2" <?php if ($rows["gender"] == "2") echo "checked"; ?> />
                                            <!-- 性別資料 存到資料庫時通常會用1或2 不會用單字 -->
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="date">生日</label>
                                        <input placeholder="請選擇日期" class="form-control" value="1990-01-01" max="" type="date" id="birth" name="birth" <?= $rows["birth"] ?>>

                                    </div>

                                    <div class="col-6 ">
                                        <label for="email" class="">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="<?= $rows["email"] ?>" required>
                                    </div>


                                    <div class="col-6 ">
                                        <label for="phone" class="">電話號碼</label>
                                        <input type="phone" class="form-control" id="phone" placeholder="請輸入電話號碼" name="phone" value="<?= $rows["phone"] ?>" required>
                                    </div>

                                    <div class="col-3 ">
                                        <label for="number" class="">教學年資</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" placeholder="請輸入數字" id="experience" name="experience" value="<?= $rows["experience"] ?>">
                                            <label class="input-group-text" for="experience">年</label>
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="license ">
                                            <label for="" class="me-3">證照</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="license" value="1" name="license[]" <?php if (strpos($rows["license_ids"], '1') !== false) echo "checked"; ?>>
                                                <!-- 這將檢查 $rows["license_ids"] 中是否包含 1 這個字串。如果包含，strpos 會返回 1 的索引位置（索引從 0 開始），否則會返回 false。 -->
                                                <label class="form-check-label" for="license1">PADI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="license" value="2" name="license[]" <?php if (strpos($rows["license_ids"], '2') !== false) echo "checked"; ?>>
                                                <label class="form-check-label" for="license2">NAUI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="license" value="3" name="license[]" <?php if (strpos($rows["license_ids"], '3') !== false) echo "checked"; ?>>
                                                <label class="form-check-label" for="license3">SSI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="license" value="4" name="license[]" <?php if (strpos($rows["license_ids"], '4') !== false) echo "checked"; ?>>
                                                <label class="form-check-label" for="license4">CMAS</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <label for="info" class="form-label">教練介紹</label>
                                        <textarea class="form-control" id="info" name="info" rows="5"><?= $rows["info"] ?></textarea>
                                    </div>

                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a class="btn btn-danger text-white" href="coach-list.php">取消</a>
                                    <button class="btn" type="submit">儲存</button>
                                </div>
                                <p>上次更新時間:<?= $rows["upload_at"] ?> </p>
                        </form>

                    <?php endif ?>
                </div>

            </div>
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
</body>

</html>