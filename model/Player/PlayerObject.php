<?php 


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
    private $category;
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

    public function getCategory() {
        return $this->category;
    }

    public function getPoste() {
        return $this->poste;
    }


    // SETTER

	public function setPlayerid($playerid) {
		$this->playerid = $playerid;
    }
    
    public function setLicence($licence) {
		$this->licence = $licence;
    }

    public function setLastname($lastname) {
		$this->lastname = $lastname;
    }
    
    public function setFirstname($firstname) {
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
		$this->phonenum = $phonenum;
    }
    
    public function setMail($mail) {
		$this->mail = $mail;
    }
    
    public function setPhoto($photo) {
		$this->photo = $photo;
	}

    public function setCategory($category) {
        $this->category = $category;
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