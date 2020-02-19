<?php $title = 'Infos Joueur - MyTeamStats'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>

<div id="player" class="d-flex flex-column col-8 offset-2 align-items-center">
    <h3 id="player_name">Chloé MINARD</h3>
    <div id="player_photo" class="d-flex flex-column align-items-center">
        <div class="col-6">
            <img src="public/img/players/cminard.jpg" class="img-responsive fit-image">
        </div>
    </div>
    <div id="player_data" class="m-4 p-4 border border-primary rounded-lg myborder">
        <p id="player_licence">
            <span class="player_data-title font-weight-bold">N° Licence :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="player_data-txt">123456</span>
        </p>
        <p id="player_position">
            <span class="player_data-title font-weight-bold">Poste :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="player_data-txt">Milieu gauche</span>
        </p>
        <p id="player_goal">
            <span class="player_data-title font-weight-bold">But(s) marqué(s) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="player_data-txt">4 (saison en cours) - 14 au total</span>
        </p>
        <p id="player_pass">
            <span class="player_data-title font-weight-bold">Passe(s) décisive(s) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="player_data-txt">10 (saison en cours) - 30 au total</span>
        </p>
        <p id="player_card">
            <span class="player_data-title font-weight-bold">Carton(s) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="player_data-txt">0 Jaune - 0 Rouge</span>
        </p>
        <div id="player_coord">
        </div>
    </div>    
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>