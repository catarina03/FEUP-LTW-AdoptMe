<link rel="stylesheet" href="../css/petProfile.css"> 

<?php 
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../templates/tpl_petprofile.php');
    include_once('../includes/init.php');


    $user = getUser($_SESSION['username']);
    $petID = $_GET['id'];
    $pet = getPetInfo($petID);
?>

    <section id='main'>
        <?php drawPetProfile($pet,$petID); ?>
        
        <button>ADOPT ME!</button>

        <?php
        if(!userLikesPet($user['id'],$petID)){?>
            <form action="../actions/action_likeAnimal.php?petId=<?=$petID?>" method="post" enctype="multipart/form-data">
                <button type="submit"><i class="far fa-heart"></i></button>
            </form>
        <?php } else { ?>
            <form action="../actions/action_dislikeAnimal.php?petId=<?=$petID?>" method="post" enctype="multipart/form-data">
                <button type="submit"><i class="fas fa-heart"></i></button>
            </form>
        <?php } ?>
    </section>

<?php include_once('../templates/common/footer.php'); ?>