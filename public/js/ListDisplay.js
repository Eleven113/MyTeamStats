class ListDisplay {
    constructor(list,count){
        this.tableTr = document.getElementsByClassName("trlist");
        this.count = count;
        this.list = list;
        this.page = 1;
        this.userStatus = userStatus;
        this.pageNumber = Math.trunc(this.count / MTSCONFIG.listLength) + 1;

        // this.getPlayersList(this.page);
        this.displayListBar();

        if (this.count > MTSCONFIG.listLength){
            this.events();
        }

        console.log(this.list, this.count)
    }

    // displayTr(page){
    //     for ( let i=0; i < this.count; i++){
    //         this.tableTr[i].style.display = "none";
    //     }
        
    //     this.lines = page * CONFIG.listLength;
    //     for ( let i=(this.lines-CONFIG.listLength); i < this.lines; i++){
    //         if (this.tableTr[i]){
    //             this.tableTr[i].style.display = "table-row";
    //         }
    //     }
    // }

    getList(list,page,userStatus){
        $.get('/More'+ list +'/'+ page , function(data){
            data = JSON.parse(data);
            $("tbody").html('');
            for (let i=0; i < data.length; i++){
                this.tr = document.createElement("tr");
                this.tr.className = "tableTR trlist";

                switch (list) {
                    case 'Players':
                        if (data[i].activelicence === 1){
                            this.licence = '<i class="fas fa-check greencheck"></i>'
                        }
                        else {
                            this.licence = '<i class="fas fa-times redtimes"></i>'
                        }

                        this.date = Date();
                        this.date = new Date(this.date);
                        this.year = this.date.getFullYear();
                        this.month = this.date.getMonth();

                        if (this.month > 6){
                            this.year += 1;
                        }

                        this.playerBirthyear = data[i].birthdate.split('-')[2];
                        this.category = "U" + (this.year - this.playerBirthyear);

                        if ( userStatus >= 3){
                            this.licencenum = '<td>' + data[i].licence + '</td>';
                            if (userStatus >= 4){
                                this.options = '<div><a href="/Player/' + data[i].playerid + '" class="bluelink"><i class="fas fa-user"></i></a></div><div><a href="/ModifyPlayer/' + data[i].playerid + '" class="bluelink"><i class="fas fa-user-edit"></i></a></div><div class="delete_btn"><i class="fas fa-user-times" id="delete_player_' + data[i].playerid + '" ></i></div>';
                            }
                            else {
                                this.options = '<div><a href="/Player/' + data[i].playerid + '" class="bluelink"><i class="fas fa-user"></i></a></div><div><a href="/ModifyPlayer/' + data[i].playerid + '" class="bluelink"><i class="fas fa-user-edit"></i></a></div>';
                            }
                        }
                        else {
                            this.licencenum = '';
                            this.options = '<div><a href="/Player/' + data[i].playerid + '" class="bluelink"><i class="fas fa-user"></i></a></div>';
                        }

                        this.tr.innerHTML = '<tr class="tableTR trlist">' + this.licencenum + '<td>' + data[i].firstname + '</td><td>' + data[i].lastname + '</td><td>' + data[i].birthdate + '</td><td>' + this.category + '</td><td>' + this.licence + '</td><td class="optionsTD">' + this.options + '</td></tr>';
                        break;

                    case 'Oppo':
                        if (userStatus >= 4){
                            this.tr.innerHTML = '<td>' + data[i].name + '</td><td><img src="' + data[i].logo + '" class="img-responsive fit-image"></td><td class="optionsTD"><div><a href="/ModifyOppo/' + data[i].opponentid + '" class="bluelink"><i class="fas fa-pen"></i></a></div><div class="delete_btn"><i class="fas fa-trash-alt" id="delete_oppo_' + data[i].opponentid + '"></i></div></td>';
                        }
                        else {
                            this.tr.innerHTML = '<td>' + data[i].name + '</td><td><img src="' + data[i].logo + '" class="img-responsive fit-image"></td><td class="optionsTD"><div><a href="/ModifyOppo/' + data[i].opponentid + '" class="bluelink"><i class="fas fa-pen"></i></a></div></td>';
                        }
                        break;

                    case 'Fields':
                        if (userStatus >= 4){
                            this.tr.innerHTML = '<td>' + data[i].name + '</a></td><td>' + data[i].address + '</td><td>' + data[i].zipcode + '</td><td>' + data[i].city + '</td><td>' + data[i].turf + '</td><td class="d-flex flex-row justify-content-between"><div><a href="/ModifyField/' + data[i].fieldid + '" class="bluelink"><i class="fas fa-pen"></i></a></div><div  class="delete_btn"><i class="fas fa-trash-alt"  id="delete_field_' + data[i].fieldid + '"></i></div></td>';
                        }
                        else {
                            this.tr.innerHTML = '<td>' + data[i].name + '</a></td><td>' + data[i].address + '</td><td>' + data[i].zipcode + '</td><td>' + data[i].city + '</td><td>' + data[i].turf + '</td><td class="d-flex flex-row justify-content-between"><div><a href="/ModifyField/' + data[i].fieldid + '" class="bluelink"><i class="fas fa-pen"></i></a></div></td>';
                        }
                        break;

                    case 'Users':
                        switch (data[i].status) {
                            case 1:
                                this.status = "Visiteur";
                                break;
                            case 2:
                                this.status = "Joueur";
                                break;
                            case 3:
                                this.status = "Coach/Dirigeant";
                                break;
                            case 4:
                                this.status = "Administrateur"
                                break;
                            default:
                                break;
                        }

                        if (userStatus >= 4){
                            this.tr.innerHTML = '<td>' + data[i].lastname + '</td><td>' + data[i].firstname + '</td><td>' + data[i].mail + '</td><td>' + this.status + '</td><td class="d-flex flex-row justify-content-around"><div><a href="/ModifyUser/' + data[i].userid +'" class="bluelink"><i class="fas fa-user-edit"></i></a></div><div class="delete_btn"><i class="fas fa-user-times" id="delete_user_' + data[i].userid + '"></i></div></td></tr>';
                        }
                        else {
                            this.tr.innerHTML = '<td>' + data[i].lastname + '</td><td>' + data[i].firstname + '</td><td>' + data[i].mail + '</td><td>' + this.status + '</td><td class="d-flex flex-row justify-content-around"><div><a href="/ModifyUser/' + data[i].userid +'" class="bluelink"><i class="fas fa-user-edit"></i></a></div></td></tr>';
                        }
                        break;

                    case 'Matchs':
                        this.status = parseInt(data[i].status);
                        if (this.status === 1) {
                            this.score = "A venir";
                        }
                        else {
                            this.score = data[i].homescore + " - " + data[i].awayscore;
                        }

                        if (data[i].athome === 1) {
                            this.atHome = "Domicile";
                        }
                        else {
                            this.atHome = "Extérieur";
                        }

                        this.date = data[i].date.split(' ')[0];
                        this.hour = data[i].date.split(' ')[1];
                        this.hour = this.hour.split(':')[0]+':'+this.hour.split(':')[1];
                        this.date = this.date.split('-')[2]+'/'+this.date.split('-')[1]+'/'+this.date.split('-')[0];
                        this.date = this.date + ' à ' + this.hour;

                        if ( userStatus < 3 || data[i] === 0){
                            this.tr.innerHTML = '<td>' + data[i].category + '</td><td>' + data[i].oppo + '</td><td>' + this.atHome + '</td><td>' + this.date + '</td><td>' + this.score +  '</td><td class="d-flex flex-row justify-content-between"><div><a href="/Match/' + data[i].gameid + '" class="bluelink"><i class="far fa-futbol"></i></a></div><div><a href="/Composition/' + data[i].gameid + '" class="bluelink"><i class="fas fa-users"></i></a></div><div><a href="/MatchStats/' + data[i].gameid + '" class="bluelink"><i class="fas fa-clipboard-list"></i></a></div></td>';
                        }
                        else {
                            if ( userStatus >= 4){
                                this.tr.innerHTML = '<td>' + data[i].category + '</td><td>' + data[i].oppo + '</td><td>' + this.atHome + '</td><td>' + this.date + '</td><td>' + this.score +  '</td><td class="d-flex flex-row justify-content-between"><div><a href="/Match/' + data[i].gameid + '" class="bluelink"><i class="far fa-futbol"></i></a></div><div><a href="/Composition/' + data[i].gameid + '" class="bluelink"><i class="fas fa-users"></i></a></div><div><a href="/MatchStats/' + data[i].gameid + '" class="bluelink"><i class="fas fa-clipboard-list"></i></a></div><div class="delete_btn"><i class="fas fa-trash-alt" id="delete_match_' + data[i].gameid + '"></i></div></td>';
                            }
                            else {
                                this.tr.innerHTML = '<td>' + data[i].category + '</td><td>' + data[i].oppo + '</td><td>' + this.atHome + '</td><td>' + this.date + '</td><td>' + this.score +  '</td><td class="d-flex flex-row justify-content-between"><div><a href="/Match/' + data[i].gameid + '" class="bluelink"><i class="far fa-futbol"></i></a></div><div><a href="/Composition/' + data[i].gameid + '" class="bluelink"><i class="fas fa-users"></i></a></div><div><a href="/MatchStats/' + data[i].gameid + '" class="bluelink"><i class="fas fa-clipboard-list"></i></a></div></td>';
                            }
                        }
                        break;

                    default:
                        break;
                }

                $("tbody").append(this.tr);
                tableOptions = new TableOptions();
                deleteManagement = new DeleteManagement();
            }
        });
    }

    displayListBar(){
        if ( this.count > MTSCONFIG.listLength ){
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
        this.getList(this.list, this.page, this.userStatus);
    }

}

let listDisplay = new ListDisplay(list,count);
    