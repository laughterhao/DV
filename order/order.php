<?php
if (!isset($_GET["id"])) {
    header("location: coupon-list.php");
}

$id = $_GET["id"];

require_once("../DB_conn.php");

$stmt = $conn->prepare('SELECT product.price AS price, order_detail.* FROM order_detail JOIN product ON product.id = order_detail.product_id WHERE order_id =:id');
$stmt->execute([':id' => $id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$couponCount = $stmt->rowCount();

$totalPrice=0;

?>

<!doctype html>
<html lang="en">

<head>
    <title>訂單</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    include("../css/css.php");
    ?>

</head>

<body>
    <div class="container-fluid">
        <main class="row">
            <nav class="main-nav col-lg-2 p-0">
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

            <div class="col-10 px-0" style="margin-left: 16.66%;">
                <div class="main-top">
                    <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
                </div>
                <div class="container">
                    <div class="py-2">
                        <a class="btn btn-info text-white" href="order-list.php" title="回訂單列表">
                            <i class="bi bi-arrow-90deg-left"></i>
                        </a>
                    </div>
                    <?php if ($couponCount == 0) : ?>
                        <h1>訂單不存在</h1>
                    <?php else : ?>
                        <table class="table table-bordered">
                            <tr>
                                <th>產品</th>
                                <th>單價</th>
                                <th>數量</th>
                                <th>總價</th>
                            </tr>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td><?=$row["product_id"]?></td>
                                <td><?=$row["price"]?></td>
                                <td><?=$row["number"]?></td>
                                <td><?=$row["price"]*$row["number"]?></td>
                            </tr>
                        <?php $totalPrice += $row["price"]*$row["number"] ?>
                        <?php endforeach; ?>
                        </table>
                        <h1>合計<?=$totalPrice?></h1>
                        <div class="py-2">
                            <a class="btn btn-info text-white" href="edit_order.php?id=<?= $row["id"] ?>" title="修改資料">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </main>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
