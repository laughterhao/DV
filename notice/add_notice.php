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



            <div class="continer ">
               <h2 class="text-center mt-5">新增公告</h2>
               <form action="do_add_notice.php" method="post" enctype="multipart/form-data" class="border  border-dark-subtle border-2 m-4 py-2 px-1">
                  <div class="row m-2">
                     <div class="col-md-6">
                        <div class="mb-3">
                           <label for="title" class="form-label">標題</label>
                           <input type="text" class="form-control" id="title" name="title" placeholder="輸入標題" />
                           <div class="form-text">輸入標題</div>
                        </div>
                        <div class="mb-3">
                           <div class="content">
                              <textarea class="form-control" placeholder="輸入內容" id="content" style="height: 170px" name="content"></textarea>
                           </div>
                        </div>
                        <button type="submit" class="btn border border-dark">
                           送出
                        </button>
                        <a href="notice.php" type="button" class="btn border border-dark">
                           取消
                        </a>
                     </div>
                     <div class="col-md-6">
                        <select class="form-select form-select-lg my-4" aria-label="Large select example" name="sort">
                           <option selected>選擇公告類別</option>
                           <option value="1">體驗</option>
                           <option value="2">深潛</option>
                           <option value="3">自由潛水</option>
                        </select>
                        <div class="mb-3">
                           <label for="img" class="form-label">圖片</label>
                           <input type="file" class="form-control" id="img" name="img" />
                           <div class="form-text">上傳圖片</div>
                        </div>
                        <div class="mb-3">
                           <label for="end_date" class="form-label">下架時間</label>
                           <input type="date" class="form-control" id="end_date" name="end_date" />

                        </div>

                     </div>
                  </div>
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
