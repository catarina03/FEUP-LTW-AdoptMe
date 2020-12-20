<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');

    $pet_id = $_GET['id'];

    removePetPost($pet_id);

    echo '<script>alert("Removed pet post!"); location.replace("../pages/userprofile.php");</script>';
    die();

?>