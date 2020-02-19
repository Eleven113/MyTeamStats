<?php $title = 'Créér Match - MyTeamStats'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>

<div id="creatematch_form" class="d-flex flex-column justify-content-center align-items-center">
    <form id="createapmatch-form" class="col-lg-6">
        <legend>Créér un joueur</legend>
        <div class="form-group">
            <label for="text">Compétition</label>
            <select>
                <option>Championnat</option>
                <option>Coupe</option>
                <option>Tournoi</option>
                <option>Futsal</option>
                <option>Amical</option>
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
            <label for="text">Adversaire</label>
            <input id="text" type="text" name="opponent" class="form-control" required>        
        </div>
        <div>
            <input type="radio" id="where" name="where" value="home" checked>
            <label for="home">Domicile</label>
            <input type="radio" id="where" name="where" value="away">
            <label for="away">Extérieur</label>
        <div class="form-group">
            <label for="text">Adresse</label>
            <input id="text" type="text" name="address" class="form-control">        
        </div>
        <div class="form-group">
            <label for="text">Date</label>
            <input id="date" type="datetime-local" name="address" class="form-control">        
        </div>  
        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;Envoyer</button>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>