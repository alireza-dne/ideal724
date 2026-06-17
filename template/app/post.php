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

    <section class="main my-5 py-">

        <div id="post" class="">
            <div class="container">



                <div class="row mt-5" id="single-product-info">
                    <div class="col-12">

                        <?php require_once(BASE_PATH . '/template/admin/layouts/partials/error.php'); ?>
                        <?php require_once(BASE_PATH . '/template/admin/layouts/partials/success.php'); ?>
                        <div class="single-product-info box-shadow p-4">



                            <div class="my-4 post-title row align-items-center">
                                <div class="col-12 col-lg-8">
                                    <h1 class="mb-4 title p-2 my-4 "><?= $post['name'] ?>
                                    </h1>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div
                                        class="article-item-head color d-flex justify-content-around align-items-center p-2 gap-4">
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
                                            <h6><?= sizeof($comments) ?></h6>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="post-body">
                                <img src="<?= asset($post['image']) ?>" alt="" class="w-100 rounded">

                                <p class="mb-5 pb-5"><?= $post['body'] ?></p>
                            </div>


                            <?php if ($post['commentable'] == 1) { ?>
                                <div id="comments">
                                    <h6 class="mb-4 fw-bolder border-bottom py-2">دیدگاه ها</h6>

                                    <div class="set-comment my-5">

                                        <?php if (isset($_SESSION['user'])) { ?>
                                            <form action="<?= url('post-comment-store/' . $post['id']) ?>" method="post"
                                                class=" my-5 d-flex flex-column gap-3">
                                                <label for="comment" class="form-label">دیدگاه خود را در کادر ذیل یادداشت
                                                    فرمایید.</label>
                                                <textarea rows="8" cols="" class="form-control" placeholder="چیزی بنویسید"
                                                    name="comment"></textarea>
                                                <button class="login-register">ارسال نظر</button>
                                            </form>
                                        <?php } else { ?>
                                            <section class="d-flex align-items-center gap-5 my-5">
                                                <p class="text-success fw-bold">جهت ثبت نظر ابتدا وارد شوید. </p>
                                                <a href="<?= url('login-register') ?>" class="login-register">ورود / ثبت نام</a>
                                            </section>
                                        <?php } ?>



                                    </div>

                                    <ul>

                                        <?php foreach ($comments as $comment) {
                                        ?>
                                            <li class=" box-shadow p-4 mt-4">
                                                <div class="comment-body">
                                                    <div class="comment-header d-flex gap-3">
                                                        <span class="text-muted"><?= $comment['username'] ?></span>
                                                        <span><?= jalaliData($comment['updated_at']) ?></span>
                                                    </div>

                                                    <p class="mt-3 text-muted"><?= $comment['comment'] ?></p>

                                                    <?php

                                                    $db = new DataBase;
                                                    $replycomments = $db->select("SELECT * FROM comments WHERE status='approved' AND post_id=? AND parent_id=?", [$post['id'], $comment['id']])->fetchAll();
                                                    $db->closeConnection();

                                                    foreach ($replycomments as $replycomment) {
                                                    ?>

                                                        <div class="comment-reply p-3 ms-4 mt-4">
                                                            <div class="comment-header d-flex gap-3">
                                                                <span class="text-muted">admin</span>
                                                                <span><?= jalaliData($replycomment['updated_at']) ?></span>
                                                            </div>

                                                            <p class="mt-3 text-muted"><?= $replycomment['comment'] ?></p>
                                                        </div>

                                                    <?php } ?>

                                                </div>

                                            </li>
                                        <?php } ?>

                                    </ul>

                                </div>
                            <?php } ?>
                        </div>
                    </div>
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