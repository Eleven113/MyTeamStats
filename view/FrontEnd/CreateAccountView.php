<?php $title = 'MyTeamStats - Accueil'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>

<div id="createaccount_form" class="d-flex flex-column justify-content-center align-items-center">
    <form id="createaccount-form" class="col-lg-6">
        <legend>Connexion</legend>
        <div class="form-group">
            <label for="text">Nom</label>
            <input id="text" type="text" name="surname" class="form-control">        
        </div>
        <div class="form-group">
            <label for="text">Prénom</label>
            <input id="text" type="text" name="surname" class="form-control">        
        </div>
        <div class="form-group">
            <label for="text"><i class="fas fa-at"></i>&nbsp;&nbsp;Adresse mail</label>
            <input id="text" type="text" name="mail" class="form-control">        
        </div>
        <div class="form-group">
            <label for="text"><i class="fas fa-key"></i>&nbsp;&nbsp;Entrer un mot de passe</label>
            <input id="text" type="text" name="mdp" class="form-control">
        </div>
        <div class="form-group">
            <label for="text"><i class="fas fa-key"></i>&nbsp;&nbsp;Confirmer le mot de passe</label>
            <input id="text" type="text" name="mdp" class="form-control">
        </div>    
        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;Envoyer</button>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>