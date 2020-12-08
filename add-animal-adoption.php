<?php 
    include_once('templates/common/header.php');
    include_once('includes/init.php');
    include_once('database/db_user.php');

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));

?>

<form action="action-add-animal-adoption.php" method="get">
    <label>Name:
        <input type="text" name="name" required>
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
    <label>Breed:
        <input type="text" name="breed" required>
    </label>
    <button type="submit"value="Submit">Submit</button>

</form>

<?php 
    include_once('templates/common/footer.php');
?>