<?php

use Database\DataBase;

if (isset($_SESSION['user'])) {

    $db = new Database;
    $adminUser = $db->select("select * from users where id=? and is_active=1 and permission='admin'", [$_SESSION['user']])->fetch();
}

?>

<div class="container">
    <nav class="d-flex justify-content-between align-items-center">
        <div class="right d-flex align-items-center">
            <div class="bars cursor-pointer">
                <div></div>
            </div>

            <div class="search-box d-flex align-items-center" data-target="<?= url('header-search-box') ?>"
                data-url="<?= url('product/') ?>">
                <input type="text" placeholder="جستجو در محصولات">
                <span class="cursor-pointer fs-5 color ms-2 search-icon position-relative"><i
                        class="fas fa-search"></i></span>

                <ul class="search-result">
                    <li><span class="fas fa-link"></span>موردی یافت نشد</li>
                </ul>
            </div>
        </div>

        <div class="left d-flex align-items-center">
            <?php if (isset($_SESSION['user'])) { ?>
                <div class="profile-header position-relative">
                    <span class="me-4 text-white cursor-pointer profile-icon"><i class="fas fa-user"></i></span>

                    <ul class="profile-dropdown position-absolute p-2 rounded top-100 box-shadow">
                        <li class="d-flex align-items-center gap-2 p-1 rounded"><i
                                class="fas fa-user-circle text-white py-2"></i><a href="<?= url('my-profile') ?>"
                                class="text-white d-flex w-100">پروفایل کاربری</a></li>


                        <li class="d-flex align-items-center gap-2 p-1 rounded mb-2"><i
                                class="fas fa-bag-shopping text-white"></i><a href="<?= url('order/1') ?>"
                                class="text-white d-flex w-100">ثبت
                                سفارش</a></li>



                        <?php if ($adminUser) { ?>
                            <li class="d-flex align-items-center gap-2 border-top p-1 rounded"><i
                                    class="fas fa-user-cog text-white py-2"></i><a href="<?= url('admin') ?>"
                                    class="text-white d-flex w-100">پنل ادمین</a></li>

                        <?php } ?>

                        <li class="d-flex align-items-center gap-2 border-top p-1 rounded"><i
                                class="fas fa-sign-out-alt text-white py-2"></i><a href="<?= url('logout') ?>"
                                class="text-white d-flex w-100">خروج</a></li>
                    </ul>
                </div>

            <?php } else { ?>
                <a href="<?= url('login-register') ?>" class="login-register me-4">ورود / ثبت نام</a>
            <?php } ?>



            <a href="<?= url('/') ?>" class="d-flex align-items-center">
                <img src="<?= asset($setting['icon']) ?>" alt="">
                <img src="<?= asset($setting['logo']) ?>" alt="">
            </a>
        </div>
    </nav>
</div>


<section class="navbar-responsive position-fixed text-white p-3">
    <span class="text-white fs-2 close-menu cursor-pointer"><i class="fas fa-times"></i></span>
    <div class="menu-icon text-center pt-2 pb-4">
        <img class="w-25" src="public/app/assets/img/icon.svg" alt="">
    </div>

    <h4 class="fs-4 mt-2">خدمات و محصولات</h4>

    <ul class="category-one">
        <li href="" class="cursor-pointer"><a href="<?= url('/') ?>" class="">خانه</a></li>

        <?php foreach ($productCategories as $productCategory) {
            if ($productCategory['parent_id'] == null) {
        ?>
                <li class="cursor-pointer"><?= $productCategory['name'] ?>
                    <ul class="category-two">

                        <?php foreach ($productCategories as $productCategoryTwo) {
                            if ($productCategoryTwo['parent_id'] == $productCategory['id']) {
                        ?>
                                <li><a
                                        href="<?= url('product-category/' . $productCategoryTwo['id']) ?>"><?= $productCategoryTwo['name'] ?></a>
                                </li>

                        <?php }
                        } ?>
                    </ul>
                </li>
        <?php }
        } ?>
        <li href="" class="cursor-pointer"><a href="<?= url('brands') ?>" class="">برند ها</a></li>

        <li href="" class="cursor-pointer"><a href="<?= url('about-us') ?>" class="">درباره ما</a></li>

    </ul>
</section>