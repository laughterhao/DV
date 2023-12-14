<?php
require("..". DIRECTORY_SEPARATOR ."DB_conn.php");

$stmtTotal = $conn->prepare('SELECT * FROM coupon WHERE valid=1');
$stmtTotal->execute();
$totalCouponCount = $stmtTotal->rowCount();

$stmt = $conn->prepare('SELECT * FROM coupon WHERE valid=1');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
  <title>Coupon List</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php
  include("../css/css.php");
  ?>

  <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script defer src="../js/dataTables.js"></script>
  <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script defer src="../js/script.js"></script>

</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-2 main-nav p-0">
        <h1 class="my-4 text-center">DiVING</h1>
        <ul class="main-ul list-unstyle p-0">
              <li class="main-li"><a href="..\"><i class="bi bi-intersect"></i>總覽</a></li>
              <li class="main-li"><a href="..\order\order-list.php"><i class="bi bi-file-text"></i>訂單管理</a></li>
              <li class="main-li"><a href="..\product\product-list.php"><i class="bi bi-bag-fill"></i>商品及分類</a></li>
              <li class="main-li"><a href="..\member\member-list.php"><i class="bi bi-person-circle"></i>顧客管理</a></li>
              <li class="main-li"><a href="..\lesson\lessonList.php"><i class="bi bi-tv"></i>課程管理</a></li>
              <li class="main-li"><a href="..\coach\coach-list.php"><i class="bi bi-person-vcard"></i>教練管理</a></li>
              <li class="main-li"><a href="coupon-list.php"><i class="bi bi-shop-window"></i>行銷</a></li>
              <li class="main-li"><a href="..\notice\notice.php"><i class="bi bi-megaphone"></i>公告</a></li>
          </ul>
      </div>
      <div class="col-10 p-0" style="margin-left:16.66%;">
        <div class="main-top" style="width: auto;">
          <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
        </div>
        <div class="container">
          <div class="py-2">
            <a class="btn" href="add-coupon-ajax.php" title="增加優惠券"><i class="bi bi-person-fill-add"></i></a>
          </div>
          <?php if ($totalCouponCount > 0) : ?>
            <table id="example" class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>優惠券名稱</th>
                  <th>優惠碼</th>
                  <th>可使用人數</th>
                  <th>以使用人數</th>
                  <th>折扣金額</th>
                  <th>可使用時間</th>
                  <th>詳細</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $row) : ?>
                  <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["code"] ?></td>
                    <td><?= $row["max_count"] ?></td>
                    <td><?= $row["used_count"] ?></td>
                    <td>
                      <?php if (isset($row["discount_pa"])) : ?>
                        <?= $row["discount_pa"] ?>折
                      <?php elseif (isset($row["discount_cash"])) : ?>
                        <?= $row["discount_cash"] ?>NTD
                      <?php endif; ?>
                    </td>
                    <td><?= $row["start"] ?> ~ <?= $row["end"] ?></td>
                    <td>
                      <a class="btn" href="coupon.php?id=<?= $row["id"] ?>" title="詳細資料"><i class="bi bi-info-circle-fill"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
        </div>
        <?php if (!isset($_GET["search"])) : ?>
        <?php endif; ?>
      <?php else : ?>
        目前無優惠券
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
