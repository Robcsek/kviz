<?php
// Session létrehozása az átirányítások kezeléséhez (redirect) - nem használunk erre most 'cookie'-kat.
session_start();
  
// Meghívjuk a 'config.php'-t, ahol a szerveroldali kapcsolat végrehajtható.
require_once "config.php";
 
// Változók létrehozása és nullázása (üres sztring értékre)
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Elküldéskor az adatok feldolgozása 'Post' módszerrel
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Username (felhasználónév) ellenőrzése. Ha üres, akkor hibát adni. 
    if(empty(trim($_POST["username"]))){
        $username_err = "Kérem, adja meg a felhasználónevét!";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Password (jelszó) ellenőrzése. Ha üres, akkor hibát adni.
    if(empty(trim($_POST["password"]))){
        $password_err = "Kérem, adja meg a jelszavát!";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Adatok hitelesítése és ellenőrzése (ha nincs hiba, akkor belépünk a végrehajtásba)
    if(empty($username_err) && empty($password_err)){
        // Előkészítjük a 'Select'-et lekérdezésre
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Általános hibakizáráshoz multicard (üres, csak tipusjelzéses) paraméterezést hozunk létre
            $stmt->bind_param("s", $param_username);
            
            // Beállítjuk a változó paramétert
            $param_username = $username;
            
            // Az elkészített utasítás végrehajtása
            if($stmt->execute()){
                // Találati eredmény tárolása
                $stmt->store_result();
                
                // Ha létezik a felhasználónév, ellenőrizze a jelszót
                if($stmt->num_rows == 1){                    
                    // Találatok változóinak vizsgálata
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Ha a jelszó helyes, kezdjen egy új munkamenetet (session)
                            //session_start();
                            
                            // A találati adatok letárolása a session-változókba, belépési igazolás (loggedin = true)
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $GLOBALS['username'] = $username;                                                        
                           
                        } else{
                            // Hamis ág: nem egyezik a jelszó -> általános hibaüzenet.
                            $login_err = "Helytelen felhasználónév vagy jelszó.";
                        }
                    }
                } else{
                    // A felhasználónév (username) nem létezik az adatbázisban -> általános hibaüzenet
                    $login_err = "Helytelen felhasználónév vagy jelszó.";
                }
            } else{
                // Kitételkezelés -> hiba -> végrehajtási hiba 
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
  <title>KVÍZ - Tentacles Projekt - Főoldal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="./assets/graphs/tentacles_flavicons/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>  
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">  
  <script src="https://kit.fontawesome.com/e1a01595a9.js" crossorigin="anonymous"></script>  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="/assets/css/foldal_valid.css">
  <script src="./assets/js/fooldal.js"></script>
  
  
</head>
<body>

  <div class="container-fluid" id="fejlec" style="background-color: rgb(0, 11, 61); opacity: 1;" >
  
  </div>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">

    <div class="container-fluid align-middle">    
      <a class="navbar-brand" href="#">
        <img src="/assets/graphs/tentacles_flavicons/android-chrome-512x512.png" alt="Tentacles Teams Logo" style="width:40px;" class="rounded-pill"> 
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#D1"><i class="fa-solid fas fa-gamepad fa-flip" style="--fa-animation-duration: 3.5s; font-size: 1.5em;"> </i>Játékról</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#D2"><i class="fa-solid fas fa-user-friends fa-flip" style="--fa-animation-duration: 4.4s; font-size: 1.5em;"> </i>Csapatról</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#D3"><i class="fa-solid fas fa-cogs fa-flip" style="--fa-animation-duration: 5.6s; font-size: 1.5em;"> </i>Háttérről</a>
          </li>   
          <li class="nav-item">
            <a class="nav-link" href="#D4"><i class="fa-solid fas fa-question fa-flip" style="--fa-animation-duration: 3.8s; font-size: 1.5em;"> </i> &nbsp; GY.I.K.</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#D5"><i class="fa-solid fas fa-envelope-open fa-flip" style="--fa-animation-duration: 6.5s; font-size: 1.5em;"> </i>Kapcsolat</a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" href="toplista.php"><i class="fa-solid fa-dungeon fa-flip" style="--fa-animation-duration: 7.5s; font-size: 1.5em;"> </i>Toplista</a>
          </li>  
        </ul>
      </div>	
    </div>
  </nav>

  <!--div
    data-aos="fade-up"
    data-aos-offset="200"
    data-aos-delay="50"
    data-aos-duration="1000"
    data-aos-easing="ease-in-out"
    data-aos-mirror="true"
    data-aos-once="false"
    data-aos-anchor-placement="top-center"
  >
  </div-->

<div  id="D1">  <!--  ***  Eslő DIV => JÁTÉKRÓL LEÍRÁS   ***   -->
  <br><br><br>
<hr>
<hr>
</div>

<div class="container-fluid mt-5">
  <div class="row clearfix">
    <div class="col-sm-8">
      <div  id="Game" class="float-sm-start" data-aos="fade-down-right" data-aos-duration="1800" data-aos-delay="800";>  

          <h3 class="small"  style="padding-bottom: 1em";>A Játékról</h3>
          <hr>
          <h4>Üdvözlet a Tentacles Teams Kvíz játék oldalán!</h4> <br>
          <p>Véletlenszerűen változó nehézségű kérdésekre várjuk majd a válaszaid. Egy gyors regisztráció után máris elkezdheted a játékot. Jelenleg kétféle játékmód közül választhatsz:</p>
          <p class="p_kiemelt"> <span class="span_kiemelt">Kihívás játékmód - </span>  60 másodpercnyi játékidőd lesz. Igyekezz minél több kérdésre megtalálni a helyes választ! Sok sikert! </p>
          <p class="p_kiemelt"> <span class="span_kiemelt">Időzár játékmód - </span>  itt 5 'élettel' indul a játék. Egy kérdés megválaszolására 15 másodpercnyi időd lesz. Rossz válasz vagy 15 másodperc letelte után (ha nincs válasz vagy az rossz) 1 életet elvesztesz. A játék véget ér, ha elfogytak az 'életek'. A legtöbb helyes választ begyűjtő játékosok kerülnek fel a Toplistára.</p><hr>    
      </div>
    </div>
    <div class="col-sm-4">

        <div id="Game_2" class="float-sm-end"  data-aos="fade-down-left" data-aos-duration="1200" data-aos-delay="900";>
          <div class="login_kezeles">


          <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
            <h3  style="padding-bottom: 1em" >Beléptetve</h3>
            <hr>
            <h5>Üdvözöllek <strong><?php echo $_SESSION["username"];?></strong> !</h5>            
            <hr>
            <br>
            <div class="form-group">
            <p>
                <a href="reset-password.php" class="btn btn-outline-success ml-2">Új jelszó megadása</a>
                <a href="logout.php" class="btn btn-outline-danger ml-2">Kijelentkezés</a>
            </p>
                </div>
          <? else: ?>
          
            <h3>Belépés</h3>
            <p></p>
            <p>Add meg a regisztrációkor kiválasztott felhasználóneved és jelszavad!</p>
            <hr>
    
            <?php /* Ha van belépési hiba, általános hibaüzenet kiiratása. */
            if(!empty($login_err)){
                echo '<div class="alert alert-danger"> <strong>' . $login_err . '</strong></div>';
            }        
            ?>
            
    


            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Felhasználónév</label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <p></p>    
                <div class="form-group">
                    <label>Jelszó</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <p></p> 
                <hr>
                <p></p>
                <div class="form-group">
                    <input type="submit" class="btn btn-outline-primary" value="Belépés"><br><br>
                </div>
                <p></p>
                <p>Nem regisztráltál még?<br>
                <span> <strong> <a href="register.php">Regisztrálok most!</a></strong></span><strong></p>
                <p>  <a style="color:brown; font-size: 0.9em"  href="remember.php">Elfelejtettem a jelszavam...</a></strong> </p-->
            </form>
            <?php endif; ?>
        </div>     
          
    </div>


    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
        <div id="Game_reg" class="float-end mt-2"  data-aos="fade-down-left" data-aos-duration="1800" data-aos-delay="600";>
          <button class="m-0 mx-auto p-0 button" onClick="window.open('game.php', '_self');" style="cursor: pointer;">
            <i class="fa-solid fa-dice-d20 fa-beat-fade" style="--fa-animation-duration: 1.5s; font-size: 2.5em;">
            <br style="vertical-align: -37%";></i> <br>
             <i id="start" class="fa-solid fa-beat-fade" style="--fa-animation-duration: 1.5s; font-size: 1.3em;"  onClick="window.open('.php', '_self');" style="cursor: pointer;"><br>START</i>
          </button>            
        </div>
    <?php endif; ?>    
    </div>        
  </div>
</div>

<div  id="D2">  <!--  ***  Második DIV => Készítő csapatról bemutatkozó rész   ***   -->
  <br><br><br>
<hr>
<hr>
</div>

<h2 class="container w-80 mx-auto" data-aos="zoom-in" data-aos-duration="2200" data-aos-delay="400" style="font-size: xx-large; color:aliceblue; text-align: center;"; >A készítőkről néhány szóban...</h2>



<div class="container-fluid mt-5">
  <div class="row clearfix">
    <div class="col-md-6 float-sm-start" data-aos="fade-right" data-aos-duration="3000" data-aos-delay="5000";>
      <div class="cardBox" >
        <div class="card csr">
          <div class="front">            
            <h2>Csongrádi Róbert</h2>
            <hr style="width: 40%; margin-left: 60%;">
            <p>fejlesztő</p>            
            <strong>&#x21bb;</strong>  
            <hr style="width: 40%; margin-left: 60%;">      
          </div>
          <div class="v-50" style="margin-left: 55%; margin-top: 6.5em";>

            <div id="html_csr" class="progress ms-3" style="background-color: transparent; margin: 0.8em 0em; width: 100%";>
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="text-shadow: rgb(12, 12, 19);";>
              HTML & CSS  -  90%
              </div>                
            </div>

            <div id="java_csr" class="progress ms-3" style="background-color: transparent; margin: 0.8em 0em; width: 100%";>
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="text-shadow: rgb(12, 12, 19);";>
              JAVA - 70%
              </div>  
            </div>

            <div id="php_csr" class="progress ms-3" style="background-color: transparent; margin: 0.8em 0em; width: 100%";>
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="text-shadow: rgb(12, 12, 19)";>
              PhP & MySQL - 75%
              </div>  
            </div>

          </div>        
          <div class="back">
            <div class="col">
              <h4>Ismerj meg!</h4>
              <hr style="width: 90%; margin-left: 10%;"> 
              <h6 style="font-size: 0.7em";>Front-end részen a magas ügyfélélményt nyújtó meoldások elkészítése motivál. Szeretnék szakmailag a komplex fejlesztés irányába mozdulni. Mind a script-nyelvekben, mind keretrendszerek használatában jelentősen fejlódni. </h6>                                   
              <a href="https://csongradi.eu">személyes honlap</a>          
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 float-sm-end" data-aos="fade-left" data-aos-duration="3000" data-aos-delay="5000";>
      <div class="cardBox" >
        <div class="card sza">
          <div class="front">            
            <h2>Szuper András</h2>
            <hr style="width: 40%; margin-left: 60%;">
            <p>fejlesztő</p>            
            <strong>&#x21bb;</strong>  
            <hr style="width: 40%; margin-left: 60%;">      
          </div>
          <div class="w-50" style="margin-left: 50%; margin-top: 6.5em";>

            <div id="html_sza" class="progress ms-3" style="background-color: transparent; margin: 0.8em 0em; width: 90%";>
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="text-shadow: rgb(12, 12, 19);";>
              HTML & CSS  -  90%
              </div>                
            </div>

            <div id="java_sza" class="progress ms-3" style="background-color: transparent; margin: 0.8em 0em; width: 40%";>
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="text-shadow: rgb(12, 12, 19);";>
              JAVA - 40%
              </div>  
            </div>

            <div id="php_sza" class="progress ms-3" style="background-color: transparent; margin: 0.8em 0em; width: 60%";>
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="text-shadow: rgb(12, 12, 19)";>
              PhP & MySQL - 60%
              </div>  
            </div>

          </div>        
          <div class="back">
            <div class="col">
              <h4>Ismerj meg!</h4>
              <hr style="width: 90%; margin-left: 10%;"> 
              <h6 style="font-size: 0.7em";>Felsőfokú informatikai képzésre kívánok jelentkezni. Ezért is fontos számomra, hogy ismeretet és gyakorlatot szerezzek ezen a téren. </h6>                                   
              <a href="https://www.w3schools.com">személyes honlap</a>          
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>






<div  id="D3">  <!--  ***  Harmadik DIV => Hengersor iskoláról és tanárainkról bemutató rész    ***   -->
  <br><br><br>
<hr>
<hr>
<br>
<h1></h1>
<br>
</div>


<h2 class="container w-80" data-aos="zoom-in" data-aos-duration="2200" data-aos-delay="400" style="font-size: xx-large; color:aliceblue; text-align: center;"; >Akik nélkül nem sikerülhetett volna...</h2>

<div class="container-fluid my-5 hengersor_suli">
  <div class="row clearfix">
    <div class="col-lg-3 float-md-start mx-auto" id="Support" data-aos="fade-right" data-aos-duration="2500" ;>
      <hr style="width: 75%; margin: auto;">
      <br><br>  
        <p style="font-size: 1.4em; font-weight: bold;">BENCZE ISTVÁN <br> <span style="font-size: 0.7em; font-weight: 400;">tanár úr  <hr style="width: 75%; margin: auto;"></span><a class="mailto" href="mailto:bencze.istvan@hengersor.hu?subject=Érdeklődés a felnőttoktatásról";><i class="fa-solid fa-envelope fa-shake" style="--fa-animation-duration: 5.0s; font-size: 1.2em; color: rgba(70, 4, 78, 0.774); padding-left: 0em;"></i></a></p>
                
        <p>Szakmai informatikai tárgyak oktatója</p> 
        <p>A Digitális Munkaközösség tagja</p>
        <p>(Cisco, Front-end, Bootstrap, Angular)</p>
        <hr style="width: 75%; margin: auto;"><br>
    </div>

    <div class="col-lg-3 float-md-start mx-auto" id="Support" data-aos="fade-up" data-aos-duration="2500" ;>
      <hr style="width: 75%; margin: auto;">
      <br><br>  
        <p style="font-size: 1.4em; font-weight: bold;">DOBROCSI RÓBERTNÉ<br> <span style="font-size: 0.7em; font-weight: 400;">tanárnő  <hr style="width: 75%; margin: auto;"></span><a class="mailto" href="mailto:dobrocso.csilla@hengersor.hu?subject=Érdeklődés a felnőttoktatásról";><i class="fa-solid fa-envelope fa-shake" style="--fa-animation-duration: 5.0s; font-size: 1.2em; color: rgba(70, 4, 78, 0.774); padding-left: 0em;"></i></a></p>

        <p>Szakmai informatikai tárgyak oktatója</p> 
        <p>A Digitális Munkaközösség vezetője</p>
        <p>(Front-end, Bootstrap, Java, Python, C#)</p>
        <hr style="width: 75%; margin: auto;"><br>
    </div>

    <div class="col-lg-3 float-md-start mx-auto" id="Support" data-aos="fade-left" data-aos-duration="2500" ;>
      <hr style="width: 75%; margin: auto;">
      <br><br>  
        <p style="font-size: 1.4em; font-weight: bold;">KECSKEMÉTI CSABA <br> <span style="font-size: 0.7em; font-weight: 400;">tanár úr  <hr style="width: 75%; margin: auto;"></span><a class="mailto" href="mailto:kecskemeti.csaba@hengersor.hu?subject=Érdeklődés a felnőttoktatásról";><i class="fa-solid fa-envelope fa-shake" style="--fa-animation-duration: 5.0s; font-size: 1.2em; color: rgba(70, 4, 78, 0.774); padding-left: 0em;"></i></a></p>
                
        <p>Szakmai informatikai tárgyak oktatója</p> 
        <p>A Digitális Munkaközösség tagja</p>
        <p>(Back-end, PHP(myAdmin), MySQL)</p>
        <hr style="width: 75%; margin: auto;"><br> 
    </div>
    
  </div>
  <span><a id="sulilink" href="https://hengersor.hu";>Budapesti Gazdasági Szakképzési Centrum Pestszentlőrinci Technikum</a></span>
</div>







<div  id="D4">  <!--  ***  Negyedik DIV => Gyakori kérdések (GY.I.K.) => Accordion rész.   ***   -->
  <br><br><br>
<hr>
<hr>
</div>


<div class="container w-90 mx-auto mt-5"  data-aos="fade-down" data-aos-duration="2500"; id="GYIK">
  <h2>Gyakran Ismételt Kérdések (GY.I.K.)</h2>
  <p><br><br><hr></p>
  
  <button class="accordion">Regisztráció nélkül lehet játszani a Kvízzel?</button>
  <div class="valaszpanel">    
    <p>Sajnos nem lehet regisztráció nélkül játszani. Vizsgamunkaként készült a Kvízjáték. Fontos volt, hogy tettenérhető legyen az adatbázis- és jogosultságkezelés. Mivel néhány mozdulat mindössze, ezért azt javasuljuk: regisztrálj gyorsan és lépj be utána! 
    </p>
    <hr>
  </div>
  
  <button class="accordion">Tudunk a barátommal vagy barátaimmal közösen, egyszerre játszani?</button>
  <div class="valaszpanel">
    <p>A jelenlegi állapotában az 1-játékos lehetőségig lett elkészítve a játék. Tervezzük többjátékos és akár csapat-játék üzemmód fejlesztését is a jövőben.</p>
    <hr>
  </div>
  
  <button class="accordion">Hogyan lehet feladványként kérdéseket-válaszokat küldeni Nektek?</button>
  <div class="valaszpanel">
    <p>Nagyon jó kérdés! Ez a következő fejlesztés, amit nagyon szeretnénk elkészíteni. Jelenleg - sajnos - időszűke miatt nem sikerült ezt az opciót véghezvinnünk. Dolgozunk rajta! :)</p>
    <hr>
  </div>
 

</div>





<div  id="D5">  <!--  ***  Ötödik DIV => Általános kapcsolatfelvétel és Üzenőfalra írás része.   ***   -->
  <br><br><br><br><br>
<hr>
<hr>
</div>



<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
  AOS.init();
 
</script>




<script>  
$(document).ready(function(){
  $("#java_csr").animate({width: "70%", // mennyi legyen a csík terjedelme a 100%-hoz képest?
  }, 5000);  // mennyi idő alatt fusson le az 'animálása'?
  $("#html_csr").animate({width: "90%",}, 5000);  
  $("#php_csr").animate({width: "75%",}, 5000);  

  $("#java_sza").animate({width: "40%",}, 5000); 
  $("#html_sza").animate({width: "90%",}, 5000);  
  $("#php_sza").animate({width: "60%",}, 5000);  

  $(".progress-bar").animate({width: "100%",}, 5000);
});

</script>

<script>
  var acc = document.getElementsByClassName("accordion");
  var i;
  
  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("jelolve");
      var valaszpanel = this.nextElementSibling;
      if (valaszpanel.style.maxHeight) {
        valaszpanel.style.maxHeight = null;
      } else {
        valaszpanel.style.maxHeight = valaszpanel.scrollHeight + "px";
      } 
    });
  }
  </script>

  
</body>
</html>

