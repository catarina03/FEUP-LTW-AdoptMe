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


    function getBiggestAccountId() {
        global $db;
        $stmt = $db->prepare('SELECT max(id) AS id FROM account');
        $stmt->execute();
        $id = $stmt->fetch();

        return $id;
    }


    function addAccount($data, $password) {
        global $db;
        if (checkUser($data['email'])){
            throw new PDO('Email already in use');
            return false;
        }
        else {
            $newId = implode(getBiggestAccountId()) + 1;
            $stmt = $db->prepare('INSERT INTO account VALUES(?,?,?, NULL)');
            $stmt->execute(array($newId, $data['email'], $password));

            $locationId = getLocationId($data['city']);

            $stmt = $db->prepare('INSERT INTO person VALUES(NULL, ?, ?, ?, NULL)');
            $stmt->execute(array($data['username'], $newId, $locationId));
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


    function getUserById($user_id){
        global $db;
        $stmt = $db->prepare('SELECT account.id AS id, name, account.bio AS bio, location.city AS city, account.email AS email
            FROM account 
            INNER JOIN person 
            ON account.id = person.account_id
            INNER JOIN location
            ON location.id = person.location_id
            WHERE account.id = ?');
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


    function getAllPetsFromUser($email) {
        global $db;
        $stmt = $db->prepare("SELECT pet.id AS id, pet.name AS name, pet.bio AS bio, location.city AS location, breed.species AS species, breed.name AS breed, pet.color AS color, pet.has_for_adoption AS status
            FROM pet INNER JOIN breed ON pet.breed_id = breed.id
            INNER JOIN person ON pet.has_for_adoption = person.person_id
            INNER JOIN account ON person.person_id = account.id
            INNER JOIN location ON person.location_id = location.id
            WHERE account.email = ?
            
            UNION            
                    
            SELECT pet.id AS id, pet.name AS name, pet.bio AS bio, location.city AS location, breed.species AS species, breed.name AS breed, pet.color AS color, pet.has_for_adoption AS status
                    FROM pet INNER JOIN breed ON pet.breed_id = breed.id
                    INNER JOIN person ON pet.adopted = person.person_id
                    INNER JOIN account ON person.person_id = account.id
                    INNER JOIN location ON person.location_id = location.id
                    WHERE account.email = ?");
        $stmt->execute(array("$email", "$email"));
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
            breed.name AS breed,
            breed.species AS species,
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


    function removePetPost($pet_id) {
        global $db;
        $stmt = $db->prepare('DELETE FROM pet WHERE pet.id = ?');
        $stmt->execute(array($pet_id));
    }


    function userOwnsPet($email,$petID) {
        $pets = getAllPetsFromUser($email);
        
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


    function addFavouritePet($petID,$userID){
        global $db;
        $stmt = $db->prepare('INSERT INTO favourite VALUES(?,?)');
        $stmt->execute(array($petID,$userID));
    } 
    function removeFavouritePet($petID,$userID){
        global $db;
        $stmt = $db->prepare('DELETE FROM favourite WHERE pet_id=? AND person_id=?');
        $stmt->execute(array($petID,$userID));
    }  

    function getFavouritePets($userID){
        global $db;
        $stmt = $db->prepare('SELECT pet_id FROM favourite WHERE person_id= ?');
        $stmt->execute(array($userID)); 
        return $stmt->fetchAll(); 
    }

    function userLikesPet($userID,$petID){
        $pets = getFavouritePets($userID);
        
        foreach($pets as $pet){
            if($pet['pet_id']===$petID)
                return true;
        }

        return false;
    }


    
    function getBiggestLocationId() {
        global $db;
        $stmt = $db->prepare('SELECT max(id) AS id FROM location');
        $stmt->execute();
        $id = $stmt->fetch();

        return $id;
    }

    function getLocationId($location) {
        global $db;
        $stmt = $db->prepare('SELECT id FROM location where city = upper(?)');
        $stmt->execute(array("$location"));
        $result = $stmt->fetch()?true:false;

        if ($result) {
            $stmt = $db->prepare('SELECT id FROM location where city = upper(?)');
            $stmt->execute(array("$location"));
            $location_id = $stmt->fetch();
        }
        else {
            $lastLocationId = getBiggestLocationId();

            $location_id = implode($lastLocationId) + 1;
            $stmt = $db->prepare('INSERT INTO location VALUES (?, ?, ?)');
            $stmt->execute(array("$location_id", "$location", "NULL"));
        }

        return $location_id;
    }


    function createArrayWithUserInfo() {
        $user['id'] = $_POST['id'];
        $user['name'] = $_POST['name'];
        $user['bio'] = $_POST['bio'];
        $user['email'] = $_POST['email'];
        $user['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $user['location'] = getLocationId($_POST['location']);

        return $user;
    }


    function send_request($owner_of_pet) {
        global $db;

        date_default_timezone_set('Europe/Lisbon');
        $date = date('m-d-Y h:i:s', time());

        $account_id = getUserHavePetForAdoption($_GET['pet_id']);

        if($account_id == $owner_of_pet) {
            die(header('Location: ../pages/pages_index.php'));
        }

        $stmt = $db->prepare('INSERT into proposal VALUES(?, ?, ?, ?, ?, ?)');
        $stmt->execute(array(NULL, 1, $date, $_GET['pet_id'], $_GET['user_id'], $account_id));
    }


    function deleteProposal($proposal) {
        global $db;

        $stmt = $db->prepare('DELETE FROM proposal WHERE proposal.id = ?');
        $stmt->execute(array($proposal['id']));
    }

    function acceptRequest($proposal) {
        global $db;

        $stmt = $db->prepare('UPDATE pet SET adopted = ?, has_for_adoption = ? WHERE pet.id = ?');
        $stmt->execute(array($proposal['made_adoption_proposal'], NULL, $proposal['pet_id']));
    }


    function addAnimalToUser() {
        $animal = createArrayWithAnimalInfo();
        
        global $db;
        $stmt = $db->prepare('INSERT INTO pet VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute(array($animal['id'], $animal['name'], $animal['bio'], $animal['gender'], 
            $animal['weight'], $animal['height'], $animal['color'], $animal['breed'], 
            $animal['has_for_adoption'], $animal['adopted']));
    }

?>