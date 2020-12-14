<link rel="stylesheet" href="../css/petProfile.css"> 

<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../database/db_pet.php');
    include_once('../templates/common/header.php');
    include_once('../templates/template-pets.php');
    include_once('../templates/template-forms.php');
    include_once('../templates/tpl_petprofile.php');
    include_once('../includes/init.php');

    if(isset($_SESSION['username']))
        $user = getUser($_SESSION['username']);
    
    $petID = $_GET['id'];
    $pet = getPetInfo($petID);
?>

    <section id='main'>
        <?php drawPetProfile($pet,$petID); ?>

        <button>ADOPT ME!</button>
        
        <?php
        if(isset($_SESSION['username'])){
            if (!userOwnsPet($_SESSION['username'],$petID)) { ?>
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
            <?php } 
            else { ?>
                <form action="../actions/action_upload_pet_pic.php?id=<?=$petID?>" method="post" enctype="multipart/form-data">
                    <label>Insert new pet picture:
                        <input type="file" name="image">
                    </label>
                    <input type="submit" value="Upload">
                </form>
            <?php } 
        } ?>
    </section>

    <section id='divider'>
        <h1>Any questions? Ask them down below</h1>
    </section>

    <section id="comments">
        <h2 class="visually-hidden">Pet comments</h2>

        <?php $comments = getAllPetComments($petID);
        drawAllPetComments($comments); 

        if(isset($_SESSION['username'])){
            if (!userOwnsPet($_SESSION['username'],$petID)) { 
                commentForm();
            } 
        } 
        else { ?>
            <p>Want to ask a question? <a href='login.php'>Log in</a></p>
        <?php } ?>
    </section>

<?php include_once('../templates/common/footer.php'); ?>