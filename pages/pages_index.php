<?php
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/template-pets.php');
    include_once('../templates/template-common.php');

    $webPets = getAllPetsPostsFromWebsite();
    $title = "<title>Adopt Me!</title>";
     
    drawStyle("index");
    drawHeader($title); 
    drawIndex($webPets);
    drawFooter();
?>
