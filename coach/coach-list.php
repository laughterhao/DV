<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require(".." . DIRECTORY_SEPARATOR . "mysql-db-conn.php");

$sqlTotal = "SELECT * FROM coach WHERE valid=1";
$resultTotal = $conn->query($sqlTotal); //去抓資料庫
$totalUser = $resultTotal->num_rows; //列出來?
$perPage = 10;
$pageCount = ceil($totalUser / $perPage);


if (isset($_GET["search"])) {
  $search = $_GET["search"];
  $sql = "SELECT * FROM coach WHERE name LIKE '%$search%' AND valid=1";
  // LIKE 這行也要加喔 不然搜尋也會搜尋的到你設成0的
  // 加上value等於1的時候才顯示的條件↑

} elseif (isset($_GET["page"]) && isset($_GET["order"])) {
  // ↑同時要有這兩個才跑
  $page = $_GET["page"];
  $order = $_GET["order"];
  switch ($order) {
    case 1:
      $orderSql = "id ASC";
      break;
    case 2:
      $orderSql = "id DESC";
      break;
      // 利用sql語法來改變判斷式
    case 3:
      $orderSql = "experience ASC";
      break;
    case 4:
      $orderSql = "experience DESC";
      break;
    default:
      $orderSql = "id ASC";
      // 怕有人打網址進來所以寫一下
  }

  $startItem = ($page - 1) * $perPage; // 開始的頁面=目前頁碼-1 乘以我要略過的筆數

  $sql = "SELECT * FROM coach WHERE valid=1 ORDER BY $orderSql LIMIT $startItem,$perPage ";
} else {
  $page = 1; //因為第一頁沒有頁數?所以不會跑active 給他預設一下
  $order = 1;
  $sql = "SELECT * FROM coach WHERE valid=1 ORDER BY id ASC LIMIT 0,$perPage ";

  /*LIMIT 限制筆數 列出幾筆
SELECT * FROM coach LIMIT 4, 4
這樣我們可以拿到第5~8 筆，前面一個數字為開始的index，第二個參數為抓取筆數 (做分頁時用的)*/
}
// 再加一個elseif=> 如果我有GET的話做什麼事情  然後最後再做else

$result = $conn->query($sql);

?>

<!doctype html>
<html lang="en">

<head>
  <title>Coach List</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php
  include("css-coach.php");
  ?>
</head>

