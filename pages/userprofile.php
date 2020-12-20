<link rel="stylesheet" href="../css/userProfile.css">

<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../includes/validate_input.php');
?>

<?php     
    if(isset($_GET['id'])) {
        $user = getUserById($_GET['id']);
    }
    else {
        $user = getUser($_SESSION['username']);
    }
?>

<head>
        <title> <?=$user['name']?> | Adopt Me!</title>
</head>

<?php
    include_once('../templates/template-pets.php');
    include_once('../templates/template-user.php'); 
    include_once('../templates/common/header.php');

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

?>

<div id="main">
    <div id="userAndPosts">
        <aside id="user_profile">
            <?php drawUserProfile($user);
            drawUserActions(); ?>
        </aside>
        <?php drawAllPetPosts($pets, $user); ?>
    </div>
    <?php drawFavoritesSection($favs); 
    drawProposalSection($proposals); ?>
</div>

<?php 
    include_once('../templates/common/footer.php')
?>
