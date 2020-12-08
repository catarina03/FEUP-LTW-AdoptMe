<?php
    include('database/db_user.php');
    include_once('templates/common/header.php');
    include_once('templates/template-posts.php');

    $webPets = getAllPetsPostsFromWebsite();
    
?>

<?php foreach($webPets as $webPet) { ?>
    <a href="petprofile.php?id=<?=$webPet['id']?>">
        <img src="images/pets/original/<?=$webPet['id']?>.jpg" alt="pet<?=$webPet['id']?>" width="100" height="100">
    </a>
<?php } ?>

<?php   
    include_once('templates/common/footer.php');
?>
