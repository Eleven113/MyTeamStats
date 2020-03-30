<?php


class MatchDisplay implements JsonSerializable
{
    private $category;
    private $date;
    private $athome;
    private $periodnum;
    private $type;
    private $periodduration;
    private $status;
    private $oppo;
    private $logo;
    private $address;
    private $zipcode;
    private $city;
    private $turf;
    private $gameid;
    private $homescore;
    private $awayscore;

    // SETTER

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
    public function getAthome()
    {
        return $this->athome;
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
    public function getPeriodduration()
    {
        return $this->periodduration;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getOppo()
    {
        return $this->oppo;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getTurf()
    {
        return $this->turf;
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


    // SETTER


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
     * @param mixed $athome
     */
    public function setAthome($athome)
    {
        $this->athome = $athome;
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
     * @param mixed $periodduration
     */
    public function setPeriodduration($periodduration)
    {
        $this->periodduration = $periodduration;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $oppo
     */
    public function setOppo($oppo)
    {
        $this->oppo = $oppo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $turf
     */
    public function setTurf($turf)
    {
        $this->turf = $turf;
    }

    /**
     * @param mixed $gameid
     */
    public function setGameid($gameid)
    {
        $this->gameid = $gameid;
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