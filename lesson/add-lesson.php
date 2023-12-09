<?php
require_once("./db_connect.php");

$sql = "SELECT * FROM lesson";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <title>課程編輯</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- font-awesome v6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../lesson/css/addLesson.css">
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
                    <a href="doDeleteUser.php?id=<?= $row["id"] ?>" class="btn btn-danger">確認</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <header></header>
    <main>
        <div class="sidebar"></div>
        <section class="right-content">
            <div class="body">
                <div class="breadcrumb">課程管理 > 編輯</div>
                <form action="" method="post">
                    <div class="list-box scroll-x">
                        <div class="container">
                            <div class="row align-items-center mb-3">
                                <h3 class="col-12 border-bottom pb-1">課程資訊</h3>
                                <div class="row align-items-center">
                                    <h4 class="col-2">課程圖片</h4>
                                    <div class="col-6">
                                        <img src="./images/01.jpg" alt="" class="object-fit">
                                    </div>
                                </div>
                                <div class="row">
                                    <h4 class="col-2">課程名稱</h4>
                                    <input type="text" class="col d-inline-block ms-2">
                                </div>
                                <div class="row">
                                    <h4 class="col-2">課程簡介</h4>
                                    <input type="text" class="col-12 d-inline-block ms-2 input-height">
                                </div>
                                <div class="row">
                                    <h4 class="col-2">課程內容</h4>
                                    <input type="text" class="col-12 d-inline-block ms-2 input-height">
                                </div>
                                <h3 class="col-12 border-bottom pb-1">分類</h3>
                                <h3 class="col-12 border-bottom pb-1">價格和數量</h3>
                            </div>
                        </div>
                    </div>
                    <!-- LIST BOX END -->
                </form>
                <div class="foot">
                    <div class="d-flex flex-row-reverse">
                        <div class="btn-group">
                            <button class="btn">儲存</button>
                            <button class="btn">取消</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            var checkboxes = document.getElementsByClassName('checkbox');
            // console.log(checkboxes);
            for (i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = this.checked;
            }
        });
    </script>
</body>

</html>