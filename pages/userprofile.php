<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../includes/validate_input.php');
    include_once('../templates/template-pets.php');
    include_once('../templates/template-user.php'); 
    include_once('../templates/template-common.php');

    if(!validInput())
        die(header('Location: ../pages/userprofile.php'));
    if(!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));
    if(isset($_GET['id'])) {
        $user = getUserById($_GET['id']);
        $pets = getAllPetsForAdoption($user['email']);
    }
    else {
        $user = getUser($_SESSION['username']);
        $pets = getAllPetsForAdoption($_SESSION['username']);
    }

    $favs = getFavouritePets($user['id']);
    $proposals = getProposals($user['id']);
    $title = "<title>" . $user['name'] . " | Adopt Me!</title>";

    drawStyle("userProfile");
    drawHeader($title); 
    drawUserProfile($user, $pets, $favs, $proposals);
    drawFooter();
?>
