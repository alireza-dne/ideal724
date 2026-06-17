<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <title>ادمین ایده آل</title>


    <?php require_once(BASE_PATH . '/template/admin/layouts/head-tag.php'); ?>

<body>

    <?php require_once(BASE_PATH . '/template/admin/layouts/partials/header.php'); ?>


    <section class="body-container">

        <?php require_once(BASE_PATH . '/template/admin/layouts/partials/sidebar.php'); ?>


        <section class="main-body ">
            <section class="row">
                <div class="col-12 col-lg-3 col-md-6 mt-4">
                    <a href="<?= url('admin/content/comment') ?>" class="card bg-custom-yellow text-white">
                        <div class="card-body d-flex justify-content-between pb-5">
                            <div class="card-body-desc">
                                <h5><?= $unseenComments['count'] ?></h5>
                                <h6>کامنت دیده نشده</h6>
                            </div>
                            <span class="fs-3 fw-bolder "><i class="fas fa-chart-line"></i></span>
                        </div>

                        <div class="card-footer d-flex align-items-center">
                            <span class="card-footer-clock me-2"><i class="fas fa-clock"></i></span>
                            <span>به روز رسانی شده <span class="card-footer-time"></span></span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-lg-3 col-md-6 mt-4">
                    <a href="<?= url('admin/user/user') ?>" class="card bg-custom-green text-white">
                        <div class="card-body d-flex justify-content-between pb-5">
                            <div class="card-body-desc">
                                <h5><?= $users['count'] ?></h5>
                                <h6>کاربران فعال</h6>
                            </div>
                            <span class="fs-3 fw-bolder "><i class="fas fa-chart-line"></i></span>
                        </div>

                        <div class="card-footer d-flex align-items-center">
                            <span class="card-footer-clock me-2"><i class="fas fa-clock"></i></span>
                            <span>به روز رسانی شده <span class="card-footer-time"></span></span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-lg-3 col-md-6 mt-4">
                    <a href="<?= url('admin/content/post') ?>" class="card bg-custom-pink text-white">
                        <div class="card-body d-flex justify-content-between pb-5">
                            <div class="card-body-desc">
                                <h5><?= $posts['count'] ?></h5>
                                <h6> پست ها</h6>
                            </div>
                            <span class="fs-3 fw-bolder "><i class="fas fa-chart-line"></i></span>
                        </div>

                        <div class="card-footer d-flex align-items-center">
                            <span class="card-footer-clock me-2"><i class="fas fa-clock"></i></span>
                            <span>به روز رسانی شده <span class="card-footer-time"></span></span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-lg-3 col-md-6 mt-4">
                    <a href="<?= url('admin/market/product') ?>" class="card bg-custom-blue text-white">
                        <div class="card-body d-flex justify-content-between pb-5">
                            <div class="card-body-desc">
                                <h5><?= $products['count'] ?></h5>
                                <h6> محصولات</h6>
                            </div>
                            <span class="fs-3 fw-bolder "><i class="fas fa-chart-line"></i></span>
                        </div>

                        <div class="card-footer d-flex align-items-center">
                            <span class="card-footer-clock me-2"><i class="fas fa-clock"></i></span>
                            <span>به روز رسانی شده <span class="card-footer-time"></span></span>
                        </div>
                    </a>
                </div>

                <!-- <div class="col-12 col-lg-3 col-md-6 mt-4">
                    <a href="#" class="card bg-danger text-white">
                        <div class="card-body d-flex justify-content-between pb-5">
                            <div class="card-body-desc">
                                <h5>30,200 تومان</h5>
                                <h6>سود خالص</h6>
                            </div>
                            <span class="fs-3 fw-bolder "><i class="fas fa-chart-line"></i></span>
                        </div>

                        <div class="card-footer d-flex align-items-center">
                            <span class="card-footer-clock me-2"><i class="fas fa-clock"></i></span>
                            <span>به روز رسانی شده در <span class="card-footer-time">21:42 بعد از ظهر</span></span>
                        </div>
                    </a>
                </div>


                <div class="col-12 col-lg-3 col-md-6 mt-4">
                    <a href="#" class="card bg-success text-white">
                        <div class="card-body d-flex justify-content-between pb-5">
                            <div class="card-body-desc">
                                <h5>30,200 تومان</h5>
                                <h6>سود خالص</h6>
                            </div>
                            <span class="fs-3 fw-bolder "><i class="fas fa-chart-line"></i></span>
                        </div>

                        <div class="card-footer d-flex align-items-center">
                            <span class="card-footer-clock me-2"><i class="fas fa-clock"></i></span>
                            <span>به روز رسانی شده در <span class="card-footer-time">21:42 بعد از ظهر</span></span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-lg-3 col-md-6 mt-4">
                    <a href="#" class="card bg-warning text-white">
                        <div class="card-body d-flex justify-content-between pb-5">
                            <div class="card-body-desc">
                                <h5>30,200 تومان</h5>
                                <h6>سود خالص</h6>
                            </div>
                            <span class="fs-3 fw-bolder "><i class="fas fa-chart-line"></i></span>
                        </div>

                        <div class="card-footer d-flex align-items-center">
                            <span class="card-footer-clock me-2"><i class="fas fa-clock"></i></span>
                            <span>به روز رسانی شده در <span class="card-footer-time">21:42 بعد از ظهر</span></span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-lg-3 col-md-6 mt-4">
                    <a href="#" class="card bg-primary text-white">
                        <div class="card-body d-flex justify-content-between pb-5">
                            <div class="card-body-desc">
                                <h5>30,200 تومان</h5>
                                <h6>سود خالص</h6>
                            </div>
                            <span class="fs-3 fw-bolder "><i class="fas fa-chart-line"></i></span>
                        </div>

                        <div class="card-footer d-flex align-items-center">
                            <span class="card-footer-clock me-2"><i class="fas fa-clock"></i></span>
                            <span>به روز رسانی شده در <span class="card-footer-time">21:42 بعد از ظهر</span></span>
                        </div>
                    </a>
                </div> -->
            </section>


            <div class="row mt-5 p-3">
                <div class="col-12 main-body-container bg-white p-3 rounded">
                    <h3 class="fw-bolder mb-1">اطلس کمپرسور ایده آل</h3>
                    <h6 class="mb-5">در این بخش خلاصه ای از اطلاعات پنل ادمین شرکت اطلس کمپرسور ایده آل به شما داده می
                        شود.</h6>


                    <!-- <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                        مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                        کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان
                        را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و
                        فرهنگ پیشرو در زبان فارسی ایجاد کرد. در
                        این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان
                        رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد.</p> -->
                </div>
            </div>
        </section>
    </section>


    <?php require_once(BASE_PATH . '/template/admin/layouts/script.php'); ?>


</body>

</html>