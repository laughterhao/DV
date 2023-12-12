<?php require_once("notice/select_new.php") ?>
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
    <?php foreach ($rows as $row) : ?>
        <div class="modal fade" id="edit-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><?php echo $row['Title'] ?></h4>
                    </div>
                    <div class="modal-body">
                        <form action="edit_notice.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <label for="title_img" class="form-label">縮圖</label>
                                        <input type="text" class="form-control" id="title_img" name="title_img" value="<?= $row['Sub_img'] ?>" />
                                        <div class="form-text">上傳縮圖</div>

                                        <label for="title" class="form-label">標題</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?= $row['Title'] ?>" />
                                        <div class="form-text">輸入標題</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="sort" class="form-label">類別</label>
                                        <input type="text" class="form-control" id="sort" name="sort" value="<?= $row['Sort'] ?>" />
                                        <div class="form-text">輸入類別</div>
                                    </div>
                                    <div>
                                        <label for="img" class="form-label">圖片</label>
                                        <input type="text" class="form-control" id="img" name="img" value="<?= $row['Main_img'] ?>" />
                                        <div class="form-text">上傳圖片</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="content" class="form-label">內文</label>
                                <textarea type="text" class="form-control" id="content" name="content" pattern="\s"><?= $row['Content'] ?></textarea>
                            </div>
                            <div>
                                <label for="end_date" class="form-label">下架時間</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="<?= $row['Exp_date'] ?>" />
                                <div class="form-text">輸入內容</div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                送出
                            </button>
                        </form>
                        <input type="hidden" id="modalId" value="">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="del-<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $row['Title'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        確定要刪除嗎?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <a class="btn btn-danger" href="del_notice.php?id=<?= $row['id'] ?>">確定</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

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

            <div class="col-lg-10 px-0" style="margin-left: 16.66%;">
                <div class="main-top">
                    <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
                </div>
                <div class="continer mx-3">
                    <div class="pt-5">
                        <h2 class="text-center">最新公告</h2>
                    </div>
                    <div class="">
                        <div class="d-flex justify-content-between py-2">
                            <div class="input-group w-25">
                                <input type="text" class="form-control" placeholder="search" />
                                <button type="button" class="btn btn-info">
                                    <i class="bi bi-search"></i>search
                                </button>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-info">
                                    <a href="new_create.html"><i class="bi bi-newspaper px-2"></i>新增資訊</a>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive border border-dark rounded-3 mb-2">
                            <table class="table table-striped table-hover table-borderless table-primary align-middle m-0">
                                <thead class="table-light table-responsive table-striped">
                                    <tr class="text-nowrap text-center">
                                        <th>縮圖</th>
                                        <th>
                                            <i class="bi bi-sort-alpha-up"></i><i class="bi bi-sort-alpha-down-alt"></i>標題
                                        </th>
                                        <th>內文</th>
                                        <th>圖片</th>
                                        <th>
                                            <i class="bi bi-sort-numeric-down-alt"></i><i class="bi bi-sort-numeric-up"></i>上架時間
                                        </th>
                                        <th>
                                            <i class="bi bi-sort-numeric-down-alt"></i><i class="bi bi-sort-numeric-up"></i>下架時間
                                        </th>
                                        <th>操作</th>
                                    </tr>
                                </thead>

                                <tbody class="table-group-divider nowrap">
                                    <tr class="table-primary">
                                        <?php foreach ($rows as $row) : ?>
                                            <td scope="row">
                                                <img src="https://picsum.photos/50/50/?random=10">
                                            </td>
                                            <td><?= $row['Title'] ?></td>
                                            <td><?= $row['Content'] ?></td>
                                            <td><?= $row['Main_img'] ?></td>
                                            <td><?= $row['Create_at'] ?></td>
                                            <td><?= $row['Exp_date'] ?></td>
                                            <td class="text-nowrap">
                                                <a type="button" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $row['id']; ?>" data-id="<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></a>

                                                <a type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#del-<?= $row["id"] ?>" data-id="<?php echo $row['id']; ?>"><i class="bi bi-trash3"></i></i></a>
                                            </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
    </script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
