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
     * @param mixed $homescore
     * @throws
     */
    public function setHomescore($homescore)
    {
        $homescore = (int) $homescore;
        if ( !is_int($homescore)){
            throw new \Exception("Le score doit être un nombre entier");
        }
        $this->homescore = $homescore;
    }

    /**
     * @param mixed $awayscore
     * @throws
     */
    public function setAwayscore($awayscore)
    {
        $awayscore = (int) $awayscore;
        if ( !is_int($awayscore)){
            throw new \Exception("Le score doit être un nombre entier");
        }
        $this->awayscore = $awayscore;
    }

    /**
     * @param mixed $missshot
     * @throws
     */
    public function setMissshot($missshot)
    {
        $missshot = (int) $missshot;
        if ( !is_int($missshot)){
            throw new \Exception("Tirs ratés doit être un nombre entier");
        }
        $this->missshot = $missshot;
    }

    /**
     * @param mixed $shotontarget
     * @throws
     */
    public function setShotontarget($shotontarget)
    {
        $shotontarget = (int) $shotontarget;
        if ( !is_int($shotontarget)){
            throw new \Exception("Tirs réussis doit être un nombre entier");
        }
        $this->shotontarget = $shotontarget;
    }

    /**
     * @param mixed $misspass
     * @throws
     */
    public function setMisspass($misspass)
    {
        $misspass = (int) $misspass;
        if ( !is_int($misspass)){
            throw new \Exception("Passes ratées doit être un nombre entier");
        }
        $this->misspass = $misspass;
    }

    /**
     * @param mixed $successpass
     * @throws
     */
    public function setSuccesspass($successpass)
    {
        $successpass = (int) $successpass;
        if ( !is_int($successpass)){
           throw new \Exception("Passes réussies doit être un nombre entier");
        }
        $this->successpass = $successpass;
    }

    /**
     * @param mixed $foul
     * @throws
     */
    public function setFoul($foul)
    {
        $foul = (int) $foul;
        if ( !is_int($foul)){
            throw new \Exception("Fautes doit être un nombre entier");
        }
        $this->foul = $foul;
    }

    /**
     * @param mixed $cornerkick
     * @throws
     */
    public function setCornerkick($cornerkick)
    {
        $cornerkick = (int) $cornerkick;
        if ( !is_int($cornerkick)){
            throw new \Exception("Corners doit être un nombre entier");
        }
        $this->cornerkick = $cornerkick;
    }

    /**
     * @param mixed $lostball
     * @throws
     */
    public function setLostball($lostball)
    {
        $lostball = (int) $lostball;
        if ( !is_int($lostball)){
            throw new \Exception("Balles perdues doit être un nombre entier");
        }
        $this->lostball = $lostball;
    }

    /**
     * @param mixed $winball
     * @throws
     */
    public function setWinball($winball)
    {
        $winball = (int) $winball;
        if ( !is_int($winball)){
            throw new \Exception("Balles gagnées doit être un nombre entier");
        }
        $this->winball = $winball;
    }

    /**
     * @param mixed $offside
     * @throws
     */
    public function setOffside($offside)
    {
        $offside = (int) $offside;
        if ( !is_int($offside)){
            throw new \Exception("Hors jeu doit être un nombre entier");
        }
        $this->offside = $offside;
    }

    /**
     * @param mixed $freekick
     * @throws
     */
    public function setFreekick($freekick)
    {
        $freekick = (int) $freekick;
        if ( !is_int($freekick)){
            throw new \Exception("Coups francs doit être un nombre entier");
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