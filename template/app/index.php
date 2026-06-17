<?php

use Database\DataBase;

require_once(BASE_PATH . '/template/app/layouts/head-tag.php'); ?>


<body>

    <!-- start home & header -->

    <section class="home">
        <header class="p-2">
            <?php require_once(BASE_PATH . '/template/app/layouts/header.php'); ?>

        </header>


        <div class="title">
            <h1>شرکت اطلس کمپرسور ایده آل</h1>

            <span id="typed"></span>
        </div>

        <div class="go-down d-flex flex-column">
            <img src="public/app/assets/img/arrow-down.svg" alt="">
        </div>

    </section>

    <!-- end home & header -->



    <!-- start main -->

    <section class="main my-5 py-5">

        <section id="base-story">
            <div class="container">
                <section class="base-story row align-items-center">
                    <div class="col-12 col-lg-6">
                        <div class="right">
                            <img src="public/app/assets/img/compressor.webp" alt="">
                        </div>

                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="left ms-lg-5 mt-4 mt-lg-0">
                            <h4 class="title">چه خدماتی به شما ارائه می‌دهیم؟</h4>
                            <p class="text mb-5">خدمات تخصصی هوای فشرده این مجموعه، شامل طیف گسترده‌ای از فعالیت‌های فنی
                                و
                                پشتیبانی به شرح ذیل می‌باشد.
                            </p>
                        </div>

                        <div
                            class="left-item ms-lg-5 mt-4 mt-lg-0 d-flex flex-wrap gap-4 justify-content-center align-items-center">
                            <?php foreach ($productCategories as $productCategory) {
                                if ($productCategory['parent_id'] == 11) {
                            ?>
                                    <a class=""
                                        href="<?= url('product-category/' . $productCategory['id']) ?>"><?= $productCategory['name'] ?></a>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </section>

            </div>


        </section>



        <section id="services">
            <div class="container">
                <h4 class="title2">خدمات و محصولات</h4>

                <ul class="services-title row">

                    <?php foreach ($productCategories as $productCategory) {
                        if ($productCategory['parent_id'] == null) {
                    ?>

                            <li class="col-12 col-sm-3">
                                <h3><?= $productCategory['name'] ?></h3>
                                <span><i class="<?= $productCategory['slug'] ?>"></i></span>
                            </li>
                    <?php }
                    } ?>

                </ul>



                <ul class="services-main row">

                    <?php foreach ($productCategories as $productCategory) {
                        if ($productCategory['parent_id'] == null) {
                    ?>
                            <li class="col-12 align-items-center gap-5">
                                <p><?= $productCategory['description'] ?></p>

                                <img src="<?= asset($productCategory['image']) ?>" alt="">

                                <a href="<?= url('product-category/' . $productCategory['id']) ?>">اطلاعات بیشتر و مشاهده
                                    محصولات</a>
                            </li>

                    <?php }
                    } ?>
                </ul>

            </div>
        </section>




        <section id="products">
            <div class="container">

                <div class="produts-title d-flex align-items-center justify-content-between">
                    <h4 class="title">پر بازدیدترین محصولات</h4>

                    <a href="<?= url('products') ?>" class="login-register d-flex">اینجا کلیک کنید</a>
                </div>

                <div class="row products">
                    <?php foreach ($mostViewProducts as $mostViewProduct) { ?>
                        <div class="col-12 col-lg-3 col-sm-6 product-item">
                            <a href="<?= url('product/' . $mostViewProduct['id']) ?>" class="text-dark">
                                <div class="product-image">
                                    <img src="<?= asset($mostViewProduct['image']) ?>" alt="">
                                </div>
                                <h3><?= $mostViewProduct['name'] . ' ' . $mostViewProduct['english_name'] ?></h3>
                                <P><i class="fas fa-check me-2"></i>قابل تامین توسط شرکت اطلس کمپرسور ایده آل</P>
                                <a href="<?= url('order/' . $mostViewProduct['id']) ?>"
                                    class="login-register product-button d-flex">ثبت سفارش</a>
                            </a>
                        </div>
                    <?php }  ?>
                </div>
            </div>

            <div class="product-controlls">
                <div class="next-product"><i class="fas fa-chevron-right"></i></div>
                <div class="prev-product"><i class="fas fa-chevron-left"></i></div>
            </div>
        </section>


        <section id="article">
            <div class="container">
                <div class="produts-title d-flex align-items-center justify-content-between">
                    <h4 class="title2">آخرین مقالات</h4>

                    <a href="<?= url('posts') ?>" class="login-register d-flex border-white">اینجا کلیک کنید</a>
                </div>

                <div class="row article">
                    <?php foreach ($posts as $post) {

                        $db = new DataBase;
                        $comments = $db->select("SELECT COUNT(`id`) AS comments_count FROM comments WHERE status='approved' AND post_id=?", [$post['id']])->fetch();
                        $db->closeConnection();

                    ?>

                        <div class="col-12 col-lg-4 col-sm-6 mt-lg-0 mt-4">
                            <div class="article-item">
                                <div class="article-item-head color d-flex justify-content-around align-items-center p-2">
                                    <div class="article-item-date d-flex gap-1 align-items-center">
                                        <span class="color2"><i class="fas fa-calendar"></i></span>
                                        <h6><?= jalaliData2($post['published_at']) ?></h6>
                                    </div>

                                    <div class="article-item-view d-flex gap-1 align-items-center">
                                        <span class="color2"><i class="fas fa-eye"></i></span>
                                        <h6><?= $post['view'] ?></h6>
                                    </div>

                                    <div class="article-item-comment d-flex gap-1 align-items-center">
                                        <span class="color2"><i class="fas fa-comment"></i></span>
                                        <h6><?= $comments['comments_count'] ?></h6>
                                    </div>
                                </div>

                                <a href="<?= url('post/' . $post['id']) ?>" class="article-item-img">
                                    <img src="<?= asset($post['image']) ?>" alt="">
                                    <span class="fs-2"><i class="fas fa-search"></i></span>
                                </a>

                                <div class="article-item-text py-3 px-2">
                                    <h3 class="fs-5 fs-sm fw-bolder mb-3"><?= $post['name'] ?></h3>
                                    <p class="text-muted"><?= substr($post['body'], 0, 100) . ' ...' ?></p>
                                </div>
                            </div>
                        </div>
                    <?php }  ?>


                </div>
            </div>
        </section>


        <section id="partner">
            <div class="container">
                <h4 class="title">برخی مشتریان ما</h4>


                <div class="d-flex partner gap-5">


                    <?php foreach ($banners as $banner) { ?>
                        <div class="partner-item">
                            <img src="<?= asset($banner['image']) ?>" alt="">
                        </div>
                    <?php }  ?>
                </div>
            </div>


        </section>
    </section>




    <?php require_once(BASE_PATH . '/template/app/layouts/other.php'); ?>


    <!-- end main -->



    <!-- start footer -->


    <?php require_once(BASE_PATH . '/template/app/layouts/footer.php'); ?>

    <!-- end footer -->



    <?php require_once(BASE_PATH . '/template/app/layouts/script.php'); ?>


    <script>
        $(document).ready(function() {
            var typed = new Typed('#typed', {
                strings: [
                    "هوای خط فشرده شما را داریم",
                    "کیفیت برتر",
                    "خدمات متمایز",
                    "با بهترین مهندسین",
                    "تضمین صد درصدی کاری"
                ],
                loop: true,
                typeSpeed: 50,
                backSpeed: 20
            });


        })
    </script>

</body>

</html>