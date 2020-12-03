<?php

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

    $db = new PDO('sqlite:g21.db');
    $stmt = $db->prepare('INSERT INTO account VALUES(NULL,?,?)');
    $stmt->execute(array($_POST['email'],$_POST['password']));

    echo '<h1>You just registered</h1>';
    echo '<a href=login.html>Sign In Here</a>';
    
?>