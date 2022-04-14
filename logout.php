<?php

// ha nincs belépve, redirection -> főoldalra
 session_start();
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]){}
  else{ header('location: fo3.php'); }


 
// Minden session-változó kiürítése
$_SESSION = array();
 
// Sütik megsemmisítése

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
 }


// A session megsemmisítése
session_destroy();
 
// Átirányítás a főoldalra (ahol a beléptetés is van)
header("location: fo3.php");
exit;
?>