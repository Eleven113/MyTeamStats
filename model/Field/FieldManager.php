<?php


class FieldManager
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getFieldsList(){
        $fieldsList = $this->db->query('SELECT * FROM FIELD');
        $fieldListObj = new ArrayObject();
        while ($fieldArray = $fieldsList->fetch(PDO::FETCH_ASSOC)){
            $field = new Field($fieldArray);
            $fieldListObj->append($field);
        }

        return $fieldListObj;
    }

    public function AddField($field){
        $field = new Field($field);
        $query = $this->db->prepare('INSERT INTO FIELD (NAME, ADDRESS, ZIPCODE, CITY, TURF) VALUES (:name, :address, :zipcode, :city, :turf)');
        $query->bindValue(':name', $field->getName());
        $query->bindValue(':address', $field->getAddress());
        $query->bindValue(':zipcode', $field->getZipcode());
        $query->bindValue(':city', $field->getCity());
        $query->bindValue(':turf', $field->getTurf());

        $query->execute();
    }
}