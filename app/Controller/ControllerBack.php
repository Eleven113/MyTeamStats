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


    // PLAYER
    public function PlayersList($notice){
        $playersListObj = $this->playerManager->getPlayersList();

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
                'link' => $this->link,
                'year' => $year,
                'notice' => $notice
            ]);

    }

    public function CreatePlayer(){
        echo $this->twig->render('/BackEnd/CreatePlayer.html.twig');
    }

    public function AddPlayer($lastname, $firstname, $licencenum, $activelicence, $birthdate, $poste, $address, $phonenum, $mail, $photo){
        $photo = $photo['tmp_name'];
        $result = \Cloudinary\Uploader::upload($photo, array("folder" => "Players/") );

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

        if ( $player->getFirstName != null) {
            echo $this->twig->render('/BackEnd/UpdatePlayer.html.twig', ['player' => $player]);
        }
        else {
            throw new \Exception("Le joueur que vous tentez de modifier n'existe pas/plus");
        }

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
            throw new \Exception("Un joueur qui a déjà participé à un match ne peut pas être supprimé, à moins de supprimer tous les matchs auquel il a participé");
        }

    }




    // MATCH
    public function CreateMatch(){
        $oppoListObj = $this->opponentManager->getOppoList();
        $fieldsListObj = $this->fieldManager->getFieldsList();

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
            throw new \Exception("Un match pour lequel il existe une composition d'équipe ne peut pas être supprimé. Il faut d'abord supprimer la composition d'équipe");
        }

    }

    public function MatchStat(){
        echo $this->twig->render('/BackEnd/MatchStats.html.twig');
    }

    public function MatchsList($notice){
        $matchs = $this->matchManager->getMatchsList();

        echo $this->twig->render('/FrontEnd/MatchsList.html.twig', [
            'matchs' => $matchs,
            'notice' => $notice
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
        $usersListObj = $this->userManager->getUsersList();

        if ($notice == null){
            echo $this->twig->render('/BackEnd/UsersList.html.twig', ['usersListObj' => $usersListObj]);
        }
        else {
            echo $this->twig->render('/BackEnd/UsersList.html.twig', [
                'usersListObj' => $usersListObj,
                'notice' => $notice]);
        }
    }

    public function DeleteUser($id){
        $this->userManager->DeleteUser($id);
        $notice = "L'utilisateur a bien été supprimé";
        $this->UsersList($notice);
    }

    public function ModifyUser($id){
        $user = $this->userManager->getUser($id);

        if ($user->getFirstName != null){
            echo $this->twig->render('/BackEnd/UpdateUser.html.twig', ['user' => $user]);
        }
        else {
            throw new \Exception("L'utilisateur que vous tentez de modifier n'existe pas/plus");
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
        $oppoListObj = $this->opponentManager->getOppoList();

        if ($notice == null){
            echo $this->twig->render('/BackEnd/OppoList.html.twig', [ 'oppoListObj' => $oppoListObj]);
        }
        else {
            echo $this->twig->render('/BackEnd/OppoList.html.twig', [
                'oppoListObj' => $oppoListObj,
                'notice' => $notice
            ]);
        }

    }

    public function CreateOppo(){
        echo $this->twig->render('/BackEnd/CreateOppo.html.twig');
    }

    public function AddOppo($name, $logo){
        $logo = $logo['tmp_name'];
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
            throw new \Exception("L'adversaire que vous tentez de modifier n'existe pas/plus");
        }

    }

    public function UpdateOppo($id, $name, $logo){
        $logo = $logo['tmp_name'];
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
            throw new \Exception("Un adversaire qui a déjà participé à un match ne peut pas être supprimé, à moins de supprimer tous les matchs auquel il a participé");
        }
    }




    // FIELD
    public function CreateField(){

        echo $this->twig->render('/BackEnd/CreateField.html.twig');
    }

    public function FieldsList($notice = null){
        $fieldsListObj = $this->fieldManager->getFieldsList();

        if ($notice == null){
            echo $this->twig->render('/BackEnd/FieldsList.html.twig', [ 'fieldListObj' => $fieldsListObj]);
        }
        else {
            echo $this->twig->render('/BackEnd/FieldsList.html.twig', [
                'fieldListObj' => $fieldsListObj,
                'notice' => $notice
            ]);
        }


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
            throw new \Exception("Le terrain que vous tentez de modifier n'existe pas/plus");
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
            throw new \Exception("Un terrain qui a déjà servi pour un match ne peut pas être supprimé, à moins de supprimer tous les matchs concernés");
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

    public function SendComposition($id){
        $message = $_POST['text'];
        $match = $this->matchManager->getMatch($id);
        $this->compositionManager->SendComposition($id, $match, $message);

        $notice = "Les convocations ont bien été envoyées";
        echo $this->twig->render('/FrontEnd/MatchsList.html.twig', ['notice' => $notice]);
    }

}

