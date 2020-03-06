<?php

class ControllerBack {

    private $twig;
    private $playerManager;
    private $userManager;

    public function __construct($twig, $playerManager, $userManager)
    {
        $this->twig = $twig;
        $this->playerManager = $playerManager;
        $this->userManager = $userManager;
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

    public function DeletePlayer($id){
        $this->playerManager->DeletePlayer($id);

        header ('Location: index.php?action=playerslist');
    }

    public function ModifyPlayer($id){
        $player = $this->playerManager->getPlayer($id);
        echo $this->twig->render('/BackEnd/UpdatePlayer.html.twig', ['player' => $player]);
    }

    public function UpdatePlayer($id, $lastname, $firstname, $licencenum, $activelicence, $birthdate, $category, $photo, $poste, $address, $phonenum, $mail){

        $player = [
            'playerid' => $id,
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

        $this->playerManager->UpdatePlayer($player);


        header ('Location: index.php?action=playerslist');
    }

    public function CreateMatch(){
        echo $this->twig->render('/BackEnd/CreateMatch.html.twig');
    }

    public function MatchStat(){
        echo $this->twig->render('/BackEnd/MatchStat.html.twig');
    }

    public function Admin(){
        echo $this->twig->render('/BackEnd/Admin.html.twig');
    }

    public function UsersList(){
        $usersListObj = $this->userManager->getUsersList();

        echo $this->twig->render('/BackEnd/UsersList.html.twig', ['usersListObj' => $usersListObj]);
    }

    public function DeleteUser($id){
        $this->userManager->DeleteUser($id);

        header ('Location: index.php?action=userslist');
    }

    public function ModifyUser($id){
        $user = $this->userManager->getUser($id);

        echo $this->twig->render('/BackEnd/UpdateUser.html.twig', ['user' => $user]);
    }

    public function UpdateUser($id, $lastname, $firstname, $mail, $status){
        $user = [
            'userid' => $user,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'mail' => $mail
        ];

        $this->userManager->UpdateUser($user);

        echo $this->twig->render('/BackEnd/UsersList.html.twig');
    }
}

// $surname, $name, $licencenum, $activelicence, $category, $photo, $position, $address, $phonenum, $mail