<?php $title = 'Infos Club - MyTeamStats'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>

<div id="club" class="d-flex flex-column col-8 offset-2 align-items-center">
    <h3 id="club_name">E113 Football Club</h3>
    <div id="club_logo_soclink" class="d-flex flex-column align-items-center">
        <div id="club_logo" class="row">
            <div class="offset-3 col-6">
                <img src="public/img/logo.png" class="img-responsive fit-image">
            </div>
        </div>
        <div id="club_soclink" class="text-primary">
            <a href="#"><i class="fab fa-facebook-square"></i></a>
            <a href="#"><i class="fab fa-twitter-square"></i></a>
            <a href="#"><i class="fab fa-instagram-square"></i></a>
            <a href="#"><i class="fab fa-youtube-square"></i></a>
        </div>
    </div>
    <div id="club_data" class="m-4">
        <p id="club_pres">
            <span class="club_data-title font-weight-bold">Président :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="club_data-txt">Thibaut MINARD</span>
        </p>
        <p id="club_hq">
            <span class="club_data-title font-weight-bold">Siège social :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="club_data-txt">28 rue des cépes 53210 Argentré</span>
        </p>
        <p id="club_tel">
            <span class="club_data-title font-weight-bold">Téléphone :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="club_data-txt">06 07 08 09 10 11</span>
        </p>
        <p id="club_mail">
            <span class="club_data-title font-weight-bold">Mail :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="club_data-txt">contact@e113-fc.fr</span>
        </p>
        <p id="club_website"">
            <span class="club_data-title font-weight-bold">Site internet :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="club_data-txt">www.e133-fc.fr</span>
        </p>
    </div>    
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>