<?php

namespace MyTeamStats\Model\Opponent;

class OpponentManager
{


    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function countOppo(){
        return $this->db->query('SELECT COUNT(*) FROM OPPONENT')->fetchColumn();
    }

    public function getOppoList($limit){
        $oppoList = $this->db->prepare('SELECT * FROM OPPONENT LIMIT :offset, :limit');
        $oppoList->bindValue(':offset', 0, \PDO::PARAM_INT);
        $oppoList->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $oppoList->execute();
        $oppoListObj = new \ArrayObject();
        while ($oppoArray = $oppoList->fetch(\PDO::FETCH_ASSOC)){
            $oppo = new OpponentObject($oppoArray);
            $oppoListObj->append($oppo);
        }

        return $oppoListObj;
    }

    public function getOppoFullList(){
        $oppoList = $this->db->query('SELECT * FROM OPPONENT');
        $oppoListObj = new \ArrayObject();
        while ($oppoArray = $oppoList->fetch(\PDO::FETCH_ASSOC)){
            $oppo = new OpponentObject($oppoArray);
            $oppoListObj->append($oppo);
        }

        return $oppoListObj;
    }


    public function getMoreOppoList($limit,$offset)
    {
        $opposList = $this->db->prepare('SELECT * FROM OPPONENT LIMIT :offset , :limit');
        $opposList->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $opposList->bindValue(':offset', (int) $offset, \PDO::PARAM_INT);
        $opposList->execute();

        $opposListObj = new \ArrayObject();
        while ($oppoArray = $opposList->fetch(\PDO::FETCH_ASSOC)){
            $oppo = new OpponentObject($oppoArray);
            $opposListObj->append($oppo);
        }

        return $opposListObj;
    }

    public function getOppo($id){
        $query = $this->db->prepare('SELECT * FROM OPPONENT WHERE OPPONENTID = :oppoid');
        $query->bindValue(':oppoid',$id);
        $query->execute();

        return new OpponentObject($query->fetch(\PDO::FETCH_ASSOC));
    }

    public function AddOppo($oppo){
        $oppo = new OpponentObject($oppo);

        $query = $this->db->prepare('INSERT INTO OPPONENT(NAME, LOGO) VALUES (:name, :logo)');
        $query->bindValue(':name',$oppo->getName());
        $query->bindValue(':logo', $oppo->getLogo());
        $query->execute();

    }

    public function DeleteOppo($id){
        $opponent = $this->getOppo($id);

        if ( $opponent->getName() != null){
            $query = $this->db->prepare('DELETE FROM OPPONENT WHERE OPPONENTID = :oppoid');
            $query->bindValue(':oppoid', $id);
            $query->execute();
        }
        else {
            throw new \Exception("L'adversaire que vous tentez de supprimer n'existe pas/plus_/MyTeamStats/OppoList_Retour à la liste des adversaires");
        }


    }

    public function UpdateOppo($oppo){
        $oppo = new OpponentObject($oppo);
        $query = $this->db->prepare('UPDATE OPPONENT SET NAME = :name, LOGO = :logo WHERE OPPONENTID = :oppoid');
        $query->bindValue(':name', $oppo->getName());
        $query->bindValue(':logo', $oppo->getLogo());
        $query->bindValue(':oppoid', $oppo->getOpponentid());
        $query->execute();

    }
}