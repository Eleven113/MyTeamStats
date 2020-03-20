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
        this.name.innerHTML = CONFIG.MyTeam.name;
        this.logo.src = CONFIG.MyTeam.logo;
        this.facebook.href = CONFIG.MyTeam.facebook;
        this.twitter.href = CONFIG.MyTeam.twitter;
        this.instagram.href = CONFIG.MyTeam.instagram;
        this.youtube.href = CONFIG.MyTeam.youtube;
        this.president.innerHTML = CONFIG.MyTeam.president;
        this.hq.innerHTML = CONFIG.MyTeam.address;
        this.tel.innerHTML = CONFIG.MyTeam.tel;
        this.mail.innerHTML = CONFIG.MyTeam.mail;
        this.website.innerHTML = CONFIG.MyTeam.website;
    }
}

let club = new Club();