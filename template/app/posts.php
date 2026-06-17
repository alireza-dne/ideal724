<?php

use Database\DataBase;

require_once(BASE_PATH . '/template/app/layouts/head-tag.php'); ?>


<body>

    <!-- start header -->
    <header class="p-2 none-home">
        <?php require_once(BASE_PATH . '/template/app/layouts/header.php'); ?>
    </header>
    <!-- end header -->



    <!-- start main -->

    <section class="main my-5">

        <div id="category">
            <div class="container">

                <div class="category row box-shadow p-4 position-relative">
                    <div class="category-title d-flex justify-content-between align-items-center border-bottom py-3">
                        <h1 class="fs-5 fw-bolder">مقالات شرکت اطلس کمپرسور ایده آل</h1>

                    </div>


                    <section id="articles">


                        <div class="row article">
                            <?php foreach ($posts as $post) {

                                $db = new DataBase;
                                $comments = $db->select("SELECT COUNT(`id`) AS comments_count FROM comments WHERE status='approved' AND post_id=?", [$post['id']])->fetch();
                                $db->closeConnection();

                            ?>

                                <div class="col-12 col-lg-4 col-sm-6 mt-4">
                                    <div class="article-item">
                                        <div
                                            class="article-item-head color d-flex justify-content-around align-items-center p-2">
                                            <div class="article-item-date d-flex gap-1 align-items-center">
                                                <span class="color2"><i class="fas fa-calendar"></i></span>
                                                <h6><?= jalaliData2($post['published_at']) ?></h6>
                                            </div>

                                            <div class="article-item-view d-flex gap-1 align-items-center">
                                                <span class="color2"><i class="fas fa-eye"></i></span>
                                                <h6><?= $post['view'] ?></h6>
                                            </div>

                                            <div class="article-item-comment d-flex gap-1 align-items-center">
                                                <span class="color2"><i class="fas fa-comment"></i></span>
                                                <h6><?= $comments['comments_count'] ?></h6>
                                            </div>
                                        </div>

                                        <a href="<?= url('post/' . $post['id']) ?>" class="article-item-img">
                                            <img src="<?= asset($post['image']) ?>" alt="">
                                            <span class="fs-2"><i class="fas fa-search"></i></span>
                                        </a>

                                        <div class="article-item-text py-3 px-2">
                                            <h3 class="fs-5 fs-sm fw-bolder mb-3"><?= $post['name'] ?></h3>
                                            <p class="text-muted"><?= substr($post['body'], 0, 100) . ' ...' ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php }  ?>


                        </div>
                    </section>
                </div>


            </div>
        </div>
    </section>


    <?php require_once(BASE_PATH . '/template/app/layouts/other.php'); ?>

    <!-- end main -->



    <!-- start footer -->
    <?php require_once(BASE_PATH . '/template/app/layouts/footer.php'); ?>

    <!-- end footer -->


    <?php require_once(BASE_PATH . '/template/app/layouts/script.php'); ?>



</body>

</html>