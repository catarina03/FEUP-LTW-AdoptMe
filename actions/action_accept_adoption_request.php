<?php 
    include_once('../includes/init.php');

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/userprofile.php'));
    
    $proposal = unserialize($_GET['proposal']);

    if($_GET['acceptance'] === 'Accept') {
        acceptRequest($proposal);
        deleteProposal($proposal);
    }else if($_GET['acceptance'] == "Refuse") {
        deleteProposal($proposal);
    }
    
    header('Location: ../pages/userprofile.php')

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