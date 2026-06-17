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

                <?php require_once(BASE_PATH . '/template/admin/layouts/partials/error.php'); ?>
                <?php require_once(BASE_PATH . '/template/admin/layouts/partials/success.php'); ?>


                <div class="title">اطلاعات کاربر</div>

                <form action="<?= url('change-profile-info') ?>" class="category row box-shadow p-4" method="post">
                    <div class="mb-3 col-12 col-lg-6">
                        <label for="username " class="form-label ">نام و نام خانوادگی</label>
                        <input type="text " class="form-control" name="username" value="<?= $user['username'] ?>">
                    </div>

                    <div class="mb-3 col-12 col-lg-6">
                        <label for="email " class="form-label ">ایمیل</label>
                        <input type="email " class="form-control" name="email" value="<?= $user['email'] ?>">
                    </div>

                    <div class="mb-3 col-12 col-lg-6">
                        <label for="mobile " class="form-label ">موبایل</label>
                        <input type="text " class="form-control" name="mobile" value="<?= $user['mobile'] ?>">
                    </div>

                    <div class="mb-3 col-12 col-lg-6">
                        <label for="permission " class="form-label ">دسته بندی: </label>
                        <input type="text " class="form-control"
                            value="<?= $user['permission'] == 'admin' ? 'ادمین' : 'کاربر عادی' ?>">
                    </div>

                    <div class="mb-3 col-12 col-lg-6">
                        <label for="password" class="form-label ">رمز عبور جدید(تغییر رمز عبور)</label>
                        <input type="password" class="form-control text-danger"
                            placeholder="در هنگام تغییر پسورد دقت فرمایید" name="password">
                    </div>

                    <div class="mb-3 col-12 col-lg-6">
                        <label for="created_at" class="form-label ">تاریخ ایجاد</label>
                        <input type="text " class="form-control" value="1404/05/14">
                    </div>

                    <p class=" col-12 my-4 text-danger"><span class="fas fa-info-circle me-1 text-danger"></span>کاربر
                        گرامی، در صورت فشردن دکمه ویرایش، اطلاعات جدیدی که ویرایش کرده اید ثبت خواهد شد، لذا خواهشمندیم
                        در ویرایش اطلاعات به خصوص پسورد دقت فرمایید. در صورت اصلاح ایمیل نیز حساب
                        کاربری شما تا زمان تایید ایمیل فعال سازی که به ایمیلتان ارسال خواهد شد، غیر فعال می گردد.
                    </p>


                    <button type="submit" class="btn btn-primary login-register">ویرایش</button>
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