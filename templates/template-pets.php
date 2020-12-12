<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');

    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));
 
    $posts = getAllPetsForAdoption($_SESSION['username']); 
?>

    <?php function drawPetPost($post){ ?>
        <article>
            <h2><?php echo $post['name'] ?></h2>
            <img src="../images/dog1.jpg" alt="dog profile picture" width="80">
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


    <?php function drawPetComment($comment){ ?>
        <article>
            <!-- redirects to the profile?   <a href="../pages/userprofile"  -->
            <img src="../images/accounts/small/<?php echo $comment['made_by']?>.jpg" alt="Profile picture of the user who made the question" width="40">
            <p><?php echo $comment['question'] ?><p>
            <p class="date"><?php echo $comment['question_date'] ?><p>
            <img src="../images/accounts/small/<?php echo $comment['answered_by']?>.jpg" alt="Profile picture of the user who answered the question" width="40">
            <?php if($comment['response'] !== NULL){ ?>
                <p><?php echo $comment['response'] ?><p>
                <p class="date"><?php echo $comment['answer_date'] ?><p>
            <?php }
            else{ ?>
                <p>This questions hasn't been answered yet<p>
            <?php } ?>
        </article>
    <?php } ?>


    <?php function drawAllPetComments($comments) { ?>            
            <?php foreach($comments as $comment)
                drawPetComment($comment); ?>
    <?php } ?>


    

