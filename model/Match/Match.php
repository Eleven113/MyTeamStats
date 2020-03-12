<?php


class Match
{
    private $matchid;
    private $oppoid;
    private $category;
    private $date;
    private $location;
    private $atHome;
    private $type;
    private $periodnum;
    private $periodduration;
    private $status;

    // GETTER

    /**
     * @return mixed
     */
    public function getAtHome()
    {
        return $this->atHome;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
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
    public function getPeriodduration()
    {
        return $this->periodduration;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $oppoid
     */
    public function setOppoid($oppoid)
    {
        $this->oppoid = $oppoid;
    }

    /**
     * @return mixed
     */
    public function getOppoid()
    {
        return $this->oppoid;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    // SETTER

    /**
     * @param mixed $atHome
     */
    public function setAtHome($atHome)
    {
        $this->atHome = $atHome;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param mixed $matchid
     */
    public function setMatchid($matchid)
    {
        $this->matchid = $matchid;
    }

    /**
     * @param mixed $periodduration
     */
    public function setPeriodduration($periodduration)
    {
        $this->periodduration = $periodduration;
    }

    /**
     * @param mixed $periodnum
     */
    public function setPeriodnum($periodnum)
    {
        $this->periodnum = $periodnum;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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