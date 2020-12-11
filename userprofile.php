<?php 
    include_once('includes/init.php');
    include_once('database/db_user.php');
    include_once('templates/template-pets.php');
    include_once('templates/common/header.php');

    if (!isset($_SESSION['username']))
        die(header('Location: login.html'));

    $user = getUser($_SESSION['username']);
    $pets = getAllPetsForAdoption($_SESSION['username']);
?>


    <aside id="user_profile">
        <header>
            <img src="images/person.jpg" alt="profile picture" width="80">
            <h2><?php echo $user['name'] ?></h2>
        </header>
        <p id="bio"><?php echo $user['bio'] ?></p>
        <p id="location"><?php echo $user['city'] ?></p>
        <footer>
            <h4>XX followers</h4>
            <h4>XX following</h4>

            <!-- placeholder-->
            <a href="login.html">Edit profile</a>

        </footer>
    </aside>

    <?php drawAllPetPosts($pets); ?>
    

<?php 
    include_once('templates/common/footer.php');
?>