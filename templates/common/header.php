<?php include_once("../database/db_user.php"); ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Adopt Me!</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/header.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <header>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        
        <a class="logo" href="pages_index.php">
            <img alt="logo image" src="../images/logo.png" width="80">
        </a>
        <h1 class="siteName" >ADOPT ME!</h1>

        <?php if(!isset($_SESSION['username'])){ ?>
            <nav class='loggedOut'>
                    <a href="../pages/login.php">Log in</a>
                    <a href="../pages/register.php">Sign up</a>
            </nav>
        <?php } ?>
        
        <?php if(isset($_SESSION['username'])){ 
            $user = getUser($_SESSION['username']); ?>
            <a class="loggedIn" href="../pages/userprofile.php">
                    <img alt="User profile" src="../images/accounts/small/<?php echo $user['id'] ?>.jpg" width="40" height="40">
            </a>
        <?php } ?>

        <a href="searchresults.php">
            <img alt="search" src="../images/search_icon.png" width="30">
        </a>
        <hr>
    </header>
</body>
