<?php
  include_once('database/db_pet.php');

  $res = getPetsByName('');

  ?><h1><?php echo getAllPets();?><h1>
