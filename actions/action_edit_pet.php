<?php
    include_once('../includes/init.php');
    include_once('../includes/validate_input.php');
    include_once('../database/db_pet.php');
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../templates/tpl_petprofile.php');

    /*
    if(!validInput()){
        echo '<script>alert("Invalid input!"); location.replace("../pages/petprofile.php?id=' . $_GET['id'] . '");</script>';
        die();
        //die(header('Location: ../pages/login.php'));
    }
    */

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));


    if(!userOwnsPet($_SESSION['username'],$_GET['id'])){
        echo '<script>alert("User does not have ownership permission to edit pet!"); location.replace("../pages/petprofile.php?id=' . $_GET['id'] . '");</script>';
        die();
    }


    $pet = createArrayWithPetInfo();

    global $db;
    $stmt = $db->prepare('UPDATE pet
        SET name = ?, breed_id = ?, color = ?, weight = ?, height = ?, gender = ?, bio = ?
        WHERE id = ?');
    $stmt->execute(array($pet['name'], $pet['breed'], $pet['color'], $pet['weight'], $pet['height'], $pet['gender'], $pet['bio'], $_GET['id'])); 

    echo '<script>alert("Updated pet information!"); location.replace("../pages/petprofile.php?id=' . $_GET['id'] . '");</script>';
    die();   



    function getBiggestSpeciesId() {
        global $db;
        $stmt = $db->prepare('SELECT max(id) AS id FROM breed');
        $stmt->execute();
        $id = $stmt->fetch();

        return $id;
    }

    function getBreedId($breed, $species) {
        global $db;
        $stmt = $db->prepare('SELECT id FROM breed where name = upper(?) AND species = upper(?)');
        $stmt->execute(array("$breed", "$species"));
        $result = $stmt->fetch()?true:false;

        if ($result) {
            $stmt = $db->prepare('SELECT id FROM breed where name = upper(?) AND species = upper(?)');
            $stmt->execute(array($breed, $species));
            $breed_id = $stmt->fetch();
        }
        else {
            $lastSpeciesId = getBiggestSpeciesId();

            $breed_id = implode($lastSpeciesId) + 1;
            $stmt = $db->prepare('INSERT INTO breed VALUES (?, ?, ?)');
            $stmt->execute(array("$breed_id", "$species", "$breed"));
        }

        return $breed_id;
    }

    
    function createArrayWithPetInfo() {
        $animal['name'] = $_GET['name'];
        $animal['bio'] = $_GET['bio'];
        $animal['gender'] = $_GET['gender'];
        $animal['weight'] = $_GET['weight'];
        $animal['height'] = $_GET['height'];
        $animal['color'] = $_GET['color'];
        $animal['breed'] = getBreedId($_GET['breed'], $_GET['species']);

        return $animal;
    }
    

?>