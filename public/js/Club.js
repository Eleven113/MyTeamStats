class Club {
    constructor(){

        this.name = document.getElementById("club_name");
        this.logo = document.getElementById("club_logo");
        this.facebook = document.getElementById("facebook");
        this.twitter = document.getElementById("twitter");
        this.instagram = document.getElementById("instagram");
        this.youtube = document.getElementById("youtube");
        this.president = document.getElementById("club_pres");
        this.hq = document.getElementById("club_hq");
        this.tel = document.getElementById("club_tel");
        this.mail = document.getElementById("club_mail");
        this.website = document.getElementById("club_website");

        this.setValue();
    }

    setValue(){
        this.name.innerHTML = MTSCONFIG.MyTeam.name;
        this.logo.src = MTSCONFIG.MyTeam.logo;
        this.facebook.href = MTSCONFIG.MyTeam.facebook;
        this.twitter.href = MTSCONFIG.MyTeam.twitter;
        this.instagram.href = MTSCONFIG.MyTeam.instagram;
        this.youtube.href = MTSCONFIG.MyTeam.youtube;
        this.president.innerHTML = MTSCONFIG.MyTeam.president;
        this.hq.innerHTML = MTSCONFIG.MyTeam.address;
        this.tel.innerHTML = MTSCONFIG.MyTeam.tel;
        this.mail.innerHTML = MTSCONFIG.MyTeam.mail;
        this.website.innerHTML = MTSCONFIG.MyTeam.website;
    }
}

let club = new Club();