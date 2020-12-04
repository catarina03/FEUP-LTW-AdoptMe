<?php 
    include_once('includes/init.php');
    include_once('database/db_user.php');
    include_once('templates/common/header.php');

    if (!isset($_SESSION['username']))
        die(header('Location: login.html'));

    $user = getUser($_SESSION['username']);
?>


    <aside id="user_profile">
        <header>
            <img src="images/person.jpg" alt="profile picture" width="80">
            <h2><?php echo $user['name'] ?></h2>
        </header>
        <p id="bio"><?php echo $user['bio'] ?></p>
        <p id="location"><?php echo $user['city'] ?></p>
        <footer>
            <h4>XX followers</h4>
            <h4>XX following</h4>

            <!-- placeholder-->
            <a href="login.html">Edit profile</a>

        </footer>
    </aside>

    <section id="posts">
        <h2 class="visually-hidden">User posts</h2>
        <article>
            <h2>Pet name</h2>
            <img src="images/dog1.jpg" alt="dog profile picture" width="80">
            <p>Doggo ipsum much ruin diet pats porgo very jealous pupper shoober, woofer noodle horse. Very hand that feed shibe heckin angery woofer doggo sub woofer very jealous pupper vvv very jealous pupper super...</p>
        </article>

        <article>
            <h2>Pet name</h2>
                <img src="images/dog1.jpg" alt="dog profile picture" width="80">
                <p>Doggo ipsum much ruin diet pats porgo very jealous pupper shoober, woofer noodle horse. Very hand that feed shibe heckin angery woofer doggo sub woofer very jealous pupper vvv very jealous pupper super...</p>
        </article>

        <article>
            <h2>Pet name</h2>
                <img src="images/dog1.jpg" alt="dog profile picture" width="80">
                <p>Doggo ipsum much ruin diet pats porgo very jealous pupper shoober, woofer noodle horse. Very hand that feed shibe heckin angery woofer doggo sub woofer very jealous pupper vvv very jealous pupper super...</p>
        </article>
    </section>

<?php 
    include_once('templates/common/footer.php');
?>