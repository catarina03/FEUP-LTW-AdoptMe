<?php function drawUserProfile($user){ ?>
    <header>
        <img src="../images/accounts/small/<?=$user['id']?>.jpg" alt="profile picture" width="80" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
        <h2><?php echo htmlentities($user['name']) ?></h2>
    </header>
    <p id="bio"><?php echo htmlentities($user['bio']) ?></p>
    <p id="location"><?php echo htmlentities($user['city']) ?></p>
<?php } 


function drawProposals($proposals) { ?>
    <h2>Proposals</h2>
    <ul>
    <?php foreach($proposals as $proposal) { ?>
        <?php $user_name = getUserById($proposal['made_adoption_proposal'])['name'] ?> 
        <li>
            <p><?=$user_name?><?=' wants to adopt '. getPetInfo($proposal['pet_id'])['name']?></p>
            <form action="../actions/action_accept_adoption_request.php" method="get">
                <input type="submit" name="acceptance" value="Accept">
                <input type="submit" name="acceptance" value="Refuse">
                <input type="hidden" name="proposal" value="<?php echo urlencode(serialize($proposal)); ?>">
                <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
            </form>
        </li>
    <?php } ?>
    </ul>

<?php } 


function drawUserActions() {
    if(!isset($_GET['id'])){ ?>
        <form action="edit_profile.php" method="post">
            <input type="submit" value="Edit Profile">
            <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
        </form>
        <form action="add-animal-adoption.php" method="post">
            <input type="submit" value="Add Animal">
            <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
        </form>
    <?php } 
} 


function drawFavoritesSection($favs) { ?>
    <!--Só mostra caso a lista de favoritos não seja nula-->
    <div id="favourite">
        <?php if(!isset($_GET['id'])){ ?>
            <?php if($favs!=NULL){?>
                <h2 id="fav">Favourites</h2>
                <?php foreach($favs as $favID) { 
                    $favInfo = getPetInfo($favID['pet_id']);
                    drawPetPhotoName($favInfo,$favID['pet_id']);
                }
            }
        } ?>
    </div>  
<?php } 


function drawProposalSection($proposals) { ?>
    <div id="proposal">
        <?php if(!isset($_GET['id'])){ ?>
            <?php if($proposals!=NULL){
                drawProposals($proposals); 
            }
        } ?>
    </div>  
<?php } ?>