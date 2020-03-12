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
//require('router.php');

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
    $isAuthorized = False;
}

//// Routeur
//
//if (isset($_GET['action'])) {
//    if ($_GET['action'] == 'matchs'){
//
//    }
//
//    if ($_GET['action'] == 'userlogin'){
//        if ( isset($_POST['mail']) || isset($_POST['pwd']) ){
//            $controllerFront->UserLogin($_POST['mail'], $_POST['pwd']);
//        }
//        else {
//            echo "Vous devez saisir un mail et un mot de passe";
//        }
//    }
//

//
//    if ($_GET['action'] == 'adduser'){
//
//        $controllerFront->AddUser($_POST['lastname'], $_POST['firstname'], $_POST['mail'], $_POST['pwd1'] );
//    }
//
//    if ($_GET['action'] == 'deleteuser'){
//        if ($isAuthorized){
//            if (isset($_GET['id']) && $_GET['id'] > 0) {
//                $controllerBack->DeleteUser($_GET['id']);
//            }
//            else {
//                echo  "Erreur : pas d'id user";
//            }
//        }
//        else {
//            echo "Vous n'êtes pas autorisé à effectuer cette action";
//        }
//    }
//
//    if ($_GET['action'] == 'modifyuser'){
//        if (isset($_GET['id']) && $_GET['id'] > 0) {
//            $controllerBack->ModifyUser($_GET['id']);
//        }
//        else {
//            echo  "Erreur : pas d'id user";
//        }
//    }
//
//    if ($_GET['action'] == 'updateuser'){
//        if (isset($_GET['id']) && $_GET['id'] > 0) {
//            $controllerBack->UpdateUser($_GET['id'], $_POST['lastname'], $_POST['firstname'], $_POST['mail'], $_POST['status']);
//        }
//        else {
//            echo  "Erreur : pas d'id user";
//        }
//    }
//
//    if ($_GET['action'] == 'userslist'){
//
//        $controllerBack->UsersList();
//    }
//
//    if ($_GET['action'] == 'club'){
//
//        $controllerFront->Club();
//    }
//
//    if ($_GET['action'] == 'player'){


