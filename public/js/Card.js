class Card {

    constructor(matchId, periodDuration, pageStat) {
        this.matchId = matchId;
        this.periodDuration = periodDuration;
        this.pageStat = pageStat;

        if (this.pageStat){
            this.divYc = document.getElementById("yellowcard");
            this.divRc = document.getElementById("redcard");

            this.spanYc = document.getElementById("yellowcard_num");
            this.spanRc = document.getElementById("redcard_num");

            this.modalYc = document.getElementById("modal_yellowcard");
            this.modalRc = document.getElementById("modal_redcard");

            this.buttonYc = document.getElementById("valid_yc");
            this.closeYc = document.getElementById("yc_close");
            this.isDisplayYellow = false;

            this.buttonRc = document.getElementById("valid_rc");
            this.closeRc = document.getElementById("rc_close");
            this.isDisplayRed = false;

            this.buttonShowCards = document.getElementById("show_cards");
            this.closeShowCards = document.getElementById("cards_close");
            this.isDisplayShow = false;

            this.spanYc = document.getElementById("yellowcard_num");
            this.ycNumb = 0;
            this.spanYc = document.getElementById("yellowcard_num");
            this.rcNumb = 0;

            this.divDisplayCards = document.getElementById("modal_displaycards");
            this.divSetCards = document.getElementById("set_cards");
            this.divCard;

            this.selectYc = document.getElementById("player_yc");
            this.selectRc = document.getElementById("player_rc");

            this.playerId;
            this.playerName;
            this.time;
            this.period;

            this.cards = [];
            this.card;

            this.events();
        }
        else{
            this.displayCardMatchPage();
        }
    }

    events() {
        this.divYc.addEventListener("click", this.displayModalYellow.bind(this));
        this.closeYc.addEventListener("click", this.displayModalYellow.bind(this));

        this.divRc.addEventListener("click", this.displayModalRed.bind(this));
        this.closeRc.addEventListener("click", this.displayModalRed.bind(this));

        this.buttonShowCards.addEventListener("click", this.displayModalShow.bind(this));
        this.closeShowCards.addEventListener("click", this.displayModalShow.bind(this));

        this.buttonYc.addEventListener("click", this.setYc.bind(this));
        this.buttonRc.addEventListener("click", this.setRc.bind(this));



    }

    displayModalYellow() {
        if (!this.isDisplayYellow){
            this.modalYc.style.display = "flex";
            this.isDisplayYellow = true;
        }
        else {
            this.modalYc.style.display = "none";
            this.isDisplayYellow = false;
        }

    }

    displayModalRed() {
        if (!this.isDisplayRed){
            this.modalRc.style.display = "flex";
            this.isDisplayRed = true;
        }
        else {
            this.modalRc.style.display = "none";
            this.isDisplayRed = false;
        }
    }

    displayModalShow() {
        if (!this.isDisplayShow){
            this.divDisplayCards.style.display = "flex";
            this.isDisplayShow = true;
        }
        else {
            this.divDisplayCards.style.display = "none";
            this.isDisplayShow = false;
        }

    }

    setYc() {
        this.playerId = this.selectYc.options[this.selectYc.selectedIndex].value;
        this.time = parseInt(document.getElementById("timer_min").textContent) + 1;
        this.period = parseInt(document.getElementById("current_period").textContent);
        this.playerName = this.selectYc.options[this.selectYc.selectedIndex].text;

        this.card = {
            "playerid": this.playerId,
            "periodnum": this.period,
            "matchid": this.matchId,
            "time" : this.time,
            "color": "jaune"
        }

        this.cards.push(this.card);

        this.ycNumb += 1;
        this.spanYc.textContent = this.ycNumb;

        this.displayCard(this.card, this.playerName);
        this.modalYc.style.display = "none";
    }

    setRc() {
        this.playerId = this.selectRc.options[this.selectRc.selectedIndex].value;
        this.time = parseInt(document.getElementById("timer_min").textContent) + 1;
        this.period = parseInt(document.getElementById("current_period").textContent);
        this.playerName = this.selectRc.options[this.selectRc.selectedIndex].text;

        this.card = {
            "playerid": this.playerId,
            "periodnum": this.period,
            "matchid": this.matchId,
            "time" : this.time,
            "color": "rouge"
        }

        this.cards.push(this.card);

        this.rcNumb += 1;
        this.spanRc.textContent = this.rcNumb;

        this.displayCard(this.card, this.playerName);
        this.modalRc.style.display = "none";
    }

    displayCard(card, name) {
        this.divCard = document.createElement("div");
        this.divCard.id = "card"

        let divCardColor = document.createElement("div");

        if (card.color === "rouge") {
            divCardColor.className = "redcard";
        } else {
            divCardColor.className = "yellowcard";
        }

        let spanName = document.createElement("span");
        spanName.textContent =  name ;

        let spanTime = document.createElement("span");

        if (card.time <= this.periodDuration) {
            spanTime.textContent = card.time + "'";
        } else {
            spanTime.textContent = this.periodDuration + "'+" + (card.time - this.periodDuration);
        }

        this.divCard.append(divCardColor);
        this.divCard.append(spanName);
        this.divCard.append(spanTime);

        this.divSetCards.append(this.divCard);
    }

    displayCardMatchPage(){
        for (let i = 0; i < card.length; i++){
            this.player = player.find(({playerid}) => playerid === card[i].playerid);
            let time = card[i].time;

            if ( time > this.periodDuration){
                let remain = time - this.periodDuration;
                time = this.periodDuration * card[i].periodnum + "' + " + remain;
            }
            else {
                time = time * goal[i].periodnum + "'";
            }

            let divDisplayCard = document.createElement("div");
            divDisplayCard.className = "card_display d-flex flex-row justify-content-center align-items-center mt-1";
            let divIcon = document.createElement("div");
            if ( card[i].color === "jaune"){
                divIcon.className = "card_display_icon yellowcard";
            }
            else {
                divIcon.className = "card_display_icon redcard";
            }
            let divPlayer = document.createElement("div");
            divPlayer.className = "card_display_player col-3";
            let divTime = document.createElement("div");
            divTime.className = "card_display_time col-2";

            divPlayer.innerHTML = this.player.firstname + " " + this.player.lastname.slice(0,1) + ".";
            divTime.innerHTML = time;
            
            divDisplayCard.append(divIcon);
            divDisplayCard.append(divPlayer);
            divDisplayCard.append(divTime);

            document.getElementById("match_card_display").append(divDisplayCard);
        }

    }
}