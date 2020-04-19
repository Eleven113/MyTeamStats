<?php

namespace MyTeamStats\Model\Opponent;

class OpponentObject implements \JsonSerializable
{
    private $opponentid;
    private $name;
    private $logo;

    // GETTER

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getOpponentid()
    {
        return $this->opponentid;
    }

    // SETTER

    /**
     * @param mixed $logo
     * @throws
     */
    public function setLogo($logo)
    {
        if ( !is_string($logo)){
            throw new  \Exception("L'url du logo doit contenir plusieurs caractères");
        }
        $this->logo = $logo;
    }

    /**
     * @param mixed $name
     * @throws
     */
    public function setName($name)
    {
        if ( !is_string($name)){
            throw new  \Exception("Le nom de l'adversaire doit contenir plusieurs caractères");
        }
        $this->name = $name;
    }

    /**
     * @param mixed $opponentid
     * @throws
     */
    public function setOpponentid($opponentid)
    {
        $opponentid = (int) $opponentid;
        if ( !is_int($opponentid) || $opponentid < 0 ){
            throw new \Exception("L'id de l'adversaire doit être un nombre entier");
        }
        $this->opponentid = $opponentid;
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