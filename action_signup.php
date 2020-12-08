<?php

    include_once('database/connection.php');

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
        $stmt = $db->prepare('INSERT INTO account VALUES(NULL,?,?, NULL)');
        $stmt->execute(array($_POST['email'],$_POST['password']));
    }
    catch(PDOException $e){
        echo '<script>alert("Email already in use")</script>';
        echo '<a href=register.php>Try again</a>';
        die();
    }

    echo '<h1>You just registered</h1>';
    echo '<a href=login.html>Sign In Here</a>';
    
?>