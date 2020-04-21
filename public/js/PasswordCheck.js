class PasswordCheck {
    constructor(formpwd1, formpwd2, notice, regex, submitBtn){
        this.form1 = document.getElementById(formpwd1);
        this.form2 = document.getElementById(formpwd2);
        this.noticeDiv = document.getElementById(notice);
        this.regexDiv = document.getElementById(regex)
        this.submitBtn = document.getElementById(submitBtn);
        this.submitBtn.disabled = true;
        this.noticeDiv.style.display = "none";

        this.regex = new RegExp("^[a-zA-Z0-9]{8,}$");

        this.event();
    }

    event(){
        this.form1.addEventListener("keyup", this.checkRegex.bind(this));
        this.form2.addEventListener("keyup", this.checkPassword.bind(this));
    }

    checkRegex(){
        if (this.regex.test(this.form1.value)){
            console.log("vert");
            this.regexDiv.style.color = "green";
        }
        else{
            console.log("vert");
            this.regexDiv.style.color = "red";
        }
    }

    checkPassword(){
        if (this.form1.value === this.form2.value){
            this.form1.className = "form-control form-control-success";
            this.form2.className = "form-control form-control-success";
            this.noticeDiv.style.display = "none";  
            submitPassword = true;
            if (submitMail){
                this.submitBtn.disabled = false;    
            }
        }
        else {
            this.form1.className = "form-control form-control-warning"
            this.form2.className = "form-control form-control-warning";
            this.noticeDiv.style.display = "block";
            this.submitBtn.disabled = true;
        }
    }
}