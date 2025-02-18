<?php
    include_once('../database/db_user.php');

    function verifyInput(){
        foreach($_POST as $input){
            if(!isset($input) || $input === '')
                return false;
        }

        if($_POST['password'] !== $_POST['password_check'])
            return false;
            
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            return false;

        if(!preg_match('/^[0-9a-zA-Z_\s]+$/',$_POST['username']))
            return false;

        return true;
    }

    if(!verifyInput($_POST) ){
        echo '<script>alert("Invalid Input!"); location.replace("../pages/register.php");</script>'; 
        die();
    }

    $hashedPassword = password_hash($_POST['password'],PASSWORD_DEFAULT);

    try{
        addAccount($_POST,$hashedPassword);
    }
    catch(PDOException $e){
        echo '<script>alert("Email already in use"); location.replace("../pages/register.php");</script>';
        die();
    }

    include_once('../includes/init.php');
    $_SESSION['username'] = $_POST['email'];
    echo '<script>alert("You registered successfully"); location.replace("../pages/userprofile.php");</script>'; 
    die();   
?>
