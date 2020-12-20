<?php 
    include_once('../includes/init.php');
    include_once('../templates/template-forms.php');
    include_once('../templates/template-common.php');

    $title = "<title>Search | Adopt Me!</title>";

    drawStyle("search");
    drawHeader($title); 
?>

    <script src="../js/search_pets.js" defer=""></script>
    <section id="main">
        <aside id="search_filters">
            <?php drawSearchForm(); ?>
        <aside>
        <section id="search_results">
            <h2 class="visually-hidden">Search</h2>
        </section>
    </section>

<?php drawFooter(); ?>