<?php
// ToDo : Tester les setters (si les modifs impactent bien la base)
    class MAssoc {

        private $sql;

        private $id;
        private $name;
        private $territory;
        private $theme;

        function __construct ($id) {
            $this->sql = new MDBase();
            $state = $this->sql->prepare("SELECT * FROM ASSOCIATION WHERE ID = :id");
            $state->bindValue('id', $id, PDO::PARAM_INT);
            $state->execute();
            $assoc = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->name = $assoc['NAME'];
            $this->territory= $assoc['TERRITORY_ID'];
            $this->theme= $assoc['THEME_ID'];
        }


        // Getters
        public function getId() { return $this->id; }
        public function getName() { return $this->name; }
        public function getTerritory() { return $this->territory; }
        public function getTheme() { return $this->theme; }


        // Setters
        public function setName($name)
        {
            $this->name = $name;
            $this->sql->exec('UPDATE ASSOCIATION SET NAME = \''.$name.'\' WHERE ID = '.$this->id.' ;');

        }

        public function setTerritory($territory)
        {
            $this->territory = $territory;
            $this->sql->exec('UPDATE ASSOCIATION SET TERRITORY_ID = \''.$territory.'\' WHERE ID = '.$this->id.' ;');
        }


        public function setTheme($theme)
        {
            $this->theme = $theme;
            $this->sql->exec('UPDATE ASSOCIATION SET THEME_ID = \''.$theme.'\' WHERE ID = '.$this->id.' ;');
        }

        public function getMembers(){
            $sql = new MDBase();
            $state = $sql->prepare("SELECT ID, NAME, SURNAME FROM USER WHERE ASSOCIATION_ID = :id ORDER By ROLE ASC");
            $state->bindValue('id', $this->id, PDO::PARAM_INT);
            $state->execute();
            $assoc = $state->fetchall();
            return $assoc;
        }

    }