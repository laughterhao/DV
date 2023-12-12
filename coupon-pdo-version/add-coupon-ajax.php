<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Add Coupon</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    include("../css/css.php");
    ?>

</head>

<body>
    <div class="container-fluid">

        <main class="row">
            <nav class="main-nav col-lg-2 p-0">
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

            <div class="col-10 px-0" style="margin-left: 16.66%;">
                <div class="main-top">
                    <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
                </div>
                <div>
                    <div class="container">
                        <div class="py-2">
                            <a class="btn btn-info text-white" href="coupon-list.php" title="回優惠券列表">
                                <i class="bi bi-arrow-90deg-left"></i>
                            </a>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">優惠券名稱</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">優惠券號碼</label>
                            <input type="text" pattern="\S*" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="max_count" class="form-label">可使用人數</label>
                            <input type="number" class="form-control" id="max_count" name="max_count" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">使用期間</label>
                            <div class="d-flex align-items-center">
                                <div class="col-auto">
                                    <input type="date" class="form-control" name="start" id="start">
                                </div>
                                <div class="col-auto">
                                    ～
                                </div>
                                <div class="col-auto">
                                    <input type="date" class="form-control" name="end" id="end">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="discount_method" class="form-label">優惠方式</label>
                            <div class="form-check col-auto">
                                <input class="form-check-input" type="radio" name="discount_method" id="discount_cash" value="discount_cash" checked>
                                <label class="form-check-label" for="discount_cash">
                                    現金折抵
                                </label>
                            </div>
                            <div class="form-check col-auto">
                                <input class="form-check-input" type="radio" name="discount_method" id="discount_pa" value="discount_pa">
                                <label class="form-check-label" for="discount_pa">
                                    折扣
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="discount" class="form-label">優惠額數</label>
                            <input type="number" class="form-control" id="discount" name="discount" required>
                        </div>
                        <button class="btn btn-info" id="send">送出</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        const send = document.querySelector("#send"),
            name = document.querySelector("#name"),
            code = document.querySelector("#code"),
            start = document.querySelector("#start"),
            end = document.querySelector("#end"),
            max_count = document.querySelector("#max_count"),
            discount = document.querySelector("#discount")

        send.addEventListener("click", function() {
            console.log("click");
            console.log(name);
            let nameValue = name.value;
            let codeValue = code.value;
            let startValue = start.value;
            let endValue = end.value;
            let max_countValue = max_count.value;
            let discountValue = discount.value;
            let discountMethodValue = $("input[name=discount_method]:checked").val()


            let data = {
                name: nameValue,
                code: codeValue,
                start: startValue,
                end: endValue,
                max_count: max_countValue,
                discount: discountValue,
                discount_method: discountMethodValue
            }

            console.log(data);
            $.ajax({
                    method: "POST", //or GET
                    url: "../api/doAddcoupon.php",
                    dataType: "json",
                    data: data
                })
                .done(function(response) {
                    // console.log(response);
                    let status = response.status;
                    if (status == 0) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }

                }).fail(function(jqXHR, textStatus) {
                    console.log("Request failed: " + textStatus);
                });

        })
    </script>
</body>

</html>