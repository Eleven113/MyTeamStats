// Récupération des paramètres du match 
let atHome = parseInt(document.getElementById("athome").innerHTML) ;
let periodNumber = parseInt(document.getElementById("periodnum").innerHTML);
let periodDuration = parseInt(document.getElementById("periodduration").innerHTML) ;
let matchId = parseInt(document.getElementById("matchid").innerHTML) ;
let stat = true;

let goalIndex;

score = new Score(matchId, atHome, periodNumber, periodDuration, stat);
card = new Card(matchId, periodDuration, stat);
stats = new Stats(matchId, periodNumber, periodDuration, atHome, stat);
chrono = new Chrono(matchId, periodNumber, periodDuration);


