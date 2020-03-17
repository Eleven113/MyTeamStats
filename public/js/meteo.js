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
    this.dateNow = Date.now()/1000;

    this.displayMeteo()
    }

    displayMeteo(){
        for ( let i = 0 ; i < this.divZipCode.length; i++){
            this.dateMatch = (Date.parse(this.divDate[i].innerHTML)/1000 + 3600);
            
            console.log (this.dateMatch - this.dateNow);
            if ( this.dateMatch - this.dateNow <= 432000 && this.dateMatch - this.dateNow >= - 10800 ){
                this.getMeteo();
            }
            else {
                this.spanMeteo[i].innerHTML = "La météo n'est pas disponible pour ce match"
            }
        }
    }

    getMeteo(){

    }

}

let meteoApi = new MeteoAPI("meteo_zipcode", "meteo_date", "meteo_display");