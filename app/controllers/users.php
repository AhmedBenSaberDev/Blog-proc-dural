<?php


// Including the dattabase
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

// Including utilities functions
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');

// fetch all users

$req = $pdo->prepare("SELECT * FROM users");
$req->execute();
$users = $req->fetchAll(PDO::FETCH_ASSOC);



