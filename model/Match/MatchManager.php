<?php


class MatchManager
{

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getMatchList(){
        $matchList = $this->db->query('SELECT * FROM GAME');
        $matchListObj = new ArrayObject();
        while ($matchArray = $matchList->fetch(PDO::FETCH_ASSOC)){
            $match = new Opponent($matchArray);
            $matchListObj->append($match);
        }

        return $matchListObj;
    }

    public function getMatch($id){

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

    }
}