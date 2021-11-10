<?php

// Including database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

// Including functions
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');


function getPostsNumberByTopic($topic){

    global $pdo;

    $req = $pdo->prepare('SELECT * FROM posts INNER JOIN topics ON  topics.id = posts.topic_id WHERE name = ? AND posts.published = ?');

    $req->execute([$topic,1]);
    $posts = $req->fetchAll();

    return count($posts);
}


