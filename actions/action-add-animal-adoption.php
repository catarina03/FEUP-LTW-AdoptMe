<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../includes/validate_input.php');

    if(!validInput()){
        echo '<script>alert("Invalid input!"); location.replace("../pages/userprofile.php");</script>';
        die();
    }

    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_GET['csrf']){
        echo '<script>alert("Sessions!"); location.replace("../pages/userprofile.php");</script>';
        die();
    }
    
    addAnimalToUser();

    echo '<script>alert("Added new pet for adoption!"); location.replace("../pages/userprofile.php");</script>';
    die();

?>

<?php
    function getBiggestPetId() {
        global $db;
        $stmt = $db->prepare('SELECT max(id) AS id FROM pet');
        $stmt->execute();
        $id = $stmt->fetch();

        return $id;
    }

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
    
    function createArrayWithAnimalInfo() {
        $animal['id'] = (int)implode(getBiggestPetId()) + 1;
        $animal['name'] = $_GET['name'];
        $animal['bio'] = $_GET['bio'];
        $animal['gender'] = $_GET['gender'];
        $animal['weight'] = $_GET['weight'];
        $animal['height'] = $_GET['height'];
        $animal['color'] = $_GET['color'];
        $animal['breed'] = getBreedId($_GET['breed'], $_GET['species']);
        $animal['has_for_adoption'] = getUser($_SESSION['username'])['id'];
        $animal['adopted'] = NULL;

        return $animal;
    }
    
    function addAnimalToUser() {
        $animal = createArrayWithAnimalInfo();
        
        global $db;
        $stmt = $db->prepare('INSERT INTO pet VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute(array($animal['id'], $animal['name'], $animal['bio'], $animal['gender'], 
            $animal['weight'], $animal['height'], $animal['color'], $animal['breed'], 
            $animal['has_for_adoption'], $animal['adopted']));
    }
?>