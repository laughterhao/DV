<?php require_once("select_new.php") ?>
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
   <link rel="stylesheet" href="asider.css">
</head>

<body>
   <div class="container-fluid">
      <main class="row">
         <nav class="main-nav col-lg-2 p-0">
            <h1 class="my-4 text-center">DiVING</h1>
            <ul class="main-ul list-unstyle p-0">
               <li class="main-li"><a href="..\"><i class="bi bi-intersect"></i>總覽</a></li>
               <li class="main-li"><a href="..\order\order-list.php"><i class="bi bi-file-text"></i>訂單管理</a></li>
               <li class="main-li"><a href="..\product\product-list.php"><i class="bi bi-bag-fill"></i>商品及分類</a></li>
               <li class="main-li"><a href="..\member\member-list.php"><i class="bi bi-person-circle"></i>顧客管理</a></li>
               <li class="main-li"><a href="..\lesson\lessonList.php"><i class="bi bi-tv"></i>課程管理</a></li>
               <li class="main-li"><a href="..\coach\coach-list.php"><i class="bi bi-person-vcard"></i>教練管理</a></li>
               <li class="main-li"><a href="..\coupon-pdo-version\coupon-list.php"><i class="bi bi-shop-window"></i>行銷</a></li>
               <li class="main-li"><a href="notice\notice.php"><i class="bi bi-megaphone"></i>公告</a></li>
            </ul>
         </nav>

         <div class="col-lg-10 px-0" style="margin-left: 16.66%;">
            <div class="main-top">
               <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
            </div>



            <div class="continer mx-auto">
               <h2 class="text-center mt-5">新增公告</h2>
               <form action="do_add_notice.php" method="post">
                  <div class="row mx-5">
                     <div class="col-md-6">
                        <div class="mb-3">
                           <label for="title_img" class="form-label">縮圖</label>
                           <input type="text" class="form-control" id="title_img" name="title_img" />
                           <div class="form-text">上傳縮圖</div>
                        </div>
                        <div class="mb-3">
                           <label for="title" class="form-label">標題</label>
                           <input type="text" class="form-control" id="title" name="title" />
                           <div class="form-text">輸入標題</div>
                        </div>
                        <div class="mb-3">
                           <label for="sort" class="form-label">類別</label>
                           <input type="text" class="form-control" id="sort" name="sort" />
                           <div class="form-text">輸入類別</div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mb-3">
                           <label for="content" class="form-label">內文</label>
                           <textarea type="text" class="form-control" id="content" name="content"></textarea>
                           <div class="form-text">輸入內容</div>
                        </div>
                        <div class="mb-3">
                           <label for="img" class="form-label">圖片</label>
                           <input type="text" class="form-control" id="img" name="img" />
                           <div class="form-text">上傳圖片</div>
                        </div>
                        <div class="mb-3">
                           <label for="end_date" class="form-label">下架時間</label>
                           <input type="date" class="form-control" id="end_date" name="end_date" />
                           <div class="form-text">輸入內容</div>
                        </div>
                     </div>
                  </div>





                  <button type="submit" class="btn border border-dark">
                     Submit
                  </button>
               </form>
            </div>
         </div>
      </main>
   </div>
   <!-- Bootstrap JavaScript Libraries -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
