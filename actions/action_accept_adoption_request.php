<?php 
    include_once('../includes/init.php');

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));
    
    

?>