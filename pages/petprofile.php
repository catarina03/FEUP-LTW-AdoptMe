<link rel="stylesheet" href="../css/petProfile.css"> 

<?php 
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../templates/tpl_petprofile.php');

    $petID = $_GET['id'];
    $pet = getPetInfo($petID);
?>

    <section id='main'>
        <?php drawPetProfile($pet,$petID); ?>
        
        <button>ADOPT ME!</button>
        <form action="../actions/action_loveAnimal.php?petId=<?=$petID?>" method="get" enctype="multipart/form-data">
            <button type="submit"><i class="fas fa-heart"></i></button>
        </form>
    </section>

<?php include_once('../templates/common/footer.php'); ?>