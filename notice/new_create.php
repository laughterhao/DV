<!DOCTYPE html>
<html lang="en">
   <head>
      <title>create</title>
      <!-- Required meta tags -->
      <meta charset="utf-8" />
      <meta
         name="viewport"
         content="width=device-width, initial-scale=1, shrink-to-fit=no"
      />

      <!-- Bootstrap CSS v5.2.1 -->
      <link
         href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
         rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
         crossorigin="anonymous"
      />
      <link rel="stylesheet" href="min.css" />
   </head>

   <body>
      <div class="container">
         <div class="row">
            <div class="col-3">
               <div class="bg_color h-100">列表</div>
            </div>
            <div class="col-9">
               <div class="py-2">
                  <h2 class="text-center">新增公告</h2>
               </div>
               <div class="m-3">
                  <form action="add_new.php" method="post">
                     <div class="mb-3">
                        <label for="title_img" class="form-label">縮圖</label>
                        <input
                           type="text"
                           class="form-control"
                           id="title_img"
                           name="title_img"
                        />
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
                     <div class="mb-3">
                        <label for="content" class="form-label">內文</label>
                        <textarea type="text" class="form-control" id="content" name="content" >
                        </textarea>
                        <div class="form-text">輸入內容</div>
                     </div>
                     <div class="mb-3">
                        <label for="img" class="form-label">圖片</label>
                        <input type="text" class="form-control" id="img" name="img" />
                        <div class="form-text">上傳圖片</div>
                     </div>
                     <div class="mb-3">
                        <label for="end_date" class="form-label"
                           >下架時間</label
                        >
                        <input type="date" class="form-control" id="end_date" name="end_date"/>
                        <div class="form-text">輸入內容</div>
                     </div>
                     <button type="submit" class="btn btn-primary">
                        Submit
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <script
         src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
         integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
         crossorigin="anonymous"
      ></script>

      <script
         src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
         integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
         crossorigin="anonymous"
      ></script>
   </body>
</html>
