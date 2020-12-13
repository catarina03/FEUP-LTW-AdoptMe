<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/edit_profile.css" > 
</head>
<?php 
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/tpl_userprofile.php');

    if (!isset($_SESSION['username']))
        die(header('Location: login.html'));

    $user = getUser($_SESSION['username']);
?>

<body>
    <?php include_once('../templates/common/header.php');?>
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