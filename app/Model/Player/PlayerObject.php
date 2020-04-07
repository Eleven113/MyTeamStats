<?php

namespace MyTeamStats\Model\Player;

Class PlayerObject {

    private $playerid;
    private $licence;
    private $lastname;
    private $firstname;
    private $birthdate;
    private $activelicence;
    private $address;
    private $phonenum;
    private $mail;
    private $photo;
    private $poste;


    // GETTER

	public function getPlayerid() {
		return $this->playerid;
    }
    
    public function getLicence() {
		return $this->licence;
    }

    public function getLastname() {
		return $this->lastname;
    }
    
    public function getFirstname() {
		return $this->firstname;
    }
    
    public function getBirthdate() {
		return $this->birthdate;
    }
    
    public function getActivelicence() {
		return $this->activelicence;
    }
    
    public function getAddress() {
		return $this->address;
    }
    
    public function getPhonenum() {
		return $this->phonenum;
    }
    
    public function getMail() {
		return $this->mail;
    }
    
    public function getPhoto() {
		return $this->photo;
	}

    public function getPoste() {
        return $this->poste;
    }


    // SETTER

	public function setPlayerid($playerid) {
		$this->playerid = $playerid;
    }
    
    public function setLicence($licence) {
	    if ( !is_numeric($licence)){
	        trigger_error("Le numéro de licence doit être un nombre entier", E_USER_NOTICE);
        }
		$this->licence = $licence;
    }

    public function setLastname($lastname) {
	    if ( !is_string($lastname)){
	        trigger_error("Le nom du joueur doit contenir plusieurs caractères", E_USER_NOTICE);
        }
		$this->lastname = $lastname;
    }
    
    public function setFirstname($firstname) {
        if ( !is_string($firstname)){
            trigger_error("Le prénom du joueur doit contenir plusieurs caractères", E_USER_NOTICE);
        }
		$this->firstname = $firstname;
    }
    
    public function setBirthdate($birthdate) {

		$this->birthdate = $birthdate;
    }
    
    public function setActivelicence($activelicence) {
		$this->activelicence = $activelicence;
    }
    
    public function setAddress($address) {
		$this->address = $address;
    }
    
    public function setPhonenum($phonenum) {
	    $phoneLength = strlen((string)$phonenum);

	    if ( !is_numeric($phonenum) || $phoneLength != 10 ){
	        trigger_error("Le numéro de téléphone est incorrect", E_USER_NOTICE);
        }
		$this->phonenum = $phonenum;
    }
    
    public function setMail($mail) {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->mail = $mail;
        }
        else {
            trigger_error("Le format du mail est incorrect", E_USER_NOTICE);
        }
    }
    
    public function setPhoto($photo) {
		$this->photo = $photo;
	}

    public function setPoste($poste) {
        $this->poste = $poste;
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