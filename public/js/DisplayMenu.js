class DisplayMenu {
    constructor(){
        this.divMenu = document.getElementById("left_menu_window");
        this.btnMenu = document.getElementById("left_menu_btn");
        this.header = document.getElementById("head_menu");

        this.isDisplay = false;
        // Initialise la postion de la div au chargement
        this.setTop();
        // Ré-actualise la position de la div quand la taille changement
        window.onresize = this.setTop.bind(this);

        this.event();
    }

    event(){
        this.btnMenu.addEventListener("click", this.menuDisplay.bind(this));
    }

    setTop(){
        this.topPosition = (this.header.getBoundingClientRect().bottom + 1);
        this.divMenu.style.top = this.topPosition + "px";
    }

    menuDisplay(){
        if (this.isDisplay){
            this.divMenu.style.display = "none";
            this.isDisplay = false;
        }
        else {
            this.divMenu.style.display = "flex";
            this.isDisplay = true;
        }
    }
}

let displayMenu = new DisplayMenu();