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
        $playersList = $this->db->query('SELECT PLAYERID, LICENCE, LASTNAME, FIRSTNAME, ADDRESS, PHONENUM, MAIL, DATE_FORMAT(BIRTHDATE,\' %d-%m-%Y\') AS BIRTHDATE, ACTIVELICENCE, PHOTO, CATEGORY, POSTE FROM PLAYER');
        $playersListObj = new ArrayObject();
        while ($playerArray = $playersList->fetch(PDO::FETCH_ASSOC)){
                $player = new Player($playerArray);
                $playersListObj->append($player);
        }

        return $playersListObj;
    }

    public function getPlayer($id)
    {
        $query = $this->db->prepare('SELECT PLAYERID, LICENCE, LASTNAME, FIRSTNAME, ADDRESS, PHONENUM, MAIL, DATE_FORMAT(BIRTHDATE,\' %d-%m-%Y\') AS BIRTHDATE, ACTIVELICENCE, PHOTO, CATEGORY, POSTE FROM PLAYER WHERE PLAYERID = :playerid');
        $query->bindValue(':playerid', $id);
        $query->execute();
        $player = new Player($query->fetch(PDO::FETCH_ASSOC));

        return $player;
    }

    public function DeletePlayer($id)
    {
        $query = $this->db->prepare('DELETE FROM PLAYER WHERE PLAYERID = :playerid');
        $query->bindValue(':playerid', $id);
        $query->execute();

    }

    public function UpdatePlayer(array $player)
    {

        $player = new Player($player);
        $q = $this->db->prepare('UPDATE PLAYER SET LICENCE = :licence, LASTNAME = :lastname, FIRSTNAME = :firstname, ADDRESS = :address, PHONENUM = :phonenum, MAIL = :mail, BIRTHDATE = :birthdate, ACTIVELICENCE = :activelicence, PHOTO = :photo, CATEGORY = :category, POSTE = :poste WHERE PLAYERID = :playerid');

        $q->bindValue(':playerid', $player->getPlayerid());
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
}