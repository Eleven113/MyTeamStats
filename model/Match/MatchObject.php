<?php

namespace MyTeamStats\Model\Match;

class MatchObject
{
    private $gameid;
    private $opponentid;
    private $category;
    private $date;
    private $fieldid;
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
    public function getFieldid()
    {
        return $this->fieldid;
    }

    /**
     * @return mixed
     */
    public function getGameid()
    {
        return $this->gameid;
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
     * @return mixed
     */
    public function getOpponentid()
    {
        return $this->opponentid;
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
     * @param mixed $fieldid
     */
    public function setFieldid($fieldid)
    {
        $this->fieldid = $fieldid;
    }

    /**
     * @param mixed $gameid
     */
    public function setGameid($gameid)
    {
        $this->gameid = $gameid;
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

    /**
     * @param mixed $oppoid
     */
    public function setOpponentid($opponentid)
    {
        $this->opponentid = $opponentid;
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