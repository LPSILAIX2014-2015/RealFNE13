<?php

    class MUser {

        private $sql;

        private $id;
        private $login;
        private $reset; //ToDo A passer dans une table externe temporaire
        private $association_id;
        private $theme_interest_id;
        private $theme_details;
        private $role;
        private $name;
        private $surname;
        private $mail;
        private $adress;
        private $cp;
        private $profession;
        private $profession2;
        private $presentation;
        private $photopath;
        private $association;

        function __construct ($id) {
            $sql = new MDBase();
            if (is_int($id+0))
            {
                $state = $sql->prepare("SELECT * FROM USER WHERE ID = :id;");
                $state->bindValue('id', $id, PDO::PARAM_INT);
            }
            else
            {
                $state = $sql->prepare("SELECT * FROM USER WHERE MAIL = :mail;");
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
            $this->adress = $user['ADRESS'];
            $this->cp = $user['CP'];
            $this->profession = $user['PROFESSION'];
            $this->profession2 = $user['PROFESSION2'];
            $this->presentation = $user['PRESENTATION'];
            $this->photopath = $user['PHOTOPATH'];
        }

        /**
         * @param mixed $adress
         */
        public function setAdress($adress)
        {
            $this->adress = $adress;
        }

        /**
         * @return mixed
         */
        public function getAdress()
        {
            return $this->adress;
        }

        /**
         * @param mixed $cp
         */
        public function setCp($cp)
        {
            $this->cp = $cp;
        }

        /**
         * @return mixed
         */
        public function getCp()
        {
            return $this->cp;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $login
         */
        public function setLogin($login)
        {
            $this->login = $login;
        }

        /**
         * @return mixed
         */
        public function getLogin()
        {
            return $this->login;
        }

        /**
         * @param mixed $mail
         */
        public function setMail($mail)
        {
            $this->mail = $mail;
        }

        /**
         * @return mixed
         */
        public function getMail()
        {
            return $this->mail;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $photopath
         */
        public function setPhotopath($photopath)
        {
            $this->photopath = $photopath;
        }

        /**
         * @return mixed
         */
        public function getPhotopath()
        {
            return $this->photopath;
        }

        /**
         * @param mixed $presentation
         */
        public function setPresentation($presentation)
        {
            $this->presentation = $presentation;
        }

        /**
         * @return mixed
         */
        public function getPresentation()
        {
            return $this->presentation;
        }

        /**
         * @param mixed $profession
         */
        public function setProfession($profession)
        {
            $this->profession = $profession;
        }

        /**
         * @return mixed
         */
        public function getProfession()
        {
            return $this->profession;
        }

        /**
         * @param mixed $profession2
         */
        public function setProfession2($profession2)
        {
            $this->profession2 = $profession2;
        }

        /**
         * @return mixed
         */
        public function getProfession2()
        {
            return $this->profession2;
        }

        /**
         * @param mixed $reset
         */
        public function setReset($reset)
        {
            $this->reset = $reset;
        }

        /**
         * @return mixed
         */
        public function getReset()
        {
            return $this->reset;
        }

        /**
         * @param mixed $role
         */
        public function setRole($role)
        {
            $this->role = $role;
            $pdo=new MDBase();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE user  set ROLE = ? WHERE ID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($role, $this->id));
        }

        /**
         * @return mixed
         */
        public function getRole()
        {
            return $this->role;
        }

        /**
         * @param mixed $surname
         */
        public function setSurname($surname)
        {
            $this->surname = $surname;
        }

        /**
         * @return mixed
         */
        public function getSurname()
        {
            return $this->surname;
        }

        /**
         * @param mixed $theme_association_id
         */
        public function setAssociationId($association_id)
        {
            $this->association_id = $association_id;
        }

        /**
         * @return mixed
         */
        public function getAssociationId()
        {
            return $this->association_id;
        }

        /**
         * @param mixed $theme_details
         */
        public function setThemeDetails($theme_details)
        {
            $this->theme_details = $theme_details;
        }

        /**
         * @return mixed
         */
        public function getThemeDetails()
        {
            return $this->theme_details;
        }

        /**
         * @param mixed $theme_interest_id
         */
        public function setThemeInterestId($theme_interest_id)
        {
            $this->theme_interest_id = $theme_interest_id;
        }

        /**
         * @return mixed
         */
        public function getThemeInterestId()
        {
            return $this->theme_interest_id;
        }

        public  function getAssoName() {
            if (isset($this->association)) {
                return $this->association->getName();
            }
            else {
                $this->association = new MAssoc($this->association_id) ;
                return $this->association->getName();
            }
        }

        public function toString()
        {
            return $this->surname." ".$this->name;
        }

    }

