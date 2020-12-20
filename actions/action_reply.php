<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../database/db_pet.php');

    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_POST['csrf'])
        die(header('Location: ../pages/login.php'));
    else{
        $pet_id = $_POST['pet_id'];
        $question_id = $_POST['question_id'];
        $reply = $_POST['reply'];

        $owner = getPetOwner($pet_id);
        $user = getUser($owner['owner_email']);
        if($_SESSION['username'] === $owner['owner_email']){
            addReply($question_id, $reply, $user['id']);
            echo '<script>alert("Added reply!"); location.replace("../pages/petprofile.php?id=' . $pet_id . '");</script>';
            die();
        }
        else{
            echo '<script>alert("Not allowed to reply!"); location.replace("../pages/petprofile.php?id=' . $pet_id . '");</script>';
            die();
        }
    }
?>