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
                            <h3 class="fw-bolder mb-1">بخش پست ها</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد پست ها به شما نمایش داده می شود</h6>
                        </div>

                        <a href="<?= url('admin/content/post/create') ?>" class="btn btn-outline-success">ایجاد</a>
                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="d-flex flex-row align-items-baseline">

                                        <input type="text" placeholder="عنوان" class="title-table-searcher"
                                            targetUrl="<?= url('admin/content/post/title-search') ?>"
                                            baseUrl="<?= BASE_URL ?>">

                                        <i class="fas fa-search"></i>

                                    </th>
                                    <th scope="col">عکس</th>
                                    <th scope="col">وضعیت</th>
                                    <th scope="col">وضعیت کامنت</th>
                                    <th scope="col">تنظیمات</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($posts as $post) { ?>
                                    <tr class="ajax-delete">
                                        <th scope="row"><?= $post['id'] ?></th>
                                        <td><?= $post['name'] ?></td>
                                        <td><img class="table-image" src="<?= asset($post['image']) ?>" alt="">
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                <h6 class="me-2">فعال</h6>
                                                <div class="checkbox-wrapper-40">
                                                    <label>
                                                        <input targetUrl="<?= url('admin/content/post/change-status') ?>"
                                                            data-status="<?= $post['id'] ?>" type="checkbox"
                                                            class="checkboxStatus cursor-pointer status-changer"
                                                            <?= $post['status'] == 1 ? 'checked' : '' ?>>
                                                        <span class="checkbox"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex ">
                                                <h6 class="me-2">فعال</h6>
                                                <div class="checkbox-wrapper-40">
                                                    <label>
                                                        <input
                                                            targetUrl="<?= url('admin/content/post/change-commentable') ?>"
                                                            data-status="<?= $post['id'] ?>" type="checkbox"
                                                            class="checkboxStatus cursor-pointer status-changer"
                                                            <?= $post['commentable'] == 1 ? 'checked' : '' ?>>
                                                        <span class="checkbox"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div>
                                                <button class="text-danger btn btn-sm btn-ajax-delete"
                                                    targetUrl="<?= url('admin/content/post/delete/' . $post['id']) ?>"><i
                                                        class="fas fa-trash"></i></button>

                                                <a href="<?= url('admin/content/post/edit/' . $post['id']) ?>"
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