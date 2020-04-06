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
     */
    public function setCardid($cardid)
    {
        $cardid = (int) $cardid;

        if ( $cardid >= 0) {
            $this->cardid = $cardid;
        }
    }

    /**
     * @param mixed $playerid
     */
    public function setPlayerid($playerid)
    {
        $playerid = (int) $playerid;

        if ( $playerid >= 0 ){
            $this->playerid = $playerid;
        }

    }

    /**
     * @param mixed $matchid
     */
    public function setMatchid($matchid)
    {
        $matchid = (int) $matchid;

        if ( $matchid >= 0 ){
            $this->matchid = $matchid;
        }
    }

    /**
     * @param mixed $periodnum
     */
    public function setPeriodnum($periodnum)
    {
        $periodnum = (int) $periodnum;

        if ($periodnum >= 0 && $periodnum <= 4){
            $this->periodnum = $periodnum;
        }
    }


    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        if ( $color == "rouge" || $color = "jaune"){
            $this->color = $color;
        }

    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $time = (int) $time;

        if ($time >= 0){
            $this->time = $time;
        }

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