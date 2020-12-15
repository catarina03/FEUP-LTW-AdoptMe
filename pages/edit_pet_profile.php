<link rel="stylesheet" href="../css/petProfile.css" > 

<?php
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../templates/tpl_petprofile.php');
    include_once('../includes/validate_input.php');

    if(!validInput())
        die(header('Location: ../pages/login.php'));

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    if(!userOwnsPet($_SESSION['username'],$_GET['id']))
        die(header('Location: ../pages/login.php'));

    $petID = $_GET['id'];
    $pet = getPetInfo($petID);
    
?>

<section id='main'>
    <?php drawPetProfile($pet,$petID); ?>


    <form action="../actions/action_upload_pet_pic.php?id=<?=$petID?>" method="post" enctype="multipart/form-data">
            <label>Insert new pet picture:
                <input type="file" name="image">
                <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
            </label>
            <input type="submit" value="Upload">
    </form>
</section>

<?php include_once('../templates/common/footer.php')?>
    
