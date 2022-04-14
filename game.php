<?php
// ha nincs belépve, redirection -> főoldalra
 session_start();
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]){}
  else{ header('location: fo3.php'); }

?>








<!DOCTYPE html>
<html lang="hu">
<head>
    <title>KVÍZ - Tentacles Projekt - Game</title>
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
    <link rel="stylesheet" href="./assets/css/game.css">


</head>
<body>


<div class=" col-xs-11 col-sm-10 col-md-6 col-lg-6 col-xl-6 align-middle" id="Game">
        <p  class=" align-middle" id="score">
            Pontszám: <span id="scoreValue">&nbsp; 0</span>
        </p>        
        
        <div class="row"></div>           
            <div class="col-sm-4 align-middle" id="correct">
                
                Helyes válasz!
            </div>
            <div class="col-sm-4 align-middle" id="timeRemaining" style="font-family:Arial, Helvetica, sans-serif">
                Hátralévő idő: <span id="timeRemainingValue">60</span>
            </div>
            <div class="col-sm-4 align-middle" id="wrong">
                
                Rossz válasz!
            </div>
           

            <div class="col-sm-12 mt-1 " id="question">                
             <h5>A kérdés:  </h5>  
            </div>
        </div>
   
        <h5  id="instruction">
            Ha forognak a kérdőjelek -> Start!
        </h5>
        
        <div class="container-fluid my-2 py-2  col-xs-11 col-sm-10 col-md-6 col-lg-6 col-xl-6"  id="choices">           
            <ul class="choices_list" >
              <li class="list-group-item box" id="box1" data-num="1"><i class="fa-solid fas fa-question fa-flip" style="--fa-animation-duration: 1.8s; font-size: 1.5em;"></i>&nbsp;&nbsp;&nbsp;</li>
              <li class="list-group-item box" id="box2" data-num="2"><i class="fa-solid fas fa-question fa-flip" style="--fa-animation-duration: 1.8s; font-size: 1.5em;"></i>&nbsp;&nbsp;&nbsp;</li>
              <li class="list-group-item box" id="box3" data-num="3"><i class="fa-solid fas fa-question fa-flip" style="--fa-animation-duration: 1.8s; font-size: 1.5em;"></i>&nbsp;&nbsp;&nbsp;</li>
              <li class="list-group-item box" id="box4" data-num="4"><i class="fa-solid fas fa-question fa-flip" style="--fa-animation-duration: 1.8s; font-size: 1.5em;"></i>&nbsp;&nbsp;&nbsp;</li>
            </ul>
            
        </div>
        <div id="startReset" onclick="startReset()">
            Start
        </div>
    </div>
        


    <div class="form-group mt-3" id="gombok">
            <p>
                <a href="fo3.php" class="btn btn-sm btn-outline-success ">Visszatérés a főoldalra</a>               
            </p>
    </div>
        <div id="gameOver">
            <p id="">A játéknak vége! <br>   Pontszámod: <span id="scoreNumber">0</span></p>           
        </div>
 
        
<script src="./assets/js/kerdesek.js"></script>

<script type="text/javascript">
  
  /*
 * Játékmenet logikai-tábla
 * ---Kérdés/Válaszok tömb leképezése, változók létrehozása
 * 
 * Játék indítása: klikk a Start gombra:
 *      - ha játékban vagyunk:
 *          az oldal újratöltése
 *      - ha nem vagyunk játékban:
 *          pontszám nullázása
 *          mezők kiürítése
 *          visszaszámláló beállítása, 1másodperces ciklus létrehozása
 *          Van még hátralévő idő
 *              igen -> folytatás
 *              nem -> játék vége funkció hívása
 *          alsó gomb érték/felirat 'reset'-re váltani
 *          'új kérdés/válaszok' funkció meghívása
 * 
 * Ha klikkelünk valamelyik válasz dobozra:
 *      ha játékban vagyunk:
 *          Helyes a válasz?
 *              igen --> 
 *                  növeld meg a pontszámot 1-gyel
 *                  megmutatni 1másodpercre a 'jó válasz' feliratot
 *                  'új kérdés/válaszok' funkció meghívása 
 *              nem --> 
 *                  megmutatni 1másodpercre a 'rossz válasz' feliratot
 *                  'új kérdés/válaszok' funkció meghívása 
 */




var gameCounter;
var gameTimeLeft;
var score;
var gameOn = false;
var most;

var correctAnswer;
let tombHossz = questions.length;
let rndTomb = [];




for (x = 0; x <= (tombHossz); x++)  // véletlen tömb normál sorrendben feltöltve -> index kiválasztáshoz
{
    rndTomb.push(x);   
}

