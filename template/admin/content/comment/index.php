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
                            <h3 class="fw-bolder mb-1">بخش کامنت ها</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد کامنت ها به شما نمایش داده می شود</h6>
                        </div>

                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نظر</th>
                                    <th scope="col">نویسنده</th>
                                    <th scope="col">پست یا محصول</th>
                                    <th scope="col">پاسخ</th>
                                    <th scope="col">وضعیت</th>
                                    <th scope="col">تنظیمات</th>

                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($comments as $comment) { ?>
                                    <tr class="ajax-delete">
                                        <th scope="row"><?= $comment['id'] ?></th>
                                        <td><?= substr($comment['comment'], 0, 80) . ' ...' ?></td>
                                        <td><?= $comment['username'] ?></td>
                                        <td><?= $comment['product_name'] != null ? substr($comment['product_name'], 0, 50) . ' ...' : substr($comment['post_name'], 0, 50) . ' ...' ?>
                                        </td>
                                        <td><?= $comment['parent_id'] == null ? '-' : 'هست' ?></td>


                                        <td>
                                            <select class="form-select status-changer" aria-label="Default select example"
                                                targetUrl="<?= url('admin/content/comment/change-status') ?>"
                                                data-status="<?= $comment['id'] ?>">
                                                <option value="unseen"
                                                    <?= $comment['status'] == 'unseen' ? 'selected' : '' ?>>دیده نشده
                                                </option>
                                                <option value="seen" <?= $comment['status'] == 'seen' ? 'selected' : '' ?>>
                                                    دیده</option>
                                                <option value="approved"
                                                    <?= $comment['status'] == 'approved' ? 'selected' : '' ?>>منتشر شده
                                                </option>
                                            </select>

                                        </td>

                                        <td>
                                            <div>
                                                <a href="<?= url('admin/content/comment/show/' . $comment['id']) ?>"
                                                    class="text-primary mx-2"><i class="fas fa-eye"></i></a>
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