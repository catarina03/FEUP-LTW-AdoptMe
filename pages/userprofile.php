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
    include_once('../templates/tpl_userprofile.php'); 
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

            if(!isset($_GET['id'])){ ?>
                <form action="edit_profile.php" method="post">
                    <input type="submit" value="Edit Profile">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                </form>
                <form action="add-animal-adoption.php" method="post">
                    <input type="submit" value="Add Animal">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                </form>
            <?php } ?> 
        </aside>

        <?php drawAllPetPosts($pets, $user); ?>
    </div>

    <!--Só mostra caso a lista de favoritos não seja nula-->
    <div id="favourite">
        <?php if(!isset($_GET['id'])){ ?>
            <?php if($favs!=NULL){?>
                <h2 id="fav">Favourites</h2>
                <?php foreach($favs as $favID) { 
                    $favInfo = getPetInfo($favID['pet_id']);
                    drawPetPhotoName($favInfo,$favID['pet_id']);
                }
            }
        } ?>
    </div>   

    <div id="proposal">
        <?php if(!isset($_GET['id'])){ ?>
            <?php if($proposals!=NULL){
                drawProposals($proposals); 
            }
        } ?>
    </div>   

</div>

<?php 
    include_once('../templates/common/footer.php')
?>
