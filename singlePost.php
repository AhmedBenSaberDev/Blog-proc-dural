<?php
session_start();

//  Including head 
include(dirname(__FILE__) . '/app/includes/head.php');

// Including  functions
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');

// Including  post controller
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/controllers/singlePost.php');
?>

<body>

    <!-- Including the header -->
    <?php include(dirname(__FILE__) . '/app/includes/header.php'); ?>

    <div class="single-post-banner">
        <img src= <?= BASE_URL . "/assets/images/posts/".$post['image'] ?> alt="">

        <div class="banner-info">
            <div class="category-info">
                <a class="post-category topic-link" data-id= <?= $post['topic_id'] ?> href="#"> <?= $post['name'] ?></a>
                <span> <?= dateFormate($post['created_at']); ?> </span>
            </div>

            <h1><?= $post['title'] ?></h1>
        </div>
    </div>

    <div class="container">

        <div class="single-post-wrapper">
            <div class="post">
                <h2><?= $post['title'] ?></h2>
                <p> <?= $post['body'] ?></p>
            </div>

            <?php if(!empty($relatedPosts)):?>  
            <div class="related-side-bar">
                <h3>Related Posts</h3>
                
                <?php foreach($relatedPosts as $post):?>
                    <div class="related-post">
                        <div class="related-post-img">
                            <img src= <?= BASE_URL . "/assets/images/posts/" . $post['image'] ?> alt="post image">
                        </div>
                        <div class="related-post-title">
                            <a href=<?= BASE_URL . "/singlePost.php?post-id=" . $post['0'] ?>> <?= limitText($post['title'],50)?> </a>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>

            <?php else: ?>
                <h3>The is no related posts related posts</h3>
            <?php endif; ?> 
        </div>
    </div>

    <div class="comments-wrapper">

        <h2><span> <?php if( !empty($comments)): ?> <?= count($comments) ?>  <?php else: ?> <?= "0" ?> <?php endif;?> </span> Comment(s)</h2>
        <?php if(!empty($comments)):?>
            <?php foreach($comments as $comment):?>
                <div class="single-comment-block">
                    <div class="comment-info">
                        <h3><?= $comment['nickName'] ?></h3>
                        <span><?=  dateFormate($comment['posted_at']) . " At " . hourFormat($comment['posted_at']) ?></span>
                    </div>
                    <p><?= $comment['content'] ?></p>
                    <?php if(checkIfAdmin() || $_SESSION['user']['username'] == $comment['nickName']): ?>
                        <form method="POST" action = <?= BASE_URL .  "/app/controllers/comments.php" ?>>
                            <input name="comment-id" type="hidden" value= <?= $comment[0] ?> >
                            <input name="post-id" type="hidden" value= <?= $_GET['post-id'] ?> >
                            <button name="delete-comment" class="delete-comment-btn" type="submit"> Delete </button>
                        </form> 
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif;?>
        <div class="leave-comment">
            <h3>Leave A Comment</h3>
            <p>You need to sign in or register to put a comment.</p>

            <form method="POST" action = <?= BASE_URL .  "/app/controllers/comments.php" ?> >
                <input name="post-id" type="hidden" value= <?= $_GET['post-id'] ?>>
                <input name="comment-author" type="hidden" value = <?php if(userConnected()): ?><?= $_SESSION['user']['username'] ?><?php endif; ?>   >
                <textarea name="message" placeholder="Message" required></textarea>
                <button class="submit-comment" type="submit">Submit</button>
            </form>

        </div>
    </div>
    
    <!-- Including the footer -->
    <?php
     include(dirname(__FILE__) . '/app/includes/footer.php'); ?>


</body>