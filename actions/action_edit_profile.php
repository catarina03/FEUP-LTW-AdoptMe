<?php
    include_once('../includes/init.php');
    include_once('../includes/validate_input.php');
    include_once('../database/db_pet.php');
    include_once('../database/db_user.php');
    include_once('../templates/tpl_petprofile.php');

    /*
    if(!validInput()){
        echo '<script>alert("Invalid input!"); location.replace("../pages/petprofile.php?id=' . $_GET['id'] . '");</script>';
        die();
        //die(header('Location: ../pages/login.php'));
    }
    */

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



    function getBiggestLocationId() {
        global $db;
        $stmt = $db->prepare('SELECT max(id) AS id FROM location');
        $stmt->execute();
        $id = $stmt->fetch();

        return $id;
    }

    function getLocationId($location) {
        global $db;
        $stmt = $db->prepare('SELECT id FROM location where city = upper(?)');
        $stmt->execute(array("$location"));
        $result = $stmt->fetch()?true:false;

        if ($result) {
            $stmt = $db->prepare('SELECT id FROM location where city = upper(?)');
            $stmt->execute(array("$location"));
            $location_id = $stmt->fetch();
        }
        else {
            $lastLocationId = getBiggestLocationId();

            $location_id = implode($lastLocationId) + 1;
            $stmt = $db->prepare('INSERT INTO location VALUES (?, ?, ?)');
            $stmt->execute(array("$location_id", "$location", "NULL"));
        }

        return $location_id;
    }

    
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