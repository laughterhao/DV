<!doctype html>
<html lang="en">

<head>
    <title>Coach Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    include("css-coach.php");
    ?>
</head>

<body>

    <main class="container rounded-3 m-5 border">
        <div class="row py-3 text-nowrap ">
            <h4>編輯教練</h4>
            <div class="col-4">
                <form action="">
                    <div class="ratio ratio-1x1 mb-4">
                        <img src="../spiderman.jpg" class="img-thumbnail rounded-circle my-3" alt="...">
                    </div>

                    <div class="input-group">
                        <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">上傳</button>
                    </div>

                    <input class="form-control my-3" type="text" placeholder="專長" aria-label="default input example" required>
                    <a href="" class="ps-3 nav-link "><i class="bi bi-plus-circle "></i>　新增專長</a>

                    <input class="form-control my-3" type="text" placeholder="地區" aria-label="default input example" required>
                    <a href="" class="ps-3 nav-link"><i class="bi bi-plus-circle"></i>　新增地區</a>
                    <hr class="border border-primary border-1 opacity-75">

                    <div class="form-check form-check-inline">
                        <label for="">證照</label><br>
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">PADI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">NAUI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">SSI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option4">
                        <label class="form-check-label" for="inlineCheckbox4">CMAS</label>
                    </div>

                </form>

            </div>

            <div class="col-5 ms-3 mt-5">
                <form action="">
                    <div class="row g-3">
                        <div class="col-8">
                            <label for="">姓名</label>
                            <input type="text" class="form-control" placeholder="請輸入姓名" aria-label="" required>
                        </div>
                        <div class="col-4">
                            <label for="">性別</label>
                            <select class="form-select form-select" aria-label="Small select example">
                                <option selected>請選擇</option>
                                <option value="1">男</option>
                                <option value="2">女</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="">生日</label>
                            <input placeholder="請選擇日期" class="form-control" type="date" id="date">
                        </div>


                        <div class="col-12 ">
                            <label for="exampleFormControlInput1" class="">Email</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
                        </div>

                        <div class="col-12 ">
                            <label for="exampleFormControlInput1" class="">電話號碼</label>
                            <input type="phone" class="form-control" id="exampleFormControlInput1" placeholder="請輸入電話號碼" required>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">教練介紹</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>


                    </div>

                </form>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-danger" type="button">取消</button>
                    <button class="btn btn-primary" type="button">確認</button>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>