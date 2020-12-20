<?php 
    include_once('../includes/init.php');
    include_once('../database/db_pet.php');

    $id = $_GET['id'];
    $question = $_GET['question'];
    $made_by = $_GET['made_by'];

    removeComment($id, $question, $made_by);

    echo '<script>alert("Removed comment!"); location.replace("../pages/userprofile.php?id='. $_GET['id']; .'");</script>';
    die();

?>