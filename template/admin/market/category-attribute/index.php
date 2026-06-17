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
                            <h3 class="fw-bolder mb-1">بخش ویژگی دسته بندی های محصولات</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد ویژگی دسته بندی ها به شما نمایش داده می شود
                            </h6>
                        </div>

                        <a href="<?= url('admin/market/category-attribute/create') ?>"
                            class="btn btn-outline-success">ایجاد</a>
                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="d-flex flex-row align-items-baseline">

                                        <input type="text" placeholder="نام" class="title-table-searcher"
                                            targetUrl="<?= url('admin/market/category-attribute/title-search') ?>"
                                            baseUrl="<?= BASE_URL ?>">

                                        <i class="fas fa-search"></i>

                                    </th>
                                    <th scope="col">واحد اندازه گیری</th>
                                    <th scope="col">دسته بندی</th>
                                    <th scope="col">تنظیمات</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($categoryAttributes as $categoryAttribute) { ?>
                                    <tr class="ajax-delete">
                                        <th scope="row"><?= $categoryAttribute['id'] ?></th>
                                        <td><?= $categoryAttribute['name'] ?></td>

                                        <td><?= $categoryAttribute['unit'] == null ? '-' : $categoryAttribute['unit'] ?>
                                        </td>



                                        <td><?= $categoryAttribute['product_category_name'] ?></td>


                                        <td>
                                            <div>
                                                <button class="text-danger btn btn-sm btn-ajax-delete"
                                                    targetUrl="<?= url('admin/market/category-attribute/delete/' . $categoryAttribute['id']) ?>"><i
                                                        class="fas fa-trash"></i></button>

                                                <a href="<?= url('admin/market/category-attribute/edit/' . $categoryAttribute['id']) ?>"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>


                                                <a href="<?= url('admin/market/category-attribute-value/' . $categoryAttribute['id']) ?>"
                                                    class="text-primary mx-2"><i class="fas fa-layer-group"></i></a>
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