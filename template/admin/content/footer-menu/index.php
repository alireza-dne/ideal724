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
                            <h3 class="fw-bolder mb-1">بخش Footer Menu</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد منوهای Footer به شما نمایش داده می شود</h6>
                        </div>

                        <a href="<?= url('admin/content/footer-menu/create') ?>"
                            class="btn btn-outline-success">ایجاد</a>
                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">ردیف</th>
                                    <th scope="col">url</th>
                                    <th scope="col">منو والد</th>
                                    <th scope="col">تنظیمات</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($FooterMenus as $FooterMenu) { ?>
                                <tr class="ajax-delete">
                                    <th scope="row"><?= $FooterMenu['id'] ?></th>
                                    <td><?= $FooterMenu['name'] ?></td>
                                    <td><?= $FooterMenu['row'] ?></td>
                                    <td><?= $FooterMenu['url'] ?></td>
                                    <td><?= $FooterMenu['parent_name'] == '' ? '-' : $FooterMenu['parent_name'] ?>
                                    </td>


                                    <td>
                                        <div>
                                            <button class="text-danger btn btn-sm btn-ajax-delete"
                                                targetUrl="<?= url('admin/content/footer-menu/delete/' . $FooterMenu['id']) ?>"><i
                                                    class="fas fa-trash"></i></button>

                                            <a href="<?= url('admin/content/footer-menu/edit/' . $FooterMenu['id']) ?>"
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