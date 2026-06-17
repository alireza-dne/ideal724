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
                            <h3 class="fw-bolder mb-1">بخش ایجاد بنر جدید</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/content/banner') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3" action="<?= url('admin/content/banner/store') ?>" method="post"
                            enctype="multipart/form-data">


                            <div class="col-md-6">
                                <label for="title" class="form-label">عنوان</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="<?= old('title') ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="position" class="form-label">موقعیت</label>
                                <input type="text" name="position" class="form-control" id="slug"
                                    value="<?= old('position') ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="url" class="form-label">url</label>
                                <input type="text" name="url" class="form-control" id="slug" value="<?= old('url') ?>">
                            </div>


                            <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">عکس</label>
                                <input class="form-control" name="image" type="file" id="image">
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