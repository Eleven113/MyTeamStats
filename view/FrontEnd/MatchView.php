<?php $title = 'Match - MyTeamStats'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>

<div id="match" class="d-flex flex-column col-10 offset-1 align-items-center">

    <h3 id="match_name">E113 FC - Stade Lavallois</h3>
    <h5 id="match_date">Le 10/10/2020 à 14h30</h5>

    <div id="match_teams" class="d-flex flex-row justify-content-center">
        <div id="match_team_home" class="d-flex flex-column align-items-center justify-content-end col-6">
            <div id ="match_team_home-logo" class="col-6">
                <img src="public/img/logo.png" class="img-responsive fit-image">
            </div>
            <div id ="match_team_home-name">
                E113 Football Club
            </div>
        </div>
        <div id="match_team_away" class="d-flex flex-column align-items-center col-6">
            <div id ="match_team_away-logo" class="col-6">
                <img src="public/img/logo_sl.svg" class="img-responsive fit-image">
            </div>
            <div id ="match_team_away-name">
                Stade Lavallois
            </div>
        </div>
    </div>
    
    <div id="match_data" class="m-4 p-4 col-8 border border-primary rounded-lg myborder">
        <p id="match_address">
            <span class="player_data-title font-weight-bold">Adresse :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="player_data-txt">28 rue des cèpes 53210 Argentré</span>
        </p>
        <p id="match_field">
            <span class="player_data-title font-weight-bold">Pelouse :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="player_data-txt">Naturelle</span>
        </p>
        <p id="match_meteo">
            <span class="player_data-title font-weight-bold">Prévision météo :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="player_data-txt">Soleil</span>
        </p>
    </div>  

    <div id="match_player" class="m-4 p-4 col-8 border border-primary rounded-lg myborder">
        <div id="match_player-title">Joueurs convoqués</div>
        <ul>
            <li>Nom Prénom</li>
            <li>Nom Prénom</li>
            <li>Nom Prénom</li>
            <li>Nom Prénom</li>
            <li>Nom Prénom</li>
            <li>Nom Prénom</li>
            <li>Nom Prénom</li>
            <li>Nom Prénom</li>
            <li>Nom Prénom</li>
            <li>Nom Prénom</li>
            <li>Nom Prénom</li>
        </ul>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>