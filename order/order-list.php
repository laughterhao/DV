<?php
require_once("../DB_conn.php");

$stmtTotal = $conn->prepare('SELECT * FROM order_data');
$stmtTotal->execute();
$totalCouponCount = $stmtTotal->rowCount();

$stmt = $conn->prepare('SELECT order_data.*, member.name AS name FROM order_data JOIN member ON member.id = order_data.member_id');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
  <title>order List</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php
  include("../css/css.php");
  ?>

  <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <!-- <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> -->
  <script defer src="../js/dataTables.js"></script>
  <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script defer src="../js/script.js"></script>

  <link rel="stylesheet" href="../css/backe-template.css">

</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-2 main-nav p-0">
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
      </div>
      <div class="col-10 p-0" style="margin-left:16.66%;">
        <div class="main-top" style="width: auto;">
          <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
        </div>
        <div class="container">
          <?php if ($totalCouponCount > 0) : ?>
            <table id="example" class="table table-bordered">
              <thead>
                <tr>
                  <th>訂單編號</th>
                  <th>訂購客戶</th>
                  <th>訂單時間</th>
                  <th>訂單狀態</th>
                  <th>付款狀態</th>
                  <th>總價</th>
                  <th>詳細</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $row) : ?>
                  <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["created_at"] ?></td>
                    <td><?= $row["order_status"] ?></td>
                    <td><?= $row["payment"] ?></td>
                    <td><?= $row["total_price"] ?></td>
                    <td>
                      <a class="btn btn-info text-white" href="order.php?id=<?= $row["id"] ?>" title="詳細資料"><i class="bi bi-info-circle-fill"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
        </div>
        <?php if (!isset($_GET["search"])) : ?>
        <?php endif; ?>
      <?php else : ?>
        目前無訂單
      <?php endif; ?>
      </div>
    </div>

  </div>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

</body>

</html>
