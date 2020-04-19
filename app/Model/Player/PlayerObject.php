<?php

namespace MyTeamStats\Model\Player;

Class PlayerObject implements \JsonSerializable{

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
	    $playerid = (int) $playerid;
	    if ( !is_int($playerid)){
	        throw new \Exception("L'id du joueur doit être un nombre entier");
        }
		$this->playerid = $playerid;
    }
    
    public function setLicence($licence) {
        $licence = (int) $licence;
	    if ( !is_numeric($licence)){
	        throw new \Exception("Le numéro de licence doit être un nombre entier");
        }
		$this->licence = $licence;
    }

    public function setLastname($lastname) {
	    if ( !is_string($lastname)){
	        throw new \Exception("Le nom du joueur doit contenir plusieurs caractères");
        }
		$this->lastname = $lastname;
    }
    
    public function setFirstname($firstname) {
        if ( !is_string($firstname)){
            throw new \Exception("Le prénom du joueur doit contenir plusieurs caractères");
        }
		$this->firstname = $firstname;
    }
    
    public function setBirthdate($birthdate) {

		$this->birthdate = $birthdate;
    }
    
    public function setActivelicence($activelicence) {
        $activelicence = (int) $activelicence;
        if ( $activelicence != 0 && $activelicence != 1){
            throw new \Exception("L'indicateur de licence active est incorrecte");
        }
        $this->activelicence = $activelicence;
    }
    
    public function setAddress($address) {
        if ( !is_string($address)){
            throw new \Exception("L'adresse doit contenir plusieurs caractères");
        }
		$this->address = $address;
    }
    
    public function setPhonenum($phonenum) {
	    $phoneLength = strlen((string)$phonenum);

	    if ( !is_numeric($phonenum) || $phoneLength != 10 ){
	        throw new \Exception("Le numéro de téléphone est incorrect");
        }
		$this->phonenum = $phonenum;
    }
    
    public function setMail($mail) {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->mail = $mail;
        }
        else {
            throw new \Exception("Le format du mail est incorrect");
        }
    }
    
    public function setPhoto($photo) {
        if ( !is_string($photo)){
            throw new \Exception("L'url de la photo doit contenir plusieurs caractères");
        }
		$this->photo = $photo;
	}

    public function setPoste($poste) {
	    $values = ["Attaquant", "Milieu", "Défenseur", "Gardien"];
	    if ( !in_array($poste, $values)){
	        throw new \Exception("Le poste du joueur est incorrect");
        }
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

    public function jsonSerialize(){
        return get_object_vars($this);

    }


}