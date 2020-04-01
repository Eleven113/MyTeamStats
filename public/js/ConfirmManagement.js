class ConfirmManagement {

    constructor (divDeleteId, page){
        this.page = page;
        this.divDeleteId = divDeleteId;

        this.isDisplay = false;
        this.divDelete = document.getElementsByClassName("this.divDeleteId");

        this.checkPage();
        this.createModal();

    }

    createModal(){
        this.modal = document.createElement("div");
        this.modal.className = "modal_confirm";
        this.modal.style.display = "none"

        this.closeBtn = document.createElement("div");
        this.closeBtn.className = "modal_close";

        this.divText = document.createElement("div");
        this.divText.className = "modal_text";

        this.yesBtn = document.createElement("button");
        this.yesBtn.id = this.page + "yes_btn";
        this.yesBtn.className = "btn btn-primary";
        this.yesBtn.textContent = "Oui";

        this.noBtn = document.createElement("button");
        this.noBtn.id = this.page + "no_btn";
        this.noBtn.className = "btn btn-primary";
        this.noBtn.textContent = "Non";
    
    }

    displayModal(){
        if (this.isDisplay){
            this.modal.style.display = "none";
            this.isDisplay = false;
        }
        else {
            this.modal.style.display = "flex";
            this.isDisplay = true;
        }
    }

    events(){
        this.
    }
}