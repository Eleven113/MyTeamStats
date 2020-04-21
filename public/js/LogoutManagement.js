class LogoutManagement {
    constructor(){
        this.menuBtn = document.getElementById("user_menu");
        this.menuModal = document.getElementById("user_modal");
        this.header = document.getElementById("head_menu");
        this.events();
    }

    events(){
        this.menuBtn.addEventListener("click", this.displayModal.bind(this));
    }

    displayModal(){
        clearInterval(this.timer);
        this.menuModal.style.display = "flex";
        this.topPosition = this.header.getBoundingClientRect().bottom 
        this.menuModal.style.top = this.topPosition + "px";
        this.timer = setInterval(this.closeModal.bind(this),3000);
    }

    closeModal(){
        this.menuModal.style.display = "none";
    }
}

let logoutManagement = new LogoutManagement();