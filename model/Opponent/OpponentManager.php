<?php



class OpponentManager
{


    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    public function getOppoList(){
        $oppoList = $this->db->query('SELECT * FROM OPPONENT');
        $oppoListObj = new ArrayObject();
        while ($oppoArray = $oppoList->fetch(PDO::FETCH_ASSOC)){
            $oppo = new Opponent($oppoArray);
            $oppoListObj->append($oppo);
        }

        return $oppoListObj;
    }

    public function getOppo($id){
        $query = $this->db->prepare('SELECT * FROM OPPONENT WHERE OPPOID = :oppoid');
        $query->bindValue(':oppoid',$id);
        $query->execute();

        return new Opponent($query->fetch(PDO::FETCH_ASSOC));
    }

    public function AddOppo($oppo){
        $oppo = new Opponent($oppo);

        $query = $this->db->prepare('INSERT INTO OPPONENT(NAME, LOGO) VALUES (:name, :logo)');
        $query->bindValue(':name',$oppo->getName());
        $query->bindValue(':logo', $oppo->getLogo());
        $query->execute();

    }

    public function DeleteOppo(){

    }

    public function UpdateOppo($oppo){
        $oppo = new Opponent($oppo);
        $query = $this->db->prepare('UPDATE OPPONENT SET NAME = :name, LOGO = :logo WHERE OPPOID = :oppoid');
        $query->bindValue(':name', $oppo->getName());
        $query->bindValue(':logo', $oppo->getLogo());
        $query->bindValue(':oppoid', $oppo->getOppoid());
        $query->execute();
        
    }
}