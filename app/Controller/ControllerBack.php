<?php

namespace MyTeamStats\Controller ;

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

    public function __construct($twig, $playerManager, $userManager, $opponentManager, $matchManager, $fieldManager, $compositionManager, $goalManager, $periodManager, $cardManager, $limit){
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
        $this->limit = $limit;
    }


    // PLAYER
    public function PlayersList($notice = null){
        $playersListObj = $this->playerManager->getPlayersList($this->limit);
        $count = $this->playerManager->countPlayers();

        if (date('n') >= 8){
            $year = date('Y') + 1;
        }
        else {
            $year = date('Y');
        }

        echo $this->twig->render('/FrontEnd/PlayersList.html.twig',
            [
                'playerListObj' => $playersListObj,
                'sessionUser' => $_SESSION['user_status'],
                'year' => $year,
                'notice' => $notice,
                'list' => 'Players',
                'count' => $count
            ]);

    }

    public function CreatePlayer(){
        echo $this->twig->render('/BackEnd/CreatePlayer.html.twig');
    }

    public function AddPlayer($lastname, $firstname, $licencenum, $activelicence, $birthdate, $poste, $address, $phonenum, $mail, $photo){

        $type = explode("/", $photo['type'])[0];
        $photo = $photo['tmp_name'];

        if ( $type ==  'image' ){
            $result = \Cloudinary\Uploader::upload($photo, array("folder" => "Players/") );
        }
        else {
            throw new \Exception("Le format de la photo est incorrect_/CreatePlayer_Retour à la création de joueur");
        }


        $player = [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'licence' => $licencenum,
            'activelicence' => $activelicence,
            'birthdate' => $birthdate,
            'photo' => $result['url'],
            'poste' => $poste,
            'address' => $address,
            'phonenum' => $phonenum,
            'mail' => $mail
        ];

        $this->playerManager->AddPlayer($player);

        $notice = "Le joueur a bien été créé";
        $this->PlayersList($notice);
    }

    public function ModifyPlayer($id){
        $player = $this->playerManager->getPlayer($id);

        if ( $player->getFirstName() != null) {
            echo $this->twig->render('/BackEnd/UpdatePlayer.html.twig', ['player' => $player]);
        }
        else {
            throw new \Exception("Le joueur que vous tentez de modifier n'existe pas/plus_/PlayersList_Retour à liste des joueurs");
        }

    }

    public function UpdatePlayer($id, $lastname, $firstname, $licencenum, $activelicence, $birthdate, $poste, $address, $phonenum, $mail, $photo){
        $type = explode("/", $photo['type'])[0];
        $photo = $photo['tmp_name'];

        if ( $type ==  'image' ){
            $result = \Cloudinary\Uploader::upload($photo, array("folder" => "Players/") );
        }
        else {
            throw new \Exception("Le format de la photo est incorrect_/CreatePlayer_Retour à la modification de joueur");
        }

        $result = \Cloudinary\Uploader::upload($photo, array("folder" => "Players/") );

        $player = [
            'playerid' => $id,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'licence' => $licencenum,
            'activelicence' => $activelicence,
            'birthdate' => $birthdate,
            'poste' => $poste,
            'photo' => $result['url'],
            'address' => $address,
            'phonenum' => $phonenum,
            'mail' => $mail

        ];

        $this->playerManager->UpdatePlayer($player);

        $notice = "Le joueur a bien été modifié";
        $this->PlayersList($notice);

    }

    public function DeletePlayer($id){
        $matchPlayed = $this->compositionManager->CountMatchPlayed($id);

        if ($matchPlayed == 0){
            $this->playerManager->DeletePlayer($id);
            $notice = "Le joueur a bien été supprimé";
            $this->PlayersList($notice);
        }
        else {
            throw new \Exception("Un joueur qui a déjà participé à un match ne peut pas être supprimé, à moins de supprimer tous les matchs auquel il a participé_/PlayersList_Retour à liste des joueurs");
        }

    }



    // MATCH
    public function CreateMatch(){
        $oppoListObj = $this->opponentManager->getOppoFullList();
        $fieldsListObj = $this->fieldManager->getFieldsFullList();

        echo $this->twig->render('/BackEnd/CreateMatch.html.twig',
            [
                'oppoListObj' => $oppoListObj,
                'fieldsListObj' => $fieldsListObj,
            ]);
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
        $notice = "Le match a bien été créé";
        $this->MatchsList($notice);

    }

    public function DeleteMatch($id){
        $match = $this->matchManager->getMatch($id);
        $playersNum = $this->compositionManager->CountPlayers($id);

        if ( $match->getStatus() == 0){
            throw new \Exception("Un match déjà joué ne peut pas être supprimé");
        }

        if ( $playersNum == 0 ){
            $this->matchManager->DeleteMatch($id);

            $notice = "Le match a bien été supprimé";
            $this->MatchsList($notice);
        }
        else {
            throw new \Exception("Un match pour lequel il existe une composition d'équipe ne peut pas être supprimé. Il faut d'abord supprimer la composition d'équipe_/MatchsList_Retour à la liste des matchs");
        }

    }

    public function MatchStat(){
        echo $this->twig->render('/BackEnd/MatchStats.html.twig');
    }

    public function MatchsList($notice){
        $matchs = $this->matchManager->getMatchsList($this->limit);
        $count = $this->matchManager->countMatchs();

        echo $this->twig->render('/FrontEnd/MatchsList.html.twig', [
            'matchs' => $matchs,
            'notice' => $notice,
            'count' => $count,
            'list' => 'Matchs'
        ]);
    }

    public function MatchData(){

        $game = $_POST['game'];
        $this->matchManager->UpdateStatus($game);

        for ( $i = 0; $i < count($_POST['goals']); $i++){
            $goal = $_POST['goals'][$i];
            $this->goalManager->AddGoal($goal);
        }

        for ( $i = 0; $i < count($_POST['stats']); $i++){
            $period = $_POST['stats'][$i];
            $this->periodManager->AddPeriod($period);
        }

        for ( $i = 0; $i < count($_POST['cards']); $i++){
            $card = $_POST['cards'][$i];
            $this->cardManager->AddCard($card);
        }
    }




    // ADMIN
    public function Admin(){
        echo $this->twig->render('/BackEnd/Admin.html.twig');
    }



    // USER
    public function UsersList($notice = null){
        $usersListObj = $this->userManager->getUsersList($this->limit);
        $count = $this->userManager->countUsers();

        if ($notice == null){
            echo $this->twig->render('/BackEnd/UsersList.html.twig', [
                'usersListObj' => $usersListObj,
                'count' => $count,
                'list' => 'Users'
            ]);
        }
        else {
            echo $this->twig->render('/BackEnd/UsersList.html.twig', [
                'usersListObj' => $usersListObj,
                'notice' => $notice,
                'count' => $count,
                'list' => 'Users'
            ]);
        }
    }

    public function MoreUsers($page){
        $offset = $this->limit * ($page-1);
        $userListObj = $this->userManager->getMoreUsersList($this->limit, $offset);

        $userArray = [];

        for ($i=0; $i < count($userListObj); $i++){
            $user = $userListObj[$i];
            array_push($userArray, $user);
        }

        print_r(json_encode($userArray));

    }

    public function DeleteUser($id){
        $this->userManager->DeleteUser($id);
        $notice = "L'utilisateur a bien été supprimé";
        $this->UsersList($notice);
    }

    public function ModifyUser($id){
        $user = $this->userManager->getUser($id);

        if ($user->getFirstName() != null){
            echo $this->twig->render('/BackEnd/UpdateUser.html.twig', ['user' => $user]);
        }
        else {
            throw new \Exception("L'utilisateur que vous tentez de modifier n'existe pas/plus_/UsersList_Retour à la liste des utilisateurs");
        }

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
        $notice = "L'utilisateur a bien été modifié";
        $this->UsersList($notice);
    }



    // OPPONENT
    public function OppoList($notice = null){
        $oppoListObj = $this->opponentManager->getOppoList($this->limit);
        $count = $this->opponentManager->countOppo();

        if ($notice == null){
            echo $this->twig->render('/BackEnd/OppoList.html.twig', [
                'oppoListObj' => $oppoListObj,
                'count' => $count,
                'list' => 'Oppo'
            ]);
        }
        else {
            echo $this->twig->render('/BackEnd/OppoList.html.twig', [
                'oppoListObj' => $oppoListObj,
                'count' => $count,
                'list' => 'Oppo',
                'notice' => $notice
            ]);
        }

    }

    public function MoreOppo($page){
        $offset = $this->limit * ($page-1);
        $oppopListObj = $this->opponentManager->getMoreOppoList($this->limit, $offset);

        $oppoArray = [];

        for ($i=0; $i < count($oppopListObj); $i++){
            $oppo = $oppopListObj[$i];
            array_push($oppoArray, $oppo);
        }

        print_r(json_encode($oppoArray));

    }

    public function CreateOppo(){
        echo $this->twig->render('/BackEnd/CreateOppo.html.twig');
    }

    public function AddOppo($name, $logo){
        $type = explode("/", $logo['type'])[0];
        $logo = $logo['tmp_name'];

        if ( $type ==  'image' ){
            $result = \Cloudinary\Uploader::upload($logo, array("folder" => "Opponent/") );
        }
        else {
            throw new \Exception("Le format de la photo est incorrect_/CreateOppo_Retour à la création d'adversaire");
        }

        $result = \Cloudinary\Uploader::upload($logo, array("folder" => "OpponentObject/") );

        $oppo = [
            'name' => $name,
            'logo' => $result['url']
        ];

        $this->opponentManager->AddOppo($oppo);
        $notice = "L'adversaire a bien été créé";
        $this->OppoList($notice);
    }

    public function ModifyOppo($id){
        $oppo = $this->opponentManager->getOppo($id);

        if ($oppo->getName() != null){
            echo $this->twig->render('/BackEnd/UpdateOppo.html.twig', [ 'oppo' => $oppo]);
        }
        else {
            throw new \Exception("L'adversaire que vous tentez de modifier n'existe pas/plus_/OppoList_Retour à la liste des adversaires");
        }

    }

    public function UpdateOppo($id, $name, $logo){
        $type = explode("/", $logo['type'])[0];
        $logo = $logo['tmp_name'];

        if ( $type ==  'image' ){
            $result = \Cloudinary\Uploader::upload($logo, array("folder" => "Opponent/") );
        }
        else {
            throw new \Exception("Le format de la photo est incorrect_/UpdateOppo_Retour à la modification d'adversaire");
        }

        $result = \Cloudinary\Uploader::upload($logo, array("folder" => "OpponentObject/") );

        $oppo = [
            'opponentid' => $id,
            'name' => $name,
            'logo' => $result['url']
        ];

        $this->opponentManager->UpdateOppo($oppo);

        $notice = "L'adversaire a bien été modifié";
        $this->OppoList($notice);

    }

    public function DeleteOppo($id){
        $oppoPlayed = $this->matchManager->CountMatchOppo($id);

        if ($oppoPlayed == 0){
            $this->opponentManager->DeleteOppo($id);
            $notice = "L'adversaire a bien été supprimé";
            $this->OppoList($notice);
        }
        else {
            throw new \Exception("Un adversaire qui a déjà participé à un match ne peut pas être supprimé, à moins de supprimer tous les matchs auquel il a participé_/OppoList_Retour à la liste des adversaires");
        }
    }




    // FIELD
    public function CreateField(){

        echo $this->twig->render('/BackEnd/CreateField.html.twig');
    }

    public function FieldsList($notice = null){
        $fieldsListObj = $this->fieldManager->getFieldsList($this->limit);
        $count = $this->fieldManager->countFields();

        if ($notice == null){
            echo $this->twig->render('/BackEnd/FieldsList.html.twig', [
                'fieldListObj' => $fieldsListObj,
                'count' => $count,
                'list' => 'Fields'
            ]);
        }
        else {
            echo $this->twig->render('/BackEnd/FieldsList.html.twig', [
                'fieldListObj' => $fieldsListObj,
                'notice' => $notice,
                'count' => $count,
                'list' => 'Fields'
            ]);
        }
    }

    public function MoreFields($page){
        $offset = $this->limit * ($page-1);
        $fieldListObj = $this->fieldManager->getMoreFieldsList($this->limit, $offset);

        $fieldArray = [];

        for ($i=0; $i < count($fieldListObj); $i++){
            $field = $fieldListObj[$i];
            array_push($fieldArray, $field);
        }

        print_r(json_encode($fieldArray));

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

        $notice = "Le terrain a bien été créé";
        $this->FieldsList($notice);
    }

    public function ModifyField($id){
        $field = $this->fieldManager->getField($id);

        if ($field->getName() != null){
            echo $this->twig->render('/BackEnd/UpdateField.html.twig', [ 'field' => $field]);
        }
        else {
            throw new \Exception("Le terrain que vous tentez de modifier n'existe pas/plus_/FieldsList_Retour à la liste des terrains");
        }

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

        $notice = "Le terrain a bien été modifié";
        $this->FieldsList($notice);
    }

    public function DeleteField($id){
        $fieldPlayed = $this->matchManager->CountMatchField($id);

        if ($fieldPlayed == 0){
            $this->fieldManager->DeleteField($id);

            $notice = "Le terrain a bien été supprimé";
            $this->FieldsList($notice);
        }
        else {
            throw new \Exception("Un terrain qui a déjà servi pour un match ne peut pas être supprimé, à moins de supprimer tous les matchs concernés_/FieldsList_Retour à la liste des terrains");
        }

    }


    // COMPOSITION
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

        if (date('n') >= 8){
            $year = date('Y') + 1;
        }
        else {
            $year = date('Y');
        }

        echo $this->twig->render('/BackEnd/CreateComposition.html.twig',
            [
                'playersList' => $playersList,
                'id' => $id,
                'year' => $year
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

        if (date('n') >= 8){
            $year = date('Y') + 1;
        }
        else {
            $year = date('Y');
        }

        for ($i = 0; $i < count($playerInList); $i++){
            array_push($List,$playerInList[$i]->getPlayerid());
        }

        echo $this->twig->render('/BackEnd/UpdateComposition.html.twig',
            [
                'playersList' => $playersList,
                'id' => $id,
                'List' => $List,
                'year' => $year
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

    public function SendComposition($id){
        $message = $_POST['text'];
        $match = $this->matchManager->getMatch($id);
        $this->compositionManager->SendComposition($id, $match, $message);

        $notice = "Les convocations ont bien été envoyées";
        echo $this->twig->render('/FrontEnd/MatchsList.html.twig', ['notice' => $notice]);
    }

}

