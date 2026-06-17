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
                            <h3 class="fw-bolder mb-1">بخش تخفیفات</h3>
                            <h6 class="mb-5">در این بخش اطلاعاتی در مورد کدهای تخفیف به شما نمایش داده می شود</h6>
                        </div>

                        <a href="<?= url('admin/market/discount/create') ?>" class="btn btn-outline-success">ایجاد</a>
                    </div>

                    <div class="body-content">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="d-flex flex-row align-items-center">

                                        <input type="text" placeholder="کد تخفیف" class="title-table-searcher"
                                            targetUrl="<?= url('admin/market/discount/title-search-code') ?>"
                                            baseUrl="<?= BASE_URL ?>">

                                        <i class="fas fa-search"></i>

                                    </th>
                                    <th scope="col">مقدار</th>
                                    <th scope="col">نوع</th>
                                    <th scope="col">سقف (تومان)</th>
                                    <th scope="col">نوع استفاده</th>
                                    <th scope="col">وضعیت</th>
                                    <th scope="col">شروع</th>
                                    <th scope="col">پایان</th>
                                    <th scope="col" class="d-flex flex-row align-items-center">

                                        <input type="text" placeholder="کاربر" class="title-table-searcher"
                                            targetUrl="<?= url('admin/market/discount/title-search-user') ?>"
                                            baseUrl="<?= BASE_URL ?>">

                                        <i class="fas fa-search"></i>

                                    </th>
                                    <th scope="col">تنظیمات</th>


                                </tr>
                            </thead>
                            <tbody class="table-searcher-output">
                                <?php foreach ($discounts as $discount) { ?>
                                    <tr class="ajax-delete">
                                        <th scope="row"><?= $discount['id'] ?></th>
                                        <td><?= $discount['code'] ?></td>
                                        <td><?= number_format($discount['amount']) ?></td>
                                        <td><?= $discount['amount_type'] == 1 ? 'درصد' : 'تومان' ?></td>
                                        <td><?= $discount['discount_celling'] == null ? '-' : number_format($discount['discount_celling']) ?>

                                        </td>
                                        <td><?= $discount['type'] == 1 ? 'خصوصی' : 'عمومی' ?></td>
                                        <td><?= $discount['status'] == 1 ? 'فعال' : 'غیر فعال' ?></td>
                                        <td><?= jalaliData($discount['start_date']) ?></td>
                                        <td><?= jalaliData($discount['end_date']) ?></td>
                                        <td><?= $discount['email'] == null ? '-' : $discount['email'] ?></td>

                                        <td>
                                            <div>
                                                <button class="text-danger btn btn-sm btn-ajax-delete"
                                                    targetUrl="<?= url('admin/market/discount/delete/' . $discount['id']) ?>"><i
                                                        class="fas fa-trash"></i></button>

                                                <a href="<?= url('admin/market/discount/edit/' . $discount['id']) ?>"
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