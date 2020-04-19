class MailCheck {

    constructor(mailsList, formMail, notice, submitBtn){
        this.mails = mailsList;
        this.formMail = document.getElementById(formMail);
        this.notice = document.getElementById(notice);
        this.submitBtn = document.getElementById(submitBtn);

       this.notice.style.display = "none";

        this.event();
    }

    event(){
        this.formMail.addEventListener("keyup", this.checkMail.bind(this));
    }

    checkMail(){
        submitMail = true;
        this.notice.style.display = "none";
        
        if (this.formMail.value === ""){
            submitMail = false;
            this.notice.style.display = "block";
            this.notice.textContent = "Vous devez entrer une adresse mail";
        }
        
        let check = this.mails.includes(this.formMail.value);
        if (check){
            this.notice.style.display = "block";
            submitMail = false;
            this.notice.textContent = "Cette adresse mail est déjà enregistrée";
        }

        if (submitMail && submitPassword){
            this.submitBtn.disabled = false;
        }

    }
}