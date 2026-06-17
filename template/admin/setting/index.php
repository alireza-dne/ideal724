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
                            <h3 class="fw-bolder mb-1">بخش تنظیمات</h3>
                            <h6 class="mb-5"></h6>
                        </div>
                        <?php if ($setting == null) { ?>
                        <a href="<?= url('admin/setting/create') ?>" class="btn btn-outline-success">ایجاد</a>
                        <?php } else { ?>
                        <a href="<?= url('admin/setting/edit/' . $setting['id']) ?>"
                            class="btn btn-outline-success">ویرایش</a>
                        <?php } ?>

                    </div>

                    <div class="body-content">
                        <?php if ($setting != null) { ?>
                        <table class="table table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">عنوان</th>
                                    <th scope="col">ویژگی</th>
                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <tr>
                                    <th>عنوان</th>
                                    <td><?= $setting['title'] ?></td>
                                </tr>

                                <tr>
                                    <th>توضیحات</th>
                                    <td><?= $setting['description'] ?></td>
                                </tr>

                                <tr>
                                    <th>کلمات کلیدی</th>
                                    <td><?= $setting['key_words'] ?></td>
                                </tr>
                                <tr>
                                    <th>تلفن</th>
                                    <td><?= $setting['phone'] ?></td>
                                </tr>

                                <tr>
                                    <th>موبایل</th>
                                    <td><?= $setting['mobile'] ?></td>
                                </tr>

                                <tr>
                                    <th>اینستاگرام</th>
                                    <td><?= $setting['instagram'] ?></td>
                                </tr>
                                <tr>
                                    <th>تلگرام</th>
                                    <td><?= $setting['telegram'] ?></td>
                                </tr>

                                <tr>
                                    <th>لوگو</th>
                                    <td>
                                        <div class="mb-3 col-md-6"><img class="edit-image"
                                                src="<?= asset($setting['logo']) ?>" alt="edit-image">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>آیکون</th>
                                    <td>
                                        <div class="mb-3 col-md-6"><img class="edit-image"
                                                src="<?= asset($setting['icon']) ?>" alt="edit-image">
                                        </div>
                                    </td>
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