<?php

Class ControllerFront {

    private $twig;
    private $playerManager;
    private $userManager;

    public function __construct($twig, $playerManager, $userManager)
    {
        $this->twig = $twig;
        $this->playerManager = $playerManager;
        $this->userManager = $userManager;
    }

    public function Home(){
        echo $this->twig->render('/FrontEnd/Homepage.html.twig');
    }

    public function PlayersList(){
        $playersListObj = $this->playerManager->getPlayersList();
        echo $this->twig->render('/FrontEnd/PlayersList.html.twig',
            [
                'playerListObj' => $playersListObj,
                'sessionUser' => $_SESSION['user_status']
            ]);
    }

    public function Login(){
        echo $this->twig->render('/FrontEnd/Login.html.twig');
    }

    public function LostPassword(){
        echo $this->twig->render('/FrontEnd/LostPassword.html.twig');
    }

    public function CreateUser(){
        echo $this->twig->render('/FrontEnd/CreateUser.html.twig');
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

       echo $this->twig->render('/FrontEnd/Homepage.html.twig', ['notice' => $_SESSION['notice']]);
    }

    public function MatchsList(){
        echo $this->twig->render('/FrontEnd/MatchsList.html.twig');
    }

    public function Club(){
        echo $this->twig->render('/FrontEnd/Club.html.twig');
    }

    public function Player($id){
        $player = $this->playerManager->getPlayer($id);
        echo $this->twig->render('/FrontEnd/Player.html.twig', ['player' => $player]);
    }

    public function Match(){
        echo $this->twig->render('/FrontEnd/MatchView.html.twig');
    }

    public function SessionKill(){
        $_SESSION = array();
        session_destroy();
        $this->home();

    }
}

