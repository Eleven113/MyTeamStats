class Score {
    constructor(atHome){
        this.atHome = atHome;

        // Récupération des div liées aux buttons
        this.divHomeButtonPlus = document.getElementById("home_score-btn_plus");
        this.divHomeButtonMinus = document.getElementById("home_score-btn_minus");
        this.divAwayButtonPlus = document.getElementById("away_score-btn_plus");
        this.divAwayButtonMinus = document.getElementById("away_score-btn_minus");   
        
        // Récupération des div liées au score
        this.divHomeScore = document.getElementById("match_team_score-home");
        this.divHomeAway = document.getElementById("match_team_score-away")

        // Récupération div Modal Goal
        this.divModalGoal = document.getElementById("modal_goal");

        this.divMyTeamScore;
        this.divOppoTeamScore;
        this.MyTeamScore;
        this.divOppoTeamScore;
        this.divMyTeamButtonMinus;
        this.divMyTeamButtonPlus;
        this.divOppoTeamButtonMinus;
        this.divOppoTeamButtonPlus;
        console.log("just avant les method");
        this.renameDiv();
        this.getNewDiv();
        this.events();

    }

    // Renomage des div en fonction du lieu du match
    renameDiv(){
        if ( atHome == 1){
            console.log("home");
            this.divHomeScore.id = "MyTeamScore";
            this.divHomeAway.id = "OppoTeamScore";
            
            this.divHomeButtonPlus.id = "MyTeamButtonPlus";
            this.divHomeButtonMinus.id = "MyTeamButtonMinus";
        
            this.divAwayButtonPlus.id = "OppoTeamButtonPlus";
            this.divAwayButtonMinus.id = "OppoTeamButtonMinus";
        }
        else {
            console.log("away");
            this.divHomeScore.id = "OppoTeamScore";
            this.divHomeAway.id = "MyTeamScore";
        
            this.divHomeButtonPlus.id = "OppoTeamButtonPlus";
            this.divHomeButtonMinus.id = "OppoTeamButtonMinus";
        
            this.divAwayButtonPlus.id = "MyTeamButtonPlus";
            this.divAwayButtonMinus.id = "MyTeamButtonMinus";
        }
    }

    getNewDiv(){
        this.divMyTeamScore = document.getElementById("MyTeamScore");
        this.divOppoTeamScore = document.getElementById("OppoTeamScore");
        this.MyTeamScore = parseInt(this.divMyTeamScore.innerHTML);
        this.OppoTeamScore = parseInt(this.divOppoTeamScore.innerHTML);

        this.divMyTeamButtonMinus = document.getElementById("MyTeamButtonMinus");
        this.divMyTeamButtonPlus = document.getElementById("MyTeamButtonPlus");
        this.divOppoTeamButtonMinus = document.getElementById("OppoTeamButtonMinus");
        this.divOppoTeamButtonPlus = document.getElementById("OppoTeamButtonPlus");
    }

    events(){
        this.divOppoTeamButtonMinus.addEventListener("click", this.oppoTeamMinus.bind(this));
        this.divOppoTeamButtonPlus.addEventListener("click", this.oppoTeamPlus.bind(this));
    }

    oppoTeamMinus(){
        if ( this.OppoTeamScore > 0){
            this.OppoTeamScore -= 1;
            this.divOppoTeamScore.innerHTML = this.OppoTeamScore;
        }
    }

    oppoTeamPlus(){
        this.OppoTeamScore += 1;
        this.divOppoTeamScore.innerHTML = this.OppoTeamScore;
    }

    openModalGoal(){

    }

    closeModalGoal(){

    }
}