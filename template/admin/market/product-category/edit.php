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
                            <h3 class="fw-bolder mb-1">بخش اصلاح دسته بندی محصولات</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/market/product-category') ?>"
                                class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3"
                            action="<?= url('admin/market/product-category/update/' . $category['id']) ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="name" class="form-label">نام</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="<?= $category['name'] ?>">
                            </div>
                            <div class="col-6">
                                <label for="slug" class="form-label">slug</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="slug"
                                    value="<?= $category['slug'] ?>">
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">توضیحات</label>
                                <input type="text" name="description" class="form-control" id="description"
                                    value="<?= $category['description'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="show_in_menu" class="form-label">وضعیت نمایش در منو</label>
                                <select class="form-select" name="show_in_menu" id="show_in_menu">
                                    <option value="1" <?= $category['show_in_menu'] == 1 ? 'selected' : '' ?>>فعال
                                    </option>
                                    <option value="2" <?= $category['show_in_menu'] == 2 ? 'selected' : '' ?>>غیر فعال
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="parent_id" class="form-label">دسته والد</label>
                                <select class="form-select" name="parent_id" id="parent_id">
                                    <option value="parent"> --اصلی-- </option>
                                    <?php foreach ($categories as $cat) { ?>
                                        <option value="<?= $cat['id'] ?>"
                                            <?= $cat['id'] == $category['parent_id'] ? 'selected' : '' ?>>
                                            <?= $cat['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">عکس</label>
                                <input class="form-control" name="image" type="file" id="image">
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">وضعیت</label>
                                <select class="form-select" name="status" id="status">
                                    <option value="1" <?= $category['status'] == 1 ? 'selected' : '' ?>>فعال</option>
                                    <option value="2" <?= $category['status'] == 2 ? 'selected' : '' ?>>غیر فعال
                                    </option>
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