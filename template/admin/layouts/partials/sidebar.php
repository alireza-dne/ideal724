<aside id="sidebar" class="bg-gray active">


    <a href="<?= url('') ?>" class="sidebar-link border-bottom py-4 mb-4">
        <span><i class="fa fa-bag-shopping"></i>اطلس کمپرسور ایده آل</span>
    </a>



    <a href="<?= url('dashboard') ?>" class="sidebar-link">
        <span><i class="fa fa-home-lg-alt"></i>خانه</span>
    </a>

    <h6 class="sidebar-part-title">بخش محتوی</h6>


    <section class="sidebar-dropdown-toggle">
        <div class="sidebar-dropdown-toggle-header cursor-pointer d-flex justify-content-between">
            <a class="cursor-pointer">
                <span><i class="fas fa-chart-bar"></i>پست ها</span>
            </a>

            <span class="chevron-left"><i class="fas fa-chevron-left icon"></i></span>
        </div>

        <ul class="sidebar-dropdown d-flex flex-column gap-2">
            <li class="d-flex align-items-center">
                <a href="<?= url('admin/content/post-category') ?>" class="sub-sidebar-dropdown"><span
                        class="little-icon"><i class="fas fa-angle-double-left"></i></span>دسته بندی پست ها</a>
            </li>


            <li class="d-flex align-items-center">
                <a href="<?= url('admin/content/post') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>پست ها</a>
            </li>


            <li class="d-flex align-items-center">
                <a href="<?= url('admin/content/comment') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>نظرات</a>
            </li>

            <li class="d-flex align-items-center">
                <a href="<?= url('admin/content/banner') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>بنر ها</a>
            </li>

            <li class="d-flex align-items-center">
                <a href="<?= url('admin/content/faq') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>سوالات متداول</a>
            </li>

        </ul>
    </section>



    <section class="sidebar-dropdown-toggle">
        <div class="sidebar-dropdown-toggle-header cursor-pointer d-flex justify-content-between">
            <a class="cursor-pointer">
                <span><i class="fas fa-chart-bar"></i>محصولات (فروشگاه)</span>
            </a>

            <span class="chevron-left"><i class="fas fa-chevron-left icon"></i></span>
        </div>

        <ul class="sidebar-dropdown d-flex flex-column gap-2">
            <li class="d-flex align-items-center">
                <a href="<?= url('admin/market/product-category') ?>" class="sub-sidebar-dropdown"><span
                        class="little-icon"><i class="fas fa-angle-double-left"></i></span>دسته ها</a>
            </li>

            <li class="d-flex align-items-center">
                <a href="<?= url('admin/market/brand') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>برند ها</a>
            </li>

            <li class="d-flex align-items-center">
                <a href="<?= url('admin/market/product') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>محصولات</a>
            </li>
            <li class="d-flex align-items-center">
                <a href="<?= url('admin/market/store') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>انبار</a>
            </li>
            <li class="d-flex align-items-center">
                <a href="<?= url('admin/market/category-attribute') ?>" class="sub-sidebar-dropdown"><span
                        class="little-icon"><i class="fas fa-angle-double-left"></i></span>ویژگی دسته بندی ها</a>
            </li>
            <li class="d-flex align-items-center">
                <a href="<?= url('admin/market/payment') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>پرداخت ها</a>
            </li>
            <li class="d-flex align-items-center">
                <a href="<?= url('admin/market/delivery') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>روش های ارسال</a>
            </li>
            <li class="d-flex align-items-center">
                <a href="<?= url('admin/market/discount') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>تخفیفات</a>
            </li>
            <li class="d-flex align-items-center">
                <a href="<?= url('admin/market/order') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>سفارشات</a>
            </li>
        </ul>
    </section>



    <h6 class="sidebar-part-title">بخش کاربران</h6>


    <section class="sidebar-dropdown-toggle">
        <div class="sidebar-dropdown-toggle-header cursor-pointer d-flex justify-content-between">
            <a class="cursor-pointer">
                <span><i class="fas fa-users"></i> کاربران</span>
            </a>

            <span class="chevron-left"><i class="fas fa-chevron-left icon"></i></span>
        </div>

        <ul class="sidebar-dropdown d-flex flex-column gap-2">
            <li class="d-flex align-items-center">
                <a href="<?= url('admin/user/admin') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>ادمین</a>
            </li>

            <li class="d-flex align-items-center">
                <a href="<?= url('admin/user/user') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>کاربران عادی</a>
            </li>

        </ul>
    </section>


    <h6 class="sidebar-part-title"> تنظیمات</h6>


    <section class="sidebar-dropdown-toggle">
        <div class="sidebar-dropdown-toggle-header cursor-pointer d-flex justify-content-between">
            <a class="cursor-pointer">
                <span><i class="fas fa-cogs"></i> تنظیمات و منو</span>
            </a>

            <span class="chevron-left"><i class="fas fa-chevron-left icon"></i></span>
        </div>

        <ul class="sidebar-dropdown d-flex flex-column gap-2">
            <li class="d-flex align-items-center">
                <a href="<?= url('admin/content/header-menu') ?>" class="sub-sidebar-dropdown"><span
                        class="little-icon"><i class="fas fa-angle-double-left"></i></span>منو header</a>
            </li>

            <li class="d-flex align-items-center">
                <a href="<?= url('admin/content/footer-menu') ?>" class="sub-sidebar-dropdown"><span
                        class="little-icon"><i class="fas fa-angle-double-left"></i></span> منو footer</a>
            </li>

            <li class="d-flex align-items-center">
                <a href="<?= url('admin/setting') ?>" class="sub-sidebar-dropdown"><span class="little-icon"><i
                            class="fas fa-angle-double-left"></i></span>تنظیمات</a>
            </li>

        </ul>
    </section>




</aside>