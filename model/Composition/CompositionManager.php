<?php


class CompositionManager
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


}