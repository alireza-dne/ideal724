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
                            <h3 class="fw-bolder mb-1">بخش اصلاح اطلاعات انبار محصول</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/market/store') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3" action="<?= url('admin/market/store/update/' . $product['id']) ?>"
                            method="post" enctype="multipart/form-data">


                            <div class="col-md-6">
                                <label for="marketable_number" class="form-label">موجودی انبار</label>
                                <input type="number" min="0" name="marketable_number" class="form-control"
                                    id="marketable_number" value="<?= $product['marketable_number'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="sold_number" class="form-label">تعداد فروخته شده</label>
                                <input type="number" min="0" name="sold_number" class="form-control" id="sold_number"
                                    value="<?= $product['sold_number'] ?>">
                            </div>




                            <div class="mb-3 col-md-6 text-center"><img class="edit-image"
                                    src="<?= asset($product['image']) ?>" alt="edit-image">
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