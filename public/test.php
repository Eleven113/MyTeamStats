<html lang="fr"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta property="og:title" content="MyTeamStats">
    <meta property="og:type" content="Website">
    <meta property="og:url" content="http://www.thibaut-minard.fr/MyTeamStats/">
    <meta property="og:image" content="http://www.thibaut-minard.fr/blog/public/img/og_pic.jpg">
    <meta property="og:description" content="Gestion d'équipe / Statistiques">
        <title>Match Stat - MyTeamStats</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="/MyTeamStats/public/css/style.css" rel="stylesheet">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="/MyTeamStats//public/css/style_mobile.css">
    <script src="https://kit.fontawesome.com/5fbf6a0223.js" crossorigin="anonymous"></script><link href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all" rel="stylesheet" id="font-awesome-5-kit-css"><link href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all" rel="stylesheet" id="font-awesome-5-kit-css"><link href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all" rel="stylesheet" id="font-awesome-5-kit-css">
</head>

<body>
    <div class="container-fluid">
        <header class="row d-flex justify-content-between bg-primary">
            <div class="col-4 text-left"><a href="/MyteamStats" class="link"><i class="fas fa-bars" aria-hidden="true"></i></a></div>
            <div class="col-4 text-center"><a href="/MyteamStats" class="link">MyTeamStats</a></div>
            <div class="col-4 text-right">
                                    Bienvenue <a href="/MyTeamStats/SessionKill" class="link">Thibaut</a>
                            </div>
        </header>

        <div id="content">
                <div id="modal">
        <div id="modal_goal" class="modalflex" style="display: none;">
            <div id="scorer">
                <label for="scorer">Buteur :</label>
                <select name="scorer" id="select_scorer">
                                            <option value="2">Prénom N</option>
                                            <option value="7">Prénom N</option>
                                            <option value="13">Chloé M</option>
                                            <option value="16">Thibaut M</option>
                                            <option value="17">Simon C</option>
                                            <option value="18">Lenny B</option>
                                    </select>
            </div>
            <div id="passer">
                <label for="passer">Passeur :</label>
                <select name="passer" id="select_passer">
                    <option value="null">Pas de passeur</option>
                                            <option value="2">Prénom N</option>
                                            <option value="7">Prénom N</option>
                                            <option value="13">Chloé M</option>
                                            <option value="16">Thibaut M</option>
                                            <option value="17">Simon C</option>
                                            <option value="18">Lenny B</option>
                                    </select>
            </div>
            <div id="action">
                <label for="action">Action :</label>
                <select name="action" id="select_action">
                    <option value="Action de jeu">Action de jeu</option>
                    <option value="Corner">Corner</option>
                    <option value="Coup franc">Coup franc</option>
                    <option value="Coup franc direct">Coup franc direct</option>
                    <option value="Penalty">Penalty</option>
                </select>
            </div>
            <div id="bodypart">
                <label for="bodypart">Methode :</label>
                <select name="bodypart" id="select_bodypart">
                    <option value="Pied droit">Pied droit</option>
                    <option value="Pied Gauche">Pied Gauche</option>
                    <option value="Tête">Tête</option>
                    <option value="CSC">CSC</option>
                </select>
            </div>
            <button id="modal_goal-button" class="btn btn-primary">Valider</button>
        </div>

        <div id="modal_yellowcard" class="modalflex">
            <div id="yc_close"><i class="fas fa-times" aria-hidden="true"></i></div>
            <div id="set_yellowcard">
                <label for="player_yc">Joueur averti :</label>
                &nbsp;&nbsp;&nbsp;
                <select name="player_yc" id="player_yc">
                                            <option value="2">Prénom N</option>
                                            <option value="7">Prénom N</option>
                                            <option value="13">Chloé M</option>
                                            <option value="16">Thibaut M</option>
                                            <option value="17">Simon C</option>
                                            <option value="18">Lenny B</option>
                                    </select>
                &nbsp;&nbsp;&nbsp;
                <button id="valid_yc" class="btn btn-primary">Valider</button>
            </div>
        </div>

        <div id="modal_redcard" class="modalflex">
            <div id="rc_close"><i class="fas fa-times" aria-hidden="true"></i></div>
            <div id="set_redcard">
                <label for="player_rc">Joueur expulsé :</label>
                &nbsp;&nbsp;&nbsp;
                <select name="player_rc" id="player_rc">
                                            <option value="2">Prénom N</option>
                                            <option value="7">Prénom N</option>
                                            <option value="13">Chloé M</option>
                                            <option value="16">Thibaut M</option>
                                            <option value="17">Simon C</option>
                                            <option value="18">Lenny B</option>
                                    </select>
                &nbsp;&nbsp;&nbsp;
                <button id="valid_rc" class="btn btn-primary">Valider</button>
            </div>
        </div>

        <div id="modal_displaycards">
            <div id="cards_close"><i class="fas fa-times" aria-hidden="true"></i></div>
            <div id="set_cards"></div>
        </div>
    </div>

