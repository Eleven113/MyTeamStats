<?php

namespace MyTeamStats\Model\Composition;

class CompositionManager
{

    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getComposition($id){
        $composition = $this->db->prepare('SELECT PLAY.PLAYERID, PLAY.GAMEID, PLAYER.LASTNAME, PLAYER.FIRSTNAME, PLAYER.ACTIVELICENCE, PLAYER.CATEGORY, PLAYER.MAIL FROM PLAY, PLAYER WHERE PLAY.GAMEID = :gameid AND PLAY.PLAYERID = PLAYER.PLAYERID');
        $composition->bindValue(':gameid', $id);
        $composition->execute();
        $playerList = new \ArrayObject();
        $count = 0;
        while($player = $composition->fetch(\PDO::FETCH_ASSOC)){
            $count++;
            $player = new CompositionObject($player);
            $playerList->append($player);
        }

        if ($count == 0){
            $playerList = null ;
        }

        return $playerList;
    }

    public function addComposition($id, $playersList){
        $count = count($playersList);
        $match = new \MyTeamStats\Model\Match\MatchObject($id);

        for ( $i = 0 ; $i < $count ; $i++){

            $player = [ 'playerid' => $playersList[$i]];
            $player = new \MyTeamStats\Model\Player\PlayerObject($player);

            $query = $this->db->prepare('INSERT INTO PLAY (GAMEID , PLAYERID) VALUES ( :gameid , :playerid )');
            $query->bindValue(':gameid', $match->getGameid());
            $query->bindValue('playerid', $player->getPlayerid());
            $query->execute();

        }
    }


    public function DeleteComposition($id){
        $query = $this->db->prepare('DELETE FROM PLAY WHERE GAMEID = :gameid');
        $query->bindValue(':gameid', $id);

        $query->execute();
    }

    public function SendComposition($id, $match, $text){
        $playerList = $this->getComposition($id);
        $mails = '';

        $senderMail = $_SESSION['user_mail'];
        $senderName = $_SESSION['user_firstname'];

        $date = new \DateTime($match->getDate());
        $date = $date->format('\\l\\e d-m-Y à H\hi');

        for ( $i=0; $i < count($playerList); $i++){
            $player = new CompositionObject($playerList[$i]);

            $title = 'Convocation de match';
            $message =  '<html>'.
                '  <body>'.
                '       Bonjour '.$player->getFirstname().','.'<br/><br/>'.
                '       Tu es convoquée pour le match de '.$match->getType().' '.$date.' contre  '.$match->getOppo().'.<br/><br/>'.
                '       Tous les détails sont sur <a href="http://www.thibaut-minard.fr/MyTeamStats/Match/'.$id.'">MyTeamStats</a>'.'.'.'<br/><br/>'.
                $text.'<br/><br/>'.
                '       Pour signaler un retard, une absence. Contactez moi directement'.'<br/><br/>'.
                'A bientôt, '.$senderName.' - '.$senderMail.
                '  </body>'.
                '</html>';

            $result = new \MyTeamStats\Model\Mailer($player->getMail(), $title, $message);
        }

   }


    public function jsonSerialize(){
        return get_object_vars($this);
    }
}