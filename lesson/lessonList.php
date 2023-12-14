<?php
require_once("../mysql-db-conn.php");

$sql = "SELECT * FROM lesson";
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
    <link rel="stylesheet" href="../lesson/css/list.css">
</head>

<body>
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
    <header></header>
    <main>
        <div class="sidebar"></div>
        <section class="right-content">
            <div class="body">
                <div class="breadcrumb">課程管理</div>
                <form action="editStatus.php" method="post">
                    <div class="list-box">
                        <div class="list-action text-nowrap">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="newLesson.php" class="btn">新增</a>
                                    <button class="btn">刪除</button>
                                </div>
                                <div class="search-box">
                                    <span></span>
                                    <input type="text" class="search" placeholder="搜尋">
                                </div>
                            </div>
                        </div>
                        <div class="scroll-x">
                            <table class="table text-nowrap">
                                <thead>
                                    <tr class="text-center">
                                        <th class="selectAll"><input type="checkbox" id="selectAll"></th>
                                        <th class="img">圖片</th>
                                        <th class="name">課程名稱</th>
                                        <th class="price">價格</th>
                                        <th class="status">上架狀態</th>
                                        <th class="created-at">建立日期</th>
                                        <th class="edit-box"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rows as $row) : ?>
                                        <tr class="text-center">
                                            <td><input type="checkbox" class="checkbox"></td>
                                            <td>
                                                <img src="../midterm/images/<?= $row["image"] ?>" alt="" class="object-fit">
                                            </td>
                                            <td id="<?= $row["id"] ?>"><?= $row["name"] ?></td>
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
                                            <td><?= $row["created_at"] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="submit" name="sale" value="<?= $row["id"] ?>" class="btn">上架</button>
                                                    <button type="submit" name="unsale" value="<?= $row["id"] ?>" class="btn">下架</button>
                                                    <a href="editLesson.php" class="btn">編輯</a>
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
                <div class="page d-flex justify-content-center">
                    <ul class="btn-group">
                        <li class="btn">
                            <a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a>
                        </li>
                        <li class="btn">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="btn">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="btn">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="btn">
                            <a class="page-link" href="#">
                                <i class="fa-solid fa-chevron-right"></i></a>
                        </li>
                    </ul>
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
