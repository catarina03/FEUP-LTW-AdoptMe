<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>ONLINE ANIMAL ADOPTION</title>
    <meta charset="utf-8">
</head>

<body>
    <header>
        <a href="index.html">
            <img alt="logo image" src="images/logo.png" width="80">
        </a>
        <nav class='logged out'>
            <a href="login.html">Log in</a>
            <a href="register.php">Sign up</a>
        </nav>
        <a class="logged in" href="userprofile.php">
            <img alt="User profile" src="images/profile_photo.jpg" width="40" height="40">
        </a>
        <a href="search.html">
            <img alt="search" src="images/search_icon.png" width="100" height="100">
        </a>
        <h1>ADOPT ME!</h1>
    </header>

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
</body>

</html>