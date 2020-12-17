<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    
    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_POST['csrf'])
        die(header('Location: ../pages/login.php'));

?>
<link rel="stylesheet" href="../css/add_animal_adoption.css" > 
<div id="main">
    <form action="../actions/action-add-animal-adoption.php" method="get">
        <label>Name:
            <input type="text" name="name" required>
        </label>
        <label>Bio:
            <input type="text" name="bio" required>
        </label>
        <label>Gender:
            <input type="text" name="gender" required>
        </label>
        <label>Weight:
            <input type="text" name="weight" required>
        </label>
        <label>Height:
            <input type="text" name="height" required>
        </label>
        <label>Color:
            <input type="text" name="color" required>
        </label>
        <label>Species:
            <input type="text" name="species" required>
        </label>
        <label>Breed:
            <input type="text" name="breed" required>
        </label>
        <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
        <button type="submit"value="Submit">Submit</button>

    </form>
</div>

<?php 
    include('../templates/common/footer.php');
?>