<?php
    include_once('../database/db_user.php');
    include_once('../includes/validate_input.php');

    if(!validInput())
        die(header('Location: ../pages/register.php'));

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

    $hashedPassword = password_hash($_POST['password'],PASSWORD_DEFAULT);

    try{
        addAccount($_POST['email'],$hashedPassword);
    }
    catch(PDOException $e){
        echo '<script>alert("Email already in use"); location.replace("../pages/register.php");</script>';
    }

    echo '<script>alert("You registered successfully"); location.replace("../pages/userprofile.php");</script>';    
?>