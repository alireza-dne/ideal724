    <footer>
        <div class="container">
            <div class="footer-top row text-white">
                <div class="col-12 col-lg-4 right d-flex flex-column gap-3 pb-4 mt-4 mt-lg-0 mb-4">
                    <div class="address d-flex align-items-center gap-2">
                        <span class="fas fa-location"></span>
                        <p><?= $setting['description'] ?></p>
                    </div>

                    <div class="address d-flex align-items-center gap-2">
                        <span class="fas fa-location-arrow"></span>
                        <p><?= $setting['key_words'] ?></p>
                    </div>

                    <div class="address d-flex align-items-center gap-2">
                        <span class="fas fa-phone-alt"></span>
                        <p>تلفن تماس: <a class="text-white" href="tel:+985136512507"><?= $setting['phone'] ?></a></p>
                    </div>

                    <div class="address d-flex align-items-center gap-2">
                        <span class="fas fa-mobile-android"></span>
                        <p>موبایل: <a class="text-white" href="tel:++989152222646"><?= $setting['mobile'] ?></a></p>
                    </div>

                    <div class="address d-flex align-items-center gap-2">
                        <span class="fas fa-mail-bulk"></span>
                        <p>ایمیل: <a class="text-white" href="mailto:info@ideal724.com">info@ideal724.com</a> - <a
                                class="text-white" href="mailto:acideal1401@gmail.com">acideal1401@gmail.com</a></p>
                    </div>
                </div>

                <ul
                    class="col-12 col-lg-4 social d-flex justify-content-center align-items-center fs-2 gap-4 mt-4 mt-lg-0 mb-4">
                    <li><a href="<?= $setting['instagram'] ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="<?= $setting['telegram'] ?>" target="_blank"><i class="fab fa-telegram"></i></a></li>
                    <li><a href="https://wa.me/+989152222646" target="_blank"><i class="fab fa-whatsapp"
                                target="_blank"></i></a></li>
                </ul>


                <ul class="col-12 col-lg-4 d-flex  gap-2 flex-column mt-4 mt-lg-0 mb-4 footer-menu">
                    <h4 class="fs-5 fw-bold">خدمات و محصولات</h4>

                    <?php foreach ($productCategories as $productCategory) {
                        if ($productCategory['parent_id'] == null) {
                    ?>
                            <li><a
                                    href="<?= url('product-category/' . $productCategory['id']) ?>"><?= $productCategory['name'] ?></a>
                            </li>

                    <?php }
                    } ?>


                </ul>
            </div>

            <div
                class="footer-bottom text-white d-flex flex-row-reverse align-items-center justify-content-center p-4 gap-2 position-relative">
                <span class="fas fa-copyright"></span>
                <p>Created by <a href="https://www.instagram.com/Alireza_DNE/" target="_blank">Alireza_DNE</a></p>
            </div>
        </div>
    </footer>