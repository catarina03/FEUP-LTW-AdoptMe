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
        <?php $user_name = getUserById($proposal['made_adoption_proposal'])['name'] ?> 
        <li>
            <p><?=$user_name?><?=' ==> '. getPetInfo($proposal['pet_id'])['name']?></p>
            <form action="../actions/action_accept_adoption_request.php" method="get">
                <input type="submit" name="acceptance" value="Accept">
                <input type="submit" name="acceptance" value="Refuse">
                <input type="hidden" name="proposal" value="<?php echo urlencode(serialize($proposal)); ?>">
                <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
            </form>
        </li>
    <?php } ?>
    </ul>

<?php } ?>