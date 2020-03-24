<?php


class Period
{
    private $matchid;
    private $periodnum;
    private $homescore;
    private $awayscore;
    private $missshot;
    private $shotontarget;
    private $misspass;
    private $successpass;
    private $foul;
    private $cornerkick;
    private $lostball;
    private $winball;
    private $offside;
    private $freekick;

    // GETTER

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
    public function getHomescore()
    {
        return $this->homescore;
    }

    /**
     * @return mixed
     */
    public function getAwayscore()
    {
        return $this->awayscore;
    }

    /**
     * @return mixed
     */
    public function getMissshot()
    {
        return $this->missshot;
    }

    /**
     * @return mixed
     */
    public function getShotontarget()
    {
        return $this->shotontarget;
    }

    /**
     * @return mixed
     */
    public function getMisspass()
    {
        return $this->misspass;
    }

    /**
     * @return mixed
     */
    public function getSuccesspass()
    {
        return $this->successpass;
    }

    /**
     * @return mixed
     */
    public function getFoul()
    {
        return $this->foul;
    }

    /**
     * @return mixed
     */
    public function getCornerkick()
    {
        return $this->cornerkick;
    }

    /**
     * @return mixed
     */
    public function getLostball()
    {
        return $this->lostball;
    }

    /**
     * @return mixed
     */
    public function getWinball()
    {
        return $this->winball;
    }

    /**
     * @return mixed
     */
    public function getOffside()
    {
        return $this->offside;
    }

    /**
     * @return mixed
     */
    public function getFreekick()
    {
        return $this->freekick;
    }


    // SETTER

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
     * @param mixed $homescore
     */
    public function setHomescore($homescore)
    {
        $this->homescore = $homescore;
    }

    /**
     * @param mixed $awayscore
     */
    public function setAwayscore($awayscore)
    {
        $this->awayscore = $awayscore;
    }

    /**
     * @param mixed $missshot
     */
    public function setMissshot($missshot)
    {
        $this->missshot = $missshot;
    }

    /**
     * @param mixed $shotontarget
     */
    public function setShotontarget($shotontarget)
    {
        $this->shotontarget = $shotontarget;
    }

    /**
     * @param mixed $misspass
     */
    public function setMisspass($misspass)
    {
        $this->misspass = $misspass;
    }

    /**
     * @param mixed $successpass
     */
    public function setSuccesspass($successpass)
    {
        $this->successpass = $successpass;
    }

    /**
     * @param mixed $foul
     */
    public function setFoul($foul)
    {
        $this->foul = $foul;
    }

    /**
     * @param mixed $cornerkick
     */
    public function setCornerkick($cornerkick)
    {
        $this->cornerkick = $cornerkick;
    }

    /**
     * @param mixed $lostball
     */
    public function setLostball($lostball)
    {
        $this->lostball = $lostball;
    }

    /**
     * @param mixed $winball
     */
    public function setWinball($winball)
    {
        $this->winball = $winball;
    }

    /**
     * @param mixed $offside
     */
    public function setOffside($offside)
    {
        $this->offside = $offside;
    }

    /**
     * @param mixed $freekick
     */
    public function setFreekick($freekick)
    {
        $this->freekick = $freekick;
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