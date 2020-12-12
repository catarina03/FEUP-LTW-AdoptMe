<?php
    include_once('../includes/init.php');

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

    send_request();

?>

<?php

    function send_request() {
        global $db;

        $timezone = date_default_timezone_set('Europe/Lisbon');
        $date = date('m-d-Y h:i:s', time());

        $stmt = $db->prepare('INSERT into proposal VALUES(?, ?, ?, ?, ?, ?)');
        $stmt->execute(array(, 1, $date, $_GET['id']), , NULL);
        

        echo $date;
        
    }

?>