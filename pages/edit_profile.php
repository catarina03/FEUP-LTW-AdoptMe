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
    <title> <?=$user['name']?> | Adopt Me!</title>
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
            <form action="../actions/action_upload_profile_pic.php?id=<?=$user['id']?>" method="post" enctype="multipart/form-data">
                    <label>Insert new pet picture:
                        <input type="file" name="image">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                    </label>
                <input type="submit" value="Upload">
            </form>

            
            <form action="../actions/action_edit_profile.php?id=<?=$user['id']?>" method="post">
                <label>Name
                    <input id="name" type="text" name="name" value="<?php echo $user['name'] ?>" pattern="[a-zA-Z\u00C0-\u00ff\s]+">
                </label>
                <label>Bio
                    <input id="bio" type="text" name="bio" value="<?php echo $user['bio'] ?>" pattern="^[a-zA-Z\u00C0-\u00ff0-9,.!? ]*$">
                </label>
                <label>Email
                    <input id="email" type="email" name="email" value="<?php echo $_SESSION['username'] ?>">
                </label>
                <label>Password
                    <input id="password" type="password" name="password" value="" requred>
                </label>
                <label>Location
                    <input id="location" type="text" name="location" value="<?php echo $user['city'] ?>" pattern="[a-zA-Z\u00C0-\u00ff\s]+">
                </label>
                <input type="hidden" name="id" value="<?=$user['id']?>">
                <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
                <input type="submit" value="Update">
            </form>




        </div>
    </div>
</body>

</html>