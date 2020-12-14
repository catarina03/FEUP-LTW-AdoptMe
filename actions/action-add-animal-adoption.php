<?php 
    include_once('../templates/common/header.php');
    include_once('../includes/init.php');
    include_once('../database/db_user.php');

    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_GET['csrf'])
        die(header('Location: ../pages/login.php'));
    
    addAnimalToUser();

    header('Location: ../pages/userprofile.php')

?>

<?php
    function getBigestId() {
        global $db;
        $stmt = $db->prepare('SELECT P.id  FROM pet P 
                            WHERE  P.id = 
                                (
                                    SELECT  max(id) FROM pet
                                )');
        $stmt->execute();
        $id = $stmt->fetch();

        return $id[key($id)];
    }

    function getBreedId($breed) {
        global $db;
        $stmt = $db->prepare('SELECT B.id FROM breed B where B.name = ?');
        $stmt->execute(array($breed));
        $breed_id = $stmt->fetch();

        return $breed_id[key($breed_id)];
    }
    
    function createArrayWithAnimalInfo() {
        
        $animal['id'] = getBigestId()+1;
        $animal['name'] = $_GET['name'];
        $animal['bio'] = 'none';
        $animal['gender'] = $_GET['gender'];
        $animal['weight'] = $_GET['weight'];
        $animal['height'] = $_GET['height'];
        $animal['color'] = $_GET['color'];
        $animal['breed'] = getBreedId($_GET['breed']);
        $animal['has_for_adoption'] = getUser($_SESSION['username'])['id'];
        $animal['adopted'] = NULL;

        

        return $animal;
    }
    
    function addAnimalToUser() {

        $animal = createArrayWithAnimalInfo();
        
        global $db;
        $stmt = $db->prepare('INSERT INTO pet VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($animal['id'], $animal['name'], $animal['bio'], $animal['gender'], 
                        $animal['weight'], $animal['height'], $animal['color'], $animal['breed'], $animal['has_for_adoption'], $animal['adopted']
                    ));
        
    }
?>