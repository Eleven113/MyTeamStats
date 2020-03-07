<?php

class ControllerBack {

    private $twig;
    private $playerManager;
    private $userManager;
    private $opponentManager;

    public function __construct($twig, $playerManager, $userManager, $opponentManager)
    {
        $this->twig = $twig;
        $this->playerManager = $playerManager;
        $this->userManager = $userManager;
        $this->opponentManager = $opponentManager;
    }

    public function CreatePlayer(){
        echo $this->twig->render('/BackEnd/CreatePlayer.html.twig');
    }

    public function AddPlayer($lastname, $firstname, $licencenum, $activelicence, $birthdate, $category, $photo, $poste, $address, $phonenum, $mail){

        $result = \Cloudinary\Uploader::upload($photo, array("folder" => "Players/") );

        $player = [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'licence' => $licencenum,
            'activelicence' => $activelicence,
            'birthdate' => $birthdate,
            'category' => $category,
            'photo' => $result['url'],
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

        $result = \Cloudinary\Uploader::upload($photo, array("folder" => "Players/") );

        $player = [
            'playerid' => $id,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'licence' => $licencenum,
            'activelicence' => $activelicence,
            'birthdate' => $birthdate,
            'category' => $category,
            'photo' => $result['url'],
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
            'userid' => $id,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'mail' => $mail,
            'status' => $status
        ];

        $this->userManager->UpdateUser($user);

        header ('Location: index.php?action=userslist');
    }

    public function CreateOppo(){
        echo $this->twig->render('/BackEnd/CreateOppo.html.twig');
    }

    public function AddOppo($name, $photo){
        $result = \Cloudinary\Uploader::upload($photo, array("folder" => "Opponent/") );

        $oppo = [
            'name' => $name,
            'logo' => $result['url']
        ];

        $this->opponentManager->AddOppo($oppo);

//        header ('Location: index.php?action=oppolist');
    }
}

// $surname, $name, $licencenum, $activelicence, $category, $photo, $position, $address, $phonenum, $mail