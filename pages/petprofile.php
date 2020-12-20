<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../database/db_pet.php');
    include_once('../templates/template-forms.php');
    include_once('../includes/init.php');
    include_once('../templates/template-pets.php');
    include_once('../templates/template-common.php');

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    $petID = $_GET['id'];
    $user = getUser($_SESSION['username']);
    $pet = getPetInfo($petID);
    $title = "<title>" . $pet['name'] . " | Adopt Me!</title>";

    drawStyle("petProfile");
    drawHeader($title); 
?>

    <section id='main'>
        <?php drawPetProfile($pet,$petID); 
        drawPetActions($petID, $user); ?>

        <hr>

        <?php drawCommentSection($pet); ?>
    </section>


<?php
drawFooter();
?>