class Score {
    constructor(matchId,atHome, periodNumber, periodDuration){
        this.matchId = matchId;
        this.atHome = atHome;
        this.periodNumber = periodNumber;
        this.periodDuration = periodDuration;

        // Récupération des div liées aux buttons
        this.divHomeButtonPlus = document.getElementById("home_score-btn_plus");
        this.divHomeButtonMinus = document.getElementById("home_score-btn_minus");
        this.divAwayButtonPlus = document.getElementById("away_score-btn_plus");
        this.divAwayButtonMinus = document.getElementById("away_score-btn_minus");   
        
        // Récupération des div liées au score
        this.divHomeScore = document.getElementById("match_team_score-home");
        this.divHomeAway = document.getElementById("match_team_score-away")
        this.divBannerLeft = document.getElementById("match_banner-left");
        this.divBannerRight = document.getElementById("match_banner-right");

        // Récupération div Modal Goal
        this.divModalGoal = document.getElementById("modal_goal");
        this.divModalScorer = document.getElementById("select_scorer");
        this.divModalPasser = document.getElementById("select_passer");
        this.divModalAction = document.getElementById("select_action");
        this.divModalBodypart = document.getElementById("select_bodypart");
        this.buttonModalGoal = document.getElementById("modal_goal-button");

        // Variables utiles au but
        this.scorer;
        this.scorerName;
        this.passer;
        this.passerName;
        this.action;
        this.actionName;
        this.bodypart;
        this.bodypartName;
        
        this.minutes = 11;

        this.divMyTeamScore;
        this.divOppoTeamScore;

        this.divScorer;
        this.divChrono;

        this.goals = [];
        this.goal;
        this.goalIndex;

        this.MyTeamScore;
        this.divOppoTeamScore;

        this.divMyTeamButtonMinus;
        this.divMyTeamButtonPlus;

        this.divOppoTeamButtonMinus;
        this.divOppoTeamButtonPlus;

        this.renameDiv();
        this.getNewDiv();
        this.events();

    }

    // Renomage des div en fonction du lieu du match
    renameDiv(){
        if ( atHome == 1){
            this.divHomeScore.id = "MyTeamScore";
            this.divHomeAway.id = "OppoTeamScore";
            
            this.divHomeButtonPlus.id = "MyTeamButtonPlus";
            this.divHomeButtonMinus.id = "MyTeamButtonMinus";
        
            this.divAwayButtonPlus.id = "OppoTeamButtonPlus";
            this.divAwayButtonMinus.id = "OppoTeamButtonMinus";

            this.divBannerLeft.id = "banner_scorer";
            this.divBannerRight.id = "banner_chrono";
        }
        else {
            this.divHomeScore.id = "OppoTeamScore";
            this.divHomeAway.id = "MyTeamScore";
        
            this.divHomeButtonPlus.id = "OppoTeamButtonPlus";
            this.divHomeButtonMinus.id = "OppoTeamButtonMinus";
        
            this.divAwayButtonPlus.id = "MyTeamButtonPlus";
            this.divAwayButtonMinus.id = "MyTeamButtonMinus";

            this.divBannerLeft.id = "banner_chrono";
            this.divBannerRight.id = "banner_scorer";
        }
    }

    getNewDiv(){
        this.divMyTeamScore = document.getElementById("MyTeamScore");
        this.divOppoTeamScore = document.getElementById("OppoTeamScore");
        this.MyTeamScore = parseInt(this.divMyTeamScore.innerHTML);
        this.OppoTeamScore = parseInt(this.divOppoTeamScore.innerHTML);

        this.divMyTeamButtonMinus = document.getElementById("MyTeamButtonMinus");
        this.divMyTeamButtonMinus.style.display = "none";
        this.divMyTeamButtonMinus.parentElement.className = "d-flex flex-row justify-content-center col-12";
        this.divMyTeamButtonPlus = document.getElementById("MyTeamButtonPlus");

        this.divOppoTeamButtonMinus = document.getElementById("OppoTeamButtonMinus");
        this.divOppoTeamButtonPlus = document.getElementById("OppoTeamButtonPlus");

        this.divScorer = document.getElementById("banner_scorer");
        this.divScorer.className= "d-flex flex-column flex-wrap col-3";
        this.divChrono = document.getElementById("banner_chrono");
    }

