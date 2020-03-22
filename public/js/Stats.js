class Stats {
    constructor(matchId, periodNumber, atHome){
        this.matchId = matchId;
        this.periodNumber = periodNumber;
        this.atHome = atHome;

        this.div1stCol = document.getElementById("stat_1stcol");
        this.div2ndCol = document.getElementById("stat_2ndcol");

        this.newDivStatBar;

        this.stats;
        this.stat;
        this.period;


        this.setStatBars();

        this.btnsMinus = document.querySelectorAll('div[id^="btnminus_"]');
        this.btnsPlus = document.querySelectorAll('div[id^="btnplus_"]');
        this.btnsMinus;
        this.btnPlus;

        // Stats à inserer dans la DB
        this.homeScore;
        this.awayScore;
        this.successPass;
        this.missPass;
        this.shotOnTarget;
        this.missShot;
        this.freeKick;
        this.offSide;
        this.foul;
        this.cornerKick;
        this.winBall;
        this.lostBall;

        this.homeScoreAgglo;
        this.awayScoreAgglo;
        this.successPassAgglo;
        this.missPassAgglo;
        this.shotOnTargetAgglo;
        this.missShotAgglo;
        this.freeKickAgglo;
        this.offSideAgglo;
        this.foulAgglo;
        this.cornerKickAgglo;
        this.winBallAgglo;
        this.lostBallAgglo;
        
        this.events();


    }

    setStatBars(){

        for (let i = 0; i < CONFIG.data.length; i++){

            this.newDivStatBar = document.createElement("div");
            this.newDivStatBar.className = "stat_bar d-flex flex-row mb-3";

            switch (CONFIG.data[i].model){
                case 0:
                    this.newDivStatBar.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+ CONFIG.data[i].db_name +'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div>';
                    break;

                case 1:
                    this.newDivStatBar.innerHTML = '<div id="btnminus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+CONFIG.data[i].db_name+'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div id="btnplus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2"><i class="far fa-plus-square"></i></div>';
                    break;

                case 2:
                    this.newDivStatBar.innerHTML = '<div id="btnminus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent">0%</span></div><div id="btnplus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2"><i class="far fa-plus-square"></i></div>';                
                    break;

                case 3:
                    this.newDivStatBar.innerHTML = '<div id="btnminus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent">0%</span></div><div id="btnplus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2"><i class="far fa-plus-square"></i></div>';                
                    break;                    

                default:
                    break;
            }
            this.createStatBars(i);
        }
    }

    createStatBars(i){
        if ( i <= 6) {
            this.div1stCol.append(this.newDivStatBar);
        }
        else {
            this.div2ndCol.append(this.newDivStatBar);
        }
    }

    events(){
        this.btnsPlus.forEach(
            function(btn){
                btn.addEventListener("click", function(){
                    let statName = this.id.split('_')[1];
                    let statType = this.id.split('_')[2];
                    let statNameFull;

                    if (statType === "ok" || statType === "nok"){
                        statNameFull = this.id.split('_')[1]+"_"+this.id.split('_')[2];
                    }
                    else {
                        statNameFull = statName;
                    }

                    let statModel = parseInt(this.id.split('_')[3]);
                    let divStat = document.getElementById(statNameFull);

                    let stat = parseInt(divStat.innerHTML);
                    stat += 1;

                    divStat.innerHTML = stat;
                
                    switch (statModel){
                        case 2:
                            let stat_ok_2 = parseInt(document.getElementById(statName+"_ok").innerHTML);
                            let stat_nok_2 = parseInt(document.getElementById(statName+"_nok").innerHTML);
                            let stat_2 = stat_ok_2 + stat_nok_2;
                            let stat_ok_percent_2 = Math.round((stat_ok_2 / stat_2)*100);
                            let stat_nok_percent_2 = 100 - stat_ok_percent_2;
                            document.getElementById(statName+"_ok_percent").innerHTML = stat_ok_percent_2+"%";
                            document.getElementById(statName+"_nok_percent").innerHTML = stat_nok_percent_2+"%";
                            document.getElementById(statName).innerHTML = stat_2;
                            break;

                        case 3:
                            let stat_ok_3 = parseInt(document.getElementById(statName+"_ok").innerHTML);
                            let stat_nok_3 = parseInt(document.getElementById(statName+"_nok").innerHTML);
                            let stat_ok_percent_3 = Math.round((stat_ok_3 / (stat_ok_3 + stat_nok_3))*100);
                            let stat_nok_percent_3 = 100 - stat_ok_percent_3;
                            document.getElementById(statName+"_ok_percent").innerHTML = stat_ok_percent_3+"%";
                            document.getElementById(statName+"_nok_percent").innerHTML = stat_nok_percent_3+"%";
                            break;   
                            
                        default:
                            break;
                    }  

                });
            }
        );

        this.btnsMinus.forEach(
            function(btn){
                btn.addEventListener("click", function(){
                    let statName = this.id.split('_')[1];
                    let statType = this.id.split('_')[2];
                    let statNameFull;

                    if (statType === "ok" || statType === "nok"){
                        statNameFull = this.id.split('_')[1]+"_"+this.id.split('_')[2];
                    }
                    else {
                        statNameFull = statName;
                    }

                    let statModel = parseInt(this.id.split('_')[3]);
                    let divStat = document.getElementById(statNameFull);

                    let stat = parseInt(divStat.innerHTML);
                    if (stat > 0){
                        stat -= 1;
                        divStat.innerHTML = stat;
                    }

                    switch (statModel){
                        case 2:
                            let stat_ok_2 = parseInt(document.getElementById(statName+"_ok").innerHTML);
                            let stat_nok_2 = parseInt(document.getElementById(statName+"_nok").innerHTML);
                            stat_ok_2 = parseInt(stat_ok_2);
                            stat_nok_2 = parseInt(stat_nok_2);
                            let stat_2 = stat_ok_2 + stat_nok_2;

                            let stat_ok_percent_2
                            let stat_nok_percent_2
                            if (stat_2 !== 0){
                                stat_ok_percent_2 = Math.round((stat_ok_2 / stat_2)*100);
                                stat_nok_percent_2 = 100 - stat_ok_percent_2;
                            }
                            else {
                                stat_ok_percent_2 = 0;
                                stat_nok_percent_2 = 0;
                            }

                            document.getElementById(statName+"_ok_percent").innerHTML = stat_ok_percent_2+"%";
                            document.getElementById(statName+"_nok_percent").innerHTML = stat_nok_percent_2+"%";
                            document.getElementById(statName).innerHTML = stat_2;
                            break;

                        case 3:
                            let stat_ok_3 = parseInt(document.getElementById(statName+"_ok").innerHTML);
                            let stat_nok_3 = parseInt(document.getElementById(statName+"_nok").innerHTML);
                            stat_ok_3 = parseInt(stat_ok_3);
                            stat_nok_3 = parseInt(stat_nok_3);
                            let stat_3 = stat_ok_3 + stat_nok_3;

                            let stat_ok_percent_3
                            let stat_nok_percent_3
                            console.log(stat_3)
                            if (stat_3 !== 0){
                                stat_ok_percent_3 = Math.round((stat_ok_3 / stat_3)*100);
                                stat_nok_percent_3 = 100 - stat_ok_percent_3;
                            }
                            else {
                                stat_ok_percent_3 = 0;
                                stat_nok_percent_3 = 0;
                            }
                            
                            document.getElementById(statName+"_ok_percent").innerHTML = stat_ok_percent_3+"%";
                            document.getElementById(statName+"_nok_percent").innerHTML = stat_nok_percent_3+"%";
                            break;   
                            
                        default:
                            break;
                    } 
                });
            }
        );
    }

    setStats(){
        this.homeScore = 0;
        this.awayScore = 0;
        this.successPassAgglo = 0;
        this.missPassAgglo = 0;
        this.shotOnTargetAgglo = 0;
        this.missShotAgglo = 0;
        this.freeKickAgglo = 0;
        this.offSideAgglo = 0;
        this.foulAgglo = 0;
        this.cornerKickAgglo = 0;
        this.winBallAgglo = 0;
        this.lostBallAgglo = 0;

        this.successPass = document.getElementById("pass_ok").innerHTML;
        this.missPass = document.getElementById("pass_nok").innerHTML;
        this.shotOnTarget = document.getElementById("shot_ok").innerHTML;
        this.missShot = document.getElementById("shot_ok").innerHTML;
        this.freeKick = document.getElementById("freekick").innerHTML;
        this.offSide = document.getElementById("offside").innerHTML;
        this.foul = document.getElementById("foul").innerHTML;
        this.cornerKick = document.getElementById("cornerkick").innerHTML;
        this.winBall = document.getElementById("ball_ok").innerHTML;
        this.lostBall = document.getElementById("ball_nok").innerHTML;

        if ( this.atHome === 1) {
            this.homeScore = document.getElementById("MyTeamScore").innerHTML;
            this.awayScore = document.getElementById("OppoTeamScore").innerHTML
        }
        else {
            this.awayScore = document.getElementById("MyTeamScore").innerHTML;
            this.homeScore = document.getElementById("OppoTeamScore").innerHTML;
        }

        if ( this.stats.length > 0){
            for (let i = 0; i < this.stats.length; i++){
                this.homeScoreAgglo = this.stats[i].homescore;
                this.awayScore = this.stats[i].awayscore;
                this.successPassAgglo += this.stats[i].successPass;
                this.missPassAgglo += this.stats[i].misspass;
                this.shotOnTargetAgglo += this.stats[i].shotontarget;
                this.missShotAgglo += this.stats[i].missshot;
                this.freeKickAgglo += this.stats[i].freekick;
                this.offSideAgglo += this.stats[i].offside;
                this.foulAgglo += this.stats[i].foul;
                this.cornerKickAgglo += this.stats[i].cornerkick;
                this.winBallAgglo += this.stats[i].winball;
                this.lostBallAgglo += this.stats[i].lostball;
            }
        }

        this.stat = {
            "homescore": this.homeScore - this.homeScoreAgglo,
            "awayscore" : this.awayScore - this.awayScoreAgglo,
            "successpass" : this.successPass - this.successPassAgglo,
            "misspass" : this.missPass - this.missPassAgglo,
            "shotontarget" : this.shotOnTarget - this.shotOnTargetAgglo ,
            "missshot" : this.missShot - this.missShotAgglo,
            "freekick" : this.freeKick - this.freeKickAgglo,
            "offside" : this.offSide - this.offSideAgglo,
            "foul" : this.foul - this.foulAgglo,
            "cornerkick" : this.cornerKick - this.cornerKickAgglo ,
            "winball" : this.winBall - this.winBallAgglo,
            "lostball" : this.lostBall - this.lostBallAgglo
        }

        this.stats.push(this.stat);
    }
}

