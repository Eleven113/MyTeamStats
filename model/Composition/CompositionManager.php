<?php


class CompositionManager implements JsonSerializable
{

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getComposition($id){
        $composition = $this->db->prepare('SELECT PLAY.PLAYERID, PLAY.GAMEID, PLAYER.LASTNAME, PLAYER.FIRSTNAME, PLAYER.ACTIVELICENCE, PLAYER.CATEGORY FROM PLAY, PLAYER WHERE PLAY.GAMEID = :gameid AND PLAY.PLAYERID = PLAYER.PLAYERID');
        $composition->bindValue(':gameid', $id);
        $composition->execute();
        $playerList = new ArrayObject();
        $count = 0;
        while($player = $composition->fetch(PDO::FETCH_ASSOC)){
            $count++;
            $player = new Player($player);
            $playerList->append($player);
        }

        if ($count == 0){
            $playerList = null ;
        }

        return $playerList;
    }

    public function addComposition($id, $playersList){
        $count = count($playersList);
        $match = new Match($id);

        for ( $i = 0 ; $i < $count ; $i++){

            $player = [ 'playerid' => $playersList[$i]];
            $player = new Player($player);

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

    public function jsonSerialize(){
        return get_object_vars($this);
    }
}