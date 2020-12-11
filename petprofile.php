<?php 
    include_once('database/connection.php'); 
    include_once('templates/common/header.php');
?>

    <section id='main'>
        <h2 class="visually-hidden">Pet profile</h2>
        <img src="images/original/<?=$_GET['id']?>.jpg" alt="dog image " width="130">
        <article id="pet">

        <?php
            $stmt = $db->prepare(
                'SELECT 
                pet.name AS name,
                breed.name AS race,
                gender,weight,height,color
                FROM pet JOIN breed ON breed_id=breed.id
                WHERE pet.id=?'
            );

            $stmt->execute(array($_GET['id']));
            $pet = $stmt->fetch();
        ?>
                
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
</body>

</html>