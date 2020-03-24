class Card {

    constructor(matchId, periodDuration) {
        this.matchId = matchId;
        this.periodDuration = periodDuration;

        this.divYc = document.getElementById("yellowcard");
        this.divRc = document.getElementById("redcard");

        this.spanYc = document.getElementById("yellowcard_num");
        this.spanRc = document.getElementById("redcard_num");

        this.modalYc = document.getElementById("modal_yellowcard");
        this.moddalRc = document.getElementById("modal_redcard");

        this.buttonYc = document.getElementById("valid_yc");
        this.buttonRc = document.getElementById("valid_rc");

        this.ycNumb;
        this.rcNumb;

        this.divShowYc = document.getElementById("show_yellowcard");
        this.divShowRc = document.getElementById("show_redcard");

        this.divGetYc = document.getElementById("get_yellowcard");
        this.divGetRc = document.getElementById("get_redcard");
        this.divCard;

        this.selectYc = document.getElementById("player_yc");
        this.selectRc = document.getElementById("player_rc");

        this.playerId;
        this.playerName;
        this.time;
        this.period;

        this.cards;
        this.card;

        this.events();
    }

    events() {
        this.divYc.addEventListener("click", this.displayModalYellow.bind(this));

        this.divRc.addEventListener("click", this.displayModalRed.bind(this));

        this.buttonYc.addEventListener("click", this.setYc.bind(this));

    }

    displayModalYellow() {
        this.modalYc.style.display = "block";
    }

    displayModalRed() {
        this.modalRc.style.display = "block";
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
            "color": "jaune"
        }

        this.card.push(this.card);
        console.log(this.card);

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
            "color": "rouge"
        }

        this.card.push(this.card);
        console.log(this.card);

        this.displayCard(this.card, this.playerName);
        this.modalRc.style.display = "none";
    }

    displayCard(card, name) {
        this.divCard = document.createElement("div");
        this.divCard.className = "d-flex flex-row justify-content-center col-10"

        let divCardColor = document.createElement("div");

        if (card.color === "rouge") {
            divCardColor.className = "redcard";
        } else {
            divCardColor.className = "yellowcard";
        }

        let spanName = document.createElement("span");
        spanName.textContent = name;

        let spanTime = document.createElement("span");

        if (card.time <= this.periodDuration) {
            spanTime.textContent = card.time;
        } else {
            spanTime.textContent = this.periodDuration + "'+" + (card.time - this.periodDuration);
        }

        this.divCard.append(divCardColor);
        this.divCard.append(spanName);
        this.divCard.append(spanTime);

        if (card.color === "rouge") {
            this.divGetRc.append(this.divCard);
        } else {
            this.divGetYc.append(this.divCard);
        }
    }
}