<?php
    include_once('../database/db_pet.php');


    function drawSearchForm(){ ?>
        <form id="search_form">
            <label>Name
                <input id="name" type="search" name="name">
            </label>
            <label>Location
                <select id= "location" name="location">
                    <option value=""></option>
                    <?php $locations = getAllPetLocations();
                    foreach($locations as $location) {?>
                        <option value="<?php echo htmlentities($location['location']); ?>"><?php echo $location['location']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Species
                <select id="species" name="species">
                    <option value=""></option>
                    <?php $all_species = getAllPetSpecies();
                    foreach($all_species as $species) {?>
                        <option value="<?php echo htmlentities($species['species']); ?>"><?php echo $species['species']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Breed
                <select id="breed" name="breed">
                    <option value=""></option>
                    <?php $breeds = getAllPetBreeds();
                    foreach($breeds as $breed) {?>
                        <option value="<?php echo htmlentities($breed['breed']); ?>"><?php echo $breed['breed']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Color
                <select id="color" name="color">
                    <option value=""></option>
                    <?php $colors = getAllPetColors();
                    foreach($colors as $color) {?>
                        <option value="<?php echo htmlentities($color['color']); ?>"><?php echo $color['color']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Status
                <select id="status" name="status">
                    <option value=""></option>
                    <option value="for adoption">For adoption</option>
                    <option value="adopted">Adopted</option>
                </select>
            </label>
        </form>
    <?php } ?>

    <?php function commentForm(){ ?>
        <form id='add_comment' action="../actions/action_comment.php" method="post">
            <label>Question:
                <textarea name="question" rows="4" cols="50"></textarea>
            <label>
            <input type="hidden" name="pet_id" value="<?php echo $_GET['id'] ?>">
            <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
            <input id="send" type="submit" value="Send">
        </form>
    <?php } ?>

    <?php function replyForm($question_id){ ?>
        <form class='reply_comment' action="../actions/action_reply.php" method="post">
            <label>Reply:
                <input name="reply" type="text">
            <label>
            <input type="hidden" name="pet_id" value="<?php echo $_GET['id'] ?>">
            <input type="hidden" name="question_id" value="<?php echo $question_id ?>">
            <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
            <input type="submit" value="Submit">
        </form>
    <?php } ?>

<?php function drawAddAnimalForm() { ?>
    <form action="../actions/action-add-animal-adoption.php" method="get">
        <label>Name:
            <input type="text" name="name" pattern="[a-zA-Z\u00C0-\u00ff\s]+" required>
        </label>
        <label>Bio:
            <input type="text" name="bio" pattern="^[a-zA-Z\u00C0-\u00ff0-9,.!? ]*$" required>
        </label>
        <label>Gender:
            <input type="text" name="gender" pattern="[a-zA-Z\u00C0-\u00ff\s]+" required>
        </label>
        <label>Weight:
            <input type="text" name="weight" pattern="^\d+(\.\d+)*$" required>
        </label>
        <label>Height:
            <input type="text" name="height" pattern="^\d+(\.\d+)*$" required>
        </label>
        <label>Color:
            <input type="text" name="color" pattern="[a-zA-Z\u00C0-\u00ff\s]+" required>
        </label>
        <label>Species:
            <input type="text" name="species" pattern="[a-zA-Z\u00C0-\u00ff\s]+" required>
        </label>
        <label>Breed:
            <input type="text" name="breed" pattern="[a-zA-Z\u00C0-\u00ff\s]+" required>
        </label>
        <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
        <button type="submit"value="Submit">Submit</button>
    </form>
<?php } ?>


<?php function drawRegisterForm($cities) { ?>
    <section id="signup">
        <h2>Create Account</h2>
        <form action="../actions/action_signup.php" method="post">
            <label>Username:
                <input type="text" name="username" required>
            </label>
            <label>Email:
                <input type="text" name="email" required>
            </label>
            <label for="city">City:
                <select name="city" id="city">
                    <?php
                        foreach($cities as $city)
                            echo '<option value="'.htmlentities($city['city']).'">'.htmlentities($city['city']).'</option>';
                    ?>
                </select>
            </label>
            <label>Password:
                <input type="password" name="password" required>
            </label>
            <label>Repeat Password:
                <input type="password" name="password_check" required>
            </label>
            <div>
                <legend>I am a:</legend>
                <input type="radio" name="type" value="User" checked>User
                <input type="radio" name="type" value="Shelter">Shelter
            </div>
            <input type="submit" value="Send">
        </form>
    </section>
<?php } ?>