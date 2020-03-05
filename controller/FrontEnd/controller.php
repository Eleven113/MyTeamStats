<?php

Class ControllerFront {

    private $twig;
    private $playerManager;

    public function __construct($twig, $playerManager)
    {
        $this->twig = $twig;
        $this->playerManager = $playerManager;
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
}

