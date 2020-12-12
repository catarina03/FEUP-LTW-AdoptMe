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

    try{
        addAccount($_POST['email'],$_POST['password']);
    }
    catch(PDOException $e){
        echo '<script>alert("Email already in use")</script>';
        echo '<a href=../pages/register.php>Try again</a>';
        die();
    }

    echo '<h1>You just registered</h1>';
    echo '<a href=../pages/login.php>Sign In Here</a>';
    
?>