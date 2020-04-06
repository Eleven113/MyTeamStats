class PasswordCheck {
    constructor(formpwd1, formpwd2, notice, submitBtn){
        this.form1 = document.getElementById(formpwd1);
        this.form2 = document.getElementById(formpwd2);
        this.notice = document.getElementById(notice);
        this.submitBtn = document.getElementById(submitBtn);

        this.submitBtn.disabled = true;
        this.notice.style.display = "none";

        this.event();
    }

    event(){
        this.form2.addEventListener("keyup", this.checkPassword.bind(this));
    }

    checkPassword(){
        console.log(this.form1.value, this.form2.value);
        if (this.form1.value === this.form2.value){
            this.form1.className = "form-control form-control-success";
            this.form2.className = "form-control form-control-success";
            this.notice.style.display = "none";
            submitPassword = true;
            if (submitMail){
                this.submitBtn.disabled = false;    
            }
        }
        else {
            this.form1.className = "form-control form-control-warning"
            this.form2.className = "form-control form-control-warning";
            this.notice.style.display = "block";
            this.submitBtn.disabled = true;
        }
    }
}