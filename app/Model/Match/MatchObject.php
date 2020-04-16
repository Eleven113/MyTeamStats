<?php

namespace MyTeamStats\Model\Match;

use mysql_xdevapi\Exception;

class MatchObject
{
    private $gameid;
    private $opponentid;
    private $category;
    private $date;
    private $fieldid;
    private $atHome;
    private $type;
    private $periodnum;
    private $periodduration;
    private $status;

    // GETTER

    /**
     * @return mixed
     */
    public function getAtHome()
    {
        return $this->atHome;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

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
    public function getGameid()
    {
        return $this->gameid;
    }

    /**
     * @return mixed
     */
    public function getPeriodduration()
    {
        return $this->periodduration;
    }

    /**
     * @return mixed
     */
    public function getPeriodnum()
    {
        return $this->periodnum;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getOpponentid()
    {
        return $this->opponentid;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    // SETTER

    /**
     * @param mixed $atHome
     * @throws
     */
    public function setAtHome($atHome)
    {
        $atHome = (int) $atHome;
        if ($atHome != 0 && $atHome != 1){
            throw new \Exception("Le statut du match est incorrect");
        }
        $this->atHome = $atHome;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $fieldid
     * @throws
     */
    public function setFieldid($fieldid)
    {
        $fieldid = (int) $fieldid;
        if ( !is_int($fieldid)){
            throw new \Exception("L'id du terrain doit être un nombre entier_/CreateMatch_Retour à la création de match");
        }
        $this->fieldid = $fieldid;
    }

    /**
     * @param mixed $gameid
     * @throws
     */
    public function setGameid($gameid)
    {
        $gameid = (int) $gameid;
        if ( !is_int($gameid)){
            throw new Exception("L'id du match doit être un nombre entier");
        }
        $this->gameid = $gameid;
    }

    /**
     * @param mixed $periodduration
     * @throws
     */
    public function setPeriodduration($periodduration)
    {
        $periodduration = (int) $periodduration;
        if ( !is_int($periodduration) || $periodduration < 0 ){
            throw new \Exception("La durée du match doit être un nombre entier_/CreateMatch_Retour à la création de match");
        }
        $this->periodduration = $periodduration;
    }

    /**
     * @param mixed $periodnum
     * @throws
     */
    public function setPeriodnum($periodnum)
    {
        $periodnum = (int) $periodnum;
        if ( !is_int($periodnum)){
            throw new \Exception("La durée du match doit être un nombre entier_/CreateMatch_Retour à la création de match");
        }
        $this->periodnum = $periodnum;
    }

    /**
     * @param mixed $type
     * @throws
     */
    public function setType($type)
    {
        $values = ["Championnat", "Coupe", "Futsal", "Tournoi", "Amical"];
        if (!in_array($type, $values)){
            throw new \Exception("Le type de match est incorrect_/CreateMatch_Retour à la création de match");
        }
        $this->type = $type;
    }

    /**
     * @param mixed $status
     * @throws
     */
    public function setStatus($status)
    {
        $status = (int) $status;
        if ($status != 0 && $status != 1){
            throw new \Exception("Le statut du match est incorrect_/CreateMatch_Retour à la création de match");
        }
        $this->status = $status;
    }

    /**
     * @param mixed $opponentid
     * @throws
     */
    public function setOpponentid($opponentid)
    {
        $opponentid = (int) $opponentid;
        if ( !is_int($opponentid)){
            throw new \Exception("L'id de l'adversaire doit être un nombre entier_/CreateMatch_Retour à la création de match");
        }
        $this->opponentid = $opponentid;
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