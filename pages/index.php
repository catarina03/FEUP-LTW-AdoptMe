<?php
    include('../database/db_user.php');
    include_once('../templates/common/header.php');
    
    $webPets = getAllPetsPostsFromWebsite();
    
?>

<ul class="container">
<?php foreach($webPets as $webPet) { ?>
    <li>
        <a href="petprofile.php?id=<?=$webPet['id']?>">
            <img src="../images/pets/original/<?=$webPet['id']?>.jpg" alt="pet<?=$webPet['id']?>" width="100" height="100">
        </a>
        <h3><?=$webPet['name']?></h3>
    </li>
<?php } ?>
</ul>

<?php   
    include_once('../templates/common/footer.php');
?>
