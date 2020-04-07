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
     * @throws
     */
    public function setFirstname($firstname)
    {
        if ( !is_string($firstname)){
            throw new \Exception("Le prénom de l'utilisateur doit contenir plusieurs caractères");
        }
        $this->firstname = $firstname;
    }

    /**
     * @param mixed $lastname
     * @throws
     */
    public function setLastname($lastname)
    {
        if ( !is_string($lastname)){
            throw new \Exception("Le nom de l'utilisateur doit contenir plusieurs caractères");
        }
        $this->lastname = $lastname;
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
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $status
     * @throws
     */
    public function setStatus($status)
    {
        $status = (int) $status;
        if ( !is_int($status)){
            throw new \Exception("Le status de l'utilisateur doit être un nombre entier");
        }
        $this->status = $status;
    }

    /**
     * @param mixed $userid
     * @throws
     */
    public function setUserid($userid)
    {
        $userid = (int) $userid;
        if ( !is_int($userid)){
            throw new \Exception("L'id de l'utilisateur doit être un nombre entier");
        }
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