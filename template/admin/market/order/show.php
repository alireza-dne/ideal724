<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>admin-panel </title>
    <?= require_once(BASE_PATH . "/template/admin/layouts/head-tag.php") ?>
</head>

<body>


    <?= require_once(BASE_PATH . "/template/admin/layouts/partials/header.php") ?>



    <section class="body-container">

        <?= require_once(BASE_PATH . "/template/admin/layouts/partials/sidebar.php") ?>



        <section class="main-body">

            <div class="row mt-5 p-3">
                <div class="col-12 main-body-container bg-white p-3 rounded">

                    <?php require_once(BASE_PATH . "/template/admin/layouts/partials/success.php") ?>


                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bolder mb-1">بخش جزئیات سفارش</h3>
                            </h6>
                        </div>

                        <div>
                            <a href="<?= url('admin/market/order') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>


                    <div class="body-content">
                        <table class="table table-striped mt-5">

                            <tr>
                                <td>#</td>
                                <td><?= $order['id'] ?></td>
                            </tr>

                            <tr>
                                <td>کاربر</td>
                                <td><?= $order['email'] ?></td>
                            </tr>

                            <tr>
                                <td>قیمت نهایی</td>
                                <td><?= number_format($order['order_final_amount']) ?></td>
                            </tr>

                            <tr>
                                <td>وضعیت ارسال</td>
                                <td><?php if ($order['delivery_status'] == 1) {
                                        echo 'در حال پردازش';
                                    } elseif ($order['delivery_status'] == 2) {
                                        echo 'ارسال شده';
                                    } else {
                                        echo 'بازگشت داده شده';
                                    } ?>
                                </td>
                            </tr>

                            <tr>
                                <td>آدرس</td>
                                <td><?= $order['city_name'] . ' - ' . $order['address'] ?></td>
                            </tr>

                            <tr>
                                <td>وضعیت پرداخت</td>

                                <td><?php if ($order['payment_status'] == 1) {
                                        echo 'در انتظار پرداخت';
                                    } elseif ($order['payment_status'] == 2) {
                                        echo 'پرداخت شد';
                                    } else {
                                        echo 'پرداخت نشده';
                                    } ?></td>
                            </tr>

                            <tr>
                                <td>وضعیت سفارش</td>

                                <td><?php if ($order['order_status'] == 0) {
                                        echo 'در انتظار ';
                                    } elseif ($order['order_status'] == 1) {
                                        echo  'در حال پردازش ';
                                    } elseif ($order['order_status'] == 2) {
                                        echo 'تکمیل شده';
                                    } elseif ($order['order_status'] == 3) {
                                        echo 'رد شده';
                                    } else {
                                        echo 'بازگشت داده شده';
                                    } ?></td>
                            </tr>


                            <tr>
                                <td>پیام پرداخت</td>
                                <td><?= $order['message'] ?></td>
                            </tr>
                            <tr>
                                <td>شناسه پرداخت</td>
                                <td><?= $order['tracking_code'] ?></td>
                            </tr>

                            <tr>
                                <td>روش پرداخت</td>

                                <td><?php if ($order['payment_type'] == 0) {
                                        echo 'آفلاین';
                                    } else {
                                        echo 'آنلاین';
                                    }  ?></td>
                            </tr>



                            <tr>
                                <td>روش ارسال</td>
                                <td><?= $order['delivery_name'] ?></td>
                            </tr>
                            <tr>
                                <td>مبلغ اضافه شده به پرداخت</td>
                                <td><?= $order['delivery_amount'] ?></td>
                            </tr>
                            <tr>
                                <td>زمان تحویل</td>
                                <td><?= jalaliData($order['delivery_date']) ?></td>
                            </tr>
                            <tr>
                                <td>مقدار تخفیف سفارش</td>
                                <td><?= number_format($order['order_discount_amount']) ?></td>
                            </tr>
                            <tr>
                                <td>کد تخفیفات</td>
                                <td><?= $order['code'] == null ? '-' : $order['code'] ?></td>
                            </tr>
                            <tr>
                                <td>کل تخفیف سفارش</td>
                                <td><?= number_format($order['order_total_discount']) ?></td>
                            </tr>
                            <tr>
                                <td>وضعیت سفارش</td>
                                <td><?php if ($order['order_status'] == 0) {
                                        echo 'در انتظار ';
                                    } elseif ($order['order_status'] == 1) {
                                        echo  'در حال پردازش ';
                                    } elseif ($order['order_status'] == 2) {
                                        echo 'تکمیل شده';
                                    } elseif ($order['order_status'] == 3) {
                                        echo 'رد شده';
                                    } else {
                                        echo 'بازگشت داده شده';
                                    } ?></td>
                            </tr>
                            <tr>
                                <td>زمان ایجاد</td>
                                <td><?= $order['created_at'] ?></td>
                            </tr>
                            <tr>
                                <td>زمان به روزرسانی</td>
                                <td><?= $order['updated_at'] ?></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </section>


    </section>



    <?= require_once(BASE_PATH . "/template/admin/layouts/script.php") ?>


</body>

</html>