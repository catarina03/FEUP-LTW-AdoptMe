<?php

    include_once('../database/db_user.php');

    function verifyInput(){
        foreach($_POST as $input){
            if(!isset($input) || $input === '')
                return false;
        }
        return true;
    }

    if(!verifyInput()){
        echo '<h1>Invalid input</h1>';
        die();
    }

    $hashedPassword = password_hash($_POST['password'],PASSWORD_DEFAULT);

    try{
        addAccount($_POST['email'],$hashedPassword);
    }
    catch(PDOException $e){
        echo '<script>alert("Email already in use")</script>';
        echo '<a href=../pages/register.php>Try again</a>';
        die();
    }

    echo '<h1>You just registered</h1>';
    echo '<a href=../pages/login.html>Sign In Here</a>';
    
?>