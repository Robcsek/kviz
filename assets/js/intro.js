

// ----------------  Labda, kérdőjel létrehozása és HTML injektálása
const colors = ["#5513EF", "#5E35BC", "#B61CE5", "#AD7FD0", "#9933FF","#FF3399","#650D80","#D75685","#330019","#9E6FFA","#DC18F2","#E908AD","#67399B"]; //Színek listája tömb
const colorsBetu = ["#5513EF", "#5E35BC", "#B61CE5", "#AD7FD0", "#9933FF","#FF3399","#650D80","#D75685","#330019","#9E6FFA","#DC18F2","#E908AD","#67399B"]; //Színek listája tömb => kérdőjeleknek
var meret = 10;
const numBalls = 12;  //labdák száma (amennyit a képernyőn szeretnénk látni = inzertált DIV száma is!)
const balls = [];  //labda tömb - animálás miatt szükséges létrehozni és feltölteni

for (let i = 0; i < numBalls; i++) {   
  meret = Math.floor((Math.random()*60+30)+(Math.random()*50)+10);
  let ball = document.createElement("div");  // div inzert létrehozása
  ball.classList.add("ball");                // div->class:"ball" inzert létrehozása -> a fenti div és a 'ball' egyfajta fészek a lenti style-hoz
  ball.style.zIndex = 1;
  ball.style.background = colors[Math.floor(Math.random() * colors.length)]; // labdák háttere = colors lista véletlen eleme
  ball.style.left = `${Math.floor(Math.random() * 100)}vw`; //labda kezdeti helye -> bal-felső= 0,0
  ball.style.top = `${Math.floor(Math.random() * 60)}vh`; //ladba kezdeti helye -> vertikálisan (horizontális sor értéke)
  //ball.style.width = `${Math.random()*10+5}em`; //labda szélessége random
  //ball.style.height = ball.style.width; //labda magassága = szélessége (kör alakot akarunk, de itt még négyzet)
  ball.innerHTML ='?';  
  ball.style.fontSize = `${meret}px`; // random méret a kérdőjelhez
  ball.style.color = colorsBetu[Math.floor(Math.random() * colors.length)]; // kérdőjelek random színének beállítása  
  ball.style.width = `${meret*1.35}px`; //labda szélessége a kérdőjel szélességéhez képest
  ball.style.height = ball.style.width; //labda magassága = szélessége (kör alakot akarunk, de itt még négyzet)
  //ball.style.transform = `scale(${Math.random()*5+1})`; //labda méret változtatás egységesen
  balls.push(ball); //kialakított egyed labda a 'balls' tömb (labdák) hozzáadva
  document.body.append(ball); //inzertálni a teljes style 'labda' egyedet a html részre (akár record!)
}

// ----------------  Keyframes és animáció
balls.forEach((el, i, ra) => {     //balls tömb bejárása, mindegyik labdára más egyedi animáció (randomizálva!)
  let to = {
    x: Math.random() * (i % 2 === 0 ? -13 : 13),  // horizontális mozgástér beállítása 
    y: Math.random() * (i % 2 != 0 ? -30 : 55),  // vertikális mozgástér beállítása
    deg1:Math.floor(Math.random() * 300 + Math.random() * 40),   //forgási szög randomizálása 
  };

  let anim = el.animate(          //maga a mozgási animáció meghatározása
    [
     
      //{transform: "translate(0,0)"},
      { transform: `rotate(${to.deg1}deg)`},
      { transform: `translate(${to.x}rem, ${to.y}rem)`}, 
      

    ],

    {
      duration: (Math.random() + 1) * 4000, // random duration -> ne legyen túl gyors = cikázás - most: minimum 4másodperc *2
      direction: "alternate", //oda-vissza
      fill: "both", //kezdeti és vég színnel
      iterations: Infinity, //végtelen sokszor
      easing: "ease-in-out"  //cubic blezier mozgás is szóba jöhet még...
    }
  );
});
