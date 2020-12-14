<link rel="stylesheet" href="../css/userProfile.css">

<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../templates/template-pets.php');
    include_once('../templates/tpl_userprofile.php');

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

?>
<div id="main">

    <aside id="user_profile">
        <?php drawUserProfile($user); 
        
        if(isset($_SESSION['username'])){
            if($_SESSION['username'] === $user['email']){ ?>
                <form action="edit_profile.php">
                    <input type="submit" value="Edit Profile">
                </form>
                <form action="add-animal-adoption.php">
                    <input type="submit" value="Add Animal">
                </form>
            <?php }
        } ?>

    </aside>

    <?php drawAllPetPosts($pets); ?>
        
 </div>
    <?php 
        include_once('../templates/common/footer.php')
    ?>

