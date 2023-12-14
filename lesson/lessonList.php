<?php
require_once("./db_connect.php");

// 用來計算課程筆數 & 頁面數量
$sqlTotal = "SELECT * FROM lesson WHERE valid=1 OR valid=0";
$resultTotal = $conn->query($sqlTotal);
$totalLesson = $resultTotal->num_rows;
$perPage = 5;
$pageCount = ceil($totalLesson / $perPage);

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT lesson.*, location.name AS location_name FROM lesson
    JOIN location ON lesson.location = location.id
    WHERE (lesson.name LIKE '%$search%' OR lesson.location LIKE '%$search%') AND (valid = 1 OR valid = 0)
    ORDER BY id DESC";
} elseif (isset($_GET["page"])) {
    $page = $_GET["page"];
    $startItem = ($page - 1) * $perPage;
    $sql = "SELECT lesson.*, location.name AS location_name FROM lesson
    JOIN location ON lesson.location = location.id
    WHERE valid=1 OR valid=0 ORDER BY id DESC LIMIT $startItem,$perPage";
} else {
    $page = 1;
    $sql = "SELECT lesson.*, location.name AS location_name FROM lesson
    JOIN location ON lesson.location = location.id
    WHERE valid=1 OR valid=0 ORDER BY id DESC LIMIT 0,$perPage";
}

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <title>課程管理</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- font-awesome v6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/list.css">
</head>

<body>
    <header class="d-flex flex-row-reverse">
        <div class="logo d-flex align-items-center">
            <a href="" class=""><i class="bi bi-box-arrow-in-right me-2"></i>LOG OUT</a>
        </div>
    </header>
    <main>
        <div class="sidebar text-white">
            <h1 class="my-4 text-center">DiVING</h1>
            <ul class="row justify-content-center list-unstyle m-0 p-0 w-100">
                <li class="main-li"><a href=""><i class="bi bi-intersect"></i>總覽</a></li>
                <li class="main-li"><a href=""><i class="bi bi-file-text"></i>訂單管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-bag-fill"></i>商品及分類</a></li>
                <li class="main-li"><a href=""><i class="bi bi-person-circle"></i>顧客管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-tv"></i>課程管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-person-vcard"></i>教練管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-shop-window"></i>行銷</a></li>
                <li class="main-li"><a href=""><i class="bi bi-megaphone"></i>公告</a></li>
            </ul>
        </div>
        <section class="right-content">
            <div class="body">
                <div class="breadcrumb">
                    <a href="lessonList.php" class="text-main-color">課程管理</a>
                </div>
                <div class="list-box">
                    <div class="list-action text-nowrap">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                                <div id="btnGroup">
                                    <a href="add-lesson.php" class="btn"><i class="fa-regular fa-plus"></i> 新增</a>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#alertModal" class="btn d-none bg-danger text-white" id="delete">刪除</button>
                                </div>
                            </div>
                            <!-- search star -->
                            <div class="search-box">
                                <form action="" class="input-group justify-content-end">
                                    <input type="text" class="search" placeholder="搜尋" id="search" name="search">
                                    <button type="submit" class="btn search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                            <!-- search end -->
                        </div>
                    </div>
                    <div class="scroll-x">
                        <form action="editStatus.php" method="post">
                            <table class="table text-nowrap">
                                <thead>
                                    <tr class="text-center">
                                        <th class="selectAll"><input type="checkbox" id="selectAll"></th>
                                        <th class="img">圖片</th>
                                        <th class="name">課程名稱</th>
                                        <th class="price">價格</th>
                                        <th class="status">上架狀態</th>
                                        <th class="status">地區</th>
                                        <th class="created-at">建立日期</th>
                                        <th class="edit-box"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rows as $row) : ?>
                                        <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">警告</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        確定要"刪除"當前所選課程？
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="doDeleteLesson.php?id=<?= $row["id"] ?>" class="btn btn-danger text-white" id="modalBtnY">確認</a>
                                                        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal" id="modalBtnN">取消</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <tr class="text-center">
                                            <td><input type="checkbox" class="checkbox" id="<?= $row["id"] ?>"></td>
                                            <td>
                                                <img src="./images/<?= $row["image"] ?>" alt="" class="object-fit">
                                            </td>
                                            <td><?= $row["name"] ?></td>
                                            <td>$<?= number_format($row["price"]) ?></td>
                                            <td>
                                                <?php
                                                $valid = $row["valid"];
                                                switch ($valid):
                                                    case 0: ?>
                                                        <span class="<?= ($row["valid"] == 0) ? 'inactive' : 'active' ?>">下架</span>
                                                    <?php break;
                                                    case 1: ?>
                                                        <span class="<?= ($row["valid"] == 1) ? 'active' : 'inactive' ?>">上架</span>
                                                <?php break;
                                                endswitch ?>
                                            </td>
                                            <td><?= $row["location_name"] ?></td>
                                            <td><?= $row["created_at"] ?></td>
                                            <td>
                                                <div class="modal fade" id="alertModalY<?= $row["id"] ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">警告</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                確定要執行上架？
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="sale" value="<?= $row["id"] ?>" class="btn">確認</button>
                                                                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal" id="modalBtnN">取消</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="alertModalN<?= $row["id"] ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">警告</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                確定要執行下架？
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="unsale" value="<?= $row["id"] ?>" class="btn">確認</button>
                                                                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal" id="modalBtnN">取消</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#alertModalY<?= $row["id"] ?>" class="btn">上架</button>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#alertModalN<?= $row["id"] ?>" class="btn">下架</button>
                                                    <a href="edit-Lesson.php?id=<?= $row["id"] ?>" class="btn">編輯</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                    </div>
                </div>
                <!-- LIST BOX END -->
                </form>
                <!-- page start -->
                <?php if (!isset($_GET["search"])) : ?>
                    <div class="page d-flex justify-content-center">
                        <ul class="btn-group">
                            <li class="btn page-item">
                                <a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a>
                            </li>
                            <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                <li class="btn page-item <?php if ($page == $i) echo "page-active" ?>">
                                    <a class="page-link" href="lessonList.php?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor ?>
                            <li class="btn page-item">
                                <a class="page-link" href="#">
                                    <i class="fa-solid fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                <?php endif ?>
                <!-- page end -->
            </div>
        </section>
    </main>
    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="./lessonList.js"></script>
</body>

</html>