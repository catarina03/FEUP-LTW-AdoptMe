<link rel="stylesheet" href="../css/userProfile.css">

<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../templates/template-pets.php');
    include_once('../templates/tpl_userprofile.php');
    include_once('../templates/tpl_petprofile.php');


    if (!isset($_SESSION['username']))
        die(header('Location: login.html'));

    $user = getUser($_SESSION['username']);
    $pets = getAllPetsForAdoption($_SESSION['username']);
    $favsID = getFavouritePets($user['id']);
?>
<div id="main">

    <aside id="user_profile">
        <?php drawUserProfile($user); ?>

        <form action="edit_profile.php">
            <input type="submit" value="Edit Profile">
        </form>
        <form action="add-animal-adoption.php">
            <input type="submit" value="Add Animal">
        </form>
    </aside>

    <?php drawAllPetPosts($pets); ?>
    
    <!--Só mostra caso a lista de favoritos não seja nula-->
    <?php if($favsID!=NULL){?>
        <h2>Favourites</h2>
        <?php foreach($favsID as $favID) { 
            $favInfo = getPetInfo($favID);
            drawPetPhotoName($favInfo,$favID);
        }?>
    <?php }?>
        
 </div>
    <?php 
        include_once('../templates/common/footer.php')
    ?>

