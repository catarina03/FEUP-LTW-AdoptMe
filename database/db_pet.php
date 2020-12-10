<?php
    include_once('database/connection.php');

    function getAllPets(){
        global $db;
        $stmt = $db->prepare('SELECT pet.name AS name, location.city AS location, breed.species AS species, breed.name AS breed, pet.color AS color
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
        $stmt = $db->prepare("SELECT pet.name AS name, location.city AS location, breed.species AS species, breed.name AS breed, pet.color AS color
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



?>