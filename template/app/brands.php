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

    <section class="main my-5">

        <div id="category">
            <div class="container">

                <div class="category row box-shadow p-4 position-relative">
                    <div class="category-title d-flex justify-content-between align-items-center border-bottom py-3">
                        <h1 class="fs-5 fw-bolder">برند های قابل تامین شرکت اطلس کمپرسور ایده آل</h1>

                    </div>

                    <div class="row brands mt-5">

                        <?php foreach ($brands as $brand) { ?>
                            <div class="col-6 col-lg-2 col-sm-4 col-md-3 mt-4">
                                <a href="<?= url('brand/' . $brand['id']) ?>" class="d-flex border">
                                    <img class="w-100" src="<?= asset($brand['image']) ?>" alt="">
                                </a>
                            </div>
                        <?php } ?>
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