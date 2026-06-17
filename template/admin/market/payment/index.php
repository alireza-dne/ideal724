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
                            <h3 class="fw-bolder mb-1">بخش پرداخت ها</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد پرداخت ها به شما نمایش داده می شود
                            </h6>
                        </div>

                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">

                                        <input type="text" placeholder="کدپیگیری" class="title-table-searcher"
                                            targetUrl="<?= url('admin/market/category-attribute/title-search') ?>"
                                            baseUrl="<?= BASE_URL ?>">

                                        <i class="fas fa-search"></i>

                                    </th>

                                    <th scope="col"><input type="text" placeholder="کاربر" class="title-table-searcher"
                                            targetUrl="<?= url('admin/market/category-attribute/title-search') ?>"
                                            baseUrl="<?= BASE_URL ?>">

                                        <i class="fas fa-search"></i>
                                    </th>
                                    <th scope="col">مبلغ</th>
                                    <th scope="col">درگاه</th>
                                    <th scope="col">پیغام</th>
                                    <th scope="col">درایور</th>
                                    <th scope="col">کد اختصاصی</th>
                                    <th scope="col">شناسه معامله</th>
                                    <th scope="col">شناسه پیگیری</th>
                                    <th scope="col">تاریخ</th>
                                    <th scope="col">وضعیت</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($payments as $payment) { ?>
                                <tr class="ajax-delete">
                                    <th scope="row"><?= $payment['id'] ?></th>
                                    <th scope="row"><?= $payment['email'] ?></th>

                                    <td><?= $payment['tracking_code'] ?></td>
                                    <td><?= number_format($payment['amount']) ?></td>

                                    <td><?= $payment['gate_way'] ?></td>
                                    <td><?= $payment['message'] ?></td>
                                    <td><?= $payment['driver'] == null ? '-' : $payment['driver'] ?></td>
                                    <td><?= $payment['uuid'] == null ? '-' : $payment['uuid'] ?></td>
                                    <td><?= $payment['transaction_id'] == null ? '-' : $payment['transaction_id'] ?>
                                    </td>
                                    <td><?= $payment['reference_id'] == null ? '-' : $payment['reference_id'] ?></td>

                                    <td><?= jalaliData($payment['created_at']) ?></td>


                                    <td>
                                        <select class="form-select status-changer" aria-label="Default select example"
                                            targetUrl="<?= url('admin/market/payment/change-status') ?>"
                                            data-status="<?= $payment['id'] ?>">
                                            <option value="0" <?= $payment['status'] == '0' ? 'selected' : '' ?>>ورود
                                                به
                                                درگاه پرداخت
                                            </option>
                                            <option value="1" <?= $payment['status'] == '1' ? 'selected' : '' ?>>
                                                پرداخت شده</option>
                                            <option value="2" <?= $payment['status'] == '2' ? 'selected' : '' ?>>
                                                ناموفق
                                            </option>
                                        </select>

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