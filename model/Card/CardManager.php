<?php


class CardManager
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function AddCard($card){
        $card = new Card($card);

        $req = $this->db->prepare('INSERT INTO CARD (PLAYERID, MATCHID, PERIODNUM, COLOR, TIME) VALUES (:playerid, :matchid, :periodnum, :color, :time)');
        $req->bindValue(':playerid', $card->getPlayerid());
        $req->bindValue(':matchid', $card->getMatchid());
        $req->bindValue(':periodnum', $card->getPeriodnum());
        $req->bindValue(':color', $card->getColor());
        $req->bindValue(':time', $card->getTime());

        $req->execute();
    }

}