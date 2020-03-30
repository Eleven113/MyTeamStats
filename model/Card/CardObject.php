<?php


class CardObject implements JsonSerializable
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
        $this->cardid = $cardid;
    }

    /**
     * @param mixed $playerid
     */
    public function setPlayerid($playerid)
    {
        $this->playerid = $playerid;
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
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
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