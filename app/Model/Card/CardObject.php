<?php

namespace MyTeamStats\Model\Card;

class CardObject implements \JsonSerializable
{
    private $cardid;
    private $playerid;
    private $matchid;
    private $periodnum;
    private $color;
    private $time;

    // GETTER

    /**
     * @return mixed
     */
    public function getCardid()
    {
        return $this->cardid;
    }

    /**
     * @return mixed
     */
    public function getPlayerid()
    {
        return $this->playerid;
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
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }


    // SETTER

    /**
     * @param mixed $cardid
     * @throws
     */
    public function setCardid($cardid)
    {
        $cardid = (int) $cardid;
        if ( !is_int($cardid)){
            throw new \Exception("L'id du carton doit être un nombre entier");
        }
        $this->cardid = $cardid;
    }

    /**
     * @param mixed $playerid
     * @throws
     */
    public function setPlayerid($playerid)
    {
        $playerid = (int) $playerid;
        if ( !is_int($playerid)){
            throw new \Exception("L'id du joueur doit être un nombre entier");
        }
        $this->playerid = $playerid;

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
        if ($periodnum >= 0 && $periodnum <= 4){
            $this->periodnum = $periodnum;
        }
        else {
            throw new \Exception("Le numéro de période est incorrecte");
        }
    }


    /**
     * @param mixed $color
     * @throws
     */
    public function setColor($color)
    {
        if ( $color == "rouge" || $color = "jaune"){
            $this->color = $color;
        }
        else {
            throw new \Exception("La couleur du carton est incorrecte");
        }

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
        foreach ($match as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    public function jsonSerialize(){
        return get_object_vars($this);

        }


}