data = {
    "game":{"gameid":9, "status":0},
    "goals":[
        {"matchid":9,"time":1,"periodnum":"1","scorerid":"10","passerid":"null","action":"Action de jeu","bodypart":"Pied droit"},
        {"matchid":9,"time":1,"periodnum":"1","scorerid":"10","passerid":"null","action":"Action de jeu","bodypart":"Pied droit"}
    ],
    "stats":[
        {"matchid":9,"periodnum":1,"homescore":2,"awayscore":1,"successpass":1,"misspass":1,"shotontarget":1,"missshot":1,"freekick":1,"offside":6,"foul":2,"cornerkick":5,"winball":4,"lostball":1},
        {"matchid":9,"periodnum":2,"homescore":0,"awayscore":0,"successpass":3,"misspass":3,"shotontarget":3,"missshot":3,"freekick":3,"offside":5,"foul":2,"cornerkick":2,"winball":2,"lostball":2}
    ],
    "cards":[
        {"playerid":10,"matchid":9,"periodnum":1,"color":"yellow","time":10},
        {"playerid":17,"matchid":9,"periodnum":2,"color":"red","time":25},
        {"playerid":11,"matchid":9,"periodnum":1,"color":"yellow","time":26}
    ]
};

dataJson = JSON.stringify(data);
console.log(dataJson);

console.log($("body"));

// $(document).ready(function() {
//     $.ajax({
//         type: "POST",
//         url: 'http://www.thibaut-minard.fr/MyTeamStats/matchdata.php',
//         data: dataJson,
//         success: function(data)
//         {
//             alert("success!");
//         },

//         error : function(data)
//         {
//             alert("error!");
//         }
//     });
// });

    $.post('/MyTeamStats/MatchData', data, function(returnData){
        $("body").html(returnData);
    });