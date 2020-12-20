<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/template-forms.php');
    include_once('../templates/template-common.php');

    $cities = getAllCities();
    $title = "<title>Register | Adopt Me!</title>";

    drawStyle("register");
    drawHeader($title); 
    drawRegisterForm($cities);
    drawFooter();
?>