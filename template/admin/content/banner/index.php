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
                            <h3 class="fw-bolder mb-1">بخش بنر ها</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد بنر ها به شما نمایش داده می شود</h6>
                        </div>

                        <a href="<?= url('admin/content/banner/create') ?>" class="btn btn-outline-success">ایجاد</a>
                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">عنوان</th>
                                    <th scope="col">عکس</th>
                                    <th scope="col">آدرس</th>
                                    <th scope="col">تنظیمات</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($banners as $banner) { ?>
                                <tr class="ajax-delete">
                                    <th scope="row"><?= $banner['id'] ?></th>
                                    <td><?= $banner['title'] ?></td>
                                    <td><img class="table-image" src="<?= asset($banner['image']) ?>" alt="">
                                    </td>
                                    <td><?= $banner['url'] ?></td>

                                    <td>
                                        <div>
                                            <button class="text-danger btn btn-sm btn-ajax-delete"
                                                targetUrl="<?= url('admin/content/banner/delete/' . $banner['id']) ?>"><i
                                                    class="fas fa-trash"></i></button>

                                            <a href="<?= url('admin/content/banner/edit/' . $banner['id']) ?>"
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