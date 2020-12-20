<?php
    include_once('../includes/init.php');
    include_once('../templates/template-pets.php');
    include_once('../database/db_user.php');
    include_once('../includes/validate_input.php');
    include_once('../templates/template-common.php');
    
    if(!validInput()){
        echo '<script>alert("Invalid input!"); location.replace("../pages/petprofile.php?id=' . $_GET['id'] . ');</script>';
        die();
    }
    
    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));
    
    if(!userOwnsPet($_SESSION['username'],$_GET['id'])){
        echo '<script>alert("User does not have ownership permission to edit pet!"); location.replace("../pages/petprofile.php?id=' . $_GET['id'] . ');</script>';
        die();
    }
    
    $petID = $_GET['id'];
    $pet = getPetInfo($petID);
    $title = "<title>" . $pet['name'] . " | Adopt Me!</title>";

    drawStyle("petProfile");
    drawStyle("edit_pet_profile");
    drawHeader($title);
    drawEditPet($petID, $pet);
    drawFooter();
?>
    
