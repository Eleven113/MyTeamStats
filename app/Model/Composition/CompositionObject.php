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
    }


    // SETTER

    /**
     * @param mixed $gameid
     * @throws
     */
    public function setGameid($gameid)
    {
        $gameid = (int) $gameid;
        if ( !is_int($gameid)){
            throw new \Exception("L'id du match doit être un nombre entier");
        }
        $this->gameid = $gameid;
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
     * @param mixed $lastname
     * @throws
     */
    public function setLastname($lastname)
    {
        if ( !is_string($lastname)){
            throw new \Exception("Le nom joueur doit contenir plusieurs caractères");
        }
        $this->lastname = $lastname;
    }

    /**
     * @param mixed $firstname
     * @throws
     */
    public function setFirstname($firstname)
    {
        if ( !is_string($firstname)){
            throw new \Exception("Le prénom joueur doit contenir plusieurs caractères");
        }
        $this->firstname = $firstname;
    }

    /**
     * @param mixed $mail
     * @throws
     */
    public function setMail($mail)
    {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->mail = $mail;
        }
        else {
            throw new \Exception("Le format du mail est incorrect");
        }
    }

    /**
     * @param mixed $activelicence
     * @throws
     */
    public function setActivelicence($activelicence)
    {
        $activelicence = (int) $activelicence;
        if ( $activelicence != 0 && $activelicence != 1){
            throw new \Exception("L'indicateur de licence active est incorrecte");
        }
        $this->activelicence = $activelicence;
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