<?php

// Including database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

// Including path file
if(!defined('BASE_URL')){
    include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/path.php'); 
}

// Including utilities functions
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');

startSession();

$req =  $pdo->prepare('SELECT * FROM posts');
$req->execute();
$posts = $req->fetchAll();

$postsId = [];

foreach($posts as $post){
    array_push($postsId,$post['id']);
}

if(isset($_GET['delete-post'])){

    global $postsId;

    $postId = $_GET['id'];

    if(is_numeric($postId)){
        
        if(in_array($postId,$postsId)){
            $req = $pdo->prepare("DELETE FROM posts WHERE id = ?");
            $req->execute([$postId]);

            $_SESSION['success'] = "Post has been succcessfuly deleted";
            header("Location: ".BASE_URL . "/app/admin/posts/manage.php");
            return;

        }else{
            header("Location: ".BASE_URL . "/app/admin/posts/manage.php");
        }
    }
}