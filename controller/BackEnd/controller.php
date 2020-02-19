<?php

class ControllerBack {

    public function CreatePlayer(){
        require('view/BackEnd/CreatePlayerView.php');
    }

    public function CreateMatch(){
        require('view/BackEnd/CreateMatchView.php');
    }
}