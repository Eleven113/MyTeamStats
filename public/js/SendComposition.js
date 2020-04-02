class SendComposition {
    constructor(){
        this.modal = document.getElementById("modal_send_composition");
        this.divClose = document.getElementById("modal_send_composition_close");
        this.btnSend = document.getElementById("send_modal");

        this.isDisplay = false;
        this.events();

    }

    modalDisplay(){
        if (!this.isDisplay){
            this.modal.style.display = "flex";
            this.isDisplay = true;
        }
        else {
            this.modal.style.display = "none";
            this.isDisplay = false;
        }

    }

    events(){
        this.btnSend.addEventListener("click", this.modalDisplay.bind(this));

        this.divClose.addEventListener("click", this.modalDisplay.bind(this));
    }
}

let sendComposition = new SendComposition;