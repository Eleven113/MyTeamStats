// Récupération des paramètres du match 
let atHome = parseInt(document.getElementById("athome").innerHTML) ;
let periodNumber = parseInt(document.getElementById("periodnum").innerHTML);
let periodDuration = parseInt(document.getElementById("periodduration").innerHTML) ;
let matchId = parseInt(document.getElementById("matchid").innerHTML) ;

let goalIndex;

score = new Score(matchId, atHome, periodNumber, periodDuration);
stats = new Stats(matchId, periodNumber, periodDuration, atHome);
chrono = new Chrono(periodNumber, periodDuration);


data = {"goals":[{"matchid":9,"time":1,"periodnum":"1","scorer":"10","passer":"null","action":"Action de jeu","bodypart":"Pied droit"},{"matchid":9,"time":1,"periodnum":"1","scorer":"10","passer":"null","action":"Action de jeu","bodypart":"Pied droit"}],"stats":[{"homescore":2,"awayscore":1,"successpass":1,"misspass":1,"shotontarget":1,"missshot":1,"freekick":1,"offside":6,"foul":2,"cornerkick":5,"winball":4,"lostball":1},{"homescore":0,"awayscore":0,"successpass":3,"misspass":3,"shotontarget":3,"missshot":3,"freekick":3,"offside":5,"foul":2,"cornerkick":2,"winball":2,"lostball":2}]};
dataJson = JSON.stringify(data);

myAjaxPost('/MyTeamStats/MatchData/', dataJson);