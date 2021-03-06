<?php

namespace MyTeamStats\Model\Player;

class PlayerManager
{

    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function countPlayers()
    {
        return $this->db->query('SELECT COUNT(*) FROM PLAYER')->fetchColumn();
    }

    public function AddPlayer(array $player)
    {

        $player = new PlayerObject($player);
        $q = $this->db->prepare('INSERT INTO PLAYER (LICENCE, LASTNAME, FIRSTNAME, ADDRESS, PHONENUM, MAIL, BIRTHDATE, ACTIVELICENCE, PHOTO, POSTE)
        VALUES (:licence, :lastname, :firstname, :address, :phonenum, :mail, :birthdate, :activelicence, :photo, :poste) ');

        $q->bindValue(':licence', $player->getLicence());
        $q->bindValue(':lastname', $player->getLastname());
        $q->bindValue(':firstname', $player->getFirstname());
        $q->bindValue(':address', $player->getAddress());
        $q->bindValue(':phonenum', $player->getPhonenum());
        $q->bindValue(':mail', $player->getMail());
        $q->bindValue(':birthdate', $player->getBirthdate());
        $q->bindValue(':activelicence', $player->getActivelicence());
        $q->bindValue(':photo', $player->getPhoto());
        $q->bindValue(':poste', $player->getPoste());

        $q->execute();

    }

    public function getPlayersList($limit)
    {

        $playersList = $this->db->prepare('SELECT PLAYERID, LICENCE, LASTNAME, FIRSTNAME, ADDRESS, PHONENUM, MAIL, DATE_FORMAT(BIRTHDATE,\' %d-%m-%Y\') AS BIRTHDATE, ACTIVELICENCE, PHOTO, POSTE FROM PLAYER LIMIT :offset , :limit');
        $playersList->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $playersList->bindValue(':offset', 0, \PDO::PARAM_INT);
        $playersList->execute();

        $playersListObj = new \ArrayObject();
        while ($playerArray = $playersList->fetch(\PDO::FETCH_ASSOC)){
                $player = new PlayerObject($playerArray);
                $playersListObj->append($player);
        }

        return $playersListObj;
    }

    public function getMorePlayersList($limit,$offset)
    {
        $playersList = $this->db->prepare('SELECT PLAYERID, LICENCE, LASTNAME, FIRSTNAME, ADDRESS, PHONENUM, MAIL, DATE_FORMAT(BIRTHDATE,\' %d-%m-%Y\') AS BIRTHDATE, ACTIVELICENCE, PHOTO, POSTE FROM PLAYER LIMIT :offset , :limit');
        $playersList->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $playersList->bindValue(':offset', (int) $offset, \PDO::PARAM_INT);
        $playersList->execute();

        $playersListObj = new \ArrayObject();
        while ($playerArray = $playersList->fetch(\PDO::FETCH_ASSOC)){
            $player = new PlayerObject($playerArray);
            $playersListObj->append($player);
        }

        return $playersListObj;
    }

    public function getPlayer($id)
    {
        $query = $this->db->prepare('SELECT PLAYERID, LICENCE, LASTNAME, FIRSTNAME, ADDRESS, PHONENUM, MAIL, DATE_FORMAT(BIRTHDATE,\' %d-%m-%Y\') AS BIRTHDATE, ACTIVELICENCE, PHOTO, POSTE FROM PLAYER WHERE PLAYERID = :playerid');
        $query->bindValue(':playerid', $id);
        $query->execute();
        $player = new PlayerObject($query->fetch(\PDO::FETCH_ASSOC));

        return $player;
    }

    public function DeletePlayer($id)
    {
        $player = $this->getPlayer($id);

        if ( $player->getFirstname() != null){
            $query = $this->db->prepare('DELETE FROM PLAYER WHERE PLAYERID = :playerid');
            $query->bindValue(':playerid', $id);
            $query->execute();
        }
        else {
            throw new \Exception("Le joueur que vous tentez d'utiliser n'existe pas/plus_/MyTeamStats/PlayersList_Retour à liste des joueurs");
        }


    }

    public function UpdatePlayer(array $player)
    {

        $player = new PlayerObject($player);

        $q = $this->db->prepare('UPDATE PLAYER SET LICENCE = :licence, LASTNAME = :lastname, FIRSTNAME = :firstname, ADDRESS = :address, PHONENUM = :phonenum, MAIL = :mail, BIRTHDATE = :birthdate, ACTIVELICENCE = :activelicence, PHOTO = :photo, POSTE = :poste WHERE PLAYERID = :playerid');

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
        $q->bindValue(':poste', $player->getPoste());

        $q->execute();

    }
}
