<?php


class Opponent
{
    private $oppoid;
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
    public function getOppoid()
    {
        return $this->oppoid;
    }

    // SETTER

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $oppoid
     */
    public function setOppoid($oppoid)
    {
        $this->oppoid = $oppoid;
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
}