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

if(isset($_GET['delete-topic'])){

    global $topicsIds;

    $topicId = $_GET['id'];

    if(is_numeric($topicId)){
        
        if(in_array($topicId,$topicsIds)){
            $req = $pdo->prepare("DELETE FROM topics WHERE id = ?");
            $req->execute([$topicId]);

            $_SESSION['success'] = "Topic has been succcessfuly deleted";
            header("Location: ".BASE_URL . "/app/admin/topics/manage.php");
            return;

        }else{
            header("Location: ".BASE_URL . "/app/admin/topics/manage.php");
        }
    }
}