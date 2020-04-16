<?php

namespace MyTeamStats\Model\Card;

class CardManager
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function AddCard($card){
        $card = new CardObject($card);

        $req = $this->db->prepare('INSERT INTO CARD (PLAYERID, MATCHID, PERIODNUM, COLOR, TIME) VALUES (:playerid, :matchid, :periodnum, :color, :time)');
        $req->bindValue(':playerid', $card->getPlayerid());
        $req->bindValue(':matchid', $card->getMatchid());
        $req->bindValue(':periodnum', $card->getPeriodnum());
        $req->bindValue(':color', $card->getColor());
        $req->bindValue(':time', $card->getTime());

        $req->execute();
    }

    public function getCardsList($matchid){
        $cardsList = $this->db->prepare('SELECT * FROM CARD WHERE MATCHID = :matchid ORDER BY CARD.PERIODNUM ASC, CARD.TIME ASC ');
        $cardsList->bindValue(':matchid', $matchid);
        $cardsList->execute();

        $cardsListObj = new \ArrayObject();

        while ($cardArray = $cardsList->fetch(\PDO::FETCH_ASSOC)){
            $card = new CardObject($cardArray);
            $card = $card->jsonSerialize();
            $cardsListObj->append($card);
        }


        return $cardsListObj;
    }

    public function CountYellow($id){
        $yellowcard = $this->db->prepare('SELECT COUNT(*) FROM CARD WHERE COLOR = :color AND PLAYERID = :playerid');
        $yellowcard->bindValue(':color', 'jaune');
        $yellowcard->bindValue(':playerid', $id);
        $yellowcard->execute();

        return $yellowcard->fetchColumn();
    }

    public function CountRed($id){
        $redcard = $this->db->prepare('SELECT COUNT(*) FROM CARD WHERE COLOR = :color AND PLAYERID = :playerid');
        $redcard->bindValue(':color', 'rouge');
        $redcard->bindValue(':playerid', $id);
        $redcard->execute();

        return $redcard->fetchColumn();
    }

}