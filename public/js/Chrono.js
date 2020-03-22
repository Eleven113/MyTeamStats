class Chrono {
    constructor(periodNumber, periodDuration){
        this.periodNumber = periodNumber;
        this.periodDuration = periodDuration;

        this.period = 1;

        this.divChrono = document.getElementById("banner_chrono");
        this.divPeriod = document.createElement("div");
        this.divTimer = document.createElement("div");
        this.divTimerBtn = document.createElement("div");


        // Buttons
        this.btnPlay;
        this.btnPause;
        this.btnNext;

        this.divCurrentPeriod;

        // Div pour afficher Heures et minutes
        this.divMin;
        this.divSec;

        // Variables du chrono
        this.timer = null;
        this.time = 0;
        this.min;
        this.sec;

        this.setChrono();
        this.events();
        }

        setChrono(){
            // Création de l'affichage du chrono
            this.divPeriod.className = "d-flex flex-column align-items-center";

            this.divPeriod.id = "period";
            this.divPeriod.innerHTML = '<div>Période <span id="current_period">'+ this.period +'</span> / <span id="number_period"> ' + this.periodNumber + '</span></div>';
            this.divChrono.append(this.divPeriod);

            this.divTimer.id = "timer";
            this.divTimer.innerHTML = '<span id="timer_min">00</span>:<span id="timer_sec">00</span>';
            this.divPeriod.append(this.divTimer);

            this.divTimerBtn.id = "timer_btn";
            this.divTimerBtn.className = "d-flex flew-row justify-content-around col-8"
            this.divTimerBtn.innerHTML = '<i class="fas fa-play" id="play_btn"></i><i class="fas fa-pause" id="pause_btn"></i><i class="fas fa-step-forward" id="next_btn"></i>';
            this.divPeriod.append(this.divTimerBtn);

            // Récupération des divBtn et divTimer
            this.btnPlay = document.getElementById("play_btn");
            this.btnPause = document.getElementById("pause_btn");
            this.btnNext = document.getElementById("next_btn");

            this.divCurrentPeriod = document.getElementById("current_period");

            this.divMin = document.getElementById("timer_min");
            this.divSec = document.getElementById("timer_sec");

        }

        start(){
            if (this.timer !== null) return;

            this.timer = setInterval(() => {
                this.time = this.time + 1;
                console.log(this.time);
                this.min = Math.floor(this.time / 60);
                if (this.min.toString().length === 1) {
                    this.min = "0" + this.min.toString()
                }
                this.sec = this.time % 60;
                if (this.sec.toString().length === 1) {
                    this.sec = "0" + this.sec.toString()
                }
                this.divMin.textContent = this.min;
                this.divSec.textContent = this.sec;
            }, 1000);
            
            this.btnPlay.style.color = "#00ACEE";
            this.btnPause.style.color = "#000000";
        }

        pause(){
            if (this.timer === null) return;

            clearInterval(this.timer);
            this.timer = null;

            this.btnPlay.style.color = "#000000";
            this.btnPause.style.color = "#00ACEE"
            
        }

        next(){
            if (this.time === 0) return;
            this.pause();

            if (this.period == this.periodNumber) return;
            window.confirm("Etes-vous sûr de vouloir passer à la période suivante ?");
            this.period = this.period + 1;

            this.time = 0;
            this.divCurrentPeriod.textContent = this.period;
            this.divMin.textContent = "00";
            this.divSec.textContent = "00";

            stats.setStats();
        }

        events(){
            this.btnPlay.addEventListener("click", this.start.bind(this));

            this.btnPause.addEventListener("click", this.pause.bind(this));

            this.btnNext.addEventListener("click", this.next.bind(this));
        }
}





