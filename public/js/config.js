const CONFIG = {
    MyTeam : {
        name : "Lavalloise Football Club",
        acronym : "LFC",
        logo : "https://res.cloudinary.com/marthyte/image/upload/v1584623500/v2_vnydsk.png",
        president : "NOM Prénom",
        address : "28 rue des cèpes 53210 Argentré",
        tel : "06 23 91 29 66",
        mail : "nom.prenom@lavalloise-fc.com",
        website : "http://www.lavalloise-fc.com",
        facebook : "lien facebook",
        twitter : "lien twitter",
        instagram : "lien insta",
        youtube : "lien youtube"

    },

    data : items = [
        {
            "name": "Passes",
            "db_name": "pass",
            "model" : 0
        },
        {
            "name": "Passes Réussies",
            "db_name": "successpass",
            "model" : 2
        },
        {
            "name": "Passes Ratées",
            "db_name": "misspass",
            "model" : 2
        },
        {
            "name": "Tirs",
            "db_name": "shot",
            "model" : 0
        },
        {
            "name": "Tirs cadrés",
            "db_name": "shotontarget",
            "model" : 2
        },
        {
            "name": "Tirs non cadrés",
            "db_name": "missshot",
            "model" : 2
        },
        {
            "name": "Coup francs",
            "db_name": "freekick",
            "model" : 1
        },
        {
            "name": "Hors jeu",
            "db_name": "offside",
            "model" : 1
        },
        {
            "name": "Corner",
            "db_name": "cornerkick",
            "model" : 1
        },
        {
            "name": "Cartons Jaunes",
            "db_name": "yellowcard",
            "model" : 1
        },
        {
            "name": "Cartons Rouges",
            "db_name": "redcard",
            "model" : 1
        },
        {
            "name": "Fautes",
            "db_name": "foul",
            "model" : 1
        },
        {
            "name": "Ballons gagnés",
            "db_name": "winball",
            "model" : 2
        },
        {
            "name": "Ballons perdus",
            "db_name": "lostball",
            "model" : 2
        }
    ]
}

    
