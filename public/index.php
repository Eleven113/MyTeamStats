<?php
session_start();

require ('../vendor/autoload.php');

use MyTeamStats;

$db = MyTeamStats\Model\DBFactory::ConnexionPDO();

$playerManager = new MyTeamStats\Model\Player\PlayerManager($db);
$userManager = new MyteamStats\Model\User\UserManager($db);
$opponentManager = new MyteamStats\Model\Opponent\OpponentManager($db);
$matchManager = new MyteamStats\Model\Match\MatchManager($db);
$fieldManager = new MyteamStats\Model\Field\FieldManager($db);
$compositionManager = new MyteamStats\Model\Composition\CompositionManager($db);
$goalManager = new MyteamStats\Model\Goal\GoalManager($db);
$periodManager = new MyteamStats\Model\Period\PeriodManager($db);
$cardManager = new MyteamStats\Model\Card\CardManager($db);

// Preparation de TWIG
$loader = new \Twig\Loader\FilesystemLoader('../view');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());
$twig->addExtension(new Twig_Extensions_Extension_Text());
$twig->addExtension(new Twig_Extensions_Extension_Intl());
$twig->addGlobal('session', $_SESSION);
$twig->addGlobal('env', $_ENV);


// Définition de la limite de longueur des listes
$limit = 10;

$controllerFront = new MyTeamStats\Controller\ControllerFront($twig, $playerManager, $userManager, $opponentManager, $matchManager, $fieldManager, $compositionManager, $goalManager, $periodManager, $cardManager, $limit);
$controllerBack = new MyTeamStats\Controller\ControllerBack($twig, $playerManager, $userManager, $opponentManager, $matchManager, $fieldManager, $compositionManager, $goalManager, $periodManager, $cardManager, $limit);

