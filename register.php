<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>ONLINE ANIMAL ADOPTION</title>
    <meta charset="utf-8">
</head>

<body>
    <header>
        <img src="images/logo.png" alt="a logo image" width="80">
        <h1>ADOPT ME!</h1>
    </header>
    <section id="signup">
        <h2>Create Account</h2>
        <form action=add_user.php method="post">
            <label>Email:
                <input type="text" name="email" required>
            </label>
            <label for="city">City:
                <select name="city" id="city">
                    <?php 
                        include_once('database/connection.php');
            
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
            <input type="submit" value="Send">
        </form>
    </section>
</body>

</html>