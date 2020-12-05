<?php
    include_once('includes/session.php');
    include_once('database/db_user.php');

    $name = $_POST['name'];
    $location = $_POST['location'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $color = $_POST['color'];

    if (checkUserPassword($email, $password)) {
        $_SESSION['username'] = $email;
        header('Location: userprofile.php');
      } else {
        header('Location: login.html');
    }

?>