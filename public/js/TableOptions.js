class TableOptions {
    constructor(){
        this.thead = document.querySelector(".optionsTH");
        this.tr = document.querySelector(".tableTR");
        this.td = document.getElementsByClassName("optionsTD");

        this.setTDSize();

    }

    setTDSize(){
        let width = this.thead.getBoundingClientRect().width;
        let height = this.tr.getBoundingClientRect().bottom - this.tr.getBoundingClientRect().top;

        for ( let i=0; i < this.td.length; i++){
            this.td[i].style.width = (width+1) + "px";
            this.td[i].style.height = (height+1) + "px";
        }

    }
}

let tableOptions = new TableOptions();


