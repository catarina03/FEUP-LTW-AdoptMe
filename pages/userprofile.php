<link rel="stylesheet" href="../css/userProfile.css">

<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../templates/template-pets.php');
    include_once('../templates/tpl_userprofile.php');
    include_once('../templates/tpl_petprofile.php');
    
    if(!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    $user = getUser($_SESSION['username']);
    $pets = getAllPetsForAdoption($_SESSION['username']);
    $favs = getFavouritePets($user['id']);

?>
<div id="main">
    <div id="userAndPosts">
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
</div>   

    <!--Só mostra caso a lista de favoritos não seja nula-->
    <div id="favourite">
        <?php if($favs!=NULL){?>
            <h2>Favourites</h2>
            <?php foreach($favs as $favID) { 
                $favInfo = getPetInfo($favID['pet_id']);
                drawPetPhotoName($favInfo,$favID['pet_id']);
            }?>
        <?php }?>
    </div>   
 </div>
    <?php 
        include_once('../templates/common/footer.php')
    ?>

