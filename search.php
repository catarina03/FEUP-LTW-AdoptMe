<?php 
    include_once('templates/common/header.php');
?>

    <section id="main">
        <h2 class="visually-hidden">Search</h2>
        <img src="images/search_icon.png" alt="search"  width="300">
        <form action="action_search.php" method="get">
            <label>Name
                <input type="search" name="name">
            </label>
            <label>Location
                <select name="location">
                    <option value="Near me" selected>Near me</option>
                    <option value="Lisbon">Orange</option>
                </select>
            </label>
            <label>Species
                <select name="species">
                    <option value="Dog" selected>Dog</option>
                    <option value="Cat">Cat</option>
                </select>
            </label>
            <label>Breed
                <select name="breed">
                    <option value="Beagle" selected>Bleagle</option>
                    <option value="Boxer">Boxer</option>
                </select>
            </label>
            <label>Color
                <select name="color">
                    <option value="Black" selected>Black</option>
                    <option value="Brown">Brown</option>
                </select>
            </label>
            <input type="radio" name="sort by alphabetical order" value="Sort by alphabetical order" checked="checked">Sort by alphabetical order
            <input type="radio" name="sort by most recent" value="Sort by most recent">Sort by most recent
            <input type="submit" value="Search">
        </form>
    </section>
</body>

</html>