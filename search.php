<?php 
    include_once('templates/common/header.php');
    include_once('templates/template-forms.php');
?>

    <script src="js/search_pets.js" defer=""></script>
    <section id="main">
        <h2 class="visually-hidden">Search</h2>
        <img src="images/search_icon.png" alt="search"  width="300">
        <?php drawSearchForm(); ?>
    </section>
    <section id="search-results">
    </section>
</body>

</html>