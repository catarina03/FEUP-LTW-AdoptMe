<?php
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../includes/validate_input.php');

    if(!validInput())
        die(header('Location: ../pages/login.php'));

    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_GET['csrf'])
        die(header('Location: ../pages/login.php'));

    $session_user = getUser($_SESSION['username']);
    
    send_request($session_user['id']);

    header('Location: ../pages/userprofile.php')

?>

<?php

    function send_request($owner_of_pet) {
        global $db;

        date_default_timezone_set('Europe/Lisbon');
        $date = date('m-d-Y h:i:s', time());

        $account_id = getUserHavePetForAdoption($_GET['pet_id']);

        if($account_id == $owner_of_pet) {
            die(header('Location: ../pages/pages_index.php'));
        }

        $stmt = $db->prepare('INSERT into proposal VALUES(?, ?, ?, ?, ?, ?)');
        $stmt->execute(array(NULL, 1, $date, $_GET['pet_id'], $_GET['user_id'], $account_id));
    }

?>