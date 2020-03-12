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

// Router

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
        // User
    $r->addRoute('GET', '/MyTeamStats/Login', 'controllerFront/Login');
    $r->addRoute('GET', '/MyTeamStats/CreateUser', 'controllerFront/CreateUser');
    $r->addRoute('GET', '/MyTeamStats/LostPassword', 'controllerFront/LostPassword');
    $r->addRoute('GET', '/MyTeamStats/SessionKill', 'controllerFront/SessionKill');
    $r->addRoute('POST', '/MyTeamStats/UserLogin', 'controllerFront/UserLogin');


    // BackEnd
        // Admin
    $r->addRoute('GET', '/MyTeamStats/Admin', 'controllerBack/Admin');
        // Player
    $r->addRoute('GET', '/MyTeamStats/CreatePlayer', 'controllerBack/CreatePlayer');
    $r->addRoute('POST', '/MyTeamStats/AddPlayer', 'controllerBack/AddPlayer');
    $r->addRoute('GET', '/MyTeamStats/ModifyPlayer/{id:[0-9]+}', 'controllerBack/ModifyPlayer');
    $r->addRoute('POST', '/MyTeamStats/UpdatePlayer/{id:[0-9]+}', 'controllerBack/UpdatePlayer');
    $r->addRoute('GET', '/MyTeamStats/DeletePlayer/{id:[0-9]+}', 'controllerBack/DeletePlayer');
        // Match

        // Oppo
    $r->addRoute('GET', '/MyTeamStats/OppoList', 'controllerBack/OppoList');
    $r->addRoute('GET', '/MyTeamStats/CreateOppo', 'controllerBack/CreateOppo');
    $r->addRoute('POST', '/MyTeamStats/AddOppo', 'controllerBack/AddOppo');
    $r->addRoute('GET', '/MyTeamStats/ModifyOppo/{id:[0-9]+}', 'controllerBack/ModifyOppo');
    $r->addRoute('POST', '/MyTeamStats/UpdateOppo/{id:[0-9]+}', 'controllerBack/UpdateOppo');
    $r->addRoute('GET', '/MyTeamStats/DeleteOppo/{id:[0-9]+}', 'controllerBack/DeleteOppo');
        // Club

        // User
    $r->addRoute('GET', '/MyTeamStats/UsersList', 'controllerBack/UsersList');
    $r->addRoute('GET', '/MyTeamStats/ModifyUser/{id:[0-9]+}', 'controllerBack/ModifyUser');
    $r->addRoute('POST', '/MyTeamStats/UpdateUser/{id:[0-9]+}', 'controllerBack/UpdateUser');
    $r->addRoute('GET', '/MyTeamStats/DeleteUser/{id:[0-9]+}', 'controllerBack/DeleteUser');


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
        $vars += $_FILES;
        $action = explode('/',$handler,2);
        $controller = $action[0];
        $method = $action[1];

        if ($controller == 'controllerFront'){
            $controllerFront->{$method}(...array_values($vars));
        }
        else {
            if ($_SESSION['user_status'] >= 3){
                $controllerBack->{$method}(...array_values($vars));
            }
            else {
                echo "Vous n'êtes pas autorisé à effectuer cette action";
            }
        }

        break;
}
