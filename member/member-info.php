<?php
require("..". DIRECTORY_SEPARATOR ."mysql-db-conn.php");

if (!isset($_GET["id"])) { //如果沒有得到id的值會導倒會員列表
    header("location: member-list.php");
    exit;
}

//Get => 利用網址上面的變數去抓不同的內容
$id = $_GET["id"];
$sql = "SELECT * FROM member WHERE id=$id AND valid=1";
$result = $conn->query($sql);
$memberCount = $result->num_rows; //如果得到的id值的資料筆數為0
$row = $result->fetch_assoc(); //只要抓一筆資料

?>
<!doctype html>
<html lang="en">

<head>
    <title>Member Info</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="backe-template.css">
    <link rel="stylesheet" href="member-info.css">
</head>

<body>
    <main class="container-fluid p-0">
        <div class="row mx-0">
            <nav class="main-nav col-2 p-0">
                <h1 class="my-4 text-center">DiVING</h1>
                <ul class="main-ul list-unstyle p-0">
                    <li class="main-li"><a href="..\"><i class="bi bi-intersect"></i>總覽</a></li>
                    <li class="main-li"><a href="..\order\order-list.php"><i class="bi bi-file-text"></i>訂單管理</a></li>
                    <li class="main-li"><a href="..\product\product-list.php"><i class="bi bi-bag-fill"></i>商品及分類</a></li>
                    <li class="main-li"><a href="member-list.php"><i class="bi bi-person-circle"></i>顧客管理</a></li>
                    <li class="main-li"><a href="..\lesson\lessonList.php"><i class="bi bi-tv"></i>課程管理</a></li>
                    <li class="main-li"><a href="..\coach\coach-list.php"><i class="bi bi-person-vcard"></i>教練管理</a></li>
                    <li class="main-li"><a href="..\coupon-pdo-version\coupon-list.php"><i class="bi bi-shop-window"></i>行銷</a></li>
                    <li class="main-li"><a href="..\notice\notice.php"><i class="bi bi-megaphone"></i>公告</a></li>
                    </ul>
            </nav>

            <div class=" col-10 px-0" style="margin-left: 16.66%;">
                <div class="main-top">
                    <a href="" class="logout"><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
                </div>
                <!-- modal -->
                <div class="modal fade" id="blackModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">確定將"<?= $row["name"] ?>"列入黑名單嗎？</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                列入黑名單後，此顧客無法再購任何商品
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn " data-bs-dismiss="modal">取消</button>
                                <a class="btn" href="memberDelect.php?id=<?= $row["id"] ?>">確定</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid m-0 p-3">
                    <?php if ($memberCount == 0) : ?>
                        <h1>使用者不存在</h1>
                    <?php else : ?>
                        <!-- 會員資訊 -->
                        <div class="diving-block row ">
                            <div class="col-5">
                                <div class="memberinfo-block">
                                    <form action="member-edit.php" method="post">
                                        <a class="back-btn" href="member-list.php"><i class="bi bi-arrow-bar-left"></i>回到使用者列表</a>
                                        <div class="d-flex justify-content-between my-2 ">
                                            <h3>會員資訊</h3>
                                            <div>
                                                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#blackModal">列入黑名單</button>
                                                <a class="btn btn-sm" href="member-edit.php?id=<?= $row["id"] ?>">編輯</a>
                                            </div>
                                        </div>

                                        <table class="text-nowrap">
                                            <tr>
                                                <th>會員編號：</th>
                                                <td><?= $row["id"] ?></td>
                                            </tr>
                                            <tr>
                                                <th>姓名：</th>
                                                <td id="tdInfo"><?= $row["name"] ?></td>
                                            </tr>
                                            <tr>
                                                <th>性別：</th>
                                                <td><?= $row["gender"] ?></td>
                                            </tr>
                                            <tr>
                                                <th>生日：</th>
                                                <td id="tdInfo"><?= $row["birth"] ?></td>
                                            </tr>
                                            <tr>
                                                <th>信箱：</th>
                                                <td id="tdInfo"><?= $row["email"] ?></td>
                                            </tr>
                                            <tr>
                                                <th>電話：</th>
                                                <td id="tdInfo"><?= $row["phone"] ?></td>
                                            </tr>
                                            <tr>
                                                <th>地址：</th>
                                                <td id="tdInfo"><?= $row["city"] . $row["address"] ?></td>
                                            </tr>
                                            <tr>
                                                <th>註冊時間：</th>
                                                <td><?= $row["created_at"] ?></td>
                                            </tr>
                                        </table>

                                    </form>
                                </div>
                            </div>
                            <!-- 訂單 -->
                            <div class="col-7">
                                <div class="order-block ">
                                    <h3 class="mb-4">歷史訂單</h3>
                                    <table>
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>訂單號碼</th>
                                                <th>訂單日期</th>
                                                <th>訂單狀態</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            <?php endif; ?>
            </div>
        </div>


        </div>
    </main>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- <script>
        function memberUpdate() {
            var getInfo = document.getElementById("#tdInfo").innerText;
            var inputEl = document.createElement("input");

            //inputEl一開始的值為getInfo得到的值
            inputEl.value = getInfo;

            inputEl.addEventListener("blur", function() {
                var newInfo = inputEl.value;
                document.getElementById("#tdInfo").innerText = newInfo;
            })

            document.getElementById('#tdInfo').replaceWith(inputEl);

            // 自動聚焦到 input 元素，使使用者可以立即編輯
            inputEl.focus();

        } -->

    // console.log(newInfo);
    </script>
</body>

</html>
