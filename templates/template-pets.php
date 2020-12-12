<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');

    if (!isset($_SESSION['username']))
        die(header('Location: login.html'));
 
    $posts = getAllPetsForAdoption($_SESSION['username']);
?>

    <?php function drawPetPost($post){ ?>
        <article>
<<<<<<< HEAD:templates/template-posts.php
            <h2><?php echo $post['name'] ?></h2>
            <a href="edit_pet_profile.php?id=<?=$post['id']?>">
            <img src="../images/pets/small/<?=$post['id']?>.jpg" alt="dog profile picture" width="80" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
=======
            <img src="../images/dog1.jpg" alt="dog profile picture" width="80">
            <h2><?php echo $post['name'] ?></h2>
>>>>>>> main:templates/template-pets.php
            <p><?php echo $post['bio'] ?></p>
        </article>
    <?php } ?>


    <?php function drawAllPetPosts($posts) { ?>
        <section id="posts">
            <h2 class="visually-hidden">User posts</h2>
            
            <?php foreach($posts as $post)
                drawPetPost($post); ?>

        </section>
    <?php } ?>

    

