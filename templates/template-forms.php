<?php
    include_once('database/db_pet.php');


    function drawSearchForm(){ ?>
        <form action="action_search.php" method="post">
            <label>Name
                <input id="name" type="search" name="name">
            </label>
            <label>Location
                <select id= "location" name="location">
                    <?php $locations = getAllPetLocations();
                    foreach($locations as $location) {?>
                        <option value="<?php echo $location['location']; ?>"><?php echo $location['location']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Species
                <select id="species" name="species">
                    <?php $all_species = getAllPetSpecies();
                    foreach($all_species as $species) {?>
                        <option value="<?php echo $species['species']; ?>"><?php echo $species['species']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Breed
                <select id="breed" name="breed">
                    <?php $breeds = getAllPetBreeds();
                    foreach($breeds as $breed) {?>
                        <option value="<?php echo $breed['breed']; ?>"><?php echo $breed['breed']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <label>Color
                <select id="color" name="color">
                    <?php $colors = getAllPetColors();
                    foreach($colors as $color) {?>
                        <option value="<?php echo $color['color']; ?>"><?php echo $color['color']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <input type="radio" name="sort" value="alphabetical" checked="checked">Sort by alphabetical order
            <input type="radio" name="sort" value="most recent">Sort by most recent
            <input type="submit" name="Search" value="Search">
        </form>
    <?php } 

?>
