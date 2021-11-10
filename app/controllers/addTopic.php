<?php

session_start();
// Including the dattabase
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

// Including path file
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/path.php');

// Including utilities functions
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');


if(isset($_POST['add-topic'])){

    $topicName = sanitizeForm($_POST['topic-name']);
    $topicDescription = sanitizeForm($_POST['description']);

    $_SESSION['old-addPost-value-form']['name'] = $topicName;
    $_SESSION['old-addPost-value-form']['description'] = $topicDescription;

    if(empty($topicName)){
        $_SESSION['error']['topic-name'] = "The name field cannot be empty";
    }else{
        $req = $pdo->prepare("SELECT * FROM topics WHERE name = ?");
        $req->execute([$topicName]);
        $result = $req->fetch();

        if($result){
            $_SESSION['error']['topic-name'] = "The topic name already exists";
        }
    }

    if(empty($topicDescription)){
        $_SESSION['error']['description'] = "The description field cannot be empty";
    }

    if(empty($_SESSION['error'])){
        $req = $pdo->prepare('INSERT INTO topics (`name`,`description`) VALUES (?,?)');
        $req->execute([$topicName,$topicDescription]);

        $_SESSION['success'] = "Topic has been added succcesfuly";
        header("Location: ".BASE_URL . "/app/admin/topics/manage.php");
        return;
    }

    header("Location: ".BASE_URL . "/app/admin/topics/index.php");

}