shuffle(rndTomb);  // Összerázzuk a tömböt -> véletlen sorrend

//most = rndTomb[rndTomb.length-1];
//rndTomb.pop();


document.getElementById("startReset").onclick = function() {
    most = Math.floor((Math.random() * 10) + 1);
    if (gameOn === true){
       
        window.location.reload(false);
   
    }else{
        
        score = 0;        
        document.getElementById("scoreValue").innerHTML = score;
        var countLeft = 60; // hátralévő idő        
        hide("gameOver");
        passziv ("instruction");
        document.getElementById("startReset").innerHTML = "Újra";        
        gameCounter = setInterval(function(){countLeft--; timeRemainingValue.innerHTML = countLeft;},1000);        
        gameTimeLeft = setTimeout(gameOver, 60000);       // játékvége idő = hátralévő idő legyen!!!
        gameOn = true;      
        generateQA(most);
    }
};


// Játék vége eljárás
function gameOver(){
    window.clearInterval(gameCounter);
    passziv("timeRemaining");
    show("gameOver");
    document.getElementById("scoreNumber").innerHTML = score;
    document.getElementById("startReset").innerHTML = "Start";
    gameOn = false;

    $.ajax({
                    type: "POST",
                    url: "toplist.php",
                    data: {
                        pontszam : score
                       
                    },
                    cache: false,
                    success: function(data) {
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });

    
};



// A "Fisher-Yates Shuffle" eljárás alkalmazása 'véletlen' sorrendű tömb létrehozásához
function shuffle(array) {
    let counter = array.length; //'counter' változó = tömb hossza

    while (counter > 0) {
    // Véletlen alapú index létrehozása a tömb hosszát alapul véve
    let index = Math.floor(Math.random() * counter);

    // 'counter' változó értékének csökkentése 1-gyel (max = max -1)
    counter--;

    // ...és itt cserélgetjük össze a tömb elemeit -> ideiglenes = utolsó (max), utolsó = véletlen, véletlen = ideiglenes - ciklusban végig -> első tömbelemig visszafelé
    let temp = array[counter];
    array[counter] = array[index];
    array[index] = temp;
    }

    return array;
    }


// Új 'kérdés-válasz' generálása -> PHP MySQL Select alapján készül el 1-1 kérdés-válasz

function generateQA(index){
    most = rndTomb[rndTomb.length-1];
    rndTomb.pop();
    console.log((rndTomb.length));
    if (rndTomb.length <=0){gameOver(); rndTomb.length = 10;}
    document.getElementById("box1").innerHTML = questions[index].options[0];
    document.getElementById("box2").innerHTML = questions[index].options[1];
    document.getElementById("box3").innerHTML = questions[index].options[2];
    document.getElementById("box4").innerHTML = questions[index].options[3];
    
    document.getElementById("question").innerHTML = questions[index].question;
    
    correctAnswer = questions[index].answer;
   };



function hide(elementId){
    document.getElementById(elementId).style.display = 'none';
}
function show(elementId){
    document.getElementById(elementId).style.display = 'inline-block';
}

function passziv(elementId){
    document.getElementById(elementId).style.color = 'transparent';
    document.getElementById(elementId).style.backgroundColor = 'transparent';
}
function jovalasz(elementId){
    document.getElementById(elementId).style.color = 'white';
    document.getElementById(elementId).style.backgroundColor = 'green';
}
function rosszvalasz(elementId){
    document.getElementById(elementId).style.color = 'black';
    document.getElementById(elementId).style.backgroundColor = 'red';
}




// Kiértékelés
for(b=1;b<5; b++){
    document.getElementById("box"+b).onclick = function() {
        // Játékban vagyunk?
        if (gameOn === true){
        // A válasz helyes?
        // igen--> 
            if(this.innerHTML == correctAnswer){
            // pontszámot növelni
                score++;
                document.getElementById("scoreValue").innerHTML = score;
            // megmutatni kis időre a 'jó válasz' feliratot
                jovalasz("correct");
                setTimeout(function(){
                    passziv("correct");
                },700);
            // új 'kérdés-válasz' generálása (funkció hívással)
                //most=most+1
                generateQA(most);
            // no--> 
            }else {
            // megmutatni kis időre a 'rossz válasz' feliratot
                rosszvalasz("wrong");
                setTimeout(function(){
                    passziv("wrong");
                },700);
            // új 'kérdés-válasz' generálása (funkció hívással)
                //most=most+1
                generateQA(most);
            }
        }
    };
}
  
  
  
  
  </script>
 
</body>
</html>