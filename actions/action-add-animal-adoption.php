<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../database/db_pet.php');
    include_once('../includes/validate_input.php');

    if(!validInput()){
        echo '<script>alert("Invalid input!"); location.replace("../pages/userprofile.php");</script>';
        die();
    }

    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_GET['csrf']){
        echo '<script>alert("Sessions!"); location.replace("../pages/userprofile.php");</script>';
        die();
    }
    
    addAnimalToUser();

    echo '<script>alert("Added new pet for adoption!"); location.replace("../pages/userprofile.php");</script>';
    die();
?>
