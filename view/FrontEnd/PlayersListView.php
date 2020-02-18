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
                <th id="table_licencenum">N° Licence</th>
                <th id="table_surname">Nom</th>
                <th id="table_name">Prénom</th>
                <th id="table_birthdate">Date de naissance</th>
                <th id="table_licenced">Licencié.e ?</th>
                <th id="table_options">Options</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>123456</td>
                <td>Neymar</td>
                <td>Jean</td>
                <th>26/09/1984</td>
                <td>yes</td>
                <td><i class="fas fa-user-edit"></i>&nbsp;&nbsp;<i class="fas fa-trash-alt"></i></td>
            </tr>
            <tr>
                <td>123456</td>
                <td>Neymar</td>
                <td>Jean</td>
                <th>26/09/1984</td>
                <td>yes</td>
                <td>buttons</td>
            </tr>
            <tr>
                <td>123456</td>
                <td>Neymar</td>
                <td>Jean</td>
                <th>26/09/1984</td>
                <td>yes</td>
                <td>buttons</td>
            </tr>
            <tr>
                <td>123456</td>
                <td>Neymar</td>
                <td>Jean</td>
                <th>26/09/1984</td>
                <td>yes</td>
                <td>buttons</td>
            </tr>
            <tr>
                <td>123456</td>
                <td>Neymar</td>
                <td>Jean</td>
                <th>26/09/1984</td>
                <td>yes</td>
                <td>buttons</td>
            </tr>
            <tr>
                <td>123456</td>
                <td>Neymar</td>
                <td>Jean</td>
                <th>26/09/1984</td>
                <td>yes</td>
                <td>buttons</td>
            </tr>
            <tr>
                <td>123456</td>
                <td>Neymar</td>
                <td>Jean</td>
                <th>26/09/1984</td>
                <td>yes</td>
                <td>buttons</td>
            </tr>
        </tbody>
    </table>
</div>    

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>