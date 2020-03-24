<?php


class MatchManager
{

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getMatchsList(){
        $matchList = $this->db->query('SELECT GAME.GAMEID, GAME.OPPONENTID, GAME.CATEGORY, GAME.DATE, GAME.FIELDID, GAME.ATHOME, GAME.PERIODNUM, GAME.TYPE, GAME.PERIODDURATION, GAME.STATUS, OPPONENT.OPPONENTID AS OPPOID, OPPONENT.NAME AS OPPO, OPPONENT.NAME, OPPONENT.LOGO, FIELD.FIELDID AS FIEID, FIELD.ADDRESS, FIELD.ZIPCODE, FIELD.CITY, FIELD.TURF FROM GAME, OPPONENT, FIELD WHERE GAME.OPPONENTID = OPPONENT.OPPONENTID AND GAME.FIELDID = FIELD.FIELDID');
        $matchsList = new ArrayObject();
        while ($matchArray = $matchList->fetch(PDO::FETCH_ASSOC)){

            $matchDisplay = new MatchDisplay($matchArray);

            $matchsList->append($matchDisplay);
        }

        return $matchsList;
    }

    public function getMatch($id){
        $query = $this->db->prepare('SELECT GAME.GAMEID, GAME.OPPONENTID, GAME.CATEGORY, GAME.DATE, GAME.FIELDID, GAME.ATHOME, GAME.PERIODNUM, GAME.TYPE, GAME.PERIODDURATION, GAME.STATUS, OPPONENT.OPPONENTID AS OPPOID, OPPONENT.NAME AS OPPO, OPPONENT.NAME, OPPONENT.LOGO, FIELD.FIELDID AS FIEID, FIELD.ADDRESS, FIELD.ZIPCODE, FIELD.CITY, FIELD.TURF FROM GAME, OPPONENT, FIELD WHERE GAME.GAMEID = :gameid AND GAME.OPPONENTID = OPPONENT.OPPONENTID AND GAME.FIELDID = FIELD.FIELDID');
        $query->bindValue(':gameid', $id);
        $query->execute();

        return new MatchDisplay($query->fetch(PDO::FETCH_ASSOC));

    }

    public function AddMatch($match){
        $match = new Match($match);

        $query = $this->db->prepare('INSERT INTO GAME (OPPONENTID, CATEGORY, DATE, FIELDID, ATHOME, PERIODNUM, TYPE, PERIODDURATION, STATUS) VALUES (:opponentid, :category, :date, :fieldid, :athome, :periodnum, :type, :periodduration, :status)');
        $query->bindValue(':opponentid', $match->getOpponentid());
        $query->bindValue(':category', $match->getCategory());
        $query->bindValue(':date', $match->getDate());
        $query->bindValue(':fieldid', $match->getFieldid());
        $query->bindValue(':athome', $match->getAtHome());
        $query->bindValue(':periodnum', $match->getPeriodnum());
        $query->bindValue(':type', $match->getType());
        $query->bindValue(':periodduration', $match->getPeriodduration());
        $query->bindValue(':status', $match->getStatus());

        $query->execute();


    }

    public function UpdateMatch($id){

    }

    public function UpdateStatus($match){
        $match = new Match($match);

        $query = $this->db->prepare('UPDATE GAME SET STATUS = :status WHERE GAMEID = :gameid');
        $query->bindValue(':gameid', $match->getGameid());
        $query->bindValue(':status', $match->getStatus());

        $query->execute();
    }

    public function DeleteMatch($id){
        $query = $this->db->prepare('DELETE FROM GAME WHERE GAMEID = :gameid');
        $query->bindValue(':gameid', $id);

        $query->execute();
    }
}