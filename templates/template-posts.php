<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');

    if (!isset($_SESSION['username']))
        die(header('Location: login.html'));
 
    $posts = getAllPetsForAdoption($_SESSION['username']); 
?>

    <?php function drawPetPost($post){ ?>
        <article>
            <h2><?php echo $post['name'] ?></h2>
            <img src="../images/<?=$post['id']?>.jpg" alt="dog profile picture" width="80">
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

    

