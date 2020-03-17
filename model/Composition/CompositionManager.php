<?php


class CompositionManager
{

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getComposition($id){
        $composition = $this->db->prepare('SELECT PLAY.PLAYERID, PLAY.GAMEID, PLAYER.LASTNAME, PLAYER.FIRSTNAME, PLAYER.ACTIVELICENCE, PLAYER.CATEGORY FROM PLAY, PLAYER WHERE PLAY.GAMEID = 7 AND PLAY.PLAYERID = PLAYER.PLAYERID');
        $composition->bindValue(':gameid', $id);
        $composition->execute();
        $count = 0;
        while($player = $composition->fetch(PDO::FETCH_ASSOC)){
            $count++;
            echo $count;
        }
    }
}