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
                            <h3 class="fw-bolder mb-1">بخش ادمین ها</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد ادمین ها به شما نمایش داده می شود</h6>
                        </div>


                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نام کاربری</th>
                                    <th scope="col">ایمیل</th>
                                    <th scope="col">تنظیمات</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($admins as $admin) { ?>
                                <tr class="ajax-delete">
                                    <th scope="row"><?= $admin['id'] ?></th>
                                    <td><?= $admin['username'] ?></td>
                                    <td><?= $admin['email'] ?></td>
                                    <td>
                                        <div>

                                            <a href="<?= url('admin/user/admin/edit/' . $admin['id']) ?>"
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