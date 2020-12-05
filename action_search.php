<?php
    include_once('includes/init.php');
    include_once('database/db_user.php');

    if(isset($_POST['Search'])){
        $name = $_POST['name'];
        $location = $_POST['location'];
        $species = $_POST['species'];
        $breed = $_POST['breed'];
        $color = $_POST['color'];
        $sort = $_POST['sort'];
    }

    echo $name;
    echo $location;
    echo $species;
    echo $breed;
    echo $color;
    echo $sort;

    global $db;
    $stmt = $db->prepare('SELECT pet.name AS name, pet.bio AS bio, pet.gender AS gender, pet.weight AS weight, 
        pet.height AS  height, pet.color AS color, breed.species AS species, breed.name AS breed
        FROM pet 
        INNER JOIN breed
        ON pet.breed_id = breed.id
        WHERE breed.species = ?');
    $stmt->execute(array($species)); 
    $all_species = $stmt->fetchAll(); 


    

    foreach($all_species as $one_species){
        echo $one_species['name'];
        echo $one_species['breed']; 
    }




    

?>