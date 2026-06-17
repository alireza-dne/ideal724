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
                            <h3 class="fw-bolder mb-1">بخش اصلاح کد تخفیف</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/market/discount') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3" action="<?= url('admin/market/discount/update/' . $discount['id']) ?>"
                            method="post" enctype="multipart/form-data">


                            <div class="col-md-12">
                                <label for="code" class="form-label">کد</label>
                                <input type="text" name="code" class="form-control" id="code"
                                    value="<?= $discount['code'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="amount" class="form-label">مقدار (صفر نباشد)</label>
                                <input type="text" name="amount" class="form-control" id="amount"
                                    value="<?= $discount['amount'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="amount_type" class="form-label">نوع</label>
                                <select class="form-select" name="amount_type" id="amount_type">
                                    <option value="1" <?= $discount['amount_type'] == 1 ? 'selected' : '' ?>>درصد (%)
                                    </option>
                                    <option value="2" <?= $discount['amount_type'] == 2 ? 'selected' : '' ?>>تومان
                                    </option>
                                </select>
                            </div>


                            <div class="col-md-6">
                                <label for="discount_celling" class="form-label">سقف (به تومان، بدون جدا کننده)</label>
                                <input type="text" name="discount_celling" class="form-control" id="discount_celling"
                                    value="<?= $discount['discount_celling'] ?>">
                            </div>


                            <div class="col-md-6">
                                <label for="type" class="form-label">نوع استفاده</label>
                                <select class="form-select" name="type" id="type">
                                    <option value="1" <?= $discount['type'] == 1 ? 'selected' : '' ?>>خصوصی</option>
                                    <option value="2" <?= $discount['type'] == 2 ? 'selected' : '' ?>>عمومی</option>
                                </select>
                            </div>


                            <div class="col-md-6">
                                <label for="status" class="form-label">وضعیت</label>
                                <select class="form-select" name="status" id="status">
                                    <option value="1" <?= $discount['status'] == 1 ? 'selected' : '' ?>>فعال</option>
                                    <option value="2" <?= $discount['status'] == 2 ? 'selected' : '' ?>>غیر فعال
                                    </option>
                                </select>
                            </div>


                            <div class="col-md-6">
                                <label for="user_id" class="form-label">کاربر</label>
                                <select class="form-select" name="user_id" id="user_id">

                                    <option value="public"> - </option>

                                    <?php foreach ($users as $user) { ?>
                                        <option value="<?= $user['id'] ?>"
                                            <?= $discount['user_id'] == $user['id'] ? 'selected' : '' ?>>
                                            <?= $user['email'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="start_date">زمان شروع<br>(اگر تاریخ یک روز جلو بود مشکلی ندارد، شما یک روز
                                    جلوتر
                                    انتخاب کنید)</label>
                                <input type="text" class="form-control d-none" id="start_date" name="start_date">

                                <input data-jdp type="text" class="form-control" id="start_date_view"
                                    value="<?= $discount['start_date'] ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="start_date">زمان پایان<br>(اگر تاریخ یک روز جلو بود مشکلی ندارد، شما یک روز
                                    جلوتر
                                    انتخاب کنید)</label>
                                <input type="text" class="form-control d-none" id="end_date" name="end_date">

                                <input data-jdp type="text" class="form-control" id="end_date_view"
                                    value="<?= $discount['end_date'] ?>">
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

    <script>
        $(document).ready(function() {
            $("#start_date_view").persianDatepicker({
                format: 'YYYY/MM/DD HH:mm',
                altField: "#start_date",
                timePicker: {
                    enabled: true
                }
            });


            $("#end_date_view").persianDatepicker({
                format: 'YYYY/MM/DD HH:mm',
                altField: "#end_date",
                timePicker: {
                    enabled: true
                }
            });

        });
    </script>
</body>

</html>