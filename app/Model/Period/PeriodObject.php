<?php

namespace MyTeamStats\Model\Period;

class PeriodObject implements \JsonSerializable
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
        if ( !is_int($periodnum)){
            trigger_error("Le numéro de période doit être un nombre entier", E_USER_NOTICE);
        }
        $this->periodnum = $periodnum;
    }

    /**
     * @param mixed $homescore
     */
    public function setHomescore($homescore)
    {
        if ( !is_int($homescore)){
            trigger_error("Le score doit être un nombre entier", E_USER_NOTICE);
        }
        $this->homescore = $homescore;
    }

    /**
     * @param mixed $awayscore
     */
    public function setAwayscore($awayscore)
    {
        if ( !is_int($awayscore)){
            trigger_error("Le score doit être un nombre entier", E_USER_NOTICE);
        }
        $this->awayscore = $awayscore;
    }

    /**
     * @param mixed $missshot
     */
    public function setMissshot($missshot)
    {
        if ( !is_int($missshot)){
            trigger_error("Tirs ratés doit être un nombre entier", E_USER_NOTICE);
        }
        $this->missshot = $missshot;
    }

    /**
     * @param mixed $shotontarget
     */
    public function setShotontarget($shotontarget)
    {
        if ( !is_int($shotontarget)){
            trigger_error("Tirs réussis doit être un nombre entier", E_USER_NOTICE);
        }
        $this->shotontarget = $shotontarget;
    }

    /**
     * @param mixed $misspass
     */
    public function setMisspass($misspass)
    {
        if ( !is_int($misspass)){
            trigger_error("Passes ratées doit être un nombre entier", E_USER_NOTICE);
        }
        $this->misspass = $misspass;
    }

    /**
     * @param mixed $successpass
     */
    public function setSuccesspass($successpass)
    {
        if ( !is_int($successpass)){
            trigger_error("Passes réussies doit être un nombre entier", E_USER_NOTICE);
        }
        $this->successpass = $successpass;
    }

    /**
     * @param mixed $foul
     */
    public function setFoul($foul)
    {
        if ( !is_int($foul)){
            trigger_error("Fautes doit être un nombre entier", E_USER_NOTICE);
        }
        $this->foul = $foul;
    }

    /**
     * @param mixed $cornerkick
     */
    public function setCornerkick($cornerkick)
    {
        if ( !is_int($cornerkick)){
            trigger_error("Corners doit être un nombre entier", E_USER_NOTICE);
        }
        $this->cornerkick = $cornerkick;
    }

    /**
     * @param mixed $lostball
     */
    public function setLostball($lostball)
    {
        if ( !is_int($lostball)){
            trigger_error("Balles perdues doit être un nombre entier", E_USER_NOTICE);
        }
        $this->lostball = $lostball;
    }

    /**
     * @param mixed $winball
     */
    public function setWinball($winball)
    {
        if ( !is_int($winball)){
            trigger_error("Balles gagnées doit être un nombre entier", E_USER_NOTICE);
        }
        $this->winball = $winball;
    }

    /**
     * @param mixed $offside
     */
    public function setOffside($offside)
    {
        if ( !is_int($offside)){
            trigger_error("Hors jeu doit être un nombre entier", E_USER_NOTICE);
        }
        $this->offside = $offside;
    }

    /**
     * @param mixed $freekick
     */
    public function setFreekick($freekick)
    {
        if ( !is_int($freekick)){
            trigger_error("Coups francs doit être un nombre entier", E_USER_NOTICE);
        }
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

    public function jsonSerialize(){
        return get_object_vars($this);

    }

}