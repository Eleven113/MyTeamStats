class MeteoAPI {
    constructor(divZipCode,divDate,spanMeteo){
    this.divZipCode = document.getElementsByClassName(divZipCode);
    this.divDate = document.getElementsByClassName(divDate);
    this.spanMeteo = document.getElementsByClassName(spanMeteo);
    this.dateMatch;
    this.hourMatch;
    this.dateNow = Date.now()/1000;
    this.zipCode;
    this.urlRequest
    this.apiResponse;
    this.temperature;
    this.weather;
    this.icon;

    this.testTimestamp();
    this.displayMeteo();
    }

    // Test la différence entre la date du moment et la date du match si inférieur à 5 jours, on peut afficher la météo
    testTimestamp(){
        for ( let i = 0 ; i < this.divZipCode.length; i++){
            this.dateMatch = (Date.parse(this.divDate[i].innerHTML)/1000 + 3600)
            let date = new Date(this.dateMatch * 1000);
            this.hourMatch = date.getHours()-1;

            if ( this.dateMatch - this.dateNow <= 432000 && this.dateMatch - this.dateNow >= - 10800 ){
                this.getMeteo(i);
            }
            else {
                this.spanMeteo[i].innerHTML = "La météo n'est pas disponible pour ce match"
            }
        }
    }

    // Récupérer les données dans l'API
    getMeteo(i){
        this.zipCode = this.divZipCode[i].innerHTML;
        
        this.urlRequest = "http://api.openweathermap.org/data/2.5/forecast?zip="+this.zipCode+",FR&appid=544af5ad005b2c4b8fd3f5709fada161&units=metric";

        ajaxGet(this.urlRequest, function(response){
            this.apiResponse = JSON.parse(response);
            let time = 0;
            // Test du temps pour trouver le prochain Timestamp le plus proche de dateMatch
            while (this.dateMatch > this.apiResponse.list[time].dt){
                time++;
            }
            
            // Récupération des données dans l'API
            this.icon = this.apiResponse.list[time].weather[0].icon;
            this.weather = this.apiResponse.list[time].weather[0].main;
            this.temperature = Math.round(this.apiResponse.list[time].main.temp);


            this.displayMeteo(i, this.icon, this.weather, this.temperature);
        }.bind(this));

    }

    // Construction de la div meteo
    displayMeteo(i, icon, weather, temperature){
        this.spanMeteo[i].innerHTML = '<img src="http://openweathermap.org/img/wn/'+ icon +'@2x.png" alt="' + weather + '"> ' + temperature + '°C' ;
    };

}

let meteoApi = new MeteoAPI("meteo_zipcode", "meteo_date", "meteo_display");