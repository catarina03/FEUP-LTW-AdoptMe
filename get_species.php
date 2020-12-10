<?php
  $species = $_GET['species'];

  include_once('database/connection.php');

  global $db;

  // Get the countries that start with $name
  $stmt = $db->prepare("SELECT pet.name AS name
    FROM pet INNER JOIN breed ON pet.breed_id = breed.id
    WHERE breed.species = (?)");
  $stmt->execute(array("$species"));
  $result = $stmt->fetchAll();
  
  // JSON encode them
  echo json_encode($result);