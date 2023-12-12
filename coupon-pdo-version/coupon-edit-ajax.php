<?php
session_start();

if(!isset($_GET["id"])){
    header("location: coupon-list.php");
}

$id=$_GET["id"];

require_once("pdo-connect.php");

$stmt=$conn->prepare('SELECT * FROM `coupon` WHERE id =:id ');
$stmt->execute([':id' => $id]);
$row=$stmt->fetch();
$couponCount =$stmt->rowCount();

?>
<!doctype html>
<html lang="en">

<head>
    <title>Coupon Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
     include("css.php");
    ?>

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
                    確認刪除?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a href="api/doDeleteCoupon.php?id=<?=$row["id"]?>" class="btn btn-danger">確認</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
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
                <div class="container">
                <div class="py-2">
                    <a class="btn btn-info text-white" href="coupon-list.php" title="回優惠券列表">
                        <i class="bi bi-arrow-90deg-left"></i>
                    </a>
                </div>
                <?php  if($couponCount == 0):?>
                    <h1>優惠券不存在</h1>
                <?php else: ?>
                <div class="container" style="height: 77.6vh;">
                <table class="table table-bordered">
                <input type="hidden" name="id" id="id" value="<?=$row["id"]?>">
                <tr>
                    <th>優惠券名稱</th>
                    <td>
                        <input type="text" class="form-control" name="name" id="name" value="<?=$row["name"]?>">
                    </td>
                </tr>
                <tr>
                    <th>優惠碼</th>
                    <td>
                        <input type="text" pattern="\S*" class="form-control" name="code" id="code" value="<?=$row["code"]?>">
                    </td>
                </tr>
                <tr>
                    <th>可使用人數</th>
                    <td>
                        <input type="number" class="form-control" name="max_count" id="max_count" value="<?=$row["max_count"]?>">
                    </td>
                </tr>
                <tr>
                    <th>折扣方式</th>
                    <td>
                        <div class="form-check col-auto">
                            <input class="form-check-input" type="radio" name="discount_method" id="discount_cash" value="discount_cash" <?php if(isset($row["discount_cash"])) :?>checked<?php endif; ?>>
                            <label class="form-check-label" for="discount_cash">
                                現金折抵
                            </label>
                        </div>
                        <div class="form-check col-auto">
                            <input class="form-check-input" type="radio" name="discount_method" id="discount_pa" value="discount_pa" <?php if(isset($row["discount_pa"])) :?>checked<?php endif; ?>>
                            <label class="form-check-label" for="discount_pa">
                                折扣
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <?php 
                    $a = isset($row["discount_pa"]);
                    ?>
                    <th>折扣額數</th>
                    <td>
                        <input type="number" class="form-control" name="discount" id="discount" value="<?php echo ($a ? $row["discount_pa"] : $row["discount_cash"]) ?>" >
                    </td>
                </tr>
                <tr>
                    <th>使用期間</th>
                    <td>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="start" id="start" value="<?=$row["start"]?>">
                        </div>
                        <div class="col-auto">
                            to
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="end" id="end" value="<?=$row["end"]?>">
                        </div>
                    </td>
                </tr>
            </table>
                </div>
            <div class="py-2 d-flex justify-content-between">
                <div>
                    <button class="btn btn-info text-white" id="send">儲存</button>
                    <a class="btn btn-info text-white" href="coupon.php?id=<?=$row["id"]?>">取消</a>
                </div>
                <div>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#alertModal" class="btn btn-danger">刪除</button>
                </div>
            </div>
            </div>
        <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


    <script>
            const send = document.querySelector("#send"),
                id = document.querySelector("#id"),
                name = document.querySelector("#name"),
                code = document.querySelector("#code"),
                start = document.querySelector("#start"),
                end = document.querySelector("#end"),
                max_count = document.querySelector("#max_count"),
                discount = document.querySelector("#discount")

            send.addEventListener("click", function() {
                console.log("click");
                let idValue = id.value;
                let nameValue = name.value;
                let codeValue = code.value;
                let startValue = start.value;
                let endValue = end.value;
                let max_countValue = max_count.value;
                let discountValue = discount.value;
                let discountMethodValue = $("input[name=discount_method]:checked").val()
                
                let data = {
                    id: idValue,
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
                        url: "api/doEditCoupon.php",
                        dataType: "json",
                        data: data
                    })
                    .done(function(response) {
                        // console.log(response);
                        let status=response.status;
                        if(status==0){
                            alert(response.message);
                        }else{
                            alert(response.message);
                        }

                    }).fail(function(jqXHR, textStatus) {
                        console.log("Request failed: " + textStatus);
                    });

            })
        </script>

</body>

</html>