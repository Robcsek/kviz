<?php

// ha nincs belépve, redirection -> főoldalra
 session_start();
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]){}
  else{ header('location: fo3.php'); }



// Meghívjuk a 'config.php'-t, ahol a szerveroldali kapcsolat végrehajtható.
require_once "config.php";
 
    $name = $_SESSION['username'];
    $score = mysqli_real_escape_string($mysqli, $_POST['pontszam']);
    
 
 
    if(mysqli_query($mysqli, "INSERT INTO toplista(username, score) VALUES('" . $name . "', '" . $score . "')")) {
    
    } else {
       echo "Error: " . $sql . "" . mysqli_error($mysqli);
    }
 
    mysqli_close($mysqli);
 
?>


