<?php

// Including database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');


if(isset($_GET['post-id'])){

    // fetch the post
    $req = $pdo->prepare('SELECT * FROM posts  INNER JOIN topics ON  topics.id = posts.topic_id  WHERE posts.id = ?');
    $req->execute([$_GET['post-id']]);
    $post = $req->fetch(PDO::FETCH_ASSOC);
    
    // fetch post comments 
    $req = $pdo->prepare('SELECT * FROM comments  INNER JOIN posts ON  comments.post_id = posts.id  WHERE posts.id = ?');
    $req->execute([$_GET['post-id']]);
    $comments = $req->fetchAll();
    
    // Update post views
    $view = $post['view'] + 1;
    $req = $pdo->prepare('UPDATE posts SET view = ? WHERE id = ?');
    $req->execute([$view,$_GET['post-id']]);

    //get related posts by topic
    $topicId = $post['topic_id'];
    $req = $pdo->prepare('SELECT * FROM posts  INNER JOIN topics ON  topics.id = posts.topic_id WHERE topic_id = ? AND posts.id != ? LIMIT 4');
    $req->execute([$topicId,$_GET['post-id']]);
    $relatedPosts = $req->fetchall();

    if(!$post){
        header("Location:" . BASE_URL . "/index.php");
        return;
    }
}
?>