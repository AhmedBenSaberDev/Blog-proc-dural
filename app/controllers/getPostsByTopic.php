<?php

// Including database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

// Including database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/path.php');

// Including functions 
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');


if (isset($_POST['id'])) {
    $req = $pdo->prepare('SELECT * FROM posts INNER JOIN topics ON  topics.id = posts.topic_id WHERE topic_id = ? ORDER BY posts.id ASC ');
    $req->execute([$_POST['id']]);
    $posts = $req->fetchAll();
}
?>

<?php if($posts):?>
<h1><?= $posts[0]['name'] ?></h1>

<div class="single-post-wrapper">

    <div class="post-wrapper">
        <?php foreach ($posts as $post) : ?>
            <?php if ($post['published']) : ?>
                <div class="single-post-card">
                    <img src=<?= BASE_URL . "/assets/images/posts/" . $post['image'] ?> alt="">
                    <div class="single-card-info">
                        <div class="single-card-topic">
                            <a class="post-category" href=""><?= $post['name'] ?></a> <span class="published-date"><?= dateFormate($post['created_at']) ?></span>
                        </div>
                        <a class="single-post-title" href=<?= BASE_URL . "/singlePost.php?post-id=" . $post['0'] ?>><?= limitText($post['title'],50)  ?></a>
                        <p><?= limitText($post['body'], 300); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    
        <div class="add-more-wrapper">
            <button class="load-more-btn" id="load-more-categories" data-categorie = <?= $post['name'] ?> data-id= <?= $post['0'] ?> >Load More</button>
        </div>
    </div>
    
</div>
<?php else:?>
    <h1> There Is No Posts In This Topic Yet </h1>
<?php endif; ?>