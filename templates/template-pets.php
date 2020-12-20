<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');    
?>

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
    <?php } 


    function drawPetPost($post){ ?>
        <a href="petprofile.php?id=<?=$post['id']?>">
            <article>
                <h2><?php echo htmlentities($post['name']) ?></h2>
                <img src="../images/pets/original/<?=$post['id']?>.jpg" alt="dog profile picture" width="80" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
                <p><?php echo htmlentities($post['bio']) ?></p>
                <?php if(!isset($_GET['id'])){ ?>
                    <a href="../actions/action_remove_pet.php?id=<?=$post['id']?>" >
                        <img src="../images/trash.png" alt="trash icon" width="20">
                    </a>
                <?php } ?>
            </article>
        </a>
    <?php }


    function drawAllPetPosts($posts, $user) { ?>
        <section id="posts">
            <h2 class="visually-hidden">User posts</h2>
            
            <?php foreach($posts as $post)
                drawPetPost($post, $user); ?>

        </section>
    <?php } 


    function drawPetActions($petID, $user) {
        if(isset($_SESSION['username'])){
            if (!userOwnsPet($_SESSION['username'],$petID)) { ?>
                <link rel="stylesheet" href="../css/petProfile_adopt.css"> 
                <form method="get" action="../actions/action_send_request.php">
                    <input type="hidden" name="pet_id" value=<?=$_GET['id']?>>
                    <input type="hidden" name="user_id" value=<?=getUser($_SESSION['username'])['id']?>>
                    <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                    <input type="submit" value="ADOPT ME">
                </form>
                <?php 
                if(!userLikesPet($user['id'],$petID)){?>
                    <form action="../actions/action_likeAnimal.php?petId=<?=$petID?>" method="post" enctype="multipart/form-data">
                       <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                       <button type="submit"><i class="far fa-heart"></i></button>
                    </form>
                <?php } else { ?>
                    <form action="../actions/action_dislikeAnimal.php?petId=<?=$petID?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                        <button type="submit"><i class="fas fa-heart"></i></button>
                    </form>
                <?php } ?>
            <?php } 
            else { ?>
                <link rel="stylesheet" href="../css/petProfile_edit.css"> 

                <form action="../pages/edit_pet_profile.php" method="get">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                    <input type="hidden" name="id" value="<?=$_GET['id']?>">
                    <input type="submit" value="Edit pet" />
                </form>
            <?php } 
        } 
    } 


    function drawCommentSection($pet) { ?>
        <section id='questions'>
            <h1>Any questions? Ask them down below</h1>
    
            <section id="comments">
                <h2 class="visually-hidden">Pet comments</h2>

                <?php $comments = getAllPetComments($pet['id']);
                drawAllPetComments($comments); 

                if(isset($_SESSION['username'])){
                    if (!userOwnsPet($_SESSION['username'],$_GET['id'])) { 
                        commentForm();
                    } 
                } 
                else { ?>
                    <p>Want to ask a question? <a href='login.php'>Log in</a></p>
                <?php } ?>

            </section>

        </section>
    <?php } 


    function drawPetComment($comment){ ?>
        <article>
            <!-- redirects to the profile?   <a href="../pages/userprofile"  -->
            <div>
                <a href="../pages/userprofile.php?id=<?php echo $comment['made_by']?>">
                    <img src="../images/accounts/small/<?php echo $comment['made_by']?>.jpg" alt="Profile picture of the user who made the question" width="40" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
                </a>
                <div>
                    <p><?php echo htmlentities($comment['question']) ?><p>
                    <p class="date"><?php echo htmlentities($comment['question_date']) ?><p>
                </div>

            </div>

            <?php if($comment['response'] !== NULL){ ?>
                <div>
                    <a href="../pages/userprofile.php?id=<?php echo $comment['answered_by']?>">
                        <img src="../images/accounts/small/<?php echo $comment['answered_by']?>.jpg" alt="Profile picture of the user who answered the question" width="40" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
                    </a>
                    <div>
                    <p><?php echo htmlentities($comment['response']) ?><p>
                    <p class="date"><?php echo htmlentities($comment['answer_date']) ?><p>
                    </div>
                </div>
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
    <?php }


    function drawAllPetComments($comments) { ?>            
            <?php foreach($comments as $comment)
                drawPetComment($comment); ?>
    <?php }


    function drawPetPhotoName($pet,$petID){ ?>
        <article>
            <a href="petprofile.php?id=<?=$petID?>">
                <img src="../images/pets/original/<?=$petID?>.jpg" alt="pet<?=$petID?>" width="150" height="150">
            </a>
            <h3><?=$pet['name']?></h3>
        </article>
    <?php } ?>


    

