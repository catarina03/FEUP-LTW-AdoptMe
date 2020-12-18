<?php include_once("../database/db_user.php"); 
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/header.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body>
<header>
        <a class="logo" href="../pages/pages_index.php">
            <img alt="logo image" src="../images/logo.png" width="80">
        </a>
        <h1 class="siteName" >ADOPT ME!</h1>
        <a href="../pages/search.php">
             <img class="search" alt="search" src="../images/search_icon.png" width="30">
        </a>


        <?php if(!isset($_SESSION['username'])){ ?>
            <nav class='loggedOut'>
                <a href="../pages/login.php">Log in</a>
                <a href="../pages/register.php">Sign up</a>

            </nav>
        <?php } 
        else { 
            $user = getUser($_SESSION['username']); ?>
             <nav class='loggedIn'>
                <a href="../pages/userprofile.php">
                        <img alt="User profile" src="../images/accounts/small/<?php echo $user['id'] ?>.jpg" width="40" height="40" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
                </a>
                <a href="../actions/action_logout.php">Log out</a>
            </nav>
        <?php } ?>
        
        <hr>
    </header>
</body>
