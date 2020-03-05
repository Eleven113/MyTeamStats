<?php


class UserManager
{

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function AddUser($user)
    {
        $user = new User($user);
        $query = $this->db->prepare('INSERT INTO USER(LASTNAME, FIRSTNAME, MAIL, PASSWORD, STATUS) VALUES (:lastname, :firstname, :mail, :password, :status)');

        $query->bindValue(':lastname', $user->getLastname());
        $query->bindValue(':firstname', $user->getFirstname());
        $query->bindValue(':mail', $user->getMail());
        $query->bindValue(':password', $user->getPwd());
        $query->bindValue(':status', 1);

        $query->execute();

    }

    public function UserLogin($mail, $pwd){

        $userPDO = $this->db->prepare('SELECT * FROM USER WHERE MAIL = :mail');
        $userPDO->bindValue(':mail', $mail);
        $userArray = $userPDO->fetch(PDO::FETCH_ASSOC);
        $user = new User($userArray);

        empty($user);
    }

}