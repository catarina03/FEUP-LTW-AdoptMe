<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/tpl_userprofile.php');

    if (!isset($_SESSION['username']))
        die(header('Location: login.html'));

    $user = getUser($_SESSION['username']);
?>


<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Profile</title>
    <meta charset="utf-8">
</head>

<?php drawUserProfile($user); ?>

<body>
    <h3>Insert new profile picture</h3>
    <form action="../actions/action_upload_profile_pic.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="Upload">
    </form>
</body>

</html>