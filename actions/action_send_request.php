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

    die(header('Location: ../pages/userprofile.php'));
?>