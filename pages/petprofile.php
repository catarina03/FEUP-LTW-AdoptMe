<?php 
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../includes/init.php');

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

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
        <form method="get" action="../actions/action_accept_adoption_request.php">
            <input type="hidden" name="pet_id" value=<?=$_GET['id']?>>
            <input type="hidden" name="user_id" value=<?=getUser($_SESSION['username'])['id']?>>
            <input type="submit" value="ADOPT ME">
        </form>
    </section>

<?php include_once('../templates/common/footer.php'); ?>