<?php
session_start();

require ('vendor/autoload.php');
require ('controller/FrontEnd/controller.php');
require ('controller/BackEnd/controller.php');
require('model/Player/Player.php');
require('model/Player/PlayerManager.php');
require('model/User/UserManager.php');
require('model/User/User.php');
require('model/Opponent/Opponent.php');
require('model/Opponent/OpponentManager.php');
require ('model/DBFactory.php');

$db = DBFactory::ConnexionPDO();
$playerManager = new PlayerManager($db);
$userManager = new UserManager($db);
$opponentManager = new OpponentManager($db);

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/view');
$twig = new \Twig\Environment($loader, [
    'cache' => false
]);
$twig->addGlobal('session', $_SESSION);
$twig->addGlobal('env', $_ENV);

$controllerFront = new ControllerFront($twig, $playerManager, $userManager);
$controllerBack = new ControllerBack($twig, $playerManager, $userManager, $opponentManager);

\Cloudinary::config( array (
    "cloud_name" => "marthyte" ,
    "api_key" => "284172277764297" ,
    "api_secret" => "FymxxaeAwKJB9bVn-2J5cFozT4k" ,
    "secure" => true
));

// Vérifie le statut de l'utilisateur pour protéger la saisie via URL

if ( $_SESSION['user_status'] >= 3){
    $isAuthorized = True;
}
else {
    $isAuthorized = false;
}

// Routeur

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'matchs'){

    }

    if ($_GET['action'] == 'playerslist'){

        $controllerFront->PlayersList();
    }

    if ($_GET['action'] == 'login'){

        $controllerFront->Login();
    }

    if ($_GET['action'] == 'userlogin'){
        if ( isset($_POST['mail']) || isset($_POST['pwd']) ){
            $controllerFront->UserLogin($_POST['mail'], $_POST['pwd']);
        }
        else {
            echo "Vous devez saisir un mail et un mot de passe";
        }
    }

    if ($_GET['action'] == 'lostpassword'){

        $controllerFront->LostPassword();
    }

    if ($_GET['action'] == 'createuser'){

        $controllerFront->CreateUser();
    }

    if ($_GET['action'] == 'adduser'){

        $controllerFront->AddUser($_POST['lastname'], $_POST['firstname'], $_POST['mail'], $_POST['pwd1'] );
    }

    if ($_GET['action'] == 'deleteuser'){
        if ($isAuthorized){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controllerBack->DeleteUser($_GET['id']);
            }
            else {
                echo  "Erreur : pas d'id user";
            }
        }
        else {
            echo "Vous n'êtes pas autorisé à effectuer cette action";
        }
    }

    if ($_GET['action'] == 'modifyuser'){
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $controllerBack->ModifyUser($_GET['id']);
        }
        else {
            echo  "Erreur : pas d'id user";
        }
    }

    if ($_GET['action'] == 'updateuser'){
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $controllerBack->UpdateUser($_GET['id'], $_POST['lastname'], $_POST['firstname'], $_POST['mail'], $_POST['status']);
        }
        else {
            echo  "Erreur : pas d'id user";
        }
    }

    if ($_GET['action'] == 'userslist'){

        $controllerBack->UsersList();
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
        if ($isAuthorized){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controllerBack->DeletePlayer($_GET['id']);
            }
            else {
                echo  "Erreur : pas d'id joueur";
            }
        }
        else {
            echo "Vous n'êtes pas autorisé à effectuer cette action";
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
            $controllerBack->UpdatePlayer($_GET['id'],$_POST['lastname'], $_POST['firstname'], $_POST['licencenum'], $_POST['activelicence'], $_POST['birthdate'], $_POST['category'], $_FILES['photo']['tmp_name'], $_POST['poste'], $_POST['address'],  $_POST['phonenum'], $_POST['mail']);
        }
        else {
            echo  "Erreur : pas d'id joueur";
        }
    }

    if ($_GET['action'] == 'createplayer'){

        $controllerBack->CreatePlayer();
    }

    if ($_GET['action'] == 'addplayer'){
        $controllerBack->AddPlayer($_POST['lastname'], $_POST['firstname'], $_POST['licencenum'], $_POST['activelicence'], $_POST['birthdate'], $_POST['category'], $_FILES['photo']['tmp_name'], $_POST['poste'], $_POST['address'],  $_POST['phonenum'], $_POST['mail']);
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

    if ($_GET['action'] == 'sessionkill'){

        $controllerFront->SessionKill();
    }

    if ($_GET['action'] == 'admin'){

        $controllerBack->Admin();
    }

    if ($_GET['action'] == 'createoppo'){

        $controllerBack->CreateOppo();
    }

    if ($_GET['action'] == 'addoppo'){

        $controllerBack->AddOppo($_POST['name'], $_FILES['logo']['tmp_name']);
    }

    if ($_GET['action'] == 'oppolist'){

        $controllerBack->OppoList();
    }

    if ($_GET['action'] == 'modifyoppo'){

        $controllerBack->ModifyOppo($_GET['id']);
    }

    if ($_GET['action'] == 'updateoppo'){

        $controllerBack->UpdateOppo($_GET['id'], $_POST['name'], $_FILES['logo']['tmp_name']);
    }

}
else {

    $controllerFront->Home();
}


