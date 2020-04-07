<?php

namespace MyTeamStats\Model\Field;

class FieldObject
{
    private $fieldid;
    private $name;
    private $address;
    private $zipcode;
    private $city;
    private $turf;

    // GETTER

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
    public function getName()
    {
        return $this->name;
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

    // SETTER

    /**
     * @param mixed $fieldid
     * @throws
     */
    public function setFieldid($fieldid)
    {
        if ( !is_int($fieldid)){
            throw new \Exception("L'id du terrain doit être un nombre entier'");
        }
        $this->fieldid = $fieldid;
    }

    /**
     * @param mixed $name
     * @throws
     */
    public function setName($name)
    {
        if ( !is_string($name)){
            throw new \Exception("Le nom du terrain doit contenir plusieurs caractéres");
        }
        $this->name = $name;
    }

    /**
     * @param mixed $address
     * @throws
     */
    public function setAddress($address)
    {
        if ( !is_string($address)){
            throw new \Exception("L'adresse doit contenir plusieurs caractéres");
        }
        $this->address = $address;
    }

    /**
     * @param mixed $zipcode
     * @throws
     */
    public function setZipcode($zipcode)
    {
        if ( is_int($zipcode)){
            throw new \Exception("Le code postal ne peut contenir que des chiffres");
        }
        $this->zipcode = $zipcode;
    }

    /**
     * @param mixed $city
     * @throws
     */
    public function setCity($city)
    {
        if ( !is_string($city)){
            throw new \Exception("Le nom de la ville doit contenir plusieurs caractéres");
        }
        $this->city = $city;
    }

    /**
     * @param mixed $turf
     * @throws
     */
    public function setTurf($turf)
    {
        $values = ["Naturelle", "Synthétique", "Salle"];
        if ( !in_array($turf, $values)){
            throw new \Exception("La type de terrain est incorrecte");
        }
        $this->turf = $turf;
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