// Configuration de Cloudinary
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
try {
    $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
        // FrontEnd
        // Home
        $r->addRoute('GET', '/', 'controllerFront/Home');

        // Player
        $r->addRoute('GET', '/PlayersList', 'controllerFront/PlayersList');
        $r->addRoute('GET', '/MorePlayers/{page:[0-9]+}', 'controllerFront/MorePlayers');
        $r->addRoute('GET', '/Player/{id:[0-9]+}', 'controllerFront/Player');

        // Match
        $r->addRoute('GET', '/MatchsList', 'controllerFront/MatchsList');
        $r->addRoute('GET', '/MoreMatch/{page:[0-9]+}', 'controllerFront/MoreMatchs');
        $r->addRoute('GET', '/Match/{id:[0-9]+}', 'controllerFront/Match');

        // Club
        $r->addRoute('GET', '/Club', 'controllerFront/Club');

        // User
        $r->addRoute('GET', '/Login', 'controllerFront/Login');
        $r->addRoute('GET', '/CreateUser', 'controllerFront/CreateUser');
        $r->addRoute('POST', '/AddUser', 'controllerFront/AddUser');
        $r->addRoute('GET', '/LostPassword', 'controllerFront/LostPassword');
        $r->addRoute('GET', '/Logout', 'controllerFront/Logout');
        $r->addRoute('POST', '/UserLogin', 'controllerFront/UserLogin');
        $r->addRoute('POST', '/ResetPassword', 'controllerFront/ResetPassword');
        $r->addRoute('GET', '/ModifyPassword/{mail}/{token}', 'controllerFront/ModifyPassword');
        $r->addRoute('POST', '/UpdatePassword/{mail}/{token}', 'controllerFront/UpdatePassword');


        // BackEnd
        // Admin
        $r->addRoute('GET', '/Admin', 'controllerBack/Admin');

        // Player
        $r->addRoute('GET', '/CreatePlayer', 'controllerBack/CreatePlayer');
        $r->addRoute('POST', '/AddPlayer', 'controllerBack/AddPlayer');
        $r->addRoute('GET', '/ModifyPlayer/{id:[0-9]+}', 'controllerBack/ModifyPlayer');
        $r->addRoute('POST', '/UpdatePlayer/{id:[0-9]+}', 'controllerBack/UpdatePlayer');
        $r->addRoute('GET', '/DeletePlayer/{id:[0-9]+}', 'controllerBack/DeletePlayer');

        // Match
        $r->addRoute('GET', '/CreateMatch', 'controllerBack/CreateMatch');
        $r->addRoute('POST', '/AddMatch', 'controllerBack/AddMatch');
        $r->addRoute('GET', '/MoreMatchs/{page:[0-9]+}', 'controllerFront/MoreMatchs');
        $r->addRoute('GET', '/ModifyMatch/{id:[0-9]+}', 'controllerBack/ModifyMatch');
        $r->addRoute('POST', '/UpdateMatch/{id:[0-9]+}', 'controllerBack/UpdateMatch');
        $r->addRoute('GET', '/DeleteMatch/{id:[0-9]+}', 'controllerBack/DeleteMatch');
        $r->addRoute('GET', '/MatchStats/{id:[0-9]+}', 'controllerBack/MatchStats');
        $r->addRoute('POST', '/MatchData', 'controllerBack/MatchData');


        // Composition
        $r->addRoute('GET', '/Composition/{id:[0-9]+}', 'controllerBack/Composition');
        $r->addRoute('GET', '/CreateComposition/{id:[0-9]+}', 'controllerBack/CreateComposition');
        $r->addRoute('POST', '/AddComposition/{id:[0-9]+}', 'controllerBack/AddComposition');
        $r->addRoute('GET', '/ModifyComposition/{id:[0-9]+}', 'controllerBack/ModifyComposition');
        $r->addRoute('POST', '/UpdateComposition/{id:[0-9]+}', 'controllerBack/UpdateComposition');
        $r->addRoute('POST', '/SendComposition/{id:[0-9]+}', 'controllerBack/SendComposition');
        $r->addRoute('GET', '/DeleteComposition/{id:[0-9]+}', 'controllerBack/DeleteComposition');

        // Oppo
        $r->addRoute('GET', '/OppoList', 'controllerBack/OppoList');
        $r->addRoute('GET', '/MoreOppo/{page:[0-9]+}', 'controllerBack/MoreOppo');
        $r->addRoute('GET', '/CreateOppo', 'controllerBack/CreateOppo');
        $r->addRoute('POST', '/AddOppo', 'controllerBack/AddOppo');
        $r->addRoute('GET', '/ModifyOppo/{id:[0-9]+}', 'controllerBack/ModifyOppo');
        $r->addRoute('POST', '/UpdateOppo/{id:[0-9]+}', 'controllerBack/UpdateOppo');
        $r->addRoute('GET', '/DeleteOppo/{id:[0-9]+}', 'controllerBack/DeleteOppo');

        // Field
        $r->addRoute('GET', '/FieldsList', 'controllerBack/FieldsList');
        $r->addRoute('GET', '/CreateField', 'controllerBack/CreateField');
        $r->addRoute('POST', '/AddField', 'controllerBack/AddField');
        $r->addRoute('GET', '/MoreFields/{page:[0-9]+}', 'controllerBack/MoreFields');
        $r->addRoute('GET', '/ModifyField/{id:[0-9]+}', 'controllerBack/ModifyField');
        $r->addRoute('POST', '/UpdateField/{id:[0-9]+}', 'controllerBack/UpdateField');
        $r->addRoute('GET', '/DeleteField/{id:[0-9]+}', 'controllerBack/DeleteField');
        // Club

        // User
        $r->addRoute('GET', '/UsersList', 'controllerBack/UsersList');
        $r->addRoute('GET', '/MoreUsers/{page:[0-9]+}', 'controllerBack/MoreUsers');
        $r->addRoute('GET', '/ModifyUser/{id:[0-9]+}', 'controllerBack/ModifyUser');
        $r->addRoute('POST', '/UpdateUser/{id:[0-9]+}', 'controllerBack/UpdateUser');
        $r->addRoute('GET', '/DeleteUser/{id:[0-9]+}', 'controllerBack/DeleteUser');


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
            throw new Exception("404 - La page que vous demandez n'existe pas_/MyTeamStats/_Retour à la page d'accueil");
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            throw new Exception("405 - La méthode n'est pas autorisée_/MyTeamStats/_Retour à la page d'accueil");
        case FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            $vars += $_POST;
            $vars += $_FILES;
            $action = explode('/', $handler, 2);
            $controller = $action[0];
            $method = $action[1];

            if ($controller == 'controllerFront') {
                $controllerFront->{$method}(...array_values($vars));
            } else {
                if ($_SESSION['user_status'] >= 3) {
                    $controllerBack->{$method}(...array_values($vars));
                } else {
                    throw new Exception("Vous n'avez l'autorisation d'accèder à cette page_/MyTeamStats/_Retour à la page d'accueil");;
                }
            }

            break;
    }
}
catch (\Exception $e){

    echo $twig->render('exception.html.twig', [
        'error' => explode('_', $e->getMessage())[0],
        'link' => explode('_', $e->getMessage())[1],
        'linkTxt' => explode('_', $e->getMessage())[2]
    ]);
}

