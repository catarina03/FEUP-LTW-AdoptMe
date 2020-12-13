<?php
    include_once('../includes/init.php');
    include_once('../database/db_user.php');

    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_POST['csrf'])
        die(header('Location: ../pages/login.html'));

    $user = getUser($_SESSION['username']);

    $id = $user['id'];
    
    $originalFileName = "../images/accounts/original/$id.jpg";
    $smallFileName = "../images/accounts/small/$id.jpg";

    move_uploaded_file($_FILES['image']['tmp_name'],$originalFileName);

    //TODO
    //support more image extensions
    $original = imagecreatefromjpeg($originalFileName);

    $width = imagesx($original);
    $height = imagesy($original);
    $square = min($width,$height);

    $small = imagecreatetruecolor(200,200);
    imagecopyresized(
        $small,
        $original,
        0,0,
        ($width>$square)?($width-$square)/2:0,($height>$square)?($height-$square)/2:0,
        200,200,
        $square,$square
    );

    imagejpeg($small,$smallFileName);

    header("Location: ../pages/userprofile.php");
?>