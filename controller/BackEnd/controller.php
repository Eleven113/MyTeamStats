<?php

class ControllerBack {

    private $twig;
    private $playerManager;

    public function __construct($twig, $playerManager)
    {
        $this->twig = $twig;
        $this->playerManager = $playerManager;
    }

    public function CreatePlayer(){
        echo $this->twig->render('/BackEnd/CreatePlayer.html.twig');
    }

    public function AddPlayer($lastname, $firstname, $licencenum, $activelicence, $birthdate, $category, $photo, $poste, $address, $phonenum, $mail){

        $player = [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'licence' => $licencenum,
            'activelicence' => $activelicence,
            'birthdate' => $birthdate,
            'category' => $category,
            'photo' => $photo,
            'poste' => $poste,
            'address' => $address,
            'phonenum' => $phonenum,
            'mail' => $mail
        ];

        $this->playerManager->AddPlayer($player);


        header ('Location: index.php?action=playerslist');
    }

    public function CreateMatch($twig){
        echo $this->twig->render('/BackEnd/CreateMatch.html.twig');
    }

    public function MatchStat($twig){
        echo $this->twig->render('/BackEnd/MatchStat.html.twig');
    }
}

// $surname, $name, $licencenum, $activelicence, $category, $photo, $position, $address, $phonenum, $mail