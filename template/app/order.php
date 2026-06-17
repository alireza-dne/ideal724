<?php


require_once(BASE_PATH . '/template/app/layouts/head-tag.php'); ?>


<body>

    <!-- start header -->
    <header class="p-2 none-home">
        <?php require_once(BASE_PATH . '/template/app/layouts/header.php'); ?>
    </header>
    <!-- end header -->



    <!-- start main -->

    <section class="main my-5">

        <div id="order">
            <div class="container">

                <div class="title">ثبت سفارش</div>

                <?php require_once(BASE_PATH . '/template/admin/layouts/partials/error.php'); ?>
                <?php require_once(BASE_PATH . '/template/admin/layouts/partials/success.php'); ?>

                <form action="<?= url('order-store') ?>" class="order row box-shadow p-4" method="post">
                    <div class="mb-3 col-12">
                        <label for="order " class="form-label ">شرح کالا / کالاهای مورد نیاز</label>
                        <textarea name="order" id="" cols="30" rows="5" class="form-control col-12" name="order"
                            placeholder="تعداد و شرح کالای مد نظر خود را وارد فرمایید"><?= $product != null ? 'تعداد ....... عدد ' . $product['name'] . ' ' . $product['english_name'] : '' ?></textarea>
                    </div>


                    <div class="mb-3 col-12">
                        <label for="mobile " class="form-label ">موبایل</label>
                        <input type="text " class="form-control" name="mobile" placeholder="مثال : 09151234567"
                            value="<?= $user['mobile'] ?>">
                    </div>


                    <p class=" col-12 my-4 text-danger"><span class="fas fa-info-circle me-1 text-danger"></span>کاربر
                        گرامی، پس از ثبت سفارش، کارشناسان اطلس کمپرسور ایده آل در اسرع وقت با شما تماس خواهند گرفت. <br>
                        وارد کردن شماره موبایل برای ثبت سفارش ضروری می باشد
                    </p>

                    <button type="submit" class="btn btn-primary login-register">ثبت سفارش</button>
                </form>


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