<link rel="stylesheet" href="../css/index.css" > 

<?php
    include('../database/db_user.php');
    include_once('../templates/common/header.php');
    
    $webPets = getAllPetsPostsFromWebsite();
    
?>
<div id="main">
    <?php foreach($webPets as $webPet) { ?>
    <article>
    <a href="petprofile.php?id=<?=$webPet['id']?>">
        <img src="../images/pets/original/<?=$webPet['id']?>.jpg" alt="pet<?=$webPet['id']?>" width="150" height="150">
    </a>
    <h3><?=$webPet['name']?></h3>
    </article>
<?php } ?>
</div>
<?php   
    include_once('../templates/common/footer.php');
?>
