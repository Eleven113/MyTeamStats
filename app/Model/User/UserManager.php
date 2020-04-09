<?php

namespace MyTeamStats\Model\User;

class UserManager
{

    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function AddUser($user)
    {
        $user = new UserObject($user);
        $query = $this->db->prepare('INSERT INTO USER(LASTNAME, FIRSTNAME, MAIL, PASSWORD, STATUS) VALUES (:lastname, :firstname, :mail, :password, :status)');

        $query->bindValue(':lastname', $user->getLastname());
        $query->bindValue(':firstname', $user->getFirstname());
        $query->bindValue(':mail', $user->getMail());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':status', 1);

        $query->execute();

        $title = "Confirmation d'inscription";

        $message = "Bonjour ". $user->getFirstname().PHP_EOL."Vous êtes désormais inscrit sur MyTeamStats. Et ça... c'est vraiment bien";

        $mail = new \MyTeamStats\Model\Mailer($user->getMail(), $title, $message);

    }

    public function UserLogin($mail, $pwd){

        $userPDO = $this->db->prepare('SELECT * FROM USER WHERE MAIL = :mail ');
        $userPDO->bindValue(':mail', $mail );
        $userPDO->execute();
        $userArray = $userPDO->fetch(\PDO::FETCH_ASSOC);

        $user = new UserObject($userArray);

        if (empty($user->getMail())){
            $login = False;
        }
        else {
            if (password_verify($pwd, $user->getPassword())) {
                $login = True;
                $_SESSION['user_lastname'] = $user->getLastname();
                $_SESSION['user_firstname'] = $user->getFirstname();
                $_SESSION['user_mail'] = $user->getMail();
                $_SESSION['user_status'] = $user->getStatus();
            }
            else {
                $login = False;
            }
        }

        return $login;
    }

     public function getUsersList(){
        $usersList = $this->db->query('SELECT * FROM USER');
        $usersListObj = new \ArrayObject();
        while ($userArray = $usersList->fetch(\PDO::FETCH_ASSOC)){
            $user = new UserObject($userArray);
            $usersListObj->append($user);
        }

        return $usersListObj;
     }

     public function DeleteUser($id){
        $user = $this->getUser($id);

        if ( $user->getFirstname() != null){
            $query = $this->db->prepare('DELETE FROM USER WHERE USERID = :userid');
            $query->bindValue(':userid', $id);
            $query->execute();
        }
        else {
            throw new \Exception("L'utilisateur que vous tentez de supprimer n'existe pas/plus_/MyTeamStats/UserList_Retour à la liste des utilisateurs");
        }


     }

    public function getUser($id)
    {
        $query = $this->db->prepare('SELECT * FROM USER WHERE USERID = :userid');
        $query->bindValue(':userid', $id);
        $query->execute();
        return new UserObject($query->fetch(\PDO::FETCH_ASSOC));

    }

    public function UpdateUser($user){

        $user = new UserObject($user);

        $query = $this->db->prepare('UPDATE USER SET LASTNAME = :lastname, FIRSTNAME = :firstname, MAIL = :mail, STATUS = :status WHERE USERID = :userid');
        $query->bindValue(':userid', $user->getUserid());
        $query->bindValue(':lastname', $user->getLastname());
        $query->bindValue(':firstname', $user->getFirstname());
        $query->bindValue(':mail', $user->getMail());
        $query->bindValue(':status', $user->getStatus());

        $query->execute();
    }

    public function ResetPassword($mail)
    {
        $usersList = $this->getUsersList();
        $inList = false;

        for ($i = 0; $i < count($usersList); $i++) {

            if ($mail == $usersList[$i]->getmail()) {
                $inList = true;
                $user = $i;
            }
        }

        if ($inList) {
            $token = uniqid();
            $query = $this->db->prepare('UPDATE USER SET TOKEN = :token WHERE MAIL = :mail');
            $query->bindValue(':token', $token);
            $query->bindValue(':mail', $mail);
            $query->execute();

            $title = 'Réinitialisation de votre mot de passe';
            $message = '<html>' .
                '  <body>' .
                '       Bonjour ' . $usersList[$user]->getFirstname() . ',' . '<br/><br/>' .
                '       Vous avez demandé la ré-initialisation de votre mot de passe' . '<br/><br/>' .
                '       Cliquez sur <a href="http://www.thibaut-minard.fr/MyTeamStats/ModifyPassword/' . $usersList[$user]->getMail() . '/' . $token . '">ce lien</a> pour définir un nouveau mot de passe' . '<br/><br/>' .
                'A bientôt, MyTeamStats' .
                '  </body>' .
                '</html>';

            $result = new \MyTeamStats\Model\Mailer($usersList[$user]->getMail(), $title, $message);
        }
    }

    public function CheckToken($mail, $token){
        $user = $this->db->prepare('SELECT TOKEN FROM USER WHERE MAIL = :mail');
        $user->bindValue(':mail', $mail);
        $user->execute();

        $user = new UserObject($user->fetch(\PDO::FETCH_ASSOC));

        if ($token == $user->getToken()){
            $check = true;
        }
        else {
            $check = false;
        }

        return $check;
    }

    public function UpdatePassword($user){
        $user = new UserObject($user);
        $query = $this->db->prepare('UPDATE USER SET PASSWORD = :password, TOKEN = :token WHERE MAIL = :mail');
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':token', null);
        $query->bindValue(':mail', $user->getMail());
        $query->execute();

    }

    public function getMails(){
        $mails = $this->db->query("SELECT MAIL FROM USER");
        $mailsListObj = new \ArrayObject();

        while ($mailArray = $mails->fetch(\PDO::FETCH_ASSOC)){
            $mail = new UserObject($mailArray);
            $mailsListObj->append($mail);
        }

        return $mailsListObj;
    }

}