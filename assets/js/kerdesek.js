// creating an array and passing the number, questions, options, and answers
let questions = [
    {
    numb: 1,
    question: "Mikor volt István, királlyá koronázása?",
    answer: "1001. január 01.",
    options: [
      "1001. január 01.",
      "1001. január 11.",
      "1001. január 21.",
      "1001. január 31."
    ]
  },
    {
    numb: 2,
    question: "Kik voltak a Küklopszok a görög mitológiában?",
    answer: "Egyszemű óriások",
    options: [
      "Félig ember, félig lószerű lények",
      "Emberevő óriások",
      "Egyszemű óriások",
      "Óriási sasok"
    ]
  },
    {
    numb: 3,
    question: "Ki fedezte fel a déli sarkkört?",
    answer: "James Cook",
    options: [
      "Amerigo Vespucci",
      "Magellán",
      "James South",
      "James Cook"
    ]
  },
    {
    numb: 4,
    question: "Kik voltak a tatárok?",
    answer: "Mongolok",
    options: [
      "Törökök",
      "Mongolok",
      "Nyenyecek",
      "Levédiaiak"
    ]
  },
    {
    numb: 5,
    question: "Mikor gyártották az első Trabantot?",
    answer: "1957-ben",
    options: [
      "1955-ben",
      "1956-ban",
      "1957-ben",
      "1958-ban"
    ]
  },
  
  {
    numb: 6,
    question: "Ki volt az USA első elnöke?",
    answer: "George Washington",
    options: [
      "Thomas Jefferson",
      "George Washington",
      "Mike Tyson",
      "Abraham Lincoln"
    ]
  },
  {
    numb: 7,
    question: "Mi volt a régi Inka Birodalom központja?",
    answer: "Peru",
    options: [
      "Peru",
      "Chile",
      "Brazília",
      "Bolívia"
    ]
  },
  {
    numb: 8,
    question: "Hány aradi vértanu volt?",
    answer: "13",
    options: [
      "7",
      "13",
      "11",
      "számtalan sok"
    ]
  },
  {
    numb: 9,
    question: "Mi a neve annak a fegyvernek amivel Jézust megsebezték a kereszten?",
    answer: "A Végzet Lándzsája",
    options: [
      "A Balszerencse Dárdája",
      "A Végzet Kopjája",
      "A Végzet Fegyvere",
      "A Végzet Lándzsája"
    ]
  },
  {
    numb: 10,
    question: "Mi a squash?",
    answer: "Fallabda",
    options: [
      "Fallabda",
      "Gyeplabda",
      "Röplabda",
      "Sínlabda"
    ]
  },
  {
    numb: 11,
    question: "Milyen hosszú a Balaton?",
    answer: "77 km",
    options: [
      "66 km",
      "77 km",
      "88 km",
      "99 km"
    ]
  },
  {
    numb: 12,
    question: "Melyik államban van Dallas?",
    answer: "Texas",
    options: [
      "Kansas",
      "Texas",
      "Kalifornia",
      "Új-Mexikó"
    ]
  },
  {
    numb: 13,
    question: "Honnan ered a Duna?",
    answer: "a Fekete Erdőből",
    options: [
      "Csehországból",
      "Észak-Szlovákiából",
      "a Fekete Erdőből",
      "Franciaországból"
    ]
  },
  {
    numb: 14,
    question: "Melyik a Föld leghosszabb folyója?",
    answer: "Amazonasz",
    options: [
      "Nílus",
      "Rio Grande",
      "Mississippi",
      "Amazonasz"
    ]
  },
  {
    numb: 15,
    question: "Melyik NEM tartozik a világ hét csodája közé?",
    answer: "Noé Bárkája",
    options: [
      "Szermiramisz Függőkertje",
      "Noé Bárkája",
      "Rodoszi Kolosszus",
      "Pharoszi Világítorony"
    ]
  },
  {
    numb: 15,
    question: "Melyik megyében van Csanádapáca?",
    answer: "Békés megye",
    options: [
      "Baranya megye",
      "Bács-Kiskun megye",
      "Békés megye",
      "Csongrád-Csanád megye"
    ]
  },
  {
    numb: 16,
    question: "Hány méter magas a Kékes?",
    answer: "1014",
    options: [
      "1014",
      "1006",
      "997",
      "1074"
    ]
  },
  {
    numb: 17,
    question: "Melyik városban van a Golden Gate híd?",
    answer: "San Franciscoban",
    options: [
      "New Orleansban",
      "Las Vegasban",
      "San Franciscoban",
      "1New Yorkban"
    ]
  },
  {
    numb: 18,
    question: "Melyik téren van Budapesten a Mátyás templom?",
    answer: "Szentháromság téren",
    options: [
      "Mátyás téren",
      "Szentháromság téren",
      "II. János Pál pápa téren",
      "Szabaság téren"
    ]
  },
  {
    numb: 19,
    question: "Melyik fővárosban látható a Petronas-ikertorony?",
    answer: "Kuala Lumpurban",
    options: [
      "Kuala Lumpurban",
      "Katmanduban",
      "Hanoiban",
      "Rio de Janeiroban"
    ]
  },
  {
    numb: 19,
    question: "Mi a Csomolungma hegy másik elnevezése?",
    answer: "Mount Everest",
    options: [
      "Kilimandzsáró",
      "Mont Blanc",
      "Chimborazo",
      "Mount Everest"
    ]
  },
  {
    numb: 20,
    question: "Melyik volt hazánk első nemzeti parkja?",
    answer: "Hortobágyi",
    options: [
      "Hortobágyi",
      "Aggteleki",
      "Őrségi",
      "Kiskunsági"
    ]
  },
  {
    numb: 21,
    question: "Melyik a Föld leghosszabb szélességi köre?",
    answer: "Egyenlítő",
    options: [
      "Baktérítő",
      "Egyenlítő",
      "Központi Equalitas",
      "Ráktérítő"
    ]
  },
  {
    numb: 22,
    question: "Melyik a világ legmagasabban fekvő városa?",
    answer: "La Paz",
    options: [
      "Lagos",
      "La Paz",
      "Lima",
      "Linz"
    ]
  },
  {
    numb: 23,
    question: "Mi a Normafa régi neve?",
    answer: "Viharbükk",
    options: [
      "Szelesfa",
      "Ezüstfenyves",
      "Bükktető",
      "Viharbükk"
    ]
  },
  {
    numb: 24,
    question: "Hány piramisból állnak a Gízai piramisok?",
    answer: "Három",
    options: [
      "Kettő",
      "Három",
      "Öt",
      "Hét"
    ]
  },
  {
    numb: 25,
    question: "Mi az Andok legmagasabb pontja?",
    answer: "Aconcagua",
    options: [
      "Aconcagua",
      "K2",
      "Mahendragiri",
      "Csomolungma"
    ]
  },
  {
    numb: 26,
    question: "Mi Kolumbia hivatalos nyelve?",
    answer: "Spanyol",
    options: [
      "Angol",
      "Francia",
      "Portugál",
      "Spanyol"
    ]
  },
  {
    numb: 27,
    question: "Melyik országban van a Gyöngy-folyó?",
    answer: "Kína",
    options: [
      "Japán",
      "Kína",
      "Vietnám",
      "India"
    ]
  },
  {
    numb: 28,
    question: "Mi a Himalája szó jelentése?",
    answer: "'a hó hazája'",
    options: [
      "'a hó hazája'",
      "'a fehér óriás'",
      "'a hegyek ura'",
      "'a jég birodalma'"
    ]
  },
  {
    numb: 29,
    question: "Melyik a világ legnagyobb öble?",
    answer: "Bengáli-öböl",
    options: [
      "Mexikói-öböl",
      "Bengáli-öböl",
      "Perzsa-öböl",
      "Alaszkai-öböl"
    ]
  },
  {
    numb: 30,
    question: "Hány országon halad át a Duna?",
    answer: "10",
    options: [
      "8",
      "10",
      "12",
      "16"
    ]
  },
  {
    numb: 31,
    question: "Mikor és hol rendezték meg az első (modern) nyári olimpiai játékokat?",
    answer: "1896 Athén",
    options: [
      "1908 London",
      "1896 Athén",
      "1932 Los Angeles",
      "1904 Párizs"
    ]
  },
  {
    numb: 32,
    question: "Michael Phelps úszó, hány aranyérmet nyert 2012-ben Londonban?",
    answer: "4",
    options: [
      "4",
      "2",
      "5",
      "3"
    ]
  },
  {
    numb: 33,
    question: "Hány km hosszú a Kékszalag vitorlásverseny?",
    answer: "160 km",
    options: [
      "140 km",
      "160 km",
      "200 km",
      "260 km"
    ]
  },
  {
    numb: 34,
    question: "Maradona hányas mezt viselt?",
    answer: "10",
    options: [
      "1",
      "10",
      "7",
      "22"
    ]
  },
  {
    numb: 35,
    question: "Milyen szeszes ital az abszint?",
    answer: "égetett szesz",
    options: [
      "habzóbor",
      "ánizs-sör",
      "likőr",
      "égetett szesz"
    ]
  },
  {
    numb: 36,
    question: "Mi Pennsylvania állam itala?",
    answer: "tej",
    options: [
      "tej",
      "whisky",
      "gyömbérsör",
      "mazsolabor"
    ]
  },
  {
    numb: 37,
    question: "Melyik anyag okozza a paprika csípősségét?",
    answer: "kapszaicin",
    options: [
      "kini",
      "kapszaicin",
      "kodein",
      "klementin"
    ]
  },
  {
    numb: 38,
    question: "Mi a kaviár?",
    answer: "halikra",
    options: [
      "haltej",
      "helfej",
      "halikra",
      "halszem"
    ]
  },
  {
    numb: 39,
    question: "Miből készül a szaké?",
    answer: "rizsből",
    options: [
      "búzából",
      "árpából",
      "kölesből",
      "rizsből"
    ]
  },
  {
    numb: 40,
    question: "Milyen ital az Amaretto?",
    answer: "olasz mandulalikőr",
    options: [
      "olasz mandulalikőr",
      "francia ánizslikőr",
      "ír krémlikőr",
      "spanyol mazsolalikőr"
    ]
  },
  {
    numb: 41,
    question: "Miből készül a rum?",
    answer: "cukornádból",
    options: [
      "cukorrépából",
      "szőlőből",
      "cukornádból",
      "árpamalátából"
    ]
  },
  {
    numb: 42,
    question: "Miről kapta a nevét a somlói galuska?",
    answer: "egy dombról",
    options: [
      "egy dombról",
      "egy településről",
      "egy híres cukrászról",
      "egy folyóról"
    ]
  },
  {
    numb: 43,
    question: "Mi a slambuc?",
    answer: "krumplis tészta",
    options: [
      "túrós tészta",
      "húsos-tejfölös tészta",
      "diós-mákos tészta",
      "krumplis tészta"
    ]
  },
  {
    numb: 44,
    question: "Milyen étel a macskanadrág?",
    answer: "rántott tejbegríz",
    options: [
      "rántott tejbegríz",
      "kelt tésztás sütemény",
      "virslis-tojásos tészta",
      "reszelt répás sült tésztaféle"
    ]
  },
  {
    numb: 45,
    question: "Milyen eredetű étel a sztrapacska?",
    answer: "szlovák",
    options: [
      "szerb",
      "szlovák",
      "albán",
      "ruszin"
    ]
  },
];