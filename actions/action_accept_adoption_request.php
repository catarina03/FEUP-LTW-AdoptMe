<?php 
    include_once('../includes/init.php');
    include_once('../includes/validate_input.php');

    if(!validInput()){
        echo '<script>alert("Invalid input!");</script>';
        //die(header('Location: ../pages/userprofile.php'));
    }

    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_GET['csrf']){
        echo '<script>alert("Session sets!");</script>';
        //die(header('Location: ../pages/userprofile.php'));
    }
    
    $proposal = unserialize($_GET['proposal']);

    echo '<script>console.log("accept");<script>';

    if($_GET['acceptance'] === 'Accept') {
        acceptRequest($proposal);
        deleteProposal($proposal);
        echo '<script>alert("Accepted pet for adoption!"); location.replace("../pages/userprofile.php");</script>';
    }else if($_GET['acceptance'] == "Refuse") {
        deleteProposal($proposal);
        echo '<script>alert("Refused pet for adoption!"); location.replace("../pages/userprofile.php");</script>';
    }
    
    //header('Location: ../pages/userprofile.php')

?>

<?php 

    function deleteProposal($proposal) {
        global $db;

        $stmt = $db->prepare('DELETE FROM proposal WHERE proposal.id = ?');
        $stmt->execute(array($proposal['id']));
    }

    function acceptRequest($proposal) {
        global $db;

        $stmt = $db->prepare('UPDATE pet SET adopted = ?, has_for_adoption = ? WHERE pet.id = ?');
        $stmt->execute(array($proposal['made_adoption_proposal'], NULL, $proposal['pet_id']));
    }

?>