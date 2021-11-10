<?php

// Including the dattabase
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

// Including path file
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/path.php');

// Including utilities functions
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');

if(isset($_POST['message'])){

    $message = sanitizeForm($_POST['message']);

    if(empty($_POST['comment-author'])){
        header('Location:' . BASE_URL . "/login.php");
        return;
    };
    if(empty($message)){
        header('Location:' . BASE_URL . "/singlePost.php?post-id=" . $_POST['post-id']);
        return;
    }
    
    $req = $pdo->prepare("INSERT INTO comments (nickname,content,post_id) VALUES (?,?,?)");
    $req->execute([$_POST['comment-author'],$message,$_POST['post-id']]);
}

if(isset($_POST['delete-comment'])){


    $req = $pdo->prepare('DELETE FROM comments WHERE id = ?');
    $req->execute([$_POST['comment-id']]);
}

header('Location:' . BASE_URL . "/singlePost.php?post-id=" . $_POST['post-id']);