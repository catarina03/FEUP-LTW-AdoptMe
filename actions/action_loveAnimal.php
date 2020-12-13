<?php
    include_once('../database/db_user.php');

    
    //verifiva que a pessoa tem o login feito
    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.html'));

    // obtem o user e o petID
    $user = getUser($_SESSION['username']);
    $petID = $_GET['id'];

    //coloca na base de dados
    addFavouritePet($petID,$user['id']);   
?>