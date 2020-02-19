<?php $title = 'Match - MyTeamStats'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>

<div id="match" class="d-flex flex-column col-10 offset-1 align-items-center">

    <h3 id="match_name">E113 FC - Stade Lavallois</h3>
    <h5 id="match_date">Le 10/10/2020 à 14h30</h5>

    <div id="match_teams" class="d-flex flex-row justify-content-center">
        <div id="match_team_home" class="d-flex flex-column align-items-center col-6">
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
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>