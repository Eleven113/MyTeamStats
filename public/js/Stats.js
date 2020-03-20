class Stats {
    constructor(matchId, periodNumber){
        this.matchId = matchId;
        this.periodNumber = periodNumber;

        this.div1stCol = document.getElementById("stat_1stcol");
        this.div2ndCol = document.getElementById("stat_2ndcol");

        this.newDivStatBar;

        this.setStatBars();
    }

    setStatBars(){

        for (let i = 0; i < CONFIG.data.length; i++){

            this.newDivStatBar = document.createElement("div");
            this.newDivStatBar.className = "stat_bar d-flex flex-row mb-3";

            switch (CONFIG.data[i].model){
                case 0:
                    this.newDivStatBar.innerHTML = '<div id="stat_bar-btnless" class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+ CONFIG.data[i].db_name +'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="stat_bar-btnplus col-2"></div>';
                    break;

                case 1:
                    this.newDivStatBar.innerHTML = '<div id="'+CONFIG.data[i].db_name+'-btnless" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+CONFIG.data[i].db_name+'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div id="'+CONFIG.data[i].db_name+'-btnplus" class="col-2"><i class="far fa-plus-square"></i></div>';
                    break;

                case 2:
                    this.newDivStatBar.innerHTML = '<div id="'+CONFIG.data[i].db_name+'-btnless" class="col-2 text-right"><i class="far fa-minus-square"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">'+ CONFIG.data[i].name +'</div><div id="'+CONFIG.data[i].db_name+'" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div id="'+CONFIG.data[i].db_name+'-btnplus" class="col-2"><i class="far fa-plus-square"></i></div>';                
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

}

