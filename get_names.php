<?php
  $name = $_GET['name'];

  include_once('database/connection.php');

  global $db;

  // Get the countries that start with $name
  $stmt = $db->prepare("SELECT pet.name FROM pet WHERE upper(pet.name) LIKE upper(?) LIMIT 10");
  $stmt->execute(array("$name%"));
  $response = $stmt->fetchAll();
  
  // JSON encode them
  echo json_encode($response);
?>
