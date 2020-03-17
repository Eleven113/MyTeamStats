let dateDiv = document.getElementsByClassName("meteo_date");
let dateDivLength = dateDiv.length;
let dateMatch;
let timeStampDateMatch;
console.log(dateDivLength);

for (let i =0; i < dateDivLength; i++){
    dateMatch = dateDiv[i].innerHTML;
    console.log(dateMatch);
    timeStampDateMatch = (Date.parse(dateMatch)/1000) + 3600;
    console.log(timeStampDateMatch);
}


class MeteoAPI {
    constructor(divZipCode,divDate,spanMeteo){
    this.divZipCode = document.getElementsByClassName(divZipCode);
    this.divDate = document.getElementsByClassName(divDate);
    this.spanMeteo = document.getElementsByClassName(spanMeteo)
    this.dateMatch;
    this.hourMatch;
    this.dateNow = Date.now()/1000;
    this.zipCode;
    this.urlRequest
    this.apiResponse;

    this.displayMeteo()
    }

    displayMeteo(){
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

    getMeteo(i){
        this.zipCode = this.divZipCode[i].innerHTML;
        console.log(this.zipCode);
        this.urlRequest = "http://api.openweathermap.org/data/2.5/forecast?zip="+this.zipCode+",FR&appid=544af5ad005b2c4b8fd3f5709fada161&units=metric";
        console.log(this.urlRequest);
        ajaxGet(this.urlRequest, function(response){
            this.apiResponse = JSON.parse(response);
            console.log(this.apiResponse);
        }.bind(this));

    }

}

let meteoApi = new MeteoAPI("meteo_zipcode", "meteo_date", "meteo_display");