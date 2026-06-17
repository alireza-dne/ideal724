<?php require_once(BASE_PATH . '/template/app/layouts/head-tag.php'); ?>


<body>

    <!-- start header -->
    <header class="p-2 none-home">
        <?php require_once(BASE_PATH . '/template/app/layouts/header.php'); ?>
    </header>
    <!-- end header -->

    <!-- start main -->

    <section class="main my-5">

        <div id="category">
            <div class="container">

                <div class="category row box-shadow p-4 position-relative">
                    <div
                        class="category-title d-flex justify-content-between align-items-center border-bottom flex-row-reverse py-3">
                        <h1 class="fs-5 fw-bolder"><?= $brand['english_name'] ?></h1>

                        <img src="<?= asset($brand['image']) ?>" alt="">
                    </div>


                    <p class="mt-4 fs-5">محصولات قابل تامین شرکت اطلس کمپرسور ایده آل با برند
                        <?= $brand['english_name'] ?></p>


                    <div class="row category-products mt-5">
                        <?php foreach ($products as $product) { ?>
                            <div class="col-12 col-lg-3 col-sm-6 mt-4">
                                <a href="<?= url('product/' . $product['id']) ?>"
                                    class="text-dark product-item d-flex flex-column p-2">
                                    <div class="product-image">
                                        <img src="<?= asset($product['image']) ?>" alt="">
                                    </div>
                                    <h3><?= $product['name'] . ' ' . $product['english_name'] ?></h3>
                                    <P class="mt-2"><i class="fas fa-check me-2"></i>قابل تامین توسط شرکت اطلس کمپرسور ایده
                                        آل</P>
                                    <form action="<?= url('order/' . $product['id']) ?>" class="">
                                        <button type="submit" class="login-register product-button d-flex w-100">ثبت
                                            سفارش</button>
                                    </form>

                                </a>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="category-controlls d-flex mt-5 justify-content-center align-items-center gap-3">
                        <div class="category-next">بعدی</div>
                        <h6>صفحه 5 / 1</h6>
                        <div class="category-prev">قبلی</div>

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