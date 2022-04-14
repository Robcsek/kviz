<?php
/* Adatbázis hitelesítő adatok */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'csongra3_kviz');
 
/* Kapcsolódási kísérlet az MySQL adatbázishoz */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Kapcsolat ellenőrzése.
if($mysqli === false){
    die("HIBA: Nem sikerült kapcsolódni!" . $mysqli->connect_error);
}


?>