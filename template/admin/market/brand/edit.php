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
                            <h3 class="fw-bolder mb-1">بخش اصلاح برند</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/market/brand') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3" action="<?= url('admin/market/brand/update/' . $brand['id']) ?>"
                            method="post" enctype="multipart/form-data">


                            <div class="col-md-6">
                                <label for="persian_name" class="form-label">نام</label>
                                <input type="text" name="persian_name" class="form-control" id="persian_name"
                                    value="<?= $brand['persian_name'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="english_name" class="form-label">english name</label>
                                <input type="text" name="english_name" class="form-control" id="english_name"
                                    value="<?= $brand['english_name'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="slug" class="form-label">slug</label>
                                <input type="text" name="slug" class="form-control" id="slug"
                                    value="<?= $brand['slug'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">وضعیت</label>
                                <select class="form-select" name="status" id="status">
                                    <option value="1" <?= $brand['status'] == 1 ? 'selected' : '' ?>>فعال</option>
                                    <option value="2" <?= $brand['status'] == 2 ? 'selected' : '' ?>>غیر فعال
                                    </option>
                                </select>
                            </div>


                            <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">عکس</label>
                                <input class="form-control" name="image" type="file" id="image">
                            </div>

                            <div class="mb-3 col-md-6"><img class="edit-image" src="<?= asset($brand['image']) ?>"
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