<link rel="stylesheet" href="../css/petProfile.css" > 

<?php
    include_once('../includes/init.php');
    include_once('../database/db_user.php');
    include_once('../templates/common/header.php');
    include_once('../templates/tpl_petprofile.php');
    include_once('../includes/validate_input.php');

    if(!validInput()){
        echo '<script>alert("Invalid input!"); location.replace("../pages/petprofile.php?id=' . $_GET['id'] . ');</script>';
        die();
        //die(header('Location: ../pages/login.php'));
    }

    if (!isset($_SESSION['username']))
        die(header('Location: ../pages/login.php'));


    if(!userOwnsPet($_SESSION['username'],$_GET['id'])){
        echo '<script>alert("User does not have ownership permission to edit pet!"); location.replace("../pages/petprofile.php?id=' . $_GET['id'] . ');</script>';
        die();
    }
        

    $petID = $_GET['id'];
    $pet = getPetInfo($petID);
    
?>

<section id='main'>
    <img src="../images/pets/original/<?=$petID?>.jpg" alt="dog image " width="160" height="180" onerror="this.onerror=null;this.src='../images/missing_image.jpg';">
    
    <form action="../actions/action_upload_pet_pic.php?id=<?=$petID?>" method="post" enctype="multipart/form-data">
            <label>Insert new pet picture:
                <input type="file" name="image">
                <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
            </label>
            <input type="submit" value="Upload">
    </form>

    <article id="description">
        <form action="../actions/action_edit_pet.php?id=<?=$petID?>" method="get">
            <label>Name
                <input id="name" type="text" name="name" value="<?php echo $pet['name'] ?>">
            </label>
            <label>Species
                <input id="species" type="text" name="species" value="<?php echo $pet['species'] ?>">
            </label>
            <label>Breed
                <input id="breed" type="text" name="breed" value="<?php echo $pet['breed'] ?>">
            </label>
            <label>Color
                <input id="color" type="text" name="color" value="<?php echo $pet['color'] ?>">
            </label>
            <label>Weight
                <input id="weight" type="text" name="weight" value="<?php echo $pet['weight'] ?>">
            </label>
            <label>Height
                <input id="height" type="text" name="height" value="<?php echo $pet['height'] ?>">
            </label>
            <label>Gender
                <input id="gender" type="text" name="gender" value="<?php echo $pet['gender'] ?>">
            </label>
            <label>Bio
                <input id="bio" type="text" name="bio" value="<?php echo $pet['bio'] ?>">
            </label>
            <input type="hidden" name="id" value="<?=$_GET['id']?>">
            <input type="submit" value="Update">
        </form>
    </article>



</section>

<?php include_once('../templates/common/footer.php')?>
    
