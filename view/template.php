<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <meta property="og:title" content="MyTeamStats" />
    <meta property="og:type" content="Website" />
    <meta property="og:url" content="http://www.thibaut-minard.fr/MyTeamStats/" />
    <meta property="og:image" content="http://www.thibaut-minard.fr/blog/public/img/og_pic.jpg" />
    <meta property="og:description" content="Gestion d'équipe / Statistiques">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">   
    <link href="public/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="public/css/style_mobile.css" />
    <script src="https://kit.fontawesome.com/5fbf6a0223.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <header class="row">
            <!-- <div class="col-md-1"><i class="fas fa-bars"></i></div>
            <div class="col-md-offset-2 col-md-3"><i class="fas fa-user"></i>&nbsp;&nbsp;Connexion</div>     -->
            <div class="col-lg-3">3 colonnes</div>
            <div class="col-lg-offset-6 col-lg-3">3 colonnes</div>
        </header>

        <div id="main">
            <?= $content ?>
        </div>    
        
        <footer>
        </footer>
    </div>    
    <div class="container">
      <div class="row">
        <div class="col-lg-3">3 colonnes</div>
        <div class="col-lg-6">6 colonnes</div>
        <div class="col-lg-3">3 colonnes</div>
      </div>
      <div class="row">
        <div class="col-lg-3">3 colonnes</div>
        <div class="col-lg-offset-6 col-lg-3">3 colonnes</div>
      </div>
    </div>
    <script src="public/js/script.js"></script>
    <?= $script ?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</body>
</html>