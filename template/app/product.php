<?php

use Database\DataBase;

require_once(BASE_PATH . '/template/app/layouts/head-tag.php'); ?>


<body>

    <!-- start header -->
    <header class="p-2 none-home">
        <?php require_once(BASE_PATH . '/template/app/layouts/header.php'); ?>
    </header>
    <!-- end header -->

    <!-- start main -->
    <section class="main my-5 py-">

        <div id="single-product" class="">
            <div class="container">
                <ol class="single-product-category d-flex gap-3 color fs-5 fw-bolder mb-5 flex-wrap">

                    <?php foreach ($productAllCategories as $productAllCategory) { ?>
                        <li><a href="<?= url('product-category/' . $productAllCategory['id']) ?>"
                                class="color"><?= $productAllCategory['name'] ?></a></li>/
                    <?php } ?>

                    <li><a href="" class="color"><?= $product['name'] . ' ' . $product['english_name'] ?></a></li>
                </ol>


                <?php require_once(BASE_PATH . '/template/admin/layouts/partials/error.php'); ?>
                <?php require_once(BASE_PATH . '/template/admin/layouts/partials/success.php'); ?>


                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="single-product-image-box box-shadow p-4">
                            <img src="<?= asset($product['image']) ?>" class="w-100" alt="">

                            <ul class="single-product-gallery">
                                <li class="cursor-pointer"><img src="<?= asset($product['image']) ?>" alt="">
                                </li>
                                <?php foreach ($galleries as $gallery) { ?>
                                    <li class="cursor-pointer"><img src="<?= asset($gallery['image']) ?>" alt="">
                                    </li>
                                <?php } ?>


                            </ul>
                        </div>

                    </div>

                    <div class="col-12 col-lg-8">
                        <div class="single-product-text-box box-shadow p-4 mt-4 mt-lg-0 d-flex flex-column gap-4">
                            <h1 class="fs-4 fw-bolder border-bottom p-2">
                                <?= $product['name'] . ' ' . $product['english_name'] ?></h1>

                            <h6>برند: <a href="<?= url('brand/' . $product['brand_id']) ?>" class="text-muted">
                                    <?= $product['english_name'] ?></a></h6>
                            <p class="text-muted"><span class="fas fa-shield-alt me-1"></span> گارانتی اصالت و سلامت
                                فیزیکی کالا</p>
                            <p class="text-success"><span class="fas fa-store-alt me-1"></span>قابل تامین توسط شرکت اطلس
                                کمپرسور ایده آل</p>
                            <p class="text-muted"><span class="fas fa-info-circle me-1 text-danger"></span>کاربر گرامی
                                خرید شما هنوز نهایی نشده است. برای ثبت سفارش باید ابتدا وارد سامانه شده وسپس درخواست خود
                                را ثبت کنید تا کارشناسان ما در اسرع وقت با شما تماس بگیرند در غیر
                                اینصورت به صورت مستقیم با کارشناسان شرکت اطلس کمپرسور ایده آل تماس بگیرید. </p>

                            <a href="<?= url('order/' . $product['id']) ?>"
                                class="login-register d-flex justify-content-center">ثبت سفارش</a>
                        </div>
                    </div>
                </div>


                <div class="row mt-5" id="single-product-info">
                    <div class="col-12">
                        <div class="single-product-info box-shadow p-4">

                            <ul class="d-flex gap-3 fw-bolder fs-5 border-bottom py-2 single-product-info-head">
                                <li><a href="#introductin" class="text-black position-relative p-2">معرفی</a></li>
                                <li><a href="#features" class="text-black position-relative p-2">ویژگی ها</a></li>
                                <li><a href="#comments" class="text-black position-relative p-2">دیدگاه ها</a></li>
                            </ul>

                            <div id="introductin" class="my-4">
                                <h6 class="mb-4 fw-bolder border-bottom py-2">معرفی</h6>
                                <p class=""> <?= $product['description'] ?></p>
                            </div>


                            <div id="features" class="my-4">
                                <h6 class="mb-4 fw-bolder border-bottom py-2">ویژگی ها</h6>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">طول</th>
                                            <td><?= $product['length']  ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">عرض</th>
                                            <td><?= $product['width'] ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ارتفاع</th>
                                            <td><?= $product['height']  ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">وزن</th>
                                            <td><?= $product['weight']  ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <?php foreach ($categoryAttributes as $categoryAttribute) {
                                        ?>
                                            <tr>
                                                <th scope="row"><?= $categoryAttribute['name'] ?></th>
                                                <td><?php foreach ($categoryValues as $categoryValue) {
                                                        if ($categoryValue['category_attribute_id'] == $categoryAttribute['id']) {


                                                            echo json_decode($categoryValue['value'], true)['value'];
                                                        }
                                                    }
                                                    ?></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>



                            <div id="comments">
                                <h6 class="mb-4 fw-bolder border-bottom py-2">دیدگاه ها</h6>

                                <div class="set-comment my-5">

                                    <?php if (isset($_SESSION['user'])) { ?>
                                        <form action="<?= url('comment-store/' . $product['id']) ?>" method="post"
                                            class=" my-5 d-flex flex-column gap-3">
                                            <label for="comment" class="form-label">دیدگاه خود را در کادر ذیل یادداشت
                                                فرمایید.</label>
                                            <textarea rows="8" cols="" class="form-control" placeholder="چیزی بنویسید"
                                                name="comment"></textarea>
                                            <button class="login-register">ارسال نظر</button>
                                        </form>
                                    <?php } else { ?>
                                        <section class="d-flex align-items-center gap-5 my-5">
                                            <p class="text-success fw-bold">جهت ثبت نظر ابتدا وارد شوید. </p>
                                            <a href="<?= url('login-register') ?>" class="login-register">ورود / ثبت نام</a>
                                        </section>
                                    <?php } ?>



                                </div>

                                <ul>

                                    <?php foreach ($comments as $comment) {
                                    ?>
                                        <li class=" box-shadow p-4 mt-4">
                                            <div class="comment-body">
                                                <div class="comment-header d-flex gap-3">
                                                    <span class="text-muted"><?= $comment['username'] ?></span>
                                                    <span><?= jalaliData($comment['updated_at']) ?></span>
                                                </div>

                                                <p class="mt-3 text-muted"><?= $comment['comment'] ?></p>

                                                <?php

                                                $db = new DataBase;
                                                $replycomments = $db->select("SELECT * FROM comments WHERE status='approved' AND product_id=? AND parent_id=?", [$product['id'], $comment['id']]);
                                                $db->closeConnection();


                                                foreach ($replycomments as $replycomment) {
                                                ?>

                                                    <div class="comment-reply p-3 ms-4 mt-4">
                                                        <div class="comment-header d-flex gap-3">
                                                            <span class="text-muted">admin</span>
                                                            <span><?= jalaliData($replycomment['updated_at']) ?></span>
                                                        </div>

                                                        <p class="mt-3 text-muted"><?= $replycomment['comment'] ?></p>
                                                    </div>

                                                <?php } ?>

                                            </div>

                                        </li>
                                    <?php } ?>

                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php require_once(BASE_PATH . '/template/app/layouts/other.php'); ?>

    <!-- end main -->



    <!-- start footer -->
    <?php require_once(BASE_PATH . '/template/app/layouts/footer.php'); ?>

    <!-- end footer -->


    <?php require_once(BASE_PATH . '/template/app/layouts/script.php'); ?>



</body>

</html>