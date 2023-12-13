<?php
require_once("db-connect.php");

if (!isset($_GET["id"])) { //如果沒有得到id的值會導倒會員列表
    header("location: member-list.php");
    exit;
}


//Get => 利用網址上面的變數去抓不同的內容
$id = $_GET["id"];
$sql = "SELECT * FROM member WHERE id=$id AND valid=1";
$result = $conn->query($sql);
$memberCount = $result->num_rows; //如果得到的id值的資料筆數為0
$row = $result->fetch_assoc(); //只要抓一筆資料

// var_dump($rows);


?>


<!doctype html>
<html lang="en">

<head>
    <title>Member Info</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="backe-template.css">
    <link rel="stylesheet" href="member-info.css?time=<?= time() ?>">
</head>

<body>
    <main class="container-fluid p-0">
        <div class="row mx-0">
            <nav class="main-nav col-2 p-0">
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

            <div class=" col-10 px-0" style="margin-left: 16.66%;">
                <div class="main-top">
                    <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
                </div>
                <div class="container-fluid m-0 p-3">
                    <?php if ($memberCount == 0) : ?>
                        <h1>使用者不存在</h1>
                    <?php else : ?>
                        <!-- 會員資訊 -->
                       
                        <div class="diving-block row ">
                            <div class="col-5">
                                <div class="memberinfo-block">
                                    <form action="memberEdit.php" method="post">

                                        <div class="d-flex justify-content-between mb-4 ">
                                            <h3>會員資訊</h3>
                                            <div>
                                                <a href="member-info.php?id=<?= $row["id"] ?>" class="btn btn-sm">取消</a>
                                                <button type="submit" class="btn btn-sm okbtn">確認</button>
                                            </div>
                                        </div>

                                        <table class="text-nowrap">

                                            <tr>
                                                <th>會員編號：</th>
                                                <td><?= $row["id"] ?></td>
                                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            </tr>
                                            <tr>
                                                <th>姓名：</th>
                                                <td>
                                                    <input type="text" class="form-control" name="name" value="<?= $row["name"] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>性別：</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="男" <?php if ($row["gender"] === "男") echo 'checked' ?>>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            男
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="女" <?php if ($row["gender"] === "女") echo 'checked' ?>>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            女
                                                        </label>
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>生日：</th>
                                                <td>
                                                    <input type="text" class="form-control" name="birth" value="<?= $row["birth"] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>信箱：</th>
                                                <td>
                                                    <input type="email" class="form-control" name="email" value="<?= $row["email"] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>電話：</th>
                                                <td><input type="tel" class="form-control" name="phone" value="<?= $row["phone"] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>地址：</th>
                                                <td>
                                                    <select name="city" class="form-select mt-2" aria-label="Default select example">
                                                        <!-- <option value="<?= $row["city"] ?>"></option> -->
                                                        <option value="台北市" <?php if ($row["city"] === "台北市") echo 'selected' ?>>台北市</option>
                                                        <option value="新北市" <?php if ($row["city"] === "新北市") echo 'selected' ?>>新北市</option>
                                                        <option value="桃園市" <?php if ($row["city"] === "桃園市") echo 'selected' ?>>桃園市</option>
                                                        <option value="新竹縣" <?php if ($row["city"] === "新竹縣") echo 'selected' ?>>新竹縣</option>
                                                        <option value="新竹市" <?php if ($row["city"] === "新竹市") echo 'selected' ?>>新竹市</option>
                                                        <option value="苗栗縣" <?php if ($row["city"] === "苗栗縣") echo 'selected' ?>>苗栗縣</option>
                                                        <option value="台中市" <?php if ($row["city"] === "台中市") echo 'selected' ?>>台中市</option>
                                                        <option value="彰化縣" <?php if ($row["city"] === "彰化縣") echo 'selected' ?>>彰化縣</option>
                                                        <option value="嘉義縣" <?php if ($row["city"] === "嘉義縣") echo 'selected' ?>>嘉義縣</option>
                                                        <option value="嘉義市" <?php if ($row["city"] === "嘉義市") echo 'selected' ?>>嘉義市</option>
                                                        <option value="台南縣" <?php if ($row["city"] === "台南縣") echo 'selected' ?>>台南縣</option>
                                                        <option value="高雄市" <?php if ($row["city"] === "高雄市") echo 'selected' ?>>高雄市</option>
                                                        <option value="台東縣" <?php if ($row["city"] === "台東縣") echo 'selected' ?>>台東縣</option>
                                                        <option value="台東市" <?php if ($row["city"] === "台東市") echo 'selected' ?>>台東市</option>
                                                        <option value="花蓮縣" <?php if ($row["city"] === "花蓮縣") echo 'selected' ?>>花蓮縣</option>
                                                        <option value="宜蘭縣" <?php if ($row["city"] === "宜蘭縣") echo 'selected' ?>>宜蘭縣</option>
                                                    </select>

                                                    <input style="width: 300px;" type="text" class="form-control" name="address" value="<?= $row["address"] ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>註冊時間：</th>
                                                <td><?= $row["created_at"] ?></td>
                                            </tr>

                                        </table>
                                    </form>
                                </div>
                            </div>
                            <!-- 訂單 -->
                            <div class="col-7">
                                <div class="order-block">
                                    <h3 class="mb-4">歷史訂單</h3>
                                    <table>
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>訂單號碼</th>
                                                <th>訂單日期</th>
                                                <th>訂單狀態</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </main>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- <script>
        function memberUpdate() {
            var getInfo = document.getElementById("#tdInfo").innerText;
            var inputEl = document.createElement("input");

            //inputEl一開始的值為getInfo得到的值
            inputEl.value = getInfo;

            inputEl.addEventListener("blur", function() {
                var newInfo = inputEl.value;
                document.getElementById("#tdInfo").innerText = newInfo;
            })

            document.getElementById('#tdInfo').replaceWith(inputEl);

            // 自動聚焦到 input 元素，使使用者可以立即編輯
            inputEl.focus();

        } -->

    // console.log(newInfo);
    </script>
</body>

</html>