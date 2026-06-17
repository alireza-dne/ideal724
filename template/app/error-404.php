<?php require_once(BASE_PATH . '/template/app/layouts/head-tag.php'); ?>

<body>

    <div class="error-404 d-flex flex-column justify-content-center align-items-center text-white gap-3">
        <h1 class="">404</h1>
        <p class="fs-1">صفحه مورد نظر شما پیدا نشد!</p>
        <a class="login-register" href="<?= url('/') ?>">برگشت به خانه</a>
    </div>



    <?php require_once(BASE_PATH . '/template/app/layouts/script.php'); ?>




</body>

</html>