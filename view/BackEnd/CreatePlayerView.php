<?php $title = 'Créér Joueur - MyTeamStats'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>

<div id="createplayer_form" class="d-flex flex-column justify-content-center align-items-center">
    <form id="createaplayer-form" class="col-lg-6">
        <legend>Créér un joueur</legend>
        <div class="form-group">
            <label for="text">Nom</label>
            <input id="text" type="text" name="surname" class="form-control" required>        
        </div>
        <div class="form-group">
            <label for="text">Prénom</label>
            <input id="text" type="text" name="name" class="form-control" required>        
        </div>
        <div class="form-group">
            <label for="text">N° Licence</label>
            <input id="text" type="number" name="licencenum" class="form-control">        
        </div>
        <div class="form-group">
            <label for="text">Licence active ?</label>
            <select>
                <option>Oui</option>
                <option>Non</option>
            </select>
        </div>
        <div class="form-group">
            <label for="text">Catégorie</label>
            <select>
                <option>U18</option>
                <option>U15</option>
            </select>
        </div>
        <div class="form-group">
            <label for="text">Ajouter une photo</label>
            <input id="text" type="file" name="photo" class="form-control">        
        </div>
        <div class="form-group">
            <label for="text">Poste</label>
            <input id="text" type="number" name="licencenum" class="form-control">        
        </div>  
        <div class="form-group">
            <label for="text">Adresse</label>
            <input id="text" type="text" name="address" class="form-control">        
        </div>  
        <div class="form-group">
            <label for="text">Téléphone</label>
            <input id="text" type="number" name="phonenum" class="form-control">        
        </div>  
        <div class="form-group">
            <label for="text">Mail</label>
            <input id="text" type="mail" name="mail" class="form-control">        
        </div>  
        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;Envoyer</button>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>