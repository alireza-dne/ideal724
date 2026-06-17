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
                            <h3 class="fw-bolder mb-1">بخش ایجاد ویژگی دسته بندی محصول</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/market/category-attribute') ?>"
                                class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3" action="<?= url('admin/market/category-attribute/store') ?>" method="post"
                            enctype="multipart/form-data">


                            <div class="col-md-6">
                                <label for="name" class="form-label">نام</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="<?= old('name') ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="unit" class="form-label">واحد اندازه گیری</label>
                                <input type="text" name="unit" class="form-control" id="unit"
                                    value="<?= old('unit') ?>">
                            </div>


                            <div class="col-md-12">
                                <label for="product_category_id" class="form-label">دسته بندی </label>
                                <select class="form-select" name="product_category_id" id="product_category_id">
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?= $category['id'] ?>"
                                            <?= old('product_category_id') == $category['id'] ? 'selected' : '' ?>>
                                            <?= $category['name'] ?>
                                        </option>
                                    <?php } ?>
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

    <!-- <script>
    $(document).ready(function() {
        CKEDITOR.replace('description');


    });
    </script> -->
</body>

</html>