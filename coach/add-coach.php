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

</head>

<body>


    <div class="container rounded-3 m-5 border  flex-nowrap">
        <form class="row" action="doAddCoach.php" method="post" enctype="multipart/form-data">
            <h4>新增教練</h4>

            <div class="col-4">
                <img class="ratio ratio-1x1 bg-transparent mb-4 img-thumbnail rounded-circle my-3 img-fluid" id="output" style="height: 300px;" />

                <input class="form-control " type="file" accept="image/*" onchange="loadFile(event)" id="imgfile" name="imgfile">

                <label for="" class="mt-3">專長</label>
                <input class="form-control " type="text" placeholder="專長" aria-label="skill" id="skill" name="skill" required>

                <label for="" class="mt-3">地區</label>
                <input class="form-control" type="text" placeholder="地區" id="city" name="city" required>

            </div>
            <div class="col-7 ms-3">
                <div class="row g-3">
                    <div class="col-6">
                        <label for="">姓名</label>
                        <input type="text" class="form-control" placeholder="請輸入姓名" id="name" name="name" required>
                    </div>
                    <div class="col-6">
                        <label for="" class="mb-2">性別</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="1">
                            <label class="form-check-label" for="male">男</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="2">
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
                        <input type="tel" class="form-control" name="phone" required>
                    </div>



                    <div class="col-4 ">
                        <label for="number" class="">教學年資</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="請輸入數字" id="experience" name="experience">
                            <label class="input-group-text" for="inputGroupSelect02">年</label>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="info" class="form-label">教練介紹</label>
                        <textarea class="form-control" id="info" name="info" rows="5" placeholder="介紹一下自己吧！" required></textarea>
                    </div>

                </div>

                <div class="license ">
                    <label for="" class="me-3">證照</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="license" value="1" name="license[]">
                        <label class="form-check-label" for="license1">PADI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="license" value="2" name="license[]">
                        <label class="form-check-label" for="license2">NAUI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="license" value="3" name="license[]">
                        <label class="form-check-label" for="license3">SSI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="license" value="4" name="license[]">
                        <label class="form-check-label" for="license4">CMAS</label>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-danger" href="coach-list.php">取消</a>
                    <button class="btn btn-primary" type="submit">新增</button>
                </div>
        </form>

    </div>


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

    <script>
        function validateForm() {
            const email = document.getElementById('email').value;
            const phone = document.getElementsByName('phone')[0].value;

            if (!emailRegex.test(email)) {
                alert('請輸入有效的電子郵件地址');
                return false;
            }

            if (!phoneRegex.test(phone)) {
                alert('請輸入有效的10位數電話號碼');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>