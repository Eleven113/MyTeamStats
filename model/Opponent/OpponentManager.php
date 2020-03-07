<?php



class OpponentManager
{


    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    public function OppoList(){

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

    public function UpdateOppo(){

    }
}