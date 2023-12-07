<!doctype html>
<html lang="en">

<head>
    <title>Add Coach</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    include("css-coach.php");
    ?>
    <style>

    </style>

</head>

<body>


    <div class="container rounded-3 m-5 border  flex-nowrap">
        <form class="row" action="doAddCoach.php" method="post">
            <h4>新增教練</h4>

            <div class="col-4">
                <img class="ratio ratio-1x1 mb-4 img-thumbnail rounded-circle my-3 img-fluid" id="output" />
                <input class="form-control" type="file" accept="image/*" onchange="loadFile(event)" id="upload" name="myFile">

                <input class="form-control my-3" type="text" placeholder="專長" aria-label="skill" id="skill" name="skill" required>
                <a href="" class="ps-3 nav-link "><i class="bi bi-plus-circle "></i>　新增專長</a>

                <input class="form-control my-3" type="text" placeholder="地區" id="city" name="city" required>
                <a href="" class="ps-3 nav-link"><i class="bi bi-plus-circle"></i>　新增地區</a>
            </div>
            <div class="col-7 ms-3 mt-5">
                <div class="row g-3">
                    <div class="col-6">
                        <label for="">姓名</label>
                        <input type="text" class="form-control" placeholder="請輸入姓名" id="name" name="name" required>
                    </div>
                    <div class="col-6">
                        <label for="" class="mb-2">性別</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="男">
                            <label class="form-check-label" for="male">男</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="女">
                            <!-- 兩個input設定同一個name才能做單選；設定value才能帶到後端去 -->
                            <label class="form-check-label" for="female">女</label>
                            <!-- 性別資料 存到資料庫時通常會用1或2 不會用單字 -->
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="date">生日</label>
                        <input placeholder="請選擇日期" class="form-control" value="1990-01-01" max="" type="date" id="birth" name="birth">

                    </div>

                    <div class="col-6 ">
                        <label for="email" class="">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
                    </div>


                    <div class="col-6 ">
                        <label for="phone" class="">電話號碼</label>
                        <input type="phone" class="form-control" id="phone" placeholder="請輸入電話號碼" name="phone[]" required>
                        <label for="phone" class="">電話號碼2</label>
                        <input type="phone" class="form-control" id="phone" placeholder="請輸入電話號碼" name="phone[]">
                    </div>



                    <div class="col-3 ">
                        <label for="number" class="">教學年資</label>
                        <input type="number" class="form-control" placeholder="請輸入數字" id="experience" name="experience">

                    </div>

                    <div class="col-12 ">
                        <div class="license ">
                            <label for="" class="me-3">證照</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="skill" value="1" name="license">
                                <label class="form-check-label" for="inlineCheckbox1">PADI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="skill" value="2" name="license">
                                <label class="form-check-label" for="inlineCheckbox2">NAUI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="skill" value="3" name="license">
                                <label class="form-check-label" for="inlineCheckbox3">SSI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="skill" value="4" name="license">
                                <label class="form-check-label" for="inlineCheckbox4">CMAS</label>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="info" class="form-label">教練介紹</label>
                        <textarea class="form-control" id="info" name="info" rows="5"></textarea>
                    </div>

                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-danger" href="coach-list.php">取消</a>
                    <button class="btn btn-primary" type="submit">新增</button>
                </div>
        </form>
    </div>

    </form>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
</body>

</html>