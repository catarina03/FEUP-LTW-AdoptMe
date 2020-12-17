<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');    
?>

    <?php function drawPetPost($post){ ?>
        <article>
            <h2><?php echo htmlentities($post['name']) ?></h2>
            <a href="petprofile.php?id=<?=$post['id']?>">
            <img src="../images/pets/original/<?=$post['id']?>.jpg" alt="dog profile picture" width="80" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
            <p><?php echo htmlentities($post['bio']) ?></p>
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
            <div>
            <a href="../pages/userprofile.php?id=<?php echo $comment['made_by']?>">
                <img src="../images/accounts/small/<?php echo $comment['made_by']?>.jpg" alt="Profile picture of the user who made the question" width="40">
            </a>
            <p><?php echo htmlentities($comment['question']) ?><p>
            </div>
            <p class="date"><?php echo htmlentities($comment['question_date']) ?><p>
            
            <?php if($comment['response'] !== NULL){ ?>
                <div>
                <a href="../pages/userprofile.php?id=<?php echo $comment['answered_by']?>">
                    <img src="../images/accounts/small/<?php echo $comment['answered_by']?>.jpg" alt="Profile picture of the user who answered the question" width="40">
                </a>
                <p><?php echo htmlentities($comment['response']) ?><p>
                </div>
                <p class="date"><?php echo htmlentities($comment['answer_date']) ?><p>
                
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

    <?php function drawPetPhotoName($pet,$petID){ ?>
        <article>
            <a href="petprofile.php?id=<?=$petID?>">
                <img src="../images/pets/original/<?=$petID?>.jpg" alt="pet<?=$petID?>" width="150" height="150">
            </a>
            <h3><?=$pet['name']?></h3>
        </article>
    <?php }?>


    

