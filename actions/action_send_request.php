<?php
    include_once('../includes/init.php');
    include_once('../database/db_user.php');

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    send_request();

?>

<?php

    function send_request() {
        global $db;

        date_default_timezone_set('Europe/Lisbon');
        $date = date('m-d-Y h:i:s', time());

        $account_id = getUserHavePetForAdoption($_GET['pet_id']);

        $stmt = $db->prepare('INSERT into proposal VALUES(?, ?, ?, ?, ?, ?)');
        $stmt->execute(array(NULL, 1, $date, $_GET['pet_id'], $_GET['user_id'], $account_id));
    }

?>