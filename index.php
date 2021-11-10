<?php session_start(); ?>

<!-- // Including functions -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php'); ?>

<!-- Including head -->
<?php include(dirname(__FILE__) . '/app/includes/head.php'); ?>

<!-- Including post controller -->
<?php include(dirname(__FILE__) . '/app/controllers/listAllPosts.php'); ?>

<body>

    <!-- Including the header -->
    <?php include(dirname(__FILE__) . '/app/includes/header.php'); ?>

    <div class="main-container">

        <div class="featured-post-wrapper">

            <?php foreach ($randomPosts as $post) : ?>
                <div style=<?= "background-image:url(" . BASE_URL . "/assets/images/posts/" . $post['image'] . ")" ?> class="featured-post-card">
                    <div class="post-overlay"></div>
                    <div class="post-topic-info">
                        <a class="post-category topic-link" data-id= <?= $post['topic_id'] ?> href="#"><?= $post['name'] ?></a>
                        <span><?= dateFormate($post['created_at']) ?> </span>
                    </div>
                    <h3><a class="featured-post-title" href=<?= BASE_URL . "/singlePost.php?post-id=" . $post['0'] ?>><?= $post['title'] ?></a></h3>
                </div>

            <?php endforeach; ?>
        </div>

        <h2 class="recent-posts">Most Read Posts</h2>

        <div class="card-wrapper">

            <?php foreach ($mostViewedPost as $post) : ?>

                <?php if ($post['published']) : ?>
                    <div class="post-card">
                        <img src=<?= BASE_URL . "/assets/images/posts/" . $post['image'] ?> alt="">
                        <div class="topic-date-info">
                            <a href='#' class="post-category topic-link" data-id= <?= $post['topic_id'] ?> href="#"><?= $post['name'] ?></a>
                            <span class="published-date"><?= dateFormate($post['created_at']) ?></span>
                        </div>
                        <h3> <a href=<?= BASE_URL . "/singlePost.php?post-id=" . $post['0'] ?>> <?= limitText($post['title'], 70) ?> </a></h3>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>

        </div>

        <section class="most-read-section">

            <div class="post-content">

                <h1>Recent Posts</h1>

                <div class="single-post-wrapper">
                    <div class="post-wrapper">
                    <?php if($posts):?>
                        <?php foreach ($posts as $post) : ?>
                            <?php if ($post['published']) : ?>
                                <div class="single-post-card">
                                    <img src=<?= BASE_URL . "/assets/images/posts/" . $post['image'] ?> alt="">
                                    <div class="single-card-info">
                                        <div class="single-card-topic">
                                            <a class="post-category " href="#"><?= $post['name'] ?></a> <span class="published-date"><?= dateFormate($post['created_at']) ?></span>
                                        </div>
                                        <a class="single-post-title" href=<?= BASE_URL . "/singlePost.php?post-id=" . $post['0'] ?>><?= $post['title'] ?></a>
                                        <p><?= limitText($post['body'], 300); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif;?>
                        <div class="add-more-wrapper">
                            <button id="load-more" data-id=<?= $post['0'] ?>>Load More</button>
                        </div>
                    </div>

                </div>
            </div>
            <?php include(dirname(__FILE__) . '/app/includes/topicSideBar.php'); ?>
        </section>
    </div>

    <!-- Including the footer -->
    <?php include(dirname(__FILE__) . '/app/includes/footer.php'); ?>

</body>

</html>