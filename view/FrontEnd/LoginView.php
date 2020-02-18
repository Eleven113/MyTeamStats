<?php $title = 'MyTeamStats - Accueil'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>

<div id="login_form" class="d-flex flex-column justify-content-center align-items-center">
    <div id="login-create">Première connexion ? <a href="index.php?action=createaccount">Créér un compte</a></div>
    <form id="login-form" class="col-lg-6">
        <legend>Connexion</legend>
        <div class="form-group">
            <label for="text"><i class="fas fa-at"></i>&nbsp;&nbsp;adresse mail</label>
            <input id="text" type="text" name="mail" class="form-control">        
        </div>
        <div class="form-group">
            <label for="text"><i class="fas fa-key"></i>&nbsp;&nbsp;mot de passe</label>
            <input id="text" type="text" name="mdp" class="form-control">
        </div>    
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
    <div id="login-create"><a href="index.php?action=lostpassword">Mot de passe oublié ?</a></div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>