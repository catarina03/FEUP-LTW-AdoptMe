<link rel="stylesheet" href="../css/register.css" > 

<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/template-forms.php');

    $cities = getAllCities();

?>
<head>
    <title> Register | Adopt Me!</title>
</head>

<?php  include_once('../templates/common/header.php');

    drawRegisterForm($cities);

    include_once('../templates/common/footer.php');
?>