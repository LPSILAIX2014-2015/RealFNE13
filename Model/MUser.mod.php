<?php
class MUser {

    private $sql;

    private $id;
    private $login;
    private $reset; //ToDo A passer dans une table externe temporaire
    private $association_id;
    private $theme_id;
    private $theme_interest_id;
    private $theme_details;
    private $role;
    private $name;
    private $surname;
    private $mail;
    private $address;
    private $cp;
    private $profession;
    private $profession2;
    private $presentation;
    private $photopath;

    function __construct ($id) {
        $this->sql = new MDBase();
        if (is_int($id+0))
        {
            $state = $this->sql->prepare("SELECT * FROM USER WHERE ID = :id;");
            $state->bindValue('id', $id, PDO::PARAM_INT);
        }
        else
        {
            $state = $this->sql->prepare("SELECT * FROM USER WHERE MAIL = :mail;");
            $state->bindValue('mail', $id, PDO::PARAM_STR);
        }


        $state->execute();
        $user = $state->fetch(PDO::FETCH_ASSOC);

        $this->id = $id;
        $this->login = $user['LOGIN'];
        //$this->reset = $user['RESET']; // ToDo a modif
        $this->association_id = $user['ASSOCIATION_ID'];
        $this->theme_interest_id = $user['THEME_INTEREST_ID'];
        $this->theme_details = $user['THEME_DETAILS'];
        $this->role = $user['ROLE'];
        $this->name = $user['NAME'];
        $this->surname = $user['SURNAME'];
        $this->mail = $user['MAIL'];
        $this->address = $user['ADRESS'];
        $this->cp = $user['CP'];
        $this->profession = $user['PROFESSION'];
        $this->profession2 = $user['PROFESSION2'];
        $this->presentation = $user['PRESENTATION'];
        $this->photopath = $user['PHOTOPATH'];
    }


    // Getters
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getLogin() { return $this->login; }
    public function getReset() { return $this->reset; }
    public function getAssociation() { return $this->association_id; }
    public function getThemeInterest() { return $this->theme_interest_id; }
    public function getThemeDetails() { return $this->theme_details; }
    public function getTheme() { return $this->theme_id; }
    public function getRole() { return $this->role; }
    public function getSurname() { return $this->surname; }
    public function getMail() { return $this->mail; }
    public function getAddress() { return $this->address; }
    public function getCp() { return $this->cp; }
    public function getProfession() { return $this->profession; }
    public function getProfession2() { return $this->profession2; }
    public function getPresentation() { return $this->presentation; }
    public function getPhotopath() { return $this->photopath; }
    public function getAssoName() {
        if (isset($this->association)) {
            return $this->association->getName();
        }
        else {
            $this->association = new MAssoc($this->association_id) ;
            return $this->association->getName();
        }
    }

    // Setters
    public function setAdress($adress)
    {
        $this->adress = $adress;
        $this->sql->exec('UPDATE USER SET ADDRESS = \''.$adress.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setCp($cp)
    {
        $this->cp = $cp;
        $this->sql->exec('UPDATE USER SET CP = \''.$cp.'\' WHERE ID = '.$this->id.' ;');
    }

        /**
         * @param mixed $role
         */
        /*public function setRole($role)
        {
            $this->role = $role;
            $pdo=new MDBase();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE USER  set ROLE = ? WHERE ID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($role, $this->id));
        }*/

    public function setLogin($login)
    {
        $this->login = $login;
        $this->sql->exec('UPDATE USER SET LOGIN = \''.$login.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
        $this->sql->exec('UPDATE USER SET mail = \''.$mail.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->sql->exec('UPDATE USER SET NAME = \''.$name.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setPhotopath($photopath)
    {
        $this->photopath = $photopath;
        $this->sql->exec('UPDATE USER SET PHOTOPATH = \''.$photopath.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;
        $this->sql->exec('UPDATE USER SET PRESENTATION = \''.$presentation.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setProfession($profession)
    {
        $this->profession = $profession;
        $this->sql->exec('UPDATE USER SET PROFESSION = \''.$profession.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setProfession2($profession2)
    {
        $this->profession2 = $profession2;
        $this->sql->exec('UPDATE USER SET PROFESSION2 = \''.$profession2.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setReset($reset)
    {
        $this->reset = $reset;
        $this->sql->exec('UPDATE USER SET PROFESSION2 = \''.$reset.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setRole($role)
    {
        $this->role = $role;
        $this->sql->exec('UPDATE USER SET ROLE = \''.$role.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
        $this->sql->exec('UPDATE USER SET SURNAME = \''.$surname.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setAssociationId($association_id)
    {
        $this->association_id = $association_id;
        $this->sql->exec('UPDATE USER SET ASSOCIATION_ID = \''.$association_id.'\' WHERE ID = '.$this->id.' ;');
    }


        public function toString()
        {
            return $this->surname." ".$this->name;
        }

    public function setThemeDetails($theme_details)
    {
        $this->theme_details = $theme_details;
        $this->sql->exec('UPDATE USER SET THEME_DETAILS = \''.$theme_details.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
        $this->sql->exec('UPDATE USER SET THEME = \''.$theme.'\' WHERE ID = '.$this->id.' ;');
    }


    public function setThemeInterestId($theme_interest_id)
    {
        $this->theme_interest_id = $theme_interest_id;
        $this->sql->exec('UPDATE USER SET THEME_INTEREST_ID = \''.$theme_interest_id.'\' WHERE ID = '.$this->id.' ;');
    }

}