<?php

session_start();
// Including the dattabase
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

// Including path file
if(!defined('BASE_URL')){
    include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/path.php'); 
}

if(isset($_GET['publish-post'])){

    $req = $pdo->prepare("UPDATE posts SET published = ? WHERE id = ?");
    $req->execute([1,$_GET['id']]);

    $_SESSION['success'] = "Post has been published";
}

if(isset($_GET['unpublish-post'])){

    $req = $pdo->prepare("UPDATE posts SET published = ? WHERE id = ?");
    $req->execute([0,$_GET['id']]);

    $_SESSION['success'] = "Post has been unpublished";
}

header("Location: ".BASE_URL . "/app/admin/posts/manage.php");