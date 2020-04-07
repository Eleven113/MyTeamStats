class Stats {
    constructor(matchId, periodNumber, periodDuration, atHome, stat, matchPlayed){
        this.matchId = matchId;
        this.periodNumber = periodNumber;
        this.periodDuration = periodDuration;
        this.atHome = atHome;
        this.pageStat = stat;
        this.matchPlayed = matchPlayed;

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

        this.divMatch = document.getElementById("match");

        // Stats à inserer dans la DB
        this.homeScore = 0;
        this.awayScore = 0;
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
        this.periodNum = 0;
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
        


        if (!this.pageStat){
            if (matchPlayed){
                this.setPeriodBtn();
                this.AddStatBarsMatchpage();
                this.displayStatMatchpage();
            }
        }
        else {
            this.setStatBars();
            this.btnsMinus = document.querySelectorAll('div[id^="btnminus_"]');
            this.btnsPlus = document.querySelectorAll('div[id^="btnplus_"]');
            this.events();

        }

    }

    setStatBars(period){
        for (let i = 0; i < CONFIG.data.length; i++){
            this.newDivStatBar = document.createElement("div");
            this.newDivStatBar.className = "stat_bar d-flex flex-row mb-3";

            this.newDivStatBarDbyP = document.createElement("div");
            this.newDivStatBarDbyP.className = "stat_bar d-flex flex-row mb-3";

            switch (CONFIG.data[i].model){
                case 0:
                    if (this.pageStat){
                        this.newDivStatBar.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+ CONFIG.data[i].db_name +'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div>';
                        this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+ CONFIG.data[i].db_name +'_dbp" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div>';
                    } 
                    else {
                    this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+ CONFIG.data[i].db_name +'_match_stat_'+ period +'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div>';
                    }
                    break;

                case 1:
                    if (this.pageStat){
                        this.newDivStatBar.innerHTML = '<div id="btnminus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+CONFIG.data[i].db_name+'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div id="btnplus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2"><i class="far fa-plus-square"></i></div>';
                        this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+CONFIG.data[i].db_name+'_dbp" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div>';
                   
                    }
                    else {
                        this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+CONFIG.data[i].db_name+'_match_stat_'+ period +'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div>';
                    }
                    break;

                case 2:
                    if (this.pageStat){
                        this.newDivStatBar.innerHTML = '<div id="btnminus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent">0%</span></div><div id="btnplus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2"><i class="far fa-plus-square"></i></div>';
                        this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'_dbp">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent_dbp">0%</span></div><div class="col-2"></div>';                                                   
                    } 
                    else {
                        this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'_match_stat_'+ period +'">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent_match_stat_'+ period +'">0%</span></div><div class="col-2"></div>';                
                    }
                    break;

                case 3:
                    if (this.pageStat){
                        this.newDivStatBar.innerHTML = '<div id="btnminus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent">0%</span></div><div id="btnplus_'+CONFIG.data[i].db_name+'_'+CONFIG.data[i].model+'" class="col-2"><i class="far fa-plus-square"></i></div>';
                        this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'_dbp">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent_dbp">0%</span></div><div class="col-2"></div>';
                    }
                    else {
                        this.newDivStatBarDbyP.innerHTML = '<div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="'+CONFIG.data[i].db_name+'_match_stat_'+ period +'">0</span>&nbsp;&nbsp;<span id="'+CONFIG.data[i].db_name+'_percent_match_stat_'+ period +'">0%</span></div><div class="col-2"></div>';
                    }
                    break;                    

                default:
                    break;
            }
            this.createStatBars(i);    
        }
    }

    createStatBars(i){
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
        for ( let i=1; i <= this.periodNumber+1; i++){
            
            this.newDivStatPeriod = document.createElement("div");
            this.newDivStatPeriod.id = "match_stat_period_"+ i;
            if ( i === this.periodNumber+1){
                this.newDivStatPeriod.className = "d-flex flex-row col-12 mt-4 match_period";
            } 
            else {
                this.newDivStatPeriod.className = "d-none match_period";
            }
    
            this.newDivCol1 = document.createElement("div");
            this.newDivCol1.id = "stat_1stcol_period_" + i;
            this.newDivCol1.className = "col-6 d-flex flex-column";

            this.newDivCol2 = document.createElement("div");
            this.newDivCol2.id = "stat_1stcol_period_" + i;
            this.newDivCol2.className = "col-6 d-flex flex-column";

            
            this.setStatBars(i);
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
        this.periodNum += 1;
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

        this.pass = parseInt(this.successPass - this.successPassAgglo) + parseInt(this.missPass - this.missPassAgglo);

        if (this.pass !== 0){
            this.pass_ok_percent = Math.round(((this.successPass - this.successPassAgglo) / this.pass ) * 100 ) + "%";
            this.pass_nok_percent = Math.round(((this.missPass - this.missPassAgglo) / this.pass ) * 100 ) + "%";
        }
        else {
            this.pass_ok_percent = 0 + "%";
            this.pass_nok_percent = 0 + "%";
        }

        this.shot = parseInt(this.shotOnTarget - this.shotOnTargetAgglo) + parseInt(this.missShot - this.missShotAgglo)

        if (this.shot !== 0){
            this.shot_ok_percent = Math.round(((this.shotOnTarget - this.shotOnTargetAgglo) / this.shot) * 100) + "%";
            this.shot_nok_percent = Math.round(((this.missShot - this.missShotAgglo) / this.shot) * 100) + "%";
        }
        else {
            this.shot_ok_percent = 0 + "%";
            this.shot_nok_percent = 0 + "%";
        }


        this.ball = parseInt(this.winBall - this.winBallAgglo) + parseInt(this.lostBall - this.lostBallAgglo)

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
            this.divStatDbyP.className = "d-flex flex-row col-12 mt-5";
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
            if (this.periodNumber === 1) return;
        }
    }

    btnPeriodEvents(event){
        let target = event.target.innerHTML;
        this.changeDisplayMatchpage(target);
    }

    changeDisplayMatchpage(target){
        if ( target === "Total"){
            document.getElementById("match_stat_period_" + (this.periodNumber + 1)).className = "d-flex flex-row col-12 mt-4 match_period"
            for ( let i = 1; i <= this.periodNumber; i++){
                document.getElementById("match_stat_period_"+ i).className = "d-none match_period";
            } 
        }
        else {
            document.getElementById("match_stat_period_" + (this.periodNumber + 1)).className = "d-none match_period"
            for ( let i = 1; i <= this.periodNumber; i++){
                if ( i == target){
                    document.getElementById("match_stat_period_"+ i).className = "d-flex flex-row col-12 mt-4 match_period";
                }
                else {
                    document.getElementById("match_stat_period_"+ i).className = "d-none match_period";
                }
            } 
        }
    }

    displayStatMatchpage(){
        // Score
        for ( let i = 0; i < this.periodNumber; i++){
            this.homeScore += parseInt(period[i].homescore);
            this.awayScore += parseInt(period[i].awayscore);
            document.getElementById("homescore").textContent = this.homeScore;
            document.getElementById("awayscore").textContent = this.awayScore;
        }

        // Stats by period
        for ( let i = 1; i <= this.periodNumber + 1; i++){
          
            if ( i !== (this.periodNumber + 1)){
                this.periodStat = {
                    "pass_ok" : period[i-1].successpass,
                    "pass_nok" : period[i-1].misspass,
                    "shot_ok" : period[i-1].shotontarget,
                    "shot_nok" : period[i-1].missshot,
                    "freekick" : period[i-1].freekick,
                    "offside" : period[i-1].offside,
                    "foul" : period[i-1].foul,
                    "cornerkick" : period[i-1].cornerkick,
                    "ball_ok" : period[i-1].winball,
                    "ball_nok" : period[i-1].lostball
                }

                for (const [key, value] of Object.entries(this.periodStat)){
                    document.getElementById(key+"_match_stat_"+ i).innerHTML = value;
                }
            }
            else {

                this.pass_ok = 0;
                this.pass_nok = 0;
                this.shot_ok = 0;
                this.shot_nok = 0;
                this.freekick = 0;
                this.offside = 0;
                this.foul = 0;
                this.cornerkick = 0;
                this.ball_ok = 0;
                this.ball_nok = 0;

                for ( let j = 0; j < this.periodNumber; j++){
                    this.pass_ok += parseInt(period[j].successpass);
                    this.pass_nok += parseInt(period[j].misspass);
                    this.shot_ok += parseInt(period[j].shotontarget);
                    this.shot_nok += parseInt(period[j].missshot);
                    this.freekick += parseInt(period[j].freekick);
                    this.offside += parseInt(period[j].offside);
                    this.foul += parseInt(period[j].foul);
                    this.cornerkick += parseInt(period[j].cornerkick);
                    this.ball_ok = parseInt(period[j].winball);
                    this.ball_nok = parseInt(period[j].lostball);
                }

                this.periodStat = {
                    "pass_ok" : this.pass_ok,
                    "pass_nok" : this.pass_nok,
                    "shot_ok" : this.shot_ok,
                    "shot_nok" : this.shot_nok,
                    "freekick" : this.freekick,
                    "offside" : this.offside,
                    "foul" : this.foul,
                    "cornerkick" : this.cornerkick,
                    "ball_ok" : this.ball_ok,
                    "ball_nok" : this.ball_nok
                }

                for (const [key, value] of Object.entries(this.periodStat)){
                    document.getElementById(key+"_match_stat_"+ i ).innerHTML = value;
                }

            }

            // Calcul du total pass et pass percent
            this.periodPassOk = parseInt(document.getElementById("pass_ok_match_stat_" + i).innerHTML);
            this.periodPassNok = parseInt(document.getElementById("pass_nok_match_stat_" + i).innerHTML);
            this.periodPass = this.periodPassOk + this.periodPassNok ; 
            this.periodPassOkPercent = Math.round((this.periodPassOk / this.periodPass) * 100) +"%";
            this.periodPassNokPercent = Math.round((this.periodPassNok / this.periodPass) * 100) +"%";
            document.getElementById("pass_match_stat_" + i).innerHTML = this.periodPass;
            document.getElementById("pass_ok_percent_match_stat_" + i).innerHTML = this.periodPassOkPercent;
            document.getElementById("pass_nok_percent_match_stat_" + i).innerHTML = this.periodPassNokPercent;

            // Calcul total shot et shot percent
            this.periodShotOk = parseInt(document.getElementById("shot_ok_match_stat_" + i).innerHTML);
            this.periodShotNok = parseInt(document.getElementById("shot_nok_match_stat_" + i).innerHTML);
            this.periodShot = this.periodShotOk + this.periodShotNok ; 
            this.periodShotOkPercent = Math.round((this.periodShotOk / this.periodShot) * 100) +"%";
            this.periodShotNokPercent = Math.round((this.periodShotNok / this.periodShot) * 100) +"%";
            document.getElementById("shot_match_stat_" + i).innerHTML = this.periodPass;
            document.getElementById("shot_ok_percent_match_stat_" + i).innerHTML = this.periodShotOkPercent;
            document.getElementById("shot_nok_percent_match_stat_" + i).innerHTML = this.periodShotNokPercent;

            // Calcul ball percent
            this.periodBallOk = parseInt(document.getElementById("ball_ok_match_stat_" + i).innerHTML);
            this.periodBallNok = parseInt(document.getElementById("ball_nok_match_stat_" + i).innerHTML);
            this.periodBall = this.periodBallOk + this.periodBallNok ; 
            this.periodBallOkPercent = Math.round((this.periodShotOk / this.periodShot) * 100) +"%";
            this.periodBallNokPercent = Math.round((this.periodShotNok / this.periodShot) * 100) +"%";
            document.getElementById("ball_ok_percent_match_stat_" + i).innerHTML = this.periodBallOkPercent;
            document.getElementById("ball_nok_percent_match_stat_" + i).innerHTML = this.periodBallNokPercent;
        }
    }
}

