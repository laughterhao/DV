<?php
require_once("../DB_conn.php");


$id=$_GET["id"];
$stmt = $conn->prepare('SELECT product.price AS price,product.name AS name, order_detail.* FROM order_detail JOIN product ON product.id = order_detail.product_id WHERE order_id =:id');
$stmt->execute([':id' => $id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmtData = $conn->prepare('SELECT order_data.*, member.name AS name FROM order_data JOIN member ON order_data.member_id = member.id WHERE order_data.id =:id');
$stmtData->execute([':id' => $id]);
$rowData = $stmtData->fetch();

$totalPrice=0;
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
    <link rel="stylesheet" href="../css/backe-template.css">
    <link rel="stylesheet" href="order-info.css?time=<?=time()?>">
</head>

<body>
    <main>
        <div class="row mx-0">
            <nav class="main-nav col-2 p-0">
                <h1 class="my-4 text-center">DiVING</h1>
                <ul class="main-ul list-unstyle p-0">
                    <li class="main-li"><a href="..\"><i class="bi bi-intersect"></i>總覽</a></li>
                    <li class="main-li"><a href="order-list.php"><i class="bi bi-file-text"></i>訂單管理</a></li>
                    <li class="main-li"><a href="..\product\product-list.php"><i class="bi bi-bag-fill"></i>商品及分類</a></li>
                    <li class="main-li"><a href="..\member\member-list.php"><i class="bi bi-person-circle"></i>顧客管理</a></li>
                    <li class="main-li"><a href="..\lesson\lessonList.php"><i class="bi bi-tv"></i>課程管理</a></li>
                    <li class="main-li"><a href="..\coach\coach-list.php"><i class="bi bi-person-vcard"></i>教練管理</a></li>
                    <li class="main-li"><a href="..\coupon-pdo-version\coupon-list.php"><i class="bi bi-shop-window"></i>行銷</a></li>
                    <li class="main-li"><a href="..\notice\notice.php"><i class="bi bi-megaphone"></i>公告</a></li>
                </ul>
            </nav>

            <div class="px-0">
                <div class="main-top">
                    <a href="" class="logout"><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
                </div>

                <!-- 會員資訊 -->
                <div class="container-fluid m-0 p-0">
                    <div class="diving-block row align-items-start">
                        <div class="col">
                            <!-- 訂單資訊 -->
                            <div class="block-style order-block">
                                <form action="member-edit.php" method="post">
                                    <!-- <a class="back-btn" href="member-list.php"><i class="bi bi-arrow-bar-left"></i>回到使用者列表</a> -->
                                    <div class="d-flex justify-content-between my-2 ">
                                        <h3>訂單資料</h3>
                                        <div class="d-flex align-items-center">
                                            <!-- <select class="form-select form-select-sm me-2" aria-label="Default select example">
                                                <option id="stutasId" selected>--更改訂單狀態--</option>
                                                <option value="1">備貨中</option>
                                                <option value="2">已出貨</option>
                                                <option value="3">已完成</option>
                                                <option value="4">已取消</option>
                                            </select> -->
                                            <!-- <a class="btn btn-sm text-nowrap" href="member-edit.php?id=<?= $row["id"] ?>">編輯</a> -->
                                        </div>
                                    </div>
                                    <hr>
                                    <table class="text-nowrap">
                                        <tr>
                                            <th>訂單編號：</th>
                                            <td><?=$rowData["id"]?></td>
                                        </tr>
                                        <tr>
                                            <th>訂單日期：</th>
                                            <td><?=$rowData["created_at"]?></td>
                                        </tr>
                                        <tr>
                                            <th>訂單狀態：</th>
                                            <td> <button class="stutas-btn btn btn-sm"><?=$rowData["order_status"]?></button></td>
                                        </tr>
                                        <tr>
                                            <th>付款狀態：</th>
                                            <td><?=$rowData["payment"]?></td>
                                        </tr>

                                    </table>
                                </form>
                            </div>
                            <!-- 訂購人資訊 -->
                            <div class="member-block block-style">
                                <form action="member-edit.php" method="post">
                                    <div class="d-flex justify-content-between my-2 ">
                                        <h3>訂購人資訊</h3>
                                        <div>
                                            <!-- <a class="btn btn-sm" href="member-edit.php?id=<?= $row["id"] ?>">編輯</a> -->
                                        </div>
                                    </div>

                                    <table class="text-nowrap">
                                        <tr>
                                            <th>姓名：</th>
                                            <td><?=$rowData["name"]?></td>
                                        </tr>
                                        <tr>
                                            <th>信箱：</th>
                                            <td><?=$row["email"]?></td>
                                        </tr>
                                        <tr>
                                            <th>電話：</th>
                                            <td><?=$row["phone"]?></td>
                                        </tr>
                                        <tr>
                                            <th>送貨地址：</th>
                                            <td><?=$row["city"].$row["address"]?></td>
                                        </tr>

                                    </table>
                                </form>
                            </div>

                        </div>

                        <!-- 商品詳情 -->
                        <div class="block-style product-block col">
                            <div class="d-flex justify-content-between my-2 ">
                                <h3>商品詳情</h3>
                                <div>
                                    <!-- <a class="btn btn-sm" href="member-edit.php?id=<?= $row["id"] ?>">編輯</a> -->
                                </div>
                            </div>
                            <hr>
                            <div>
                                <?php foreach ($rows as $row) : ?>
                                <div class="d-flex align-items-center">
                                    <figure class="figure me-3 mb-0">
                                        <img class="figure-img img-fluid m-0" src="4.png" alt="">
                                    </figure>
                                    <div>
                                        <h5><?=$row["name"]?></h5>
                                        <div><?=$row["number"]?>份x<?=$row["price"]?>單價＝<?=$row["price"]*$row["number"]?></div>
                                        <?php $totalPrice += $row["price"]*$row["number"]?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <hr>
                            <div style="text-align: right;">
                                合計 <?=$totalPrice?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </main>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    </script>
</body>

</html>
