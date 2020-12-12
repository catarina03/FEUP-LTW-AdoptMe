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
                        <option value="<?php echo $location['location']; ?>"><?php echo $location['location']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Species
                <select id="species" name="species">
                    <option value=""></option>
                    <?php $all_species = getAllPetSpecies();
                    foreach($all_species as $species) {?>
                        <option value="<?php echo $species['species']; ?>"><?php echo $species['species']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Breed
                <select id="breed" name="breed">
                    <option value=""></option>
                    <?php $breeds = getAllPetBreeds();
                    foreach($breeds as $breed) {?>
                        <option value="<?php echo $breed['breed']; ?>"><?php echo $breed['breed']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Color
                <select id="color" name="color">
                    <option value=""></option>
                    <?php $colors = getAllPetColors();
                    foreach($colors as $color) {?>
                        <option value="<?php echo $color['color']; ?>"><?php echo $color['color']; ?></option>
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
            <input type="submit" value="Send">
        </form>
    <?php } ?>