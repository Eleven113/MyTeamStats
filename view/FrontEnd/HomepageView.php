<?php $title = 'Accueil - MyTeamStats'; ?>
<!-- <?php $script1= '<script src ="../public/js/tinymce.js"></script>'; ?> -->

<?php ob_start(); ?>

<div class="row mt-5">
    <div class="row offset-1 col-10">
        <div class="col-5">
            <div class="embed-responsive embed-responsive-1by1 text-center">
                <div class="embed-responsive-item bg-primary rounded-lg">
                    <a href="index.php?action=playerslist" class="link">
                        <div class="menu_option">
                            <span class="menu_option-ico"><i class="fas fa-users"></i></span><br/>
                            <span class="menu_option-txt">Effectif</span>
                        </div>              
                    </a>   
                </div>
            </div>
        </div>     
        <div class="offset-2 col-5">
            <div class="embed-responsive embed-responsive-1by1 text-center align-middle">
                <div class="embed-responsive-item bg-primary rounded-lg">
                    <a href="index.php?action=matchslist" class="link">
                        <div class="menu_option">
                                <span class="menu_option-ico"><i class="far fa-futbol"></i></span><br/>
                                <span class="menu_option-txt">Matchs</span>
                        </div>    
                    </a>                    
                </div>
            </div>
        </div>
    </div>    
</div>

<div class="row mt-5 mb-5">
    <div class="row offset-1 justify-content-center col-10">
        <div class="col-5">
            <div class="embed-responsive embed-responsive-1by1 text-center">
                <div class="embed-responsive-item bg-primary rounded-lg">
                    <a href="index.php?action=club" class="link">
                        <div class="menu_option">
                            <span class="menu_option-ico"><i class="fas fa-clipboard-list"></i></span><br/>
                            <span class="menu_option-txt">Infos Club</span>
                        </div>     
                    </a>             
                </div>
            </div>
        </div>
    </div>    
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>