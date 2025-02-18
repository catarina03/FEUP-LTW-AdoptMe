<?php function drawPetProfile($pet,$petID) { ?>
    <div>
    <h2 class="visually-hidden">Pet profile</h2>
    <img src="../images/pets/original/<?=$petID?>.jpg" alt="pet image" height="200" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
    <article id="description">
                
        <h2><?=htmlentities($pet['name'])?></h2>
        <h3><?=htmlentities($pet['species'])?></h3>
        <h3><?=htmlentities($pet['breed'])?></h3>
        <h3><?=htmlentities($pet['color'])?></h3>
        <h3><?=htmlentities($pet['weight'])?> kg</h3>
        <h3><?=htmlentities($pet['height'])?> cm</h3>
        <h3><?=htmlentities($pet['gender'])?></h3>
        <p><?=htmlentities($pet['bio'])?></p>
    </article>
</div>
<?php } ?>