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
                            <h3 class="fw-bolder mb-1">بخش کاربران عادی</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد کاربران عادی به شما نمایش داده می شود</h6>
                        </div>


                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نام کاربری</th>
                                    <th scope="col" class="d-flex flex-row align-items-baseline">

                                        <input type="text" placeholder="ایمیل" class="title-table-searcher"
                                            targetUrl="<?= url('admin/user/user/title-search') ?>"
                                            baseUrl="<?= BASE_URL ?>">

                                        <i class="fas fa-search"></i>

                                    </th>
                                    <th scope="col">تنظیمات</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($users as $user) { ?>
                                <tr class="ajax-delete">
                                    <th scope="row"><?= $user['id'] ?></th>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td>
                                        <div>

                                            <a href="<?= url('admin/user/user/edit/' . $user['id']) ?>"
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