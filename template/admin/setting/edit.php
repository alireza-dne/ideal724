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



            <div class="row mt-5 p-3">
                <div class="col-12 main-body-container bg-white p-3 rounded">

                    <?php require_once(BASE_PATH . '/template/admin/layouts/partials/error.php'); ?>
                    <?php require_once(BASE_PATH . '/template/admin/layouts/partials/success.php'); ?>

                    <div class="d-flex justify-content-between align-items-center">


                        <div>
                            <h3 class="fw-bolder mb-1">بخش اصلاح تنظیمات</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/setting') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3" action="<?= url('admin/setting/update/' . $setting['id']) ?>"
                            method="post" enctype="multipart/form-data">


                            <div class="col-md-6">
                                <label for="title" class="form-label">عنوان</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="<?= $setting['title'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="key_words" class="form-label">کلمات کلیدی</label>
                                <input type="text" name="key_words" class="form-control" id="key_words"
                                    value="<?= $setting['key_words'] ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label">توضیحات</label>
                                <input type="text" name="description" class="form-control" id="description"
                                    value="<?= $setting['description'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label">تلفن</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    value="<?= $setting['phone'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="mobile" class="form-label">موبایل</label>
                                <input type="text" name="mobile" class="form-control" id="mobile"
                                    value="<?= $setting['mobile'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="telegram" class="form-label">تلگرام</label>
                                <input type="text" name="telegram" class="form-control" id="telegram"
                                    value="<?= $setting['telegram'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="instagram" class="form-label">اینستاگرام</label>
                                <input type="text" name="instagram" class="form-control" id="instagram"
                                    value="<?= $setting['instagram'] ?>">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="logo" class="form-label">لوگو</label>
                                <input class="form-control" name="logo" type="file" id="logo">
                            </div>

                            <div class="mb-3 col-md-6"><img class="edit-image" src="<?= asset($setting['logo']) ?>"
                                    alt="edit-image">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="icon" class="form-label">آیکون</label>
                                <input class="form-control" name="icon" type="file" id="icon">
                            </div>

                            <div class="mb-3 col-md-6"><img class="edit-image" src="<?= asset($setting['icon']) ?>"
                                    alt="edit-image">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success w-100">ثبت</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </section>


    <?php require_once(BASE_PATH . '/template/admin/layouts/script.php'); ?>

</body>

</html>