<?php $title = 'MyTeamStats - Accueil'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>

<div class="row">
    <div id="menu_team" class="col-md-offset-1 col-md-4">Effectif</div>
    <div id="menu_players" class="col-md-offset-3 col-md-4 col-md-push-1">Joueurs</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>