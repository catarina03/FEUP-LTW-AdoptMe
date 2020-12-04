<?php
    include_once('includes/session.php');
    include_once('database/db_user.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (checkUserPassword($email, $password)) {
        $_SESSION['username'] = $email;
        header('Location: userprofile.php');
      } else {
        header('Location: login.html');
    }

?>