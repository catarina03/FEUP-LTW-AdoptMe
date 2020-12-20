<?php
    include_once('../includes/init.php');
    include_once('../includes/validate_input.php');
    include_once('../database/db_pet.php');
    include_once('../database/db_user.php');


    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));


    $user = createArrayWithUserInfo();

    global $db;
    $stmt = $db->prepare('UPDATE account
        SET email = ?, password = ?, bio = ?
        WHERE id = ?');
    $stmt->execute(array($user['email'], $user['password'], $user['bio'], $user['id'])); 

    $stmt = $db->prepare('UPDATE person
        SET name = ?, location_id = ?
        WHERE account_id = ?');
    $stmt->execute(array($user['name'], $user['location'], $user['id'])); 

    echo '<script>alert("Updated user information!"); location.replace("../pages/userprofile.php");</script>';
    die();   


    
    function createArrayWithUserInfo() {
        $user['id'] = $_POST['id'];
        $user['name'] = $_POST['name'];
        $user['bio'] = $_POST['bio'];
        $user['email'] = $_POST['email'];
        $user['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $user['location'] = getLocationId($_POST['location']);

        return $user;
    }

    
    

?>