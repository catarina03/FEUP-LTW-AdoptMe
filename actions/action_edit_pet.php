<?php
    include_once('../includes/init.php');
    include_once('../includes/validate_input.php');
    include_once('../database/db_pet.php');
    include_once('../database/db_user.php');


    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));


    if(!userOwnsPet($_SESSION['username'],$_GET['id'])){
        echo '<script>alert("User does not have ownership permission to edit pet!"); location.replace("../pages/petprofile.php?id=' . $_GET['id'] . '");</script>';
        die();
    }


    $pet = createArrayWithPetInfo();

    global $db;
    $stmt = $db->prepare('UPDATE pet
        SET name = ?, breed_id = ?, color = ?, weight = ?, height = ?, gender = ?, bio = ?
        WHERE id = ?');
    $stmt->execute(array($pet['name'], $pet['breed'], $pet['color'], $pet['weight'], $pet['height'], $pet['gender'], $pet['bio'], $_GET['id'])); 

    echo '<script>alert("Updated pet information!"); location.replace("../pages/petprofile.php?id=' . $_GET['id'] . '");</script>';
    die();   
?>