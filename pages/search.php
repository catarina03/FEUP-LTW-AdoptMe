<?php 
    include_once('../includes/init.php');
    include_once('../templates/template-pets.php');
    include_once('../templates/template-forms.php');
    include_once('../templates/template-common.php');

    $title = "<title>Search | Adopt Me!</title>";

    drawStyle("search");
    drawHeader($title); 
    drawSearch();
    drawFooter(); 
?>