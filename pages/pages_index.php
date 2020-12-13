<link rel="stylesheet" href="../css/index.css" > 

<?php
    include('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../templates/tpl_petprofile.php');

    
    $webPets = getAllPetsPostsFromWebsite();
    
?>
<div id="main">
    <?php foreach($webPets as $webPet) { 
        drawPetPhotoName($webPet,$webPet['id']);
    }?>
   
</div>
<?php   
    include_once('../templates/common/footer.php');
?>
