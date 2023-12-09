<?php
require_once("db-connect.php");

//Get => 利用網址上面的變數去抓不同的內容
$id = $_GET["id"];
$sql = "SELECT * FROM member WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc(); //只要抓一筆資料

// var_dump($rows);

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
    <main class="row">
        <nav class="main-nav col-2 p-0">
            <h1 class="my-4 text-center">DiVING</h1>
            <ul class="main-ul list-unstyle p-0">
                <li class="main-li"><a href=""><i class="bi bi-intersect"></i>總覽</a></li>
                <li class="main-li"><a href=""><i class="bi bi-file-text"></i>訂單管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-bag-fill"></i>商品及分類</a></li>
                <li class="main-li"><a href=""><i class="bi bi-person-circle"></i>顧客管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-tv"></i>課程管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-person-vcard"></i>教練管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-shop-window"></i>行銷</a></li>
                <li class="main-li"><a href=""><i class="bi bi-megaphone"></i>公告</a></li>
            </ul>
        </nav>

        <div class="px-0">
            <div class="main-top">
                <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
            </div>
            <!-- 會員資訊 -->
            <div class="diving-block row">
                <div class="memberinfo-block col ">
                    <form action="member-edit.php" method="post">
                        <div class="d-flex justify-content-between mb-4 ">
                            <h3>會員資訊</h3>
                            <div>
                                <a class="btn btn-sm" href="">列入黑名單</a>
                                <a class="btn btn-sm" href="">編輯</a>
                            </div>
                        </div>

                        <table>
                            <tr>
                                <th>會員編號：</th>
                                <td><?= $row["id"] ?></td>
                            </tr>
                            <tr>
                                <th>姓名：</th>
                                <td><?= $row["name"] ?></td>
                            </tr>
                            <tr>
                                <th>性別：</th>
                                <td><?= $row["gender"] ?></td>
                            </tr>
                            <tr>
                                <th>生日：</th>
                                <td><?= $row["birth"] ?></td>
                            </tr>
                            <tr>
                                <th>信箱：</th>
                                <td><?= $row["email"] ?></td>
                            </tr>
                            <tr>
                                <th>電話：</th>
                                <td><?= $row["phone"] ?></td>
                            </tr>
                            <tr>
                                <th>地址：</th>
                                <td><?= $row["city"] ?></td>
                            </tr>
                            <tr>
                                <th>註冊時間：</th>
                                <td><?= $row["created_at"] ?></td>
                            </tr>
                        </table>

                    </form>
                </div>
                <!-- 訂單 -->
                <div class="order-block col">
                    <h3 class="mb-4">歷史訂單</h3>
                    <table>
                    <thead>
                            <tr class="text-nowrap">
                                <th>會員編號</th>
                                <th>姓名</th>
                                <th>性別</th>
                                <th>生日</th>
                                <th>信箱</th>
                                <th>電話</th>
                                <th>地址</th>
                                <th>註冊時間</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>


        </div>
    </main>


    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>