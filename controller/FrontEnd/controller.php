<?php

Class ControllerFront {

    public function Home(){
        require('view/FrontEnd/HomepageView.php');
    }

    public function PlayersList(){
        require('view/FrontEnd/PlayersListView.php');
    }

    public function Login(){
        require('view/FrontEnd/LoginView.php');
    }

    public function LostPassword(){
        require('view/FrontEnd/LostPasswordView.php');
    }

    public function CreateAccount(){
        require('view/FrontEnd/CreateAccountView.php');
    }

    public function MatchsList(){
        require('view/FrontEnd/MatchsListView.php');
    }

    public function Club(){
        require('view/FrontEnd/ClubView.php');
    }

    public function Player(){
        require('view/FrontEnd/PlayerView.php');
    }

    public function Match(){
        require('view/FrontEnd/MatchView.php');
    }
}

