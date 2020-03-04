<?php


class PlayerManager
{

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM PLAYERS')->fetchColumn();
    }

    public function AddPlayer(array $player)
    {

        $player = new Player($player);
        $q = $this->db->prepare('INSERT INTO PLAYER (LICENCE, LASTNAME, FIRSTNAME, ADDRESS, PHONENUM, MAIL, BIRTHDATE, ACTIVELICENCE, PHOTO, CATEGORY, POSTE)
        VALUES (:licence, :lastname, :firstname, :address, :phonenum, :mail, :birthdate, :activelicence, :photo, :category, :poste) ');

        $q->bindValue(':licence', $player->getLicence());
        $q->bindValue(':lastname', $player->getLastname());
        $q->bindValue(':firstname', $player->getFirstname());
        $q->bindValue(':address', $player->getAddress());
        $q->bindValue(':phonenum', $player->getPhonenum());
        $q->bindValue(':mail', $player->getMail());
        $q->bindValue(':birthdate', $player->getBirthdate());
        $q->bindValue(':activelicence', $player->getActivelicence());
        $q->bindValue(':photo', $player->getPhoto());
        $q->bindValue(':category', $player->getCategory());
        $q->bindValue(':poste', $player->getPoste());

        $q->execute();

    }

    public function getPlayersList()
    {
        $playersList = $this->db->query('SELECT * FROM PLAYER');
        $playersListObj = new ArrayObject();
        while ($playerArray = $playersList->fetch(PDO::FETCH_ASSOC)){
                $player = new Player($playerArray);
                $playersListObj->append($player);
        }

        return $playersListObj;
    }

    public function getPlayer($id)
    {
        $query = $this->db->prepare('SELECT * FROM PLAYER WHERE PLAYERID = :playerid');
        $query->bindValue(':playerid', $id);
        $query->execute();
        $player = new Player($query->fetch(PDO::FETCH_ASSOC));

        return $player;
    }
}
