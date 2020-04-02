<?php

namespace MyTeamStats\Model\Composition;

class CompositionObject implements \JsonSerializable
{
    private $gameid;
    private $playerid;
    private $lastname;
    private $firstname;
    private $mail;
    private $activelicence;
    private $category;

    // GETTER

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
    public function getPlayerid()
    {
        return $this->playerid;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getActivelicence()
    {
        return $this->activelicence;
    }/**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    // SETTER

    /**
     * @param mixed $gameid
     */
    public function setGameid($gameid)
    {
        $this->gameid = $gameid;
    }


    /**
     * @param mixed $playerid
     */
    public function setPlayerid($playerid)
    {
        $this->playerid = $playerid;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param mixed $activelicence
     */
    public function setActivelicence($activelicence)
    {
        $this->activelicence = $activelicence;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }


    // Constructor
    public function __construct($player = [])
    {
        if (!empty($player))
        {
            $this->hydrate($player);
        }
    }

    // Hydrate
    public function hydrate($player)
    {
        foreach ($player as $key => $value)
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