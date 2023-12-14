<?php
// require_once("./db_connect.php");
require("..". DIRECTORY_SEPARATOR ."mysql-db-conn.php");

$sql = "SELECT * FROM lesson";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <title>新增課程</title>
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
    <header class="d-flex flex-row-reverse">
        <div class="logo d-flex align-items-center">
            <a href="" class=""><i class="bi bi-box-arrow-in-right me-2"></i>LOG OUT</a>
        </div>
    </header>
    <main>
        <div class="sidebar text-white">
            <h1 class="my-4 text-center">DiVING</h1>
            <ul class="row justify-content-center list-unstyle m-0 p-0 w-100">
            <li class="main-li"><a href="#"><i class="bi bi-intersect"></i>總覽</a></li>
                <li class="main-li"><a href="..\order\order-list.php"><i class="bi bi-file-text"></i>訂單管理</a></li>
                <li class="main-li"><a href="..\product\product-list.php"><i class="bi bi-bag-fill"></i>商品及分類</a></li>
                <li class="main-li"><a href="..\member\member-list.php"><i class="bi bi-person-circle"></i>顧客管理</a></li>
                <li class="main-li"><a href="lessonList.php"><i class="bi bi-tv"></i>課程管理</a></li>
                <li class="main-li"><a href="..\coach\coach-list.php"><i class="bi bi-person-vcard"></i>教練管理</a></li>
                <li class="main-li"><a href="..\coupon-pdo-version\coupon-list.php"><i class="bi bi-shop-window"></i>行銷</a></li>
                <li class="main-li"><a href=".\notice\notice.php"><i class="bi bi-megaphone"></i>公告</a></li>
            </ul>
        </div>
        <section class="right-content">
            <div class="body">
                <form action="doAddLesson.php" method="post" enctype="multipart/form-data">
                    <div class="breadcrumb"><a href="lessonList.php">課程管理</a> > 編輯</div>
                    <div class="list-box scroll-x">
                        <div class="container">
                            <div class="row align-items-center my-3">
                                <h3 class="col-12 border-bottom pb-1">課程資訊</h3>
                                <div class="row align-items-center my-3">
                                    <label for="image" class="col-2">課程圖片</label>
                                    <div class="col-4">
                                        <div class="ratio ratio-1x1">
                                            <img class="img-fluid" id="previewImage"  alt="">
                                        </div>
                                        <input type="file" class="mt-2 form-control" id="file" name="file" onchange="previewFile()"></input>
                                    </div>
                                </div>
                                <div class="row align-items-center my-3 pe-0">
                                    <label for="name" class="col-2">課程名稱</label>
                                    <input type="text" name="name" id="name" class="col-10 d-inline-block">
                                </div>
                                <div class="row align-items-center my-3 pe-0">
                                    <label class="col-2" for="info">課程簡介</label>
                                    <textarea rows="4" name="info" id="info" class="col-10 d-inline-block"></textarea>
                                </div>
                                <div class="row align-items-center my-3 pe-0">
                                    <label for="" class="col-2">課程內容</label>
                                    <textarea rows="8" name="content" id="content" class="col-10 d-inline-block"></textarea>
                                </div>
                                <h3 class="col-12 border-bottom my-3">課程分類</h3>
                                <div class="col-6 my-3">
                                    <label for="sort" class="col-2 py-1">所屬分類</label>
                                    <select name="sort" id="sort" class="col-3">
                                        <option value="0">請選擇</option>
                                        <option value="1">自由潛水</option>
                                        <option value="2">水肺潛水</option>
                                        <option value="3">技術潛水</option>
                                    </select>
                                </div>
                                <div class="col-6 my-3">
                                    <label for="location" class="col-2 py-1">所屬地區</label>
                                    <select name="location" id="location" class="col-3">
                                        <option value="0">請選擇</option>
                                        <option value="1">東北角</option>
                                        <option value="2">澎湖</option>
                                        <option value="3">小琉球</option>
                                        <option value="4">墾丁</option>
                                        <option value="5">蘭嶼</option>
                                        <option value="6">綠島</option>
                                    </select>
                                </div>
                                <h3 class="col-12 border-bottom my-3">價格和數量</h3>
                                <div class="col-6 my-3">
                                    <label for="price" class="col-2">原價</label>
                                    <input type="text" name="price" class="col-3" id="price">
                                </div>
                                <div class="col-6 my-3">
                                    <label for="max-person" class="col-2">人數上限</label>
                                    <input type="text" name="max-person" class="col-3" id="max-person">
                                </div>
                                <div class="col-6 my-3">
                                    <label for="" class="col-2">特價</label>
                                    <input type="text" class="col-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- list box end -->
                    <div class="foot">
                        <div class="d-flex flex-row-reverse">
                            <!-- modal -->
                            <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">通知</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            新增成功！
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn">確認</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal end -->
                            <div class="btn-group">
                                
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#alertModal">新增</button>
                                
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
        // cancel function
        document.getElementById('cancel').addEventListener('click', function() {
            location.href = 'http://localhost/DV/lesson/lessonList.php'
        })

        function previewFile() {
            const preview = document.getElementById('previewImage');
            const fileInput = document.getElementById('file');
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = ''; // 清空预览
            }
        }
    </script>
</body>

</html>