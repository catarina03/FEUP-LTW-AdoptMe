<?php
    $db = new PDO('sqlite:g21.db');

    $stmt = $db->prepare('SELECT password FROM account WHERE email = ?');
    $stmt->execute(array($_POST['email']));
    $passwd = $stmt->fetch();

    $success = $passwd['password']===$_POST['password'];

    if(empty($passwd) || !$success)
        echo '<h1>Wrong email or password</h1>';
        
    if($success)
        echo "<script>window.location='user-profile.html'</script>";
?>