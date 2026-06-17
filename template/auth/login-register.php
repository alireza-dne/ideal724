<?php require_once(BASE_PATH . '/template/auth/layouts/head-tag.php'); ?>


<body>



    <section class="login-register d-flex flex-column">
        <?php require_once(BASE_PATH . '/template/admin/layouts/partials/error.php'); ?>
        <?php require_once(BASE_PATH . '/template/admin/layouts/partials/success.php'); ?>
        <div class="login-register-box">
            <div class="top login">
                <button class="login-btn active">ورود</button>
                <button class="register-btn">ثبت نام</button>

                <div class="changer"></div>
            </div>

            <ul class="social d-flex justify-content-center gap-4 m-4">
                <li><a href="<?= $setting['instagram'] ?>" class="instagram-colorfull"><i
                            class="fab fa-instagram"></i></a></li>
                <li><a href="<?= $setting['telegram'] ?>" class="telegram-colorfull"><i class="fab fa-telegram"></i></a>
                </li>
            </ul>


            <div class="form-box mt-5">
                <form action="<?= asset('login') ?>" class="login-form d-flex flex-column gap-4" method="post"
                    loginTarget="<?= url('/') ?>">

                    <a href="<?= url('forget-password') ?>" class="">فراموشی رمز عبور</a>

                    <div class="form-controll">
                        <input type="text" name="email" placeholder="ایمیل">
                        <div class="red text-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="green text-success"><i class="fas fa-check-circle"></i></div>
                        <span>پیام خطا</span>
                    </div>

                    <div class="form-controll">
                        <input type="password" name="password" placeholder="رمز عبور">
                        <div class="red"></div>
                        <div class="green"></div>
                        <div class="red text-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="green text-success"><i class="fas fa-check-circle"></i></div>
                        <span>پیام خطا</span>
                    </div>

                    <p class="final-message-login"></p>


                    <button type="submit">ورود</button>
                </form>


                <form action="<?= asset('register-store') ?>" class="register-form d-flex flex-column gap-4"
                    method="post" RegisterTarget="<?= url('login-register') ?>">
                    <div class="form-controll">
                        <input type="text" name="email" placeholder="ایمیل">
                        <div class="red text-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="green text-success"><i class="fas fa-check-circle"></i></div>
                        <span>پیام خطا</span>
                    </div>

                    <div class="form-controll">
                        <input type="text" name="username" placeholder="نام و نام خانوادگی">
                        <div class="red text-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="green text-success"><i class="fas fa-check-circle"></i></div>
                        <span>پیام خطا</span>
                    </div>

                    <div class="form-controll">
                        <input type="password" name="password" placeholder="رمز عبور">
                        <div class="red text-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="green text-success"><i class="fas fa-check-circle"></i></div>
                        <span>پیام خطا</span>
                    </div>

                    <div class="form-controll">
                        <input type="password" name="confirm-password" placeholder="تکرار رمز عبور">
                        <div class="red text-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="green text-success"><i class="fas fa-check-circle"></i></div>
                        <span>پیام خطا</span>
                    </div>

                    <p class="final-message-register"></p>

                    <button type="submit">ثبت نام</button>
                </form>


            </div>
        </div>
    </section>


    <?php require_once(BASE_PATH . '/template/auth/layouts/script.php'); ?>

</body>

</html>