    events(){
        // Clic sur les buttons OppoTeam
        this.divOppoTeamButtonMinus.addEventListener("click", this.oppoTeamMinus.bind(this));
        this.divOppoTeamButtonPlus.addEventListener("click", this.oppoTeamPlus.bind(this));
        // Clic sur les buttons MyTeam

        this.divMyTeamButtonPlus.addEventListener("click", this.openModalGoal.bind(this));

        // Clic sur button ModalGoal
        this.buttonModalGoal.addEventListener("click",function(){
            this.closeModalGoal();
            this.setGoal();
            this.MyTeamPlus();
        }.bind(this));
    }

    MyTeamMinus(){
        if (this.MyTeamScore > 0){
            this.MyTeamScore -= 1;
            this.divMyTeamScore.innerHTML = this.MyTeamScore;
        }
    }

    MyTeamPlus(){
        this.MyTeamScore += 1;
        this.divMyTeamScore.innerHTML = this.MyTeamScore;
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
        this.divModalGoal.style.display = "block" ;
    }

    closeModalGoal(){
        this.divModalGoal.style.display = "none" ;
    }

    setGoal(){
        // Récupération de l'ID du buteur et de son nom pour affichage 
        this.scorer = this.divModalScorer.options[this.divModalScorer.selectedIndex].value;
        this.scorerName = this.divModalScorer.options[this.divModalScorer.selectedIndex].text;

        // Récupération de l'ID du passeur et de son nom pour affichage (peut être null)
        this.passer = this.divModalPasser.options[this.divModalPasser.selectedIndex].value;
        this.passerName = this.divModalPasser.options[this.divModalPasser.selectedIndex].text;

        // Récupération du type d'action
        this.action = this.divModalAction.options[this.divModalAction.selectedIndex].value;
        this.actionName = this.divModalAction.options[this.divModalAction.selectedIndex].text;

        // Récupération de la surface de contact pour le but
        this.bodypart = this.divModalBodypart.options[this.divModalBodypart.selectedIndex].value;
        this.bodypartName = this.divModalBodypart.options[this.divModalBodypart.selectedIndex].text;

        this.goal = {
            "matchid" : this.matchId,
            "time" : this.minutes,
            "periodnum" : this.periodnum,
            "scorer" : this.scorer,
            "passer" : this.passer,
            "action" : this.action,
            "bodypart" : this.bodypart
        }

        this.goals.push(this.goal);
        console.log(this.goals);
        this.displayGoal();
    }

    displayGoal(){

        // Création div Goal pour afficher le but
        let divGoal = document.createElement("div");
        divGoal.className = "d-flex flex-row justify-content-around col-6";

        let divScorerName = document.createElement("div");
        divScorerName.className = "scorername col-10 overflow-hidden";
        divScorerName.innerHTML = this.scorerName;

        let divGoalTime = document.createElement("div");
        divGoalTime.className = "goaltime col-1";
        divGoalTime.innerHTML = this.minutes + "'";

        let divGoalClose = document.createElement("div");
        divGoalClose.className = "buttonclose col-1";
        divGoalClose.innerHTML = '<i class="fas fa-times"></i>'
        divGoalClose.addEventListener("click", this.getGetGoalIndexAndRemove.bind(divGoalClose) );
        divGoalClose.addEventListener("click", function(){ this.deleteGoal(goalIndex) }.bind(this) );

        divGoal.append(divScorerName);
        divGoal.append(divGoalTime);
        divGoal.append(divGoalClose);

        this.divScorer.append(divGoal);
      
    }

    getGetGoalIndexAndRemove(){
        console.log(this);
        let child = this.parentElement;
        
        goalIndex = Array.from(child.parentNode.children).indexOf(child);
        child.remove();
    }

    deleteGoal(index){
        this.goals.splice(index,1);
        this.MyTeamMinus();
    }
}
