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

if(isset($_GET['id'])){

    global $postsId;

    $postId = $_GET['id'];

    if(is_numeric($postId)){

        if(in_array($postId,$postsId)){
            $req = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
            $req->execute([$postId]);
            $post = $req->fetch();
            return;
        }    
    }
    header("Location: ".BASE_URL . "/app/admin/posts/manage.php");
} 

if(isset($_POST['edit-post'])){

    $postName = sanitizeForm($_POST['post-name']);
    $postDescription = sanitizeText($_POST['post-description']);
    $postTopic = sanitizeForm($_POST['topic']);
    $userId = $_SESSION['user']['id'];
    $id = $_POST['id'];


    $allowedTypes = array( 'png' => IMAGETYPE_PNG  ,  'jpeg' =>IMAGETYPE_JPEG  );

    if(empty($postName)){
        $_SESSION['error']['post-name'] = "The title field cannot be empty";
    }else{
        $req = $pdo->prepare("SELECT * FROM posts WHERE id != ? AND title = ?");
        $req->execute([$id,$postName]);
        $results = $req->fetchAll();

        if($results){
            $_SESSION['error']['post-name'] = "This title already exists";
        }
    }

    if(empty($postTopic)){
        $_SESSION['error']['topic'] = "The topic is required";
    }

    if(empty($postDescription)){
        $_SESSION['error']['body'] = "The body field cannot be empty";
    }

    if(!empty($_FILES['post-image']['name'])){

        $detectedType = exif_imagetype($_FILES['post-image']['tmp_name']);

        if(!in_array($detectedType, $allowedTypes))
        {
            $_SESSION['error']['image'] = "This image extension is not allowed";
        }
    }else{
        $_SESSION['error']['image'] = "Image is required";
    } 

    if(empty($_SESSION['error'])){

        $picture = time()  . "_" .  $_FILES['post-image']['name'];
        $tmpPicture = $_FILES['post-image']['tmp_name'];
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/Blog-native/assets/images/posts/';
        move_uploaded_file($tmpPicture,$folder.$picture);

        $req = $pdo->prepare("UPDATE posts
        SET title = ?, body = ?, topic_id = ?, `image`= ?
        WHERE id = ?;");
        $req->execute([$postName,$postDescription,$postTopic,$picture,$id]);

        $_SESSION['success'] = "Topic has been updated";
        header("Location: ".BASE_URL . "/app/admin/posts/manage.php");
        return;
    }

    header("Location: ".BASE_URL . "/app/admin/posts/edit.php?id=" . $id);
}
