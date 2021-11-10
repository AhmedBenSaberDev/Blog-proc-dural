<?php

// Including database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');



$errors = [];

if(isset($_POST['signin-btn'])){


    $email = sanitizeForm($_POST['email']);
    $password = sanitizeForm($_POST['password']);

    if(empty($email)){
        $errors['email'] = "Email is required";

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['error'] = "Email or password invalid";
        }
    }

    if(empty($password)){
        $errors['error'] = "Email or password invalid";
    }

    if(empty($errors)){

        $req = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $req->execute([$email]);
        $user = $req->fetch(PDO::FETCH_ASSOC);
        
        if(empty($user)){
            $errors['error'] = "Email or password invalid";
        }

        if(!empty($user)){

            $verifyPassword = password_verify($password,$user['password']);

            if(!$verifyPassword){
                $errors['error'] = "Email or password invalid";
            }else{     
                $_SESSION['user'] = $user;
                header('Location: index.php');
            }
        }
    }
}


