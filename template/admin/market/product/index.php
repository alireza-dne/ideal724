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
                            <h3 class="fw-bolder mb-1">بخش محصولات</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد محصولات به شما نمایش داده می شود</h6>
                        </div>

                        <a href="<?= url('admin/market/product/create') ?>" class="btn btn-outline-success">ایجاد</a>
                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="d-flex flex-row align-items-baseline">

                                        <input type="text" placeholder="نام" class="title-table-searcher"
                                            targetUrl="<?= url('admin/market/product/title-search') ?>"
                                            baseUrl="<?= BASE_URL ?>">

                                        <i class="fas fa-search"></i>

                                    </th>
                                    <th scope="col">عکس</th>
                                    <th scope="col">قیمت</th>
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
                                        <td><?= number_format($product['price']) ?></td>

                                        <td>
                                            <div>
                                                <button class="text-danger btn btn-sm btn-ajax-delete"
                                                    targetUrl="<?= url('admin/market/product/delete/' . $product['id']) ?>"><i
                                                        class="fas fa-trash"></i></button>

                                                <a href="<?= url('admin/market/product/edit/' . $product['id']) ?>"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>


                                                <a href="<?= url('admin/market/product/show/' . $product['id']) ?>"
                                                    class="text-primary mx-2"><i class="fas fa-eye"></i></a>

                                                <a href="<?= url('admin/market/product/table/' . $product['id']) ?>"
                                                    class="text-success mx-2"><i class="fas fa-table"></i></a>

                                                <a href="<?= url('admin/market/product/' . $product['id'] . '/gallery')  ?>"
                                                    class="text-black mx-2"><i class="fas fa-image"></i></a>
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