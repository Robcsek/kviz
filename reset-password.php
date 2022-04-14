<?php
// Új session indítása
session_start();
 
// Ellenőrizzük, hogy be van-e lépve a user, ha nincs átirányítjuk a beléptetéshez.
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: fo3.php");
    exit;
}
 
// Meghívjuk a 'config.php'-t, ahol a szerveroldali kapcsolat végrehajtható.
require_once "config.php";
 
// Változók létrehozása és nullázása (üres sztring értékre)
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Űrlapadatok feldolgozása az űrlap elküldésekor (Post módszerrrel)
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Új jelszó vizsgálata, ellenőrzése
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Kérlek, add meg az új jelszavadat.";     
    } elseif (strlen(trim($_POST["new_password"])) > 16 || strlen(trim($_POST["new_password"])) < 6 ){
        $new_password_err ="Minimum 6, maxium 16 karakter hosszú jelszót válassz!";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Új jelszó ISMÉTLÉSÉNEK vizsgálata, ellenőrzése
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Kérlek, ismételd meg az új jelszót!";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "A megadott jelszavak nem egyeznek!";
        }
    }

    
    

    // Adatok hitelesítése és ellenőrzése (ha nincs hiba, akkor belépünk a végrehajtásba)
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Általános hibakizáráshoz multicard (üres, csak tipusjelzéses) paraméterezést hozunk létre
            $stmt->bind_param("si", $param_password, $param_id);
            
            // Beállítjuk a változó paramétert
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Az elkészített utasítás végrehajtása
            if($stmt->execute()){
                // Az új jelszó cseréje sikeres. Megsemmisítjük a sessiont és átirányítás a főoldalra (ahol a Beléptetés is van.)
                session_destroy();
                header("location: fo3.php");
                exit();
            } else{
                echo "Elnézést, a feldolgozás során hiba történt. Kérlek, próbáld meg később ismét!";
            }

            // Utasítás zárása
            $stmt->close();
        }
    }
    
    // Kapcsolat zárása
    $mysqli->close();
}
?>
 
 <!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Tentacles Teams - KVÍZ - Jelszó módosítás oldal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="./assets/graphs/tentacles_flavicons/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>  
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">  
    <script src="https://kit.fontawesome.com/e1a01595a9.js" crossorigin="anonymous"></script>  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="./assets/css/php_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<br><br>
<div class="col-xl-4 col-lg-5 col-md-6 col-sm-10 mx-auto" data-aos="zoom-in" data-aos-duration="2200" data-aos-delay="400">
    <div class="Regdoboz">
        <h2>Jelszó változtatás</h2>
        <br>
        <hr>
        <p>Kérlek, töltsd ki a mezőket az új jelszó létrehozásához!</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>Új jelszó</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Új jelszó megismétlése</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-outline-primary ml-2" value="Elküldés">
                <a class="btn btn-outline-warning ml-2" href="fo3.php">Mégsem</a>
            </div>
        </form>
    </div> 
    
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
  AOS.init();
 
</script>
</body>
</html>