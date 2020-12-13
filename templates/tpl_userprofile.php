<?php function drawUserProfile($user){ ?>
    
        <header>
            <img src="../images/accounts/small/<?=$user['id']?>.jpg" alt="profile picture" width="80" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
            <h2><?php echo $user['name'] ?></h2>
        </header>
        <p id="bio"><?php echo $user['bio'] ?></p>
        <p id="location"><?php echo $user['city'] ?></p>
        <div id="user_info">
            <h3>XX followers</h3>
            <h3>XX following</h3>
        </div>

<?php } ?>

<?php function drawProposals($proposals) { ?>
   
    <ul>
    <?php foreach($proposals as $proposal) { ?>
        <li>
            <p><?=$proposal['date']?><?=' ==> '. getPetInfo($proposal['pet_id'])['name']?></p>
            <form action="../actions/action_accept_adoption_request.php" method="post">
                <input type="submit" name="acceptance" value="Accept">
                <input type="submit" name="acceptance" value="Refused">
                <input type="hidden" name="proposal" value="<?php echo htmlentities(serialize($proposal)); ?>">
            </form>
        </li>
    <?php } ?>
    </ul>

<?php } ?>