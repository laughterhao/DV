<?php
require_once("db-connect.php");
session_start();
//得出資料總筆數
$sqlTotal = "SELECT * FROM member WHERE valid=1"; //得出所有資料
$resultTotal = $conn->query($sqlTotal);
$totalMember = $resultTotal->num_rows; //算出所有會員筆數


$page = 1; //先設一個頁數=1
$perPage = 10; //每頁有13筆項目
//總頁數＝全部筆數/每頁項目 //ceil無條件進位，算出總頁數
$pageCount = ceil($totalMember / $perPage);
$resultPerPage = $resultTotal->num_rows;

if (isset($_GET["search"])) {

    $search = $_GET["search"];
    $_SESSION["search"] = $search; //儲存search讓下面抓得到

    if (isset($_GET["page"])) {

        $page = $_GET["page"];

        $startItem = ($page - 1) * $perPage;
        // var_dump($startItem);
        $sql = "SELECT * FROM member WHERE (name LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%' OR gender LIKE '%$search%' OR birth LIKE '%$search%') AND valid=1  LIMIT $startItem, $perPage";
    } else {
        $sql = "SELECT * FROM member WHERE (name LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%' OR gender LIKE '%$search%' OR birth LIKE '%$search%') AND valid=1  LIMIT $perPage";
    }

    //另外抓收尋的總數，算出總頁數
    $searchTotal = "SELECT * FROM member WHERE name LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%' OR gender LIKE '%$search%' OR birth LIKE '%$search%' AND valid=1";
    $resultTotal = $conn->query($searchTotal);
    $totalMember  = $resultTotal->num_rows;
    $pageCount = ceil($totalMember  / $perPage);
} elseif (isset($_GET["page"]) && isset($_GET["order"])) {
    $page = $_GET["page"];
    $order = $_GET["order"];
    switch ($order) {
        case 1:
            $orderSql = "ASC";
            break;
        case 2:
            $orderSql = "DESC";
            break;
    }
    // 每頁開始的項目＝當前的頁碼-1 * 每頁項目
    $startItem = ($page - 1) * $perPage;
    $sql = "SELECT * FROM member WHERE valid=1 ORDER BY id $orderSql LIMIT $startItem,$perPage";
} else {
    unset($_SESSION["search"]);
    $sql = "SELECT * FROM member WHERE valid=1 ORDER BY id LIMIT 0,$perPage";
}

$result = $conn->query($sql); //把上面$sql連接資料庫
$rows = $result->fetch_all(MYSQLI_ASSOC); //把搜尋結果陣列出來




?>

<!doctype html>
<html lang="en">

<head>
    <title>Member List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="backe-template.css">
    <link rel="stylesheet" href="member-list.css">


</head>

<body>
    <main>
        <div class="row mx-0">
            <nav class="main-nav p-0">
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
                <!-- 會員列表 -->
                <div class="m-0">
                    <div class="member-block pb-3 mb-5">
                        <h3>會員列表</h3>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- 算出每頁得到人數相加後的總人數 -->
                            <?php $rowMembers = $perPage * ($totalMember  / $perPage) ?>
                            <div class="">
                                <?php if (isset($_GET["search"])) : ?>
                                    <a href="member-list.php">回使用者列表</a>
                                <?php endif; ?>
                                共<?= $rowMembers ?>人
                            </div>

                            <div class="filter-block row mt-3 ">
                                <div class="col-md-5">
                                    <!-- <select class="form-select">
                                        <option selected>增加篩選條件</option>
                                        <option value="1">性別</option>
                                        <option value="2">註冊時間</option>
                                        <option value="3">生日</option>
                                    </select> -->
                                </div>
                                <form action="" class="col-md">
                                    <div class="input-group mb-3 ">
                                        <!-- 收尋使用form，在本頁action=""，送出之後會在本頁執行 -->
                                        <input type="text" class="form-control" name="search">
                                        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="member-table table text-center mt-4">
                            <thead>
                                <tr class="text-nowrap">
                                    <th style="width: 80px;" class="d-flex justify-content-center">
                                        <div>
                                            <p class="m-0">編號 </p>
                                        </div>
                                        <div class="order-btn">
                                                <a href="member-list.php?page=<?= $page ?>&order=1"><i class="bi bi-caret-down-fill"></i></a>
                                                <a href="member-list.php?page=<?= $page ?>&order=2"><i class="bi bi-caret-up-fill"></i></a>
                                        </div>
                                    </th>
                                    <th>姓名</th>
                                    <th>性別</th>
                                    <th>生日 </th>
                                    <th>信箱</th>
                                    <th>電話</th>
                                    <th>地址</th>
                                    <th>註冊時間</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($rows as $row) : ?>

                                    <tr>
                                        <td><?= $row["id"] ?></td>
                                        <td><?= $row["name"] ?></td>
                                        <td><?= $row["gender"] ?></td>
                                        <td><?= $row["birth"] ?></td>
                                        <td><?= $row["email"] ?></td>
                                        <td><?= $row["phone"] ?></td>
                                        <td><?= $row["city"] ?></td>
                                        <td><?= $row["created_at"] ?></td>
                                        <td>
                                            <a class="btn btn-sm" href="member-info.php?id=<?= $row["id"] ?>">查閱</a>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>
                        <!-- 分頁 -->
                        <nav class="mt-4">
                            <ul class="pagination justify-content-center ">

                                <!-- 上一頁 -->

                                <?php if ($page > 1) : ?>
                                    <li class="page-item">
                                        <?php if (isset($_GET["search"])) : ?>
                                            <a class="page-link" href="member-list.php?page=<?= $page  - 1 ?>&search=<?= $search ?>">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        <?php else : ?>
                                            <a class="page-link" href="member-list.php?page=<?= $page  - 1 ?>">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>

                                <!-- 頁數 -->
                                <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                    <?php if (isset($_SESSION["search"])) : ?>
                                        <li class="page-item"><a class="page-link" href="member-list.php?page=<?= $i ?>&search=<?= $_SESSION["search"] ?>"><?= $i ?></a></li>
                                    <?php else : ?>
                                        <li class="page-item"><a class="page-link" href="member-list.php?page=<?= $i ?>"><?= $i ?></a></li>
                                    <?php endif; ?>
                                <?php endfor; ?>

                                <!-- 下一頁 -->
                                <?php if ($page < $pageCount) : ?>
                                    <li class="page-item">
                                        <?php if (isset($_GET["search"])) : ?>
                                            <a class="page-link" href="member-list.php?page=<?= $page + 1 ?>&search=<?= $search ?>"> <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        <?php else : ?>
                                            <a class="page-link" href="member-list.php?page=<?= $page + 1 ?>"> <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        <?php endif; ?>

                                    </li>
                                <?php endif; ?>

                            </ul>
                        </nav>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>


</body>

</html>