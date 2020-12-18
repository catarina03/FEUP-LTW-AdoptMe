<link rel="stylesheet" href="../css/index.css" > 

<?php
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/template-pets.php');

    
    $webPets = getAllPetsPostsFromWebsite();
    
?>
<head>
    <title>  Adopt Me!</title>
</head>

<?php  include_once('../templates/common/header.php');?>

<div id="main">
    <?php foreach($webPets as $webPet) { 
        drawPetPhotoName($webPet,$webPet['id']);
    }?>
   
</div>
<?php   
    include_once('../templates/common/footer.php');
?>
