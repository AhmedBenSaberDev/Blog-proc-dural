<?php

// Including database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/database/connect.php');

// Including functions
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/utilities/functions.php');

$errors = [];

if(isset($_POST['register-btn'])){

    $username = sanitizeForm($_POST['username']);
    $email = sanitizeForm($_POST['email']);
    $password = sanitizeForm($_POST['password']);
    $confirmPassword = sanitizeForm($_POST['confirm-password']);

    $_SESSION['lastFormValue']['username'] = $username;
    $_SESSION['lastFormValue']['email'] = $email;

    if(empty($username)){
        $errors['username'] = "Username is required";

        if(strlen($username) < 3){
            $errors['username'] = "Username must contain at least 3 characters";
        }
    }else{
        $req = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $req->execute([$username]);
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if(!empty($user)){
            $errors['username'] = "Username already exists";
        }
    }

    if(empty($email)){
        $errors['email'] = "Email is required";

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Email is not valid";
        }
    }else{
        $req = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $req->execute([$email]);
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if(!empty($user)){
            $errors['email'] = "Email already exists";
        }
    }

    if(empty($password) || empty($confirmPassword)){
        $errors['password'] = "Password is required";
        
    }
    if($password !== $confirmPassword){
        $errors['password'] = "Passwords don't match";
    }

    if(empty($errors)){

        $req = $pdo->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
        $hash = password_hash($password,PASSWORD_BCRYPT);
        $req->execute([$username,$email,$hash]);

        $_SESSION['success'] = "You account has been created successfuly";
        header('Location: login.php' );
    }
   
}