<?php


class Goal
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
     */
    public function setGoalid($goalid)
    {
        $this->goalid = $goalid;
    }

    /**
     * @param mixed $scoreid
     */
    public function setScorerid($scorerid)
    {
        $this->scorerid = $scorerid;
    }

    /**
     * @param mixed $passerid
     */
    public function setPasserid($passerid)
    {
        $this->passerid = $passerid;
    }

    /**
     * @param mixed $matchid
     */
    public function setMatchid($matchid)
    {
        $this->matchid = $matchid;
    }

    /**
     * @param mixed $periodnum
     */
    public function setPeriodnum($periodnum)
    {
        $this->periodnum = $periodnum;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @param mixed $bodypart
     */
    public function setBodypart($bodypart)
    {
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


}