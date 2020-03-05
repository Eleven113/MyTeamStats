<?php
session_start();

require ('vendor/autoload.php');
require ('controller/FrontEnd/controller.php');
require ('controller/BackEnd/controller.php');
require ('model/Player.php');
require ('model/PlayerManager.php');
require ('model/PlayerManagerPDO.php');
require ('model/DBFactory.php');

$db = DBFactory::ConnexionPDO();
$playerManager = new PlayerManager($db);

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/view');
$twig = new \Twig\Environment($loader, [
    'cache' => false
]);

$controllerFront = new ControllerFront($twig, $playerManager);
$controllerBack = new ControllerBack($twig, $playerManager);


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'matchs'){
        if ($_SESSION['admin_user'] == TRUE){
            AdminMatchs();
        }
        else {
            PublicMatchs();
        }
    }

    if ($_GET['action'] == 'playerslist'){

        $controllerFront->PlayersList();
    }

    if ($_GET['action'] == 'login'){

        $controllerFront->Login();
    }

    if ($_GET['action'] == 'lostpassword'){

        $controllerFront->LostPassword();
    }

    if ($_GET['action'] == 'createaccount'){

        $controllerFront->CreateAccount();
    }

    if ($_GET['action'] == 'matchslist'){

        $controllerFront->MatchsList();
    }

    if ($_GET['action'] == 'club'){

        $controllerFront->Club();
    }

    if ($_GET['action'] == 'player'){
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $controllerFront->Player($_GET['id']);
        }
        else {
            echo  "Erreur : pas d'id joueur";
        }
    }

    if ($_GET['action'] == 'deleteplayer'){
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $controllerBack->DeletePlayer($_GET['id']);
        }
        else {
            echo  "Erreur : pas d'id joueur";
        }
    }

    if ($_GET['action'] == 'modifyplayer'){
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $controllerBack->ModifyPlayer($_GET['id']);
        }
        else {
            echo  "Erreur : pas d'id joueur";
        }
    }

    if ($_GET['action'] == 'updateplayer'){
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $controllerBack->UpdatePlayer($_GET['id'],$_POST['lastname'], $_POST['firstname'], $_POST['licencenum'], $_POST['activelicence'], $_POST['birthdate'], $_POST['category'], $_FILES['photo']['name'], $_POST['poste'], $_POST['address'],  $_POST['phonenum'], $_POST['mail']);
        }
        else {
            echo  "Erreur : pas d'id joueur";
        }
    }

    if ($_GET['action'] == 'createplayer'){

        $controllerBack->CreatePlayer();
    }

    if ($_GET['action'] == 'addplayer'){
        $controllerBack->AddPlayer($_POST['lastname'], $_POST['firstname'], $_POST['licencenum'], $_POST['activelicence'], $_POST['birthdate'], $_POST['category'], $_FILES['photo']['name'], $_POST['poste'], $_POST['address'],  $_POST['phonenum'], $_POST['mail']);
    }


    if ($_GET['action'] == 'creatematch'){

        $controllerBack->CreateMatch();
    }

    if ($_GET['action'] == 'match'){

        $controllerFront->Match();
    }

    if ($_GET['action'] == 'matchstat'){

        $controllerBack->MatchStat();
    }

}
else {

    $controllerFront->Home();
}


