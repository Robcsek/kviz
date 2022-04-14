<?php
// Meghívjuk a 'config.php'-t, ahol a szerveroldali kapcsolat végrehajtható.
require_once "config.php";
 
// Változók létrehozása és nullázása (üres sztring értékre)
$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";

function bevitel_szures($data) {  //  karakterlánc tisztítása
    $data = trim($data);   // felesleges karakterek (szóköz, tab...stb.) eltávolítása
    $data = stripslashes($data);  // '\'-jelek eltávolítása
    $data = htmlspecialchars($data);  //  predef karakterek HTML entitássá alakítása
    return $data;
  }
 
// Elküldéskor az adatok feldolgozása 'Post' módszerrel
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Felhasználónév (username) ellenőrzése
    if ((strlen(bevitel_szures($_POST["username"])) > 16) || (strlen(bevitel_szures($_POST["username"])) <4)){
        $username_err ="Minimum 3, maximum 16 karakter hosszú nevet válassz!";
    }
    if(empty(trim($_POST["username"]))){
        $username_err = "Felhasználónév megadása kötelező!";
    } elseif(!preg_match("/^[0-9a-zA-Z- áéíóöőúüűÁÉÍÓÖŐÚÜŰ]*$/", trim($_POST["username"]))){
        $username_err = "A Felhasználónév csak kis- és nagybetűket, számokat és szóközt tartalmazhat!";
    } else{
        // Utasítás előkészítése (Select előkészítése a lekérdezéshez)
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Általános hibakizáráshoz multicard (üres, csak tipusjelzéses) paraméterezést hozunk létre
            $stmt->bind_param("s", $param_username);
            
            // Beállítjuk a változó paramétert
            $param_username = trim($_POST["username"]);
            
            // Az elkészített utasítás végrehajtása
            if($stmt->execute()){
                // Találati eredmény tárolása
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "Ez a felhasználónév már használatban van.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Elnézést, a feldolgozás során hiba történt. Kérlek, próbáld meg később ismét!";
            }

            // Utasítás zárása
            $stmt->close();
        }
    }
    
    // Jelszó ellenőrzése   
    if(empty(trim($_POST["password"]))){
        $password_err = "Jelszó megadása kötelező!";     
    } elseif (strlen(bevitel_szures($_POST["password"])) > 16 || strlen(bevitel_szures($_POST["password"])) < 6 ){
        $password_err ="Minimum 6, maxium 16 karakter hosszú jelszót válassz!";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Jelszó és jelszó ismétlés azonosságának vizsgálata
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Ismételje meg a megadott jelszavát!";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "A megadott jelszavak nem egyeznek meg.";
        }
    }


    // E-mail cím vizsgálata
    if (strlen(bevitel_szures($_POST["email"])) > 195){
        $email_err ="Túl hosszú e-mail címet adtál meg (195max)!";
    }
    if (empty($_POST["email"])) {  // ha üres -> hiba.
        $email_err = "Emailcím megadása kötelező!";
      } else {
        $email = bevitel_szures($_POST["email"]);
        // email cím ellenőrzése beépített filter-függvény használatával.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $email_err = $email."E-mail cím nem megfelelő!";
        }
      }

    
    // Beviteli hibák ellenőrzése. Ha nincs hiba, az új rekord beillesztése az táblába.
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)){
        
        // A beillesztési utasítás előkészítése
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Általános hibakizáráshoz multicard (üres, csak tipusjelzéses) paraméterezést hozunk létre
            $stmt->bind_param("sss", $param_username, $param_password, $param_email);
            
            // Változók beállítása küldés előtt
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Jelszó "hash' készítése - titkosítás.
            $param_email = $email;
            // Az elkészített utasítás végrehajtása
            if($stmt->execute()){
                // Átirányítás (redirect) a 'login.php' oldalra (regisztráció kész, lépjen be!)
                header("location: fo3.php");
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
    <title>Tentacles Teams - KVÍZ - Regisztrációs oldal</title>
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
    <div class="Regdoboz ">
        <h2>Regisztráció</h2>
        <hr>
        <p>Kérem, töltse ki a mezőket egy új fiók létrehozásához!</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Felhasználónév</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Jelszó</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Jelszó megerősítése</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>E-mail cím</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn regButton" value="Regisztráció">
                
            </div>
            <p>Van már regisztrációja?  &nbsp &nbsp &nbsp <a href="fo3.php">  Igen van, Belépek.</a></p>
        </form>
    </div>
</div>
    
    


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
  AOS.init();
 
</script>

</body>
</html>