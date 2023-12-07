<?php
session_start();


?>

<!doctype html>
<html lang="en">

<head>
    <title>SIGN UP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="sign-up.css">

</head>

<body>
    <div class="sign-up-container container row  justify-content-center align-items-center">

        <main class="form-signin p-4 col-4 text-center  ">
            <form class="sign-up-form" action="signUp.php" method="post">
                <!--  var_dump($_SESSION["error"]) ?> -->
                <h1 class="mb-3 fw-normal">DiVING</h1>

                <div class="form-floating mt-4">
                    <input type="email" class="form-control" id="Email" name="email" placeholder="填入信箱">
                    <label for="email" class="fs-6 text">Email</label>
                </div>

                <div class="form-floating mt-3">
                    <input type="password" class="form-control" id="Password" name="password" placeholder="輸入密碼">
                    <label for="password" class="fs-6 text">Password</label>
                </div>

                <div class="form-floating mt-3">
                    <input type="password" class="form-control" id="rePassword" name="repassword" placeholder="請再輸入密碼">
                    <label for="password" class="fs-6 text">Re-type password</label>
                </div>
                <?php if (isset($_SESSION["error"]["message"])) : ?>
                    <div class="text-danger">
                        <?= $_SESSION["error"]["message"] ?>
                    </div>
                <?php endif; ?>

                <div class="checkbox mb-3 mt-4">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button type="submit" class="sign-up-btn btn btn-md mt-2" data-bs-toggle="modal" data-bs-target="#signModel">SIGN UP</button>

                <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signModel" type="submit">Launch demo modal </button>-->

            </form>
        </main>

        <?php
        unset($_SESSION["error"]["message"]);

        ?>

        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
</body>

</html>