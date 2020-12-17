<?php 
    include_once('../includes/init.php');
    include_once('../includes/validate_input.php');

    if (!isset($_SESSION['username'])){
        echo '<script>alert("Session sets - username!"); location.replace("../pages/userprofile.php");</script>';
        die();
    }
    if (isset($_SESSION['token'])){
        if ($_SESSION['token'] !== $_GET['csrf']){
            echo '<script>alert("Session sets - token and crsf different!"); location.replace("../pages/userprofile.php");</script>';
            die();
        }
    }
    else {
        echo '<script>alert("Session sets - token crsf not set!"); location.replace("../pages/userprofile.php");</script>';
        die();
    }
    if (!isset($_GET['acceptance'])){
        
        echo '<script>alert("Session sets - acceptance!"); location.replace("../pages/userprofile.php");</script>';
        die();
    }
    
    $proposal = unserialize(urldecode($_GET['proposal']));

    if($_GET['acceptance'] === 'Accept') {
        acceptRequest($proposal);
        deleteProposal($proposal);
        echo '<script>alert("Accepted pet for adoption!"); location.replace("../pages/userprofile.php");</script>';
        die();
    }else if($_GET['acceptance'] === "Refuse") {
        deleteProposal($proposal);
        echo '<script>alert("Refused pet for adoption!"); location.replace("../pages/userprofile.php");</script>';
        die();
    }
    else {
        echo '<script>alert("Invalid button input!"); location.replace("../pages/userprofile.php");</script>';
        die();
    }
    

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