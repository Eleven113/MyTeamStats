<?php

Class ControllerFront {


    public function Home($twig){
        echo $twig->render('/FrontEnd/Homepage.html.twig');
    }

    public function PlayersList($twig){

        echo $twig->render('/FrontEnd/PlayersList.html.twig');
    }

    public function Login($twig){
        echo $twig->render('/FrontEnd/Login.html.twig');
    }

    public function LostPassword($twig){
        echo $twig->render('/FrontEnd/LostPassword.html.twig');
    }

    public function CreateAccount($twig){
        echo $twig->render('/FrontEnd/CreateAccount.html.twig');
    }

    public function MatchsList($twig){
        echo $twig->render('/FrontEnd/MatchsList.html.twig');
    }

    public function Club($twig){
        echo $twig->render('/FrontEnd/Club.html.twig');
    }

    public function Player($twig){
        echo $twig->render('/FrontEnd/Player.html.twig');
    }

    public function Match($twig){
        echo $twig->render('/FrontEnd/MatchView.html.twig');
    }
}

