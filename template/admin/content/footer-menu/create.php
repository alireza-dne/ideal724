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
                            <h3 class="fw-bolder mb-1">بخش ایجاد منو footer جدید</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/content/footer-menu') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3" action="<?= url('admin/content/footer-menu/store') ?>" method="post">


                            <div class="col-md-6">
                                <label for="name" class="form-label">نام</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="<?= old('name') ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="row" class="form-label">ردیف</label>
                                <input type="text" name="row" class="form-control" id="row" value="<?= old('row') ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="url" class="form-label">url</label>
                                <input type="text" name="url" class="form-control" id="url" value="<?= old('url') ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="parent_id" class="form-label">دسته بندی </label>
                                <select class="form-select" name="parent_id" id="parent_id">
                                    <option value="parent">-- منو اصلی --</option>
                                    <?php foreach ($FooterMenus as $FooterMenu) {
                                        if ($FooterMenu['parent_id'] == null) { ?>
                                    <option value="<?= $FooterMenu['id'] ?>"
                                        <?= old('parent_id') == $FooterMenu['id'] ? 'selected' : '' ?>>
                                        <?= $FooterMenu['name'] ?>
                                    </option>
                                    <?php }
                                    } ?>
                                </select>
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