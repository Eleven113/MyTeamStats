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
     */
    public function setFieldid($fieldid)
    {
        $this->fieldid = $fieldid;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        if ( !is_string($name)){
            trigger_error("Le nom du terrain doit contenir plusieurs caractéres", E_USER_NOTICE);
        }

        $this->name = $name;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        if ( !is_string($address)){
            trigger_error("L'adresse doit contenir plusieurs caractéres", E_USER_NOTICE);
        }
        $this->address = $address;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        if ( is_int($zipcode)){
            trigger_error("Le code postal ne peut contenir que des chiffres", E_USER_NOTICE);
        }
        $this->zipcode = $zipcode;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        if ( !is_string($city)){
            trigger_error("Le nom de la ville doit contenir plusieurs caractéres", E_USER_NOTICE);
        }
        $this->city = $city;
    }

    /**
     * @param mixed $turf
     */
    public function setTurf($turf)
    {
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