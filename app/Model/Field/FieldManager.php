<?php

namespace MyTeamStats\Model\Field;

class FieldManager
{
    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function countFields()
    {
        return $this->db->query('SELECT COUNT(*) FROM FIELD')->fetchColumn();
    }

    public function getFieldsList($limit){
        $fieldsList = $this->db->prepare('SELECT * FROM FIELD LIMIT :offset, :limit');
        $fieldsList->bindValue(':offset', 0, \PDO::PARAM_INT);
        $fieldsList->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $fieldsList->execute();

        $fieldListObj = new \ArrayObject();
        while ($fieldArray = $fieldsList->fetch(\PDO::FETCH_ASSOC)){
            $field = new FieldObject($fieldArray);
            $fieldListObj->append($field);
        }

        return $fieldListObj;
    }

    public function getFieldsFullList(){
        $fieldsList = $this->db->query('SELECT * FROM FIELD');

        $fieldListObj = new \ArrayObject();
        while ($fieldArray = $fieldsList->fetch(\PDO::FETCH_ASSOC)){
            $field = new FieldObject($fieldArray);
            $fieldListObj->append($field);
        }

        return $fieldListObj;
    }

    public function getMoreFieldsList($limit,$offset)
    {
        $fieldsList = $this->db->prepare('SELECT * FROM FIELD LIMIT :offset , :limit');
        $fieldsList->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $fieldsList->bindValue(':offset', (int) $offset, \PDO::PARAM_INT);
        $fieldsList->execute();

        $fieldsListObj = new \ArrayObject();
        while ($fieldArray = $fieldsList->fetch(\PDO::FETCH_ASSOC)){
            $field = new FieldObject($fieldArray);
            $fieldsListObj->append($field);
        }

        return $fieldsListObj;
    }

    public function getField($id){
        $query = $this->db->prepare("SELECT * FROM FIELD WHERE FIELDID = :fieldid");
        $query->bindValue(':fieldid', $id);
        $query->execute();

        return new FieldObject($query->fetch(\PDO::FETCH_ASSOC));
    }

    public function AddField($field){
        $field = new FieldObject($field);
        $query = $this->db->prepare('INSERT INTO FIELD (NAME, ADDRESS, ZIPCODE, CITY, TURF) VALUES (:name, :address, :zipcode, :city, :turf)');
        $query->bindValue(':name', $field->getName());
        $query->bindValue(':address', $field->getAddress());
        $query->bindValue(':zipcode', $field->getZipcode());
        $query->bindValue(':city', $field->getCity());
        $query->bindValue(':turf', $field->getTurf());

        $query->execute();
    }

    public function UpdateField($field){

        $field = new FieldObject($field);

        $query = $this->db->prepare('UPDATE FIELD SET NAME = :name, ADDRESS = :address, ZIPCODE = :zipcode, CITY = :city, TURF = :turf WHERE FIELDID = :fieldid');
        $query->bindValue(':fieldid', $field->getFieldid());
        $query->bindValue(':name', $field->getName());
        $query->bindValue(':address', $field->getAddress());
        $query->bindValue(':zipcode', $field->getZipcode());
        $query->bindValue(':city', $field->getCity());
        $query->bindValue(':turf', $field->getTurf());

        $query->execute();
    }

    public function DeleteField($id){
        $field = $this->getField($id);

        if ( $field->getName() != null){
            $query = $this->db->prepare("DELETE FROM FIELD WHERE FIELDID = :fieldid");
            $query->bindValue(':fieldid', $id);

            $query->execute();
        }
        else {
            throw new \Exception("Le terrain que vous tentez de supprimer n'existe pas/plus_/MyTeamStats/FieldsList_Retour à la liste des terrains");
        }

    }
}