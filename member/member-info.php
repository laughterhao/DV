<?php
require_once("db-connect.php");

$sql = "SELECT * FROM member";


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
</head>

<body>
    <main>
        <div class="container">
            <form action="">
                <table>
                    <tr>
                        <th>會員編號：</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>姓名：</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>性別：</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>生日：</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>信箱：</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>電話：</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>地址：</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>註冊時間：</th>
                        <td></td>
                    </tr>
                </table>

            </form>
        </div>
    </main>


    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>