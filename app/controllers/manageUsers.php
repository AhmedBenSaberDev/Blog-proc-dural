<?php
session_start();
// Including the dattabase
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');


// Including path file
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/path.php');

if(isset($_GET['delete-user'])){

    $req = $pdo->prepare("DELETE FROM users WHERE id= ?");
    $req->execute([$_GET['id']]);

    $_SESSION['success'] = "User has been deleted";
    header("Location: ".BASE_URL . "/app/admin/users/index.php");
}

if(isset($_GET['switch-admin'])){

    $req = $pdo->prepare("SELECT * FROM users WHERE id= ?");
    $req->execute([$_GET['id']]);
    $user = $req->fetch();

    $admin =  !$user['admin'];

    $req = $pdo->prepare("UPDATE users SET admin = ? WHERE id = ?");;
    $req->execute([$admin,$_GET['id']]);
    $_SESSION['success'] = "User has been updated";
    header("Location: ".BASE_URL . "/app/admin/users/index.php");
}

