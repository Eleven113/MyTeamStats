<?php

namespace MyTeamStats\Model\Goal;

class GoalManager
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function AddGoal($goal){
        $goal = new GoalObject($goal);

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

    public function getGoalsList($matchid){
        $goalsList = $this->db->prepare('SELECT * FROM GOAL WHERE MATCHID = :matchid');
        $goalsList->bindValue(':matchid', $matchid);
        $goalsList->execute();

        $goalsListObj = new \ArrayObject();

        while ($goalArray = $goalsList->fetch(\PDO::FETCH_ASSOC)){
            $goal = new GoalObject($goalArray);
            $goalsListObj->append($goal);
        }

        return $goalsListObj;
    }

    public function CountGoal($id){
        $goal = $this->db->prepare('SELECT COUNT(*) FROM GOAL WHERE SCORERID = :scorerid');
        $goal->bindValue(':scorerid', $id);
        $goal->execute();

        return $goal->fetchColumn();
    }

    public function CountPass($id){
        $pass = $this->db->prepare('SELECT COUNT(*) FROM GOAL WHERE PASSERID = :passerid');
        $pass->bindValue(':passerid', $id);
        $pass->execute();

        return $pass->fetchColumn();
    }
}