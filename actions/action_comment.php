<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../database/db_pet.php');

    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_POST['csrf'])
        die(header('Location: ../pages/login.php'));
    else{
        $user = getUser($_SESSION['username']);
        $pet_id = $_POST['pet_id'];
        $question = $_POST['question'];

        addComment($pet_id, $question, $user['id']);

        echo '<script>alert("Added comment!"); location.replace("../pages/petprofile.php?id=' . $pet_id . '");</script>';

    }
    


?>