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

$req =  $pdo->prepare('SELECT * FROM topics');
$req->execute();
$topics = $req->fetchAll();

$topicsIds = [];

foreach($topics as $topic){
    array_push($topicsIds,$topic['id']);
}

if(isset($_GET['id'])){

    global $topicsIds;

    $topicId = $_GET['id'];

    if(is_numeric($topicId)){
        if(in_array($topicId,$topicsIds)){
            $req = $pdo->prepare("SELECT * FROM topics WHERE id = ?");
            $req->execute([$topicId]);
            $topic = $req->fetch();
            return;
        }    
    }
    header("Location: ".BASE_URL . "/app/admin/topics/manage.php");
} 

if(isset($_POST['edit-topic-form'])){

    $topicName = sanitizeForm($_POST['topic-name']);
    $topicDescription = sanitizeForm($_POST['description']);
    $id = $_POST['id'];

    if(empty($topicName)){
        $_SESSION['error']['topic-name'] = "The name field cannot be empty";
    }else{
        $req = $pdo->prepare("SELECT * FROM topics WHERE id != ? AND name = ?");
        $req->execute([$id,$topicName]);
        $results = $req->fetchAll();

        if($results){
            $_SESSION['error']['topic-name'] = "The topic name already exists";
        }
    }

    if(empty($topicDescription)){
        $_SESSION['error']['description'] = "The description field cannot be empty";
    }

    if(empty($_SESSION['error'])){

        $req = $pdo->prepare("UPDATE topics
        SET name = ?, description= ?
        WHERE id = ?;");
        $req->execute([$topicName,$topicDescription,$id]);

        $_SESSION['success'] = "Topic has been updated";
        header("Location: ".BASE_URL . "/app/admin/topics/manage.php");
        return;
    }

    header("Location: ".BASE_URL . "/app/admin/topics/editTopic.php?id=" . $id);
}
