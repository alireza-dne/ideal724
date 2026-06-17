<?php require_once(BASE_PATH . '/template/auth/layouts/head-tag.php'); ?>


<body>

    <section class="login-register forget-password">
        <div class="login-register-box">
            <div class="top login p-2">
                فراموشی رمز عبور
            </div>

            <ul class="social d-flex justify-content-center gap-4 m-4">
                <li><a href="<?= $setting['instagram'] ?>" class="instagram-colorfull"><i
                            class="fab fa-instagram"></i></a></li>
                <li><a href="<?= $setting['telegram'] ?>" class="telegram-colorfull"><i class="fab fa-telegram"></i></a>
                </li>
            </ul>


            <div class="form-box mt-5">
                <form action="<?= url('forget-password-store') ?>" class="forget-password-form d-flex flex-column gap-4"
                    method="post">

                    <a href="<?= url('login-register') ?>" class="">ورود / ثبت نام</a>

                    <div class="form-controll">
                        <input type="text" name="email" placeholder="ایمیل">
                        <div class="red text-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="green text-success"><i class="fas fa-check-circle"></i></div>
                        <span class="">پیام خطا</span>
                    </div>

                    <button type="submit">ارسال ایمیل بازنشانی رمز عبور</button>
                </form>
            </div>
        </div>
    </section>


    <?php require_once(BASE_PATH . '/template/auth/layouts/script.php'); ?>


</body>

</html>