<?php


class MatchManager
{

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getMatchList(){

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
        $query->bindValue(':status', 'prout');

        $query->execute();


    }

    public function UpdateMatch($id){

    }

    public function DeleteMatch($id){

    }
}