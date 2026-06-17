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
                            <h3 class="fw-bolder mb-1">بخش ایجاد پست جدید</h3>
                            <h6 class="mb-5"></h6>

                        </div>

                        <div>
                            <a href="<?= url('admin/content/post') ?>" class="btn btn-outline-warning">بازگشت</a>
                        </div>
                    </div>

                    <div class="body-content">
                        <form class="row g-3" action="<?= url('admin/content/post/store') ?>" method="post"
                            enctype="multipart/form-data">


                            <div class="col-md-6">
                                <label for="name" class="form-label">نام</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="<?= old('name') ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="slug" class="form-label">slug</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="slug"
                                    value="<?= old('slug') ?>">
                            </div>


                            <div class="col-md-12">
                                <label for="summary" class="form-label">خلاصه پست</label>
                                <textarea name="summary" class="form-control"
                                    id="summary"><?= old('summary') ?></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="body" class="form-label"> محتوا پست</label>
                                <textarea name="body" class="form-control" id="body"><?= old('body') ?></textarea>
                            </div>


                            <div class="col-md-6">
                                <label for="status" class="form-label">وضعیت</label>
                                <select class="form-select" name="status" id="status">
                                    <option value="1" <?= old('status') == 1 ? 'selected' : '' ?>>فعال</option>
                                    <option value="2" <?= old('status') == 2 ? 'selected' : '' ?>>غیر فعال</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="commentable" class="form-label">وضعیت کامنت</label>
                                <select class="form-select" name="commentable" id="commentable">
                                    <option value="1" <?= old('commentable') == 1 ? 'selected' : '' ?>>فعال</option>
                                    <option value="2" <?= old('commentable') == 2 ? 'selected' : '' ?>>غیر فعال</option>
                                </select>
                            </div>



                            <div class="col-md-6">
                                <label for="post_category_id" class="form-label">دسته بندی </label>
                                <select class="form-select" name="post_category_id" id="post_category_id">
                                    <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category['id'] ?>"
                                        <?= old('post_category_id') == $category['id'] ? 'selected' : '' ?>>
                                        <?= $category['name'] ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="published_at">زمان انتشار</label>
                                <input type="text" class="form-control d-none" id="published_at" name="published_at">

                                <input data-jdp type="text" class="form-control" id="published_at_view"
                                    value="<?= old('published_at') ?>">
                            </div>



                            <div class="mb-3 col-md-12">
                                <label for="image" class="form-label">عکس</label>
                                <input class="form-control" name="image" type="file" id="image">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success w-100">ثبت</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </section>


    <?php require_once(BASE_PATH . '/template/admin/layouts/script.php'); ?>

    <script>
    $(document).ready(function() {
        // CKEDITOR.replace('summary');
        // CKEDITOR.replace('body');

        $("#published_at_view").persianDatepicker({
            format: 'YYYY/MM/DD HH:mm',
            altField: "#published_at",
            timePicker: {
                enabled: true
            }
        });

    });
    </script>
</body>

</html>