<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../templates/template-posts.php');
    include_once('../templates/tpl_userprofile.php');

    if (!isset($_SESSION['username']))
        die(header('Location: login.html'));

    $user = getUser($_SESSION['username']);
    $pets = getAllPetsForAdoption($_SESSION['username']);
?>


    <?php drawUserProfile($user); ?>

    <form action="edit_profile.php">
        <input type="submit" value="Edit Profile">
    </form>

    <?php drawAllPetPosts($pets); ?>
    

<?php 
    include_once('../templates/common/footer.php')
?>