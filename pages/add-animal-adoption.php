<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/template-forms.php');
    
    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_POST['csrf'])
        die(header('Location: ../pages/login.php'));

?>
<head>
    <title> Add animal | Adopt Me!</title>
    <link rel="stylesheet" href="../css/add_animal_adoption.css" > 

</head>

<?php  include_once('../templates/common/header.php');?>


<div id="main">
    <?php drawAddAnimalForm(); ?>
</div>

<?php 
    include('../templates/common/footer.php');
?>