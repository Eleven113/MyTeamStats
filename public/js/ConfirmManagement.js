class ConfirmManagement {

    constructor (divDeleteId, page){
        this.page = page;
        this.divDeleteId = divDeleteId;

        this.isDisplay = false;
        this.divDelete = document.getElementById("this.divDeleteId");

        this.checkPage();
        this.createModal();

    }

    checkPage(){
        switch (page){
            case "composition":

            default:
                break;
        }
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

        this.closeBtn = document.createElement("div");
        this.noBtn.id = this.page + "no_btn";
        this.noBtn.innerHTML = '<i class="fas fa-times"></i>';
    
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
        this.divDelete.addEventListener(this.displayModal.bind(this));
    }
}