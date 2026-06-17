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
                            <h3 class="fw-bolder mb-1">بخش نمایش جزئیات محصول</h3>
                            <h6 class="mb-5"></h6>
                        </div>

                        <div>

                            <a href="<?= url('admin/market/product') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>


                    </div>

                    <div class="body-content">
                        <?php if ($product != null) { ?>
                        <table class="table table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">ویژگی</th>
                                    <th scope="col">مقدار</th>
                                    <th scope="col">تاثیر بر قیمت</th>
                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">

                                <?php
                                    foreach ($categoryAttributeValues as $categoryAttributeValue) {
                                        $categoryAttributeValue['value'] = json_decode($categoryAttributeValue['value'], true);

                                    ?>
                                <tr>
                                    <th><?php
                                                foreach ($categoryAttributes as $categoryAttribute) {

                                                    if ($categoryAttributeValue['category_attribute_id'] == $categoryAttribute['id']) {
                                                        echo $categoryAttribute['name'];
                                                    }
                                                }
                                                ?></th>
                                    <td>

                                        <?= $categoryAttributeValue['value']['value'] ?>
                                    </td>
                                    <td> <?= $categoryAttributeValue['value']['increase_price'] ?></td>

                                </tr>

                                <?php
                                    } ?>

                            </tbody>
                        </table>

                        <?php } ?>

                    </div>

                </div>
            </div>
        </section>
    </section>


    <?php require_once(BASE_PATH . '/template/admin/layouts/script.php'); ?>


</body>

</html>