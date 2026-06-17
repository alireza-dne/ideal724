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
                            <h3 class="fw-bolder mb-1">بخش سفارشات</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد سفارش ها به شما داده می شود
                            </h6>
                        </div>
                        <div>
                            <a href="<?= url('admin/market/order') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">شماره سفارش</th>
                                    <th scope="col">محصول</th>
                                    <th scope="col">تعداد</th>
                                    <th scope="col">قیمت تک</th>
                                    <th scope="col">قیمت کل</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($items as $item) { ?>
                                    <tr class="tr-post-category">
                                        <th scope="row"><?= $item['id'] ?></th>
                                        <td><?= $item['order_id'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= number_format($item['price']) ?></td>
                                        <td><?= number_format($item['total_price']) ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>


    </section>



    <?= require_once(BASE_PATH . "/template/admin/layouts/script.php") ?>


</body>

</html>