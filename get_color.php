<?php
  $color = $_GET['color'];

  include_once('database/connection.php');

  global $db;

  // Get the countries that start with $name
  $stmt = $db->prepare("SELECT pet.name AS name FROM pet WHERE pet.color = (?)");
  $stmt->execute(array("$color"));
  $result = $stmt->fetchAll();
  
  // JSON encode them
  echo json_encode($result);