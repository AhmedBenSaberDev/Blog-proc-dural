<?php

session_start();
unset($_SESSION['user']);
header('Location: http://localhost:8080/Blog-native/index.php');

?>