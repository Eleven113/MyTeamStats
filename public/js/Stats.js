class Stats {
    constructor(matchId, periodNumber, periodDuration, atHome, stat){
        this.matchId = matchId;
        this.periodNumber = periodNumber;
        this.periodDuration = periodDuration;
        this.atHome = atHome;
        this.pageStat = stat;

        this.div1stCol = document.getElementById("stat_1stcol");
        this.div2ndCol = document.getElementById("stat_2ndcol");
        this.div1stColDbyP = document.getElementById("stat_1stcol_dbp");
        this.div2ndColDbyP = document.getElementById("stat_2ndcol_dbp");

        this.divStatPeriodDisplay = document.getElementById("match_stat_period_display");

        this.divStatDbyP = document.getElementById("match_stat_displaybyperiod")
        this.divStatRecord = document.getElementById("match_stat_record");
        this.divStatAll = document.getElementById("stat_all");

        this.newDivStatBar;
        this.newDivStatBarDbyP;

        this.isDisplayTotal = true;

        this.stats = [];
        this.stat;
        this.period;

        this.statsDisplay = [];
        this.statDisplay;

        this.btnsMinus = document.querySelectorAll('div[id^="btnminus_"]');
        this.btnsPlus = document.querySelectorAll('div[id^="btnplus_"]');
        this.btnsMinus;
        this.btnPlus;

        this.divMatch = document.getElementById("match");

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
        this.periodNum;
        this.pass;
        this.shot;

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

        if (!this.pageStat){
            this.setPeriodBtn();
            this.AddStatBarsMatchpage(); 
        }
        else {
            this.setStatBars();
        }

    }

    setStatBars(){
        console.log("setStats");
        for (let i = 0; i < CONFIG.data.length; i++){

            this.newDivStatBar = document.createElement("div");
            this.newDivStatBar.className = "stat_bar d-flex flex-row mb-3";

            this.newDivStatBarDbyP = document.createElement("div");
            this.newDivStatBarDbyP.className = "stat_bar d-flex flex-row mb-3";

            switch (CONFIG.data[i].model){
                case 0:
                    if (this.pageStat){
                        this.newDivStatBar.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+ CONFIG.data[i].db_name +'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div>';
                    }
                    this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+ CONFIG.data[i].db_name +'_dbp" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div>';
                    break;

                case 1:
                    if (this.pageStat){
                        this.newDivStatBar.innerHTML = '<div id="btnminus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+CONFIG.data[i].db_name+'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div id="btnplus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2"><i class="far fa-plus-square"></i></div>';
                   }
                    this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+CONFIG.data[i].db_name+'_dbp" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div>';
                    break;

                case 2:
                    if (this.pageStat){
                        this.newDivStatBar.innerHTML = '<div id="btnminus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent">0%</span></div><div id="btnplus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2"><i class="far fa-plus-square"></i></div>';
                    }
                    this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'_dbp">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent_dbp">0%</span></div><div class="col-2"></div>';                
                    break;

                case 3:
                    if (this.pageStat){
                    this.newDivStatBar.innerHTML = '<div id="btnminus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent">0%</span></div><div id="btnplus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2"><i class="far fa-plus-square"></i></div>';
                    }
                    this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'_dbp">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent_dbp">0%</span></div><div class="col-2"></div>';
                    break;                    

                default:
                    break;
            }
            this.createStatBars(i);    
        }
    }

    createStatBars(i){
        console.log("ici");
        if (this.pageStat){
            if ( i <= 5) {
                this.div1stCol.append(this.newDivStatBar);
                this.div1stColDbyP.append(this.newDivStatBarDbyP);
            }
            else {
                this.div2ndCol.append(this.newDivStatBar);
                this.div2ndColDbyP.append(this.newDivStatBarDbyP);
            }
        }
        else {
            if ( i <= 5) {
                this.newDivCol1.append(this.newDivStatBarDbyP);
            }
            else {
                this.newDivCol2.append(this.newDivStatBarDbyP);
            }

            this.newDivStatPeriod.append(this.newDivCol1);
            this.newDivStatPeriod.append(this.newDivCol2);
            this.divMatch.append(this.newDivStatPeriod);

        }
    }

    AddStatBarsMatchpage(){
        console.log("AddStatMatch");
        for ( let i=1; i <= this.periodNumber+1; i++){
            
            this.newDivStatPeriod = document.createElement("div");
            this.newDivStatPeriod.id = "match_stat_period_"+ i;
            if ( i === this.periodNumber+1){
                this.newDivStatPeriod.className = "d-flex flex-row col-12 mt-2";
            } 
            else {
                this.newDivStatPeriod.className = "d-none";
            }
    
            this.newDivCol1 = document.createElement("div");
            this.newDivCol1.id = "stat_1stcol_period_" + i;
            this.newDivCol1.className = "col-6 d-flex flex-column";

            this.newDivCol2 = document.createElement("div");
            this.newDivCol2.id = "stat_1stcol_period_" + i;
            this.newDivCol2.className = "col-6 d-flex flex-column";

            
            this.setStatBars();
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

                            let stat_ok_percent_3;
                            let stat_nok_percent_3;

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

        if (this.pageStat){
            this.divStatAll.addEventListener("click", function(){
                this.divStatDbyP.className = "d-none";
                this.divStatRecord.className = "d-flex flex-row col-12 mt-5";
            }.bind(this));
        }   
    }

    setStats(){
        this.homeScoreAgglo = 0;
        this.awayScoreAgglo = 0;
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
        this.missShot = document.getElementById("shot_nok").innerHTML;
        this.freeKick = document.getElementById("freekick").innerHTML;
        this.offSide = document.getElementById("offside").innerHTML;
        this.foul = document.getElementById("foul").innerHTML;
        this.cornerKick = document.getElementById("cornerkick").innerHTML;
        this.winBall = document.getElementById("ball_ok").innerHTML;
        this.lostBall = document.getElementById("ball_nok").innerHTML;


        if ( this.atHome === 1) {
            this.homeScore = document.getElementById("MyTeamScore").innerHTML;

            this.awayScore = document.getElementById("OppoTeamScore").innerHTML;
        }
        else {
            this.awayScore = document.getElementById("MyTeamScore").innerHTML;
            this.homeScore = document.getElementById("OppoTeamScore").innerHTML;
        }

        if ( this.stats.length > 0){
            for (let i = 0; i < this.stats.length; i++){
                this.homeScoreAgglo = this.stats[i].homescore;
                this.awayScoreAgglo = this.stats[i].awayscore;
                this.successPassAgglo += this.stats[i].successpass;
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
            "matchid": this.matchId,
            "periodnum": this.periodNum,
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

        this.pass = parseInt(this.successPass - this.successPassAgglo) + (this.missPass - this.missPassAgglo);
        console.log(this.pass);
        if (this.pass !== 0){
            this.pass_ok_percent = Math.round(((this.successPass - this.successPassAgglo) / this.pass ) * 100 ) + "%";
            this.pass_nok_percent = Math.round(((this.missPass - this.missPassAgglo) / this.pass ) * 100 ) + "%";
        }
        else {
            this.pass_ok_percent = 0 + "%";
            this.pass_nok_percent = 0 + "%";
        }

        this.shot = (this.shotOnTarget - this.shotOnTargetAgglo) + (this.missShot - this.missShotAgglo)

        if (this.shot !== 0){
            this.shot_ok_percent = Math.round(((this.shotOnTarget - this.shotOnTargetAgglo) / this.shot) * 100) + "%";
            this.shot_nok_percent = Math.round(((this.missShot - this.missShotAgglo) / this.shot) * 100) + "%";
        }
        else {
            this.shot_ok_percent = 0 + "%";
            this.shot_nok_percent = 0 + "%";
        }


        this.ball = (this.winBall - this.winBallAgglo) + (this.lostBall - this.lostBallAgglo)

        if (this.ball !== 0){
            this.winball_percent = Math.round(((this.winBall - this.winBallAgglo) / this.ball) * 100 ) + "%";
            this.lostball_percent = Math.round(((this.lostBall - this.lostBallAgglo) / this.ball) * 100 ) + "%";
        }
        else{
            this.winball_percent = 0 + "%";
            this.lostball_percent = 0 + "%";
        }


        this.statDisplay = {
            "shot": this.shot,
            "shot_ok": this.shotOnTarget - this.shotOnTargetAgglo,
            "shot_ok_percent": this.shot_ok_percent,
            "shot_nok": this.missShot - this.missShotAgglo,
            "shot_nok_percent": this.shot_nok_percent,
            "pass": this.pass,
            "pass_ok" : this.successPass - this.successPassAgglo,
            "pass_ok_percent" : this.pass_ok_percent,
            "pass_nok" : this.missPass - this.missPassAgglo,
            "pass_nok_percent" : this.pass_nok_percent,
            "shot_ok" : this.shotOnTarget - this.shotOnTargetAgglo ,
            "shot_ok_percent" : this.shot_ok_percent,
            "shot_nok" : this.missShot - this.missShotAgglo,
            "shot_nok_percent" : this.shot_nok_percent,
            "freekick" : this.freeKick - this.freeKickAgglo,
            "offside" : this.offSide - this.offSideAgglo,
            "foul" : this.foul - this.foulAgglo,
            "cornerkick" : this.cornerKick - this.cornerKickAgglo ,
            "ball_ok" : this.winBall - this.winBallAgglo,
            "ball_ok_percent" : this.winball_percent,
            "ball_nok" : this.lostBall - this.lostBallAgglo,
            "ball_nok_percent" : this.lostball_percent
        }

        this.stats.push(this.stat);
        this.statsDisplay.push(this.statDisplay);
        
        let divStatPeriod = document.createElement("button");
        divStatPeriod.id = "stat_" + this.periodNum;
        divStatPeriod.className = "period_btn btn btn-primary";
        divStatPeriod.innerHTML = this.periodNum;
        this.divStatPeriodDisplay.append(divStatPeriod);

        divStatPeriod.addEventListener("click", this.displayStatsByPeriod.bind(this));
    }

    displayStatsByPeriod(event){

        let period = event.target.innerHTML;

        let statArray = this.statsDisplay[period-1];
        
        for (const [key, value] of Object.entries(statArray)){
            document.getElementById(key+"_dbp").innerHTML = value;
        }

        if (this.pageStat){
            this.changeDisplay();
        }

    }

    changeDisplay(){
            this.divStatDbyP.className = "d-flex flex-row col-12 mt-2";
            this.divStatRecord.className = "d-none";
    }

    setPeriodBtn(){
        for (let i = 1; i <= this.periodNumber+1; i++ ){
            let divStatPeriod = document.createElement("button");
            if ( i === 1){
                divStatPeriod.id = "btn_stat_total";
                divStatPeriod.innerHTML = "Total";
            } else {
                divStatPeriod.id = "btn_stat_period_" + (i-1);
                divStatPeriod.innerHTML = i-1;
            }

            divStatPeriod.className = "period_btn btn btn-primary";
            divStatPeriod.addEventListener("click",this.btnPeriodEvents.bind(this));
            this.divStatPeriodDisplay.append(divStatPeriod);
        }
    }

    btnPeriodEvents(event){
        let target = event.target.innerHTML;
        this.changeDisplayMatchpage(target);
        if ( target !== "total"){

        }
        else {

        }
    }

    changeDisplayMatchpage(target){
        console.log(target);
        if ( target === "Total"){
            document.getElementById("match_stat_period_" + (this.periodNumber + 1)).className = "d-flex flex-row col-12 mt-2"
            for ( let i = 1; i <= this.periodNumber; i++){
                document.getElementById("match_stat_period_"+ i).className = "d-none";
            } 
        }
        else {
            document.getElementById("match_stat_period_" + (this.periodNumber + 1)).className = "d-none"
            for ( let i = 1; i <= this.periodNumber; i++){
                console.log(i);
                if ( i == target){
                    document.getElementById("match_stat_period_"+ i).className = "d-flex flex-row col-12 mt-2";
                }
                else {
                    document.getElementById("match_stat_period_"+ i).className = "d-none";
                }
            } 
        }
    }
}

