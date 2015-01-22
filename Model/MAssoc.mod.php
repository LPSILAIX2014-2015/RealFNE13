<?php
// ToDo : Tester les setters (si les modifs impactent bien la base)
    class MAssoc {

        private $sql;

        private $id;
        private $name;
        private $territory;

        function __construct ($id) {
            $this->sql = new MDBase();
            $state = $this->sql->prepare("SELECT * FROM ASSOCIATION WHERE ID = :id");
            $state->bindValue('id', $id, PDO::PARAM_INT);
            $state->execute();
            $assoc = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->name = $assoc['NAME'];
            $this->territory= $assoc['TERRITORY_ID'];
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
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
            $this->sql->exec('UPDATE ASSO SET NAME = \''.$name.'\' WHERE ID = '.$this->id.' ;');

        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $territory
         */
        public function setTerritory($territory)
        {
            $this->territory = $territory;
            $this->sql->exec('UPDATE ASSO SET TERRITORY = \''.$territory.'\' WHERE ID = '.$this->id.' ;');
        }

        /**
         * @return mixed
         */
        public function getTerritory()
        {
            return $this->territory;
        }

    }