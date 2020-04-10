class NoticeManagement {
    constructor (){
        this.div = document.querySelector(".notice");
        this.divClose = document.querySelector(".notice_close");
        this.event();
        // this.timer();

    }

    closeDiv(){
        this.div.style.display = "none"
    }

    event(){
        this.divClose.addEventListener("click", this.closeDiv.bind(this));
    }

    timer(){
        setInterval(this.closeDiv.bind(this),5000);
    }

}

let noticeManagement = new NoticeManagement;