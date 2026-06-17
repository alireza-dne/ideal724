<?php require_once(BASE_PATH . '/template/auth/layouts/head-tag.php'); ?>


<body>

    <section class="login-register forget-password d-flex flex-column">

        <?php require_once(BASE_PATH . '/template/admin/layouts/partials/error.php'); ?>
        <?php require_once(BASE_PATH . '/template/admin/layouts/partials/success.php'); ?>


        <div class="login-register-box">
            <div class="top login p-2">
                بازنشانی رمز عبور
            </div>

            <ul class="social d-flex justify-content-center gap-4 m-4">
                <li><a href="<?= $setting['instagram'] ?>" class="instagram-colorfull"><i
                            class="fab fa-instagram"></i></a></li>
                <li><a href="<?= $setting['telegram'] ?>" class="telegram-colorfull"><i class="fab fa-telegram"></i></a>
                </li>
            </ul>


            <div class="form-box mt-5">
                <form action="<?= url('reset-password-store') ?>" class="forget-password-form d-flex flex-column gap-4"
                    method="post">

                    <a href="<?= url('login-register') ?>" class="">ورود / ثبت نام</a>


                    <input type="hidden" name="randomToken" value="<?= $randomToken ?>">

                    <div class="form-controll">
                        <input type="password" name="password" placeholder="رمز عبور جدید">
                        <div class="red text-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="green text-success"><i class="fas fa-check-circle"></i></div>
                        <span>پیام خطا</span>
                    </div>

                    <div class="form-controll">
                        <input type="password" name="confirm-password" placeholder="تکرار رمز عبور جدید">
                        <div class="red text-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="green text-success"><i class="fas fa-check-circle"></i></div>
                        <span>پیام خطا</span>
                    </div>

                    <button type="submit">تایید</button>
                </form>

            </div>
        </div>
    </section>


    <?php require_once(BASE_PATH . '/template/auth/layouts/script.php'); ?>


</body>

</html>