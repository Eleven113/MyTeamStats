<?php $title = 'MyTeamStats - Accueil'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>
<div class="table-responsive">
    <table class="table table table-bordered table-striped text-center">
        <caption class="text-center">
            <h4>Liste des joueurs</h4>
        </caption>
        <thead>
            <tr>
                <th id="table_category">Catégorie</th>
                <th id="table_opponent">Adversaire</th>
                <th id="table_place">Lieu</th>
                <th id="table_date">Date</th>
                <th id="table_status">Statut</th>
                <th id="table_options">Options</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>U15F</td>
                <td>Argentré</td>
                <td>Domicile</td>
                <th>26/09/2020</td>
                <td>A venir</td>
                <td><i class="fas fa-user-edit"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-trash-alt"></i></td>
            </tr>
            <tr>
                <td>U15F</td>
                <td>Argentré</td>
                <td>Domicile</td>
                <th>26/09/2020</td>
                <td>A venir</td>
                <td><i class="fas fa-user-edit"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-trash-alt"></i></td>
            </tr>
            <tr>
                <td>U15F</td>
                <td>Argentré</td>
                <td>Domicile</td>
                <th>26/09/2020</td>
                <td>A venir</td>
                <td><i class="fas fa-user-edit"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-trash-alt"></i></td>
            </tr>
            <tr>
                <td>U15F</td>
                <td>Argentré</td>
                <td>Domicile</td>
                <th>26/09/2020</td>
                <td>A venir</td>
                <td><i class="fas fa-user-edit"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-trash-alt"></i></td>
            </tr>
            <tr>
                <td>U15F</td>
                <td>Argentré</td>
                <td>Domicil</td>
                <th>26/09/2020</td>
                <td>A venir</td>
                <td><i class="fas fa-user-edit"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-trash-alt"></i></td>
            </tr>
            <tr>
                <td>U15F</td>
                <td>Argentré</td>
                <td>Domicile</td>
                <th>26/09/2020</td>
                <td>A venir</td>
                <td><i class="fas fa-user-edit"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-trash-alt"></i></td>
            </tr>
            <tr>
                <td>U15F</td>
                <td>Argentré</td>
                <td>Domicile</td>
                <th>26/09/2020</td>
                <td>A venir</td>
                <td><i class="fas fa-user-edit"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-trash-alt"></i></td>
            </tr>
        </tbody>
    </table>
</div>    

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>