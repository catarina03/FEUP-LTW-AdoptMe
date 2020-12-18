<!DOCTYPE html>
<html lang="en-US">

<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/tpl_userprofile.php');

    if (!isset($_SESSION['username']) || $_SESSION['token']!==$_POST['csrf'])
        die(header('Location: ../pages/login.php'));

    $user = getUser($_SESSION['username']);
?>
<head>
    <title> <?=$user['name']?>| Adopt Me!</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/edit_profile.css" > 
</head>

<?php  include_once('../templates/common/header.php');?>


<body>
    <div id="main">
        <aside id="user_profile">
            <?php drawUserProfile($user); ?>
        </aside>

        <div id="edit">
            <h3>Insert new profile picture</h3>
            <form action="../actions/action_upload_profile_pic.php" method="post" enctype="multipart/form-data">
                <label>Insert image:
                    <input type="file" name="image">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                </label>
                <input type="submit" value="Upload">
            </form>
        </div>
    </div>
</body>

</html>