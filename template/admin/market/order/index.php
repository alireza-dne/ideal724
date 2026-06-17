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
                            <h3 class="fw-bolder mb-1">بخش سفارشات</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد سفارشات به شما نمایش داده می شود</h6>
                        </div>

                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="d-flex flex-row align-items-baseline">

                                        <input type="text" placeholder="توسط" class="title-table-searcher"
                                            targetUrl="<?= url('admin/market/order/title-search') ?>"
                                            baseUrl="<?= BASE_URL ?>">

                                        <i class="fas fa-search"></i>

                                    </th>
                                    <th scope="col">وضعیت پرداخت</th>
                                    <th scope="col">وضعیت ارسال</th>
                                    <th scope="col">قیمت نهایی</th>
                                    <th scope="col">وضعیت سفارش</th>
                                    <th scope="col">زمان</th>
                                    <th scope="col">تنظیمات</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($orders as $order) { ?>
                                    <tr class="ajax-delete">
                                        <th scope="row"><?= $order['id'] ?></th>
                                        <td><?= $order['email'] ?></td>

                                        <td><?php if ($order['payment_status'] == 1) {
                                                echo 'در انتظار پرداخت';
                                            } elseif ($order['payment_status'] == 2) {
                                                echo 'پرداخت شد';
                                            } else {
                                                echo 'پرداخت نا موفق';
                                            } ?>
                                        </td>


                                        <td><?php if ($order['delivery_status'] == 1) {
                                                echo 'در حال پردازش';
                                            } elseif ($order['delivery_status'] == 2) {
                                                echo 'ارسال شده';
                                            } else {
                                                echo 'بازگشت داده شده';
                                            } ?>
                                        </td>

                                        <td><?= number_format($order['order_final_amount']) ?></td>
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
                                        <td><?= jalaliData($order['created_at']) ?></td>
                                        <td>
                                            <div>


                                                <a href="<?= url('admin/market/order/items/' . $order['id']) ?>"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>


                                                <a href="<?= url('admin/market/order/show/' . $order['id']) ?>"
                                                    class="text-primary mx-2"><i class="fas fa-eye"></i></a>


                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </section>


    <?php require_once(BASE_PATH . '/template/admin/layouts/script.php'); ?>


</body>

</html>