<body>
  <!-- 新增教練Modal -->
  <div class="modal fade modal-xl" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">新增教練</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row p-4" action="doAddCoach.php" method="post" enctype="multipart/form-data">

            <div class="col-4">
              <img class="ratio ratio-1x1 bg-transparent mb-4 img-thumbnail rounded-circle my-3 img-fluid object-fit-cover" id="output" style="height: 300px;" />

              <input class="form-control " type="file" accept="image/*" onchange="loadFile(event)" id="imgfile" name="imgfile">

              <label for="" class="mt-3">專長</label>
              <input class="form-control " type="text" placeholder="專長" aria-label="skill" id="skill" name="skill" required>

              <label for="" class="mt-3">地區</label>
              <input class="form-control" type="text" placeholder="地區" id="city" name="city" required>

            </div>
            <div class="col-8">
              <div class="row g-3">
                <div class="col-6">
                  <label for="">姓名</label>
                  <input type="text" class="form-control" placeholder="請輸入姓名" id="name" name="name" required>
                </div>
                <div class="col-6">
                  <label for="" class="mb-2">性別</label><br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="1">
                    <label class="form-check-label" for="male">男</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="2">
                    <!-- 兩個input設定同一個name才能做單選；設定value才能帶到後端去 -->
                    <label class="form-check-label" for="female">女</label>
                    <!-- 性別資料 存到資料庫時通常會用1或2 不會用單字 -->
                  </div>
                </div>

                <div class="col-6">
                  <label for="date">生日</label>
                  <input placeholder="請選擇日期" class="form-control" value="1990-01-01" max="" type="date" id="birth" name="birth">

                </div>

                <div class="col-6 ">
                  <label for="email" class="">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
                </div>


                <div class="col-6 ">
                  <label for="phone" class="">電話號碼</label>
                  <input type="tel" class="form-control" name="phone">
                </div>

                <div class="col-4 ">
                  <label for="number" class="">教學年資</label>
                  <div class="input-group">
                    <input type="number" class="form-control" placeholder="請輸入數字" id="experience" name="experience">
                    <label class="input-group-text" for="inputGroupSelect02">年</label>
                  </div>

                </div>

                <div class="mb-3">
                  <label for="info" class="form-label">教練介紹</label>
                  <textarea class="form-control" id="info" name="info" rows="5" placeholder="介紹一下自己吧！"></textarea>
                </div>

              </div>

              <div class="license ">
                <label for="" class="me-3">證照</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="license" value="1" name="license[]">
                  <label class="form-check-label" for="license1">PADI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="license" value="2" name="license[]">
                  <label class="form-check-label" for="license2">NAUI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="license" value="3" name="license[]">
                  <label class="form-check-label" for="license3">SSI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="license" value="4" name="license[]">
                  <label class="form-check-label" for="license4">CMAS</label>
                </div>
              </div>

              <div class="modal-footer d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-danger text-white" href="coach-list.php">取消</a>
                <button class="btn" type="submit">新增</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="container-fluid">
    <main class="row">
      <nav class="main-nav col-2 p-0">
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

        <div class="container p-5">

          <div class="d-grid gap-2 d-flex justify-content-between">
            <h3>教練管理</h3>
            <div>
              <a class="btn my-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">新增教練</a>
              <!-- href="add-coach.php" -->
              <a class="btn my-3" href="coach-hide-list.php">已隱藏教練</a>
            </div>
          </div>


          <?php
          $userCount = $result->num_rows;
          ?>
          <div class="d-grid gap-2 d-flex justify-content-end align-items-center text-nowrap mb-3">
            <div>
              <?php
              if (isset($_GET["search"])) : ?>
                <a class="btn" href="coach-list.php" title="回教練列表"><i class="bi bi-arrow-left"></i></a>
                搜尋<?= $_GET["search"] ?> 的結果,
              <?php endif;
              ?> 共 <?= $userCount ?> 人
              <!-- 第 < ?= $pageCount ?>頁的結果, -->
            </div>

            <div class="py-2">
              <form action="">
                <div class=" input-group">

                  <input type="text" class="form-control" placeholder="Search.." name="search">

                  <button class="btn" type="submit"><i class="bi bi-search" name="search"></i></button>
                </div>
              </form>
            </div>


            <?php if (!isset($_GET["search"])) : ?>
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  排序依據
                </button>
                <ul class="dropdown-menu">
                  <li><a id="btn" class="dropdown-item <?php if ($order == 1) echo "active" ?> " href="coach-list.php?page=<?= $page ?>&order=1">ID-小到大</a></li>
                  <li><a class="dropdown-item <?php if ($order == 2) echo "active" ?> " href="coach-list.php?page=<?= $page ?>&order=2">ID-大到小</a></li>
                  <li><a class="dropdown-item <?php if ($order == 3) echo "active" ?> " href="coach-list.php?page=<?= $page ?>&order=3">教學年資-小到大</a></li>
                  <li><a class="dropdown-item dropdown-item <?php if ($order == 4) echo "active" ?> " href="coach-list.php?page=<?= $page ?>&order=4">教學年資-大到小</a></li>
                </ul>
              </div>
            <?php endif; ?>
          </div>

          <div>
            <?php
            $rows = $result->fetch_all(MYSQLI_ASSOC);  //括號可以帶參數 MYQSLI_NUM=索引式陣列/ MYQSLI_BOTH=同時有關聯式又有索引式陣列
            // var_dump($rows);
            // 直接把整個關聯式陣列撈出來 不是一筆一筆撈
            ?>
          </div>
          <?php if ($userCount > 0) : ?>
            <table class="table table-light table-hover mt-2">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">教練姓名</th>
                  <th scope="col">性別</th>
                  <th scope="col">電話號碼</th>
                  <th scope="col">Email</th>
                  <th scope="col">專長</th>
                  <th scope="col">教學年資</th>
                  <th scope="col">地區</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $row) : ?>
                  <tr>
                    <th scope="row"><?= $row["id"] ?></th>
                    <td><?= $row["name"] ?></td>

                    <?php $genderText = ($row["gender"] == 1) ? '男' : '女';
                    ?>
                    <td><?= $genderText; ?></td>

                    <td><?= $row["phone"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["skill"] ?></td>
                    <td><?= $row["experience"] ?></td>
                    <td><?= $row["city"] ?></td>
                    <td><a href="coach.php?id=<?= $row["id"] ?>"><i class="bi bi-info-circle" title="詳細資料"></i></a><a href="coach-edit.php?id=<?= $row["id"] ?>"><i class="bi bi-pencil-square text-info ms-4" title="編輯"></i></a><a href="doHideCoach.php?id=<?= $row["id"] ?>"><i class="bi bi-ban ms-4" title="隱藏"></i></a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php if (!isset($_GET["search"])) :
            ?>
              <div class="py-2">
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                      <li class="page-item <?php if ($page == $i) echo "active"; ?> ">
                        <a class="btn page-link" href="coach-list.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                      </li>
                    <?php endfor; ?>
                  </ul>
                </nav>
              </div>
            <?php endif; ?>
          <?php else : ?>
            目前無此教練
          <?php endif; ?>
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