<?php
session_start();

require('controller/FrontEnd/controller.php');
require('controller/BackEnd/controller.php');

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
        $controllerFront->PlayersList();
    }

    if ($_GET['action'] == 'login'){
        $controllerFront = new ControllerFront();
        $controllerFront->Login();
    }

    if ($_GET['action'] == 'lostpassword'){
        $controllerFront = new ControllerFront();
        $controllerFront->LostPassword();
    }

    if ($_GET['action'] == 'createaccount'){
        $controllerFront = new ControllerFront();
        $controllerFront->CreateAccount();
    }

    if ($_GET['action'] == 'matchslist'){
        $controllerFront = new ControllerFront();
        $controllerFront->MatchsList();
    }

    if ($_GET['action'] == 'club'){
        $controllerFront = new ControllerFront();
        $controllerFront->Club();
    }

    if ($_GET['action'] == 'player'){
        $controllerFront = new ControllerFront();
        $controllerFront->Player();
    }

    if ($_GET['action'] == 'createplayer'){
        $controllerBack = new ControllerBack();
        $controllerBack->CreatePlayer();
    }

    if ($_GET['action'] == 'creatematch'){
        $controllerBack = new ControllerBack();
        $controllerBack->CreateMatch();
    }

    if ($_GET['action'] == 'match'){
        $controllerFront = new ControllerFront();
        $controllerFront->Match();
    }

}
else {
    $controllerFront = new ControllerFront();
    $controllerFront->Home();
}

