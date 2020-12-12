<link rel="stylesheet" href="../css/login.css">

<?php include_once('../templates/common/header.php'); ?>

    <section id="main">
        <h2>Log in</h2>
        <form action="../actions/action_login.php" method="post">
            <label for="email">Email:
                <input type="text" name="email" required>
            </label>
            <label for="password">Password:
                <input type="password" name="password" required>
            </label>
            <input type="submit" value="Send">
        </form>
        <p>Don’t have an account yet? <a href='register.php'>Sign up</a></p>
    </section>
</body>

</html>