<?php

function sanitizeForm($input){
    $input = trim($input);
    $input = strip_tags($input);
    return $input;
}

function sanitizeText($input){
    $input = strip_tags($input);
    return $input;
}

function checkError($array, $field){
    if(isset($array[$field])){
        return " error-border";
    }
    return "";
}

function displayError($array,$field){
    if(isset($array[$field])){
        return $array[$field];
    }
    return "";
}

function startSession()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function userConnectionCheck(){
    if(isset($_SESSION['user'])){
        return true;
    }
    return false;
}

function displayUserName(){
    if(isset($_SESSION['user'])){
        return $_SESSION['user']['username'];
    }
    return "";
}

function checkIfSubmit(){
    if(isset($_SESSION['lastFormValue'])){
        return true;
    }
    return false;
}

function displayLastFormValue($field){
    if(isset($_SESSION['lastFormValue'])){
        return $_SESSION['lastFormValue'][$field];
    }
    return "";
}

function checkForSuccessMessage(){
    if(isset($_SESSION['success'])){
        return true;
    }
}

function displaySuccessMessage(){
    if(isset($_SESSION['success'])){
        return $_SESSION['success'];
    }
}

function checkIfAdmin(){
    if($_SESSION['user']['admin'] == 1){
        return true;
    }
    return false;
}

function redirectIfNotAdmin()
{
    if(!checkIfAdmin()){
        return header('Location:'.BASE_URL);
    }
}

function userConnected(){
    if(isset($_SESSION['user'])){
        return true;
    }
    return false;
}

function checkIfTopicFormError($field){
    if(isset($_SESSION['error'][$field])){
        return $_SESSION['error'][$field];
    }
    return "";
}

function displayTopicToEdit($topic,$column){
   return $topic[$column];
}

function displayPostToEdit($post,$column){
    return $post[$column];
}


function displayOldValuesAddForm($field){
    if(isset($_SESSION['old-addPost-value-form'][$field])){
        return  $_SESSION['old-addPost-value-form'][$field];
    }
    return "";
}

function dateFormate($date){
    $dateObj = date_create($date);
    return date_format($dateObj,"M d,Y");
}

function hourFormat($date){
    $dateObj = date_create($date);
    return date_format($dateObj,"g:i a");
}

function limitText($string,$lenght){

    if(strlen($string) > $lenght){
        $stringCut = substr($string,0,$lenght);
        $string = substr($stringCut,0, strrpos($stringCut,' ')). " ...";
       return(substr($string,0,$lenght));
    }
    return $string;
}

