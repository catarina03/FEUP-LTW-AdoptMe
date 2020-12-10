<?php
  $location = $_GET['location'];

  include_once('database/connection.php');

  global $db;

  // Get the countries that start with $name
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
  $response = $stmt->fetchAll();
  
  // JSON encode them
  echo json_encode($response);
?>
