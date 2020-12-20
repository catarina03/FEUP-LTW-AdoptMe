<?php
    include_once('../includes/init.php');
    include_once('../includes/validate_input.php');
    include_once('../database/db_pet.php');
    include_once('../database/db_user.php');


    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));


    $user = createArrayWithUserInfo();

    global $db;

	if(isset($user['password']) && $user['password'] !== ''){
		$stmt = $db->prepare('UPDATE account
			SET email = ?, password = ?, bio = ?
			WHERE id = ?');
		$stmt->execute(array($user['email'], $user['password'], $user['bio'], $user['id'])); 
	}
	else{
		$stmt = $db->prepare('UPDATE account
			SET email = ?, bio = ?
			WHERE id = ?');
		$stmt->execute(array($user['email'],$user['bio'], $user['id'])); 
	}

    $stmt = $db->prepare('UPDATE person
        SET name = ?, location_id = ?
        WHERE account_id = ?');
    $stmt->execute(array($user['name'], $user['location'], $user['id'])); 

    echo '<script>alert("Updated user information!"); location.replace("../pages/userprofile.php");</script>';
    die();   
?>
