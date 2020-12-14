<?php function drawPetProfile($pet,$petID) { ?>
    <div>
    <h2 class="visually-hidden">Pet profile</h2>
    <img src="../images/pets/original/<?=$petID?>.jpg" alt="dog image " width="160" height="180" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
    <article id="description">
                
        <h2><?=$pet['name']?></h2>
        <h3><?=$pet['race']?></h3>
        <h3><?=$pet['color']?></h3>
        <h3><?=$pet['weight']?> kg</h3>
        <h3><?=$pet['height']?> cm</h3>
        <h3><?=$pet['gender']?></h3>

        <p><?=$pet['bio']?></p>
    </article>
</div>
<?php } ?>

<?php function drawPetPhotoName($pet,$petID){ ?>
    <article>
        <a href="petprofile.php?id=<?=$petID?>">
            <img src="../images/pets/original/<?=$petID?>.jpg" alt="pet<?=$petID?>" width="150" height="150">
        </a>
        <h3><?=$pet['name']?></h3>
    </article>
<?php }?>