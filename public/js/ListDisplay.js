class ListDisplay {
    constructor(){
        this.tableTr = document.getElementsByClassName("trlist");
        this.count = this.tableTr.length;
        this.page = 1;
        this.pageNumber = Math.trunc(this.count / CONFIG.listLength) + 1;

        this.displayTr(this.page);
        this.displayListBar();

        if (this.count > CONFIG.listLength){
            this.events();
        }

    }

    displayTr(page){
        for ( let i=0; i < this.count; i++){
            this.tableTr[i].style.display = "none";
        }
        
        this.lines = page * CONFIG.listLength;
        for ( let i=(this.lines-CONFIG.listLength); i < this.lines; i++){
            if (this.tableTr[i]){
                this.tableTr[i].style.display = "table-row";
            }
        }

    }

    displayListBar(){
        if ( this.count > CONFIG.listLength ){
            this.listBar = document.createElement("div");
            this.listBar.id = "pages_bar";

            this.btnStart = document.createElement("div")
            this.btnStart.innerHTML = '<i class="fas fa-step-backward"></i>';
            this.btnStart.id = "btn_start"

            this.listBar.append(this.btnStart);

            this.btnPrev = document.createElement("div");
            this.btnPrev.innerHTML = '<i class="fas fa-backward"></i>';
            this.btnPrev.id = "btn_prev";
            this.listBar.append(this.btnPrev);

            this.divPage = document.createElement("div");
            this.divPage.innerHTML = '<span id="page_num">1</span> / <span id="page_total">' + this.pageNumber + '</span>';
            this.listBar.append(this.divPage);

            this.btnNext = document.createElement("div");
            this.btnNext.innerHTML = '<i class="fas fa-forward"></i>'
            this.btnNext.id = "btn_next";
            this.listBar.append(this.btnNext);

            this.btnEnd = document.createElement("div");
            this.btnEnd.innerHTML = '<i class="fas fa-step-forward"></i>';
            this.btnEnd.id = "btn_end";
            this.listBar.append(this.btnEnd);
            
            document.querySelector(".list_bar").append(this.listBar);
            
        }
    }

    events(){
        // Button Start
        document.getElementById("btn_start").addEventListener("click", this.changeDisplay.bind(this, 1));
        // Button Previous
        document.getElementById("btn_prev").addEventListener("click", function(){
            this.changeDisplay(this.page-1)
        }.bind(this));
        // Button Next
        document.getElementById("btn_next").addEventListener("click", function(){
            this.changeDisplay(this.page + 1);
        }.bind(this));
        // Button End
        document.getElementById("btn_end").addEventListener("click", this.changeDisplay.bind(this, this.pageNumber));

    }

    changeDisplay(page){
        if ( page < 1){
            this.page = 1;
            return
        }

        if ( page > this.pageNumber){
            this.page = this.pageNumber;
            return
        }

        this.page = page;
        document.getElementById("page_num").textContent = this.page;
        this.displayTr(this.page);
    }

}

let listDisplay = new ListDisplay();
    