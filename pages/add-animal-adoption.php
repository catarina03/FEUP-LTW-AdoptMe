<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/template-forms.php');
    include_once('../templates/template-common.php');
    
    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_POST['csrf'])
        die(header('Location: ../pages/login.php'));
        
    $title = "<title>Add animal | Adopt Me!</title>";

    drawStyle("add_animal_adoption");
    drawHeader($title);
    drawAddAnimalForm(); 
    drawFooter();
?>
