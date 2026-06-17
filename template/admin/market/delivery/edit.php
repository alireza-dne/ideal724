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
                            <h3 class="fw-bolder mb-1">بخش اصلاح روش ارسال جدید</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/market/delivery') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3" action="<?= url('admin/market/delivery/update/' . $delivery['id']) ?>"
                            method="post" enctype="multipart/form-data">


                            <div class="col-md-6">
                                <label for="name" class="form-label">نام</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="<?= $delivery['name'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="time" class="form-label">زمان</label>
                                <input type="text" name="time" class="form-control" id="time"
                                    value="<?= $delivery['time'] ?>">
                            </div>


                            <div class="col-md-6">
                                <label for="unit" class="form-label">واحد</label>
                                <input type="text" name="unit" class="form-control" id="unit"
                                    value="<?= $delivery['unit'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="amount" class="form-label">هزینه ارسال (تومان)</label>
                                <input type="number" name="amount" class="form-control" id="amount"
                                    value="<?= $delivery['amount'] ?>">
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