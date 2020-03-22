class Stats {
    constructor(matchId, periodNumber){
        this.matchId = matchId;
        this.periodNumber = periodNumber;

        this.div1stCol = document.getElementById("stat_1stcol");
        this.div2ndCol = document.getElementById("stat_2ndcol");

        this.newDivStatBar;

        this.setStatBars();

        this.btnsMinus = document.querySelectorAll('div[id^="btnminus_"]');
        this.btnsPlus = document.querySelectorAll('div[id^="btnplus_"]');
        this.btnsMinus;
        this.btnPlus;

        console.log(this.btnsPlus);
        
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
}