<div id="match" class="d-flex flex-column col-12">

    <div id="match_data">
        <div id="matchid">8</div>
        <div id="athome">1</div>
        <div id="periodnum">4</div>
        <div id="periodduration">15</div>
        <div id="page">stats</div>
    </div>



            <div id="match_banner" class="d-flex flex-row col-12">
             <div id="banner_scorer" class="d-flex flex-row flex-wrap col-3">
            <div class="d-flex flex-column justify-content-start align-items-start col-12"><div class="scorername col-10 d-flex flex-row overflow-hidden p-0">Prénom N</div><div class="goaltime p-1 col-1">1'</div><div class="buttonclose col-1"><i class="fas fa-times" aria-hidden="true"></i></div></div></div>
            <div id="match_banner-teams" class="d-flex flex-column align-items-center col-6 teamcol">
                                    <div id="match_team_logo" class="d-flex flex-row justify-content-around col-12">
                        <div id="match_team_logo-home" class="col-3">
                            <img src="https://res.cloudinary.com/marthyte/image/upload/v1584623500/v2_vnydsk.png" class="img-responsive fit-image">
                        </div>
                        <div id="match_team_logo-away" class="col-3">
                            <img src="http://res.cloudinary.com/marthyte/image/upload/v1583593043/Opponent/vqnfrqdhek26dmcqhokl.jpg" class="img-responsive fit-image">
                        </div>
                    </div>
                    <div id="match_team_name" class="d-flex flex-row justify-content-around col-12 mt-1 font-weight-bold">
                        <div id="match_team_name-home" class="col-6 text-center">
                            LFC
                        </div>
                        <div id="match_team_name-away" class="col-6 text-center">
                            US Changé
                        </div>
                    </div>
                    <div id="match-team_score" class="d-flex flex-row justify-content-around col-12 mt-1">
                        <div id="MyTeamScore" class="col-6 text-center">1</div>
                        <div id="OppoTeamScore" class="col-6 text-center">
                            0
                        </div>
                    </div>
                    <div id="match_team_buttons" class="d-flex flex-row justify-content-around col-12 mt-1">
                        <div id="match_team_buttons-home" class="d-flex flex-row col-4">
                            <div class="d-flex flex-row justify-content-center col-12">
                                <button id="MyTeamButtonMinus" class="btn btn-primary" style="display: none;"><i class="fas fa-minus" aria-hidden="true"></i></button> <button id="MyTeamButtonPlus" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div id="match_team_buttons-away" class="d-flex flex-row justify-content-between col-4">
                            <div class="d-flex flex-row justify-content-around col-12">
                                <button id="OppoTeamButtonMinus" class="btn btn-primary"><i class="fas fa-minus" aria-hidden="true"></i></button> <button id="OppoTeamButtonPlus" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>

                                <div id="match_team_buttons-cards" class="d-flex flex-row justify-content-center col-12 mt-1">
                    <div class="d-flex flex-row justify-content-around col-4">
                        <div class="d-flex flex-row align-items-center"><div id="yellowcard"></div>&nbsp;&nbsp;<span id="yellowcard_num">0</span></div>
                        <div class="d-flex flex-row align-items-center"><div id="redcard"></div>&nbsp;&nbsp;<span id="redcard_num">0</span></div>
                    </div>
                </div>
                <div id="match_team_show-cards" class="d-flex flex-row justify-content-center col-12 mt-1">
                    <div class="d-flex flex-row justify-content-around col-4">
                        <button id="show_cards" class="btn btn-primary">Voir les cartons</button>
                    </div>
                </div>
            </div>
            <div id="banner_chrono" class="col-3 d-flex flex-column justify-content-center">
            <div class="d-flex flex-column align-items-center" id="period"><div class="mb-2">Période <span id="current_period">1</span> / <span id="number_period"> 4</span></div><div id="timer" class="mb-2"><span id="timer_min">00</span>:<span id="timer_sec">00</span></div><div id="timer_btn" class="d-flex flew-row justify-content-around col-12 mt-2"><i class="fas fa-play" id="play_btn" aria-hidden="true"></i><i class="fas fa-pause" id="pause_btn" aria-hidden="true"></i><i class="fas fa-step-forward" id="next_btn" aria-hidden="true"></i></div></div></div>
        </div>

        <div id="match_stat_period_display" class="mt-2">
            <div id="match_stat_period-bar" class="border border-primary rounded"></div>
            <button id="stat_all" class="period_btn btn btn-primary">Total</button>
        </div>

        <div id="match_stat_record" class="d-flex flex-row col-12 mt-2">
            <div id="stat_1stcol" class="col-6 d-flex flex-column">
            <div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Tirs</div><div id="shot" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div id="btnminus_shot_ok_2" class="col-2 text-right"><i class="far fa-minus-square" aria-hidden="true"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Tirs cadrés</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="shot_ok">0</span>&nbsp;&nbsp;<span id="shot_ok_percent">0%</span></div><div id="btnplus_shot_ok_2" class="col-2"><i class="far fa-plus-square" aria-hidden="true"></i></div></div><div class="stat_bar d-flex flex-row mb-3"><div id="btnminus_shot_nok_2" class="col-2 text-right"><i class="far fa-minus-square" aria-hidden="true"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Tirs non cadrés</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="shot_nok">0</span>&nbsp;&nbsp;<span id="shot_nok_percent">0%</span></div><div id="btnplus_shot_nok_2" class="col-2"><i class="far fa-plus-square" aria-hidden="true"></i></div></div><div class="stat_bar d-flex flex-row mb-3"><div id="btnminus_freekick_1" class="col-2 text-right"><i class="far fa-minus-square" aria-hidden="true"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Coup francs</div><div id="freekick" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div id="btnplus_freekick_1" class="col-2"><i class="far fa-plus-square" aria-hidden="true"></i></div></div><div class="stat_bar d-flex flex-row mb-3"><div id="btnminus_offside_1" class="col-2 text-right"><i class="far fa-minus-square" aria-hidden="true"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Hors jeu</div><div id="offside" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div id="btnplus_offside_1" class="col-2"><i class="far fa-plus-square" aria-hidden="true"></i></div></div><div class="stat_bar d-flex flex-row mb-3"><div id="btnminus_foul_1" class="col-2 text-right"><i class="far fa-minus-square" aria-hidden="true"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Fautes</div><div id="foul" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div id="btnplus_foul_1" class="col-2"><i class="far fa-plus-square" aria-hidden="true"></i></div></div></div>

            <div id="stat_2ndcol" class="col-6 d-flex flex-column">
            <div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Passes</div><div id="pass" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div id="btnminus_pass_ok_2" class="col-2 text-right"><i class="far fa-minus-square" aria-hidden="true"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Passes Réussies</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="pass_ok">0</span>&nbsp;&nbsp;<span id="pass_ok_percent">0%</span></div><div id="btnplus_pass_ok_2" class="col-2"><i class="far fa-plus-square" aria-hidden="true"></i></div></div><div class="stat_bar d-flex flex-row mb-3"><div id="btnminus_pass_nok_2" class="col-2 text-right"><i class="far fa-minus-square" aria-hidden="true"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Passes Ratées</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="pass_nok">0</span>&nbsp;&nbsp;<span id="pass_nok_percent">0%</span></div><div id="btnplus_pass_nok_2" class="col-2"><i class="far fa-plus-square" aria-hidden="true"></i></div></div><div class="stat_bar d-flex flex-row mb-3"><div id="btnminus_cornerkick_1" class="col-2 text-right"><i class="far fa-minus-square" aria-hidden="true"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Corner</div><div id="cornerkick" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div id="btnplus_cornerkick_1" class="col-2"><i class="far fa-plus-square" aria-hidden="true"></i></div></div><div class="stat_bar d-flex flex-row mb-3"><div id="btnminus_ball_ok_3" class="col-2 text-right"><i class="far fa-minus-square" aria-hidden="true"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Ballons gagnés</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="ball_ok">0</span>&nbsp;&nbsp;<span id="ball_ok_percent">0%</span></div><div id="btnplus_ball_ok_3" class="col-2"><i class="far fa-plus-square" aria-hidden="true"></i></div></div><div class="stat_bar d-flex flex-row mb-3"><div id="btnminus_ball_nok_3" class="col-2 text-right"><i class="far fa-minus-square" aria-hidden="true"></i></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Ballons perdus</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="ball_nok">0</span>&nbsp;&nbsp;<span id="ball_nok_percent">0%</span></div><div id="btnplus_ball_nok_3" class="col-2"><i class="far fa-plus-square" aria-hidden="true"></i></div></div></div>
        </div>

        <div id="match_stat_displaybyperiod" class="d-none">
            <div id="stat_1stcol_dbp" class="col-6 d-flex flex-column">
            <div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Tirs</div><div id="shot_dbp" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Tirs cadrés</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="shot_ok_match_stat_undefined">0</span>&nbsp;&nbsp;<span id="shot_ok_percent_dbp">0%</span></div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Tirs non cadrés</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="shot_nok_match_stat_undefined">0</span>&nbsp;&nbsp;<span id="shot_nok_percent_dbp">0%</span></div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Coup francs</div><div id="freekick_dbp" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Hors jeu</div><div id="offside_dbp" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Fautes</div><div id="foul_dbp" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div></div></div>

            <div id="stat_2ndcol_dbp" class="col-6 d-flex flex-column">
            <div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Passes</div><div id="pass_dbp" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Passes Réussies</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="pass_ok_match_stat_undefined">0</span>&nbsp;&nbsp;<span id="pass_ok_percent_dbp">0%</span></div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Passes Ratées</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="pass_nok_match_stat_undefined">0</span>&nbsp;&nbsp;<span id="pass_nok_percent_dbp">0%</span></div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Corner</div><div id="cornerkick_dbp" class="stat_bar-num col-2 border border-primary border-left-0">0</div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Ballons gagnés</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="ball_ok_dbp">0</span>&nbsp;&nbsp;<span id="ball_ok_percent_dbp">0%</span></div><div class="col-2"></div></div><div class="stat_bar d-flex flex-row mb-3"><div class="col-2"></div><div class="stat_bar-text col-6 bg-primary text-white border border-primary border-right-0 text-center">Ballons perdus</div><div class="stat_bar-num col-2 border border-primary border-left-0"><span id="ball_nok_dbp">0</span>&nbsp;&nbsp;<span id="ball_nok_percent_dbp">0%</span></div><div class="col-2"></div></div></div>
        </div>
    </div>

        </div>    
        
        <footer>
        </footer>
    </div>    
    <script src="/MyTeamStats/public/js/script.js"></script>
    <script src="/MyTeamStats/public/js/config.js"></script>
        <script src="/MyTeamStats/public/js/ajax.js"></script>
    <script src="/MyTeamStats/public/js/Score.js"></script>
    <script src="/MyTeamStats/public/js/Card.js"></script>
    <script src="/MyTeamStats/public/js/Stats.js"></script>
    <script src="/MyTeamStats/public/js/Chrono.js"></script>
    <script src="/MyTeamStats/public/js/MatchStats.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    

</body></html>