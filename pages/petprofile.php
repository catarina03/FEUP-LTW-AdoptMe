<?php 
    include_once('../database/db_user.php');
    include_once('../database/db_pet.php');
    include_once('../templates/common/header.php');
    include_once('../templates/template-pets.php');

    $pet = getPetInfo($_GET['id']);
?>

    <section id='main'>
        <h2 class="visually-hidden">Pet profile</h2>
        <img src="../images/pets/original/<?=$_GET['id']?>.jpg" alt="dog image " width="130" height="180">
        <article id="pet">
                
            <h2><?=$pet['name']?></h2>
            <h3><?=$pet['race']?></h3>
            <h3><?=$pet['color']?></h3>
            <h3><?=$pet['weight']?> kg</h3>
            <h3><?=$pet['height']?> cm</h3>
            <h3><?=$pet['gender']?></h3>

            <p>iognerwogn onerougnweornpgwenrgnregn erughre guerwhguehru ghreuogh rehuoewrhguowheurog rehg uehru hewruhgeur huerh</p>
        </article>
        <button>ADOPT ME!</button>
    </section>

    <?php $comments = getAllPetComments($pet['id']);
    drawAllPetComments($comments); ?>

<?php include_once('../templates/common/footer.php'); ?>