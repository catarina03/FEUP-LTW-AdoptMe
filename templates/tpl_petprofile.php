<?php function drawPetProfile($pet,$petID) { ?>
    <div>
    <h2 class="visually-hidden">Pet profile</h2>
    <img src="../images/pets/original/<?=$petID?>.jpg" alt="dog image " width="130" height="180" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
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