<?php include_once('database/connection.php'); ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>ONLINE ANIMAL ADOPTION</title>
    <meta charset="utf-8">
</head>

<body>
    <header>
        <a href="index.html">
            <img alt="logo image" src="images/logo.png" width="80">
        </a>
        <nav class='logged out'>
            <a href="login.html">Log in</a>
            <a href="register.php">Sign up</a>
        </nav>
        <a class="logged in" href="userprofile.php">
            <img alt="User profile" src="images/profile_photo.jpg" width="40" height="40">
        </a>
        <a href="search.html">
            <img alt="search" src="images/search_icon.png" width="100" height="100">
        </a>
        <h1>ADOPT ME!</h1>
    </header>
    <section id='main'>
        <h2 class="visually-hidden">Pet profile</h2>
        <img src="images/pets/original/<?=$_GET['id']?>.jpg" alt="dog image " width="130" height="180">
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