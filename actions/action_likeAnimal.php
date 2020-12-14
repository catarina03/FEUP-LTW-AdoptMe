<?php
    include_once('../database/db_user.php');
    include_once('../includes/init.php');

    
    //verifiva que a pessoa tem o login feito
    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.html'));

    // obtem o user e o petID
    $user = getUser($_SESSION['username']);
    $petID = $_GET['petId'];

    //coloca na base de dados
    try{
        addFavouritePet($petID,$user['id']);   
    }
    catch(PDOException $e){
        header('Location: ../pages/userprofile.php');
        die();
    }

    header('Location: ../pages/pages_index.php');
?>