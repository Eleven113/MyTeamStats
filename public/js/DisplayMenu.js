class DisplayMenu {
    constructor(){
        this.divMenu = document.getElementById("left_menu");
        this.header = document.getElementById("head_menu");
        
        // Initialise la postion de la div au chargement
        this.setTop();
        // Réactualise la position de la div quand la taille changement
        window.onresize = this.setTop.bind(this);
    }

    // events(){
    //     window.addEventListener('resize', this.setTop.bind(this));
    // }

    setTop(){
        this.topPosition = (this.header.getBoundingClientRect().bottom + 1);
        this.divMenu.style.top = this.topPosition + "px";
    }
}

let displayMenu = new DisplayMenu();