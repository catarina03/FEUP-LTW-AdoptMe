<?php 
    include_once('../database/db_pet.php');

    function checkLocation($pet_location, $location){
        return $location === '' || ($pet_location === $location);
    }

    function checkSpecies($pet_species, $species){
        return $species === '' || ($pet_species === $species);
    }

    function checkBreed($pet_breed, $breed){
        return $breed === '' || ($pet_breed === $breed);
    }

    function checkColor($pet_color, $color){
        return $color === '' || ($pet_color === $color);
    }

    function checkStatus($pet_status, $status){
        return $status === '' || ($pet_status === NULL && $status === "adopted") || ($pet_status !== NULL && $status === "for adoption");
    }

    $name = '';
    $location = '';
    $species = '';
    $breed = '';
    $color = '';
    $status = '';

    if(isset($_GET['name']))
        $name = $_GET['name'];
    if(isset($_GET['location']))
        $location = $_GET['location'];
    if(isset($_GET['species']))
        $species = $_GET['species'];
    if(isset($_GET['breed']))
        $breed = $_GET['breed'];
    if(isset($_GET['color']))
        $color = $_GET['color'];
    if(isset($_GET['status']))
        $status = $_GET['status'];

    $filtered_pets = array();

    if($name === ''){
        $pets = getAllPets();
    }
    else{
        $pets = getPetsByName($name);
    }

    foreach($pets as $pet){
        if(checkLocation($pet['location'], $location) 
            && checkSpecies($pet['species'], $species) 
            && checkBreed($pet['breed'], $breed)
            && checkColor($pet['color'], $color)
            && checkStatus($pet['status'], $status)){

            array_push($filtered_pets, $pet);
        }
    }

    usort($filtered_pets, function ($a, $b) {
        return $a['name'] <=> $b['name'];
    });

    echo json_encode($filtered_pets);

?>