<?php
    include_once('database/connection.php');

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



?>