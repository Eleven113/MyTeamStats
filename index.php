<?php
session_start();

require ('vendor/autoload.php');
require ('controller/FrontEnd/controller.php');
require ('controller/BackEnd/controller.php');

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/view');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

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
        $controllerFront = new ControllerFront();
        $controllerFront->PlayersList($twig);
    }

    if ($_GET['action'] == 'login'){
        $controllerFront = new ControllerFront();
        $controllerFront->Login($twig);
    }

    if ($_GET['action'] == 'lostpassword'){
        $controllerFront = new ControllerFront();
        $controllerFront->LostPassword($twig);
    }

    if ($_GET['action'] == 'createaccount'){
        $controllerFront = new ControllerFront();
        $controllerFront->CreateAccount($twig);
    }

    if ($_GET['action'] == 'matchslist'){
        $controllerFront = new ControllerFront();
        $controllerFront->MatchsList($twig);
    }

    if ($_GET['action'] == 'club'){
        $controllerFront = new ControllerFront();
        $controllerFront->Club($twig);
    }

    if ($_GET['action'] == 'player'){
        $controllerFront = new ControllerFront();
        $controllerFront->Player($twig);
    }

    if ($_GET['action'] == 'createplayer'){
        $controllerBack = new ControllerBack();
        $controllerBack->CreatePlayer($twig);
    }

    if ($_GET['action'] == 'creatematch'){
        $controllerBack = new ControllerBack();
        $controllerBack->CreateMatch($twig);
    }

    if ($_GET['action'] == 'match'){
        $controllerFront = new ControllerFront();
        $controllerFront->Match($twig);
    }

    if ($_GET['action'] == 'matchstat'){
        $controllerBack = new ControllerBack();
        $controllerBack->MatchStat($twig);
    }

}
else {
    $controllerFront = new ControllerFront();
    $controllerFront->Home($twig);
}



// echo $twig->render('/FrontEnd/Homepage.twig');