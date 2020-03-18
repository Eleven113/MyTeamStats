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
require('model/Match/Match.php');
require('model/Match/MatchDisplay.php');
require('model/Match/MatchManager.php');
require('model/Composition/Composition.php');
require('model/Composition/CompositionManager.php');
require('model/Field/Field.php');
require('model/Field/FieldManager.php');
require ('model/DBFactory.php');
//require('router.php');

$db = DBFactory::ConnexionPDO();

$playerManager = new PlayerManager($db);
$userManager = new UserManager($db);
$opponentManager = new OpponentManager($db);
$matchManager = new MatchManager($db);
$fieldManager = new FieldManager($db);
$compositionManager = new CompositionManager($db);

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/view');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());
$twig->addGlobal('session', $_SESSION);
$twig->addGlobal('env', $_ENV);

$controllerFront = new ControllerFront($twig, $playerManager, $userManager, $opponentManager, $matchManager, $fieldManager, $compositionManager);
$controllerBack = new ControllerBack($twig, $playerManager, $userManager, $opponentManager, $matchManager, $fieldManager, $compositionManager);

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
    $r->addRoute('POST', '/MyTeamStats/AddUser', 'controllerFront/AddUser');
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
    $r->addRoute('GET', '/MyTeamStats/CreateMatch', 'controllerBack/CreateMatch');
    $r->addRoute('POST', '/MyTeamStats/AddMatch', 'controllerBack/AddMatch');
    $r->addRoute('GET', '/MyTeamStats/ModifyMatch/{id:[0-9]+}', 'controllerBack/ModifyMatch');
    $r->addRoute('POST', '/MyTeamStats/UpdateMatch/{id:[0-9]+}', 'controllerBack/UpdateMatch');
    $r->addRoute('GET', '/MyTeamStats/DeleteMatch/{id:[0-9]+}', 'controllerBack/DeleteMatch');
    $r->addRoute('GET', '/MyTeamStats/MatchStats/{id:[0-9]+}', 'controllerBack/MatchStats');


        // Composition
    $r->addRoute('GET', '/MyTeamStats/Composition/{id:[0-9]+}', 'controllerBack/Composition');
    $r->addRoute('GET', '/MyTeamStats/CreateComposition/{id:[0-9]+}', 'controllerBack/CreateComposition');
    $r->addRoute('POST', '/MyTeamStats/AddComposition/{id:[0-9]+}', 'controllerBack/AddComposition');
    $r->addRoute('GET', '/MyTeamStats/ModifyComposition/{id:[0-9]+}', 'controllerBack/ModifyComposition');
    $r->addRoute('POST', '/MyTeamStats/UpdateComposition/{id:[0-9]+}', 'controllerBack/UpdateComposition');
    $r->addRoute('GET', '/MyTeamStats/DeleteComposition/{id:[0-9]+}', 'controllerBack/DeleteComposition');


        // Oppo
    $r->addRoute('GET', '/MyTeamStats/OppoList', 'controllerBack/OppoList');
    $r->addRoute('GET', '/MyTeamStats/CreateOppo', 'controllerBack/CreateOppo');
    $r->addRoute('POST', '/MyTeamStats/AddOppo', 'controllerBack/AddOppo');
    $r->addRoute('GET', '/MyTeamStats/ModifyOppo/{id:[0-9]+}', 'controllerBack/ModifyOppo');
    $r->addRoute('POST', '/MyTeamStats/UpdateOppo/{id:[0-9]+}', 'controllerBack/UpdateOppo');
    $r->addRoute('GET', '/MyTeamStats/DeleteOppo/{id:[0-9]+}', 'controllerBack/DeleteOppo');

        // Field
    $r->addRoute('GET', '/MyTeamStats/FieldsList', 'controllerBack/FieldsList');
    $r->addRoute('GET', '/MyTeamStats/CreateField', 'controllerBack/CreateField');
    $r->addRoute('POST', '/MyTeamStats/AddField', 'controllerBack/AddField');
    $r->addRoute('GET', '/MyTeamStats/ModifyField/{id:[0-9]+}', 'controllerBack/ModifyField');
    $r->addRoute('POST', '/MyTeamStats/UpdateField/{id:[0-9]+}', 'controllerBack/UpdateField');
    $r->addRoute('GET', '/MyTeamStats/DeleteField/{id:[0-9]+}', 'controllerBack/DeleteField');
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
