<?php
// Új session indítása
session_start();
 

 
// Meghívjuk a 'config.php'-t, ahol a szerveroldali kapcsolat végrehajtható.
require_once "config.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["email"]))){
        $email_err = "Kérem, adja meg az e-mail címét!";
    } else{
        $email = trim($_POST["email"]);
    }

    if(empty($email_err)){

        $email = $mysqli -> real_escape_string($_POST['email']);
        $temp_password = ($_POST['$temp_password']);

        $error_1 = $main_error = "";
        $sql = "SELECT * FROM users where email= '$email'";        
                $result = $mysqli -> query($sql);
                if($result){
                    session_start();
                    if (mysqli_num_rows($result) > 0) {
                        while($row = $result -> fetch_assoc()) {
                                      
                            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_";
                            $temp_password = substr(str_shuffle($chars), 0, 8);

                            
                            $param_password = password_hash($temp_password, PASSWORD_DEFAULT);
                            $param_id = $row['id'];



                            $sql = "UPDATE users SET password = '$param_password' WHERE id = $param_id";
                            
                            
                            if ($mysqli->query($sql) === TRUE) {
                                echo "Jelszó frissítve lett!";
                              } else {
                                echo "Hiba: " . $mysqli->error;
                              }
                                                                                                                    
                            $to = $email;
                            $subject = 'Ideiglenes jelszó generálása - Tenctales Teams - Kvíz';
                            

                                    $message = "
                                    Ideiglenes jelszó értesítés
                                    __________________________

                                    Az általad megadott e-mailcímre
                                    $email
                                    kiküldtük az új, ideiglenes jelszavadat:

                                    $temp_password
                                    
                                    Lépj be ezzel és változtasd meg!
                                    ";
                            
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                            $headers = "From: robert@csongradi.eu" . "\r\n" .  'X-Mailer: PHP/' . phpversion();   
                        
                    
                            mail($to, $subject, $message, $headers);

                            session_destroy();
                            header("location: fo3.php");
                        }

                        
                        
                            
                    }else {
                        $main_error = "Ez az e-mail cím nincs nyilvántartva.";} 
                } else {
                $main_error = "Ez az e-mail cím nincs nyilvántartva.";}
    }
}
                
    


                

        $mysqli->close();

        
?>




<!-- *****************************  ----->
 
 <!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Tentacles Teams - KVÍZ - Elfelejtett jelszó</title>
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
        <h2>Új jelszó kérése</h2>
        <hr>
        <?php /* Ha van belépési hiba, általános hibaüzenet kiiratása. */
            if(!empty($main_error)){
                echo '<div class="alert alert-danger"> <strong>' . $main_error. '</strong></div>';
            }        
            ?>    
        <p>Add meg az e-mail címedet az ideiglenes jelszó létrehozásához!</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
           
            <div class="form-group">
                <label>E-mail cím</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-outline-primary" value="Új jelszó kérése">
               
            </div>
            <!--h5><strong><?php echo $error_1  ?></strong></h5-->
    </div> 
    
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
  AOS.init();
 
</script>
</body>
</html>