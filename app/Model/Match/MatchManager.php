<?php

namespace MyTeamStats\Model\Match;

class MatchManager
{

    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getMatchsList(){
        $matchList = $this->db->query('SELECT GAME.GAMEID, GAME.OPPONENTID, GAME.CATEGORY, GAME.DATE, GAME.FIELDID, GAME.ATHOME, GAME.PERIODNUM, GAME.TYPE, GAME.PERIODDURATION, GAME.STATUS, OPPONENT.OPPONENTID AS OPPOID, OPPONENT.NAME AS OPPO, OPPONENT.NAME, OPPONENT.LOGO, FIELD.FIELDID AS FIELDID, FIELD.ADDRESS, FIELD.ZIPCODE, FIELD.CITY, FIELD.TURF, SUM(PERIOD.HOMESCORE) AS HOMESCORE, SUM(PERIOD.AWAYSCORE) AS AWAYSCORE FROM GAME LEFT JOIN PERIOD ON GAME.GAMEID = PERIOD.MATCHID INNER JOIN FIELD ON GAME.FIELDID = FIELD.FIELDID INNER JOIN OPPONENT ON GAME.OPPONENTID = OPPONENT.OPPONENTID GROUP BY GAME.GAMEID ORDER BY GAME.DATE DESC');
        $matchsList = new \ArrayObject();
        while ($matchArray = $matchList->fetch(\PDO::FETCH_ASSOC)){

            $matchDisplay = new MatchDisplay($matchArray);

            $matchsList->append($matchDisplay);
        }

        return $matchsList;
    }

    public function getMatch($id){
        $query = $this->db->prepare('SELECT GAME.GAMEID, GAME.OPPONENTID, GAME.CATEGORY, GAME.DATE, GAME.FIELDID, GAME.ATHOME, GAME.PERIODNUM, GAME.TYPE, GAME.PERIODDURATION, GAME.STATUS, OPPONENT.OPPONENTID AS OPPOID, OPPONENT.NAME AS OPPO, OPPONENT.NAME, OPPONENT.LOGO, FIELD.FIELDID AS FIEID, FIELD.ADDRESS, FIELD.ZIPCODE, FIELD.CITY, FIELD.TURF FROM GAME, OPPONENT, FIELD WHERE GAME.GAMEID = :gameid AND GAME.OPPONENTID = OPPONENT.OPPONENTID AND GAME.FIELDID = FIELD.FIELDID');
        $query->bindValue(':gameid', $id);
        $query->execute();

        return new MatchDisplay($query->fetch(\PDO::FETCH_ASSOC));

    }

    public function AddMatch($match){
        $match = new MatchObject($match);

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

    public function UpdateStatus($match){
        $match = new MatchObject($match);

        $query = $this->db->prepare('UPDATE GAME SET STATUS = :status WHERE GAMEID = :gameid');
        $query->bindValue(':gameid', $match->getGameid());
        $query->bindValue(':status', $match->getStatus());

        $query->execute();
    }

    public function DeleteMatch($id){
        $match = $this->getMatch($id);

        if ( $match->getStatus() != null ){
            $query = $this->db->prepare('DELETE FROM GAME WHERE GAMEID = :gameid');
            $query->bindValue(':gameid', $id);

            $query->execute();
        }
        else{
            throw new \Exception("Le match que vous tentez de supprimer n'existe pas/plus");
        }
    }

    public function CountMatchOppo($id){
        $oppoPlayed = $this->db->prepare('SELECT COUNT(*) FROM GAME WHERE OPPONENTID = :opponentid');
        $oppoPlayed->bindValue(':opponentid', $id);
        $oppoPlayed->execute();

        return $oppoPlayed->fetchColumn();
    }

    public function CountMatchField($id){
        $fieldPlayed = $this->db->prepare('SELECT COUNT(*) FROM GAME WHERE FIELDID = :fieldid');
        $fieldPlayed->bindValue(':fieldid', $id);
        $fieldPlayed->execute();

        return $fieldPlayed->fetchColumn();
    }
}