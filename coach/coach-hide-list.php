<?php
require("..\mysql-db-conn.php");

$sqlTotal = "SELECT * FROM coach WHERE valid=2";
$resultTotal = $conn->query($sqlTotal); //去抓資料庫
$totalUser = $resultTotal->num_rows; //列出來?
$perPage = 5;
$pageCount = ceil($totalUser / $perPage);


if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM coach WHERE name LIKE '%$search%' AND valid=2";
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

    $sql = "SELECT * FROM coach WHERE valid=2 ORDER BY $orderSql LIMIT $startItem,$perPage ";
} else {
    $page = 1; //因為第一頁沒有頁數?所以不會跑active 給他預設一下
    $order = 1;
    $sql = "SELECT * FROM coach WHERE valid=2 ORDER BY id ASC LIMIT 0,$perPage ";

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
                    <li class="main-li"><a href="..\coupon-list.php"><i class="bi bi-shop-window"></i>行銷</a></li>
                    <li class="main-li"><a href="..\notice\notice.php"><i class="bi bi-megaphone"></i>公告</a></li>
                </ul>
            </nav>

            <div class="col-10 px-0" style="margin-left: 16.66%;">
                <div class="main-top">
                    <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
                </div>

                <div class="container p-5">

                    <a class="btn mb-3" href="coach-list.php" title="回教練列表"><i class="bi bi-arrow-left"></i></a>
                    <?php
                    $userCount = $result->num_rows;
                    ?>
                    <h3>已隱藏教練</h3>
                    <div class="d-grid gap-2 d-flex justify-content-end align-items-center text-nowrap mb-3">
                        <div class="d-grid d-flex gap-3 align-items-center">
                            <div>
                                <?php
                                if (isset($_GET["search"])) : ?>
                                    <a class="btn" href="coach-list.php" title="回已隱藏教練列表"><i class="bi bi-arrow-left"></i></a>
                                    搜尋<?= $_GET["search"] ?> 的結果,
                                    <?php endif;
                                    ?>共 <?= $userCount ?> 人
                            </div>

                            <div class="py-2">
                                <form action="">
                                    <div class=" input-group">
                                        <input type="text" class="form-control" placeholder="Search.." name="search">

                                        <button class="btn" type="submit"><i class="bi bi-search" name="search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

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
                                        <td><?= $row["gender"] ?></td>
                                        <td><?= $row["phone"] ?></td>
                                        <td><?= $row["email"] ?></td>
                                        <td><?= $row["skill"] ?></td>
                                        <td><?= $row["experience"] ?></td>
                                        <td><?= $row["city"] ?></td>
                                        <td><a href="coach.php?id=<?= $row["id"] ?>"><i class="bi bi-info-circle" title="詳細資料"></i></a><a href="coach-edit.php?id=<?= $row["id"] ?>"><i class="bi bi-pencil-square text-info ms-4" title="編輯"></i></a><a href="doApperCoach.php?id=<?= $row["id"] ?>"><i class="bi bi-person-fill-up ms-4" title="顯示"></i></a></td>
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
                                            </li>
                                            <a class="page-link" href="coach-list.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </nav>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        在隱藏的教練找不到唷
                    <?php endif; ?>
                </div>

            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
