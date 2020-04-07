<?php

namespace MyTeamStats\Model\Goal;

class GoalObject implements \JsonSerializable
{
    private $goalid;
    private $scorerid;
    private $passerid;
    private $matchid;
    private $periodnum;
    private $time;
    private $action;
    private $bodypart;

    // GETTER
    /**
     * @return mixed
     */
    public function getGoalid()
    {
        return $this->goalid;
    }

    /**
     * @return mixed
     */
    public function getScorerid()
    {
        return $this->scorerid;
    }

    /**
     * @return mixed
     */
    public function getPasserid()
    {
        return $this->passerid;
    }

    /**
     * @return mixed
     */
    public function getMatchid()
    {
        return $this->matchid;
    }

    /**
     * @return mixed
     */
    public function getPeriodnum()
    {
        return $this->periodnum;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getBodypart()
    {
        return $this->bodypart;
    }


    // SETTER

    /**
     * @param mixed $goalid
     * @throws
     */
    public function setGoalid($goalid)
    {
        $goalid = (int) $goalid;
        if ( !is_int($goalid)){
            throw new \Exception("L'id du but doit être un nombre entier");
        }
        $this->goalid = $goalid;
    }

    /**
     * @param mixed $scorerid
     * @throws
     */
    public function setScorerid($scorerid)
    {
        $scorerid = (int) $scorerid;
        if ( !is_int($scorerid)){
            throw new \Exception("L'id du buteur doit être un nombre entier");
        }
        $this->scorerid = $scorerid;
    }

    /**
     * @param mixed $passerid
     * @throws
     */
    public function setPasserid($passerid)
    {
        $passerid = (int) $passerid;
        if ( !is_int($passerid)){
            throw new \Exception("L'id du passeur doit être un nombre entier");
        }
        $this->passerid = $passerid;
    }

    /**
     * @param mixed $matchid
     * @throws
     */
    public function setMatchid($matchid)
    {
        $matchid = (int) $matchid;
        if ( !is_int($matchid)){
            throw new \Exception("L'id du match doit être un nombre entier");
        }
        $this->matchid = $matchid;
    }

    /**
     * @param mixed $periodnum
     * @throws
     */
    public function setPeriodnum($periodnum)
    {
        $periodnum = (int) $periodnum;
        if ( !is_int($periodnum)){
            throw new \Exception("Le numéro de période doit être un nombre entier");
        }
        $this->periodnum = $periodnum;
    }

    /**
     * @param mixed $time
     * @throws
     */
    public function setTime($time)
    {
        $time = (int) $time;
        if ( !is_int($time)){
            throw new \Exception("Le temps doit être un nombre entier");
        }
        $this->time = $time;
    }

    /**
     * @param mixed $action
     * @throws
     */
    public function setAction($action)
    {
        $values = ["Action de jeu", "Corner", "Coup franc", "Coup franc direct", "Penalty"];
        if ( !in_array($action, $values)){
            throw new \Exception("Le type d'action est incorrect");
        }
        $this->action = $action;
    }

    /**
     * @param mixed $bodypart
     * @throws
     */
    public function setBodypart($bodypart)
    {
        $values = ["Pied droit", "Pied gauche", "Tête", "CSC"];
        if ( !in_array($bodypart, $values)){
            throw new \Exception("Le type d'action est incorrect");
        }
        $this->bodypart = $bodypart;
    }


    // Constructor
    public function __construct($match = [])
    {
        if (!empty($match))
        {
            $this->hydrate($match);
        }
    }

    // Hydrate
    public function hydrate($match)
    {
        foreach ($match as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (is_callable([$this, $method]))
            {
                $this->$method($value);
            }
        }
    }

    public function jsonSerialize(){
        return get_object_vars($this);

    }

}