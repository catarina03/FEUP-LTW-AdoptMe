<?php
    include_once('../includes/init.php');
    include_once('../database/db_user.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      die(header('Location: ../pages/login.php'));


    if (checkUserPassword($email, $password)) {
        $_SESSION['username'] = $email;
        header('Location: ../pages/userprofile.php');
      } else {
        header('Location: ../pages/login.php');
    }

?>