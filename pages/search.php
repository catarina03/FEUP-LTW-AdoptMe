<link rel="stylesheet" href="../css/search.css" > 

<?php 
    include_once('../includes/init.php');
    include_once('../templates/template-forms.php');

?>
<head>
    <title> Search | Adopt Me!</title>
</head>

<?php  include_once('../templates/common/header.php');?>

    <script src="../js/search_pets.js" defer=""></script>
    <section id="main">
        <aside id="search_filters">
            <?php drawSearchForm(); ?>
        <aside>
        <section id="search_results">
            <h2 class="visually-hidden">Search</h2>
        </section>
    </section>
</section>

<?php 
    include_once('../templates/common/footer.php');
?>