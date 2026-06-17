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
                            <h3 class="fw-bolder mb-1">بخش اصلاح مقادیر ویژگی محصول</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/market/category-attribute-value/' . $categoryAttributeID) ?>"
                                class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3"
                            action="<?= url("admin/market/category-attribute-value/$categoryAttributeID/update/" . $categoryAttributeValue['id']) ?>"
                            method="post">

                            <?php $categoryAttributeValue['value'] = json_decode($categoryAttributeValue['value'], true); ?>

                            <div class="col-md-6">
                                <label for="value" class="form-label">مقدار</label>
                                <input type="text" name="value" class="form-control" id="value"
                                    value="<?= $categoryAttributeValue['value']['value'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="increase_price" class="form-label">تاثیر قیمت</label>
                                <input type="text" name="increase_price" class="form-control" id="increase_price"
                                    value="<?= $categoryAttributeValue['value']['increase_price'] ?>">
                            </div>


                            <div class="col-md-6">
                                <label for="product_id" class="form-label">محصول</label>
                                <select class="form-select" name="product_id" id="product_id">
                                    <?php foreach ($products as $product) { ?>
                                        <option value="<?= $product['id'] ?>"
                                            <?= $categoryAttributeValue['product_id'] == $product['id'] ? 'selected' : '' ?>>
                                            <?= $product['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="type" class="form-label">حالت</label>
                                <select class="form-select" name="type" id="type">
                                    <option value="1" <?= $categoryAttributeValue['type'] == 1 ? 'selected' : '' ?>>تکی
                                    </option>
                                    <option value="2" <?= $categoryAttributeValue['type'] == 2 ? 'selected' : '' ?>>چند
                                        گانه</option>
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