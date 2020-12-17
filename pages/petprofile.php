<link rel="stylesheet" href="../css/petProfile.css"> 

<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../database/db_pet.php');
    include_once('../templates/common/header.php');
    include_once('../templates/template-forms.php');
    include_once('../templates/tpl_petprofile.php');
    include_once('../includes/init.php');
    include_once('../templates/template-pets.php');

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    $user = getUser($_SESSION['username']);
    $petID = $_GET['id'];
    $pet = getPetInfo($petID);
?>

    <section id='main'>
        <?php drawPetProfile($pet,$petID);

        if(isset($_SESSION['username'])){
            if (!userOwnsPet($_SESSION['username'],$petID)) { ?>
                <form method="get" action="../actions/action_send_request.php">
                    <input type="hidden" name="pet_id" value=<?=$_GET['id']?>>
                    <input type="hidden" name="user_id" value=<?=getUser($_SESSION['username'])['id']?>>
                    <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                    <input type="submit" value="ADOPT ME">
                </form>
                <?php 
                if(!userLikesPet($user['id'],$petID)){?>
                    <form action="../actions/action_likeAnimal.php?petId=<?=$petID?>" method="post" enctype="multipart/form-data">
                       <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                       <button type="submit"><i class="far fa-heart"></i></button>
                    </form>
                <?php } else { ?>
                    <form action="../actions/action_dislikeAnimal.php?petId=<?=$petID?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                        <button type="submit"><i class="fas fa-heart"></i></button>
                    </form>
                <?php } ?>
        <?php } 
            else { ?>
                <form action="../actions/action_upload_pet_pic.php?id=<?=$petID?>" method="post" enctype="multipart/form-data">
                    <label>Insert new pet picture:
                        <input type="file" name="image">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                    </label>
                    <input type="submit" value="Upload">
                </form>
            <?php } 
        } ?>
        <hr>
        <section id='questions'>
            <h1>Any questions? Ask them down below</h1>
      
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
        </section>

    </section>


<?php include_once('../templates/common/footer.php'); ?>