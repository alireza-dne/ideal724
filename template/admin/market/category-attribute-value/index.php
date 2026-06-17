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
                            <h3 class="fw-bolder mb-1">بخش مقادیر ویژگی ها ----> <?= $categoryAttribute['name'] ?></h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد مقادیر ویژگی های محصولات به شما نمایش داده می
                                شود
                            </h6>
                        </div>

                        <div><a href="<?= url("admin/market/category-attribute-value/$categoryAttributeID/create") ?>"
                                class="btn btn-outline-success">ایجاد</a>

                            <a href="<?= url('admin/market/category-attribute') ?>"
                                class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">مقدار</th>
                                    <th scope="col">تاثیر قیمت</th>
                                    <th scope="col">محصول</th>

                                    <th scope="col">نوع</th>
                                    <th scope="col">تنظیمات</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($categoryAttributeValues as $categoryAttributeValue) { ?>
                                    <tr class="ajax-delete">
                                        <th scope="row"><?= $categoryAttributeValue['id'] ?></th>



                                        <?php $categoryAttributeValue['value'] = json_decode($categoryAttributeValue['value'], true); ?>




                                        <td><?= $categoryAttributeValue['value']['value'] ?>
                                        </td>
                                        <td><?= number_format($categoryAttributeValue['value']['increase_price']) ?></td>





                                        <td><?= $categoryAttributeValue['product_name'] ?></td>
                                        <td><?= $categoryAttributeValue['type'] == 1 ? 'تکی' : 'چند گانه' ?></td>


                                        <td>
                                            <div>
                                                <button class="text-danger btn btn-sm btn-ajax-delete"
                                                    targetUrl="<?= url('admin/market/category-attribute-value/delete/' . $categoryAttributeValue['id']) ?>"><i
                                                        class="fas fa-trash"></i></button>

                                                <a href="<?= url("admin/market/category-attribute-value/$categoryAttributeID/edit/" . $categoryAttributeValue['id']) ?>"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>

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