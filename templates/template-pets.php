<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
 
    if(isset($_SESSION['username'])){
        $user = getUser($_SESSION['username']); 
    }
?>

    <?php function drawPetPost($post){ ?>
        <article>
            <h2><?php echo $post['name'] ?></h2>
            <a href="edit_pet_profile.php?id=<?=$post['id']?>">
            <img src="../images/pets/original/<?=$post['id']?>.jpg" alt="dog profile picture" width="80" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
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

            <?php if($comment['response'] !== NULL){ ?>
                <img src="../images/accounts/small/<?php echo $comment['answered_by']?>.jpg" alt="Profile picture of the user who answered the question" width="40">
                <p><?php echo $comment['response'] ?><p>
                <p class="date"><?php echo $comment['answer_date'] ?><p>
            <?php }
            else{ 
                $owner = getPetOwner($comment['pet_id']);
                if(isset($_SESSION['username'])){
                    if($owner['owner_email'] === $_SESSION['username']){
                        replyForm($comment['question_id']);
                    }
                }
                else{ ?>
                    <p>This questions hasn't been answered yet<p>
                <?php } 
            } ?>
        </article>
    <?php } ?>

    <?php function drawAllPetComments($comments) { ?>            
            <?php foreach($comments as $comment)
                drawPetComment($comment); ?>
    <?php } ?>


    

