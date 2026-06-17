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
                            <h3 class="fw-bolder mb-1">بخش اصلاح محصول</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/market/product') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3" action="<?= url('admin/market/product/update/' . $product['id']) ?>"
                            method="post" enctype="multipart/form-data">


                            <div class="col-md-6">
                                <label for="name" class="form-label">نام</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="<?= $product['name'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="slug" class="form-label">slug</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="slug"
                                    value="<?= $product['slug'] ?>">
                            </div>


                            <div class="col-md-12">
                                <label for="description" class="form-label"> محتوا محصول</label>
                                <textarea name="description" class="form-control"
                                    id="description"><?= $product['description'] ?></textarea>
                            </div>




                            <div class="col-md-3 col-6">
                                <label for="width" class="form-label">عرض</label>
                                <input type="text" name="width" class="form-control" id="width"
                                    value="<?= $product['width'] ?>">
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="height" class="form-label">ارتفاع</label>
                                <input type="text" name="height" class="form-control" id="height"
                                    value="<?= $product['height'] ?>">
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="length" class="form-label">طول</label>
                                <input type="text" name="length" class="form-control" id="length"
                                    value="<?= $product['length'] ?>">
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="weight" class="form-label">وزن</label>
                                <input type="text" name="weight" class="form-control" id="weight"
                                    value="<?= $product['weight'] ?>">
                            </div>



                            <div class="col-md-6">
                                <label for="price" class="form-label">قیمت (تومان)</label>
                                <input type="number" name="price" class="form-control" id="price" min="0"
                                    value="<?= $product['price'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">وضعیت</label>
                                <select class="form-select" name="status" id="status">
                                    <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>فعال</option>
                                    <option value="2" <?= $product['status'] == 2 ? 'selected' : '' ?>>غیر فعال</option>
                                </select>
                            </div>



                            <div class="col-md-6">
                                <label for="brand_id" class="form-label">برند</label>
                                <select class="form-select" name="brand_id" id="brand_id">
                                    <?php foreach ($brands as $brand) { ?>
                                        <option value="<?= $brand['id'] ?>"
                                            <?= $product['brand_id'] == $brand['id'] ? 'selected' : '' ?>>
                                            <?= $brand['english_name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="col-md-6">
                                <label for="product_category_id" class="form-label">دسته بندی </label>
                                <select class="form-select" name="product_category_id" id="product_category_id">
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?= $category['id'] ?>"
                                            <?= $product['product_category_id'] == $category['id'] ? 'selected' : '' ?>>
                                            <?= $category['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>



                            <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">عکس</label>
                                <input class="form-control" name="image" type="file" id="image">
                            </div>

                            <div class="mb-3 col-md-6"><img class="edit-image" src="<?= asset($product['image']) ?>"
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

    <!-- <script>
    $(document).ready(function() {
        CKEDITOR.replace('description');


    });
    </script> -->
</body>

</html>