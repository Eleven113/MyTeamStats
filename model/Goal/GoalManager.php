<?php


class GoalManager
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function AddGoal($goal){
        $goal = new Goal($goal);

        if ( $goal->getPasserid() == "null" ){
            echo 'null';
            $req = $this->db->prepare('INSERT INTO GOAL (SCORERID, MATCHID, PERIODNUM, TIME, ACTION, BODYPART) VALUES (:scorerid, :matchid, :periodnum, :time, :action, :bodypart)');
            $req->bindValue(':scorerid', $goal->getScorerid());
            $req->bindValue(':matchid', $goal->getMatchid());
            $req->bindValue(':periodnum', $goal->getPeriodnum());
            $req->bindValue(':time', $goal->getTime());
            $req->bindValue(':action', $goal->getAction());
            $req->bindValue(':bodypart', $goal->getBodypart());

            $req->execute();
        }
        else {
            echo 'not null';
            $req = $this->db->prepare('INSERT INTO GOAL (SCORERID, PASSERID, MATCHID, PERIODNUM, TIME, ACTION, BODYPART) VALUES (:scorerid, :passerid, :matchid, :periodnum, :time, :action, :bodypart)');
            $req->bindValue(':scorerid', $goal->getScorerid());
            $req->bindValue(':passerid', $goal->getPasserid());
            $req->bindValue(':matchid', $goal->getMatchid());
            $req->bindValue(':periodnum', $goal->getPeriodnum());
            $req->bindValue(':time', $goal->getTime());
            $req->bindValue(':action', $goal->getAction());
            $req->bindValue(':bodypart', $goal->getBodypart());

            $req->execute();
        }
    }
}