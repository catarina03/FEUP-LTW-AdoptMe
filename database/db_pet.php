<?php
    include_once('../database/connection.php');

    function getAllPets(){
        global $db;
        $stmt = $db->prepare('SELECT pet.id AS id, pet.name AS name, location.city AS location, breed.species AS species, breed.name AS breed, pet.color AS color, pet.has_for_adoption AS status
            FROM pet INNER JOIN breed ON pet.breed_id = breed.id
            INNER JOIN person ON (pet.has_for_adoption = person.person_id OR pet.adopted = person.person_id)
            INNER JOIN location ON person.location_id = location.id;');
        $stmt->execute(); 
        return $stmt->fetchAll(); 
    }

    function getAllPetLocations(){
        global $db;
        $stmt = $db->prepare('SELECT location.city as location FROM location');
        $stmt->execute(); 
        return $stmt->fetchAll(); 
    }

    function getAllPetSpecies(){
        global $db;
        $stmt = $db->prepare('SELECT DISTINCT breed.species AS species FROM breed');
        $stmt->execute(); 
        return $stmt->fetchAll(); 
    }

    function getAllPetBreeds(){
        global $db;
        $stmt = $db->prepare('SELECT DISTINCT breed.name AS breed FROM breed');
        $stmt->execute(); 
        return $stmt->fetchAll(); 
    }

    function getAllPetColors(){
        global $db;
        $stmt = $db->prepare('SELECT DISTINCT pet.color AS color FROM pet');
        $stmt->execute(); 
        return $stmt->fetchAll(); 
    }

    function getAllPetComments($pet_id){
        global $db;
        $stmt = $db->prepare("SELECT pet.id AS pet_id, 
            questions.question AS question, 
            questions.made_by AS made_by, 
            questions.question_date AS question_date, 
            questions.response AS response, 
            questions.answered_by AS answered_by, 
            questions.answer_date AS answer_date,
            questions.id AS question_id FROM pet
            INNER JOIN questions ON pet.id = questions.about
            WHERE pet.id = (?)");
        $stmt->execute(array("$pet_id"));
        return $stmt->fetchAll();
    }

    function getPetsByBreed($breed){
        global $db;
        $stmt = $db->prepare("SELECT pet.name AS name
            FROM pet INNER JOIN breed ON pet.breed_id = breed.id
            WHERE breed.name = (?)");
        $stmt->execute(array("$breed"));
        return $stmt->fetchAll();
    }

    function getPetsByColor($color){
        global $db;
        $stmt = $db->prepare("SELECT pet.name AS name FROM pet WHERE pet.color = (?)");
        $stmt->execute(array("$color"));
        $result = $stmt->fetchAll();
    }

    //Complicates to much and returns only pets for adoption, must change
    function getPetsByLocation($location){
        global $db;
        $stmt = $db->prepare("SELECT pet.name AS name, location.city AS city FROM pet 
            INNER JOIN account ON pet.has_for_adoption = account.id 
            INNER JOIN person ON account.id = person.account_id
            INNER JOIN location ON location.id = person.location_id
            WHERE location.city = (?)
            
            UNION
            
            SELECT pet.name AS name, location.city AS city FROM pet 
            INNER JOIN account ON pet.has_for_adoption = account.id 
            INNER JOIN shelter ON account.id = shelter.account_id
            INNER JOIN location ON location.id = shelter.location_id
            WHERE location.city = (?)");
        $stmt->execute(array("$location", "$location"));
        return $stmt->fetchAll();
    }

    function getPetsByName($name){
        global $db;
        $stmt = $db->prepare("SELECT pet.id AS id, pet.name AS name, location.city AS location, breed.species AS species, breed.name AS breed, pet.color AS color, pet.has_for_adoption AS status
            FROM pet INNER JOIN breed ON pet.breed_id = breed.id
            INNER JOIN person ON (pet.has_for_adoption = person.person_id OR pet.adopted = person.person_id)
            INNER JOIN location ON person.location_id = location.id
            WHERE upper(pet.name) LIKE upper(?)");
        $stmt->execute(array("$name%"));
        return $stmt->fetchAll();
    }

    function getPetsBySpecies($species){
        global $db;
        $stmt = $db->prepare("SELECT pet.name AS name, location.city AS location, breed.species AS species
            FROM pet INNER JOIN breed ON pet.breed_id = breed.id
            INNER JOIN person ON (pet.has_for_adoption = person.person_id OR pet.adopted = person.person_id)
            INNER JOIN location ON person.location_id = location.id
            WHERE breed.species = (?)");
        $stmt->execute(array("$species"));
        return $stmt->fetchAll();
    }

    function getPetOwner($pet){
        global $db;
        $stmt = $db->prepare("SELECT account.email AS owner_email 
            FROM pet INNER JOIN account ON pet.adopted = account.id
            WHERE pet.id = (?)
            
            UNION
            
            SELECT account.email AS owner_email 
            FROM pet INNER JOIN account ON pet.has_for_adoption = account.id
            WHERE pet.id = (?)");
        $stmt->execute(array("$pet", "$pet"));
        return $stmt->fetch();
    }

    function addComment($pet_id, $question, $user_id){
        $date = date("Y-m-d H:i:s");

        global $db;
        $stmt = $db->prepare("INSERT INTO questions (question, question_date, made_by, about) VALUES (?, ?, ?, ?)");
        $stmt->execute(array("$question", "$date", "$user_id", "$pet_id"));
        return $stmt->fetchAll();
    }


    function removeComment($id, $question, $made_by){
        global $db;
        $stmt = $db->prepare("DELETE FROM questions WHERE question = ?, made_by = ?, about = ?");
        $stmt->execute(array($question, $made_by, $id));
    }


    function addReply($question_id, $reply, $user_id){
        $date = date("Y-m-d H:i:s");

        global $db;
        $stmt = $db->prepare("UPDATE questions SET response = ?, answer_date = ?, answered_by = ? WHERE id = ?;");
        return $stmt->execute(array("$reply", "$date", "$user_id", "$question_id"));
    }


    function getBiggestSpeciesId() {
        global $db;
        $stmt = $db->prepare('SELECT max(id) AS id FROM breed');
        $stmt->execute();
        $id = $stmt->fetch();

        return $id;
    }

    function getBreedId($breed, $species) {
        global $db;
        $stmt = $db->prepare('SELECT id FROM breed where name = upper(?) AND species = upper(?)');
        $stmt->execute(array("$breed", "$species"));
        $result = $stmt->fetch()?true:false;

        if ($result) {
            $stmt = $db->prepare('SELECT id FROM breed where name = upper(?) AND species = upper(?)');
            $stmt->execute(array($breed, $species));
            $breed_id = $stmt->fetch();
        }
        else {
            $lastSpeciesId = getBiggestSpeciesId();

            $breed_id = implode($lastSpeciesId) + 1;
            $stmt = $db->prepare('INSERT INTO breed VALUES (?, ?, ?)');
            $stmt->execute(array("$breed_id", "$species", "$breed"));
        }

        return $breed_id;
    }


    function createArrayWithPetInfo() {
        $animal['name'] = $_GET['name'];
        $animal['bio'] = $_GET['bio'];
        $animal['gender'] = $_GET['gender'];
        $animal['weight'] = $_GET['weight'];
        $animal['height'] = $_GET['height'];
        $animal['color'] = $_GET['color'];
        $animal['breed'] = getBreedId($_GET['breed'], $_GET['species']);

        return $animal;
    }


    function getBiggestPetId() {
        global $db;
        $stmt = $db->prepare('SELECT max(id) AS id FROM pet');
        $stmt->execute();
        $id = $stmt->fetch();

        return $id;
    }

    
    function createArrayWithAnimalInfo() {
        $animal['id'] = (int)implode(getBiggestPetId()) + 1;
        $animal['name'] = $_GET['name'];
        $animal['bio'] = $_GET['bio'];
        $animal['gender'] = $_GET['gender'];
        $animal['weight'] = $_GET['weight'];
        $animal['height'] = $_GET['height'];
        $animal['color'] = $_GET['color'];
        $animal['breed'] = getBreedId($_GET['breed'], $_GET['species']);
        $animal['has_for_adoption'] = getUser($_SESSION['username'])['id'];
        $animal['adopted'] = NULL;

        return $animal;
    }
?>