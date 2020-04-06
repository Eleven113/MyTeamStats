<?php

namespace MyTeamStats\Model\User;

class UserObject implements \JsonSerializable
{
    private $lastname;
    private $firstname;
    private $mail;
    private $password;
    private $status;
    private $userid;
    private $token;

    // GETTER

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
    public function getLastname()
    {
        return $this->lastname;
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
    public function getPassword()
    {
        return $this->password;
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
    public function getUserid()
    {
        return $this->userid;
    }

        /**
         * @return mixed
         */
    public function getToken()
    {
        return $this->token;
    }

    // SETTER

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        if ( !is_string($firstname)){
            trigger_error("Le prénom de l'utilisateur doit contenir plusieurs caractères", E_USER_NOTICE);
        }
        $this->firstname = $firstname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        if ( !is_string($lastname)){
            trigger_error("Le nom de l'utilisateur doit contenir plusieurs caractères", E_USER_NOTICE);
        }
        $this->lastname = $lastname;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->mail = $mail;
        }
        else {
            trigger_error("Le format du mail saisi est incorrect", E_USER_NOTICE);
        }
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
    * @param mixed $token
    */
    public function setToken($token)
    {
        $this->token = $token;
    }

    // Constructor
    public function __construct($user = [])
    {
        if (!empty($user))
        {
            $this->hydrate($user);
        }
    }

    // Hydrate
    public function hydrate($user)
    {
        foreach ($user as $key => $value)
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