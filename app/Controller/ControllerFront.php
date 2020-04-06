<?php

namespace MyTeamStats\Controller;

Class ControllerFront {

    private $twig;
    private $playerManager;
    private $userManager;
    private $opponentManager;
    private $matchManager;
    private $fieldManager;
    private $compositionManager;
    private $goalManager;
    private $periodManager;
    private $cardManager;

    public function __construct($twig, $playerManager, $userManager, $opponentManager, $matchManager, $fieldManager, $compositionManager, $goalManager, $periodManager, $cardManager)
    {
        $this->twig = $twig;
        $this->playerManager = $playerManager;
        $this->userManager = $userManager;
        $this->opponentManager = $opponentManager;
        $this->matchManager = $matchManager;
        $this->fieldManager = $fieldManager;
        $this->compositionManager = $compositionManager;
        $this->goalManager = $goalManager;
        $this->periodManager = $periodManager;
        $this->cardManager = $cardManager;
    }

    public function Home(){
        echo $this->twig->render('/FrontEnd/Homepage.html.twig');
    }

    public function PlayersList(){
        $playersListObj = $this->playerManager->getPlayersList();

        if (date('n') >= 8){
            $year = date('Y') + 1;
        }
        else {
            $year = date('Y');
        }

        echo $this->twig->render('/FrontEnd/PlayersList.html.twig',
            [
                'playerListObj' => $playersListObj,
                'sessionUser' => $_SESSION['user_status'],
                'link' => $this->link,
                'year' => $year
            ]);
    }

    public function Login(){
        echo $this->twig->render('/FrontEnd/Login.html.twig');
    }

    public function LostPassword(){
        echo $this->twig->render('/FrontEnd/LostPassword.html.twig');
    }

    public function CreateUser(){
        $mailsList = $this->userManager->getMails();

        $mailsArray  = [];

        for ($i=0; $i < count($mailsList); $i++){
            $mail = $mailsList[$i];
            array_push($mailsArray, $mail->getMail());
        }

        $mailsList = json_encode($mailsArray);

        echo $this->twig->render('/FrontEnd/CreateUser.html.twig', [ 'mails' => $mailsList]);
    }

    public function AddUser($lastname, $firstname, $mail, $pwd){
        $h_pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $user = [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'mail' => $mail,
            'password' => $h_pwd
        ];

        $this->userManager->AddUser($user);

        echo $this->twig->render('/FrontEnd/Login.html.twig');
    }

    public function UserLogin($mail, $pwd){

        $login = $this->userManager->UserLogin($mail, $pwd);

        if ($login){
            $_SESSION['notice'] = "Vous avez été correctement identifié";
        }
        else {
            $_SESSION['notice'] = "Adresse mail inconnue ou mot de passe incorrect";
        }

        $this->twig->addGlobal('session', $_SESSION);
        echo $this->twig->render('/FrontEnd/Homepage.html.twig', ['notice' => $_SESSION['notice']]);

    }

    public function MatchsList(){
        $matchs = $this->matchManager->getMatchsList();

        echo $this->twig->render('/FrontEnd/MatchsList.html.twig', [ 'matchs' => $matchs]);
    }

    public function Club(){
        echo $this->twig->render('/FrontEnd/Club.html.twig');
    }

    public function Player($id){
        $player = $this->playerManager->getPlayer($id);
        echo $this->twig->render('/FrontEnd/Player.html.twig', ['player' => $player]);
    }

    public function Match($id){
        $match = $this->matchManager->getMatch($id);
        $playersList = $this->compositionManager->getComposition($id);
        $cardsList = $this->cardManager->getCardsList($id);
        $goalsList = $this->goalManager->getGoalsList($id);
        $periodsList = $this->periodManager->getPeriodsList($id);

        $playerArray  = [];

        for ($i=0; $i < count($playersList); $i++){
            $player = $playersList[$i];
            array_push($playerArray, $player);
        }

        $cardArray = [];

        for ($i=0; $i < count($cardsList); $i++){
            $card = $cardsList[$i];
            array_push($cardArray, $card);
        }

        $goalArray = [];

        for ($i=0; $i < count($goalsList); $i++){
            $goal = $goalsList[$i];
            array_push($goalArray, $goal);
        }

        $periodArray = [];

        for ($i=0; $i < count($periodsList); $i++){
            $period = $periodsList[$i];
            array_push($periodArray, $period);
        }

        $players = json_encode($playerArray);
        $cards = json_encode($cardArray);
        $periods = json_encode($periodArray);
        $goals = json_encode($goalArray);

        echo $this->twig->render('/FrontEnd/Match.html.twig', [
            'match' => $match,
            'players' => $players,
            'playersList' => $playersList,
            'goals' => $goals,
            'cards' => $cards,
            'periods' => $periods
            ]);
    }

    public function SessionKill(){
        $_SESSION = array();
        session_destroy();

        $this->twig->addGlobal('session', $_SESSION);
        $this->home();

    }

    public function ResetPassword(){
        $mail = $_POST['mail'];

        $this->userManager->ResetPassword($mail);

        echo $this->twig->render('/FrontEnd/Homepage.html.twig');
    }

    public function ModifyPassword($mail,$token){

        $return = $this->userManager->CheckToken($mail, $token);

        if ($return){
            echo $this->twig->render('/FrontEnd/ModifyPassword.html.twig', [
                'mail' => $mail,
                'token' => $token
            ]);
        }
        else {
            throw new \Exception("Vous n'êtes pas autorisé à effectuer cette action.");
        }
    }

    public function UpdatePassword($mail, $token){
        $return = $this->userManager->CheckToken($mail, $token);

        if ($return){
            if ($_POST['pwd1'] == $_POST['pwd2']){
                $pwd = password_hash($_POST['pwd1'], PASSWORD_DEFAULT);
                $user = [
                    'mail' => $mail,
                    'password' => $pwd
                ];
                $this->userManager->UpdatePassword($user);

                echo $this->twig->render('/FrontEnd/Home.html.twig');
            }
        }
        else {
            // On fera un truc
        }

    }

}

