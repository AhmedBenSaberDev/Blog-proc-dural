<?php

// Including database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

$req = $pdo->prepare('SELECT * FROM topics');
$req->execute();
$topics = $req->fetchAll();