class Stats {
    constructor(matchId, periodNumber){
        this.matchId = matchId;
        this.periodNumber = periodNumber;

        this.div1stCol = document.getElementById("stat_1stcol");
        this.div2ndCol = document.getElementById("stat_2ndcol");

        this.setStatBars();
    }

    setStatBars(){
        console.log(CONFIG.data);

    }
}