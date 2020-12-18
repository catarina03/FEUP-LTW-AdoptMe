<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    
    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_POST['csrf'])
        die(header('Location: ../pages/login.php'));

?>
<head>
    <title> Add animal | Adopt Me!</title>
    <link rel="stylesheet" href="../css/add_animal_adoption.css" > 

</head>

<?php  include_once('../templates/common/header.php');?>


<div id="main">
    <form action="../actions/action-add-animal-adoption.php" method="get">
        <label>Name:
            <input type="text" name="name" pattern="[a-zA-Z\u00C0-\u00ff\s]+" required>
        </label>
        <label>Bio:
            <input type="text" name="bio" pattern="^[a-zA-Z\u00C0-\u00ff0-9,.!? ]*$" required>
        </label>
        <label>Gender:
            <input type="text" name="gender" pattern="[a-zA-Z\u00C0-\u00ff\s]+" required>
        </label>
        <label>Weight:
            <input type="text" name="weight" pattern="^\d+(\.\d+)*$" required>
        </label>
        <label>Height:
            <input type="text" name="height" pattern="^\d+(\.\d+)*$" required>
        </label>
        <label>Color:
            <input type="text" name="color" pattern="[a-zA-Z\u00C0-\u00ff\s]+" required>
        </label>
        <label>Species:
            <input type="text" name="species" pattern="[a-zA-Z\u00C0-\u00ff\s]+" required>
        </label>
        <label>Breed:
            <input type="text" name="breed" pattern="[a-zA-Z\u00C0-\u00ff\s]+" required>
        </label>
        <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
        <button type="submit"value="Submit">Submit</button>

    </form>
</div>

<?php 
    include('../templates/common/footer.php');
?>