// Récupération des paramètres du match 
let atHome = parseInt(document.getElementById("athome").innerHTML) ;
let periodNumber = parseInt(document.getElementById("periodnum").innerHTML);
let periodDuration = parseInt(document.getElementById("periodduration").innerHTML) ;
let matchId = parseInt(document.getElementById("matchid").innerHTML) ;
let matchPlayed = parseInt(document.getElementById("status").innerHTML);
let stat = false;

if (matchPlayed === 1){
    matchPlayed = false;
}
else {
    matchPlayed = true;
}

let goalIndex;

let stats = new Stats(matchId, periodNumber, periodDuration, atHome, stat, matchPlayed);
let card = new Card(matchId, periodDuration, stat);
let score = new Score(matchId, atHome, periodNumber, periodDuration, stat);


