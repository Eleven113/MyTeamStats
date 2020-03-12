<?php

class ControllerBack {

    private $twig;
    private $playerManager;
    private $userManager;
    private $opponentManager;
    private $matchManager;

    public function __construct($twig, $playerManager, $userManager, $opponentManager, $matchManager)
    {
        $this->twig = $twig;
        $this->playerManager = $playerManager;
        $this->userManager = $userManager;
        $this->opponentManager = $opponentManager;
        $this->matchManager = $matchManager;
    }

    public function CreatePlayer(){
        echo $this->twig->render('/BackEnd/CreatePlayer.html.twig');
    }

    public function AddPlayer($lastname, $firstname, $licencenum, $activelicence, $birthdate, $category, $poste, $address, $phonenum, $mail, $photo){
        $photo = $photo['tmp_name'];
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


        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/PlayersList');
    }

    public function DeletePlayer($id){
        $this->playerManager->DeletePlayer($id);

        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/PlayersList');
    }

    public function ModifyPlayer($id){
        $player = $this->playerManager->getPlayer($id);
        echo $this->twig->render('/BackEnd/UpdatePlayer.html.twig', ['player' => $player]);
    }

    public function UpdatePlayer($id, $lastname, $firstname, $licencenum, $activelicence, $birthdate, $category, $poste, $address, $phonenum, $mail, $photo){
        $photo = $photo['tmp_name'];
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


        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/PlayersList');
    }

    public function CreateMatch(){
        $oppoListObj = $this->opponentManager->getOppoList();

        echo $this->twig->render('/BackEnd/CreateMatch.html.twig', [ 'oppoListObj' => $oppoListObj]);
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

        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/UsersList');
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

        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/UsersList');
    }

    public function CreateOppo(){
        echo $this->twig->render('/BackEnd/CreateOppo.html.twig');
    }

    public function AddOppo($name, $logo){
        $logo = $logo['tmp_name'];
        $result = \Cloudinary\Uploader::upload($logo, array("folder" => "Opponent/") );

        $oppo = [
            'name' => $name,
            'logo' => $result['url']
        ];

        $this->opponentManager->AddOppo($oppo);

        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/OppoList');
    }

    public function OppoList(){
        $oppoListObj = $this->opponentManager->getOppoList();

        echo $this->twig->render('/BackEnd/OppoList.html.twig', [ 'oppoListObj' => $oppoListObj]);
    }

    public function ModifyOppo($id){
        $oppo = $this->opponentManager->getOppo($id);

        echo $this->twig->render('/BackEnd/UpdateOppo.html.twig', [ 'oppo' => $oppo]);
    }

    public function UpdateOppo($id, $name, $logo){
        $logo = $logo['tmp_name'];
        $result = \Cloudinary\Uploader::upload($logo, array("folder" => "Opponent/") );

        $oppo = [
            'oppoid' => $id,
            'name' => $name,
            'logo' => $result['url']
        ];

        $this->opponentManager->UpdateOppo($oppo);

        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/OppoList');

    }

    public function DeleteOppo($id){
        $this->opponentManager->DeleteOppo($id);

        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/OppoList');
    }

    public function AddMatch($date, $opponent, $athome, $location, $category, $type, $periodnum, $periodduration){
        $match = [
            'date' => $date,
            'opponent' => $opponent,
            'athome' => $athome,
            'category' => $category,
            'type' => $type,
            'periodnum' => $periodnum,
            'periodduration' => $periodduration
        ];

        $this->matchManager->AddMatch($match);

        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/MatchsList');

    }
}

