class DeleteManagement {
    constructor(){
        this.confirmDeleteDiv = document.querySelector(".modal_confirm_delete");
        this.confirmBtnYes = document.querySelector(".modal_confirm_delete_content-buttonyes");
        this.confirmBtnNo = document.querySelector(".modal_confirm_delete_content-buttonno");
        this.deleteBtns = document.getElementsByClassName("delete_btn");
        this.deleteLink = document.querySelector(".delete_link");
        this.deleteMethod = this.confirmBtnYes.id;
        console.log("putain",this.deleteMethod);
        this.isDisplay = false;

        this.events();
    }

    events(){
        this.confirmBtnNo.addEventListener("click", function(){
            this.confirmDeleteDiv.style.display = "none";
        }.bind(this));

        for ( let i = 0; i < this.deleteBtns.length; i++){
            this.deleteBtns[i].addEventListener("click", function(event){
                let id = event.target.id.split('_')[2];
                console.log(id);
                this.confirmDeleteDiv.style.top = window.pageYOffset + "px"
                this.confirmDeleteDiv.style.display = "flex";
                console.log(this.deleteMethod);
                this.confirmBtnYes.onclick = function(){
                    location.href= this.deleteMethod + id;
                }.bind(this);
            }.bind(this))
        }
    }
}

let deleteManagement = new DeleteManagement();