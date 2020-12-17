<link rel="stylesheet" href="../css/register.css" > 

<?php 
    include_once('../includes/init.php');
    include_once('../templates/common/header.php');
    include_once('../database/db_user.php');

    $cities = getAllCities();

?>

    <section id="signup">
        <h2>Create Account</h2>
        <form action="../actions/action_signup.php" method="post">
            <label>Username:
                <input type="text" name="username" required>
            </label>
            <label>Email:
                <input type="text" name="email" required>
            </label>
            <label for="city">City:
                <select name="city" id="city">
                    <?php
                        foreach($cities as $city)
                            echo '<option value="'.htmlentities($city['city']).'">'.htmlentities($city['city']).'</option>';
                    ?>
                </select>
            </label>
            <label>Password:
                <input type="password" name="password" required>
            </label>
            <label>Repeat Password:
                <input type="password" name="password_check" required>
            </label>
            <div>
                <legend>I am a:</legend>
                <input type="radio" name="type" value="User" checked>User
                <input type="radio" name="type" value="Shelter">Shelter
            </div>
            <input type="submit" value="Send">
        </form>
    </section>

<?php 
    include_once('../templates/common/footer.php');
?>