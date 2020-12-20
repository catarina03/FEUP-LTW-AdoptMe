<?php 
    include_once('../includes/init.php');
    include_once('../templates/template-forms.php');
    include_once('../templates/template-common.php');

    $title = "<title>Log in | Adopt Me!</title>";

    drawStyle("login");
    drawHeader($title);
    drawLogInForm();
    drawFooter();
?>