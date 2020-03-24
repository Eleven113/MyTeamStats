<?php

class ControllerBack {

    private $twig;
    private $playerManager;
    private $userManager;
    private $opponentManager;
    private $matchManager;
    private $fieldManager;
    private $compositionManager;
    private $goalManager;
    private $periodManager;
    private $cardManager;

    public function __construct($twig, $playerManager, $userManager, $opponentManager, $matchManager, $fieldManager, $compositionManager, $goalManager, $periodManager, $cardManager)
    {
        $this->twig = $twig;
        $this->playerManager = $playerManager;
        $this->userManager = $userManager;
        $this->opponentManager = $opponentManager;
        $this->matchManager = $matchManager;
        $this->fieldManager = $fieldManager;
        $this->compositionManager = $compositionManager;
        $this->goalManager = $goalManager;
        $this->periodManager = $periodManager;
        $this->cardManager = $cardManager;
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
        $fieldsListObj = $this->fieldManager->getFieldsList();

        echo $this->twig->render('/BackEnd/CreateMatch.html.twig',
            [
                'oppoListObj' => $oppoListObj,
                'fieldsListObj' => $fieldsListObj
            ]);
    }

    public function MatchStat(){
        echo $this->twig->render('/BackEnd/MatchStats.html.twig');
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

    public function AddMatch($date, $opponent, $athome, $fieldid, $category, $type, $periodnum, $periodduration){
        $match = [
            'date' => $date,
            'opponentid' => $opponent,
            'athome' => $athome,
            'fieldid' => $fieldid,
            'category' => $category,
            'type' => $type,
            'periodnum' => $periodnum,
            'periodduration' => $periodduration,
            'status' => 1
        ];

        $this->matchManager->AddMatch($match);

        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/MatchsList');

    }

    public function CreateField(){

        echo $this->twig->render('/BackEnd/CreateField.html.twig');
    }

    public function FieldsList(){
        $fieldsListObj = $this->fieldManager->getFieldsList();

        echo $this->twig->render('/BackEnd/FieldsList.html.twig', [ 'fieldListObj' => $fieldsListObj]);

    }

    public function AddField($name, $address, $zipcode, $city, $turf){
        $field = [
            'name' => $name,
            'address' => $address,
            'zipcode'=> $zipcode,
            'city' => $city,
            'turf' => $turf
        ];

        $this->fieldManager->AddField($field);

        header ('Location: http://www.thibaut-minard.fr/MyTeamStats/FieldsList');
    }

    public function ModifyField($id){
        $field = $this->fieldManager->getField($id);

        echo $this->twig->render('/BackEnd/UpdateField.html.twig', [ 'field' => $field]);
    }

    public function UpdateField($id, $name, $address, $zipcode, $city, $turf)
    {
        $field = [
            'fieldid' => $id,
            'name' => $name,
            'address' => $address,
            'zipcode' => $zipcode,
            'city' => $city,
            'turf' => $turf
        ];

        $this->fieldManager->UpdateField($field);

        header('Location: http://www.thibaut-minard.fr/MyTeamStats/FieldsList');
    }

    public function DeleteField($id){
        $this->fieldManager->DeleteField($id);

        header('Location: http://www.thibaut-minard.fr/MyTeamStats/FieldsList');
    }

    public function ModifyMatch($id){
        $match = $this->matchManager->getMatch($id);
        $oppoListObj = $this->opponentManager->getOppoList();
        $fieldsListObj = $this->fieldManager->getFieldsList();

        echo $this->twig->render('/BackEnd/CreateMatch.html.twig',
            [
                'match' => $match,
                'oppoListObj' => $oppoListObj,
                'fieldsListObj' => $fieldsListObj
            ]);
    }

    public function DeleteMatch($id){
        $this->matchManager->DeleteMatch($id);

        header('Location: http://www.thibaut-minard.fr/MyTeamStats/MatchsList');
    }

    public function Composition($id){
        $playersList = $this->compositionManager->getComposition($id);

        echo $this->twig->render('/BackEnd/Composition.html.twig',
            [
            'playersList' => $playersList,
            'id' => $id
            ]
        );
    }

    public function CreateComposition($id){
        $playersList = $this->playerManager->getPlayersList($id);

        echo $this->twig->render('/BackEnd/CreateComposition.html.twig',
            [
                'playersList' => $playersList,
                'id' => $id
            ]);
    }

    public function AddComposition($id, $playersList){
        $idArray = [ 'gameid' => $id];
        $this->compositionManager->AddComposition($idArray, $playersList);

        $this->Composition($id);
    }

    public function ModifyComposition($id){
        $playersList = $this->playerManager->getPlayersList($id);
        $playerInList = $this->compositionManager->getComposition($id);
        $List = [];

        for ($i = 0; $i < count($playerInList); $i++){
            array_push($List,$playerInList[$i]->getPlayerid());
        }

        echo $this->twig->render('/BackEnd/UpdateComposition.html.twig',
            [
                'playersList' => $playersList,
                'id' => $id,
                'List' => $List
            ]);
    }

    public function UpdateComposition($id, $playersList = null){

        $this->compositionManager->DeleteComposition($id);

        if ( isset($playersList) ){
            $this->AddComposition($id, $playersList);
        }
        else {
            $this->Composition($id);
        }
    }

    public function DeleteComposition($id){
        $this->compositionManager->DeleteComposition($id);

        echo $this->twig->render('/BackEnd/Composition.html.twig', [ 'id' => $id] );
    }

    public function MatchStats($id){
        $match = $this->matchManager->getMatch($id);
        $playersList = $this->compositionManager->getComposition($id);

        echo $this->twig->render('/BackEnd/MatchStats.html.twig', [
            'match' => $match,
            'playersList' => $playersList,
            'id' => $id
        ]);
    }

    public function MatchData(){
           $game = $_POST['game'];
           $this->matchManager->UpdateStatus($game);

//        for ( $i = 0; $i < count($_POST['goals']); $i++){
//            $goal = $_POST['goals'][$i];
//            $this->goalManager->AddGoal($goal);
//        }

//        for ( $i = 0; $i < count($_POST['stats']); $i++){
//            $period = $_POST['stats'][$i];
//            $this->periodManager->AddPeriod($period);
//        }

//        for ( $i = 0; $i < count($_POST['cards']); $i++){
//            $card = $_POST['cards'][$i];
//            $this->cardManager->AddCard($card);
//        }
    }
}

