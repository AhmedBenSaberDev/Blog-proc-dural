<?php

// Including database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

// fetch most recent posts
$req = $pdo->prepare('SELECT * FROM posts INNER JOIN topics ON  topics.id = posts.topic_id ORDER BY posts.id ASC LIMIT 4');
$req->execute();
$posts = $req->fetchAll();

// fetch most read posts
$req = $pdo->prepare('SELECT * FROM posts  INNER JOIN topics ON  topics.id = posts.topic_id  ORDER BY view DESC LIMIT 6');
$req->execute();
$mostViewedPost = $req->fetchAll();

$req = $pdo->prepare('SELECT * FROM posts INNER JOIN topics ON  topics.id = posts.topic_id ORDER BY rand() LIMIT 2');
$req->execute();
$randomPosts = $req->fetchAll();