//    }
//
//    if ($_GET['action'] == 'deleteplayer'){
//        if ($isAuthorized){
//            if (isset($_GET['id']) && $_GET['id'] > 0) {
//                $controllerBack->DeletePlayer($_GET['id']);
//            }
//            else {
//                echo  "Erreur : pas d'id joueur";
//            }
//        }
//        else {
//            echo "Vous n'êtes pas autorisé à effectuer cette action";
//        }
//    }
//
//    if ($_GET['action'] == 'modifyplayer'){
//        if (isset($_GET['id']) && $_GET['id'] > 0) {
//            $controllerBack->ModifyPlayer($_GET['id']);
//        }
//        else {
//            echo  "Erreur : pas d'id joueur";
//        }
//    }
//
//    if ($_GET['action'] == 'updateplayer'){
//        if (isset($_GET['id']) && $_GET['id'] > 0) {
//            $controllerBack->UpdatePlayer($_GET['id'],$_POST['lastname'], $_POST['firstname'], $_POST['licencenum'], $_POST['activelicence'], $_POST['birthdate'], $_POST['category'], $_FILES['photo']['tmp_name'], $_POST['poste'], $_POST['address'],  $_POST['phonenum'], $_POST['mail']);
//        }
//        else {
//            echo  "Erreur : pas d'id joueur";
//        }
//    }
//
//    if ($_GET['action'] == 'createplayer'){
//
//        $controllerBack->CreatePlayer();
//    }
//
//    if ($_GET['action'] == 'addplayer'){
//        $controllerBack->AddPlayer($_POST['lastname'], $_POST['firstname'], $_POST['licencenum'], $_POST['activelicence'], $_POST['birthdate'], $_POST['category'], $_FILES['photo']['tmp_name'], $_POST['poste'], $_POST['address'],  $_POST['phonenum'], $_POST['mail']);
//    }
//
//
//    if ($_GET['action'] == 'creatematch'){
//
//        $controllerBack->CreateMatch();
//    }
//
//    if ($_GET['action'] == 'match'){
//
//        $controllerFront->Match();
//    }
//
//    if ($_GET['action'] == 'matchstat'){
//
//        $controllerBack->MatchStat();
//    }
//
//    if ($_GET['action'] == 'sessionkill'){
//
//        $controllerFront->SessionKill();
//    }
//
//    if ($_GET['action'] == 'admin'){
//
//        $controllerBack->Admin();
//    }
//
//    if ($_GET['action'] == 'createoppo'){
//
//        $controllerBack->CreateOppo();
//    }
//
//    if ($_GET['action'] == 'addoppo'){
//
//        $controllerBack->AddOppo($_POST['name'], $_FILES['logo']['tmp_name']);
//    }
//
//    if ($_GET['action'] == 'oppolist'){
//
//        $controllerBack->OppoList();
//    }
//
//    if ($_GET['action'] == 'modifyoppo'){
//        if (isset($_GET['id']) && $_GET['id'] > 0) {
//            $controllerBack->ModifyOppo($_GET['id']);
//        }
//        else {
//            echo "Erreur : pas d'id oppo";
//        }
//    }
//
//    if ($_GET['action'] == 'updateoppo'){
//        if (isset($_GET['id']) && $_GET['id'] > 0) {
//            $controllerBack->UpdateOppo($_GET['id'], $_POST['name'], $_FILES['logo']['tmp_name']);
//        }
//        else {
//            echo "Erreur : pas d'id oppo";
//        }
//    }
//
//    if ($_GET['action'] == 'deleteoppo'){
//        if ($isAuthorized){
//            if (isset($_GET['id']) && $_GET['id'] > 0) {
//                $controllerBack->DeleteOppo($_GET['id']);
//            }
//            else {
//                echo  "Erreur : pas d'id oppo";
//            }
//        }
//        else {
//            echo "Vous n'êtes pas autorisé à effectuer cette action";
//        }
//    }
//
//}
//else {
//
//    $controllerFront->Home();
//}

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    // FrontEnd
        // Home
    $r->addRoute('GET', '/MyTeamStats/', 'controllerFront/Home');
        // Player
    $r->addRoute('GET', '/MyTeamStats/PlayersList', 'controllerFront/PlayersList');
    $r->addRoute('GET', '/MyTeamStats/Player/{id:[0-9]+}', 'controllerFront/Player');
        // Match
    $r->addRoute('GET', '/MyTeamStats/MatchsList', 'controllerFront/MatchsList');
    $r->addRoute('GET', '/MyTeamStats/Match/{id:[0-9]+}', 'controllerFront/Match');
        // Club
    $r->addRoute('GET', '/MyTeamStats/Club', 'controllerFront/Club');
        // USER
    $r->addRoute('GET', '/MyTeamStats/Login', 'controllerFront/Login');
    $r->addRoute('GET', '/MyTeamStats/CreateUser', 'controllerFront/CreateUser');
    $r->addRoute('GET', '/MyTeamStats/LostPassword', 'controllerFront/LostPassword');
    $r->addRoute('GET', '/MyTeamStats/SessionKill', 'controllerFront/SessionKill');
    $r->addRoute('POST', '/MyTeamStats/UserLogin', 'controllerFront/UserLogin');



    // BackEnd
        // Player
    $r->addRoute('GET', '/MyTeamStats/UpdatePlayer/{id:[0-9]+}', 'controllerBack/UpdatePlayer');
    // {id} must be a number (\d+)
    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    // The /{title} suffix is optional
    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);


$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $vars += $_POST;
        $action = explode('/',$handler,2);
        $controller = $action[0];
        $method = $action[1];
        if ($controller == 'controllerFront'){
            $controllerFront->{$method}(...array_values($vars));
        }
        else {
            $controllerBack->{$method}(...array_values($vars));
        }

        break;
}
