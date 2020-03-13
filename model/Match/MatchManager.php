<?php


class MatchManager
{

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getMatchsList(){
        $matchList = $this->db->query('SELECT * FROM GAME');
        $matchListObj = new ArrayObject();
        while ($matchArray = $matchList->fetch(PDO::FETCH_ASSOC)){
            $match = new Match($matchArray);
            $matchListObj->append($match);
        }

        return $matchListObj;
    }

    public function getMatch($id){
        $query = $this->db->prepare('SELECT * FROM GAME WHERE GAMEID = :gameid');
        $query->bindValue(':gameid', $id);
        $query->execute();

        return new Match($query->fetch(PDO::FETCH_ASSOC));

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

    public function DeleteMatch($id){
        $query = $this->db->prepare('DELETE FROM GAME WHERE GAMEID = :gameid');
        $query->bindValue(':gameid', $id);

        $query->execute();
    }
}