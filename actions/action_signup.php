<?php
    include_once('../database/db_user.php');

    function verifyInput(){
        foreach($_POST as $input){
            if(!isset($input) || $input === '')
                return false;
        }
        if($_POST['password'] === $_POST['password_check'])
            return true;
        return false;
    }

    if(!verifyInput()){
        echo '<script>alert("Invalid Input!"); location.replace("../pages/register.php");</script>'; 
    }

    try{
        addAccount($_POST['email'],$_POST['password']);
    }
    catch(PDOException $e){
        echo '<script>alert("Email already in use"); location.replace("../pages/register.php");</script>';
    }

    echo '<script>alert("You registered successfully"); location.replace("../pages/userprofile.php");</script>';    
?>