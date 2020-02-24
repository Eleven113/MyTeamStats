<?php

class ControllerBack {

    public function CreatePlayer($twig){
        echo $twig->render('/BackEnd/CreatePlayer.html.twig');
    }

    public function CreateMatch($twig){
        echo $twig->render('/BackEnd/CreateMatch.html.twig');
    }

    public function MatchStat($twig){
        echo $twig->render('/BackEnd/MatchStat.html.twig');
    }
}