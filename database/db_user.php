<?php
    include_once('../database/connection.php');

    function checkUserPassword($email, $password) {
        global $db;
        $stmt = $db->prepare('SELECT password FROM account WHERE email = ?');
        $stmt->execute(array($email));


        $fetched = $stmt->fetch();
        if($fetched!==false)
            return password_verify($password,$fetched['password']);

        return false;
    }


    function checkUser($email) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM account WHERE email = ?');
        $stmt->execute(array($email));
        return $stmt->fetch()?true:false; 
    }


    function addAccount($email, $password) {
        global $db;
        if (checkUser($email)){
            throw new PDO('Email already in use');
            return false;
        }
        else {
            $stmt = $db->prepare('INSERT INTO account VALUES(NULL,?,?, NULL)');
            $stmt->execute(array($email, $password));
            return true;
        }
    }


    function getUser($email){
        global $db;
        $stmt = $db->prepare('SELECT account.id AS id, name, account.bio AS bio, location.city AS city, account.email AS email 
            FROM account 
            INNER JOIN person 
            ON account.id = person.account_id
            INNER JOIN location
            ON location.id = person.location_id
            WHERE account.email = ?');
        $stmt->execute(array($email)); 
        return $stmt->fetch(); 
    }
    
    function getUserById($user_id) {
        global $db;
        
        $stmt = $db->prepare('SELECT p.name FROM person p, shelter s WHERE p.person_id = ? or s.shelter_id = ?');
        $stmt->execute(array($user_id));

        return $stmt->fetch(); 
    }


    function getAllPetsForAdoption($email){
        global $db;
        $stmt = $db->prepare('SELECT pet.id AS id, pet.name AS name, pet.bio AS bio, pet.gender AS gender, pet.weight AS weight,
            pet.height AS  height, pet.color AS color, breed.species AS species, breed.name AS breed
            FROM account 
            INNER JOIN pet 
            ON account.id = pet.has_for_adoption
            INNER JOIN breed
            ON pet.breed_id = breed.id
            WHERE account.email = ?'
        );
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
            pet.id AS id,
            pet.name AS name,
            pet.bio AS bio,
            breed.name AS race,
            gender,weight,height,color
            FROM pet JOIN breed ON breed_id=breed.id
            WHERE pet.id=?'
        );

        $stmt->execute(array($petID));
        return $stmt->fetch();
    }


    function getAllPetsPostsFromWebsite() { 
        global $db;
        $stmt = $db->prepare('SELECT DISTINCT P.id, P.name 
                            FROM shelter S, person Per, pet P 
                            WHERE Per.account_id = P.has_for_adoption or
                                S.account_id = P.has_for_adoption'
                            );
        $stmt->execute();
        $pets = $stmt->fetchAll();
        return $pets;
    }

    function userOwnsPet($email,$petID) {
        $pets = getAllPetsForAdoption($email);
        
        foreach($pets as $pet){
            if($pet['id']===$petID)
                return true;
        }

        return false;
    }
    
    function getUserHavePetForAdoption($pet_id) {
        global $db;
        $stmt = $db->prepare('SELECT has_for_adoption FROM pet WHERE pet.id = ?');
        $stmt->execute(array($pet_id));
        $values = $stmt->fetch();

        foreach ($values as $value) {
            $user_id = $value;
        }

        return $user_id;
    }

    function getProposals($account_id) {
        global $db;
        
        $stmt = $db->prepare('SELECT * FROM proposal p WHERE p.recv_adoption_proposal = ?');
        $stmt->execute(array($account_id));
        $proposals = $stmt->fetchAll();

        return $proposals;
    }

?>