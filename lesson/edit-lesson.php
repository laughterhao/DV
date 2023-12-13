<?php
$id = $_GET["id"];

require_once("./db_connect.php");

$sql = "SELECT * FROM lesson WHERE id = $id AND valid = 1";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <title>編輯課程</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- font-awesome v6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/addLesson.css">
</head>

<body>
    <!-- modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">警告</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    是否確定要上架？
                </div>
                <div class="modal-footer">
                    <a href="doDeleteUser.php" class="btn btn-danger">確認</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
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
                <div class="breadcrumb"><a href="lessonList.php">課程管理</a> > 編輯</div>
                <form action="doUpdateLesson.php" method="post" enctype="multipart/form-data" id="edit">
                    <div class="list-box scroll-x">
                        <div class="container">
                            <div class="row align-items-center my-3">
                                <?php foreach ($rows as $row) : ?>
                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                    <h3 class="col-12 border-bottom pb-1">課程資訊</h3>
                                    <div class="row align-items-center">
                                        <span for="" class="col-2">課程圖片</span>
                                        <div class="col-4 dropzone">
                                            <div class="row justify-content-center fs-4">
                                                拖放圖片到這裡
                                                <button type="button" class="btn col-4 mt-2">新增圖片</button>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="name" class="col-2">課程名稱</label>
                                    <input type="text" name="name" id="name" class="col-10 d-inline-block" value="<?= $row["name"] ?>" autocomplete="name">
                                    <label class="col-2" for="info">課程簡介</label>
                                    <input type="text" name="info" id="info" class="col-12 d-inline-block ms-2 input-style" value="<?= $row["info"] ?>">
                                    <label for="content" class="col-2">課程內容</label>
                                    <input type="text" name="content" id="content" class="col-12 d-inline-block ms-2 input-style" value="<?= $row["content"] ?>">
                                    <h3 class="col-12 border-bottom pb-1">分類</h3>
                                    <div class="col-6">
                                        <label for="sort" class="col-3 py-1">所屬分類</label>
                                        <select name="sort" id="sort" class="col-6">
                                            <option value="">請選擇</option>
                                            <option value="1">自由潛水</option>
                                            <option value="2">水肺潛水</option>
                                            <option value="3">技術潛水</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="location" class="col-3 py-1">所屬地區</label>
                                        <select name="location" id="location" class="col-6">
                                            <option value="">請選擇</option>
                                            <option value="1">東北角</option>
                                            <option value="2">澎湖</option>
                                            <option value="3">小琉球</option>
                                            <option value="4">墾丁</option>
                                            <option value="5">蘭嶼</option>
                                            <option value="6">綠島</option>
                                        </select>
                                    </div>
                                    <h3 class="col-12 border-bottom pb-1">價格和數量</h3>
                                    <div class="col-6">
                                        <label for="price">原價</label>
                                        <input type="text" name="price" id="price" value="<?= $row["price"] ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="max-person">人數上限</label>
                                        <input type="text" name="max_person" id="max-person" value="<?= $row["max_person"] ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="onSale">特價</label>
                                        <input type="text" name="onSale" id="onSale">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!-- list box end -->
                    <div class="foot">
                        <div class="d-flex flex-row-reverse">
                            <div class="btn-group">
                                <button type="submit" class="btn">儲存</button>
                                <button type="button" class="btn" id="cancel">取消</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
        // connect select element value
        const sortValue = <?= $rows[0]["sort"] ?>;
        const locationValue = <?= $rows[0]["location"] ?>;
        document.getElementById('sort').value = sortValue;
        document.getElementById('location').value = locationValue;

        // cancel function
        document.getElementById('cancel').addEventListener('click', function() {
            location.href = 'http://localhost/DV/lesson/lessonList.php';
        })
    </script>
</body>

</html>