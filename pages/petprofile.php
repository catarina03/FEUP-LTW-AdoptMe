<link rel="stylesheet" href="../css/petProfile.css"> 

<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../database/db_pet.php');
    include_once('../templates/common/header.php');
    include_once('../templates/template-pets.php');
    include_once('../templates/template-forms.php');
    include_once('../templates/tpl_petprofile.php');

    $petID = $_GET['id'];
    $pet = getPetInfo($petID);
?>

    <section id='main'>
        <?php drawPetProfile($pet,$petID);

        if(isset($_SESSION['username'])){
            if (!userOwnsPet($_SESSION['username'],$_GET['id'])) { ?>
                <button>ADOPT ME!</button>
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

        <?php $comments = getAllPetComments($pet['id']);
        drawAllPetComments($comments); 

        if(isset($_SESSION['username'])){
            if (!userOwnsPet($_SESSION['username'],$_GET['id'])) { 
                commentForm();
            } 
        } 
        else { ?>
            <p>Want to ask a question? <a href='login.php'>Log in</a></p>
        <?php } ?>
    </section>

<?php include_once('../templates/common/footer.php'); ?>