<?php
    include('database/connection.php');
    include_once('templates/common/header.php');

    $webPets = getAllPetsPostsFromWebsite();
?>
    <?php foreach( $webPets as $webPet) { ?>
        <img src="images/pets/original/<?=$webPet['id']?>.jpg" alt="pet<?=$webPet['id']?>" width="100" height="100">
        <a href="petprofile.php?id=<?=$webPet['id']?>"><?=$webPet['name']?></a>
    <?php } ?>
    </body>
<?php
    include_once('templates/common/footer.php');
?>


<?php
    
    function getAllPetsPostsFromWebsite() { 
        global $db;
        $stmt = $db->prepare('SELECT DISTINCT P.id, P.name 
                            FROM shelter S, person Per, pet P 
                            WHERE Per.account_id = P.has_for_adoption or
                                S.account_id = P.has_for_adoption'
                            );
        $stmt->execute();
        $pets = $stmt->fetchAll();
        
        return $pets;
    }

?>