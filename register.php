<?php 
    include_once('includes/init.php');
    include_once('templates/common/header.php');
?>

    <section id="signup">
        <h2>Create Account</h2>
        <form action=add_user.php method="post">
            <label>Username:
                <input type="text" name="username" required>
            </label>
            <label>Email:
                <input type="text" name="email" required>
            </label>
            <label for="city">City:
                <select name="city" id="city">
                    <?php 
                        $stmt = $db->prepare('SELECT city FROM location');
                        $stmt->execute();
                        $cities = $stmt->fetchAll();

                        foreach($cities as $city)
                            echo '<option value="'.$city['city'].'">'.$city['city'].'</option>';
                    ?>
                </select>
            </label>
            <label>Password:
                <input type="password" name="password" required>
            </label>
            <label>Repeat Password:
                <input type="password" name="password" required>
            </label>
            <fieldset>
                <legend>I am a:</legend>
                <input type="radio" name="type" value="User" checked>User
                <input type="radio" name="type" value="Shelter">Shelter
            </fieldset>
            <input type="submit" value="Send">
        </form>
    </section>

<?php 
    include_once('templates/common/footer.php');
?>