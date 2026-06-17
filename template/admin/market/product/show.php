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

                        <div> <a href="<?= url('admin/market/product/edit/' . $product['id']) ?>"
                                class="btn btn-outline-success">ویرایش</a>

                            <a href="<?= url('admin/market/product') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>


                    </div>

                    <div class="body-content">
                        <?php if ($product != null) { ?>
                            <table class="table table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">عنوان</th>
                                        <th scope="col">ویژگی</th>
                                    </tr>
                                </thead>
                                <tbody class="table-searcher-output">
                                    <tr>
                                        <th>#</th>
                                        <td><?= $product['id'] ?></td>
                                    </tr>


                                    <tr>
                                        <th>نام</th>
                                        <td><?= $product['name'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>برند</th>
                                        <td><?= $product['brand_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>دسته</th>
                                        <td><?php foreach ($allCategories as $allCategory) {
                                                echo $allCategory['name'] . ' / ';
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <th>عکس</th>
                                        <td>
                                            <div class="mb-3 col-md-6"><img class="edit-image"
                                                    src="<?= asset($product['image']) ?>" alt="edit-image">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>توضیحات</th>
                                        <td><?= $product['description'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>slug</th>
                                        <td><?= $product['slug'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>تعداد دیده شده</th>
                                        <td><?= $product['view'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>طول</th>
                                        <td><?= $product['length'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>عرض</th>
                                        <td><?= $product['width'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>ارتفاع</th>
                                        <td><?= $product['height'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>وزن</th>
                                        <td><?= $product['weight'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>قیمت</th>
                                        <td><?= number_format($product['price']) ?></td>
                                    </tr>

                                    <tr>
                                        <th>وضعیت</th>
                                        <td><?= $product['status'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>تعداد فروخته شده</th>
                                        <td><?= $product['sold_number'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>تعداد موجودی انبار</th>
                                        <td><?= $product['marketable_number'] ?></td>
                                    </tr>



                                    <tr>
                                        <th>ایجاد کننده</th>
                                        <td><?= $product['username'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>تاریخ ایجاد</th>
                                        <td><?= jalaliData($product['created_at']) ?></td>
                                    </tr>

                                    <tr>
                                        <th>تاریخ بروزرسانی</th>
                                        <td><?= jalaliData($product['updated_at']) ?></td>
                                    </tr>

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