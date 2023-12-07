<?php
require_once("../Diving/db-connect.php");
$sql = "SELECT * FROM member WHERE valid=1";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_GET["srearch"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM member WHERE name, phone, email LIKE '%$search%' AND valid=1";
} else {
    $sql = "SELECT * FROM member WHERE valid=1";
}




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
    <link rel="stylesheet" href="member-list.css">


</head>

<body>

    <div class="container">
        <div class="member-block">
            <h3>會員列表</h3>
            <div class="filter-block row mt-5 ">
                <div class="col-md-5">
                    <select class="form-select">
                        <option selected>增加篩選條件</option>
                        <option value="1">性別</option>
                        <option value="2">註冊時間</option>
                        <option value="3">生日</option>
                    </select>
                </div>
                <div class="input-group mb-3 col-md">
                    <!-- 收尋使用form，在本頁action=""，送出之後會在本頁執行 -->
                    <form action="">
                        <input type="text" class="form-control" name="search">
                        <button class="btn btn-outline-secondary" type="submit" id="searchBtn" ><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>

            <table class="member-table table text-center mt-4" id="example">
                <thead>
                    <tr class="text-nowrap">
                        <th>會員編號</th>
                        <th>姓名</th>
                        <th>性別</th>
                        <th>生日</th>
                        <th>信箱</th>
                        <th>電話</th>
                        <th>地址</th>
                        <th>註冊時間</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <?php if (isset($_GET["search"])) : ?>
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
                                    <a class="btn" href="">修改</a>
                                    <a class="btn" href="">刪除</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>


            </table>
        </div>
        <!-- 分頁 -->
        <nav>
            <ul class="pagination justify-content-center mt-5">
                <li class="page-item">
                    <a class="page-link" href="#">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>