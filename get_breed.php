<?php
  $breed = $_GET['breed'];

  include_once('database/connection.php');

  global $db;

  // Get the countries that start with $name
  $stmt = $db->prepare("SELECT pet.name AS name
    FROM pet INNER JOIN breed ON pet.breed_id = breed.id
    WHERE breed.name = (?)");
  $stmt->execute(array("$breed"));
  $result = $stmt->fetchAll();
  
  // JSON encode them
  echo json_encode($result);