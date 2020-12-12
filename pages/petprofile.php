<link rel="stylesheet" href="../css/petProfile.css"> 

<?php 
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
<<<<<<< HEAD
 
    $pet = getPetInfo($_GET['id']);
=======
    include_once('../templates/tpl_petprofile.php');

    $petID = $_GET['id'];
    $pet = getPetInfo($petID);
>>>>>>> ad9249a8dc125439eb996bfc93140ea10e0983b3
?>

    <section id='main'>
        <?php drawPetProfile($pet,$petID); ?>
        <button>ADOPT ME!</button>
    </section>

<?php include_once('../templates/common/footer.php'); ?>