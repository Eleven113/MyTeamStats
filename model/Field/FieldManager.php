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
            $field = new FieldObject($fieldArray);
            $fieldListObj->append($field);
        }

        return $fieldListObj;
    }

    public function getField($id){
        $query = $this->db->prepare("SELECT * FROM FIELD WHERE FIELDID = :fieldid");
        $query->bindValue(':fieldid', $id);
        $query->execute();

        return new FieldObject($query->fetch(PDO::FETCH_ASSOC));
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
        $query = $this->db->prepare("DELETE FROM FIELD WHERE FIELDID = :fieldid");
        $query->bindValue(':fieldid', $id);

        $query->execute();
    }
}