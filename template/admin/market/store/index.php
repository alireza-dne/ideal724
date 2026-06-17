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
                            <h3 class="fw-bolder mb-1">بخش انبار</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد موجودی و تعداد فروش محصولات به شما نمایش داده
                                می شود</h6>
                        </div>

                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="d-flex flex-row align-items-baseline">

                                        <input type="text" placeholder="نام" class="title-table-searcher"
                                            targetUrl="<?= url('admin/market/store/title-search') ?>"
                                            baseUrl="<?= BASE_URL ?>">

                                        <i class="fas fa-search"></i>

                                    </th>
                                    <th scope="col">عکس</th>
                                    <th scope="col">موجودی</th>
                                    <th scope="col">فروخته شده</th>
                                    <th scope="col">تنظیمات</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($products as $product) { ?>
                                    <tr class="ajax-delete">
                                        <th scope="row"><?= $product['id'] ?></th>
                                        <td><?= $product['name'] ?></td>
                                        <td><img class="table-image" src="<?= asset($product['image']) ?>" alt="">
                                        </td>
                                        <td><?= number_format($product['marketable_number']) ?></td>
                                        <td><?= number_format($product['sold_number']) ?></td>

                                        <td>
                                            <div>

                                                <a href="<?= url('admin/market/store/edit/' . $product['id']) ?>"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>


                                                <a href="<?= url('admin/market/store/add-form/' . $product['id']) ?>"
                                                    class="text-primary mx-2"><i class="fas fa-plus"></i></a>
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