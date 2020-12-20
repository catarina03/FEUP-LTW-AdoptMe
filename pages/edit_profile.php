<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/template-user.php');
    include_once('../templates/template-forms.php');
    include_once('../templates/template-common.php');

    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_POST['csrf'])
        die(header('Location: ../pages/login.php'));

    $user = getUser($_SESSION['username']);
    $title = "<title>" . $user['name'] . " | Adopt Me!</title>";

    drawStyle("edit_profile");
    drawHeader($title);
    drawEditUserProfile($user);
    drawFooter(); 
?>
