<?php

session_start();
// Including the dattabase
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

// Including path file
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/path.php');

// Including utilities functions
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');



if(isset($_POST['add-post'])){

    $postName = sanitizeForm($_POST['post-name']);
    $postDescription = $_POST['post-description'];
    $postTopic = sanitizeForm($_POST['topic']);
    $userId = $_SESSION['user']['id'];
    

    $_SESSION['old-addPost-value-form']['title'] = $postName;
    $_SESSION['old-addPost-value-form']['description'] = $postDescription;


    $allowedTypes = array( 'png' => IMAGETYPE_PNG  ,  'jpeg' =>IMAGETYPE_JPEG  );

    if(!empty($_FILES['post-image']['name'])){

        $detectedType = exif_imagetype($_FILES['post-image']['tmp_name']);

        if(!in_array($detectedType, $allowedTypes))
        {
            $_SESSION['error']['image'] = "This image extension is not allowed";
        }

    }else{
        $_SESSION['error']['image'] = "Image is required";
    }  

    if(empty($postName)){
        $_SESSION['error']['post-name'] = "The title field cannot be empty";
    }
    else{
        $req = $pdo->prepare("SELECT * FROM posts WHERE title = ?");
        $req->execute([$postName]);
        $result = $req->fetch();

        if($result){
            $_SESSION['error']['post-name'] = "The post title already exists";
        }
    }

    if(empty($postDescription)){
        $_SESSION['error']['description'] = "The description field cannot be empty";
    }
    if(empty($postTopic)){
        $_SESSION['error']['topic'] = "Please choose a topic";
    }

    if(empty($_SESSION['error'])){

        
        $picture = time()  . "_" .  $_FILES['post-image']['name'];
        $tmpPicture = $_FILES['post-image']['tmp_name'];
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/Blog-native/assets/images/posts/';
        move_uploaded_file($tmpPicture,$folder.$picture);

        $req = $pdo->prepare('INSERT INTO posts (`title`,`body`,`user_id`,`published`,`topic_id`,`image`) VALUES (?,?,?,?,?,?)');
        $req->execute([$postName,$postDescription,$userId,0,$postTopic,$picture]);

        $_SESSION['success'] = "Post has been added succcesfuly";
        header("Location: ".BASE_URL . "/app/admin/posts/manage.php");
        return;
    }

    header("Location: ".BASE_URL . "/app/admin/posts/index.php");

}