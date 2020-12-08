<?php
    include_once('../database/connection.php');

    /**
     * Verifies if a certain username, password combination
     * exists in the database. Use the sha1 hashing function.
     */
    function checkUserPassword($email, $password) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM account WHERE email = ? AND password = ?');
        $stmt->execute(array($email, $password)); //sha1($password))
        return $stmt->fetch()?true:false; // return true if a line exists
    }

    function getUser($email){
        global $db;
        $stmt = $db->prepare('SELECT account.id AS id, name, account.bio AS bio, location.city AS city 
            FROM account 
            INNER JOIN person 
            ON account.id = person.account_id
            INNER JOIN location
            ON location.id = person.location_id
            WHERE account.email = ?');
        $stmt->execute(array($email)); 
        return $stmt->fetch(); 
    }

    function getAllPetsForAdoption($email){
        global $db;
        $stmt = $db->prepare('SELECT pet.name AS name, pet.bio AS bio, pet.gender AS gender, pet.weight AS weight, 
        pet.height AS  height, pet.color AS color, breed.type AS type, breed.name AS breed
        FROM account 
        INNER JOIN pet 
        ON account.id = pet.has_for_adoption
        INNER JOIN breed
        ON pet.breed_id = breed.id
        WHERE account.email = ?');
    $stmt->execute(array($email)); 
    return $stmt->fetchAll(); 
    }

    function getAllCities(){
        global $db;
        $stmt = $db->prepare('SELECT city FROM location');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getPetInfo($petID){
        global $db;
        $stmt = $db->prepare(
            'SELECT 
            pet.name AS name,
            breed.name AS race,
            gender,weight,height,color
            FROM pet JOIN breed ON breed_id=breed.id
            WHERE pet.id=?'
        );

        $stmt->execute(array($petID));
        return $stmt->fetch();
    }
?>